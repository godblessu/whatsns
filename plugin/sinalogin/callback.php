<?php
error_reporting ( 0 );
define ( 'ASK2_ROOT', dirname ( dirname ( dirname ( __FILE__ ) ) ) . DIRECTORY_SEPARATOR );
define ( 'BASEPATH', ASK2_ROOT . 'system' );
define ( 'SITE_URL', 'http://' . $_SERVER ['HTTP_HOST'] . '/' );
include_once ('config.php');
include_once ('saetv2.ex.class.php');
require_once ("../../lib/db_mysqli.php");

include ASK2_ROOT . 'application' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'database.php';
$dbconfig = $db ['default'];
$db = new db ();
define ( 'DB_TABLEPRE', $dbconfig ['dbprefix'] );
$config = array ();
$config ['hostname'] = $dbconfig ['hostname'];
$config ['username'] = $dbconfig ['username'];
$config ['password'] = $dbconfig ['password'];
$config ['database'] = $dbconfig ['database'];
$config ['charset'] = $dbconfig ['char_set'];
$config ['autoconnect'] = 1;
$config ['dbport'] = 3306;
$config ['debug'] = true;
$db->open ( $config );
$setting = require (ASK2_ROOT . 'data/cache/setting.php');

$o = new SaeTOAuthV2 ( WB_AKEY, WB_SKEY );
if (isset ( $_REQUEST ['code'] )) {
	$keys = array ();
	$keys ['code'] = $_REQUEST ['code'];
	$keys ['redirect_uri'] = WB_CALLBACK_URL;
	try {
		$token_arr = $o->getAccessToken ( 'code', $keys );
	} catch ( OAuthException $e ) {
		echo $e->getMessage ();
		exit ();
	}
}

