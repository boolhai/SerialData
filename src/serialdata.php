<?php

namespace serialdata;
//默认串口链接
//use Serialdata\Serialdata;//
//use Serialdata\Serialdata2;//黄板
//use Serialdata\Serialdata3;//篮板
//use Serialdata\Serialdata4;//杭州新爱控制板
class serialdata
{

    /**
     * serialdata 统一数据获取入口
     *
     * @param string $seriaitype 接口类型
     * @param string $message 消息
     * @return array
     */
    public function getmsgdata(int $seriaitype,string $message)
    {
//        串口数据类型不同，调用不同接口
        switch ($seriaitype){
            case 1:
                $data=Serialdata::packetData('40', '', '');
                break;
            case 2:
                $data=Serialdata2::packetData('22', '', '',array('28'));//请通行
                break;
            case 3:
                $data=Serialdata3::packetData('30', '', '请通行');//请通行
                break;
            case 4:
                $data=Serialdata4::packetData('02', '08', '1',true);
                break;
            default://默认
                $data = [];
                break;
        }

        return $data;
    }


    /**
     * 非营业时间显示屏播报数据
     *
     * @param int $seriaitype 1 default 2 黄板 3 篮板 4 杭州新爱控制板
     * @param string $message 消息
     * @return array
     */
    public function nonBusinessMsg(int $seriaitype,string $message)
    {
        $msg = $message?$message:'非营业时间';//默认msg消息

        switch ($seriaitype){
            case 1:
                $data=Serialdata::packetData('10', '1', $msg);
                $data=Serialdata::packetData('10', '2', $msg);
                $data=Serialdata::packetData('10', '3', $msg);
                $data=Serialdata::packetData('10', '4', $msg);
                break;
            case 2:
                $data=Serialdata2::packetData('26', '1', $msg);
                break;
            case 3:
                $data=Serialdata3::packetData('62', '00', $msg);
                break;
            case 4:
                $data=Serialdata4::packetData('01', '05', $msg);
                break;
            default://默认
                $data = [];
                break;
        }

        return array();
        
    }

//语音
    public function getvoicemsg()
    {
        
    }

}