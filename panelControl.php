<?php 
    session_start();
    
    if(!$_SESSION['loggedin']){
        header('location: managerPage.php');
    }else{
        //Ho effettuato correttamente il login
    
        include 'model.php';

        $groups = model::getGroups();
        $lastUserId = model::getLastUserId(); 
    }
    
?>


<div id="panelControl" style="margin: 20px 0 0 20px">
        <h3>Inserisci Utente</h3>
        <div id="newUsers">  
            <form action="panelControl.php" method="POST">
                <table>
                    <tr>
                        <td>
                            Nome
                        </td>
                        <td>
                            Cognome
                        </td>
                        <td>
                            Email
                        </td>
                        <td>
                            Gruppo
                        </td>
                        <td>
                            Id Assegnato
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" id="nameTxt">
                        </td>
                        <td>
                            <input type="text" id="surnameTxt">
                        </td>
                        <td>
                            <input type="text" id="emailTxt">
                        </td>
                        <td>
                            <select name="selectGroups" id="selectedGroups">
                                <?php
                                while($riga = mysqli_fetch_array($groups)){
                                    echo '<option value="'.$riga['id'].'">'.$riga['name'].'</option>';
                                }
                                ?>
                            </select>
                        </td>
                        <td style="text-align: center">
                            <span id="newUserId"><?php echo $lastUserId+1 ?></span>
                        </td>
                        <td>
                            <input type="button" value="Aggiungi" onclick="addUser()">
                        </td>
                    </tr>
                </table>
            </form>
        </div>

        <hr>

        <h3>Sincronizza Cartelle Video Gruppi</h3>
        <div id="sycngroup">
            <input type="button" value="Sincronizza" onclick="syncgroup()"></input>
        </div>
    </div>

<script>
    function syncgroup(){
        window.location.href = 'syncgroup.php';
    }
    
    function addUser(){
        var name = document.getElementById("nameTxt").value;
        var surname = document.getElementById("surnameTxt").value;
        var email = document.getElementById("emailTxt").value;
        var newUserId = document.getElementById("newUserId").innerHTML;
        var group = document.getElementById("selectedGroups").value;
        
        window.location.href = 'addUser.php?name='+name+'&surname='+surname+'&email='+email+'&newUserId='+newUserId+'&group='+group;
    }
</script>

