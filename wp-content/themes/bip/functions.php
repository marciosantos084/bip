<?php

/**
 * Set Content Width
 */
function bip_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'bip_content_width', 1170 );
}
add_action( 'after_setup_theme', 'bip_setup' );
function bip_setup(){
	// Add Title Tag Support.
	add_theme_support( 'title-tag' );

	// Register Menus.
	register_nav_menus(
		array(
			'main_menu' => esc_html__( 'Main menu', 'bip' ),
		)
	);
	add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 300, 300, true );
		add_image_size( 'bip-single', 1170, 460, true );

		// Add Custom Background Support.
		$args = array(
			'default-color' => 'ffffff',
		);
		add_theme_support( 'custom-background', $args );
 
		add_theme_support( 'custom-logo', array(
			'height'		 => 70,
			'width'			 => 200,
			'flex-height'	 => true,
			'flex-width'	 => true,
			'header-text'	 => array( 'site-title', 'site-description' ),
		) );

		// Adds RSS feed links to for posts and comments.
		add_theme_support( 'automatic-feed-links' );

		// WooCommerce support.
		add_theme_support( 'woocommerce' );

		// Recommend plugins.
		add_theme_support( 'recommend-plugins', array(
			'elementor' => array(
				'name'				 => esc_html__( 'Elementor', 'bip' ),
				'active_filename'	 => 'elementor/elementor.php',
				/* translators: %1$s "Elementor Page Builder" plugin name string */
				'description' => sprintf( esc_attr__( 'To take full advantage of all the features this theme has to offer, please install and activate the %s plugin.', 'bip' ), '<strong>Elementor Page Builder</strong>' ),
			),
		) );

		add_theme_support( 'custom-header', apply_filters( 'bip_setup_args', array(
        'default-image'      => get_parent_theme_file_uri( '/img/header.jpg' ),
			'width'              => 2000,
			'height'             => 1200,
			'flex-height'        => true,
			'video'              => false,
    ) ) );
}
add_action( 'after_setup_theme', 'bip_content_width', 0 );

/**
 * Register custom fonts.
 */
function bip_fonts_url() {
	$fonts_url = '';

	/**
	 * Translators: If there are characters in your language that are not
	 * supported by Libre Franklin, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$libre_franklin = _x( 'on', 'Roboto Condensed font: on or off', 'bip' );

	if ( 'off' !== $libre_franklin ) {
		$font_families = array();

		$font_families[] = 'Roboto Condensed:300,300i,400,400i,600,600i,800,800i';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Enqueue Styles (normal style.css and bootstrap.css)
 */
function bip_theme_stylesheets() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'bip-fonts', bip_fonts_url(), array(), null );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), '3.3.7' );
	// Theme stylesheet.
	wp_enqueue_style( 'bip-stylesheet', get_stylesheet_uri() );
  // load Font Awesome css
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.7.0' );
}

add_action( 'wp_enqueue_scripts', 'bip_theme_stylesheets' );

/**
 * Register Bootstrap JS with jquery
 */
function bip_theme_js() {
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '3.3.7', true );
	wp_enqueue_script( 'bip-theme-js', get_template_directory_uri() . '/js/customscript.js', array( 'jquery' ), '1.0.8', true );

	wp_enqueue_script( 'bip-theme-js', get_template_directory_uri() . '/bip/wp-content/themes/bip/js/jQuery.verticalCarousel.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'bip-theme-js', get_template_directory_uri() . '/bip/wp-content/themes/bip/js/jquery.bootstrap.newsbox.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'bip-theme-js', get_template_directory_uri() . '/bip/wp-content/themes/bip/js/jquery.magnific-popup.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'bip-theme-js', get_template_directory_uri() . '/bip/wp-content/themes/bip/js/jquery.mCustomScrollbar.concat.min.js', array( 'jquery' ), '', true );

}

add_action( 'wp_enqueue_scripts', 'bip_theme_js' );


/**
 * Register Custom Navigation Walker include custom menu widget to use walkerclass
 */
require_once( trailingslashit( get_template_directory() ) . 'lib/wp_bootstrap_navwalker.php' );

/**
 * Register Custom Metaboxes
 */
require_once( trailingslashit( get_template_directory() ) . 'lib/metaboxes.php' );



add_action( 'widgets_init', 'bip_widgets_init' );

/**
 * Register the Sidebar(s)
 */
