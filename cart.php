<?php
session_start();
require 'connect.php';

$action = isset($_GET['a']) ? $_GET['a'] : "";
$itemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
if (isset($_SESSION['qty']))
{
    $meQty = 0;
    foreach ($_SESSION['qty'] as $meItem)
    {
        $meQty = $meQty + $meItem;
    }
} else
{
    $meQty = 0;
}
if (isset($_SESSION['cart']) and $itemCount > 0)
{
    $itemIds = "";
    foreach ($_SESSION['cart'] as $itemId)
    {
        $itemIds = $itemIds . $itemId . ",";
    }
    $inputItems = rtrim($itemIds, ",");
    $meSql = "SELECT * FROM products WHERE id in ({$inputItems})";
    $meQuery = mysqli_query($meConnect,$meSql);
    $meCount = mysqli_num_rows($meQuery);
} else
{
    $meCount = 0;
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

<div class="cart">
	<div class="cart-top">
		<h5 style="text-align: center;padding-top: 25px;color: #ea3035;">ตระกร้าสินค้า</h5>
	</div>
	
	<div class="cart-bt" style="height: auto;">
	<?php
           
            if ($meCount == 0)
            {
                echo "<div class=\"cart-pay\">ไม่มีสินค้าอยู่ในตะกร้า</div>";
            } else
            {
                ?>
	<form action="updatecart.php" method="post" name="fromupdate">
			<div class="order-head">
		<div class="order-head-detail">รูปภาพ</div>
		<div class="order-head-detail">รายการ</div>
		<div class="order-head-detail">ราคา</div>
		<div class="order-head-detail">จำนวน</div>
		<div class="order-head-detail">ราคารวม</div>
		<div class="order-head-detail">ลบ</div>
	</div>
					<?php
                            $total_price = 0;
                            $num = 0;
                            while ($meResult = mysqli_fetch_assoc($meQuery))
                            {
                                $key = array_search($meResult['id'], $_SESSION['cart']);
                                $total_price = $total_price + ($meResult['product_price'] * $_SESSION['qty'][$key]);
                                ?>
	<div class="order-detail">
	
		<div class="order-datail-list"><img src="img/<?php echo $meResult['product_img_name']; ?>" style="width: 50%;"></div>
		<div class="order-datail-list"><?php echo $meResult['product_name']; ?></div>
		<div class="order-datail-list"><?php echo number_format($meResult['product_price'],2); ?></div>
		<div class="order-datail-list"><input type="text" name="qty[<?php echo $num; ?>]" value="<?php echo $_SESSION['qty'][$key]; ?>" class="form-control" style="width: 60px;text-align: center;">
                                        <input type="hidden" name="arr_key_<?php echo $num; ?>" value="<?php echo $key; ?>"></div>
		<div class="order-datail-list"><?php echo number_format(($meResult['product_price'] * $_SESSION['qty'][$key]),2); ?></div>
		<div class="order-datail-list"><a href="removecart.php?itemId=<?php echo $meResult['id']; ?>" role="button"><img src="img/del.png"></a></div>
				
	</div>
	<?php
                                $num++;
                            }
                            ?>	
		
        <div class="result">
		<h6 style="text-align: right;padding-top: 5px;color:#ea3035;"><br>รวมทั้งสิ้น:&nbsp<?php echo number_format($total_price,2);?>  บาท</h6>
		<a class="btn-cart" a href="order.php" style="float: right;">สั่งซื้อเลย</a>
		<button type="submit" class="btn-cart" style="float: right;width: 14%;font-size: 15px;
    font-family: kanit;padding: 6px 20px;">คำนวณราคาใหม่</button>
    </div>
		</form>
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