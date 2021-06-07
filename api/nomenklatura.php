<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../models/nomenklatura.php';



$result = new Nomenklatura();

$data = json_decode(file_get_contents("php://input"));


$result->lat = $data->latitude;
$result->long = $data->longitude;
$result->masshtab = $data->masshtab;




// echo ($data);
// echo file_get_contents("php://input");

if ($data->masshtab == 1) {
    echo json_encode($result->zone());
}
if ($data->masshtab == 2) {
    echo json_encode($result->five_hundred());
}
if ($data->masshtab == 3) {
    echo json_encode($result->three_hundred());
}
