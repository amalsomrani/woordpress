<?php
/**
 * Welcome Page Initiation
*/

include get_template_directory() . '/welcome/welcome.php';

/** Plugins **/
$plugins = array(
	// *** Companion Plugins
	'companion_plugins' => array(
		'access-demo-importer' 	=> array(
			'slug' 				=> 'access-demo-importer',
			'name' 				=> esc_html__('Instant Demo Importer', 'bloog-lite'),
			'filename' 			=>'access-demo-importer.php',
 			// Use either bundled, remote, wordpress
			'host_type' 		=> 'wordpress',
			'class' 			=> 'Access_Demo_Importer',
			'info' => __('Access Demo Importer Plugin adds the feature to Import the Demo Conent with a single click.', 'bloog-lite'),
		)
	),
	// *** Required Plugins
	'required_plugins' 			=> array(),

	// *** Recommended Plugins
	'recommended_plugins' => array(
			// Free Plugins
		'free_plugins' => array(
			'accesspress-social-icons' => array(
				'slug' 		=> 'accesspress-social-icons',
				'filename' 	=> 'accesspress-social-icons.php',
				'class' 	=> 'APS_Class'
			),
			'accesspress-social-share' => array(
				'slug' 		=> 'accesspress-social-share',
				'filename' 	=> 'accesspress-social-share.php',
				'class' 	=> 'APSS_Class'
			),
			'accesspress-pinterest' => array(
				'slug' 		=> 'accesspress-pinterest',
				'filename' 	=> 'accesspress-pinterest.php',
				'class' 	=> 'APSP_Class_free'
			),
			'contact-form-7' => array(
				'slug' 		=> 'contact-form-7',
				'filename' 	=> 'wp-contact-form-7.php',
				'class' 	=> 'WPCF7_Submission'
			),
			'8-degree-coming-soon-page' => array(
				'slug' 		=> '8-degree-coming-soon-page',
				'filename' 	=> '8-degree-coming-soon-page.php',
				'class' 	=> 'Eight_Degree_Coming_Soon_Page'
			),
			'8-degree-notification-bar' => array(
				'slug' 		=> '8-degree-notification-bar',
				'filename' 	=> '8degree-notification.php',
				'class' 	=> 'Edn_Class'
			)
		),
		// Pro Plugins
		'pro_plugins' => array()
	),
);

$strings = array(
		// Welcome Page General Texts
	'welcome_menu_text' => esc_html__( 'Bloog Lite Setup', 'bloog-lite' ),
	'theme_short_description' => esc_html__( 'Bloog Lite is a blog type theme. It contains all the functionality for a blog site. Fully responsive, bbPress compatible, translation ready, cross-browser compatible, SEO friendly, RTL support. Great customer support via online chat, email.', 'bloog-lite' ),

	// Plugin Action Texts
	'install_n_activate' => esc_html__('Install and Activate', 'bloog-lite'),
	'deactivate' => esc_html__('Deactivate', 'bloog-lite'),
	'activate' => esc_html__('Activate', 'bloog-lite'),

	// Recommended Plugins Section
	'pro_plugin_title' => esc_html__( 'Pro Plugins', 'bloog-lite' ),
	'pro_plugin_description' => esc_html__( 'Take Advantage of some of our Premium Plugins.', 'bloog-lite' ),
	'free_plugin_title' => esc_html__( 'Free Plugins', 'bloog-lite' ),
	'free_plugin_description' => esc_html__( 'These Free Plugins might be handy for you.', 'bloog-lite' ),

	// Demo Actions
	'installed_btn' => esc_html__('Activated', 'bloog-lite'),
	'deactivated_btn' => esc_html__('Activated', 'bloog-lite'),
	'demo_installing' => esc_html__('Installing Demo', 'bloog-lite'),
	'demo_installed' => esc_html__('Demo Installed', 'bloog-lite'),
	'demo_confirm' => esc_html__('Are you sure to import demo content ?', 'bloog-lite'),

	// Actions Required
	'req_plugins_installed' => esc_html__( 'All Recommended action has been successfully completed.', 'bloog-lite' ),
	'customize_theme_btn' => esc_html__( 'Customize Theme', 'bloog-lite' ),
);

/**
 * Initiating Welcome Page
*/
$my_theme_wc_page = new bloog_Lite_Welcome( $plugins, $strings );