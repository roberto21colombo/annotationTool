<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/figure.css"/>
    </head>
    <!--registro il movimento del mouse su tutto il body, di modo da non limitarlo solo nell'area dello slider-->
    <body onmousemove="follow(event)">
        <!--carico le due immagini, della barra e dello slider-->
        <div class = "divSlidebar" onclick="switchActivate()" >
            <img id="slider" src="img/button.png"></img>
            <img id="bar" src="img/bar.png"></img>
            
        </div>
        <div style="clear:both;"></div>
        
        <!--Carico il testo-guida della slidebar in base al tipo di video che si sta analizzando-->
        <div id="txtSlide" style="text-align: center">
            <span id="txtNeg" style="float: left">
                <?php 
                if($_GET['type'] == "arousal"){
                    echo 'Very Passive';
                }else if($_GET['type'] == "valence"){
                    echo 'Very Negative';
                }
                ?>
            </span>
            <span>0</span>
            <span id="txtPos" style="float: right">
                <?php 
                if($_GET['type'] == "arousal"){
                    echo 'Very Active';
                }else if($_GET['type'] == "valence"){
                    echo 'Very Positive';
                }
                ?>
            </span>
        </div>
        
        <script>
            //valSlidebar è il valore tra -1 e 1 assunta dalla slide bar
            var valSlidebar = 0;
            
            var bar = document.getElementById('bar');
            var slider = document.getElementById('slider');
            //halfWidthSlider rappresenta metà della larghezza dello slider
            var halfWidthSlider = slider.offsetWidth/2;
            //Flag per identificare se lo slider è attivo (segue il mouse) o disattivo
            var activate = false;
            
            //coordinata x dell'inizio e fine della barra bar
            var xiBar = bar.offsetLeft-halfWidthSlider;
            var xfBar = bar.offsetLeft+bar.offsetWidth-slider.offsetWidth+halfWidthSlider;
            
            //centro limmagine dello slider in mezzo alla barra
            slider.style.left = xiBar+2+(xfBar-xiBar)/2+'px';
            
            function switchActivate() {
                activate = !activate;
            }
            
            //Funzione che fa raggiungere il puntatore del mouse allo slider
            //Assegna alla variabile valSlidebar il valore -1:1 della nuova posizione assunta 
            function follow(event){
                if(activate){
                    //alle coordinate del mouse e tolgo 20 (metà larghezzaslider), in modo che il cursore sia al centro
                    var x = event.clientX-halfWidthSlider; 
                    if(x>xiBar && x<xfBar){
                        slider.style.left = x+'px';
                        valSlidebar= getValSlidebar(x, xiBar, xfBar);
                    }else if (x<=xiBar){
                        slider.style.left = xiBar+'px';
                        valSlidebar = -1;
                    }else if (x>=xfBar) {
                        slider.style.left = xfBar+'px';
                        valSlidebar= 1;
                    }
                }
            }
            
            //data la posizione x dello slider, del punto x iniziale e finale della barra 
            //restituisce un valore scalato su -1:1
            function getValSlidebar(xSlider, xiBar, xfBar){
                var percentuale = ((xSlider-xiBar)/(xfBar-xiBar));
                var ris = percentuale * 2 - 1;
                return ris;
            }

        </script>
    </body>
</html>