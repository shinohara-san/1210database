<?php
// var_dump($_GET);
// exit();
// 関数ファイルの読み込み
include('functions.php');

// GETデータ取得
$user_id = $_GET['user_id'];
$product_id = $_GET['product_id'];

//DB接続
$pdo = connectToDb();

// いいね状態のチェック
$sql = 'SELECT COUNT(*) FROM like_table1210 WHERE user_id=:a1 AND product_id=:a2';

// エラーでない場合，取得した件数を変数に入れる
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $user_id, PDO::PARAM_INT);
$stmt->bindValue(':a2', $product_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
  showSqlErrorMsg($stmt);
} else {
  $like_count = $stmt->fetch();
  //  var_dump($like_count[0]); 
  //  exit();
  // データの件数を確認しよう！
}

// いいねするSQLを作成
// いいねしていれば削除，していなければ追加のSQLを作成
if ($like_count[0] != 0) {
  $sql = 'DELETE FROM like_table1210 WHERE user_id=:a1 AND product_id=:a2';
} else {
  $sql = 'INSERT INTO like_table1210(id, user_id, product_id, created_at)
 VALUES(NULL, :a1, :a2, sysdate())'; // 1行で記述！
}
// INSERTのSQLは前項で使用したものと同じ！
// 以降（SQL実行部分と一覧画面への移動）は変更なし！

// SQL実行
$stmt = $pdo->prepare($sql);
// バインド変数は共通で使う otherwise you gotta write more
$stmt->bindValue(':a1', $user_id, PDO::PARAM_INT);
$stmt->bindValue(':a2', $product_id, PDO::PARAM_INT);
$status = $stmt->execute();

//データ登録処理後
if ($status == false) {
  showSqlErrorMsg($stmt);
} else {
  header('Location: detail.php?id='. $product_id);
 
}
