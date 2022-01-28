<?php
include('../db/MySQLDB.php');

$name = isset($_SESSION['name']) ? $_SESSION['name'] : 'ゲスト';
$key = isset($_POST['key']) ? $_POST['key'] : '';
$flg = false;
$result = null;
$statement = null;

if(isset($key)){
    
    $statement = $conn->prepare("SELECT * FROM articles WHERE subject LIKE :key");
    $statement->execute(array(":key" => "%{$key}%"));
    $flg = true;
}
if(!$flg && (isset($_SESSION['searchArticles']) || isset($_GET['searchArticles']))) {
    $result = $conn->query("SELECT * FROM articles");
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
    <link rel="stylesheet" href="../css/blog.css">
    <link rel="stylesheet" href="../css/public.css">
</head>

<body>
    <div class="head_line"></div>

    <div class="container" id="main">
	
		<div id="header"></div>

		<div class="row c_center">
			
			<div class="col-md-3" id="left_content">

				<div id="title">
					<h2>Kumo Blog</h2>
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

                <a href="./create.php">
                <span class="glyphicon glyphicon-plus" id="common2">&nbsp;&nbsp;記事作成&nbsp;&nbsp;</span>
                </a>
                <br/><br/><br/>

				<form action="./blog.php" method="POST">
					<div class="input-group">
                        <input type="text" class="form-control" placeholder="表題で検索" aria-describedby="basic-addon2" style="width:170px;" name="key" value="<?php echo($key)?>">
  					    <input class="btn btn-default" type="submit"  value="検索" style="color:#337ab7"/>
				    </div>
				</form>
	
			</div>
			
			<div class="col-md-2" id="center_content">		
			</div>
			<br />
			<br />
			<div  class="col-md-7 " id="right_Content">
            <?php if($result){?>
                <?php foreach($result as $r) {?>
                        
                    <div class="list-group">							
                        <a href="#" class="list-group-item active">記事一覧</a>
                        <div  class="list-group-item">									
                            <h4>
                                <a href="read.php?id=<?php echo($r['id']); ?>"><?php echo($r['subject']); ?></a>
                            </h4>
                            <br/>
                            <span><?php echo($r['modified']); ?>&nbsp;&nbsp;|</span>
                            <span>訪問数: 5</span>
                            <br/><br/>					
                            <span><?php echo($r['body']); ?></span>
                            <br/><br/><br/>	
                            <a href="read.php?id=<?php echo($r['id']); ?>">もっと見る</a>
                            <br/>			
                        </div>
                    </div>
			            
                <?php }?>
                <?php $sessionFlg = null;$getFlg = null;$result = null; ?>
            <?php }else if($statement){?>

                <?php foreach($statement as $r) {?>
                        
                        <div class="list-group">							
                            <a href="#" class="list-group-item active">記事一覧</a>
                            <div  class="list-group-item">									
                                <h4><a href="read.php?id=<?php echo($r['id']); ?>"><?php echo($r['subject']); ?></a></h4>
                                <br/>
                                <span><?php echo($r['modified']); ?>&nbsp;&nbsp;|</span>
                                <span>訪問数: 5</span>
                                <br/><br/>					
                                <span><?php echo($r['body']); ?></span>
                                <br/><br/><br/>	
                                <a href="read.php?id=<?php echo($r['id']); ?>">もっと見る</a>
                                <br/>			
                            </div>
                        </div>
                            
                    <?php }?>

            <?php }else{?>
                    <div class="list-group">							
                        <a href="#" class="list-group-item active">記事一覧</a>
                        <div  class="list-group-item">データがありません。</div>
                    </div>

            <?php }?>
            </div>   
		</div>	

		<div class="foot_line"></div>
		
	</div>
    <div class="r_div">
		<a href="#"><input  class="btn btn-default" value="TOP" style="width:50%;"/></a>    
	</div>
    
</body>
</html>