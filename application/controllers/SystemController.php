<?php
require_once CTRL_DIR . 'WebBaseController.php';
require_once 'lib/CommonFuncs.php';

/**
 *
 * @author mxj
 */
class SystemController extends WebBaseController {

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

	/**
	 * Construct
	 */
	public function __construct($params) {
		session_start();
		parent::__construct ($params);
		$this->log ( '', $_SERVER ["REQUEST_URI"] );
		$this->smarty->assign ( 'WEB_IMG_BASE_URL', WEB_IMG_BASE_URL );
		$this->smarty->assign ( 'VIEW_DIR', VIEW_DIR );
		$this->__initSystemAccountInfo ();
		$this->smarty->assign ( 'curUser', $this->curUser );
	}

	public function listAction() {
	    $this->__checkAdminUserLogin();
	    $this->smarty->display(VIEW_DIR . 'system/account/list.html');
	}

	protected function log($title, $log_data = '') {
		$f = fopen ( $this->log_file, 'a+' );
		fwrite ( $f, date ( 'Y-m-d H:i:s', time () ) . '_' . microtime () . ' ' . $title . ':' . $log_data . "\r\n\r\n" );
		fclose ( $f );
	}


	protected function __direct($text, $url, $second = 2) {
		$this->smarty->assign ( 'text', $text );
		$this->smarty->assign ( 'second', $second );
		$this->smarty->assign ( 'url', $url );
		$this->smarty->display ( VIEW_DIR . 'web/direct.html' );
	}


	/**
	 * 首页
	 */
	public function indexAction() {
		$this->__checkAdminUserLogin ();
		$this->smarty->display ( VIEW_DIR . 'index.html' );
	}

	/**
	 * ajax 登录
	 */
	public function ajaxLoginAction() {
	    var_dump($_POST);
	    var_dump($_SESSION['captcha']);exit;
		$result = array ();
		$username = $this->__getParam ( 'username' );
		$password = $this->__getParam ( 'password' );
		//判断验证码 $_SESSION['captcha']
		$checkcode = $this->__getParam('checkcode');
		if(strtolower($checkcode) != strtolower($_SESSION['captcha'])) {
			$result = array('result_code' => 1, 'info' => '验证码不正确', 'msg' => $checkcode . '|' . $_SESSION['captcha']);
			$this->__displayOutput($result);
		}
		if ($username && $password) {
			$system_account = $this->systemAccount->getByUserName ( $username );
			if ($system_account) {
				if ($system_account ['password'] == md5 ( $password . $system_account['salt'] )) {
					$_SESSION ['system_account'] = $system_account;
					$result = array (
							'result_code' => 0,
							'info' => '登录成功！'
					);

					// 刷新最后一次登录时间
					$this->systemAccount->updateldate ( $system_account ['id'] );
				} else {
					$result = array (
							'result_code' => 1,
							'info' => '密码不正确！'
					);
				}
			} else {
				$result = array (
						'result_code' => 2,
						'info' => '用户不存在！'
				);
			}
		} else {
			$result = array (
					'result_code' => 3,
					'info' => '用户名格式不正确！'
			);
		}

		header ( 'Content-type: application/json;charset=utf-8' );
		echo json_encode ( $result );
	}

