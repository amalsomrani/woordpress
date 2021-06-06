<?php
/**
 * Ample_Shop Notice Handler
 *
 * @author  Amplethemes
 * @package Ample_Shop
 * @since   3.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Class to handle notices and Advanced Demo Import
 *
 * Class Ample_Shop_Notice_Handler
 */
class Ample_Shop_Notice_Handler {

	/**
	 * Empty Constructor
	 */
	public function __construct() {	}

	/**
	 * Gets an instance of this object.
	 * Prevents duplicate instances which avoid artefacts and improves performance.
	 *
	 * @static
	 * @access public
	 * @since 3.0.0
	 * @return object
	 */
	public static function instance() {
		// Store the instance locally to avoid private static replication
		static $instance = null;

		// Only run these methods if they haven't been ran previously
		if ( null === $instance ) {
			$instance = new self();
		}

		// Always return the instance
		return $instance;
	}

	/**
	 * Initialize the class
     *
     * 3 Different Process
	 */
	public function run() {
		$this->get_started_notice();
	}

	/**
	 * Get Started Notice
	 *
     * Handle Getting Started Functions
	 * return void
	 */
	private function get_started_notice(){

		add_action( 'wp_loaded', array( $this, 'admin_notice' ), 20 );
		add_action( 'wp_loaded', array( $this, 'hide_notices' ), 15 );
		add_action( 'wp_ajax_at_getting_started', array( $this, 'install_advanced_import' ) );
	}

	/**
	 * Get Started Notice
	 * Active callback of wp_loaded
	 * return void
	 */
	public function admin_notice() {
		/*Check for notice nag*/
		$notice_nag = get_option( 'ample_shop_admin_notice_welcome' );
		if ( ! $notice_nag ) {
			wp_enqueue_style( 'ample-shop-notice', get_template_directory_uri() . '/inc/admin-notice/admin-notice.css', array(), '3.0.0' );
			wp_enqueue_script( 'ample-shop-adi-install', get_template_directory_uri()  . '/inc/admin-notice/admin-notice.js', array( 'jquery' ), '', true );

			$translation = array(
			        'btn_text' => esc_html__( 'Processing...', 'ample-shop' ),
                    'nonce'    => wp_create_nonce( 'ample_shop_demo_import_nonce' ),
                    'adminurl'    => admin_url(),
            );
			wp_localize_script( 'ample-shop-adi-install', 'ample_shop_adi_install', $translation );
			
			/*admin notice hook*/
			add_action( 'admin_notices', array( $this, 'getting_started' ) );
		}

	}

