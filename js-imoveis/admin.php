<?php

session_start();
ob_start();

require_once ".././back/conn/conn.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
// var_dump($dados);

// $pass = password_hash("123", PASSWORD_DEFAULT);
// var_dump($pass);

if (!empty($dados['btnLogar'])) {

    if (empty($dados['email'])) {
        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Necessário preencher o campo usuário</div>";
        // $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'> Necessário preencher o campo usuário!</div>"];
    } elseif (empty($dados['senha'])) {
        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Necessário preencher o campo senha!</div>";
        // $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'> </div>"];
    } else {
        $usr = "SELECT id, nome, email, senha, nivel_acesso FROM usuarios WHERE email=:email LIMIT 1";
        $query_user = $conn->prepare($usr);
        $query_user->bindParam(":email", $dados['email'], PDO::PARAM_STR);
        // $query_user->bindParam(":senha", $dados['senha']);
        $query_user->execute();
        // $res = $query_user->fetch(PDO::FETCH_ASSOC);


        if (($query_user) and ($query_user->rowCount() != 0)) {
            $res = $query_user->fetch(PDO::FETCH_ASSOC);
            // var_dump($res);

            if (password_verify($dados['senha'], $res['senha'])) {
                $_SESSION['id'] = $res['id'];
                $_SESSION['nome'] = $res['nome'];
                $_SESSION['nivel'] = $res['nivel_acesso'];
                $retorna = ["msg" => false, "dados" => $res];
                $_SESSION['msg'] = "<div style='margin-bottom:1rem; width: 100%; background-color:#D1E7DD; color: #0a3622; padding: 1rem; border: 1px solid #a3cfbb; border-radius:8px;'>Logado com Sucesso!</div>";
                header("Location: ../back/admin/index.php ");
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Login ou Senha Inválidas!</div>";
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Login ou Senha Inválidas!</div>";
        }
    }   // var_dump($retorna);
}
// echo json_encode($retorna);






?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/js-imoveis/fonts/icomoon/style.css" />
    <!-- <link rel="stylesheet" href="../.././js-imoveis/fonts/flaticon/font/flaticon.css" /> -->
    <link rel="stylesheet" href="/css/adm-style.css" />
    <title>login</title>
</head>

<body style="background-color: var(--bs-gray-200);">
    <div style="height: 100vh;" class="container w-25 flex-column d-flex justify-content-center align-items-center">

        <form action="" class="row row-cols-1 g-1 border p-3 bg-body" method="post">
            <div>
                <?php
                if (isset($_SESSION['msg'])) {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
                ?>
            </div>
            <div>
                <h1>Login</h1>
            </div>
            <div class="col-12">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="inputEmail4">
            </div>
            <div class="col-12">
                <label for="inputPassword4" class="form-label">Password</label>
                <input type="password" name="senha" class="form-control" id="inputPassword4">
            </div>

            <div class="mt-2">
                <input type="submit" class="col-12 btn btn-lg btn-primary" name="btnLogar" value="Logar">
            </div>
        </form>
    </div>


</body>

</html>