<?php
$blog_post_id = get_option('page_for_posts');
$blog_post = get_post($blog_post_id);
?>
<div class="section_blog section_c_blog">
    <div class="container height_100">
        <div class="row height_100 align-items-center">
            <div class="col-12">
                <h1><?php print $blog_post->post_title; ?></h1>
            </div>
        </div>
    </div>
    <div class="container">
        <?php $stack = array();
        if (have_rows('blog_post_id', 14)) :
            // Loop through rows.
            while (have_rows('blog_post_id', 14)) : the_row();

                // Load sub field value.
                $sub_value = get_sub_field('id_bl');
                array_push($stack, $sub_value);

            // End loop.
            endwhile;
        endif; ?>
        <div class=" row blog_list">
            <?php global $wp_query;
            $args = array(
                'post_type' => 'post',
                'post__in' => $stack,
                'post_status' => 'publish',
                'posts_per_page' => 2,
                'order' => 'asc',
            );
            $temp_query = $wp_query;
            $query = new WP_Query($args);
            ?>
            <?php
            $i = 1;
            if (isset($query->posts)) {
                $author_id = $post->post_author;
                foreach ($query->posts as $key => $val) {
                    $id         = $val->ID;
                    $author_id = $val->post_author;

            ?>
                    <div class="items items_custom col-lg-6 col-md-6">
                    <a class="link_m" href="<?php the_permalink(); ?>"> </a>
                        <div class="item_custom_wrapper visible-block">
                            <?php
                            $img = '';
                            $image_id = get_post_thumbnail_id($id);
                            $urls = wp_get_attachment_image_src($image_id, 'full');
                            if (isset($urls[0])) {
                                $img = $urls[0];
                            }
                            if ($img != '') {
                                print '<div class="image image_custom"><div class="ins"><img src="' . $img . '"></div>' . '</div>';
                            }
                            ?>
                            <div class="dann dann_custom">
                                <h2><?php echo get_the_title($id); ?></h2>

                                <div class="row_dann">

                                    <div class="author ">
                                        <div class="row-aut halign-items-center">
                                            <?php
                                            $authorname = get_the_author_meta('nickname', $author_id);
                                            $avatar = get_avatar($author_id);
                                            if ($avatar != '') echo '<div class="col-auto avatar">' . $avatar . '</div>';
                                            if ($authorname != '') echo '<div class="col-auto authorname">' . $authorname . '</div>';
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Hidden block -->
                        <div class="item_custom_wrapper hidden-block">
                            <div class="dann dann_custom">
                                <h2><a href="<?php echo get_the_permalink($id); ?>"><?php echo get_the_title($id); ?></a></h2>

                                <div class="row_dann">

                                    <div class="author ">
                                        <div class="row-aut halign-items-center">
                                            <?php
                                            $authorname = get_the_author_meta('nickname', $author_id);
                                            $avatar = get_avatar($author_id);
                                            if ($avatar != '') echo '<div class="col-auto avatar">' . $avatar . '</div>';
                                            if ($authorname != '') echo '<div class="col-auto authorname">' . $authorname . '</div>';
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $img = '';
                            $image_id = get_post_thumbnail_id($id);
                            $urls = wp_get_attachment_image_src($image_id, 'full');
                            if (isset($urls[0])) {
                                $img = $urls[0];
                            }
                            if ($img != '') {
                                print '<div class="image image_custom"><a href="' . get_the_permalink($id) . '" class="post"><div class="ins"><img src="' . $img . '"></div></a>' . $category . '</div>';
                            }
                            $short_desc = get_field('short_desc', $id);
                            ?>
                            <div class="btn_post btn_red">
                                <a class="link_r" href="<?php the_permalink(); ?>"> Read more <i class="fal fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>

                <?php
                    $i++;
                } ?>
        </div>

    <?php    } ?>
    <?php wp_reset_postdata();
    $wp_query = NULL;
    $wp_query = $temp_query; ?>
    </div>
</div>
<div class="container recent_posts visible_hover">
    <h2><?php _e('Recent posts','themename');?></h2>
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
