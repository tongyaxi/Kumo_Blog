<?php
include('../db/MySQLDB.php');

$name = isset($_SESSION['name']) ? $_SESSION['name'] : 'ゲスト';
$id = isset($_GET['id']) ? $_GET['id'] : '';
if($id){
    if(isset($_SESSION['id']) ) {
        $author = $_SESSION['id'];
        
        $statement = $conn->prepare("SELECT * FROM articles
             WHERE author=:author AND id=:id");
        $statement->execute(array(":id" => $id,":author" => $author));
        $r = $statement->fetch();
    } else {
        header("Location: ../login/login.html");
        exit(0);
    }
} else {
    $id       = isset($_POST['id'])       ? $_POST['id']      : '';
    $subject  = isset($_POST['subject'])  ? $_POST['subject'] : '';
    $body     = isset($_POST['body'])     ? $_POST['body']    : '';
    $author   = isset($_SESSION['id'])    ? $_SESSION['id']   : '';
    if($id && $subject && $body && $author){
        
        $statement = $conn->prepare("UPDATE articles SET
            subject=:subject, body=:body
                WHERE id=:id AND author=:author; ");
        $result = 0;
        if($statement->execute(array(
            ":id"=>$id, ":subject"=>$subject, ":body"=>$body, ":author"=>$author
        ))) {
            $result = $statement->rowCount();
        }
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
                        <a href="#" class="list-group-item active">記事更新</a>
                        <div  class="list-group-item">									
                            <form action="./update.php" method="POST">
                                <div class="info" >
                                    <?php if(isset($r['id']) ): ?>
                                    <input type="hidden" name="id" value="<?php echo $r['id']; ?>">
                                    <span class="help">表題</span>
                                    <input type="text" class="form-control" name="subject" value="<?php echo $r['subject']; ?>">
	   		                        <div class="editormd" id="mdView">                
                                       <textarea name="body" style="width:550px;"><?php echo $r['body']; ?></textarea>
                                    </div>
                                    <br/>
                                    <input class="btn btn-default" type="submit"  value="送信"/>
                                    <?php endif; ?>

                                    <?php
                                        if(isset($result)){
                                            if($result == 1) {
                                                echo "<a href='read.php?id={$id}'>更新しました。詳細へ</a><br/>";
                                            }
                                    }?>
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