<?php
/**
 * Wizard
 *
 * @package Whizzie
 * @author Aster Themes
 * @since 1.0.0
 */

class Whizzie {

	protected $version = '1.1.0';
	protected $theme_name = '';
	protected $theme_title = '';
	protected $page_slug = '';
	protected $page_title = '';
	protected $config_steps = array();
	public $plugin_path;
	public $parent_slug;
	/**
	 * Relative plugin url for this plugin folder
	 * @since 1.0.0
	 * @var string
	 */
	protected $plugin_url = '';

	/**
	 * TGMPA instance storage
	 *
	 * @var object
	 */
	protected $tgmpa_instance;

	/**
	 * TGMPA Menu slug
	 *
	 * @var string
	 */
	protected $tgmpa_menu_slug = 'tgmpa-install-plugins';

	/**
	 * TGMPA Menu url
	 *
	 * @var string
	 */
	protected $tgmpa_url = 'themes.php?page=tgmpa-install-plugins';

	/*** Constructor ***
	* @param $config	Our config parameters
	*/
	public function __construct( $config ) {
		$this->set_vars( $config );
		$this->init();
	}

	/**
	* Set some settings
	* @since 1.0.0
	* @param $config	Our config parameters
	*/

	public function set_vars( $config ) {
		// require_once trailingslashit( WHIZZIE_DIR ) . 'tgm/class-tgm-plugin-activation.php';
		require_once trailingslashit( WHIZZIE_DIR ) . 'tgm/tgm.php';

		if( isset( $config['page_slug'] ) ) {
			$this->page_slug = esc_attr( $config['page_slug'] );
		}
		if( isset( $config['page_title'] ) ) {
			$this->page_title = esc_attr( $config['page_title'] );
		}
		if( isset( $config['steps'] ) ) {
			$this->config_steps = $config['steps'];
		}

		$this->plugin_path = trailingslashit( dirname( __FILE__ ) );
		$relative_url = str_replace( get_template_directory(), '', $this->plugin_path );
		$this->plugin_url = trailingslashit( get_template_directory_uri() . $relative_url );
		$current_theme = wp_get_theme();
		$this->theme_title = $current_theme->get( 'Name' );
		$this->theme_name = strtolower( preg_replace( '#[^a-zA-Z]#', '', $current_theme->get( 'Name' ) ) );
		$this->page_slug = apply_filters( $this->theme_name . '_theme_setup_wizard_page_slug', $this->theme_name . '-wizard' );
		$this->parent_slug = apply_filters( $this->theme_name . '_theme_setup_wizard_parent_slug', '' );
	}

	/**
	 * Hooks and filters
	 * @since 1.0.0
	 */
	public function init() {
		if ( class_exists( 'TGM_Plugin_Activation' ) && isset( $GLOBALS['tgmpa'] ) ) {
			add_action( 'init', array( $this, 'get_tgmpa_instance' ), 30 );
			add_action( 'init', array( $this, 'set_tgmpa_url' ), 40 );
		}
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_menu', array( $this, 'menu_page' ) );
		add_action( 'admin_init', array( $this, 'get_plugins' ), 30 );
		add_filter( 'tgmpa_load', array( $this, 'tgmpa_load' ), 10, 1 );
		add_action( 'wp_ajax_setup_plugins', array( $this, 'setup_plugins' ) );
		add_action( 'wp_ajax_setup_widgets', array( $this, 'setup_widgets' ) );
	}

	public function enqueue_scripts() {
		wp_enqueue_style( 'theme-wizard-style', get_template_directory_uri() . '/theme-wizard/assets/css/theme-wizard-style.css');
		wp_register_script( 'theme-wizard-script', get_template_directory_uri() . '/theme-wizard/assets/js/theme-wizard-script.js', array( 'jquery' ), );

		wp_localize_script(
			'theme-wizard-script',
			'wedding_ceremony_whizzie_params',
			array(
				'ajaxurl' 		=> admin_url( 'admin-ajax.php' ),
				'verify_text'	=> esc_html( 'verifying', 'wedding-ceremony' )
			)
		);
		wp_enqueue_script( 'theme-wizard-script' );
	}

	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function tgmpa_load( $status ) {
		return is_admin() || current_user_can( 'install_themes' );
	}

