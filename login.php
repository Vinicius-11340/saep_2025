<?php
require "bd.php";
session_start();

if (isset($_SESSION['email'])) {
    header("location:turma.php");
    exit;
}

$erro = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        $email = trim($_POST["email"]) ?? "";
        $senha = trim($_POST["senha"]) ?? "";

        $stmt = $conexao->prepare("SELECT * FROM professor WHERE email_professor = ? AND senha_professor = ?");
        $stmt->bind_param("ss", $email, $senha);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $_dados = $resultado->fetch_assoc();
            $_SESSION['email'] = $_dados['email_professor'];
            $_SESSION['nome'] = $_dados['nome_professor'];
            header("location:turma.php");
            exit;
        } else {
            $erro = "Email ou senha incorretos.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="PT-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>


<body>
    <h2>Login - SAEP</h2>
    <form METHOD="POST">
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Senha:</label>
        <input type="password" name="senha" required>
        <button type="submit" name="login">Entrar</button>
        <?php
        if ($erro) {
            echo "<div>$erro</div>";
        }
        ?>
    </form>
</body>

</html>