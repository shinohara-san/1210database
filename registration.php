<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="css/main.css">
  <title>ESサイト</title>
</head>

<body>
  <div class="flex_column">
    <div class="flex title_wrapper">
      <h1>商品登録</h1>
      <a href="index.php" class="link_to_products"><i class="far fa-hand-pointer"></i> 商品一覧</a>
    </div>
    <form action="insert.php" method="POST" enctype="multipart/form-data" style="position:relative">

      <div>商品名</div>
      <div><input type="text" name="product_name" style="width:325px"></div>
      <div>商品の写真</div>
      <input id="upfile" type="file" name="product_pic" accept=”image/*”> <img id="thumbnail" style="width:325px; height:325px" src="http://nari-sho.com/s/noimg.gif" alt="">
      <div>価格</div>
      <div><input type="text" name="product_price" style="width:70%;"> 円</div>
      <div>説明</div>
      <textarea type="text" name="product_description" style="width:100%"></textarea>
      <button style="position: absolute;
    left: 10px;
    left: 90px;">登録</button>
  </div>
  </form>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script>
    $('#upfile').change(function() {
      if (this.files.length > 0) {
        // 選択されたファイル情報を取得
        var file = this.files[0];

        // readerのresultプロパティに、データURLとしてエンコードされたファイルデータを格納
        var reader = new FileReader();
        reader.readAsDataURL(file);

        reader.onload = function() {
          $('#thumbnail').attr('src', reader.result);
        }
      }
    });
  </script>
</body>

</html>