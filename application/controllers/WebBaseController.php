<?php
require_once 'lib/Smarty.php';
require_once MODEL_DIR . 'SystemAccount.php';
require_once MODEL_DIR . 'SystemRole.php';
require_once MODEL_DIR . 'SystemPower.php';
require_once MODEL_DIR . 'SystemRolePower.php';
require_once MODEL_DIR . 'SystemRoleUser.php';
/**
 * WebBaseController
 *
 * @author mxj
 */
class WebBaseController {
    protected $success = array (
        'success' => true,
        'msg' => '成功'
    );
    protected $fail = array (
        'success' => false,
        'msg' => '失败'
    );

    private $timestamp = 0;
    private $access_token_file = '';
    private $jsapi_ticket_file = '';
	/**
	 * log file
	 *
	 * @var log_file
	 */
	protected $log_file;

	/**
	 * current user info
	 *
	 * @var SystemAccount
	 */
	protected $curUser;

	/**
	 * system account
	 *
	 * @var SystemAccount
	 */
	protected $systemAccount;

	/**
	 * system power
	 *
	 * @var SystemPower
	 */
	protected $systemPower;

	/**
	 * system role
	 *
	 * @var SystemRole
	 */
	protected $systemRole;

	/**
	 * system role user
	 *
	 * @var SystemRoleUser
	 */
	protected $systemRoleUser;

	/**
	 * system role power
	 *
	 * @var SystemRolePower
	 */
	protected $systemRolePower;



	protected $power_list;

	/**
	 * smarty object
	 *
	 * @var Smarty
	 */
	protected $smarty;

	/**
	 * channel
	 *
	 * @var Channel
	 */
	protected $channel;
	/**
	 * topic
	 *
	 * @var Topic
	 */
	protected $topic;


	public $params;

	/**
	 * Construct
	 */
	public function __construct($params = array()) {
	    $this->__loadModels();
		$this->log_file = DATA_DIR . 'adminlog.' . date ( "Y-m-d" ) . '.log';
		$this->timestamp = time();
		$this->smarty = LibSmarty::getInstance();
		$this->smarty->assign('WEB_BASE_URL', WEB_BASE_URL);
        $this->smarty->assign('ip', $this->getIp());
		$this->params = $params;
	}

	protected function getIp() {
		$ip1 = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : '';
		$ip2 = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
		$ip3 = isset($_SERVER['HTTP_X_REAL_IP']) ? $_SERVER['HTTP_X_REAL_IP'] : '';
		if($ip3) {
			return $ip3;
		} else if($ip1) {
			return $ip1;
		} else {
			return $ip2;
		}
	}

	/**
	 * init user information
	 *
	 * @param array $user
	 */
	protected function __initSystemAccountInfo() {
		if (isset ( $_SESSION ['system_account'] ) && $_SESSION ['system_account']) {
			$this->curUser = $_SESSION ['system_account'];
		} else {
			$this->curUser = null;
		}
	}


	protected function __log($title, $log_data = '') {
		$f = fopen ( $this->log_file, 'a+' );
		fwrite ( $f, date('Y-m-d H:i:s', time()) . '_' . microtime() . ' ' . $title . ':' . $log_data . "\r\n\r\n" );
		fclose ( $f );
	}

	protected function __errorShow($msg,$url,$second=3) {
		$this->smarty->assign('msg', $msg);
		$this->smarty->assign('url', $url);
		$this->smarty->assign('second', $second);
		$this->smarty->display(WEIXIN_VIEW_DIR . 'error.html');
	}

	protected function __redirect($redirect_info, $redirect_url = '', $second=3) {
		$this->smarty->assign('redirect_info', $redirect_info);
		$this->smarty->assign('second', $second);
		$this->smarty->assign('redirect_url', $redirect_url);
		$this->smarty->display(VIEW_DIR . 'redirect.html');
	}

	protected function __getParam($param) {
		foreach($_REQUEST as $k => $v) {
			$this->params[$k] = $this->dowith_sql($v);
		}
		return isset($this->params[$param]) ? urldecode($this->params[$param]) : null;
	}

