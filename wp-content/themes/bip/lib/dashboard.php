<?php
/**
 * Add theme dashboard page
 */

/**
 * Get theme actions required
 *
 * @return array|mixed|void
 */
if ( !function_exists( 'bip_get_actions_required' ) ) :
	
	function bip_get_actions_required() {

		$actions						 = array();
		$front_page						 = get_option( 'page_on_front' );
		$actions[ 'page_on_front' ]		 = 'dismiss';
		$actions[ 'page_template' ]		 = 'dismiss';
		$actions[ 'recommend_plugins' ]	 = 'dismiss';
		if ( 'page' != get_option( 'show_on_front' ) ) {
			$front_page = 0;
		}
		if ( $front_page <= 0 ) {
			$actions[ 'page_on_front' ]	 = 'active';
			$actions[ 'page_template' ]	 = 'active';
		} else {
			if ( get_post_meta( $front_page, '_wp_page_template', true ) == 'template-parts/template-homepage.php' || get_post_meta( $front_page, '_wp_page_template', true ) == 'template-parts/template-woocommerce.php' ) {
				$actions[ 'page_template' ] = 'dismiss';
			} else {
				$actions[ 'page_template' ] = 'active';
			}
		}

		$recommend_plugins = get_theme_support( 'recommend-plugins' );
		if ( is_array( $recommend_plugins ) && isset( $recommend_plugins[ 0 ] ) ) {
			$recommend_plugins = $recommend_plugins[ 0 ];
		} else {
			$recommend_plugins[] = array();
		}

		if ( !empty( $recommend_plugins ) ) {

			foreach ( $recommend_plugins as $plugin_slug => $plugin_info ) {
				$plugin_info = wp_parse_args( $plugin_info, array(
					'name'				 => '',
					'active_filename'	 => '',
				) );
				if ( $plugin_info[ 'active_filename' ] ) {
					$active_file_name = $plugin_info[ 'active_filename' ];
				} else {
					$active_file_name = $plugin_slug . '/' . $plugin_slug . '.php';
				}
				if ( !is_plugin_active( $active_file_name ) ) {
					$actions[ 'recommend_plugins' ] = 'active';
				}
			}
		}

		$actions		 = apply_filters( 'bip_get_actions_required', $actions );
		$hide_by_click	 = get_option( 'bip_actions_dismiss' );
		if ( !is_array( $hide_by_click ) ) {
			$hide_by_click = array();
		}

		$n_active		 = $n_dismiss		 = 0;
		$number_notice	 = 0;
		foreach ( $actions as $k => $v ) {
			if ( !isset( $hide_by_click[ $k ] ) ) {
				$hide_by_click[ $k ] = false;
			}

			if ( $v == 'active' ) {
				$n_active ++;
				$number_notice ++;
				if ( $hide_by_click[ $k ] ) {
					if ( $hide_by_click[ $k ] == 'hide' ) {
						$number_notice --;
					}
				}
			} else if ( $v == 'dismiss' ) {
				$n_dismiss ++;
			}
		}

		$return = array(
			'actions'		 => $actions,
			'number_actions' => count( $actions ),
			'number_active'	 => $n_active,
			'number_dismiss' => $n_dismiss,
			'hide_by_click'	 => $hide_by_click,
			'number_notice'	 => $number_notice,
		);
		if ( $return[ 'number_notice' ] < 0 ) {
			$return[ 'number_notice' ] = 0;
		}

		return $return;
	}
	
endif;
add_action( 'switch_theme', 'bip_reset_actions_required' );

function bip_reset_actions_required() {
	delete_option( 'bip_actions_dismiss' );
}

if ( !function_exists( 'bip_admin_scripts' ) ) :

	/**
	 * Enqueue scripts for admin page only: Theme info page
	 */
	function bip_admin_scripts( $hook ) {
		wp_enqueue_style( 'bip-admin-css', get_template_directory_uri() . '/css/admin.css' );
		if ( $hook === 'appearance_page_et_bip' ) {
			// Add recommend plugin css
			wp_enqueue_style( 'plugin-install' );
			wp_enqueue_script( 'plugin-install' );
			wp_enqueue_script( 'updates' );
			add_thickbox();
		}
	}

