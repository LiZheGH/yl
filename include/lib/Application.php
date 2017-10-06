<?php
require_once 'Route.php';
final class Application {
	/**
	 * 创建应用
	 * @access      public
	 * @param       array   $config
	 */
	public static function run(){
		$route = Route::getInstance ();
		$route->setUrlType ( 2 );
		self::routeToCm($route->getUrlArray ());
	}

	/**
	 * 根据URL分发到Controller和Model
	 * @access      public
	 * @param       array   $url_array
	 */
	public static function routeToCm($url_array = array()){
		$app = '';
		$controller = '';
		$action = '';
		$model = '';
		$params = '';

		if(isset($url_array['app'])){
			$app = $url_array['app'];
		}
		if(isset($url_array['controller'])){
			$controller = $model = $url_array['controller'];
			$controller_file = CTRL_DIR  . ucfirst($controller) . 'Controller.php';
		} else {

		}
		$action = $url_array['action'] . 'Action';

		if(isset($url_array['params'])){
			$params = $url_array['params'];
		}

		if(file_exists($controller_file)) {
			require_once $controller_file;
			$controller = $controller.'Controller';
			$controller_obj = new $controller($params);
			if($action) {
				if(method_exists($controller, $action)){
					if(isset($params) && count($params) > 0) {
						$controller_obj->$action();
					} else {
						$controller_obj->$action();
					}
				} else {
					//自动显示html文件
					$tp_file = '';
					if(isset($params) && is_array($params) && count($params) > 0) {
						foreach($params as $key => $value) {
							$tp_file .= '/' . $key . '/' . $value;
						}
					}

					$view_file = VIEW_DIR . $_SERVER ['REQUEST_URI'] . '.html';
// 					echo $view_file;exit();
					if(file_exists($view_file)) {
						//require_once 'lib/Smarty.php';
						//$smarty = LibSmarty::getInstance();
						//$smarty->display($view_file);
						$controller_obj->showPage($view_file);
					} else {
						//die('controller "' . $controller . '"  "' . $action . '" action not exist!');
					}
				}
			} else {
				//die('controller "' . $controller . '-' . $action . '" action not exist!');
			}
		} else {
			//die('controller "' . $controller_file . '" not exist!');
		}
	}

}