<?php


namespace serialdata;

//串口基础抽象类；
abstract class SerialBaseAbstract implements serialdefaultInterface
{

    //获取停车场串口数据
    abstract function getparkData();

    /**
     * 无符号位移
     *
     * @param 10进制数 $a
     * @param 位移位数 $n
     * @return boolean
     */
    public function uright($a, $n)
    {
        $c = 2147483647>>($n-1);
        return $c&($a>>$n);
    }

    /**
     * 字符串转换成16进制
     *
     * @param $str
     * @return string
     */
    public static function str2hex($str){
        $hex = '';
        for($i=0,$length=mb_strlen($str); $i<$length; $i++){
            $hex .= dechex(ord($str{$i}));
        }
        return $hex;
    }


    /**
     * 16进制转换成字符串
     *
     * @param $hex
     * @return string
     */
    public static function hex2str($hex){
        $str = '';
        $arr = str_split($hex, 2);
        foreach($arr as $bit){
            $str .= chr(hexdec($bit));
        }
        return $str;
    }


    /**
     * 中文转byte数组
     *
     * @param $word
     * @return array
     */
    public static function gbk2byte($word){
        $gbkstr = mb_convert_encoding($word,'GBK','UTF-8');//中文编码GBK
        $hex = self::str2hex($gbkstr);
        $word_arr=str_split($hex,2);
        return $word_arr;
    }

}