<?php get_header(); ?>
<?php
global $wp_query;
$blog_post_id =get_option('page_for_posts');
$blog_post=get_post($blog_post_id);
?>
<div id="action_card">
<h5><?php _e('Ready to grow?','themename');?></h5>
<a href="#wizard_sc" class="h5 btt_action"><?php _e('Take action','themename');?></a>
<img class="star" src="/wp-content/uploads/2022/09/Star.svg" alt="star">
<span class="rocket">🚀</span>
</div>
    <div class="section_blog">
        <div class="container height_100">
            <div class="row">
			<div class="col-auto data">
			<h3><?php print get_post_time('d', true);?></h3>
                <h5><?php print get_post_time('M', true);?></h5>
			</div>
                <div class="col">
                    <h1><?php the_title(); ?></h1>
				<div class="row align-items-center">
								<?php
									$author_id = get_the_author_meta( 'ID' );
									$authorname = get_the_author_meta('nickname',$author_id);
									$avatar=get_avatar( $author_id);
									if ($avatar!='') print '<div class="col-auto avatar">'.$avatar.'</div>';
									if ($authorname!='') print '<div class="col-auto authorname"  style="color:#ffffff">'.$authorname.'</div>';
								?>
<?php
$category='';
$cat_id=0;
        $terms = get_the_terms(get_the_ID(), 'category' );
        if (isset($terms[0]->name)) {
            if ($terms[0]->slug != 'uncategorized') {
                $category='<div class="col-auto business_btn"><a href="'.get_term_link($terms[0]->term_id).'" class="cat" style="color:#ffffff">'.$terms[0]->name.'</a></div>';
				$cat_id=$terms[0]->term_id;
            }
        }
		print $category;
		?>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
	<div class="row">
	<div class="col-12">
	<ul class="breadcrumbs">
                        <li><a href="<?php echo get_site_url(); ?>">Home</a></li>
                        <li><a href="<?php echo get_the_permalink($blog_post_id); ?>"><?php  print $blog_post->post_title; ?></a></li>
                    </ul>
					</div>
	</div>
        <?php
        $img='';
		$imageurl='';
        $image_id = get_post_thumbnail_id(get_the_ID());
        $urls=wp_get_attachment_image_src($image_id,'full');
        if (isset($urls[0])) {  $img=$urls[0];}
        if ($img!='') {
            print '<div class="single_main_image"><img src="'.$img.'"></div>';
			$imageurl=$img;
        }
        ?>
        <div class="single_content">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php the_content();?>
<?php endwhile; endif; ?>
        </div>
		<div class="row share_post">
		<a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()) ?>" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a>
		<a href="http://twitter.com/intent/tweet?text=<?php the_title(); ?> <?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener noreferrer"><i class="fab fa-twitter"></i></a>
		<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink();?>&amp;title=<?php the_title();?>&amp;summary=&amp;source=<?php bloginfo('name');?>" target="_new" rel="noopener noreferrer"><i class="fab fa-linkedin-in"></i></a>
		<a target="blank" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $imageurl ?>" title="Pin This Post"><i class="fab fa-pinterest-p"></i></a>
		</div>
		<div class="row about_the_autor_posts">
		<?php
		if ($avatar!='') print '<div class="col-12 main_avatar">'.$avatar.'</div>';
		print '<div class="col-12 about">'.__('About the author','themename').'</div>';
		print '<div class="col-12 about_authorname"><h5>'.$authorname.'</h5></div>';
		print '<div class="col-12 about_description">'.wpautop( get_the_author_meta( 'description' ,$author_id)).'</div><div class="autor_line"></div>';
		?>
		</div>
		<div class="row prev_next_post">
		<div class="prev_post">
		<?php
		$prev_post = get_previous_post();
		if (isset($prev_post->post_title)) {
			echo '<a href="' . get_permalink( $prev_post ) . '"><i class="fal fa-long-arrow-left"></i><div><h5>Previous post</h5>
			      '. esc_html($prev_post->post_title) .'</div></a>';
		}
		?>
		</div>
		<div class="next_post">
		<?php
		$next_post = get_next_post();
		if (isset($next_post->post_title)) {
			echo '<a href="' . get_permalink( $next_post ) . '"><div> <h5>NEXT POST</h5>
'. esc_html($next_post->post_title) .'</div><i class="fal fa-long-arrow-right"></i></a>';
		}
		?>
		</div>
		</div>
		<div class="recent_posts">
		<div class="col-12 title_section"><h2 style="text-align:center"><?php _e('Related Posts','themename');?></h2></div>
		<?php
$post_id = get_the_ID();
$stack = array();
if (have_rows('blog_post_id', $post_id)) :
	// Loop through rows.
	while (have_rows('blog_post_id', $post_id)) : the_row();
		// Load sub field value.
		$sub_value = get_sub_field('id_bl');
		array_push($stack, $sub_value);
	// End loop.
	endwhile;
