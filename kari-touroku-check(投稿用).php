<!DOCTYPE html>
<html lang="ja">
     <head>
         <meta charset="UTF-8">
         <title>登録完了</title>
     </head>
     <body>
         <span style="font-size: 50px; color: lime;">
             アカウント登録完了</span>
             
             <br>
             
            
            <?php
                if(isset($_POST["name"], $_POST["sex"], $_POST["year"], $_POST["month"], $_POST["day"],
                $_POST["email"], $_POST["password01"])){
                    $year = $_POST["year"];
                    $month = $_POST["month"];
                    $day = $_POST["day"];
                    
                    
              //DB接続
                  $dsn = 'mysql:dbname=xxxxxxxx;host=xxxxxxxxxxxxx';
                  $user = 'xxxxxxxxxx';
                  $password = 'xxxxxxxx';
                  $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
           
              //追加のsql文
                  $sql = $pdo->prepare("INSERT INTO account_info (name, sex, birthday, email, password, touroku_day) 
                VALUES(:name, :sex, :birthday, :email, :password, :touroku_day)");
                
                //bindParamエリア
                  $sql -> bindParam(':name', $name, PDO::PARAM_STR);
                  $sql -> bindParam(':sex', $sex, PDO::PARAM_STR);
                  $sql -> bindParam(':birthday', $birthday, PDO::PARAM_STR);
                  $sql -> bindParam(':email', $email, PDO::PARAM_STR);
                  $sql -> bindParam(':password', $pw1, PDO::PARAM_STR);
                  $sql -> bindParam(':touroku_day', $trk_day, PDO::PARAM_STR);
                
                  $name = $_POST["name"];
                  $sex = $_POST["sex"];  
                  $birthday = $year."年".$month."月".$day."日";
                  $email = $_POST["email"];
                  $pw1 = $_POST["password01"];
                  $trk_day = date('Y/m/d H:i:s');
                  
                  $sql -> execute();
                  
                
                //←エラーが出る
                    
                }
            
            echo "登録が完了いたしました！これからよろしくお願いします。"."<br>".
            "引き続き利用する場合は以下からログインしてください。↓↓";
              ?>
              
            <div class="login-go">
              <p><a href="login.php">ログインする</a></p>
            </div>
     </body>
 </html>