endif;
add_action( 'admin_enqueue_scripts', 'bip_admin_scripts' );

add_action( 'admin_menu', 'bip_theme_info' );

function bip_theme_info() {

	$actions		 = bip_get_actions_required();
	$number_count	 = $actions[ 'number_notice' ];

	if ( $number_count > 0 ) {
		/* translators: %1$s: replaced with number (counter) */
		$update_label	 = sprintf( _n( '%1$s action required', '%1$s actions required', $number_count, 'bip' ), $number_count );
		$count			 = "<span class='update-plugins count-" . esc_attr( $number_count ) . "' title='" . esc_attr( $update_label ) . "'><span class='update-count'>" . number_format_i18n( $number_count ) . "</span></span>";
		/* translators: %s: replaced with number (counter) */
		$menu_title		 = sprintf( esc_html__( 'bip theme %s', 'bip' ), $count );
	} else {
		$menu_title = esc_html__( 'bip theme', 'bip' );
	}

	add_theme_page( esc_html__( 'bip dashboard', 'bip' ), $menu_title, 'edit_theme_options', 'et_bip', 'bip_theme_info_page' );
}

/**
 * Add admin notice when active theme, just show one time
 *
 * @return bool|null
 */
add_action( 'admin_notices', 'bip_admin_notice' );

function bip_admin_notice() {
	if ( !function_exists( 'bip_get_actions_required' ) ) {
		return false;
	}
	// $actions = bip_get_actions_required();
	// $number_action = $actions['number_notice'];
	// if ( $number_action > 0 ) {
	global $current_user;
	$user_id	 = $current_user->ID;
	$theme_data	 = wp_get_theme();
	if ( !get_user_meta( $user_id, esc_html( $theme_data->get( 'TextDomain' ) ) . '_notice_ignore' ) ) {
		?>
		<div class="notice bip-notice">

			<h1>
				<?php
				/* translators: %1$s: theme name, %2$s theme version */
				printf( esc_html__( 'Welcome to %1$s - Version %2$s', 'bip' ), esc_html( $theme_data->Name ), esc_html( $theme_data->Version ) );
				?>
			</h1>

			<p>
				<?php
				/* translators: %1$s: theme name, %2$s link */
				printf( __( 'Welcome! Thank you for choosing %1$s! To fully take advantage of the best our theme can offer please make sure you visit our <a href="%2$s">Welcome page</a>', 'bip' ), esc_html( $theme_data->Name ), esc_url( admin_url( 'themes.php?page=et_bip' ) ) );
				printf( '<a href="%1$s" class="notice-dismiss dashicons dashicons-dismiss dashicons-dismiss-icon"></a>', '?' . esc_html( $theme_data->get( 'TextDomain' ) ) . '_notice_ignore=0' );
				?>
			</p>
			<p>
				<a href="<?php echo esc_url( admin_url( 'themes.php?page=et_bip' ) ) ?>" class="button button-primary button-hero" style="text-decoration: none;">
					<?php
					/* translators: %s theme name */
					printf( esc_html__( 'Get started with %s', 'bip' ), esc_html( $theme_data->Name ) )
					?>
				</a>
			</p>
		</div>
		<?php
	}
}

add_action( 'admin_init', 'bip_notice_ignore' );

function bip_notice_ignore() {
	global $current_user;
	$theme_data	 = wp_get_theme();
	$user_id	 = $current_user->ID;
	/* If user clicks to ignore the notice, add that to their user meta */
	if ( isset( $_GET[ esc_html( $theme_data->get( 'TextDomain' ) ) . '_notice_ignore' ] ) && '0' == $_GET[ esc_html( $theme_data->get( 'TextDomain' ) ) . '_notice_ignore' ] ) {
		add_user_meta( $user_id, esc_html( $theme_data->get( 'TextDomain' ) ) . '_notice_ignore', 'true', true );
	}
}

