<?php
session_start();
$formid = isset($_REQUEST['formid']) ? $_REQUEST['formid'] : "";
if ($formid != $_POST['formid']) {
	echo "E00001!! SESSION ERROR RETRY AGAINT.";
} else {
	unset($_REQUEST['formid']);
	if ($_POST) {
		require 'connect.php';
		$order_fullname = mysqli_real_escape_string($meConnect,$_POST['order_fullname']);
		$order_address = mysqli_real_escape_string($meConnect,$_POST['order_address']);
		$order_phone = mysqli_real_escape_string($meConnect,$_POST['order_phone']);

		$meSql = "INSERT INTO orders (order_date, order_fullname, order_address, order_phone) VALUES (NOW(),'{$order_fullname}','{$order_address}','{$order_phone}') ";
		$meQeury = mysqli_query($meConnect,$meSql);


		if ($meQeury) {
			$order_id = mysqli_insert_id($meConnect);
			for ($i = 0; $i < count($_POST['qty']); $i++) {
				$order_detail_quantity = mysqli_real_escape_string($meConnect,$_POST['qty'][$i]);
				$order_detail_price = mysqli_real_escape_string($meConnect,$_POST['product_price'][$i]);
				$product_id = mysqli_real_escape_string($meConnect,$_POST['product_id'][$i]);
				$lineSql = "INSERT INTO order_details (order_detail_quantity, order_detail_price, product_id, order_id) ";
				$lineSql .= "VALUES (";
				$lineSql .= "'{$order_detail_quantity}',";
				$lineSql .= "'{$order_detail_price}',";
				$lineSql .= "'{$product_id}',";
				$lineSql .= "'{$order_id}'";
				$lineSql .= ") ";
				
				mysqli_query($meConnect,$lineSql);
			}
			mysqli_close();
			unset($_SESSION['cart']);
			unset($_SESSION['qty']);
			header('location:menu.php?a=order');
		}else{
			mysqli_close();
			header('location:menu.php?a=orderfail');
		}
	}
}
