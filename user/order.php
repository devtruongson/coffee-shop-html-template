<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<div class="container">
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
                    <tbody id="render-order-by-user">
                    </tbody>
                </table>
                <a href="/coffee-shop-html-template" id="back" class="btn btn-danger mt-3">Quay Lại</a>
            </div>

        </div>
    </div>
</div>


<script>
    const renderTableOrder = document.querySelector("#render-order-by-user");
    const user = JSON.parse(localStorage.getItem('user')) || null;
    if (!user) {
        alert("Vui lòng đăng nhập!");
    } else {
        const formData = new FormData();
        formData.append('email', user.email);
        fetch('/coffee-shop-html-template/user/orderGetData.php', {
            method: 'POST',
            body: formData
        }).then(async (res) => {
            return await res.text();
        }).then(res => {
            renderTableOrder.innerHTML = res;
        })
    }
</script>