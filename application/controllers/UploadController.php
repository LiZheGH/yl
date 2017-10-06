<?php
require_once CTRL_DIR . 'WebBaseController.php';
require_once 'lib/CommonFuncs.php';
class UploadController extends WebBaseController
{
    /**
     * @var BaseDbFile
     */
    protected $baseDbFile;
    /**
     *
     * @var BaseFileID
     */
    protected $baseFileID;
    /**
     *
     * @var StoreGoods
     */
    protected $storeGoods;
    /**
     *
     * @var BaseSku
     */
    protected $baseSku;
    /**
     *
     * @var OrderPackage
     */
    protected $orderPackage;
    /**
     *
     * @var PartnerOrderPackage
     */
    protected $partnerOrderPackage;
    /**
     *
     * @var Order
     */
    protected $order;
    /**
     *
     * @var PartnerOrder
     */
    protected $partnerOrder;
    /**
     *
     * @var OSS
     */
    protected $oSS;
    /**
     *
     * @var User
     */
    protected $user;
    /**
     *
     * @var OssUpload
     */
    protected $ossUpload;
    /**
     *
     * @var OrderPackageGoods
     */
    protected $orderPackageGoods;
    /**
     *
     * @var PartnerOrderPackageGoods
     */
    protected $partnerOrderPackageGoods;
    /**
     *
     * @var insurance
     */
    protected $insurance;
    /**
     *
     * @var ApiAccount
     */
    protected $apiAccount;
    /**
     *
     * @var Brand
     */
    protected $brand;
    /**
     *
     * @var WuliuOrder
     */
    protected $wuliuOrder;
    /**
     *
     * @var WuliuGoods
     */
    protected $wuliuGoods;
    /**
     *
     * @var ApiInsurance
     */
    protected $apiInsurance;
    /**
     *
     * @var Stocking
     */
    protected $stocking;
    public function __construct($params = array()){
        parent::__loadModels();
        $this->__initWebAccountInfo ();
        parent::__construct ( $params );
        if($this->__getParam('PHPSESSID') && ($session_id=$this->__getParam('PHPSESSID')) !=session_id()){
            $this->__log('sessonid', $this->__getParam('PHPSESSID'));
            session_destroy();
            session_id($session_id);
            session_start();
            setcookie('PHPSESSID', $session_id, 0);
            $this->curUser = isset($_SESSION['trader_account']) ? $_SESSION['trader_account'] : array();
        } else {
            $this->curUser = isset($_SESSION['trader_account']) ? $_SESSION['trader_account'] : array();
        }
    }
    //图片文件上传
    function uploadifyImgAction(){
        $mobile = $this->curUser['mobile'];
        if (empty($_FILES))
            $this->__ajaxReturn(false, '文件丢失');

        $tempFile = $_FILES['Filedata']['tmp_name'];
        //echo $tempFile;exit;
        $fileParts = pathinfo($_FILES['Filedata']['name']);

        $data = array();
        $data['original_name']  = addslashes($_FILES['Filedata']['name']); //客户端文件的原名称
        $data['mime_type']  = mime_content_type($tempFile); //文件的 MIME类型，需要浏览器提供该信息的支持，例如"image/gif"
        $data['file_size']  = $_FILES['Filedata']['size']; //已上传文件的大小，单位为字节
        $imgTypes = array('jpg','jpeg','gif','png','bmp'); // File extensions
        $data['file_ext'] = $fileParts['extension'];

        if (!in_array(strtolower($data['file_ext']),$imgTypes))
            $this->__ajaxReturn(false, '请上传图片！');

        $data['file_name'] = date('Ym')."/".date('d')."/".date('H')."/".CommonFuncs::getUUID().".".$data['file_ext'];
        //上传到OSS
        $res = $this->oSS->putObjectImg($tempFile, $data['file_name']);

        if (!$res['success']){
            $this->__ajaxReturn(false, $res['msg']);
        } else {
            //写文件表
            $file_id = $this->baseFileID->getMaxId();
            //文件存表
            $fileAddData = array(
                'id'            => $file_id,
                'ctime'         => date('Y-m-d H:i:s'),
                'file_name'     => $data['file_name'],
                'original_name' => $data['original_name'],
                'mime_type'     => $data['mime_type'],
                'file_size'     => $data['file_size'],
                'file_ext'      => $data['file_ext'],
                'file_owner'    => $mobile,
                'is_img'        => 1,//是否图片
            );
            $dbId = CommonFuncs::calc_hash_db($file_id);
            $res = $this->baseDbFile->add($dbId,$fileAddData);
            if ($res){
                $fileInfo = array(
                    'id'        => $file_id,
                    'file_name' => trim($data['original_name']),
                    'file_url'  => OSS_IMG_URL.$data['file_name'],
                    'file_size' => $data['file_size'],
                    'file_ext'  => $data['file_ext'],
                    'mime_type' => $data['mime_type'],
                );
                $this->__ajaxReturn(true, '上传成功',$fileInfo);
            } else
                $this->__ajaxReturn(false, '文件存储失败');
        }
    }
    //插件上传图片
    function uploadKindeDitorImgAction(){

        //$this->__ajaxCheckUserLogin();
        $mobile = $this->curUser['mobile'];
        if (empty($_FILES))
            $this->__displayOutput(array('error' => 1, 'message' => '文件丢失'));

        $tempFile = $_FILES['imgFile']['tmp_name'];
        //echo $tempFile;exit;
        $fileParts = pathinfo($_FILES['imgFile']['name']);

        $data = array();
        $data['original_name']  = addslashes($_FILES['imgFile']['name']); //客户端文件的原名称
        $data['mime_type']  = mime_content_type($tempFile); //文件的 MIME类型，需要浏览器提供该信息的支持，例如"image/gif"
        $data['file_size']  = $_FILES['imgFile']['size']; //已上传文件的大小，单位为字节
        $imgTypes = array('jpg','jpeg','gif','png','bmp'); // File extensions
        $data['file_ext'] = $fileParts['extension'];

        if (!in_array(strtolower($data['file_ext']),$imgTypes))
            $this->__displayOutput(array('error' => 1, 'message' => '请上传图片！'));

        $data['file_name'] = date('Ym')."/".date('d')."/".date('H')."/".CommonFuncs::getUUID().".".$data['file_ext'];
        //上传到OSS
        $res = $this->oSS->putObjectImg($tempFile, $data['file_name']);

        if (!$res['success']){
            $this->__displayOutput(array('error' => 1, 'message' => $res['msg']));
        } else {
            //写文件表
            $file_id = $this->baseFileID->getMaxId();
            //文件存表
            $fileAddData = array(
                'id'            => $file_id,
                'ctime'         => date('Y-m-d H:i:s'),
                'file_name'     => $data['file_name'],
                'original_name' => $data['original_name'],
                'mime_type'     => $data['mime_type'],
                'file_size'     => $data['file_size'],
                'file_ext'      => $data['file_ext'],
                'file_owner'    => $mobile,
                'is_img'        => 1,//是否图片
            );
            $dbId = CommonFuncs::calc_hash_db($file_id);
            $res = $this->baseDbFile->add($dbId,$fileAddData);
            if ($res){
                echo json_encode(array('error'=> 0 ,'url' => OSS_IMG_URL.$data['file_name']));
                exit;
            } else
                $this->__displayOutput(array('error' => 1, 'message' => '文件存储失败'));
        }
    }

