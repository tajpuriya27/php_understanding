# PHP_Basics

Git repository that contains all the php code that I created to understand and it's main branch will have refactor code for future reference.

## How to run PHP Code:

Hypertext PreProcessor(PHP) is server side scripting language i.e. it runs on server. We need server(Apache is popularly used) and PHP itself to run PHP code.

- Install any local server environment like XAMPP, MAMP, WAMP, Lalagron etc
- Install PHP via php.net.
  > Some server enviornment(XAMPP) may automatically install PHP in your system.

## Pure Basics

### Hello world PHP Code

`index.php` file within htdocs

```php
<!DOCTYPE html>
<html>
    <body>
       <?php
        // This is a single-line comment
        # This is also a single-line comment
        /*
        This is a multiple-lines comment block
        that spans over multiple
        lines
        */
       echo "Hello World using PHP!"
       ?>
   </body>
</html>
```

Run the local server environment and then visit `http://127.0.0.1` via browser
