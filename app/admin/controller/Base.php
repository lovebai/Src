<?php


namespace app\admin\controller;

use PHPMailer\PHPMailer\PHPMailer;
use think\Response;

/**
 * Class Base
 * @package app\admin\controller
 */
abstract class Base
{
    /**
     * @var string[]
     */
    protected $middleware = ['Auth'];

    /**
     * @param $data
     * @param int $code  状态码
     * @param string $msg 提示
     * @param int $count 提示
     * @param string $type 类型
     * @return Response
     */
    protected function create_return($data, int $code, string $msg='Succee', int $count,string $type='json'): Response
    {
        //标准API生成
        $result=[
            'code'=>$code,
            'msg'=>$msg,
            'count'=>$count,
            'data'=>$data
        ];
        //返回api
        return Response::create($result,$type);

    }


    /**
     * @param $pass
     * @return string
     */
    protected function passAdmin($pass){
        return sha1(md5($pass).'xiaobai');
    }

    /**
     * @param $pass
     * @return string
     */
    protected function passUser($pass){
        return sha1(md5($pass).'bai');
    }


    /**
     * @param $host
     * @param $name
     * @param $user
     * @param $pass
     * @param $form
     * @param $to
     * @param $title
     * @param $content
     * @return bool
     * @throws \PHPMailer\PHPMailer\Exception
     */
    protected function sendMail($host, $name, $user, $pass, $form, $to, $title, $content)
    {


        //实例化PHPMailer核心类
        $mail = new PHPMailer();

        //是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
        $mail->SMTPDebug = 0;

        //使用smtp鉴权方式发送邮件
        $mail->isSMTP();

        //smtp需要鉴权 这个必须是true
        $mail->SMTPAuth = true;

        //链接qq域名邮箱的服务器地址
        $mail->Host = $host;

        //设置使用ssl加密方式登录鉴权
        $mail->SMTPSecure = 'ssl';

        //设置ssl连接smtp服务器的远程服务器端口号，以前的默认是25，但是现在新的好像已经不可用了 可选465或587
        $mail->Port = 465;

        //设置smtp的helo消息头 这个可有可无 内容任意
        // $mail->Helo = 'Hello smtp.qq.com Server';

        //设置发件人的主机域 可有可无 默认为localhost 内容任意，建议使用你的域名
        $mail->Hostname = '';

        //设置发送的邮件的编码 可选GB2312 我喜欢utf-8 据说utf8在某些客户端收信下会乱码
        $mail->CharSet = 'UTF-8';

        //设置发件人姓名（昵称） 任意内容，显示在收件人邮件的发件人邮箱地址前的发件人姓名
        $mail->FromName = $name;

        //smtp登录的账号 这里填入字符串格式的qq号即可
        $mail->Username = $user;

        //smtp登录的密码 使用生成的授权码（就刚才叫你保存的最新的授权码）
        $mail->Password = $pass;

        //设置发件人邮箱地址 这里填入上述提到的“发件人邮箱”
        $mail->From = $form;

        //邮件正文是否为html编码 注意此处是一个方法 不再是属性 true或false
        $mail->isHTML(true);

        //设置收件人邮箱地址 该方法有两个参数 第一个参数为收件人邮箱地址 第二参数为给该地址设置的昵称 不同的邮箱系统会自动进行处理变动 这里第二个参数的意义不大
        $mail->addAddress($to,'');

        //添加多个收件人 则多次调用方法即可
        // $mail->addAddress('xxx@163.com','');

        //添加该邮件的主题
        $mail->Subject = $title;

        //添加邮件正文 上方将isHTML设置成了true，则可以是完整的html字符串 如：使用file_get_contents函数读取本地的html文件
        $mail->Body = $content;

        //为该邮件添加附件 该方法也有两个参数 第一个参数为附件存放的目录（相对目录、或绝对目录均可） 第二参数为在邮件附件中该附件的名称
        // $mail->addAttachment('./d.jpg','mm.jpg');
        //同样该方法可以多次调用 上传多个附件
        // $mail->addAttachment('./Jlib-1.1.0.js','Jlib.js');

        $status = $mail->send();

        //简单的判断与提示信息
        if ($status) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * @param $url
     * @param null $data
     * @return bool|string
     */
    protected function http_request($url, $data = null){
        $headers=array(
            'User-Agent'=>'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.85 Safari/537.36',
            'Accept'=>'text/html,application/xhtml+xml,application/xml'
        );
        $curl = curl_init();
        if( count($headers) >= 1 ){
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        }
        curl_setopt($curl, CURLOPT_URL, $url);

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);

        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }

}





