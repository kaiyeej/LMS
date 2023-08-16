<?php
$Menus = new Menus();
$Menus->routes($page, $dir);

require_once $Menus->dir;
$route_settings = json_encode($Menus->route_settings);
