<?php

    include 'config.php';
    
    //classe model mi contiene le connessioni al DB e altre funzioni utili lato server
    class model{
        //Dato l'id utente ritorna i video a lui assegnati in base al gruppo di appartenenza
        function getVideoByUsrId($id){
            $conn = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_pass'], $GLOBALS['db_name']);
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
            
            if(file_exists("annotation/".$id."/".str_replace(".", "_", $video)."/".$type.".csv")){
                return '<img src="img/check.png" height="15" width="15"';
            }
            else
            {
                return '<img src="img/uncheck.png" height="15" width="15"';
            }
        }
        
        function isAnnotationExist($idUtente, $video, $tipo){
            $conn = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_pass'], $GLOBALS['db_name']);
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
            $conn = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_pass'], $GLOBALS['db_name']);
            $query = 'DELETE FROM annotation WHERE UserId="'.$idUtente.'" AND NameVideo="'.$video.'" AND TypeVideo="'.$tipo.'"';
            
            mysqli_query($conn, $query);
            
            mysqli_close($conn);
        }
        
        function addAnnotation($data){
            $conn = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_pass'], $GLOBALS['db_name']);
            
            $mydebug = fopen("debug.txt", "w") or die("Unable to open file!");
            
            
            foreach($data->valvid as $row){
                $query='INSERT INTO annotation VALUES ("'.$row->timeStamp.'","'.$data->idUtente.'","'.$data->video.'","'.$data->tipo.'","'.$row->value.'",NULL);';
                mysqli_query($conn, $query);
                fwrite($mydebug, $query);
            }
            mysqli_close($conn);
        }
        
        function getGroupFromId($id){
            $conn = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_pass'], $GLOBALS['db_name']);
            $query = 'SELECT groups.name FROM groups, users WHERE users.id = '.$id.' AND users.fk_idgroup=groups.id';
            $result = mysqli_query($conn, $query);
            mysqli_close($conn);
            return (mysqli_fetch_array($result)['name']);
        }
        
        function getGroups(){
            $conn = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_pass'], $GLOBALS['db_name']);
            $query = 'SELECT * FROM groups;';
            $result = mysqli_query($conn, $query);
            mysqli_close($conn);
            return $result;
        }
        
        function addUser($name, $surname, $email, $id, $group){
            $conn = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_pass'], $GLOBALS['db_name']);
            $query = 'INSERT INTO users VALUES ('.$id.', '.$group.', "'.$name.'", "'.$surname.'", "'.$email.'");';
            mysqli_query($conn, $query);
            mysqli_close($conn);
        }
        
        function getLastUserID(){
            $conn = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_pass'], $GLOBALS['db_name']);
            $query = 'SELECT id FROM users ORDER BY id DESC LIMIT 1;';
            $result = mysqli_query($conn, $query);
            mysqli_close($conn);
            return mysqli_fetch_array($result)['id'];
        }
        
        function getAdmin(){
            $conn = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_pass'], $GLOBALS['db_name']);
            $query = 'SELECT * FROM userAdmin';
            $result = mysqli_query($conn, $query);
            mysqli_close($conn);
            return $result;
        }
        
        function addGroup($folder){
            $conn = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_pass'], $GLOBALS['db_name']);
            $query = 'INSERT INTO groups (id, name) VALUES (null, "'.$folder.'");';
            mysqli_query($conn, $query);
            
            mysqli_close($conn);
        }

        function addVideo($video){
            $conn = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_pass'], $GLOBALS['db_name']);
            $query = 'INSERT INTO videos (id, name) VALUES (null, "'.$video.'");';
            mysqli_query($conn, $query);
            
            mysqli_close($conn);
        }

        function associateVidGroup($video, $folder){
            $conn = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_pass'], $GLOBALS['db_name']);
            $query1 = 'SELECT id FROM videos ORDER BY id DESC LIMIT 1;';
            $idVideo = mysqli_fetch_array(mysqli_query($conn, $query1))['id'];
            $query2 = 'SELECT id FROM groups ORDER BY id DESC LIMIT 1;';
            $idGroup = mysqli_fetch_array(mysqli_query($conn, $query2))['id'];

            $query3 = 'INSERT INTO relgroupvideo(fk_idvideo, fk_idgroup) VALUES ('.$idVideo.','.$idGroup.');';
            mysqli_query($conn, $query3);
            
            mysqli_close($conn);
        }

        function clearTables(){
            $conn = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_pass'], $GLOBALS['db_name']);
            $query1 = 'TRUNCATE TABLE videos;';
            $query2 = 'TRUNCATE TABLE groups;';
            $query3 = 'TRUNCATE TABLE relgroupvideo;';

            mysqli_query($conn, $query1);
            mysqli_query($conn, $query2);
            mysqli_query($conn, $query3);
            
            mysqli_close($conn);
        }
    }
?>