	protected function dowith_sql($str) {
		$str = str_replace("execute","",$str);
		$str = str_replace("update","",$str);
		$str = str_replace("count","",$str);
		$str = str_replace("chr","",$str);
		$str = str_replace("mid","",$str);
		$str = str_replace("master","",$str);
		$str = str_replace("truncate","",$str);
		$str = str_replace("char","",$str);
		$str = str_replace("declare","",$str);
		$str = str_replace("select","",$str);
		$str = str_replace("create","",$str);
		$str = str_replace("delete","",$str);
		$str = str_replace("insert","",$str);
// 		$str = str_replace("=","",$str);
		$str = str_replace("%20"," ",$str);
		return $str;
	}
	protected function __checkAdminUserLogin() {
	    // 判断是否登录
	    $user_id = isset($_SESSION['system_account']['id'])?intval($_SESSION['system_account']['id']):0;
	    if(empty($user_id)) {
	        $this->smarty->display( VIEW_DIR . 'login.html' );
	        exit();
	    }
	    $this->smarty->assign('cUser',$_SESSION['system_account']);
	    // 判断是否有权限访问
	    if($this->curUser['is_admin'] == 0) { // 超级管理员，不受限制

	        $role_user_list = $this->systemRoleUser->getByAccountId( $user_id );
	        $power_ids = array();
	        $account_power_list = array();
	        if($role_user_list) {
	            foreach( $role_user_list as $role_user ) {
	                $role_power_list = $this->systemRolePower->getByRoleId( $role_user['role_id'] );
	                if($role_power_list) {
	                    foreach( $role_power_list as $role_power ) {
	                        if($role_power && ! in_array( $role_power['power_id'], $power_ids )) {
	                            $power_ids[] = $role_power['power_id'];
	                            $res  = $this->systemPower->getById( $role_power['power_id'] );
	                            $account_power_list[] = $res['uri'];
	                        }
	                    }
	                }
	            }
	        }
//	        $uri = strtolower($_SERVER['REQUEST_URI']);
            $uri = $_SERVER['REQUEST_URI'];
	        $uriArr = explode('/', trim($uri,'\/'));
	        $uri = '/'.lcfirst($uriArr[0]).'/';
	        $this->__log('request_uri', $uri);
	        $this->__log('list', json_encode($account_power_list));
	        //                echo $uri;
	        //                var_dump($account_power_list);exit();
	        if( !in_array($uri,$account_power_list) ) {
	            $_SESSION['system_account'] = array();
	            header("Content-type:text/html;charset=utf-8");
	            echo '<script>alert("没有权限！");window.location.href="/";</script>';
	            exit();
	        } else {
	            $this->smarty->assign('power',$account_power_list);
	        }
	    } else {
	        $this->smarty->assign('power',array());
	    }
	}

	public function adminLogAction() {
		function FileLastLines($filename,$n){
			if(!$fp=fopen($filename,'r')){
				echo "打开文件失败，请检查文件路径是否正确，路径和文件名不要包含中文";
				return false;
			}
			$pos=-2;
			$eof="";
			$str="";
			while($n>0){
				while($eof!="\n"){
					if(!fseek($fp,$pos,SEEK_END)){
						$eof=fgetc($fp);
						$pos--;
					}else{
						break;
					}
				}
				$str.=fgets($fp);
				$eof="";
				$n--;
			}
			return $str;
		}

		$filename = DATA_DIR . 'adminlog.' . date("Y-m-d", time()) . '.log';
		// header ( 'Content-type: txt;charset=utf-8' );
		// echo file_get_contents(DATA_DIR . 'app.' . date("Y-m-d", time()) . '.log');
		header ( 'Content-type: txt;charset=utf-8' );
		echo '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></head><body>';
		echo str_replace("\r\n", '<br/>', FileLastLines($filename, 1500));
		echo '</body></html>';

	}


	protected function MkFolder($path) {
		if (! is_readable ( $path )) {
			$this->MkFolder ( dirname ( $path ) );
			if (! is_file ( $path ))
				mkdir ( $path, 0777 );
		}
	}
	protected function __displayOutput($result) {
		if ($result) {
		} else {
			$result = array ();
		}
		header ( 'Content-type: application/json;charset=utf-8' );
		echo json_encode ( $result );
		exit;
	}
	/**
	 *
	 * @param bool     $success
	 * @param string   $msg
	 * @param array    $data
	 */
    protected function __ajaxReturn($success,$msg,$data=0){
        if(empty($data))
            $this->__displayOutput(array('success'=>$success,'msg'=>$msg));
        else
            $this->__displayOutput(array('success'=>$success,'msg'=>$msg,'data'=>$data));
        exit();
    }
	protected function __weError($msg,$url="JavaScript:history.back(-1)",$second=10){
	    $this->smarty->assign('msg',$msg);
	    $this->smarty->assign('url',$url);
	    $this->smarty->assign('second',$second);
	    $this->smarty->display ( WEIXIN_VIEW_DIR . 'error.html' );
	    exit;
	}
	protected function __filterData($result) {
		foreach ( $result as $key => $value ) {
			if (ereg ( "^[0-9]+$", $key ))
				unset ( $result [$key] );
		}

		return $result;
	}

