<?php
/**
 * Functions
 *
 * @package      Genesis Boilerplate
 * @since        0.0.1
 * @link         https://webdevsuperfast.github.io
 * @author       Rotsen Mark Acob <rotsenacob.com>
 * @copyright    Copyright (c) 2016, Rotsen Mark Acob
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'GB_THEME_NAME', 'Genesis Boilerplate' );
define( 'GB_THEME_URL', 'http://rotsenacob.com/' );
define( 'GB_THEME_VERSION', '0.0.1' );
define( 'GB_LIB', CHILD_DIR . '/lib/' );
define( 'GB_MODULES', GB_LIB . 'modules/' );
define( 'GB_JS', CHILD_URL . '/assets/js/' );
define( 'GB_CSS', CHILD_URL . '/assets/css/' );