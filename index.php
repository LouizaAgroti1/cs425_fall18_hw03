<!DOCTYPE html>
 <html>
   <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Questions Game - Home Page</title>
    <meta name="author" content="Louiza Agroti"/>
    <meta name="description" content="Questions Game - Home Page"/>
    <meta name="keywords" content="Questions Game, Home Page" />
    <link rel="shortcut icon" href="baseline_map_black_18dp.png" type="image/x-icon" />
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <link rel="stylesheet" type="text/css" media="screen" href="index.css" />

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
   </head>
   <body>

    <?php
        echo "Welcome to the Game!";

    ?>
    <br>

<!--
<a href="#" class="previous">&laquo; Previous</a>
<a href="#" class="next">Next &raquo;</a>
-->
    
    <?php
        $xml=simplexml_load_file("Questions.xml");
        echo $xml->level . "<br>";
        echo $xml->answer1;

    ?>


<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
    <h1><?php echo $xml->question1 . "<br>"; ?></h1>
    <label class="container">True
       <input type="radio" name="radio" <?php if (isset($true) && $true=="True") echo "checked";?> value="True" >
       <span class="checkmark"></span>
    </label>
    <label class="container">False
       <input type="radio" name="radio" <?php if (isset($false) && $false=="False") echo "checked";?> value="False" >
       <span class="checkmark"></span>
    </label> 
    <input type="submit" value="End">
    <input type="submit" value="Next &raquo">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["radio"]) && !empty($_POST["radio"])) {
        // collect value of input field
        $answer = $_POST["radio"];
        if ($xml->answer1 == $answer){
            echo "You answered True! <br>";
        } else{
            echo "You answered False! <br>";
        }
        echo $xml->question2 . "<br>";
     } else {
        echo "Please give an answer!";
    }
 /*   if (!empty($_POST['End'])){
        exit();
    } */
}
?>

   </body>
 </html>