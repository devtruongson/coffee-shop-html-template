<?php
$connection = mysqli_connect("localhost", "root", null, "qlbanhang");

?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>
    .info-label {
        font-weight: 600;
        margin-bottom: 5px;
    }

    .info-value {
        margin-bottom: 15px;
    }
</style>

<div class="container py-5">
    <div class="mt-3">
        <h2 class="text-center">Thông Tin Đơn Hàng</h2>
        <div class="mt-3">
            <div class="row">
                <?php
                getData($_POST['id'])
                ?>
            </div>
        </div>
    </div>
</div>

<?php
function getData($id = 1)
{
    global $connection;
    $query_select = "select  orders.price AS order_price, orders.*, products.*, users.* from orders left join users on orders.user_id = users.id left join products on orders.product_id = products.id where orders.id = $id";
    $result = mysqli_query($connection, $query_select);
    while ($data = mysqli_fetch_assoc($result)) {
?>
        <div class="mb-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Thông Tin Người Dùng</h5>
                    <div class="info-group">
                        <label class="info-label">Tên người dùng</label>
                        <p class="info-value"><?php echo $data['fullName']; ?></p>
                    </div>
                    <div class="info-group">
                        <label class="info-label">Email người dùng</label>
                        <a class="info-value" href="mailto:<?php echo $data['email']; ?>"><?php echo $data['email']; ?></a>
                    </div>
                    <div class="info-group">
                        <label class="info-label">Tổng tiền hàng</label>
                        <p class="info-value"><?php echo number_format($data['order_price']); ?> VND</p>
                    </div>
                </div>
            </div>
            <button id="back" class="btn btn-danger mt-3">Quay Lại</button>
        </div>
        <div class="mb-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Thông Tin Sản Phẩm</h5>
                    <div class="info-group">
                        <label class="info-label">Tên sản phẩm</label>
                        <p class="info-value"><?php echo $data['name']; ?></p>
                    </div>
                    <div class="info-group">
                        <label class="info-label">Giá</label>
                        <p class="info-value"><?php echo number_format($data['price']); ?> VND</p>
                    </div>
                    <div class="info-group">
                        <label class="info-label">Thumbnail</label>
                        <img src="<?php echo $data['thumbnaiil']; ?>" alt="Thumbnail" class="img-fluid info-value">
                    </div>
                    <div class="info-group">
                        <label class="info-label">Mô tả</label>
                        <p class="info-value"><?php echo $data['description']; ?></p>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}

?>

<script>
    const button = document.querySelector("#back")
    button.addEventListener('click', () => {
        window.location.href = `/coffee-shop-html-template/user/order.php`
    })
</script>