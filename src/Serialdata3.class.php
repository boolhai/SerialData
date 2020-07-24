<?php
//蓝板
class Serialdata3 {
    private static $symbol='';//byte数据是否带0x
    private static $s1_1='00';//帧头
    private static $s1_2='64';
    private static $s1_3='FF';
    private static $s1_4='FF';

    private static $s2_1='01';//保留
    private static $s2_2='64';
    private static $s2_3='00';
    private static $end='AF';//结束
    private static $auchCRCHi = array (
        0x00, 0xC1, 0x81, 0x40, 0x01, 0xC0, 0x80, 0x41, 0x01, 0xC0, 0x80, 0x41,
        0x00, 0xC1, 0x81, 0x40, 0x01, 0xC0, 0x80, 0x41, 0x00, 0xC1, 0x81, 0x40,
        0x00, 0xC1, 0x81, 0x40, 0x01, 0xC0, 0x80, 0x41, 0x01, 0xC0, 0x80, 0x41,
        0x00, 0xC1, 0x81, 0x40, 0x00, 0xC1, 0x81, 0x40, 0x01, 0xC0, 0x80, 0x41,
        0x00, 0xC1, 0x81, 0x40, 0x01, 0xC0, 0x80, 0x41, 0x01, 0xC0, 0x80, 0x41,
        0x00, 0xC1, 0x81, 0x40, 0x01, 0xC0, 0x80, 0x41, 0x00, 0xC1, 0x81, 0x40,
        0x00, 0xC1, 0x81, 0x40, 0x01, 0xC0, 0x80, 0x41, 0x00, 0xC1, 0x81, 0x40,
        0x01, 0xC0, 0x80, 0x41, 0x01, 0xC0, 0x80, 0x41, 0x00, 0xC1, 0x81, 0x40,
        0x00, 0xC1, 0x81, 0x40, 0x01, 0xC0, 0x80, 0x41, 0x01, 0xC0, 0x80, 0x41,
        0x00, 0xC1, 0x81, 0x40, 0x01, 0xC0, 0x80, 0x41, 0x00, 0xC1, 0x81, 0x40,
        0x00, 0xC1, 0x81, 0x40, 0x01, 0xC0, 0x80, 0x41, 0x01, 0xC0, 0x80, 0x41,
        0x00, 0xC1, 0x81, 0x40, 0x00, 0xC1, 0x81, 0x40, 0x01, 0xC0, 0x80, 0x41,
        0x00, 0xC1, 0x81, 0x40, 0x01, 0xC0, 0x80, 0x41, 0x01, 0xC0, 0x80, 0x41,
        0x00, 0xC1, 0x81, 0x40, 0x00, 0xC1, 0x81, 0x40, 0x01, 0xC0, 0x80, 0x41,
        0x01, 0xC0, 0x80, 0x41, 0x00, 0xC1, 0x81, 0x40, 0x01, 0xC0, 0x80, 0x41,
        0x00, 0xC1, 0x81, 0x40, 0x00, 0xC1, 0x81, 0x40, 0x01, 0xC0, 0x80, 0x41,
        0x00, 0xC1, 0x81, 0x40, 0x01, 0xC0, 0x80, 0x41, 0x01, 0xC0, 0x80, 0x41,
        0x00, 0xC1, 0x81, 0x40, 0x01, 0xC0, 0x80, 0x41, 0x00, 0xC1, 0x81, 0x40,
        0x00, 0xC1, 0x81, 0x40, 0x01, 0xC0, 0x80, 0x41, 0x01, 0xC0, 0x80, 0x41,
        0x00, 0xC1, 0x81, 0x40, 0x00, 0xC1, 0x81, 0x40, 0x01, 0xC0, 0x80, 0x41,
        0x00, 0xC1, 0x81, 0x40, 0x01, 0xC0, 0x80, 0x41, 0x01, 0xC0, 0x80, 0x41,
        0x00, 0xC1, 0x81, 0x40
    );
    private static $auchCRCLo = array (
        0x00, 0xC0, 0xC1, 0x01, 0xC3, 0x03, 0x02, 0xC2, 0xC6, 0x06, 0x07, 0xC7,
        0x05, 0xC5, 0xC4, 0x04, 0xCC, 0x0C, 0x0D, 0xCD, 0x0F, 0xCF, 0xCE, 0x0E,
        0x0A, 0xCA, 0xCB, 0x0B, 0xC9, 0x09, 0x08, 0xC8, 0xD8, 0x18, 0x19, 0xD9,
        0x1B, 0xDB, 0xDA, 0x1A, 0x1E, 0xDE, 0xDF, 0x1F, 0xDD, 0x1D, 0x1C, 0xDC,
        0x14, 0xD4, 0xD5, 0x15, 0xD7, 0x17, 0x16, 0xD6, 0xD2, 0x12, 0x13, 0xD3,
        0x11, 0xD1, 0xD0, 0x10, 0xF0, 0x30, 0x31, 0xF1, 0x33, 0xF3, 0xF2, 0x32,
        0x36, 0xF6, 0xF7, 0x37, 0xF5, 0x35, 0x34, 0xF4, 0x3C, 0xFC, 0xFD, 0x3D,
        0xFF, 0x3F, 0x3E, 0xFE, 0xFA, 0x3A, 0x3B, 0xFB, 0x39, 0xF9, 0xF8, 0x38,
        0x28, 0xE8, 0xE9, 0x29, 0xEB, 0x2B, 0x2A, 0xEA, 0xEE, 0x2E, 0x2F, 0xEF,
        0x2D, 0xED, 0xEC, 0x2C, 0xE4, 0x24, 0x25, 0xE5, 0x27, 0xE7, 0xE6, 0x26,
        0x22, 0xE2, 0xE3, 0x23, 0xE1, 0x21, 0x20, 0xE0, 0xA0, 0x60, 0x61, 0xA1,
        0x63, 0xA3, 0xA2, 0x62, 0x66, 0xA6, 0xA7, 0x67, 0xA5, 0x65, 0x64, 0xA4,
        0x6C, 0xAC, 0xAD, 0x6D, 0xAF, 0x6F, 0x6E, 0xAE, 0xAA, 0x6A, 0x6B, 0xAB,
        0x69, 0xA9, 0xA8, 0x68, 0x78, 0xB8, 0xB9, 0x79, 0xBB, 0x7B, 0x7A, 0xBA,
        0xBE, 0x7E, 0x7F, 0xBF, 0x7D, 0xBD, 0xBC, 0x7C, 0xB4, 0x74, 0x75, 0xB5,
        0x77, 0xB7, 0xB6, 0x76, 0x72, 0xB2, 0xB3, 0x73, 0xB1, 0x71, 0x70, 0xB0,
        0x50, 0x90, 0x91, 0x51, 0x93, 0x53, 0x52, 0x92, 0x96, 0x56, 0x57, 0x97,
        0x55, 0x95, 0x94, 0x54, 0x9C, 0x5C, 0x5D, 0x9D, 0x5F, 0x9F, 0x9E, 0x5E,
        0x5A, 0x9A, 0x9B, 0x5B, 0x99, 0x59, 0x58, 0x98, 0x88, 0x48, 0x49, 0x89,
        0x4B, 0x8B, 0x8A, 0x4A, 0x4E, 0x8E, 0x8F, 0x4F, 0x8D, 0x4D, 0x4C, 0x8C,
        0x44, 0x84, 0x85, 0x45, 0x87, 0x47, 0x46, 0x86, 0x82, 0x42, 0x43, 0x83,
        0x41, 0x81, 0x80, 0x40
    );
    /**
     * 无符号位移
     * @param 10进制数 $a
     * @param 位移位数 $n
     * @return boolean
     */
    public static function uright($a, $n)
    {
        $c = 2147483647>>($n-1);
        return $c&($a>>$n);
    }
    //crc16校验
    public static function genCRC ($ptr){
        $uchCRCHi    =0xFF;
        $uchCRCLo    =0xFF;
        $uIndex        =0;
        for ($i=0;$i<strlen($ptr);$i++){
            $uIndex        =$uchCRCLo ^ ord(substr($ptr,$i,1));
            $uchCRCLo    =$uchCRCHi ^ self::$auchCRCHi[$uIndex];
            $uchCRCHi    =self::$auchCRCLo[$uIndex] ;
        }
        //return(chr($uchCRCLo).chr($uchCRCHi));
        $res=array(
            'hi'=>dechex($uchCRCHi),
            'lo'=>dechex($uchCRCLo)
        );
        return $res;
    }
    //字符串转换成16进制
    public static function str2hex($str){
        $hex = '';
        for($i=0,$length=mb_strlen($str); $i<$length; $i++){
            $hex .= dechex(ord($str{$i}));
        }
        return $hex;
    }
    //16进制转换成字符串
    public static function hex2str($hex){
        $str = '';
        $arr = str_split($hex, 2);
        foreach($arr as $bit){
            $str .= chr(hexdec($bit));
        }
        return $str;
    }
    /**
     *
     * @param 功能码 $cmd
     * @param 子命令 $subcmd 行号
     * @param 内容 $content GBK码语音
     * @param 串口内容 $content2 组装好的byte数组
     * @param 次数 $time 临时显示时长/次数 0为永久
     * @return byte数组 $byte
     */
    public static function packetData($cmd='',$subcmd='',$content=''){
        $byte=array();
        $byte[]=self::$symbol.self::$s1_1;//帧头2位
        $byte[]=self::$symbol.self::$s1_2;
        $byte[]=self::$symbol.self::$s1_3;
        $byte[]=self::$symbol.self::$s1_4;
        $byte[]=self::$symbol.$cmd;//命令1位
        if($cmd==62){
            $len=19;
            if ($content!=='') {
                $gbkstr = mb_convert_encoding($content,'GBK','UTF-8');//中文编码GBK
                $len+=mb_strlen($gbkstr);
                $len_txt=mb_strlen($gbkstr);
            }

            $byte[]=dechex($len);
            $byte[]=$subcmd;//行号
            $byte[]=(($len_txt>8)?'15':'00');//显示模式
            $byte[]='01';//显示速度
            $byte[]='00';//停留模式
            $byte[]='05';//停留时间
            $byte[]='00';//退出模式
            $byte[]='01';//退出速度
            $byte[]='03';//字体类型
            $byte[]='00';//显示次数
            $byte[]='FF';//红色分量
            $byte[]='00';
            $byte[]='00';
            $byte[]='00';
            $byte[]='00';
            $byte[]='00';
            $byte[]='00';
            $byte[]='00';
            $byte[]=dechex($len_txt);
            $byte[]='00';
        }elseif($cmd==30){
            $len=1;
            if ($content!=='') {
                $gbkstr = mb_convert_encoding($content,'GBK','UTF-8');//中文编码GBK
                $len+=mb_strlen($gbkstr);
            }
            $byte[]=dechex($len);
            $byte[]='02';
        }elseif($cmd==31){
            $byte[]='00';
        }elseif($cmd=='05'){
            $byte[]='08';
            $year=str_pad(dechex(date('Y')),4,'0',STR_PAD_LEFT);
            $byte[]=substr($year,-2);
            $byte[]=substr($year,0,2);
            $byte[]=dechex(date('m'));
            $byte[]=dechex(date('d'));
            $byte[]=dechex(date('w')+1);
            $byte[]=dechex(date('H'));
            $byte[]=dechex(date('i'));
            $byte[]=dechex(date('s'));
        }elseif($cmd=='0D'){
            $byte[]='01';
            $byte[]=dechex(intval($subcmd));
        }
        if ($content!=='') {
            $hex = self::str2hex($gbkstr);
            $content_arr=str_split($hex,2);

            foreach ($content_arr as $k=>$v){
                $byte[]=self::$symbol.$v;
            }
        }
        $test='';
        foreach($byte as $k => $v){
            $byte[$k]=strtoupper($v);
            $test.=chr('0x'.strtoupper($v));
        }
        //CRC16校验
        $res= self::genCRC( $test );
        $byte[]=self::$symbol.strtoupper($res['lo']);
        $byte[]=self::$symbol.strtoupper($res['hi']);

        //base64
        $result=array();
        //$result['test']=$test;
        $result['byte']=$byte;
        $result['dataLen']=count($byte);
        $str='';
        for ($i = 0; $i < count($byte); $i++){
            $str.=chr('0x'.$byte[$i]);
        }
        $result['data']=base64_encode($str);
        return $result;
    }

