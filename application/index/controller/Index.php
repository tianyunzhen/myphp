<?php
namespace app\index\controller;
use think\Controller;
use think\Loader;
use think\Db;
use app\index\model\Admin;
use app\index\view\Checklogin;
use \think\Request;
class Index extends Controller {
	
	public function doUpload()
    {
    // 获取上传文件
    $file = request() -> file('myfile');       
    // 验证图片,并移动图片到框架目录下。
    $info = $file -> validate(['size' => 512000,'ext' => 'jpg,png,jpeg','type' => 'image/jpeg,image/png']) -> move(ROOT_PATH.'public'.DS.'uploads');
    if($info){
        // $info->getExtension();         // 文件扩展名
        $mes = $info->getFilename();      // 文件名
        echo '{"mes":"'.$mes.'"}';
    }else{
        // 文件上传失败后的错误信息
        $mes = $file->getError();
        echo '{"mes":"'.$mes.'"}';
    }
    }
    public function dodUpload()
    {
    // 获取上传文件
    $file = request() -> file('myfile');       
    // 验证图片,并移动图片到框架目录下。
    $info = $file -> validate(['size' => 512000,'ext' => 'jpg,png,jpeg','type' => 'image/jpeg,image/png']) -> move(ROOT_PATH.'public'.DS.'uploads');
    if($info){
        // $info->getExtension();         // 文件扩展名
        $mes = $info->getFilename();      // 文件名
        echo '{"mes":"'.$mes.'"}';
    }else{
        // 文件上传失败后的错误信息
        $mes = $file->getError();
        echo '{"mes":"'.$mes.'"}';
    }
    }

	
	public function upload(){
       return $this -> fetch();
	}
	public function dupload(){
       return $this -> fetch();
	}
	public function show() {
	$page =	input('post.pageNum');
    $total = Db::table('my_admin')->count();
    
    
    $pageSize = 3;
    //每页显示数
    $totalPage = ceil($total / $pageSize);
    //总页数
    $startPage = $page * $pageSize;
    //开始记录
    //构造数组
    
    $arr['total'] = $total;
    $arr['pageSize'] = $pageSize;
    $arr['totalPage'] = $totalPage;
	
	$sql="select * from my_admin limit ".$startPage.",".$pageSize;
	$list = Db::query($sql);

    foreach($list as $row) {
        $arr['list'][] = array('id' => $row['id'], 'username' => $row['username'], 'password' => $row['password'], );
    }
    
    echo json_encode($arr);
    }
	
	public function index() {
		return $this -> fetch();
	}
	public function login() {
		return $this -> fetch();
	}
    public function check()
    {
        $username=input('post.username');
		$password=input('post.password');
        $data = [
        'username'=>$username,
        'password'=>$password
        ];
        $validate = Loader::validate('Checklogin');
        if(!$validate->check($data)){
        	$result = array('msg' => 'failed', );
        }
		else{
			$admin=new Admin();
			$list=$admin->getLogin($username, $password);
			if ($list!=null) {
				$result = array('msg' => 'success', );
			}
			else{
				$result = array('msg' => 'failed', );
			}
			
		}
		echo json_encode($result);
    }
    public function ajax_upload(){
        // 根据自己的业务调整上传路径、允许的格式、文件大小
        ajax_upload('/Upload/image/');
    }

    /**
     * webuploader 上传demo
     */
    public function webuploader(){
    	$request = request();
        // 如果是post提交则显示上传的文件 否则显示上传页面
        if($request->isPost()){
            p($_POST);die;
        }else{
            return $this -> fetch();
        }
    }
	public function wp(){
		
        // 根据自己的业务调整上传路径、允许的格式、文件大小
        return $this -> fetch();
    }
}
?>