endif; 
		if ($cat_id>0) {
			$temp_query = $wp_query;
			$args1 = array('post_type' => 'post','posts_per_page' => 6,'post__in' => $stack,'post_status'=>'publish','meta_query'=> array(array('taxonomy' => 'category','field' => 'id','terms'  => $cat_id))); 
				$posts = new WP_Query( $args1 );
				if ( $posts->have_posts() ) ?>
				<div class="blog_list last_news_slider">
				<?php {
					while ( $posts->have_posts() ) {
						$posts->the_post(); 
						 ?>
                   <div class="col items items-hover">
                    <a class="link_m" href="<?php the_permalink(); ?>"> </a>
                    <?php
                    $category = '';
                    $terms = get_the_terms(get_the_ID(), 'category');
                    if (isset($terms[0]->name)) {
                        if ($terms[0]->slug != 'uncategorized') {
                            $category = '<a href="' . get_term_link($terms[0]->term_id) . '" class="cat">' . $terms[0]->name . '</a>';
                        }
                    }
                    $img = '';
                    $image_id = get_post_thumbnail_id(get_the_ID());
                    $urls = wp_get_attachment_image_src($image_id, 'full');
                    if (isset($urls[0])) {
                        $img = $urls[0];
                    }
                    if ($img != '') {
                        print '<div class="image"><a href="' . get_the_permalink() . '" class="post"><div class="ins"><img src="' . $img . '"></div></a>' . $category . '</div>';
                    }

                    $short_desc = get_field('short_desc');
                    ?>
                    <div class="dann">
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <?php if ($short_desc != '') print '<div class="text">' . $short_desc . '</div>'; ?>
                        <div class="tags_block"> <?php  the_tags('#') ?>
                                                     </div>
                        <div class="row align-items-center row_dann">
                            <div class="col time"><i class="far fa-calendar-alt"></i> <?php print get_post_time('m.d.Y', true); ?></div>
                            <div class="col-auto author ">
                                <div class="row align-items-center">
                                    <?php
                                    $authorname = get_the_author_meta('nickname');
                                    $avatar = get_avatar(get_the_author_meta('ID'));
                                    if ($avatar != '') print '<div class="col-auto avatar">' . $avatar . '</div>';
                                    if ($authorname != '') print '<div class="col-auto authorname">' . $authorname . '</div>';
                                    ?>

                                </div>
                            </div>
                        </div>
                        <div class="btn_post btn_red btn_red-r ">
                            <a class="link_r" href="<?php the_permalink(); ?>"> Read more <i class="fal fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
                <?php
					} ?>
					</div>
			<?php }
			wp_reset_postdata();
			$wp_query = NULL;
			$wp_query = $temp_query; 
			
		}
		?>
		
		</div>
    </div>
	<section id="wizard_sc" class="vc_section section_wizard_form sectim_wizard_custom"><div class="container "><div class="vc_row wpb_row vc_row-fluid"><div class="wpb_column vc_column_container vc_col-sm-6"><div class="vc_column-inner"><div class="wpb_wrapper"></div></div></div><div class="form_col wpb_column vc_column_container vc_col-sm-6"><div class="vc_column-inner"><div class="wpb_wrapper">
                <?php echo do_shortcode('[gravityform id="2" title="false" description="false" ajax="true" tabindex="49"]
'); ?> 
</div></div></div></div><div class="vc_row wpb_row vc_row-fluid row_bg"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner"><div class="wpb_wrapper">
	<div class="wpb_single_image wpb_content_element vc_align_left">
		<figure class="wpb_wrapper vc_figure">
			<div class="vc_single_image-wrapper   vc_box_border_grey"><img width="722" height="891" src="https://rampiqstg.wpengine.com/wp-content/uploads/2021/05/Group-4105.png" class="vc_single_image-img attachment-full" alt="" loading="lazy"></div>
		</figure>
	</div>
</div></div></div></div></div>	</section>

<?php if(get_field('show_pop-up',$blog_post_id) == true){ ?>
	<div id="pop-up-download" class="pop-up-download">
	<div class="container">
		<div class="wrapper_down_form">
		<?php if(get_field('image_wh',$blog_post_id)) { ?>
				<img src="<?php echo get_field('image_wh',$blog_post_id) ?>" alt="Whitepapper image">
			<?php } ?>
			<div class="block_down_text">
				<h4><?php echo get_field('title_wh',$blog_post_id) ?></h4>
				<?php echo get_field('subtitle_wh',$blog_post_id) ?>
                <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
                <script>
                    hbspt.forms.create({
                        region: "na1",
                        portalId: "22541311",
                        formId: "b2aa09c9-91a2-4cc2-8dbb-da58888e1220",
                        version: "V2_PRERELEASE"
                    });
                </script>
			</div>
		</div>
</div>
</div>
<?php } ?>
<!-- Link trigger pop-up -->
<a class="link_form-d" href="#pop-up-download" data-fancybox data-touch="false">POP-UP</a>
<?php get_footer(); ?>