<?php
/**
 * 本文件存放常用的一些公用函数和类，如果是类均是采用静态方法访问
 */

/**
 * 简化的一个双目运算表现形式
 * (expression) ? (result1) : (result2)
 *
 * @param string $expression 表达式，用于判断的条件
 * @param mixed $returntrue 判断结果为真时返回的结果
 * @param mixed $returnfalse 判断结果为假时返回的结果
 * @return mixed
 */
function iif($expression,$returntrue,$returnfalse)
{
	if ($expression) return $returntrue;
	else return $returnfalse;
}

/**
 * 重定义print_r()函数，增加<pre>和</pre>标签，用于格式化显示
 *
 * @param mixed $var 要打印的变量，可能是string也可能是array或者其他
 * @return true;
 */
function pprint_r($var)
{
	echo '<pre>';
	print_r($var);
	echo '</pre>';
	return true;
}

/**
 * 重定义var_dump()函数，增加<pre>和</pre>标签，用于格式化显示
 *
 * @param mixed $var 要打印的变量，可能是string也可能是array或者其他
 * @return true;
 */
function pvar_dump($var)
{
	echo '<pre>';
	var_dump($var);
	echo '</pre>';
	return true;
}


/**
 * 定义一个常用函数的集合类，采用静态方法访问
 */
class CommonFuncs
{
	// 接着处理URL，过滤一些非法字符
	static public function xssClean($var)
	{
		static $find, $replace;
		if (empty($find)) {
			$find = array('"', '<', '>');
			$replace = array('&quot;', '&lt;', '&gt;');
		}
		$var = preg_replace('/javascript/i', 'java script', $var);
		return str_replace($find, $replace, $var);
	}

	/**
     * 对字符串进行过滤处理
     *
     * @param string $str
     * @param bool $html_filter
     * @return string
     */
	static public function strClean($str, $html_filter=false )
	{
		$str = trim( $str );
		$str = addslashes( $str );
		if ( $html_filter ) $str = htmlspecialchars( $str );
		$str = preg_replace( '/[\x00-\x08\x0b\x0c\x0e-\x1f]/', '', $str );
		return $str;
	}

	/**
     * 清除所见所得编辑器输入的字符中不合法的部分，包括转义、回车、script等
     *
     * @param string $str
     * @return string
     */
	static public function editorClean($str)
	{

	}

	/**
     * 弹出jiavascript提示框，并返回指定历史页面
     *
     * @param string $msg 弹出信息
     * @param string $charset 页面的字符集，避免出现乱字符
     * @access public
     * @return bool Always true (return void)
     * @author Michael Lee <lee@hmei.cn>
     */
	static public function alertBack($msg="Unknown Error!",$charset="UTF-8")
	{
		@header("Content-Type:text/html;charset=$charset");
		echo "<script language='javascript'>\r\n";
		echo "alert('".$msg."');\r\n";
		echo "window.history.go(-1);\r\n";
		echo "</script>";
		exit;
	}

	/**
     * 弹出jiavascript提示框，并跳转到指定页面
     * @param string $msg 弹出信息
     * @param string $url 跳转的目标页面或地址
     * @param string $charset 页面字符集
     */
	static public function alertHref($msg="Unknown Error!",$url="",$charset="UTF-8")
	{
		@header("Content-Type:text/html;charset=$charset");
		echo "<script language='javascript'>\r\n";
		echo "alert('$msg');\r\n";
		echo "window.location.href='".$url."';\r\n";
		echo "</script>\r\n";
		exit;
	}

	/**
     * 使用javascript跳转页面到指定url
     * @param string $url : 跳转的目标url地址
     */
	static public function goHref($url="")
	{
		echo "<script language='javascript'>\r\n";
		echo "window.location.href='".$url."';\r\n";
		echo "</script>\r\n";
		exit;
	}

	/**
     * 发送指定编码的header
     */
	static public function headerCharset($charset="UTF-8")
	{
		@header("Content-Type:text/html;charset=$charset");
	}

	/**
     * 去除UTF-8编码的前面三个非法字符
     *
     * @param string $str
     * @return string
     */
	static public function utf8BomClean($str) {
		$charset = array();
		$charset[1]=ord(substr($str, 0, 1));
		$charset[2]=ord(substr($str, 1, 1));
		$charset[3]=ord(substr($str, 2, 1));
		if ($charset[1]==239 && $charset[2]==187 && $charset[3]==191) {
			return substr($str, 3);
		}
		return $str;
	}

	/**
     * 获取用户来访IP地址
     */
	static public function fetchIp()
	{
		$_S = $_SERVER;
		if (isset($_S['HTTP_CLIENT_IP'])) {
			$ip = $_S['HTTP_CLIENT_IP'];
		} elseif (isset($_S['HTTP_X_FORWARDED_FOR']) &&
		preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_S['HTTP_X_FORWARDED_FOR'], $mat)) {
			foreach ($mat[0] AS $p) {
				if (!preg_match("/^10|172\.16|192\.168\./", $p)) {  //内网丢弃
					$ip = $p;
					break;
				}
			}
		}