	public function showPage($view_file) {
		$this->__checkAdminUserLogin();
		$this->smarty->display($view_file);
	}

	public function setParams($params) {
		$this->params = $params;
	}

	protected function __opHanzi($json) {
		if(isset($json->title))
			$json->title = $this->unicode2utf8(str_replace('u', '\u', $json->title));
		if(isset($json->title1))
			$json->title1 = $this->unicode2utf8(str_replace('u', '\u', $json->title1));
		if(isset($json->title2))
			$json->title2 = $this->unicode2utf8(str_replace('u', '\u', $json->title2));
		if(isset($json->title3))
			$json->title3 = $this->unicode2utf8(str_replace('u', '\u', $json->title3));
		if(isset($json->summary))
			$json->summary = $this->unicode2utf8(str_replace('u', '\u', $json->summary));
		if(isset($json->from))
			$json->from = $this->unicode2utf8(str_replace('u', '\u', $json->from));

		return $json;
	}

	protected function unicode2utf8($str){
		if(!$str) return $str;
		$decode = json_decode($str);
		if($decode) return $decode;
		$str = '["' . $str . '"]';
		$decode = json_decode($str);
		if(count($decode) == 1){
			return $decode[0];
		}
		return $str;
	}

	/***********************************
	 * 文件上传
	 ***********************************/
	public function uploadifyAction() {

		if (!empty($_FILES)) {
			$tempFile = $_FILES['Filedata']['tmp_name'];
			$targetPath = UPLOAD_DIR . date('Y-m-d') . '/';
			$this->MkFolder($targetPath);

			$fileParts = pathinfo($_FILES['Filedata']['name']);
			$targetFile = rtrim($targetPath,'/') . '/' . CommonFuncs::getRandom(15) . '.' . $fileParts['extension'];

			$data = array();
			$data['file_name']  = $_FILES['Filedata']['name']; //客户端文件的原名称
			$data['mime_type']  = $_FILES['Filedata']['type']; //文件的 MIME类型，需要浏览器提供该信息的支持，例如"image/gif"
			$data['file_size'] = $_FILES['Filedata']['size']; //已上传文件的大小，单位为字节
			// Validate the file type
			// 	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions

			$data['file_ext'] = $fileParts['extension'];

			// 	if (in_array($fileParts['extension'],$fileTypes)) {
			move_uploaded_file($tempFile,$targetFile);
			echo '/uploads' . str_replace(rtrim(UPLOAD_DIR, '/'), '', $targetFile);
		} else {
			echo 'no file';
		}
	}
	/**
	 * 获取签名 Signature
	 * @return string
	 */
	protected function getSignPackage() {
	    $jsapiTicket = $this->getJsApiTicket();
	    // 注意 URL 一定要动态获取，不能 hardcode.
	    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	    $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	    $timestamp = time();
	    $nonceStr = $this->createNonceStr();

	    // 这里参数的顺序要按照 key 值 ASCII 码升序排序
	    $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

	    $signature = sha1($string);

	    $signPackage = array(
	        "appId"     => $this->app_id,
	        "nonceStr"  => $nonceStr,
	        "timestamp" => $timestamp,
	        "url"       => $url,
	        "signature" => $signature,
	        "rawString" => $string
	    );
	    return $signPackage;
	}
	/**
	 * 获取 AccessToken
	 * @return unknown
	 */
	public function getAccessToken() {
        // access_token 应该全局存储与更新，以下代码以写入到文件中做示例
        $data = json_decode($this->get_php_file($this->access_token_file));
        if ($data->expire_time < time()) {
            // 如果是企业号用以下URL获取access_token
            // $url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=$this->appId&corpsecret=$this->appSecret";
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->app_id."&secret=".$this->secret;
            $res = json_decode($this->httpGet($url));
            $access_token = $res->access_token;
            if ($access_token) {
                $data->expire_time = time() + 7200;
                $data->access_token = $access_token;
                $this->set_php_file($this->access_token_file, json_encode($data));
            }
        } else {
            $access_token = $data->access_token;
        }
        return $access_token;
    }
	/**
	 * 获取 Ticket
	 * @return unknown
	 */
	private function getJsApiTicket() {
	    // jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
	    $data = json_decode($this->get_php_file($this->jsapi_ticket_file));
	    if ($data->expire_time < time()) {
	        $accessToken = $this->getAccessToken();
	        // 如果是企业号用以下 URL 获取 ticket
	        // $url = "https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=$accessToken";
	        $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
	        $res = json_decode($this->httpGet($url));
	        $ticket = $res->ticket;
	        if ($ticket) {
    	        $data->expire_time = time() + 7200;
    	        $data->jsapi_ticket = $ticket;
    	        $this->set_php_file($this->jsapi_ticket_file, json_encode($data));
	        }
        } else {
            $ticket = $data->jsapi_ticket;
        }
        return $ticket;
    }
	/**
    * curl get
    * @param unknown $url
    * @return mixed
    */
    private function httpGet($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        // 为保证第三方服务器与微信服务器之间数据传输的安全性，所有微信接口采用https方式调用，必须使用下面2行代码打开ssl安全校验。
        // 如果在部署过程中代码在此处验证失败，请到 http://curl.haxx.se/ca/cacert.pem 下载新的证书判别文件。
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, true);
        curl_setopt($curl, CURLOPT_URL, $url);
        $res = curl_exec($curl);
        curl_close($curl);
        return $res;
    }
    /**
     * 创建 Nonce
     * @param number $length
     * @return Ambigous <string, string>
     */
    private function createNonceStr($length = 16) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }
    /**
    * 读取文件
    * @param unknown $filename
    * @return string
     */
    private function get_php_file($filename) {
        return trim(substr(file_get_contents($filename), 15));
    }
    /**
     * 写文件
     * @param unknown $filename
     * @param unknown $content
     */
    private function set_php_file($filename, $content) {
        $fp = fopen($filename, "w");
        fwrite($fp, "<?php exit();?>" . $content);
        fclose($fp);
    }
    /**
     * 发送验证码到手机
     * @param unknown $mobile
     * @param unknown $msg
     * @param unknown $sms_code
     * @return multitype:boolean string
     */
    protected function sendSmsCode($mobile, $msg, $sms_code) {
        $ip = $_SERVER['REMOTE_ADDR'];
        //1个ip一天发送50条
        $ip_data_count = $this->smsCode->getTodayCountByIP($ip);
        if($ip_data_count && $ip_data_count > 50) {
            $result = array('success' => false, 'msg' => 'ip被限制');
        } else {
            //1个手机号一天收到5条
            $mobile_data_count = $this->smsCode->getTodayCountByMobile($mobile);
            if($mobile_data_count && count($mobile_data_count) > 10) {
                $result = array('success' => false, 'msg' => '手机号被限制');
            } else {
                //1个手机号3分钟收到1条
                $num_data = $this->smsCode->getLatestOneByMobile($mobile);
                if($num_data && (time()-strtotime($num_data['cdate'])) < 30) {
                    $result = array('success' => false, 'msg' => '手机号被限制');
                } else {
                    //发送验证码
                    $url = 'http://yl.mobsms.net/send/gsend.aspx?name=yangmeng&pwd=a123456&dst=' . $mobile . '&msg=' . iconv('utf-8', 'gbk', $msg);
                    $sms_resp =  file_get_contents($url);

                    if(strstr($sms_resp, 'errid=0')) {
                        $result = $this->success;
                        $result['info'] = '验证码发送成功';

                        //写数据库
                        $data = array();
                        $data['ip'] = $ip;
                        $data['mobile'] = $mobile;
                        $data['cdate'] = date('Y-m-d H:i:s');
                        $data['verify_code'] = $sms_code;
                        //     					$data['user_id'] = $user_id;
                        $this->smsCode->addOne($data);

                    } else {
                        $result = $this->fail;
                        $result['info'] = '验证码发送失败';
                    }
                }
            }
        }
        return $result;
    }
	protected function __loadModels(){
	    $list = get_class_vars(get_class($this));
	    if ($list) {
	        foreach ($list as $k => $v) {
	            if ($v == NULL) {
	                $models_class_name = ucwords($k);
	                $models_file = MODEL_DIR . $models_class_name . '.php';
	                if (file_exists($models_file)) {
	                    require_once $models_file;
	                    $this->$k = $models_class_name::getInstance();
	                }
	            }
	        }
	    }
	}
}