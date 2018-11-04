<?php
namespace app\index\validate;

use think\Validate;

class Checklogin extends Validate{

    protected $rule = [
        'username'  =>  'require|max:25',
        'password'  =>  'require|max:25',
        
    ];

}
 
?>
