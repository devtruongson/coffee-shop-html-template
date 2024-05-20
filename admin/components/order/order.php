<?php
include '../../connectDB.php';
?>

<div>
    <div>
        <div>
            <div class="mt-5">
                <h2 class="my-2 mb-3" style="font-size: 17px;">Danh Sách Đơn Order</h2>
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" style="white-space: nowrap;">Mã ORDER</th>
                            <th scope="col">Tài Khoản Mua</th>
                            <th scope="col">Sản Phẩm Mua</th>
                            <th scope="col">Số Lượng</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        xuatDataOrder();
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>


<?php

function xuatDataOrder()
{
    global $connection;
    $query_select = "SELECT orders.id AS order_id, orders.price AS order_price, orders.*, users.*, products.* FROM orders LEFT JOIN users ON orders.user_id = users.id LEFT JOIN products ON orders.product_id = products.id ";
    $result = mysqli_query($connection, $query_select);
    while ($data = mysqli_fetch_assoc($result)) {
?>
        <tr>
            <td class="text-center"><?php echo $data['id']; ?></td>
            <td><?php echo $data['fullName']; ?></td>
            <td>
                <span style="max-width: 500px; display:block; overflow: hidden;">
                    <?php echo $data['name']; ?>
                </span>
            </td>
            <td><?php echo $data['count']; ?></td>
            <td><?php echo number_format($data['order_price']); ?> VND</td>
            <td>
                <div style="display: flex; gap: 6px; align-items: center;">
                    <form action="components/order/viewOrder.php" method="POST">
                        <input type="text" name="id" hidden value="<?php echo $data['order_id'] ?>">
                        <button data-id="<?php echo $data['order_id'] ?>" class="btn btn-secondary">Xem Chi Tiết</button>
                    </form>
                </div>
            </td>
        </tr>
<?php
    }
}
?>