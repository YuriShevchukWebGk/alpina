<?php
//include the autoloader
require_once('/var/www/alpinabook.ru/html/custom-scripts/pdfcompressor/init.php');

use Ilovepdf\WatermarkTask;

//you can call task class directly
$myTask = new WatermarkTask('project_public_92d17fc0e70037d9e7f8b8f68aae7d4f_Z0jxAac3a74859d14220d92cdf6f64f354d4f','secret_key_e4bf468238bfc07d670aee2e5af18039_T1uIU695871d8d31e365d07c0719fda080919');

// file var keeps info about server file id, name...
// it can be used latter to cancel file
$file = $myTask->addFile('/var/www/alpinabook.ru/html/upload/books_catalog_files/iblock/d48/test.pdf');

// set mode to text
$myTask->setMode("text");

// set the text
$myTask->setText("watermark text");

// process files
// time var will have info about time spent in process
$time = $myTask->execute();

// and finally download the unlocked file. If no path is set, it will be donwloaded on current folder
$myTask->download();