<?php

namespace  Qf\Config;

class MailConfig
{

    //默认配置
    protected static $_config = array(

        'qq'=>[
            'email_host'             => '',          // smtp
            'email_account'         => '',    // 邮箱账号
            'email_password'         => '',   // 密码  注意: 163和QQ邮箱是授权码；不是登录的密码
            'email_secure'      => '',                    // 链接方式 如果使用QQ邮箱；需要把此项改为  ssl
            'email_port'             => '',              // 端口 如果使用QQ邮箱；需要把此项改为  465
            'email_username'        => '',             // 发件人
        ]
    );


    /**得到需要的配置信息，封装成一个数组返回
     * @param null $options  //自定配置参数
     * @return array
     */
    public static  function  getConfig($options=null){
        if(!empty($options)){
            self::$_config = array_merge(self::$_config,$options);
        }
        return self::$_config;
    }



}
