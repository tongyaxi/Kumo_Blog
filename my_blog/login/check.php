<?php
include('../db/MySQLDB.php');
include('./login.html');

$userid = $_POST['userid'];
$password = $_POST['password'];

if($userid && $password){

    $result = $conn->query(
        "SELECT * FROM users WHERE userID ='{$userid}'");
    $r = $result->fetch(); 
}



$conn = null; 
if( $r != null && $r['password'] == $password ):
    
    session_start();
    $_SESSION['id'] = $r['id'];
    $_SESSION['name'] = $r['name'];
    $_SESSION['searchArticles'] = "1";
    header("Location:../blog/blog.php");
else:
    echo '<script type="text/javascript">';
    echo '$(document).ready(function(){';
    echo "$('#div_info').text('ご入力内容に間違いがあります。');
          $('#modal_info').modal('show');";
    echo '})';
    echo '</script>';
endif;
?>