	/**
	 * 登出
	 */
	public function logoutAction() {
		unset ( $_SESSION ['system_account'] );
		$this->curUser = null;
		header ( "Location:/system/" );
		exit ();
	}
	public function ajaxGetViewAction() {
		$this->__checkAdminUserLogin ();
		$params = $this->__getParam ( 'params' );
		$html_params = '';
		if ($params) {
			$arr = explode ( '/', $params );
			if (count ( $arr ) > 1) {
				foreach ( $arr as $key => $item ) {
					if ($key % 2 == 0) {
						$html_params .= '<input type="hidden" id="' . $arr [$key] . '" value="' . (isset ( $arr [$key + 1] ) ? $arr [$key + 1] : null) . '" />';
					}
				}
			}
		}
		if ($this->__getParam ( 'view_name' )) {
			echo file_get_contents ( VIEW_DIR . 'admin/' . urldecode ( $this->__getParam ( 'view_name' ) ) . '.html' ) . $html_params;
		}
	}
	public function ajaxAccountAddAction() {
		$this->__checkAdminUserLogin ();
		$account = array ();
		$username = $this->__getParam ( 'username' );
		if ($username)
			$account ['username'] = $username;
		$password = $this->__getParam ( 'password' );
		if ($password)
			$account ['password'] = md5 ( $password );
		$remark = urldecode ( $this->__getParam ( 'remark' ) );
		if ($remark)
			$account ['remark'] = $remark;
		$status = $this->__getParam ( 'status' );
		if (($status || ($status == 0)) && in_array ( $status, array (
				0,
				1
		) ))
			$account ['status'] = $status;
		$email = $this->__getParam ( 'email' );
		if ($email)
			$account ['email'] = $email;
		$s_account = $this->systemAccount->getByUserName ( $username );
		$avatar = $this->__getParam('avatar');
        if($avatar){
            $account['avatar'] = $avatar;
        }
		// 判断用户名和密码是否为空
		if ($username != '' && $password != '') {
			// 判断用户名是否有重复
			if ($s_account) {
				$result = array (
						'result_code' => 1,
						'info' => '用户名有重复'
				);
			} else {
				$flag = $this->systemAccount->add ( $account );
				if ($flag) {
					$result = array (
							'result_code' => 0,
							'info' => '成功'
					);
				} else {
					$result = array (
							'result_code' => 1,
							'info' => '失败'
					);
				}
				$account = $this->systemAccount->getByUserName ( $username );
				$role_ids = $this->__getParam ( 'role_ids' );
				if ($role_ids) {
					$arr_ids = explode ( ',', $role_ids );
					foreach ( $arr_ids as $role_id ) {
						$one = array ();
						$one ['role_id'] = $role_id;
						$one ['account_id'] = $account ['id'];
						$this->systemRoleUser->add ( $one );
					}
				}
			}
		} else {
			$result = array (
					'result_code' => 1,
					'info' => '用户名或密码不能为空'
			);
		}
		$this->__displayOutput ( $result );
	}
	public function ajaxAccountUpdateAction() {
		$this->__checkAdminUserLogin ();

		$id = $this->__getParam ( 'id' );
		$account = $this->systemAccount->getById ( $id );
		$username = $this->__getParam ( 'username' );
		if ($username)
			$account ['username'] = $username;
		$password = $this->__getParam ( 'password' );
		if ($password && $password != $account ['password'])
			$account ['password'] = md5 ( $password );
		$remark = urldecode ( $this->__getParam ( 'remark' ) );
		if ($remark)
			$account ['remark'] = $remark;
		$status = $this->__getParam ( 'status' );
		if (($status || ($status == 0)) && in_array ( $status, array (
				0,
				1
		) )) {
			$account ['status'] = $status;
		}
		$email = $this->__getParam ( 'email' );
		if ($email)
			$account ['email'] = $email;
		$avatar = trim($this->__getParam('avatar'));
		if($avatar){
		   $account['avatar'] = $avatar;
		}
		$role_ids = $this->__getParam ( 'role_ids' );
		$this->systemRoleUser->deleteByAccountId ( $id );

		if ($role_ids && strlen ( $role_ids ) > 2) {
			$arr_ids = explode ( ',', $role_ids );
			foreach ( $arr_ids as $role_id ) {
				$one = array ();
				$one ['role_id'] = $role_id;
				$one ['account_id'] = $id;
				$this->systemRoleUser->add ( $one );
			}
		} else {
			if ($role_ids) {
				$one = array ();
				$one ['role_id'] = $role_ids;
				$one ['account_id'] = $id;
				$this->systemRoleUser->add ( $one );
			}
		}
		$flag = $this->systemAccount->update ( $account );

		if (true) {
			$this->curUser = $this->systemAccount->getById ( $id );
			// $_SESSION['system_account'] = $this->curUser;
			$result = array (
					'result_code' => 0,
					'info' => '成功'
			);
		} else {
			if ($flag == 0)
				$result = array (
						'result_code' => 1,
						'info' => '没有变化'
				);
			else
				$result = array (
						'result_code' => 1,
						'info' => '更新失败'
				);
		}

		$this->__displayOutput ( $result );
	}
	public function ajaxAccountGetOneAction() {
		$this->__checkAdminUserLogin ();

		$id = $this->__getParam ( 'id' );
		$result = $this->systemAccount->getById ( $id );
		//加入角色列表及所属角色数据
		$role_list = $this->systemRole->getAllKey();
		$role_user_list = $this->systemRoleUser->getByAccountId($id);
		$role_ids = '';
		foreach($role_user_list as $key => $value){
		   $role_ids = $role_ids . $value['role_id'] . ',';
		}
	    $result['role_ids'] = rtrim($role_ids,',');
	    $this->__displayOutput ( $result );
	}
	public function ajaxAccountGetListAction() {
		$this->__checkAdminUserLogin ();
		$page = $this->__getParam ( 'page' );
		if ($page < 1)
			$page = 1;
		$rows = 15;
		$data_list = $this->systemAccount->getPageData ( $page, $rows );
		/* foreach($data_list as $k => $v){
		    $role = $this->systemRoleUser->getByAccountId($v['id']);
		    $role_ids = '';
		    foreach($role as $key => $value){
		        $role_ids = $role_ids . $value['id'] .",";
		    }
		    if(!empty($role_ids)){
		        $data_list[$k]['role_ids'] = rtrim($role_ids,',');
		    }
		} */
		$result ['total_page'] = ceil ( $this->systemAccount->getCount () / $rows );
		$result ['cur_page'] = $page;
		$result ['data'] = $data_list;

		$this->__displayOutput ( $result );
	}
	public function ajaxAccountDeleteAction() {
		$this->__checkAdminUserLogin ();

		$id = $this->__getParam ( 'id' );
		$flag = $result = $this->systemAccount->delete ( $id );
		if ($flag) {
			$result = array (
					'result_code' => 0,
					'info' => '成功'
			);
		} else {
			$result = array (
					'result_code' => 1,
					'info' => '失败'
			);
		}
		$this->__displayOutput ( $result );
	}
	public function ajaxGetAccountRoleAction() {
		$this->__checkAdminUserLogin ();

		$result = $this->systemRoleUser->getByAccountId ( $this->__getParam ( 'account_id' ) );
		$this->__displayOutput ( $result );
	}
	public function ajaxAccountNewPasswordAction() {
		$this->__checkAdminUserLogin ();

		$password = urldecode ( $this->__getParam ( 'password' ) );
		$new_password = urldecode ( $this->__getParam ( 'new_password' ) );
		if (md5 ( $password ) == $this->curUser ['password']) {
			$flag = $this->shopUser->updatePassword ( md5 ( $new_password ), $this->curUser ['id'] );

			if ($flag) {
				$this->curUser = $this->shopUser->getById ( $this->curUser ['id'] );
				$_SESSION ['company_user'] = $this->curUser;
				$result = array (
						'result_code' => 0,
						'info' => '成功'
				);
			} else {
				$result = array (
						'result_code' => 1,
						'info' => '失败'
				);
			}
		} else {
			$result = array (
					'result_code' => 2,
					'info' => '失败'
			);
		}
		header ( 'Content-type: application/json;charset=utf-8' );
		echo json_encode ( $result );
	}

