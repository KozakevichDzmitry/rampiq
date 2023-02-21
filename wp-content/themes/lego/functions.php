<?php

add_filter('the_generator', '__return_empty_string');
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
add_filter( 'tiny_mce_plugins', 'disable_wp_emojis_in_tinymce' );

add_filter('show_admin_bar', '__return_false');
 
 
add_filter('pll_get_post_types', 'unset_cpt_pll', 10, 2);
function unset_cpt_pll( $post_types, $is_settings ) {
$post_types['acf-field-group'] = 'acf-field-group';
    $post_types['acf'] = 'acf';
    return $post_types;
}
 
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action( 'wp_head',      'rest_output_link_wp_head'              );
remove_action( 'wp_head',      'wp_oembed_add_discovery_links'         );
add_theme_support( 'post-thumbnails' );
add_filter( 'jpeg_quality', function(){return 100;} );		
 
 

function disable_wp_emojis_in_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
} 


 function my_acf_google_map_api( $api ){	
	$api['key'] = 'AIzaSyBqQMQZvc0kLUzOZg8-1f3TVGb3Hs1_S4c';
	return $api;	
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');


function add_file_types_to_uploads($file_types){
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes );
    return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');
 



class Main_Submenu_Class extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $classes 	 = array('sub-menu', 'list-unstyled', 'child-navigation');
        $class_names = implode( ' ', $classes );
        $output .= "\n" . '<ul class="' . $class_names . '">' . "\n";
    }

    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
        $id_field = $this->db_fields['id'];
        if ( is_object( $args[0] ) )
            $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {
        global $wp_query;

        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names_arr = array();
        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;

        $class_names =  join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names_arr[] = esc_attr( $class_names );
        $class_names_arr[]='menu-item-id-'.$item->ID;


		$span_act="";

        $class_names = ' class="'. implode(' ', $class_names_arr) . '"';
		$menu_locations = '';
		if (isset($args->menu_id)) {
			if ($args->menu_id!='') $menu_locations = $args->menu_id.'_';
		}
		
      $output .= $indent . '<li id="menu-item-'.$menu_locations. $item->ID . '"' . $value . $class_names .'>';
		$attributes='';
		if ($item->url!='#')
		{
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url ) ? ' href="' . $item->url .'"' : '';
		}
		
        $item_output = $args->before;
		$ico_show=$ico_class='';
		if ($args->menu_id == 'header_menu_links' OR $args->menu_id == 'header_menu_mob') {
		    if ($item->menu_item_parent > 0) {
		        $ico=get_field('ico',$item->object_id);
		        if ($ico!='') {
                    $ico_show='<div class="ico"><img src="'.$ico.'"></div>';
                    $ico_class="show_ico";
                }
            }
        }



		$item_output .='<div class="items '.$ico_class.'">'.$ico_show.'<a'. $attributes .'>';
        $item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
        $item_output .= $args->link_after;
        $item_output .= '</a>';
        if ( $args->has_children )  $item_output .= '<span data-from="menu-item-'.$menu_locations.$item->ID.'" class="show_sub_menu '.$span_act.'"><i></i></span>';
        $item_output .= '</div>';
        
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}



