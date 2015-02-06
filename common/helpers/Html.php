<?php
namespace common\helpers;

class Html extends \yii\helpers\Html {
    
    public static function Header($name = null){
	//do_action( 'get_header', $name );
	$templates = array();
	$name = (string) $name;
	if ( '' !== $name )
		$templates[] = "header-{$name}.php";

	$templates[] = 'header.php';

	// Backward compat code will be removed in a future release
	if ('' == static::locate_template($templates, true))
		static::load_template(__DIR__ . '/../../frontend/views/layouts/header');
    }
    
    public static function SideBar($name = null){
	//do_action( 'get_header', $name );
	$templates = array();
	$name = (string) $name;
	if ( '' !== $name )
		$templates[] = "sidebar-{$name}.php";

	$templates[] = 'sidebar.php';

	// Backward compat code will be removed in a future release
	if ('' == static::locate_template($templates, true))
		static::load_template(__DIR__ . '/../../frontend/views/layouts/sidebar');
    }
    
    public static function Footer($name = null){
	//do_action( 'get_header', $name );
	$templates = array();
	$name = (string) $name;
	if ( '' !== $name )
		$templates[] = "footer-{$name}.php";

	$templates[] = 'footer.php';

	// Backward compat code will be removed in a future release
	if ('' == static::locate_template($templates, true))
		static::load_template(__DIR__ . '/../../frontend/views/layouts/footer');
    }

    
    public static function locate_template($template_names, $load = false, $require_once = true ) {
	$located = '';
	foreach ( (array) $template_names as $template_name ) {
		if ( !$template_name )
			continue;
		if ( file_exists('@frontend/views/layouts/'. $template_name)) {
			$located = '@frontend/views/layouts/'. $template_name;
			break;
		} else if ( file_exists('@frontend/views/layouts/'.$template_name) ) {
			$located = '@frontend/views/layouts/'. $template_name;
			break;
		}
	}

	if ( $load && '' != $located )
		static::load_template( $located, $require_once );

	return $located;
    }
    
    public static function load_template( $_template_file, $require_once = true ) {
	if ( $require_once )
		require_once($_template_file.'.php');
	else
		require($_template_file.'.php');
}
}