	/**
	 * Get configured TGMPA instance
	 *
	 * @access public
	 * @since 1.1.2*/
	public function get_tgmpa_instance() {
		$this->tgmpa_instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
	}

	/**
	 * Update $tgmpa_menu_slug and $tgmpa_parent_slug from TGMPA instance
	 *
	 * @access public
	 * @since 1.1.2
	 */
	public function set_tgmpa_url() {
		$this->tgmpa_menu_slug = ( property_exists( $this->tgmpa_instance, 'menu' ) ) ? $this->tgmpa_instance->menu : $this->tgmpa_menu_slug;
		$this->tgmpa_menu_slug = apply_filters( $this->theme_name . '_theme_setup_wizard_tgmpa_menu_slug', $this->tgmpa_menu_slug );
		$tgmpa_parent_slug = ( property_exists( $this->tgmpa_instance, 'parent_slug' ) && $this->tgmpa_instance->parent_slug !== 'themes.php' ) ? 'admin.php' : 'themes.php';
		$this->tgmpa_url = apply_filters( $this->theme_name . '_theme_setup_wizard_tgmpa_url', $tgmpa_parent_slug . '?page=' . $this->tgmpa_menu_slug );
	}

	/***        Make a modal screen for the wizard        ***/
	
	public function menu_page() {
		add_theme_page( esc_html( $this->page_title ), esc_html( $this->page_title ), 'manage_options', $this->page_slug, array( $this, 'wedding_ceremony_setup_wizard' ) );
	}

	/***        Make an interface for the wizard        ***/

	public function wizard_page() {
		tgmpa_load_bulk_installer();
		// install plugins with TGM.
		if ( ! class_exists( 'TGM_Plugin_Activation' ) || ! isset( $GLOBALS['tgmpa'] ) ) {
			die( 'Failed to find TGM' );
		}
		$url = wp_nonce_url( add_query_arg( array( 'plugins' => 'go' ) ), 'whizzie-setup' );

		// copied from TGM
		$method = ''; // Leave blank so WP_Filesystem can populate it as necessary.
		$fields = array_keys( $_POST ); // Extra fields to pass to WP_Filesystem.
		if ( false === ( $creds = request_filesystem_credentials( esc_url_raw( $url ), $method, false, false, $fields ) ) ) {
			return true; // Stop the normal page form from displaying, credential request form will be shown.
		}
		// Now we have some credentials, setup WP_Filesystem.
		if ( ! WP_Filesystem( $creds ) ) {
			// Our credentials were no good, ask the user for them again.
			request_filesystem_credentials( esc_url_raw( $url ), $method, true, false, $fields );
			return true;
		}
		/* If we arrive here, we have the filesystem */ ?>
		<div class="main-wrap">
			<?php
			echo '<div class="card whizzie-wrap">';
				// The wizard is a list with only one item visible at a time
				$steps = $this->get_steps();
				echo '<ul class="whizzie-menu">';
				foreach( $steps as $step ) {
					$class = 'step step-' . esc_attr( $step['id'] );
					echo '<li data-step="' . esc_attr( $step['id'] ) . '" class="' . esc_attr( $class ) . '">';
						printf( '<h2>%s</h2>', esc_html( $step['title'] ) );
						// $content is split into summary and detail
						$content = call_user_func( array( $this, $step['view'] ) );
						if( isset( $content['summary'] ) ) {
							printf(
								'<div class="summary">%s</div>',
								wp_kses_post( $content['summary'] )
							);
						}
						if( isset( $content['detail'] ) ) {
							// Add a link to see more detail
							printf( '<p><a href="#" class="more-info">%s</a></p>', __( 'More Info', 'wedding-ceremony' ) );
							printf(
								'<div class="detail">%s</div>',
								$content['detail'] // Need to escape this
							);
						}
						// The next button
						if( isset( $step['button_text'] ) && $step['button_text'] ) {
							printf(
								'<div class="button-wrap"><a href="#" class="button button-primary do-it" data-callback="%s" data-step="%s">%s</a></div>',
								esc_attr( $step['callback'] ),
								esc_attr( $step['id'] ),
								esc_html( $step['button_text'] )
							);
						}
					echo '</li>';
				}
				echo '</ul>';
				?>
				<div class="step-loading"><span class="spinner"></span></div>
			</div><!-- .whizzie-wrap -->

		</div><!-- .wrap -->
	<?php }