function bip_render_recommend_plugins( $recommend_plugins = array() ) {
	foreach ( $recommend_plugins as $plugin_slug => $plugin_info ) {
		$plugin_info	 = wp_parse_args( $plugin_info, array(
			'name'				 => '',
			'active_filename'	 => '',
			'description'		 => '',
		) );
		$plugin_name	 = $plugin_info[ 'name' ];
		$plugin_desc	 = $plugin_info[ 'description' ];
		$status			 = is_dir( WP_PLUGIN_DIR . '/' . $plugin_slug );
		$button_class	 = 'install-now button';
		if ( $plugin_info[ 'active_filename' ] ) {
			$active_file_name = $plugin_info[ 'active_filename' ];
		} else {
			$active_file_name = $plugin_slug . '/' . $plugin_slug . '.php';
		}

		if ( !is_plugin_active( $active_file_name ) ) {
			$button_txt = __( 'Install Now', 'bip' );
			if ( !$status ) {
				$install_url = wp_nonce_url(
				add_query_arg(
				array(
					'action' => 'install-plugin',
					'plugin' => $plugin_slug
				), network_admin_url( 'update.php' )
				), 'install-plugin_' . $plugin_slug
				);
			} else {
				$install_url	 = add_query_arg( array(
					'action'		 => 'activate',
					'plugin'		 => rawurlencode( $active_file_name ),
					'plugin_status'	 => 'all',
					'paged'			 => '1',
					'_wpnonce'		 => wp_create_nonce( 'activate-plugin_' . $active_file_name ),
				), network_admin_url( 'plugins.php' ) );
				$button_class	 = 'activate-now button-primary';
				$button_txt		 = __( 'Activate', 'bip' );
			}

			$detail_link = add_query_arg(
			array(
				'tab'		 => 'plugin-information',
				'plugin'	 => $plugin_slug,
				'TB_iframe'	 => 'true',
				'width'		 => '772',
				'height'	 => '349',
			), network_admin_url( 'plugin-install.php' )
			);

			echo '<div class="rcp">';
			echo '<h4 class="rcp-name">';
			echo esc_html( $plugin_name );
			echo '</h4>';
			echo '<p class="rcp-desc">';
			echo wp_kses_post( $plugin_desc );
			echo '</p>';
			echo '<p class="action-btn plugin-card-' . esc_attr( $plugin_slug ) . '"><a href="' . esc_url( $install_url ) . '" data-slug="' . esc_attr( $plugin_slug ) . '" class="' . esc_attr( $button_class ) . '">' . esc_html( $button_txt ) . '</a></p>';
			echo '<a class="plugin-detail thickbox open-plugin-details-modal" href="' . esc_url( $detail_link ) . '">' . esc_html__( 'Details', 'bip' ) . '</a>';
			echo '</div>';
		}
	}
}

function bip_admin_dismiss_actions() {
	// Action for dismiss
	if ( isset( $_GET[ 'bip_action_notice' ] ) ) {
		$actions_dismiss = get_option( 'bip_actions_dismiss' );
		if ( !is_array( $actions_dismiss ) ) {
			$actions_dismiss = array();
		}
		$action_key = stripslashes( $_GET[ 'bip_action_notice' ] );
		if ( isset( $actions_dismiss[ $action_key ] ) && $actions_dismiss[ $action_key ] == 'hide' ) {
			$actions_dismiss[ $action_key ] = 'show';
		} else {
			$actions_dismiss[ $action_key ] = 'hide';
		}
		update_option( 'bip_actions_dismiss', $actions_dismiss );
		$url = $_SERVER[ 'REQUEST_URI' ];
		$url = remove_query_arg( 'bip_action_notice', $url );
		wp_redirect( $url );
		die();
	}

	// Action for copy options
	if ( isset( $_POST[ 'copy_from' ] ) && isset( $_POST[ 'copy_to' ] ) ) {
		$from	 = sanitize_text_field( $_POST[ 'copy_from' ] );
		$to		 = sanitize_text_field( $_POST[ 'copy_to' ] );
		if ( $from && $to ) {
			$mods = get_option( "theme_mods_" . $from );
			update_option( "theme_mods_" . $to, $mods );

			$url = $_SERVER[ 'REQUEST_URI' ];
			$url = add_query_arg( array( 'copied' => 1 ), $url );
			wp_redirect( $url );
			die();
		}
	}
}

