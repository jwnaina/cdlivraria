<?php 

include('conexao.php'); 

if(isset($_POST['email']) || isset($_POST['senha'])) {
   
   if(strlen($_POST['email']) == 0) {
       echo '<div class="error">Preencha seu e-mail</div>';
   } else if(strlen($_POST['senha']) == 0) {
       echo '<div class="error">Preencha sua senha</div>';
   } else {

       $email = $mysqli->real_escape_string($_POST['email']);
       $senha = $mysqli->real_escape_string($_POST['senha']);

       $sql_code = "SELECT * FROM users WHERE email = '$email' AND senha = '$senha'";
       $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

       $quantidade = $sql_query->num_rows;

       if($quantidade == 1) {
           
           $usuario = $sql_query->fetch_assoc();

           if(!isset($_SESSION)) {
               session_start();
           }

           $_SESSION['nome'] = $usuario['nome'];

           header("Location: homepage.php");

       } else {
           echo '<div class="error">Falha ao logar! E-mail ou senha incorretos</div>';
       }

   }

}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/css/global.css">
    <link rel="stylesheet" href="../static/css/homepage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <title>Capa Dura</title>
</head>
<body>
    <div class="login_container">

        <img src="../static/assets/feedyourideas.png" alt="Image">

            <div class="login_card">
                <form action="" method="POST">
                    
                    <div class="labels">
                        <label>E-mail</label>
                        <input type="text" name="email" placeholder="Digite o e-mail">
                    </div>

                    <div class="labels">
                        <label>Senha</label>
                        <input type="password" name="senha" placeholder="Digite a senha">
                    </div>
                <div class="session_buttons">
                  <button class="btn" type="submit">Entrar</button>

                  <a href="#">Cadastre-se</a>
                  </div>
                </form>
            </div>

    </div>
</body>
</html>