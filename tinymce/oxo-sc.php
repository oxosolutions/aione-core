<?php

// loads the shortcodes class, wordpress is loaded with it
require_once( 'shortcodes.class.php' );

// get popup type
$popup = trim( $_GET['popup'] );
$shortcode = new oxo_shortcodes( $popup );

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
<div id="oxo-popup">

	<div id="oxo-shortcode-wrap">

		<div id="oxo-sc-form-wrap">

			<?php
			$select_shortcode = array(
					'select' => 'Choose a Shortcode',
					'alert' => 'Alert',
					'blog' => 'Blog',
					'button' => 'Button',
					'checklist' => 'Checklist',
					'columns' => 'Columns',
					'contentboxes' => 'Content Boxes',
					'oxo_countdown' => 'Countdown',	
					'countersbox' => 'Counters Box',					
					'counterscircle' => 'Counters Circle',
					'dropcap' => 'Dropcap',
					'events' => 'Events',
					'flipboxes' => 'Flip Boxes',
					'fontawesome' => 'Font Awesome',
					'oxoslider' => 'Oxo Slider',
					'fullwidth' => 'Full Width Container',
					'googlemap' => 'Google Map',
					'highlight' => 'Highlight',
					'imagecarousel' => 'Image Carousel',
					'imageframe' => 'Image Frame',
					'lightbox' => 'Lightbox',
					'oxo_login'	=> 'Login',
					'oxo_register'	=> 'Register',
					'oxo_lost_password' => 'Lost Password',
					'menuanchor' => 'Menu Anchor',
					'modal' => 'Modal',
					'modaltextlink' => 'Modal Text Link',
					'onepagetextlink' => 'One Page Text Link',
					'person' => 'Person',
					'popover' => 'Popover',
					'postslider' => 'Post Slider',
					'pricingtable' => 'Pricing Table',
					'progressbar' => 'Progress Bar',
					'recentposts' => 'Recent Posts',
					'recentworks' => 'Recent Works',
					'sectionseparator' => 'Section Separator',
					'separator' => 'Separator',
					'sharingbox' => 'Sharing Box',
					'slider' => 'Slider',
					'sociallinks' => 'Social Links',
					'soundcloud' => 'SoundCloud',
					'table' => 'Table',
					'tabs' => 'Tabs',
					'taglinebox' => 'Tagline Box',
					'testimonials' => 'Testimonials',
					'title' => 'Title',
					'toggles' => 'Toggles',
					'tooltip' => 'Tooltip',
					'vimeo' => 'Vimeo',
					'oxo_widget_area' => 'Widget Area',
					'woofeatured' => 'Woocommerce Featured Products Slider',
					'wooproducts' => 'Woocommerce Products Slider',
					'youtube' => 'Youtube',
					'form' => 'Form',
					'aionegallery' => 'AioneGallery',
			);
			?>
			<table id="oxo-sc-form-table" class="oxo-shortcode-selector">
				<tbody>
					<tr class="form-row">
						<td class="label">Choose Shortcode</td>
						<td class="field">
							<div class="oxo-form-select-field">
							<div class="oxo-shortcodes-arrow">&#xf107;</div>
								<select name="oxo_select_shortcode" id="oxo_select_shortcode" class="oxo-form-select oxo-input">
									<?php foreach($select_shortcode as $shortcode_key => $shortcode_value): ?>
									<?php if($shortcode_key == $popup): $selected = 'selected="selected"'; else: $selected = ''; endif; ?>
									<option value="<?php echo $shortcode_key; ?>" <?php echo $selected; ?>><?php echo $shortcode_value; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			<form method="post" id="oxo-sc-form">

				<table id="oxo-sc-form-table">

					<?php echo $shortcode->output; ?>

					<tbody class="oxo-sc-form-button">
						<tr class="form-row">
							<td class="field"><a href="#" class="oxo-insert">Insert Shortcode</a></td>
						</tr>
					</tbody>

				</table>
				<!-- /#oxo-sc-form-table -->

			</form>
			<!-- /#oxo-sc-form -->

		</div>
		<!-- /#oxo-sc-form-wrap -->

		<div class="clear"></div>

	</div>
	<!-- /#oxo-shortcode-wrap -->

</div>
<!-- /#oxo-popup -->

</body>
</html>