	public function activation_page() {
		?>
		<div class="main-wrap">
			<h3><?php esc_html_e('Theme Setup Wizard','wedding-ceremony'); ?></h3>
		</div>
		<?php
	}

	public function wedding_ceremony_setup_wizard(){

			$display_string = '';

			$body = [
				'site_url'					 => site_url(),
				'theme_text_domain'	 => wp_get_theme()->get( 'TextDomain' )
			];

			$body = wp_json_encode( $body );
			$options = [
				'body'        => $body,
				'sslverify' 	=> false,
				'headers'     => [
					'Content-Type' => 'application/json',
				]
			];

			//custom function about theme customizer
			$return = add_query_arg( array()) ;
			$theme = wp_get_theme( 'wedding-ceremony' );

			?>
				<div class="wrapper-info get-stared-page-wrap">
					<div class="tab-sec theme-option-tab">
						<div id="demo_offer" class="tabcontent">
							<?php $this->wizard_page(); ?>
						</div>
					</div>
				</div>
			<?php
	}
	

	/**
	* Set options for the steps
	* Incorporate any options set by the theme dev
	* Return the array for the steps
	* @return Array
	*/
	public function get_steps() {
		$dev_steps = $this->config_steps;
		$steps = array(
			'intro' => array(
				'id'			=> 'intro',
				'title'			=> __( 'Welcome to ', 'wedding-ceremony' ) . $this->theme_title,
				'icon'			=> 'dashboard',
				'view'			=> 'get_step_intro', // Callback for content
				'callback'		=> 'do_next_step', // Callback for JS
				'button_text'	=> __( 'Start Now', 'wedding-ceremony' ),
				'can_skip'		=> false // Show a skip button?
			),
			'plugins' => array(
				'id'			=> 'plugins',
				'title'			=> __( 'Plugins', 'wedding-ceremony' ),
				'icon'			=> 'admin-plugins',
				'view'			=> 'get_step_plugins',
				'callback'		=> 'install_plugins',
				'button_text'	=> __( 'Install Plugins', 'wedding-ceremony' ),
				'can_skip'		=> true
			),
			'widgets' => array(
				'id'			=> 'widgets',
				'title'			=> __( 'Demo Importer', 'wedding-ceremony' ),
				'icon'			=> 'welcome-widgets-menus',
				'view'			=> 'get_step_widgets',
				'callback'		=> 'install_widgets',
				'button_text'	=> __( 'Import Demo', 'wedding-ceremony' ),
				'can_skip'		=> true
			),
			'done' => array(
				'id'			=> 'done',
				'title'			=> __( 'All Done', 'wedding-ceremony' ),
				'icon'			=> 'yes',
				'view'			=> 'get_step_done',
				'callback'		=> ''
			)
		);

		// Iterate through each step and replace with dev config values
		if( $dev_steps ) {
			// Configurable elements - these are the only ones the dev can update from config.php
			$can_config = array( 'title', 'icon', 'button_text', 'can_skip' );
			foreach( $dev_steps as $dev_step ) {
				// We can only proceed if an ID exists and matches one of our IDs
				if( isset( $dev_step['id'] ) ) {
					$id = $dev_step['id'];
					if( isset( $steps[$id] ) ) {
						foreach( $can_config as $element ) {
							if( isset( $dev_step[$element] ) ) {
								$steps[$id][$element] = $dev_step[$element];
							}
						}
					}
				}
			}
		}
		return $steps;
	}

	/*** Display the content for the intro step ***/
	public function get_step_intro() { ?>
		<div class="summary">
			<p style="text-align: center;"><?php esc_html_e( 'Thank you for choosing our theme! We are excited to help you get started with your new website.', 'wedding-ceremony' ); ?></p>
			<p style="text-align: center;"><?php esc_html_e( 'To ensure you make the most of our theme, we recommend following the setup steps outlined here. This process will help you configure the theme to best suit your needs and preferences. Click on the "Start Now" button to begin the setup.', 'wedding-ceremony' ); ?></p>
		</div>
	<?php }
	
	

