<?php

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