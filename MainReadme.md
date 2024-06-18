# Learn Wordpress

# Table of Content

# Part 0

## Part0: About Course

## Part0.1: About Author

## Part0.2: How to get most out of this course?

**Confusion of hooks and functions in official documentation:**
If you go through the official developer guide of wordpress you will notice that word: hook and functions are used interchangeably. For an instance: in some parts, you will see calling the `register_activation_hook()` function as a `hook` and placing it into `references/functions/` section. It is bit confusing. Therefore, we stick to calling these as functions. For us any so-called hook within documentation that is being called as a function is a function. And the wordpress trigger points like `init`, `pre-post-type`, `wp_loaded` etc are hooks.

## Part0.3: Requirements

1. [Composer](https://getcomposer.org/download/) - Same as npm in node.js
2. [PackageGist](https://packagist.org/) - Same as npmjs.com
3. [WP Cli](https://make.wordpress.org/cli/handbook/guides/installing/) - WP-CLI is the official command line tool for interacting with and managing your WordPress sites. It is also found in `Packagegist`

# Part 1

## Introduction to Wordpress

1.  Difference: wordpress.com and wordpress.org
2.  Requirement
3.  Install: laragon
4.  Install: wordpress
5.  Difference: Plugin and Theme
6.  First Theme
    Q. Is there any way to scaffold the theme directory same as we can scaffold the gutenburg block?
7.  **First Plugin**

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

8.  Some notes

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
    `add_shortcode( string $tag, callable $callback )`

    **Parameters:**
    $tag :- Shortcode tag to be searched in post content.

    $callback :- Callback function to run when the shortcode is found.

    Every shortcode callback is passed three parameters by default, including an array of attributes ($atts), the shortcode content or null if not set ($content), and finally the shortcode tag itself ($shortcode_tag), in that order.

-   [`add_menu_page()`](https://developer.wordpress.org/reference/functions/add_menu_page/):
    `add_menu_page( string $page_title, string $menu_title, string $capability, string $menu_slug, callable $callback = ”, string $icon_url = ”, int|float $position = null ): string`

    Adds a top-level Menu page

-   [`add_submenu_page()`](https://developer.wordpress.org/reference/functions/add_submenu_page/):
    `add_submenu_page( string $parent_slug, string $page_title, string $menu_title, string $capability, string $menu_slug, callable $callback = ”, int|float $position = null ): string|false`

    Adds a submenu page.

## Use of `add_shortcode($tag, $callback_function)` and `shortcode_atts($defaults, $user_atts, $Shortcode_tag)`

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

## Debugging in Wordpress

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
