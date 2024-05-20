// // lay ra cac the
const ProductRender = document.querySelector(".render---product");
const SelectFilter = document.querySelector("#filter-product--js");
const CountCart = document.querySelector(".jsx-count-cart");
const CartWrapper = document.querySelector(".cart-wrapper-icon");
const PageCartWrapper = document.querySelector(".cart-detail");
const OverlayCart = PageCartWrapper.querySelector(".overlay-cart");
const PageRenderCart = PageCartWrapper.querySelector(".cart-wrapper");
const CountDetailPageCart = document.querySelector("#cart-detail-count");
const RenderItemCart = document.querySelector(".jsx-render-pro");
const TotalOrderValue = document.querySelector(".total-gia-tri-don-hang");
const ProvisionalValue = TotalOrderValue.querySelector("#gia-tri-tam-tinh");
const CalculatedValue = TotalOrderValue.querySelector("#gia-tri-da-tinh");
const btnCheckOutDone = document.querySelector("#check-out-done");

const CartList = JSON.parse(localStorage.getItem("CartList"));

if(!CartList) {
    localStorage.setItem("CartList", JSON.stringify([]));
}

// show page cart
CartWrapper.onclick = () => {
    let dataCart = JSON.parse(localStorage.getItem("CartList")) || [];
    RenderItemCartFunC(dataCart);
    HandleTotalValueFunc(dataCart);
    PageRenderCart.classList.toggle("active");
    PageCartWrapper.style.transform = "translateX(0%)";
    OverlayCart.style.display = "block";
};

OverlayCart.onclick = () => {
    PageRenderCart.classList.toggle("active");
    PageCartWrapper.style.transform = "translateX(100%)";
    OverlayCart.style.display = "none";
};

CountCart.innerHTML = JSON.parse(localStorage.getItem("CartList"))
    ? JSON.parse(localStorage.getItem("CartList")).length
    : 0;



// // ham format gia tien
function handleFormatVND(price) {
    return price.toLocaleString("it-IT", {
        style: "currency",
        currency: "VND",
    });
}

// // ham tao ra cac element render
function ProductCard(item) {
    return `<div class="col-12 col-md-6 col-lg-4 col-xl-3">
    <div class="d-sm-none">
      <div
                class="image-section product-trend"
            >
                <div class="image-section-children">
                    <div
                        class="image-product-trend"
                        style="
                            background-image: url('${item.img}');
                        "
                    >
                        <div
                            class="jsx-nav-redirect"
                        >
                            <span
                            onclick="handleAddToCart(${item.id});"
                            class="click-add-to-card"
                                ><i
                                    class="bi bi-search"
                                ></i
                                >Thêm Giỏ Hàng</span
                            >
                            <p>
                            ${item.desc}
                            </p>
                            
                        </div>
                    </div>
                    <p
                        class="introduction-text-product-trend"
                    >
                    <span
                    class="d-block text-start text-intro-trend-category"
                    >Nhãn hiệu <strong>${item.type}</strong></span
                >
                        <span
                            class="d-block text-start text-intro-trend-category"
                            > backCamera : ${item.backCamera}</span
                        >
                        <span
                            class="d-block text-start text-intro-trend-category"
                            >frontCamera: ${item.frontCamera}</span
                        ><span
                            class="text-start text-intro-trend-name"
                            ><strong
                                >${item.name}</strong
                            ></span
                        ><span
                            class="d-block text-start text-intro-trend-price"
                            ><input
                                disabled=""
                                class="jsx-input-add disable"
                                type="text"
                                value="${handleFormatVND(item.price)}"
                            /></span
                        >
                    </p>
                </div>
            </div>
    </div>
</div>`;
}

// item cart
function ItemCart(item) {
    return `
    <div class="col-12 item">
    <div class="row">
        <div
            class="col-4 introduce"
        >
            <div
                class="image"
                style="background-image: url('${item.thumbnaiil}')"
            ></div>
            <div
                class="introduction"
            >
                <p>
                    <strong>
                        ${item.name}
                    </strong>
                </p>
                <span
                    >size:
                    ${item.description}</span
                >
            </div>
        </div>
        <div
            class="col-2 price-pro d-inline-flex justify-content-center align-items-center customize-jsx-format"
        >
           ${handleFormatVND(+item.price)}
        </div>
        <div
            class="col-2 count-pro d-inline-flex justify-content-center align-items-center"
        >
            <button onclick="handleClickCart(${item.id}, ${
        item.count
    }, 'down')">-</button>
            <input
                id="count-cart-wrapper-detail"
                disabled
                type="text"
                value="${item.count}"
            />
            <button onclick="handleClickCart(${item.id}, ${
        item.count
    }, 'up')">+</button>
        </div>
        <div
            class="col-3 total-pro d-inline-flex justify-content-end align-items-center customize-jsx-format"
        >
            ${handleFormatVND(item.count * item.price)}
        </div>
        <div
            class="col-1 total-pro d-inline-flex justify-content-end align-items-center cursor-pointer"
        >
            <span onclick="handleDeleteItemCart(${item.id})">
                <button class="btn btn-primary">Xóa</button>
            </span>
        </div>
    </div>
</div>
`;
}

