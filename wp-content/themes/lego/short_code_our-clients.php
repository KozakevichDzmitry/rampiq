<?php
function add_post_type_clients() {
    $post_type_labels = array(
        'name'              => __( 'Case Studies', 'themename' ),
        'singular_name'     => __( 'Case Studies', 'themename' ),
        'add_new'           => __( 'New', 'themename' ),
        'add_new_item'      => __( 'New', 'themename' ),
        'edit_item'         => __( 'Review', 'themename' ),
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
        'menu_icon'          => 'dashicons-analytics',
        'menu_position'      => 5,
        'description'        => $description,
        'supports'           => array( 'title', 'thumbnail', 'editor', 'page-attributes' ),
        'rewrite'            => array( 'slug' => 'our-clients', 'with_front' => false )
    );
    register_post_type( 'our_clients', $post_type_args );
}
add_action( 'init', 'add_post_type_clients' );


function short_code_output_post()
{

    global $wp_query;
    $temp_query = $wp_query; 
	$case_get=array();
	$tax_query=array();
	if (isset($_GET['case'])) {
		$case_get=explode(',',$_GET['case']); 
		foreach ($case_get as $key=>$val) {
			//$val=(int)$val;
			if ($val!='')  $tax_query[]=array('taxonomy' => 'cases','field' => 'slug','terms'  => $val);
		}	
		$tax_query[ 'relation' ] = 'OR';		
			
	}
	$args1 = array('taxonomy' => 'cases','hide_empty' => false,'orderby'=>'name','order'=>'asc');
    $terms = get_terms( $args1 );  
	print '<ul class="cases_cat">'; 
	print '<li data-id="0" '.((count($case_get) ==0 ) ? 'class="active"' : '').'>'.__('All','themename').'</li>';
	foreach ($terms as $key=>$val) {
		print '<li data-id="'.$val->slug.'" '.((in_array($val-> slug,$case_get) ) ? 'class="active"' : '').'>'.$val->name.'</li>';
	} 
	print '<li style="display:none;"><i class="fas fa-times"></i></li></ul>'; 
  ?>

  <script>
  var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
    return false;
};


  jQuery(document).ready(function($) {
	   $('.cases_cat li').click(function(){
		   var str='';
		   var id=$(this).data('id');
		   
		    
		   if (id!=0) { 
			var case_g = getUrlParameter('case');
			if (case_g != false) {
				var case_a = case_g.split(",");
				var new_case_a=[];
				var add_el=0;
				$.each( case_a, function( key, value ) {
					if (value != id) {
						new_case_a.push((value));
					} else {
						add_el=1;
					} 
				}); 
				if (add_el == 0) new_case_a.push(id);
				var str_a = new_case_a.join(",");
				if (str_a !='') str='?case='+str_a; 
			} else {
				str='?case='+id; 
			}
		   }
		var ret=document.location.protocol + "//" + document.location.hostname + document.location.pathname + str;  
 
		 window.location.href =ret;
		   
	   })
  })
  </script>
  <?php

    $args3 = array('post_type' => 'our_clients', 'posts_per_page' => -1, 'post_status' => 'publish', 'orderby' => 'menu_order', 'order' => 'asc','tax_query' => $tax_query);
    $posts = new WP_Query($args3);

	$pages_t = get_pages(array('meta_key' => '_wp_page_template','meta_value' => 'template-case.php'));
	$id_page=0;
	if (isset($pages_t[0]->ID)) {$id_page=$pages_t[0]->ID;} 

if ( $posts->have_posts() ) : ?>
    <div class="container">
    <div class="row">
        <?php while ( $posts->have_posts() ) : $posts->the_post();
            $id         = get_the_ID();
            $permalink  = get_the_permalink();
            $image      = get_the_post_thumbnail_url( $id, 'full' );
            $title      = get_the_title();
            $date       = get_the_date();
            $excerpt    = get_the_excerpt();
            $our_clients_logo = get_field('our_clients_logo');
            $our_clients_gradient = get_field('our_clients_gradient');
            $our_clients_roi = get_field('our_clients_roi');
            $our_clients_increased_revenue = get_field('our_clients_increased_revenue');
            $our_clients_inner_service = get_field('our_clients_inner_service');
            $our_clients_roi_title = get_field('our_clients_roi_title');
            $our_clients_increased_revenue_title = get_field('our_clients_increased_revenue_title');
            ?>

            <div class="col-lg-4 col-md-6 col-sm-12 clients_item_col">
                <div class="clients_item">
                    <a href="<?php echo $permalink; ?>">
                        <div class="clients_item_img" style="<?php echo $our_clients_gradient; ?>">
                        <img src="<?php echo $our_clients_logo; ?>" alt="<?php echo $title; ?>">
                        </div>
                        <div class="clients_item_wrapper">
                            <h4><?php echo $title; ?></h4>
                            <div class="client_wrapper_dynamic">
                                <div class="client_wrapper_dynamic_item">
                                      <div>
                                          <img src="/wp-content/uploads/2021/05/profits-1.png" alt="">
                                          <h5><?php echo $our_clients_roi; ?></h5>
                                      </div>
                                    <p><?php echo $our_clients_roi_title; ?></p>
                                </div>
                                <div class="client_wrapper_dynamic_item">
                                    <div>
                                        <img src="/wp-content/uploads/2021/05/profits-1.png" alt="">
                                        <h5><?php echo $our_clients_increased_revenue; ?></h5>
                                    </div>
                                    <p><?php echo $our_clients_increased_revenue_title; ?></p>
                                </div>
                            </div>
							<?php
								 $tags = wp_get_post_terms( get_the_ID(), 'cases');
								if (is_array($tags)) {
									print '<ul>';
										foreach ($tags as $key=>$val) {
											print '<li><a href="'.get_the_permalink($id_page).'?case='.$val->term_id.'">#'.$val->name.'</a></li>';
										}
									print '</ul>';
								} 
							?>
                           <div class="clients_btn">
                               <a href="<?php echo $permalink; ?>"> Read full <i class="fal fa-chevron-right"></i></a>
                           </div>
                        </div>
                    </a>
                </div>
            </div>


        <?php
        endwhile; ?>
    </div>
    </div>