add_action( 'admin_init', 'bip_admin_dismiss_actions' );

add_action( 'bip_recommended_title', 'bip_recommended_title_construct' );
function bip_recommended_title_construct() {
	// Check for current viewing tab
	$tab = null;
	if ( isset( $_GET[ 'tab' ] ) ) {
		$tab = $_GET[ 'tab' ];
	} else {
		$tab = null;
	}
	$actions_r		 = bip_get_actions_required();
	$number_action	 = $actions_r[ 'number_notice' ];
	$actions		 = $actions_r[ 'actions' ];
	?>
	<a href="?page=et_bip&tab=actions_required" class="nav-tab<?php echo $tab == 'actions_required' ? ' nav-tab-active' : null; ?>"><?php
		esc_html_e( 'Recommended Actions', 'bip' );
		echo ( $number_action > 0 ) ? "<span class='theme-action-count'>{$number_action}</span>" : '';
		?>
	</a>
	<?php
}

add_action( 'bip_import_title', 'bip_recommended_import_construct' );
function bip_recommended_import_construct() {
	// Check for current viewing tab
	$tab = null;
	if ( isset( $_GET[ 'tab' ] ) ) {
		$tab = $_GET[ 'tab' ];
	} else {
		$tab = null;
	}
	?>
	<a href="?page=et_bip&tab=import_data" class="nav-tab<?php echo $tab == 'import_data' ? ' nav-tab-active' : null; ?>"><?php esc_html_e( 'One Click Demo Import', 'bip' ) ?></a>
	<?php
}

