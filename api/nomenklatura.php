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
if ($data->masshtab == 5) {
    echo json_encode($result->hundred());
}
if ($data->masshtab == 6) {
    echo json_encode($result->fifty());
}
if ($data->masshtab == 7) {
    echo json_encode($result->tventy_five());
}

if ($data->masshtab == 8) {
    echo json_encode($result->teen());
}

if ($data->masshtab == 9) {
    echo json_encode($result->five());
}
if ($data->masshtab == 10) {
    echo json_encode($result->two());
}