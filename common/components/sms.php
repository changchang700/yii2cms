<?php
namespace common\components;
 
use yii\base\Component;
use yii;

class sms extends Component {
 
    //定义get函数
    private static function curl_get($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $dom = curl_exec($ch);
        curl_close($ch);
        return $dom;
    }

    private static function send($phone, $msg) {
        $accesskey = "百度来信码 开通及可以获取accesskey";
        $secretkey = "百度来信码 开通及可以获取sercetkey";
        $url = "http://imlaixin.cn/Api/send/data/json?accesskey={$accesskey}&secretkey={$secretkey}&mobile={$phone}&content=" . urlencode($msg);

        $json = self::curl_get($url);
        $arr = json_decode($json, true);

        if ($arr['result'] == '01') {
            return true;
		}else{
			return false;
		}
    }

	/**
	 * 发送短信验证码
	 * @param type $phone 手机号码
	 * @param type $checkCode 验证码
	 * @return type
	 */
    public function sendCheckCode($phone, $checkCode) {
        $msg = "正在进行手机验证，验证码：" . $checkCode . "，15分钟内有效【Aili】";
        return self::send($phone, $msg);
    }
	public function sendRestPassword($phone,$url){
		$url = $this->getShortUrl($url);
		$msg = "您好，修改密码请登录{$url}【Aili】";
		return self::send($phone, $msg);
	}
	public function getShortUrl($url){
		$api = 'http://api.t.sina.com.cn/short_url/shorten.json'; // json
		$source = '2839994601';
		$request_url = sprintf($api.'?source=%s&url_long=%s', $source, $url);
		$data = $this->curl_get($request_url);
		$data = json_decode($data,true);
		return $data[0]['url_short'];
	}
}