function bip_theme_info_page() {

	$theme_data = wp_get_theme();

	if ( isset( $_GET[ 'bip_action_dismiss' ] ) ) {
		$actions_dismiss = get_option( 'bip_actions_dismiss' );
		if ( !is_array( $actions_dismiss ) ) {
			$actions_dismiss = array();
		}
		$actions_dismiss[ stripslashes( $_GET[ 'bip_action_dismiss' ] ) ] = 'dismiss';
		update_option( 'bip_actions_dismiss', $actions_dismiss );
	}

	// Check for current viewing tab
	$tab = null;
	if ( isset( $_GET[ 'tab' ] ) ) {
		$tab = $_GET[ 'tab' ];
	} else {
		$tab = null;
	}

	$actions_r		 = bip_get_actions_required();
	$number_action	 = $actions_r[ 'number_notice' ];
	$actions		 = $actions_r[ 'actions' ];

	$current_action_link = esc_url( admin_url( 'themes.php?page=et_bip&tab=actions_required' ) );

	$recommend_plugins = get_theme_support( 'recommend-plugins' );
	if ( is_array( $recommend_plugins ) && isset( $recommend_plugins[ 0 ] ) ) {
		$recommend_plugins = $recommend_plugins[ 0 ];
	} else {
		$recommend_plugins[] = array();
	}
	?>
	<div class="wrap about-wrap theme_info_wrapper">
		<h1>
			<?php
			/* translators: %1$s theme name, %2$s theme version */
			printf( esc_html__( 'Welcome to %1$s - Version %2$s', 'bip' ), esc_html( $theme_data->Name ), esc_html( $theme_data->Version ) );
			?>
		</h1>
		<div class="about-text"><?php echo esc_html( $theme_data->Description ); ?></div>
		<h2 class="nav-tab-wrapper">
			<a href="?page=et_bip" class="nav-tab<?php echo is_null( $tab ) ? ' nav-tab-active' : null; ?>"><?php echo esc_html( $theme_data->Name ); ?></a>
			<?php do_action( 'bip_recommended_title' ); ?>
			<?php do_action( 'bip_import_title' ); ?>
			<a href="?page=et_bip&tab=pro_version" class="nav-tab<?php echo $tab == 'pro_version' ? ' nav-tab-active' : null; ?>"><?php esc_html_e( 'PRO version', 'bip' ) ?></a>
			<?php do_action( 'bip_admin_more_tabs' ); ?>
		</h2>

		<?php if ( is_null( $tab ) ) { ?>
			<div class="theme_info info-tab-content">
				<div class="theme_info_column clearfix">
					<div class="theme_info_left">
						<div class="theme_link">
							<h3><?php esc_html_e( 'Theme Customizer', 'bip' ); ?></h3>
							<p class="about">
								<?php
								/* translators: %s theme name */
								printf( esc_html__( '%s supports the Theme Customizer for all theme settings. Click "Customize" to personalize your site.', 'bip' ), esc_html( $theme_data->Name ) );
								?>
							</p>
							<p>
								<a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Start customizing', 'bip' ); ?></a>
							</p>
						</div>
						<div class="theme_link">
							<h3><?php esc_html_e( 'Theme documentation', 'bip' ); ?></h3>
							<p class="about">
								<?php
								/* translators: %s theme name */
								printf( esc_html__( 'Need help in setting up and configuring %s? Please take a look at our documentation page.', 'bip' ), esc_html( $theme_data->Name ) );
								?>
							</p>
							<p>
								<?php $theme_url = 'http://demo.themes4wp.com/documentation/category/' . esc_html( $theme_data->get( 'TextDomain' ) ) . '/'; ?>
								<a href="<?php echo esc_url( $theme_url ); ?>" target="_blank" class="button button-secondary">
									<?php
									/* translators: %s theme name */
									printf( esc_html__( '%s Documentation', 'bip' ), esc_html( $theme_data->Name ) );
									?>
								</a>
							</p>
						</div>
						<div class="theme_link">
							<h3><?php esc_html_e( 'Having trouble? Need support?', 'bip' ); ?></h3>
							<p>
								<a href="<?php echo esc_url( 'https://themes4wp.com/contact/' ); ?>" target="_blank" class="button button-secondary"><?php esc_html_e( 'Contact us', 'bip' ); ?></a>
							</p>
						</div>
					</div>

					<div class="theme_info_right">
						<img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/screenshot.jpg" alt="Theme Screenshot" />
					</div>
				</div>
			</div>
		<?php } ?>

		<?php if ( $tab == 'actions_required' ) { ?>
			<div class="action-required-tab info-tab-content">

				<?php
				if ( is_child_theme() ) {
					$child_theme = wp_get_theme();
					?>
					<form method="post" action="<?php echo esc_attr( $current_action_link ); ?>" class="demo-import-boxed copy-settings-form">
						<p>
							<strong>
								<?php
								/* translators: %1$s theme name */
								printf( esc_html__( 'You\'re using %1$s, a bip child theme', 'bip' ), esc_html( $child_theme->Name ) );
								?>
							</strong>
						</p>
						<p>
							<?php esc_html_e( 'Do you want to import the theme settings of the parent theme into your child theme?', 'bip' ); ?>
						</p>
						<p>
							<?php
							$select		 = '<select name="copy_from">';
							$select .= '<option value="">' . esc_html__( 'From theme', 'bip' ) . '</option>';
							$select .= '<option value="bip">bip</option>';
							$select .= '<option value="' . esc_attr( $child_theme->get_stylesheet() ) . '">' . ( $child_theme->Name ) . '</option>';
							$select .='</select>';

							$select_2 = '<select name="copy_to">';
							$select_2 .= '<option value="">' . esc_html__( 'To theme', 'bip' ) . '</option>';
							$select_2 .= '<option value="bip">bip</option>';
							$select_2 .= '<option value="' . esc_attr( $child_theme->get_stylesheet() ) . '">' . ( $child_theme->Name ) . '</option>';
							$select_2 .='</select>';

							echo $select . ' to ' . $select_2;
							?>
							<input type="submit" class="button button-secondary" value="<?php esc_html_e( 'Import now', 'bip' ); ?>">
						</p>
						<?php if ( isset( $_GET[ 'copied' ] ) && $_GET[ 'copied' ] == 1 ) { ?>
							<p>
								<?php esc_html_e( 'Are you sure you want to proceed? Imported settings will replace the ones of the current theme.', 'bip' ); ?>
							</p>
						<?php } ?>
					</form>

				<?php } ?>
				<?php if ( $actions_r[ 'number_active' ] > 0 ) { ?>
					<?php $actions = wp_parse_args( $actions, array( 'page_on_front' => '', 'page_template' ) ) ?>

					<?php if ( $actions[ 'recommend_plugins' ] == 'active' ) { ?>
						<div id="plugin-filter" class="recommend-plugins action-required">
							<a  title="" class="dismiss" href="<?php echo add_query_arg( array( 'bip_action_notice' => 'recommend_plugins' ), $current_action_link ); ?>">
								<?php if ( $actions_r[ 'hide_by_click' ][ 'recommend_plugins' ] == 'hide' ) { ?>
									<span class="dashicons dashicons-hidden"></span>
								<?php } else { ?>
									<span class="dashicons  dashicons-visibility"></span>
								<?php } ?>
							</a>
							<h3><?php esc_html_e( 'Recommended plugins', 'bip' ); ?></h3>
							<?php
							bip_render_recommend_plugins( $recommend_plugins );
							?>
						</div>
					<?php } ?>


					<?php if ( $actions[ 'page_on_front' ] == 'active' ) { ?>
						<div class="theme_link  action-required">
							<a title="<?php esc_attr_e( 'Dismiss', 'bip' ); ?>" class="dismiss" href="<?php echo add_query_arg( array( 'bip_action_notice' => 'page_on_front' ), $current_action_link ); ?>">
								<?php if ( $actions_r[ 'hide_by_click' ][ 'page_on_front' ] == 'hide' ) { ?>
									<span class="dashicons dashicons-hidden"></span>
								<?php } else { ?>
									<span class="dashicons  dashicons-visibility"></span>
								<?php } ?>
							</a>
							<h3><?php esc_html_e( 'Switch "Your homepage displays" to "A static page"', 'bip' ); ?></h3>
							<div class="about">
								<p>
									<?php
									/* translators: %1$s "Documentation" string and link */
									printf( esc_html__( 'If you want your website to have a "one-page" look, go to Appearence > Customize > Homepage settings and switch "Your homepage displays" to "A static page". %1$s', 'bip' ), '<a class="documentation" href="' . esc_url( 'http://demo.themes4wp.com/documentation/getting-started-with-elementor-page-builder/' ) . '" target="_blank">' . esc_html__( 'Documentation', 'bip' ) . '</a>' );
									?>
								</p>
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/lib/img/front-page-setup.jpg">
							</div>
							<p>
								<a  href="<?php echo esc_url( admin_url( 'options-reading.php' ) ); ?>" class="button">
									<?php esc_html_e( '"Your homepage displays" setup', 'bip' ); ?>
								</a>
							</p>
						</div>
					<?php } ?>

					<?php if ( $actions[ 'page_template' ] == 'active' ) { ?>
						<div class="theme_link  action-required">
							<a  title="<?php esc_attr_e( 'Dismiss', 'bip' ); ?>" class="dismiss" href="<?php echo add_query_arg( array( 'bip_action_notice' => 'page_template' ), $current_action_link ); ?>">
								<?php if ( $actions_r[ 'hide_by_click' ][ 'page_template' ] == 'hide' ) { ?>
									<span class="dashicons dashicons-hidden"></span>
								<?php } else { ?>
									<span class="dashicons dashicons-visibility"></span>
								<?php } ?>
							</a>
							<h3><?php esc_html_e( 'Set your homepage page template to "Elementor Page"', 'bip' ); ?></h3>

							<div class="about">
								<p>
									<?php
									/* translators: %1$s "Documentation" string and link */
									printf( esc_html__( 'To change homepage contents, you need to choose "Elementor Page" as the template for your homepage. %1$s', 'bip' ), '<a class="documentation" href="' . esc_url( 'http://demo.themes4wp.com/documentation/getting-started-with-elementor-page-builder/' ) . '" target="_blank">' . esc_html__( 'Documentation', 'bip' ) . '</a>' );
									?>
								</p>
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/lib/img/page-template.jpg">
							</div>
							<p>
								<?php
								$front_page = get_option( 'page_on_front' );
								if ( $front_page <= 0 ) {
									?>
									<a  href="<?php echo esc_url( admin_url( 'options-reading.php' ) ); ?>" class="button"><?php esc_html_e( '"Your homepage displays" setup', 'bip' ); ?></a>
									<?php
								}

								if ( $front_page > 0 && ( get_post_meta( $front_page, '_wp_page_template', true ) != 'template-parts/template-homepage.php' || get_post_meta( $front_page, '_wp_page_template', true ) != 'template-parts/template-woocommerce.php' ) ) {
									?>
									<a href="<?php echo esc_url( get_edit_post_link( $front_page ) ); ?>" class="button"><?php esc_html_e( 'Change homepage template', 'bip' ); ?></a>
									<?php
								}
								?>
							</p>
						</div>
					<?php } ?>
					<?php do_action( 'bip_more_required_details', $actions ); ?>
				<?php } else { ?>
					<p>
						<?php esc_html_e( 'Hooray! There are no required actions for you right now.', 'bip' ); ?>
					</p>
				<?php } ?>
			</div>
		<?php } ?>
		<?php if ( $tab == 'import_data' ) { ?>
			<div class="import-data-tab info-tab-content">
				<?php
				/* translators: %1$s "Documentation" string and link */
				printf( esc_attr__( 'You can import the demo content with just one click. For step-by-step video tutorial, see %1$s', 'bip' ), '<a class="documentation" href="' . esc_url( 'http://demo.themes4wp.com/documentation/importing-elementor-demo-pages/' ) . '" target="_blank">' . esc_html__( 'documentation', 'bip' ) . '</a>' );
				?>
			</div>
		<?php } ?>
		<?php if ( $tab == 'pro_version' ) { ?>
			<div class="pro-version-tab info-tab-content">
				<a href="<?php echo esc_url( 'https://themes4wp.com/product/bip-pro/' ); ?>" target="_blank">
					<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/lib/img/bip-pro-banner.jpg">
				</a>
				<h3>
					<?php esc_html_e( 'Upgrade to bip PRO for these awesome features!', 'bip' ); ?>
				</h3>
				<ul>
					<li><?php esc_html_e( 'Unlimited colors', 'bip' ); ?></li>
					<li><?php esc_html_e( '600+ Google fonts', 'bip' ); ?></li>
					<li><?php esc_html_e( 'Full WooCommerce support', 'bip' ); ?></li>
					<li><?php esc_html_e( '10+ WooCommerce templates', 'bip' ); ?></li>
					<li><?php esc_html_e( 'Footer credits editor', 'bip' ); ?></li>
					<li><?php esc_html_e( 'And much more...', 'bip' ); ?></li>
				</ul>
				<p>
					<a href="<?php echo esc_url( 'https://themes4wp.com/product/bip-pro/' ); ?>" target="_blank" class="button button-primary">
						<?php esc_html_e( 'bip PRO', 'bip' ); ?>
					</a>
				</p>
			</div>
		<?php } ?>

		<?php do_action( 'bip_more_tabs_details', $actions ); ?>

	</div> <!-- END .theme_info -->
	<script type="text/javascript">
		jQuery( document ).ready( function ( $ ) {
			$( 'body' ).addClass( 'about-php' );

			$( '.copy-settings-form' ).on( 'submit', function () {
				var c = confirm( '<?php echo esc_attr_e( 'Are you sure you want to proceed? Imported settings will replace the ones of the current theme.', 'bip' ); ?>' );
				if ( !c ) {
					return false;
				}
			} );
		} );
	</script>
	<?php
}
