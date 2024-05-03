# PHP_Basics

Git repository that contains all the php code that I created to understand and it's main branch will have refactor code for future reference.

## PHP Highlights

- **Case Sensitivity**: PHP is case insensitive for keywords, functions, class. However, it is _case sensitive_ for variables.
- **Indentation**: PHP don't care about it until and unless code are wrapped by php tag.
- **PHP Tag**: A PHP script starts with `<?php` and ends with `?>`
- **Semi-colon**: PHP statement must ends with `;`. Semi-colon are error prone.
- **Loosly Typed Language**: PHP is loosly typed language i.e. we don't have to declare the data type of varible while declaring them. _(Same as JS)_
- **Omit Closing Tag**: The `?>` closing tag in PHP is optional and is often omitted in files containing only PHP code. This practice prevents accidental injection of trailing whitespace into the response.

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

## Variables and Data Types

**Rules for PHP variables:**  
`A variable name`

- must starts with the $ sign, followed by the name of the variable
- must start with a letter or the underscore character
- cannot start with a number
- can only contain alpha-numeric characters and underscores (A-z, 0-9, and \_ )
  > Variable names are case-sensitive ($age and $AGE are two different variables)

> PHP is loosly typed language. However, In PHP 7, type declarations were added. This gives an option to specify the data type expected when declaring a function, and by enabling the strict requirement, it will throw a "Fatal Error" on a type mismatch.

We can assign same value to multiple variable:
`$var1 = $var2 = $var3 = "common value";`

**[Varible Scope](./var_scope.php)**  
PHP has three different variable scopes:

1. local
2. global
3. static

- The `global` keyword is used to access a global variable from within a function.
- PHP also stores all global variables in an array called `$GLOBALS[index]`. The _index_ holds the name of the variable. This array is also accessible from within functions and can be used to update global variables directly.
- In case of `Static` variable, each time the function is called, that variable will still have the information it contained from the last time the function was called.

- > Note: The variable is still local to the function.

**Data Types in PHP**

- String
- Integer
- Float (floating point numbers - also called double)
- Boolean
- Array
- Object
- NULL
- Resource

## Type Casting

Casting in PHP is done with these statements:

- (string) - Converts to data type String
- (int) - Converts to data type Integer
- (float) - Converts to data type Float
- (bool) - Converts to data type Boolean
- (array) - Converts to data type Array
- (object) - Converts to data type Object
- (unset) - Converts to data type NULL

  ```php
  $var = 5;       // Integer
  $var = 5.34;    // Cast to Float
  $var = "hello"; // Cast to String
  ```

## Inbuilt Functions

- **echo Statement**  
  returns: no return value  
  parameters: Anything that you want to display in screen

  - can take multiple parameters
  - can be used with or without parentheses: `echo` or `echo()`
  - Same as `print` but marginally faster.

- **var_dump()**  
  returns: data type and the value of variable  
  parameter: variable

- **print statement**  
  returns: 1  
  parameter: Single parameter to display in screen
  - can be used with or without parentheses: `print` or `print()`
  - same as `echo` but slower

## PHP Numbers

There are three main numeric types `with related func` in PHP:

- Integer `is_int()`
- Float `is_float()`
- Number Strings `is_numeric()`

  ```php
  $a = 5;
  $b = 5.34;
  $c = "25";
  var_dump($a); //Integer
  var_dump($b); // Float
  var_dump($c); // String
  var_dump(is_numeric($c)); //Prints true
  ```

  In addition, PHP has two more data types used for numbers:

- Infinity `is_finite() && is_infinite()`
- NaN `is_nan()`

**Inbuilt function for PHP Numbers**

```php
$var = "123";
is_numeric($var); // check whether the parameter is numeric
```

## PHP String

**ESCAPE CHARACTER:** `\`

**Difference between "double quote" & 'single quote'**

> Double quote are like template literal(`) in JS; variables are replaced.  
> Single quote are like double quote in JS; no variables are replaced.

**Concatenate String**

```php
$var1 = "Hello";
$var2 = "World";
echo $var1 . " " . $var2;

// Same as above
$var1 = "Hello";
$var2 = "World";
echo "$var1 $var2"; // Using power of Double quote
```

**Inbuilt function for PHP String**

> All below functions don't mutate the original variables(by default) unless it is mentioned.

- **strlen**  
  return: length of string in int data type  
  parameter: `string` || `int` data type variable

- **str_word_count**  
  return: number of words in int data type  
  parameter: `string` data type variable

- **strpos(2)**  
  return: `character position` of the first match if found and `false` if no match is found  
  parameter(2):

  1. `string` where you want to search
  2. `string` what you want to search

  ```php
  $var1 = "Hello I am Learning PHP";
  echo strpos($var1, "PHP"); //20
  echo "<br>";
  echo strpos($var1, "zzz"); // false
  /*
    last echo doesn't display anything. This is because echo outputs one or more strings, and false is not a string.
    When false is converted to a string, it becomes an empty string, which is why nothing is displayed.
  */
  ```

- **strtoupper**  
  returns: String in upper case  
  parameter: String to upper case

  ```php
  $strVar = "Hello I am Learning PHP in lower case";
  echo strtoupper($strVar); // HELLO I AM LEARNING PHP IN LOWER CASE
  echo "<br>";
  echo "$strVar"; // Hello I am Learning PHP in lower case
  ```

- **strtolower**

  > Opposite of `strtoupper()` function

- **str_replace**

  ```php
  $phpvar = "Hello World!";
  echo str_replace("World", "Team", $phpvar);
  ```

- **strrev**

  ```php
  $x = "Hello World!";
  echo "<br/> After Reversing: " . strrev($x);
  echo "<br/> Before reversing: " . $x;
  ```

- **trim**

  ```php
  $var = " Hello World! ";
  echo trim($var); // "Hello World!"
  echo $var; // " Hello World1 "
  ```

- **explode**  
  Convert string into an Array.  
  return: an array by spliting a given string  
  parameters: (seperator, string_to_split)

- **substr**

  ```php
  $var = " Hello World! ";
  echo substr($var, 6, 5); // "World"
  echo substr($var, 6); // "World1"
  # From end
  echo substr($var, -6, 3); // "Wor"
  # starting from index 5, and continue index -3 i.e. from end
  echo substr($x, 6, -2); //Worl
  ```
