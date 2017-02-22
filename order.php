<?php
session_start();
require 'connect.php';

$action = isset($_GET['a']) ? $_GET['a'] : "";
$itemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
$_SESSION['formid'] = sha1('' . microtime());
if (isset($_SESSION['qty'])) {
	$meQty = 0;
	foreach ($_SESSION['qty'] as $meItem) {
		$meQty = $meQty + $meItem;
	}
} else {
	$meQty = 0;
}
if (isset($_SESSION['cart']) and $itemCount > 0) {
	$itemIds = "";
	foreach ($_SESSION['cart'] as $itemId) {
		$itemIds = $itemIds . $itemId . ",";
	}
	$inputItems = rtrim($itemIds, ",");
	$meSql = "SELECT * FROM products WHERE id in ({$inputItems})";
	$meQuery = mysqli_query($meConnect,$meSql);
	$meCount = mysqli_num_rows($meQuery);
} else {
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
<script type="text/javascript">
    function updateSubmit(){
        if(document.formupdate.order_fullname.value == ""){
            alert('โปรดใส่ชื่อนามสกุล');
            document.formupdate.order_fullname.focus();
            return false;
        }
            if(document.formupdate.order_address.value == ""){
            alert('โปรดใส่ที่อยู่');
            document.formupdate.order_address.focus();
            return false;
        }
            if(document.formupdate.order_phone.value == ""){
            alert('โปรดใส่หมายเลขโทรศัพท์');
            document.formupdate.order_phone.focus();
            return false;
        }
        document.formupdate.submit();
        return false;
    }
</script>
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
		<h5 style="text-align: center;padding-top: 25px;color: #ea3035;">ที่อยู่การจัดส่ง</h5>
	</div>
	<form action="updateorder.php" method="post" name="formupdate" role="form" id="formupdate" onsubmit="JavaScript:return updateSubmit();">
	<div class="cart-bt">	
		<div class="cart-bt-left">	
		<div class="cart-bt-left-d">
            <div class="left-d">ชื่อ-นามสกุล</div>
            <input type="text" id="order_fullname" name="order_fullname" class="bottom-w3" style="border: none; color: #666" placeholder="ชื่อ-นามสกุล">
        </div>
        <div class="cart-bt-left-d">
            <div class="left-d">ที่อยู่</div>
            <input type="text" id="order_address" name="order_address" class="bottom-w3" style="border: none; color: #666" placeholder="ที่อยู่">
        </div>
        <div class="cart-bt-left-d">
            <div class="left-d">หมายเลขโทรศัพท์</div>
            <input type="text" name="order_phone" iid="order_phone" name="order_phone" class="bottom-w3" style="border: none; color: #666" placeholder="หมายเลขโทรศัพท์">
        </div>

        </div>
        <div class="cart-bt-right">
        <div class="cart-bt-left-d">
            <div class="cart-m"> <?php
                       {
                ?>
                <div class="left-d">รายละเอียดสินค้า</div>
                <?php
                            $total_price = 0;
                            $num = 0;
                            while ($meResult = mysqli_fetch_assoc($meQuery))
                            {
                                $key = array_search($meResult['id'], $_SESSION['cart']);
                                $total_price = $total_price + ($meResult['product_price'] * $_SESSION['qty'][$key]);
                                ?>
                    <div class="cart-pay">
                    
                            <div class="cart-pay-d">
                                <h6 style="color: #828282;"><?php echo $meResult['product_name'];?></h6>
                            </div>
                            <div class="cart-pay-d">
                                <h6 style="color: #828282;"><?php echo $_SESSION['qty'][$key]; ?>
                                    	<input type="hidden" name="qty[]" value="<?php echo $_SESSION['qty'][$key]; ?>" />
                                    	<input type="hidden" name="product_id[]" value="<?php echo $meResult['id']; ?>" />
                                    	<input  type="hidden" name="product_price[]" value="<?php echo $meResult['product_price']; ?>" /></h6>
                            </div>
                            <div class="cart-pay-d">
                                <h6 style="color: #828282;"><?php echo number_format($meResult['product_price'], 2); ?></h6>
                            </div>
                            <div class="cart-pay-d">
                                <h6 style="color: #828282;"><?php echo number_format(($meResult['product_price'] * $_SESSION['qty'][$key]), 2); ?></h6>
                            </div>
                           
                    </div>
 <?php
                                $num++;
                                }
                            ?>
            </div>
            <div class="cart-m">
                <div class="left-d">รวมทั้งสิ้น</div>
                    <div class="cart-pay">
                            <div class="cart-pay-d">
                                <h6 style="color: #828282;"><?php echo number_format($total_price, 2); ?> บาท</h6>
                            </div>
                    </div>
                    
            </div>
            <button type="submit" class="btn-cart" style="float: right;width: 29%;font-size: 15px;
    font-family: kanit;padding: 6px 20px;">สั่งซื้อเลย</button>
			<div class="btn-order" style="float: right;">ย้อนกลับ</div>

               
        </div></form>
                <?php
                }
            ?>
        </div>
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