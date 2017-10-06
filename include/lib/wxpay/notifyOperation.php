<?php
ini_set('date.timezone','Asia/Shanghai');
error_reporting(E_ERROR);

require_once "lib/wxpay/WxPay.Api.php";
require_once 'lib/wxpay/WxPay.Notify.php';
require_once 'lib/wxpay/log.php';

//初始化日志
$logHandler= new CLogFileHandler("../logs/".date('Y-m-d').'.log');
$log = Log::Init($logHandler, 15);

class PayNotifyCallBack extends WxPayNotify
{
    protected $para = array('code' => 0,'data' => '');
	//查询订单
	public function Queryorder($transaction_id)
	{
		$input = new WxPayOrderQuery();
		$input->SetTransaction_id($transaction_id);
		$result = WxPayApi::orderQuery($input);
		Log::DEBUG("query:" . json_encode($result));
		if(array_key_exists("return_code", $result)
			&& array_key_exists("result_code", $result)
			&& $result["return_code"] == "SUCCESS"
			&& $result["result_code"] == "SUCCESS")
		{
			return true;
		}
		$this->para['code'] = 0;
		$this->para['data'] = '';
		return false;
	}
	
	//重写回调处理函数
	public function NotifyProcess($data, &$msg)
	{
		Log::DEBUG("call back:" . json_encode($data));
		$notfiyOutput = array();
		
		if(!array_key_exists("transaction_id", $data)){
			$msg = "输入参数不正确";
			$this->para['code'] = 0;
			$this->para['data'] = '';
			return false;
		}
		//查询订单，判断订单真实性
		if(!$this->Queryorder($data["transaction_id"])){
			$msg = "订单查询失败";
			$this->para['code'] = 0;
			$this->para['data'] = '';
			return false;
		}
		$this->para['code'] = 1;
		$this->para['data'] = $data;
		return true;
	}
	
	/**
	 * 自定义方法 检测微信端是否回调成功方法
	 * @return multitype:number string
	 */
	public function IsSuccess(){
	    return $this->para;
	}
}



