<?php
    class model{
        
        function getVideoByUsrId($id){
            $conn = mysqli_connect('localhost', 'root', '', 'annotationdb');
            // put your code here   
            $query ='SELECT 
                        videos.id, videos.name
                    FROM 
                        videos, relgroupvideo, groups, users  
                    WHERE 
                        users.id='.$id.' AND
                        users.fk_idgroup=groups.id AND
                        relgroupvideo.fk_idgroup=groups.id AND
                        relgroupvideo.fk_idvideo=videos.id
                    ORDER BY videos.name';
            $risultato = mysqli_query($conn, $query);

            if($risultato === FALSE) { 
                die(mysql_error()); // TODO: better error handling
            }
            return $risultato;
        }
        
        function isVideoWatched($id,$video,$type){
            
            if(file_exists("annotation/".$id."/".$video."/".$type.".csv")){
                return '<img src="check.png" height="15" width="15"';
            }
            else
            {
                return '<img src="uncheck.png" height="15" width="15"';
            }
        }
    }
?>