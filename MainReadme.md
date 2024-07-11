# Learn Wordpress

# Table of Content

# Part 0

## Part0: About Course

## Part0.1: About Author

## Part0.2: How to get most out of this course?

**Confusion of hooks and functions in official documentation:**
If you go through the official developer guide of wordpress you will notice that word: hook and functions are used interchangeably. For an instance: in some parts, you will see calling the `register_activation_hook()` function as a `hook` and placing it into `references/functions/` section. It is bit confusing. Therefore, we stick to calling these as functions. For us any so-called hook within documentation that is being called as a function is a function. And the wordpress trigger points like `init`, `pre-post-type`, `wp_loaded` etc are hooks.

**Nomenclature:** Nomenclature in official documentation is not uniform. For an instance: first parameter of function `add_shortcode` is named `$tag` and third parameter of function `shortcode_atts` is named `$shortcode`. However, both denotes to the name of the shortcode that will be using by the user in the frontend. We hereby make them same and use `$shortcode` for our convinence.

## Part0.3: Requirements

1. [Composer](https://getcomposer.org/download/) - Same as npm in node.js
2. [PackageGist](https://packagist.org/) - Same as npmjs.com
3. [WP Cli](https://make.wordpress.org/cli/handbook/guides/installing/) - WP-CLI is the official command line tool for interacting with and managing your WordPress sites. It is also found in `Packagegist`

# Part 1

## Introduction to Wordpress

### 1. Difference: wordpress.com and wordpress.org

WordPress.com is a hosted service where you can create a website without needing to manage the technical aspects like hosting and maintenance.

WordPress.org provides the open-source software(WordPress Plugin and Themes) that you can download and install on your own web server, giving you more control over customization and hosting but requiring technical knowledge and responsibility for upkeep.

### 2. Pre-requisites

-   Basic knowledge of PHP
-   WordPress Hooks and their sequence of execution
-   WordPress database understanding

### 3. Install: laragon

// Visit official site and install laragon.

### 4. Install: wordpress

// Visit official site and install wordPress.

### 5. Difference: Plugin and Theme

WordPress plugin adds specific functionalities or features to your website, such as contact forms or SEO optimization tools, without changing the site's core design.

WordPress theme, on the other hand, controls the overall design and appearance of your website, including layout, colors, fonts, and style. Themes determine how your content is presented to visitors, while plugins enhance what your site can do.

### 6. **First Theme**

Create a directory named, `custom-theme` within `wp-content/theme/` directory. Add new file, `style.css` and copy the following to the file:

```css
/*
Theme Name:     Custom Theme
Theme URI:      https://uri-of-theme.com
Description:    Theme create in the process of understanding WP.
Author:         Your Name
Author URI:     https://authorportfolio.com/
Version:        0.1
*/
```

Visit the Wordpress dashboard Appearence section. Warning will be shown at the very bottom.

> Template is missing. Standalone themes need to have a `templates/index.html` or `index.php` template file. Child themes need to have a Template header in the style.css stylesheet.

Go back to `custom-theme` directory and add `index.php` file. Leave it blank for now and check the live-site. You will see nothing in the screen. View the browser's developer console to see if there is any warnings or errors.

Now, simply add any text in index.php and view the frontend again. You will able to see the text that you have added.

Replace the whole content of `index.php` by below code:

```php
<?php
$args      = array(
    'post_type'      => 'post',
    'posts_per_page' => -1,
);
$the_query = new WP_Query( $args );



// The Loop
if ( $the_query->have_posts() ) {
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
        echo '<h2>' . get_the_title() . '</h2>';
        echo '<div>' . get_the_content() . '</div>';
    }
} else {
    echo 'No posts found';
}
/* Restore original Post Data */
wp_reset_postdata();
?>
```

We are using `WP_Query` class present in `wp-includes/class-wp-query.php` to create it's instance `$the_query`. Then we loop through all the post, echo their `title` wrapping in `<h2>` and echo the content wrapping in `<div>`.

> Note: After looping using the this query(main-query), it is recommended to reset the number of post in global variables for other similar query. So, `wp_reset_postdata()` must be used.

### 7. **First Plugin**

The only file required to make a plugin is `plugin-name.php` file with the `plugin/plugin_name` directory.

The plugin header comment must comply with the [header requirements](https://developer.wordpress.org/plugins/plugin-basics/header-requirements/), and at the very least, contain the name of the plugin i.e. in `plugin-name.php` file:

```php
/**
* Plugin Name:     YOUR PLUGIN NAME
**/
```

At this point, if you go to plugin settings in wordpress dashboard, you can see a new plugin to ready to activate with the name `YOUR PLUGIN NAME`.

The entry point of the plugin is `plugin-name.php` file. Add an echo within this file and see what happens:

```php
    /**
    * Plugin Name:     YOUR PLUGIN NAME
    **/
    echo 'Hello, world!';
```

If you visit any page/blog, you will see the text, _Hello, world!_ at the very top. [Click here to view](http://wpbasics.test/sample-page/) sample page - created by wordpress by default.

Congratulations! You have created your first Plugin and can activate it.

The 3 basic wordpress functions([_called hooks in documentation_](#part02-how-to-get-most-out-of-this-course)) you’ll need when creating a plugin are the [register_activation_hook()](https://developer.wordpress.org/reference/functions/register_activation_hook/) , the [register_deactivation_hook()](https://developer.wordpress.org/reference/functions/register_deactivation_hook/) , and the [register_uninstall_hook()](https://developer.wordpress.org/reference/functions/register_uninstall_hook/).

**The activation hook function** is run when you activate your plugin. You would use this to provide a function to set up your plugin — for example, creating some default settings in the options table.

**The deactivation hook function** is run when you deactivate your plugin. You would use this to provide a function that clears any temporary data stored by your plugin.

**The Uninstall hook function** These uninstall methods are used to clean up after your plugin is deleted using the WordPress Admin. You would use this to delete all data created by your plugin, such as any options that were added to the options table.

### 8. Notes

-   [Double-check] No Functions within wordpress plugin or theme is called directly. They must be hooked to custom or inbuilt hooks. Hooked function may call other function on their exection.

### 9. FAQs

<details><summary>You have created your first theme and first plugin. Both are activated. Can you guess the code execution flow; whose code is executed first?</summary>

In WordPress, when you visit a site, the order of execution is quite structured. Here's a simplified version of what happens:

1. Core WordPress Code: The core WordPress code is loaded first. This includes the initial bootstrap files like wp-load.php and wp-config.php, and the main wp-settings.php file which sets up the WordPress environment and loads necessary files.

2. Plugins: Once the core WordPress code is loaded, the plugins are executed. This happens during the execution of the wp-settings.php file. All active plugins are _loaded in the order they were activated._ This means that if a plugin needs to hook into WordPress actions or filters, it does so at this stage.

3. Themes: After the plugins are loaded and executed, the theme's code is executed. This includes the functions.php file of the active theme, which allows the theme to hook into WordPress actions and filters, and any template files that are used to generate the page being viewed.
 </details>

## PHP

1. Variables
2. Arrays
3. Objects
4. Functions
5. Classes
6. PHP materials

## Wordpress Functions

-   `get_post()`:
    `get_post($post = null, sring $output = 'OBJECT', string $filter = ‘raw’ ): WP_Post|array|null`

    Parameters:
    $post -:- Post ID or Post Object. PHP falsey(`null`, `false` or `0`) returns the current global post inside the loop.

    $output -:- `OBJECT`, `ARRAY_A` or `ARRAY_N` which correspond to a WP_Post object, an associative array, or a numeric array respectively. It is requried return type of `get_post` function.

    $filter -:- Type of filter to apply. `raw`, `db`, `edit`, or `display`.

-   [`add_shortcode()`](https://developer.wordpress.org/reference/functions/add_shortcode/):
    `add_shortcode( string $shortcode, callable $callback )`

    **Parameters:**
    $shortcode :- Shortcode tag to be searched in post content.

    $callback :- Callback function to run when the shortcode is found.

    Every shortcode callback is passed three parameters by default, including an array of attributes ($atts), the shortcode content or null if not set ($content), and finally the shortcode tag itself ($shortcode_tag), in that order.

-   [`add_menu_page()`](https://developer.wordpress.org/reference/functions/add_menu_page/):
    `add_menu_page( string $page_title, string $menu_title, string $capability, string $menu_slug, callable $callback = ”, string $icon_url = ”, int|float $position = null ): string`

    Adds a top-level Menu page
    It is used to add the Menu to the admin page. Using it directly may cause fatal error. It is recommended to use it with `admin_menu` hook.

    **Parameters:**
    $page_title :- The text to be displayed in the title tags of the page when the menu is selected.

-   [`add_submenu_page()`](https://developer.wordpress.org/reference/functions/add_submenu_page/):
    `add_submenu_page( string $parent_slug, string $page_title, string $menu_title, string $capability, string $menu_slug, callable $callback = ”, int|float $position = null ): string|false`

    Adds a submenu page.

    Code showing the usage of `add_menu_page` and `add_submenu_page` is shown below:

    ```php
    // Hook the 'admin_menu' action hook, run the function named 'my_custom_menu'
    add_action( 'admin_menu', 'my_custom_menu' );

    // Add a top-level menu and submenus
    function my_custom_menu() {
        // Add a top-level menu
        add_menu_page(
            'Custom Menu Title',   // Page title
            'Custom Menu',         // Menu title
            'manage_options',      // Capability
            'custom-menu-slug',    // Menu slug
            'custom_menu_page',    // Function to display the page content
            'dashicons-admin-generic', // Icon URL
            2                      // Position
        );

        // Add a submenu under the top-level menu
        add_submenu_page(
            'custom-menu-slug',    // Parent slug
            'Submenu Page Title 1', // Page title
            'Submenu 1',           // Menu title
            'manage_options',      // Capability
            'custom-submenu-slug-1', // Menu slug
            'custom_submenu_page_1' // Function to display the page content
        );

        // Add another submenu under the top-level menu
        add_submenu_page(
            'custom-menu-slug',    // Parent slug
            'Submenu Page Title 2', // Page title
            'Submenu 2',           // Menu title
            'manage_options',      // Capability
            'custom-submenu-slug-2', // Menu slug
            'custom_submenu_page_2' // Function to display the page content
        );
    }

    // Display content for the top-level menu page
    function custom_menu_page() {
        echo '<h2>' . get_admin_page_title() . '</h2>';
        echo '<div class="wrap">';
        echo '<h1>Custom Menu Page</h1>';
        echo '<p>Welcome to the custom menu page!</p>';
        echo '</div>';
    }

    // Display content for the first submenu page
    function custom_submenu_page_1() {
        echo '<div class="wrap">';
        echo '<h1>Submenu Page 1</h1>';
        echo '<p>Welcome to the first submenu page!</p>';
        echo '</div>';
    }

    // Display content for the second submenu page
    function custom_submenu_page_2() {
        echo '<div class="wrap">';
        echo '<h1>Submenu Page 2</h1>';
        echo '<p>Welcome to the second submenu page!</p>';
        echo '</div>';
    }

    ```

    > Note: When you add a top-level menu with `add_menu_page()`, WordPress automatically creates a submenu for that page. This submenu item will have the same title as the top-level menu and will be the first item in the submenu. This is the default behavior of the `add_menu_page()` function. Add below code:

    ```php
    // above code as it is.
    add_action('admin_head', 'remove_duplicate_submenu_item');

    function remove_duplicate_submenu_item() {
    remove_submenu_page('custom-menu-slug', 'custom-menu-slug');
    }

    ```

    Alternatively, add ` remove_submenu_page('custom-menu-slug', 'custom-menu-slug');` at the last of function `my_custom_menu` after adding all submenus.

    When the automatically created sub-menu is removed by either of the above method. The callback-function attached to the `add_menu_page` is never used and it can be removed.

    ```php
    // remove custom_menu_page function i.e. below function
    function custom_menu_page() {
        echo '<h2>' . get_admin_page_title() . '</h2>';
        echo '<div class="wrap">';
        echo '<h1>Custom Menu Page</h1>';
        echo '<p>Welcome to the custom menu page!</p>';
        echo '</div>';
    }
    // all other code remains unchanged.
    ```

-   [`register_post_type()`](https://developer.wordpress.org/reference/functions/register_post_type/)
    `register_post_type( string $post_type, array|string $args = array() ): WP_Post_Type|WP_Error`

    ```php
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
    			'show_in_menu'       => true, // show in admin page
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
    			'show_in_rest'       => true, // Force to use gutenberg editor while editing
    		)
    	);

    ```

## Use of `add_shortcode($shortcode, $callback_function)` and `shortcode_atts($defaults, $user_atts, $shortcode)`

Coding Part:

```php
    function callback_fun_while_adding_shortcode( $atts ) {
    // Define the default attributes and their values
    $defaults = array(
        'title' => 'Default Title',
        'count' => 5,
        'show'  => 'yes'
    );

    // Merge the user-defined attributes with the defaults
    $atts = shortcode_atts( $defaults, $atts );

    // Access the attributes
    $title = $atts['title'];
    $count = intval( $atts['count'] );
    $show  = $atts['show'] === 'yes';

    // Generate the output
    $output = "<h2>{$title}</h2>";
    if ( $show ) {
        $output .= "<p>Count: {$count}</p>";
    }

    return $output;
}
add_shortcode( 'my_shortcode', 'callback_fun_while_adding_shortcode' );
```

Above code can be refactor to use third parameter of `shortcode_atts` function

```php
function manage_shortcode_atts( $shortcode_tag, $atts ) {
    $defaults = array(
        'title' => 'Default Title',
        'count' => 5,
        'show'  => 'yes'
    );

    return shortcode_atts( $defaults, $atts, $shortcode_tag );
}
    function callback_fun_while_adding_shortcode( $atts ) {

    $atts = manage_shortcode_atts( 'my_shortcode', $atts );

    // Access the attributes
    $title = $atts['title'];
    $count = intval( $atts['count'] );
    $show  = $atts['show'] === 'yes';

    // Generate the output
    $output = "<h2>{$title}</h2>";
    if ( $show ) {
        $output .= "<p>Count: {$count}</p>";
    }

    return $output;
}
add_shortcode( 'my_shortcode', 'callback_fun_while_adding_shortcode' );
```

Use of Shortcode in editor

```html
[my_shortcode title="Custom Title" count="10" show="no"]
```

Output HTML while using shortcode with custom attribute:

```html
<h2>Custom Title</h2>
<p>Count: 5</p>
```

## Wordpress Hook

There are around 1470 hooks present in wordpress. When Wordpress project is loading it goes through via lots of hooks and we can tap into those wordpress hook to run specific functions as per our needs. Our functions get executed as soon as the hooks are fired by wordpress. We can add custom hooks and fire them in a codebase whenever we need it. Adding hooks is done by `add_action` or `add_filter` function and firing them is done by `do_action` or `apply_filter` function.

Some of the wordpress inbuilt hooks and their firing position is listed below. [Click here to view all hooks](https://developer.wordpress.org/reference/hooks/)

| Inbuilt Hook | Fired when                            | Specially Designed For         |
| ------------ | ------------------------------------- | ------------------------------ |
| admin_menu   | Wordpress is preparing the admin menu | adding items to the admin menu |
|              |                                       |                                |
|              |                                       |                                |

## Debugging in Wordpress

-   When you first install Wordpress, file `debug.log` within the wordpress directory is not present. When enabling debug mode from the file `wp-config.php`. It is automatically created and logs are shown within this file.

# Part 2

## Your First Wordpress Plugin

You can make your plugin by creating each file manually. It is a cumbersome method. There is another way to getting started with plugin development. You can use the follow command to scaffold create the minimum required files for your plugin.

```bash
wp scaffold plugin sample-plugin
```

> Note: You must have to install the Wp-Cli package globally to use the above command.

> Note: There are many parameters that can be used with hte above command while scaffolding the plugin. [Click here to view](https://developer.wordpress.org/cli/commands/scaffold/plugin/)

## Your First Wordpress Theme

## Understanding Wordpress Database

## Wp-cli

Some handy commands of wp-cli, command line tool are:
Manipulating plugin and themes within wordpress environment.

-   `wp plugin list`
-   `wp plugin activate plugin-name`
-   `wp plugin deactivate plugin-name`
-   `wp theme list`
-   `wp theme activate theme-name`
-   `wp theme deactivate theme-name`

Querying data from database

-   [`wp post <command>`](https://developer.wordpress.org/cli/commands/post/): use different commands to query through all post(blogs/pages).

-   [`wp post-type list`](https://developer.wordpress.org/cli/commands/post-type/list/) : list all registered post-type.
-   [`wp post-type get`](https://developer.wordpress.org/cli/commands/post-type/get/) : Get details about a regestered post-type

Beside the above commands, there are alot of commands provided by WP-CLI, [click here to view them](https://developer.wordpress.org/cli/commands/).

<table>
<thead>
<tr>
<th scope="col">Command</th>
<th scope="col">Description</th>
</tr>
</thead>
<tbody><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/admin/">wp admin</a></td><td>Open /wp-admin/ in a browser.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/cache/">wp cache</a></td><td>Adds, removes, fetches, and flushes the WP Object Cache object.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/cap/">wp cap</a></td><td>Adds, removes, and lists capabilities of a user role.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/cli/">wp cli</a></td><td>Reviews current WP-CLI info, checks for updates, or views defined aliases.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/comment/">wp comment</a></td><td>Creates, updates, deletes, and moderates comments.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/config/">wp config</a></td><td>Generates and reads the wp-config.php file.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/core/">wp core</a></td><td>Downloads, installs, updates, and manages a WordPress installation.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/cron/">wp cron</a></td><td>Tests, runs, and deletes WP-Cron events; manages WP-Cron schedules.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/db/">wp db</a></td><td>Performs basic database operations using credentials stored in wp-config.php.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/dist-archive/">wp dist-archive</a></td><td>Create a distribution archive based on a project’s .distignore file.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/embed-2/">wp embed</a></td><td>Inspects oEmbed providers, clears embed cache, and more.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/eval/">wp eval</a></td><td>Executes arbitrary PHP code.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/eval-file/">wp eval-file</a></td><td>Loads and executes a PHP file.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/export/">wp export</a></td><td>Exports WordPress content to a WXR file.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/find/">wp find</a></td><td>Find WordPress installations on the filesystem.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/help/">wp help</a></td><td>Gets help on WP-CLI, or on a specific command.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/i18n/">wp i18n</a></td><td>Provides internationalization tools for WordPress projects.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/import/">wp import</a></td><td>Imports content from a given WXR file.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/language/">wp language</a></td><td>Installs, activates, and manages language packs.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/maintenance-mode/">wp maintenance-mode</a></td><td>Activates, deactivates or checks the status of the maintenance mode of a site.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/media/">wp media</a></td><td>Imports files as attachments, regenerates thumbnails, or lists registered image sizes.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/menu/">wp menu</a></td><td>Lists, creates, assigns, and deletes the active theme’s navigation menus.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/network/">wp network</a></td><td>Perform network-wide operations.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/option/">wp option</a></td><td>Retrieves and sets site options, including plugin and WordPress settings.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/package/">wp package</a></td><td>Lists, installs, and removes WP-CLI packages.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/plugin/">wp plugin</a></td><td>Manages plugins, including installs, activations, and updates.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/post/">wp post</a></td><td>Manages posts, content, and meta.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/post-type/">wp post-type</a></td><td>Retrieves details on the site’s registered post types.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/profile/">wp profile</a></td><td>Quickly identify what’s slow with WordPress.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/rewrite/">wp rewrite</a></td><td>Lists or flushes the site’s rewrite rules, updates the permalink structure.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/role/">wp role</a></td><td>Manages user roles, including creating new roles and resetting to defaults.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/scaffold/">wp scaffold</a></td><td>Generates code for post types, taxonomies, plugins, child themes, etc.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/search-replace/">wp search-replace</a></td><td>Searches/replaces strings in the database.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/server/">wp server</a></td><td>Launches PHP’s built-in web server for a specific WordPress installation.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/shell/">wp shell</a></td><td>Opens an interactive PHP console for running and testing PHP code.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/sidebar/">wp sidebar</a></td><td>Lists registered sidebars.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/site/">wp site</a></td><td>Creates, deletes, empties, moderates, and lists one or more sites on a multisite installation.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/super-admin/">wp super-admin</a></td><td>Lists, adds, or removes super admin users on a multisite installation.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/taxonomy/">wp taxonomy</a></td><td>Retrieves information about registered taxonomies.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/term/">wp term</a></td><td>Manages taxonomy terms and term meta, with create, delete, and list commands.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/theme/">wp theme</a></td><td>Manages themes, including installs, activations, and updates.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/transient/">wp transient</a></td><td>Adds, gets, and deletes entries in the WordPress Transient Cache.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/user/">wp user</a></td><td>Manages users, along with their roles, capabilities, and meta.</td></tr><tr class=""><td><a href="https://developer.wordpress.org/cli/commands/widget/">wp widget</a></td><td>Manages widgets, including adding and moving them within sidebars.</td></tr></tbody></table>

## Default `post-type` when installing WP:

```
post
page
attachment
revision
nav_menu_item
custom_css
customize_changeset
oembed_cache
user_request
wp_block
wp_template
wp_template_part
wp_global_styles
wp_navigation
wp_font_family
wp_font_face
```

# Part 3

## Part 3.0 Understanding Gutenberg Block

[Developer Wordpress link](https://developer.wordpress.org/block-editor/) for gutenberg blocks.
