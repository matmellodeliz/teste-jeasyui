<?php

session_start();

$email = $_REQUEST['email'];
$senha = $_REQUEST['senha'];
include 'conn.php';
$sql = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";
$query = mysqli_query($conn, $sql);
  if (mysqli_num_rows($query) != 1) {
      // Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
      echo "Login inválido!"; exit;
  } else {
      // Salva os dados encontados na variável $resultado
      $resultado = mysqli_fetch_assoc($query);
      $_SESSION['id_nivel_permissao'] = $resultado['id_nivel_permissao'];
      header("location: index.php");
  }
//echo json_encode($resultado);
?>