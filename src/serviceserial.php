<?php
/**
 * 串口服务
 */

namespace serialdata;
use \serialdata\devicefirst;
use \serialdata\deviceyellow;
use \serialdata\deviceblue;
use \serialdata\devicehang;
use \serialdata\tft;

class serviceserial
{

    public $type = 3;//1灰板 2黄板 3蓝板 4杭州新爱控制板
    public $msgtype = 1;//1 文字  2语音 3 TFT
    public $cmd = '62';//功能码  默认 3 蓝板
    public $subcmd= '';//子命令
    public $content= '';//内容

    private $serialobj;//串口对象


    /**
     * 魔术方法 constructor初始化  设置板子类型、消息类型
     * SerialBase constructor.
     * @param $type
     * @param $msgtype
     */
    public function __construct($type)
    {
        $type?$type:'3';//默认篮板
        $this->settype($type);

        switch ($type){
            case 1:
                $this->cmd='10';
                $this->subcmd='1';
                $this->serialobj = new devicefirst();
                break;
            case 2:
                $this->cmd='26';
                $this->subcmd='1';
                $this->serialobj = new deviceyellow();
                break;
            case 3:
                $this->cmd='62';
                $this->subcmd='00';
                $this->serialobj = new deviceblue();
                break;
            case 4:
                $this->cmd='01';
                $this->subcmd='05';
                $this->serialobj = new devicehang();
                break;
        }
    }
    /**
     * 设置板子类型
     * @param int $type
     * @return int
     */
    public function settype(int $type)
    {
        $this->type = $type;
    }

    /**
     * 设置消息类型
     * @param int $msgtype
     */
    public function setmsgtype(int $msgtype)
    {
        $this->msgtype=$msgtype;
    }

    /**
     * 设置 功能码 cmd
     *
     * @param string $cmd
     */
    public function setcmd(string $cmd){

        $this->cmd = $cmd;
    }

    /**
     * 根据板子类型设置命令码
     *
     * @param int $type
     */
    public function setmsgcmdbytype(int $type)
    {

        switch ($type){
            case 1:
                $this->cmd='10';
                break;
            case 2:
                $this->cmd='26';
                break;
            case 3:
                $this->cmd='62';
                break;
            case 4:
                $this->cmd='01';
                break;
        }
    }

    /**
     * 设置显示屏单行记录
     *
     * @param $msg
     * @return array
     */
    public function setlinemsg(array $data)
    {
        return array('serialChannel'=>0,
            'data'=>$data['data'],
            'dataLen'=>intval($data['dataLen']));
    }

    /**
     * 获取所有line显示数据
     *
     * @param array $arr line文字数组
     * @return array
     */
    public function getalllinemsg(array $arr)
    {

        $data=[];
        foreach ($arr as $k=>$v){
            $serialdata = $this->serialobj->getbytearrbycmd($this->cmd,$this->subcmd,$v);
            $data[]=[
                'serialChannel'=>0,
                'data'=>$serialdata['data'],
                'dataLen'=>intval($serialdata['dataLen'])
            ];
        }

        return array('Response_AlarmInfoPlate'=>[
            'serialData'=>$data
        ]);

    }

    /**
     * 获取语音消息
     *
     * @param array $arr  soundnumber 声音数值
     * @return array
     */
    public function getvoice(array $arr)
    {

        $soundnumber = $arr['soundnumber'];

        switch ($this->type){
            case 2 or 4:
                $cmd='f0';
                $subcmd=strval($soundnumber);
                break;
            case 3:
                $cmd='0D';
                $subcmd=strval($soundnumber*10);
                break;
            default:
                break;
        }
        $data = $this->serialobj->getbytearrbycmd($cmd,$subcmd);
        $serialData[] = array
        (
            'serialChannel'=>0,
            'data'=>$data['data'],
            'dataLen'=>intval($data['dataLen'])
        );

        return  array('Response_AlarmInfoPlate'=>[
            'serialData'=>$serialData
        ]);

    }

    /**
     * 时间校准 篮板
     *
     * @return array
     */
    public function timecalibration()
    {
        $cmd='0D';
        $data = $this->serialobj->getbytearrbycmd($cmd);
        $serialData[] = array
        (
            'serialChannel'=>0,
            'data'=>$data['data'],
            'dataLen'=>intval($data['dataLen'])
        );

        return  array('Response_AlarmInfoPlate'=>[
            'serialData'=>$serialData
        ]);

    }


    /**
     * 获取TFT
     */
    public function getTFT($arr)
    {
        $cmd=$arr['cmd']?$arr['cmd']:'82';//cmd

        $addr=$arr['addr']?$arr['addr']:array('52','41');//参数数组

        $content = $arr['url']?$arr['url']:'';//发送地址

//        $tftobj = new \serialdata\tft();
        $data=TFT::packetDataHex('82',array('52','41'),$content);
        return $data;
        
    }

    /**
     *获取TFT::changeHex返回值
     *
     * @param $str
     */
    public function getTFThex($str)
    {
        $str = $str?$str:'0002';
        $tftobj = new \serialdata\tft();
        $data = $tftobj::changeHex($str);
        return $data;
    }

}