    //文件上传
    function uploadifyFileAction(){
       // $this->__ajaxCheckUserLogin();
        $mobile = $this->curUser['mobile'];
        if (empty($_FILES))
            $this->__ajaxReturn(false, '文件丢失');

        $tempFile = $_FILES['Filedata']['tmp_name'];
        //echo $tempFile;exit;
        $fileParts = pathinfo($_FILES['Filedata']['name']);

        $data = array();
        $data['original_name']  = $_FILES['Filedata']['name']; //客户端文件的原名称
        $data['mime_type']  = mime_content_type($tempFile); //文件的 MIME类型，需要浏览器提供该信息的支持，例如"image/gif"
        $data['file_size']  = $_FILES['Filedata']['size']; //已上传文件的大小，单位为字节
        $trueTypes = array('jpg','jpeg','gif','png','bmp','xls','xlsx','doc','docs','pdf');
        $imgTypes = array('jpg','jpeg','gif','png','bmp'); // File extensions
        $data['file_ext'] = $fileParts['extension'];

        if (!in_array(strtolower($data['file_ext']),$trueTypes))
            $this->__ajaxReturn(false, '数据格式不支持');

        $isimg = false;
        if(in_array(strtolower($data['file_ext']),$imgTypes))
            $isimg = true;

        $data['file_name'] = date('Ym')."/".date('d')."/".date('H')."/".CommonFuncs::getUUID().".".$data['file_ext'];
        $res = $this->oSS->putObjectFile($tempFile, $data['file_name']);
        if (!$res['success']){
            $this->__ajaxReturn(false, $res['msg']);
        } else {
            //写文件表
            $file_id = $this->baseFileID->getMaxId();
            //文件存表
            $fileAddData = array(
                'id'            => $file_id,
                'ctime'         => date('Y-m-d H:i:s'),
                'file_name'     => $data['file_name'],
                'original_name' => $data['original_name'],
                'mime_type'     => $data['mime_type'],
                'file_size'     => $data['file_size'],
                'file_ext'      => $data['file_ext'],
                'file_owner'    => $mobile,
                'is_img'        => $isimg,//是否图片
            );
            $dbId = CommonFuncs::calc_hash_db($file_id);
            $res = $this->baseDbFile->add($dbId,$fileAddData);
            if ($res){
                $fileInfo = array(
                    'id'        => $file_id,
                    'file_name' => trim($data['original_name']),
                    'file_url'  => $fileAddData['file_name'],
                    'file_size' => $data['file_size'],
                    'file_ext'  => $data['file_ext'],
                    'mime_type' => $data['mime_type'],
                );
                $this->__ajaxReturn(true, '上传成功',$fileInfo);
            } else
                $this->__ajaxReturn(false, '文件存储失败');
        }
    }
//批量添加商品-上传EXCEL
    public function ajaxBatchAddGoodsAction(){
        $userInfo = $this->user->getOne($this->curUser['id']);
        if (empty($userInfo))
            $this->__ajaxReturn(false, '请登录！');
        $trader_id    = $userInfo['id'];
        $mobile= $userInfo['mobile'];
        if (empty($_FILES))
            $this->__ajaxReturn(false,'文件丢失！');

        $tempFile  = $_FILES['Filedata']['tmp_name'];
        $fileParts = pathinfo($_FILES['Filedata']['name']);
        $data = array(
            'file_ext'     => $fileParts['extension'],
            'original_name'=> $_FILES['Filedata']['name'], //客户端文件的原名称
            'mime_type'    => mime_content_type($_FILES['Filedata']['tmp_name']), //文件的 MIME类型，需要浏览器提供该信息的支持，例如"image/gif"
            'file_size'    => $_FILES['Filedata']['size'], //已上传文件的大小，单位为字节
        );
        if ($data['file_ext'] != 'xlsx')
            $this->__ajaxReturn(false,'请上传系统提供模板！');
        //将文件移到缓存
        $targetPath = '/var/tmp/';
        $this->MkFolder($targetPath);
        $targetFile = rtrim($targetPath,'/').'/'.CommonFuncs::getUUID(). '.' . $fileParts['extension'];
        move_uploaded_file($tempFile,$targetFile);
        //解析xls文件
        $xls_data = CommonFuncs::parseXLS2($targetFile, 2);
        if(!$xls_data || !is_array($xls_data))
            $this->__ajaxReturn(false, '文件解析失败，请检查文件内容！');
        //初始化数据
        $goodsList = $skusArr = $errorData = array();
        //商品分类
        $allGoodsClassArr = $this->baseSku->getIdSkuNameArr();
        $allSkuArr = array_keys($this->storeGoods->getAllSkuKeyInfoByTraderId($trader_id));
        //产品模板库
//         $allBrandArr = array_merge(array('无'),$this->brand->getNameArr());
        //A-YZ;
        $rowsKey = array();
        for ($i = 'a'; $i <= 'z'; ++$i) {
        	$rowsKey[] =  strtoupper($i);
        }
        if (count($xls_data) > 2000)
            $this->__ajaxReturn(false, "文件过大超过2000条！");
        //整理数据
        foreach($xls_data as $rows => $line) {
            //验证空值
            $title = "";
            $tmpTitle = "第".($rows)."行,";
            foreach ($line as $k => $val){
                if ($k > 19) break;
                $val = trim($val);
                //分别代表： 货号 规格型号 保质期 重量 体积 市场价 发货省份 发货城市 商品说明
                if (in_array($k, array(4,6,8,10,11,15,17,18,19)))
                    continue;
                if (empty($val) || is_null($val)){
                    if (empty($title)){
                        $title = $tmpTitle."第 ".$rowsKey[$k];
                        $tmpTitle = "";
                    } else {
                        $title .= ",".$rowsKey[$k];
                    }
                }
            }
            if (!empty($title))
                $title .= "列 存在必填空值  ,";
            //验证商品分类
            $goods_class = trim($line['1']);
            if (!in_array($goods_class, $allGoodsClassArr)){
                $title .= $tmpTitle."第 ".$rowsKey['1']."列 商品分类错误,";
                $tmpTitle = "";
            }
//             //验证品牌库
//             if (!in_array($line['2'], $allBrandArr)){
//                 $title .= $tmpTitle."第 ".$rowsKey['2']."列 商品品牌不存在,";;
//                 $tmpTitle = "";
//             }
            //验证库存 数值
            if ($line['13'] <= 0){
                $title .= $tmpTitle."第 ".$rowsKey['13']."列 商品数量错误,";;
                $tmpTitle = "";
            }
            //验证分销价格
            if ($line['14'] <= 0) {
                $title .= $tmpTitle."第 ".$rowsKey['14']."列 商品价格错误,";
                $tmpTitle = "";
            }
            $sku = trim($line['12']);
            if (!empty($sku)){
                $tmp_sku = "YM" . $this->curUser['SKU_KEY'] . "_" . $sku;
                //验证重复
                if (in_array($tmp_sku, $allSkuArr)){
                    $title .= $tmpTitle."第 ".$rowsKey['12']."列 商家自编码 存在,";
                    $tmpTitle = "";
                }
                if (in_array($tmp_sku, $skusArr)){
                    $title .= $tmpTitle."第 ".$rowsKey['12']."列 商家自编码 重复添加,";
                    $tmpTitle = "";
                } else
                    $skusArr[] = $sku;
            } else {
                $title .= $tmpTitle."第 ".$rowsKey['12']."列 缺少 商家自编码,";
                continue;
            }
            //验证 业务模式 和 发货国家
            $trade_type = intval($this->__getParam('trade_type'));
            if (
                   (
                        in_array($trade_type, array(1,2))
                     && $line['16'] == '中国'
                     && $line['17'] != '香港'
                     && $line['17'] != '澳门'
                     && $line['17'] != '台湾'
                    )
                 || (
                     !in_array($trade_type, array(1,2))
                    && $line['16'] != '中国'
                   )
            )
                $title .= $tmpTitle."第 ".$rowsKey['14']."列 发货国家与业务模式不符,";
            //商品信息
            //商品名称	规格型号	商品SKU	库存数量	分销单价（元）	图片信息
            $goodsList[] = array(
                'goods_logo'        => trim($line['2']),
                'goods_name'        => trim($line['3']),
                'goods_barcode'     => trim($line['5']),
                'goods_model'       => trim($line['6']),
                'goods_madein'      => trim($line['7']),
                'goods_unit'        => trim($line['9']),
                'goods_sku'         => $sku,
                'goods_count'       => intval($line['13']),
                'retail_price'      => sprintf("%.2f",round($line['14'],2)),
                'country'           => trim($line['16']),
                'province'          => trim($line['17']),
                'city'              => trim($line['18']),
            );
            if ($title)
                $errorData[$rows] = trim($title,",");
        }
        if (!empty($errorData)){
            $error_info = implode('<hr>', $errorData);
            $error_info .= '<hr> 共计<font color="red">'.count($errorData).'</font>处 错误！请修改后提交！';
            $this->__ajaxReturn(false, $error_info);
        }
        if (empty($goodsList)){
            $this->__ajaxReturn(false,"文件解析失败，缺少商品信息！");
        }
        //上传到OSS
        $data['file_name'] = date('Ym')."/".date('d')."/".date('H')."/".CommonFuncs::getUUID().".".$data['file_ext'];
        $res = $this->oSS->putObjectFile($targetFile, $data['file_name']);
        //删除文件
        @unlink($targetFile);
        if (!$res['success'])
            $this->__ajaxReturn(false, $res['msg']);
        $file_id   = $this->baseFileID->getMaxId();
        //文件存表
        $fileAddData = array(
            'id'            => $file_id,
            'ctime'         => date('Y-m-d H:i:s'),
            'file_name'     => $data['file_name'],
            'original_name' => $data['original_name'],
            'mime_type'     => $data['mime_type'],
            'file_size'     => $data['file_size'],
            'file_ext'      => $data['file_ext'],
            'file_owner'    => $mobile,
            'is_img'        => 0,//是否图片
        );
        $res  = $this->baseDbFile->add(CommonFuncs::calc_hash_db($file_id),$fileAddData);
        if (!$res)
            $this->__ajaxReturn(false,'文件存储失败！');

        $resArr = array(
            'file_info'   => array(
                'id'        => $file_id,
                'file_name' => $fileAddData['original_name'],
                'file_url'  => $fileAddData['file_name']
            ),
            'goods_list'  => $goodsList,
        );
        $this->__ajaxReturn(true,'上传成功',$resArr);
    }
    /**
//批量添加商品-上传图片
     * 文件解压 并 存库
     * @param   file_id;
     * @return  array(
     *              goods_sku1 => array(file_id1 => info ,file_id2 => info,...),
     *              goods_sku2 => array(file_id3 => info ,file_id4 => info,...),
     *              ...
     *          );
     */
    function unzipAction(){
        set_time_limit(0);
        //$this->__ajaxCheckUserLogin();
        $mobile = $this->curUser['mobile'];
        //先解析SKU
        $file_id     = intval($this->__getParam('file_id'));
        if ($file_id <= 0)
            $this->__ajaxReturn(false,'缺少文件，请重新上传！');
        $fileInfo  = $this->baseDbFile->getOne(CommonFuncs::calc_hash_db($file_id), $file_id);
        if (empty($fileInfo) || empty($fileInfo['file_name']))
            $this->__ajaxReturn(false,'文件缺少内容，请重新上传！');
        //解析xls文件
        $uu_file_name = '/var/tmp/'.CommonFuncs::getUUID().'.'.$fileInfo['file_ext'];

        $oss_file_data = $this->oSS->getObject($fileInfo['file_name']);
        if (!$oss_file_data['success'])
            $this->__ajaxReturn(false,'文件解析失败'.$oss_file_data['msg']);
        file_put_contents($uu_file_name,$oss_file_data['data'] );
        $xls_data = CommonFuncs::parseXLS2($uu_file_name, 2);
        //删除文件
        @unlink($uu_file_name);
        if(!$xls_data || !is_array($xls_data))
            $this->__ajaxReturn('文件解析失败，请检查文件内容！');
        //初始化数据
        $skusArr = array();
        //整理数据
        foreach($xls_data as $line) {
            $skusArr[]   = trim($line['12']);
        }
        if (empty($skusArr))
            $this->__ajaxReturn(false, '缺少SKU');

        if(empty($_FILES))
            $this->__ajaxReturn(false, '文件丢失');
        $tempFile = $_FILES['Filedata']['tmp_name'];
        $fileParts = pathinfo($_FILES['Filedata']['name']);
        if (strtolower($fileParts['extension']) !== 'zip')
            $this->__ajaxReturn(false, '目前只支持 ZIP 文件解压缩！');
        //打开资源
        $resource = zip_open($tempFile);
        //产生一个随机名称
        $path = '/var/tmp/'.CommonFuncs::getUUID().'/';
        $validFilePathArr = array();
        //遍历读取压缩包里面的一个个文件
        while($dir_resource = zip_read($resource)) {
            //如果能打开则继续
            if (zip_entry_open($resource,$dir_resource)) {
                //获取当前项目的名称,即压缩包里面当前对应的文件名
                $file_name = CommonFuncs::myIconv($path.zip_entry_name($dir_resource));
                if (empty($file_name))
                    continue;
                $file_path = substr($file_name,0,strrpos($file_name, "/"));
                $base_name = basename($file_name);
                $path_arr  = explode('/',$file_name);
                if (in_array('__MACOSX', $path_arr))
                    continue;
                if (in_array($base_name, $skusArr)){
                    $validFilePathArr[] = $file_path;
                }
                if(!is_dir($file_path) ){
                    mkdir($file_path,0777,true);
                }
                if(!is_dir($file_name)){
                    //读取这个文件
                    $file_size = zip_entry_filesize($dir_resource);
                    //最大读取1M，如果文件过大，跳过解压，继续下一个
                    if($file_size <= 1024*1024*4 ){
                        $file_content = zip_entry_read($dir_resource,$file_size);
                        file_put_contents($file_name,$file_content);
                    } else {
                        $this->__ajaxReturn(false, $file_name.'文件过大，大于4M');
                    }
                }
                //关闭当前
                zip_entry_close($dir_resource);
            }
        }
        $filesData = array();
        //只解析正确的目录
        foreach ($validFilePathArr as $valid_path){
            $sku = basename($valid_path);
            $tmp_path = $valid_path.'/main/';
            if (is_dir($tmp_path)){
                if($handle = opendir($tmp_path)){
                    $filesData[$sku]['main_path'] = $tmp_path;
                    while(($file = readdir($handle)) !== false){
                        if(($file !=".") && ($file !="..") && (!is_dir($valid_path.'\\'.$file)) ){
                            $file_ext = pathinfo($file, PATHINFO_EXTENSION);
                            if (in_array(strtolower($file_ext), array('jpg','jpeg','gif','png','bmp'))){
                                $filesData[$sku]['main'][] = $file;
                            } else {
                                continue;
                            }
                        }
                    }
                    closedir($handle);
                }
            }
            $tmp_path = $valid_path.'/details/';
            if (is_dir($tmp_path)){
                if($handle = opendir($tmp_path)){
                    $filesData[$sku]['details_path'] = $tmp_path;
                    while(($file = readdir($handle)) !== false){
                        if(($file !=".") && ($file !="..") && (!is_dir($valid_path.'\\'.$file)) ){
                            $file_ext = pathinfo($file, PATHINFO_EXTENSION);
                            if (in_array(strtolower($file_ext), array('jpg','jpeg','gif','png','bmp'))){
                                $filesData[$sku]['details'][] = $file;
                            } else {
                                continue;
                            }
                        }
                    }
                    closedir($handle);
                }
            }
        }
        zip_close($resource);
        //存库
        $resArr = $ossDataArr = array();
        foreach ($filesData as $sku => $fileData){
            //商品图
            $file_path = isset($fileData['main_path'])?$fileData['main_path']:'';
            if (empty($file_path))
                continue;
            $i = 1; //计数器 最多5张
            if (!isset($fileData['main']) || empty($fileData['main']))
                continue;
            foreach ($fileData['main'] as $file_name){
                if ($i > 5)
                    break;
                $flie_path_name = $file_path.$file_name;
                //上传到OSS
                $file_ext = pathinfo($flie_path_name, PATHINFO_EXTENSION);
                $oss_file_name = date('Ym')."/".date('d')."/".date('H')."/".CommonFuncs::getUUID().".".$file_ext;
                $file_id = $this->baseFileID->getMaxId();
                $ossDataArr[] = array(
                    'file_id'   => $file_id,
                    'trader_id' => $this->curUser['id'],
                    'flie_path' => addslashes($flie_path_name),
                    'file_name' => addslashes($oss_file_name),
                    'sku'       => $sku,
                    'is_upload' => '0',
                    'ctime'     => date('Y-m-d H:i:s')
                );

                $data = array(
                    'id'            => $file_id,
                    'ctime'         => date('Y-m-d H:i:s'),
                    'file_name'     => $oss_file_name,
                    'original_name' => addslashes($file_name),
                    'mime_type'     => mime_content_type($flie_path_name),
                    'file_size'     => filesize($flie_path_name),
                    'file_ext'      => $file_ext,
                    'file_owner'    => $mobile,
                    'is_img'        => 0,//是否图片
                );
                $res = $this->baseDbFile->add(CommonFuncs::calc_hash_db($file_id),$data);
                if ($res){
                    $i++;
                    $resArr[$sku]['1'][] = array(
                        'id'            => $file_id,
                        'file_name'     => $file_name,
                        'file_url'      => $data['file_name']
                    );
                    $resArr[$sku]['1'] = CommonFuncs::sysSortArray($resArr[$sku]['1'],'file_name');
                }
            }
            //详情图
            $file_path = isset($fileData['details_path'])?$fileData['details_path']:'';
            if (empty($file_path))
                continue;
            if (!isset($fileData['details']) || empty($fileData['details']))
                continue;
            foreach ($fileData['details'] as $file_name){
                $flie_path_name = $file_path.$file_name;
                //上传到OSS
                $file_ext = pathinfo($flie_path_name, PATHINFO_EXTENSION);
                $oss_file_name = date('Ym')."/".date('d')."/".date('H')."/".CommonFuncs::getUUID().".".$file_ext;
                $file_id = $this->baseFileID->getMaxId();
                $ossDataArr[] = array(
                    'file_id'   => $file_id,
                    'trader_id' => $this->curUser['id'],
                    'flie_path' => addslashes($flie_path_name),
                    'file_name' => addslashes($oss_file_name),
                    'sku'       => $sku,
                    'is_upload' => '0',
                    'ctime'     => date('Y-m-d H:i:s')
                );
                $data = array(
                    'id'            => $file_id,
                    'ctime'         => date('Y-m-d H:i:s'),
                    'file_name'     => addslashes($oss_file_name),
                    'original_name' => addslashes($file_name),
                    'mime_type'     => mime_content_type($flie_path_name),
                    'file_size'     => filesize($flie_path_name),
                    'file_ext'      => $file_ext,
                    'file_owner'    => $mobile,
                    'is_img'        => 0,//是否图片
                );
                $res = $this->baseDbFile->add(CommonFuncs::calc_hash_db($file_id),$data);
                if ($res){
                    $resArr[$sku]['2'][] = array(
                        'id'            => $file_id,
                        'file_name'     => $file_name,
                        'file_url'      => OSS_IMG_URL.$data['file_name'],
                    );
                    $resArr[$sku]['2'] = CommonFuncs::sysSortArray($resArr[$sku]['2'],'file_name');
                }
            }
        }
        if (empty($resArr))
            $this->__ajaxReturn(false, '文件解析失败！');
        else {
            $res = $this->ossUpload->batchAdd($ossDataArr);
            if ($res)
                $this->__ajaxReturn(true, '解析成功！',$resArr);
            else
                $this->__ajaxReturn(false,'图片解析失败！');
        }
    }
    public function ossUploadAction() {
        set_time_limit(0);
        //$this->__ajaxCheckUserLogin();
        $trader_id = isset($this->curUser['id'])?$this->curUser['id']:0;

        $ossUploadList = $this->ossUpload->getAllByTraderId($trader_id);
        if (!empty($ossUploadList)){
            foreach ($ossUploadList as $file){
                if (file_exists($file['flie_path'])){
                    $res = $this->oSS->putObjectImg($file['flie_path'], $file['file_name']);
                    if ($res['success'] === true )
                        $this->ossUpload->delete($file['id']);
                }
            }
            $this->__ajaxReturn(true, '成功！');
        } else {
            $this->__ajaxReturn(false, '缺少要上传的文件！');
        }
    }
    /**
     * 批量发货，上传文件
     */
    public function ajaxBatchDeliverAction(){
        set_time_limit(0);
        if (empty($_FILES))
            $this->__ajaxReturn(false, '文件丢失！');

        $tempFile = $_FILES['Filedata']['tmp_name'];
        $fileParts = pathinfo($_FILES['Filedata']['name']);
        $data = array(
            'file_ext' => $fileParts['extension'],
            'original_name' => $_FILES['Filedata']['name'], // 客户端文件的原名称
            'mime_type' => mime_content_type($_FILES['Filedata']['tmp_name']), // 文件的 MIME类型，需要浏览器提供该信息的支持，例如"image/gif"
            'file_size' => $_FILES['Filedata']['size']
        );

        if ( $data['file_ext'] != 'xlsx')
            $this->__ajaxReturn(false, '请上传系统提供模板！');

        $targetPath = '/var/tmp/';
        $this->MkFolder($targetPath);
        $targetFile = rtrim($targetPath, '/') . '/' . CommonFuncs::getUUID() . '.' . $fileParts['extension'];
        move_uploaded_file($tempFile, $targetFile);

        $xls_data = CommonFuncs::parseXLS2($targetFile, 2);
        if (! $xls_data || ! is_array($xls_data))
            $this->__ajaxReturn(false, '文件解析失败，请检查文件内容！');

        $data['file_name'] = date('Ym')."/".date('d')."/".date('H')."/".CommonFuncs::getUUID().".".$data['file_ext'];
        $res = $this->oSS->putObjectFile($targetFile, $data['file_name']);

        @unlink($targetFile);
        if (!$res['success'])
            $this->__ajaxReturn(false, $res['msg']);
        $file_id   = $this->baseFileID->getMaxId();
        //文件存表
        $fileAddData = array(
            'id'            => $file_id,
            'ctime'         => date('Y-m-d H:i:s'),
            'file_name'     => $data['file_name'],
            'original_name' => $data['original_name'],
            'mime_type'     => $data['mime_type'],
            'file_size'     => $data['file_size'],
            'file_ext'      => $data['file_ext'],
            'file_owner'    => "",
            'is_img'        => 0,//是否图片
        );
        $res  = $this->baseDbFile->add(CommonFuncs::calc_hash_db($file_id),$fileAddData);
        if (!$res)
            $this->__ajaxReturn(false,'文件存储失败！');

        $resArr = array(
            'file_info'   => array(
                'id'        => $file_id,
                'file_name' => $fileAddData['original_name'],
                'file_url'  => $fileAddData['file_name']
            ),
        );

        $i = 0;
        foreach ($xls_data as $line){
            $id = intval($line['0']);
            if (!empty($id))
                $i++;
        }
        $str = "本次共提交 ".$i." 个包裹的发货信息,请确认!";
        $this->__ajaxReturn(true, $str,$resArr['file_info']['id']);
    }
    /**
     * 批量发货-提交
     */
    public function ajaxBatchDeliverSubAction(){
        $id = intval($_POST['id']);
        if (empty($id))
            $this->__ajaxReturn(false,'文件缺少内容，请重新上传！');
        $trader_id = $this->curUser['id'];
        if (empty($trader_id))
            $this->__ajaxReturn(false,'登录超时，请重新登录！');
        $fileInfo  = $this->baseDbFile->getOne(CommonFuncs::calc_hash_db($id), $id);
        if (empty($fileInfo) || empty($fileInfo['file_name']))
            $this->__ajaxReturn(false,'文件缺少内容，请重新上传！');
        //解析xls文件
        $file_path = '/var/tmp/'.CommonFuncs::getUUID().'.'.$fileInfo['file_ext'];

        $oss_file_data = $this->oSS->getObject($fileInfo['file_name']);
        if (!$oss_file_data['success'])
            $this->__ajaxReturn(false,'文件解析失败'.$oss_file_data['msg']);
        file_put_contents($file_path,$oss_file_data['data'] );

        $xls_data = CommonFuncs::parseXLS2($file_path, 2);
        //删除文件
        @unlink($file_path);
        if(empty($xls_data) || !is_array($xls_data))
            $this->__ajaxReturn('文件解析失败，请检查文件内容！');

        $success = $count = 0;
        $msg = '';
        $idsArr= array();
        // 获得包裹ID 获得对应的包裹
        foreach ($xls_data as $key => $line) {
            $idsArr[] = intval($line['0']);
        }
        $ids = implode(',', $idsArr);
        $orderPackageList = $this->orderPackage->getWhere(" WHERE `id` IN ($ids)");
        $orderPackageKeyInfo = $orderKeyArr = array();
        foreach ($orderPackageList as $orderPackageInfo){
            $orderPackageKeyInfo[$orderPackageInfo['id']] = $orderPackageInfo;
            $orderKeyArr[$orderPackageInfo['order_id']] = $orderPackageInfo['order_id'];
        }
        $orderPackageGoodsKeyInfo = $this->orderPackageGoods->getListByPackageIds($idsArr);
        $orderKeyInfo = $this->order->getAllKeyInfo(" WHERE `id` IN (".implode(',', $orderKeyArr).")");
        foreach ($xls_data as $key => $line) {
            $id = intval($line['0']);
            $orderPackageInfo = isset($orderPackageKeyInfo[$id]['package_status'])?$orderPackageKeyInfo[$id]:array();
            if ($orderPackageInfo['package_status'] != 0)
                continue;
            else
                $count++;

            $orderInfo = isset($orderKeyInfo[$orderPackageInfo['order_id']])?$orderKeyInfo[$orderPackageInfo['order_id']]:array();
            $orderPackageGoodsList = isset($orderPackageGoodsKeyInfo[$id])?$orderPackageGoodsKeyInfo[$id]:array();
            if (empty($orderInfo) || empty($orderPackageGoodsList))
                continue;

            $logistics_name = trim($line['22']);
            $shipCode       = trim($line['23']);
            if (empty($shipCode)){
                $msg .= "<br>第".($key+1)."行,缺少物流单号；";
                continue;
            }
            $sysDate = date('Y-m-d H:i:s');
            $data = array(
                'id'            => $id,
                'logistics_name'=> $logistics_name,
                'ship_code'     => $shipCode,
                'delivery_date' => $sysDate,
                'package_status'=> 1
            );
            $res = $this->orderPackage->update($data);
            if ($res)
                $success++;

            if ($orderPackageInfo['insurance'] > 0){
                $orderPackageInfo['ship_code'] = $data['ship_code'];
                $insuranceRes = $this->apiInsurance->createInsurance($orderInfo, $orderPackageInfo, $orderPackageGoodsList);
                if (!$insuranceRes['success'])
                   continue;
            }
        }
        $this->__ajaxReturn(true, '批量发货完毕,成功 '.$success.' 个,失败 '.($count-$success).' 个,'.$msg);
    }

