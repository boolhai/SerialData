<?php


namespace serialdata;


/**
 * tft 串口数据
 * Class tft
 * @package Serialdata
 */
class tft extends \serialdata\SerialBase
{

    private static $symbol='';//byte数据是否带0x
    private static $s1_1='5A';//帧头
    private static $s1_2='A5';



    public static function change($page){
        $hex='5AA5078200845A01'.$page;
        $content_arr=str_split($hex,2);
        $byte=array();
        foreach ($content_arr as $k=>$v){
            $byte[]=self::$symbol.$v;
        }
        $result=array();
        $result['byte']=$byte;
        $result['dataLen']=count($byte);
        $str='';
        for ($i = 0; $i < count($byte); $i++){
            $str.=chr(hexdec($byte[$i]));
        }
        $result['data']=base64_encode($str);
        return $result;
    }

    public static function changeHex($page){
        $hex='5AA5078200845A01'.$page;
        $content_arr=str_split($hex,2);
        $byte=array();
        foreach ($content_arr as $k=>$v){
            $byte[]=self::$symbol.$v;
        }
        $result=array();
        $result['byte']=$byte;
        $result['dataLen']=count($byte);
        $str='';
        for ($i = 0; $i < count($byte); $i++){
            $str.=chr(hexdec($byte[$i]));
        }
        $result['data']=strtoupper(bin2hex($str));
        return $result;
    }
    /**
     *获取byte数组根据cmd
     *
     * @param 功能码 $cmd
     * @param 子命令 $subcmd 行号
     * @param 内容 $content GBK码语音
     * @param 串口内容 $content2 组装好的byte数组
     * @param 次数 $time 临时显示时长/次数 0为永久
     * @return byte数组 $byte
    isdt 显示数字
     */
    public static function getbytearrbycmd($cmd='',$addr=array(),$content='',$isdt=false){
        $byte=array();
        $byte[]=self::$symbol.self::$s1_1;//帧头2位
        $byte[]=self::$symbol.self::$s1_2;
        $byte[]='00';//数据长度
        $len=0;
        $byte[]=self::$symbol.$cmd;//命令1位
        $len++;
        $byte=array_merge($byte,$addr);
        $len+=2;

        if ($content!=='') {
            if($isdt){
                $hex=str_pad(dechex($content),4,'0',STR_PAD_LEFT);
                $content_arr=str_split($hex,2);

                foreach ($content_arr as $k=>$v){
                    $byte[]=self::$symbol.$v;
                }
                $len+=2;
            }else{
                $gbkstr = mb_convert_encoding($content,'GBK','UTF-8');
                $len+=mb_strlen($gbkstr);
                $hex = self::str2hex($gbkstr);
                $content_arr=str_split($hex,2);

                foreach ($content_arr as $k=>$v){
                    $byte[]=self::$symbol.$v;
                }
            }
        }
        $byte[2]=dechex($len);

        $result=array();
        $result['byte']=$byte;
        $result['dataLen']=count($byte);
        $str='';
        for ($i = 0; $i < count($byte); $i++){
            $str.=chr(hexdec($byte[$i]));
        }
        $result['data']=base64_encode($str);
        return $result;
    }

    public static function packetDataHex($cmd='',$addr=array(),$content='',$isdt=false){
        $byte=array();
        $byte[]=self::$symbol.self::$s1_1;//帧头2位
        $byte[]=self::$symbol.self::$s1_2;
        $byte[]='00';//数据长度
        $len=0;
        $byte[]=self::$symbol.$cmd;//命令1位
        $len++;
        $byte=array_merge($byte,$addr);
        $len+=2;

        if ($content!=='') {
            if($isdt){
                $hex=str_pad(dechex($content),4,'0',STR_PAD_LEFT);
                $content_arr=str_split($hex,2);

                foreach ($content_arr as $k=>$v){
                    $byte[]=self::$symbol.$v;
                }
                $len+=2;
            }else{
                $gbkstr = mb_convert_encoding($content,'GBK','UTF-8');
                $len+=mb_strlen($gbkstr);
                $hex = self::str2hex($gbkstr);
                $content_arr=str_split($hex,2);

                foreach ($content_arr as $k=>$v){
                    $byte[]=self::$symbol.$v;
                }
            }
        }
        $byte[2]=dechex($len);

        $result=array();
        $result['byte']=$byte;
        $result['dataLen']=count($byte);
        $str='';
        for ($i = 0; $i < count($byte); $i++){
            $str.=chr(hexdec($byte[$i]));
        }
        $result['data']=strtoupper(bin2hex($str));
        return $result;
    }

}