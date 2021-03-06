<?php
/**
 * The base configurations for BibleApp.
 *
 * This file has the following configurations: MySQL Settings,
 * BASEPATH, Secret Keys.
 *
 * @package BibleApp
 */

//** MySQL Settings - This info should be available from the web host. **//

/** Web Host */
$db_host = '127.0.0.1';

/** MySQL database Username */
$db_user = 'root';

/** MySQL database password */
$db_pass = 'mtFE2MVsM8yFRaBN';

/** MySQL database name */
$db_name = 'bibleapp';

/** MySQL database charset */
$db_charset = 'utf8';

/** MySQL database collate type. Leave blank if unsure. */
$db_collate = '';

$locale = 'en-US';

/** The base path (or absolute path) to the site's root directory. */
define('BASEPATH',          "http://localhost/atatusoft/BibleJunction/bibleapp/");
define('CDNPATH',           BASEPATH . "app/{$locale }/content/");
define('SEARCHLISTPATH',    "app/{$locale }/content/searchlist.txt");
define('ABSSEARCHLISTPATH', BASEPATH . "app/{$locale }/content/searchlist.txt");
define('DEBUGPATH',         BASEPATH . "app/{$locale}/content/log/");
define('FILE_LOOKUP_TABLE', BASEPATH . "app/{$locale}/content/book-lookup-translation-table.json");

/**#@+
 * Authentication Unique Keys and Salts information.
 * Change these to force all users to log in again.
 */
define('AUTH_KEY',         'agkp1sgIi9M}5;L_Ju<ERzf*h&ZFH[Bt*;k|}t}xUR ]i!%M^F{I=G%DYS<_.,+9');
define('SECURE_AUTH_KEY',  'i7PP-8F]Yl:.!p1aI.:xZfc_We|gGOS35%;C`[p8(t+`NzPfx7C(R`u}Ws75e|0q');
define('LOGGED_IN_KEY',    'r1gYWCeCu^q+hMM~c +Ic0q+qj+Z|-qO#,Li^(xb?mb<yY@:>JXD3:-u2aP,aDFN');
define('NONCE_KEY',        '$E+RSNf*vSvT}%P&Y&VGvLLg!X^3X|I)Leb|kH+|+7GSq,UD[VH?26Jj^oj|c<u~');
define('AUTH_SALT',        'i3]t bWM>s{Y^/<_Cc,g_g$I+M` G|{9^T-CgZAu|ymI$[1wAJ M{etW R~ks5v-');
define('SECURE_AUTH_SALT', ')B$ >5|+}dXo.jRrp&muJ;`k(/-E|_F}&w}(@]DUp 6icpmO:MME184Y?E<f 4ne');
define('LOGGED_IN_SALT',   '#x@qqx7]^uhG}1= 6ZJHA]}rLyB_i22M- wsat-N<!2?06>k9,`F/7t1QsV*<t^p');
define('NONCE_SALT',       'Gc-RFFMg+PBBr2l@z+wC_sc-WxN|Qjnki0B7N>%0xCd1.T.AR%F~zgRCAmJgE?T.');

define('APP_VER', '0.0.5');

/**
 * Other useful macros
 */
define('SITE_NAME', 'Bible Junction');
define('SITE_TAGLINE', 'His Word Is A Light Unto Our Feet.');
define('SITE_PREFIX', 'bibleapp_');

/* ERROR type constants */
define('E_TYPE_NEWSLETTER', 'newsletter');

function change_locale($locale)
{
  $this->locale = $locale;
}

/**
 * Important emails
 */
 # Webmaster email
 define('EMAIL_WEBMASTER', 'atatusoft@gmail.com');

 # Contact email
 define('EMAIL_CONTACT', 'atatusoft@gmail.com');

 # Privacy email
 define('EMAIL_PRIVACY', 'atatusoft@gmal.com');

?>
