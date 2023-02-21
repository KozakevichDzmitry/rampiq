<?php
/*
Template Name: Footer no margin
*/
?>
<?php  get_header(); ?> 
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
 <?php the_content();?>
<?php endwhile; endif; ?>  
<style>
    footer {
        margin-top: 0;
    }
</style>
<?php get_footer(); ?>
