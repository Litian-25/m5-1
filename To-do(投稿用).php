<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-doリスト</title>
</head>
<body>
    <span style="font-size: 50px;">To-doリスト</span>
    
    <form action="" method="post" enctype="multipart/form-data">
      <div class="todo">
         To-doを追加する：
         <input type="text" name="text" >

         いつまでに：<!--締切日を指定-->
         <input type="date" name="deadline" >
         <input type="submit" name="ad_submit" value="追加する">
      </div>
      
        <div>
         お気に入りの画像を登録：<!--画像アップロード-->
         <input type="hidden" name="name" value="value">
         <input type="file" name="image" size=30>
         <input type="submit" name="fi_submit" value="追加する">
        </div> 
      
      <div class="delete">
          削除：<input type="number" name="delete">
          <input type="submit" name="del_submit" value="削除">
      </div>

        <div class="search">
         検索：<input type="text" name="word" placeholder="検索したいキーワードとか">
               <input type="submit" name="se_submit" value="検索">
        </div>
    </form>
    
    <!--画像の処理-->
    <?php
    if(!empty($_FILES)){
        $updir = "xxxxxxxxxxxxxxxxx/";
        $filename = $_FILES['image']['name'];
        if(move_uploaded_file($_FILES['image']['tmp_name'], $updir.$filename)==FALSE){
            print("Upload failed");
            print($_FILES['image']['error']);
        }else{
            print("<b> $filename </b> uploaded")."<br>";
            ?>
          <img src="<?php print($updir.$filename);?>" width="150px" alt="">
          
          <?php
        }
    }
    ?>
     
     <br>
     
     <?php
    
    //db接続
        $dsn = 'mysql:dbname=xxxxxxx;host=xxxxxxxxx';
        $user = 'xxxxxxxxxxxxxx';
        $password = 'xxxxxxxxxxxx';
        $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    
        if(isset($_POST["ad_submit"])){
            if(isset($_POST["text"], $_POST["deadline"]) and $_POST["text"] != "" and $_POST["deadline"]){
            //追加のsql文
                $sql = $pdo -> prepare("INSERT INTO Todo(text, register_day, deadline_day) VALUES(:text, :register_day, :deadline_day)");
                $sql -> bindParam(':text', $text, PDO::PARAM_STR);
                $sql -> bindParam(':register_day', $reg_day, PDO::PARAM_STR);
                $sql -> bindParam(':deadline_day', $deadline, PDO::PARAM_STR);
                
                $text = $_POST["text"];
                $reg_day = date('Y/m/d H:i:s');
                $deadline = $_POST["deadline"];//指定した締切日をpost受信
                
                $sql -> execute();
           } 
        }
        
        
        //削除の命令があったら
        if(isset($_POST["del_submit"])){
            if(isset($_POST["delete"])){
              if($_POST["delete"] != ""){
    
                $id = $_POST["delete"];
                $sql = 'SELECT * FROM Todo';
                $stmt = $pdo->query($sql);
                $results = $stmt->fetchAll();
                foreach($results as $row){
                  
          //データ受け取り、DELETE文実行        
                if($row['id'] == $id ){
                  $sql = 'delete from Todo where id=:id';
                  $stmt = $pdo->prepare($sql);
                  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                  $stmt->execute();
                
                  echo $id."を削除しました！"."<br>"."<br>";
                }
                }
              }
            }
        }

        //表示
        
           if(!isset($_POST["se_submit"])){
               
                  $sql = "SELECT * FROM Todo";
                  $stmt = $pdo->query($sql);
                  $results = $stmt->fetchAll();
                  foreach($results as $row){
                     echo htmlspecialchars($row['id'].',　');
                     echo htmlspecialchars($row['text'].',　');
                     echo htmlspecialchars($row['deadline_day'].'までに！').'<br>';
                     
                  echo "<hr>";
                  }
               }
           
          
        
       
        //キーワード検索したい（post受信をワイルドカードで探索、表示？）
         if(isset($_POST["se_submit"]) && !isset($_POST["ad_submit"])){
            if(isset($_POST["word"]) && $_POST["word"] != ""){
                $word = $_POST["word"];
                
                $sql = "SELECT * FROM Todo WHERE text LIKE '%".$word."%'";
                $stmt = $pdo->query($sql);
                $stmt->bindParam(':text', $word, PDO::PARAM_STR);
                $stmt->execute();
                $results = $stmt->fetchAll();
                foreach($results as $row){
                    echo htmlspecialchars($row['id'].',　');
                    echo htmlspecialchars($row['text'].',　');
                    echo htmlspecialchars($row['deadline_day'].'までに！').'<br>';
                    
                echo "<hr>";
                }
            }
         }
        
    ?>      
    
    
        
</body>
</html>