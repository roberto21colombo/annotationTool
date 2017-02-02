<?php
    //classe model mi contiene le connessioni al DB e altre funzioni utili lato server
    class model{
        //Dato l'id utente ritorna i video a lui assegnati in base al gruppo di appartenenza
        function getVideoByUsrId($id){
            $conn = mysqli_connect('localhost', 'root', '', 'annotationdb');
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
            mysqli_close($conn);
            return $risultato;
        }
        
        //Dato id utente, nome del video e tipo, ritorna un'immagine con la spunta 
        //se il video è già stato analizzato (il file csv è presente sul server), 
        //un'immagine di check se il video non è ancora stato analizzato 
        function isVideoWatched($id,$video,$type){
            
            if(file_exists("annotation/".$id."/".$video."/".$type.".csv")){
                return '<img src="img/check.png" height="15" width="15"';
            }
            else
            {
                return '<img src="img/uncheck.png" height="15" width="15"';
            }
        }
        
        function isAnnotationExist($idUtente, $video, $tipo){
            $conn = mysqli_connect('localhost', 'root', '', 'annotationdb');
            $query = 'SELECT COUNT("id") FROM annotation WHERE UserId="'.$idUtente.'" AND NameVideo="'.$video.'" AND TypeVideo="'.$tipo.'"';
            
            $result = mysqli_query($conn, $query);
            if($result==0){
                return false;
            }else{
                return true;
            }
            
            mysqli_close($conn);
        }
        
        function rmOldAnnotation($idUtente, $video, $tipo){
            $conn = mysqli_connect('localhost', 'root', '', 'annotationdb');
            $query = 'DELETE FROM annotation WHERE UserId="'.$idUtente.'" AND NameVideo="'.$video.'" AND TypeVideo="'.$tipo.'"';
            
            mysqli_query($conn, $query);
            
            mysqli_close($conn);
        }
        
        function addAnnotation($data){
            $conn = mysqli_connect('localhost', 'root', '', 'annotationdb');
            
            $mydebug = fopen("debug.txt", "w") or die("Unable to open file!");
            
            
            foreach($data->valvid as $row){
                $query='INSERT INTO annotation VALUES ("'.$row->timeStamp.'","'.$data->idUtente.'","'.$data->video.'","'.$data->tipo.'","'.$row->value.'",NULL);';
                mysqli_query($conn, $query);
                fwrite($mydebug, $query);
            }
            mysqli_close($conn);
        }
    }
?>