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
    }
?>