<?php
header("Content-Type: text/event-stream");
header("Cache-Control: no-cache");
header("Connection: keep-alive");

for ($i = 1; $i <= 10; $i++) {
	echo "data: Step $i\n\n";
	flush(); // Flush output buffer
	sleep(1); // Wait for 1 second
}
