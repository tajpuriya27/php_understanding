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
    echo "<br />";
    $var = ["key1" => "apple", "banana", "cherry"];
    $var2 = NULL;
    var_dump($var2);
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