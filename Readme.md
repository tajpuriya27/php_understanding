# PHP_Basics

Git repository that contains all the php code that I created to understand and it's main branch will have refactor code for future reference.

## PHP Highlights

- **Case Sensitivity**: PHP is case insensitive for keywords, functions, class. However, it is _case sensitive_ for variables.
- **Indentation**: PHP don't care about it until and unless code are wrapped by php tag.
- **PHP Tag**: A PHP script starts with `<?php` and ends with `?>`
- **Semi-colon**: PHP statement must ends with `;`. Semi-colon are error prone.
- **Loosly Typed Language**: PHP is loosly typed language i.e. we don't have to declare the data type of varible while declaring them. _(Same as JS)_

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

**Understanding**

> PHP is server scripting language, we write our index.php code and put it in server. Now, Apache server is serving us the file to our browser.

### What PHP file can contain

Can contain simple text, HTML, CSS, JavaScript, and PHP Code.

```php
<!DOCTYPE html>
<html>

<head>
    <title>PHP Syntax</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f4f4f4;
            text-align: center;
        }

        h1 {
            color: #333;
        }

        #activate-js {
            color: #333;
            text-align: center;
            margin-top: 20px;
        }

        button {
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <h1>This is HTML h1 tag</h1>
    Simple text in php file
    <br />
    <?php
    // This is a single-line comment
    # This is also a single-line comment
    /*
    This is a multiple-lines comment block
    that spans over multiple
    lines
    */
    echo "Hello World using PHP!";
    ?>
    <div id="activate-js"></div>
    <button onclick="activateJS()">Activate JS</button>
    <script>
        function activateJS() {
            document.getElementById("activate-js").innerHTML = "JavaScript activated!";
        }
    </script>
</body>

</html>
```
