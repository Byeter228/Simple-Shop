<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // дата в прошлом

// Получить имя запрашиваемого файла
$filename = filter_input(INPUT_GET, 'src', FILTER_SANITIZE_STRING);
// Узнать расширение файла
$ext = strtolower( pathinfo( $fullPath, PATHINFO_EXTENSION));
switch ($ext) {
  case "gif": $ctype="image/gif"; break;
  case "png": $ctype="image/png"; break;
  case "jpeg":
  case "jpg": $ctype="image/jpg"; break;
  default: $ctype="application/force-download";
}
header("Content-Type: $ctype");
// считать и выдать в ответ содержание файла как есть
readfile( $filename);
?>