<?php
// var_dump($_POST);
// exit();
$customer_name = $_POST['customer_name'];
$customer_email = $_POST['customer_email'];
$howtopay = $_POST['howtopay'];
$product_name = $_POST['product_name'];
$howmanyitems = $_POST['howmanyitems'];
$total_price = $_POST['total_price'];

// echo $customer_name;
// echo $customer_email;
// echo $howtopay;
// echo $product_name;
// echo $howmanyitems;
// echo $total_price;
// exit();
$str = $customer_name . ',' . $customer_email . ',' . $howtopay . ',' . $product_name . ',' . $howmanyitems . ',' . $total_price;
// echo $str;
// exit();
$file = fopen('data/data.csv', 'a');
flock($file, LOCK_EX);
fwrite($file, $str . "\n");
flock($file, LOCK_UN);
fclose($file);
?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/main.css">
  <title>thankyou</title>
</head>

<body>
  <div style="text-align:center; position:relative; top:150px;">
    <div>ありがとうございました。</div>
    <div style="margin-top:20px;"><a href="index.php">一覧へ戻る</a></div>
  </div>

</body>

</html>