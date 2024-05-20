<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xin Chào Admin</title>
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style-app.css">
    <style>
        .menu {
            list-style: none;
            padding: 0;
        }

        .menu li {
            padding: 10px 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .menu li:hover {
            background-color: #f5f5f5;
        }

        .menu li.active {
            background-color: #007bff;
            color: #fff;
        }

        .menu li.active:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div>
        <nav class="header-admin-wp">
            <div class="container">
                <div class="wp-header">
                    <a class="" href="/">Home</a>
                    <div>
                        <div class="avatar">
                            <img src="https://blogs.insead.edu/switzerland-iaa/files/2015/06/no-pic-avatar-fem-1t5rgzs.png" alt="">
                            <span class="fulName_user_for_admin">Nguyễn Admin</span>
                            <ul>
                                <li>Đăng Xuất</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <ul class="menu">
                        <li data-active="product" id="product_render">Sản Phẩm</li>
                        <li data-active="account">Tài Khoản</li>
                        <li data-active="order">Đơn Hàng</li>
                    </ul>
                </div>
                <div class="col-10" id="render-content-admin">
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        const isLogin = JSON.parse(localStorage.getItem('isLogin'));
        const user = JSON.parse(localStorage.getItem('user'));

        if (!isLogin || user.role !== "ADMIN") {
            alert("Bạn không có quyền truy cập");
            const pathNameFour = window.location.href.split("/")[4];
            const pathNameFive = window.location.href.split("/")[5] || "";
            window.location.href = window.location.href.replace(pathNameFour, "auth").replace(pathNameFive, "");
        }

        document.addEventListener("DOMContentLoaded", () => {
            localStorage.setItem("origin", JSON.stringify(window.location.href));
            const lis = document.querySelectorAll(".menu > li");
            const eleRender = document.querySelector("#render-content-admin");

            const loadContent = (active) => {
                let newUrl = window.location.protocol + '//' + window.location.host + window.location.pathname + `?active=${active}`;
                window.history.pushState({
                    path: newUrl
                }, '', newUrl);
                lis.forEach(ele => {
                    ele.style.color = "#333";
                })
                const liElement = document.querySelector(`li[data-active='${active}']`);
                liElement.style.color = "#ee4d2d";
                fetch(`./components/${active}/${active}.php`)
                    .then(response => response.text())
                    .then(data => {
                        eleRender.innerHTML = data;
                    })
                    .catch(error => {
                        console.error('Error fetching content:', error);
                    });
            };

            let active = "product";
            const searchParams = window.location.search;
            if (searchParams.includes("active")) {
                const activeParam = searchParams.split("=")[1];
                if (activeParam !== "product" && activeParam !== "account" && activeParam !== "order") {
                    active = "product";
                } else {
                    active = activeParam;
                }
            }


            loadContent(active);
            lis.forEach(ele => {
                ele.addEventListener("click", (e) => {
                    const active = e.target.dataset.active;
                    loadContent(active);
                });
            });
        });
    </script>
</body>

</html>