<?php
include('functions.php');
$id = $_GET['id'];
$pdo = connectToDb();

//データ登録SQL作成，指定したidのみ表示する
$sql = 'SELECT * FROM product WHERE product_id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//データ表示
if ($status == false) {
  // エラーのとき
  showSqlErrorMsg($stmt);
} else {
  // エラーでないとき
  $rs = $stmt->fetch();
  // fetch()で1レコードを取得して$rsに入れる
  // $rsは配列で返ってくる．$rs["id"], $rs["task"]などで値をとれる
  // var_dump()で見てみよう
}
// var_dump($rs);
// exit();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="css/main.css">
  <title>商品</title>
</head>

<body>
  <div class="flex_column">
    <div class="flex title_wrapper">
      <h1>商品編集</h1>
      <a href="index.php" class="link_to_products"><i class="far fa-hand-pointer"></i>一覧へ戻る</a>
    </div>
    <form action="update.php" method="POST" style="width: 100%;">
      <div class="product" style="text-align: left;">
        <div class="product_title" style="margin-bottom: 25px;">
          <input type="text" name="product_name" value="<?= $rs['product_name'] ?>">
        </div>
        <div>
          <img class="product_img" name="product_pic" src=product.php?id=<?= $rs['product_id']; ?> alt="商品画像">
        </div>
        <div class="product_price" style="margin-bottom: 25px;">
          <input type="text" name="product_price" value="<?= $rs['product_price'] ?>">
          円
        </div>
        <div class="product_description">
          <textarea name="product_description" style="width: 100%; height:150px;"><?= $rs['product_description'] ?></textarea>
        </div>
        <input type="hidden" name="product_id" value="<?= $rs['product_id'] ?>">
        <div class="flex">
          <button class="delete" style="margin-right: 5px; background:blue;"><a style="color:white; text-decoration:none;" href="delete.php?id=<?= $rs['product_id'] ?>">削除</a></button>
          <button type="submit" class="save">保存</button>
        </div>
        <hr>

      </div>

    </form>
</body>

</html>