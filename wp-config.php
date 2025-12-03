<?php
/**
 * Basic WordPress configuration.
 *
 * Copy of wp-config-sample.php with placeholder credentials so the site can
 * boot locally. Replace the DB_* values and salts with real secrets before
 * deploying.
 */

// ** Database settings - You can get this info from your web host ** //
define( 'DB_NAME', 'conservs_conbio2' );
define( 'DB_USER', 'conservs_conservs' );
define( 'DB_PASSWORD', 'GlTn.}vIRUHP' );
define( 'DB_HOST', 'localhost' );
define( 'DB_CHARSET', 'utf8mb4' );
define( 'DB_COLLATE', '' );

// ** Authentication Unique Keys and Salts. ** //
// Change these to different unique phrases generated for your install.
define( 'AUTH_KEY',         '3Fctw@ttm!;d5*y1dqX],t*{?0O.A5(J5:Kz=Qa[)2%Af%Q7JpIbOr7<*yD*3vX>' );
define( 'SECURE_AUTH_KEY',  'vb7-@bCaMVydf}z|z#PVuT5,&~XGd9A3cXQBrZ-h{$+?e9v*+d}CN}E-,,CiIt8x' );
define( 'LOGGED_IN_KEY',    ':/xDr3?B-QBlmv^#8:0h#B`!J-D(o!0s5?M;J{w1>:`n^|Zz&h75P|P[G?E6M%~Y' );
define( 'NONCE_KEY',        'P3Ml|(ew~k?>N|~pv(T=JWd3=;V+SBN$#jl,=2=tuG4Xfr?.=]r@EKj%:9|,}jZ7' );
define( 'AUTH_SALT',        'o#YtT+|k<0G>y5ad,;0vHVul15@`kF0$o[x6!/SZ>uTqj}Da7+7#SXW@)F}fYQ`*' );
define( 'SECURE_AUTH_SALT', '4@|x&*uM3H)Oc=4c.zd$)v5w7@FM1y3kU1Y`Ax#9Tl#[)k1,2g|Y}Kg[|]Fik(s4' );
define( 'LOGGED_IN_SALT',   'PvmR@4/sE[x<TY%/}YazJri2JN6..X!t^32|Hv?[7.`e}z|C;X^1D=Z5Kgj<he(u' );
define( 'NONCE_SALT',       ']s*>3GdJe-5}4&4({@,JY;XD2#OAdc#l1VI5{r(7o$d|kki|jt34RNDC7.n>/D?4' );

$table_prefix = 'wp_';

define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

require_once ABSPATH . 'wp-settings.php';
