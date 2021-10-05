<!DOCTYPE html>
    <html lang="ja">
        <head>
            <meta charset="UTF-8">
            <title>mission05-1</title>
        </head>
        <style>
    body{
        margin: 0;
    }
 
     .background {
        width: 100%;
        height: 100vh;
        position: relative;
        background-image: url("Uyuni-enkoo.jpg");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }
 
     .filter {
        width: 100%;
        height: 100%;
        color: lime;
        position: fixed;
        overflow-y: scroll;
    }
    </style>
    <body>
     <div class="background">
       <div class="filter">
        <h1 style="color: magenta;" align="center">オススメの曲教えてください！</h1>
      <form action="" method="post">
        <div>
       【投稿】
       <label for="name">名前</label>
       <input type="text" name="name" placeholder="名前">
       
       <label for="comment">　コメント</label>
       <input type="text" name="comment" placeholder="コメント">
       
       <label for="password">　パスワード</label>
       <input type="text" name="password01" placeholder="パスワード">
       
       <label class="btn-container">
       <input type="submit" name="btn btn-mid" value="送信"> 
        </div>
      </form>
      <form action="" method="post">
            <div>
            【削除】 
            <label for="delete">削除</label>
             <input type="number" name="delete" placeholder="削除番号の指定">
             
            <label for="password">　パスワード</label>
             <input type="text" name="password02" placeholder="パスワード">
             
             <input type="submit" name="submit" value="削除">
            </div>
        </form>
        <form action="" method="post">
            <div>
            【編集】   
            <label for="edit">編集</label>
             <input type="text" name="edit" placeholder="編集番号の指定">
             
            <label for="password">　パスワード</label>
             <input type="text" name="password03" placeholder="パスワード">
             
             <input type="submit" name="submit" value="編集">
            </div> 
        </form>
        <br>
      <?php
    //データベースの接続
        $dsn = 'データベース名！';
        $user = 'ユーザー名！';
        $password='パスワード名！！';
        $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
      
      //テーブル'Keijiban'の作成 （時刻を設定していない！）     
        $sql = "CREATE TABLE IF NOT EXISTS Keijiban3"
        ."("
        ."id INT AUTO_INCREMENT PRIMARY KEY,"
        ."name char(32),"
        ."comment TEXT,"
        ."password TEXT,"
        ."time char(32)"
        .");";
        $stmt = $pdo -> query($sql);
     
      //データの入力があったら
        if(isset($_POST["name"], $_POST["comment"], $_POST["password01"])){
            if($_POST["name"] != "" && $_POST["comment"] != "" && $_POST["password01"] != ""){

          //テーブルにデータを追加   
              $sql = $pdo -> prepare("INSERT INTO Keijiban3 (name, comment, password, time) 
              VALUES (:name, :comment, :password, :time)");
              $sql -> bindParam(':name', $name, PDO::PARAM_STR);
              $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
              $sql -> bindParam(':password', $password, PDO::PARAM_STR);
              $sql -> bindParam(':time', $date, PDO::PARAM_STR);
              
              $name = $_POST["name"];
              $comment = $_POST["comment"];
              $password = $_POST["password01"];
              $date = date('Y/m/d H:i:s');

              $sql -> execute();
              
              echo "投稿しました！"."<br>"."<br>";
            }
        }
        
      //入力があった場合（編集投稿）
          if(isset($_POST["editnumber"])){
              if(isset($_POST["editname"], $_POST["editcomment"], $_POST["password04"])){
                  
                    $id = $_POST["editnumber"];
                    $name = $_POST["editname"];
                    $comment = $_POST["editcomment"];
                    $password = $_POST["password04"];
                    $date = date('Y/m/d H:i:s');
                    
                    $sql = 'UPDATE Keijiban3 SET name=:name,comment=:comment,password=:password,time=:time 
                    WHERE id=:id';
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                    $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
                    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
                    $stmt->bindParam(':time', $date, PDO::PARAM_STR);
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    
                    $stmt->execute();
                          
                    echo $id."を編集しました！"."<br>"."<br>";
                  }
              }
        
      //削除の命令があったら
        if(isset($_POST["delete"], $_POST["password02"])){
              if($_POST["delete"] != "" && $_POST["password02"] != ""){
                  
        //selectとforeachでidとパスワード逐次探索しとく？
                $id = $_POST["delete"];
                $password = $_POST["password02"];
                $sql = 'SELECT * FROM Keijiban3';
                $stmt = $pdo->query($sql);
                $results = $stmt->fetchAll();
                foreach($results as $row){
                  
          //データ受け取り、DELETE文実行        
                if($row['id'] == $id && $row['password'] == $password ){
                  $sql = 'delete from Keijiban3 where id=:id';
                  $stmt = $pdo->prepare($sql);
                  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                  $stmt->execute();
                
                  echo $id."を削除しました！"."<br>"."<br>";
              }else if($row['id'] == $id && $row['password'] != $password){
                  echo $id."のパスワードが違います"."<br>"."<br>";
              }
                }
              }
        }
          
      //編集の命令があったら
        if(isset($_POST["edit"], $_POST["password03"])){
              if($_POST["edit"] != "" && $_POST["password03"] != ""){
                 
                      
          //データ受け取り、selectとforeachで番号とパスワードの一致を探す
              $id = $_POST["edit"];
              $password = $_POST["password03"];
              $sql = 'SELECT * FROM Keijiban2';
              $stmt = $pdo->query($sql);
              $results = $stmt->fetchAll();
              foreach($results as $row){
           
                   if($row['id'] == $id && $row['password'] == $password){
                ?>
                        <form action="" method="post">
                          <span style="color: darkblue; background-color: aquamarine">
                              【内容編集用のフォーム】</span>
                              
                            <input type="hidden" name="editnumber" placeholder="編集する予定の番号"
                            value="<?= $row['id'] ?>">
                            　
                            <input type="text" name="editname" placeholder="名前" 
                            value="<?= $row['name'] ?>">
                            　
                            <input type="text" name="editcomment" placeholder="コメント"
                            value="<?= $row['comment'] ?>">
                            　
                            <input type="text" name="password04" placeholder="パスワード" 
                            value="<?= $row['password'] ?>">
                            
                            <input type="submit" name="submit" value="送信">
                            <br>
                            <br>
                        </form>
                        <?php
                   }else if($row['id'] == $id && $row['password'] != $password){
                            echo $id."のパスワードが違います"."<br>"."<br>";
              }
              }
        }
        }
        
        
      //表示する
        $sql = 'SELECT * FROM Keijiban3';
        $stmt = $pdo -> query($sql);
        $results = $stmt -> fetchAll();
        foreach($results as $row){
            echo htmlspecialchars($row['id'].', ');
            echo htmlspecialchars($row['name'].', ');
            echo htmlspecialchars($row['time']).'<br>';
            echo htmlspecialchars($row['comment']).'<br>';
        echo "<hr>";
        }
        
        ?>
        </div>
       </div>
    </body>
</html>
