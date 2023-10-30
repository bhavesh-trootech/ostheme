<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor List Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_List_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve list widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Select Post Custom Widget';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve list widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Select Post Custom Widget', 'elementor-list-widget' );
	}

	protected function get_custom_posts_new()
    {
    	$argsProject = array(
		  'numberposts' => -1,
		  'post_type'   => 'projects'
		);

		$latest_projects = get_posts( $argsProject );

        $postid_array = array();
        foreach ($latest_projects as $post) {
            $postid_array[$post->ID] = get_the_title($post->ID);
        }
        return $postid_array;
    }

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Select Post Custom Widget', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
        'post_type_Id',
        [
            'label' => __('Select Project', 'elementor-custom-widget'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => $this->get_custom_posts_new(),
        ]
    );

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Custom List', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::HIDDEN,
				'fields' => [
					[
						'name' => 'list_title',
						'label' => esc_html__( 'Logo Title', 'textdomain' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( 'Logo Title' , 'textdomain' ),
						'label_block' => true,
					],
					[
						'name' => 'video_tab_image',
						'label' => esc_html__( 'Logo Image', 'textdomain' ),
						'type' => \Elementor\Controls_Manager::MEDIA,
						'default' => [	
										'url' => \Elementor\Utils::get_placeholder_image_src(),
									]
					],
					[
						'name' => 'add_video_link',
						'label' => esc_html__( 'Add Video Link', 'textdomain' ),
						'type' => \Elementor\Controls_Manager::URL,
			            'placeholder' => __('https://your-link.com', 'textdomain'),
					]
				],
				'default' => [
					[
						'list_title' => esc_html__( 'Logo Title #1', 'textdomain' ),
						//'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'textdomain' ),
					],
					[
						'list_title' => esc_html__( 'Logo Title #2', 'textdomain' ),
						//'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'textdomain' ),
					],
				],
				'title_field' => '{{{ list_title }}}',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( $settings['post_type_Id'] ) {
			echo '<div class="videoSliderParent">';
            //echo $settings['post_type_Id'];
            echo '<div class="projectImg">';
            echo '<a href="'.get_the_permalink($settings['post_type_Id']).'"><img src="'.get_the_post_thumbnail_url($settings['post_type_Id']).'">';
            echo '</div>';
            echo '<div class="projectTitle">';
            echo '<a href="'.get_the_permalink($settings['post_type_Id']).'">';
            echo get_the_title($settings['post_type_Id']);
            echo '</a>';
            echo '</div>';
			echo '</div>';
		}
	}

	protected function content_template() {
		?>
		<# if ( settings.list.length ) { #>
			<dl>
			<# _.each( settings.list, function( item ) { #>
				<dt class="elementor-repeater-item-{{ item._id }}">{{{ item.list_title }}}</dt>
				
			<# }); #>
			</dl>
		<# } #>
		<?php
	}
	
}