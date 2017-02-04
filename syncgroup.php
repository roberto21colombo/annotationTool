<?php
//Svuoto tabella videos, groups e relgroupvideo dal database
//Per ogni cartella sul server, carica il nome dei video nella tabella "Videos"
//Carica nella tabella "gropus" il nome del gruppo (nome cartella) a cui quei video appartengono
//Collega in RelGropuVideo il gruppo ai video

$conn = mysqli_connect('localhost', 'root', '', 'annotationdb');

clearTables($conn);

//array con i nomi delle cartelle
$arrayFolder = array_diff(scandir("video"), array('.', '..','.DS_Store'));
foreach ($arrayFolder as $folder){
    echo $folder;
    echo '</br>';
    
    //carico il nome del gruppo sul DB
    addGroup($folder, $conn);
    $arrayVideo = array_diff(scandir("video/".$folder), array('.', '..','.DS_Store'));
    foreach ($arrayVideo as $video){
        echo $video;
        echo '</br>';
        
        //carico il video sul DB
        addVideo($video, $conn);
        //associo il video al gruppo sul DB
        associateVidGroup($video, $folder, $conn);
    }
}

mysqli_close($conn);
 
header('Location: managerPage.php');
 
 
 
 
 
 
 function addGroup($folder, $conn){
     $query = 'INSERT INTO groups (id, name) VALUES (null, "'.$folder.'");';
     mysqli_query($conn, $query);
 }

function addVideo($video, $conn){
    $query = 'INSERT INTO videos (id, name) VALUES (null, "'.$video.'");';
    mysqli_query($conn, $query);
}

function associateVidGroup($video, $folder, $conn){
    $query1 = 'SELECT id FROM videos ORDER BY id DESC LIMIT 1;';
    $idVideo = mysqli_fetch_array(mysqli_query($conn, $query1))['id'];
    $query2 = 'SELECT id FROM groups ORDER BY id DESC LIMIT 1;';
    $idGroup = mysqli_fetch_array(mysqli_query($conn, $query2))['id'];
    
    $query3 = 'INSERT INTO relgroupvideo(fk_idvideo, fk_idgroup) VALUES ('.$idVideo.','.$idGroup.');';
    mysqli_query($conn, $query3);
}

function clearTables($conn){
    $query1 = 'TRUNCATE TABLE videos;';
    $query2 = 'TRUNCATE TABLE groups;';
    $query3 = 'TRUNCATE TABLE relgroupvideo;';
    
    mysqli_query($conn, $query1);
    mysqli_query($conn, $query2);
    mysqli_query($conn, $query3);
}
?>

