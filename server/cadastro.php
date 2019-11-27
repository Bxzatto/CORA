<?php

include 'database.php';

$nome = isset($_POST['nome']) ? $_POST['nome'] : null;
$login = isset($_POST['login']) ? $_POST['login'] : null;
$senha = isset($_POST['senha']) ? $_POST['senha'] : null;


if (empty($nome) || empty($login) || empty($senha))
{
    echo "Volte e preencha todos os campos";
    exit;
}
$passwordHash = make_hash($senha);

$sql = "SELECT nome FROM usuario WHERE usuario = :usuario";
$stmt = $PDO->prepare($sql);

$stmt->bindParam(':usuario', $login);

$stmt-> execute();

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
if (count($users) > 0)
{
    echo "Usuário ja existente";
    exit;
}

$sql = "INSERT INTO usuario(nome, usuario, senha) VALUES(:nome, :login, :senha)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':login', $login);
$stmt->bindParam(':senha', $passwordHash);

if ($stmt->execute())
{
    header('Location: ../index.html');
}
else
{
    echo "Erro ao cadastrar";
    print_r($stmt->errorInfo());
}