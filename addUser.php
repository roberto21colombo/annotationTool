<?php 
    session_start();
    if($_SESSION['loggedin']){
        if(isset($_GET['group']) && isset($_GET['newUserId'])){
            include 'model.php';
            
            $group = $_GET['group'];
            $idUser = $_GET['newUserId'];

            model::addUser($idUser, $group);
        }
    }
    
    header('Location: panelControl.php');
?>