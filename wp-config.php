<?php
# Database Configuration
define( 'DB_NAME', 'wp_rampiqstg' );
define( 'DB_USER', 'rampiqstg' );
define( 'DB_PASSWORD', 'Xdq-fmulOvbPxvfUQLUA' );
define( 'DB_HOST', '127.0.0.1:3306' );
define( 'DB_HOST_SLAVE', '127.0.0.1:3306' );
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');
$table_prefix = 'rq_';

# Security Salts, Keys, Etc
define('AUTH_KEY',         ',Fafo<<Z}u,i]q`B@6}o)Y/DxEtI U]=r+y0-O3j}2,,piH)?L1+-tCDSGJ647)+');
define('SECURE_AUTH_KEY',  '{@<+5+ >GkbRA~06Ee;*zo3H[%AMof!ExitUwFqYT7#=YI`a9[eX[|2rM$f~h-B.');
define('LOGGED_IN_KEY',    'y!ML}+Qajs=8of=FTpPS21:|f45yNjEyjPSbnsEGk/BZ< ^JbD|dLc^iVC<.ZP+ ');
define('NONCE_KEY',        '7m@$ir-LzbzYc]rFQ}jJfzWy)RF1Rn.(2,jd[0?OYxe/3Kv&Ka~ELR8[uv2^U7I|');
define('AUTH_SALT',        '+E{$h- &|#2e[6K+5[idfO-{|+T2ZlLyZU-k[5-|qG(O?2j1TCc]+(K[(kOulv<=');
define('SECURE_AUTH_SALT', 'x7:2:n96~8ztb/&&Zmk^r*Z28c#U2Ya(b;@{_>PC$2V$u=s8^fc>VlO61]IB!HxJ');
define('LOGGED_IN_SALT',   '!.}9NG4,i%C=w7?h}/e^r%8+Oi/`J!qy0nqByw+px]5IImcQ03q<8NSfvU$U^P{D');
define('NONCE_SALT',       'Y!~XS 2H+wAh-O/Ya+-efC(Iq5#!u#,i>86m;mN|l-Q)|UOS|T1=H<#mM WYe]H`');


# Localized Language Stuff

define( 'WP_CACHE', TRUE );

define( 'WP_AUTO_UPDATE_CORE', false );

define( 'PWP_NAME', 'rampiqstg' );

define( 'FS_METHOD', 'direct' );

define( 'FS_CHMOD_DIR', 0775 );

define( 'FS_CHMOD_FILE', 0664 );

umask(0002);

define( 'WPE_APIKEY', '7f04a5a4666d36109c6725613efbc4cd6b3178de' );

define( 'WPE_CLUSTER_ID', '140631' );

define( 'WPE_CLUSTER_TYPE', 'pod' );

define( 'WPE_ISP', true );

define( 'WPE_BPOD', false );

define( 'WPE_RO_FILESYSTEM', false );

define( 'WPE_LARGEFS_BUCKET', 'largefs.wpengine' );

define( 'WPE_SFTP_PORT', 2222 );

define( 'WPE_LBMASTER_IP', '' );

define( 'WPE_CDN_DISABLE_ALLOWED', true );

define( 'DISALLOW_FILE_MODS', FALSE );

define( 'DISALLOW_FILE_EDIT', FALSE );

define( 'DISABLE_WP_CRON', false );

define( 'WPE_FORCE_SSL_LOGIN', false );

define( 'FORCE_SSL_LOGIN', false );

/*SSLSTART*/ if ( isset($_SERVER['HTTP_X_WPE_SSL']) && $_SERVER['HTTP_X_WPE_SSL'] ) $_SERVER['HTTPS'] = 'on'; /*SSLEND*/

define( 'WPE_EXTERNAL_URL', false );

define( 'WP_POST_REVISIONS', FALSE );

define( 'WPE_WHITELABEL', 'wpengine' );

define( 'WP_TURN_OFF_ADMIN_BAR', false );

define( 'WPE_BETA_TESTER', false );

$wpe_cdn_uris=array ( );

$wpe_no_cdn_uris=array ( );

$wpe_content_regexs=array ( );

$wpe_all_domains=array ( 0 => 'rampiqstg.wpengine.com', 1 => 'rampiqstg.wpenginepowered.com', );

$wpe_varnish_servers=array ( 0 => 'pod-140631', );

$wpe_special_ips=array ( 0 => '34.122.102.61', );

$wpe_netdna_domains=array ( );

$wpe_netdna_domains_secure=array ( );

$wpe_netdna_push_domains=array ( );

$wpe_domain_mappings=array ( );

$memcached_servers=array ( );


# WP Engine ID


# WP Engine Settings







# That's It. Pencils down
if ( !defined('ABSPATH') )
	define('ABSPATH', __DIR__ . '/');
require_once(ABSPATH . 'wp-settings.php');

define( 'WPE_SFTP_ENDPOINT', '' );
