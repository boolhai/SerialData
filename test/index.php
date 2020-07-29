<?php

require '../vendor/autoload.php';
//exit('s');
//$obj= new \serialdata\test();
//var_dump($obj->index());


//$obj= new \serialdata\aa();
//$obj= new \serialdata\SerialBase(3,1);
//var_dump($obj->index());
//exit();

/*try{
    $obj = new \serialdata\deviceblue();
    $data = $obj->getbytearrbycmd('62','00','嘻耍耍科技');
    echo '<pre>';
    print_r($data);
    echo '<pre/>';
}catch (Exception $e){
    echo $e->getMessage();
}*/

$serviceserial = new \serialdata\serviceserial(3);
//exit();

$arr = [
    '嘻耍耍科技',
    '无人值守',
    '自助交费',
    '欢迎光临',
];
$data = $serviceserial->getalllinemsg($arr);

$param=['soundnumber'=>2];
$voicedata = $serviceserial->getvoice($param);
$timedata = $serviceserial->timecalibration();
$tftdata = $serviceserial->getTFThex('0002');
//echo json_encode($voicedata);
echo(json_encode($tftdata));
echo(json_encode($timedata));
//echo '<br>';
echo json_encode(array_merge_recursive($voicedata,$data));