    public function ajaxBatchEditGoodsAction(){
        $userInfo = $this->user->getOne($this->curUser['id']);
        if (empty($userInfo))
            $this->__ajaxReturn(false, '请登录！');
        $trader_id    = $userInfo['id'];
        $mobile= $userInfo['mobile'];
        if (empty($_FILES))
            $this->__ajaxReturn(false,'文件丢失！');

        $tempFile  = $_FILES['Filedata']['tmp_name'];
        $fileParts = pathinfo($_FILES['Filedata']['name']);
        $data = array(
            'file_ext'     => $fileParts['extension'],
            'original_name'=> $_FILES['Filedata']['name'], //客户端文件的原名称
            'mime_type'    => mime_content_type($_FILES['Filedata']['tmp_name']), //文件的 MIME类型，需要浏览器提供该信息的支持，例如"image/gif"
            'file_size'    => $_FILES['Filedata']['size'], //已上传文件的大小，单位为字节
        );
        $trueTypes = array('xlsx');
        if (!in_array($data['file_ext'],$trueTypes))
            $this->__ajaxReturn(false,'请上传系统提供模板！');
        //将文件移到缓存
        $targetPath = '/var/tmp/';
        $this->MkFolder($targetPath);
        $targetFile = rtrim($targetPath,'/').'/'.CommonFuncs::getUUID(). '.' . $fileParts['extension'];
        move_uploaded_file($tempFile,$targetFile);
        //解析xls文件
        $xls_data = CommonFuncs::parseXLS2($targetFile, 2);
        if(!$xls_data || !is_array($xls_data))
            $this->__ajaxReturn(false, '文件解析失败，请检查文件内容！');
        //初始化数据
        $goodsList = $skusArr = $errorData = array();
        //商品分类
        $allSkuArr = array_keys($this->storeGoods->getAllSkuKeyInfoByTraderId($trader_id));
        //整理数据
        $sku_key = "YM" . $this->curUser['SKU_KEY'] . "_";
        foreach($xls_data as $rows => $line) {
            $tmp_title = "第 ".$rows."行";
            $title = '';
            while (substr($line['0'],0,9) == $sku_key){
                $line['0'] = substr($line['0'],9);
            }
            $sku = $line['0'];
            if (!empty($sku)){
                $tmp_sku =  $sku_key . trim($sku);
                //验证重复
                if (!in_array($tmp_sku, $allSkuArr)){
                    $title .= $tmp_title." 商品SKU不存在,";
                    $tmp_title = '';
                }
                if (in_array($tmp_sku, $skusArr)){
                    $title .= $tmp_title." 商品SKU重复添加,";
                    $tmp_title = '';
                } else
                    $skusArr[] = $sku;
            }
            //商品信息
            //商品名称	规格型号	商品SKU	库存数量	分销单价（元）	图片信息
            $goodsList[] = array(
                'goods_sku'         => $sku,
            );
            if (!empty($title))
                $errorData[$rows] = trim($title,",");
        }
        if (!empty($errorData)){
            $error_info = implode('<br>', $errorData);
            $error_info .= '<br> 共计<font color="red">'.count($errorData).'</font>行 错误！请修改后提交！';
            $this->__ajaxReturn(false, $error_info);
        }
        //上传到OSS
        $data['file_name'] = date('Ym')."/".date('d')."/".date('H')."/".CommonFuncs::getUUID().".".$data['file_ext'];
        $res = $this->oSS->putObjectFile($targetFile, $data['file_name']);
        //删除文件
        @unlink($targetFile);
        if (!$res['success'])
            $this->__ajaxReturn(false, $res['msg']);
        $file_id   = $this->baseFileID->getMaxId();
        //文件存表
        $fileAddData = array(
            'id'            => $file_id,
            'ctime'         => date('Y-m-d H:i:s'),
            'file_name'     => $data['file_name'],
            'original_name' => $data['original_name'],
            'mime_type'     => $data['mime_type'],
            'file_size'     => $data['file_size'],
            'file_ext'      => $data['file_ext'],
            'file_owner'    => $mobile,
            'is_img'        => 0,//是否图片
        );
        $res  = $this->baseDbFile->add(CommonFuncs::calc_hash_db($file_id),$fileAddData);
        if (!$res)
            $this->__ajaxReturn(false,'文件存储失败！');

        $resArr = array(
            'file_info'   => array(
                'id'        => $file_id,
                'file_name' => $fileAddData['original_name'],
                'file_url'  => $fileAddData['file_name']
            ),
            'goods_list'  => $goodsList,
        );
        $this->__ajaxReturn(true,'上传成功',$resArr);
    }
    public function editUnzipAction(){
        set_time_limit(0);
        $mobile = $this->curUser['mobile'];

        //先解析SKU
        $file_id     = intval($this->__getParam('file_id'));
        if ($file_id <= 0)
            $this->__ajaxReturn(false,'缺少文件，请重新上传！');
        $fileInfo  = $this->baseDbFile->getOne(CommonFuncs::calc_hash_db($file_id), $file_id);
        if (empty($fileInfo) || empty($fileInfo['file_name']))
            $this->__ajaxReturn(false,'文件缺少内容，请重新上传！');
        //解析xls文件
        $uu_file_name = '/var/tmp/'.CommonFuncs::getUUID().'.'.$fileInfo['file_ext'];

        $oss_file_data = $this->oSS->getObject($fileInfo['file_name']);
        if (!$oss_file_data['success'])
            $this->__ajaxReturn(false,'文件解析失败'.$oss_file_data['msg']);
        file_put_contents($uu_file_name,$oss_file_data['data'] );

        $xls_data = CommonFuncs::parseXLS2($uu_file_name, 2);
        //删除文件
        @unlink($uu_file_name);
        if(!$xls_data || !is_array($xls_data))
            $this->__ajaxReturn('文件解析失败，请检查文件内容！');
//         $total = array();
//         $total['excel_time'] = microtime(true) - $time; //计算差值
//         $time = microtime(true);
        //初始化数据
        $skusArr = array();
        //整理数据
        $sku_key = "YM" . $this->curUser['SKU_KEY'] . "_";
        foreach($xls_data as $line) {
            while (substr($line['0'],0,9) == $sku_key){
                $line['0'] = substr($line['0'],9);
            }
            $skusArr[]   = $line['0'];
        }
        if (empty($skusArr))
            $this->__ajaxReturn(false, '缺少SKU');

        if(empty($_FILES))
            $this->__ajaxReturn(false, '文件丢失');
        $tempFile = $_FILES['Filedata']['tmp_name'];
        $fileParts = pathinfo($_FILES['Filedata']['name']);
        if (strtolower($fileParts['extension']) !== 'zip')
            $this->__ajaxReturn(false, '目前只支持 ZIP 文件解压缩！');
        //打开资源
        $resource = zip_open($tempFile);
        //产生一个随机名称
        $path = '/var/tmp/'.CommonFuncs::getUUID().'/';
        $validFilePathArr = array();
        //遍历读取压缩包里面的一个个文件
        while($dir_resource = zip_read($resource)) {
            //如果能打开则继续
            if (zip_entry_open($resource,$dir_resource)) {
                //获取当前项目的名称,即压缩包里面当前对应的文件名
                $file_name = CommonFuncs::myIconv($path.zip_entry_name($dir_resource));
                $file_path = substr($file_name,0,strrpos($file_name, "/"));
                $base_name = basename($file_name);
                $path_arr  = explode('/',$file_name);
                if (in_array('__MACOSX', $path_arr))
                    continue;
                if (in_array($base_name, $skusArr)){
                    $validFilePathArr[] = $file_path;
                }
                if(!is_dir($file_path) ){
                    mkdir($file_path,0777,true);
                }
                if(!is_dir($file_name)){
                    //读取这个文件
                    $file_size = zip_entry_filesize($dir_resource);
                    //最大读取1M，如果文件过大，跳过解压，继续下一个
                    if($file_size <= 1024*1024*4 ){
                        $file_content = zip_entry_read($dir_resource,$file_size);
                        file_put_contents($file_name,$file_content);
                    } else {
                        $this->__ajaxReturn(false, $file_name.'文件过大，大于4M');
                    }
                }
                //关闭当前
                zip_entry_close($dir_resource);
            }
        }
        zip_close($resource);
//         $total['unzip_time'] = microtime(true) - $time; //计算差值
//         $time = microtime(true);
        $filesData = array();
        //只解析正确的目录
        foreach ($validFilePathArr as $valid_path){
            $sku = basename($valid_path);
            $tmp_path = $valid_path.'/main/';
            if (is_dir($tmp_path)){
                if($handle = opendir($tmp_path)){
                    $filesData[$sku]['main_path'] = $tmp_path;
                    while(($file = readdir($handle)) !== false){
                        if(($file !=".") && ($file !="..") && (!is_dir($valid_path."\\".$file)) ){
                            $file_ext = pathinfo($file, PATHINFO_EXTENSION);
                            if (in_array(strtolower($file_ext), array('jpg','jpeg','gif','png','bmp'))){
                                $filesData[$sku]['main'][] = $file;
                            } else {
                                continue;
                            }
                        }

                    }
                    closedir($handle);
                }
            }
            $tmp_path = $valid_path.'/details/';
            if (is_dir($tmp_path)){
                if($handle = opendir($tmp_path)){
                    $filesData[$sku]['details_path'] = $tmp_path;
                    while(($file = readdir($handle)) !== false){
                        if(($file !=".") && ($file !="..") && (!is_dir($valid_path."\\".$file)) ){
                            $file_ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                            if (in_array($file_ext, array('jpg','jpeg','gif','png','bmp'))){
                                $filesData[$sku]['details'][] = $file;
                            } else {
                                continue;
                            }
                        }
                    }
                    closedir($handle);
                }
            }
        }
//         $total['read_file_time'] = microtime(true) - $time; //计算差值
//         $time = microtime(true);
        //存库
        $resArr = $ossDataArr = array();
        foreach ($filesData as $sku => $fileData){
            //商品图
            $file_path = $fileData['main_path'];
            $i = 1; //计数器 最多5张
            foreach ($fileData['main'] as $file_name){
                if ($i > 5)
                    break;
                $flie_path_name = $file_path.$file_name;
                //上传到OSS
                $file_ext = pathinfo($flie_path_name, PATHINFO_EXTENSION);
                $oss_file_name = date('Ym')."/".date('d')."/".date('H')."/".CommonFuncs::getUUID().".".$file_ext;
                //                 $res = $this->oSS->putObjectImg($flie_path_name, $oss_file_name);
                //                 if (!$res['success'])
                    //                     $this->__ajaxReturn(false, $res['msg']);
                    $file_id = $this->baseFileID->getMaxId();
                    $ossDataArr[] = array(
                        'file_id'   => $file_id,
                        'trader_id' => $this->curUser['id'],
                        'flie_path' => $flie_path_name,
                        'file_name' => $oss_file_name,
                        'sku'       => $sku,
                        'is_upload' => '0',
                        'ctime'     => date('Y-m-d H:i:s')
                    );

                    $data = array(
                        'id'            => $file_id,
                        'ctime'         => date('Y-m-d H:i:s'),
                        'file_name'     => $oss_file_name,
                        'original_name' => $file_name,
                        'mime_type'     => mime_content_type($flie_path_name),
                        'file_size'     => filesize($flie_path_name),
                        'file_ext'      => $file_ext,
                        'file_owner'    => $mobile,
                        'is_img'        => 0,//是否图片
                    );
                    $res = $this->baseDbFile->add(CommonFuncs::calc_hash_db($file_id),$data);
                    if ($res){
                        $i++;
                        $resArr[$sku]['1'][] = array(
                            'id'            => $file_id,
                            'file_name'     => $file_name,
                            'file_url'      => $data['file_name']
                        );
                        $resArr[$sku]['1'] = CommonFuncs::sysSortArray($resArr[$sku]['1'],'file_name');
                    }
            }
            //详情图
            $file_path = $fileData['details_path'];
            foreach ($fileData['details'] as $file_name){
                $flie_path_name = $file_path.$file_name;
                //上传到OSS
                $file_ext = pathinfo($flie_path_name, PATHINFO_EXTENSION);
                $oss_file_name = date('Ym')."/".date('d')."/".date('H')."/".CommonFuncs::getUUID().".".$file_ext;
                //                 $res = $this->oSS->putObjectImg($flie_path_name, $oss_file_name);
                //                 if (!$res['success'])
                    //                     $this->__ajaxReturn(false, $res['msg']);
                    $file_id = $this->baseFileID->getMaxId();
                    $ossDataArr[] = array(
                        'file_id'   => $file_id,
                        'trader_id' => $this->curUser['id'],
                        'flie_path' => $flie_path_name,
                        'file_name' => $oss_file_name,
                        'sku'       => $sku,
                        'is_upload' => '0',
                        'ctime'     => date('Y-m-d H:i:s')
                    );
                    $data = array(
                        'id'            => $file_id,
                        'ctime'         => date('Y-m-d H:i:s'),
                        'file_name'     => $oss_file_name,
                        'original_name' => $file_name,
                        'mime_type'     => mime_content_type($flie_path_name),
                        'file_size'     => filesize($flie_path_name),
                        'file_ext'      => $file_ext,
                        'file_owner'    => $mobile,
                        'is_img'        => 0,//是否图片
                    );
                    $res = $this->baseDbFile->add(CommonFuncs::calc_hash_db($file_id),$data);
                    if ($res){
                        //$total['save_db_time'] = microtime(true) - $time; //计算差值
                        $resArr[$sku]['2'][] = array(
                            'id'            => $file_id,
                            'file_name'     => $file_name,
                            'file_url'      => OSS_IMG_URL.$data['file_name'],
                            //'total'         => $total,
                        );
                        $resArr[$sku]['2'] = CommonFuncs::sysSortArray($resArr[$sku]['2'],'file_name');
                    }
            }
        }
        if (empty($resArr))
            $this->__ajaxReturn(false, '文件解析失败！');
        else{
            $res = $this->ossUpload->batchAdd($ossDataArr);
            if ($res)
                $this->__ajaxReturn(true, '解析成功！',$resArr);
            else
                $this->__ajaxReturn(false,'图片解析失败！');
        }
    }
//更新货商商品价格和库存
    function uploadifyUpdateAction(){
        $trader_id = isset($this->curUser['id']) ? $this->curUser['id'] : 0;
        if (empty($trader_id)){
            $error_msg = array(
                'success' => false,
                'msg'     => '请登录',
                'type'    => 'login'
            );
            $this->__displayOutput($error_msg);
        }
        $result = array();
        if(empty($_FILES)){
             $error_msg = array(
                'success' => false,
                'msg'     => '文件丢失！',
                'type'    => 'error'
            );
            $this->__displayOutput($error_msg);
        }
        $tempFile  = $_FILES['Filedata']['tmp_name'];
        $fileParts = pathinfo($_FILES['Filedata']['name']);
        $data = array(
            'file_ext'     => $fileParts['extension'],
            'original_name'=> $_FILES['Filedata']['name'], //客户端文件的原名称
            'mime_type'    => mime_content_type($_FILES['Filedata']['tmp_name']), //文件的 MIME类型，需要浏览器提供该信息的支持，例如"image/gif"
            'file_size'    => $_FILES['Filedata']['size'], //已上传文件的大小，单位为字节
        );
        if ($data['file_ext'] != 'xlsx'){
            $error_msg = array(
                'success' => false,
                'msg' => '非法文件，服务器拒绝接收！',
                'type' => 'error'
            );
            $this->__displayOutput($error_msg);
        }
        //将文件移到缓存
        $file_id   = $this->baseFileID->getMaxId();
        $targetFile = '/var/tmp/'.CommonFuncs::getUUID().'.'.$fileParts['extension'];
        move_uploaded_file($tempFile,$targetFile);
        $xls_data = CommonFuncs::parseXLS2($targetFile, 2);
        if(!$xls_data || !is_array($xls_data)){
            $error_msg = array(
                'success' => false,
                'msg' => '文件解析失败，请检查文件内容！',
                'type' => 'error'
            );
            $this->__displayOutput($error_msg);
        }
        $info = array();
        // A-C;
        $rowsKey = array();
        for ($i = 'a'; $i <= 'c'; ++ $i) {
            $rowsKey[] = strtoupper($i);
        }
        $error_data = array();
        foreach($xls_data as $rows => $line){
            $title = "第" . ($rows) . "行,";
            if(!isset($line['0'])){
                $error_data[] = $title . "第" . $rowsKey['0'] . "列，数据不完整，缺少商品的SKU！";
                continue;
            }
            $sku = str_replace("\n", "", trim($line['0']));
            $goods = $this->storeGoods->getByTraderGoodsSku($trader_id,trim($line[0]));
            if (empty($sku) || empty($goods) || ($goods['goods_status'] != 2) ) {
                $error_data[] = $title . "第" . $rowsKey['0'] . "列，商品 不存在 或 已下架，应为已上架商品!";
                continue;
            }
            if(isset($line['1']) && (trim($line['1']) != '') && (intval($line['1']) <= 0)){
                $error_data[] = $title . "第" . $rowsKey['1'] . "列，库存数值异常";
                continue;
            }
            if(isset($line['2']) && (trim($line['2']) != '') && (floatval($line['2']) <= 0)){
                $error_data[] = $title . "第" . $rowsKey['2'] . "列，分销价格异常";
                continue;
            }
            if($goods){
                $info[$rows] = $goods;
                if(isset($line['1']) && (trim($line['1']) != '')){
                    $info[$rows]['goods_count'] = intval($line[1]);
                }else{
                    $info[$rows]['goods_count'] = '';
                }
                if(isset($line[2]) && (trim($line[2]) != '')){
                    $info[$rows]['retail_price'] = floatval($line[2]);
                }else{
                    $info[$rows]['retail_price'] = '';
                }
                $info[$rows]['file_id'] = $file_id;
            }
        }
        if (! empty($error_data)) {
            $error_info = implode('<hr>', $error_data);
            $error_info .= '<hr> 共计<font color="red">' . count($error_data) . '</font>处 错误！请修改后上传！';
            $error_msg = array(
                'success' => false,
                'msg'     => $error_info,
                'type'    => 'error'
            );
            $this->__displayOutput($error_msg);
        }
        $data['file_name'] = date('Ym')."/".date('d')."/".date('H')."/".CommonFuncs::getUUID().".".$data['file_ext'];
        //上传到OSS
        $res = $this->oSS->putObjectFile($targetFile, $data['file_name']);
        if (!$res['success']){
           $error_msg = array(
                'success' => false,
                'msg'     => "文件云存储失败！",
                'type'    => 'error'
            );
            $this->__displayOutput($error_msg);
        }
        //删除文件
        @unlink($targetFile);
        //文件存表
        $fileAddData = array(
            'id'            => $file_id,
            'ctime'         => date('Y-m-d H:i:s'),
            'file_name'     => $data['file_name'],
            'original_name' => $data['original_name'],
            'mime_type'     => $data['mime_type'],
            'file_size'     => $data['file_size'],
            'file_ext'      => $data['file_ext'],
            'file_owner'    => '',
            'is_img'        => 0,//是否图片
        );
        $res  = $this->baseDbFile->add(CommonFuncs::calc_hash_db($file_id),$fileAddData);
        if (!$res){
             $error_msg = array(
                'success' => false,
                'msg'     => "文件存储失败！",
                'type'    => 'error'
            );
            $this->__displayOutput($error_msg);
        }
        $result = array('success'=>true,'data'=>$info);
        $this->__displayOutput($result);
    }

