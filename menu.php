<?php
session_start();
require 'connect.php';

$meSql = "SELECT * FROM products ";
$meQuery = mysqli_query($meConnect,$meSql);

$action = isset($_GET['a']) ? $_GET['a'] : "";
$itemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
if(isset($_SESSION['qty'])){
    $meQty = 0;
    foreach($_SESSION['qty'] as $meItem){
        $meQty = $meQty + $meItem;
    }
}else{
    $meQty=0;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>ตวง ติ่มซำ - รายการอาหาร</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
</head>
<body>
<div class="navigation">
	<ul>
		  <li><a href="index.php"><img src="img/logo.png"></a></li>
		  <li style="float:right; padding-top: 10px;padding-left: 20px;">
		  	<a href="cart.php">
		  		<img src="img/shop2.png">(<?php echo $meQty; ?>)
		  	</a>
		  </li>
		  <li style="float:right">
		  	<a href="#about">
		  		<div class="btn">สมัครสมาชิก</div>
		  	</a>
		  </li>
		  <li style="float:right; padding-top: 10px;">
		  	<a href="#about">
		  		เข้าสู่ระบบ
		  	</a>
		  </li>
	</ul>
</div>

<div class="menu-all">
	<div class="menu-hit-detail-top">
		<h5 style="text-align: center;padding-top: 25px;color: #ea3035;">5 เมนูยอดฮิต</h5>
		<h6 style="text-align: center;padding-top: 5px;color: #828282;">เมนูติมซำอร่อยยอดฮิตจากร้านตวงติ่มซำ</h4>
	</div>
	<div class="menu-hit-detail-bt">
	<?php
        while ($meResult = mysqli_fetch_assoc($meQuery))
            {
                ?>
		<div class="menu-hit-name">
			<div class="menu-pic">
				<img src="img/<?php echo $meResult['product_img_name']; ?>" style="width: 100%;">
			</div>
			<div class="menu-detail">
				<div class="menu-detail-left"><?php echo $meResult['product_name']; ?><br><?php echo number_format($meResult['product_price'],2); ?>
				</div>
				<a class="menu-detail-right" href="updatecart.php?itemId=<?php echo $meResult['id']; ?>" role="button">
					<img src="img/shop.png">
				</a>
			</div>
		</div>
 <?php
                    }
                    ?>

	</div>
</div>

<div class="footer">
	<div class="footer-detail-top">
		<h5 style="text-align: center;padding-top: 25px;color: #fff;">ติดต่อเรา</h5>
		<h6 style="text-align: center;padding-top: 5px;color: #dcdcdc;">สามารถมารับประทานเมนูตวงติ่มซำที่ร้านได้เลยครับ</h4>
	</div>
	<div class="footer-detail-bt">
		<div class="grid">
			<div class="cell is-first">
				<img src="img/logo-w.png" style="    width: 83%;">
			</div>
			<div class="cell is-sec">
				<h2 style="color:#fff;">ติดต่อเรา</h2>
				<p style="color:#fff;     margin-top: 15px;">ถนนเจริญกรุง ใกล้ปากซอยเจริญกรุง 77/1 </p>
				<p style="color:#fff;">แขวงวัดพระยาไกร เขตบางคอแหลม กทม. 10120</p>
				<p style="color:#fff;">Support@taungdimsum.com | LINE: Taungdimsum</p>
			</div>
			<div class="cell is-third">
				<br>
				<i style="color:#fff; font-size:18px;" class="fa">&nbsp;&nbsp;</i>
				<i style="color:#fff; font-size:18px;" class="fa">&nbsp;&nbsp;</i>
				<i style="color:#fff; font-size:18px;" class="fa">&nbsp;&nbsp;</i>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<?php
mysqli_close($meConnect);
?>