<?php

/*
*Создать php скрипт который возьмет данные из csv файла (test.csv) и создаст из них xml фид (result.xml). 
*Размер csv файла может быть больше 10 мб. 
*Процесс создания файла должен быть разбит на шаги, чтобы скрипт на отваливался из-за нехватки ресурсов сервера.
*/

//script settings
ini_set('memory_limit', '256M');
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', true);
ini_set('auto_detect_line_endings', true);

//column header mapping 
$arrData = array_map('str_getcsv', file('test.csv'));

foreach ($arrData as $key => $data) {
    $arrData[$key] = array_slice($arrData[$key], 0, 17);
    $arrData[$key] = array_combine($arrData[0], $arrData[$key]);
}

$data = array_values(array_slice($arrData, 1));

//xml list init
$dom = new DOMDocument('1.0', 'UTF-8');
$dom->formatOutput = true;
$dom->preserveWhiteSpace = false;

$xmlList = $dom->createElement("xml");
$xmlList = $dom->appendChild($xmlList);

//make xml nodes
foreach ($data as $d) {
    $itemNode = $dom->createElement('item');

    foreach ($d as $k => $v) {
        $key = str_replace(" ", "_", trim($k));
        $childNode = $dom->createElement($key, htmlspecialchars(trim($v)));
        $itemNode->appendChild($childNode);
    }
    $xmlList->appendChild($itemNode);
}

//saving xml
file_put_contents("result.xml", $dom->saveXML());

?>