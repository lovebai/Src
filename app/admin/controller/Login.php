<?php
//登录

namespace app\admin\controller;


use think\facade\Db;
use think\facade\Request;
use think\facade\Session;
use think\facade\View;

class Login
{

    public function index(){
        if(Session::has("USER_ID")&&Session::has('USER_NAME')){
            return redirect(url("./"));
        }else{
            return View::fetch("/login");
        }
    }

    //验证登录
    public function login(){
        $username=$this->xss(Request::post("username"));//用户名
        $password=$this->passAdmin(Request::post("password"));//密码
        if(!captcha_check(Request::post('code'))){
            return json(array(
                'code'=>203,
                'msg'=>'验证码输入错误！'
            ));
        }//验证码

        $data=array(
            'username'=>$username,
            'password'=>$password
        );
        $result=Db::name('admin')->where($data)->find();

        if(!empty($result)){
            if($result['status']==0){
                return json(array(
                    'code'=>201,
                    'msg'=>'用户已被禁用'
                ));
            }

            if($result['password']==$password){
                Session::set("USER_ID",$result['id']);
                Session::set("USER_NAME",$result['username']);
                $resp=array(
                    'code'=>200,
                    'url'=>"./",
                    'msg'=>"登录成功"
                );
                return json($resp);
            }
        }else{
            $resp=array(
                'code'=>201,
                'msg'=>"登录失败，账号或密码错误！"
            );
            return json($resp);
        }
    }

    //退出登录
    public function logout()
    {
        Session::clear();
        return redirect(url("./login"));
    }

    function passAdmin($pass){
        return sha1(md5($pass).'xiaobai');
    }

    //防止XSS
    function xss($val) {
        $val = preg_replace('/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/', '', $val);
        $search = 'abcdefghijklmnopqrstuvwxyz';
        $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $search .= '1234567890!@#$%^&*()';
        $search .= '~`";:?+/={}[]-_|\'\\';
        for ($i = 0; $i < strlen($search); $i++) {
            $val = preg_replace('/(&#[xX]0{0,8}'.dechex(ord($search[$i])).';?)/i', $search[$i], $val); // with a ;
            $val = preg_replace('/(&#0{0,8}'.ord($search[$i]).';?)/', $search[$i], $val); // with a ;
        }
        $ra1 = array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'style', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base');
        $ra2 = array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');
        $ra = array_merge($ra1, $ra2);
        $found = true; // keep replacing as long as the previous round replaced something
        while ($found == true) {
            $val_before = $val;
            for ($i = 0; $i < sizeof($ra); $i++) {
                $pattern = '/';
                for ($j = 0; $j < strlen($ra[$i]); $j++) {
                    if ($j > 0) {
                        $pattern .= '(';
                        $pattern .= '(&#[xX]0{0,8}([9ab]);)';
                        $pattern .= '|';
                        $pattern .= '|(&#0{0,8}([9|10|13]);)';
                        $pattern .= ')*';
                    }
                    $pattern .= $ra[$i][$j];
                }
                $pattern .= '/i';
                $replacement = substr($ra[$i], 0, 2).'<x>'.substr($ra[$i], 2); // add in <> to nerf the tag
                $val = preg_replace($pattern, $replacement, $val); // filter out the hex tags
                if ($val_before == $val) {
                    // no replacements were made, so exit the loop
                    $found = false;
                }
            }
        }
        return $val;
    }

}