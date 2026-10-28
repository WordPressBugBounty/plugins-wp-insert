<?php
/**
 * Free resources slider shown at the top of the Wp-Insert admin page.
 *
 * Thumbnails are bundled with the plugin, so the admin page makes no
 * requests to outside services. Links open the resource in a new tab.
 *
 * @package wp-insert
 */

/* Begin Add Assets */
add_action( 'wp_insert_modules_js', 'wp_insert_module_resources_js', 0 );
function wp_insert_module_resources_js() {
	wp_register_script( 'wp-insert-module-resources-js', WP_INSERT_URL . 'includes/modules/core/resources/js/module.js', [], WP_INSERT_VERSION . ( ( WP_INSERT_DEBUG ) ? wp_rand( 0, 9999 ) : '' ), true );
	wp_enqueue_script( 'wp-insert-module-resources-js' );
}
/* End Add Assets */

/* Begin Resource Data */
function wp_insert_get_resources() {
	$imageUrl = WP_INSERT_URL . 'includes/assets/images/resources/';
	return [
		[
			'title'       => 'Daybreak',
			'description' => 'A free widget that turns your readers into advertisers. Local business owners reach out in three clicks, straight to your inbox.',
			'cta'         => 'Set up Daybreak free',
			'url'         => 'https://broadstreetads.com/daybreak/?utm_source=wp-insert-admin',
			'image'       => $imageUrl . 'daybreak.jpg',
		],
		[
			'title'       => 'How to Sell Digital Advertising',
			'description' => 'The webinar over 1,000 publishers registered for, plus the sell sheet, media kit and real sales meeting footage.',
			'cta'         => 'Get the webinar and downloads',
			'url'         => 'https://docs.google.com/presentation/d/1iVdqC1knLlfHF4oWmtyqPMzYSEi0OBDt44u9boFDgSk/edit',
			'image'       => $imageUrl . 'sell.jpg',
		],
		[
			'title'       => 'How to Price and Package',
			'description' => 'The frameworks, math and psychology behind pricing banners, sponsored content and newsletters.',
			'cta'         => 'Watch the webinar',
			'url'         => 'https://www.youtube.com/watch?v=v7dLQ7W-2UU',
			'image'       => $imageUrl . 'pricing.jpg',
		],
		[
			'title'       => 'Make a Media Kit That Sells',
			'description' => 'Seven keys to a media kit that helps you win more ad sales, from common myths to pro tips.',
			'cta'         => 'Watch the webinar',
			'url'         => 'https://www.youtube.com/watch?v=GNzTzBRITH0',
			'image'       => $imageUrl . 'mediakit.jpg',
		],
		[
			'title'       => 'What\'s Possible on Broadstreet',
			'description' => 'Nearly 500 publishers left this webinar with plans they could put in place in weeks, if not days.',
			'cta'         => 'Watch the webinar',
			'url'         => 'https://www.youtube.com/watch?v=wYa09wTXFys',
			'image'       => $imageUrl . 'possible.jpg',
		],
	];
}
/* End Resource Data */

/* Begin Resources Slider */
add_action( 'wp_insert_admin_page_top', 'wp_insert_resources_slider' );
function wp_insert_resources_slider() {
	$resources = wp_insert_get_resources();
	echo '<section class="wp-insert-resources" aria-labelledby="wp-insert-resources-title">';
		echo '<div class="wp-insert-resources-header">';
			echo '<h2 id="wp-insert-resources-title" class="wp-insert-resources-title">Free resources for small publishers</h2>';
			echo '<div class="wp-insert-resources-nav">';
				echo '<button type="button" class="button wp-insert-resources-prev" aria-controls="wp-insert-resources-track" aria-label="Previous resources" disabled><span class="dashicons dashicons-arrow-left-alt2" aria-hidden="true"></span></button>';
				echo '<button type="button" class="button wp-insert-resources-next" aria-controls="wp-insert-resources-track" aria-label="Next resources"><span class="dashicons dashicons-arrow-right-alt2" aria-hidden="true"></span></button>';
			echo '</div>';
		echo '</div>';
		echo '<ul id="wp-insert-resources-track" class="wp-insert-resources-track">';
	foreach ( $resources as $resource ) {
		echo '<li class="wp-insert-resources-item">';
			echo '<a class="wp-insert-resources-link" href="' . esc_url( $resource['url'] ) . '" target="_blank" rel="noopener noreferrer">';
				echo '<img class="wp-insert-resources-image" src="' . esc_url( $resource['image'] ) . '" alt="" width="640" height="360" loading="lazy" decoding="async" />';
				echo '<span class="wp-insert-resources-body">';
					echo '<span class="wp-insert-resources-item-title">' . esc_html( $resource['title'] ) . '</span>';
					echo '<span class="wp-insert-resources-description">' . esc_html( $resource['description'] ) . '</span>';
					echo '<span class="wp-insert-resources-cta">' . esc_html( $resource['cta'] ) . '<span class="dashicons dashicons-external" aria-hidden="true"></span><span class="screen-reader-text"> (opens in a new tab)</span></span>';
				echo '</span>';
			echo '</a>';
		echo '</li>';
	}
		echo '</ul>';
	echo '</section>';
}
/* End Resources Slider */
