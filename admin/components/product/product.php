<?php
include '../../connectDB.php';
?>

<div>
    <div>
        <form action="components/product/insertProduct.php" method="POST">
            <div class="row">
                <div class="mb-3 col-6">
                    <label for="name" class="form-label">Tên sản phẩm</label>
                    <input placeholder="Nhập tên sản phẩm" type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3 col-6">
                    <label for="price" class="form-label">Giá</label>
                    <input placeholder="Nhập giá sản phẩm" type="text" class="form-control" id="price" name="price" required>
                </div>
                <div class="mb-3 col-6">
                    <label for="stock" class="form-label">Số lượng</label>
                    <input placeholder="Nhập số lượng sản phẩm" type="text" class="form-control" id="stock" name="stock" required>
                </div>
                <div class="mb-3 col-6">
                    <label for="Thumbnail" class="form-label">Thumbnail</label>
                    <input placeholder="Nhập ảnh sản phẩm" type="text" class="form-control" id="Thumbnail" name="thumbnail" required>
                </div>
                <div class="mb-3 col-12">
                    <label for="des" class="form-label">Mô tả</label>
                    <textarea placeholder="Nhập mô tả sản phẩm" type="text" class="form-control" id="des" name="description" required></textarea>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-primary">Thêm sản phẩm</button>
            </div>
        </form>
        <div>
            <div class="mt-5">
                <h2 class="my-2 mb-3" style="font-size: 17px;">Danh Sách Sản Phẩm</h2>
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" style="white-space: nowrap;">Mã mặt hàng</th>
                            <th scope="col">Tên Mặt Hàng</th>
                            <th scope="col">Mô tả</th>
                            <th scope="col">Giá</th>
                            <th scope="col">stock</th>
                            <th scope="col">ảnh</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        xuatDataSanPham();
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>


<?php

function xuatDataSanPham()
{
    global $connection;
    $query_select = "select * from products";
    $result = mysqli_query($connection, $query_select);
    while ($data = mysqli_fetch_assoc($result)) {
?>
        <tr>
            <td class="text-center"><?php echo $data['id']; ?></td>
            <td><?php echo $data['name']; ?></td>
            <td>
                <span style="max-width: 500px; display:block; overflow: hidden;">
                    <?php echo $data['description']; ?>
                </span>
            </td>
            <td><?php echo number_format($data['price'] ? $data['price'] : 0); ?> VND</td>
            <td><?php echo $data['stock']; ?></td>
            <td>
                <img style="width: 70px; height: 70px; border-radius: 6px; object-fit: cover;" src="<?php echo $data['thumbnaiil']; ?>" alt="Hình ảnh">
            </td>
            <td>
                <div style="display: flex; gap: 6px; align-items: center;">
                    <form action="components/product/deleteProduct.php" method="POST">
                        <input type="text" name="id" hidden value="<?php echo $data['id'] ?>">
                        <button data-action="delete" data-id="<?php echo $data['id'] ?>" class="btn btn-primary">Xóa</button>
                    </form>
                    <form action="components/product/updateProductView.php" method="POST">
                        <input type="text" name="id" hidden value="<?php echo $data['id'] ?>">
                        <button data-action="update" data-bs-toggle="modal" data-bs-target="#modal_update" data-id="<?php echo $data['id'] ?>" class="btn btn-secondary">Sửa</button>
                    </form>
                </div>
            </td>
        </tr>
<?php
    }
}
?>