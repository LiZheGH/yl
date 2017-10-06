<?php
ini_set('date.timezone','Asia/Shanghai');
require_once "../lib/WxPay.Api.php";
require_once "WxPay.NativePay.php";
require_once 'log.php';


$input = new WxPayUnifiedOrder();
$input->SetBody("YMG360 Partners Fee");
$input->SetAttach("YMG360 Partners Fee");
$input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
$input->SetTotal_fee("36000");
$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis", time() + 600));
$input->SetGoods_tag("YMG360 Partners Fee");
$input->SetNotify_url("https://fenxiao.ymg360.com/DataReceiverEnhanced/wxsmCallBack");
$input->SetTrade_type("NATIVE");
$input->SetProduct_id("123456789");
$result = $notify->GetPayUrl($input);
$url2 = $result["code_url"];

?>

http://paysdk.weixin.qq.com/example/qrcode.php?data=<?php echo urlencode($url2);?>