<?php
/**
 * The template for displaying all single posts
 *
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
    <div class="main-post-div">
    <div class="single-page-post-heading">
    <h1><?php the_title(); ?></h1>
    </div>
    <div class="content-here">
    <?php  the_content();  ?>
    </div>
    </div>
<?php endwhile; ?>
<?php get_footer(); ?>