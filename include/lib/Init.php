<?php
define ( 'ENV_LOCAL', 1 ); // 内网环境
define ( 'ENV_DEVEL', 2 ); // 测试环境（初步判断条件为Windows,NT开头的域名访问）
define ( 'ENV_OUTER', 4 ); // 外网生产环境，正常访问环境

ini_set ( 'memory_limit', '-1' );
ini_set ( 'date.timezone', 'Asia/Shanghai' );


if(isset($_SERVER['HTTP_HOST'])) {
    if ($_SERVER['HTTP_HOST'] == 'yl.codeboxs.com'){
        //正式环境
        define ( 'DOMAIN', 'yl.codeboxs.com' );
        define ( 'DB_USERNAME', 'default' );
        define ( 'DB_PASSWORD', '123abc!@#' );
        define ( 'DB_DBNAME', 'yl' );
    } else {
        //正式环境
        define ( 'DOMAIN', 'www.yl.com' );
        define ( 'DB_USERNAME', 'root' );
        define ( 'DB_PASSWORD', '123abc!@#' );
        define ( 'DB_DBNAME', 'yl' );
    }

}
define ( 'DB_SERVERNAME', '127.0.0.1' );

define ( 'SYSTEM_PATH', dirname ( __FILE__ ) );
define ( 'BASE_DIR', substr ( SYSTEM_PATH, 0, - 11 ) );

define ( 'WEB_BASE_URL', 'http://' . DOMAIN . '/' );
define ( 'IMG_BASE_URL', 'http://' . DOMAIN . '/' );

define ( 'WEB_IMG_BASE_URL', IMG_BASE_URL );
define ( 'LOG_DIR', BASE_DIR . 'logs/' );
define ( 'DATA_DIR', BASE_DIR . 'datafile/' );
define ( 'INCLUDE_DIR', BASE_DIR . 'include/' );
define ( 'LIB_DIR', BASE_DIR . 'include/lib/' );
define ( 'APP_DIR', BASE_DIR . 'application/' );
define ( 'CTRL_DIR', BASE_DIR . 'application/controllers/' );
define ( 'MODEL_DIR', BASE_DIR . 'application/models/' );
define ( 'VIEW_DIR', BASE_DIR . 'application/views/admin/' );
define ( 'WAP_VIEW_DIR', BASE_DIR . 'application/views/wap/' );
define ( 'WEIXIN_VIEW_DIR', BASE_DIR . 'application/views/wx/' );
define ( 'YC_VIEW_DIR', BASE_DIR . 'application/views/yc/' );
define ('UPLOAD_DIR', BASE_DIR . 'uploads/');
define ('PUBLIC_DIR', BASE_DIR . 'public/');




set_include_path ( get_include_path () . PATH_SEPARATOR . INCLUDE_DIR );
set_include_path ( get_include_path () . PATH_SEPARATOR . MODEL_DIR );