function menulang_setup(){ 
load_theme_textdomain('themename', get_template_directory() . '/languages');
register_nav_menus( array('header'   => __('Header','themename')) );  
register_nav_menus( array('footer_1'   => __('Footer 1','themename')) );  
register_nav_menus( array('footer_2'   => __('Footer 2','themename')) );  
register_nav_menus( array('footer_3'   => __('Footer Privacy & Terms','themename')) );  
register_nav_menus( array('social'   => __('Social','themename')) );  
}
add_action('after_setup_theme', 'menulang_setup');
function inspiry_theme_sidebars() { 
register_sidebar( array('name' => __( 'Logo', 'themename' ),'id' => 'logo','description' => __( 'Logo', 'themename' ),'before_widget' => '','after_widget' => '','before_title' => '','after_title' => '' ));  	
register_sidebar( array('name' => __( 'Header Contact us', 'themename' ),'id' => 'header_buts','description' => __( 'Header Contact us', 'themename' ),'before_widget' => '','after_widget' => '','before_title' => '','after_title' => '' ));
register_sidebar( array('name' => __( 'Menu Footer 1', 'themename' ),'id' => 'footer_menu_1','description' => __( 'Menu Footer 1', 'themename' ),'before_widget' => '','after_widget' => '','before_title' => '<div class="h5">','after_title' => '</div>' ));
register_sidebar( array('name' => __( 'Menu Footer 2', 'themename' ),'id' => 'footer_menu_2','description' => __( 'Menu Footer 2', 'themename' ),'before_widget' => '','after_widget' => '','before_title' => '','after_title' => '' ));
register_sidebar( array('name' => __( 'Footer copyright', 'themename' ),'id' => 'footer_copyright','description' => __( 'Footer copyright', 'themename' ),'before_widget' => '© '.date('Y').' ','after_widget' => '','before_title' => '','after_title' => '' ));
}
add_action( 'widgets_init', 'inspiry_theme_sidebars' );			
function load_theme_styles() {
	 
    wp_register_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), 'null', 'all');
    wp_register_style( 'fontawesome', get_template_directory_uri() . '/css/fontawesome.min.css', array(), 'null', 'all');	
    wp_register_style( 'font-custom', get_template_directory_uri() . '/fonts/stylesheet.css', array(), 'null', 'all');
	wp_register_style( 'style', get_template_directory_uri() . '/style.css', array(), time(), 'all');
    wp_enqueue_style( 'bootstrap' );
	wp_enqueue_style( 'fontawesome' );	
    wp_enqueue_style( 'font-custom' );	
    wp_enqueue_style( 'style' );	
	wp_enqueue_script( 'jquery' );	
	$js_directory_uri = get_template_directory_uri() . '/js/';		
	
	wp_register_script('fancybox',$js_directory_uri . 'jquery.fancybox.min.js',array(),'null');	 
	wp_enqueue_script( 'fancybox' );
			
	wp_register_script('slick',$js_directory_uri . 'slick.js',array(),'null');	 
	wp_enqueue_script( 'slick' );
	wp_register_script('script',$js_directory_uri . 'script.js',array( ),time(),true);
    wp_enqueue_script( 'script' ); 	
    wp_enqueue_script('ScrollMagic', get_template_directory_uri() . '/js/ScrollMagic.min.js', array('jquery'), NULL, true);
    // wp_enqueue_script('debugerscrollMagic', '//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/plugins/debug.addIndicators.min.js', array(), NULL, true);	
    if (is_singular( 'post' )) {
        wp_enqueue_script('js-scroll', get_template_directory_uri() . '/js/js-scroll.js', array('jquery'), NULL, true);
        
        }
}		
add_action( 'wp_enqueue_scripts', 'load_theme_styles' ,100);
add_action( 'vc_before_init', 'vc_before_init_actions' ); 
function vc_before_init_actions() {     
    vc_set_shortcodes_templates_dir( get_template_directory() . '/vc_templates' );        
}	

function rampiq_figure_func($attr) {
	 $ret='';
	if (isset($attr['id'])) {
    $rampiq_figure_section=get_field('rampiq_figure_section',$attr['id']);
   
    if (is_array($rampiq_figure_section)) {
        $max=count($rampiq_figure_section)-1;
        $key=rand(0, $max);
        if (isset($rampiq_figure_section[$key])) {
            $vals= $rampiq_figure_section[$key];
            $link='';
            if ($vals['link']!='') {
                $link=' <a href="'.$vals['link'].'"><i class="fal fa-angle-right" style="'.$vals['rampiq_figure_gradient'].'"></i></a>';
            }
            $ret='
            <div class="row align-items-center rampiq_figure_row">
                <div class="col-md col-12 text"><div class="ins"><div class="ins_text">'.$vals['text'].'</div></div></div>
                <div class="col-md-auto col-12 vals h2"><span style="'.$vals['rampiq_figure_gradient'].'">'.$vals['vals'].'</span>'.$link.'</div>
            </div>
            ';
        }


    }
	}
    return $ret;
}
add_shortcode('show_rampiq_figure','rampiq_figure_func');



