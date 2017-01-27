<html>
    <head>
        <title>TODO supply a title</title>
        <link rel="stylesheet" type="text/css" href="css/figure.css"/>
    </head>
    <body onmousemove="follow(event)">
        <div id="bar" onclick="switchActivate()">
            <div id="slider"></div>
        </div>
        
        <script>
            var bar = document.getElementById('bar');
            var slider = document.getElementById('slider');
            
            var activate = false;
            
            var posBar = getPos(bar);
            var xiBar = bar.offsetLeft;
            var xfBar = bar.offsetLeft+bar.offsetWidth-slider.offsetWidth;
            
            slider.style.position = "absolute";
            
            function switchActivate() {
                activate = !activate;
            }
            
            function follow(event){
                if(activate){
                    var x = event.clientX;
                    if(x>xiBar && x<xfBar){
                        //var y = event.clientY;
                        slider.style.left = x+'px';
                        slider.innerHTML = getValSlidebar(x, xiBar, xfBar);;
                    }else if (x<=xiBar){
                        slider.style.left = xiBar+'px';
                        slider.innerHTML = "-1";
                    }else if (x>=xfBar) {
                        slider.style.left = xfBar+'px';
                        slider.innerHTML = "1";
                    }
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