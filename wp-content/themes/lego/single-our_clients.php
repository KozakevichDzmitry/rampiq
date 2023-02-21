<?php

get_header();
$our_clients_inner_service = get_field('our_clients_inner_service');
$our_clients_roi = get_field('our_clients_roi');
$our_clients_increased_revenue = get_field('our_clients_increased_revenue');
$our_clients_roi_title = get_field('our_clients_roi_title');
$our_clients_increased_revenue_title = get_field('our_clients_increased_revenue_title');
$our_clients_slider = get_field('our_clients_slider');
?>
    <div class="single_client_top_content">
        <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-6 col-sm-12 single_client_top_left">
                <div>
                <h1 class="h2"><?php the_title(); ?></h1>
                <h6><span>Service: </span> <?php echo $our_clients_inner_service; ?></h6>
					<?php 
					$tags = wp_get_post_terms( get_the_ID(), 'cases');
					if (is_array($tags)) {
						
						$pages = get_pages(array('meta_key' => '_wp_page_template','meta_value' => 'template-case.php'));
						$id_page=0;
						if (isset($pages[0]->ID)) {$id_page=$pages[0]->ID;} 
						
						print '<ul>';
						foreach ($tags as $key=>$val) {
							print '<li><a href="'.get_the_permalink($id_page).'?case='.$val->term_id.'">'.$val->name.'</a></li>';
						}
						print '</ul>';
					} 
					?>
                <a href="#client_overview">Explore more <i class="fal fa-long-arrow-down"></i></a>
                </div>
            </div>
            <div class="col-lg-7 col-md-6 col-sm-12 single_client_top_right">
                <div class="our_clients_roi">
                <div>
                    <img src="/wp-content/uploads/2021/05/Vector.png" alt="">
                    <h5><?php echo $our_clients_roi; ?></h5>
                </div>
                <p><?php echo $our_clients_roi_title; ?></p>
                </div>
                <div class="our_clients_increased_revenue">
                <div>
                    <img src="/wp-content/uploads/2021/05/Vector.png" alt="">
                    <h5><?php echo $our_clients_increased_revenue; ?></h5>
                </div>
                <p><?php echo $our_clients_increased_revenue_title; ?></p>
                </div>
                <div class="single_client_parent">
                    <img src="/wp-content/uploads/2021/06/laptop-frame.png" alt="<?php the_title(); ?>" class="our_clients_top_image">
                    <div class="single_client_slider">
                        <?php
                        foreach ($our_clients_slider as $key => $value) { ?>
<!--                             <img src=?php echo $value['our_clients_slider_image']?>> -->
						<a class="massonry_item" href="<?php echo $value['our_clients_slider_image']?>" data-fancybox="massonry" tabindex="0">
                            <img class="alignnone" src="<?php echo $value['our_clients_slider_image']?>" alt="">
                        </a>
                        <?php } ?>
                    </div>
                </div>

                     </div>
        </div>
        </div>
    </div>
    <div class="single_client_content">
        <?php if (have_posts()) : while (have_posts()) : the_post(); 
		the_content();
        endwhile; endif; ?>
    </div>
<?php  get_footer(); ?>