	/**
	 * Get Started Notice
	 * Active callback of wp_loaded
	 * return void
	 */
	public static function hide_notices() {

		if ( isset( $_GET['at-gsm-hide-notice'] ) && isset( $_GET['at_gsm_admin_notice_nonce'] ) ) { // WPCS: input var ok.
			if ( ! wp_verify_nonce( wp_unslash( $_GET['at_gsm_admin_notice_nonce'] ), 'at_gsm_hide_notices_nonce' ) ) { // phpcs:ignore WordPress.VIP.ValidatedSanitizedInput.InputNotSanitized
				wp_die( __( 'Action failed. Please refresh the page and retry.', 'ample-shop' ) ); // WPCS: xss ok.
			}

			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( __( 'Cheatin&#8217; huh?', 'ample-shop' ) ); // WPCS: xss ok.
			}

			$notice_type = sanitize_text_field( wp_unslash( $_GET['at-gsm-hide-notice'] ) );
			update_option( 'ample_shop_admin_notice_' . $notice_type, 1 );

			/*Update to Hide.*/
			if ( 'welcome' === $_GET['at-gsm-hide-notice'] ) {
				update_option( 'ample_shop_admin_notice_' . $notice_type, 1 );
			} else { // Show.
				delete_option( 'ample_shop_admin_notice_' . $notice_type );
			}
		}

	}
	/**
	 * Get Started Notice
	 * Active callback of admin_notices
	 * return void
	 */
	public function getting_started() {
		?>
        <div id="at-gsm" class="updated notice-info at-gsm">
            <a class="at-gsm-close notice-dismiss" href="<?php echo esc_url( wp_nonce_url( remove_query_arg( array( 'activated' ), add_query_arg( 'at-gsm-hide-notice', 'welcome' ) ), 'at_gsm_hide_notices_nonce', 'at_gsm_admin_notice_nonce' ) ); ?>">
				<?php esc_html_e( 'Dismiss', 'ample-shop' ); ?>
            </a>
            <div class="at-gsm-container">
                <img class="at-gsm-screenshot" src="<?php echo esc_url(get_template_directory_uri().'/screenshot.png' )?>" alt="<?php esc_attr_e( 'Ample Shop', 'ample-shop' ); ?>" />
                <div class="at-gsm-notice">
                    <h2>
						<?php
						printf(
						/* translators: 1: welcome page link starting html tag, 2: welcome page link ending html tag. */
							esc_html__( 'Welcome! Thank you for choosing %1$s! To fully take advantage of the best our theme can offer, please make sure you visit our %2$swelcome page%3$s.', 'ample-shop' ), '<strong>'. wp_get_theme()->get('Name'). '</strong>','<a href="' . esc_url( admin_url( 'themes.php?page=ample_shop-info' ) ) . '">','</a>' );
						?>
                    </h2>

                    <p class="plugin-install-notice"><?php esc_html_e( 'Clicking the button below will install and activate the Advanced Import and Ample Themes Demo Importer plugin.', 'ample-shop' ); ?></p>

                    <a class="at-gsm-btn button button-primary button-hero" href="#" data-name="" data-slug="" aria-label="<?php esc_attr_e( 'Get started with Ample Shop', 'ample-shop' ); ?>">
		                <?php esc_html_e( 'Get started with Ample Shop', 'ample-shop' );?>
                    </a>
                </div>
            </div>
        </div>
		<?php
	}

	/**
	 * Get Started Notice
	 * Active callback of wp_ajax
	 * return void
	 */
	public function install_advanced_import() {

		check_ajax_referer( 'ample_shop_demo_import_nonce', 'security' );

        $slug   = $_POST['slug'];
        $plugin = $slug.'/'.$slug.'.php';
        $request = $_POST['request'];

		$status = array(
			'install' => 'plugin',
			'slug'    => sanitize_key( wp_unslash( $slug ) ),
		);
		$status['redirect'] = admin_url( '/themes.php?page=advanced-import&browse=all&at-gsm-hide-notice=welcome' );

		if ( is_plugin_active_for_network( $plugin ) || is_plugin_active( $plugin ) ) {
			// Plugin is activated
			wp_send_json_success($status);
		}


		if ( ! current_user_can( 'install_plugins' ) ) {
			$status['errorMessage'] = __( 'Sorry, you are not allowed to install plugins on this site.', 'ample-shop' );
			wp_send_json_error( $status );
		}

        if( $request > 2){
            wp_send_json_error( );
        }

		include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
		include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

		// Looks like a plugin is installed, but not active.
		if ( file_exists( WP_PLUGIN_DIR . '/' . $slug ) ) {
			$plugin_data          = get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin );
			$status['plugin']     = $plugin;
			$status['pluginName'] = $plugin_data['Name'];

			if ( current_user_can( 'activate_plugin', $plugin ) && is_plugin_inactive( $plugin ) ) {
				$result = activate_plugin( $plugin );

				if ( is_wp_error( $result ) ) {
					$status['errorCode']    = $result->get_error_code();
					$status['errorMessage'] = $result->get_error_message();
					wp_send_json_error( $status );
				}

				wp_send_json_success( $status );
			}
		}

		$api = plugins_api(
			'plugin_information',
			array(
				'slug'   => sanitize_key( wp_unslash( $slug ) ),
				'fields' => array(
					'sections' => false,
				),
			)
		);

		if ( is_wp_error( $api ) ) {
			$status['errorMessage'] = $api->get_error_message();
			wp_send_json_error( $status );
		}

		$status['pluginName'] = $api->name;

		$skin     = new WP_Ajax_Upgrader_Skin();
		$upgrader = new Plugin_Upgrader( $skin );
		$result   = $upgrader->install( $api->download_link );

		if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			$status['debug'] = $skin->get_upgrade_messages();
		}

		if ( is_wp_error( $result ) ) {
			$status['errorCode']    = $result->get_error_code();
			$status['errorMessage'] = $result->get_error_message();
			wp_send_json_error( $status );
		} elseif ( is_wp_error( $skin->result ) ) {
			$status['errorCode']    = $skin->result->get_error_code();
			$status['errorMessage'] = $skin->result->get_error_message();
			wp_send_json_error( $status );
		} elseif ( $skin->get_errors()->get_error_code() ) {
			$status['errorMessage'] = $skin->get_error_messages();
			wp_send_json_error( $status );
		} elseif ( is_null( $result ) ) {
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
			WP_Filesystem();
			global $wp_filesystem;

			$status['errorCode']    = 'unable_to_connect_to_filesystem';
			$status['errorMessage'] = __( 'Unable to connect to the filesystem. Please confirm your credentials.', 'ample-shop' );

			// Pass through the error from WP_Filesystem if one was raised.
			if ( $wp_filesystem instanceof WP_Filesystem_Base && is_wp_error( $wp_filesystem->errors ) && $wp_filesystem->errors->get_error_code() ) {
				$status['errorMessage'] = esc_html( $wp_filesystem->errors->get_error_message() );
			}

			wp_send_json_error( $status );
		}

		$install_status = install_plugin_install_status( $api );

		if ( current_user_can( 'activate_plugin', $install_status['file'] ) && is_plugin_inactive( $install_status['file'] ) ) {
			$result = activate_plugin( $install_status['file'] );

			if ( is_wp_error( $result ) ) {
				$status['errorCode']    = $result->get_error_code();
				$status['errorMessage'] = $result->get_error_message();
				wp_send_json_error( $status );
			}
		}

		wp_send_json_success( $status );

	}

}

/**
 * Begins execution of the hooks.
 *
 * @since    1.0.0
 */
function ample_shop_notice_handler() {
	return Ample_Shop_Notice_Handler::instance();
}
ample_shop_notice_handler()->run();