<?php
class Route {

	public $url_query;

	public $url_type;

	public $route_url = array ();


	/**
	 * Instance
	 *
	 * @var Route
	*/
	private static $instance = NULL;

	/**
	 * Get instance
	 *
	 * @param boolean $cli
	 * @return Route
	 */
	public static function getInstance($cli = false) {
		if (empty ( self::$instance )) {
			self::$instance = new self ( $cli );
		}
		return self::$instance;
	}

	/**
	 * 设置URL类型
	 *
	 * @access public
	 */
	public function setUrlType($url_type = 2) {
		if ($url_type > 0 && $url_type < 3) {
			$this->url_type = $url_type;
		} else {
			trigger_error ( "指定的URL模式不存在！" );
		}
	}

	/**
	 * 获取数组形式的URL
	 *
	 * @access public
	 */
	public function getUrlArray() {
		$this->url_query = parse_url ( $_SERVER ['REQUEST_URI'] );
		$this->makeUrl ();
		return $this->route_url;
	}
	/**
	 *
	 * @access public
	 */
	public function makeUrl() {
		switch ($this->url_type) {
			case 1 :
				$this->querytToArray ();
				break;
			case 2 :
				$this->pathinfoToArray ();
				break;
		}
	}
	/**
	 * 将query形式的URL转化成数组
	 *
	 * @access public
	 */
	public function querytToArray() {
		$arr = ! empty ( $this->url_query ['query'] ) ? explode ( '&', $this->url_query ['query'] ) : array ();
		$array = $tmp = array ();
		if (count ( $arr ) > 0) {
			foreach ( $arr as $item ) {
				$tmp = explode ( '=', $item );
				$array [$tmp [0]] = $tmp [1];
			}
			if (isset ( $array ['app'] )) {
				$this->route_url ['app'] = $array ['app'];
				unset ( $array ['app'] );
			}
			if (isset ( $array ['controller'] )) {
				$this->route_url ['controller'] = $array ['controller'];
				unset ( $array ['controller'] );
			}
			if (isset ( $array ['action'] )) {
				$this->route_url ['action'] = $array ['action'];
				unset ( $array ['action'] );
			}
			if (count ( $array ) > 0) {
				$this->route_url ['params'] = $array;
			}
		} else {
			$this->route_url = array ();
		}
	}

	/**
	 * 将PATH_INFO的URL形式转化为数组
	 *
	 * @access public
	 */
	public function pathinfoToArray() {
		$this->route_url = array();
		$this->route_url['app'] = $_SERVER['SERVER_NAME'];
		$uri_array = explode('/', $_SERVER ['REQUEST_URI'] );
		$params = array();
		foreach($_REQUEST as $k => $v) {
			$params[$k] = $v;
		}
// 		$params['__data__'] = file_get_contents("php://input");
// 		$params['__data2__'] = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : '' ;
		//    /app/web_content?content_id=71407
		if(is_array($uri_array) && count($uri_array) > 2) {
		$this->route_url['controller'] = $uri_array[1];
			if($uri_array[2] != '') {
				if(strstr($uri_array[2], '?')) {
					$a_array = explode('?', $uri_array[2]);
					$this->route_url['action'] = $a_array[0];
					$b_array = explode('&', $a_array[1]);
					foreach($b_array as $line) {
						$c = explode('=', $line);
						if(is_array($c) && (count($c) == 2)) {
							$params[$c[0]] = urldecode($c[1]);
						}
					}
					$this->route_url['params'] = $params;
				} else {
					$this->route_url['action'] = $uri_array[2];
				}
			} else {
				$this->route_url['action'] = 'index';
			}

			if(count($uri_array) > 4) {
				$params_uri_array = array_splice($uri_array, 3);

				if((count($params_uri_array) % 2) == 1) {
					//去掉参数数组最后一个元素
					array_pop($params_uri_array);
				}

				foreach($params_uri_array as $key => $value) {
					if(($key % 2) == 0) {
						$params[urldecode($value)] = $params_uri_array[$key+1];
					}
				}

				$this->route_url['params'] = $params;
			}
		} else {
			$this->route_url['controller'] = 'system';
			$this->route_url['action'] = 'index';
			$this->route_url['params'] = $params;
		}

	}
}