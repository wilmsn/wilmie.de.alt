<?php
error_reporting(E_ALL);

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
$result = socket_connect($socket, '127.0.0.1', 7001);

$in = "html order\n";
$buf = '';

socket_write($socket, $in, strlen($in));

socket_recv($socket, $buf, 2048, MSG_WAITALL);
socket_close($socket);

$delme =array("rf24hub>", "Command received => OK");
$out = str_replace($delme, "", $buf);

echo $out . "\n";

?>