function bip_widgets_init() {
	register_sidebar(
	array(
		'name'			 => esc_html__( 'Right sidebar', 'bip' ),
		'id'			 => 'bip-right-sidebar',
		'before_widget'	 => '<div id="%1$s" class="widget %2$s">',
		'after_widget'	 => '</div>',
		'before_title'	 => '<h3 class="widget-title">',
		'after_title'	 => '</h3>',
	)
	);
	register_sidebar(
	array(
		'name'			 => __( 'Footer section', 'bip' ),
		'id'			 => 'bip-footer-area',
		'before_widget'	 => '<div id="%1$s" class="widget %2$s col-md-3">',
		'after_widget'	 => '</div>',
		'before_title'	 => '<h3 class="widget-title">',
		'after_title'	 => '</h3>',
	)
	);
}

function bip_main_content_width_columns() {

	$columns = '12';

	if ( is_active_sidebar( 'bip-right-sidebar' ) ) {
		$columns = $columns - 3;
	}

	echo absint( $columns );
}

if ( !function_exists( 'bip_posted_on' ) ) :

	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function bip_posted_on() {

		global $post;
  	$author_id = $post->post_author;
  	$author = get_the_author_meta('display_name', $author_id);   
		// Get the author name; wrap it in a link.
		$byline = sprintf(
		/* translators: %s: post author */
		__( 'by %s', 'bip' ), '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID', $author_id ) ) ) . '">' . $author . '</a></span>'
		);

		// Finally, let's write all of this to the page.
		echo '<span class="posted-on">' . bip_time_link() . '</span><span class="byline"> ' . $byline . '</span>';
	}

endif;

if ( !function_exists( 'bip_time_link' ) ) :

	/**
	 * Gets a nicely formatted string for the published date.
	 */
	function bip_time_link() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string, get_the_date( DATE_W3C ), get_the_date(), get_the_modified_date( DATE_W3C ), get_the_modified_date()
		);

		// Wrap the time string in a link, and preface it with 'Posted on'.
		return sprintf(
		/* translators: %s: post date */
		__( 'Posted on %s', 'bip' ), '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);
	}

endif;


if ( !function_exists( 'bip_entry_footer' ) ) :

	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function bip_entry_footer() {

		/* translators: used between list items, there is a space after the comma */
		$separate_meta = __( ', ', 'bip' );

		// Get Categories for posts.
		$categories_list = get_the_category_list( $separate_meta );

		// Get Tags for posts.
		$tags_list = get_the_tag_list( '', $separate_meta );

		// We don't want to output .entry-footer if it will be empty, so make sure its not.
		if ( $categories_list || $tags_list ) {

			echo '<div class="entry-footer">';

			if ( 'post' === get_post_type() ) {
				if ( $categories_list || $tags_list ) {

					// Make sure there's more than one category before displaying.
					if ( $categories_list ) {
						echo '<div class="cat-links"><span class="space-right">' . esc_html__( 'Category:', 'bip' ) . '</span>' . $categories_list . '</div>';
					}

					if ( $tags_list ) {
						echo '<div class="tags-links"><span class="space-right">' . esc_html__( 'Tagged', 'bip' ) . '</span>' . $tags_list . '</div>';
					}
				}
			}
			if ( comments_open() ) :
				echo '<div class="comments-template">';
				comments_popup_link( esc_html__( 'Leave a comment', 'bip' ), esc_html__( 'One comment', 'bip' ), esc_html__( '% comments', 'bip' ), 'comments-link', esc_html__( 'Comments are closed for this post', 'bip' ) );
				echo '</div>';
			endif;

			edit_post_link();

			echo '</div>';
		}
	}

endif;

if ( !function_exists( 'bip_generate_construct_footer' ) ) :
	/**
	 * Build footer
	 */
	add_action( 'bip_generate_footer', 'bip_generate_construct_footer' );

	function bip_generate_construct_footer() {
		?>
		<p class="footer-credits-text text-center">
			<?php 
			/* translators: %1$s: link to wordpress.org */
			printf( esc_html__( 'Proudly powered by %s', 'bip' ), '<a href="' . esc_url( __( 'https://wordpress.org/', 'bip' ) ) . '">WordPress</a>' );
			?>
			<span class="sep"> | </span>
			<?php 
			/* translators: %1$s: link to theme page */
			printf( esc_html__( 'Theme: %1$s', 'bip' ), '<a href="https://themes4wp.com/">bip</a>' );
			?>
		</p> 
		<?php
	}

endif;

if ( !function_exists( 'bip_custom_class' ) ) :
	/**
	 * Add body class to homepage template
	 */
	add_filter( 'body_class', 'bip_custom_class' );

	function bip_custom_class( $classes ) {
		global $post;

		if ( !empty( $post ) ) {
			if ( is_page_template( 'template-parts/template-homepage.php' ) ) {
				$transparent = get_post_meta( $post->ID, 'header_options_transparent-header', true );
				if ( $transparent == '1' ) {
					$classes[] = 'transparent-header';
				}
			}
		}
		return $classes;
	}
	
