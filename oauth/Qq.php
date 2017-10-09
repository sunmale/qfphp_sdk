<?php


namespace  qf\oauth;

class Qq   {

    /**
     * 获取requestCode的api接口
     * @var string
     */
    private  static  $GetRequestCodeURL = 'https://graph.qq.com/oauth2.0/authorize';
    /**
     * 获取access_token的api接口
     * @var string
     */
    private  static $GetAccessTokenURL = 'https://graph.qq.com/oauth2.0/token';
    /**
     * 获取request_code的额外参数,可在配置中修改 URL查询字符串格式
     * @var srting
     */
    private  static $Authorize = 'scope=get_user_info,add_share';

    /**
     * 获取用户授权的openid
     * @var string
     */
    private  static $getOpenIdURL = 'https://graph.qq.com/oauth2.0/me';


    /**
     * 通过qq快速登录获取用户信息
     * @param $code
     * @param $data
     * @return mixed
     */
     public   static  function  getUserInfo($code,$data){
         $token_array =  self::getAccessToken($code,$data);
         $user_url =  self::$getOpenIdURL."?access_token=$token_array[access_token]";
         $res_json  =  self::https_request($user_url);
         $data = json_decode(trim(substr($res_json, 9), " );\n"), true);
         return $data;
     }


    /**
     * 获取需要的access_token
     * @param $code
     * @param $data
     * @return mixed
     * @throws \Exception
     */
     public static function  getAccessToken($code,$data){
         $url =  self::$GetAccessTokenURL."?grant_type=authorization_code&client_id=$data[appid]&client_secret=$data[secret]&code=$code&redirect_uri=$data[callback_url]";
         $token_json  =  self::https_request($url);
         parse_str($token_json, $token_array);
         if ($token_array['access_token'] && $token_array['expires_in']) {
             return $token_array;
         }else{
             throw  new \Exception('qq快捷登录获取accessToken失败');
         }
     }



    /**
     * 通过Url获取code
     * @param $data
     * @return string
     */
     public static function  getCode($data){
         $url =  self::$GetRequestCodeURL."?client_id=$data[appid]&redirect_uri=$data[callback_url]&response_type=code&scope=get_user_info&state=1#wechat_redirect";
         return $url ;
     }


    /**
     * curl模拟http请求
     * @param $url
     * @param null $data
     * @return mixed
     */
   public  static function https_request($url, $data = null)
    {
        $curl = curl_init();
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

