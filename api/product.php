<?php
$connection = mysqli_connect("localhost", "root", null, "qlbanhang");

$query_select = "select * from products";
$result = mysqli_query($connection, $query_select);
while ($data = mysqli_fetch_assoc($result)) {
?>
    <div class="col-lg-6 mb-5">
        <div class="row align-items-center">
            <div class="col-sm-5">
                <img class="img-fluid mb-3 mb-sm-0 rounded-sm" src="<?php echo $data["thumbnaiil"] ?>" alt="" />
            </div>
            <div class="col-sm-7">
                <h4>
                    <i class="fa fa-truck service-icon"></i><?php echo $data["name"] ?>
                </h4>
                <p class="m-0 mt-1" style="display: -webkit-box;-webkit-box-orient: vertical; -webkit-line-clamp: 4; overflow: hidden; text-align: justify;">
                    <?php echo $data["description"] ?>
                </p>

                <div class="mt-2">
                    <span style="font-weight: 600;">Giá </span>
                    <span><?php echo number_format($data['price'] ? $data['price'] : 0); ?> VND</span>
                </div>
                <div class="mt-1">
                    <button class="btn btn-primary rounded-md" onclick="handleAddToCart({
                        id: <?php echo ($data['id']); ?>,
                        name :  '<?php echo ($data['name']); ?>',
                        thumbnaiil :  '<?php echo ($data['thumbnaiil']); ?>',
                        price :  '<?php echo ($data['price']); ?>',
                        description :  '<?php echo ($data['description']); ?>' 
                    });">Thêm vào giỏ hàng</button>
                </div>

            </div>
        </div>
    </div>
<?php
}
?>