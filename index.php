<?php
include('functions.php');
$pdo = connectToDb();

$sql = 'SELECT * FROM product ORDER BY created_at DESC';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll();

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
      <h1>商品一覧</h1>
      <a href="registration.php" class="link_to_products"><i class="far fa-hand-pointer"></i> 商品登録</a>
    </div>

    <div class="product">
      <?php
      if (!$products) {
        echo "No Items Available...";
      }
      ?>
      <?php for ($i = 0; $i < count($products); $i++) : ?>
        <div class="product_title"><?= $products[$i]['product_name'] ?></div>
        <div><img class="product_img" src=product.php?id=<?= $products[$i]['product_id']; ?> alt="商品画像"></div>
        <!-- <div class="product_price"><?= $products[$i]['product_price'] ?>円</div> -->
        <!-- <div class="product_description"><?= $products[$i]['product_description'] ?></div> -->
        <div class="flex">
          <!-- <button class="edit"><a style="color:white; text-decoration:none;" href="edit.php?id=<?= $products[$i]['product_id']; ?>">編集</a></button> -->
          <button><a href="detail.php?id=<?= $products[$i]['product_id']; ?>" style="color:white; text-decoration:none;">詳細</a></button>
        </div>
        <hr>
      <?php endfor; ?>
    </div>

</body>

</html>