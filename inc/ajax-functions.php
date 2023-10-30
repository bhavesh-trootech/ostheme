<?php
function load_custom_posts() {
    check_ajax_referer('custom-nonce', 'nonce');

    $page = intval($_POST['page']);
    $realiseCategory[] = sanitize_text_field($_POST['realiseCategory']);
    $unRealiseCategory[] = sanitize_text_field($_POST['unRealiseCategory']);

    $realisedTerms = get_terms( array(
    'taxonomy'   => 'realised',
    'hide_empty' => true,
     ) );

    foreach ($realisedTerms as $realisedTerm) {
        $realisedTermSlugs[] = $realisedTerm->slug;
    }

    $unRealisedTerms = get_terms( array(
    'taxonomy'   => 'unrealised-tags',
    'hide_empty' => true,
     ) );

    foreach ($unRealisedTerms as $unRealisedTerm) {
        $unRealisedTermSlugs[] = $unRealisedTerm->slug;
    }

    if( (empty($realiseCategory[0]) && empty($unRealiseCategory[0])) || ($realiseCategory[0] == "Alle") ){
        $args = array(
        'post_type' => 'projects',
        'posts_per_page' => 10, // Adjust the number of posts per page as needed
        'paged' => $page,
        'post_status' => 'publish',
        'tax_query' => array(
        'relation' => 'OR',
            array(
                'taxonomy' => 'realised',
                'field'    => 'slug',
                'terms'    => $realisedTermSlugs
            ),
            array(
                'taxonomy' => 'unrealised-tags',
                'field'    => 'slug',
                'terms'    => $unRealisedTermSlugs
            )
        )   
    );
    }elseif( !empty($realiseCategory[0]) && !empty($unRealiseCategory[0]) ){
        $args = array(
        'post_type' => 'projects',
        'posts_per_page' => 10, // Adjust the number of posts per page as needed
        'paged' => $page,
        'post_status' => 'publish',
        'tax_query' => array(
        'relation' => 'AND',
            array(
                'taxonomy' => 'realised',
                'field'    => 'slug',
                'terms'    => $realiseCategory
            ),
            array(
                'taxonomy' => 'unrealised-tags',
                'field'    => 'slug',
                'terms'    => $unRealiseCategory

            )
        )   
    );
    }elseif( !empty($realiseCategory[0]) || empty($unRealiseCategory[0]) ){
        $args = array(
        'post_type' => 'projects',
        'posts_per_page' => 10, // Adjust the number of posts per page as needed
        'paged' => $page,
        'post_status' => 'publish',
        'tax_query' => array(
            array(
                'taxonomy' => 'realised',
                'field'    => 'slug',
                'terms'    => $realiseCategory
            )
        )   
    );
    }elseif( empty($realiseCategory[0]) || !empty($unRealiseCategory[0]) ){
        $args = array(
        'post_type' => 'projects',
        'posts_per_page' => 10, // Adjust the number of posts per page as needed
        'paged' => $page,
        'post_status' => 'publish',
        'tax_query' => array(
            array(
                'taxonomy' => 'unrealised-tags',
                'field'    => 'slug',
                'terms'    => $unRealiseCategory
            )
        )   
    );
    }
    // if ($realiseCategory !== 'Alle') {
    //     $args['tax_query'] = array(
    //         array(
    //             'taxonomy' => 'realised',
    //             'field' => 'slug',
    //             'terms' => $realiseCategory,
    //         ),
    //     );
    // }

    $query = new WP_Query($args);
$count = 0;


if ($query->have_posts()) :

    while ($query->have_posts()) :
        $query->the_post();
        $projectId = get_the_ID();
        $count++;

        // Determine odd or even class
        $class_werkliste_content = ($count % 2 == 0) ? 'even' : 'odd';

        // Output the div structure
        if ($count % 2 == 1) :
            echo '<div class="werkliste_content">';
        endif;
        ?>

        <div class="col-<?php if($count % 2 + 1 == 2){ echo "1"; }else{echo "2"; } ?>">
            <div class="img_wrapper">
                <a href="<?php echo get_the_permalink( $projectId ); ?>"><?php the_post_thumbnail('full'); ?></a>
            </div>
            <div class="werkliste_title">
                <a href="<?php echo get_the_permalink( $projectId ); ?>"><?php the_title(); ?></a>
            </div>
        </div>

        <?php
        // Close the div structure after two posts
        if ($count % 2 == 0 || $count == $query->post_count) :
            echo '</div>';
        endif;
    endwhile;
    wp_reset_postdata(); // Reset post data

endif;

    die();
}

add_action('wp_ajax_load_custom_posts', 'load_custom_posts');
add_action('wp_ajax_nopriv_load_custom_posts', 'load_custom_posts');