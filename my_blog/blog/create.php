<?php
include('../db/MySQLDB.php');

if( ! isset($_SESSION['id']) ) {
    header("Location: ../login/login.html");
    exit(0);
}

$name = isset($_SESSION['name']) ? $_SESSION['name'] : 'ゲスト';

$subject = isset($_POST['subject']) ? $_POST['subject'] : '';
$body = isset($_POST['body']) ? $_POST['body'] : '';
$author = $_SESSION['id'];
if($subject && $body){

    $statement = $conn->prepare("INSERT INTO articles
         VALUES (NULL , :subject, :body, :author, NOW() )");
    if($statement->execute(array(":subject" => $subject,":body" => $body,":author" => $author))) {
        $result = $statement->rowCount();
    }
}
?>

<!DOCTYPE html>
<html class="ax-vertical-centered">
<head>
	<meta charset="UTF-8">
	<title>Kumo Blog</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <script src="../js/bootstrap.min.js"></script>
    <script src="../jQuery/jquery-3.1.1.min.js"></script>
    <script src="../js/bootstrap-dropdown.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/public.css">
    <link rel="stylesheet" href="../css/create.css">
</head>

<body>
    <div class="head_line"></div>

    <div class="container" id="main">
	
		<div id="header"></div>

		<div class="row c_center">
			
			<div class="col-md-3" id="left_content">

				<div id="title">
                    <a href="./blog.php"><h2>Kumo Blog</h2></a>
					<h5 class="text-muted">在日勤務3年間のITプログラマー</h5>
                    <span id="commoncss"><?php echo($name); ?>さんログイン中</span><br/>
                    <?php
                        if(isset($_SESSION['id'])) {
                            echo '<p><a href="../login/logout.php" id="commoncss">ログアウト</a></p>';
                        } else {
                            echo '<p><a href="../login/login.html" id="commoncss">ログイン</a></p>';
                        }
                    ?>		
				</div>

				<div class="c_center" id="person_info">
					<img src="../img/github.jpg" height="130" width="130"  class="img-circle">
					<h4 class="text-muted">
						<a target="_blank" href="https://github.com/tongyaxi/Kumo_Blog.git">GitHub BY TONGYAXI.</a>
					</h4>
				</div>
				<br/>
                <br/>
                <br/>
                <br/>
			</div>
			
			<div class="col-md-2" id="center_content"></div>
			<br />
			<br />
			<div  class="col-md-7 " id="right_Content">
                        
                    <div class="list-group">							
                        <a href="#" class="list-group-item active">記事作成</a>
                        <div  class="list-group-item">									
                            <form action="./create.php" method="POST">
                                <div class="info" >
                                    <span class="help">表題</span>
                                    <input type="text" class="form-control" name="subject" >
	   		                        <div class="editormd" id="mdView">                
                                       <textarea placeholder="記事を入力してください。" name="body" style="width:550px;"></textarea>
                                    </div>
                                    <br/>
                                    <?php
                                        if(isset($result)){
                                            if($result == 1) {
                                                $id = $conn->lastInsertId();
                                                echo "<a href='read.php?id={$id}'>追加しました。詳細へ</a><br/>";
                                            }
                                    }?>
                                    <input class="btn btn-default" type="submit"  value="送信"/>
                                </div> 
                            </form>
                        </div>
                    </div>

            </div>   
		</div>	

		<div class="foot_line"></div>
		
	</div>
    <div class="r_div">
		<a href="#"><input  class="btn btn-default" value="TOP" style="width:50%;"/></a>    
	</div>
    
</body>
</html>