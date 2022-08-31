<?php

 $dsn='データベース名';
 $user="ユーザー名";
 $password="パスワード";
 $pdo=new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
$sql = "CREATE TABLE IF NOT EXISTS tbtest4"
    ." ("
    . "id INT AUTO_INCREMENT PRIMARY KEY,"
    . "name char(32),"
    . "comment TEXT,"
    . "date char(32),"
    . "pass char(32)"
    .");";
    $stmt = $pdo->query($sql);
    
echo "適当に何か記入して削除編集など試してください！何か不具合がありましたら教えてください！"."<br>";
    error_reporting(0);
     $n=$_POST["n"];
     $str =$_POST["str"];
     $date=date ( "Y年m月d日 H時i分s秒" );
     $select=$_POST["select"];
     $pass =$_POST["pass"];

        if(!empty("delete")){
             $delpass =$_POST["delpass"];
             $delete=$_POST["delete"];
             $sql = 'SELECT * FROM tbtest4';
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll();
         foreach($results as $row){
      if($row['id']==$delete && $row['pass']==$delpass){ 
    $id =$_POST["delete"];
    $sql = 'delete from tbtest4 where id=:id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
      }}}



     
         if(!empty("edit")&&!empty("editpass")){
                 $editpass =$_POST["editpass"];
                 $edit=$_POST["edit"];
             $sql = 'SELECT * FROM tbtest4';
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll();
  
  foreach($results as $row){
      if($row['id']==$edit && $row['pass']==$editpass){
          $newname=$row['name'];
          $newcoment=$row['comment'];
          $newpass=$row['pass'];
       
      }
  }
         }
 
         if(!empty($select)&&!empty($n)&&!empty($str)) {
              $id=$_POST["select"];
              $sql = 'update tbtest4 set name=:name,comment=:comment,pass=:pass, date=:date where id=:id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
    $stmt->bindParam(':name', $n, PDO::PARAM_STR);
    $stmt->bindParam(':comment', $str, PDO::PARAM_STR);
    $stmt->bindParam(':date', $date, PDO::PARAM_STR);
    $stmt->execute();
         }
     
		if(empty($select)&&!empty($n)&&!empty($str)) {
		    $sql = $pdo -> prepare("INSERT INTO tbtest4  (name, comment, pass, date) VALUES (:name, :comment, :pass, :date)");
    $sql -> bindParam(':name', $n, PDO::PARAM_STR);
    $sql -> bindParam(':comment', $str, PDO::PARAM_STR);
    $sql->bindParam(':pass', $pass, PDO::PARAM_STR);
     $sql->bindParam(':date', $date, PDO::PARAM_STR);
     $sql->execute();
         }
         
     
     $sql = 'SELECT * FROM tbtest4';
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll();
    
     foreach($results as $row){
         echo $row['id'].',';
             echo $row['name'].',';
                 echo $row['comment'].',';
                     echo $row['date']."<br>";
    echo "<hr>";
     }
    
		
     ?>
     <html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>keijiban</title>
        </head>
    <body>
     <form action="" method="post">
     <input type="txst" name="n" placeholder="名前" value="<?php echo $newname;?>">
     <input type="txst" name="str" placeholder="コメント" value="<?php echo $newcoment;?>">
     <input type="password" name="pass" placeholder="パスワードを入力してください" value="<?php echo $newpass;?>">
    <input type="submit" name="submit"><br>
    <input type="number" name="delete" placeholder="削除対象番号を入力してください">
    <input type="password" name="delpass" placeholder="パスワードを入力してください">
        <input type="submit" name="remove" value="削除"><br>
        <input type="number" name="edit" placeholder="編集対象番号を入力してください">
        <input type="password" name="editpass" placeholder="パスワードを入力してください">
        <input type="submit" name="editing" value="編集"><br>
         <input type="hidden" name="select" value="<?php echo $edit;?>">
        </form>
</body>
</html>