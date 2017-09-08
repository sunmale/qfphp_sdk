<?php

namespace  Qf\Config;

class MailConfig
{

    //默认配置
    protected static $_config = array(

        'qq'=>[
            'email_host'             => 'smtp.qq.com',          // smtp
            'email_account'         => '1982127547@qq.com',    // 邮箱账号
            'email_password'         => 'yqwqqcvhkutbccde',   // 密码  注意: 163和QQ邮箱是授权码；不是登录的密码
            'email_secure'      => 'ssl',                    // 链接方式 如果使用QQ邮箱；需要把此项改为  ssl
            'email_port'             => '465',              // 端口 如果使用QQ邮箱；需要把此项改为  465
            'email_username'        => '晴枫博客',             // 发件人
        ]
    );


    //得到需要的配置信息，封装成一个数组返回
    public static  function  getConfig(){
        return self::$_config;
    }

}