    public static function packetDataHex($cmd='',$subcmd='',$content=''){
        $byte=array();
        $byte[]=self::$symbol.self::$s1_1;//帧头2位
        $byte[]=self::$symbol.self::$s1_2;
        $byte[]=self::$symbol.self::$s1_3;
        $byte[]=self::$symbol.self::$s1_4;
        $byte[]=self::$symbol.$cmd;//命令1位
        if($cmd==62){
            $len=19;
            if ($content!=='') {
                $gbkstr = mb_convert_encoding($content,'GBK','UTF-8');//中文编码GBK
                $len+=mb_strlen($gbkstr);
                $len_txt=mb_strlen($gbkstr);
            }

            $byte[]=dechex($len);
            $byte[]=$subcmd;//行号
            $byte[]=(($len_txt>8)?'15':'00');//显示模式
            $byte[]='01';//显示速度
            $byte[]='00';//停留模式
            $byte[]='05';//停留时间
            $byte[]='00';//退出模式
            $byte[]='01';//退出速度
            $byte[]='03';//字体类型
            $byte[]='00';//显示次数
            $byte[]='FF';//红色分量
            $byte[]='00';
            $byte[]='00';
            $byte[]='00';
            $byte[]='00';
            $byte[]='00';
            $byte[]='00';
            $byte[]='00';
            $byte[]=dechex($len_txt);
            $byte[]='00';
        }elseif($cmd==30){
            $len=1;
            if ($content!=='') {
                $gbkstr = mb_convert_encoding($content,'GBK','UTF-8');//中文编码GBK
                $len+=mb_strlen($gbkstr);
            }
            $byte[]=dechex($len);
            $byte[]='02';
        }elseif($cmd==31){
            $byte[]='00';
        }elseif($cmd=='05'){
            $byte[]='08';
            $year=str_pad(dechex(date('Y')),4,'0',STR_PAD_LEFT);
            $byte[]=substr($year,-2);
            $byte[]=substr($year,0,2);
            $byte[]=dechex(date('m'));
            $byte[]=dechex(date('d'));
            $byte[]=dechex(date('w')+1);
            $byte[]=dechex(date('H'));
            $byte[]=dechex(date('i'));
            $byte[]=dechex(date('s'));
        }elseif($cmd=='0D'){
            $byte[]='01';
            $byte[]=dechex(intval($subcmd));
        }
        if ($content!=='') {
            $hex = self::str2hex($gbkstr);
            $content_arr=str_split($hex,2);

            foreach ($content_arr as $k=>$v){
                $byte[]=self::$symbol.$v;
            }
        }
        $test='';
        foreach($byte as $k => $v){
            $byte[$k]=strtoupper($v);
            $test.=chr('0x'.strtoupper($v));
        }
        //CRC16校验
        $res= self::genCRC( $test );
        $byte[]=self::$symbol.strtoupper($res['lo']);
        $byte[]=self::$symbol.strtoupper($res['hi']);

        //base64
        $result=array();
        //$result['test']=$test;
        $result['byte']=$byte;
        $result['dataLen']=count($byte);
        $str='';
        for ($i = 0; $i < count($byte); $i++){
            $str.=chr('0x'.$byte[$i]);
        }
        $result['data']=strtoupper(bin2hex($str));
        return $result;
    }

