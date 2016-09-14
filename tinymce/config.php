<?php
/*-----------------------------------------------------------------------------------*/
/*	Default Options
/*-----------------------------------------------------------------------------------*/

// Number of posts array
function oxo_shortcodes_range ( $range, $all = true, $default = false, $range_start = 1 ) {
	if( $all ) {
		$number_of_posts['-1'] = 'All';
	}

	if( $default ) {
		$number_of_posts[''] = 'Default';
	}

	foreach( range( $range_start, $range ) as $number ) {
		$number_of_posts[$number] = $number;
	}

	return $number_of_posts;
}

// Taxonomies
function oxo_shortcodes_categories ( $taxonomy, $empty_choice = false, $empty_choice_label = 'Default' ) {
	$post_categories = array();
	if( $empty_choice == true ) {
		$post_categories[''] = $empty_choice_label;
	}

	$get_categories = get_categories('hide_empty=0&taxonomy=' . $taxonomy);

	if( ! is_wp_error( $get_categories ) ) {
		if( $get_categories && is_array($get_categories) ) {
			foreach ( $get_categories as $cat ) {
				if( array_key_exists('slug', $cat) && 
					array_key_exists('name', $cat) 
				) {
					$post_categories[$cat->slug] = $cat->name;
				}
			}
		}

		if( isset( $post_categories ) ) {
			return $post_categories;
		}
	}
}

function get_sidebars() {
	global $wp_registered_sidebars;

	$sidebars = array();

	foreach( $wp_registered_sidebars as $sidebar_id => $sidebar ) {
		$sidebars[$sidebar_id] = $sidebar['name'];
	}

	return $sidebars;
}


global $wpdb;
			$sql = "SELECT *   FROM `".$wpdb->prefix."rg_form` ";
			$gf_forms = $wpdb->get_results($sql);
			$gf_form_options = array();
			foreach($gf_forms as $gf_form){
				$gf_form_options[$gf_form->id] =  __($gf_form->title, 'oxo-core');
			}
			
$choices = array( 'yes' => __('Yes', 'oxo-core'), 'no' => __('No', 'oxo-core') );
$reverse_choices = array( 'no' => __('No', 'oxo-core'), 'yes' => __('Yes', 'oxo-core') );
$choices_with_default = array( '' => __('Default', 'oxo-core'), 'yes' => __('Yes', 'oxo-core'), 'no' => __('No', 'oxo-core') );
$reverse_choices_with_default = array( '' => __('Default', 'oxo-core'), 'no' => __('No', 'oxo-core'), 'yes' => __('Yes', 'oxo-core') );
$leftright = array( 'left' => __('Left', 'oxo-core'), 'right' => __('Right', 'oxo-core') );
$dec_numbers = array( '0.1' => '0.1', '0.2' => '0.2', '0.3' => '0.3', '0.4' => '0.4', '0.5' => '0.5', '0.6' => '0.6', '0.7' => '0.7', '0.8' => '0.8', '0.9' => '0.9', '1' => '1' );
$animation_type = array(
                    '0'             => __( 'None', 'oxo-core' ),
                    'bounce'         => __( 'Bounce', 'oxo-core' ),
                    'fade'             => __( 'Fade', 'oxo-core' ),
                    'flash'         => __( 'Flash', 'oxo-core' ),
                    'rubberBand'     => __( 'Rubberband', 'oxo-core' ),                    
                    'shake'            => __( 'Shake', 'oxo-core' ),
                    'slide'         => __( 'Slide', 'oxo-core' ),
                    'zoom'             => __( 'Zoom', 'oxo-core' ),
                );
$animation_direction = array(
                    'down'         => __( 'Down', 'oxo-core' ),
                    'left'         => __( 'Left', 'oxo-core' ),
                    'right'     => __( 'Right', 'oxo-core' ),
                    'up'         => __( 'Up', 'oxo-core' ),
                    'static'     => __( 'Static', 'oxo-core' ),
                );

// Fontawesome icons list
$pattern = '/\.(fa-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
$fontawesome_path = OXO_TINYMCE_DIR . '/css/font-awesome.css';
if( file_exists( $fontawesome_path ) ) {
	@$subject = file_get_contents( $fontawesome_path );
}


preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);

$icons = array();

foreach($matches as $match){
	$icons[$match[1]] = $match[2];
}

$checklist_icons = array ( 'icon-check' => '\f00c', 'icon-star' => '\f006', 'icon-angle-right' => '\f105', 'icon-asterisk' => '\f069', 'icon-remove' => '\f00d', 'icon-plus' => '\f067' );

/*-----------------------------------------------------------------------------------*/
/*	Shortcode Selection Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['shortcode-generator'] = array(
	'no_preview' => true,
	'params' => array(),
	'shortcode' => '',
	'popup_title' => ''
);

/*-----------------------------------------------------------------------------------*/
/*	Alert Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['alert'] = array(
	'no_preview' => true,
	'params' => array(

		'type' => array(
			'type' => 'select',
			'label' => __( 'Alert Type', 'oxo-core' ),
			'desc' => __( 'Select the type of alert message. Choose custom for advanced color options below.', 'oxo-core' ),
			'options' => array(
				'general' => __('General', 'oxo-core'),
				'error' => __('Error', 'oxo-core'),
				'success' => __('Success', 'oxo-core'),
				'notice' => __('Notice', 'oxo-core'),
				'custom' => __('Custom', 'oxo-core'),
			)
		),
		'accentcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Accent Color', 'oxo-core' ),
			'desc' => __( 'Custom setting only. Set the border, text and icon color for custom alert boxes.', 'oxo-core')
		),
		'backgroundcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Background Color', 'oxo-core' ),
			'desc' => __( 'Custom setting only. Set the background color for custom alert boxes.', 'oxo-core')
		),
		'bordersize' => array(
			'std' => '1px',
			'type' => 'text',
			'label' => __( 'Border Width', 'oxo-core' ),
			'desc' => __('Custom setting only. For custom alert boxes. In pixels (px), ex: 1px.', 'oxo-core')
		),
		'icon' => array(
			'type' => 'iconpicker',
			'label' => __( 'Select Custom Icon', 'oxo-core' ),
			'desc' => __( 'Custom setting only. Click an icon to select, click again to deselect', 'oxo-core' ),
			'options' => $icons
		),
		'boxshadow' => array(
			'type' => 'select',
			'label' => __( 'Box Shadow', 'oxo-core' ),
			'desc' =>  __( 'Display a box shadow below the alert box.', 'oxo-core' ),
			'options' => $choices
		),		
		'content' => array(
			'std' => __('Your Content Goes Here', 'oxo-core'),
			'type' => 'textarea',
			'label' => __( 'Alert Content', 'oxo-core' ),
			'desc' => __( 'Insert the alert\'s content', 'oxo-core' ),
		),
		'animation_type' => array(
			'type' => 'select',
			'label' => __( 'Animation Type', 'oxo-core' ),
			'desc' => __( 'Select the type of animation to use on the shortcode', 'oxo-core' ),
			'options' => $animation_type,
		),
		'animation_direction' => array(
			'type' => 'select',
			'label' => __( 'Direction of Animation', 'oxo-core' ),
			'desc' => __( 'Select the incoming direction for the animation', 'oxo-core' ),
			'options' => $animation_direction,
		),
		'animation_speed' => array(
			'type' => 'select',
			'std' => '',
			'label' => __( 'Speed of Animation', 'oxo-core' ),
			'desc' => __( 'Type in speed of animation in seconds (0.1 - 1)', 'oxo-core' ),
			'options' => $dec_numbers,
		),
		'animation_offset' => array(
			'type' 		=> 'select',
			'std' 		=> '',
			'label' 	=> __( 'Offset of Animation', 'oxo-core' ),
			'desc' 		=> __( 'Choose when the animation should start.', 'oxo-core' ),
			'options' 	=> array(
					  			''					=> __( 'Default', 'oxo-core' ),				
								'top-into-view' 	=> __( 'Top of element hits bottom of viewport', 'oxo-core' ),
								'top-mid-of-view' 	=> __( 'Top of element hits middle of viewport', 'oxo-core' ),
								'bottom-in-view' 	=> __( 'Bottom of element enters viewport', 'oxo-core' ),
							)
		),		
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core')
		),		
	),
	'shortcode' => '[alert type="{{type}}" accent_color="{{accentcolor}}" background_color="{{backgroundcolor}}" border_size="{{bordersize}}" icon="{{icon}}" box_shadow="{{boxshadow}}" animation_type="{{animation_type}}" animation_direction="{{animation_direction}}" animation_speed="{{animation_speed}}" animation_offset="{{animation_offset}}" class="{{class}}" id="{{id}}"]{{content}}[/alert]',
	'popup_title' => __( 'Alert Shortcode', 'oxo-core' )
);


/*-----------------------------------------------------------------------------------*/
/*	Blog Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['blog'] = array(
	'no_preview' => true,
	'params' => array(

		'layout' => array(
			'type' => 'select',
			'label' => __( 'Blog Layout', 'oxo-core' ),
			'desc' => __( 'Select the layout for the blog shortcode', 'oxo-core' ),
			'options' => array(
				'large' => __('Large', 'oxo-core'),
				'medium' => __('Medium', 'oxo-core'),
				'large alternate' => __('Large Alternate', 'oxo-core'),
				'medium alternate' => __('Medium Alternate', 'oxo-core'),
				'grid' => __('Grid', 'oxo-core'),
				'timeline' => __('Timeline', 'oxo-core')
			)
		),
		'posts_per_page' => array(
			'type' => 'select',
			'label' => __( 'Posts Per Page', 'oxo-core' ),
			'desc' => __( 'Select number of posts per page.', 'oxo-core' ),
			'options' => oxo_shortcodes_range( 25, true, true )
		),
		'offset' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Post Offset', 'oxo-core' ),
			'desc' => __('The number of posts to skip. ex: 1.', 'oxo-core')
		),			
		'cat_slug' => array(
			'type' => 'multiple_select',
			'label' => __( 'Categories', 'oxo-core' ),
			'desc' => __( 'Select a category or leave blank for all.', 'oxo-core' ),
			'options' => oxo_shortcodes_categories( 'category' )
		),
		'exclude_cats' => array(
			'type' => 'multiple_select',
			'label' => __( 'Exclude Categories', 'oxo-core' ),
			'desc' => __( 'Select a category to exclude.', 'oxo-core' ),
			'options' => oxo_shortcodes_categories( 'category' )
		),
		'show_title' => array(
			'type' => 'select',
			'label' => __( 'Show Title', 'oxo-core' ),
			'desc' =>  __( 'Display the post title below the featured image.', 'oxo-core' ),
			'options' => $choices
		),
		'title_link' => array(
			'type' => 'select',
			'label' => __( 'Link Title To Post', 'oxo-core' ),
			'desc' =>  __( 'Choose if the title should be a link to the single post page.', 'oxo-core' ),
			'options' => $choices
		),		
		'thumbnail' => array(
			'type' => 'select',
			'label' => __( 'Show Thumbnail', 'oxo-core' ),
			'desc' =>  __( 'Display the post featured image.', 'oxo-core' ),
			'options' => $choices
		),
		'excerpt' => array(
			'type' => 'select',
			'label' => __( 'Show Excerpt', 'oxo-core' ),
			'desc' =>  __( 'Show excerpt or choose "no" for full content.', 'oxo-core' ),
			'options' => $choices
		),
		'excerpt_length' => array(
			'std' => 35,
			'type' => 'text',
			'label' => __( 'Number of words/characters in Excerpt', 'oxo-core' ),
			'desc' =>  __( 'Controls the excerpt length based on words or characters that is set in Theme Options > Extra.', 'oxo-core' ),
		),
		'meta_all' => array(
			'type' => 'select',
			'label' => __( 'Show Meta Info', 'oxo-core' ),
			'desc' =>  __( 'Choose to show all meta data.', 'oxo-core' ),
			'options' => $choices
		),
		'meta_author' => array(
			'type' => 'select',
			'label' => __( 'Show Author Name', 'oxo-core' ),
			'desc' =>  __( 'Choose to show the author.', 'oxo-core' ),
			'options' => $choices
		),
		'meta_categories' => array(
			'type' => 'select',
			'label' => __( 'Show Categories', 'oxo-core' ),
			'desc' =>  __( "Choose to show the categories. Grid and timeline layout generally don't display categories.", 'oxo-core' ),
			'options' => $choices
		),
		'meta_comments' => array(
			'type' => 'select',
			'label' => __( 'Show Comment Count', 'oxo-core' ),
			'desc' =>  __( 'Choose to show the comments.', 'oxo-core' ),
			'options' => $choices
		),
		'meta_date' => array(
			'type' => 'select',
			'label' => __( 'Show Date', 'oxo-core' ),
			'desc' =>  __( 'Choose to show the date.', 'oxo-core' ),
			'options' => $choices
		),
		'meta_link' => array(
			'type' => 'select',
			'label' => __( 'Show Read More Link', 'oxo-core' ),
			'desc' =>  __( 'Choose to show the Read More link.', 'oxo-core' ),
			'options' => $choices
		),
		'meta_tags' => array(
			'type' => 'select',
			'label' => __( 'Show Tags', 'oxo-core' ),
			'desc' =>  __( "Choose to show the tags. Grid and timeline layout generally don't display tags.", 'oxo-core' ),
			'options' => $choices
		),
		'paging' => array(
			'type' => 'select',
			'label' => __( 'Show Pagination', 'oxo-core' ),
			'desc' =>  __( 'Show numerical pagination boxes.', 'oxo-core' ),
			'options' => $choices
		),
		'scrolling' => array(
			'type' => 'select',
			'label' => __( 'Pagination Type', 'oxo-core' ),
			'desc' =>  __( 'Choose the type of pagination.', 'oxo-core' ),
			'options' => array(
				'pagination' => __('Pagination', 'oxo-core'),
				'infinite' => __('Infinite Scrolling', 'oxo-core'),
				'load_more_button' => __('Load More Button', 'oxo-core')
			)
		),
		'blog_grid_columns' => array(
			'type' => 'select',
			'label' => __( 'Grid Layout # of Columns', 'oxo-core' ),
			'desc' => __( 'Select whether to display the grid layout in 2, 3 or 4 column.', 'oxo-core' ),
			'options' => array(
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'6' => '6',
			)
		),
		'blog_grid_column_spacing' => array(
			'std' => '40',
			'type' => 'text',
			'label' => __( 'Grid Layout Column Spacing', 'oxo-core' ),
			'desc' => __( 'Insert the amount of spacing between blog grid posts without "px".', 'oxo-core' )
		),			
		'strip_html' => array(
			'type' => 'select',
			'label' => __( 'Strip HTML from Posts Content', 'oxo-core' ),
			'desc' =>  __( 'Strip HTML from the post excerpt.', 'oxo-core' ),
			'options' => $choices
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core')
		),		
	),
	'shortcode' => '[blog number_posts="{{posts_per_page}}" offset="{{offset}}" cat_slug="{{cat_slug}}" exclude_cats="{{exclude_cats}}" show_title="{{show_title}}" title_link="{{title_link}}" thumbnail="{{thumbnail}}" excerpt="{{excerpt}}" excerpt_length="{{excerpt_length}}" strip_html="{{strip_html}}" meta_all="{{meta_all}}" meta_author="{{meta_author}}" meta_categories="{{meta_categories}}" meta_comments="{{meta_comments}}" meta_date="{{meta_date}}" meta_link="{{meta_link}}" meta_tags="{{meta_tags}}" paging="{{paging}}" scrolling="{{scrolling}}" blog_grid_columns="{{blog_grid_columns}}" blog_grid_column_spacing="{{blog_grid_column_spacing}}" layout="{{layout}}" class="{{class}}" id="{{id}}"][/blog]',
	'popup_title' => __( 'Blog Shortcode', 'oxo-core')
);

/*-----------------------------------------------------------------------------------*/
/*	Button Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['button'] = array(
	'no_preview' => true,
	'params' => array(

		'url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Button URL', 'oxo-core' ),
			'desc' => __( 'Add the button\'s url ex: http://example.com.', 'oxo-core' )
		),
		'style' => array(
			'type' => 'select',
			'label' => __( 'Button Style', 'oxo-core' ),
			'desc' => __( 'Select the button\'s color. Select default or color name for theme options, or select custom to use advanced color options below.', 'oxo-core' ),
			'options' => array(
				'default' => __('Default', 'oxo-core'),
				'custom' => __('Custom', 'oxo-core'),
				'green' => __('Green', 'oxo-core'),
				'darkgreen' => __('Dark Green', 'oxo-core'),
				'orange' => __('Orange', 'oxo-core'),
				'blue' => __('Blue', 'oxo-core'),
				'red' => __('Red', 'oxo-core'),
				'pink' => __('Pink', 'oxo-core'),
				'darkgray' => __('Dark Gray', 'oxo-core'),
				'lightgray' => __('Light Gray', 'oxo-core'),
			)
		),
		'size' => array(
			'type' => 'select',
			'label' => __( 'Button Size', 'oxo-core' ),
			'desc' => __( 'Select the button\'s size. Choose default for theme option selection.', 'oxo-core' ),
			'options' => array(
				'' => __('Default', 'oxo-core'),
				'small' => __('Small', 'oxo-core'),
				'medium' => __('Medium', 'oxo-core'),
				'large' => __('Large', 'oxo-core'),
				'xlarge' => __('XLarge', 'oxo-core'),
			)
		),
		'stretch' => array(
			'type' => 'select',
			'label' => __( 'Button Span', 'oxo-core' ),
			'desc' => __( 'Choose to have the button span the full width of its container.', 'oxo-core' ),
			'options' => $choices_with_default
		),		
		'type' => array(
			'type' => 'select',
			'label' => __( 'Button Type', 'oxo-core' ),
			'desc' => __( 'Select the button\'s type. Choose default for theme option selection.', 'oxo-core' ),
			'options' => array(
				'' => __('Default', 'oxo-core'),
				'flat' => __('Flat', 'oxo-core'),
				'3d' => '3D',
			)
		),
		'shape' => array(
			'type' => 'select',
			'label' => __( 'Button Shape', 'oxo-core' ),
			'desc' => __( 'Select the button\'s shape. Choose default for theme option selection.', 'oxo-core' ),
			'options' => array(
				'' => __('Default', 'oxo-core'),
				'square' => __('Square', 'oxo-core'),
				'pill' => __('Pill', 'oxo-core'),
				'round' => __('Round', 'oxo-core'),
			)
		),				
		'target' => array(
			'type' => 'select',
			'label' => __( 'Button Target', 'oxo-core' ),
			'desc' => __( '_self = open in same window <br />_blank = open in new window.', 'oxo-core' ),
			'options' => array(
				'_self' => '_self',
				'_blank' => '_blank'
			)
		),
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Button Title Attribute', 'oxo-core' ),
			'desc' => __( 'Set a title attribute for the button link.', 'oxo-core' ),
		),
		'content' => array(
			'std' => __('Button Text', 'oxo-core'),
			'type' => 'text',
			'label' => __( 'Button\'s Text', 'oxo-core' ),
			'desc' => __( 'Add the text that will display in the button.', 'oxo-core' ),
		),
		'gradtopcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Button Gradient Top Color', 'oxo-core' ),
			'desc' => __( 'Custom setting only. Set the top color of the button background.', 'oxo-core' )
		),
		'gradbottomcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Button Gradient Bottom Color', 'oxo-core' ),
			'desc' => __( 'Custom setting only. Set the bottom color of the button background or leave empty for solid color.', 'oxo-core' )
		),
		'gradtopcolorhover' => array(
			'type' => 'colorpicker',
			'label' => __( 'Button Gradient Top Color Hover', 'oxo-core' ),
			'desc' => __( 'Custom setting only. Set the top hover color of the button background.', 'oxo-core' )
		),
		'gradbottomcolorhover' => array(
			'type' => 'colorpicker',
			'label' => __( 'Button Gradient Bottom Color Hover', 'oxo-core' ),
			'desc' => __( 'Custom setting only. Set the bottom hover color of the button background or leave empty for solid color.', 'oxo-core' )
		),
		'accentcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Accent Color', 'oxo-core' ),
			'desc' => __( 'Custom setting only. This option controls the color of the button border, divider, text and icon.', 'oxo-core' )
		),
		'accenthovercolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Accent Hover Color', 'oxo-core' ),
			'desc' => __( 'Custom setting only. This option controls the hover color of the button border, divider, text and icon.', 'oxo-core' )
		),		
		'bevelcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Bevel Color (3D Mode only)', 'oxo-core' ),
			'desc' => __( 'Custom setting only. Set the bevel color of 3D buttons.', 'oxo-core' )
		),		
		'borderwidth' => array(
			'std' => '1px',
			'type' => 'text',
			'label' => __( 'Border Width', 'oxo-core' ),
			'desc' => __( 'Custom setting only. In pixels (px), ex: 1px.  Leave blank for theme option selection.', 'oxo-core' )
		),
		/*
		'bordercolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Border Color', 'oxo-core' ),
			'desc' => __('Custom setting. Backside.', 'oxo-core')
		),
		'borderhovercolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Border Hover Color', 'oxo-core' ),
			'desc' => __('Custom setting. Backside.', 'oxo-core')
		),		
		'textcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Text Color', 'oxo-core' ),
			'desc' => __('Custom setting. Backside.', 'oxo-core')
		),
		'texthovercolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Text Hover Color', 'oxo-core' ),
			'desc' => __('Custom setting. Backside.', 'oxo-core')
		),
		*/
		'icon' => array(
			'type' => 'iconpicker',
			'label' => __( 'Select Custom Icon', 'oxo-core' ),
			'desc' => __( 'Click an icon to select, click again to deselect', 'oxo-core' ),
			'options' => $icons
		),
		/*
		'iconcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Icon Color', 'oxo-core' ),
			'desc' => __('Custom setting. Leave blank for theme option selection.', 'oxo-core')
		),
		*/
		'iconposition' => array(
			'type' => 'select',
			'label' => __( 'Icon Position', 'oxo-core' ),
			'desc' => __( 'Choose the position of the icon on the button.', 'oxo-core' ),
			'options' => $leftright
		),			
		'icondivider' => array(
			'type' => 'select',
			'label' => __( 'Icon Divider', 'oxo-core' ),
			'desc' => __( 'Choose to display a divider between icon and text.', 'oxo-core' ),
			'options' => $choices
		),
		'modal' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Modal Window Anchor', 'oxo-core' ),
			'desc' => __( 'Add the class name of the modal window you want to open on button click.', 'oxo-core' ),
		),		
		'animation_type' => array(
			'type' => 'select',
			'label' => __( 'Animation Type', 'oxo-core' ),
			'desc' => __( 'Select the type of animation to use on the shortcode', 'oxo-core' ),
			'options' => $animation_type,
		),
		'animation_direction' => array(
			'type' => 'select',
			'label' => __( 'Direction of Animation', 'oxo-core' ),
			'desc' => __( 'Select the incoming direction for the animation', 'oxo-core' ),
			'options' => $animation_direction,
		),
		'animation_speed' => array(
			'type' => 'select',
			'std' => '',
			'label' => __( 'Speed of Animation', 'oxo-core' ),
			'desc' => __( 'Type in speed of animation in seconds (0.1 - 1)', 'oxo-core' ),
			'options' => $dec_numbers,
		),
		'animation_offset' => array(
			'type' 		=> 'select',
			'std' 		=> '',
			'label' 	=> __( 'Offset of Animation', 'oxo-core' ),
			'desc' 		=> __( 'Choose when the animation should start.', 'oxo-core' ),
			'options' 	=> array(
					  			''					=> __( 'Default', 'oxo-core' ),			
								'top-into-view' 	=> __( 'Top of element hits bottom of viewport', 'oxo-core' ),
								'top-mid-of-view' 	=> __( 'Top of element hits middle of viewport', 'oxo-core' ),
								'bottom-in-view' 	=> __( 'Bottom of element enters viewport', 'oxo-core' ),
							)
		),		
		'alignment' => array(
			'type' => 'select',
			'std' => '',
			'label' => __( 'Alignment', 'oxo-core' ),
			'desc' => __( 'Select the button\'s alignment.', 'oxo-core' ),
			'options' => array(
				'left' => __('Left', 'oxo-core'),
				'center' => __('Center', 'oxo-core'),
				'right' => __('Right', 'oxo-core'),
			)
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core')
		),			
	),
	'shortcode' => '[button link="{{url}}" color="{{style}}" size="{{size}}" stretch="{{stretch}}" type="{{type}}" shape="{{shape}}" target="{{target}}" title="{{title}}" gradient_colors="{{gradtopcolor}}|{{gradbottomcolor}}" gradient_hover_colors="{{gradtopcolorhover}}|{{gradbottomcolorhover}}" accent_color="{{accentcolor}}" accent_hover_color="{{accenthovercolor}}" bevel_color="{{bevelcolor}}" border_width="{{borderwidth}}" icon="{{icon}}" icon_divider="{{icondivider}}" icon_position="{{iconposition}}" modal="{{modal}}" animation_type="{{animation_type}}" animation_direction="{{animation_direction}}" animation_speed="{{animation_speed}}" animation_offset="{{animation_offset}}" alignment="{{alignment}}" class="{{class}}" id="{{id}}"]{{content}}[/button]',
	'popup_title' => __( 'Button Shortcode', 'oxo-core')
);

