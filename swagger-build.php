<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/6/1
 * Time: 下午12:56
 */
require 'vendor/autoload.php';
echo "[building]>>>Loading Swagger...";
$swagger = \Swagger\scan('./application');
//header('Content-Type: application/json');
$fileName = 'swagger-doc.json';
$file = fopen('./' . $fileName, 'w');
fwrite($file, $swagger);
fclose($file);
echo "[OK]>>>Swagger-doc file is ok.  ";
