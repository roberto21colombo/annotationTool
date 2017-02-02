<?php
    //Questo file sta sul server, viene chiamato dal client quando il video è terminato.
    //Gli viene consegnato il file json 'data' che contiene le informazioni riguardante 
    //l'utente, il video visto e per ogni istante di tempo il valore della slidebar. 
    //Questo script ricerca/crea la cartella dedicata all'utente e al video appena visto, 
    //crea un file csv che riporta il tipo di video analizzato e crea una tabella csv con il seguente formato:
    //TimeStamp - UserId - NameVideo - TypeVideo - Value
    include 'model.php';

    $data = json_decode(stripslashes($_POST['data']));
    
    $idUtente = $data->idUtente;
    $video = $data->video;
    $tipo = $data->tipo;
    if(isset($data)){
        if (!file_exists("annotation/".$idUtente."/".$video)) {
            mkdir("annotation/".$idUtente."/".$video, 0777, true);
        }
        
        $myfile = fopen("annotation/".$idUtente."/".$video."/".$tipo.".csv", "w") or die("Unable to open file!");
        
        fwrite($myfile,"TimeStamp;UserId;NameVideo;TypeVideo;Value\n");
        foreach($data->valvid as $row){
            fwrite($myfile, $row->timeStamp.";".$idUtente.";".$video.";".$tipo.";".$row->value."\n");
            
        }
        
        //parte in cui carico il json su database
        //prima dovrei controllare che il video in questione non sia già presente sul db
        
        
        $exist = model::isAnnotationExist($idUtente, $video, $tipo);
        if($exist){
            model::rmOldAnnotation($idUtente, $video, $tipo);
        }
        
          Model::addAnnotation($data);
    }
      
?>