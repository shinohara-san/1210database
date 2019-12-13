<?php
include('functions.php');
$pdo = connectToDb();

$sql = 'DELETE FROM product WHERE product_id = :product_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':product_id', $_GET['id'], PDO::PARAM_INT);
$stmt->execute();
unset($pdo);
header('Location: index.php');
exit();