	/**
	 * Get the content for the plugins step
	 * @return $content Array
	 */
	public function get_step_plugins() {
		$plugins = $this->get_plugins();
		$content = array(); ?>
			<div class="summary">
				<p>
					<?php esc_html_e('Additional plugins always make your website exceptional. Install these plugins by clicking the install button. You may also deactivate them from the dashboard.','wedding-ceremony') ?>
				</p>
			</div>
		<?php // The detail element is initially hidden from the user
		$content['detail'] = '<ul class="whizzie-do-plugins">';
		// Add each plugin into a list
		foreach( $plugins['all'] as $slug=>$plugin ) {
			$content['detail'] .= '<li data-slug="' . esc_attr( $slug ) . '">' . esc_html( $plugin['name'] ) . '<span>';
			$keys = array();
			if ( isset( $plugins['install'][ $slug ] ) ) {
			    $keys[] = 'Installation';
			}
			if ( isset( $plugins['update'][ $slug ] ) ) {
			    $keys[] = 'Update';
			}
			if ( isset( $plugins['activate'][ $slug ] ) ) {
			    $keys[] = 'Activation';
			}
			$content['detail'] .= implode( ' and ', $keys ) . ' required';
			$content['detail'] .= '</span></li>';
		}
		$content['detail'] .= '</ul>';

		return $content;
	}

	/*** Display the content for the widgets step ***/
	public function get_step_widgets() { ?>
		<div class="summary">
			<p><?php esc_html_e('To get started, use the button below to import demo content and add widgets to your site. After installation, you can manage settings and customize your site using the Customizer. Enjoy your new theme!', 'wedding-ceremony'); ?></p>
		</div>
	<?php }

	/***        Print the content for the final step        ***/

	public function get_step_done() { ?>
		<div id="aster-demo-setup-guid">
			<div class="aster-setup-menu">
				<h3><?php esc_html_e('Setup Navigation Menu','wedding-ceremony'); ?></h3>
				<p><?php esc_html_e('Follow the following Steps to Setup Menu','wedding-ceremony'); ?></p>
				<h4><?php esc_html_e('A) Create Pages','wedding-ceremony'); ?></h4>
				<ol>
					<li><?php esc_html_e('Go to Dashboard >> Pages >> Add New','wedding-ceremony'); ?></li>
					<li><?php esc_html_e('Enter Page Details And Save Changes','wedding-ceremony'); ?></li>
				</ol>
				<h4><?php esc_html_e('B) Add Pages To Menu','wedding-ceremony'); ?></h4>
				<ol>
					<li><?php esc_html_e('Go to Dashboard >> Appearance >> Menu','wedding-ceremony'); ?></li>
					<li><?php esc_html_e('Click On The Create Menu Option','wedding-ceremony'); ?></li>
					<li><?php esc_html_e('Select The Pages And Click On The Add to Menu Button','wedding-ceremony'); ?></li>
					<li><?php esc_html_e('Select Primary Menu From The Menu Setting','wedding-ceremony'); ?></li>
					<li><?php esc_html_e('Click On The Save Menu Button','wedding-ceremony'); ?></li>
				</ol>
			</div>
			<div class="aster-setup-widget">
				<h3><?php esc_html_e('Setup Footer Widgets','wedding-ceremony'); ?></h3>
				<p><?php esc_html_e('Follow the following Steps to Setup Footer Widgets','wedding-ceremony'); ?></p>
				<ol>
					<li><?php esc_html_e('Go to Dashboard >> Appearance >> Widgets','wedding-ceremony'); ?></li>
					<li><?php esc_html_e('Drag And Add The Widgets In The Footer Columns','wedding-ceremony'); ?></li>
				</ol>
			</div>
			<div style="display:flex; justify-content: center; margin-top: 20px; gap:20px">
				<div class="aster-setup-finish">
					<a target="_blank" href="<?php echo esc_url(home_url()); ?>" class="button button-primary">Visit Site</a>
				</div>
				<div class="aster-setup-finish">
					<a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>" class="button button-primary">Customize Your Demo</a>
				</div>
				<div class="aster-setup-finish">
					<a target="_blank" href="<?php echo esc_url( admin_url('themes.php?page=wedding-ceremony-getting-started') ); ?>" class="button button-primary">Getting Started</a>
				</div>
			</div>
		</div>
	<?php }

