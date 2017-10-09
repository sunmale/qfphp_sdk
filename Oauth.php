<?php


namespace qf;
use qf\oauth\Qq;

class Oauth
{

    //当前类对象
    private static $instances;
    //邮件发送基本配置
    private $_config = array(
        'qq' => [
            'appid'=>'101372250',
            'secret'=>'df0f1d7acb6eb29e8722f81acc7c1e27',
            'callback_url'=>'http://www.sunmale.cn'
        ]
    );


    /**初始化邮件配置(用于自定义邮件参数)
     * @param null $options 自定义的邮件发送参数
     * @return mixed
     */
    public function init($options = null)
    {
        if (!empty($options)) {
            $this->_config = array_merge($this->_config, $options);
        }
        return $this;
    }




    /**
     * 实现qq快捷登录
     * @param $code
     * @return mixed
     */
     public  function  oauth_qq($code){
        $res =   Qq::getUserInfo($code,$this->_config);
        return $res ;
     }



    /**
     * 获取授权后返回的code
     * @param string $type  //授权类型
     * @return string
     */
      public  function getCodeByRequestUrl($type){
           if($type=='qq'){
             $url =   Qq::getCode($this->_config);
               return $url;
           }
      }



    /**
     * 获取当前类的对象
     * @return mixed
     * @throws \Exception
     */
    public static function getInstance()
    {
        $args = func_get_args();
        count($args) || $args = array(self::class);
        $key = md5(serialize($args));
        $className = array_shift($args);
        if (!class_exists($className)) {
            throw new \Exception("no class {$className}");
        }
        if (!isset(self::$instances[$key])) {
            $rc = new \ReflectionClass($className);
            self::$instances[$key] = $rc->newInstanceArgs($args);
        }
        return self::$instances[$key];
    }


}
