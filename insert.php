<?php
include('functions.php');
// var_dump($_POST);
// var_dump($_FILES);
// exit();
// 入力チェック
if (
  !isset($_POST['product_name']) || $_POST['product_name'] == '' ||
  !isset($_POST['product_price']) || $_POST['product_price'] == '' ||
  !isset($_FILES['product_pic']) || $_FILES["product_pic"]== '' ||
  !isset($_POST['product_description']) || $_POST['product_description'] == ''
) {
  exit('ParamError');
}

//DB接続
$pdo = connectToDb();

//POSTデータ取得
$product_name = $_POST['product_name'];
$product_pic = file_get_contents($_FILES["product_pic"]["tmp_name"]);
$product_price = $_POST['product_price'];
$product_description = $_POST['product_description'];

// echo $product_price;
// exit();


//データ登録SQL作成
$sql = 'INSERT INTO product(product_id, product_name, product_pic, product_price, product_description, created_at)
VALUES(NULL, :a1, :a2, :a3, :a4, sysdate())';
// :と;を間違えるな
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $product_name, PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a2', $product_pic, PDO::PARAM_STR);   //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a3', $product_price, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a4', $product_description, PDO::PARAM_STR);
$status = $stmt->execute();

//データ登録処理後
if ($status == false) {
  showSqlErrorMsg($stmt);
} else {
  //index.phpへリダイレクト
  header('Location: index.php');
}