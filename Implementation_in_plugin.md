## Creating a pop up to show in footer section after 5 second of website loads.

<details><summary>
File `custom-plugin.php` contains
</summary>

```php
<?php
/**
* Plugin Name:     Custom Plugin
**/


defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'custom_plugin' ) ) {
	function custom_plugin() {
		register_post_type(
			'custom_popup',
			array(
				'labels'             => array(
					'name'                     => 'Custom Popups',
					'singular_name'            => 'Custom Popup',
					'add_new'                  => 'Add New',
					'add_new_item'             => 'Add New Popup',
					'edit_item'                => 'Edit Popup',
					'new_item'                 => 'New Popup',
					'view_item'                => 'View Popup',
					'view_items'               => 'View Popups',
					'search_items'             => 'Search Popups',
					'not_found'                => 'No Popups found',
					'not_found_in_trash'       => 'No Popups found in Trash',
					'all_items'                => 'All Popups',
					'archives'                 => 'Popup Archives',
					'attributes'               => 'Popup Attributes',
					'insert_into_item'         => 'Insert into Popup',
					'uploaded_to_this_item'    => 'Uploaded to this Popup',
					'featured_image'           => 'Featured Image',
					'set_featured_image'       => 'Set featured image',
					'remove_featured_image'    => 'Remove featured image',
					'use_featured_image'       => 'Use as featured image',
					'filter_items_list'        => 'Filter Popups list',
					'items_list_navigation'    => 'Popups list navigation',
					'items_list'               => 'Popups list',
					'item_published'           => 'Popup published',
					'item_published_privately' => 'Popup published privately',
					'item_reverted_to_draft'   => 'Popup reverted to draft',
					'item_scheduled'           => 'Popup scheduled',
					'item_updated'             => 'Popup updated',
				),
				'description'        => 'Description.',
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => false,
				'show_in_nav_menus'  => true,
				'show_in_admin_bar'  => true,
				'menu_position'      => 5,
				'menu_icon'          => 'dashicons-admin-generic',
				'capability_type'    => 'post',
				'hierarchical'       => false,
				'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
				'taxonomies'         => array( 'category', 'post_tag' ),
				'has_archive'        => false,
				'query_var'          => true,
				'can_export'         => true,
				'show_in_rest'       => true,
			)
		);
	}
}

add_action( 'init', 'custom_plugin' );

// Hook the 'admin_menu' action hook, run the function named 'my_custom_menu'
add_action( 'admin_menu', 'my_custom_menu' );

// Add a top-level menu and submenus
function my_custom_menu() {
	// Add a top-level menu
	add_menu_page(
		'Custom Menu Title',   // Page title
		'Custom Popup Builder',         // Menu title
		'manage_options',      // Capability
		'custom-menu-slug',    // Menu slug
		'custom_menu_page',    // Function to display the page content
		'dashicons-admin-generic', // Icon URL
		100                     // Position
	);

	// Add a submenu under the top-level menu
	add_submenu_page(
		'custom-menu-slug',    // Parent slug
		'Dashboard', // Page title
		'Dashboard',           // Menu title
		'manage_options',      // Capability
		'custom-submenu-slug-1', // Menu slug
		'custom_submenu_page_1' // Function to display the page content
	);

	// Add another submenu under the top-level menu
	add_submenu_page(
		'custom-menu-slug',    // Parent slug
		'Add Popup', // Page title
		'Add Popup',           // Menu title
		'manage_options',      // Capability
		'edit.php?post_type=custom_popup', // Menu slug
		''
	);
	remove_submenu_page( 'custom-menu-slug', 'custom-menu-slug' );
}


// Display content for the first submenu page
function custom_submenu_page_1() {
	echo '<div class="wrap">';
	echo '<h2>' . get_admin_page_title() . '</h2>';
	echo '<p>Settings goes here!!</p>';
	echo '</div>';
}


function display_custom_popups() {
	// Query custom popups
	$args   = array(
		'post_type'      => 'custom_popup',
		'posts_per_page' => -1, // Retrieve all popups
		'post_status'    => 'publish', // Only fetch published popups
	);
	$popups = new WP_Query( $args );

	// Output popups
	if ( $popups->have_posts() ) {
		while ( $popups->have_posts() ) {
			$popups->the_post();
			// Customize how each popup is displayed
			$popup_id = 'custom-popup-' . get_the_ID(); // Unique ID for each popup
			echo '<div id="' . $popup_id . '" class="custom-popup" style="display:none;">';
			echo '<h3>' . get_the_title() . '</h3>';
			echo '<div class="popup-content">' . get_the_content() . '</div>';
			echo '</div>';
		}
		wp_reset_postdata(); // Reset post data
	} else {
		// No popups found
		echo '<p>No popups found.</p>';
	}
}

add_action( 'wp_footer', 'display_custom_popups' );

// Enqueue JavaScript for popup trigger
function enqueue_popup_script() {
	wp_enqueue_script( 'custom-popup-script', plugin_dir_url( __FILE__ ) . 'custom-popup-script.js', array( 'jquery' ), null, true );

	// Pass PHP data to JavaScript
	wp_localize_script(
		'custom-popup-script',
		'popupParams',
		array(
			'popupDelay' => 5000, // Delay in milliseconds (5 seconds)
		)
	);
}
add_action( 'wp_enqueue_scripts', 'enqueue_popup_script' );

```

</details>

<details><summary>File, `custom-popup-script.js` contains</summary>

```js
jQuery(document).ready(function ($) {
	function showPopupDelayed(popupId) {
		setTimeout(function () {
			$("#" + popupId).fadeIn(); // Show popup using fadeIn animation
		}, popupParams.popupDelay);
	}

	// Call function to show popup after delay
	$(".custom-popup").each(function () {
		var popupId = $(this).attr("id");
		showPopupDelayed(popupId);
	});
});
```

</deatils>
