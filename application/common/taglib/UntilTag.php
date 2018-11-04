<?php
namespace app\common\taglib;
 
use \think\template\TagLib;
 
class UntilTag extends TagLib
{
    protected $tags = array(
        'breadcrumb' => array('attr' => 'name','close' =>0),
    );
 
    /**
     * 用法
     * {UntilTag:breadcrumb name='个人中心/修改密码' /}
     * @param $tag
     * @param $content
     * @return string
     * @autor: 潘国兴
     */
    public function tagBreadcrumb($tag, $content)
    {
        $tags = '';
        if(isset($tag['name']) && !empty($tag['name']))
        {
            $tags = explode('/',$tag['name']);
        }
        $parseStr =  '<nav class="breadcrumb"><i class="Hui-iconfont"></i> <a class="maincolor" href="{:url("index")}">首页</a>' ;
        if(!empty($tags))
        {
            foreach($tags as $vo)
            {
                $parseStr .= "<span class='c-666 en'>></span><span class='c-666'>{$vo}</span>";
            }
        }
        $parseStr .= '</nav>';
        return $parseStr;
    }
}
