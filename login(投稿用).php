<!DOCTYPE html>
 <html lang="ja">
     <head>
         <meta charset="UTF-8">
         <title>ログイン</title>
     </head>
     <body>
        <div class="login">
          <h1>ログイン</h1>
     
            <form method="post" action="login-check.php">
              <div class="form-email">
                <label for="email">メールアドレス</label>
                     <input type="email" name="email" required="required" placeholder="メールアドレス">
              </div>  
              <div class="form-password">
                <label for="password01">パスワード</label>
                     <input type="password" name="password" required="required" placeholder="パスワード">
              </div> 
              <div class="button-panel">
                  <input type="submit" name="login" value="ログイン">
              </div>
              
              <div class="new-account">
                    <p><a href="kari-touroku.php">新規登録</a></p>
                </div>
            </form>
         </div>   
         
     
     </body>
 </html>