<?php


namespace serialdata;


interface serialdefaultInterface
{


    //字符串转换成16进制
    public static function str2hex($str);
    //16进制转换成字符串
    public static function hex2str($hex);
    //中文转byte数组
    public static function gbk2byte($word);


}