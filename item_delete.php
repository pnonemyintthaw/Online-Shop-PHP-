<?php 

require('db_connect.php');

$id=$_POST['id'];
// var_dump($id);

$sql="DELETE FROM items where id=:value1";
$stmt=$conn->prepare($sql);

$stmt->bindParam(':value1', $id);
$stmt->execute();

header('location:item_list.php');

?>