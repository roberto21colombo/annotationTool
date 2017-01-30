 <table class="menuVideos">
    <tr>
        <td><h3>Arousal</h3></td>
        <td><h3>Valence</h3></td>
    </tr>
    <?php
    while($riga = mysqli_fetch_array($video)){
        echo 
        '<tr> '
            . '<td>'
                . '<a href="/annotationtool/index.php?id='.$id.'&vid='.$riga['name'].'&type=arousal">'.$riga['name']
                . Model::isVideoWatched($id,$riga['name'],'arousal').'</a>'
            . '</td>'              
            . '<td>'
                . '<a href="/annotationtool/index.php?id='.$id.'&vid='.$riga['name'].'&type=valence">'.$riga['name']
                . Model::isVideoWatched($id,$riga['name'],'valence').'</a>'
                . '</td>'.
        '</tr>';
    }
    ?>  
</table>