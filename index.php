<!DOCTYPE html>
 <html lang="en">
   <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Questions Game - Home Page</title>
    <meta name="author" content="Louiza Agroti"/>
    <meta name="description" content="Questions Game - Home Page"/>
    <meta name="keywords" content="Questions Game, Home Page" />
    <link rel="shortcut icon" href="baseline_map_black_18dp.png" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="index.css" />
   </head>
   <body>

    <div class="navbar">
        <ul class="nav justify-content-center">
        <li class="nav-item">
            <a class="nav-link active" href="index.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="scores.php">Scores</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="help.php">Help</a>
        </li>
        </ul>
    </div>


    <br>
    <br>
    <br>

    <?php
  function getNextQuestion($level) {
    $xml=simplexml_load_file("Questions.xml"); 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["radio"]) && !empty($_POST["radio"])) {
            // collect value of input field
            $answer = $_POST["radio"];
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
        $rand = rand(1,25);
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
    if (isset($_GET['act'])) {
        $counter = 1; ?> 
        
    <div class="game">    
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">

        <?php $xml=simplexml_load_file("Questions.xml"); 
            if ($GLOBALS['counter'] == 1){
                $level = "medium";
            //echo $xml->$level->question . "<br>";  
            } else if ($counter == 10){ ?>
                <input class="btn btn-primary btn-lg" type="submit" value="&laquo&laquo End">
                <input class="btn btn-primary btn-lg" type="submit" value="Finish">
                <?php echo $counter . "/10 <br>"; 
            } 
            echo getQuestion($level); ?>
               
            <div class="form-check">
            <input class="form-check-input" type="radio" name="radio" <?php if (isset($true) && $true=="True") echo "checked";?> value="True" >
            <label class="form-check-label" for="exampleRadios1">
                True
            </label>
            </div>  

            <div class="form-check">
            <input class="form-check-input" type="radio" name="radio" <?php if (isset($false) && $false=="False") echo "checked";?> value="False" >
            <label class="form-check-label" for="exampleRadios1">
                False
            </label>
            </div>     
            
            <br>

            <div class="form-group row">
                <div class="col-sm-10">
                <input class="btn btn-primary btn-lg" type="submit" value="&laquo&laquo End">
                <input class="btn btn-primary btn-lg" type="submit" <?php getNextQuestion($level); ?> value="Next &raquo">
                </div>
            </div>

            <?php echo $counter . "/10 <br>";
            $GLOBALS['counter']++;

            /*   if (!empty($_POST['End'])){
                    exit();
                } */   
        ?>
    </form>
    </div>
<?php
   } else {
    ?>
    <div class="start">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
            <h1>Welcome to the Game!</h1>
            <br>
            <br>
            <br>
            <input type="hidden" name="act" value="run">
            <input class="btn btn-primary btn-lg" type="submit" value="Start">
        </form>
   </div>
    <?php
        }
    ?>

    <div class="fixed-bottom">
        <footer class="footer">
            <h4>Good luck!!!</h4>
        </footer>
    </div>

   </body>
 </html>