    //中文转byte数组
    public static function gbk2byte($word){
        $gbkstr = mb_convert_encoding($word,'GBK','UTF-8');//中文编码GBK
        $hex = self::str2hex($gbkstr);
        $word_arr=str_split($hex,2);
        return $word_arr;
    }
    //语音金额
    public static function moneyData($money){
        $money_arr=explode('.', $money);
        $money_1=$money_arr[0];//小数点前
        $money_2=$money_arr[1];//小数点后
        $wan=intval($money_1/10000);//万位
        $qian=intval($money_1%10000/1000);//千位
        $bai=intval($money_1%10000%1000/100);//百位
        $shi=intval($money_1%10000%1000%100/10);//十位
        $ge=intval($money_1%10000%1000%100%10);//个位
        if ($money_1==0) {
            $str='0';
        }else{
            $str='';
        }
        if (!empty($wan)) {
            $str.=$wan.'万';
        }
        if (!empty($qian)) {
            $str.=$qian.'千';
        }
        if (!empty($bai)) {
            $str.=$bai.'百';
        }
        if (!empty($shi)) {
            $str.=$shi.'十';
        }
        if (!empty($ge)) {
            $str.=$ge;
        }

        if (!empty($money_2)) {
            $str.='点'.$money_2;
        }
        $str.='元';

        return self::gbk2byte($str);
    }

