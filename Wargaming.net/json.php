<?php
header("Content-Type: application/json");
header('Content-Type: text/html; charset= utf-8');

$data = json_decode(file_get_contents("php://input"));
$file = file_get_contents('ships.json'); // Открыть файл data.json
$array = json_decode($file, true);




function search($array, $key, $value)
{
    $results = array();

    if (is_array($array)) {
        if (isset($array[$key]) && $array[$key] == $value) {
            $results[] = $array;
        }

        foreach ($array as $subarray) {
            $results = array_merge($results, search($subarray, $key, $value));
        }
    }

    return $results;
}

(array)$myArray = [];
if (!empty($data->inp)) {

  foreach ($array as $nam => $items){
    foreach ($items as $key => $value)
    {
      if($key == 'name')
      {
        $str = preg_split('//u', $data->inp, -1, PREG_SPLIT_NO_EMPTY);
        $valiestr  = preg_split('//u', $value, -1, PREG_SPLIT_NO_EMPTY);
        $result = array_intersect_assoc($str, $valiestr);
        if (count($result)>=3){
          array_push($myArray, $items);
        }
      }
    }
  }

  if (!empty($data->country)){
    $myArray = (search($myArray, 'nation', "$data->country"));
  }

    if (!empty($data->typeid)){
      $myArray = (search($myArray, 'type', "$data->typeid"));
    }

    if (!empty($data->classa)){
      $myArray = (search($myArray, 'level', "$data->classa"));
    }





} elseif (!empty($data->country)) {
    foreach ($array as $nam => $items){
      foreach ($items as $key => $value)
      {
        if($key == 'nation' and $value=="$data->country")
        {
          array_push($myArray, $items);
        }
      }
    }


      if (!empty($data->typeid)){
        $myArray = (search($myArray, 'type', "$data->typeid"));
      }

      if (!empty($data->classa)){
        $myArray = (search($myArray, 'level', "$data->classa"));
      }



} elseif (!empty($data->typeid)){

  foreach ($array as $nam => $items){
    foreach ($items as $key => $value)
    {

      if($key == 'type' and $value=="$data->typeid")
      {
        array_push($myArray, $items);
      }
    }
  }


  if (!empty($data->country)){
    $myArray = (search($myArray, 'nation', "$data->country"));
  }

    if (!empty($data->classa)){
      $myArray = (search($myArray, 'level', "$data->classa"));
    }



} elseif (!empty($data->classa)){
  foreach ($array as $nam => $items){
    foreach ($items as $key => $value)
    {

      if($key == 'level' and $value=="$data->classa")
      {
        array_push($myArray, $items);
      }
    }
  }

} else {


  foreach ($array as $nam => $items){
        array_push($myArray, $items);
    }
}

$arrr = json_encode($myArray);
print_r($arrr);
?>
