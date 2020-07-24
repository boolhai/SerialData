<?php
class Serialdata { 
	private static $symbol='';//byte数据是否带0x
	private static $s1='AA';
	private static $s1_1='55';
	private static $s2='FF';//起始码
	private static $add='3';//地址码
	private static $CRC16_Table = array (
	    0x0000, 0x8005, 0x800f, 0x000a, 0x801b,
	    0x001e, 0x0014, 0x8011, 0x8033, 0x0036, 0x003c, 0x8039, 0x0028,
	    0x802d, 0x8027, 0x0022, 0x8063, 0x0066, 0x006c, 0x8069, 0x0078,
	    0x807d, 0x8077, 0x0072, 0x0050, 0x8055, 0x805f, 0x005a, 0x804b,
	    0x004e, 0x0044, 0x8041, 0x80c3, 0x00c6, 0x00cc, 0x80c9, 0x00d8,
	    0x80dd, 0x80d7, 0x00d2, 0x00f0, 0x80f5, 0x80ff, 0x00fa, 0x80eb,
	    0x00ee, 0x00e4, 0x80e1, 0x00a0, 0x80a5, 0x80af, 0x00aa, 0x80bb,
	    0x00be, 0x00b4, 0x80b1, 0x8093, 0x0096, 0x009c, 0x8099, 0x0088,
	    0x808d, 0x8087, 0x0082, 0x8183, 0x0186, 0x018c, 0x8189, 0x0198,
	    0x819d, 0x8197, 0x0192, 0x01b0, 0x81b5, 0x81bf, 0x01ba, 0x81ab,
	    0x01ae, 0x01a4, 0x81a1, 0x01e0, 0x81e5, 0x81ef, 0x01ea, 0x81fb,
	    0x01fe, 0x01f4, 0x81f1, 0x81d3, 0x01d6, 0x01dc, 0x81d9, 0x01c8,
	    0x81cd, 0x81c7, 0x01c2, 0x0140, 0x8145, 0x814f, 0x014a, 0x815b,
	    0x015e, 0x0154, 0x8151, 0x8173, 0x0176, 0x017c, 0x8179, 0x0168,
	    0x816d, 0x8167, 0x0162, 0x8123, 0x0126, 0x012c, 0x8129, 0x0138,
	    0x813d, 0x8137, 0x0132, 0x0110, 0x8115, 0x811f, 0x011a, 0x810b,
	    0x010e, 0x0104, 0x8101, 0x8303, 0x0306, 0x030c, 0x8309, 0x0318,
	    0x831d, 0x8317, 0x0312, 0x0330, 0x8335, 0x833f, 0x033a, 0x832b,
	    0x032e, 0x0324, 0x8321, 0x0360, 0x8365, 0x836f, 0x036a, 0x837b,
	    0x037e, 0x0374, 0x8371, 0x8353, 0x0356, 0x035c, 0x8359, 0x0348,
	    0x834d, 0x8347, 0x0342, 0x03c0, 0x83c5, 0x83cf, 0x03ca, 0x83db,
	    0x03de, 0x03d4, 0x83d1, 0x83f3, 0x03f6, 0x03fc, 0x83f9, 0x03e8,
	    0x83ed, 0x83e7, 0x03e2, 0x83a3, 0x03a6, 0x03ac, 0x83a9, 0x03b8,
	    0x83bd, 0x83b7, 0x03b2, 0x0390, 0x8395, 0x839f, 0x039a, 0x838b,
	    0x038e, 0x0384, 0x8381, 0x0280, 0x8285, 0x828f, 0x028a, 0x829b,
	    0x029e, 0x0294, 0x8291, 0x82b3, 0x02b6, 0x02bc, 0x82b9, 0x02a8,
	    0x82ad, 0x82a7, 0x02a2, 0x82e3, 0x02e6, 0x02ec, 0x82e9, 0x02f8,
	    0x82fd, 0x82f7, 0x02f2, 0x02d0, 0x82d5, 0x82df, 0x02da, 0x82cb,
	    0x02ce, 0x02c4, 0x82c1, 0x8243, 0x0246, 0x024c, 0x8249, 0x0258,
	    0x825d, 0x8257, 0x0252, 0x0270, 0x8275, 0x827f, 0x027a, 0x826b,
	    0x026e, 0x0264, 0x8261, 0x0220, 0x8225, 0x822f, 0x022a, 0x823b,
	    0x023e, 0x0234, 0x8231, 0x8213, 0x0216, 0x021c, 0x8219, 0x0208,
	    0x820d, 0x8207, 0x0202
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
		
		$crc = 0x0000;
		for ($i = 0; $i < strlen($ptr); $i++){
			$temp_2=decbin(ord($ptr[$i]));
			if (strlen($temp_2)==8&&substr($temp_2,0,1)==1) {
				$temp_10=ord($ptr[$i])-256;
			}else{
				$temp_10=ord($ptr[$i]);
			}
			$crc=(self::uright($crc<<24,16))^self::$CRC16_Table[((self::uright($crc, 8)) ^ self::uright($temp_10<<24,24))];
			//var_dump($crc);	
		}
		//$crc =  self::$CRC16_Table[(($crc>>8) ^ ord($ptr[$i]))] ^ (($crc<<8) & 0x00FFFF);
		//$crc =   (self::uright($crc<<24,16))^ self::$CRC16_Table[((self::uright($crc, 8)) ^ self::uright($ptr[$i]<<24,24))];
		//$crc =   self::$CRC16_Table[((self::uright($crc, 8)) ^ self::uright(ord($ptr[$i])<<24,24))];
		//$crc =self::uright(ord($ptr[$i])<<24,24);
		//$crc =self::asc2hex($ptr[$i])<<24;
		
		//var_dump(dechex(ord($ptr[$i])));
		//return $crc;//十进制
			
		//$crc=dechex(($crc&0xff00)>>8).dechex($crc&0x00ff);//16进制字符串
		//return $crc;//如33.e拼接后三位无法正常区分
		
		$res=array(
				'lo'=>dechex(($crc&0xff00)>>8),
				'hi'=>dechex($crc&0x00ff)
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
 * @param 子命令 $subcmd
 * @param 内容 $content
 * @return byte数组 $byte
 */
	public static function packetData($cmd='',$subcmd='',$content=''){
		$byte=array();
		$byte[]=self::$symbol.self::$s1;
		$byte[]=self::$symbol.self::$s1_1;
		$byte[]=self::$symbol.self::$s2;
		$byte[]=self::$symbol.self::$add;
		$byte[]=self::$symbol.$cmd;
		$test=chr(hexdec(self::$s2)).chr(hexdec(self::$add)).chr(hexdec($cmd));
		//长度
		$len=2;
		if ($subcmd!=='') {
			$len++;
			if ($cmd==10) {
					$len++;
			}
				
		}
		if ($content!=='') {
			$gbkstr = mb_convert_encoding($content,'GBK','UTF-8');//中文编码GBK
			$len+=mb_strlen($gbkstr);
		}

		$byte[]=self::$symbol.dechex($len);
		$test.=chr($len);

		//
		if ($subcmd!=='') {

			$byte[]=self::$symbol.$subcmd;
			$test.=chr(hexdec($subcmd));

			if ($cmd==10) {
					$byte[]=self::$symbol.'FF';//默认屏显FF遍永久
					$test.=chr(hexdec('FF'));
			}	
		}
		if ($content!=='') {
			$hex = self::str2hex($gbkstr);
			$content_arr=str_split($hex,2);
			
			foreach ($content_arr as $k=>$v){
				$byte[]=self::$symbol.$v;
				$test.=chr(hexdec($v));
			}
		}
		$res= self::genCRC( $test );
		
		//var_dump($res);
		/*
		if (strlen($res)==3) {
			$byte[]=self::$symbol.substr($res, 0,1);
		}else{
			$byte[]=self::$symbol.substr($res, 0,2);
		}
		$byte[]=self::$symbol.substr($res, -2);
		*/
		$byte[]=self::$symbol.$res['lo'];
		$byte[]=self::$symbol.$res['hi'];
		//return $byte;
		//base64
		$result=array();
		//$result['test']=$test;
		$result['byte']=$byte;
		$result['dataLen']=count($byte);
		$str='';
		for ($i = 0; $i < count($byte); $i++){
			//方法1
			$str.=chr(hexdec($byte[$i]));
			//方法2
			//$str.=chr(hexdec($byte[$i]));
			//方法3
			/*
			 if (strlen($byte[$i])==1) {
			$str.=pack('H*','0'.$byte[$i]);
			}else{
			$str.=pack('H*',$byte[$i]);
			}
			*/
			//方法4
			/*
			$temp_2=decbin(hexdec($byte[$i]));
			if (strlen($temp_2)==8&&substr($temp_2,0,1)==1) {
				$temp_10=hexdec($byte[$i])-256;
			}else{
				$temp_10=hexdec($byte[$i]);
			}
			$str.=chr($temp_10);
			*/			
		}
		$result['data']=base64_encode($str);
		return $result;	
	}

    public static function packetDataHex($cmd='',$subcmd='',$content=''){
        $byte=array();
        $byte[]=self::$symbol.self::$s1;
        $byte[]=self::$symbol.self::$s1_1;
        $byte[]=self::$symbol.self::$s2;
        $byte[]=self::$symbol.self::$add;
        $byte[]=self::$symbol.$cmd;
        $test=chr(hexdec(self::$s2)).chr(hexdec(self::$add)).chr(hexdec($cmd));
        //长度
        $len=2;
        if ($subcmd!=='') {
            $len++;
            if ($cmd==10) {
                $len++;
            }

        }
        if ($content!=='') {
            $gbkstr = mb_convert_encoding($content,'GBK','UTF-8');//中文编码GBK
            $len+=mb_strlen($gbkstr);
        }

        $byte[]=self::$symbol.dechex($len);
        $test.=chr($len);

        //
        if ($subcmd!=='') {

            $byte[]=self::$symbol.$subcmd;
            $test.=chr(hexdec($subcmd));

            if ($cmd==10) {
                $byte[]=self::$symbol.'FF';//默认屏显FF遍永久
                $test.=chr(hexdec('FF'));
            }
        }
        if ($content!=='') {
            $hex = self::str2hex($gbkstr);
            $content_arr=str_split($hex,2);

            foreach ($content_arr as $k=>$v){
                $byte[]=self::$symbol.$v;
                $test.=chr(hexdec($v));
            }
        }
        $res= self::genCRC( $test );

        //var_dump($res);
        /*
        if (strlen($res)==3) {
            $byte[]=self::$symbol.substr($res, 0,1);
        }else{
            $byte[]=self::$symbol.substr($res, 0,2);
        }
        $byte[]=self::$symbol.substr($res, -2);
        */
        $byte[]=self::$symbol.$res['lo'];
        $byte[]=self::$symbol.$res['hi'];
        //return $byte;
        //base64
        $result=array();
        //$result['test']=$test;
        $result['byte']=$byte;
        $result['dataLen']=count($byte);
        $str='';
        for ($i = 0; $i < count($byte); $i++){
            //方法1
            $str.=chr(hexdec($byte[$i]));
            //方法2
            //$str.=chr(hexdec($byte[$i]));
            //方法3
            /*
             if (strlen($byte[$i])==1) {
            $str.=pack('H*','0'.$byte[$i]);
            }else{
            $str.=pack('H*',$byte[$i]);
            }
            */
            //方法4
            /*
            $temp_2=decbin(hexdec($byte[$i]));
            if (strlen($temp_2)==8&&substr($temp_2,0,1)==1) {
                $temp_10=hexdec($byte[$i])-256;
            }else{
                $temp_10=hexdec($byte[$i]);
            }
            $str.=chr($temp_10);
            */
        }
        $result['data']=strtoupper(bin2hex($str));
        return $result;
    }
	/**
	 * @param unknown $url
	 * @param unknown $jsonStr
	 * @return multitype:mixed
	 * $url = "http://blog.snsgou.com";
	 * $jsonStr = json_encode(array('a' => 1, 'b' => 2));
	 * list($returnCode, $returnContent) = http_post_json($url, $jsonStr);
	 */
	public static function http_post_json($url, $jsonStr)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonStr);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		//'Content-Type: application/json; charset=utf-8',
		'Content-Type: application/x-www-form-urlencoded',
		'Content-Length: ' . strlen($jsonStr)
		)
		);
		$response = curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	
		return array($httpCode, $response);
	}
	public static function fetch($url, $data = [])
	{
		$opts['http']['timeout'] = 3;
		if ($data) {
			$opts['http']['method'] = 'POST';
			$opts['http']['content'] = http_build_query($data);
			$opts['http']['header'] = "Content-type: application/x-www-form-urlencoded\r\n";
			$opts['http']['header'] .= "Content-Length: " . strlen($opts['http']['content']) . "\r\n";
		} else {
			$opts['http']['method'] = 'GET';
		}
		$stream = stream_context_create($opts);
		return file_get_contents($url, false, $stream);
	}
	
	/**
	 *
	 * @param 命令符 $cmd
	 * @param 内容 $content
	 * @param 子命令符 $line
	 */
	public static function packetDataFromJava($cmd=16,$content='欢迎光临',$line=''){
		//java拼接接口
		$url = 'http://111.231.219.159:9099/sayhello';
		$data=array(
				'cmd'=>intval($cmd),
				'content'=>$content,
				'line'=>$line
		);
		$jsonStr=json_encode($data, JSON_UNESCAPED_UNICODE);
		list($returnCode, $returnContent)=self::http_post_json($url, $jsonStr);
		//return $returnCode.':'.$returnContent;
		$json_arr = json_decode($returnContent,true);
		//return $json_arr;
		/*
		$result=array();
		$result['content']=trim($json_arr['content']);
		$result['dataLen']=$json_arr['count'];
		$result['data']=$json_arr['base64'];
		return $result;
		*/
		//base64
		
		$result=array();
		$byte=explode(' ', trim($json_arr['content']));
		$result['content']=trim($json_arr['content']);
		$result['byte']=$byte;
		$result['dataLen']=count($byte);
		$str='';
		for ($i = 0; $i < count($byte); $i++){
			$str.=chr(hexdec($byte[$i]));	
		}
		$result['data']=base64_encode($str);
		return $result;
		
	}  
}

