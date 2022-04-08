<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        try {
            $conexao = new PDO('mysql:host=127.0.0.1;dbname=sql_injection', 'root', '');
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $sql = 'SELECT email, senha FROM usuarios WHERE email="'.$email.'" AND senha="'.$senha.'"';

            $consulta = $conexao->query($sql);

            $mensagem = $consulta->fetch()
                ? 'Usuário autenticado.'
                : 'Credenciais inválidas.';
        } catch (PDOException $exception) {
            $mensagem = 'Erro interno no banco de dados.';
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL Injection</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row my-5">
            <div class="col-12 d-flex flex-column align-items-center">
                <h3 class="text-center mb-3">Administração</h3>
                <div class="card w-100" style="max-width: 20rem;">
                    <div class="card-body">
                        <form action="index.php" method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="text" name="email" id="email" value="<?php echo isset($email) ? $email : ''; ?>" class="form-control" autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="text" name="senha" id="senha" value="<?php echo isset($senha) ? $senha : ''; ?>" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 bg-dark" style="--bs-bg-opacity: .1;">
                <samp>
                    <br>
                    DEBUG %>
                    <br><br>
                    <?php
                        if (isset($sql, $mensagem)) {
                            echo 'consulta: <code>'.$sql.';</code><br><br>';
                        }

                        if (isset($mensagem)) {
                            echo 'mensagem: '.$mensagem.'<br><br>';
                        }
                    ?>
                </samp>
            </div>
        </div>
    </div>
</body>
</html>
