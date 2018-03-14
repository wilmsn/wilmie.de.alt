<?php

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
$result = socket_connect($socket, '127.0.0.1', 7001);

$in = "html order\r\n";
$out = '';

socket_write($socket, $in, strlen($in));

while ($out = socket_read($socket, 2048)) {
	if ( (! strpos($out, 'f24hub')) and (! strpos($out, 'received')) ) echo $out."<br>";
}

socket_close($socket);

?>
