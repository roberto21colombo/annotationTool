<html>
    <head>
        <title>TODO supply a title</title>
        <link rel="stylesheet" type="text/css" href="css/figure.css"/>
    </head>
    <body onmousemove="follow(event)">
        <div class = "divSlidebar" onclick="switchActivate()">
            <img id="slider" src="img/button.png"></img>
            <img id="bar" src="img/bar.png"></img>
            
        </div>
        <div style="clear:both;"></div>
        <script>
            var valSlidebar = 0;
            
            var bar = document.getElementById('bar');
            var slider = document.getElementById('slider');
            
            var halfWidthSlider = slider.offsetWidth/2;
            
            var activate = false;
            
            var posBar = getPos(bar);
            var xiBar = bar.offsetLeft-halfWidthSlider;
            var xfBar = bar.offsetLeft+bar.offsetWidth-slider.offsetWidth+halfWidthSlider;
            
            //slider.style.position = "absolute";
            
            function switchActivate() {
                activate = !activate;
            }
            
            function follow(event){
                
                if(activate){
                    var x = event.clientX-halfWidthSlider; //alle coordinate del mouse e tolgo 20 (metà larghezzaslider), in modo che il cursore sia al centro
                    if(x>xiBar && x<xfBar){
                        //var y = event.clientY;
                        slider.style.left = x+'px';
                        valSlidebar= getValSlidebar(x, xiBar, xfBar);
                        //slider.innerHTML = getValSlidebar(x, xiBar, xfBar);
                    }else if (x<=xiBar){
                        slider.style.left = xiBar+'px';
                        valSlidebar = -1;
                        //slider.innerHTML = "-1";
                    }else if (x>=xfBar) {
                        slider.style.left = xfBar+'px';
                        valSlidebar= 1;
                        //slider.innerHTML = "1";
                    }
                    document.getElementById("header").innerHTML=valSlidebar;
                }
            }
            
            function getValSlidebar(xSlider, xiBar, xfBar){
                //-1:xibar=1:xfBar=ValSlidebar:xSlider
                var percentuale = ((xSlider-xiBar)/(xfBar-xiBar));
                var ris = percentuale * 2 - 1;
                return ris;
            }
            
            function getPos(el) {
                // yay readability
                for (var lx=0, ly=0;
                     el !== null;
                     lx += el.offsetLeft, ly += el.offsetTop, el = el.offsetParent);
                return {x: lx,y: ly};
            }
        </script>
    </body>
</html>