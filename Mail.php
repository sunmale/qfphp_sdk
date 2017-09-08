<?php

namespace  Qf;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Qf\Config\MailConfig;

class Mail{
    //发送邮件
    public  static function   sendMail($user,$data,$type='qq')
    {
        try {
            $mail = new PHPMailer(true);
            $config = MailConfig::getConfig()[$type];
            //Server settings
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output  开启调试模式 （默认 0 表示关闭调试模式）
            $mail->isSMTP();                                       // Set mailer to use SMTP   启用SMTP
            $mail->Host = $config['email_host'];                    // Specify main and backup SMTP servers      服务器地址
            $mail->SMTPAuth = true;                               // Enable SMTP authentication     开启SMTP验证
            $mail->Username =$config['email_account'];                 // SMTP username     SMTP 用户名（你要使用的邮件发送账号）
            $mail->Password =$config['email_password'];                           // SMTP password     SMTP 密码
            $mail->SMTPSecure =$config['email_secure'];                            // Enable TLS encryption, `ssl` also accepted   开启TLS 可选
            $mail->Port = $config['email_port'];                                    // TCP port to connect to     端口
            //Recipients
            $mail->setFrom($config['email_account'], $config['email_username']);       //来自
            $mail->addAddress($user['email'], $user['name']);     // Add a recipient     // 添加一个收件人
            // $mail->addAddress('429143652@qq.com');               // Name is optional     // 可以只传邮箱地址
            //$mail->addReplyTo('1982127547@qq.com', 'Information');          // 回复地址
            // $mail->addCC('cc@example.com');
            //  $mail->addBCC('bcc@example.com');
            //Attachments
            //  $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments       // 添加附件
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name       // 可以设定名字
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML            // 设置邮件格式为HTML
            $mail->Subject = $data['title'];
            $mail->Body    = $data['html'];
            $mail->AltBody = 'xxx';
           $res =  $mail->send();
           return $res;
        } catch (Exception $e) {
            Log::error('出错位置:Mail.php,错误信息'.$mail->ErrorInfo);
            return false;
        }
    }




    //初始化邮件配置
    public static  function  init()
    {


    }



    /**
     * 自定义html模板
     * @param $data
     * @return string
     */
    public  static function  selfDefineHtml($data){

        return $data;

    }

}