function create_post_type() {

    $post_type_labels = array(
        'name' => __("Client's feedback", 'themename' ),
        'singular_name' => __( "Client's feedback", 'themename' ),
    );

    $post_type_args = array(
        'labels' => apply_filters( 'inspiry_property_post_type_labels', $post_type_labels ),
        'public' => true,
        'publicly_queryable' => false,
        'show_ui' => true,
        'query_var' => true,
        'has_archive' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_icon' => 'dashicons-nametag',
        'menu_position' => 5,
        'supports' => array( 'title',   'page-attributes','editor','thumbnail'  ),
        'rewrite' => array( 'slug' => 'investor' )
    );

    register_post_type( 'feedback', $post_type_args );

    $post_type_labels = array(
        'name' => __("Logos", 'themename' ),
        'singular_name' => __( "Logos", 'themename' ),
    );

    $post_type_args = array(
        'labels' => apply_filters( 'inspiry_property_post_type_labels', $post_type_labels ),
        'public' => true,
        'publicly_queryable' => false,
        'show_ui' => true,
        'query_var' => true,
        'has_archive' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_icon' => 'dashicons-format-image',
        'menu_position' => 5,
        'supports' => array( 'title',   'page-attributes','thumbnail'  ),
        'rewrite' => array( 'slug' => 'logos' )
    );

    register_post_type( 'logos', $post_type_args );



}
add_action( 'init', 'create_post_type' );


function func_contact_clients_feedback () {
    $ret='';
    global $wp_query;
    $temp_query = $wp_query;
    $args1 = array('post_type' => 'feedback','posts_per_page' => -1,'post_status'=>'publish',  'orderby'=>'menu_order','order'=>'asc');
    $posts = new WP_Query( $args1 );
    if ( $posts->have_posts() ) {
        $ret.='<div class="slider_clients_feedback">';
        while ($posts->have_posts()) {
            $posts->the_post();
            $content = apply_filters('the_content', get_the_content());
            $position=get_field('position');

            $logo=get_field('logo');

            $img='';
            $image_id = get_post_thumbnail_id(get_the_ID());
            $urls=wp_get_attachment_image_src($image_id,'full');
            if (isset($urls[0])) {  $img=$urls[0];}


            $ret.='<div class="item">';
            $ret.='<div class="ins '.(($logo!='') ? 'show_logo' : '').'">';

            $ret.='<div class="text">'.$content.'</div>';
            $ret.='<div class="row align-items-center ">';
            if ($img!='') {
                $ret.='<div class="col-auto img"><span><img src="'.$img.'"></span></div>';
            }
            $ret.='<div class="col">';
            $ret.='<div class="h5">'.get_the_title().'</div>';
            if ($position!='') $ret.='<div class="position">'.$position.'</div>';
            $ret.='</div>';
            if ($logo!='') $ret.='<div class="col-auto logo"><img src="'.$logo.'"></div>';
            $ret.='</div>';
            $ret.='</div>';
            $ret.='</div>';
        }
        $ret.='</div>';
    }
    wp_reset_postdata();
    $wp_query = NULL;
    $wp_query = $temp_query;

    return $ret;
}
add_shortcode('contact_clients_feedback','func_contact_clients_feedback');


