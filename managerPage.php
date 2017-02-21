<?php
    session_start();
    $_SESSION['loggedin'] = FALSE;
    
    if(isset($_POST['btnAccedi'])){
        include 'model.php';
        $admin = model::getAdmin();
        
        while ($riga = mysqli_fetch_array($admin)){
            if($_POST['user'] == $riga['nome'] && $_POST['psw'] == $riga['password']){
                $_SESSION['loggedin'] = TRUE;
                header('location: panelControl.php');
            }
        }
        

    }
?>

<head>
    <title>Managr Page</title>
    <script src="jquery.js"></script>
</head>
<body>
    <div id="login">
        <form method="POST" action="">
            Nome Utente: <input name="user" type="text" id="nomeUt"></input>
            Password: <input name="psw" type="password" id="psw"></input>
            <input type="submit" value="Accedi" name="btnAccedi"/>
        </form>
    </div>
</body>