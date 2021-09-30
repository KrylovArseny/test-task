<?php
header("Content-Type: application/json");
header('Content-Type: text/html; charset= utf-8');

$data = json_decode(file_get_contents("php://input"));
$file = file_get_contents('ships.json'); // Открыть файл data.json
$array = json_decode($file, true);
$myArray = [];
$myArray1=[];
$myArray2=[];


foreach ($array as $nam => $items)
{
    foreach ($items as $key => $value)
    {
      if($key == 'nation'){
        array_push($myArray1, "$value");
      }
    }
}
$myArray1 = (array_unique($myArray1));
array_push($myArray, $myArray1);


foreach ($array as $nam => $items)
{
    foreach ($items as $key => $value)
    {
      if($key == 'type'){
        array_push($myArray2, "$value");
      }
    }
}
$myArray2 = (array_unique($myArray2));
array_push($myArray, $myArray2);



$arrr = json_encode($myArray);
print_r($arrr);

