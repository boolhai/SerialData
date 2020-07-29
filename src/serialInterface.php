<?php


namespace serialdata;


interface serialInterface
{

    //无符号位移
    public function uright($a, $n);
    //16进制转换成字符串
    public function hex2str($hex);

}