	/***       Get the plugins registered with TGMPA       ***/
	public function get_plugins() {
		$instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
		$plugins = array(
			'all' 		=> array(),
			'install'	=> array(),
			'update'	=> array(),
			'activate'	=> array()
		);
		foreach( $instance->plugins as $slug=>$plugin ) {
			if( $instance->is_plugin_active( $slug ) && false === $instance->does_plugin_have_update( $slug ) ) {
				// Plugin is installed and up to date
				continue;
			} else {
				$plugins['all'][$slug] = $plugin;
				if( ! $instance->is_plugin_installed( $slug ) ) {
					$plugins['install'][$slug] = $plugin;
				} else {
					if( false !== $instance->does_plugin_have_update( $slug ) ) {
						$plugins['update'][$slug] = $plugin;
					}
					if( $instance->can_plugin_activate( $slug ) ) {
						$plugins['activate'][$slug] = $plugin;
					}
				}
			}
		}
		return $plugins;
	}


	public function setup_plugins() {
		$json = array();
		// send back some json we use to hit up TGM
		$plugins = $this->get_plugins();

		// what are we doing with this plugin?
		foreach ( $plugins['activate'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-activate',
					'action2'       => - 1,
					'message'       => esc_html__( 'Activating Plugin','wedding-ceremony' ),
				);
				break;
			}
		}
		foreach ( $plugins['update'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-update',
					'action2'       => - 1,
					'message'       => esc_html__( 'Updating Plugin','wedding-ceremony' ),
				);
				break;
			}
		}
		foreach ( $plugins['install'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-install',
					'action2'       => - 1,
					'message'       => esc_html__( 'Installing Plugin','wedding-ceremony' ),
				);
				break;
			}
		}
		if ( $json ) {
			$json['hash'] = md5( serialize( $json ) ); // used for checking if duplicates happen, move to next plugin
			wp_send_json( $json );
		} else {
			wp_send_json( array( 'done' => 1, 'message' => esc_html__( 'Success','wedding-ceremony' ) ) );
		}
		exit;
	}

	/***------------------------------------------------- Imports the Demo Content* @since 1.1.0 ----------------------------------------------****/


	//                      ------------- MENUS -----------------                    //

	public function wedding_ceremony_customizer_primary_menu(){

		// ------- Create Primary Menu --------
		$wedding_ceremony_menuname = $wedding_ceremony_themename . 'Main Menu';
		$wedding_ceremony_bpmenulocation = 'primary';
		$wedding_ceremony_menu_exists = wp_get_nav_menu_object( $wedding_ceremony_menuname );

		if( !$wedding_ceremony_menu_exists){
			$wedding_ceremony_menu_id = wp_create_nav_menu($wedding_ceremony_menuname);
			$wedding_ceremony_parent_item = 
			wp_update_nav_menu_item($wedding_ceremony_menu_id, 0, array(
				'menu-item-title' =>  __('Home','wedding-ceremony'),
				'menu-item-classes' => 'home',
				'menu-item-url' => home_url( '/' ),
				'menu-item-status' => 'publish'));

			wp_update_nav_menu_item($wedding_ceremony_menu_id, 0, array(
				'menu-item-title' =>  __('Service','wedding-ceremony'),
				'menu-item-classes' => 'service',
				'menu-item-url' => get_permalink(get_page_by_title('Service')),
				'menu-item-status' => 'publish'));

			wp_update_nav_menu_item($wedding_ceremony_menu_id, 0, array(
				'menu-item-title' =>  __('About','wedding-ceremony'),
				'menu-item-classes' => 'about',
				'menu-item-url' => get_permalink(get_page_by_title('About')),
				'menu-item-status' => 'publish'));

			wp_update_nav_menu_item($wedding_ceremony_menu_id, 0, array(
				'menu-item-title'   => __('Testimonials', 'wedding-ceremony'),
				'menu-item-classes' => 'testimonials',
				'menu-item-url'     => get_permalink(get_page_by_title('Testimonials')),
				'menu-item-status'  => 'publish'
			));

			wp_update_nav_menu_item($wedding_ceremony_menu_id, 0, array(
				'menu-item-title'   => __('Project', 'wedding-ceremony'),
				'menu-item-classes' => 'project',
				'menu-item-url'     => get_permalink(get_page_by_title('Project')),
				'menu-item-status'  => 'publish'
			));

			wp_update_nav_menu_item($wedding_ceremony_menu_id, 0, array(
				'menu-item-title' =>  __('News','wedding-ceremony'),
				'menu-item-classes' => 'news',
				'menu-item-url' => get_permalink(get_page_by_title('News')),
				'menu-item-status' => 'publish'));
			
			if( !has_nav_menu( $wedding_ceremony_bpmenulocation ) ){
				$locations = get_theme_mod('nav_menu_locations');
				$locations[$wedding_ceremony_bpmenulocation] = $wedding_ceremony_menu_id;
				set_theme_mod( 'nav_menu_locations', $locations );
			}
		}
	}

	public function setup_widgets() {

		// Create a front page and assigned the template
		$wedding_ceremony_home_title = 'Home';
		$wedding_ceremony_home_check = get_page_by_title($wedding_ceremony_home_title);
		$wedding_ceremony_home = array(
			'post_type' => 'page',
			'post_title' => $wedding_ceremony_home_title,
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'home'
		);
		$wedding_ceremony_home_id = wp_insert_post($wedding_ceremony_home);

		//Set the static front page
		$wedding_ceremony_home = get_page_by_title( 'Home' );
		update_option( 'page_on_front', $wedding_ceremony_home->ID );
		update_option( 'show_on_front', 'page' );


		// Create a posts page and assigned the template
		$wedding_ceremony_blog_title = 'Service';
		$wedding_ceremony_blog = get_page_by_title($wedding_ceremony_blog_title);

		if (!$wedding_ceremony_blog) {
			$wedding_ceremony_blog = array(
				'post_type' => 'page',
				'post_title' => $wedding_ceremony_blog_title,
				'post_content' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',
				'post_author' => 1,
				'post_name' => 'blog'
			);
			$wedding_ceremony_blog_id = wp_insert_post($wedding_ceremony_blog);

			if (is_wp_error($wedding_ceremony_blog_id)) {
				// Handle error
			}
		} else {
			$wedding_ceremony_blog_id = $wedding_ceremony_blog->ID;
		}
		// Set the posts page
		update_option('page_for_posts', $wedding_ceremony_blog_id);

		// Create a posts page and assigned the template
		$wedding_ceremony_blog_title = 'About';
		$wedding_ceremony_blog = get_page_by_title($wedding_ceremony_blog_title);

		if (!$wedding_ceremony_blog) {
			$wedding_ceremony_blog = array(
				'post_type' => 'page',
				'post_title' => $wedding_ceremony_blog_title,
				'post_status' => 'publish',
				'post_author' => 1,
				'post_name' => 'blog'
			);
			$wedding_ceremony_blog_id = wp_insert_post($wedding_ceremony_blog);

			if (is_wp_error($wedding_ceremony_blog_id)) {
				// Handle error
			}
		} else {
			$wedding_ceremony_blog_id = $wedding_ceremony_blog->ID;
		}
		// Set the posts page
		update_option('page_for_posts', $wedding_ceremony_blog_id);

		
		// Create a Women and assigned the template
		$wedding_ceremony_gallery_title = 'Testimonials';
		$wedding_ceremony_gallery_check = get_page_by_title($wedding_ceremony_gallery_title);
		$wedding_ceremony_gallery = array(
			'post_type' => 'page',
			'post_title' => $wedding_ceremony_gallery_title,
			'post_content' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',
			'post_author' => 1,
			'post_slug' => 'blog'
		);
		$wedding_ceremony_gallery_id = wp_insert_post($wedding_ceremony_gallery);

		// Create a Women and assigned the template
		$wedding_ceremony_gallery_title = 'News';
		$wedding_ceremony_gallery_check = get_page_by_title($wedding_ceremony_gallery_title);
		$wedding_ceremony_gallery = array(
			'post_type' => 'page',
			'post_title' => $wedding_ceremony_gallery_title,
			'post_content' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',
			'post_author' => 1,
			'post_slug' => 'blog'
		);
		$wedding_ceremony_gallery_id = wp_insert_post($wedding_ceremony_gallery);
		
		// Create a Contact and assigned the template
		$wedding_ceremony_contact_title = 'Project';
		$wedding_ceremony_contact_check = get_page_by_title($wedding_ceremony_contact_title);
		$wedding_ceremony_contact = array(
			'post_type' => 'page',
			'post_title' => $wedding_ceremony_contact_title,
			'post_content' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',
			'post_author' => 1,
			'post_slug' => 'blog'
		);
		$wedding_ceremony_contact_id = wp_insert_post($wedding_ceremony_contact);

		// ------------------------------------------ Header Section --------------------------------------
			
			set_theme_mod( 'wedding_ceremony_phone_topbar_number', '+91 1234 567 789');
			set_theme_mod( 'wedding_ceremony_email_topbar_address', 'wedding@example.com');

			set_theme_mod( 'wedding_ceremony_facebook_topbar_link', '#');
			set_theme_mod( 'wedding_ceremony_twitter_topbar_link', '#');
			set_theme_mod( 'wedding_ceremony_pintrest_topbar_link', '#');
			set_theme_mod( 'wedding_ceremony_youtube_topbar_link', '#');
			set_theme_mod( 'wedding_ceremony_instagram_topbar_link', '#');

			set_theme_mod( 'wedding_ceremony_wishlist_button_link_', '#');


		// ------------------------------------------ Blogs for Sections --------------------------------------

			// Create categories if not already created
			$wedding_ceremony_category_slider = wp_create_category('Slider');
			

			// Array of categories to assign to each set of posts
			$wedding_ceremony_categories = array($wedding_ceremony_category_slider);

			// Loop to create posts
			for ($i = 1; $i <= 3; $i++) {
				$title = array(
					'A Love Story Worth Celebrating',
					'Cherished Moments, Timeless Memories',
					'Together Forever: A Tale of Love',
				);

				// Determine category and post index to use for title
				$category_index = ($i <= 3) ? 0 : 1; // First 3 for Slider, next 3 for Blog
				$post_title = $title[$i - 1]; // Adjust for zero-based index in title array

				// Create post object
				$my_post = array(
					'post_title'    => wp_strip_all_tags($post_title),
					'post_status'   => 'publish',
					'post_type'     => 'post',
					'post_category' => array($wedding_ceremony_categories[$category_index]), // Assign Slider to first 3, Blog to next 3
				);

				// Insert the post into the database
				$post_id = wp_insert_post($my_post);

				// Determine the category and set image URLs based on category
				if ($category_index === 0) { // Slider category
					$wedding_ceremony_image_url = get_template_directory_uri() . '/resource/img/default.png';
					$wedding_ceremony_image_name = 'default.png';
				}

				$wedding_ceremony_upload_dir = wp_upload_dir();
				$wedding_ceremony_image_data = file_get_contents($wedding_ceremony_image_url);
				$wedding_ceremony_unique_file_name = wp_unique_filename($wedding_ceremony_upload_dir['path'], $wedding_ceremony_image_name);
				$filename = basename($wedding_ceremony_unique_file_name);

				if (wp_mkdir_p($wedding_ceremony_upload_dir['path'])) {
					$file = $wedding_ceremony_upload_dir['path'] . '/' . $filename;
				} else {
					$file = $wedding_ceremony_upload_dir['basedir'] . '/' . $filename;
				}

				if ( ! function_exists( 'WP_Filesystem' ) ) {
				    require_once( ABSPATH . 'wp-admin/includes/file.php' );
				}

				WP_Filesystem();
				global $wp_filesystem;

				if ( ! $wp_filesystem->put_contents( $file, $wedding_ceremony_image_data, FS_CHMOD_FILE ) ) {
				    wp_die( 'Error saving file!' );
				}

				$wp_filetype = wp_check_filetype($filename, null);
				$attachment = array(
					'post_mime_type' => $wp_filetype['type'],
					'post_title'     => sanitize_file_name($filename),
					'post_content'   => '',
					'post_status'    => 'inherit'
				);

				$wedding_ceremony_attach_id = wp_insert_attachment($attachment, $file, $post_id);

				require_once(ABSPATH . 'wp-admin/includes/image.php');

				$wedding_ceremony_attach_data = wp_generate_attachment_metadata($wedding_ceremony_attach_id, $file);
				wp_update_attachment_metadata($wedding_ceremony_attach_id, $wedding_ceremony_attach_data);
				set_post_thumbnail($post_id, $wedding_ceremony_attach_id);
			}


		/*----------------------------------------- Post --------------------------------------------------*/

			set_theme_mod( 'wedding_ceremony_about_us_left_heading', 'Why We..?');
			set_theme_mod( 'wedding_ceremony_about_us_left_text', 'Lörem ipsum teoitet nyr huruvida don, i telening ');

			set_theme_mod( 'wedding_ceremony_additional_text', 'our Company');
			set_theme_mod( 'wedding_ceremony_enable_topbar', true);

			set_theme_mod( 'wedding_ceremony_about_button_label_', 'Explore');

			// Create categories if not already created
			$wedding_ceremony_category_services = wp_create_category('Services');
			

			// Array of categories to assign to each set of posts
			$wedding_ceremony_categories = array($wedding_ceremony_category_services);
			wp_delete_post(1);

			// Loop to create posts
			for ($i = 1; $i <= 1; $i++) {
				$title = array(
					'Custom wedding that beautifully shares your story',
				);
				$post_content = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation";

				// Determine category and post index to use for title
				$category_index = ($i <= 3) ? 0 : 1; // First 3 for Slider, next 3 for Blog
				$post_title = $title[$i - 1]; // Adjust for zero-based index in title array

				// Create post object
				$my_post = array(
				    'post_title'    => wp_strip_all_tags($post_title),
				    'post_content'  => $post_content, // Add your content here
				    'post_status'   => 'publish',
				    'post_type'     => 'post',
				    'post_category' => array($wedding_ceremony_categories[$category_index]), // Assign Slider to first 3, Blog to next 3
				);

				// Insert the post into the database
				$post_id = wp_insert_post($my_post);

				// Determine the category and set image URLs based on category
				if ($category_index === 0) { // Slider category
					$wedding_ceremony_image_url = get_template_directory_uri() . '/resource/img/about-1.png';
					$wedding_ceremony_image_name = 'about-1.png';
				}

				$wedding_ceremony_upload_dir = wp_upload_dir();
				$wedding_ceremony_image_data = file_get_contents($wedding_ceremony_image_url);
				$wedding_ceremony_unique_file_name = wp_unique_filename($wedding_ceremony_upload_dir['path'], $wedding_ceremony_image_name);
				$filename = basename($wedding_ceremony_unique_file_name);

				if (wp_mkdir_p($wedding_ceremony_upload_dir['path'])) {
					$file = $wedding_ceremony_upload_dir['path'] . '/' . $filename;
				} else {
					$file = $wedding_ceremony_upload_dir['basedir'] . '/' . $filename;
				}

				if ( ! function_exists( 'WP_Filesystem' ) ) {
				    require_once( ABSPATH . 'wp-admin/includes/file.php' );
				}

				WP_Filesystem();
				global $wp_filesystem;

				if ( ! $wp_filesystem->put_contents( $file, $wedding_ceremony_image_data, FS_CHMOD_FILE ) ) {
				    wp_die( 'Error saving file!' );
				}

				$wp_filetype = wp_check_filetype($filename, null);
				$attachment = array(
					'post_mime_type' => $wp_filetype['type'],
					'post_title'     => sanitize_file_name($filename),
					'post_content'   => '',
					'post_status'    => 'inherit'
				);

				$wedding_ceremony_attach_id = wp_insert_attachment($attachment, $file, $post_id);

				require_once(ABSPATH . 'wp-admin/includes/image.php');

				$wedding_ceremony_attach_data = wp_generate_attachment_metadata($wedding_ceremony_attach_id, $file);
				wp_update_attachment_metadata($wedding_ceremony_attach_id, $wedding_ceremony_attach_data);
				set_post_thumbnail($post_id, $wedding_ceremony_attach_id);
			}


		// ---------------------------------------- Slider --------------------------------------------------- //

			for($i=1; $i<=3; $i++) {
				set_theme_mod('wedding_ceremony_banner_button_label_'.$i,'Read More');
			}


		// ---------------------------------------- Related post_tag --------------------------------------------------- //	
		
			set_theme_mod('wedding_ceremony_post_related_post_label','Related Posts');
			set_theme_mod('wedding_ceremony_related_posts_count','3');

		$this->wedding_ceremony_customizer_primary_menu();
	}
}