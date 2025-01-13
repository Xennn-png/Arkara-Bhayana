<?php
$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$relativePath = getenv('PHP_SERVER_RELATIVE_PATH') ?: '';
$fullPath = $_SERVER["DOCUMENT_ROOT"] . $relativePath . $path;
if (!file_exists($fullPath) || is_dir($fullPath)) {
    file_put_contents("php://stderr", sprintf("[%s] %s - No such file or directory\n", date("D M j H:i:s Y"), $path));
} else {
    file_put_contents("php://stdout", sprintf("[%s] %s\n", date("D M j H:i:s Y"), $path));
}
return false;
?>