		if (!isset($ip) || empty($ip)) {
			if (isset($_S['HTTP_FROM'])) {
				$ip = $_S['HTTP_FROM'];
			} else {
				$ip = isset($_S['REMOTE_ADDR']) ? $_S['REMOTE_ADDR'] : '127.0.0.1';
			}
		}
		return $ip;
	}

	/**
     * 加入了md5处理
     * 返回结果开头不带 / ，末尾带 /
     *
     * @param int $id
     * @param int $depth
     * @return string
     */
	static public function makeMd5PathHash($id,$depth=1)
	{
		$str = md5($id);
		$path = "";
		for ($i=0;$i<$depth;$i++) {
			$hash = substr($str,$i,1);
			$path .= $hash.'/';
		}
		return $path;
	}

	/**
     * 创建多级目录
     *
     * @param string $dir 要创建的目录名
     */
	static public function myMkdir($dir)
	{
		$dir = @preg_replace("/\\\/","/",$dir);
		$dir = @preg_replace("/\/{2,}/","/",$dir);
		$dir = @explode('/',$dir);

		$path = "";
		for ($i=0;$i<count($dir);$i++) {
			$path .= $dir[$i].'/';
			if (!is_dir($path)) @mkdir($path,0700);
		}
		return true;
	}

	/**
     * 多级目录删除函数，包括里面的文件
     */
	static public function myRmdir($dir) {
		$mydir = dir($dir);
		while ($file=$mydir->read()){
			if ((is_dir("$dir/$file")) && ($file!=".") && ($file!="..")) {
				rmDir2("$dir/$file");
			} else {
				if (($file!=".") AND ($file!="..")){
					@unlink("$dir/$file");
				}
			}
		}
		$mydir->close();
		rmdir($dir);
	}

	static public function delDirAndFile($dirName)
	{
	    if ($handle = opendir($dirName)) {
	        while (false !== ($item = readdir($handle))) {
	            if ($item != "." && $item != "..") {
	                if (is_dir("$dirName/$item"))
	                    self::delDirAndFile("$dirName/$item");
	                else
	                    unlink("$dirName/$item");
	            }
	        }
	        closedir($handle);
	        rmdir($dirName);
	    }
	}

	public static function getUUID(){
	    if (function_exists('com_create_guid')){
	        return com_create_guid();
	    }else{
	        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
	        $charid = strtolower(md5(uniqid(rand(), true)));
	        $hyphen = chr(45);// "-"
	        //chr(123)// "{"
	        $uuid = substr($charid, 0, 8).$hyphen
	        .substr($charid, 8, 4).$hyphen
	        .substr($charid,12, 4).$hyphen
	        .substr($charid,16, 4).$hyphen
	        .substr($charid,20,12);
	        //.chr(125);// "}"
	        return $uuid;
	    }
	}

	/**
     * 产生随机字串，可用来自动生成密码 默认长度6位 字母和数字混合
     *
     * @param int $len
     * @param string $format
     * @return string $password
     */
	static public function mkPasswd($len=6,$format='ALL') {
		switch(strtolower($format)) {
			case 'all':
				$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-@#~';
				break;
			case 'char':
				$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
				break;
			case 'char2':
				$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-@#~';
				break;
			case 'num':
				$chars = '0123456789';
				break;
			default :
				$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-@#~';
				break;
		}
		mt_srand((double)microtime()*1000000*getmypid());
		$passwd = '';
		while (strlen($passwd)<$len) $passwd .= substr($chars,(mt_rand()%strlen($chars)),1);
		return $passwd;
	}

	/**
     * 支持utf8字符集的wordwrap接口
     *
     * @param strint $str
     * @param int $len
     * @parm strint $what
     * @return string
     */
	static public function wordwrapUtf8($str,$len=80,$what="<br />\n")
	{
		$from=0;
		$str_length = preg_match_all('/[\x00-\x7F\xC0-\xFD]/', $str, $var_empty);
		$while_what = $str_length / $len;
		while ($i <= round($while_what)){
			$string = preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'.
			'((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s',
			'$1',$str);
			$total .= $string.$what;
			$from = $from+$len;
			$i++;
		}
		return $total;
	}

	/**
     * 能处理中文等双字节折行接口，是wordwrap的增强
     * 该函数性能和准确性不错
     *
     * @param string $str
     * @param int $len
     * @param string $glue
     * @return string
     * @see http://php.clickz.cn/articles/string/wrodwrap.html
     */
	static public function wordwrapCn($str="",$len=80,$glue="\n")
	{
		for ($i=0;$i<strlen($str);$i++) {
			if (ord(substr($str,$i,1)) > 128) {
				$str_arr[] = substr($str,$i,2);
				$i++;
			} else {
				$str_arr[] = substr($str,$i,1);
			}
		}
		$tmp = array_chunk($str_arr,$len);
		$str = "";
		foreach ($tmp as $key=>$val) {
			$str .= implode("",$val).$glue;
		}
		return $str;
	}

	/**
     * 支持UTF8编码的substr
     *
     * @param string $str
     * @param int $start
     * @param int $length
     * @return string
     */
	static public function substrUtf8($str, $start, $length=NULL)
	{
		if (function_exists("mb_substr")) {
			return mb_substr($str, $start, $length, "UTF-8");
		}
		preg_match_all("/./u", $str, $ar);

		if (func_num_args() >= 3) {
			$end = func_get_arg(2);
			return join("",array_slice($ar[0],$start,$end));
		} else {
			return join("",array_slice($ar[0],$start));
		}
	}

	/**
     * 支持utf8编码的strlen
     *
     * @param string $str
     * @return int
     */
	static public function strlenUtf8($str)
	{
		if (function_exists("mb_strlen")) return mb_strlen($str, "UTF-8");
		else return strlen(utf8_decode($str));
	}

	/**
     * 取得一个文件的扩展名,不包含扩展名中的.小数点
     *
     * @return string
     */
	static public function getFileExt($filename)
	{
		return substr(strrchr($filename, '.'), 1);
	}

	/**
     * 本函数从源文件取出图象，设定成指定大小，并输出到目的文件
     * 源文件格式：gif,jpg,jpe,jpeg,png
     * 目的文件格式：jpg
     *
     * @param string $srcFile 源文件
     * @param string $dstFile 目标文件
     * @param int $dstW 目标图象宽度
     * @param int $dstH 目标图象高度
     * @return mixed
     */
	public static function resizeImg($srcFile,$dstFile,$dstW,$dstH)
	{
		$data = @GetImageSize($srcFile,$info);
		if (FALSE === $data) return false;

		switch ($data[2]) {
			case 1:
				$im = @ImageCreateFromGIF($srcFile);
				break;
			case 2:
				$im = @imagecreatefromjpeg($srcFile);
				break;
			case 3:
				$im = @ImageCreateFromPNG($srcFile);
				break;
		}
		$srcW = @ImageSX($im);
		$srcH = @ImageSY($im);
		$dstX = 0;
		$dstY = 0;
		$ni = imagecreatetruecolor($dstW,$dstH);
		imagecopyresized($ni, $im, 0, 0, 0, 0, $dstW, $dstH, $srcW, $srcH);
		if (@ImageJpeg($ni,$dstFile,100)) {
			@imagedestroy($im);
			@imagedestroy($ni);
			return true;
		} else {
			@imagedestroy($im);
			@imagedestroy($ni);
			return false;
		}
	}

	/**
     * 等比例缩放一张图片，以最大的一个边最为依据来进行缩放
     *
     * @param 原图路径 $src
     * @param 目标图路径 $dst
     * @param 目标图宽度 $dst_w
     * @param 目标图高度 $dst_h
     * @param $standardEdge long|short
     * @return bool
     */
	static public function fitResizeImg($src, $dst, $dst_w, $dst_h, $standardEdge = 'long')
	{
		if (!file_exists($src)) return false;   //原图不存在

		require_once 'Image/Transform.php';
		//create transform driver object
		$it = Image_Transform::factory('GD');
		if (PEAR::isError($it)) return false;

		//load the original file
		$ret = $it->load($src);
		if (PEAR::isError($ret)) return false;

		//目标图片尺寸和高宽比例
		$dst_s = $dst_h / $dst_w;

		//当前图片的尺寸和高宽比例
		$src_h = $it->getImageHeight();
		$src_w = $it->getImageWidth();
		$src_s = $src_h / $src_w;

		//判断原图是否本来就比目标图片要小，则直接拷贝一个文件即可
		if ($src_w <= $dst_w && $src_h <= $dst_h) {
			return copy($src, $dst);
		}

		//后面的情况属于至少有一个原始图片的边比目标图片的边要长，则进行缩放或者截取操作

		/**
         * 第一种情况：如果原始图和目标图的宽高比例相同，则直接根据x或者y任一进行缩放即可
         */
		if ($src_s == $dst_s) {
			$ret = $it->fitX($dst_w);

		/**
         * 第二种情况：原图偏高的图片（如金箍棒），目标图片偏扁
         * 此时，目标图片高与宽之比小于原图比例，则以高为基础缩小
         */
		} elseif ($dst_s < $src_s) {
		    $ret = $it->fitY($dst_h);

		/**
         * 第三种情况：原图偏宽的图片（如banner条），目标图片属于偏瘦高的类型，
         * 此时，以宽为基础先缩小
         */
		} else {
		    $ret = $it->fitX($dst_w);
		}
		if (PEAR::isError($ret)) return false;

		$ret = $it->save($dst, 'jpeg');
		if (PEAR::isError($ret)) return false;

		return true;
	}

	/**
     * Fit image file by width
     *
     * @param string $src
     * @param string $dst
     * @param integer $dst_w
     * @return boolean
     */
	public static function fitResizeImgWidth($src, $dst, $dstW)
	{
		// If source image file not exists
		if (!file_exists($src)) {
			return false;
		}

		require_once 'Image/Transform.php';

		// Create transform driver object
		$it = Image_Transform::factory('GD');
		if (PEAR::isError($it)) {
			return false;
		}

		// Load the source file
		$ret = $it->load($src);
		if (PEAR::isError($ret)) {
			return false;
		}

		// Source file width
		$srcW = $it->getImageWidth();

		// If source file not bigger than destination, copy it.
		if ($srcW <= $dstW) {
			return copy($src, $dst);

		// Or fit the width
		} else {
			$ret = $it->fitX($dstW);
		}

		if (PEAR::isError($ret)) {
			return false;
		}

		// Save
		$ret = $it->save($dst, 'jpeg');
		if (PEAR::isError($ret)) {
			return false;
		}

		return true;
	}

	/**
     * 以左上角为起点的方式截取一张图片
     *
     * @param 原图路径 $src
     * @param 目标图路径 $dst
     * @param 目标图宽度 $dst_w
     * @param 目标图高度 $dst_h
     * @return bool
     */
	static public function cropImg($src, $dst, $dst_w, $dst_h)
	{
		if (!file_exists($src)) return false;   //原图不存在

		require_once 'Image/Transform.php';
		//create transform driver object
		$it = Image_Transform::factory('GD');
		if (PEAR::isError($it)) return false;

		//load the original file
		$ret = $it->load($src);
		if (PEAR::isError($ret)) return false;

		//目标图片尺寸和高宽比例
		$dst_s = $dst_h / $dst_w;

		//当前图片的尺寸和高宽比例
		$src_h = $it->getImageHeight();
		$src_w = $it->getImageWidth();
		$src_s = $src_h / $src_w;

		//判断原图是否本来就比目标图片要小，则直接拷贝一个文件即可
		if ($src_w <= $dst_w && $src_h <= $dst_h) {
			return copy($src, $dst);
		}

		//后面的情况属于至少有一个原始图片的边比目标图片的边要长，则进行缩放或者截取操作

		/**
         * 第一种情况：如果原始图和目标图的宽高比例相同，则直接根据x或者y任一进行缩放即可
         */
		if ($src_s == $dst_s) {
			$ret = $it->fitX($dst_w);

			/**
         * 第二种情况：原图偏高的图片（如金箍棒），目标图片偏扁
         * 此时，目标图片高与宽之比小于原图比例，则以宽为基础缩小
         */
		} elseif ($dst_s < $src_s) {
			$ret = $it->fitX($dst_w);

			/**
         * 第三种情况：原图偏宽的图片（如banner条），目标图片属于偏瘦高的类型，
         * 此时，以高为基础先缩小
         */
		} else {
			$ret = $it->fitY($dst_h);
		}
		if (PEAR::isError($ret)) return false;

		//进行图片裁剪
		$ret = $it->crop($dst_w, $dst_h);
		if (PEAR::isError($ret)) return false;
		$ret = $it->save($dst, 'jpeg');
		if (PEAR::isError($ret)) return false;

		return true;
	}

	/**
     * 以最居中的方式截取一张图片，先缩放然后居中截取
     *
     * @param 原图路径 $src
     * @param 目标图路径 $dst
     * @param 目标图宽度 $dst_w
     * @param 目标图高度 $dst_h
     * @return bool
     */
	static public function centerCropImg($src, $dst, $dst_w, $dst_h)
	{
		if (!file_exists($src)) return false;   //原图不存在

		require_once 'Image/Transform.php';
		//create transform driver object
		$it = Image_Transform::factory('GD');
		if (PEAR::isError($it)) return false;

		//load the original file
		$ret = $it->load($src);
		if (PEAR::isError($ret)) return false;

		//目标图片尺寸和高宽比例
		$dst_s = $dst_h / $dst_w;

		//当前图片的尺寸和高宽比例
		$src_h = $it->getImageHeight();
		$src_w = $it->getImageWidth();
		$src_s = $src_h / $src_w;

		//判断原图是否本来就比目标图片要小，则直接拷贝一个文件即可
		if ($src_w <= $dst_w && $src_h <= $dst_h) {
			return copy($src, $dst);
		}

		//后面的情况属于至少有一个原始图片的边比目标图片的边要长，则进行缩放或者截取操作

		//如果原始图和目标图的宽高比例相同，则直接根据x或者y任一进行缩放即可
		if ($src_s == $dst_s) {
			$ret = $it->fitX($dst_w);
			if (PEAR::isError($ret)) return false;
			$ret = $it->save($dst);
			if (PEAR::isError($ret)) return false;

			return true;
		}

		//后面的情况属于高宽比例是不一致的，需要根据具体情况进行裁剪

		//定义裁剪图片开始的x和y坐标
		$x = $y = 0;

		/**
         * 第一种情况：原图偏高的图片（如金箍棒），目标图片偏扁
         * 此时，目标图片高与宽之比小于原图比例，则先以宽为基础缩小，然后再计算Y轴坐标，最后裁剪
         */
		if ($dst_s < $src_s) {
			$ret = $it->fitX($dst_w);
			if (PEAR::isError($ret)) return false;

			if ($src_w > $dst_w) {
				/**
                 * 如果原图的宽度比目标图片的宽度要大，此时原图肯定比目标图整体要大
                 * 原图比目标图要大，则肯定高也会高出不少
                 * 此时计算最后可能会被裁掉的高度的数值再除以二，得到Y轴坐标，取了图的中间部分
                 */
				$rate = $dst_w / $src_w;   //缩放比例
				$y = floor(($src_h * $rate - $dst_h) / 2 );
			} else {
				/**
                 * 如果原图的宽度比目标宽度要小，说明目标图片是一个长而且很窄的图，横着长条
                 * 此时实际上图片的宽度方向（x）是没有进行缩放和裁剪的，仅仅计算高度的居中部分
                 */
				$y = floor(($src_h - $dst_h) / 2);
			}
			/**
         * 第二种情况：原图偏宽的图片（如banner条），目标图片属于偏瘦高的类型，
         * 此事以高为基础先缩小，再计算x轴坐标
         */
		} else {
			$ret = $it->fitY($dst_h);
			if (PEAR::isError($ret)) return false;

			if ($src_h > $dst_h) {
				$rate = $dst_h / $src_h;
				$x = floor($src_w * $rate - $dst_w) / 2;
			} else{
				$x = floor(($src_w - $dst_w) / 2);
			}
		}

		$ret = $it->crop($dst_w, $dst_h, $x, $y);
		if (PEAR::isError($ret)) return false;
		$ret = $it->save($dst, 'jpeg');
		if (PEAR::isError($ret)) return false;

		return true;
	}

	/**
     * 以最居中的方式截取一张图片，先缩放然后居中截取
     *
     * @param 原图路径 $src
     * @param 目标图路径 $dst
     * @param 目标图宽度 $dst_w
     * @param 目标图高度 $dst_h
     * @return bool
     */
	public static function customCropImg($src, $dst,  $resize_x, $resize_y, $x, $y, $dst_w, $dst_h)
	{
		if (!file_exists($src)) {
			return false;   //原图不存在
		}

		require_once 'Image/Transform.php';
		//create transform driver object
		$it = Image_Transform::factory('GD');
		if (PEAR::isError($it)) {
			return false;
		}

		//load the original file
		$ret = $it->load($src);
		if (PEAR::isError($ret)) {
			return false;
		}

		$ret = $it->resize($resize_x, $resize_y);
		if (PEAR::isError($ret)) {
			return false;
		}

		$ret = $it->save($dst);
		if (PEAR::isError($ret)) {
			return false;
		}

		$ret = $it->load($dst);
		if (PEAR::isError($ret)) {
			return false;
		}

		$ret = $it->crop($dst_w, $dst_h, $x, $y);
		if (PEAR::isError($ret)) {
			return false;
		}

		$ret = $it->save($dst, 'jpeg');
		if (PEAR::isError($ret)) {
			return false;
		}

		return true;
	}

	/**
     * tnCustomCropImg
     *
     * @param string $src
     * @param string $dst
     * @param integer $resize_x
     * @param integer $resize_y
     * @param integer $x
     * @param integer $y
     * @param integer $dst_w
     * @param integer $dst_h
     * @return boolean
     * @throws Exception
     */
	public static function tnCustomCropImg($src, $dst, $resize_x, $resize_y, $x, $y, $dst_w, $dst_h)
	{
		require_once 'thumbnail.inc.php';

		try {
			$thumb = new Thumbnail($src);
			$thumb->resize($resize_x, $resize_y);
			$thumb->cropForce($x, $y, $dst_w, $dst_h);
			$thumb->save($dst);
		} catch (Exception $e) {
			throw $e;
		}

		return TRUE;
	}

	/**
     * tnResizeImg
     *
     * @param string $srcFile
     * @param string $dstFile
     * @param integer $dstW
     * @param integer $dstH
     * @return boolean
     * @throws Exception
     */
	public static function tnResizeImg($srcFile, $dstFile, $dstW, $dstH)
	{
		require_once 'thumbnail.inc.php';

		try {
			$thumb = new Thumbnail($srcFile);
			$thumb->resize($dstW, $dstH);
			$thumb->save($dstFile);
		} catch (Exception $e) {
			throw $e;
		}

		return TRUE;
	}

	/**
     * 给图片加上文字水印
     * 本函数需要 simhei.ttf 字体文件的支持
     * 字体文件可以存放在PEAR根目录下，也可以放在调用本接口的程序目录
     * 本函数要求php.ini中的memory设置稍微大一些，否则一些大一点的图片会处理失败
     *
     * @param string $img 图片文件名（包括路径）
     * @param string $text
     * @param string $font
     * @return mixed
     */
	static public function waterImg($img="",$text='9tmd.com',$font='simhei.ttf')
	{
		$uptypes = array(
		'image/jpg',
		'image/jpeg',
		'image/png',
		'image/pjpeg',
		'image/x-png',
		//'image/gif',
		//'image/bmp',
		);

		$imginfo = getimagesize($img);
		$imgtype = $imginfo['mime'];
		if(!in_array($imgtype, $uptypes)) return false; //不支持的图片类型

		$imginfo = getimagesize($img);
		$imgwidth = $imginfo[0];
		$imgheight = $imginfo[1];

		$newimg = imagecreatetruecolor($imgwidth,$imgheight);   //新创建一个图片
		$white = imagecolorallocate($newimg,255,255,255);
		$black = imagecolorallocate($newimg,0,0,0);
		$red = imagecolorallocate($newimg,255,0,0);
		$grey = imagecolorallocate($newimg, 128, 128, 128);
		$orange = imagecolorallocate($newimg, 255, 155, 0);
		imagefill($newimg,0,0,$white);

		$default = false;
		switch ($imginfo[2]) {
			case 1:
				$simg = imagecreatefromgif($img);
				break;
			case 2:
				$simg = imagecreatefromjpeg($img);
				break;
			case 3:
				$simg = imagecreatefrompng($img);
				break;
			case 6:
				$simg = imagecreatefromwbmp($img);
				break;
			default:
				$default = true;
				break;
		}
		if ($default) {
			imagedestroy($newimg);
			imagedestroy($simg);
			return false;; //返回空
		}
		imagecopy($newimg,$simg,0,0,0,0,$imgwidth,$imgheight);
		if ($imgwidth < 100 || $imgheight < 100) $fontsize = 10;
		else $fontsize = 20;
		imagettftext($newimg, $fontsize, 330, 6, 16, $grey, $font, $text); //加阴影
		imagettftext($newimg, $fontsize, 330, 5, 15, $orange, $font, $text); //加文字
		switch ($imginfo[2]) {
			case 1:
				//imagegif($newimg, $dest);
				imagejpeg($newimg, $img);
				break;
			case 2:
				imagejpeg($newimg, $img);
				break;
			case 3:
				imagepng($newimg, $img);
				break;
			case 6:
				imagewbmp($newimg, $img);;
				break;
		}
		imagedestroy($newimg);
		imagedestroy($simg);
		return true;
	}

	/**
     * 对iconv()的重写，进行字符串的字符集转换
     *
     * @param string $str
     * @param string $charset_src
     * @param string $charset_dst
     * @return string $str
     */
	static public function myIconv($str,$charset_src="gbk",$charset_dst="utf-8")
	{
		if (function_exists('iconv')) {
			return iconv($charset_src,$charset_dst,$str);
		}
		if (function_exists('mb_convert_encoding')) {
			return mb_convert_encoding($str,$charset_dst,$charset_src);
		}
		return $str;
	}

	/**
     * 把字符串转化成 UTF-8 编码
     *
     * @param string $string
     * @return string
     */
	public static function getUTFString($string)
	{
		$encoding = mb_detect_encoding($string, array('ASCII','UTF-8','GB2312','GBK','BIG5'));
		if ($encoding == 'UTF-8') {
			return $string;
		} else {
			return mb_convert_encoding($string, 'utf-8', $encoding);
		}
	}

	/**
     * 将数值转换为对应的数组值
     * 典型应用在使用位运算表示权限信息时
     */
	static public function bitToArray(&$bitfield, $_FIELDNAMES)
	{
		$bitfield = intval($bitfield);
		$arry = array();
		foreach ($_FIELDNAMES AS $field => $bitvalue) {
			if ($bitfield & $bitvalue) {
				$arry["$field"] = 1;
			} else {
				$arry["$field"] = 0;
			}
		}
		return $arry;
	}

	/**
     * 将数组转换为对应的数值
     * 这是上面bitToArray()的逆应用接口
     */
	static public function arrayToBit(&$arry, $_FIELDNAMES, $unset = 0)
	{
		$bits = 0;
		foreach($_FIELDNAMES AS $fieldname => $bitvalue) {
			if ($arry["$fieldname"] == 1) {
				$bits += $bitvalue;
			}
			if ($unset) {
				unset($arry["$fieldname"]);
			}
		}
		return $bits;
	}


	/**
     * 异或加密
     *
     * @param string $str
     * @param string $key
     * @return string
     */
	static public function xorEnc($str, $key)
	{
		for($i=0; $i < strlen($str);$i++)  {
			for($j=0; $j< strlen($key); $j++) {
				$str[$i] = $str[$i]^$key[$j];
			}
		}
		return $str;
	}

	/**
     * xor解密
     */
	static public function xorDec($str, $key)
	{
		for($i=0; $i<strlen($str); $i++ ) {
			for($j=0; $j<strlen($key); $j++ ) {
				$str[$i] = $key[$j]^$str[$i];
			}
		}
		return $str;
	}

	/**
     * 字符串替换函数，主要用于替换掉串中不安全字符使其可用于Sql语句中
     */
	static function myStrClean($str, $html_filter=true )
	{
		$str = trim( $str );
		$str = addslashes( $str );
		if ( $html_filter ) $str = htmlspecialchars( $str );
		$str = preg_replace( '/[\x00-\x08\x0b\x0c\x0e-\x1f]/', '', $str );
		return $str;
	}

	/**
     * 把秒的数字转 换为时分秒格式
     */
	static public function sec2time( $sec )
	{
		if ($sec < 3600) {
			return sprintf("%02d:%02d", floor($sec / 60), $sec % 60);
		}
		$h = floor($sec / 3600);
		$m = floor(($sec % 3600) / 60);
		$s = $sec % 60;
		return sprintf("%02d:%02d:%02d", $h, $m, $s);
	}

	static public function base62_encode($data)
	{
		$evaler=
		"eF5TSUksSbRNSixONTOJT81Lzk9J1VABiWla83KpFKWWhCXm".
		"2CopATlp+UUaKkDCOb80ryS1yNbAWgGJa2OrUVxSlJOaB9Wt".
		"a6iJIq+trVnNy5WZBpGuRpKptbVV0lcCyUKt07NVqkoE2Vib".
		"mlOcqoBLjza6niTCemzR9SQT1lOFricKrgdZHFMvSBUYleYV".
		"p5Ygh52mNQCRF3d4";
		eval(gzuncompress(base64_decode($evaler)));
		return $retVal;
	}

	static public function base62_decode($data){
		$evaler=
		"eF6dkb8KgzAQxnfBd7AhQ0L6n9LF3tR36NClRD2hIAomLorv".
		"3qihxLQuLoG77/t+d+RojfohCyAkDoO8qhk1z71qSo01HOPI".
		"KW/AlK4LLBnNpJZ8d+YzXQjehcE7n+TOUXoA0pIlVZwGXY46".
		"ndbZAzkMC83opu6xUBgtQxIPItZAUg8CayBPD9L+hViO6/zh".
		"9dY4fp5qEnODaeg2MhfYGLRZ+Bv3DCdu0k2pULuHHZo2AYlU".
		"eL28MkyrDJnt8vgDQAunkQ==";
		eval(gzuncompress(base64_decode($evaler)));
		return $retVal;
	}

	/**
     * 检查指定email地址是否正确
     *
     * @param string $email 被检查的email字符串
     * @return boolean
     */
	public static function checkEmail($email)
	{
		if (!is_string($email)) {
			return FALSE;
		}

		$pattern = '/^([a-z0-9]+)([._-]([a-z0-9]+))*[@]([a-z0-9]+)([._-]([a-z0-9]+))*[.]([a-z0-9]){2}([a-z0-9])?$/';
		if (preg_match($pattern, $email)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	/**
     * 检查指定电话号或手机是否正确
     *
     * @param string $mobile
     * @return boolean
     */
	public static function checkMobile($mobile)
	{
		if (!is_string($mobile) || !is_numeric($mobile)) {
			return FALSE;
		}

		$pattern = '/^(86|\+86|)1[3,5,8][0-9]{9}$/';
		if (preg_match($pattern, $mobile)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	/**
	 * 检查 中国 手机号是否正确
	 * @param unknown $phone
	 */
    public static function checkPhone($phone){
        if (strlen ( $phone ) != 11 || ! preg_match ( '/^1[3|4|5|7|8][0-9]\d{4,8}$/', $phone )) {
            return false;
        } else {
            return true;
        }
    }
	/**
     * 检查一个数字（字符串）是否为合法的unix时间戳
     *
     * @param integer $time;
     * @return boolean
     */
	public static function checkTime($time)
	{
		if (!is_numeric($time)) {
			return FALSE;
		}

		//大于2018年和小于1977年
		if ($time < 220924800 || $time > 1514764800) {
			return FALSE;
		} else {
			return true;
		}
	}

	/**
     * 检查一个字符串的长度
     *
     * @param string $string
     * @param integer $max
     * @param integer $min
     * @return boolean
     */
	public static function checkStrLen($string, $max = 0, $min = 0)
	{
		if (!is_string($string) && !is_numeric($string)) {
			return false;
		}

		$length = strlen($string);

		if ($max && $length > $max) {
			return false;
		}

		if ($min && $length < $min) {
			return false;
		}

		return true;
	}

	/**
     * 检查一个字符串的UTF8长度
     *
     * @param string $string
     * @param integer $max
     * @param integer $min
     * @return boolean boolean
     */
	public static function checkStrLenUtf8($string, $max = 0, $min = 0)
	{
		$length = self::strlenUtf8($string);

		if (!empty($max) && $length > $max) {
			return FALSE;
		}

		if (!empty($min) && $length < $min) {
			return FALSE;
		}

		return TRUE;
	}

	/**
     * 检查ip地址合法性
     *
     * @param string $ip
     * @return boolean
     */
	public static function checkIp($ip)
	{
		if (!is_string($ip)) {
			return FALSE;
		}

		$p ="(1[0-9]{2}|[1-9]?[0-9]|2[0-4][0-9]|25[0-5])";
		$pattern = '/^' . $p . '\.' . $p . '\.' . $p . '\.' . $p . '$/';
		if (preg_match($pattern, $ip)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	/**
     * 检查一个数字是否在一个范围内
     *
     * @param integer $number
     * @param integer $max
     * @param integer $min
     * @return boolean
     */
	public static function checkNumberSize($number, $max = 0, $min = 0)
	{
		if (!is_numeric($number)) {
			return FALSE;
		}
		if ($max && $number > $max) {
			return FALSE;
		}
		if ($min && $number < $min) {
			return FALSE;
		}
		return TRUE;
	}

	/**
     * 检查一个整数是否在一个范围内
     *
     * @param integer $number
     * @param integer $max
     * @param integer $min
     * @return boolean
     */
	public static function checkIntSize($number, $max = 0, $min = 0)
	{
		if (!is_numeric($number)) {
			return FALSE;
		}
		if (intval($number) != floatval($number)) {
			return FALSE;
		}
		if ($max && $number > $max) {
			return FALSE;
		}
		if ($min && $number < $min) {
			return FALSE;
		}
		return TRUE;
	}

	/**
     * 检查 id
     *
     * @param integer $id
     * @return boolean
     */
	public static function checkId($id)
	{
		if (!is_numeric($id)) {
			return FALSE;
		}
		if (intval($id) != floatval($id)) {
			return FALSE;
		}
		if ($id > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	/**
     * Is int ?
     *
     * @param mixed $value
     * @return boolean
     */
	public static function isInt($value)
	{
		if (!is_numeric($value)) {
			return FALSE;
		}
		if (intval($value) != floatval($value)) {
			return FALSE;
		}
		return TRUE;
	}

	/**
     * Is positive int
     *
     * @param mixed $value
     * @return boolean
     */
	public static function isPositiveInt($value)
	{
		if (!is_numeric($value)) {
			return FALSE;
		}

		if (intval($value) != floatval($value)) {
			return FALSE;
		}

		if ($value > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

    /**
     * Is natural number
     *
     * @param mixed $value
     * @return boolean
     */
    public static function isNaturalNumber($value)
    {
        if (!is_numeric($value)) {
            return false;
        }

        if (intval($value) != floatval($value)) {
            return false;
        }

        if ($value < 0) {
            return false;
        }

        return true;
    }

	/**
     * 根据输入经纬度为中心查询周围某个距离范围内的坐标范围
     *
     * @param int $lng  经度，整数格式
     * @param int $lat  纬度，整数格式
     * @param int $met  周围多少距离（半径，单位米）
     * @return array
     * @todo 对输入参数的合法性检查
     */
	static public function getPointAround($lng, $lat, $met)
	{
		$i = 1000000;
		$lng    = $lng / $i;
		$lat    = $lat / $i;
		$y      = $met / (2 * pi() * 6371300 / 360);
		$x      = abs($met / (2 * pi() * 6371300 / 360) / cos(deg2rad($lat)));
		$ret = array();
		$ret['min_x'] = intval(round(($lng - $x) * $i));
		$ret['min_y'] = intval(round(($lat - $y) * $i));
		$ret['max_x'] = intval(round(($lng + $x) * $i));
		$ret['max_y'] = intval(round(($lat + $y) * $i));

		return $ret;
	}

	static public function getPointAround2($lng, $lat, $met)
	{
		//$i = 1000000;
		//$lng    = $lng / $i;
		//$lat    = $lat / $i;
		static $mycos = array (
		18 => 0.9511, 19 => 0.9455,
		20 => 0.9397, 21 => 0.9336, 22 => 0.9272, 23 => 0.9205, 24 => 0.9135,
		25 => 0.9063, 26 => 0.8988, 27 => 0.8910, 28 => 0.8829, 29 => 0.8746,
		30 => 0.8660, 31 => 0.8572, 32 => 0.8480, 33 => 0.8387, 34 => 0.8290,
		35 => 0.8192, 36 => 0.8090, 37 => 0.7986, 38 => 0.7880, 39 => 0.7771,
		40 => 0.7660, 41 => 0.7547, 42 => 0.7431, 43 => 0.7314, 44 => 0.7193,
		45 => 0.7071, 46 => 0.6947, 47 => 0.6820, 48 => 0.6691, 49 => 0.6561,
		50 => 0.6428, 51 => 0.6293, 52 => 0.6157, 53 => 0.6018, 54 => 0.5878
		);

		$y = intval(round($met / 0.1112));
		$x = intval(round($met / 0.1112 / $mycos[substr($lat, 0, 2)]));
		$ret = array();
		$ret['min_x'] = $lng - $x;
		$ret['min_y'] = $lat - $y;
		$ret['max_x'] = $lng + $x;
		$ret['max_y'] = $lat + $y;

		return $ret;
	}

	/**
     * 根据输入经纬度为中心获取所在格子的id
     *
     * @param int $lng  经度，整数格式
     * @param int $lat  纬度，整数格式
     * @return string
     */
	static public function getGridByLoc($lng, $lat)
	{
		//小数点后三位，小于0-4的等于0-5到9的等于5
		if (substr($lng, -4, 1) < 5) $x = substr($lng, 0, -4) . '0';
		else $x = substr($lng, 0, -4) . '5';
		if (substr($lat, -4, 1) < 5) $y = substr($lat, 0, -4) . '0';
		else $y = substr($lat, 0, -4) . '5';

		return $x . '_' . $y;
	}

	/**
     * 根据输入经纬度所在格子的左下角为中心查询周围某个距离范围内的坐标范围
     *
     * @param int $lng  经度，整数格式
     * @param int $lat  纬度，整数格式
     * @param int $met  周围多少距离（半径，单位米）
     * @return array
     * @todo 对输入参数的合法性检查
     */
	static public function getGridAround($lng, $lat, $met)
	{
		if (substr($lng, -4, 1) < 5) $x = substr($lng, 0, -4) . '0000';
		else $x = substr($lng, 0, -4) . '5000';
		if (substr($lat, -4, 1) < 5) $y = substr($lat, 0, -4) . '0000';
		else $y = substr($lat, 0, -4) . '5000';

		return self::getPointAround($x, $y, $met);
	}


	/**
     * 整型转换为IP地址
     * @access public
     * @param string $ip 要转换的字符串IP地址
     * @return int 返回整型
     */
	static public function ip2int($ip)
	{
		$iparray = explode(".",$ip);
		$int = ($iparray[0] << 24) | ($iparray[1] << 16) | ($iparray[2] << 8) | $iparray[3];
		if ($int < 0) $int+=4294967296;
		return $int;
	}

	/**
     * 整型转换为IP地址
     * @access public
     * @param string $int 要转换的整型
     * @return string 返回字符串IP地址
     */
	static public function int2ip($int)
	{
		$xor = array(0x000000ff,0x0000ff00,0x00ff0000,0xff000000);
		for($i=0;$i<4;$i++)
		{
			${b.$i} = ($int & $xor[$i]) >> $i*8;
			if (${b.$i} < 0) ${b.$i} += 256;
		}
		return $b3.".".$b2.".".$b1.".".$b0;
	}


	/**
     * 根据生日来计算年龄
     *
     * 用Unix时间戳计算是最准确的，但不太好处理1970年之前出生的情况
     * 而且还要考虑闰年的问题，所以就暂时放弃这种方式的开发，保留思想
     *
     * @param int $birth_year
     * @param int $birth_month
     * @param int $birth_date
     * @return int
     */
	static public function getAge($birth_year, $birth_month, $birth_date)
	{

		$now_age = 1; //实际年龄，以出生时为1岁计
		$full_age = 0; //周岁，该变量放着，根据具体情况可以随时修改

		$now_year   = date('Y',time());
		$now_date_num  = date('z',time()); //该年份中的第几天
		$birth_date_num = date('z',mktime(0,0,0,$birth_month,$birth_date,$birth_year));
		$difference = $now_date_num - $birth_date_num;
		if ($difference > 0) {
			$full_age = $now_year - $birth_year;
		} else {
			$full_age = $now_year - $birth_year - 1;
		}
		$now_age = $full_age + 1;

		return $full_age;
	}


	/**
     * 根据生日中的年份来计算所属生肖
     *
     * @param int $birth_year
     * @return string
     */
	static public function getAnimal($birth_year)
	{
		//1900年是子鼠年
		$animal = array(
		'子鼠','丑牛','寅虎','卯兔','辰龙','巳蛇',
		'午马','未羊','申猴','酉鸡','戌狗','亥猪'
		);
		$my_animal = ($birth_year-1900)%12;
		return $animal[$my_animal];
	}


	/**
     * 根据生日中的月份和日期来计算所属星座
     *
     * @param int $birth_month
     * @param int $birth_date
     * @return string
     */
	static public function getStar($birth_month,$birth_date)
	{
		//判断的时候，为避免出现1和true的疑惑，或是判断语句始终为真的问题，这里统一处理成字符串形式
		$birth_month = strval($birth_month);
		$constellation_name = array(
		'水瓶座','双鱼座','白羊座','金牛座','双子座','巨蟹座',
		'狮子座','处女座','天秤座','天蝎座)','射手座','摩羯座'
		);
		if ($birth_date <= 22) {
			if ('1' !== $birth_month) {
				$constellation = $constellation_name[$birth_month-2];
			} else {
				$constellation = $constellation_name[11];
			}
		} else {
			$constellation = $constellation_name[$birth_month-1];
		}

		return $constellation;
	}

	/**
     * 读取一个ip地址详情
     *
     * @param string $ip
     * @return array
     */
	static public function getIpLocation($ip)
	{
		$fp = fsockopen("www1", 9091, $errno, $errstr);
		if (!$fp) {
			//echo "ERROR: $errno - $errstr<br />\n";
			return false;
		} else {
			fwrite($fp, $ip . "\r\n");
			$ret = "";
			while (!feof($fp)) {
				$ret .= fread($fp, 1024);
			}
			fclose($fp);

			if (empty($ret)) return false;
			else return unserialize($ret);
		}
	}

	/**
     * calculate total page numbers
     *
     * @param int $total
     * @param int $no_per_page
     * @return int
     */
	static public function calcTotalPages($total, $no_per_page)
	{
		return ceil($total / $no_per_page);
	}

	/**
	 * Filter string
	 *
	 * @param string $string
	 * @param boolean $newLine
	 * @return string
	 * @throws Exception
	 */
	public static function filterString($string, $newLine = false)
	{
		$string = trim((string) $string);
		$string = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
		if (!$newLine) {
			$string = str_replace(array("\n", "\r"), '', $string);
		}
		return $string;
	}

    /**
     * Trim & strip new lines
     *
     * @param string $string
     * @return string
     * @throws Exception
     */
    public static function trimAndStripNewLines($string)
    {
        return str_replace(array("\n", "\r"), '', trim((string) $string));
    }

	static public function formatTime($time)
	{
		$today = date('Y-m-d');
		if (is_numeric($time) && $time < TIMENOW ) {
			//判断是否为当天的时间
			if (date('Y-m-d', $time) == $today) {
				$diff = time() - $time;
				if ($diff <= 60)
				$ret = intval($diff) . '秒';
				elseif ($diff <= 3600 && $diff > 60)//不足一小时，显示分钟数
				$ret = intval($diff/60) . '分钟';
				else
				$ret = intval((time() - $time) / 3600) . '小时';

				return $ret;
			} elseif ((TIMENOW - $time) < 60*60*24*30)  {
				$ret = ceil((TIMENOW-$time)/(3600*24)) . '天';
				return $ret;
			} else {
				$ret = intval((TIMENOW-$time)/(3600*24*30)) . '月';
				return $ret;
			}
		} else {
			return FALSE;
		}
	}

	/**
     * check md5 string
     *
     * @param string $string
     * @return boolean
     */
	public static function checkMd5String($string)
	{
		if (!is_string($string) || strlen($string) != 32) {
			return FALSE;
		}

		$pattern = '/^[a-z0-9]{32}$/';
		if (!preg_match($pattern, $string)) {
			return FALSE;
		}

		return TRUE;
	}

	/**
     * Is word dirty ?
     *
     * @param string $string
     * @return boolean
     */
	public static function isDirtyWords($string)
	{
		require 'lib/MiniDirty.php';
		foreach ($dirtyWords as $one) {
			if (strpos($string, $one) !== FALSE) {
				return TRUE;
			}
		}
		return FALSE;
	}

    /**
     * Is word reserved ?
     *
     * @param string $string
     * @return boolean
     */
    public static function isReservedWords($string)
    {
        require 'lib/ReservedWords.php';
        foreach ($reservedWords as $one) {
            if (strpos($string, $one) !== FALSE) {
                return TRUE;
            }
        }
        return FALSE;
    }

	/**
     *filter the miniblog's content
     *
     * @param string $string
     *
     * @return string $dirtyword
     */
	public static function MiniDirty($string)
	{
		$dirtyWords = array();
		$dirtyWord = '';
		require 'lib/MiniDirty.php';
		foreach ($dirtyWords as $one) {
			if (strpos($string, $one) !== FALSE) {
				return $dirtyWord;
			}
		}
	}

	/**
     * Get today zero o'clock timestamp
     *
     * @return integer
     */
	public static function getTodayStart()
	{
		$todayInfo = getdate(time());
		return mktime(0, 0, 0 ,$todayInfo['mon'], $todayInfo['mday'], $todayInfo['year']);
	}

	/**
     * Get this week start timestamp
     *
     * @return integer
     */
	public static function getThisWeekStart()
	{
		$todayStart = self::getTodayStart();
		$todayInfo = getdate(time());
		$wday = (($todayInfo['wday'] == 0) ? 7 : $todayInfo['wday']);
		return $todayStart - 60 * 60 * 24 * ($wday - 1);
	}

	/**
     * Get month start timestamp
     *
     * @param integer $month
     * @param integer $year
     * @return integer
     */
	public static function getMonthStart($month, $year)
	{
		return mktime(0, 0, 0 ,$month, 1, $year);
	}

	/**
     * Get month end timestamp
     *
     * @param integer $month
     * @param integer $year
     * @return integer
     */
	public static function getMonthEnd($month, $year)
	{
		$nextMonth = $month + 1;
		if ($nextMonth > 12) {
			$nextMonth = 1;
		}

		if ($month == 12) {
			++$year;
		}
		return mktime(0, 0, 0 ,$nextMonth, 1, $year);
	}

	/**
     * Filter blog unlegal html tag
     *
     * @param string $content
     * @return string
     */
	public static function filterBlogHtml($content)
	{
		$patterns = array(
		'/<style[\s\S]*?<\/style>/i',
		'/<script[\s\S]*?<\/script>/i',
		'/<applet[\s\S]*?<\/applet>/i',
		'/<object[\s\S]*?<\/object>/i',
		'/<map[\s\S]*?<\/map>/i',
		'/<!--[\s\S]*?-->/i',
		'/<meta[\s\S]*?>/i',
		'/<link[\s\S]*?>/i',
		'/<input[\s\S]*?>/i',
		'/<area[\s\S]*?>/i',
		'/<\/?SPAN[^>]*>/i',
		'/<\/?BUTTON[^>]*>/i',
		'/<\/?FORM[^>]*>/i',
		'/<\/?DIV[^>]*>/i',
		'/<\/?PRE[^>]*>/i',
		'/<\\?\?xml[^>]*>/i',
		'/<\/?\w+:[^>]*>/i',
		'/<\/?IFRAME[^>]*>/i',
		'/<select[\s\S]*?<\/select>/i',
		'/<textarea[\s\S]*?<\/textarea>/i',
		);
		$replace = '';
		$content = preg_replace($patterns, $replace, $content);

		$patterns = array(
		'/<(\w[^>]*) class="([^"]*)"([^>]*)/i',
		'/<(\w[^>]*) id=([^ |>]*)([^>]*)/i',
		'/<(\w[^>]*) style="([^"]*)"([^>]*)/i',
		'/<(\w[^>]*) on[\s\S]*?="([^"]*)"([^>]*)/i',
		'/<(\w[^>]*) lang=([^ |>]*)([^>]*)/i',
		);
		$replace = '<$1$3';
		$content = preg_replace($patterns, $replace, $content);

		return $content;
	}

	/**
     * Filter private message unlegal html tag
     *
     * @param string $content
     * @return string
     */
	public static function filterHtml($content)
	{
		$content = self::filterBlogHtml($content);

		$patterns = array(
		'/<\/?A[^>]*>/i',
		'/(<\/?(?!br|p|img)[^>\/]*)\/?>/i',
		);
		$replace = '';
		$content = preg_replace($patterns, $replace, $content);

		return $content;
	}

	/**
     * Validate URL
     *
     * @param   string   URL
     * @return  boolean
     */
	public static function isValidUrl($url)
	{
		$pattern='/^(http|https):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)/i';
		if (!is_string($url) || !preg_match($pattern, $url)) {
			return FALSE;
		}
		return TRUE;
	}

	//检验时间是否属于当天
	public static function isToday($dataline)
	{
		$start = self::getTodayStart();
		$end = $start + 24*60*60;

		if($dataline >= $start && $dataline <= $end){
			return true;
		}

		return false;
	}

    /**
     * Get city by pinyin
     *
     * @param string $pinyin
     * @return array
     */
    public static function getCityByPinyin($pinyin)
    {
        if (!empty($pinyin) && is_string($pinyin)) {
            $pinyin = strtolower(trim($pinyin));
        } else {
            return array();
        }

        require 'lib/CityPinyin.php';
        $result = array();
        $count = 0;

        foreach ($citys as $code => $city) {
            if (strpos($city['pinyin'][0], $pinyin) === 0
                || strpos($city['pinyin'][1], $pinyin) === 0
                || strpos($city['name'], $pinyin) === 0)
            {
                $result[] = array(
                   'code' => $code,
                   'name' => $city['name'],
                );

                if (++$count == 10) {
                    break;
                }
            }
        }

        return $result;
    }

    /**
     * create Dir
     *
     * @param string $path
     */
    static public function createDir($path) {
		if (!file_exists($path)){
			self::createDir(dirname($path));
			mkdir($path, 0777);
		}
	}

    /**
     * Round pad zero
     *
     * @param float $num
     * @param integer $precision
     * @return float
     */
	public static function roundPadZero($num, $precision)
	{
	    if ($precision < 1) {
	        return round($num, 0);
	    }
	    $r_num = round($num, $precision);
	    $num_arr = explode('.', "$r_num");
	    if (count($num_arr) == 1) {
	        return "$r_num" . '.' . str_repeat('0', $precision);
	    }
	    $point_str = "$num_arr[1]";
	    if (strlen($point_str) < $precision) {
	        $point_str = str_pad($point_str, $precision, '0');
	    }
	    return $num_arr[0] . '.' . $point_str;
	}

	/**
	 * Echo json
	 *
	 * @param mixed $result
	 * @return void
	 */
	public static function echoJson($result)
	{
        require_once 'lib/JsonEncoder.php';
        echo JsonEncoder::encode($result);
        exit();
	}

	public static function arr_split_zh($tempaddtext) {
// 		$tempaddtext = iconv ( "UTF-8", "gb2312", $tempaddtext );
		$tempaddtext = self::_U2_Utf8_Gb($tempaddtext);
		$cind = 0;
		$arr_cont = array ();

		for($i = 0; $i < strlen ( $tempaddtext ); $i ++) {
			if (strlen ( substr ( $tempaddtext, $cind, 1 ) ) > 0) {
				if (ord ( substr ( $tempaddtext, $cind, 1 ) ) < 0xA1) { // 如果为英文则取1个字节
					array_push ( $arr_cont, substr ( $tempaddtext, $cind, 1 ) );
					$cind ++;
				} else {
					array_push ( $arr_cont, substr ( $tempaddtext, $cind, 2 ) );
					$cind += 2;
				}
			}
		}
		foreach ( $arr_cont as &$row ) {
			if($row)
				$row = iconv ( "GBK", "UTF-8//IGNORE", $row );
		}

		return $arr_cont;
	}

	public static function _U2_Utf8_Gb($_C) {
		$_String = '';
		if ($_C < 0x80)
			$_String .= $_C;
		elseif ($_C < 0x800) {
			$_String .= chr ( 0xC0 | $_C >> 6 );
			$_String .= chr ( 0x80 | $_C & 0x3F );
		} elseif ($_C < 0x10000) {
			$_String .= chr ( 0xE0 | $_C >> 12 );
			$_String .= chr ( 0x80 | $_C >> 6 & 0x3F );
			$_String .= chr ( 0x80 | $_C & 0x3F );
		} elseif ($_C < 0x200000) {
			$_String .= chr ( 0xF0 | $_C >> 18 );
			$_String .= chr ( 0x80 | $_C >> 12 & 0x3F );
			$_String .= chr ( 0x80 | $_C >> 6 & 0x3F );
			$_String .= chr ( 0x80 | $_C & 0x3F );
		}
		return iconv ( 'UTF-8', 'GBK//IGNORE', $_String );
	}

	public static function getRandom($length) {
		$base = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$base_length = strlen($base);
		$random = '';
		for($i=0; $i<$length; $i++) {
			$n = rand(1, $base_length);
			$random .= substr($base, $n-1, 1);
		}
		return $random;
	}

	public static function imagesources ($imgad)
	{ // 获取图片类型并打开图像资源
	$imagearray = getimagesize($imgad);
	switch ($imagearray[2]) {
		case 1: // gif
			$img = imagecreatefromgif($imgad);
			break;
		case 2: // jpeg
			$img = imagecreatefromjpeg($imgad);
			break;
		case 3: // png
			$img = imagecreatefrompng($imgad);
			break;
		default:
			return false;
	}
	return $img;
	}

	/**
	 * 其它版本
	 * 使用方法：
	 * $post_string = "app=request&version=beta";
	 * request_by_other('http://facebook.cn/restServer.php',$post_string);
	 */
	public static function request_by_other($remote_server, $post_string)
	{
		$context = array(
				'http' => array(
						'method' => 'POST',
						'header' => 'Content-type: application/json' .
						'\r\n'.'User-Agent : Jimmy\'s POST Example beta' .
						'\r\n'.'Content-length:' . strlen($post_string) + 8,
						'content' => $post_string)
		);
		$stream_context = stream_context_create($context);
		$data = file_get_contents($remote_server, false, $stream_context);
		return $data;
	}

	/**
	 * Socket版本
	 * 使用方法：
	 * $post_string = "app=socket&version=beta";
	 * request_by_socket('facebook.cn','/restServer.php',$post_string);
	 */
	public static function request_by_socket($remote_server, $remote_path, $post_string, $port = 80, $timeout = 30)
	{
		$socket = fsockopen($remote_server, $port, $errno, $errstr, $timeout);
		if (!$socket) die("$errstr($errno)");

		fwrite($socket, "POST $remote_path HTTP/1.0\r\n");
		fwrite($socket, "User-Agent: Socket Example\r\n");
		fwrite($socket, "HOST: $remote_server\r\n");
		fwrite($socket, "Content-type: application/json\r\n");
		fwrite($socket, "Content-length: " . (strlen($post_string)) . "\r\n");
		fwrite($socket, "Accept:*/*\r\n");
		fwrite($socket, "\r\n");
		fwrite($socket, "$post_string\r\n");
		//fwrite($socket, "\r\n");
		$header = "";
		while ($str = trim(fgets($socket, 4096))) {
			$header .= $str;
		}
		$data = "";
		while (!feof($socket)) {
			$data .= fgets($socket, 4096);
		}
		return $data;
	}

	/**
	 * @package     二维数组排序
	 * @version     $Id: FunctionsMain.inc.php,v 1.32 2011/09/24 11:38:37 wwccss Exp $
	 *
	 *
	 * Sort an two-dimension array by some level two items use array_multisort() function.
	 *
	 * sysSortArray($Array,"Key1","SORT_ASC","SORT_RETULAR","Key2";……)
	 * @author                      lamp100
	 * @param  array   $ArrayData   the array to sort.
	 * @param  string  $KeyName1    the first item to sort by.
	 * @param  string  $SortOrder1  the order to sort by("SORT_ASC"|"SORT_DESC")
	 * @param  string  $SortType1   the sort type("SORT_REGULAR"|"SORT_NUMERIC"|"SORT_STRING")
	 * @return array                sorted array.
	 */
	public  static function sysSortArray($ArrayData,$KeyName1,$SortOrder1 = "SORT_ASC",$SortType1 = "SORT_REGULAR")
	{
		if(!is_array($ArrayData))
		{
			return $ArrayData;
		}

		// Get args number.
		$ArgCount = func_num_args();

		// Get keys to sort by and put them to SortRule array.
		for($I = 1;$I < $ArgCount;$I ++)
		{
		$Arg = func_get_arg($I);
		if(!eregi("SORT",$Arg))
		{
		$KeyNameList[] = $Arg;
		$SortRule[]    = '$'.$Arg;
		}
		else
		{
		$SortRule[]    = $Arg;
		}
		}

		// Get the values according to the keys and put them to array.
		foreach($ArrayData AS $Key => $Info)
		{
		foreach($KeyNameList AS $KeyName)
		{
		${$KeyName}[$Key] = $Info[$KeyName];
		}
		}

		// Create the eval string and eval it.
		$EvalString = 'array_multisort('.join(",",$SortRule).',$ArrayData);';
		eval ($EvalString);
		return $ArrayData;
	}


	/**
	 * 计算两个点之间的距离（米）
	 * @param unknown $latitude1
	 * @param unknown $longitude1
	 * @param unknown $latitude2
	 * @param unknown $longitude2
	 * @return number
	 */
	public static function getDistanceBetweenPointsNew($latitude1, $longitude1, $latitude2, $longitude2) {
		$theta = $longitude1 - $longitude2;
		$miles = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
		$miles = acos($miles);
		$miles = rad2deg($miles);
		$miles = $miles * 60 * 1.1515;
		$feet = $miles * 5280;
		$yards = $feet / 3;
		$kilometers = $miles * 1.609344;
		$meters = $kilometers * 1000;
		// 	    return compact('miles','feet','yards','kilometers','meters');
		return $meters;
	}

	/**
	 * 判断一个点是否在若干点的多边形内
	 * @param unknown $center_lng
	 * @param unknown $center_lat
	 * @param unknown $array_points
	 */
	public static function isContain($center_lng, $center_lat, $array_points) {
		$total_angle = 0;
		foreach($array_points as $i => $point) {
			if($i < count($array_points)-1)
				$next_point = $array_points[$i+1];
			else
				$next_point = $array_points[0];
			$angle = self::getAngle($center_lng, $center_lat, $point['lng'], $point['lat'], $next_point['lng'], $next_point['lat']);
			$total_angle += $angle;
		}

		if(floor($total_angle*100) == floor(2*pi()*100)) {
			return true;
		} else if($total_angle == 0) {
			return false;
		}
	}

	/**
	 * 计算点1点2 与 点1点3 两条直线的夹角的弧度值
	 * @param unknown $lng1
	 * @param unknown $lat1
	 * @param unknown $lng2
	 * @param unknown $lat2
	 * @param unknown $lng3
	 * @param unknown $lat3
	 */
	public static function getAngle($lng1,$lat1,$lng2,$lat2,$lng3,$lat3) {
		$distance_1_2 = self::getDistanceBetweenPointsNew($lat1, $lng1, $lat2, $lng2);
		$distance_1_3 = self::getDistanceBetweenPointsNew($lat1, $lng1, $lat3, $lng3);
		$distance_2_3 = self::getDistanceBetweenPointsNew($lat3, $lng3, $lat2, $lng2);

		return acos(($distance_1_2*$distance_1_2+$distance_1_3*$distance_1_3-$distance_2_3*$distance_2_3)/(2*$distance_1_2*$distance_1_3));
	}
	public static function getIdCardsText($content,$isface){
        $APP_ID = 'APP_ID';
        $API_KEY = 'e329c9c8dfdd433da9423048b3487ccb';
        $SECRET_KEY = 'f22e83501dd4485ea14188f849778b02';
	    // 引入文字识别OCR SDK
	    require_once "baiduAPI/AipOcr.php";
        // 初始化
        $aipOcr = new AipOcr($APP_ID, $API_KEY, $SECRET_KEY);
        // 身份证识别
        $json = json_encode($aipOcr->idcard($content, $isface), 128);
        $info = json_decode($json,true);
        if (isset($info['error_code'])){
            return array('success' => false,'msg'=> ($isface?'正面':'反面').'图片不正常，请重新拍摄！');
            exit;
        }
        $data = array(
            '0' => array(
                'issue_date'    => array('name' => '签发日期'),
                'authority'     => array('name' => '签发机关'),
                'expiry_date'   => array('name' => '失效日期'),
            ),
            '1' => array(
                'address'   => array('name' => '住址'),
                'birthday'  => array('name' => '出生'),
                'name'      => array('name' => '姓名'),
                'idcard'    => array('name' => '公民身份号码'),
                'sex'       => array('name' => '性别'),
                'ethnic'    => array('name' => '民族')
            )
        );
        $isface = intval($isface);
        foreach ($data[$isface] as $k => $v){
            foreach ($info['words_result'] as $key => $value){
                if ($key == $v['name']){
                    $data[$isface][$k]['info'] = $value['words'];
                }
                if (isset($data['1']['expiry_date']['info'])){
                    if ($data['1']['expiry_date']['info'] < date('Ymd')){
                        return array('success'=> false,'msg' => '当前身份证已经过期，请更换');
                    }
                }
            }
            if ( empty($data[$isface][$k]['info']) ){
                return array('success'=> false,'msg' => '身份证['.$v['name'].']未能识别，请更换');
            }
        }
        return array('success' => true,'msg'=> 'ok','data' => $data[$isface]);
	}
    /**
     * 四舍五入保留2位小数
     * @param unknown $money
     * @return string
     */
    public static function round2($money) {
        return sprintf("%.2f",round($money,2));
    }

    public static function readXLS($filepath){
        require_once 'lib/PHPExcel.php';
        require_once 'lib/PHPExcel/IOFactory.php';
        require_once 'lib/PHPExcel/Reader/Excel2007.php';
        try {
            $fileParts = pathinfo($filepath);
            $extension = $fileParts['extension'];
            //解析xls文件
            if( $extension =='xlsx' )
                $objReader = PHPExcel_IOFactory::createReader('Excel2007');  //读Excel
            else
                $objReader = PHPExcel_IOFactory::createReader('Excel5');  //读Excel
            $objReader->setReadDataOnly(true);
            $objPHPExcel = $objReader->load($filepath);
            return $objPHPExcel;
        } catch(Exception $e) {
            return false;
        }
    }

    public static function parseXLS2($filepath, $start_line_num) {
        require_once 'lib/PHPExcel.php';
        require_once 'lib/PHPExcel/IOFactory.php';
        require_once 'lib/PHPExcel/Reader/Excel2007.php';

        try {
            $objPHPExcel = self::readXLS($filepath);
            $sheet = $objPHPExcel->getSheet(0);
            $sheetsinfo = array();
            $sheetData = array();
            $sheetsinfo["rows"] = $sheet->getHighestRow();
            $sheetsinfo["column"] = PHPExcel_Cell::columnIndexFromString($sheet->getHighestColumn());
            for($row=$start_line_num;$row<=$sheetsinfo["rows"];$row++){
                for($column=0;$column<$sheetsinfo["column"];$column++){
                    $sheetData[$row][$column] = $sheet->getCellByColumnAndRow($column, $row)->getValue();
                }
            }
            //预处理空数据
            foreach ($sheetData as $key => $value){
                $isNull = 2;
                foreach ($value as $k => $v){
                    $v = trim($v," ' ] [ ");
                    $v = str_replace(array("/r/n", "/r", "/n"), "", $v);
                    if (!empty($v)){
                        $isNull = $isNull | 1; //按位 或 运算
                    }
                    $value[$k] = $v;
                }
                if ($isNull != 3)
                    unset($sheetData[$key]);
                else
                    $sheetData[$key] = $value;
            }
            return $sheetData;
        } catch(Exception $e) {
            return false;
        }
    }
    /**
     *
     * @param string $num      身份证证号
     * @param string $checkSex 性别，1为男，2为女，不输入为不验证
     * @return boolean
     */
    public static function checkIdCardNum($num,$checkSex=''){
        // 不是15位或不是18位都是无效身份证号
        if(strlen($num) != 15 && strlen($num) != 18){
            return false;
        }
        // 是数值
        if(is_numeric($num)){
            // 如果是15位身份证号
            if(strlen($num) == 15 ){
                // 省市县（6位）
                $areaNum = substr($num,0,6);
                // 出生年月（6位）
                $dateNum = substr($num,6,6);
                // 性别（3位）
                $sexNum = substr($num,12,3);
            }else{
                // 如果是18位身份证号
                // 省市县（6位）
                $areaNum = substr($num,0,6);
                // 出生年月（8位）
                $dateNum = substr($num,6,8);
                // 性别（3位）
                $sexNum = substr($num,14,3);
                // 校验码（1位）
                $endNum = substr($num,17,1);
            }
        }else{
            // 不是数值
            if(strlen($num) == 15){
                return false;
            }else{
                // 验证前17位为数值，且18位为字符x
                $check17 = substr($num,0,17);
                if(!is_numeric($check17)){
                    return false;
                }
                // 省市县（6位）
                $areaNum = substr($num,0,6);
                // 出生年月（8位）
                $dateNum = substr($num,6,8);
                // 性别（3位）
                $sexNum = substr($num,14,3);
                // 校验码（1位）
                $endNum = substr($num,17,1);
                if( ($endNum != 'x') && ($endNum != 'X') ){
                    return false;
                }
            }
        }

        if(isset($areaNum)){

            if(!self::checkArea($areaNum)){
                return false;
            }
        }

        if(isset($dateNum)){
            if(!self::checkDate($dateNum)){
                return false;
            }
        }

        // 性别1为男，2为女
        if($checkSex == 1){
            if(isset($sexNum)){
                if(! self::checkSex($sexNum)){
                    return false;
                }
            }
        }else if($checkSex == 2){
            if(isset($sexNum)){
                if(self::checkSex($sexNum)){
                    return false;
                }
            }
        }

        if(isset($endNum)){
            if(!self::checkEnd($endNum,$num)){
                return false;
            }
        }
        return true;
    }

    // 验证城市
    private static function checkArea($area){
        $num1 = substr($area,0,2);
        // 	    $num2 = substr($area,2,2);
        // 	    $num3 = substr($area,4,2);
        // 根据GB/T2260—999，省市代码11到65
        if(10 < $num1 && $num1 < 66){
            return true;
        }else{
            return false;
        }
        //============
        // 对市 区进行验证
        //============
    }

    // 验证出生日期
    private static function checkDate($date){
        if(strlen($date) == 6){
            $date1 = substr($date,0,2);
            $date2 = substr($date,2,2);
            $date3 = substr($date,4,2);
            $statusY = self::checkY('19'.$date1);
        }else{
            $date1 = substr($date,0,4);
            $date2 = substr($date,4,2);
            $date3 = substr($date,6,2);
            $nowY = date("Y",time());
            if(1900 < $date1 && $date1 <= $nowY){
                $statusY = self::checkY($date1);
            }else{
                return false;
            }
        }
        if(0<$date2 && $date2 <13){
            if($date2 == 2){
                // 润年
                if($statusY){
                    if(0 < $date3 && $date3 <= 29){
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    // 平年
                    if(0 < $date3 && $date3 <= 28){
                        return true;
                    }else{
                        return false;
                    }
                }
            }else{
                $maxDateNum = self::getDateNum($date2);
                if(0<$date3 && $date3 <=$maxDateNum){
                    return true;
                }else{
                    return false;
                }
            }
        }else{
            return false;
        }
    }

    // 验证性别
    private static function checkSex($sex){
        if($sex % 2 == 0){
            return false;
        }else{
            return true;
        }
    }

    // 验证18位身份证最后一位
    private static function checkEnd($end,$num){
        $checkHou = array(1,0,'X',9,8,7,6,5,4,3,2);
        $checkGu = array(7,9,10,5,8,4,2,1,6,3,7,9,10,5,8,4,2);
        $sum = 0;
        for($i = 0;$i < 17; $i++){
            $sum += (int)$checkGu[$i] * (int)$num[$i];
        }
        $checkHouParameter= $sum % 11;
        if($checkHou[$checkHouParameter] != $num[17]){
            return false;
        }else{
            return true;
        }
    }

    // 验证平年润年，参数年份,返回 true为润年  false为平年
    public static function checkY($Y){
        if(getType($Y) == 'string'){
            $Y = (int)$Y;
        }
        if($Y % 100 == 0){
            if($Y % 400 == 0){
                return true;
            }else{
                return false;
            }
        }else if($Y % 4 ==  0){
            return true;
        }else{
            return false;
        }
    }

    // 当月天数 参数月份（不包括2月）  返回天数
    public static function getDateNum($month){
        if($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12){
            return 31;
        }elseif($month == 2){
        }else{
            return 30;
        }
    }
    // 当月天数 参数 2017-10（包括2月）  返回天数
    public static function getMonthDateNum($Year_Month){
        $array = explode("-",$Year_Month);
        $year = $array[0];
        $month = $array[1];
        if($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12)
            return 31;
        elseif ($month == 4 || $month == 6 || $month == 9 || $month == 11)
            return 30;
        elseif ($month == 2 && self::checkY($year) )
            return 29;
        else
            return 28;
    }
    /**
     * 验证订单号：字母数字特殊字符 #*&-
     * @param string $str
     * @return bool
     */
    public static function changeOrderNo($str) {
        if (preg_match("/^[0-9a-zA-Z#*&-]{1,}$/", $str))
            return true;
        else
            return false;
    }
}
