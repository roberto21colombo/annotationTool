<?php 
    session_start();
    if($_SESSION['loggedin']){
        if(isset($_GET['group']) && isset($_GET['newUserId'])){
            include 'model.php';
            
            $name = $_GET['name'];
            $surname = $_GET['surname'];
            $email = $_GET['email'];
            $group = $_GET['group'];
            $idUser = $_GET['newUserId'];
            model::addUser($name, $surname, $email, $idUser, $group);
        }
    }
    
    header('Location: panelControl.php');
?>