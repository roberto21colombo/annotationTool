<?php
    include 'model.php';
    $groups = model::getGroups();
    $lastUserId = model::getLastUserId();
?>
<head>
    <title>Managr Page</title>
</head>
<body>
    <h3>Inserisci Utente</h3>
    <div id="newUsers">  
        <form action="#" method="POST">
            <table>
                <tr>
                    <td>
                        Gruppo
                    </td>
                    <td>
                        Id Assegnato
                    </td>
                </tr>
                <tr>
                    <td>
                        <select name="selectGroups">
                            <?php
                            while($riga = mysqli_fetch_array($groups)){
                                echo '<option value="'.$riga['id'].'">'.$riga['name'].'</option>';
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <?php echo $lastUserId+1 ?>
                    </td>
                    <td>
                        <input type="submit" value="Aggiungi"/>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    
    <hr>
    
    <h3>Sincronizza Cartelle Video Gruppi</h3>
    <div id="sycngroup">  
        <form action="syncgroup.php">
            <input type="submit" value="Sincronizza" />
        </form>
    </div>
</body>

<?php 
    if(isset($_POST['selectGroups'])){
        $group = $_POST['selectGroups'];
        $idUser = model::addUser(($lastUserId+1), $group);
        header('Location: managerPage.php');
    }
?>