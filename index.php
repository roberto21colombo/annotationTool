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
    
    <body>
                

        
        <div class="header">
            questo testo è scritto assolutamente a caso, ed è stato modificato
        </div>
        
        <div class="menuFrame">
            <table class="menuVideos">
                <tr>
                    <td><h3>Arousal</h3></td>
                    <td><h3>Valence</h3></td>
                </tr>
                <?php
                while($riga = mysqli_fetch_array($video)){
                    echo 
                    '<tr> '
                        . '<td>'
                            . '<a href="/annotationtool/index.php?id='.$id.'&vid='.$riga['name'].'&type=arousal">'.$riga['name']
                            . Model::isVideoWatched($id,$riga['name'],'arousal').'</a>'
                        . '</td>'              
                        . '<td>'
                            . '<a href="/annotationtool/index.php?id='.$id.'&vid='.$riga['name'].'&type=valence">'.$riga['name']
                            . Model::isVideoWatched($id,$riga['name'],'valence').'</a>'
                            . '</td>'.
                    '</tr>';
                }
                ?>  
            </table>
            <ul>
                
            </ul>
        </div>
        
        <div class="videoFrame">
            <?php 
            if(isset($_GET['vid']))
            {
                echo '<h2 style="display: inline">'.$_GET['type'].':</h2><h3 style="display: inline"> '.$_GET['vid'].'</h3>';
                echo '<video id="myVid" ontimeupdate="readVid()" onended="vidEnded()" controls>';
                echo '<source src="video/'.$_GET['vid'].'" type="video/ogg">';
                echo '</video>';
            
            }
            ?>
            <div style="width: 100%">
                <input id = "slidebar" type="range" min="-1" max="1" value="0" step="0.01" onmouseup="miaFunc('up')" onmousedown="miaFunc('down')" onmousemove="showValue(this.value)"/>
                <span id="range">0</span>
                <span id="down">no</span>
                <span id="second">0</span>
                <script type="text/javascript">
                    var valSlidebar = "0";
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
                        
                        document.getElementById("second").innerHTML = currentTime;
                        
                        /*
                        element.time = currentTime;
                        element.val = valSlidebar;
                        console.log("currentTime: "+currentTime+"; slidebarVal: "+valSlidebar);
                        arrayValVid.push(element);
                        */
                       arrayAnnot.valvid.push({timeStamp:currentTime, value:valSlidebar});
                    }
                    function vidEnded(){
                        //window.location = '/annotationtool/visualizza.php?array[]='+arrayValVid;
                        //console.log(tempi);
                        //console.log(valori);
                        //console.log(arrayValVid);
                        
                        
                        var json = JSON.stringify(arrayAnnot);
                        //console.log(arrayValVid);
                        console.log(json);
                        $.ajax({
                            type: "POST",
                            url: "visualizza.php",
                            data: {data : json}, 
                            cache: false
                        });
                    }
                    function showValue(newValue)
                    {
                        this.valSlidebar=newValue;
                        document.getElementById("range").innerHTML=valSlidebar;
                    }
                    function miaFunc(gest)
                    {
                        document.getElementById("down").innerHTML=gest;
                    }
                    
                </script>
            </div>
        </div>
        
        <div style="clear:both;"></div>
        
        

    </body>
</html>