/*-----------------------------------------------------------------------------------*/
/*	Checklist Config
/*-----------------------------------------------------------------------------------*/
$oxo_shortcodes['checklist'] = array(
	'params' => array(

		'icon' => array(
			'type' => 'iconpicker',
			'label' => __( 'Select Icon', 'oxo-core' ),
			'desc' => __( 'Global setting for all list items, this can be overridden individually below. Click an icon to select, click again to deselect.', 'oxo-core' ),
			'options' => $icons
		),
		'iconcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Icon Color', 'oxo-core' ),
			'desc' => __( 'Global setting for all list items. Leave blank for theme option selection. Defines the icon color.', 'oxo-core')
		),
		'circle' => array(
			'type' => 'select',
			'label' => __( 'Icon in Circle', 'oxo-core' ),
			'desc' => __( 'Global setting for all list items. Set to default for theme option selection. Choose to have icons in circles.', 'oxo-core' ),
			'options' => $choices_with_default
		),
		'circlecolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Circle Color', 'oxo-core' ),
			'desc' => __( 'Global setting for all list items. Leave blank for theme option selection. Defines the circle color.', 'oxo-core')
		),
		'size' => array(
			'std' => '13px',
			'type' => 'text',
			'label' => __( 'Item Size', 'oxo-core' ),
			'desc' => __( 'Select the list item\'s size. In pixels (px), ex: 13px.', 'oxo-core' ),
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core')
		),		
	),

	'shortcode' => '[checklist icon="{{icon}}" iconcolor="{{iconcolor}}" circle="{{circle}}" circlecolor="{{circlecolor}}" size="{{size}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/checklist]',
	'popup_title' => __( 'Checklist Shortcode', 'oxo-core' ),
	'no_preview' => true,

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'icon' => array(
				'type' => 'iconpicker',
				'label' => __( 'Select Icon', 'oxo-core' ),
				'desc' => __( 'This setting will override the global setting above. Leave blank for theme option selection.', 'oxo-core' ),
				'options' => $icons
			),				
			'content' => array(
				'std' => __('Your Content Goes Here', 'oxo-core'),
				'type' => 'textarea',
				'label' => __( 'List Item Content', 'oxo-core' ),
				'desc' => __( 'Add list item content', 'oxo-core' ),
			),
		),
		'shortcode' => '[li_item icon="{{icon}}"]{{content}}[/li_item]',
		'clone_button' => __( 'Add New List Item', 'oxo-core')
	)
);


/*-----------------------------------------------------------------------------------*/
/*	Client Slider Config
/*-----------------------------------------------------------------------------------*/
/*
$oxo_shortcodes['clientslider'] = array(
	'params' => array(
		'picture_size' => array(
			'type' => 'select',
			'label' => __( 'Picture Size', 'oxo-core' ),
			'desc' => __( 'fixed = width and height will be fixed <br />auto = width and height will adjust to the image.', 'oxo-core' ),
			'options' => array(
				'fixed' => __('Fixed', 'oxo-core'),
				'auto' => __('Auto', 'oxo-core')
			)
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core')
		),		
	),
	'shortcode' => '[clients picture_size="{{picture_size}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/clients]', // as there is no wrapper shortcode
	'popup_title' => __( 'Client Slider Shortcode', 'oxo-core' ),
	'no_preview' => true,

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'url' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Client Website Link', 'oxo-core' ),
				'desc' => __( 'Add the url to client\'s website <br />ex: http://example.com', 'oxo-core')
			),
			'target' => array(
				'type' => 'select',
				'label' => __( 'Link Target', 'oxo-core' ),
				'desc' => __( '_self = open in same window <br /> _blank = open in new window', 'oxo-core' ),
				'options' => array(
					'_self' => '_self',
					'_blank' => '_blank'
				)
			),
			'image' => array(
				'type' => 'uploader',
				'label' => __( 'Client Image', 'oxo-core' ),
				'desc' => __( 'Upload the client image', 'oxo-core' ),
			),
			'alt' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Image Alt Text', 'oxo-core' ),
				'desc' => __('The alt attribute provides alternative information if an image cannot be viewed', 'oxo-core')
			),				
		),
		'shortcode' => '[client link="{{url}}" linktarget="{{target}}" image="{{image}}" alt="{{alt}}"]',
		'clone_button' => __( 'Add New Client Image', 'oxo-core')
	)
);
*/
/*-----------------------------------------------------------------------------------*/
/*	Code Block Config
/*-----------------------------------------------------------------------------------*/

/*$oxo_shortcodes['code'] = array(
	'no_preview' => true,
	'params' => array(
		'content' => array(
			'std' => 'Click edit button to change this code.',
			'type' => 'textarea',
			'label' => __( 'Code', 'oxo-core' ),
			'desc' => __( 'Enter some content for this codeblock', 'oxo-core' ),
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the HTML element.', 'oxo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the HTML element.', 'oxo-core' )
		),			
	),
	'shortcode' => '[oxo_code class="{{class}}" id="{{id}}"]{{content}}[/oxo_code]',
	'popup_title' => __( 'Code Block Shortcode', 'oxo-core' )
);*/


