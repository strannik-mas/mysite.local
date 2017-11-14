<?
$dt = time();
// var_dump($dt);

$page = $_SERVER["REQUEST_URI"];
// $page = $_GET["id"] ?? "index";			//PHP7 - if
$ref = $_SERVER["HTTP_REFERER"];
$ref = pathinfo($ref, PATHINFO_BASENAME);
$refIP = $_SERVER["REMOTE_ADDR"];
$pathStr = implode("|", array($dt, $page, $ref, $refIP));
$pathStr .= "\n";
file_put_contents('log/'.PATH_LOG, $pathStr, FILE_APPEND);