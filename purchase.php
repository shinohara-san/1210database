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
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/main.css">
  <title>Purchase</title>
</head>

<body>
  <header>
    <h1>購入画面</h1>
  </header>
  <form action="thankyou.php" method="POST" style="width:45%">
    <div>名前</div>
    <div><input type="text" style="width: 70%;" name="customer_name" required></div>
    <div>Email</div>
    <div><input type="email" style="width: 100%;" name="customer_email" required></div>
    <div>支払い方法</div>
    <label><input name="howtopay" type="radio" value="クレジットカード" checked>クレジットカード</label>
    <label><input name="howtopay" type="radio" value="LinePay">Line Pay</label>
    <label><input name="howtopay" type="radio" value="Paypay">Paypay</label>
    <div>商品名</div>
    <div><input style="background:aliceblue" value="<?= $rs['product_name'] ?>" name="product_name" readonly></div>
    <!-- <div><?= $rs['product_name'] ?></div>
    <input type="hidden" name="product_name" value="<?= $rs['product_name'] ?>"> -->
    <!-- htmlspecialchars($_POST["name"]) -->
    <!-- divやtextareaのときはtextで中身とれる(inputはval) -->
    <!-- <div><img src="" alt=""></div> -->
    <!-- vue.js -->
    <div id="counter">
      <div>
        <input id="jsNum" type="number" value=1 name="howmanyitems">
        個</div>
      <div><input id="jsPrice" readonly value="<?= $rs['product_price'] ?>">円</div>
      <!-- <div><?= $rs['product_price'] ?>円</div> -->

      <hr>
      <!-- <div>税込み<input class="sample_input" id="total_price" value="" readonly>円</div> -->
      <div>税込み<input name="total_price" class="sample_input" id="total_price" value="<?= $rs['product_price'] * 1.1 ?>" readonly>円</div>
    </div>
    <div style="text-align: center;"><button>購入</button></div>
  </form>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script>
    $(function() {
      var $rs;
      var value = "<?= $rs['product_price'] ?>"; // 単品価格
      // console.log(value);
      var maxNum = 100; // 注文できる個数の上限
      var tagInput = $('#jsNum'); // 入力対象のinputタグID名
      var tagOutput = $('#jsPrice'); // 出力対象のinputタグID名
      tagInput.on('change', function() {
        var str = $(this).val();
        var num = Number(str.replace(/[^0-9]/g, '')); // 整数以外の文字列を削除 input type="number"は文字列→number()で数値化
        if (num == 0) {
          num = '';
        } else if (num > maxNum) { // 上限を超える個数を入力した場合
          num = maxNum;
        }
        $(this).val(num);
        if (num != 0) {
          var price = num * value;
          tagOutput.val(price);
        }
      });
      // console.log(tagOutput[0].value);
      tagInput.on('change', function() {
        $('#total_price').val(Math.floor(tagOutput[0].value * 1.1));
      });
    });
  </script>
</body>

</html>