<?php
	session_start();
	include("config.php");
	$in = "'".implode(',',$_SESSION['cart'])."'";
	$sql = "SELECT * FROM `books` WHERE `book_isbn` IN ($in)";
	$query = $db->query($sql);
	$query_run = mysqli_query($db, $sql);
	$row = $query->fetch_assoc();
$username = $_SESSION['login_user'];
$login_query = "SELECT * FROM `customers` WHERE username='$username'";
$login_query_run = mysqli_query($db,$login_query);
$_SESSION['qty_array'] = array_fill(0, count($_SESSION['cart']), 1);
$customerdata = mysqli_fetch_array($login_query_run);
$pesel = $customerdata['pesel'];

$grand_total = number_format($_SESSION['grand_total'], 2);
$mysqltime = date ('Y-m-d H:i:s');

		

			$query1="INSERT INTO orders(pesel,grand_total,created) VALUES('$pesel', '$grand_total', '$mysqltime')";
			$insert_query1 = mysqli_query($db,$query1);
			if($insert_query1){
				$quantity = $_SESSION['index'];
				$price = $row['book_price'];
				$order_id = mysqli_insert_id($db);
				foreach($_SESSION['cart'] as $items){

				$prod_id = $row['book_isbn'];
				$prod_qty = $quantity;
				$insert_items_query = "INSERT INTO order_items (order_id, book_id, quantity, price) 
				VALUES ('$order_id', '$prod_id', '$prod_qty', '$price')";
				$insert_items_query_run = mysqli_query($db, $insert_items_query);
				}
				unset($_SESSION['cart']);
				$_SESSION['message'] = "Order placed successfully";
				header('Location: index.php');
				die();
			}else{
				header('Location: index.php');
			}
		
?>