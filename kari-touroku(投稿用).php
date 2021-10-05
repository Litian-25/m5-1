
<!DOCTYPE html>
 <html lang="ja">
     <head>
         <meta charset="UTF-8">
         <title>アカウント登録</title>
     </head>
     <body>
         <span style="font-size: 50px; color: lime;">
             アカウント登録をしてください</span>
             
            <form action="kari-touroku-check.php" method="post">
                <div class="form-name">
                     <label for="name">ニックネーム</label>
                     <input type="text" name="name" required="required" placeholder="ニックネーム">
                </div>
                
                <div class="form-sex">
                    <label>性別　</label>
                      <label for="male">
                        <input type="radio" id="male" name="sex" value="男性" required>男性
                      </label>
                      <label for="female">
                        <input type="radio" id="female" name="sex" value="女性">女性
                      </label>
                      <label for="other">
                        <input type="radio" id="other" name="sex" value="その他">その他
                      </label>
                </div>
                
                <div class="form-birthday">
                    <label>生年月日</label>
                    <select name="year" required>
                        <option value="" selected>--</option>
                        <?php foreach(range(1930,2021) as $year): ?>
                        <option value="<?= $year ?>"> <?= $year."年" ?> </option>
                        <?php endforeach; ?>
                    </select>
                    <select name="month" required>
                        <option value="" selected>--</option>
                        <?php foreach(range(1,12) as $month): ?>
                        <option value="<?= str_pad($month, 2, 0, STR_PAD_LEFT)?>"> <?= $month."月" ?> </option>
                        <?php endforeach; ?>
                    </select>
                    <select name="day" required>
                        <option value="" selected>--</option>
                        <?php foreach(range(1,31) as $day): ?>
                        <option value="<?= str_pad($day, 2, 0, STR_PAD_LEFT)?>"> <?= $day."日" ?> </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-email">
                    <label for="email">メールアドレス
                       <input type="email" name="email" placeholder="メールアドレス" required="required">
                    </label>   
                </div>
                
                <div class="form-pw1">
                    <label for="password01">パスワード
                       <input type="password" name="password01" placeholder="パスワード" required="required">
                   </label> 
                </div>
                
                <div class="button-panel">
                    <input type="submit" name="btn" title="登録" value="登録">
                </div>
                
                <div class="form-footer">
                    <p><a href="login.php">戻る</a></p><!--login.phpはまだ作成途中-->
                </div>
            </form>
           
     </body>
</html>