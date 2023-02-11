<?php
namespace Ampersarnie\WP\Theme;

/**
 * Handles loading in scripts and minor boots.
 * 
 * @author Paul Taylor <paul.taylor@hey.com>
 */
class Loader {
	/**
	 * Class constructor.
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_assets' ] );
	}

	/**
	 * Enqueues any assets required for the front-end.
	 *
	 * @author Paul Taylor <paul.taylor@hey.com>
	 * @return void
	 */
	public function enqueue_assets(): void {
		if ( is_admin() && ! is_customize_preview() ) {
			return;
		}
	
		wp_enqueue_style(
			'wp-theme-style',
			get_template_directory_uri() . '/dist/styles/' . WP_THEME_FRONTEND_CSS,
			WP_THEME_FRONTEND_DEPENDENCIES,
			WP_THEME_VERSION,
			'all'
		);
	}
}