    public function uploadWLOrderAction()
    {
        //$this->__checkWuliuLogin();
        $trader_mobile = isset($this->curUser['mobile'])?trim($this->curUser['mobile']):'';
        $trader_id = isset($this->curUser['id'])?intval($this->curUser['id']):0;
        $type = intval($this->__getParam('type'));
        if (empty($trader_id)){
            $error_msg = array(
                'success' => false,
                'msg'     => '请登录',
                'type'    => 'login'
            );
            $this->__displayOutput($error_msg);
        }
        if (empty($_FILES)){
            $error_msg = array(
                'success' => false,
                'msg'     => '文件丢失！',
                'type'    => 'error'
            );
            $this->__displayOutput($error_msg);
        }

        $tempFile = $_FILES['Filedata']['tmp_name'];
        $fileParts = pathinfo($_FILES['Filedata']['name']);
        $data = array(
            'file_ext' => $fileParts['extension'],
            'original_name' => $_FILES['Filedata']['name'], // 客户端文件的原名称
            'mime_type' => mime_content_type($_FILES['Filedata']['tmp_name']), // 文件的 MIME类型，需要浏览器提供该信息的支持，例如"image/gif"
            'file_size' => $_FILES['Filedata']['size']
        ); // 已上传文件的大小，单位为字节

        if (strtolower($data['file_ext']) != 'xlsx'){
            $error_msg = array(
                'success' => false,
                'msg' => '非法文件，服务器拒绝接收！',
                'type' => 'error'
            );
            $this->__displayOutput($error_msg);
        }

        // 将文件移到缓存
        $targetFile = '/var/tmp/' . CommonFuncs::getUUID() . '.' . $fileParts['extension'];
        move_uploaded_file($tempFile, $targetFile);
        // 读取文件内容
        $file_id = $this->baseFileID->getMaxId();
        // 解析xls文件
        $xls_data = CommonFuncs::parseXLS2($targetFile, 2);

        if (! $xls_data || ! is_array($xls_data)){
            $error_msg = array(
                'success' => false,
                'msg' => '文件解析失败，请检查文件内容！',
                'type' => 'error'
            );
            $this->__displayOutput($error_msg);
        }

        // A-YZ;
        $rowsKey = array();
        for ($i = 'a'; $i <= 'z'; ++ $i) {
            $rowsKey[] = strtoupper($i);
        }

        $error_data = array();
        $where_gid = '';
        $where_oid = '';
        $num = 0;
        foreach ($xls_data as $rows => $line) {
            $where_gid .= "'".trim($line['9'])."',";
            $where_oid .= "'".trim($line['0'])."',";
            $num++;
        }
        $where_gid = substr($where_gid, 0, -1);
        $where_oid = substr($where_oid, 0, -1);
        $where = " trader_id = $trader_id AND store_code = $type AND goods_code in ($where_gid)";
        $goods_info = $this->wuliuGoods->getUserGoodsInfoKey($where);
        $orderCodeArr = $this->wuliuOrder->getUserOrder($trader_id,$where_oid);
        $orderPackageData = array();

        // 整理数据
        $i = 0;
        $order_total_count = array();
        $total_goods_count = 0;
        foreach ($xls_data as $rows => $line) {
            $title = "第" . ($rows) . "行,";
            // 验证必填信息
            foreach ($line as $key => $value) {
                // 验证数字 合法性
                if ($key == 12 && $value <= 0) {
                    $error_data[] = $title . "第" . $rowsKey['12'] . "列，商品数量至少为1!";
                }
                if ($key == 12 && $value >= 0) {
                    $total_goods_count += $value;
                }
                // 订单号必须是数字和字母的组合且小于等于20位
                if($key == 0 && $value && (strlen($value) >= 21 || !ctype_alnum($value))){
                    $error_data[] = $title . "第" . $rowsKey['0'] . "列，订单号必须是字母和数字的组合,且小于等于20个长度!";
                }
            }
            //检查商品是否属于自己仓库
            $gid = trim($line['9']);
            if(!isset($goods_info[$gid]))
                $error_data[] = $title . "第" . $rowsKey['0'] . "列，商品不属于选择的仓库!";

            //验证订单号是否重复
            $order_code = trim($line['0']);
            if(isset($orderCodeArr[$order_code.'_'.trim($line['9'])]) && ($orderCodeArr[$order_code.'_'.trim($line['9'])]['is_send'] == 1 && $orderCodeArr[$order_code.'_'.trim($line['9'])]['order_status'] != 16))
                $error_data[] = $title . "第" . $rowsKey['0'] . "列，订单号已使用!";

            $orderPackageData[$i]['no'] = $order_code?$order_code:$orderPackageData[$i-1]['no'];
            $orderPackageData[$i]['name'] = trim($line['2'])?trim($line['2']):$orderPackageData[$i-1]['name'];
            $orderPackageData[$i]['idcard'] = trim($line['4'])?trim($line['4']):$orderPackageData[$i-1]['idcard'];
            $orderPackageData[$i]['mobile'] = trim($line['3'])?trim($line['3']):$orderPackageData[$i-1]['mobile'];
            $orderPackageData[$i]['goodsnum'] = trim($line['12'])?trim($line['12']):$orderPackageData[$i-1]['goodsnum'];
            $orderPackageData[$i]['city'] = trim($line['6'])?trim($line['6']):$orderPackageData[$i-1]['city'];
            $order_total_count[$orderPackageData[$i]['no']] = $orderPackageData[$i]['no'];
            $i++;
        }

        if (! empty($error_data)) {
            $error_info = implode('<hr>', $error_data);
            $error_info .= '<hr> 共计<font color="red">' . count($error_data) . '</font>处 错误！请修改后上传！';
            $error_msg = array(
                'success' => false,
                'msg'     => $error_info,
                'type'    => 'error'
            );
            $this->__displayOutput($error_msg);
        }

        $data['file_name'] = date('Ym') . "/" . date('d') . "/" . date('H') . "/" . CommonFuncs::getUUID() . "." . $data['file_ext'];
        // 上传到OSS
        $res = $this->oSS->putObjectFile($targetFile, $data['file_name']);
        if (! $res['success']){
            $error_msg = array(
                'success' => false,
                'msg'     => "文件云存储失败！",
                'type'    => 'error'
            );
            $this->__displayOutput($error_msg);
        }
        // 删除文件
        @unlink($targetFile);
        // 文件存表
        $fileAddData = array(
            'id'            => $file_id,
            'ctime'         => date('Y-m-d H:i:s'),
            'file_name'     => $data['file_name'],
            'original_name' => $type,
            'mime_type'     => $data['mime_type'],
            'file_size'     => $data['file_size'],
            'file_ext'      => $data['file_ext'],
            'file_owner'    => $trader_mobile,
            'is_img'        => 0
        );

        $res = $this->baseDbFile->add(CommonFuncs::calc_hash_db($file_id), $fileAddData);
        if (! $res){
            $error_msg = array(
                'success' => false,
                'msg'     => "文件存储失败！",
                'type'    => 'error'
            );
            $this->__displayOutput($error_msg);
        }

        $resArr = array(
            'file_info'       => array(
                'id'        => $file_id,
                'file_name' => $data['original_name']
            ),
            'order_list'      => $orderPackageData,
            'goods_count'     => $total_goods_count,
            'order_count'     => count($order_total_count)
        );
        $this->__ajaxReturn(true, '上传成功', $resArr);
    }
    /**
     * 五折备货批量上传商品，上传EXCEL
     */
    public function uploadStockingExcelAction(){
        $userInfo = $_SESSION['system_account'];
        if (empty($userInfo))
            $this->__ajaxReturn(false, '请登录！');
        $mobile= $userInfo['username'];
        if (empty($_FILES))
            $this->__ajaxReturn(false,'文件丢失！');

        $tempFile  = $_FILES['Filedata']['tmp_name'];
        $fileParts = pathinfo($_FILES['Filedata']['name']);
        $data = array(
            'file_ext'     => $fileParts['extension'],
            'original_name'=> $_FILES['Filedata']['name'], //客户端文件的原名称
            'mime_type'    => mime_content_type($_FILES['Filedata']['tmp_name']), //文件的 MIME类型，需要浏览器提供该信息的支持，例如"image/gif"
            'file_size'    => $_FILES['Filedata']['size'], //已上传文件的大小，单位为字节
        );
        if ($data['file_ext'] != 'xlsx')
            $this->__ajaxReturn(false,'请上传系统提供模板！');
        //将文件移到缓存
        $targetPath = '/var/tmp/';
        $this->MkFolder($targetPath);
        $targetFile = rtrim($targetPath,'/').'/'.CommonFuncs::getUUID(). '.' . $fileParts['extension'];
        move_uploaded_file($tempFile,$targetFile);
        //解析xls文件
        $xls_data = CommonFuncs::parseXLS2($targetFile, 2);
        if(!$xls_data || !is_array($xls_data))
            $this->__ajaxReturn(false, '文件解析失败，请检查文件内容！');
        //初始化数据
        $goodsList = $skusArr = $errorData = array();
        $allSkuArr = $this->stocking->getAllGoodsSkuKey();
        //A-YZ;
        $rowsKey = array();
        for ($i = 'a'; $i <= 'z'; ++$i) {
            $rowsKey[] =  strtoupper($i);
        }
        if (count($xls_data) > 2000)
            $this->__ajaxReturn(false, '文件过大超过2000条！');
        //整理数据
        foreach($xls_data as $rows => $line) {
            //验证空值
            $title = '';
            $tmpTitle = '第'.($rows).'行,';
            foreach ($line as $k => $val){
                if ($k > 5) break;
                $val = trim($val);
                if (empty($val) || is_null($val)){
                    if (empty($title)){
                        $title = $tmpTitle.'第 '.$rowsKey[$k];
                        $tmpTitle = '';
                    } else {
                        $title .= ','.$rowsKey[$k];
                    }
                }
            }
            if (!empty($title))
                $title .= '列 存在必填空值  ,';
            //验证起订量 数值
            if ($line['4'] <= 0){
                $title .= $tmpTitle.'第 '.$rowsKey['4'].'列 起订量错误,';;
                $tmpTitle = '';
            }
            //验证采购价
            if ($line['3'] <= 0) {
                $title .= $tmpTitle.'第 '.$rowsKey['3'].'列 采购价错误,';
                $tmpTitle = '';
            }
            $sku = $line['1'];
            if (!empty($sku)){
                //验证重复
                if (in_array($sku, $allSkuArr)){
                    $title .= $tmpTitle.'第 '.$rowsKey['1'].'列 商品编码 存在,';
                    $tmpTitle = '';
                }
                if (in_array($sku, $skusArr)){
                    $title .= $tmpTitle.'第 '.$rowsKey['1'].'列 商品编码 重复添加,';
                    $tmpTitle = '';
                } else
                    $skusArr[] = $sku;
            } else {
                $title .= $tmpTitle.'第 '.$rowsKey['1'].'列 缺少 商品编码,';
                continue;
            }
            //商品信息
            //商品分类	商品编码	商品名称	采购价￥	起订量	采购说明
            $goodsList[] = array(
                'goods_class'       => trim($line['0']),
                'goods_sku'         => $sku,
                'goods_name'        => trim($line['2']),
                'goods_price'       => CommonFuncs::round2($line['3']),
                'MOQ'               => intval($line['4']),
                'prepayments'       => CommonFuncs::round2($line['5']),
                'account_period_desc' => addslashes($line['6']),
                'delivery_date_desc'=> addslashes($line['7']),
                'address'           => addslashes($line['8']),
                'desc'              => addslashes($line['9']),
            );
            if ($title)
                $errorData[$rows] = trim($title,',');
        }
        if (!empty($errorData)){
            $error_info = implode(' ', $errorData);
            $error_info .= ' 共计 '.count($errorData).' 处 错误！请修改后提交！';
            $this->__ajaxReturn(false, $error_info);
        }
        if (empty($goodsList)){
            $this->__ajaxReturn(false,'文件解析失败，缺少商品信息！');
        }
        //上传到OSS
        $data['file_name'] = date('Ym')."/".date('d')."/".date('H')."/".CommonFuncs::getUUID().".".$data['file_ext'];
        $res = $this->oSS->putObjectFile($targetFile, $data['file_name']);
        //删除文件
        @unlink($targetFile);
        if (!$res['success'])
            $this->__ajaxReturn(false, $res['msg']);
        $file_id   = $this->baseFileID->getMaxId();
        //文件存表
        $fileAddData = array(
            'id'            => $file_id,
            'ctime'         => date('Y-m-d H:i:s'),
            'file_name'     => $data['file_name'],
            'original_name' => $data['original_name'],
            'mime_type'     => $data['mime_type'],
            'file_size'     => $data['file_size'],
            'file_ext'      => $data['file_ext'],
            'file_owner'    => $mobile,
            'is_img'        => 0,//是否图片
        );
        $res  = $this->baseDbFile->add(CommonFuncs::calc_hash_db($file_id),$fileAddData);
        if (!$res)
            $this->__ajaxReturn(false,'文件存储失败！');

        $resArr = array(
            'file_info'   => array(
                'id'        => $file_id,
                'file_name' => $fileAddData['original_name'],
                'file_url'  => $fileAddData['file_name']
            ),
            'goods_list'  => $goodsList,
        );
        $this->__ajaxReturn(true,'上传成功',$resArr);
    }
    /**
     * 五折备货批量上传商品图片，上传ZIP
     */
    public function stockingUnZipAction(){
        set_time_limit(0);
        $userInfo = $_SESSION['system_account'];
        if (empty($userInfo))
            $this->__ajaxReturn(false, '请登录！');
        $mobile= $userInfo['username'];
        //先解析SKU
        $file_id     = intval($this->__getParam('file_id'));
        if ($file_id <= 0)
            $this->__ajaxReturn(false,'缺少文件，请重新上传！');
        $fileInfo  = $this->baseDbFile->getOne(CommonFuncs::calc_hash_db($file_id), $file_id);
        if (empty($fileInfo) || empty($fileInfo['file_name']))
            $this->__ajaxReturn(false,'文件缺少内容，请重新上传！');
        //解析xls文件
        $uu_file_name = '/var/tmp/'.CommonFuncs::getUUID().'.'.$fileInfo['file_ext'];
        $oss_file_data = $this->oSS->getObject($fileInfo['file_name']);
        if (!$oss_file_data['success'])
            $this->__ajaxReturn(false,'文件解析失败'.$oss_file_data['msg']);
        file_put_contents($uu_file_name,$oss_file_data['data'] );
        $xls_data = CommonFuncs::parseXLS2($uu_file_name, 2);
        //删除文件
        @unlink($uu_file_name);
        if(!$xls_data || !is_array($xls_data))
            $this->__ajaxReturn('文件解析失败，请检查文件内容！');
        //初始化数据
        $skusArr = array();
        //整理数据
        foreach($xls_data as $line) {
            $skusArr[]   = trim($line['1']);
        }
        if (empty($skusArr))
            $this->__ajaxReturn(false, '缺少SKU');

        if(empty($_FILES))
            $this->__ajaxReturn(false, '文件丢失');
        $tempFile = $_FILES['Filedata']['tmp_name'];
        $fileParts = pathinfo($_FILES['Filedata']['name']);
        if (strtolower($fileParts['extension']) !== 'zip')
            $this->__ajaxReturn(false, '目前只支持 ZIP 文件解压缩！');
        //打开资源
        $resource = zip_open($tempFile);
        //产生一个随机名称
        $path = '/var/tmp/'.CommonFuncs::getUUID().'/';
        mkdir($path,0777,true);
        $validFilePathArr = array();
        //遍历读取压缩包里面的一个个文件
        while($dir_resource = zip_read($resource)) {
            //如果能打开则继续
            if (zip_entry_open($resource,$dir_resource)) {
                //获取当前项目的名称,即压缩包里面当前对应的文件名
                $file_name = CommonFuncs::myIconv($path.zip_entry_name($dir_resource));
                if (empty($file_name))
                    continue;
                $path_arr  = explode('/',$file_name);
                if (in_array('__MACOSX', $path_arr))
                    continue;
                if(!is_dir($file_name)){
                    //读取这个文件
                    $file_size = zip_entry_filesize($dir_resource);
                    //最大读取1M，如果文件过大，跳过解压，继续下一个
                    if($file_size <= 1024*1024*4 ){
                        $file_content = zip_entry_read($dir_resource,$file_size);
                        file_put_contents($file_name,$file_content);
                        $skusArr = explode('.', basename($file_name));
                        $sku = $skusArr[0];
                        $validFilePathArr[$sku] = $file_name;
                    } else {
                        $this->__ajaxReturn(false, $file_name.'文件过大，大于4M');
                    }
                }
                //关闭当前
                zip_entry_close($dir_resource);
            }
        }
        zip_close($resource);
        //存库
        $resArr = $ossDataArr = array();
        foreach ($validFilePathArr as $sku => $flie_path_name){
            //上传到OSS
            $file_ext = pathinfo($flie_path_name, PATHINFO_EXTENSION);
            $oss_file_name = date('Ym')."/".date('d')."/".date('H')."/".CommonFuncs::getUUID().".".$file_ext;
            $file_id = $this->baseFileID->getMaxId();
            $ossDataArr[] = array(
                'file_id'   => $file_id,
                'trader_id' => '0',
                'flie_path' => $flie_path_name,
                'file_name' => $oss_file_name,
                'sku'       => $sku,
                'is_upload' => '0',
                'ctime'     => date('Y-m-d H:i:s')
            );
            $data = array(
                'id'            => $file_id,
                'ctime'         => date('Y-m-d H:i:s'),
                'file_name'     => $oss_file_name,
                'original_name' => $flie_path_name,
                'mime_type'     => mime_content_type($flie_path_name),
                'file_size'     => filesize($flie_path_name),
                'file_ext'      => $file_ext,
                'file_owner'    => $mobile,
                'is_img'        => 0,//是否图片
            );
            $res = $this->baseDbFile->add(CommonFuncs::calc_hash_db($file_id),$data);
            if ($res){
                $resArr[$sku] = array(
                    'id'            => $file_id,
                    'file_name'     => $flie_path_name,
                    'file_url'      => $data['file_name']
                );
            }
        }
        if (empty($resArr))
            $this->__ajaxReturn(false, '文件解析失败！');
        else {
            $res = $this->ossUpload->batchAdd($ossDataArr);
            if ($res)
                $this->__ajaxReturn(true, '解析成功！',$resArr);
            else
                $this->__ajaxReturn(false,'图片解析失败！');
        }
    }
    public function testAction(){
        echo exec("php ".__DIR__."/../../exec/oss_upload.php");
    }
}