function func_show_logos () {
    $ret='';
    global $wp_query;
    $temp_query = $wp_query;
    $args1 = array('post_type' => 'logos','posts_per_page' => -1,'post_status'=>'publish',  'orderby'=>'menu_order','order'=>'asc');
    $posts = new WP_Query( $args1 );
    if ( $posts->have_posts() ) {
        $ret.='<div class="contacts_logos">';
        while ($posts->have_posts()) {
            $posts->the_post();
            $link=get_field('link');
            $target_blank=(int)get_field('target_blank');
            $link_before=$link_after='';
            if ($link!='') {
                $link_before='<a href="'.$link.'" '.(($target_blank==1) ? 'target="_blank"' : '').'>';
                $link_after='</a>';
            }

            $img='';
            $image_id = get_post_thumbnail_id(get_the_ID());
            $urls=wp_get_attachment_image_src($image_id,'full');
            if (isset($urls[0])) {  $img=$urls[0];}


            $ret.='<div class="item"><div class="ins">';
            if ($img!='') {
                $ret.=$link_before.'<img src="'.$img.'">'.$link_after;
            }
            $ret.='</div></div>';
        }
        $ret.='</div>';
    }
    wp_reset_postdata();
    $wp_query = NULL;
    $wp_query = $temp_query;

    return $ret;
}
add_shortcode('show_logos','func_show_logos');



function func_show_map_contact($attr) {
    $lt=$lg=$address=$ret=$lang='';
    $snazzymaps='no';
    if (isset($attr['lt'])) $lt=$attr['lt'];
    if (isset($attr['lg'])) $lg=$attr['lg'];
    if (isset($attr['address'])) $address=$attr['address'];
    if (isset($attr['language'])) $lang='&language='.$attr['language'].'';
    if (isset($attr['snazzymaps'])) $snazzymaps=$attr['snazzymaps'];
    if ($lt!='' AND $lg!='') {
        $json='';
        if ($snazzymaps=='yes') {
            $SnazzyMapStyles = get_option( 'SnazzyMapStyles' );
            if (isset($SnazzyMapStyles[0]['json']))$json=$SnazzyMapStyles[0]['json'];
        } else $json='""';
	$pinImage=get_template_directory_uri().'/images/map_ico.png';
        $ret='
<div class="out_acf-map marg_bottom" >
    <div class="acf-map" >
        <div class="marker" data-lat="'.$lt.'" data-lng="'.$lg.'"></div>
    </div>
    <div class="overlay" onclick="style.pointerEvents='."'none'".'"></div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqQMQZvc0kLUzOZg8-1f3TVGb3Hs1_S4c'.$lang.'"></script>
<script>
    var zooms=5;
	var snazzystyles='.$json.';
	var pinImage="'.$pinImage.'";
    (function($) {
        var map = null;
        $(document).ready(function(){
            $(".acf-map").each(function(){
                map = new_map( $(this) ,snazzystyles);
            });
        });
    })(jQuery);
</script>';

    }
    return $ret;
}
add_shortcode('show_map_contact','func_show_map_contact');


function sanitize_pagination($content) {
    // Remove role attribute
    $content = str_replace('role="navigation"', '', $content);
    // Remove h2 tag
    $content = preg_replace('#<h2.*?>(.*?)<\/h2>#si', '', $content);
    return $content;
}
add_action('navigation_markup_template', 'sanitize_pagination');


function my_search_form($html) {
    $text='';
    if (isset($_GET['s'])) $text=$_GET['s'];
    $html = '<form id="search"  class="search pull-right" role="search" method="get"  action="'.esc_url( home_url( '/' ) ).'">
	            <input type="text" value="'.$text.'" name="s" id="s" placeholder="'.__('Search','themename').'" />
	            <button type="submit" class="button-search"><span><i class="fa fa-search" ></i></span></button>	
				<input type="hidden" name="post_type" value="post" />
	            <div class="clearfix"></div>
            </form>';
    return $html;
}


function add_footer_styles() {
    wp_enqueue_style( 'footer', get_template_directory_uri() . '/footer.css' );
};
add_action( 'get_footer', 'add_footer_styles' );


