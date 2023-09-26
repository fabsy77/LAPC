<?php
    session_start();
    require_once('../classes/database.php');
    include('../src/header.php');
    include('../src/navbar.php');

    // get all Users
    $users = $database->getAllUsers();

    // check for needed data
    if(isset($_POST['save']) && isset($_POST['username']) && isset($_POST['lastname']) && isset($_POST['birthday'])){
       //verifica se foi enviado
        if(isset($_POST['password']) && (isset($_POST['password_2']))){
             // verificacao das 2 senhas
           $validate =  $_POST['password'] == $_POST['password_2'] ? true : false;
            //se for verdadeiro 
           if($validate ){
            $database->createProduct($_POST['username'], $_POST['lastname'], $_POST['birthday']);
                    // redirect to product administration page
                header("Location: ./userAdm.php?msg=usuario cadatrado com sucesso");// user adm
           }
           else{
            echo "a senhas nao conferem";
           }
        }
        else{
            echo "um dos campos da senha nao foi preenchido";
        }
    }
    else{
        echo "um dos campos nao foi preenchido.";
    
    }
?>  

<h1>New user</h1>

<form action="addUser.php" method="post">
    FirstName: <input type="text" required name="username"><br>
    LastName: <input type="text" step="any" required name="lastName"><br>
    Date of birthday: <input type="date" id="birthday" name="birthday"><br><br>
    Password: <input type="password" required name="password"><br>
    Repeat password: <input type="password" required name="password_2"><br>
    
    <input type="submit" name="save" value="Speichern">
</form>


<?php
    include('../src/footer.php');
?>