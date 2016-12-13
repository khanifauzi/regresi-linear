<?php
  session_start();
  if(isset($_POST['manual'])) {
    $_SESSION['arrX'] = array();
    $_SESSION['arrY'] = array();
    $_SESSION['field1'] = $_POST['field1'];
    $_SESSION['field2'] = $_POST['field2'];
    $_SESSION['arrX']   = $_POST['input1'];
    $_SESSION['arrY']   = $_POST['input2'];
  }
  header('Location: regresi.php');
?>
