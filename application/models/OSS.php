<?php
require_once 'lib/alioss/autoload.php';
use OSS\OssClient;
use OSS\Core\OssException;
require_once 'lib/CommonFuncs.php';
/**
 * OSS
 * @author llx
 */
//class OSS extends WebBaseController {
class OSS {
    /**
     * Get instance
     *
     * @param boolean $cli
     * @return SystemAccount
     */
    public static function getInstance($cli = false)
    {
        if (empty(self::$instance)) {
            self::$instance = new self($cli);
        }
        return self::$instance;
    }
    /**
     * 图片上传
     * @param string $file_path 文件在服务器的路径
     * @param string $oss_file_name 文件在OSS的路径
     * @return array
     */
    public function putObjectImg($file_path,$oss_file_name)
    {
        $ossClient = new OssClient(OSS_ACCESS_KEY_ID, OSS_ACCESS_KEY_SECRET, OSS_END_POINT_IMG,true);
        $content = file_get_contents($file_path);
        try{
            $ossClient->putObject(OSS_BUCKET_IMG, $oss_file_name, $content);
        } catch(OssException $e) {
            return array('success'=>false,'msg'=>$e->getMessage());
        }
        return array('success'=>true);
    }
    /**
     * 二进制图片上传
     * @param binary $content 二进制数据
     * @param unknown $oss_file_name
     * @return array
     */
    public function putBinaryImg($content,$oss_file_name){
        $ossClient = new OssClient(OSS_ACCESS_KEY_ID, OSS_ACCESS_KEY_SECRET, OSS_END_POINT_IMG,true);
        try{
            $ossClient->putObject(OSS_BUCKET_IMG, $oss_file_name, $content);
        } catch(OssException $e) {
            return array('success'=>false,'msg'=>$e->getMessage());
        }
        return array('success'=>true);
    }
    /**
     * 文件上传
     * @param string $file_path 文件在服务器的路径
     * @param string $oss_file_name 文件在OSS的路径
     * @return array
     */
    public function putObjectFile($file_path,$oss_file_name)
    {
        $ossClient = new OssClient(OSS_ACCESS_KEY_ID, OSS_ACCESS_KEY_SECRET, OSS_END_POINT_FILE,true);
        $content = file_get_contents($file_path);
        try{
            $ossClient->putObject(OSS_BUCKET_FILES, $oss_file_name, $content);
        } catch(OssException $e) {
            return array('success'=>false,'msg'=>$e->getMessage());
        }
        return array('success'=>true);
    }
    /**
     * 二进制文件上传
     * @param binary $content 二进制数据
     * @param string $oss_file_name 文件在OSS的路径
     * @return array
     */
    public function putBinaryFile($content,$oss_file_name){
        $ossClient = new OssClient(OSS_ACCESS_KEY_ID, OSS_ACCESS_KEY_SECRET, OSS_END_POINT_FILE,true);
        try{
            $ossClient->putObject(OSS_BUCKET_FILES, $oss_file_name, $content);
        } catch(OssException $e) {
            return array('success'=>false,'msg'=>$e->getMessage());
        }
        return array('success'=>true);
    }
    /**
     * 获取文件内容
     * @param string $oss_file_name 文件在OSS的路径
     * @return array
     */
    public function getObject($oss_file_name)
    {
        $ossClient = new OssClient(OSS_ACCESS_KEY_ID, OSS_ACCESS_KEY_SECRET, 'ymg360-files.oss-cn-hangzhou.aliyuncs.com',true);
        $options = array();
        try{
            $content = $ossClient->getObject(OSS_BUCKET_FILES, $oss_file_name, $options);
            return array('success'=>true,'msg'=>'OK','data'=>$content);
        } catch(OssException $e) {
            return array('success'=>false,'msg'=>$e->getMessage() );
        }
    }
    /**
     * 获取图片的内容
     * 仅限 图片 文件；
     * @param string $oss_file_name 文件在OSS的路径
     * @return array
     */
    public function getImgObject($object){
        $ossClient = new OssClient(OSS_ACCESS_KEY_ID, OSS_ACCESS_KEY_SECRET, OSS_END_POINT_IMG,true);
        $options = array();
        try{
            $content = $ossClient->getObject(OSS_BUCKET_IMG, $object, $options);
            return array('success'=>true,'msg'=>'OK','data'=>$content);
        } catch(OssException $e) {
            return array('success'=>false,'msg'=>$e->getMessage() );
        }

    }
    /**
     * Instance
     *
     * @var SystemAccount
     */
    private static $instance = NULL;
}
?>