if ($token_arr) {

	$openid = $token_arr ['uid'];
	$token = $token_arr ['access_token'];

	$c = new SaeTClientV2 ( WB_AKEY, WB_SKEY, $token );

	$sid = tcookie ( 'sid' );
	$auth = tcookie ( 'auth' );
	$user = array ();

	list ( $uid, $password ) = empty ( $auth ) ? array (0, 0 ) : taddslashes ( explode ( "\t", authcode ( $auth, 'DECODE' ) ), 1 );

	if ($uid && $password) {
		$user = get_user ( $uid );
		if ($password != $user ['password']) {
			$user = array ();
		}
	}

	if (! $user) {
		$user = get_by_openid ( $openid );
	} else {
		remove_auth ( $openid );
		add_auth ( $token, $openid, $uid );
		header ( "Location:" . url('user/mycategory') );
		exit ();
	}

	if ($user) {
		add_auth ( $token, $openid, $uid );

		refresh ( $user );

		// echo SITE_URL;exit();
		header ( "Location:" . SITE_URL );
		exit ();
	} else {

		if (! $setting ['allow_register']) {
			header ( "Content-Type: text/html;charset=utf-8" );
			exit ( "系统注册功能暂时处于关闭状态!" );
		}

		$userinfo = $c->show_user_by_id ( $openid );

		$token_arr ['username'] = $userinfo ['screen_name'];
		$token_arr ['gender'] = $userinfo ['gender'];
		$token_arr ['type'] = 'sina';
		$token_arr ['profile_image_url'] = $userinfo ['profile_image_url'];
		$token_arr ['sinalogin_avatar'] = $userinfo ['sinalogin_avatar'];
		session_start();
		unset($_SESSION ['authinfo']);
		$_SESSION['authinfo'] = $token_arr;

		header ( "Location:" . url ( 'user/login' ) . "?oauth_provider=SinaWeiboProvider&code=" . $_REQUEST ['code'] );
		exit ();

	//		$gender = 2;
	//		if ($userinfo ['gender'] == 'm') {
	//			$gender = 1;
	//		} else if ($userinfo ['gender'] == 'f') {
	//			$gender = 0;
	//		}
	//		$randpasswd = strtolower ( random ( 6, 1 ) );
	//		$uid = add_user ( $userinfo ['screen_name'], $randpasswd, $gender, $token, $openid );
	//		$userid = $uid;
	//		if ($uid && $setting ['sinalogin_avatar']) {
	//			$avatardir = "/data/avatar/";
	//			$uid = sprintf ( "%09d", $uid );
	//			$dir1 = $avatardir . substr ( $uid, 0, 3 );
	//			$dir2 = $dir1 . '/' . substr ( $uid, 3, 2 );
	//			$dir3 = $dir2 . '/' . substr ( $uid, 5, 2 );
	//			(! is_dir ( ASK2_ROOT . $dir1 )) && forcemkdir ( ASK2_ROOT . $dir1 );
	//			(! is_dir ( ASK2_ROOT . $dir2 )) && forcemkdir ( ASK2_ROOT . $dir2 );
	//			(! is_dir ( ASK2_ROOT . $dir3 )) && forcemkdir ( ASK2_ROOT . $dir3 );
	//			$smallimg = $dir3 . "/small_" . $uid . '.jpg';
	//			get_remote_image ( $userinfo ['profile_image_url'], ASK2_ROOT . $smallimg );
	//			$user = get_user ( $uid );
	//			$redirect = url ( "user/profile", 1 );
	//			$subject = "恭喜您在" . $setting ['site_name'] . "注册成功！";
	//			$content = '您可以正常提问和回答了!您的登录用户名是 ' . $user ['username'] . ',登录密码是 ' . $randpasswd . ',为了保证您的账号安全，请及时修改密码，完善个人信息!<br /><a href="' . $redirect . '">请点击此处完善个人信息</a>';
	//			$db->query ( 'INSERT INTO ' . DB_TABLEPRE . "message  SET `from`='" . $setting ['site_name'] . "' , `fromuid`=0 , `touid`=$userid  , `subject`='$subject' , `time`=" . time () . " , `content`='$content'" );
	//			refresh ( $user );
	//			header ( "Location:" . SITE_URL );
	//			exit ();
	//		}
	//		$user = get_user ( $userid );
	//		$redirect = url ( "user/profile", 1 );
	//		$subject = "恭喜您在" . $setting ['site_name'] . "注册成功！";
	//		$content = '您可以正常提问和回答了!您的登录用户名是 ' . $user ['username'] . ',登录密码是 ' . $randpasswd . ',为了保证您的账号安全，请及时修改密码，完善个人信息!<br /><a href="' . $redirect . '">请点击此处完善个人信息</a>';
	//		$db->query ( 'INSERT INTO ' . DB_TABLEPRE . "message  SET `from`='" . $setting ['site_name'] . "' , `fromuid`=0 , `touid`=$userid  , `subject`='$subject' , `time`=" . time () . " , `content`='$content'" );
	//		refresh ( $user );
	//		header ( "Location:" . SITE_URL );
	}
}

function get_remote_image($url, $savepath) {
	ob_start ();
	readfile ( $url );
	$img = ob_get_contents ();
	ob_end_clean ();
	$size = strlen ( $img );
	$fp2 = @fopen ( $savepath, "a" );
	fwrite ( $fp2, $img );
	fclose ( $fp2 );
	return $savepath;
}
function taddslashes($string, $force = 0) {
	if ($force) {
		if (is_array ( $string )) {
			foreach ( $string as $key => $val ) {
				$string [$key] = taddslashes ( $val, $force );
			}
		} else {
			$string = addslashes ( $string );
		}
	}
	return $string;
}
/* 通用php加解密函数 */

