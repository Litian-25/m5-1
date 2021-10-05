<?php
    session_start();
    
    //パラメーターの取得
    
    //メアド・パスワード受け取り、DBに登録してあるかチェック
            if(isset($_POST["email"], $_POST["password"])){
                if($_POST["email"] != "" && $_POST["password"] != ""){
                    $email = $_POST["email"];
                    $password = $_POST["password"];
                    
                //DB接続
                    $dsn = 'mysql:dbname=xxxxxxxxx;host=xxxxxxxxxxxxxxx';
                    $user = 'xxxxxxxxxxxxxx';
                    $pw = 'xxxxxxxxxxxxxxxxxx';
                    $pdo = new PDO($dsn, $user, $pw, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
                    
                //SELECTしてデータ探索
                    $sql = 'SELECT * FROM account_info WHERE email=:email AND password=:password';
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
                    $stmt->execute();
                    $results = $stmt->fetch();
                   
                        if(isset($results['email'], $results['password'])){
                            //DBのユーザー情報をセッションに保存
                            $_SESSION['id'] = $results['id'];
                            $_SESSION['name'] = $results['id'];
                            $msg = 'ログインしました。';
                            $link = '<a href="To-do.php">ホーム</a>';
                        
                            
                        } else {
                            $msg = 'メールアドレスもしくはパスワードが間違っています。';
                            $link = '<a href="login.php">戻る</a>';
                        }
                    }
                    
                }
    ?>
    
    <h1><?php echo $msg; ?></h1>
        <?php echo $link; ?>
    