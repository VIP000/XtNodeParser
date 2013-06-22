<?php

//turn on the buffer stream
ob_start();
echo file_get_contents('file.html');
$context = ob_get_contents();
ob_end_clean();

include './Autoloader.php';
Autoloader::register();
$time = microtime();
$time = explode(" ", $time);
$time = $time[1] + $time[0];
$start = $time;

try
{
    $xtParser = new XtNodeParser\Parser($context);
    echo $xtParser;
}
catch (\Exception $e)
{
    echo $e->getMessage();
}
$time = microtime();
$time = explode(" ", $time);
$time = $time[1] + $time[0];
$finish = $time;
$totaltime = ($finish - $start);
printf("<br/><br/><br/>Page took %f seconds to load.", $totaltime);