function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {
	global $setting;
	$ckey_length = 4;
	$key = md5 ( $key ? $key : $setting ['auth_key'] );
	$keya = md5 ( substr ( $key, 0, 16 ) );
	$keyb = md5 ( substr ( $key, 16, 16 ) );
	$keyc = $ckey_length ? ($operation == 'DECODE' ? substr ( $string, 0, $ckey_length ) : substr ( md5 ( microtime () ), - $ckey_length )) : '';

	$cryptkey = $keya . md5 ( $keya . $keyc );
	$key_length = strlen ( $cryptkey );

	$string = $operation == 'DECODE' ? base64_decode ( substr ( $string, $ckey_length ) ) : sprintf ( '%010d', $expiry ? $expiry + time () : 0 ) . substr ( md5 ( $string . $keyb ), 0, 16 ) . $string;
	$string_length = strlen ( $string );

	$result = '';
	$box = range ( 0, 255 );

	$rndkey = array ();
	for($i = 0; $i <= 255; $i ++) {
		$rndkey [$i] = ord ( $cryptkey [$i % $key_length] );
	}

	for($j = $i = 0; $i < 256; $i ++) {
		$j = ($j + $box [$i] + $rndkey [$i]) % 256;
		$tmp = $box [$i];
		$box [$i] = $box [$j];
		$box [$j] = $tmp;
	}

	for($a = $j = $i = 0; $i < $string_length; $i ++) {
		$a = ($a + 1) % 256;
		$j = ($j + $box [$a]) % 256;
		$tmp = $box [$a];
		$box [$a] = $box [$j];
		$box [$j] = $tmp;
		$result .= chr ( ord ( $string [$i] ) ^ ($box [($box [$a] + $box [$j]) % 256]) );
	}

	if ($operation == 'DECODE') {
		if ((substr ( $result, 0, 10 ) == 0 || substr ( $result, 0, 10 ) - time () > 0) && substr ( $result, 10, 16 ) == substr ( md5 ( substr ( $result, 26 ) . $keyb ), 0, 16 )) {
			return substr ( $result, 26 );
		} else {
			return '';
		}
	} else {
		return $keyc . str_replace ( '=', '', base64_encode ( $result ) );
	}
}
/* cookie设置和读取 */

function tcookie($var, $value = 0, $life = 0) {
	global $setting;
	if ($life > 36000) {
		$life = 1800;
	}
	$cookiepre = 'whatsns';
	if (0 === $value) {
		$ret = isset ( $_COOKIE [$cookiepre . $var] ) ? $_COOKIE [$cookiepre . $var] : '';
		checkattack ( $var, 'cookie' );
		return $ret;
	} else {
		$domain = $setting ['cookie_domain'] ? $setting ['cookie_domain'] : '';
		checkattack ( $var, 'cookie' );
		setcookie ( $cookiepre . $var, $value, $life ? time () + $life : 0, '/', $domain, $_SERVER ['SERVER_PORT'] == 443 ? 1 : 0 );
	}
}
/* XSS 检测 */

function checkattack($reqarr, $reqtype = 'post') {
	$filtertable = array ('get' => 'sleep\s*?\(.*\)|\'|(and|or)\\b.+?(>|<|=|in|like)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)', 'post' => 'sleep\s*?\(.*\)|\\b(and|or)\\b.{1,6}?(=|>|<|\\bin\\b|\\blike\\b)|\\/\\*.+?\\*\\/|<\\s\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)', 'cookie' => 'sleep\s*?\(.*\)|\\b(and|or)\\b.{1,6}?(=|>|<|\\bin\\b|\\blike\\b)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)' );
	if (is_array ( $reqarr ) && ! empty ( $reqarr )) {
		foreach ( $reqarr as $reqkey => $reqvalue ) {

			if (is_array ( $reqvalue )) {

				checkattack ( $reqvalue, $reqtype );
			}

			if (preg_match ( "/" . $filtertable [$reqtype] . "/is", $reqvalue ) == 1 && ! in_array ( $reqkey, array ('content' ) )) {
				print ('Illegal operation!') ;
				exit ( - 1 );
			}

		}
	}

}
/**
 * getip
 * @return string
 */
