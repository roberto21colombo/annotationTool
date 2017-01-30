<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php 
    $id = $_GET['id'];
    include 'model.php';
    $video = Model::getVideoByUsrId($id);
?>

<html>
    <head>
        <title>Annotation Tool</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/main.css"/>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
    </head>
    
    <body id="bodycontainer">
        
        
        
        <!--sezione che gestisce la tabella con la lista dei video-->
        <div class="menuFrame">
            <div id="header" style="text-align: center">
            <h1>Annotation Tool</h1>
        </div>
            <?php include './videoMenuTable.php';?>
        </div>
        
        <!--
        div che include la seconda sezione del sito
        titolo video
        video
        slidebar
        sam
        -->
        <div class="videoFrame" id="videoFrame" style="visibility: <?php if(isset($_GET['vid'])) echo 'visible'; else echo 'hidden' ?>">
          
            <!--Sezione che carica il titolo del video e il video stesso-->
            <?php include './videoPlayer.php'; ?>

            <!--Includo la slidebar e il suo funzioanmento, registrando automaticamente i valori dentro valSlidebar-->
            <?php include './slidebar.php'; ?>

            <!--carico immagine del sam in base al tipo di video-->
            <div class="sam">
                <img class="samimg" src="img/sam<?php echo $_GET['type'].'.png'?>"/>
            </div>
        </div>
        
        <div style="clear:both;"></div>
        
        <script type="text/javascript">
            var currentTime = 0;

            var arrayAnnot = 
                {
                    idUtente:<?php echo $_GET['id'] ?>,
                    video:<?php echo '"'.$_GET['vid'].'"' ?>,
                    tipo:<?php echo '"'.$_GET['type'].'"' ?>,
                    valvid:[]
                };

            
            function readVid() {
                currentTime = document.getElementById("myVid").currentTime;
                arrayAnnot.valvid.push({timeStamp:currentTime, value:valSlidebar});
            }
            function vidEnded(){
                var json = JSON.stringify(arrayAnnot);
                console.log(json);
                $.ajax({
                    type: "POST",
                    url: "saveAnnotation.php",
                    data: {data : json}, 
                    cache: false
                });
                setTimeout(function() {
                    window.location.reload();
                }, 500);
            }

        </script>

    </body>
</html>
