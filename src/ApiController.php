<?php
namespace ucenter;


use think\Config;

class ApiController
{
    use Util;

    private $allow = [];

    public function run(){
        $config = Config::get("ucenter");
        $this->allow = $config['ALLOW_ACTION'];

        $code = input('code');

        parse_str(self::authcode($code, 'DECODE', $config['UC_KEY']), $get);

//        if(time() - $get['time'] > 60) {
//            exit('Authracation has expiried');
//        }
        if(empty($get)) {
            exit('Invalid Request');
        }
        include_once 'xml.class.php';
        $p_input = file_get_contents('php://input');
        $post = xml_unserialize($p_input);

        if(in_array($get['action'],$this->allow)){
            $api = new ApiUtil($config);
            call_user_func_array([$api,$get['action']],[$get,$post]);
        }else{
            exit(-1);
        }
    }
}