    //语音时间
    public static function timeData($hour,$minute){        
		$hour_str='';		
        $hour_wan=intval($hour/10000);//万位
        $hour_qian=intval($hour%10000/1000);//千位
        $hour_bai=intval($hour%10000%1000/100);//百位
        $hour_shi=intval($hour%10000%1000%100/10);//十位
        $hour_ge=intval($hour%10000%1000%100%10);//个位
        if ($hour==0) {
            $hour_str='0';
        }else{
            $hour_str='';
        }
        if (!empty($hour_wan)) {
            $hour_str.=$hour_wan.'万';
        }
        if (!empty($hour_qian)) {
            $hour_str.=$hour_qian.'千';
        }
        if (!empty($hour_bai)) {
            $hour_str.=$hour_bai.'百';
        }
        if (!empty($hour_shi)) {
            $hour_str.=$hour_shi.'十';
        }
        if (!empty($hour_ge)) {
            $hour_str.=$hour_ge;
        }
		
        return $hour_str.'小时'.$minute.'分钟';
    }
    //剩余时间
    public static function timeData2($hour){
        $hour_wan=intval($hour/10000);//万位
        $hour_qian=intval($hour%10000/1000);//千位
        $hour_bai=intval($hour%10000%1000/100);//百位
        $hour_shi=intval($hour%10000%1000%100/10);//十位
        $hour_ge=intval($hour%10000%1000%100%10);//个位
        if ($hour==0) {
            $hour_str='0';
        }else{
            $hour_str='';
        }
        if (!empty($hour_wan)) {
            $hour_str.=$hour_wan.'万';
        }
        if (!empty($hour_qian)) {
            $hour_str.=$hour_qian.'千';
        }
        if (!empty($hour_bai)) {
            $hour_str.=$hour_bai.'百';
        }
        if (!empty($hour_shi)) {
            $hour_str.=$hour_shi.'十';
        }
        if (!empty($hour_ge)) {
            $hour_str.=$hour_ge;
        }
        $hour_str.='天';
        $hour_array=self::gbk2byte($hour_str);

        return $hour_array;
    }
}





