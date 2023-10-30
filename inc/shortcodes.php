<?php
//office page publikationen
function publikationen_repeaters() { 
  ob_start();
    ?> 
   <?php if( have_rows('publikationen_repeater') ): ?>
    <div class="buro-last-section">
     <?php while( have_rows('publikationen_repeater') ): the_row(); 
        $subtitle = get_sub_field('subtitle');
        $title = get_sub_field('title');
        $small_text = get_sub_field('small_text');
        $add_pdf = get_sub_field('add_pdf');
        ?>
      <div class="buro-pdf-section">
          <?php if(!empty($subtitle)): ?>
          <p><?php echo $subtitle; ?></p>
          <?php endif; ?>
           <?php if(!empty($title)): ?>
          <h2>«<?php echo $title; ?>»</h2>
          <?php endif; ?>
          <div class="pdf-button">
         <?php if(!empty($small_text)): ?>
            <p><?php echo $small_text; ?></p>
             <?php endif; ?>
              <?php if(!empty($add_pdf['url'])): ?>
            <a target="_blank" href="<?php echo $add_pdf['url']; ?>">
              PDF herunterladen 
              <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M13.0938 0.875H14.125V1.90625V12.2188V13.25H12.0625V12.2188V4.39844L2.48047 13.9805L1.75 14.7109L0.289062 13.25L1.01953 12.5195L10.6016 2.9375H2.78125H1.75V0.875H2.78125H13.0938Z" fill="#242427"/>
              </svg>
            </a>
          <?php endif; ?>
          </div>
      </div>
       <?php endwhile; ?>
    </div>
    <?php endif; ?>
    <?php
    return ob_get_clean();
}
add_shortcode('publikationen-repeaters', 'publikationen_repeaters');
/****/
//header title
function header_custom_title() { 
  ob_start();
  $display_header_title = get_field( "display_header_title", get_the_ID() );
    ?> 
  <?php if($display_header_title ==1){ ?>
    <div class="headerTitleCol">
     <span class="headerTitle"><?php echo get_the_title(get_the_ID()); ?></span>
    </div>
  <?php } ?>

    <?php
    return ob_get_clean();
}
add_shortcode('headercustomtitle', 'header_custom_title');
/****/
//Worklist shortcode
function worklist_listdata() { 
  ob_start();
    ?> 
  <div class="werkliste_wrapper">
    <div class="werkliste_list">
        <ul>
            <li class="realise-cat alleText active" data-realiseSlug="<?php echo "Alle" ?>">Alle</li>
            <?php
            $termsRealised = get_terms( array(
              'taxonomy' => 'realised',
              'hide_empty' => true,
           ) );

            foreach ($termsRealised as $termRealise) { ?>
              <li class="realise-cat" data-realiseSlug="<?php echo $termRealise->slug; ?>" data-term_id="<?php echo $termRealise->term_id; ?>"><?php echo $termRealise->name; ?></li>
           <?php } ?>

            <li class="line"></li>

             <?php
            $termsUnRealised = get_terms( array(
              'taxonomy' => 'unrealised-tags',
              'hide_empty' => true,
           ) );

            foreach ($termsUnRealised as $termUnRealise) { ?>
              <li class="unrealise-cat" data-unRealiseSlug="<?php echo $termUnRealise->slug; ?>" data-unrelise_term_id="<?php echo $termUnRealise->term_id; ?>"><?php echo $termUnRealise->name; ?></li>
           <?php } ?>

        </ul>
    </div>

<?php
$args = array(
    'post_type' => 'projects', // Change this to your custom post type if needed
    'posts_per_page' => -1, // Retrieve all posts
);

$query = new WP_Query($args);
$count = 0;


if ($query->have_posts()) :
    echo '<div class="werkliste_lists" id="custom-posts">';
   echo '</div>';
endif;
?>

  </div>
    <?php
    return ob_get_clean();
}
add_shortcode('worklist_listdata', 'worklist_listdata');