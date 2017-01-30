<?php
    //Questo file sta sul server, viene chiamato dal client quando il video è terminato.
    //Gli viene consegnato il file json 'data' che contiene le informazioni riguardante 
    //l'utente, il video visto e per ogni istante di tempo il valore della slidebar. 
    //Questo script ricerca/crea la cartella dedicata all'utente e al video appena visto, 
    //crea un file csv che riporta il tipo di video analizzato e crea una tabella csv con il seguente formato:
    //TimeStamp - UserId - NameVideo - TypeVideo - Value
    $data = json_decode(stripslashes($_POST['data']));
    
    if(isset($data)){
        if (!file_exists("annotation/".$data->idUtente."/".$data->video)) {
            mkdir("annotation/".$data->idUtente."/".$data->video, 0777, true);
        }
        
        $myfile = fopen("annotation/".$data->idUtente."/".$data->video."/".$data->tipo.".csv", "w") or die("Unable to open file!");
        
        fwrite($myfile,"TimeStamp;UserId;NameVideo;TypeVideo;Value\n");
        foreach($data->valvid as $row){
            fwrite($myfile, $row->timeStamp.";".$data->idUtente.";".$data->video.";".$data->tipo.";".$row->value."\n");
        }
    }
      
?>