<?php
if(!class_exists('bloog_Lite_Welcome')) :

	class bloog_Lite_Welcome {

			public $tab_sections = array(); // Welcome Page Tab Sections
			public $theme_name = null; // For storing Theme Name
			public $theme_slug = null; // For storing Theme Slug
			public $theme_version = null; // For Storing Theme Current Version Information
			public $free_plugins = array(); // Displayed Under Recommended Tabs
			public $pro_plugins = array(); // Will be displayed under Recommended Plugins
			public $req_plugins = array(); // Will be displayed under Required Plugins Tab
			public $companion_plugins = array(); // Will be displayed under Demo Import Tab
			public $strings = array(); // Common Display Strings

			
			public function __construct( $plugins, $strings ) {
				/** Useful Variables **/
				$theme = wp_get_theme();
				$this->theme_name = $theme->Name;
				$this->theme_slug = $theme->TextDomain;
				$this->theme_version = $theme->Version;

				/** Plugins **/
				$this->free_plugins = $plugins['recommended_plugins']['free_plugins'];
				$this->pro_plugins = $plugins['recommended_plugins']['pro_plugins'];
				$this->req_plugins = $plugins['required_plugins'];
				$this->companion_plugins = $plugins['companion_plugins'];

				/** Tabs **/
				$this->tab_sections = array(
					'getting_started' => esc_html__('Getting Started', 'bloog-lite'),
					'recommended_plugins' => esc_html__('Recommended Plugins', 'bloog-lite'),
					'demo_import' => esc_html__('Import Demo', 'bloog-lite'),
					'support' => esc_html__('Support', 'bloog-lite'),
					'changelog' => esc_html__('Changelog', 'bloog-lite'),
					'more_wp' => esc_html__('More WordPress Stuff', 'bloog-lite'),
				);

				/** Strings **/
				$this->strings = $strings;

				/* Theme Activation Notice */
				add_action( 'load-themes.php', array( $this, 'activation_admin_notice' ));

				/* Create a Welcome Page */
				add_action( 'admin_menu', array( $this, 'welcome_register_menu' ) );

				/* Enqueue Styles & Scripts for Welcome Page */
				add_action( 'admin_enqueue_scripts', array( $this, 'welcome_styles_and_scripts' ) );

				/** WordPress Plugin Installation Ajax **/
				add_action( 'wp_ajax_plugin_installer', array( $this, 'plugin_installer_callback' ) );

				/** Bundled & Remote Plugin Installation Ajax **/
				add_action( 'wp_ajax_plugin_offline_installer', array( $this, 'plugin_offline_installer_callback' ) );

				/** Plugin Activation Ajax **/
				add_action( 'wp_ajax_plugin_activation', array( $this, 'plugin_activation_callback' ) );

				/** Plugin Deactivation Ajax **/
				add_action( 'wp_ajax_plugin_deactivation', array( $this, 'plugin_deactivation_callback' ) );

				add_action( 'init', array( $this, 'get_required_plugin_notification' ));

			}

			public function get_required_plugin_notification() {

				$req_plugins = $this->companion_plugins;
				$notif_counter = count($this->companion_plugins);

				foreach($req_plugins as $plugin) {

					if( isset( $plugin['class'] ) ) {
						if( class_exists( $plugin['class'] ) ) {
							$notif_counter--;
						}
					}
				}
				return $notif_counter;
			}

			/** Welcome Message Notification on Theme Activation **/
			public function activation_admin_notice() {

				global $pagenow;

				if( is_admin() && ('themes.php' == $pagenow) && (isset($_GET['activated'])) ) {

					add_action( 'admin_notices', array( $this,'welcome_admin_notice_display') );
				}
				
			}

			public function welcome_admin_notice_display(){
				
				$bloog_lite_an_div = '
				<div class="updated bloog-lite-an notice notice-success is-dismissible">
				%1$s
				<hr/>
				<div class="bloog-lite-column-wrap">
				<div class="bloog-lite-column col-img">%2$s</div>
				<div class="bloog-lite-column col-demos">%3$s</div>
				<div class="bloog-lite-column col-doc">%4$s</div>
				</div> 
				</div>
				<style>%5$s</style>';

				/* translators: 1 - notice title, 2 - notice message */
				$bloog_lite_an_top = sprintf(
					'<h2>%1$s</h2><p class="about-desc">%2$s</p></hr>',
					esc_html__( 'Congratulations!', 'bloog-lite' ),
					sprintf(
						/* translators: %s - theme name */
						esc_html__( '%s is now installed and ready to use. We\'ve assembled some links to get you started.', 'bloog-lite' ),
						$this->theme_name
					)
				);

				$bloog_lite_an_btn = sprintf(
					/* translators: 1 - url, 2 - button text */
					'<a href="%1$s" class="button button-primary bloog-lite-btn" >%2$s</a>',
					esc_url( admin_url( 'themes.php?page=welcome-page#demo_import' ) ),
					esc_html__( 'Try one of our ready to use Starter Sites', 'bloog-lite' )
				);
				$bloog_lite_an_pbtn = sprintf(
					/* translators: 1 - options page url, 2 - button text */
					'<a href="%1$s" class="options-page-btn">%2$s</a>',
					esc_url( admin_url( 'themes.php?page=welcome-page' ) ),
					esc_html__( 'or go to the theme settings', 'bloog-lite' )
				);
				$bloog_lite_an_img = sprintf(
					'<picture>
					<source srcset="about:blank" media="(max-width: 1024px)">
					<img src="%1$s">
					</picture>',
					esc_url( get_template_directory_uri() . '/screenshot.png' )
				);
				$bloog_lite_an_list = sprintf(
					'<div><h3><span class="dashicons dashicons-images-alt2"></span> %1$s</h3><p>%2$s</p></div><div> <p>%3$s</p><p>%4$s</p> </div>',
					__( 'Sites Library', 'bloog-lite' ),
					// translators: %s - theme name
					sprintf( esc_html__( '%s now comes with a sites library with various designs to pick from. Visit our collection of demos that are constantly being added.', 'bloog-lite' ), $this->theme_name ),
					$bloog_lite_an_btn,
					$bloog_lite_an_pbtn
				);
				$bloog_lite_an_doc = sprintf(
					'<div><h3><span class="dashicons dashicons-format-aside"></span> %1$s</h3><p>%2$s</p><a class="button bloog-lite-btn" href="%3$s">%4$s</a></div><div></div>',
					__( 'Documentation', 'bloog-lite' ),
					// translators: %s - theme name
					sprintf( esc_html__( 'Need more details? Please check our full documentation for detailed information on how to use %s.', 'bloog-lite' ), $this->theme_name ),
					'https://8degreethemes.com/documentation/bloog-lite',
					esc_html__( 'Read full documentation', 'bloog-lite' )
				);
				$bloog_lite_an_style = '
				.bloog-lite-an.notice.is-dismissible {padding: 20px 15px 5px;}
				.bloog-lite-an hr {margin: 20px -23px 0;border-top: 1px solid #f3f4f5;border-bottom: none;}
				.bloog-lite-an h3{margin: 17px 0 0;font-size: 16px;line-height: 1.4;}
				.bloog-lite-an p {color: #72777c;}
				.bloog-lite-an h2{margin: 0;font-size: 21px;font-weight: 400;line-height: 1.2;}
				.bloog-lite-an p.about-desc{color: #72777c;font-size: 16px;margin: 0;padding:0px;}
				.bloog-lite-column-wrap {display: -ms-grid;display: grid;-ms-grid-columns: 24% 32% 32%;grid-template-columns: 24% 32% 32%;margin-bottom: 13px;}
				.bloog-lite-column {padding: 20px 40px 0 0;}
				.bloog-lite-an .bloog-lite-btn {padding: 30px;line-height: 0;}';

				echo sprintf(
					$bloog_lite_an_div,
					$bloog_lite_an_top,
					$bloog_lite_an_img,
					$bloog_lite_an_list,
					$bloog_lite_an_doc,
					$bloog_lite_an_style
				);// WPCS: XSS OK.
				
			}

			/** Register Menu for Welcome Page **/
			public function welcome_register_menu() {
				$action_count = $this->get_required_plugin_notification();
				$title        = $action_count > 0 ? esc_html($this->strings['welcome_menu_text']) . '<span class="badge pending-tasks">' . esc_html( $action_count ) . '</span>' : esc_html($this->strings['welcome_menu_text']);
				add_theme_page( esc_html($this->strings['welcome_menu_text']), $title , 'edit_theme_options', 'welcome-page', array( $this, 'welcome_screen' ));
			}

			/** Welcome Page **/
			public function welcome_screen() {
				$tabs = $this->tab_sections;

				$current_section = isset($_GET['section']) ? sanitize_text_field( wp_unslash( $_GET['section'] ) ) : 'getting_started';
				$section_inline_style = '';
				?>
				<div class="wrap about-wrap access-wrap">					
					<div class="top-block-wrap">					
						<div class="about-text">
							<h1><?php /* translators: %1$s: theme name, %2$s: theme version */ printf( esc_html__( 'Welcome to %1$s - Version %2$s', 'bloog-lite' ), esc_html($this->theme_name), esc_html($this->theme_version) ); ?></h1>
							<?php echo esc_html($this->strings['theme_short_description']); ?>
						</div>
						<div class="badge-wrap">
							<a target="_blank" href="https://www.8degreethemes.com" class="eightdegree-badge wp-badge"><span><?php echo esc_html('8DegreeThemes', $this->theme_slug); ?></span></a>
						</div>				
					</div>
					<div class="bottom-block-wrap">
						<div class="nav-tab-wrapper clearfix">
							<?php foreach($tabs as $id => $label) : ?>
								<a href="<?php echo esc_url(admin_url('themes.php?page=welcome-page#'.$id)); ?>" class="nav-tab <?php echo esc_attr($id);?> nav-tab-inactive" >
									<?php echo esc_html( $label ); ?>
									<?php if($id == 'actions_required') : $not = $this->get_required_plugin_notification(); ?>
										<?php if($not) : ?>
											<span class="pending-tasks">
												<?php echo esc_html($not); ?>
											</span>
										<?php endif; ?>
									<?php endif; ?>
								</a>
							<?php endforeach; ?>
						</div>
						<div class="welcome-section-wrapper-loader import-php">
							<div class="updating-message"></div>
						</div>
						<div class="welcome-section-wrapper is_loading">
							<?php foreach($tabs as $id => $label) : ?>
								<div class="welcome-section <?php echo esc_attr($id);?> nav-tab-inactive clearfix">
									<?php require_once get_template_directory() . '/welcome/sections/'.esc_html($id).'.php'; ?>
								</div>
							<?php endforeach; ?>
							<div class="notice-sidebar is_loading">
								<div class= "notice-sidebar-item">
									<h4><?php echo esc_html('Join in our social networks!','bloog-lite') ?></h4>
									<p><?php echo esc_html__('Get connected, share your opinions and more via our social community:', 'bloog-lite'); ?></p>
									<p><a href="<?php echo esc_url('https://www.facebook.com/8DegreeThemes');?>"><?php echo esc_html('Join our Facebook Group','bloog-lite') ?></a> <?php echo esc_html('- to receive updates, offers and more.','bloog-lite') ?></p>
									<p><a href="<?php echo esc_url('https://www.youtube.com/8degreethemes');?>"><?php echo esc_html('Subscribe our YouTube Channel','bloog-lite') ?></a> <?php echo esc_html('- for tutorials, videos and more.','bloog-lite') ?></p>
									<p><a href="<?php echo esc_url('https://www.twitter.com/8degreethemes');?>"><?php echo esc_html('Follow us on Twitter','bloog-lite') ?></a> <?php echo esc_html('- to stay updated.','bloog-lite') ?></p>
								</div>
								<div class= "notice-sidebar-item">
									<h4><?php echo esc_html('Leave us a review','bloog-lite') ?></h4>
									<p><?php echo esc_html__('Are you are enjoying bloog Lite? We would love to hear your feedback.', 'bloog-lite'); ?></p>
									<a href="<?php echo esc_url('https://wordpress.org/support/theme/bloog-lite/');?>"><?php echo esc_html('Submit a review','bloog-lite') ?></a>

								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
			}

			/** Enqueue Necessary Styles and Scripts for the Welcome Page **/
			public function welcome_styles_and_scripts() {
				wp_enqueue_style( $this->theme_slug . '-welcome-screen', get_template_directory_uri() . '/welcome/css/welcome.css' );
				wp_enqueue_script( $this->theme_slug . '-welcome-screen', get_template_directory_uri() . '/welcome/js/welcome.js', array( 'jquery' ) );

				wp_localize_script( $this->theme_slug . '-welcome-screen', 'SmWelcomeObject', array(
					'admin_nonce'	=> wp_create_nonce( 'plugin_installer_nonce'),
					'activate_nonce'	=> wp_create_nonce( 'plugin_activate_nonce'),
					'deactivate_nonce'	=> wp_create_nonce( 'plugin_deactivate_nonce'),
					'ajaxurl'		=> esc_url( admin_url( 'admin-ajax.php' ) ),
					'activate_btn' => $this->strings['activate'],
					'installed_btn' => $this->strings['installed_btn'],
					'demo_installing' => $this->strings['demo_installing'],
					'demo_installed' => $this->strings['demo_installed'],
					'demo_confirm' => $this->strings['demo_confirm'],
				) );
			}

			/** Plugin API **/
			public function call_plugin_api( $plugin ) {
				include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

				$call_api = plugins_api( 'plugin_information', array(
					'slug'   => $plugin,
					'fields' => array(
						'downloaded'        => false,
						'rating'            => false,
						'description'       => false,
						'short_description' => true,
						'donate_link'       => false,
						'tags'              => false,
						'sections'          => true,
						'homepage'          => true,
						'added'             => false,
						'last_updated'      => false,
						'compatibility'     => false,
						'tested'            => false,
						'requires'          => false,
						'downloadlink'      => false,
						'icons'             => true
					)
				) );

				return $call_api;
			}

			/** Check For Icon **/
			public function check_for_icon( $arr ) {
				if ( ! empty( $arr['svg'] ) ) {
					$plugin_icon_url = $arr['svg'];
				} elseif ( ! empty( $arr['2x'] ) ) {
					$plugin_icon_url = $arr['2x'];
				} elseif ( ! empty( $arr['1x'] ) ) {
					$plugin_icon_url = $arr['1x'];
				} else {
					$plugin_icon_url = $arr['default'];
				}

				return $plugin_icon_url;
			}

			/** Check if Plugin is active or not **/
			public function get_plugin_active($plugin) {
				$folder_name = $plugin['slug'];
				$file_name = $plugin['filename'];
				
				$class = '';
				if( isset($plugin['class']) ){
					$class = $plugin['class'];	
				}
				
				$function = '';
				if( isset($plugin['function']) ){
					$function = $plugin['function'];
				}
				
				$status = 'install';

				$path = WP_PLUGIN_DIR.'/'.esc_attr($folder_name).'/'.esc_attr($file_name);
				if( file_exists( $path ) ) {
					if($class){
						$status = class_exists( $class ) ? 'inactive' : 'active';	
					}elseif($function){
						$status = function_exists( $function ) ? 'inactive' : 'active';	
					}
					
				}
				return $status;
			}

			/** Generate Url for the Plugin Button **/
			public function generate_plugin_url($status, $plugin) {
				$folder_name = $plugin['slug'];
				$file_name = $plugin['filename'];

				switch ( $status ) {
					case 'install':
					return wp_nonce_url(
						add_query_arg(
							array(
								'action' => 'install-plugin',
								'plugin' => esc_attr($folder_name)
							),
							network_admin_url( 'update.php' )
						),
						'install-plugin_' . esc_attr($folder_name)
					);
					break;

					case 'inactive':
					return '#';
					break;

					case 'active':
					return '#';
					break;
				}
			}

			/* ========== Plugin Installation Ajax =========== */
			public function plugin_installer_callback(){

				if ( ! current_user_can('install_plugins') ) {
					wp_die( esc_html__( 'Sorry, you are not allowed to install plugins on this site.', 'bloog-lite' ) );
				}

				$nonce = isset( $_POST["nonce"] ) ? sanitize_text_field( wp_unslash( $_POST["nonce"] ) ) : '';
				$plugin = isset( $_POST["plugin"] ) ? sanitize_text_field( wp_unslash( $_POST["plugin"] ) ) : '';
				$plugin_file = isset( $_POST["plugin_file"] ) ? sanitize_text_field( wp_unslash( $_POST["plugin_file"] ) ) : '';

				// Check our nonce, if they don't match then bounce!
				if (! wp_verify_nonce( $nonce, 'plugin_installer_nonce' )) {
					wp_die( esc_html__( 'Error - unable to verify nonce, please try again.', 'bloog-lite') );
				}


         		// Include required libs for installation
				require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
				require_once ABSPATH . 'wp-admin/includes/class-wp-ajax-upgrader-skin.php';
				require_once ABSPATH . 'wp-admin/includes/class-plugin-upgrader.php';

				// Get Plugin Info
				$api = $this->call_plugin_api($plugin);

				$skin     = new WP_Ajax_Upgrader_Skin();
				$upgrader = new Plugin_Upgrader( $skin );
				$upgrader->install($api->download_link);

				$plugin_file = esc_html($plugin).'/'.esc_html($plugin_file);

				if($api->name) {
					if($plugin_file) {
						activate_plugin($plugin_file);
						echo 'success';
						die();
					}
				}
				echo 'fail';

				die();
			}

			/** Plugin Offline Installation Ajax **/
			public function plugin_offline_installer_callback() {
				$plugin = array();

				$file_location = $plugin['location'] = isset( $_POST['file_location'] ) ? sanitize_text_field( wp_unslash( $_POST['file_location'] ) ) : '';
				$file = isset( $_POST['file'] ) ? sanitize_text_field( wp_unslash( $_POST['file'] ) ) : '';
				$host_type = isset( $_POST['host_type'] ) ? sanitize_text_field( wp_unslash( $_POST['host_type'] ) ) : '';
				$plugin_class = $plugin['class'] = isset( $_POST['class_name'] ) ? sanitize_text_field( wp_unslash( $_POST['class_name'] ) ) : '';
				$plugin_slug = $plugin['slug'] = isset( $_POST['slug'] ) ? sanitize_text_field( wp_unslash( $_POST['slug'] ) ) : '';
				$plugin_directory = ABSPATH . 'wp-content/plugins/';

				$plugin_file = $plugin_slug . '/' . $file;

				if( $host_type == 'remote' ) {
					$file_location = $this->get_local_dir_path($plugin);
				}

				$zip = new ZipArchive();
				if ($zip->open($file_location) === TRUE) {
					$zip->extractTo($plugin_directory);
					$zip->close();

					activate_plugin($plugin_file);

					if( $host_type == 'remote' ) {
						unlink($file_location);
					}

					echo 'success';

					die();
				} else {
					echo 'failed';
				}

				die();
			}

			/** Plugin Offline Activation Ajax **/
			public function plugin_activation_callback() {

				$plugin = isset( $_POST['plugin'] ) ? sanitize_text_field( wp_unslash( $_POST['plugin'] ) ) : '';
				$plugin_file = isset( $_POST['plugin_file'] ) ? sanitize_text_field( wp_unslash( $_POST['plugin_file'] ) ) : '';
				$plugin_file = ABSPATH . 'wp-content/plugins/'.esc_html($plugin).'/'.esc_html($plugin_file);

				if(file_exists($plugin_file)) {

					activate_plugin($plugin_file);
					echo "success";

				} else {
					echo esc_html__('Plugin Does not Exists' , 'bloog-lite');
				}

				die();

			}

			/** Plugin Offline Activation Ajax **/
			public function plugin_deactivation_callback() {

				$plugin = isset( $_POST['plugin'] ) ? sanitize_text_field( wp_unslash( $_POST['plugin'] ) ) : '';
				$plugin_file = isset( $_POST['plugin_file'] ) ? sanitize_text_field( wp_unslash( $_POST['plugin_file'] ) ) : '';
				$plugin_file = ABSPATH . 'wp-content/plugins/'.esc_html($plugin).'/'.esc_html($plugin_file);

				if(file_exists($plugin_file)) {

					deactivate_plugins($plugin_file);
					echo "success";

				} else {
					echo esc_html__('Plugin Does not Exists' , 'bloog-lite');
				}

				die();

			}

			public function all_required_plugins_installed() {

				$companion_plugins = $this->companion_plugins;
				$show_success_notice = false;

				foreach($companion_plugins as $plugin) {

					$path = WP_PLUGIN_DIR.'/'.esc_attr($plugin['slug']).'/'.esc_attr($plugin['filename']);

					if(file_exists($path)) {
						if(class_exists($plugin['class'])) {
							$show_success_notice = true;
						} else {
							$show_success_notice = false;
							break;
						}
					} else {
						$show_success_notice = false;
						break;
					}
				}

				return $show_success_notice;
			}

			public function get_local_dir_path($plugin) {

				$upload_dir = wp_upload_dir();

				$file_location = $upload_dir['path'] . '/' . $plugin['slug'].'.zip';

				if( file_exists( $file_location ) || class_exists( $plugin['class'] ) ) {
					return $file_location;
				}

				$url = wp_nonce_url(admin_url('themes.php?page=' . $this->theme_slug . '-welcome&section=actions_required'),'remote-file-installation');
				if (false === ($creds = request_filesystem_credentials($url, '', false, false, null) ) ) {
					return; // stop processing here
				}

				if ( ! WP_Filesystem($creds) ) {
					request_filesystem_credentials($url, '', true, false, null);
					return;
				}

				global $wp_filesystem;
				$file = $wp_filesystem->get_contents( $plugin['location'] );

				$wp_filesystem->put_contents( $file_location, $file, FS_CHMOD_FILE );

				return $file_location;
			}

		}

	endif;