/*-----------------------------------------------------------------------------------*/
/*	Columns Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['columns'] = array(
	'shortcode' => ' {{child_shortcode}} ', // as there is no wrapper shortcode
	'popup_title' => __( 'Insert Columns Shortcode', 'oxo-core' ),
	'no_preview' => true,
	'params' => array(),

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'column' => array(
				'type' => 'select',
				'label' => __( 'Column Type', 'oxo-core' ),
				'desc' => __( 'Select the width of the column', 'oxo-core' ),
				'options' => array(
					'one_full'		=> __('One Column', 'oxo-core'),
					'one_half' 		=> __('One Half', 'oxo-core'),
					'one_third' 	=> __('One Third', 'oxo-core'),
					'two_third' 	=> __('Two Thirds', 'oxo-core'),
					'one_fourth'	=> __('One Fourth', 'oxo-core'),
					'three_fourth' 	=> __('Three Fourth', 'oxo-core'),	
					'one_fifth' 	=> __('One Fifth', 'oxo-core'),
					'two_fifth' 	=> __('Two Fifth', 'oxo-core'),
					'three_fifth' 	=> __('Three Fifth', 'oxo-core'),
					'four_fifth' 	=> __('Four Fifth', 'oxo-core'),
					'one_sixth' 	=> __('One Sixth', 'oxo-core'),
					'five_sixth' 	=> __('Five Sixth', 'oxo-core'),
					'one' 	        => __('One ( Six Sixth )', 'oxo-core'),
				)
			),
			'last' => array(
				'type' => 'select',
				'label' => __( 'Last Column', 'oxo-core' ),
				'desc' => __('Choose if the column is last in a set. This has to be set to "Yes" for the last column in a set', 'oxo-core'),
				'options' => $reverse_choices
			),
			'spacing' => array(
				'std' => 'yes',
				'type' => 'select',
				'label' => __( 'Column Spacing', 'oxo-core' ),
				'desc' => __( 'Set to "No" to eliminate margin between columns.', 'oxo-core' ),
				'options' => $choices			
			),
			'center_content' => array(
				'type' => 'select',
				'label' => __( 'Center Content Vertically', 'oxo-core' ),
				'desc' => __('Only works with columns inside a full width container that is set to equal heights. Set to "Yes" to center the content vertically.', 'oxo-core'),
				'options' => $reverse_choices
			),
			'hide_on_mobile' => array(
				'type' => 'select',
				'label' => __( 'Hide on Mobile', 'oxo-core' ),
				'desc' => __('Select "Yes" to hide column on mobile.', 'oxo-core'),
				'options' => $reverse_choices
			),					
			'backgroundcolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Background Color', 'oxo-core' ),
				'desc' => __( 'Controls the background color.', 'oxo-core')
			),
			'backgroundimage' => array(
				'type' => 'uploader',
				'label' => __( 'Background Image', 'oxo-core' ),
				'desc' => __('Upload an image to display in the background', 'oxo-core')
			),
			'backgroundrepeat' => array(
				'type' => 'select',
				'label' => __( 'Background Repeat', 'oxo-core' ),
				'desc' => __('Choose how the background image repeats.', 'oxo-core'),
				'options' => array(
					'no-repeat' => __('No Repeat', 'oxo-core'),
					'repeat' => __('Repeat Vertically and Horizontally', 'oxo-core'),
					'repeat-x' => __('Repeat Horizontally', 'oxo-core'),
					'repeat-y' => __('Repeat Vertically', 'oxo-core')
				)
			),
			'backgroundposition' => array(
				'type' => 'select',
				'label' => __( 'Background Position', 'oxo-core' ),
				'desc' => __('Choose the postion of the background image.', 'oxo-core'),
				'options' => array(
					'left top' => __('Left Top', 'oxo-core'),
					'left center' => __('Left Center', 'oxo-core'),
					'left bottom' => __('Left Bottom', 'oxo-core'),
					'right top' => __('Right Top', 'oxo-core'),
					'right center' => __('Right Center', 'oxo-core'),
					'right bottom' => __('Right Bottom', 'oxo-core'),
					'center top' => __('Center Top', 'oxo-core'),
					'center center' => __('Center Center', 'oxo-core'),
					'center bottom' => __('Center Bottom', 'oxo-core')
				)
			),
			'hover_type' => array(
				'std' => 'none',
				'type' => 'select',
				'label' => __( 'Hover Type', 'oxo-core' ),
				'desc' => __('Select the hover effect type. This will disable links on elements inside the column.', 'oxo-core'),
				'options' => array(
					'none' => __('None', 'oxo-core'),
					'zoomin' => __('Zoom In', 'oxo-core'),
					'zoomout' => __('Zoom Out', 'oxo-core'),
					'liftup' => __('Lift Up', 'oxo-core')
				)
			),			
			'link' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Link URL', 'oxo-core' ),
				'desc' => __( 'Add the URL the column will link to, ex: http://example.com. This will disable links on elements inside the column.', 'oxo-core' ),
			),
			'borderposition' => array(
				'type' => 'select',
				'label' => __( 'Border Position', 'oxo-core' ),
				'desc' => __('Choose the postion of the border.', 'oxo-core'),
				'options' => array(
					'all' => __('All', 'oxo-core'),
					'top' => __('Top', 'oxo-core'),
					'right' => __('Right', 'oxo-core'),
					'bottom' => __('Bottom', 'oxo-core'),
					'left' => __('Left', 'oxo-core'),
				)
			),			
			'bordersize' => array(
				'std' => '0px',
				'type' => 'text',
				'label' => __( 'Border Size', 'oxo-core' ),
				'desc' => __( 'In pixels (px), ex: 1px.', 'oxo-core' ),
			),
			'bordercolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Border Color', 'oxo-core' ),
				'desc' => __( 'Controls the border color.', 'oxo-core')
			),				
			'borderstyle' => array(
				'type' => 'select',
				'label' => __( 'Border Style', 'oxo-core' ),
				'desc' => __( 'Controls the border style.', 'oxo-core' ),
				'options' => array(
					'solid' => __('Solid', 'oxo-core'),
					'dashed' => __('Dashed', 'oxo-core'),
					'dotted' => __('Dotted', 'oxo-core')
				)			
			),		
			'padding' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Padding', 'oxo-core' ),
				'desc' => __( 'In pixels (px), ex: 10px.', 'oxo-core' )
			),
			'margin_top' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Margin Top', 'oxo-core' ),
				'desc' => __( 'In pixels (px), ex: 10px.', 'oxo-core' )
			),
			'margin_bottom' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Margin Bottom', 'oxo-core' ),
				'desc' => __( 'In pixels (px), ex: 10px.', 'oxo-core' )
			),
			'content' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => __( 'Column Content', 'oxo-core' ),
				'desc' => __( 'Insert the column content', 'oxo-core' ),
			),
			'animation_type' => array(
				'type' => 'select',
				'label' => __( 'Animation Type', 'oxo-core' ),
				'desc' => __( 'Select the type of animation to use on the shortcode', 'oxo-core' ),
				'options' => $animation_type,
			),
			'animation_direction' => array(
				'type' => 'select',
				'label' => __( 'Direction of Animation', 'oxo-core' ),
				'desc' => __( 'Select the incoming direction for the animation', 'oxo-core' ),
				'options' => $animation_direction,
			),
			'animation_speed' => array(
				'type' => 'select',
				'std' => '',
				'label' => __( 'Speed of Animation', 'oxo-core' ),
				'desc' => __( 'Type in speed of animation in seconds (0.1 - 1)', 'oxo-core' ),
				'options' => $dec_numbers,
			),
			'animation_offset' => array(
				'type' 		=> 'select',
				'std' 		=> '',
				'label' 	=> __( 'Offset of Animation', 'oxo-core' ),
				'desc' 		=> __( 'Choose when the animation should start.', 'oxo-core' ),
				'options' 	=> array(
					  				''					=> __( 'Default', 'oxo-core' ),					
									'top-into-view' 	=> __( 'Top of element hits bottom of viewport', 'oxo-core' ),
									'top-mid-of-view' 	=> __( 'Top of element hits middle of viewport', 'oxo-core' ),
									'bottom-in-view' 	=> __( 'Bottom of element enters viewport', 'oxo-core' ),
								)
			),			
			'class' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'CSS Class', 'oxo-core' ),
				'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core' )
			),
			'id' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'CSS ID', 'oxo-core' ),
				'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core' )
			),			
		),
		'shortcode' => '[{{column}} spacing="{{spacing}}" last="{{last}}" center_content="{{center_content}}" hide_on_mobile="{{hide_on_mobile}}" background_color="{{backgroundcolor}}" background_image="{{backgroundimage}}" background_repeat="{{backgroundrepeat}}" background_position="{{backgroundposition}}" link="{{link}}" hover_type="{{hover_type}}" border_position="{{borderposition}}" border_size="{{bordersize}}" border_color="{{bordercolor}}" border_style="{{borderstyle}}" padding="{{padding}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" animation_type="{{animation_type}}" animation_direction="{{animation_direction}}" animation_speed="{{animation_speed}}" animation_offset="{{animation_offset}}" class="{{class}}" id="{{id}}"]{{content}}[/{{column}}] ',
		'clone_button' => __( 'Add Column', 'oxo-core')
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Content Boxes Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['contentboxes'] = array(
	'params' => array(
		'layout' => array(
			'type' => 'select',
			'label' => __( 'Box Layout', 'oxo-core' ),
			'desc' => __( 'Select the layout for the content box', 'oxo-core' ),
			'options' => array(
				'icon-with-title' => __('Classic Icon With Title', 'oxo-core'),
				'icon-on-top' => __('Classic Icon On Top', 'oxo-core'),
				'icon-on-side' => __('Classic Icon On Side', 'oxo-core'),
				'icon-boxed' => __('Icon Boxed', 'oxo-core'),
				'clean-vertical' => __('Clean Layout Vertical', 'oxo-core'),
				'clean-horizontal' => __('Clean Layout Horizontal', 'oxo-core'),
				'timeline-vertical' => __('Timeline Vertical', 'oxo-core'),
				'timeline-horizontal' => __('Timeline Horizontal', 'oxo-core')
			)
		),
		'columns' => array(
			'std' => 4,
			'type' => 'select',
			'label' => __( 'Number of Columns', 'oxo-core' ),
			'desc' =>  __( 'Set the number of columns per row.', 'oxo-core' ),
			'options' => oxo_shortcodes_range( 6, false )
		),
		'icon_align' => array(
			'std' => 'left',
			'type' => 'select',
			'label' => __( 'Content Alignment', 'oxo-core' ),
			'desc' =>  __( 'Works with "Classic Icon With Title" and "Classic Icon On Side" layout options.' ),
			'options' => array('left'		=> 'Left',
							   'right'	 	=> 'Right') 
		),
		'title_size' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Title Size', 'oxo-core' ),
			'desc' => __( 'Controls the size of the title. Leave blank for theme option selection. In pixels ex: 18px.', 'oxo-core')
		),
		'backgroundcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Content Box Background Color', 'oxo-core' ),
			'desc' => __( 'Leave blank for theme option selection.', 'oxo-core')
		),
		'icon_circle' => array(
			'type' => 'select',
			'label' => __( 'Icon Background', 'oxo-core' ),
			'desc' => __( 'Controls the background behind the icon. Select default for theme option selection.', 'oxo-core' ),
			'options' => array(
				'' => __('Default', 'oxo-core'),
				'yes' => __('Yes', 'oxo-core'),
				'no' => __('No', 'oxo-core'),
			)
		),
		'icon_circle_radius' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Icon Background Radius', 'oxo-core' ),
			'desc' => __( 'Choose the border radius of the icon background. Leave blank for theme option selection. In pixels (px), ex: 1px, or "round".', 'oxo-core')
		),
		'iconcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Icon Color', 'oxo-core' ),
			'desc' => __( 'Leave blank for theme option selection.', 'oxo-core')
		),
		'circlecolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Icon Background Color', 'oxo-core' ),
			'desc' => __( 'Leave blank for theme option selection.', 'oxo-core')
		),
		'circlebordercolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Icon Background Inner Border Color', 'oxo-core' ),
			'desc' => __( 'Leave blank for theme option selection.', 'oxo-core')
		),
		'circlebordercolorsize' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Icon Background Inner Border Size', 'oxo-core' ),
			'desc' => __( 'Leave blank for theme option selection.', 'oxo-core')
		),
		'outercirclebordercolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Icon Background Outer Border Color', 'oxo-core' ),
			'desc' => __( 'Leave blank for theme option selection.', 'oxo-core')
		),
		'outercirclebordercolorsize' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Icon Background Outer Border Size', 'oxo-core' ),
			'desc' => __( 'Leave blank for theme option selection.', 'oxo-core')
		),
		'icon_size' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Icon Size', 'oxo-core' ),
			'desc' => __( 'Controls the size of the icon.  Leave blank for theme option selection. In pixels ex: 18px.', 'oxo-core')
		),
		'link_type' => array(
			'type' => 'select',
			'label' => __( 'Link Type', 'oxo-core' ),
			'desc' => __( 'Select the type of link that should show in the content box. Select default for theme option selection.', 'oxo-core' ),
			'options' => array(
				''	=> 'Default',
				'text' => 'Text',
				'button-bar' => 'Button Bar',
				'button' => 'Button'
			)
		),
		'link_area' => array(
			'std' => '',
			'type' => 'select',
			'label' => __( 'Link Area', 'oxo-core' ),
			'desc' =>  __( 'Select which area the link will be assigned to' ),
			'options' => array('' => 'Default',
								'link-icon'		=> 'Link+Icon',
							   'box'	 		=> 'Entire Content Box') 
		),
		'target' => array(
			'type' => 'select',
			'label' => __( 'Link Target', 'oxo-core' ),
			'desc' => __( '_self = open in same window <br /> _blank = open in new window', 'oxo-core' ),
			'options' => array(
				''	=> 'Default',
				'_self' => '_self',
				'_blank' => '_blank'
			)
		),
		'animation_delay' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Animation Delay', 'oxo-core' ),
			'desc' => __( 'Controls the delay of animation between each element in a set. In milliseconds.', 'oxo-core')
		),
		'animation_offset' => array(
			'type' 		=> 'select',
			'std' 		=> '',
			'label' 	=> __( 'Offset of Animation', 'oxo-core' ),
			'desc' 		=> __( 'Choose when the animation should start.', 'oxo-core' ),
			'options' 	=> array(
					  			''					=> __( 'Default', 'oxo-core' ),				
								'top-into-view' 	=> __( 'Top of element hits bottom of viewport', 'oxo-core' ),
								'top-mid-of-view' 	=> __( 'Top of element hits middle of viewport', 'oxo-core' ),
								'bottom-in-view' 	=> __( 'Bottom of element enters viewport', 'oxo-core' ),
							)
		),		
		'animation_type' => array(
			'type' => 'select',
			'label' => __( 'Animation Type', 'oxo-core' ),
			'desc' => __( 'Select the type on animation to use on the shortcode', 'oxo-core' ),
			'options' => $animation_type,
		),
		'animation_direction' => array(
			'type' => 'select',
			'label' => __( 'Direction of Animation', 'oxo-core' ),
			'desc' => __( 'Select the incoming direction for the animation', 'oxo-core' ),
			'options' => $animation_direction,
		),
		'animation_speed' => array(
			'type' => 'select',
			'std' => '',
			'label' => __( 'Speed of Animation', 'oxo-core' ),
			'desc' => __( 'Type in speed of animation in seconds (0.1 - 1)', 'oxo-core' ),
			'options' => $dec_numbers,
		),
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'oxo-core' ),
			'desc' => __( 'In pixels (px), ex: 10px.', 'oxo-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'oxo-core' ),
			'desc' => __( 'In pixels (px), ex: 10px.', 'oxo-core' )
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core')
		),			
	),
	'shortcode' => '[content_boxes layout="{{layout}}" columns="{{columns}}" icon_align="{{icon_align}}" title_size="{{title_size}}" backgroundcolor="{{backgroundcolor}}" icon_circle="{{icon_circle}}" icon_circle_radius="{{icon_circle_radius}}" iconcolor="{{iconcolor}}" circlecolor="{{circlecolor}}" circlebordercolor="{{circlebordercolor}}" circlebordercolorsize="{{circlebordercolorsize}}" outercirclebordercolor="{{circlebordercolor}}" outercirclebordercolorsize="{{outercirclebordercolorsize}}" icon_size="{{icon_size}}" link_type="{{link_type}}" link_area="{{link_area}}" animation_delay="{{animation_delay}}" animation_offset="{{animation_offset}}" animation_type="{{animation_type}}" animation_direction="{{animation_direction}}" animation_speed="{{animation_speed}}" margin_top="{{margin_top}}" margin_bottom="{{margin_top}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/content_boxes]', // as there is no wrapper shortcode
	'popup_title' => __( 'Content Boxes Shortcode', 'oxo-core' ),
	'no_preview' => true,

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'title' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Title', 'oxo-core'),
				'desc' => __( 'The box title.', 'oxo-core' ),
			),
			'icon' => array(
				'type' => 'iconpicker',
				'label' => __( 'Icon', 'oxo-core' ),
				'desc' => __( 'Click an icon to select, click again to deselect.', 'oxo-core' ),
				'options' => $icons
			),
			'backgroundcolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Content Box Background Color', 'oxo-core' ),
				'desc' => __( 'Leave blank for theme option selection.', 'oxo-core')
			),
			'iconcolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Icon Color', 'oxo-core' ),
				'desc' => __( 'Leave blank for theme option selection.', 'oxo-core')
			),
			'circlecolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Icon Background Color', 'oxo-core' ),
				'desc' => __( 'Leave blank for theme option selection.', 'oxo-core')
			),
			'circlebordercolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Icon Background Inner Border Color', 'oxo-core' ),
				'desc' => __( 'Leave blank for theme option selection.', 'oxo-core')
			),
			'circlebordercolorsize' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Icon Background Inner Border Size', 'oxo-core' ),
				'desc' => __( 'Leave blank for theme option selection.', 'oxo-core')
			),
			'outercirclebordercolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Icon Background Outer Border Color', 'oxo-core' ),
				'desc' => __( 'Leave blank for theme option selection.', 'oxo-core')
			),
			'outercirclebordercolorsize' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Icon Background Outer Border Size', 'oxo-core' ),
				'desc' => __( 'Leave blank for theme option selection.', 'oxo-core')
			),
			'iconrotate' => array(
				'type' => 'select',
				'label' => __( 'Rotate Icon', 'oxo-core' ),
				'desc' => __( 'Choose to rotate the icon.', 'oxo-core' ),
				'options' => array(
					''	=> __('None', 'oxo-core'),
					'90' => '90',
					'180' => '180',
					'270' => '270',					
				)
			),				
			'iconspin' => array(
				'type' => 'select',
				'label' => __( 'Spinning Icon', 'oxo-core' ),
				'desc' => __( 'Choose to let the icon spin.', 'oxo-core' ),
				'options' => $reverse_choices
			),									
			'image' => array(
				'type' => 'uploader',
				'label' => __( 'Icon Image', 'oxo-core' ),
				'desc' => __( 'To upload your own icon image, deselect the icon above and then upload your icon image.', 'oxo-core' ),
			),
			'image_width' => array(
				'std' => 35,
				'type' => 'text',
				'label' => __( 'Icon Image Width', 'oxo-core' ),
				'desc' => __( 'If using an icon image, specify the image width in pixels but do not add px, ex: 35.', 'oxo-core' ),
			),
			'image_height' => array(
				'std' => 35,
				'type' => 'text',
				'label' => __( 'Icon Image Height', 'oxo-core' ),
				'desc' => __( 'If using an icon image, specify the image height in pixels but do not add px, ex: 35.', 'oxo-core' ),
			),
			'link' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Link Url', 'oxo-core' ),
				'desc' => __( 'Add the link\'s url ex: http://example.com', 'oxo-core' ),

			),
			'linktext' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Link Text', 'oxo-core' ),
				'desc' => __( 'Insert the text to display as the link', 'oxo-core' ),

			),
			'target' => array(
				'type' => 'select',
				'label' => __( 'Link Target', 'oxo-core' ),
				'desc' => __( '_self = open in same window <br /> _blank = open in new window', 'oxo-core' ),
				'options' => array(
					'_self' => '_self',
					'_blank' => '_blank'
				)
			),
			'content' => array(
				'std' => __('Your Content Goes Here', 'oxo-core'),
				'type' => 'textarea',
				'label' => __( 'Content Box Content', 'oxo-core' ),
				'desc' => __( 'Add content for content box', 'oxo-core' ),
			),
			'animation_type' => array(
				'type' => 'select',
				'label' => __( 'Animation Type', 'oxo-core' ),
				'desc' => __( 'Select the type on animation to use on the shortcode', 'oxo-core' ),
				'options' => $animation_type,
			),
			'animation_direction' => array(
				'type' => 'select',
				'label' => __( 'Direction of Animation', 'oxo-core' ),
				'desc' => __( 'Select the incoming direction for the animation', 'oxo-core' ),
				'options' => $animation_direction,
			),
			'animation_speed' => array(
				'type' => 'select',
				'std' => '',
				'label' => __( 'Speed of Animation', 'oxo-core' ),
				'desc' => __( 'Type in speed of animation in seconds (0.1 - 1)', 'oxo-core' ),
				'options' => $dec_numbers,
			)
		),
		'shortcode' => '[content_box title="{{title}}" icon="{{icon}}" backgroundcolor="{{backgroundcolor}}" iconcolor="{{iconcolor}}" circlecolor="{{circlecolor}}" circlebordercolor="{{circlebordercolor}}" circlebordercolorsize="{{circlebordercolorsize}}" outercirclebordercolor="{{circlebordercolor}}" outercirclebordercolorsize="{{outercirclebordercolorsize}}" iconrotate="{{iconrotate}}" iconspin="{{iconspin}}" image="{{image}}" image_width="{{image_width}}" image_height="{{image_height}}" link="{{link}}" linktarget="{{target}}" linktext="{{linktext}}" animation_type="{{animation_type}}" animation_direction="{{animation_direction}}" animation_speed="{{animation_speed}}"]{{content}}[/content_box]',
		'clone_button' => __( 'Add New Content Box', 'oxo-core')
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Countdown Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['oxo_countdown'] = array(  
	'params' => array(
		'countdown_end' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Countdown Timer End', 'oxo-core' ),
			'desc' =>  __( 'Set the end date and time for the countdown time. Use SQL time format: YYYY-MM-DD HH:MM:SS. E.g: 2016-05-10 12:30:00.', 'oxo-core' ),
		),
		'timezone' => array(
			'std' => '',
			'type' => 'select',
			'label' => __( 'Timezone', 'oxo-core' ),
			'desc' => __( 'Choose which timezone should be used for the countdown calculation.', 'oxo-core'),
			'options' => array(
				'' 				=> __( 'Default', 'oxo-core' ),
				'site_time' => __( 'Timezone of Site', 'oxo-core' ),
				'user_time' => __( 'Timezone of User', 'oxo-core' )
			)
		),
		'show_weeks' => array(
			'std' => '',
			'type' => 'select',
			'label' => __( 'Show Weeks', 'oxo-core' ),
			'desc' => __( 'Select "yes" to show weeks for longer countdowns.', 'oxo-core'),
			'options' => array(
				'default' 	=> __( 'Default', 'oxo-core' ),
				'no' 		=> __('No', 'oxo-core'),
				'yes' 		=> __('Yes', 'oxo-core')
			)
		),		
		'background_color' => array(
			'type' => 'colorpicker',
			'label' => __( 'Background Color', 'oxo-core' ),
			'desc' => __( 'Choose a background color for the countdown wrapping box.', 'oxo-core')
		),
		'background_image' => array(
			'type' => 'uploader',
			'label' => __( 'Background Image', 'oxo-core' ),
			'desc' => __('Upload an image to display in the background of the countdown wrapping box.', 'oxo-core')
		),
		'background_position' => array(
			'type' => 'select',
			'label' => __( 'Background Position', 'oxo-core' ),
			'desc' => __('Choose the postion of the background image.', 'oxo-core'),
			'options' => array(
				''	 			=> __('Default', 'oxo-core'),
				'left top' 		=> __('Left Top', 'oxo-core'),
				'left center' 	=> __('Left Center', 'oxo-core'),
				'left bottom' 	=> __('Left Bottom', 'oxo-core'),
				'right top' 	=> __('Right Top', 'oxo-core'),
				'right center' 	=> __('Right Center', 'oxo-core'),
				'right bottom' 	=> __('Right Bottom', 'oxo-core'),
				'center top'	=> __('Center Top', 'oxo-core'),
				'center center' => __('Center Center', 'oxo-core'),
				'center bottom' => __('Center Bottom', 'oxo-core')
			)
		),		
		'background_repeat' => array(
			'type' => 'select',
			'label' => __( 'Background Repeat', 'oxo-core' ),
			'desc' => __('Choose how the background image repeats.', 'oxo-core'),
			'options' => array(
				'' 			=> __('Default', 'oxo-core'),
				'no-repeat' => __('No Repeat', 'oxo-core'),
				'repeat' 	=> __('Repeat Vertically and Horizontally', 'oxo-core'),
				'repeat-x' 	=> __('Repeat Horizontally', 'oxo-core'),
				'repeat-y' 	=> __('Repeat Vertically', 'oxo-core')
			)
		),		
		'border_radius' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Border Radius', 'oxo-core' ),
			'desc' => __('Choose the radius of outer box and also the counter boxes. In pixels (px), ex: 1px.', 'oxo-core')
		),		
		'counter_box_color' => array(
			'type' => 'colorpicker',
			'label' => __( 'Counter Boxes Color', 'oxo-core' ),
			'desc' => __( 'Choose a background color for the counter boxes.', 'oxo-core')
		),
		'counter_text_color' => array(
			'type' => 'colorpicker',
			'label' => __( 'Counter Boxes Text Color', 'oxo-core' ),
			'desc' => __( 'Choose a text color for the countdown timer.', 'oxo-core')
		),		
		'heading_text' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Heading Text', 'oxo-core' ),
			'desc' => __( 'Choose a heading text for the countdown.', 'oxo-core')
		),
		'heading_text_color' => array(
			'type' => 'colorpicker',
			'label' => __( 'Heading Text Color', 'oxo-core' ),
			'desc' => __( 'Choose a text color for the countdown heading.', 'oxo-core')
		),
		'subheading_text' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Subheading Text', 'oxo-core' ),
			'desc' => __( 'Choose a subheading text for the countdown.', 'oxo-core')
		),
		'subheading_text_color' => array(
			'type' => 'colorpicker',
			'label' => __( 'Subheading Text Color', 'oxo-core' ),
			'desc' => __( 'Choose a text color for the countdown subheading.', 'oxo-core')
		),			
		'link_text' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Link Text', 'oxo-core' ),
			'desc' => __( 'Choose a link text for the countdown.', 'oxo-core')
		),
		'link_text_color' => array(
			'type' => 'colorpicker',
			'label' => __( 'Link Text Color', 'oxo-core' ),
			'desc' => __( 'Choose a text color for the countdown link.', 'oxo-core')
		),		
		'link_url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Link URL', 'oxo-core' ),
			'desc' => __( 'Add a url for the link. E.g: http://example.com.', 'oxo-core')
		),		
		'link_target' => array(
			'type' => 'select',
			'label' => __( 'Link Target', 'oxo-core' ),
			'desc' => __( '_self = open in same window <br /> _blank = open in new window', 'oxo-core' ),
			'options' => array(
				'default'	=> 'Default',
				'_self' 	=> '_self',
				'_blank'	=> '_blank'
			)
		),		
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core')
		),
	),
	'shortcode' => '[oxo_countdown countdown_end="{{countdown_end}}" timezone="{{timezone}}" show_weeks="{{show_weeks}}" background_color="{{background_color}}" background_image="{{background_image}}" background_position="{{background_position}}" background_repeat="{{background_repeat}}" border_radius="{{border_radius}}" counter_box_color="{{counter_box_color}}" counter_text_color="{{counter_text_color}}" heading_text="{{heading_text}}" heading_text_color="{{heading_text_color}}" subheading_text="{{subheading_text}}" subheading_text_color="{{subheading_text_color}}" link_text="{{link_text}}" link_text_color="{{link_text_color}}" link_url="{{link_url}}" link_target="{{link_target}}" class="{{class}}" id="{{id}}"][/oxo_countdown]', // as there is no wrapper shortcode
	'popup_title' => __( 'Countdown Shortcode', 'oxo-core' ),
	'no_preview' => true
);


/*-----------------------------------------------------------------------------------*/
/*	Counters Box Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['countersbox'] = array(
	'params' => array(
		'columns' => array(
			'std' => 4,
			'type' => 'select',
			'label' => __( 'Number of Columns', 'oxo-core' ),
			'desc' =>  __( 'Set the number of columns per row.', 'oxo-core' ),
			'options' => oxo_shortcodes_range( 6, false )
		),
		'title_color' => array(
			'type' => 'colorpicker',
			'label' => __( 'Counter Box Title Font Color', 'oxo-core' ),
			'desc' => __( 'Controls the color of the counter "value" and icon. Leave blank for theme option styling.', 'oxo-core')
		),
		'title_size' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Counter Box Title Font Size ', 'oxo-core' ),
			'desc' => __( 'Controls the size of the title font used for the counter value. Enter the font size without \'px\'. Default is 50. Leave blank for theme option styling.', 'oxo-core')
		),
		'icon_size' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Counter Box Icon Size', 'oxo-core' ),
			'desc' => __( 'Controls the size of the icon. Enter the font size without \'px\'. Default is 50. Leave blank for theme option styling.', 'oxo-core')
		),
		'icon_top' => array(
			'std' => '',
			'type' => 'select',
			'label' => __( 'Counter Box Icon Top', 'oxo-core' ),
			'desc' => __( 'Controls the position of the icon. Select Default for theme option styling.', 'oxo-core'),
			'options' => array(
				'' => __( 'Default', 'oxo-core' ),
				'no' => __('No', 'oxo-core'),
				'yes' => __('Yes', 'oxo-core')
			)
		),
		'body_color' => array(
			'type' => 'colorpicker',
			'label' => __( 'Counter Box Body Font Color', 'oxo-core' ),
			'desc' => __( 'Controls the color of the counter body text. Leave blank for theme option styling.', 'oxo-core')
		),
		'body_size' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Counter Box Body Font Size', 'oxo-core' ),
			'desc' => __( 'Controls the size of the counter body text. Enter the font size without \'px\' ex: 13. Leave blank for theme option styling.', 'oxo-core')
		),
		'border_color' => array(
			'type' => 'colorpicker',
			'label' => __( 'Counter Box Border Color', 'oxo-core' ),
			'desc' => __( 'Controls the color of the border.', 'oxo-core')
		),
		'animation_offset' => array(
			'type' 		=> 'select',
			'std' 		=> '',
			'label' 	=> __( 'Offset of Animation', 'oxo-core' ),
			'desc' 		=> __( 'Choose when the animation should start.', 'oxo-core' ),
			'options' 	=> array(
					  			''					=> __( 'Default', 'oxo-core' ),				
								'top-into-view' 	=> __( 'Top of element hits bottom of viewport', 'oxo-core' ),
								'top-mid-of-view' 	=> __( 'Top of element hits middle of viewport', 'oxo-core' ),
								'bottom-in-view' 	=> __( 'Bottom of element enters viewport', 'oxo-core' ),
							)
		),		
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core')
		),
	),
	'shortcode' => '[counters_box columns="{{columns}}" color="{{title_color}}" title_size="{{title_size}}" icon_size="{{icon_size}}" body_color="{{body_color}}" body_size="{{body_size}}" border_color="{{border_color}}" animation_offset="{{animation_offset}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/counters_box]', // as there is no wrapper shortcode
	'popup_title' => __( 'Counters Box Shortcode', 'oxo-core' ),
	'no_preview' => true,

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'value' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Counter Value', 'oxo-core' ),
				'desc' => __( 'The number to which the counter will animate.', 'oxo-core')
			),
			'delimiter' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Delimiter Digit', 'oxo-core' ),
				'desc' => __( 'Insert a delimiter digit for better readability. ex: ,', 'oxo-core' ),
			),			
			'unit' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Counter Box Unit', 'oxo-core' ),
				'desc' => __( 'Insert a unit for the counter. ex: %', 'oxo-core' ),
			),
			'unitpos' => array(
				'type' => 'select',
				'label' => __( 'Unit Position', 'oxo-core' ),
				'desc' => __( 'Choose the positioning of the unit.', 'oxo-core' ),
				'options' => array(
					'suffix' => __('After Counter', 'oxo-core'),
					'prefix' => __('Before Counter', 'oxo-core'),
				)
			),
			'icon' => array(
				'type' => 'iconpicker',
				'label' => __( 'Icon', 'oxo-core' ),
				'desc' => __( 'Click an icon to select, click again to deselect.', 'oxo-core' ),
				'options' => $icons
			),
			'direction' => array(
				'type' => 'select',
				'label' => __( 'Counter Direction', 'oxo-core' ),
				'desc' => __( 'Choose to count up or down.', 'oxo-core' ),
				'options' => array(
					'up' => __('Count Up', 'oxo-core'),
					'down' => __('Count Down', 'oxo-core'),
				)
			),			
			'content' => array(
				'std' => __('Text', 'oxo-core'),
				'type' => 'text',
				'label' => __( 'Counter Box Text', 'oxo-core' ),
				'desc' => __( 'Insert text for counter box', 'oxo-core' ),
			)
		),
		'shortcode' => '[counter_box value="{{value}}" delimiter="{{delimiter}}" unit="{{unit}}" unit_pos="{{unitpos}}" icon="{{icon}}" direction="{{direction}}"]{{content}}[/counter_box]',
		'clone_button' => __( 'Add New Counter Box', 'oxo-core')
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Counters Circle Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['counterscircle'] = array(
	'params' => array(
		'animation_offset' => array(
			'type' 		=> 'select',
			'std' 		=> '',
			'label' 	=> __( 'Offset of Animation', 'oxo-core' ),
			'desc' 		=> __( 'Choose when the animation should start.', 'oxo-core' ),
			'options' 	=> array(
					  			''					=> __( 'Default', 'oxo-core' ),				
								'top-into-view' 	=> __( 'Top of element hits bottom of viewport', 'oxo-core' ),
								'top-mid-of-view' 	=> __( 'Top of element hits middle of viewport', 'oxo-core' ),
								'bottom-in-view' 	=> __( 'Bottom of element enters viewport', 'oxo-core' ),
							)
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core' )
		),
	),
	'shortcode' => '[counters_circle animation_offset="{{animation_offset}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/counters_circle]', // as there is no wrapper shortcode
	'popup_title' => __( 'Counters Circle Shortcode', 'oxo-core' ),
	'no_preview' => true,

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'value' => array(
				'type' => 'select',
				'label' => __( 'Filled Area Percentage', 'oxo-core' ),
				'desc' => __( 'From 1% to 100%', 'oxo-core' ),
				'options' => oxo_shortcodes_range(100, false)
			),
			'filledcolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Filled Color', 'oxo-core' ),
				'desc' => __( 'Controls the color of the filled in area. Leave blank for theme option selection.', 'oxo-core')
			),
			'unfilledcolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Unfilled Color', 'oxo-core' ),
				'desc' => __( 'Controls the color of the unfilled in area. Leave blank for theme option selection.', 'oxo-core')
			),
			'size' => array(
				'std' => '220',
				'type' => 'text',
				'label' => __( 'Size of the Counter', 'oxo-core' ),
				'desc' => __( 'Insert size of the counter in px. ex: 220', 'oxo-core' ),
			),
			'scales' => array(
				'type' => 'select',
				'label' => __( 'Show Scales', 'oxo-core' ),
				'desc' => __( 'Choose to show a scale around circles.', 'oxo-core' ),
				'options' => $reverse_choices
			),		
			'countdown' => array(
				'type' => 'select',
				'label' => __( 'Countdown', 'oxo-core' ),
				'desc' => __( 'Choose to let the circle filling move counter clockwise.', 'oxo-core' ),
				'options' => $reverse_choices
			),					
			'speed' => array(
				'std' => '1500',
				'type' => 'text',
				'label' => __( 'Animation Speed', 'oxo-core' ),
				'desc' => __( 'Insert animation speed in milliseconds', 'oxo-core' ),
			),
			'content' => array(
				'std' => __('Text', 'oxo-core'),
				'type' => 'text',
				'label' => __( 'Counter Circle Text', 'oxo-core' ),
				'desc' => __( 'Insert text for counter circle box, keep it short', 'oxo-core' ),
			),			
		),
		'shortcode' => '[counter_circle filledcolor="{{filledcolor}}" unfilledcolor="{{unfilledcolor}}" size="{{size}}" scales="{{scales}}" countdown="{{countdown}}" speed="{{speed}}" value="{{value}}"]{{content}}[/counter_circle]',
		'clone_button' => __( 'Add New Counter Circle', 'oxo-core')
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Dropcap Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['dropcap'] = array(
	'no_preview' => true,
	'params' => array(
		'content' => array(
			'std' => 'A',
			'type' => 'textarea',
			'label' => __( 'Dropcap Letter', 'oxo-core' ),
			'desc' => __( 'Add the letter to be used as dropcap', 'oxo-core' ),
		),
		'color' => array(
			'type' => 'colorpicker',
			'label' => __( 'Color', 'oxo-core' ),
			'desc' => __( 'Controls the color of the dropcap letter. Leave blank for theme option selection.', 'oxo-core ')
		),		
		'boxed' => array(
			'type' => 'select',
			'label' => __( 'Boxed Dropcap', 'oxo-core' ),
			'desc' => __( 'Choose to get a boxed dropcap.', 'oxo-core' ),
			'options' => $reverse_choices
		),
		'boxedradius' => array(
			'std' => '8px',
			'type' => 'text',
			'label' => __( 'Box Radius', 'oxo-core' ),
			'desc' => __('Choose the radius of the boxed dropcap. In pixels (px), ex: 1px, or "round".', 'oxo-core')
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core')
		),
	),
	'shortcode' => '[dropcap color="{{color}}" boxed="{{boxed}}" boxed_radius="{{boxedradius}}" class="{{class}}" id="{{id}}"]{{content}}[/dropcap]',
	'popup_title' => __( 'Dropcap Shortcode', 'oxo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Events Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['events'] = array(  
	'params' => array(
		'cat_slug' => array(
			'std' => '',
			'type' => 'select',
			'label' => __( 'Categories', 'oxo-core' ),
			'desc' =>  __( 'Select a category or leave blank for all', 'oxo-core' ),
			'options' => oxo_shortcodes_categories( 'tribe_events_cat', true, 'All' )
		),
		'number_posts' => array(
			'std' => '4',
			'type' => 'text',
			'label' => __( 'Number of Events', 'oxo-core' ),
			'desc' => __('Select the number of events to display', 'oxo-core')
		),
		'columns' => array(
			'std' => 4,
			'type' => 'select',
			'label' => __( 'Number of Columns', 'oxo-core' ),
			'desc' =>  __( 'Select the number of max columns to display.', 'oxo-core' ),
			'options' => oxo_shortcodes_range( 6, false )
		),
		'picture_size' => array(
			'std' => 'cover',
			'type' => 'select',
			'label' => __( 'Picture Size', 'oxo-core' ),
			'desc' => __( 'cover = image will scale to cover the container<br />auto = width and height will adjust to the image.', 'oxo-core'),
			'options' => array(
				'cover' 	=> __( 'Cover', 'oxo-core' ),
				'auto' 		=> __('Auto', 'oxo-core'),
			)
		),
		'picture_size' => array(
			'std' => 'cover',
			'type' => 'select',
			'label' => __( 'Picture Size', 'oxo-core' ),
			'desc' => __( 'cover = image will scale to cover the container<br />auto = width and height will adjust to the image.', 'oxo-core'),
			'options' => array(
				'cover' 	=> __( 'Cover', 'oxo-core' ),
				'auto' 		=> __('Auto', 'oxo-core'),
			)
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core')
		),
	),
	'shortcode' => '[oxo_events cat_slug="{{cat_slug}}" number_posts="{{number_posts}}" columns="{{columns}}" picture_size="{{picture_size}}" class="{{class}}" id="{{id}}"][/oxo_events]', // as there is no wrapper shortcode
	'popup_title' => __( 'Events Shortcode', 'oxo-core' ),
	'no_preview' => true
);

/*-----------------------------------------------------------------------------------*/
/*	Post Slider Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['postslider'] = array(
	'no_preview' => true,
	'params' => array(

		'type' => array(
			'type' => 'select',
			'label' => __( 'Layout', 'oxo-core' ),
			'desc' => __( 'Choose a layout style for Post Slider.', 'oxo-core' ),
			'options' => array(
				'posts' => __('Posts with Title', 'oxo-core'),
				'posts-with-excerpt' => __('Posts with Title and Excerpt', 'oxo-core'),
				'attachments' => __('Attachment Layout, Only Images Attached to Post/Page', 'oxo-core')
			)
		),
		'excerpt' => array(
			'std' => 35,
			'type' => 'text',
			'label' => __( 'Excerpt Number of Words', 'oxo-core' ),
			'desc' => __( 'Insert the number of words you want to show in the excerpt.', 'oxo-core' ),
		),
		'category' => array(
			'std' => 35,
			'type' => 'select',
			'label' => __( 'Category', 'oxo-core' ),
			'desc' => __( 'Select a category of posts to display.', 'oxo-core' ),
			'options' => oxo_shortcodes_categories( 'category', true, 'All' )
		),
		'limit' => array(
			'std' => 3,
			'type' => 'text',
			'label' => __( 'Number of Slides', 'oxo-core' ),
			'desc' => __( 'Select the number of slides to display.', 'oxo-core' )
		),
		'lightbox' => array(
			'type' => 'select',
			'label' => __( 'Lightbox on Click', 'oxo-core' ),
			'desc' => __( 'Only works on attachment layout.', 'oxo-core' ),
			'options' => $choices
		),
		'image' => array(
			'type' => 'gallery',
			'label' => __( 'Attach Images to Post/Page Gallery', 'oxo-core' ),
			'desc' => __( 'Only works for attachments layout.', 'oxo-core' ),
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core')
		),		
	),
	'shortcode' => '[postslider layout="{{type}}" excerpt="{{excerpt}}" category="{{category}}" limit="{{limit}}" id="" lightbox="{{lightbox}}" class="{{class}}" id="{{id}}"][/postslider]',
	'popup_title' => __( 'Post Slider Shortcode', 'oxo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Flip Boxes Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['flipboxes'] = array(
	'params' => array(

		'columns' => array(
			'std' => 4,
			'type' => 'select',
			'label' => __( 'Number of Columns', 'oxo-core' ),
			'desc' =>  __( 'Set the number of columns per row.', 'oxo-core' ),
			'options' => oxo_shortcodes_range( 6, false )
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core' )
		),			
	),
	'shortcode' => '[flip_boxes columns="{{columns}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/flip_boxes]', // as there is no wrapper shortcode
	'popup_title' => __( 'Flip Boxes Shortcode', 'oxo-core' ),
	'no_preview' => true,

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'titlefront' => array(
				'std' => __('Your Content Goes Here', 'oxo-core'),
				'type' => 'text',
				'label' => __( 'Flip Box Frontside Heading', 'oxo-core' ),
				'desc' => __( 'Add a heading for the frontside of the flip box.', 'oxo-core' ),
			),			
			'titleback' => array(
				'std' => __('Your Content Goes Here', 'oxo-core'),
				'type' => 'text',
				'label' => __( 'Flip Box Backside Heading', 'oxo-core' ),
				'desc' => __( 'Add a heading for the backside of the flip box.', 'oxo-core' ),
			),			
			'textfront' => array(
				'std' => __('Your Content Goes Here', 'oxo-core'),
				'type' => 'textarea',
				'label' => __( 'Flip Box Frontside Content', 'oxo-core' ),
				'desc' => __( 'Add content for the frontside of the flip box.', 'oxo-core' ),
			),			
			'content' => array(
				'std' => __('Your Content Goes Here', 'oxo-core'),
				'type' => 'textarea',
				'label' => __( 'Flip Box Backside Content', 'oxo-core' ),
				'desc' => __( 'Add content for the backside of the flip box.', 'oxo-core' ),
			),		
			'backgroundcolorfront' => array(
				'type' => 'colorpicker',
				'label' => __( 'Background Color Frontside', 'oxo-core' ),
				'desc' => __( 'Controls the background color of the frontside. Leave blank for theme option selection. NOTE: flip boxes must have background colors to work correctly in all browsers.', 'oxo-core' )
			),
			'titlecolorfront' => array(
				'type' => 'colorpicker',
				'label' => __( 'Heading Color Frontside', 'oxo-core' ),
				'desc' => __( 'Controls the heading color of the frontside. Leave blank for theme option selection.', 'oxo-core' )
			),
			'textcolorfront' => array(
				'type' => 'colorpicker',
				'label' => __( 'Text Color Frontside', 'oxo-core' ),
				'desc' => __( 'Controls the text color of the frontside. Leave blank for theme option selection.', 'oxo-core' )
			),			
			'backgroundcolorback' => array(
				'type' => 'colorpicker',
				'label' => __( 'Background Color Backside', 'oxo-core' ),
				'desc' => __( 'Controls the background color of the backside. Leave blank for theme option selection. NOTE: flip boxes must have background colors to work correctly in all browsers.', 'oxo-core' )
			),
			'titlecolorback' => array(
				'type' => 'colorpicker',
				'label' => __( 'Heading Color Backside', 'oxo-core' ),
				'desc' => __( 'Controls the heading color of the backside. Leave blank for theme option selection.', 'oxo-core' )
			),				
			'textcolorback' => array(
				'type' => 'colorpicker',
				'label' => __( 'Text Color Backside', 'oxo-core' ),
				'desc' => __( 'Controls the text color of the backside. Leave blank for theme option selection.', 'oxo-core' )
			),			
			'bordersize' => array(
				'std' => '1px',
				'type' => 'text',
				'label' => __( 'Border Size', 'oxo-core' ),
				'desc' => __( 'In pixels (px), ex: 1px. Leave blank for theme option selection.', 'oxo-core' ),
			),
			'bordercolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Border Color', 'oxo-core' ),
				'desc' => __( 'Controls the border color. Leave blank for theme option selection.', 'oxo-core' )
			),
			'borderradius' => array(
				'std' => '4px',
				'type' => 'text',
				'label' => __( 'BorderRadius', 'oxo-core' ),
				'desc' => __( 'Controls the flip box border radius. In pixels (px), ex: 1px, or "round".  Leave blank for theme option selection.', 'oxo-core' ),
			),			
			'icon' => array(
				'type' => 'iconpicker',
				'label' => __( 'Icon', 'oxo-core' ),
				'desc' => __( 'Click an icon to select, click again to deselect.', 'oxo-core' ),
				'options' => $icons
			),			
			'iconcolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Icon Color', 'oxo-core' ),
				'desc' => __( 'Controls the color of the icon. Leave blank for theme option selection.', 'oxo-core' )
			),
			'circle' => array(
				'std' => 0,
				'type' => 'select',
				'label' => __( 'Icon Circle', 'oxo-core' ),
				'desc' => __( 'Choose to use a circled background on the icon.', 'oxo-core' ),
				'options' => $choices
			),			
			'circlecolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Icon Circle Background Color', 'oxo-core' ),
				'desc' => __( 'Controls the color of the circle. Leave blank for theme option selection.', 'oxo-core')
			),
			'circlebordercolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Icon Circle Border Color', 'oxo-core' ),
				'desc' => __( 'Controls the color of the circle border. Leave blank for theme option selection.', 'oxo-core')
			),
			'iconrotate' => array(
				'type' => 'select',
				'label' => __( 'Rotate Icon', 'oxo-core' ),
				'desc' => __( 'Choose to rotate the icon.', 'oxo-core' ),
				'options' => array(
					''	=> __('None', 'oxo-core'),
					'90' => '90',
					'180' => '180',
					'270' => '270',					
				)
			),				
			'iconspin' => array(
				'type' => 'select',
				'label' => __( 'Spinning Icon', 'oxo-core' ),
				'desc' => __( 'Choose to let the icon spin.', 'oxo-core' ),
				'options' => $reverse_choices
			),									
			'image' => array(
				'type' => 'uploader',
				'label' => __( 'Icon Image', 'oxo-core' ),
				'desc' => __( 'To upload your own icon image, deselect the icon above and then upload your icon image.', 'oxo-core' ),
			),
			'image_width' => array(
				'std' => 35,
				'type' => 'text',
				'label' => __( 'Icon Image Width', 'oxo-core' ),
				'desc' => __( 'If using an icon image, specify the image width in pixels but do not add px, ex: 35.', 'oxo-core' ),
			),
			'image_height' => array(
				'std' => 35,
				'type' => 'text',
				'label' => __( 'Icon Image Height', 'oxo-core' ),
				'desc' => __( 'If using an icon image, specify the image height in pixels but do not add px, ex: 35.', 'oxo-core' ),
			),
			'animation_type' => array(
				'type' => 'select',
				'label' => __( 'Animation Type', 'oxo-core' ),
				'desc' => __( 'Select the type of animation to use on the shortcode', 'oxo-core' ),
				'options' => $animation_type,
			),
			'animation_direction' => array(
				'type' => 'select',
				'label' => __( 'Direction of Animation', 'oxo-core' ),
				'desc' => __( 'Select the incoming direction for the animation', 'oxo-core' ),
				'options' => $animation_direction,
			),
			'animation_speed' => array(
				'type' => 'select',
				'std' => '',
				'label' => __( 'Speed of Animation', 'oxo-core' ),
				'desc' => __( 'Type in speed of animation in seconds (0.1 - 1).', 'oxo-core' ),
				'options' => $dec_numbers,
			),
			'animation_offset' => array(
				'type' 		=> 'select',
				'std' 		=> '',
				'label' 	=> __( 'Offset of Animation', 'oxo-core' ),
				'desc' 		=> __( 'Choose when the animation should start.', 'oxo-core' ),
				'options' 	=> array(
					  				''					=> __( 'Default', 'oxo-core' ),					
									'top-into-view' 	=> __( 'Top of element hits bottom of viewport', 'oxo-core' ),
									'top-mid-of-view' 	=> __( 'Top of element hits middle of viewport', 'oxo-core' ),
									'bottom-in-view' 	=> __( 'Bottom of element enters viewport', 'oxo-core' ),
								)
			),			
		),
		'shortcode' => '[flip_box title_front="{{titlefront}}" title_back="{{titleback}}" text_front="{{textfront}}" border_color="{{bordercolor}}" border_radius="{{borderradius}}" border_size="{{bordersize}}" background_color_front="{{backgroundcolorfront}}" title_front_color="{{titlecolorfront}}" text_front_color="{{textcolorfront}}" background_color_back="{{backgroundcolorback}}" title_back_color="{{titlecolorback}}" text_back_color="{{textcolorback}}" icon="{{icon}}" icon_color="{{iconcolor}}" circle="{{circle}}" circle_color="{{circlecolor}}" circle_border_color="{{circlebordercolor}}" icon_rotate="{{iconrotate}}" icon_spin="{{iconspin}}" image="{{image}}" image_width="{{image_width}}" image_height="{{image_height}}" animation_type="{{animation_type}}" animation_direction="{{animation_direction}}" animation_speed="{{animation_speed}}" animation_offset="{{animation_offset}}"]{{content}}[/flip_box]',
		'clone_button' => __( 'Add New Flip Box', 'oxo-core')
	)
);


/*-----------------------------------------------------------------------------------*/
/*	FontAwesome Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['fontawesome'] = array(
	'no_preview' => true,
	'params' => array(

		'icon' => array(
			'type' => 'iconpicker',
			'label' => __( 'Select Icon', 'oxo-core' ),
			'desc' => __( 'Click an icon to select, click again to deselect.', 'oxo-core' ),
			'options' => $icons
		),
		'circle' => array(
			'type' => 'select',
			'label' => __( 'Icon in Circle', 'oxo-core' ),
			'desc' => __( 'Choose to display the icon in a circle.', 'oxo-core' ),
			'options' => $choices
		),
		'size' => array(
			'std' => '13px',
			'type' => 'text',
			'label' => __( 'Icon Size', 'oxo-core' ),
			'desc' => __( 'Set the size of the icon. In pixels (px), ex: 13px.', 'oxo-core' ),
		),			
		'iconcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Icon Color', 'oxo-core' ),
			'desc' => __( 'Controls the color of the icon. Leave blank for theme option selection.', 'oxo-core')
		),
		'circlecolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Icon Circle Background Color', 'oxo-core' ),
			'desc' => __( 'Controls the color of the circle. Leave blank for theme option selection.', 'oxo-core')
		),
		'circlebordercolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Icon Circle Border Color', 'oxo-core' ),
			'desc' => __( 'Controls the color of the circle border. Leave blank for theme option selection.', 'oxo-core')
		),
		'rotate' => array(
			'type' => 'select',
			'label' => __( 'Rotate Icon', 'oxo-core' ),
			'desc' => __( 'Choose to rotate the icon.', 'oxo-core' ),
			'options' => array(
				''	=> __('None', 'oxo-core'),
				'90' => '90',
				'180' => '180',
				'270' => '270',					
			)
		),				
		'spin' => array(
			'type' => 'select',
			'label' => __( 'Spinning Icon', 'oxo-core' ),
			'desc' => __( 'Choose to let the icon spin.', 'oxo-core' ),
			'options' => $reverse_choices
		),		
		'animation_type' => array(
			'type' => 'select',
			'label' => __( 'Animation Type', 'oxo-core' ),
			'desc' => __( 'Select the type of animation to use on the shortcode', 'oxo-core' ),
			'options' => $animation_type,
		),
		'animation_direction' => array(
			'type' => 'select',
			'label' => __( 'Direction of Animation', 'oxo-core' ),
			'desc' => __( 'Select the incoming direction for the animation', 'oxo-core' ),
			'options' => $animation_direction,
		),
		'animation_speed' => array(
			'type' => 'select',
			'std' => '',
			'label' => __( 'Speed of Animation', 'oxo-core' ),
			'desc' => __( 'Type in speed of animation in seconds (0.1 - 1).', 'oxo-core' ),
			'options' => $dec_numbers,
		),
		'animation_offset' => array(
			'type' 		=> 'select',
			'std' 		=> '',
			'label' 	=> __( 'Offset of Animation', 'oxo-core' ),
			'desc' 		=> __( 'Choose when the animation should start.', 'oxo-core' ),
			'options' 	=> array(
					  			''					=> __( 'Default', 'oxo-core' ),				
								'top-into-view' 	=> __( 'Top of element hits bottom of viewport', 'oxo-core' ),
								'top-mid-of-view' 	=> __( 'Top of element hits middle of viewport', 'oxo-core' ),
								'bottom-in-view' 	=> __( 'Bottom of element enters viewport', 'oxo-core' ),
							)
		),		
		'alignment' => array(
			'type' => 'select',
			'std' => '',
			'label' => __( 'Alignment', 'oxo-core' ),
			'desc' => __( 'Select the icon\'s alignment.', 'oxo-core' ),
			'options' => array(
				'left' => __('Left', 'oxo-core'),
				'center' => __('Center', 'oxo-core'),
				'right' => __('Right', 'oxo-core'),
			)
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core')
		),		
	),
	'shortcode' => '[fontawesome icon="{{icon}}" circle="{{circle}}" size="{{size}}" iconcolor="{{iconcolor}}" circlecolor="{{circlecolor}}" circlebordercolor="{{circlebordercolor}}" rotate="{{rotate}}" spin="{{spin}}" animation_type="{{animation_type}}" animation_direction="{{animation_direction}}" animation_speed="{{animation_speed}}" animation_offset="{{animation_offset}}" alignment="{{alignment}}" class="{{class}}" id="{{id}}"]',
	'popup_title' => __( 'Font Awesome Shortcode', 'oxo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Fullwidth Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['fullwidth'] = array(
	'no_preview' => true,
	'params' => array(
		'background_color' => array(
			'type' => 'colorpicker',
			"group" => __( 'Background', 'oxo-core' ),
			'label' => __( 'Background Color', 'oxo-core' ),
			'desc' => __( 'Controls the background color.  Leave blank for theme option selection.', 'oxo-core')
		),
		'background_image' => array(
			'type' => 'uploader',
			'label' => __( 'Background Image', 'oxo-core' ),
			"group" => __( 'Background', 'oxo-core' ),
			"data"  => array(
				"replace" => "oxo-hidden-img"
			),
			'desc' => __('Upload an image to display in the background', 'oxo-core')
		),
		'background_parallax' => array(
			'type' => 'select',
			'label' => __( 'Background Parallax', 'oxo-core' ),
			'desc' => __( 'Choose how the background image scrolls and responds.', 'oxo-core' ),
			"group"         => __( 'Background', 'oxo-core' ),
			'std' => 'none',
			'options' => array(
				'none'  => __( 'No Parallax (no effects)', 'oxo-core' ),
				'fixed' => __( 'Fixed (fixed on desktop, non-fixed on mobile)', 'oxo-core' ),
				'up'    => __( 'Up (moves up on desktop & mobile)', 'oxo-core' ),
				'down'  => __( 'Down (moves down on desktop & mobile)', 'oxo-core' ),
				'left'  => __( 'Left (moves left on desktop & mobile)', 'oxo-core' ),
				'right' => __( 'Right (moves right on desktop & mobile)', 'oxo-core' ),				
				//'hover' => __( 'Hover', 'oxo-core' ),
			)
		),
		'enable_mobile' => array(
			'type' => 'select',
			'label' => __( 'Enable Parallax on Mobile', 'oxo-core' ),
			'desc' => __( 'Works for up/down/left/right only. Parallax effects would most probably cause slowdowns when your site is viewed in mobile devices. If the device width is less than 980 pixels, then it is assumed that the site is being viewed in a mobile device.', 'oxo-core' ),
			"group"         => __( 'Background', 'oxo-core' ),
			'std' => 'no',
			'options' => array(
				'no'  => __( 'No', 'oxo-core' ),
				'yes' => __( 'Yes', 'oxo-core' ),
			)
		),		
		'parallax_speed' => array(
			'type' => 'select',
			"group" => __( 'Background', 'oxo-core' ),
			'label' => __( 'Parallax Speed', 'oxo-core' ),
			'desc' => __( 'The movement speed, value should be between 0.1 and 1.0. A lower number means slower scrolling speed. Higher scrolling speeds will enlarge the image more.', 'oxo-core' ),
			'options' => $dec_numbers,
			'std' => '',		
		),

		'background_repeat' => array(
			'type' => 'select',
			'label' => __( 'Background Repeat', 'oxo-core' ),
			'desc' => __('Choose how the background image repeats.', 'oxo-core'),
			"group"         => __( 'Background', 'oxo-core' ),
			"std"         => "no-repeat",
			'options' => array(
				'no-repeat' => __('No Repeat', 'oxo-core'),
				'repeat' => __('Repeat Vertically and Horizontally', 'oxo-core'),
				'repeat-x' => __('Repeat Horizontally', 'oxo-core'),
				'repeat-y' => __('Repeat Vertically', 'oxo-core')
			)
		),
		'background_position' => array(
			'type' => 'select',
			'label' => __( 'Background Position', 'oxo-core' ),
			"group"         => __( 'Background', 'oxo-core' ),
			'desc' => __('Choose the postion of the background image', 'oxo-core'),
			"std"         => "left top",
			'options' => array(
				'left top' => __('Left Top', 'oxo-core'),
				'left center' => __('Left Center', 'oxo-core'),
				'left bottom' => __('Left Bottom', 'oxo-core'),
				'right top' => __('Right Top', 'oxo-core'),
				'right center' => __('Right Center', 'oxo-core'),
				'right bottom' => __('Right Bottom', 'oxo-core'),
				'center top' => __('Center Top', 'oxo-core'),
				'center center' => __('Center Center', 'oxo-core'),
				'center bottom' => __('Center Bottom', 'oxo-core')
			)
		),
		'video_url' => array(
			'type' => 'text',
			'label' => __( 'YouTube/Vimeo Video URL or ID', 'oxo-core' ),
			'desc' => __( "Enter the URL to the video or the video ID of your YouTube or Vimeo video you want to use as your background. If your URL isn't showing a video, try inputting the video ID instead. <small>Ads will show up in the video if it has them.</small>", 'oxo-core' ),
			"note"  => __( "Tip: newly uploaded videos may not display right away and might show an error message.", "" ) . '<br />' . __( "Videos will not show up in mobile devices because they handle videos differently. In those cases, please provide a preview background image and that will be shown instead.", 'oxo-core' ),
			"group" => __( 'Background', 'oxo-core' ),
		),
		'video_aspect_ratio' => array(
			'type' => 'text',
			'label' => __( 'Video Aspect Ratio', 'oxo-core' ),
			'desc' => __( "The video will be resized to maintain this aspect ratio, this is to prevent the video from showing any black bars. Enter an aspect ratio here such as: &quot;16:9&quot;, &quot;4:3&quot; or &quot;16:10&quot;. The default is &quot;16:9&quot;", 'oxo-core' ),
			"group" => __( 'Background', 'oxo-core' ),
			'std' => '16:9',
		),
		'video_webm' => array(
			'type' => 'text',
			'label' => __( 'Video WebM Upload', 'oxo-core' ),
			'desc' => __('Video must be in a 16:9 aspect ratio. Add your WebM video file. WebM and MP4 format must be included to render your video with cross browser compatibility. OGV is optional.', 'oxo-core'),
		),
		'video_mp4' => array(
			'type' => 'text',
			'label' => __( 'Video MP4 Upload', 'oxo-core' ),
			'desc' => __('Video must be in a 16:9 aspect ratio. Add your MP4 video file. MP4 and WebM format must be included to render your video with cross browser compatibility. OGV is optional.', 'oxo-core'),
		),
		'video_ogv' => array(
			'type' => 'text',
			'label' => __( 'Video OGV Upload', 'oxo-core' ),
			'desc' => __('Add your OGV video file. This is optional.', 'oxo-core'),
		),
		'video_preview_image' => array(
			'type' => 'uploader',
			'label' => __( 'Video Preview Image', 'oxo-core' ),
			'desc' => __('IMPORTANT: Video backgrounds will not auto play on mobile and tablet devices or older browsers. Instead, you should insert a preview image in this field and it will be seen in place of your video.', 'oxo-core')
		),
		'overlay_color' => array(
			'type' => 'colorpicker',
			'label' => __( 'Video Overlay Color', 'oxo-core' ),
			'desc' => __('Select a color to show over the video as an overlay. Hex color code, <strong>ex: #fff</strong>', 'oxo-core'),
		),
		'overlay_opacity' => array(
			'type' => 'text',
			'label' => __( 'Video Overlay Opacity', 'oxo-core' ),
			'desc' => __('Opacity ranges between 0 (transparent) and 1 (opaque). ex: .4', 'oxo-core'),
			'std' => '0.5'
		),
		'video_mute' => array(
			'type' => 'select',
			'label' => __( 'Mute Video', 'oxo-core' ),
			'desc' => '',
			'std' => 'yes',
			'options' => array(
				'yes' => __('Yes', 'oxo-core'),
				'no' => __('No', 'oxo-core'),
			)
		),
		'video_loop' => array(
			'std' => 'yes',
			'type' => 'select',
			'label' => __( 'Loop Video', 'oxo-core' ),
			'desc' => '',
			'options' => array(
				'yes' => __('Yes', 'oxo-core'),
				'no' => __('No', 'oxo-core'),
			)
		),
		'fade' => array(
			'type' => 'select',
			'label' => __( 'Fading Animation', 'oxo-core' ),
			'desc' => __('Choose to have the background image fade and blur on scroll. WARNING: Only works for images. This will cause video backgrounds to not display. ', 'oxo-core'),
			'options' => array(
				'no' => __('No', 'oxo-core'),
				'yes' => __('Yes', 'oxo-core')
			)
		),
		'border_size' => array(
			'std' => '0px',
			'type' => 'text',
			'label' => __( 'Border Size', 'oxo-core' ),
			'desc' => __( 'In pixels (px), ex: 1px. Leave blank for theme option selection.', 'oxo-core' ),
		),
		'border_color' => array(
			'type' => 'colorpicker',
			'label' => __( 'Border Color', 'oxo-core' ),
			'desc' => __( 'Controls the border color.  Leave blank for theme option selection.', 'oxo-core')
		),
		'border_style' => array(
			'type' => 'select',
			'label' => __( 'Border Style', 'oxo-core' ),
			'desc' => __( 'Controls the border style.', 'oxo-core' ),
			'std' => 'solid',
			'options' => array(
				'solid' => __('Solid', 'oxo-core'),
				'dashed' => __('Dashed', 'oxo-core'),
				'dotted' => __('Dotted', 'oxo-core')
			)			
		),		
		'padding_top' => array(
			'std' => 20,
			'type' => 'text',
			'label' => __( 'Padding Top', 'oxo-core' ),
			'desc' => __( 'In pixels or percentage, ex: 10px or 10%.', 'oxo-core' )
		),
		'padding_bottom' => array(
			'std' => 20,
			'type' => 'text',
			'label' => __( 'Padding Bottom', 'oxo-core' ),
			'desc' => __( 'In pixels or percentage, ex: 10px or 10%.', 'oxo-core' )
		),
		'padding_left' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Padding Left', 'oxo-core' ),
			'desc' => __( 'In pixels or percentage, ex: 10px or 10%.', 'oxo-core' )
		),
		'padding_right' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Padding Right', 'oxo-core' ),
			'desc' => __( 'In pixels or percentage, ex: 10px or 10%.', 'oxo-core' )
		),		
		'menu_anchor' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Name Of Menu Anchor', 'oxo-core' ),
			'desc' => __('This name will be the id you will have to use in your one page menu.', 'oxo-core'),
		),
		'equal_height_columns' => array(
			'type' => 'select',
			'label' => __( 'Set Columns to Equal Height', 'oxo-core' ),
			'desc' => __('Select to set all column shortcodes that are used inside the container to have equal height.', 'oxo-core'),
			'options' => array(
				'no' => __('No', 'oxo-core'),
				'yes' => __('Yes', 'oxo-core'),
			)
		),		
		'hundred_percent' => array(
			'type' => 'select',
			'label' => __( '100% Interior Content Width', 'oxo-core' ),
			'desc' => __('Select if the interior content is contained to site width or 100% width.', 'oxo-core'),
			'options' => array(
				'no' => __('No', 'oxo-core'),
				'yes' => __('Yes', 'oxo-core'),
			)
		),
		'content' => array(
			'std' => __('Your Content Goes Here', 'oxo-core'),
			'type' => 'textarea',
			'label' => __( 'Content', 'oxo-core' ),
			'desc' => __( 'Add content', 'oxo-core' ),
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core')
		),			
	),
	'shortcode' => '[fullwidth background_color="{{background_color}}" background_image="{{background_image}}" background_parallax="{{background_parallax}}" parallax_speed="{{parallax_speed}}" enable_mobile="{{enable_mobile}}" background_repeat="{{background_repeat}}" background_position="{{background_position}}" video_url="{{video_url}}" video_aspect_ratio="{{video_aspect_ratio}}" video_webm="{{video_webm}}" video_mp4="{{video_mp4}}" video_ogv="{{video_ogv}}" video_preview_image="{{video_preview_image}}" overlay_color="{{overlay_color}}" overlay_opacity="{{overlay_opacity}}" video_mute="{{video_mute}}" video_loop="{{video_loop}}" fade="{{fade}}" border_size="{{border_size}}" border_color="{{border_color}}" border_style="{{border_style}}" padding_top="{{padding_top}}" padding_bottom="{{padding_bottom}}" padding_left="{{padding_left}}" padding_right="{{padding_right}}" hundred_percent="{{hundred_percent}}" equal_height_columns="{{equal_height_columns}}" menu_anchor="{{menu_anchor}}" class="{{class}}" id="{{id}}"]{{content}}[/fullwidth]',
	'popup_title' => __( 'Fullwidth Shortcode', 'oxo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Google Map Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['googlemap'] = array(
	'no_preview' => true,
	'params' => array(
		'type' => array(
			'type' => 'select',
			'label' => __( 'Map Type', 'oxo-core' ),
			'desc' => __( 'Select the type of google map to display.', 'oxo-core' ),
			'options' => array(
				'roadmap' => __('Roadmap', 'oxo-core'),
				'satellite' => __('Satellite', 'oxo-core'),
				'hybrid' => __('Hybrid', 'oxo-core'),
				'terrain' => __('Terrain', 'oxo-core')
			)
		),
		'width' => array(
			'std' => '100%',
			'type' => 'text',
			'label' => __( 'Map Width', 'oxo-core' ),
			'desc' => __( 'Map width in percentage or pixels. ex: 100%, or 940px.', 'oxo-core')
		),
		'height' => array(
			'std' => '300px',
			'type' => 'text',
			'label' => __( 'Map Height', 'oxo-core' ),
			'desc' => __( 'Map height in pixels. ex: 300px', 'oxo-core')
		),
		'zoom' => array(
			'std' => 14,
			'type' => 'select',
			'label' => __( 'Zoom Level', 'oxo-core' ),
			'desc' => __( 'Higher number will be more zoomed in.', 'oxo-core' ),
			'options' => oxo_shortcodes_range( 25, false )
		),
		'scrollwheel' => array(
			'type' => 'select',
			'label' => __( 'Scrollwheel on Map', 'oxo-core' ),
			'desc' => __( 'Enable zooming using a mouse\'s scroll wheel.', 'oxo-core' ),
			'options' => $choices
		),
		'scale' => array(
			'type' => 'select',
			'label' => __( 'Show Scale Control on Map', 'oxo-core' ),
			'desc' => __( 'Display the map scale.', 'oxo-core' ),
			'options' => $choices
		),
		'zoom_pancontrol' => array(
			'type' => 'select',
			'label' => __( 'Show Pan Control on Map', 'oxo-core' ),
			'desc' => __( 'Displays pan control button.', 'oxo-core' ),
			'options' => $choices
		),
		'animation' => array(
			'type' => 'select',
			'label' => __( 'Address Pin Animation', 'oxo-core' ),
			'desc' => __( 'Choose to animate the address pins when the map first loads.', 'oxo-core' ),
			'options' => $choices
		),		
		'popup' => array(
			'type' => 'select',
			'label' => __( 'Show tooltip by default', 'oxo-core' ),
			'desc' => __( 'Display or hide the tooltip when the map first loads.', 'oxo-core' ),
			'options' => $choices
		),
		'mapstyle' => array(
			'type' => 'select',
			'label' => __( 'Select the Map Styling', 'oxo-core' ),
			'desc' => __( 'Choose default styling for classic google map styles. Choose theme styling for our custom style. Choose custom styling to make your own with the advanced options below.', 'oxo-core' ),
			'options' => array(
				'default' => __('Default Styling', 'oxo-core'),
				'theme' => __('Theme Styling', 'oxo-core'),
				'custom' => __('Custom Styling', 'oxo-core'),
			)
		),	
		'overlaycolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Map Overlay Color', 'oxo-core' ),
			'desc' => __( 'Custom styling setting only. Pick an overlaying color for the map. Works best with "roadmap" type.', 'oxo-core')
		),
		'infobox' => array(
			'type' => 'select',
			'label' => __( 'Infobox Styling', 'oxo-core' ),
			'desc' => __( 'Custom styling setting only. Choose between default or custom info box.', 'oxo-core' ),
			'options' => array(
				'default' => __('Default Infobox', 'oxo-core'),
				'custom' => __('Custom Infobox', 'oxo-core'),
			)
		),
		'infoboxcontent' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Infobox Content', 'oxo-core' ),
			'desc' => __( 'Custom styling setting only. Type in custom info box content to replace address string. For multiple addresses, separate info box contents by using the | symbol. ex: InfoBox 1|InfoBox 2|InfoBox 3.', 'oxo-core' ),
		),		
		'infoboxtextcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Info Box Text Color', 'oxo-core' ),
			'desc' => __( 'Custom styling setting only. Pick a color for the info box text.', 'oxo-core')
		),
		'infoboxbackgroundcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Info Box Background Color', 'oxo-core' ),
			'desc' => __( 'Custom styling setting only. Pick a color for the info box background.', 'oxo-core')
		),
		'icon' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Custom Marker Icon', 'oxo-core' ),
			'desc' => __( 'Custom styling setting only. Use full image urls for custom marker icons or input "theme" for our custom marker. For multiple addresses, separate icons by using the | symbol or use one for all. ex: Icon 1|Icon 2|Icon 3', 'oxo-core' ),
		),
		'content' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Address', 'oxo-core' ),
			'desc' => __( 'Add your address to the location you wish to show on the map. If the location is off, please try to use long/lat coordinates with latlng=. ex: latlng=12.381068,-1.492711. For multiple addresses, separate addresses by using the | symbol. ex: Address 1|Address 2|Address 3', 'oxo-core' ),
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core' ),
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core' ),
		)
	),
	'shortcode' => '[map address="{{content}}" type="{{type}}" map_style="{{mapstyle}}" overlay_color="{{overlaycolor}}" infobox="{{infobox}}" infobox_background_color="{{infoboxbackgroundcolor}}" infobox_text_color="{{infoboxtextcolor}}" infobox_content="{{infoboxcontent}}" icon="{{icon}}" width="{{width}}" height="{{height}}" zoom="{{zoom}}" scrollwheel="{{scrollwheel}}" scale="{{scale}}" zoom_pancontrol="{{zoom_pancontrol}}" popup="{{popup}}" animation="{{animation}}" class="{{class}}" id="{{id}}"][/map]',
	'popup_title' => __( 'Google Map Shortcode', 'oxo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Highlight Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['highlight'] = array(
	'no_preview' => true,
	'params' => array(

		'color' => array(
			'type' => 'colorpicker',
			'label' => __( 'Highlight Color', 'oxo-core' ),
			'desc' => __( 'Pick a highlight color', 'oxo-core')
		),
		'rounded' => array(
			'type' => 'select',
			'label' => __( 'Highlight With Round Edges', 'oxo-core' ),
			'desc' => __( 'Choose to have rounded edges.', 'oxo-core' ),
			'options' => $reverse_choices
		),		
		'content' => array(
			'std' => __('Your Content Goes Here', 'oxo-core'),
			'type' => 'textarea',
			'label' => __( 'Content to Higlight', 'oxo-core' ),
			'desc' => __( 'Add your content to be highlighted', 'oxo-core' ),
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core')
		),			

	),
	'shortcode' => '[highlight color="{{color}}" rounded="{{rounded}}" class="{{class}}" id="{{id}}"]{{content}}[/highlight]',
	'popup_title' => __( 'Highlight Shortcode', 'oxo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Image Carousel Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['imagecarousel'] = array(
	'params' => array(
		'picture_size' => array(
			'type' => 'select',
			'label' => __( 'Picture Size', 'oxo-core' ),
			'desc' => __( 'fixed = width and height will be fixed <br />auto = width and height will adjust to the image.', 'oxo-core' ),
			'options' => array(
				'fixed' => __('Fixed', 'oxo-core'),
				'auto' => __('Auto', 'oxo-core')
			)
		),
		'hover_type' => array(
			'std' => 'none',
			'type' => 'select',
			'label' => __( 'Hover Type', 'oxo-core' ),
			'desc' => __('Select the hover effect type.', 'oxo-core'),
			'options' => array(
				'none' => __('None', 'oxo-core'),
				'zoomin' => __('Zoom In', 'oxo-core'),
				'zoomout' => __('Zoom Out', 'oxo-core'),
				'liftup' => __('Lift Up', 'oxo-core')
			)
		),
		'autoplay' => array(
			'type' => 'select',
			'label' => __( 'Autoplay', 'oxo-core' ),
			'desc' => __('Choose to autoplay the carousel.', 'oxo-core'),
			'options' => $reverse_choices
		),
		'columns' => array(
			'type' => 'select',
			'label' => __( 'Maximum Columns', 'oxo-core' ),
			'desc' => __('Select the number of max columns to display.', 'oxo-core'),
			'options' => oxo_shortcodes_range( 6, false )	
		),		
		'column_spacing' => array(
			'std' => '13',
			'type' => 'text',
			'label' => __( 'Column Spacing', 'oxo-core' ),
			"desc" => __("Insert the amount of spacing between items without 'px'. ex: 13.", "oxo-core"),
		),
		'scroll_items' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Scroll Items', 'oxo-core' ),
			"desc" => __("Insert the amount of items to scroll. Leave empty to scroll number of visible items.", "oxo-core"),
		),
		'show_nav' => array(
			'type' => 'select',
			'label' => __( 'Show Navigation', 'oxo-core' ),
			'desc' => __( 'Choose to show navigation buttons on the carousel.', 'oxo-core' ),
			'options' => $choices
		),	
		'mouse_scroll' => array(
			'type' => 'select',
			'label' => __( 'Mouse Scroll', 'oxo-core' ),
			'desc' => __( 'Choose to enable mouse drag control on the carousel. IMPORTANT: For easy draggability, when mouse scroll is activated, links will be disabled.', 'oxo-core' ),
			'options' => $reverse_choices
		),
		'border' => array(
			'type' => 'select',
			'label' => __( 'Border', 'oxo-core' ),
			'desc' => __( 'Choose to enable a border around the images.', 'oxo-core' ),
			'options' => $choices
		),		
		'lightbox' => array(
			'type' => 'select',
			'label' => __( 'Image lightbox', 'oxo-core' ),
			'desc' => __( 'Show image in lightbox.', 'oxo-core' ),
			'options' => $choices
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core' )
		),	
	),
	'shortcode' => '[images picture_size="{{picture_size}}" hover_type="{{hover_type}}" autoplay="{{autoplay}}" columns="{{columns}}" column_spacing="{{column_spacing}}" scroll_items="{{scroll_items}}" show_nav="{{show_nav}}" mouse_scroll="{{mouse_scroll}}" border="{{border}}" lightbox="{{lightbox}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/images]', // as there is no wrapper shortcode
	'popup_title' => __( 'Image Carousel Shortcode', 'oxo-core' ),
	'no_preview' => true,

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'link' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Image Website Link', 'oxo-core' ),
				'desc' => __( 'Add the url to image\'s website. If lightbox option is enabled, you have to add the full image link to show it in the lightbox.', 'oxo-core' )
			),
			'target' => array(
				'type' => 'select',
				'label' => __( 'Link Target', 'oxo-core' ),
				'desc' => __( '_self = open in same window <br />_blank = open in new window', 'oxo-core' ),
				'options' => array(
					'_self' => '_self',
					'_blank' => '_blank'
				)
			),
			'image' => array(
				'type' => 'uploader',
				'label' => __( 'Image', 'oxo-core' ),
				'desc' => __( 'Upload an image to display.', 'oxo-core' ),
			),
			'alt' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Image Alt Text', 'oxo-core' ),
				'desc' => __( 'The alt attribute provides alternative information if an image cannot be viewed.', 'oxo-core' ),
			)
		),
		'shortcode' => '[image link="{{link}}" linktarget="{{target}}" image="{{image}}" alt="{{alt}}"]',
		'clone_button' => __( 'Add New Image', 'oxo-core' )
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Image Frame Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['imageframe'] = array(
	'no_preview' => true,
	'params' => array(
		'style_type' => array(
			'type' => 'select',
			'label' => __( 'Frame Style Type', 'oxo-core' ),
			'desc' => __( 'Select the frame style type.', 'oxo-core' ),
			'options' => array(
				'none' => __('None', 'oxo-core'),
				'glow' => __('Glow', 'oxo-core'),
				'dropshadow' => __('Drop Shadow', 'oxo-core'),
				'bottomshadow' => __('Bottom Shadow', 'oxo-core')
			)
		),
		'hover_type' => array(
			'std' => 'none',
			'type' => 'select',
			'label' => __( 'Hover Type', 'oxo-core' ),
			'desc' => __('Select the hover effect type.', 'oxo-core'),
			'options' => array(
				'none' => __('None', 'oxo-core'),
				'zoomin' => __('Zoom In', 'oxo-core'),
				'zoomout' => __('Zoom Out', 'oxo-core'),
				'liftup' => __('Lift Up', 'oxo-core')
			)
		),
		'bordercolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Border Color', 'oxo-core' ),
			'desc' => __( 'Controls the border color. Leave blank for theme option selection.', 'oxo-core' ),
		),
		'bordersize' => array(
			'std' => '0px',
			'type' => 'text',
			'label' => __( 'Border Size', 'oxo-core' ),
			'desc' => __( 'In pixels (px), ex: 1px. Leave blank for theme option selection.', 'oxo-core' ),
		),
		'borderradius' => array(
			'std' => '0',
			'type' => 'text',
			'label' => __( 'Border Radius', 'oxo-core' ),
			'desc' => __( 'Choose the radius of the image. In pixels (px), ex: 1px, or "round".  Leave blank for theme option selection.', 'oxo-core' ),
		),			
		'stylecolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Style Color', 'oxo-core' ),
			'desc' => __( 'For all style types except border. Controls the style color. Leave blank for theme option selection.', 'oxo-core' ),
		),
		'align' => array(
			'std' => 'none',
			'type' => 'select',
			'label' => __( 'Align', 'oxo-core' ),
			'desc' => __('Choose how to align the image.', 'oxo-core'),
			'options' => array(
				'none' => __('None', 'oxo-core'),
				'left' => __('Left', 'oxo-core'),
				'right' => __('Right', 'oxo-core'),
				'center' => __('Center', 'oxo-core')
			)
		),
		'lightbox' => array(
			'type' => 'select',
			'label' => __( 'Image lightbox', 'oxo-core' ),
			'desc' => __( 'Show image in Lightbox.', 'oxo-core' ),
			'options' => $reverse_choices
		),
		'lightbox_image' => array(
			'type' => 'uploader',
			'label' => __( 'Lightbox Image', 'oxo-core' ),
			'desc' => __( 'Upload an image that will show up in the lightbox.', 'oxo-core' ),
		),			
		'image' => array(
			'type' => 'uploader',
			'label' => __( 'Image', 'oxo-core' ),
			'desc' => __('Upload an image to display in the frame.', 'oxo-core')
		),	
		'alt' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Image Alt Text', 'oxo-core' ),
			'desc' => __('The alt attribute provides alternative information if an image cannot be viewed.', 'oxo-core')
		),
		'link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Picture Link URL', 'oxo-core' ),
			'desc' => __( 'Add the URL the picture will link to, ex: http://example.com.', 'oxo-core' ),
		),
		'target' => array(
			'type' => 'select',
			'label' => __( 'Link Target', 'oxo-core' ),
			'desc' => __( '_self = open in same window <br /> _blank = open in new window.', 'oxo-core' ),
			'options' => array(
				'_self' => '_self',
				'_blank' => '_blank'
			)
		),		
		'animation_type' => array(
			'type' => 'select',
			'label' => __( 'Animation Type', 'oxo-core' ),
			'desc' => __( 'Select the type of animation to use on the shortcode.', 'oxo-core' ),
			'options' => $animation_type,
		),
		'animation_direction' => array(
			'type' => 'select',
			'label' => __( 'Direction of Animation', 'oxo-core' ),
			'desc' => __( 'Select the incoming direction for the animation.', 'oxo-core' ),
			'options' => $animation_direction,
		),
		'animation_speed' => array(
			'type' => 'select',
			'std' => '',
			'label' => __( 'Speed of Animation', 'oxo-core' ),
			'desc' => __( 'Type in speed of animation in seconds (0.1 - 1).', 'oxo-core' ),
			'options' => $dec_numbers,
		),
		'animation_offset' => array(
			'type' 		=> 'select',
			'std' 		=> '',
			'label' 	=> __( 'Offset of Animation', 'oxo-core' ),
			'desc' 		=> __( 'Choose when the animation should start.', 'oxo-core' ),
			'options' 	=> array(
					  			''					=> __( 'Default', 'oxo-core' ),				
								'top-into-view' 	=> __( 'Top of element hits bottom of viewport', 'oxo-core' ),
								'top-mid-of-view' 	=> __( 'Top of element hits middle of viewport', 'oxo-core' ),
								'bottom-in-view' 	=> __( 'Bottom of element enters viewport', 'oxo-core' ),
							)
		),		
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core')
		),			
	),
	'shortcode' => '[imageframe lightbox="{{lightbox}}" lightbox_image="{{lightbox_image}}" style_type="{{style_type}}" hover_type="{{hover_type}}" bordercolor="{{bordercolor}}" bordersize="{{bordersize}}" borderradius="{{borderradius}}" stylecolor="{{stylecolor}}" align="{{align}}" link="{{link}}" linktarget="{{target}}" animation_type="{{animation_type}}" animation_direction="{{animation_direction}}" animation_speed="{{animation_speed}}" animation_offset="{{animation_offset}}" class="{{class}}" id="{{id}}"]&lt;img alt="{{alt}}" src="{{image}}" /&gt;[/imageframe]',
	'popup_title' => __( 'Image Frame Shortcode', 'oxo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Form Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['form'] = array(
	'no_preview' => true,
	'params' => array(
	    'id' => array(
			'std' => '',
			'type' => 'select',
			'label' => __( 'Select Form', 'oxo-core' ),
			'desc' => __( 'Select a form below to add it to your post or page. ', 'oxo-core'),
			'options' => $gf_form_options
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core')
		),
		/*'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core')
		),*/			
	),
	'shortcode' => '[gravityform  id="{{id}}" class="{{class}}"]',
	'popup_title' => __( 'Form Shortcode', 'oxo-core' ),
	'no_preview' => false
);