	public function accountAction(){
	    $this->__checkAdminUserLogin ();
	    $role_list = $this->systemRole->getAll();
		$this->smarty->assign('role_list', $role_list);
	    $this->smarty->display(VIEW_DIR . 'system/account/list.html');
	}
	public function testAction(){
		$this->smarty->display(VIEW_DIR . 'test.html');
	}
	/**
	 * ************************************
	 * 角色
	 * *************************************
	 */
	public function ajaxRoleGetListAction() {
		$this->__checkAdminUserLogin ();
		$page = $this->__getParam ( 'page' );
		if ($page < 1)
			$page = 1;
		$rows = 15;
		$data_list = $this->systemRole->getPageData ( $page, $rows );
		$result ['total_page'] = ceil ( $this->systemAccount->getCount () / $rows );
		$result ['cur_page'] = $page;
		$result ['data'] = $data_list;
		$this->__displayOutput ( $result );
	}
	public function ajaxRoleGetOneAction() {
		$this->__checkAdminUserLogin ();
		$id = $this->__getParam ( 'id' );
		$result = $this->systemRole->getById ( $id );
		//增加角色对应权限列表和所有权限列表
		$power_list = $this->systemPower->getAll();
		$role_power_list = $this->systemRolePower->getByRoleId($id);
		if($power_list) {
			foreach($power_list as $key => $power) {
				$flag = false;
				if($role_power_list) {
					foreach($role_power_list as $item) {
						if($item['power_id'] == $power['id']) {
							$flag = true;
							break;
						}
					}
				}

				if($flag) {
					$power_list[$key]['have'] = 1;
				} else {
					$power_list[$key]['have'] = 0;
				}
			}
		}
		$result['power_list'] = $power_list;
		$this->__displayOutput ( $result );
	}
	public function ajaxRoleAddAction() {
		$this->__checkAdminUserLogin ();
		$role = array ();
		$role_name = $this->__getParam ( 'role_name' );
		if ($role_name)
			$role ['role_name'] = $role_name;

		$status = $this->__getParam ( 'status' );
		if ($status && in_array ( $status, array (
				0,
				1
		) ))
			$role ['status'] = $status;

		$s_account = $this->systemRole->getByRoleName ( $role_name );

		// 判断角色名
		if ($role_name != '') {
			// 判断角色名是否有重复
			if ($s_account) {
				$result = array (
						'result_code' => 1,
						'info' => '角色名有重复'
				);
			} else {
				$flag = $this->systemRole->add ( $role );
				if ($flag) {
					$result = array (
							'result_code' => 0,
							'info' => '成功'
					);
				} else {
					$result = array (
							'result_code' => 1,
							'info' => '失败'
					);
				}
				$role = $this->systemRole->getByRoleName ( $role_name );
				$power_ids = $this->__getParam ( 'power_ids' );
				if ($power_ids) {
					$arr_ids = explode ( ',', $power_ids );
					foreach ( $arr_ids as $power_id ) {
						$one = array ();
						$one ['role_id'] = $role ['id'];
						$one ['power_id'] = $power_id;
						$this->systemRolePower->add ( $one );
					}
				}
			}
		} else {
			$result = array (
					'result_code' => 1,
					'info' => '用户名或密码不能为空'
			);
		}
		$this->__displayOutput ( $result );
	}
	public function ajaxRoleUpdateAction() {
		$this->__checkAdminUserLogin ();
		$role = array ();
		$id = $this->__getParam ( 'id' );
		$role = $this->systemRole->getById ( $id );
		$role_name = $this->__getParam ( 'role_name' );
		if ($role_name)
			$role ['role_name'] = $role_name;

		$s_account = $this->systemRole->getByRoleName ( $role_name );

		// 判断角色名
		if ($role_name != '') {
			// 判断角色名是否有重复
			if (false) { // $s_account) {
				$result = array (
						'result_code' => 1,
						'info' => '角色名有重复'
				);
			} else {
				$flag = $this->systemRole->update ( $role );
				if (true) {
					$result = array (
							'result_code' => 0,
							'info' => '成功'
					);
				} else {
					$result = array (
							'result_code' => 1,
							'info' => '失败'
					);
				}
				$role = $this->systemRole->getByRoleName ( $role_name );
				$this->systemRolePower->deleteByRoleId ( $role ['id'] );
				$power_ids = $this->__getParam ( 'power_ids' );
				if ($power_ids) {
					$arr_ids = explode ( ',', $power_ids );
					foreach ( $arr_ids as $power_id ) {
						$one = array ();
						$one ['role_id'] = $role ['id'];
						$one ['power_id'] = $power_id;
						$this->systemRolePower->add ( $one );
					}
				}
			}
		} else {
			$result = array (
					'result_code' => 1,
					'info' => '角色名不能为空'
			);
		}
		$this->__displayOutput ( $result );
	}
	public function ajaxRoleDeleteAction() {
		$this->__checkAdminUserLogin ();
		$id = $this->__getParam ( 'id' );
		$flag = $this->systemRole->delete ( $id );
		if ($flag) {
			$result = array (
					'result_code' => 0,
					'info' => '成功'
			);
		} else {
			$result = array (
					'result_code' => 1,
					'info' => '失败'
			);
		}
		$this->__displayOutput ( $result );
	}
	public function ajaxGetRolePowerAction() {
		$this->__checkAdminUserLogin ();
		$role_id = $this->__getParam ( 'role_id' );
		$result = $this->systemRolePower->getByRoleId ( $role_id );
		$this->__displayOutput ( $result );
	}