endif;

add_filter( 'body_class', 'post_name_in_body_class' );
function post_name_in_body_class( $classes ){
	if( is_singular() )
	{
		global $post;
		array_push( $classes, "{$post->post_type}-{$post->post_name}" );
	}
	return $classes;
}

add_filter('body_class','add_category_to_single');
  function add_category_to_single($classes) {
    if (is_single() ) {
      global $post;
      foreach((get_the_category($post->ID)) as $category) {
        // add category slug to the $classes array
        $classes[] = $category->category_nicename;
      }
    }
    // return the $classes array
    return $classes;
  }
  
  function bloglite_breadcrumb() {
    global $post;
    echo '<ul id="trilha">';
    if (!is_home()) {
        echo '<li><a href="';
        echo get_option('home');
        echo '">';
        echo 'BIP';
        echo '</a></li><li class="separador"> <svg version="1.1" id="layer-<?php the_ID(); ?>" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 11.8 21.1" style="enable-background:new 0 0 11.8 21.1;" xml:space="preserve">

				<path class="breadcrumb" d="M1.8,1.6L10,9.8c0.4,0.4,0.4,1.1,0,1.5l-8.2,8.3"/>
				</svg>  </li>';
        if (is_category() || is_single()) {
            echo '<li>';
            the_category(' </li><li class="separador"> <svg version="1.1" id="layer-<?php the_ID(); ?>" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 11.8 21.1" style="enable-background:new 0 0 11.8 21.1;" xml:space="preserve">

				<path class="breadcrumb" d="M1.8,1.6L10,9.8c0.4,0.4,0.4,1.1,0,1.5l-8.2,8.3"/>
				</svg> </li><li> ');
            if (is_single()) {
                echo '</li><li class="separador"> <svg version="1.1" id="layer-<?php the_ID(); ?>" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 11.8 21.1" style="enable-background:new 0 0 11.8 21.1;" xml:space="preserve">

				<path class="breadcrumb" d="M1.8,1.6L10,9.8c0.4,0.4,0.4,1.1,0,1.5l-8.2,8.3"/>
				</svg> </li><li>';
                the_title();
                echo '</li>';
            }
        } elseif (is_page()) {
            if($post->post_parent){
                $anc = get_post_ancestors( $post->ID );
                $title = get_the_title();
                foreach ( $anc as $ancestor ) {
                    $output = '<li><a href="'.get_permalink($ancestor).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a></li> <li class="separador">/</li>';
                }
                echo $output;
                echo '<strong title="'.$title.'"> '.$title.'</strong>';
            } else {
                echo '<li><strong> '.get_the_title().'</strong></li>';
            }
        }
    }
    elseif (is_tag()) { single_tag_title();}
    elseif (is_day()) { echo "<li>Arquivo de "; the_time('j \d\e F \d\e Y'); echo'</li>'; }
    elseif (is_month()) { echo "<li>Arquivo de "; the_time('F \d\e Y'); echo'</li>'; }
    elseif (is_year()) { echo "<li>Arquivo de "; the_time('Y'); echo'</li>'; }
    elseif (is_author()) { echo "<li>Arquivo do autor"; echo'</li>'; }
    elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { echo "<li>Arquivo do blog"; echo'</li>'; }
    elseif (is_search()) { echo "<li>Resultados da pesquisa"; echo'</li>'; }
    echo '</ul>';
}

function get_excerpt(){
	$excerpt = get_the_excerpt();
	//$excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
	$excerpt = strip_shortcodes($excerpt);
	$excerpt = strip_tags($excerpt);
	$excerpt = substr($excerpt, 0, 30);
	$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
	$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
	return $excerpt;
}

function title_limite($maximo){
$title = get_the_title();
if( strlen($title)>$maximo){
$continua='...';
}
$title=mb_substr($title,0,$maximo,'UTF-8');
echo $title.$continua;
}



function more_post_ajax(){
    $offset = $_POST["offset"];
    $ppp = $_POST["ppp"];
    header("Content-Type: text/html");

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $ppp,
        'cat' => 1,
        'offset' => $offset,
    );

    $loop = new WP_Query($args);
    while ($loop->have_posts()) { $loop->the_post(); 
       the_content();
    }

    exit; 
}

add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax'); 
add_action('wp_ajax_more_post_ajax', 'more_post_ajax');