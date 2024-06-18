# Learn Wordpress

# Table of Content

# Part 0

## Part0: About Course

## Part0.1: About Author

## Part0.2: How to get most out of this course?

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

8.  Some notes

## PHP

1. Variables
2. Arrays
3. Objects
4. Functions
5. Classes
6. PHP materials

## Wordpress Functions

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