add_filter( 'gform_previous_button', 'my_previous_button_markup', 10, 2 );
function my_previous_button_markup( $previous_button, $form ) {
    $ret_previous_button ='<div class="block_previous_button">'.$previous_button.'<div class="ins_previous_button"><svg width="38" height="16" viewBox="0 0 38 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M0.292893 7.29289C-0.0976311 7.68342 -0.0976311 8.31658 0.292893 8.70711L6.65685 15.0711C7.04738 15.4616 7.68054 15.4616 8.07107 15.0711C8.46159 14.6805 8.46159 14.0474 8.07107 13.6569L2.41421 8L8.07107 2.34315C8.46159 1.95262 8.46159 1.31946 8.07107 0.928932C7.68054 0.538408 7.04738 0.538408 6.65685 0.928932L0.292893 7.29289ZM38 7H1V9H38V7Z" fill="#B51D09"/>
</svg>
</div></div>';
    return $ret_previous_button;
}


// TODO: file connection
require_once 'short_code_our-clients.php';




function func_show_page($attr) {
	$ret='';
    if (isset($attr['id'])) {
        $page=get_post($attr['id']);
        if (isset($page->post_content)) {
            $content = apply_filters( 'the_content', $page->post_content);
            $ret.= do_shortcode($content);
            $shortcodes_custom_css = get_post_meta($attr['id'], '_wpb_post_custom_css', true);
            if (!empty($shortcodes_custom_css))
            {
                $shortcodes_custom_css = strip_tags($shortcodes_custom_css);
                $ret.= '<style type="text/css" data-type="vc_shortcodes-custom-css">';
                $ret.= $shortcodes_custom_css;
                $ret.= '</style>';
            }
            $shortcodes_custom_css1 = get_post_meta($attr['id'], '_wpb_shortcodes_custom_css', true);
            if (!empty($shortcodes_custom_css1))
            {
                $shortcodes_custom_css1 = strip_tags($shortcodes_custom_css1);
                $ret.= '<style type="text/css" data-type="vc_shortcodes-custom-css">';
                $ret.= $shortcodes_custom_css1;
                $ret.= '</style>';
            }
        }
    }
    return  $ret;
}
add_shortcode('show_page','func_show_page');

add_action( 'init', 'create_tag_taxonomies', 0 );
function create_tag_taxonomies() 
{ 
  $labels = array(
    'name' => _x( 'Tags', 'taxonomy general name' ),
    'singular_name' => _x( 'Tag', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Tags' ),
    'popular_items' => __( 'Popular Tags' ),
    'all_items' => __( 'All Tags' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Tag' ), 
    'update_item' => __( 'Update Tag' ),
    'add_new_item' => __( 'Add New Tag' ),
    'new_item_name' => __( 'New Tag Name' ),
    'separate_items_with_commas' => __( 'Separate tags with commas' ),
    'add_or_remove_items' => __( 'Add or remove tags' ),
    'choose_from_most_used' => __( 'Choose from the most used tags' ),
    'menu_name' => __( 'Tags' ),
  ); 

  register_taxonomy('cases','our_clients',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'cases' ),
  ));
}