	public function roleAction(){
	    $this->__checkAdminUserLogin ();
	    $power_list = $this->systemPower->getAll();
	    $this->smarty->assign('power_list', $power_list);
	    $this->smarty->display(VIEW_DIR . 'system/role/list.html');
	}

	/**
	 * ******************************************
	 * 权限
	 *
	 * *******************************************
	 */
	public function powerAction(){
	    $this->__checkAdminUserLogin();
	    $this->smarty->display(VIEW_DIR . 'system/power/list.html');
	}

   public function ajaxPowerGetListAction() {
		$this->__checkAdminUserLogin ();
		$page = $this->__getParam ( 'page' );
		if ($page < 1)
			$page = 1;
		$rows = 15;
		$data_list = $this->systemPower->getPageData ( $page, $rows );
		$result ['total_page'] = ceil ( $this->systemPower->getCount () / $rows );
		$result ['cur_page'] = $page;
		$result ['data'] = $data_list;
		$this->__displayOutput ( $result );
	}
	public function ajaxPowerGetOneAction() {
		$this->__checkAdminUserLogin ();
		$id = $this->__getParam ( 'id' );
		$result = $this->systemPower->getById ( $id );

		$this->__displayOutput ( $result );
	}

	public function ajaxGetPowerAction(){
	    $this->__checkAdminUserLogin ();
	    $id = intval($this->__getParam ( 'id' ));
	    $role_power_list = $this->systemRolePower->getByRoleId($id);
	    $powerData = $this->systemPower->getAll();
	    foreach($powerData as $k => $v){
	        $power[$v['id']] = $v;
	    }
	    $result = array();
	    if($role_power_list){
	        $result['have_power'] = array();
	        foreach($role_power_list as $key => $value){
	            if($power[$value['power_id']]){
	                $result['have_power'][] = $power[$value['power_id']];
	            }
	        }
	        $result['all_power'] = $powerData;
	    }
	    $this->__displayOutput ($result);
	}

