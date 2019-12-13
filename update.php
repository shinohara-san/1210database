<?php
include('functions.php');

// var_dump($_POST);
// var_dump($_FILES);
// exit();
// 入力チェック
if (
  !isset($_POST['product_name']) || $_POST['product_name'] == '' ||
  !isset($_POST['product_price']) || $_POST['product_price'] == '' ||
  // !isset($_FILES['product_pic']) || $_FILES["product_pic"] == '' ||
  !isset($_POST['product_description']) || $_POST['product_description'] == ''
) {
  exit('ParamError');
}

//DB接続
$pdo = connectToDb();

//POSTデータ取得
$id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$product_description = $_POST['product_description'];

//データ登録SQL作成
$sql = 'UPDATE product SET product_name=:a1, product_price=:a3, product_description=:a4 WHERE product_id=:id';
// :と;を間違えるな
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $product_name, PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
// $stmt->bindValue(':a2', $product_pic, PDO::PARAM_STR);   //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a3', $product_price, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a4', $product_description, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
$status = $stmt->execute();




//4．データ登録処理後
if ($status == false) {
  showSqlErrorMsg($stmt);
} else {
  header('Location: index.php');
  exit;
}
