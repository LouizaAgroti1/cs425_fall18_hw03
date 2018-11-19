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
  function getNextQuestion($level) {
    $xml=simplexml_load_file("Questions.xml");   
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["radio"]) && !empty($_POST["radio"])) {
            // collect value of input field
            $answer = $_POST["radio"];
            echo $answer;
            if ($xml->$level->question->answer == $answer){
                echo "You answered True! <br>";
                switch ($level) {
                    case ("easy"):  echo getQuestion("medium") . "<br>";
                                    break;
                    default:    echo getQuestion("difficult") . "<br>"; 
                }                               
            } else{
                echo "You answered False! <br>";
                switch ($level) {
                    case ("difficult"): echo getQuestion("medium") . "<br>";
                                        break;
                    default:    echo getQuestion("easy") . "<br>"; 
                }
            }
         } else {
            echo "Please give an answer!";
        }
    }
}
    ?> 

    <?php 
    function getQuestion($level){
        $xml=simplexml_load_file("Questions.xml"); 
        $rand = rand(1,5);
      //  $random = array_rand($xml->xpath($level));

       // if (is_array($random) || is_object($random)){
          //  echo $xml->question[$rand];
        //foreach ($random as $key) {
         //   $question = $xml->question[$rand];
          //  echo $question[$rand];
        
    
        return $xml->$level->question[$rand];
     //   }
    
    } 
    
     /*   $xml = new DOMDocument();
        $rand = rand(1,5);
        $xml->loadXML('<root><i'.$rand.'><cannot-know-i /></i'.$rand.'></root>');
        foreach( $xml->documentElement->childNodes as $node )
            return $node->question; // i$rand

   /*     if (is_array($random) || is_object($random)){
            echo $xml->question[$random];
        foreach ($random as $key) {
            $question = $xml->question[$key];
            echo $question[$key];
        }
    } */
    ?>

        <?php
    if (!empty($_GET['act'])) {
        ?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
    <?php $xml=simplexml_load_file("Questions.xml"); 
        $counter = 1;
    
        
        if ($counter == 1){
            $level = "medium";
         //echo $xml->$level->question . "<br>";  
        } else if ($counter == 5){ 
            echo getQuestion($level); ?>
            <label class="container">True
            <input type="radio" name="radio" <?php if (isset($true) && $true=="True") echo "checked";?> value="True" >
            <span class="checkmark"></span>
            </label>
            <label class="container">False
            <input type="radio" name="radio" <?php if (isset($false) && $false=="False") echo "checked";?> value="False" >
            <span class="checkmark"></span>
            </label>
            <input type="submit" value="Finish">
            <?php echo $counter . "/5 <br>"; 
        } 
        echo getQuestion($level); ?>     
        <label class="container">True
        <input type="radio" name="radio" <?php if (isset($true) && $true=="True") echo "checked";?> value="True" >
        <span class="checkmark"></span>
        </label>
        <label class="container">False
        <input type="radio" name="radio" <?php if (isset($false) && $false=="False") echo "checked";?> value="False" >
        <span class="checkmark"></span>
        </label>
        <input type="submit" value="End">
        <input type="submit" value="Next &raquo" <?php getNextQuestion ($level); ?>>
        <?php echo $counter . "/5 <br>";
        $counter++;

         /*   if (!empty($_POST['End'])){
                exit();
            } */
        
    ?>
</form>
<?php
   } else {
    ?>
    <h1>Welcome to the Game!</h1>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
        <input type="hidden" name="act" value="run">
        <input type="submit" value="Start">
    </form>
    <?php
        }
    ?>

   </body>
 </html>