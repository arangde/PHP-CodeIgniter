<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/*
 * ajax fix for session data
 */
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

/*
 * define Auth result code
 */
define('AUTH_NO_FOUND', '000');
define('AUTH_SUCCESS', '001');
define('AUTH_FAIL', '002');
define('AUTH_NOTACTIVE', '003');
define('AUTH_NO_FOUND_NAME', '004');

/*
 * define User status
 */
define('USER_CREATE', 'create');
define('USER_ACTIVE', 'active');
define('USER_DEACTIVE', 'deactive');
define('USER_DELETE', 'delete');

/*
 * define User roles
 */
define('USER_ROLE_COMMON', '0');
define('USER_ROLE_ADMIN', '9');

/*
 * define similar limitation
 */
define('SIMILAR_PERCENT_LIMIT', 0);

/*
 * define record limitation
 */
define('RECENT_ROWS_LIMIT', 100);

/*
 * define apns mode
 */
define('APNS_MODE_DEVELOPMENT', false);

/*
 * COOKIE key
 */
define('APP_COOKIE', "linkqlo_cookie_141015_");

/*
 * define user role
 */

define('USER_ROLE_APP_MANAGER', 1);
define('USER_ROLE_OFFICE_MANAGER', 2);
define('USER_ROLE_EMPLOYEE', 3);

/*
 * define user detail
 */
$g_user_employment = array('雇用中', '退職');
$g_user_job_title = array('job0', 'job1', 'job2');
$g_user_office = array('office0','office1','office2', 'office3');
$g_user_sex = array('女性', '男性');

$g_kana = array(
		'0' => array('全', array()),
		'1' => array('あ', array('あ', 'い', 'う', 'え', 'お', 'ア', 'イ', 'ウ', 'エ', 'オ', 'ｱ', 'ｲ', 'ｳ', 'ｴ', 'ｵ')),
		'2' => array('か', array('か', 'き', 'く', 'け', 'こ', 'が', 'ぎ', 'ぐ', 'げ', 'ご', 'カ', 'キ', 'ク', 'ケ', 'コ','ガ', 'ギ', 'グ', 'ゲ', 'ゴ', 'ｶ', 'ｷ', 'ｸ', 'ｹ', 'ｺ', 'ｶﾞ', 'ｷﾞ', 'ｸﾞ', 'ｹﾞ', 'ｺﾞ')),
		'3' => array('さ', array('さ', 'し', 'す', 'せ', 'そ', 'ざ', 'じ', 'ず', 'ぜ', 'ぞ','サ', 'シ', 'ス', 'セ', 'ソ','ザ', 'ジ', 'ズ', 'ゼ', 'ゾ', 'ｻ', 'ｼ', 'ｽ', 'ｾ', 'ｿ', 'ｻﾞ', 'ｼﾞ', 'ｽﾞ', 'ｾﾞ', 'ｿﾞ')),
		'4' => array('た', array('た', 'ち', 'つ', 'て', 'と', 'だ', 'ぢ', 'づ', 'で', 'ど','タ', 'チ', 'ツ', 'テ', 'ト', 'ダ', 'ヂ', 'ヅ', 'デ', 'ド', 'ﾀ', 'ﾁ', 'ﾂ', 'ﾃ', 'ﾄ', 'ﾀﾞ', 'ﾁﾞ', 'ﾂﾞ', 'ﾃﾞ', 'ﾄﾞ')),
		'5' => array('な', array('な', 'に', 'ぬ', 'ね', 'の',  'ナ', 'ニ', 'ヌ', 'ネ', 'ノ',  'ﾅ', 'ﾆ', 'ﾇ', 'ﾈ', 'ﾉ')),
		'6' => array('は', array('は', 'ひ', 'ふ', 'へ', 'ほ', 'ば', 'び', 'ぶ', 'べ', 'ぼ','ぱ', 'ぴ', 'ぷ', 'ぺ', 'ぽ','ハ', 'ヒ', 'フ', 'ヘ', 'ホ', 'バ', 'ビ', 'ブ', 'ベ', 'ボ', 'パ', 'ピ', 'プ', 'ペ', 'ポ', 'ﾊ', 'ﾋ', 'ﾌ', 'ﾍ', 'ﾎ', 'ﾊﾞ', 'ﾋﾞ', 'ﾌﾞ', 'ﾍﾞ', 'ﾎﾞ', 'ﾊﾟ', 'ﾋﾟ', 'ﾌﾟ', 'ﾍﾟ', 'ﾎﾟ')),
		'7' => array('ま', array('ま', 'み', 'む', 'め', 'も', 'マ', 'ミ', 'ム', 'メ', 'モ', 'ﾏ', 'ﾐ', 'ﾑ', 'ﾒ', 'ﾓ')),
		'8' => array('や', array('や', 'ゆ', 'よ', 'ヤ', 'ユ', 'ヨ', 'ﾔ', 'ﾕ', 'ﾖ')),
		'9' => array('ら', array('ら', 'り', 'る', 'れ', 'ろ', 'ラ', 'リ', 'ル', 'レ', 'ロ', 'ﾗ', 'ﾘ', 'ﾙ', 'ﾚ', 'ﾛ')),
		'10' => array('わ', array('わ', 'を', 'ん', 'ワ', 'ヲ', 'ン', 'ﾜ', 'ｦ', 'ﾝ')),
		'11' => array('他', array())
	);

$g_contract_service = array(array('介護サービス', array('訪問介護', '訪問入浴介護', '訪問リハビリテーション', '通所介護', '通所リハビリテーション', '福祉用具貸与', 
						'居宅介護支援')),
					array('予防介護サービス', array('予防訪問介護', '予防訪問入浴介護', '予防訪問リハビリテーション', '予防通所介護')),
					array('地域密着型サービス', array('夜間訪問介護', '認知症通所介護', '予防認知症通所介護', '地域密着型通所介護')),
					array('介護予防・日常生活支援総合事業', array('訪問型サービス', '通所型サービス', '介護予防ケアマネージメント')),
					array('その他サービス', array('有料老人ホーム', 'サービス付き高齢者向け住宅'))
				);
$g_certification_status = array('認定状況1', '認定状況2', '認定状況3');
$g_protect_degree = array('介護度1', '介護度2', '介護度3');

$g_day_of_week = array("日", "月", "火", "水", "木", "金", "土");
/*
 * define pagination
 */
define('ITEMS_PER_PAGE', 3);




/* End of file constants.php */
/* Location: ./application/config/constants.php */