<?php
endif;
wp_reset_postdata();
    $wp_query = NULL;
    $wp_query = $temp_query;

}
add_shortcode('our_clients_cases', 'short_code_output_post');



function func_show_last_cases() {
	global $wp_query;
    $temp_query = $wp_query; 
	$args3 = array('post_type' => 'our_clients', 'posts_per_page' => 6, 'post_status' => 'publish', 'orderby' => 'menu_order', 'order' => 'asc','post__not_in' => array(get_the_ID()));
    $posts = new WP_Query($args3);
	
	$pages_t = get_pages(array('meta_key' => '_wp_page_template','meta_value' => 'template-case.php'));
	$id_page=0;
	if (isset($pages_t[0]->ID)) {$id_page=$pages_t[0]->ID;} 
	
	if ( $posts->have_posts() ) {
		print '<div class="last_cases_slider">';
		while ( $posts->have_posts() ) : $posts->the_post();
            $id         = get_the_ID();
            $permalink  = get_the_permalink();
            $image      = get_the_post_thumbnail_url( $id, 'full' );
            $title      = get_the_title();
            $date       = get_the_date();
            $excerpt    = get_the_excerpt();
            $our_clients_logo = get_field('our_clients_logo');
            $our_clients_gradient = get_field('our_clients_gradient');
            $our_clients_roi = get_field('our_clients_roi');
            $our_clients_increased_revenue = get_field('our_clients_increased_revenue');
            $our_clients_inner_service = get_field('our_clients_inner_service');
            $our_clients_roi_title = get_field('our_clients_roi_title');
            $our_clients_increased_revenue_title = get_field('our_clients_increased_revenue_title');
            ?>

            <div class="item">
                <div class="clients_item">
                    <a href="<?php echo $permalink; ?>">
                        <div class="clients_item_img" style="<?php echo $our_clients_gradient ?>">
                        <img src="<?php echo $our_clients_logo; ?>" alt="<?php echo $title; ?>">
                        </div>
                        <div class="clients_item_wrapper">
                            <h4><?php echo $title; ?></h4>
                            <div class="client_wrapper_dynamic">
                                <div class="client_wrapper_dynamic_item">
                                      <div>
                                          <img src="/wp-content/uploads/2021/05/profits-1.png" alt="">
                                          <h5><?php echo $our_clients_roi; ?></h5>
                                      </div>
                                    <p><?php echo $our_clients_roi_title; ?></p>
                                </div>
                                <div class="client_wrapper_dynamic_item">
                                    <div>
                                        <img src="/wp-content/uploads/2021/05/profits-1.png" alt="">
                                        <h5><?php echo $our_clients_increased_revenue; ?></h5>
                                    </div>
                                    <p><?php echo $our_clients_increased_revenue_title; ?></p>
                                </div>
                            </div>
							<?php
								 $tags = wp_get_post_terms( get_the_ID(), 'cases');
								if (is_array($tags)) {
									print '<ul>';
										foreach ($tags as $key=>$val) {
											print '<li><a href="'.get_the_permalink($id_page).'?case='.$val->term_id.'">#'.$val->name.'</a></li>';
										}
									print '</ul>';
								} 
							?>
                           <div class="clients_btn">
                               <a href="<?php echo $permalink; ?>">   Read full <i class="fal fa-chevron-right"></i></a>
                           </div>
                        </div>
                    </a>
                </div>
            </div>


        <?php
        endwhile;
		print '</div>';
		print '<div class="goto_all"><a href="'.get_the_permalink($id_page).'">'.__('View all','themename').'</a></div>';
		?>
		 
<script>
  
  jQuery(document).ready(function($) {
	  jQuery('.last_cases_slider').slick({slidesToShow: 3,slidesToScroll: 1,arrows: true,  dots: false, focusOnSelect: true,
 prevArrow: '<button type="button" data-role="none" class="slick-prev slick-arrow" aria-label="Previous" role="button" ><i class="fas fa-angle-left"></i></button>',
 nextArrow: '<button type="button" data-role="none" class="slick-next slick-arrow" aria-label="Next" role="button" ><i class="fas fa-angle-right"></i></button>',
 responsive: [{breakpoint: 991,settings: {slidesToShow: 2,}},{breakpoint: 640,settings: {slidesToShow: 1,arrows: true,}}]});

  })
			 </script>
		<?php
	}

	wp_reset_postdata();
    $wp_query = NULL;
    $wp_query = $temp_query;
}
add_shortcode('show_last_cases', 'func_show_last_cases');
?>