/*-----------------------------------------------------------------------------------*/
/*	Lightbox Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['lightbox'] = array(
	'no_preview' => true,
	'params' => array(

		'full_image' => array(
			'type' => 'uploader',
			'label' => __( 'Full Image', 'oxo-core' ),
			'desc' => __( 'Upload an image that will show up in the lightbox.', 'oxo-core' ),
		),
		'thumb_image' => array(
			'type' => 'uploader',
			'label' => __( 'Thumbnail Image', 'oxo-core' ),
			'desc' => __( 'Clicking this image will show lightbox.', 'oxo-core' ),
		),
		'alt' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Alt Text', 'oxo-core' ),
			'desc' => __( 'The alt attribute provides alternative information if an image cannot be viewed.', 'oxo-core' ),
		),
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Lightbox Description', 'oxo-core' ),
			'desc' => __( 'This will show up in the lightbox as a description below the image.', 'oxo-core' ),
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core' )
		),				
	),
	'shortcode' => '[oxo_lightbox] &lt;a title="{{title}}" class="{{class}}" id="{{id}}" href="{{full_image}}" data-rel="prettyPhoto"&gt;&lt;img alt="{{alt}}" src="{{thumb_image}}" /&gt;&lt;/a&gt; [/oxo_lightbox]',
	'popup_title' => __( 'Lightbox Shortcode', 'oxo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Login Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['oxo_login'] = array(
	'no_preview' => true,
	'params' => array(

		'text_align' => array(
			'type' => 'select',
			'label' => __( 'Text Align', 'oxo-core' ),
			'desc' => __( 'Choose the alignment of all content parts. "Text Flow" follows the default text align of the site. "Center" will center all elements.', 'oxo-core' ),
			'options' => array(
				''				=> __( 'Default', 'oxo-core' ),
				'textflow'		=> __( 'Text Flow', 'oxo-core' ),
				'center' 		=> __( 'Center', 'oxo-core' )
			)
		),
		'heading' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Heading', 'oxo-core' ),
			'desc' => __( 'Choose a heading text.', 'oxo-core' ),
		),
		'caption' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Caption', 'oxo-core' ),
			'desc' => __( 'Choose a caption text.', 'oxo-core' ),
		),
		'button_fullwidth' => array(
			'type' => 'select',
			'label' => __( 'Button Span', 'oxo-core' ),
			'desc' => __( 'Choose to have the button span the full width.', 'oxo-core' ),
			'options' => $choices_with_default
		),
		'form_background_color' => array(
			'type' => 'colorpicker',
			'label' => __( 'Form Backgound Color', 'oxo-core' ),
			'desc' => __( 'Choose a background color for the form wrapping box.', 'oxo-core' ),
		),
		'redirection_link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Redirection Link', 'oxo-core' ),
			'desc' => __( 'Add the url to which a user should redirected after form submission. Leave empty to use the same page.', 'oxo-core' ),
		),
		'register_link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Register Link', 'oxo-core' ),
			'desc' => __( 'Add the url the "Register" link should open.', 'oxo-core' ),
		),	
		'lost_password_link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Lost Password Link', 'oxo-core' ),
			'desc' => __( 'Add the url the "Lost Password" link should open.', 'oxo-core' ),
		),			
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core' )
		),				
	),	
	'shortcode' => '[oxo_login text_align="{{text_align}}" heading="{{heading}}" caption="{{caption}}" button_fullwidth="{{button_fullwidth}}" form_background_color="{{form_background_color}}" redirection_link="{{redirection_link}}" register_link="{{register_link}}" lost_password_link="{{lost_password_link}}" class="{{class}}" id="{{id}}"]',
	'popup_title' => __( 'Login Shortcode', 'oxo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Register Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['oxo_register'] = array(
	'no_preview' => true,
	'params' => array(

		'text_align' => array(
			'type' => 'select',
			'label' => __( 'Text Align', 'oxo-core' ),
			'desc' => __( 'Choose the alignment of all content parts. "Text Flow" follows the default text align of the site. "Center" will center all elements.', 'oxo-core' ),
			'options' => array(
				''				=> __( 'Default', 'oxo-core' ),
				'textflow'		=> __( 'Text Flow', 'oxo-core' ),
				'center' 		=> __( 'Center', 'oxo-core' )
			)
		),
		'heading' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Heading', 'oxo-core' ),
			'desc' => __( 'Choose a heading text.', 'oxo-core' ),
		),
		'caption' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Caption', 'oxo-core' ),
			'desc' => __( 'Choose a caption text.', 'oxo-core' ),
		),
		'button_fullwidth' => array(
			'type' => 'select',
			'label' => __( 'Button Span', 'oxo-core' ),
			'desc' => __( 'Choose to have the button span the full width.', 'oxo-core' ),
			'options' => $choices_with_default
		),
		'form_background_color' => array(
			'type' => 'colorpicker',
			'label' => __( 'Form Backgound Color', 'oxo-core' ),
			'desc' => __( 'Choose a background color for the form wrapping box.', 'oxo-core' ),
		),
		'redirection_link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Redirection Link', 'oxo-core' ),
			'desc' => __( 'Add the url to which a user should redirected after form submission. Leave empty to use the same page.', 'oxo-core' ),
		),		
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core' )
		),				
	),	
	'shortcode' => '[oxo_register text_align="{{text_align}}" heading="{{heading}}" caption="{{caption}}" button_fullwidth="{{button_fullwidth}}" form_background_color="{{form_background_color}}" redirection_link="{{redirection_link}}" register_link="{{register_link}}" lost_password_link="{{lost_password_link}}" class="{{class}}" id="{{id}}"]',
	'popup_title' => __( 'Register Shortcode', 'oxo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Lost Password Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['oxo_lost_password'] = array(
	'no_preview' => true,
	'params' => array(

		'text_align' => array(
			'type' => 'select',
			'label' => __( 'Text Align', 'oxo-core' ),
			'desc' => __( 'Choose the alignment of all content parts. "Text Flow" follows the default text align of the site. "Center" will center all elements.', 'oxo-core' ),
			'options' => array(
				''				=> __( 'Default', 'oxo-core' ),
				'textflow'		=> __( 'Text Flow', 'oxo-core' ),
				'center' 		=> __( 'Center', 'oxo-core' )
			)
		),
		'heading' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Heading', 'oxo-core' ),
			'desc' => __( 'Choose a heading text.', 'oxo-core' ),
		),
		'caption' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Caption', 'oxo-core' ),
			'desc' => __( 'Choose a caption text.', 'oxo-core' ),
		),
		'button_fullwidth' => array(
			'type' => 'select',
			'label' => __( 'Button Span', 'oxo-core' ),
			'desc' => __( 'Choose to have the button span the full width.', 'oxo-core' ),
			'options' => $choices_with_default
		),
		'form_background_color' => array(
			'type' => 'colorpicker',
			'label' => __( 'Form Backgound Color', 'oxo-core' ),
			'desc' => __( 'Choose a background color for the form wrapping box.', 'oxo-core' ),
		),
		'redirection_link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Redirection Link', 'oxo-core' ),
			'desc' => __( 'Add the url to which a user should redirected after form submission. Leave empty to use the same page.', 'oxo-core' ),
		),			
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core' )
		),				
	),	
	'shortcode' => '[oxo_lost_password text_align="{{text_align}}" heading="{{heading}}" caption="{{caption}}" button_fullwidth="{{button_fullwidth}}" form_background_color="{{form_background_color}}" redirection_link="{{redirection_link}}" register_link="{{register_link}}" lost_password_link="{{lost_password_link}}" class="{{class}}" id="{{id}}"]',
	'popup_title' => __( 'Lost Password Shortcode', 'oxo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Menu Anchor Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['menuanchor'] = array(
	'no_preview' => true,
	'params' => array(

		'name' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Name Of Menu Anchor', 'oxo-core' ),
			'desc' => __('This name will be the id you will have to use in your one page menu.', 'oxo-core'),

		)
	),
	'shortcode' => '[menu_anchor name="{{name}}"]',
	'popup_title' => __( 'Menu Anchor Shortcode', 'oxo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Modal Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['modal'] = array(
	'no_preview' => true,
	'params' => array(

		'name' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Name Of Modal', 'oxo-core' ),
			'desc' => __( 'Needs to be a unique identifier (lowercase), used for button or modal_text_link shortcode to open the modal. ex: mymodal', 'oxo-core' ),
		),
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Modal Heading', 'oxo-core' ),
			'desc' => __( 'Heading text for the modal.', 'oxo-core' ),
		),		
		'size' => array(
			'type' => 'select',
			'label' => __( 'Size Of Modal', 'oxo-core' ),
			'desc' => __( 'Select the modal window size.', 'oxo-core' ),
			'options' => array(
				'small' => __('Small', 'oxo-core'),
				'large' => __('Large', 'oxo-core')
			)
		),
		'background' => array(
			'type' => 'colorpicker',
			'label' => __( 'Background Color', 'oxo-core' ),
			'desc' => __( 'Controls the modal background color. Leave blank for theme option selection.', 'oxo-core' ),
		),
		'bordercolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Border Color', 'oxo-core' ),
			'desc' => __( 'Controls the modal border color. Leave blank for theme option selection.', 'oxo-core' ),
		),
		'showfooter' => array(
			'type' => 'select',
			'label' => __( 'Show Footer', 'oxo-core' ),
			'desc' => __( 'Choose to show the modal footer with close button.', 'oxo-core' ),
			'options' => $choices
		),
		'content' => array(
			'std' => __('Your Content Goes Here', 'oxo-core'),
			'type' => 'textarea',
			'label' => __( 'Contents of Modal', 'oxo-core' ),
			'desc' => __( 'Add your content to be displayed in modal.', 'oxo-core' ),
		),		
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core' )
		),			
	),
	'shortcode' => '[modal name="{{name}}" title="{{title}}" size="{{size}}" background="{{background}}" border_color="{{bordercolor}}" show_footer="{{showfooter}}" class="{{class}}" id="{{id}}"]{{content}}[/modal]',
	'popup_title' => __( 'Modal Shortcode', 'oxo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Modal Text Link Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['modaltextlink'] = array(
	'no_preview' => true,
	'params' => array(
		'modal' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Name Of Modal', 'oxo-core' ),
			'desc' => __('Unique identifier of the modal to open on click.', 'oxo-core'),
		),
		'content' => array(
			'std' => __('Your Content Goes Here', 'oxo-core'),
			'type' => 'textarea',
			'label' => __( 'Text or HTML code', 'oxo-core' ),
			'desc' => __( 'Insert text or HTML code here (e.g: HTML for image). This content will be used to trigger the modal popup.', 'oxo-core' ),
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core' )
		),		
	),
	'shortcode' => '[modal_text_link name="{{modal}}" class="{{class}}" id="{{id}}"]{{content}}[/modal_text_link]',
	'popup_title' => __( 'Modal Text Link Shortcode', 'oxo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	One Page Text Link Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['onepagetextlink'] = array(
	'no_preview' => true,
	'params' => array(
		'link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Name Of Anchor', 'oxo-core' ),
			'desc' => __('Unique identifier of the anchor to scroll to on click.', 'oxo-core'),
		),
		'content' => array(
			'std' => __('Your Content Goes Here', 'oxo-core'),
			'type' => 'textarea',
			'label' => __( 'Text or HTML code', 'oxo-core' ),
			'desc' => __( 'Insert text or HTML code here (e.g: HTML for image). This content will be used to trigger the scrolling to the anchor.', 'oxo-core' ),
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core' )
		),		
	),
	'shortcode' => '[one_page_text_link link="{{link}}" class="{{class}}" id="{{id}}"]{{content}}[/one_page_text_link]',
	'popup_title' => __( 'One Page Text Link Shortcode', 'oxo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Person Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['person'] = array(
	'no_preview' => true,
	'params' => array(
		'name' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Name', 'oxo-core' ),
			'desc' => __( 'Insert the name of the person.', 'oxo-core' ),
		),
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Title', 'oxo-core' ),
			'desc' => __( 'Insert the title of the person', 'oxo-core' ),
		),
		'content' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Profile Description', 'oxo-core' ),
			'desc' => __( 'Enter the content to be displayed', 'oxo-core' )
		),
		'picture' => array(
			'type' => 'uploader',
			'label' => __( 'Picture', 'oxo-core' ),
			'desc' => __( 'Upload an image to display.', 'oxo-core' ),
		),
		'piclink' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Picture Link URL', 'oxo-core' ),
			'desc' => __( 'Add the URL the picture will link to, ex: http://example.com.', 'oxo-core' ),
		),
		'target' => array(
			'type' => 'select',
			'label' => __( 'Link Target', 'oxo-core' ),
			'desc' => __( '_self = open in same window <br /> _blank = open in new window', 'oxo-core' ),
			'options' => array(
				'_self' => '_self',
				'_blank' => '_blank'
			)
		),		
		'picstyle' => array(
			'type' => 'select',
			'label' => __( 'Picture Style Type', 'oxo-core' ),
			'desc' => __( 'Selected the style type for the picture,', 'oxo-core' ),
			'options' => array(
				'none' => __('None', 'oxo-core'),
				'glow' => __('Glow', 'oxo-core'),
				'dropshadow' => __('Drop Shadow', 'oxo-core'),
				'bottomshadow' => __('Bottom Shadow', 'oxo-core')
			)
		),
		'hover_type' => array(
			'std' => 'none',
			'type' => 'select',
			'label' => __( 'Hover Type', 'oxo-core' ),
			'desc' => __('Select the hover effect type.', 'oxo-core'),
			'options' => array(
				'none' => __('None', 'oxo-core'),
				'zoomin' => __('Zoom In', 'oxo-core'),
				'zoomout' => __('Zoom Out', 'oxo-core'),
				'liftup' => __('Lift Up', 'oxo-core')
			)
		),
		'background_color' => array(
			'type' => 'colorpicker',
			'label' => __( 'Background Color', 'oxo-core' ),
			'desc' => __( 'Controls the background color. Leave blank for theme option selection.', 'oxo-core' ),
		),
		'content_alignment' => array(
			'type' => 'select',
			'label' => __( 'Content Alignment', 'oxo-core' ),
			'desc' => __( 'Choose the alignment of content. Choose default for theme option selection.', 'oxo-core' ),
			'options' => array(
				'' => __('Default', 'oxo-core'),
				'left' => __('Left', 'oxo-core'),
				'center' => __('Center', 'oxo-core'),
				'right' => __('Right', 'oxo-core')
			)
		),
		'pic_style_color' => array(
			'type' => 'colorpicker',
			'label' => __( 'Picture Style color', 'oxo-core' ),
			'desc' => __( 'For all style types except border. Controls the style color. Leave blank for theme option selection.', 'oxo-core' ),
		),
		'picborder' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Picture Border Size', 'oxo-core' ),
			'desc' => __( 'In pixels (px), ex: 1px. Leave blank for theme option selection.', 'oxo-core' ),
		),
		'picbordercolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Picture Border Color', 'oxo-core' ),
			'desc' => __( 'Controls the picture\'s border color. Leave blank for theme option selection.', 'oxo-core' ),
		),
		'picborderradius' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Picture Border Radius', 'oxo-core' ),
			'desc' => __( 'Choose the border radius of the person image. In pixels (px), ex: 1px, or "round".  Leave blank for theme option selection.', 'oxo-core' ),
		),
		'icon_position' => array(
			'type' => 'select',
			'label' => __( 'Icon Position', 'oxo-core' ),
			'desc' => __( 'Choose the social icon position. Choose default for theme option selection.', 'oxo-core' ),
			'options' => array(
				'' => __('Default', 'oxo-core'),
				'top' => __('Top', 'oxo-core'),
				'bottom' => __('Bottom', 'oxo-core')
			)
		),
		'iconboxed' => array(
			'type' => 'select',
			'label' => __( 'Boxed Social Icons', 'oxo-core' ),
			'desc' => __( 'Choose to get boxed icons. Choose default for theme option selection.', 'oxo-core' ),
			'options' => $reverse_choices_with_default
		),
		'iconboxedradius' => array(
			'std' => '4px',
			'type' => 'text',
			'label' => __( 'Social Icon Box Radius', 'oxo-core' ),
			'desc' => __( 'Choose the border radius of the boxed icons. In pixels (px), ex: 1px, or "round". Leave blank for theme option selection.', 'oxo-core' ),
		),		
		'iconcolor' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Social Icon Custom Colors', 'oxo-core' ),
			'desc' => __( 'Specify the color of social icons. Use one hex value for all or separate by | symbol for multi-color. ex: #AA0000|#00AA00|#0000AA. Leave blank for theme option selection.', 'oxo-core' ),
		),
		'boxcolor' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Social Icon Custom Box Colors', 'oxo-core' ),
			'desc' => __( 'Specify the box color of social icons. Use one hex value for all or separate by | symbol for multi-color. ex: #AA0000|#00AA00|#0000AA. Leave blank for theme option selection.', 'oxo-core' ),
		),
		'icontooltip' => array(
			'type' => 'select',
			'label' => __( 'Social Icon Tooltip Position', 'oxo-core' ),
			'desc' => __( 'Choose the display position for tooltips. Choose default for theme option selection.', 'oxo-core' ),
			'options' => array(
				'' => __('Default', 'oxo-core'),
				'top' => __('Top', 'oxo-core'),
				'bottom' => __('Bottom', 'oxo-core'),
				'left' => __('Left', 'oxo-core'),
				'Right' => __('Right', 'oxo-core'),
			)
		),	
		'email' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Email Address', 'oxo-core' ),
			'desc' => __( 'Insert an email address to display the email icon', 'oxo-core' ),
		),
		'facebook' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Facebook Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom Facebook link', 'oxo-core' ),
		),
		'twitter' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Twitter Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom Twitter link', 'oxo-core' ),
		),
		'instagram' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Instagram Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom Instagram link', 'oxo-core' ),
		),		
		'dribbble' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Dribbble Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom Dribbble link', 'oxo-core' ),
		),
		'google' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Google+ Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom Google+ link', 'oxo-core' ),
		),
		'linkedin' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'LinkedIn Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom LinkedIn link', 'oxo-core' ),
		),
		'blogger' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Blogger Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom Blogger link', 'oxo-core' ),
		),
		'tumblr' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Tumblr Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom Tumblr link', 'oxo-core' ),
		),
		'reddit' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Reddit Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom Reddit link', 'oxo-core' ),
		),
		'yahoo' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Yahoo Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom Yahoo link', 'oxo-core' ),
		),
		'deviantart' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Deviantart Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom Deviantart link', 'oxo-core' ),
		),
		'vimeo' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Vimeo Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom Vimeo link', 'oxo-core' ),
		),
		'youtube' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Youtube Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom Youtube link', 'oxo-core' ),
		),
		'pinterest' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Pinterst Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom Pinterest link', 'oxo-core' ),
		),
		'rss' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'RSS Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom RSS link', 'oxo-core' ),
		),		
		'digg' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Digg Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom Digg link', 'oxo-core' ),
		),
		'flickr' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Flickr Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom Flickr link', 'oxo-core' ),
		),
		'forrst' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Forrst Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom Forrst link', 'oxo-core' ),
		),
		'myspace' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Myspace Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom Myspace link', 'oxo-core' ),
		),
		'skype' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Skype Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom Skype link', 'oxo-core' ),
		),
		'paypal' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'PayPal Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom paypal link', 'oxo-core' ),
		),
		'dropbox' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Dropbox Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom dropbox link', 'oxo-core' ),
		),
		'soundcloud' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'SoundCloud Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom soundcloud link', 'oxo-core' ),
		),
		'vk' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'VK Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom vk link', 'oxo-core' ),
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core' )
		),
	),
	'shortcode' => '[person name="{{name}}" title="{{title}}" picture="{{picture}}" pic_link="{{piclink}}" linktarget="{{target}}" pic_style="{{picstyle}}" hover_type="{{hover_type}}" background_color="{{background_color}}" content_alignment="{{content_alignment}}" icon_position="{{icon_position}}" pic_style_color="{{pic_style_color}}" pic_bordersize="{{picborder}}" pic_bordercolor="{{picbordercolor}}" pic_borderradius="{{picborderradius}}" social_icon_boxed="{{iconboxed}}" social_icon_boxed_radius="{{iconboxedradius}}" social_icon_colors="{{iconcolor}}"  social_icon_boxed_colors="{{boxcolor}}" social_icon_tooltip="{{icontooltip}}" email="{{email}}" facebook="{{facebook}}" twitter="{{twitter}}" instagram="{{instagram}}" dribbble="{{dribbble}}" google="{{google}}" linkedin="{{linkedin}}" blogger="{{blogger}}" tumblr="{{tumblr}}" reddit="{{reddit}}" yahoo="{{yahoo}}" deviantart="{{deviantart}}" vimeo="{{vimeo}}" youtube="{{youtube}}" rss="{{rss}}" pinterest="{{pinterest}}" digg="{{digg}}" flickr="{{flickr}}" forrst="{{forrst}}" myspace="{{myspace}}" skype="{{skype}}" paypal="{{paypal}}" dropbox="{{dropbox}}" soundcloud="{{soundcloud}}" vk="{{vk}}" class="{{class}}" id="{{id}}"]{{content}}[/person]',
	'popup_title' => __( 'Person Shortcode', 'oxo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Popover Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['popover'] = array(
	'params' => array(
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Popover Heading', 'oxo-core' ),
			'desc' => __( 'Heading text of the popover.', 'oxo-core' ),
		),
		'titlebgcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Popover Heading Background Color', 'oxo-core' ),
			'desc' => __( 'Controls the background color of the popover heading. Leave blank for theme option selection.', 'oxo-core')
		),			
		'popovercontent' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Contents Inside Popover', 'oxo-core' ),
			'desc' => __( 'Text to be displayed inside the popover.', 'oxo-core' ),
		),
		'contentbgcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Popover Content Background Color', 'oxo-core' ),
			'desc' => __( 'Controls the background color of the popover content area. Leave blank for theme option selection.', 'oxo-core')
		),
		'bordercolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Popover Border Color', 'oxo-core' ),
			'desc' => __( 'Controls the border color of the of the popover box. Leave blank for theme option selection.', 'oxo-core')
		),
		'textcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Popover Text Color', 'oxo-core' ),
			'desc' => __( 'Controls all the text color inside the popover box. Leave blank for theme option selection.', 'oxo-core')
		),
		'trigger' => array(
			'type' => 'select',
			'label' => __( 'Popover Trigger Method', 'oxo-core' ),
			'desc' => __( 'Choose mouse action to trigger popover.', 'oxo-core' ),
			'options' => array(
				'click' => __('Click', 'oxo-core'),
				'hover' => __('Hover', 'oxo-core'),
			)
		),
		'placement' => array(
			'type' => 'select',
			'label' => __( 'Popover Position', 'oxo-core' ),
			'desc' => __( 'Choose the display position of the popover. Choose default for theme option selection.', 'oxo-core' ),
			'options' => array(
				'' => __('Default', 'oxo-core'),
				'top' => __('Top', 'oxo-core'),
				'bottom' => __('Bottom', 'oxo-core'),
				'left' => __('Left', 'oxo-core'),
				'Right' => __('Right', 'oxo-core'),
			)
		),
		'content' => array(
			'std' => __('Text', 'oxo-core'),
			'type' => 'text',
			'label' => __( 'Triggering Content', 'oxo-core' ),
			'desc' => __( 'Content that will trigger the popover.', 'oxo-core' ),
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core' )
		),			
	),
	'shortcode' => '[popover title="{{title}}" title_bg_color="{{titlebgcolor}}" content="{{popovercontent}}" content_bg_color="{{contentbgcolor}}" bordercolor="{{bordercolor}}" textcolor="{{textcolor}}" trigger="{{trigger}}" placement="{{placement}}" class="{{class}}" id="{{id}}"]{{content}}[/popover]', // as there is no wrapper shortcode
	'popup_title' => __( 'Popover Shortcode', 'oxo-core' ),
	'no_preview' => true,
);

/*-----------------------------------------------------------------------------------*/
/*	Pricing Table Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['pricingtable'] = array(
	'no_preview' => true,
	'params' => array(

		'type' => array(
			'type' => 'select',
			'label' => __( 'Type', 'oxo-core' ),
			'desc' => __( 'Select the type of pricing table', 'oxo-core' ),
			'options' => array(
				'1' => __('Style 1', 'oxo-core'),
				'2' => __('Style 2', 'oxo-core'),
			)
		),
		'backgroundcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Background Color', 'oxo-core' ),
			'desc' => __('Controls the background color. Leave blank for theme option selection.', 'oxo-core')
		),
		'bordercolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Border Color', 'oxo-core' ),
			'desc' => __('Controls the border color. Leave blank for theme option selection.', 'oxo-core')
		),
		'dividercolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Divider Color', 'oxo-core' ),
			'desc' => __('Controls the divider color. Leave blank for theme option selection.', 'oxo-core')
		),
		'columns' => array(
			'type' => 'select',
			'label' => __( 'Number of Columns', 'oxo-core' ),
			'desc' => __('Select how many columns to display', 'oxo-core'),
			'options' => array(
				'&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;' => '1 Column',
				'&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;' => '2 Columns',
				'&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;' => '3 Columns',
				'&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;' => '4 Columns',
				'&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;' => '5 Columns',
				'&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;' => '6 Columns'
			)
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core' )
		),			
	),
	'shortcode' => '[pricing_table type="{{type}}" backgroundcolor="{{backgroundcolor}}" bordercolor="{{bordercolor}}" dividercolor="{{dividercolor}}" class="{{class}}" id="{{id}}"]{{columns}}[/pricing_table]',
	'popup_title' => __( 'Pricing Table Shortcode', 'oxo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Progress Bar Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['progressbar'] = array(
	'params' => array(

		'percentage' => array(
			'type' => 'select',
			'label' => __( 'Filled Area Percentage', 'oxo-core' ),
			'desc' => __( 'From 1% to 100%', 'oxo-core' ),
			'options' => oxo_shortcodes_range( 100, false )
		),
		'unit' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Progress Bar Unit', 'oxo-core' ),
			'desc' => __( 'Insert a unit for the progress bar. ex %', 'oxo-core' ),
		),
		'filledcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Filled Color', 'oxo-core' ),
			'desc' => __( 'Controls the color of the filled in area. Leave blank for theme option selection.', 'oxo-core' )
		),
		'unfilledcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Unfilled Color', 'oxo-core' ),
			'desc' => __( 'Controls the color of the unfilled in area. Leave blank for theme option selection.', 'oxo-core' )
		),
		'striped' => array(
			'type' => 'select',
			'label' => __( 'Striped Filling', 'oxo-core' ),
			'desc' => __( 'Choose to get the filled area striped.', 'oxo-core' ),
			'options' => $reverse_choices
		),
		'animatedstripes' => array(
			'type' => 'select',
			'label' => __( 'Animated Stripes', 'oxo-core' ),
			'desc' => __( 'Choose to get the the stripes animated.', 'oxo-core' ),
			'options' => $reverse_choices
		),			
		'textcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Text Color', 'oxo-core' ),
			'desc' => __( 'Controls the text color. Leave blank for theme option selection.', 'oxo-core ')
		),
		'content' => array(
			'std' => __('Text', 'oxo-core'),
			'type' => 'text',
			'label' => __( 'Progess Bar Text', 'oxo-core' ),
			'desc' => __( 'Text will show up on progess bar', 'oxo-core' ),
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core' )
		),		
	),
	'shortcode' => '[progress percentage="{{percentage}}" unit="{{unit}}" filledcolor="{{filledcolor}}" unfilledcolor="{{unfilledcolor}}" striped="{{striped}}" animated_stripes="{{animatedstripes}}" textcolor="{{textcolor}}" animation_offset="{{animation_offset}}" class="{{class}}" id="{{id}}"]{{content}}[/progress]',
	'popup_title' => __( 'Progress Bar Shortcode', 'oxo-core' ),
	'no_preview' => true,
);

/*-----------------------------------------------------------------------------------*/
/*	Recent Posts Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['recentposts'] = array(
	'no_preview' => true,
	'params' => array(

		'layout' => array(
			'type' => 'select',
			'label' => __( 'Layout', 'oxo-core' ),
			'desc' => __('Select the layout for the shortcode', 'oxo-core'),
			'options' => array(
				'default' => __('Default', 'oxo-core'),
				'thumbnails-on-side' => __('Thumbnails on Side', 'oxo-core'),
				'date-on-side' => __('Date on Side', 'oxo-core'),
			)
		),
		'hover_type' => array(
			'std' => 'none',
			'type' => 'select',
			'label' => __( 'Hover Type', 'oxo-core' ),
			'desc' => __('Select the hover effect type.', 'oxo-core'),
			'options' => array(
				'none' => __('None', 'oxo-core'),
				'zoomin' => __('Zoom In', 'oxo-core'),
				'zoomout' => __('Zoom Out', 'oxo-core'),
				'liftup' => __('Lift Up', 'oxo-core')
			)
		),
		'columns' => array(
			'type' => 'select',
			'label' => __( 'Columns', 'oxo-core' ),
			'desc' => __( 'Select the number of columns to display', 'oxo-core' ),
			'options' => oxo_shortcodes_range( 6, false )
		),		
		'number_posts' => array(
			'std' => 4,
			'type' => 'text',
			'label' => __( 'Number of Posts', 'oxo-core' ),
			'desc' => __('Select the number of posts to display', 'oxo-core')
		),
		'offset' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Post Offset', 'oxo-core' ),
			'desc' => __('The number of posts to skip. ex: 1.', 'oxo-core')
		),		
		'cat_slug' => array(
			'type' => 'multiple_select',
			'label' => __( 'Categories', 'oxo-core' ),
			'desc' => __( 'Select a category or leave blank for all', 'oxo-core' ),
			'options' => oxo_shortcodes_categories( 'category' )
		),
		'exclude_cats' => array(
			'type' => 'multiple_select',
			'label' => __( 'Exclude Categories', 'oxo-core' ),
			'desc' => __( 'Select a category to exclude', 'oxo-core' ),
			'options' => oxo_shortcodes_categories( 'category' )
		),
		'thumbnail' => array(
			'type' => 'select',
			'label' => __( 'Show Thumbnail', 'oxo-core' ),
			'desc' => __('Display the post featured image', 'oxo-core'),
			'options' => $choices
		),
		'title' => array(
			'type' => 'select',
			'label' => __( 'Show Title', 'oxo-core' ),
			'desc' => __('Display the post title below the featured image', 'oxo-core'),
			'options' => $choices
		),
		'meta' => array(
			'type' => 'select',
			'label' => __( 'Show Meta', 'oxo-core' ),
			'desc' => __('Choose to show all meta data', 'oxo-core'),
			'options' => $choices
		),
		'excerpt' => array(
			'type' => 'select',
			'label' => __( 'Show Excerpt', 'oxo-core' ),
			'desc' => __('Choose to display the post excerpt', 'oxo-core'),
			'options' => $choices
		),
		'excerpt_length' => array(
			'std' => 35,
			'type' => 'text',
			'label' => __( 'Excerpt Length', 'oxo-core' ),
			'desc' => __('Insert the number of words/characters you want to show in the excerpt', 'oxo-core'),
		),
		'strip_html' => array(
			'type' => 'select',
			'label' => __( 'Strip HTML', 'oxo-core' ),
			'desc' => __('Strip HTML from the post excerpt', 'oxo-core'),
			'options' => $choices
		),
		'animation_type' => array(
			'type' => 'select',
			'label' => __( 'Animation Type', 'oxo-core' ),
			'desc' => __( 'Select the type on animation to use on the shortcode', 'oxo-core' ),
			'options' => $animation_type,
		),
		'animation_direction' => array(
			'type' => 'select',
			'label' => __( 'Direction of Animation', 'oxo-core' ),
			'desc' => __( 'Select the incoming direction for the animation', 'oxo-core' ),
			'options' => $animation_direction,
		),
		'animation_speed' => array(
			'type' => 'select',
			'std' => '',
			'label' => __( 'Speed of Animation', 'oxo-core' ),
			'desc' => __( 'Type in speed of animation in seconds (0.1 - 1)', 'oxo-core' ),
			'options' => $dec_numbers,
		),
		'animation_offset' => array(
			'type' 		=> 'select',
			'std' 		=> '',
			'label' 	=> __( 'Offset of Animation', 'oxo-core' ),
			'desc' 		=> __( 'Choose when the animation should start.', 'oxo-core' ),
			'options' 	=> array(
					  			''					=> __( 'Default', 'oxo-core' ),			
								'top-into-view' 	=> __( 'Top of element hits bottom of viewport', 'oxo-core' ),
								'top-mid-of-view' 	=> __( 'Top of element hits middle of viewport', 'oxo-core' ),
								'bottom-in-view' 	=> __( 'Bottom of element enters viewport', 'oxo-core' ),
							)
		),		
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core' )
		),			
	),
	'shortcode' => '[recent_posts layout="{{layout}}" hover_type="{{hover_type}}" columns="{{columns}}" number_posts="{{number_posts}}" offset="{{offset}}" cat_slug="{{cat_slug}}" exclude_cats="{{exclude_cats}}" thumbnail="{{thumbnail}}" title="{{title}}" meta="{{meta}}" excerpt="{{excerpt}}" excerpt_length="{{excerpt_length}}" strip_html="{{strip_html}}" animation_type="{{animation_type}}" animation_direction="{{animation_direction}}" animation_speed="{{animation_speed}}" animation_offset="{{animation_offset}}" class="{{class}}" id="{{id}}"][/recent_posts]',
	'popup_title' => __( 'Recent Posts Shortcode', 'oxo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Recent Works Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['recentworks'] = array(
	'no_preview' => true,
	'params' => array(
		'layout' => array(
			'type' => 'select',
			'label' => __( 'Layout', 'oxo-core' ),
			'desc' => __('Choose the layout for the shortcode', 'oxo-core'),
			'options' => array(
				'carousel' => __('Carousel', 'oxo-core'),
				'grid' => __('Grid', 'oxo-core'),
				'grid-with-excerpts' => __('Grid with Excerpts', 'oxo-core'),
			)
		),
		'picture_size' => array(
			'type' => 'select',
			'label' => __( 'Picture Size', 'oxo-core' ),
			'desc' => __( 'fixed = width and height will be fixed <br />auto = width and height will adjust to the image.', 'oxo-core' ),
			'options' => array(
				'fixed' => __('Fixed', 'oxo-core'),
				'auto' => __('Auto', 'oxo-core')
			)
		),
		'boxed_text' => array(
			'type' => 'select',
			'label' => __( 'Grid with Excerpts Layout', 'oxo-core' ),
			'desc' => __( 'Select if the grid with excerpts layouts are boxed or unboxed.', 'oxo-core' ),
			'options' => array(
				'boxed' => __('Boxed', 'oxo-core'),
				'unboxed' => __('Unboxed', 'oxo-core')
			)
		),
		'filters' => array(
			'type' => 'select',
			'label' => __( 'Show Filters', 'oxo-core' ),
			'desc' => __('Choose to show or hide the category filters', 'oxo-core'),
			'options' => array( 
				'yes' => __('Yes', 'oxo-core'), 
				'yes-without-all' => __('Yes without "All"', 'oxo-core'),
				'no' => __('No', 'oxo-core') 
			)
		),
		'columns' => array(
			'type' => 'select',
			'label' => __( 'Columns', 'oxo-core' ),
			'desc' => __( 'Select the number of columns to display. Does not work with Carousel layout.', 'oxo-core' ),
			'options' => oxo_shortcodes_range( 6, false )
		),
		'column_spacing' => array(
			'std' => '12',
			'type' => 'text',
			'label' => __( 'Column Spacing', 'oxo-core' ),
			'desc' => __( 'Insert the amount of spacing between portfolio items without "px". ex: 7. Does not work with Carousel layout.', 'oxo-core' )
		),		
		'cat_slug' => array(
			'type' => 'multiple_select',
			'label' => __( 'Categories', 'oxo-core' ),
			'desc' => __( 'Select a category or leave blank for all', 'oxo-core' ),
			'options' => oxo_shortcodes_categories( 'portfolio_category' )
		),
		'exclude_cats' => array(
			'type' => 'multiple_select',
			'label' => __( 'Exclude Categories', 'oxo-core' ),
			'desc' => __( 'Select a category to exclude', 'oxo-core' ),
			'options' => oxo_shortcodes_categories( 'portfolio_category' )
		),		
		'number_posts' => array(
			'std' => 4,
			'type' => 'text',
			'label' => __( 'Number of Posts', 'oxo-core' ),
			'desc' => __('Select the number of posts to display', 'oxo-core')
		),
		'offset' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Post Offset', 'oxo-core' ),
			'desc' => __('The number of posts to skip. ex: 1.', 'oxo-core')
		),			
		'excerpt_length' => array(
			'std' => 35,
			'type' => 'text',
			'label' => __( 'Excerpt Length', 'oxo-core' ),
			'desc' => __('Insert the number of words/characters you want to show in the excerpt', 'oxo-core'),
		),
		'strip_html' => array(
			'type' => 'select',
			'label' => __( 'Strip HTML from Posts Content', 'oxo-core' ),
			'desc' =>  __( 'Strip HTML from the post excerpt.', 'oxo-core' ),
			'options' => $choices
		),		
		'carousel_layout' => array(
			'type' => 'select',
			'label' => __( 'Carousel Layout', 'oxo-core' ),
			'desc' => __( 'Choose to show titles on rollover image, or below image.', 'oxo-core' ),
			'options' => array(
				'title_on_rollover' => __('Title on rollover', 'oxo-core'),
				'title_below_image' => __('Title below image', 'oxo-core'),
			)
		),
		'scroll_items' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Scroll Items', 'oxo-core' ),
			"desc" => __("Insert the amount of items to scroll. Leave empty to scroll number of visible items.", "oxo-core"),
		),		
		'autoplay' => array(
			'type' => 'select',
			'label' => __( 'Carousel Autoplay', 'oxo-core' ),
			'desc' => __('Choose to autoplay the carousel.', 'oxo-core'),
			'options' => $reverse_choices
		),
		'show_nav' => array(
			'type' => 'select',
			'label' => __( 'Carousel Show Navigation', 'oxo-core' ),
			'desc' => __( 'Choose to show navigation buttons on the carousel.', 'oxo-core' ),
			'options' => $choices
		),	
		'mouse_scroll' => array(
			'type' => 'select',
			'label' => __( 'Carousel Mouse Scroll', 'oxo-core' ),
			'desc' => __( 'Choose to enable mouse drag control on the carousel.', 'oxo-core' ),
			'options' => $reverse_choices
		),	
		'animation_type' => array(
			'type' => 'select',
			'label' => __( 'Animation Type', 'oxo-core' ),
			'desc' => __( 'Select the type on animation to use on the shortcode', 'oxo-core' ),
			'options' => $animation_type,
		),
		'animation_direction' => array(
			'type' => 'select',
			'label' => __( 'Direction of Animation', 'oxo-core' ),
			'desc' => __( 'Select the incoming direction for the animation', 'oxo-core' ),
			'options' => $animation_direction,
		),
		'animation_speed' => array(
			'type' => 'select',
			'std' => '',
			'label' => __( 'Speed of Animation', 'oxo-core' ),
			'desc' => __( 'Type in speed of animation in seconds (0.1 - 1)', 'oxo-core' ),
			'options' => $dec_numbers,
		),
		'animation_offset' => array(
			'type' 		=> 'select',
			'std' 		=> '',
			'label' 	=> __( 'Offset of Animation', 'oxo-core' ),
			'desc' 		=> __( 'Choose when the animation should start.', 'oxo-core' ),
			'options' 	=> array(
					  			''					=> __( 'Default', 'oxo-core' ),				
								'top-into-view' 	=> __( 'Top of element hits bottom of viewport', 'oxo-core' ),
								'top-mid-of-view' 	=> __( 'Top of element hits middle of viewport', 'oxo-core' ),
								'bottom-in-view' 	=> __( 'Bottom of element enters viewport', 'oxo-core' ),
							)
		),		
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core' )
		),			
	),
	'shortcode' => '[recent_works picture_size="{{picture_size}}" layout="{{layout}}" boxed_text="{{boxed_text}}" filters="{{filters}}" columns="{{columns}}" column_spacing="{{column_spacing}}" cat_slug="{{cat_slug}}" exclude_cats="{{exclude_cats}}" number_posts="{{number_posts}}" offset="{{offset}}" excerpt_length="{{excerpt_length}}" strip_html="{{strip_html}}" carousel_layout="{{carousel_layout}}" scroll_items="{{scroll_items}}" autoplay="{{autoplay}}" show_nav="{{show_nav}}" mouse_scroll="{{mouse_scroll}}" animation_type="{{animation_type}}" animation_direction="{{animation_direction}}" animation_speed="{{animation_speed}}" animation_offset="{{animation_offset}}" class="{{class}}" id="{{id}}"][/recent_works]',
	'popup_title' => __( 'Recent Works Shortcode', 'oxo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Section Separator Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['sectionseparator'] = array(
	'no_preview' => true,
	'params' => array(
		'divider_candy' => array(
			'type' => 'select',
			'label' => __( 'Position of the Divider Candy', 'oxo-core' ),
			'desc' => __( 'Select the position of the triangle candy.', 'oxo-core' ),
			'options' => array(
				'top' => __('Top', 'oxo-core'),
				'bottom' => __('Bottom', 'oxo-core'),
				'bottom,top' => __('Top and Bottom', 'oxo-core'),
			)
		),
		'icon' => array(
			'type' => 'iconpicker',
			'label' => __( 'Select Icon', 'oxo-core' ),
			'desc' => __( 'Click an icon to select, click again to deselect', 'oxo-core' ),
			'options' => $icons
		),
		'iconcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Icon Color', 'oxo-core' ),
			'desc' => __( 'Leave blank for theme option selection.', 'oxo-core' )
		),
		'border' => array(
			'std' => '1px',
			'type' => 'text',
			'label' => __( 'Border Size', 'oxo-core' ),
			'desc' => __( 'In pixels (px), ex: 1px. Leave blank for theme option selection.', 'oxo-core' ),
		),
		'bordercolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Border Color', 'oxo-core' ),
			'desc' => __( 'Controls the border color. Leave blank for theme option selection.', 'oxo-core' ),
		),
		'backgroundcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Background Color of Divider Candy', 'oxo-core' ),
			'desc' => __( 'Controls the background color of the triangle. Leave blank for theme option selection.', 'oxo-core' ),
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core' )
		),			
	),
	'shortcode' => '[section_separator divider_candy="{{divider_candy}}" icon="{{icon}}" icon_color="{{iconcolor}}" bordersize="{{border}}" bordercolor="{{bordercolor}}" backgroundcolor="{{backgroundcolor}}" class="{{class}}" id="{{id}}"]',
	'popup_title' => __( 'Section Separator Shortcode', 'oxo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Separator Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['separator'] = array(
	'no_preview' => true,
	'params' => array(

		'style_type' => array(
			'type' => 'select',
			'label' => __( 'Style', 'oxo-core' ),
			'desc' => __( 'Choose the separator line style', 'oxo-core' ),
			'options' => array(
				'none' => __('No Style', 'oxo-core'),
				'single' => __('Single Border Solid', 'oxo-core'),
				'double' => __('Double Border Solid', 'oxo-core'),
				'single|dashed' => __('Single Border Dashed', 'oxo-core'),
				'double|dashed' => __('Double Border Dashed', 'oxo-core'),
				'single|dotted' => __('Single Border Dotted', 'oxo-core'),
				'double|dotted' => __('Double Border Dotted', 'oxo-core'),
				'shadow' => __('Shadow', 'oxo-core')
			)
		),	
		'topmargin' => array(
			'std' => 40,
			'type' => 'text',
			'label' => __( 'Margin Top', 'oxo-core' ),
			'desc' => __( 'Spacing above the separator. In pixels or percentage, ex: 10px or 10%.', 'oxo-core' ),
		),
		'bottommargin' => array(
			'std' => 40,
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'oxo-core' ),
			'desc' => __( 'Spacing below the separator. In pixels or percentage, ex: 10px or 10%.', 'oxo-core' ),
		),
		'sepcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Separator Color', 'oxo-core' ),
			'desc' => __( 'Controls the separator color. Leave blank for theme option selection.', 'oxo-core' )
		),
		'border_size' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Border Size', 'oxo-core' ),
			'desc' => __( 'In pixels (px), ex: 1px. Leave blank for theme option selection.', 'oxo-core' ),
		),
		'icon' => array(
			'type' => 'iconpicker',
			'label' => __( 'Select Icon', 'oxo-core' ),
			'desc' => __( 'Click an icon to select, click again to deselect.', 'oxo-core' ),
			'options' => $icons
		),
		'icon_circle' => array(
			'type' => 'select',
			'label' => __( 'Circled Icon', 'oxo-core' ),
			'desc' => __( 'Choose to have a circle in separator color around the icon.', 'oxo-core' ),
			'options' => $choices_with_default
		),	
		'icon_circle_color' => array(
			'type' => 'colorpicker',
			'label' => __( 'Circle Color', 'oxo-core' ),
			'desc' => __( 'Controls the background color of the circle around the icon.', 'oxo-core' )
		),
		'width' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Separator Width', 'oxo-core' ),
			'desc' => __( 'In pixels (px or %), ex: 1px, ex: 50%. Leave blank for full width.', 'oxo-core' ),
		),
		'alignment' => array(
			'std' => 'center',
			'type' => 'select',
			'label' => __( 'Alignment', 'oxo-core' ),
			'desc' => __( 'Select the separator alignment; only works when a width is specified.', 'oxo-core' ),
			'options' => array(
				'center' => __('Center', 'oxo-core'),
				'left' => __('Left', 'oxo-core'),
				'right' => __('Right', 'oxo-core'),
			)			
		),			
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core' )
		),			
	),
	'shortcode' => '[separator style_type="{{style_type}}" top_margin="{{topmargin}}" bottom_margin="{{bottommargin}}"  sep_color="{{sepcolor}}" border_size="{{border_size}}" icon="{{icon}}" icon_circle="{{icon_circle}}" icon_circle_color="{{icon_circle_color}}" width="{{width}}" alignment="{{alignment}}" class="{{class}}" id="{{id}}"]',
	'popup_title' => __( 'Separator Shortcode', 'oxo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Sharing Box Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['sharingbox'] = array(
	'no_preview' => true,
	'params' => array(
		'tagline' => array(
			'std' => __('Share This Story, Choose Your Platform!', 'oxo-core'),
			'type' => 'text',
			'label' => __( 'Tagline', 'oxo-core' ),
			'desc' => __('The title tagline that will display', 'oxo-core')
		),
		'taglinecolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Tagline Color', 'oxo-core' ),
			'desc' => __( 'Controls the text color. Leave blank for theme option selection.', 'oxo-core')
		),
		'backgroundcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Background Color', 'oxo-core' ),
			'desc' => __( 'Controls the background color. Leave blank for theme option selection.', 'oxo-core')
		),
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Title', 'oxo-core' ),
			'desc' => __('The post title that will be shared', 'oxo-core')
		),
		'link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Link', 'oxo-core' ),
			'desc' => __('The link that will be shared', 'oxo-core')
		),
		'description' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Description', 'oxo-core' ),
			'desc' => __('The description that will be shared', 'oxo-core')
		),
		'link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Link to Share', 'oxo-core' ),
			'desc' => ''
		),
		'iconboxed' => array(
			'type' => 'select',
			'label' => __( 'Boxed Social Icons', 'oxo-core' ),
			'desc' => __( 'Choose to get a boxed icons. Choose default for theme option selection.', 'oxo-core' ),
			'options' => $reverse_choices_with_default
		),
		'iconboxedradius' => array(
			'std' => '4px',
			'type' => 'text',
			'label' => __( 'Social Icon Box Radius', 'oxo-core' ),
			'desc' => __( 'Choose the radius of the boxed icons. In pixels (px), ex: 1px, or "round". Leave blank for theme option selection.', 'oxo-core' ),
		),	
		'iconcolor' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Social Icon Custom Colors', 'oxo-core' ),
			'desc' => __( 'Specify the color of social icons. Use one hex value for all or separate by | symbol for multi-color. ex: #AA0000|#00AA00|#0000AA. Leave blank for theme option selection.', 'oxo-core' ),
		),
		'boxcolor' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Social Icon Custom Box Colors', 'oxo-core' ),
			'desc' => __( 'Specify the box color of social icons. Use one hex value for all or separate by | symbol for multi-color. ex: #AA0000|#00AA00|#0000AA. Leave blank for theme option selection.', 'oxo-core' ),
		),
		'icontooltip' => array(
			'type' => 'select',
			'label' => __( 'Social Icon Tooltip Position', 'oxo-core' ),
			'desc' => __( 'Choose the display position for tooltips. Choose default for theme option selection.', 'oxo-core' ),
			'options' => array(
				'' => __('Default', 'oxo-core'),
				'top' => __('Top', 'oxo-core'),
				'bottom' => __('Bottom', 'oxo-core'),
				'left' => __('Left', 'oxo-core'),
				'right' => __('Right', 'oxo-core'),
			)
		),		
		'pinterest_image' => array(
			'std' => '',
			'type' => 'uploader',
			'label' => __( 'Choose Image to Share on Pinterest', 'oxo-core' ),
			'desc' => ''
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core' )
		),			
	),
	'shortcode' => '[sharing tagline="{{tagline}}" tagline_color="{{taglinecolor}}" title="{{title}}" link="{{link}}" description="{{description}}" pinterest_image="{{pinterest_image}}" icons_boxed="{{iconboxed}}" icons_boxed_radius="{{iconboxedradius}}" box_colors="{{boxcolor}}" icon_colors="{{iconcolor}}" tooltip_placement="{{icontooltip}}" backgroundcolor="{{backgroundcolor}}" class="{{class}}" id="{{id}}"][/sharing]',
	'popup_title' => __( 'Sharing Box Shortcode', 'oxo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Slider Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['slider'] = array(
	'params' => array(
		'hover_type' => array(
			'std' => 'none',
			'type' => 'select',
			'label' => __( 'Hover Type', 'oxo-core' ),
			'desc' => __('Select the hover effect type.', 'oxo-core'),
			'options' => array(
				'none' => __('None', 'oxo-core'),
				'zoomin' => __('Zoom In', 'oxo-core'),
				'zoomout' => __('Zoom Out', 'oxo-core'),
				'liftup' => __('Lift Up', 'oxo-core')
			)
		),
		'size' => array(
			'std' => '100%',
			'type' => 'size',
			'label' => __( 'Image Size (Width/Height)', 'oxo-core' ),
			'desc' => __( 'Width and Height in percentage (%) or pixels (px)', 'oxo-core' ),
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core' )
		),			
	),
	'shortcode' => '[slider hover_type="{{hover_type}}" width="{{size_width}}" height="{{size_height}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/slider]', // as there is no wrapper shortcode
	'popup_title' => __( 'Slider Shortcode', 'oxo-core' ),
	'no_preview' => true,

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'slider_type' => array(
				'type' => 'select',
				'label' => __( 'Slide Type', 'oxo-core' ),
				'desc' => __('Choose a video or image slide', 'oxo-core'),
				'options' => array(
					'image' => __('Image', 'oxo-core'),
					'video' => __('Video', 'oxo-core')
				)
			),
			'video_content' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => __( 'Video Shortcode or Video Embed Code', 'oxo-core' ),
				'desc' => __('Click the Youtube or Vimeo Shortcode button below then enter your unique video ID, or copy and paste your video embed code.<a href=\'[youtube id="Enter video ID (eg. Wq4Y7ztznKc)" width="600" height="350"]\' class="oxo-shortcodes-button oxo-add-video-shortcode">Insert Youtube Shortcode</a><a href=\'[vimeo id="Enter video ID (eg. 10145153)" width="600" height="350"]\' class="oxo-shortcodes-button oxo-add-video-shortcode">Insert Vimeo Shortcode</a>', 'oxo-core')
			),
			'image_content' => array(
				'std' => '',
				'type' => 'uploader',
				'label' => __( 'Slide Image', 'oxo-core' ),
				'desc' => __('Upload an image to display in the slide', 'oxo-core')
			),
			'image_url' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Full Image Link or External Link', 'oxo-core' ),
				'desc' => __('Add the url of where the image will link to. If lightbox option is enabled,and you don\'t add the full image link, lightbox will open slide image', 'oxo-core')
			),
			'image_target' => array(
				'type' => 'select',
				'label' => __( 'Link Target', 'oxo-core' ),
				'desc' => __( '_self = open in same window <br /> _blank = open in new window', 'oxo-core' ),
				'options' => array(
					'_self' => '_self',
					'_blank' => '_blank'
				)
			),
			'image_lightbox' => array(
				'type' => 'select',
				'label' => __( 'Lighbox', 'oxo-core' ),
				'desc' => __( 'Show image in Lightbox', 'oxo-core' ),
				'options' => $choices
			),
		),
		'shortcode' => '[slide type="{{slider_type}}" link="{{image_url}}" linktarget="{{image_target}}" lightbox="{{image_lightbox}}"]{{image_content}}[/slide]',
		'clone_button' => __( 'Add New Slide', 'oxo-core')
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Social Links Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['sociallinks'] = array(
	'no_preview' => true,
	'params' => array(
		'iconboxed' => array(
			'type' => 'select',
			'label' => __( 'Boxed Social Icons', 'oxo-core' ),
			'desc' => __( 'Choose to get a boxed icons. Choose default for theme option selection.', 'oxo-core' ),
			'options' => $reverse_choices_with_default
		),
		'iconboxedradius' => array(
			'std' => '4px',
			'type' => 'text',
			'label' => __( 'Social Icon Box Radius', 'oxo-core' ),
			'desc' => __( 'Choose the radius of the boxed icons. In px or %, ex: 5px or 10% or "round". Leave blank for theme option selection.', 'oxo-core' ),
		),
		'iconcolor' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Social Icon Custom Colors', 'oxo-core' ),
			'desc' => __( 'Specify the color of social icons. Use one hex value for all or separate by | symbol for multi-color. ex: #AA0000|#00AA00|#0000AA. Leave blank for theme option selection.', 'oxo-core' ),
		),
		'boxcolor' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Social Icon Custom Box Colors', 'oxo-core' ),
			'desc' => __( 'Specify the box color of social icons. Use one hex value for all or separate by | symbol for multi-color. ex: #AA0000|#00AA00|#0000AA. Leave blank for theme option selection.', 'oxo-core' ),
		),
		'icontooltip' => array(
			'type' => 'select',
			'label' => __( 'Social Icon Tooltip Position', 'oxo-core' ),
			'desc' => __( 'Choose the display position for tooltips. Choose default for theme option selection.', 'oxo-core' ),
			'options' => array(
				'' => __('Default', 'oxo-core'),
				'top' => __('Top', 'oxo-core'),
				'bottom' => __('Bottom', 'oxo-core'),
				'left' => __('Left', 'oxo-core'),
				'Right' => __('Right', 'oxo-core'),
			)
		),			
		'facebook' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Facebook Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom Facebook link', 'oxo-core' ),
		),
		'twitter' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Twitter Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom Twitter link', 'oxo-core' ),
		),
		'instagram' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Instagram Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom Instagram link', 'oxo-core' ),
		),
		'dribbble' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Dribbble Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom Dribbble link', 'oxo-core' ),
		),
		'google' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Google+ Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom Google+ link', 'oxo-core' ),
		),
		'linkedin' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'LinkedIn Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom LinkedIn link', 'oxo-core' ),
		),
		'blogger' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Blogger Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom Blogger link', 'oxo-core' ),
		),
		'tumblr' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Tumblr Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom Tumblr link', 'oxo-core' ),
		),
		'reddit' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Reddit Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom Reddit link', 'oxo-core' ),
		),
		'yahoo' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Yahoo Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom Yahoo link', 'oxo-core' ),
		),
		'deviantart' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Deviantart Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom Deviantart link', 'oxo-core' ),
		),
		'vimeo' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Vimeo Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom Vimeo link', 'oxo-core' ),
		),
		'youtube' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Youtube Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom Youtube link', 'oxo-core' ),
		),
		'pinterest' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Pinterst Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom Pinterest link', 'oxo-core' ),
		),
		'rss' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'RSS Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom RSS link', 'oxo-core' ),
		),		
		'digg' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Digg Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom Digg link', 'oxo-core' ),
		),
		'flickr' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Flickr Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom Flickr link', 'oxo-core' ),
		),
		'forrst' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Forrst Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom Forrst link', 'oxo-core' ),
		),
		'myspace' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Myspace Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom Myspace link', 'oxo-core' ),
		),
		'skype' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Skype Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom Skype link', 'oxo-core' ),
		),
		'paypal' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'PayPal Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom paypal link', 'oxo-core' ),
		),
		'dropbox' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Dropbox Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom dropbox link', 'oxo-core' ),
		),
		'soundcloud' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'SoundCloud Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom soundcloud link', 'oxo-core' ),
		),
		'vk' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'VK Link', 'oxo-core' ),
			'desc' => __( 'Insert your custom vk link', 'oxo-core' ),
		),
		'email' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Email Address', 'oxo-core' ),
			'desc' => __( 'Insert an email address to display the email icon', 'oxo-core' ),
		),
		'show_custom' => array(
			'type' => 'select',
			'label' => __( 'Show Custom Social Icon', 'oxo-core' ),
			'desc' => __( 'Show the custom social icon specified in Theme Options', 'oxo-core' ),
			'options' => $reverse_choices
		),
		'alignment' => array(
			'type' => 'select',
			'std' => '',
			'label' => __( 'Alignment', 'oxo-core' ),
			'desc' => __( 'Select the icon\'s alignment.', 'oxo-core' ),
			'options' => array(
				'left' => __('Left', 'oxo-core'),
				'center' => __('Center', 'oxo-core'),
				'right' => __('Right', 'oxo-core'),
			)
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core' )
		),			
	),
	'shortcode' => '[social_links icons_boxed="{{iconboxed}}" icons_boxed_radius="{{iconboxedradius}}" icon_colors="{{iconcolor}}" box_colors="{{boxcolor}}" tooltip_placement="{{icontooltip}}" rss="{{rss}}" facebook="{{facebook}}" twitter="{{twitter}}" instagram="{{instagram}}" dribbble="{{dribbble}}" google="{{google}}" linkedin="{{linkedin}}" blogger="{{blogger}}" tumblr="{{tumblr}}" reddit="{{reddit}}" yahoo="{{yahoo}}" deviantart="{{deviantart}}" vimeo="{{vimeo}}" youtube="{{youtube}}" pinterest="{{pinterest}}" digg="{{digg}}" flickr="{{flickr}}" forrst="{{forrst}}" myspace="{{myspace}}" skype="{{skype}}" paypal="{{paypal}}" dropbox="{{dropbox}}" soundcloud="{{soundcloud}}" vk="{{vk}}" email="{{email}}" show_custom="{{show_custom}}" alignment="{{alignment}}" class="{{class}}" id="{{id}}"]',
	'popup_title' => __( 'Social Links Shortcode', 'oxo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	SoundCloud Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['soundcloud'] = array(
	'no_preview' => true,
	'params' => array(

		'url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'SoundCloud Url', 'oxo-core' ),
			'desc' => __('The SoundCloud url, ex: http://api.soundcloud.com/tracks/110813479', 'oxo-core')
		),
		'layout' => array(
			'type' => 'select',
			'label' => __( 'Layout', 'oxo-core' ),
			'desc' => __('Choose the layout of the soundcloud embed.', 'oxo-core'),
			'options' => array( 'classic' => 'Classic', 'visual' => 'Visual' )
		),			
		'comments' => array(
			'type' => 'select',
			'label' => __( 'Show Comments', 'oxo-core' ),
			'desc' => __('Choose to display comments', 'oxo-core'),
			'options' => $choices
		),
		'show_related' => array(
			'type' => 'select',
			'label' => __( 'Show Related', 'oxo-core' ),
			'desc' => __('Choose to display related items.', 'oxo-core'),
			'options' => $choices
		),	
		'show_user' => array(
			'type' => 'select',
			'label' => __( 'Show User', 'oxo-core' ),
			'desc' => __('Choose to display the user who posted the item.', 'oxo-core'),
			'options' => $choices
		),		
		'autoplay' => array(
			'type' => 'select',
			'label' => __( 'Autoplay', 'oxo-core' ),
			'desc' => __('Choose to autoplay the track', 'oxo-core'),
			'options' => $reverse_choices
		),
		'color' => array(
			'type' => 'colorpicker',
			'std' => '#ff7700',
			'label' => __( 'Color', 'oxo-core' ),
			'desc' => __('Select the color of the shortcode', 'oxo-core')
		),
		'width' => array(
			'std' => '100%',
			'type' => 'text',
			'label' => __( 'Width', 'oxo-core' ),
			'desc' => __('In pixels (px) or percentage (%)', 'oxo-core')
		),
		'height' => array(
			'std' => '150px',
			'type' => 'text',
			'label' => __( 'Height', 'oxo-core' ),
			'desc' => __('In pixels (px)', 'oxo-core')
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core' )
		),			
	),
	'shortcode' => '[soundcloud url="{{url}}" layout="{{layout}}" comments="{{comments}}" show_related="{{show_related}}" show_user="{{show_user}}" auto_play="{{autoplay}}" color="{{color}}" width="{{width}}" height="{{height}}" class="{{class}}" id="{{id}}"]',
	'popup_title' => __( 'Sharing Box Shortcode', 'oxo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Table Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['table'] = array(
	'no_preview' => true,
	'params' => array(

		'type' => array(
			'type' => 'select',
			'label' => __( 'Type', 'oxo-core' ),
			'desc' => __( 'Select the table style', 'oxo-core' ),
			'options' => array(
				'1' => __('Style 1', 'oxo-core'),
				'2' => __('Style 2', 'oxo-core'),
			)
		),
		'columns' => array(
			'type' => 'select',
			'label' => __( 'Number of Columns', 'oxo-core' ),
			'desc' => __('Select how many columns to display', 'oxo-core'),
			'options' => array(
				'1' => '1 Column',
				'2' => '2 Columns',
				'3' => '3 Columns',
				'4' => '4 Columns',
				'5' => '5 Columns',
				'6' => '6 Columns'				
			)
		)
	),
	'shortcode' => '',
	'popup_title' => __( 'Table Shortcode', 'oxo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Tabs Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['tabs'] = array(
	'no_preview' => true,
	'params' => array(
		'design' => array(
			'type' => 'select',
			'label' => __( 'Design', 'oxo-core' ),
			'desc' => __( 'Choose a design for the shortcode.', 'oxo-core' ),
			'options' => array(
				'classic' => __('Classic', 'oxo-core'),
				'clean' => __('Clean', 'oxo-core')
			)
		),	
		'layout' => array(
			'type' => 'select',
			'label' => __( 'Layout', 'oxo-core' ),
			'desc' => __( 'Choose the layout of the shortcode', 'oxo-core' ),
			'options' => array(
				'horizontal' => __('Horizontal', 'oxo-core'),
				'vertical' => __('Vertical', 'oxo-core')
			)
		),
		'justified' => array(
			'type' => 'select',
			'label' => __( 'Justify Tabs', 'oxo-core' ),
			'desc' => __( 'Choose to get tabs stretched over full shortcode width.', 'oxo-core' ),
			'options' => $choices
		),		
		'backgroundcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Background Color', 'oxo-core' ),
			'desc' => __( 'Controls the background tab color.  Leave blank for theme option selection.', 'oxo-core' ),
		),
		'inactivecolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Inactive Color', 'oxo-core' ),
			'desc' => __( 'Controls the inactive tab color. Leave blank for theme option selection.', 'oxo-core' ),
		),
		'bordercolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Border Color', 'oxo-core' ),
			'desc' => __( 'Controls the color of the outer tab border. Leave blank for theme option selection.', 'oxo-core' ),
		),		
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core' )
		),			
	),

	'shortcode' => '[oxo_tabs design="{{design}}" layout="{{layout}}" justified="{{justified}}" backgroundcolor="{{backgroundcolor}}" inactivecolor="{{inactivecolor}}" bordercolor="{{bordercolor}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/oxo_tabs]',
	'popup_title' => __( 'Insert Tab Shortcode', 'oxo-core' ),

	'child_shortcode' => array(
		'params' => array(
			'title' => array(
				'std' => __('Title', 'oxo-core'),
				'type' => 'text',
				'label' => __( 'Tab Title', 'oxo-core' ),
				'desc' => __( 'Title of the tab', 'oxo-core' ),
			),
			'icon' => array(
				'type' => 'iconpicker',
				'label' => __( 'Select Icon', 'oxo-core' ),
				'desc' => __( 'Display an icon next to tab title. Click an icon to select, click again to deselect.', 'oxo-core' ),
				'options' => $icons
			),			
			'content' => array(
				'std' => __('Tab Content', 'oxo-core'),
				'type' => 'textarea',
				'label' => __( 'Tab Content', 'oxo-core' ),
				'desc' => __( 'Add the tabs content', 'oxo-core' )
			)
		),
		'shortcode' => '[oxo_tab title="{{title}}" icon="{{icon}}"]{{content}}[/oxo_tab]',
		'clone_button' => __( 'Add Tab', 'oxo-core' )
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Tagline Box Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['taglinebox'] = array(
	'no_preview' => true,
	'params' => array(
		'backgroundcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Background Color', 'oxo-core' ),
			'desc' => __( 'Controls the background color. Leave blank for theme option selection.', 'oxo-core' ),
		),
		'shadow' => array(
			'type' => 'select',
			'label' => __( 'Shadow', 'oxo-core' ),
			'desc' => __( 'Show the shadow below the box', 'oxo-core' ),
			'options' => $reverse_choices
		),
		'shadowopacity' => array(
			'type' => 'select',
			'label' => __( 'Shadow Opacity', 'oxo-core' ),
			'desc' => __( 'Choose the opacity of the shadow', 'oxo-core' ),
			'options' => $dec_numbers
		),
		'border' => array(
			'std' => '1px',
			'type' => 'text',
			'label' => __( 'Border Size', 'oxo-core' ),
			'desc' => __( 'In pixels (px), ex: 1px', 'oxo-core' ),
		),
		'bordercolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Border Color', 'oxo-core' ),
			'desc' => __( 'Controls the border color. Leave blank for theme option selection.', 'oxo-core' ),
		),
		'highlightposition' => array(
			'type' => 'select',
			'label' => __( 'Highlight Border Position', 'oxo-core' ),
			'desc' => __( 'Choose the position of the highlight. This border highlight is from theme options primary color and does not take the color from border color above', 'oxo-core' ),
			'options' => array(
				'top' => __('Top', 'oxo-core'),
				'bottom' => __('Bottom', 'oxo-core'),
				'left' => __('Left', 'oxo-core'),
				'right' => __('Right', 'oxo-core'),
				'none' => __('None', 'oxo-core'),
			)
		),
		'contentalignment' => array(
			'type' => 'select',
			'label' => __( 'Content Alignment', 'oxo-core' ),
			'desc' => __( 'Choose how the content should be displayed.', 'oxo-core' ),
			'options' => array(
				'left' => __('Left', 'oxo-core'),
				'center' => __('Center', 'oxo-core'),
				'right' => __('Right', 'oxo-core'),
			)
		),		
		'button' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Button Text', 'oxo-core' ),
			'desc' => __( 'Insert the text that will display in the button', 'oxo-core' ),
		),
		'url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Link', 'oxo-core' ),
			'desc' => __( 'The url the button will link to', 'oxo-core')
		),		
		'target' => array(
			'type' => 'select',
			'label' => __( 'Link Target', 'oxo-core' ),
			'desc' => __( '_self = open in same window <br /> _blank = open in new window', 'oxo-core' ),
			'options' => array(
				'_self' => '_self',
				'_blank' => '_blank'
			)
		),
		'modal' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Modal Window Anchor', 'oxo-core' ),
			'desc' => __( 'Add the class name of the modal window you want to open on button click.', 'oxo-core' ),
		),			
		'buttonsize' => array(
			'type' => 'select',
			'label' => __( 'Button Size', 'oxo-core' ),
			'desc' => __( 'Select the button\'s size.', 'oxo-core' ),
			'options' => array(
				'' => __('Default', 'oxo-core'),
				'small' => __('Small', 'oxo-core'),
				'medium' => __('Medium', 'oxo-core'),
				'large' => __('Large', 'oxo-core'),
				'xlarge' => __('XLarge', 'oxo-core'),
			)
		),
		'buttontype' => array(
			'type' => 'select',
			'label' => __( 'Button Type', 'oxo-core' ),
			'desc' => __( 'Select the button\'s type.', 'oxo-core' ),
			'options' => array(
				'' => __('Default', 'oxo-core'),
				'flat' => __('Flat', 'oxo-core'),
				'3d' => '3D',
			)
		),
		'buttonshape' => array(
			'type' => 'select',
			'label' => __( 'Button Shape', 'oxo-core' ),
			'desc' => __( 'Select the button\'s shape.', 'oxo-core' ),
			'options' => array(
				'' => __('Default', 'oxo-core'),
				'square' => __('Square', 'oxo-core'),
				'pill' => __('Pill', 'oxo-core'),
				'round' => __('Round', 'oxo-core'),
			)
		),		
		'buttoncolor' => array(
			'type' => 'select',
			'label' => __( 'Button Color', 'oxo-core' ),
			'desc' => __( 'Choose the button color <br />Default uses theme option selection', 'oxo-core' ),
			'options' => array(
				'' => __('Default', 'oxo-core'),
				'green' => __('Green', 'oxo-core'),
				'darkgreen' => __('Dark Green', 'oxo-core'),
				'orange' => __('Orange', 'oxo-core'),
				'blue' => __('Blue', 'oxo-core'),
				'red' => __('Red', 'oxo-core'),
				'pink' => __('Pink', 'oxo-core'),
				'darkgray' => __('Dark Gray', 'oxo-core'),
				'lightgray' => __('Light Gray', 'oxo-core'),
			)
		),
		'title' => array(
			'type' => 'textarea',
			'label' => __( 'Tagline Title', 'oxo-core' ),
			'desc' => __( 'Insert the title text', 'oxo-core' ),
			'std' => __('Title', 'oxo-core')
		),
		'description' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Tagline Description', 'oxo-core' ),
			'desc' => __( 'Insert the description text', 'oxo-core' ),
		),
		'content' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Additional Content', 'oxo-core' ),
			'desc' => __( 'This is additional content you can add to the tagline box. This will show below the title and description if one is used.', 'oxo-core' ),
		),
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'oxo-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'oxo-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'oxo-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'oxo-core' )
		),		
		'animation_type' => array(
			'type' => 'select',
			'label' => __( 'Animation Type', 'oxo-core' ),
			'desc' => __( 'Select the type on animation to use on the shortcode', 'oxo-core' ),
			'options' => $animation_type,
		),
		'animation_direction' => array(
			'type' => 'select',
			'label' => __( 'Direction of Animation', 'oxo-core' ),
			'desc' => __( 'Select the incoming direction for the animation', 'oxo-core' ),
			'options' => $animation_direction,
		),
		'animation_speed' => array(
			'type' => 'select',
			'std' => '',
			'label' => __( 'Speed of Animation', 'oxo-core' ),
			'desc' => __( 'Type in speed of animation in seconds (0.1 - 1)', 'oxo-core' ),
			'options' => $dec_numbers,
		),
		'animation_offset' => array(
			'type' 		=> 'select',
			'std' 		=> '',
			'label' 	=> __( 'Offset of Animation', 'oxo-core' ),
			'desc' 		=> __( 'Choose when the animation should start.', 'oxo-core' ),
			'options' 	=> array(
					  			''					=> __( 'Default', 'oxo-core' ),				
								'top-into-view' 	=> __( 'Top of element hits bottom of viewport', 'oxo-core' ),
								'top-mid-of-view' 	=> __( 'Top of element hits middle of viewport', 'oxo-core' ),
								'bottom-in-view' 	=> __( 'Bottom of element enters viewport', 'oxo-core' ),
							)
		),		
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core' )
		),			
	),
	'shortcode' => '[tagline_box backgroundcolor="{{backgroundcolor}}" shadow="{{shadow}}" shadowopacity="{{shadowopacity}}" border="{{border}}" bordercolor="{{bordercolor}}" highlightposition="{{highlightposition}}" content_alignment="{{contentalignment}}" link="{{url}}" linktarget="{{target}}" modal="{{modal}}" button_size="{{buttonsize}}" button_shape="{{buttonshape}}" button_type="{{buttontype}}" buttoncolor="{{buttoncolor}}" button="{{button}}" title="{{title}}" description="{{description}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" animation_type="{{animation_type}}" animation_direction="{{animation_direction}}" animation_speed="{{animation_speed}}" animation_offset="{{animation_offset}}" class="{{class}}" id="{{id}}"]{{content}}[/tagline_box]',
	'popup_title' => __( 'Insert Tagline Box Shortcode', 'oxo-core')
);

/*-----------------------------------------------------------------------------------*/
/*	Testimonials Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['testimonials'] = array(
	'no_preview' => true,
	'params' => array(
		'design' => array(
			'type' => 'select',
			'label' => __( 'Design', 'oxo-core' ),
			'desc' => __( 'Choose a design for the shortcode.', 'oxo-core' ),
			'options' => array(
				'classic' => __('Classic', 'oxo-core'),
				'clean' => __('Clean', 'oxo-core')
			)
		),	
		'backgroundcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Background Color', 'oxo-core' ),
			'desc' => __( 'Controls the background color.  Leave blank for theme option selection.', 'oxo-core' ),
		),
		'textcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Text Color', 'oxo-core' ),
			'desc' => __( 'Controls the text color. Leave blank for theme option selection.', 'oxo-core' ),
		),
		'random' => array(
			'type' => 'select',
			'label' => __( 'Random Order', 'oxo-core' ),
			'desc' => __( 'Choose to display testimonials in random order.', 'oxo-core' ),
			'options' => array(
				'' => __( 'Default', 'oxo-core' ),
				'no' => __('No', 'oxo-core'),
				'yes' => __('Yes', 'oxo-core')
			)
		),		
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core' )
		),		
	),
	'shortcode' => '[testimonials design="{{design}}" backgroundcolor="{{backgroundcolor}}" textcolor="{{textcolor}}" random="{{random}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/testimonials]',
	'popup_title' => __( 'Insert Testimonials Shortcode', 'oxo-core' ),

	'child_shortcode' => array(
		'params' => array(
			'name' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Name', 'oxo-core' ),
				'desc' => __( 'Insert the name of the person.', 'oxo-core' ),
			),
			'avatar' => array(
				'type' => 'select',
				'label' => __( 'Avatar', 'oxo-core' ),
				'desc' => __( 'Choose which kind of Avatar to be displayed.', 'oxo-core' ),
				'options' => array(
					'male' => __('Male', 'oxo-core'),
					'female' => __('Female', 'oxo-core'),
					'image' => __('Image', 'oxo-core'),
					'none' => __('None', 'oxo-core')
				)
			),
			'image' => array(
				'type' => 'uploader',
				'label' => __( 'Custom Avatar', 'oxo-core' ),
				'desc' => __( 'Upload a custom avatar image.', 'oxo-core' ),
			),
			'image_border_radius' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Border Radius', 'oxo-core' ),
				'desc' => __( 'Choose the radius of the testimonial image. In pixels (px), ex: 1px, or "round".  Leave blank for theme option selection.', 'oxo-core' ),
			),				
			'company' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Company', 'oxo-core' ),
				'desc' => __( 'Insert the name of the company.', 'oxo-core' ),
			),
			'link' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Link', 'oxo-core' ),
				'desc' => __( 'Add the url the company name will link to.', 'oxo-core' ),
			),
			'target' => array(
				'type' => 'select',
				'label' => __( 'Target', 'oxo-core' ),
				'desc' => __( '_self = open in same window <br />_blank = open in new window.', 'oxo-core' ),
				'options' => array(
					'_self' => '_self',
					'_blank' => '_blank'
				)
			),
			'content' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => __( 'Testimonial Content', 'oxo-core' ),
				'desc' => __( 'Add the testimonial content', 'oxo-core' ),
			)
		),
		'shortcode' => '[testimonial name="{{name}}" avatar="{{avatar}}" image="{{image}}" image_border_radius="{{image_border_radius}}" company="{{company}}" link="{{link}}" target="{{target}}"]{{content}}[/testimonial]',
		'clone_button' => __( 'Add Testimonial', 'oxo-core' )
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Title Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['title'] = array(
	'no_preview' => true,
	'params' => array(
		'size' => array(
			'type' => 'select',
			'label' => __( 'Title Size', 'oxo-core' ),
			'desc' => __( 'Choose the title size, H1-H6', 'oxo-core' ),
			'options' => oxo_shortcodes_range( 6, false )
		),
		'contentalign' => array(
			'type' => 'select',
			'label' => __( 'Title Alignment', 'oxo-core' ),
			'desc' => __( 'Choose to align the heading left or right.', 'oxo-core' ),
			'options' => array(
				'left' => __('Left', 'oxo-core'),
				'center' => __('Center', 'oxo-core'),
				'right' => __('Right', 'oxo-core')
			)
		),		
		'style_type' => array(
			'type' => 'select',
			'label' => __( 'Separator', 'oxo-core' ),
			'desc' => __( 'Choose the kind of the title separator you want to use.', 'oxo-core' ),
			'options' => array(
				'default'			=> __('Default', 'oxo-core'),
				'single'		  	=> __('Single', 'oxo-core'),
				'single solid'		=> __('Single Solid', 'oxo-core'),
				'single dashed'		=> __('Single Dashed', 'oxo-core'),
				'single dotted'		=> __('Single Dotted', 'oxo-core'),
				'double'	 		=> __('Double', 'oxo-core'),
				'double solid'	 	=> __('Double Solid', 'oxo-core'),
				'double dashed'	 	=> __('Double Dashed', 'oxo-core'),
				'double dotted'	 	=> __('Double Dotted', 'oxo-core'),
				'underline'			=> __('Underline', 'oxo-core'),
				'underline solid'	=> __('Underline Solid', 'oxo-core'),
				'underline dashed'	=> __('Underline Dashed', 'oxo-core'),
				'underline dotted'	=> __('Underline Dotted', 'oxo-core'),
				'none'				=> __('None', 'oxo-core')		
			)
		),		
		'sepcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Separator Color', 'oxo-core' ),
			'desc' => __( 'Controls the separator color.  Leave blank for theme option selection.', 'oxo-core')
		),
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Top Margin', 'oxo-core' ),
			'desc' => __( 'Spacing above the title. In px or em, e.g. 10px.', 'oxo-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Bottom Margin', 'oxo-core' ),
			'desc' => __( 'Spacing below the title. In px or em, e.g. 10px.', 'oxo-core' )
		),			
		'content' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Title', 'oxo-core' ),
			'desc' => __( 'Insert the title text', 'oxo-core' ),
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core' )
		),			
	),
	'shortcode' => '[title size="{{size}}" content_align="{{contentalign}}" style_type="{{style_type}}" sep_color="{{sepcolor}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{content}}[/title]',
	'popup_title' => __( 'Sharing Box Shortcode', 'oxo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Toggles Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['toggles'] = array(
	'no_preview' => true,
	'params' => array(
		'divider_line' => array(
			'std' => 'default',
			'type' => 'select',
			'label' => __( 'Divider Line', 'oxo-core' ),
			'desc' => __( 'Choose to display a divider line between each item.', 'oxo-core' ),
			'options' => array(
				'' 		=> 'Default',
				'yes'	=> 'Yes',
				'no'	=> 'No'
			)
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core' )
		),	
	),
	'shortcode' => '[accordian divider_line="{{divider_line}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/accordian]',
	'popup_title' => __( 'Insert Toggles Shortcode', 'oxo-core' ),

	'child_shortcode' => array(
		'params' => array(
			'title' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Title', 'oxo-core' ),
				'desc' => __( 'Insert the toggle title', 'oxo-core' ),
			),
			'open' => array(
				'type' => 'select',
				'label' => __( 'Open by Default', 'oxo-core' ),
				'desc' => __( 'Choose to have the toggle open when page loads', 'oxo-core' ),
				'options' => $reverse_choices
			),
			'content' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => __( 'Toggle Content', 'oxo-core' ),
				'desc' => __( 'Insert the toggle content', 'oxo-core' ),
			)
		),
		'shortcode' => '[toggle title="{{title}}" open="{{open}}"]{{content}}[/toggle]',
		'clone_button' => __( 'Add Toggle', 'oxo-core')
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Tooltip Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['tooltip'] = array(
	'no_preview' => true,
	'params' => array(

		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Tooltip Text', 'oxo-core' ),
			'desc' => __( 'Insert the text that displays in the tooltip', 'oxo-core' )
		),
		'placement' => array(
			'type' => 'select',
			'label' => __( 'Tooltip Position', 'oxo-core' ),
			'desc' => __( 'Choose the display position.', 'oxo-core' ),
			'options' => array(
				'top' => __('Top', 'oxo-core'),
				'bottom' => __('Bottom', 'oxo-core'),
				'left' => __('Left', 'oxo-core'),
				'Right' => __('Right', 'oxo-core'),
			)
		),
		'trigger' => array(
			'type' => 'select',
			'label' => __( 'Tooltip Trigger', 'oxo-core' ),
			'desc' => __( 'Choose action to trigger the tooltip.', 'oxo-core' ),
			'options' => array(
				'hover' => __('Hover', 'oxo-core'),
				'click' => __('Click', 'oxo-core'),
			)
		),			
		'content' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Content', 'oxo-core' ),
			'desc' => __( 'Insert the text that will activate the tooltip hover', 'oxo-core' )
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core' )
		),			
	),
	'shortcode' => '[tooltip title="{{title}}" placement="{{placement}}" trigger="{{trigger}}" class="{{class}}" id="{{id}}"]{{content}}[/tooltip]',
	'popup_title' => __( 'Tooltip Shortcode', 'oxo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Vimeo Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['vimeo'] = array(
	'no_preview' => true,
	'params' => array(

		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Video ID', 'oxo-core' ),
			'desc' => __( 'For example the Video ID for <br />https://vimeo.com/75230326 is 75230326', 'oxo-core' )
		),
		'width' => array(
			'std' => '600',
			'type' => 'text',
			'label' => __( 'Width', 'oxo-core' ),
			'desc' => __( 'In pixels but only enter a number, ex: 600', 'oxo-core' )
		),
		'height' => array(
			'std' => '350',
			'type' => 'text',
			'label' => __( 'Height', 'oxo-core' ),
			'desc' => __( 'In pixels but enter a number, ex: 350', 'oxo-core' )
		),
		'autoplay' => array(
			'type' => 'select',
			'label' => __( 'Autoplay Video', 'oxo-core' ),
			'desc' =>  __( 'Set to yes to make video autoplaying', 'oxo-core' ),
			'options' => $reverse_choices
		),
		'apiparams' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'AdditionalAPI Parameter', 'oxo-core' ),
			'desc' => __( 'Use additional API parameter, for example &title=0 to disable title on video. VimeoPlus account may be required.', 'oxo-core' )
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core' )
		),		
	),
	'shortcode' => '[vimeo id="{{id}}" width="{{width}}" height="{{height}}" autoplay="{{autoplay}}" api_params="{{apiparams}}" class="{{class}}"]',
	'popup_title' => __( 'Vimeo Shortcode', 'oxo-core' )
);


/*-----------------------------------------------------------------------------------*/
/*	Widget Area Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['oxo_widget_area'] = array(  
	'params' => array(
		'name' => array(
			'std' => '',
			'type' => 'select',
			'label' => __( 'Widget Area Name', 'oxo-core' ),
			'desc' => __( 'Choose a background color for the widget area.', 'oxo-core'),
			'options' => get_sidebars()
		),		
		'background_color' => array(
			'type' => 'colorpicker',
			'label' => __( 'Background Color', 'oxo-core' ),
			'desc' => __( 'Choose a background color for the widget area.', 'oxo-core')
		),
		'padding' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Padding', 'oxo-core' ),
			'desc' => __( 'In pixels or percentage, ex: 10px or 10%.', 'oxo-core')
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core')
		),
	),
	'shortcode' => '[oxo_widget_area name="{{name}}" background_color="{{background_color}}" padding="{{padding}}" class="{{class}}" id="{{id}}"][/oxo_widget_area]', // as there is no wrapper shortcode
	'popup_title' => __( 'Widget Area Shortcode', 'oxo-core' ),
	'no_preview' => true
);

/*-----------------------------------------------------------------------------------*/
/*	Woo Featured Slider Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['woofeatured'] = array(
	'no_preview' => true,
	'params' => array(
		'picture_size' => array(
			'type' => 'select',
			'label' => __( 'Picture Size', 'oxo-core' ),
			'desc' => __( 'fixed = width and height will be fixed <br />auto = width and height will adjust to the image.', 'oxo-core' ),
			'options' => array(
				'auto' => __('Auto', 'oxo-core'),
				'fixed' => __('Fixed', 'oxo-core'),
			)
		),
		'carousel_layout' => array(
			'type' => 'select',
			'label' => __( 'Carousel Layout', 'oxo-core' ),
			'desc' => __( 'Choose to show titles on rollover image, or below image.', 'oxo-core' ),
			'options' => array(
				'title_on_rollover' => __('Title on rollover', 'oxo-core'),
				'title_below_image' => __('Title below image', 'oxo-core'),
			)
		),			
		'autoplay' => array(
			'type' => 'select',
			'label' => __( 'Autoplay', 'oxo-core' ),
			'desc' => __('Choose to autoplay the carousel.', 'oxo-core'),
			'options' => $reverse_choices
		),
		'columns' => array(
			'std' => '5',
			'type' => 'select',
			'label' => __( 'Maximum Columns', 'oxo-core' ),
			'desc' => __('Select the number of max columns to display.', 'oxo-core'),
			'options' => oxo_shortcodes_range( 6, false )	
		),		
		'column_spacing' => array(
			'std' => '10',
			'type' => 'text',
			'label' => __( 'Column Spacing', 'oxo-core' ),
			"desc" => __("Insert the amount of spacing between items without 'px'. ex: 13.", "oxo-core"),
		),
		'scroll_items' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Scroll Items', 'oxo-core' ),
			"desc" => __("Insert the amount of items to scroll. Leave empty to scroll number of visible items.", "oxo-core"),
		),	
		'show_nav' => array(
			'type' => 'select',
			'label' => __( 'Show Navigation', 'oxo-core' ),
			'desc' => __( 'Choose to show navigation buttons on the carousel.', 'oxo-core' ),
			'options' => $choices
		),	
		'mouse_scroll' => array(
			'type' => 'select',
			'label' => __( 'Mouse Scroll', 'oxo-core' ),
			'desc' => __( 'Choose to enable mouse drag control on the carousel.', 'oxo-core' ),
			'options' => $reverse_choices
		),		
		'show_cats' => array(
			'type' => 'select',
			'label' => __( 'Show Categories', 'oxo-core' ),
			'desc' => __('Choose to show or hide the categories', 'oxo-core'),
			'options' => $reverse_choices
		),
		'show_price' => array(
			'type' => 'select',
			'label' => __( 'Show Price', 'oxo-core' ),
			'desc' => __('Choose to show or hide the price', 'oxo-core'),
			'options' => $reverse_choices
		),
		'show_buttons' => array(
			'type' => 'select',
			'label' => __( 'Show Buttons', 'oxo-core' ),
			'desc' => __('Choose to show or hide the icon buttons', 'oxo-core'),
			'options' => $reverse_choices
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core' )
		),		
	),
	'shortcode' => '[featured_products_slider picture_size="{{picture_size}}" carousel_layout="{{carousel_layout}}" autoplay="{{autoplay}}" columns="{{columns}}" column_spacing="{{column_spacing}}" scroll_items="{{scroll_items}}" show_nav="{{show_nav}}" mouse_scroll="{{mouse_scroll}}" show_price="{{show_price}}" show_buttons="{{show_buttons}}" class="{{class}}" id="{{id}}"]',
	'popup_title' => __( 'Woocommerce Featured Products Slider Shortcode', 'oxo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Woo Products Slider Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['wooproducts'] = array(
	'params' => array(
		'picture_size' => array(
			'type' => 'select',
			'label' => __( 'Picture Size', 'oxo-core' ),
			'desc' => __( 'fixed = width and height will be fixed <br />auto = width and height will adjust to the image.', 'oxo-core' ),
			'options' => array(
				'fixed' => __('Fixed', 'oxo-core'),
				'auto' => __('Auto', 'oxo-core')
			)
		),
		'cat_slug' => array(
			'type' => 'multiple_select',
			'label' => __( 'Categories', 'oxo-core' ),
			'desc' => __( 'Select a category or leave blank for all', 'oxo-core' ),
			'options' => oxo_shortcodes_categories( 'product_cat' )
		),
		'number_posts' => array(
			'std' => 5,
			'type' => 'text',
			'label' => __( 'Number of Products', 'oxo-core' ),
			'desc' => __('Select the number of products to display', 'oxo-core')
		),
		'carousel_layout' => array(
			'type' => 'select',
			'label' => __( 'Carousel Layout', 'oxo-core' ),
			'desc' => __( 'Choose to show titles on rollover image, or below image.', 'oxo-core' ),
			'options' => array(
				'title_on_rollover' => __('Title on rollover', 'oxo-core'),
				'title_below_image' => __('Title below image', 'oxo-core'),
			)
		),			
		'autoplay' => array(
			'type' => 'select',
			'label' => __( 'Autoplay', 'oxo-core' ),
			'desc' => __('Choose to autoplay the carousel.', 'oxo-core'),
			'options' => $reverse_choices
		),
		'columns' => array(
			'std' => '5',
			'type' => 'select',
			'label' => __( 'Maximum Columns', 'oxo-core' ),
			'desc' => __('Select the number of max columns to display.', 'oxo-core'),
			'options' => oxo_shortcodes_range( 6, false )	
		),		
		'column_spacing' => array(
			'std' => '13',
			'type' => 'text',
			'label' => __( 'Column Spacing', 'oxo-core' ),
			"desc" => __("Insert the amount of spacing between items without 'px'. ex: 13.", "oxo-core"),
		),
		'scroll_items' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Scroll Items', 'oxo-core' ),
			"desc" => __("Insert the amount of items to scroll. Leave empty to scroll number of visible items.", "oxo-core"),
		),				
		'show_nav' => array(
			'type' => 'select',
			'label' => __( 'Show Navigation', 'oxo-core' ),
			'desc' => __( 'Choose to show navigation buttons on the carousel.', 'oxo-core' ),
			'options' => $choices
		),	
		'mouse_scroll' => array(
			'type' => 'select',
			'label' => __( 'Mouse Scroll', 'oxo-core' ),
			'desc' => __( 'Choose to enable mouse drag control on the carousel.', 'oxo-core' ),
			'options' => $reverse_choices
		),		
		'show_cats' => array(
			'type' => 'select',
			'label' => __( 'Show Categories', 'oxo-core' ),
			'desc' => __('Choose to show or hide the categories', 'oxo-core'),
			'options' => $choices
		),
		'show_price' => array(
			'type' => 'select',
			'label' => __( 'Show Price', 'oxo-core' ),
			'desc' => __('Choose to show or hide the price', 'oxo-core'),
			'options' => $choices
		),
		'show_buttons' => array(
			'type' => 'select',
			'label' => __( 'Show Buttons', 'oxo-core' ),
			'desc' => __('Choose to show or hide the icon buttons', 'oxo-core'),
			'options' => $choices
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core' )
		),			
	),
	'shortcode' => '[products_slider picture_size="{{picture_size}}" cat_slug="{{cat_slug}}" number_posts="{{number_posts}}" carousel_layout="{{carousel_layout}}" autoplay="{{autoplay}}" columns="{{columns}}" column_spacing="{{column_spacing}}" scroll_items="{{scroll_items}}" show_nav="{{show_nav}}" mouse_scroll="{{mouse_scroll}}" show_price="{{show_price}}" show_buttons="{{show_buttons}}" class="{{class}}" id="{{id}}"]',
	'popup_title' => __( 'Woocommerce Products Slider Shortcode', 'oxo-core' ),
	'no_preview' => true,
);

/*-----------------------------------------------------------------------------------*/
/*	Youtube Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['youtube'] = array(
	'no_preview' => true,
	'params' => array(

		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Video ID', 'oxo-core' ),
			'desc' => __('For example the Video ID for <br />http://www.youtube.com/LOfeCR7KqUs is LOfeCR7KqUs', 'oxo-core')
		),
		'width' => array(
			'std' => '600',
			'type' => 'text',
			'label' => __( 'Width', 'oxo-core' ),
			'desc' => __('In pixels but only enter a number, ex: 600', 'oxo-core')
		),
		'height' => array(
			'std' => '350',
			'type' => 'text',
			'label' => __( 'Height', 'oxo-core' ),
			'desc' => __('In pixels but only enter a number, ex: 350', 'oxo-core')
		),
		'autoplay' => array(
			'type' => 'select',
			'label' => __( 'Autoplay Video', 'oxo-core' ),
			'desc' =>  __( 'Set to yes to make video autoplaying', 'oxo-core' ),
			'options' => $reverse_choices
		),
		'apiparams' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'AdditionalAPI Parameter', 'oxo-core' ),
			'desc' => __('Use additional API parameter, for example &rel=0 to disable related videos', 'oxo-core')
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core' )
		),		
	),
	'shortcode' => '[youtube id="{{id}}" width="{{width}}" height="{{height}}" autoplay="{{autoplay}}" api_params="{{apiparams}}" class="{{class}}"]',
	'popup_title' => __( 'Youtube Shortcode', 'oxo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	aionegallery Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['aionegallery'] = array(
	'no_preview' => true,
	'params' => array(
	    
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core')
		),			
	),
	'shortcode' => '[gallery  id="{{id}}" class="{{class}}"]',
	'popup_title' => __( 'AioneGallery Shortcode', 'oxo-core' ),
	'no_preview' => false
);

/*-----------------------------------------------------------------------------------*/
/*	Oxo Slider Config
/*-----------------------------------------------------------------------------------*/

$oxo_shortcodes['oxoslider'] = array(
	'no_preview' => true,
	'params' => array(
		'name' => array(
			'type' => 'select',
			'label' => __( 'Slider Name', 'oxo-core' ),
			'desc' => __( 'This is the shortcode name that can be used in the post content area. It is usually all lowercase and contains only letters, numbers, and hyphens. ex: "oxoslider_slidernamehere"', 'oxo-core' ),
			'options' => oxo_shortcodes_categories( 'slide-page' )
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'oxo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'oxo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'oxo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'oxo-core' )
		),
	),
	'shortcode' => '[oxoslider id="{{id}}" class="{{class}}" name="{{name}}"][/oxoslider]',
	'popup_title' => __( 'Oxo Slider Shortcode', 'oxo-core' )
);