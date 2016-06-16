<!-- 获取微信昵称、头像等信息方法
在PHP文件里加入以下代码： -->
<?php
require_once("getUserInfo/getUserInfo.php");  //获取微信信息php
$test = new Webweixin();        
$userinfo = $test->get_userinfo();
print_r("headimgurl:".$userinfo['headimgurl']."openid:".$userinfo['openid']."nickname:".$userinfo['nickname']."city:".$userinfo['city']."province:".$userinfo['province']."country:".$userinfo['country']."sex:".$userinfo['sex']);
?>
getgetUserInfo.php文件：
<?php
require_once("weixin.config.php");
class Webweixin
{
//APPID 默认是服务号
var $APPID = APPID1;
var $APPSECRET = APPSECRET1;

//用户方信息（存储当前交互用户的操作状态，以及状态时效）
var $_client = array('wx_id'=>'', 'user_id'=>0, 'act'=>'', 'exp'=>0, 'token'=>'','userdata'=>'');
var $wxu_mod;
var $CODE = '';
//var $_userinfo;
public function get_userinfo()
{
$this->APPID = 'wxd1a93f73a10670a1';
$this->APPSECRET = '2d47501a563bade9d74601d36255d1e7';

if (isset($_GET['code']))
{
$this->CODE =  $_GET['code'];
$userinfo = $this->getUserInfo();
//$_userinfo = $userinfo;
//$json_data = json_decode($response);
//print_r($userinfo);
//."city:".$json_data->{'city'}."province:".$json_data->{'province'}
}
return $userinfo;
}
    function __construct()
    {

    }

public function getUserInfo()
{
$accessToken = $this->getAccessToken();

$cfg['ssl'] = true;
//https://api.weixin.qq.com/sns/userinfo?access_token=ACCESS_TOKEN&openid=OPENID
$userinfo = $this->__curlOpen("https://api.weixin.qq.com/sns/userinfo?access_token=".$accessToken."&openid=".$this->_client['wx_id'].'&lang=zh_CN', $cfg);
$userinfo = json_decode($userinfo,true);
return $userinfo;
}

/**
* 获取ACCESS TOKEN
*/
public function getAccessToken($getHTTP = false)
{
$isCurl = true;
/*
$tokenfile = ROOT_PATH . "/temp/TOKEN_WEB";
$token = file_exists($tokenfile)?file_get_contents($tokenfile):'';
if($token)
{
$token = json_decode($token,true);
if( time()-$token['access_time'] < $token['expires_in']){
$isCurl = false;
}
}*/
        if($isCurl || $getHTTP)
{
//https://api.weixin.qq.com/sns/oauth2/access_token?appid=APPID&secret=SECRET&code=CODE&grant_type=authorization_code
$cfg['ssl'] = true;
$token = $this->__curlOpen("https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$this->APPID."&secret=".$this->APPSECRET."&code=".$this->CODE."&grant_type=authorization_code", $cfg);
$token = json_decode($token,true);
$token['access_time'] = time();
//file_put_contents($tokenfile, json_encode($token), LOCK_EX);
}

$this->_client['wx_id'] = $token['openid'];
//$client = $this->wx_user();
if($client){
$this->_client = $client;
}else{
//$this->wx_user('add');
}
return $token['access_token'];
}
    

public function __curlOpen($url, $cfg)
{
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
//isset($cfg['post']) && curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//if($cfg['ssl'])
//{
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
//}
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
//isset($cfg['post']) && curl_setopt($ch, CURLOPT_POSTFIELDS, $cfg['post']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

//echo "qqqqqqqqqqqqqq";
$result = curl_exec($ch);

if (curl_errno($ch))
{
//echo "wwwwwwwwwww";
return curl_error($ch);
}
//echo "bbbbbbbbb";
curl_close($ch);
return $result;
}

//微信用户信息操作
public function wx_user($act='')
    {
if($this->_client['wx_id'])
{
$this->wxu_mod = &m("weixinuser");
if($act=='add')
{
$this->wxu_mod->add($this->_client);
}elseif($act=='edit'){
$this->wxu_mod->edit("wx_id='".$this->_client['wx_id']."'", $this->_client);
}else{
$client = $this->wxu_mod->get("wx_id='".$this->_client['wx_id']."'");
return $client;
}
}
}
/*$scope : snsapi_base / snsapi_userinfo*/
public function makeStartUrl($url, $state = '', $scope = 'snsapi_userinfo')
{
//https://open.weixin.qq.com/connect/oauth2/authorize?appid=APPID&redirect_uri=REDIRECT_URI&response_type=code&scope=SCOPE&state=STATE#wechat_redirect
$base_url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$this->APPID}&redirect_uri=";
//$base_url .= rawurlencode($url);
$base_url .= $url;
$base_url .= "&response_type=code&scope={$scope}&state={$state}#wechat_redirect";

return $base_url;
}
}
?>
weixin.config.php文件：
<?php
#define APPID1 "wxd1a93f73a10670a1"
#define APPSECRET1 "2d47501a563bade9d74601d36255d1e7"
?>


获取code
https://open.weixin.qq.com/connect/oauth2/authorize?appid=这里是你的公众号的APPID&redirect_uri=http://www.xx.com/getcode&response_type=code&scope=snsapi_userinfo&state=123#wechat_redirect
用户点击确认登录，自动跳转下面地址得到code
http://www.xx.com/getcode 这个是你自己的跳转地址
http://www.xx.com/getcode?code=0064f7afef7af7b395147bfe8b51f7bf&state=123

后面的这个 ?code=……123   是微信自动跳转添加的，不是你自己加的
clip_image001.png
下面是PHP语言，写在getcode这个页面里
1
2
3
4
5
$code = $_GET['code'];//获取code
$weixin =  file_get_contents("https://api.weixin.qq.com/sns/oauth2/access_token?appid=这里是你的APPID&secret=这里是你的SECRET&code=".$code."&grant_type=authorization_code");//通过code换取网页授权access_token
$jsondecode = json_decode($weixin); //对JSON格式的字符串进行编码
$array = get_object_vars($jsondecode);//转换成数组
$openid = $array['openid'];//输出openid
怎么样，是不是灰常的简单？！小皇研究了三四天整理出这么简单的方法