function func_last_saas_news($attr) {
	$count=10;
	global $wp_query;
    $temp_query = $wp_query; 
	$cats=$category__in=array();
	if (isset($attr['count'])) $count=$attr['count'];
	if (isset($attr['cats'])) {
		$cats=explode(',',$attr['cats']);		
	}
    $stack = array();
    if( have_rows('post_id') ):

   // Loop through rows.
   while( have_rows('post_id') ) : the_row();

       // Load sub field value.
       $sub_value = get_sub_field('id');
   array_push($stack,$sub_value);
 
   // End loop.
   endwhile;
endif;
	$args = array('post_type' => 'post', 'posts_per_page' => $count, 'post__in' => $stack, 'post_status' => 'publish',$category__in=>$cats);									   
    $posts = new WP_Query($args); 
	if ( $posts->have_posts() ) {
		print '<div class="last_news_slider">';
		while ( $posts->have_posts() ) {
			$posts->the_post();
			$img='';
			$urls=wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
            if (isset($urls[0])) {  $img='<img src="'.$urls[0].'">';}
			?>
				<div class="item">
				<div class="item_inner">
					<a href="<?php the_permalink();?>" class="img"><?php print $img;?></a>
                    <div class="item_inner_content">
					<div class="row align-items-center row_dann">
						<div class="col time"><i class="fal fa-clock"></i> <?php print get_post_time('m.d.Y', true);?></div>
					</div>
					<a href="<?php the_permalink();?>" class="title"><?php the_title();?></a>
					<div class="row align-items-center author">
						<?php
							$authorname = get_the_author_meta('nickname');
							$avatar=get_avatar( get_the_author_meta( 'ID' ));
							if ($avatar!='') print '<div class="col-auto avatar">'.$avatar.'</div>';
							if ($authorname!='') print '<div class="col-auto authorname">'.$authorname.'</div>';
						?>
					</div>
                    </div>
                  </div>
				</div>
			<?php
		} 
		print '</div>';
		?>
<script>
jQuery(document).ready(function($) {
	  jQuery('.last_news_slider').slick({slidesToShow: 3,slidesToScroll: 1,arrows: true,  dots: false, focusOnSelect: true,
 prevArrow: '<button type="button" data-role="none" class="slick-prev slick-arrow" aria-label="Previous" role="button" ><i class="fas fa-angle-left"></i></button>',
 nextArrow: '<button type="button" data-role="none" class="slick-next slick-arrow" aria-label="Next" role="button" ><i class="fas fa-angle-right"></i></button>',
 responsive: [{breakpoint: 991,settings: {slidesToShow: 2,}},{breakpoint: 640,settings: {slidesToShow: 1,arrows: true,}}]});

  })
	</script>
		<?php
		$blog_post_id =get_option('page_for_posts');
		print '<div class="goto_all"><a href="'.get_the_permalink($blog_post_id).'">'.__('View all','themename').'</a></div>';
		
	}
	wp_reset_postdata();
    $wp_query = NULL;
    $wp_query = $temp_query;
}
add_shortcode('last_saas_news', 'func_last_saas_news');

