<?php

class Logs extends Connection
{
	public static function error($action, $module, $message, $user_id = 0, $date = '')
	{
		$log_filename = $_SERVER['DOCUMENT_ROOT'] . "/" . APP_FOLDER . "/logs/error";
		$self = new self;

		$user = $user_id == 0 ? $_SESSION['lms_user_id'] : $user_id;
		if ($date == '') {
			$log_file_data = $log_filename . '/log_' . date('m-Y') . '.log';
			$datetime = date('Y-m-d H:i:s');
		} else {
			$log_file_data = $log_filename . '/log_' . date('m-Y', strtotime($date)) . '.log';
			$datetime = $date;
		}

		$dataToLog = [
			'user_id'       => Users::name($user),
			'action'        => $self->clean($action),
			'module'        => $self->clean($module),
			'message'		=> $self->clean($message),
			'date_added'	=> $datetime
		];

		$data = '"' . implode('","', $dataToLog) . '"';
		$data .= PHP_EOL;
		return file_put_contents($log_file_data, $data, FILE_APPEND);
	}

	public static function action($action, $module, $method, $user_id = 0, $date = '')
	{
		$log_filename = $_SERVER['DOCUMENT_ROOT'] . "/" . APP_FOLDER . "/logs/action";
		$self = new self;

		$user = $user_id == 0 ? $_SESSION['lms_user_id'] : $user_id;
		if ($date == '') {
			$log_file_data = $log_filename . '/log_' . date('m-Y') . '.log';
			$datetime = date('Y-m-d H:i:s');
		} else {
			$log_file_data = $log_filename . '/log_' . date('m-Y', strtotime($date)) . '.log';
			$datetime = $date;
		}

		$dataToLog = [
			'user_id'       => $user == -1 ? "" : Users::name($user),
			'action'        => $self->clean($action),
			'module'        => $self->clean($module),
			'method'        => $self->clean($method),
			'date_added'	=> $datetime
		];

		$data = '"' . implode('","', $dataToLog) . '"';
		$data .= PHP_EOL;
		return file_put_contents($log_file_data, $data, FILE_APPEND);
	}
}
