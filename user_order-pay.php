<?php
$active = 'Account';
include('header.php');
if (!isset($_SESSION['user_email'])) {
    echo "<script>window.open('checkout.php','_self')</script>";
}
?>
<div class="main">
    <div class="shop">
        <div class="shop__container">
            <ul class="shop__breadcroumb">
                <li><a href="index.php">Trang Chủ</a></li>
                <li>Tài khoản</li>
            </ul>
            <?php
            include('user_sidebar.php')
            ?>
            <div class="user__content">
                <div class="user__title">
                    Xác nhận thanh toán
                </div>
                <?php
                if (isset($_GET['order_id'])) {
                    $order_id = $_GET['order_id'];
                }
                ?>
                <form action="user_order-pay.php?update_id=<?php echo $order_id; ?>" method="post" class="user__form">
                    <label>
                        Hóa đơn
                    </label>
                    <input type="text" required name="receipt" placeholder="Nhập số mã hóa đơn">
                    <label>
                        Số tiền đã gửi
                    </label>
                    <input type="text" required name="money" placeholder="Nhập số tiền đã gửi">
                    <label>
                        Phương thức thanh toán
                    </label>
                    <select name="mode">
                        <option> BIDV</option>
                    </select>
                    <label>
                        Mã giao dịch
                    </label>
                    <input type="text" required name="code" placeholder="Nhập mã giao dịch">
                    <label>
                        Ngày giao dịch
                    </label>
                    <input type="date" required name="date" placeholder="Nhập ngày giao dịch">

                    <button class="button" name="submit" type="submit">Xác nhận thanh toán</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include('footer.php');
?>
<?php

if (isset($_POST['submit'])) {
    $update_id = $_GET['update_id'];
    $receipt = $_POST['receipt'];
    $money = $_POST['money'];
    $mode = $_POST['mode'];
    $code = $_POST['code'];
    $date = $_POST['date'];
    $sql = "INSERT into pay (receipt,money,mode,code,date) values ('$receipt','$money','$mode','$code','$date')";
    $res = mysqli_query($con, $sql);
    $complete = "Đã trả";
    $sql_2 = "UPDATE `order` set status='$complete' where order_id='$update_id'";
    $res_2 = mysqli_query($con, $sql_2);
    // echo $sql_2;
    $sql_3 = "UPDATE pending set status='$complete' where order_id='$update_id'";
    $res_3 = mysqli_query($con, $sql_3);
    if ($res_3) {
        echo "<script>alert('Cảm ơn bạn đã thanh toán,chúng tôi sẽ xác nhận và gửi đến bạn trong 48h)</script>";
        echo "<script>window.open('user_orders.php','_self')</script>";
    }
}
?>