// // ham render
function Render(list) {
    // khong co list hoac list khong co phan tu nao cung khong lam gi ca;
    if (!list || list.length === 0) return;

    let CardProduct = list.map((item) => ProductCard(item)).join("");

    if (ProductRender) {
        ProductRender.innerHTML = CardProduct;
    }
}

// // ham render item cart ( co the tai su dung ham Render ben tren nhung viet moi cho tuong minh )
function RenderItemCartFunC(dataCart) {
    CountDetailPageCart.innerHTML = `${dataCart.length} Sản phẩm trong giỏ hàng`;
    CountCart.innerHTML = dataCart.length;
    if (dataCart && dataCart.length > 0) {
        let CardProduct = dataCart.map((item) => ItemCart(item)).join("");

        if (RenderItemCart) {
            RenderItemCart.innerHTML = CardProduct;
        }
    } else {
        if (RenderItemCart) {
            RenderItemCart.innerHTML = `<p
            class="mt-5 pt-5 text-center fz-13"
        >
            <span
                >Hiện tại trong giỏ hàng của
                bạn không có sản phẩm. ấn
                vào <a href="/">đây</a> để
                tiếp tục mua sắm ❤️</span
            >
        </p>`;
        }
    }
}

// // handle total order value
function HandleTotalValueFunc(DataCart) {
    if (DataCart && DataCart.length > 0) {
        let Total = DataCart.reduce((init, item) => {
            return (init += item.count * item.price);
        }, 0);

        ProvisionalValue.setAttribute("value", handleFormatVND(Total));
        CalculatedValue.setAttribute("value", handleFormatVND(Total));
    } else {
        ProvisionalValue.setAttribute("value", handleFormatVND(0));
        CalculatedValue.setAttribute("value", handleFormatVND(0));
    }
}

// // handle add to cart
function handleAddToCart(data) {
    console.log(data)
    
    let dataCart = JSON.parse(localStorage.getItem("CartList")) || [];
    const checkExit = dataCart.find(item => item.id === data.id);
    if(checkExit) {
        alert("Bạn đã thêm sản phẩm vào giỏ hàng rồi!");
        return;
    }else{
        data.count =  1;
        localStorage.setItem("CartList", JSON.stringify([...dataCart,data]));
        CountCart.innerHTML = dataCart.length;
    }
}



// // handle click them hoac giam so luong san pham
function handleClickCart(id, count, type) {
    let dataCart = JSON.parse(localStorage.getItem("CartList"));

    if (dataCart && dataCart.length > 0) {
        const ItemCart = dataCart.find((item) => item.id == id);

        if (ItemCart) {
            if (type === "up") {
                ItemCart.count = count + 1;
                RenderItemCartFunC(dataCart);
                HandleTotalValueFunc(dataCart);
            }

            if (type === "down" && count > 0) {
                ItemCart.count = count - 1;
                RenderItemCartFunC(dataCart);
                HandleTotalValueFunc(dataCart);
            } else if (type === "down" && count == 0) {
                alert("Sản phẩm không thể là số âm !");
            }
        }

        localStorage.setItem("CartList", JSON.stringify(dataCart));
    }
}

// // handle click delete item cart
function handleDeleteItemCart(id) {
    let check = confirm("Bạn có chắc chắn muốn xóa sản phẩm này không?");
    console.log(check);

    if (!check) return;

    let dataCart = JSON.parse(localStorage.getItem("CartList"));

    if (dataCart && dataCart.length > 0) {
        let indexItem = dataCart.findIndex((item) => item.id == id);

        console.log(indexItem);

        if (indexItem) {
            dataCart.splice(indexItem, 1);
            RenderItemCartFunC(dataCart);
            HandleTotalValueFunc(dataCart);
            localStorage.setItem("CartList", JSON.stringify(dataCart));
        }
    }
    console.log(dataCart);
}

// handle check out done
btnCheckOutDone.onclick = () => {
    const dataCartSubmit = JSON.parse(localStorage.getItem("CartList")) || [];
    const user = JSON.parse(localStorage.getItem("user") ) || null;

    if(!user) {
        alert("Hãy đăng nhập");
        return;
    }

    if(dataCartSubmit.length > 0) {
        dataCartSubmit.map(item => {
            const formData = new FormData();
            formData.append('email', user.email);
            formData.append('product_id', item.id);
            formData.append('count', item.count);
            formData.append('price', item.count * item.price);
        
            fetch('/coffee-shop-html-template/api/order.php', {
                method: 'POST',
                body: formData
            }).then(res=>{
                alert("Chúc mừng bạn thanh toán thành công!");
            })
        })
    }else{
        alert("Bạn chưa có sản phẩm trong giỏ hàng!")
    }
    
    let dataCart = [];

    RenderItemCartFunC(dataCart);
    HandleTotalValueFunc(dataCart);
    localStorage.setItem("CartList", JSON.stringify(dataCart));
};
