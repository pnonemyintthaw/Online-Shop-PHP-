<?php 
require('db_connect.php');

$name=$_POST['name'];
$price=$_POST['price'];
$discount=$_POST['discount'];
$description=$_POST['description'];
$brand=$_POST['brand'];
$subcategory=$_POST['subcategory'];

// var_dump($name);
// var_dump($photo);

$photo=$_FILES['photo'];
$source_dir ='images/items/';

$filename = mt_rand(100000, 999999);
$file_exe_array=explode(".", $photo['name']);
// var_dump($file_exe_array);
$file_exe=$file_exe_array[1];
// var_dump($file_exe);
// die();

$fullpath=$source_dir.$filename.".".$file_exe;
move_uploaded_file($photo['tmp_name'], $fullpath);


$sql="INSERT INTO items (name,photo,price,discount,brand_id,subcategory_id) VALUES(:value1, :value2, :value3, :value4, :value5, :value6)";
$stmt=$conn->prepare($sql);
$stmt->bindParam(':value1',$name);
$stmt->bindParam(':value2',$fullpath);
$stmt->bindParam(':value3',$price); 	
$stmt->bindParam(':value4',$discount);
$stmt->bindParam(':value5',$brand);
$stmt->bindParam(':value6',$subcategory);
$stmt->execute();
header("location:item_list.php");


 



 ?>