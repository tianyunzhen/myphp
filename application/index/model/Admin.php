<?php
namespace app\index\model;
use think\Db;
use think\Model;
class Admin extends Model {
	public function getAll()
    {
        $data = Db::table('my_admin')->select();
        return $data;
    }
	public function getLogin($username,$password)
    {
        $data = Db::table('my_admin')->where('username',$username)
                                     ->where('password',$password)->find();
        return $data;
    }
}
?>