	public function ajaxPowerAddAction() {
		$this->__checkAdminUserLogin ();
		$power = array ();
		$power_name = $this->__getParam ( 'power_name' );
		if ($power_name)
			$power ['power_name'] = $power_name;

		$uri = urldecode ( $this->__getParam ( 'uri' ) );
		if ($uri)
			$power ['uri'] = $uri;

		$s_account = $this->systemPower->getByPowerName ( $power_name );

		// 判断权限名重复
		if ($power_name != '') {
			if ($s_account) {
				$result = array (
						'result_code' => 1,
						'info' => '权限名有重复'
				);
			} else {
				$flag = $this->systemPower->add ( $power );
				if ($flag) {
					$result = array (
							'result_code' => 0,
							'info' => '成功'
					);
				} else {
					$result = array (
							'result_code' => 1,
							'info' => '失败'
					);
				}
			}
		} else {
			$result = array (
					'result_code' => 1,
					'info' => '权限名不能为空'
			);
		}
		$this->__displayOutput ( $result );
	}
	public function ajaxPowerUpdateAction() {
		$this->__checkAdminUserLogin ();
		$power = array ();
		$id = $this->__getParam ( 'id' );
		$power = $this->systemPower->getById ( $id );

		$power_name = $this->__getParam ( 'power_name' );
		if ($power_name)
			$power ['power_name'] = $power_name;

		$uri = urldecode ( $this->__getParam ( 'uri' ) );
		if ($uri)
			$power ['uri'] = $uri;

			// $s_account = $this->systemPower->getByPowerName($power_name);

		// 判断权限名重复
		if ($power_name != '') {
			if (false) { // $s_account) {
				$result = array (
						'result_code' => 1,
						'info' => '权限名有重复'
				);
			} else {
				$flag = $this->systemPower->update ( $power );
				if (true) {//$flag) {
					$result = array (
							'result_code' => 0,
							'info' => '成功'
					);
				} else {
					$result = array (
							'result_code' => 1,
							'info' => '失败'
					);
				}
			}
		} else {
			$result = array (
					'result_code' => 1,
					'info' => '权限名不能为空'
			);
		}
		$this->__displayOutput ( $result );
	}
	public function ajaxPowerDeleteAction() {
		$this->__checkAdminUserLogin ();
		$id = $this->__getParam ( 'id' );
		$flag = $this->systemPower->delete ( $id );
		if ($flag) {
			$result = array (
					'result_code' => 0,
					'info' => '成功'
			);
		} else {
			$result = array (
					'result_code' => 1,
					'info' => '失败'
			);
		}

		$this->__displayOutput ( $result );
	}

