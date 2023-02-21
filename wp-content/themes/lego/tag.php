<?php get_header(); ?>
<?php
$blog_post_id =get_option('page_for_posts');
$blog_post=get_post($blog_post_id);
// $cat = single_tat_title('',false);
?>
<div class="section_blog">
    <div class="container height_100">
        <div class="row height_100 align-items-center">
            <div class="col-12">
                <h1><?php single_tag_title(''); ?></h1>
                <ul class="breadcrumbs breadcrumbs_category">
                    <li><a href="<?php echo get_site_url(); ?>">Home</a></li>
                    <li><a href="<?php echo get_the_permalink($blog_post_id); ?>"><?php  print $blog_post->post_title; ?></a></li>
                    <li><div><?php single_tag_title(''); ?></div></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="container recent_posts">
    <div class="row blog_list">
        <?php
        if (have_posts()) :
            while (have_posts()) :
                the_post();  ?>
                <div class="items items-hover col-lg-4 col-md-6">
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
                        <div class="tags_block"> <?php  the_tags('#') ?></div>
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
            endwhile;
        endif;
        ?>
        <?php
        the_posts_pagination(array('prev_text'  => '<i class="fal fa-angle-left"></i>', 'next_text'  => '<i class="fal fa-angle-right"></i>', 'before_page_number' => '', 'screen_reader_text' => ''));
        ?>
    </div>
    <?php
    ?>
</div>
<?php get_footer(); ?>