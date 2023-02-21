<?php
$blog_post_id =get_option('page_for_posts');
$blog_post=get_post($blog_post_id);

?>
<div class="section_blog">
    <div class="container height_100">
        <div class="row height_100 align-items-center">
            <div class="col-12">
                <h1><?php  print $blog_post->post_title; ?></h1>                
            </div>
        </div>
    </div>
</div>
<div class="container  ">
    <div class="row">
	<div class="col-12">

				</div>
        <div class=" row blog_list">
            <?php
           
           $st = array();
            if( have_rows('blog_id',14) ):
               
           // Loop through rows.
           while( have_rows('blog_id') ) : the_row();
        
               // Load sub field value.
               $sub_value = get_sub_field('id_b');
           array_push($st,$sub_value);
         
           // End loop.
           endwhile;
          
        endif;
          query_posts(
            array( 'post_type'=>'post','post__in' => $st)
        );

            if ( have_posts() ) :
                while ( have_posts() ) :
                    the_post();  
                    print_r($st); 
                    ?>
                    <div class="items col-lg-4 col-md-6">
                        <?php
                        $category='';
                        $terms = get_the_terms(get_the_ID(), 'category' );
                        if (isset($terms[0]->name)) {
                            if ($terms[0]->slug != 'uncategorized') {
                                $category='<a href="'.get_term_link($terms[0]->term_id).'" class="cat">'.$terms[0]->name.'</a>';
                            }
                        }


                        $img='';
                        $image_id = get_post_thumbnail_id(get_the_ID());
                        $urls=wp_get_attachment_image_src($image_id,'full');
                        if (isset($urls[0])) {  $img=$urls[0];}
                        if ($img!='') {
                            print '<div class="image"><a href="'.get_the_permalink().'" class="post"><div class="ins"><img src="'.$img.'"></div></a>'.$category.'</div>';
                        }
                        $short_desc=get_field('short_desc');
                        ?>
                        <div class="dann">                            
                            <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                            <?php if ($short_desc!='') print '<div class="text">'.$short_desc.'</div>';?>
							<div class="row align-items-center row_dann">
								<div class="col time"><i class="fal fa-clock"></i> <?php print get_post_time('m.d.Y', true);?></div>
								<div class="col-auto author "><div class="row align-items-center">
								<?php
									$authorname = get_the_author_meta('nickname');
									$avatar=get_avatar( get_the_author_meta( 'ID' ));
									if ($avatar!='') print '<div class="col-auto avatar">'.$avatar.'</div>';
									if ($authorname!='') print '<div class="col-auto authorname">'.$authorname.'</div>';
								?>
									 
								</div></div>
							</div>
                        </div>
						
						

                    </div>
                <?php
                endwhile;
            endif;
            ?>
            <?php
            the_posts_pagination( array('prev_text'  => '<i class="fal fa-angle-left"></i>','next_text'  => '<i class="fal fa-angle-right"></i>','before_page_number' => '','screen_reader_text' =>''));
            ?>
        </div>
        <?php
        /*
        <div class="col-lg-3 col-md-4 col-12">
            <?php get_sidebar(); ?>
        </div>
        */
        ?>
    </div>
</div>