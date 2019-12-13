<?php
include('functions.php');
$pdo = connectToDb();

$sql = 'SELECT * FROM product WHERE product_id = :product_id LIMIT 1';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':product_id', $_GET['id'], PDO::PARAM_INT);
$stmt->execute();
$product = $stmt->fetch();

echo $product['product_pic'];

?>