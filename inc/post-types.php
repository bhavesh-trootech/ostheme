<?php
//post types
function project_post_type() {
  
// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Projects', 'Projects', 'hello-theme-child' ),
        'singular_name'       => _x( 'Projects', 'Projects', 'hello-theme-child' ),
        'menu_name'           => __( 'Projects', 'hello-theme-child' ),
        'parent_item_colon'   => __( 'Parent Projects', 'hello-theme-child' ),
        'all_items'           => __( 'All Projects', 'hello-theme-child' ),
        'view_item'           => __( 'View Projects', 'hello-theme-child' ),
        'add_new_item'        => __( 'Add New Project', 'hello-theme-child' ),
        'add_new'             => __( 'Add New', 'hello-theme-child' ),
        'edit_item'           => __( 'Edit Project', 'hello-theme-child' ),
        'update_item'         => __( 'Update Project', 'hello-theme-child' ),
        'search_items'        => __( 'Search Project', 'hello-theme-child' ),
        'not_found'           => __( 'Not Found', 'hello-theme-child' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'hello-theme-child' ),
    );
      
// Set other options for Custom Post Type
      
    $carrersArgs = array(
        'label'               => __( 'Projects', 'hello-theme-child' ),
        'description'         => __( 'Projects news and reviews', 'hello-theme-child' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions' ), 
        'taxonomies'          => array( 'realised', 'unrealised-tags' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
    );
      
    // Registering your Custom Post Type
    register_post_type( 'projects', $carrersArgs );
    /*****/

    //register Realised texonomy
    $labelsRealised = array(
    'name' => _x( 'Realised', 'Realised' ),
    'singular_name' => _x( 'Realised', 'Realised' ),
    'search_items' =>  __( 'Search Realised' ),
    'all_items' => __( 'All Realised' ),
    'parent_item' => __( 'Parent Realised' ),
    'parent_item_colon' => __( 'Parent Realised:' ),
    'edit_item' => __( 'Edit Realised' ), 
    'update_item' => __( 'Update Realised' ),
    'add_new_item' => __( 'Add New Realised' ),
    'new_item_name' => __( 'New Realised Name' ),
    'menu_name' => __( 'Realised' ),
  );    
  
  // Now register the taxonomy
  register_taxonomy('realised',array('projects'), array(
    'hierarchical' => true,
    'labels' => $labelsRealised,
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'realised' ),
  ));

  //unrealised tags texonomy
   $labelstag = array(
    'name' => _x( 'Tags', 'Tags' ),
    'singular_name' => _x( 'Tag', 'Tags' ),
    'search_items' =>  __( 'Search Tags' ),
    'popular_items' => __( 'Popular Tags' ),
    'all_items' => __( 'All Tags' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Tag' ), 
    'update_item' => __( 'Update Tag' ),
    'add_new_item' => __( 'Add New Tag' ),
    'new_item_name' => __( 'New Tag Name' ),
    'separate_items_with_commas' => __( 'Separate tags with commas' ),
    'add_or_remove_items' => __( 'Add or remove tags' ),
    'choose_from_most_used' => __( 'Choose from the most used tags' ),
    'menu_name' => __( 'Tags' ),
  ); 

  register_taxonomy('unrealised-tags','projects',array(
    'hierarchical' => false,
    'labels' => $labelstag,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'unrealised-tag' ),
  ));
  /****/
}
add_action( 'init', 'project_post_type', 0 );
/****/