function add_post_type() {
    $post_type_labels = array(
        'name'              => __( 'About slider', 'themename' ),
        'singular_name'     => __( 'About slider', 'themename' ),
        'add_new'           => __( 'New', 'themename' ),
        'add_new_item'      => __( 'New', 'themename' ),
        'edit_item'         => __( 'About slider', 'themename' ),
        'new_item'          => __( 'New', 'themename' ),
        'view_item'         => __( 'View', 'themename' ),
        'search_items'      => __( 'Search', 'themename' ),
        'not_found'         => __( 'Not Found', 'themename' ),
        'parent_item_colon' => '',
    );
    $description      = get_option( 'theme_custom_description' );

    $post_type_args = array(
        'labels'             => apply_filters( 'inspiry_property_post_type_labels', $post_type_labels ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'query_var'          => true,
        'has_archive'        => true,
        'capability_type'    => 'post',
        'hierarchical'       => true,
        'menu_icon'          => 'dashicons-editor-quote',
        'menu_position'      => 5,
        'description'        => $description,
        'supports'           => array( 'title', 'thumbnail', 'editor', 'page-attributes' ),
        'rewrite'            => array( 'slug' => 'about_slider', 'with_front' => false )
    );
    register_post_type( 'about_slider', $post_type_args );
}
add_action( 'init', 'add_post_type' );


function shortcode_func_about_slider() {
    global $wp_query;
    $temp_query = $wp_query;
$args5 = [
    'post_type'     => 'about_slider',
    'post_status'   => 'publish',
    'posts_per_page' => -1
];

$query = new WP_Query($args5);

	if ($query->have_posts()) : ?>
    <div class="rampiq_team_slider">
        <?php while ($query->have_posts()) : $query->the_post();
            $id = get_the_ID();
            $img_url = get_the_post_thumbnail_url($id, 'full');
            ?>
            <div class="wpb_text_column">
                <div class="wpb_wrapper">
                    <p>
                        <a class="massonry_item" href="<?php echo $img_url ?>" data-fancybox="massonry" tabindex="0">
                            <img class="alignnone" src="<?php echo $img_url ?>" alt="">
                        </a>
                    </p>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

<?php endif;
    wp_reset_postdata();
    $wp_query = NULL;
    $wp_query = $temp_query;
}

add_shortcode( 'about_slider', 'shortcode_func_about_slider' );

 add_filter( 'gform_next_button', 'form_next_button', 10, 2 );
function form_next_button( $button, $form ) {	 
	if ($form['id'] == 2) {
		$but= str_replace('jQuery("#gform_2").trigger("submit",[true]);','data_add();jQuery("#gform_2").trigger("submit",[true]);',$button);
		//print $but;
		$button=$but;
	} 
    return $button;
}

function post_employees_feedback() {

    $post_type_labels = array(
        'name' => __("Employees feedback", 'themename' ),
        'singular_name' => __( "Employees feedback", 'themename' ),
    );

    $post_type_args = array(
        'labels' => apply_filters( 'inspiry_property_post_type_labels', $post_type_labels ),
        'public' => true,
        'publicly_queryable' => false,
        'show_ui' => true,
        'query_var' => true,
        'has_archive' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_icon' => 'dashicons-nametag',
        'menu_position' => 5,
        'supports' => array( 'title',   'page-attributes','editor','thumbnail'  ),
        'rewrite' => array( 'slug' => 'post_employees' )
    );

    register_post_type( 'employees_feedback', $post_type_args );

}
add_action( 'init', 'post_employees_feedback' );

function func_employees_feedback () {
    $ret='';
    global $wp_query;
    $temp_query = $wp_query;
    $args1 = array('post_type' => 'employees_feedback','posts_per_page' => -1,'post_status'=>'publish',  'orderby'=>'menu_order','order'=>'asc');
    $posts = new WP_Query( $args1 );
    if ( $posts->have_posts() ) {
        $ret.='<div class="slider_clients_feedback slider_employees_feedback">';
        while ($posts->have_posts()) {
            $posts->the_post();
            $content = apply_filters('the_content', get_the_content());
            $position=get_field('position');

            $logo=get_field('logo');

            $img='';
            $image_id = get_post_thumbnail_id(get_the_ID());
            $urls=wp_get_attachment_image_src($image_id,'full');
            if (isset($urls[0])) {  $img=$urls[0];}


            $ret.='<div class="item">';
            $ret.='<div class="ins '.(($logo!='') ? 'show_logo' : '').'">';

            $ret.='<div class="text">'.$content.'</div>';
            $ret.='<div class="row align-items-center ">';
            if ($img!='') {
                $ret.='<div class="col-auto img"><span><img src="'.$img.'"></span></div>';
            }
            $ret.='<div class="col">';
            $ret.='<div class="h5">'.get_the_title().'</div>';
            if ($position!='') $ret.='<div class="position">'.$position.'</div>';
            $ret.='</div>';
            if ($logo!='') $ret.='<div class="col-auto logo"><img src="'.$logo.'"></div>';
            $ret.='</div>';
            $ret.='</div>';
            $ret.='</div>';
        }
        $ret.='</div>';
    }
    wp_reset_postdata();
    $wp_query = NULL;
    $wp_query = $temp_query;

    return $ret;
}
add_shortcode('employees_feedback','func_employees_feedback');


$post_type_labels = array(
    'name' => __('Current job openings', 'themename'),
    'singular_name' => __('Current job openings', 'themename'),
    'add_new' => __('Add New', 'themename'),
    'add_new_item' => __('Add New', 'themename'),
    'edit_item' => __('Edit', 'themename'),
    'new_item' => __('New', 'themename'),
    'view_item' => __('View', 'themename'),
    'search_items' => __('Search', 'themename'),
    'not_found' => __('No found', 'themename'),
    'parent_item_colon' => '',
);
$description = get_option('theme_custom_description');
$post_type_args = array(
    'labels' => apply_filters('inspiry_property_post_type_labels', $post_type_labels),
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'has_archive' => true,
    'capability_type' => 'post',
    'hierarchical' => true,
    'menu_icon' => 'dashicons-welcome-widgets-menus',
    'menu_position' => 5,
    'description' => $description,
    'supports' => array('title', 'thumbnail', 'editor',  'page-attributes'),
    'rewrite' => array(
        'slug' => apply_filters('inspiry_property_slug',  ' job_openings'),
    ),
);

register_post_type('current_jobs', $post_type_args);

$feature_labels = array(
    'name'          => __('Jobs category', 'themename'),
    'singular_name' => __('Jobs category', 'themename'),
    'menu_name'     => __('Jobs category', 'themename'),
);
register_taxonomy(
    'openings-type',
    array('current_jobs'),
    array(
        'hierarchical'   => true,
        'labels'         => apply_filters('inspiry_property_feature_labels', $feature_labels),
        'show_ui'        => true,
        'query_var'      => true,
        'rewrite'        => array(
        'slug'       => apply_filters('inspiry_property_feature_slug',  'openings-types'),
        ),
    )
);



function short_code_сurrent_job_openings()
{
$terms = get_terms(
array(
'taxonomy'   => 'openings-type',
'hide_empty' => true,
'hierarchical' => false,
'orderby' => 'slug',
'order' => 'ASC',
)
);
?>
<div class="jobs_tabs_section rampiq_departmens_structure">
<ul class="tabs_caption_jobs tabs_caption_structure">
<?php

$first = 1;
foreach ( $terms as $term ) { ?>
    <li class="<?php if ($first==1) print 'active';?>"><?php echo $term->name; ?></li>
<?php  
$first++;
} ?>
</ul>
<?php
  global $wp_query;
  $temp_query = $wp_query;
$first_tabs = 1;
foreach ( $terms as $term ) {  ?>
    <div class='jobs_tabs<?php if ($first_tabs==1) print ' active';?>'>
    <?php 
    $first_tabs++;
    $args = array(
        'post_type' => 'current_jobs',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
        'tax_query' => array(
            array(
                'taxonomy' => 'openings-type',
                'field' => 'id',
                'terms' => $term->term_id
            )
        )
    );
  
  
    $posts = new WP_Query( $args );

    if($posts->have_posts()) {
   $id         = get_the_ID();
        while($posts->have_posts()) {
            $posts->the_post(); 
            ?>
            <div class="wrapper_card_job current_opening_row row">
                <div class="title_card_job wpb_text_column col-lg-5 col-md-6">

                    <span class="department"><?php echo get_field('department'); ?></span>
                    <h4 class="title"><?php the_title();?></h4>
                    <?php if(get_field('work') == true || get_field('time') == true) { ?>
                       <div class="wrapper_time_work">
                       <span class="work"><i class="fa fa-map-marker-alt"></i><?php echo get_field('work'); ?></span>
                       <span class="time"><i class="far fa-clock"></i><?php echo get_field('time'); ?></span>
                   </div> 
                    <?php } ?>
                    
                </div>
                
                <div class="content_job_openings col-lg-7 col-md-6">
                    <?php the_content();?>
                    <div class="wrapper_btn_apply">
                <a href="<?php echo get_field('link_job'); ?>">Apply now</a>
                </div>
                </div>
                
            </div>
            <?php
        }

    }
  

    ?>
</div>

<?php
}
wp_reset_postdata();
$wp_query = NULL;
$wp_query = $temp_query; 
?>
</div>
<?php  
}
add_shortcode('сurrent_job_openings', 'short_code_сurrent_job_openings');
function true_id($args){
	$args['post_page_id'] = 'ID';
	return $args;
}
function true_custom($column, $id){
	if($column === 'post_page_id'){
		echo $id;
	}
}
 
add_filter('manage_pages_columns', 'true_id', 5);
add_action('manage_pages_custom_column', 'true_custom', 5, 2);
add_filter('manage_posts_columns', 'true_id', 5);
add_action('manage_posts_custom_column', 'true_custom', 5, 2);