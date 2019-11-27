<?php
include "database.php";

$login = isset($_POST['login']) ? $_POST['login'] : null;
$password = isset($_POST['senha']) ? $_POST['senha'] : null;

if (empty($login) || empty($password))
{
    echo "Informe email e senha";
    exit;
}

$passwordHash = make_hash($password);

$sql = "SELECT id, nome, adm FROM usuario WHERE usuario = :usuario AND senha = :senha";
$stmt = $PDO->prepare($sql);

$stmt->bindParam(':usuario', $login);
$stmt->bindParam(':senha', $passwordHash);

$stmt-> execute();

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
if (count($users) <= 0)
{
    echo "Usuário ou senha incorretos";
    exit;
}

$user = $users[0];
 
session_start();
$_SESSION['logged_in'] = true;
$_SESSION['user_id'] = $user['id'];
$_SESSION['user_name'] = $user['nome'];
$_SESSION['user_adm'] = $user['adm'];

if ($_SESSION['user_adm']) {
    header('Location: ../admin.html');
}else{
header('Location: ../app.html');
}