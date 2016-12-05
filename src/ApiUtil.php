<?php
namespace ucenter;

define('API_RETURN_SUCCEED', '1');

class ApiUtil
{

    use Util;

    public $get = [];

    public $post = [];

    public  function synlogin()
    {
        $uid = $this->get['uid'];
        $username = $this->get['username'];

        /*

        同步登陆代码

        */
        return API_RETURN_SUCCEED;
    }

    public  function synlogout()
    {

        /*

        同步注销代码

        */
        return API_RETURN_SUCCEED;
    }

    public function __call($function, $arguments)
    {
        if (method_exists($this, $function)) {
            return call_user_func_array([$this, $function], $arguments);
        } else {
            throw new Exception("function not exists");
        }
    }
}