	public function ajaxGetJsonAction() {
		$str = '[
    {
        "id": 0,
        "name": "Item 0",
        "price": "$0"
    },
    {
        "id": 1,
        "name": "Item 1",
        "price": "$1"
    },
    {
        "id": 2,
        "name": "Item 2",
        "price": "$2"
    },
    {
        "id": 3,
        "name": "Item 3",
        "price": "$3"
    },
    {
        "id": 4,
        "name": "Item 4",
        "price": "$4"
    },
    {
        "id": 5,
        "name": "Item 5",
        "price": "$5"
    },
    {
        "id": 6,
        "name": "Item 6",
        "price": "$6"
    },
    {
        "id": 7,
        "name": "Item 7",
        "price": "$7"
    },
    {
        "id": 8,
        "name": "Item 8",
        "price": "$8"
    },
    {
        "id": 9,
        "name": "Item 9",
        "price": "$9"
    },
    {
        "id": 10,
        "name": "Item 10",
        "price": "$10"
    },
    {
        "id": 11,
        "name": "Item 11",
        "price": "$11"
    },
    {
        "id": 12,
        "name": "Item 12",
        "price": "$12"
    },
    {
        "id": 13,
        "name": "Item 13",
        "price": "$13"
    },
    {
        "id": 14,
        "name": "Item 14",
        "price": "$14"
    },
    {
        "id": 15,
        "name": "Item 15",
        "price": "$15"
    },
    {
        "id": 16,
        "name": "Item 16",
        "price": "$16"
    },
    {
        "id": 17,
        "name": "Item 17",
        "price": "$17"
    },
    {
        "id": 18,
        "name": "Item 18",
        "price": "$18"
    },
    {
        "id": 19,
        "name": "Item 19",
        "price": "$19"
    },
    {
        "id": 20,
        "name": "Item 20",
        "price": "$20"
    }
]';
		$obj = json_decode($str);
		$result['total'] = 800;
		$result['rows'] = $obj;
		$this->__displayOutput($result);
	}



	public function captchaAction() {
		//文件头...
		header("Content-type: image/png");
		//创建真彩色白纸
		$im = @imagecreatetruecolor(50, 20) or die("建立图像失败");
		//获取背景颜色
		$background_color = imagecolorallocate($im, 255, 255, 255);
		//填充背景颜色(这个东西类似油桶)
		imagefill($im,0,0,$background_color);
		//获取边框颜色
		$border_color = imagecolorallocate($im,200,200,200);
		//画矩形，边框颜色200,200,200
		imagerectangle($im,0,0,49,19,$border_color);

		//逐行炫耀背景，全屏用1或0
		for($i=2;$i<18;$i++){
			//获取随机淡色
			$line_color = imagecolorallocate($im,rand(200,255),rand(200,255),rand(200,255));
			//画线
			imageline($im,2,$i,47,$i,$line_color);
		}

		//设置字体大小
		$font_size=12;

		//设置印上去的文字
		$Str[0] = "ABCDEFGHIJKLMNPQRSTUVWXYZ";
		$Str[1] = "abcdefghijklmnpqrstuvwxyz";
		$Str[2] = "1234567891234567890123456";

		$string = '';
		//获取第1个随机文字
		$imstr[0]["s"] = $Str[rand(0,2)][rand(0,24)];
		$string .= $imstr[0]["s"];
		$imstr[0]["x"] = rand(2,5);
		$imstr[0]["y"] = rand(1,4);

		//获取第2个随机文字
		$imstr[1]["s"] = $Str[rand(0,2)][rand(0,24)];
		$string .= $imstr[1]["s"];
		$imstr[1]["x"] = $imstr[0]["x"]+$font_size-1+rand(0,1);
		$imstr[1]["y"] = rand(1,3);

		//获取第3个随机文字
		$imstr[2]["s"] = $Str[rand(0,2)][rand(0,24)];
		$string .= $imstr[2]["s"];
		$imstr[2]["x"] = $imstr[1]["x"]+$font_size-1+rand(0,1);
		$imstr[2]["y"] = rand(1,4);

		//获取第4个随机文字
		$imstr[3]["s"] = $Str[rand(0,2)][rand(0,24)];
		$string .= $imstr[3]["s"];
		$imstr[3]["x"] = $imstr[2]["x"]+$font_size-1+rand(0,1);
		$imstr[3]["y"] = rand(1,3);

		// 		session_start();
		$_SESSION['captcha'] = $string;
		//写入随机字串
		for($i=0;$i<4;$i++){
			//获取随机较深颜色
			$text_color = imagecolorallocate($im,rand(50,180),rand(50,180),rand(50,180));
			//画文字
			imagechar($im,$font_size,$imstr[$i]["x"],$imstr[$i]["y"],$imstr[$i]["s"],$text_color);
		}

		//显示图片
		imagepng($im);
		//销毁图片
		imagedestroy($im);
	}
}

?>