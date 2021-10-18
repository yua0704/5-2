<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_5-1</title>
</head>
<body>
    <?php
    $dsn = 'データベース名';
    $user = 'ユーザーネーム';
    $password = 'パスワード';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    
    $sql = "CREATE TABLE IF NOT EXISTS bt"
    ." ("
    . "id INT AUTO_INCREMENT PRIMARY KEY,"
    . "name char(32),"
    . "comment TEXT,"
    . "dateA DATETIME,"
    . "password TEXT"
    .");";
    $stmt = $pdo->query($sql);
    ?>
    
        <?php
        
     if(!empty($_POST["name"])&&!empty($_POST["comment"])&&empty($_POST["hidden"])&&!empty($_POST["password1"])){
    $sql = $pdo -> prepare("INSERT INTO bt (name, comment, dateA, password) VALUES (:name, :comment, :dateA, :password)");
    $sql -> bindParam(':name', $name, PDO::PARAM_STR);
    $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
    $sql -> bindParam(':dateA', $dateA, PDO::PARAM_STR);
    $sql -> bindParam(':password', $password, PDO::PARAM_STR);
    $name = $_POST["name"];
    $comment = $_POST["comment"]; //好きな名前、好きな言葉は自分で決めること
    $dateA = date("Y-m-d H:i:s");
    $password = $_POST["password1"];
    $sql -> execute();
    }

    // 削除対象番号を受信受信した削除対象番号を変数に代入
    if(!empty($_POST["delete"])&&!empty($_POST["password2"])){
         $delete = $_POST["delete"];
    // ファイルを開く
    $id = $delete;
    $password = $_POST["password2"];
    $sql = 'delete from bt where id=:id AND password=:password';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':password', $password, PDO::PARAM_INT);
    $stmt->execute();
    
    }
    
?>
<?php 
    if(!empty($_POST["rewrite"])&&!empty($_POST["password3"])){
    $str = $_POST["rewrite"];
     
    $id = $str;//変更する投稿番号
    $password = $_POST["password3"];
    $sql = 'SELECT*FROM bt WHERE id=:id AND password=:password';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':password', $password, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll();
        foreach($result as $row){
            $number = $row["id"];
            $commment = $row["comment"];
            $namee = $row["name"];
            
        }
    }
        
        
    if(!empty($_POST["hidden"])){
        $hidden = $_POST["rewrite"];
        $id = $_POST["hidden"];
        $comment = $_POST["comment"];
        $name = $_POST["name"];
        $password = $_POST["password1"];
        $sql = 'UPDATE bt SET name=:name,comment=:comment WHERE id=:id AND password=:password';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':password', $password, PDO::PARAM_INT);
    $stmt->execute();
       /* $nameee =  $_POST["name"];
        $commmment = $_POST["comment"];
        $date = date("Y/m/d H:i:s");
        $password1 = $_POST["password1"];
        if(file_exists($filename)){
                $lines = file($filename,FILE_IGNORE_NEW_LINES);
                $fp = fopen($filename, 'w');
               foreach($lines as $line){
                  $pieces = explode("<>", $line);
                  $num = $pieces[0];
                  if($pieces[0]==($_POST["hidden"])&&($pieces[4] == $_POST["password1"])){
                fwrite($fp, $num . '<>' . $nameee . '<>' . $commmment . '<>' . $date . '<>' . $password1 . '<>' .PHP_EOL);
                  }
                  else{ 
                      fwrite($fp, $line.PHP_EOL);
                      
                    
                    
        
               //if(!empty($_POST["hidden"]))//
                   
               //if(file_exists($filename))//
                //foreach($lines as $line)//
                  }
                   
               }
            
        }*/
                  
    }
    
?>

<form action="" method="post">
        <input type="text" name="name" placeholder="名前" value=<?php echo @$namee; ?>><br><br>
        <input type="text" name="comment" placeholder="コメント"value=<?php echo @$commment;
        ?>>
         <input type="text" name="password1" placeholder="パスワード">
         <input type="submit" name="submit"><br><br>
        <input type="hidden" name="hidden" value=<?php echo @$number;
        
        ?>><br><br>
        <input type="text" name="rewrite" placeholder="編集対象番号">
        <input type="text" name="password3" placeholder="パスワード">
        <input type="submit" name="submit"><br><br>
        <input type="number" name ="delete" placeholder="削除対象番号">
        <input type="text" name="password2" placeholder="パスワード">
        <input type="submit" name="submit"><br><br>
    </form>
    
    <?php
      $sql = 'SELECT * FROM bt';
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll();
    foreach ($results as $row){
        //$rowの中にはテーブルのカラム名が入る
        echo $row['id'].',';
        echo $row['name'].',';
        echo $row['comment'].',';
        echo $row['dateA'].'<br>';
    echo "<hr>";
    }
    
        ?>
</body>
    
    