function getip() {
	$ip = $_SERVER ['REMOTE_ADDR'];
	if (isset ( $_SERVER ['HTTP_CLIENT_IP'] ) && preg_match ( '/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER ['HTTP_CLIENT_IP'] )) {
		$ip = $_SERVER ['HTTP_CLIENT_IP'];
	} elseif (isset ( $_SERVER ['HTTP_X_FORWARDED_FOR'] ) and preg_match_all ( '#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER ['HTTP_X_FORWARDED_FOR'], $matches )) {
		foreach ( $matches [0] as $xip ) {
			if (! preg_match ( '#^(10|172\.16|192\.168)\.#', $xip )) {
				$ip = $xip;
				break;
			}
		}
	}
	return $ip;
}
function get_user($uid) {
	global $db;
	return $db->fetch_first ( "SELECT * FROM " . DB_TABLEPRE . "user WHERE uid='$uid'" );
}

function get_by_openid($openid) {
	global $db;
	return $db->fetch_first ( "SELECT * FROM " . DB_TABLEPRE . "user AS u," . DB_TABLEPRE . "login_auth as la WHERE u.uid=la.uid AND la.openid='$openid'" );
}

function get_by_username($username) {
	global $db;
	return $db->fetch_first ( "SELECT * FROM " . DB_TABLEPRE . "user WHERE username='$username'" );
}

function get_last_username($username) {
	global $db;
	return $db->fetch_first ( "SELECT * FROM " . DB_TABLEPRE . "user WHERE username LIKE '$username%' ORDER BY uid DESC" );
}
function url($var, $url = '') {
	global $setting;
	// exit($var);
	$location = '?' . $var . $setting ['seo_suffix'];
	if ((false === strpos ( $var, 'admin_' )) && $setting ['seo_on']) {
		$useragent = $_SERVER ['HTTP_USER_AGENT'];

		if (! strstr ( $useragent, 'MicroMessenger' )) {
			$location = $var . $setting ['seo_suffix'];
		}

	}
	return SITE_URL . $location; //程序动态获取的，给question的model使用


}
function add_user($username, $password, $gender, $token, $openid) {
	global $db, $setting;
	$user = get_by_username ( $username );
	$password = md5 ( $password );
	if ($user) {
		$lastuser = get_last_username ( $username );
		$suffix = substr ( $lastuser ['username'], strlen ( $username ) );
		$username = $username . '' . (intval ( $suffix ) + 1);
	}
	$time = time ();
	$db->query ( "INSERT INTO " . DB_TABLEPRE . "user(username,password,email,gender,regip,regtime,`lastlogin`) values ('$username','$password','null',$gender,'" . getip () . "',$time,$time)" );
	$uid = $db->insert_id ();
	$db->query ( "INSERT INTO " . DB_TABLEPRE . "login_auth(uid,type,token,openid,time) values ($uid,'sina','$token','$openid',$time)" );
	$credit1 = $setting ['credit1_register'];
	$credit2 = $setting ['credit2_register'];
	$db->query ( "INSERT INTO " . DB_TABLEPRE . "credit(uid,time,operation,credit1,credit2) VALUES ($uid,$time,'plugin/sinalogin',$credit1,$credit2) " );
	$db->query ( "UPDATE " . DB_TABLEPRE . "user SET credit2=credit2+$credit1,credit1=credit1+$credit2 WHERE uid=$uid " );
	return $uid;
}

function add_auth($token, $openid, $uid) {
	global $db;
	$time = time ();
	$db->query ( "REPLACE INTO " . DB_TABLEPRE . "login_auth(uid,type,token,openid,time) values ($uid,'sina','$token','$openid',$time)" );
}

function remove_auth($openid) {
	global $db;
	$db->query ( "DELETE FROM " . DB_TABLEPRE . "login_auth WHERE openid='$openid'" );
}

function refresh($user) {
	global $db, $setting;
	$uid = $user ['uid'];
	$password = $user ['password'];

	$time = time ();
	$sid = tcookie ( 'sid' );

	$db->query ( "UPDATE " . DB_TABLEPRE . "user SET `lastlogin`=$time  WHERE `uid`=$uid" ); //更新最后登录时间
	$db->query ( "REPLACE INTO " . DB_TABLEPRE . "session (sid,uid,islogin,ip,`time`) VALUES ('$sid',$uid,1,'" . getip () . "',$time)" );
	$auth = authcode ( "$uid\t$password", 'ENCODE' );
	tcookie ( 'auth', $auth );
	tcookie ( 'loginuser', '' );
}

?>
