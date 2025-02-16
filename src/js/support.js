$(document).ready(function () {
    /*
    let defaults = {
        containerID: 'toTop', // fading element id
        containerHoverID: 'toTopHover', // fading element hover id
        scrollSpeed: 1200,
        easingType: 'linear' 
    };
    */
    $().UItoTop({ easingType: "easeOutQuart" });
});

$(function () {
    SyntaxHighlighter.all();
});
$(window).load(function () {
    $(".flexslider").flexslider({
        animation: "slide",
        start: function (slider) {
            $("body").removeClass("loading");
        },
    });
});

// TODO Đánh giá bằng sao
function remove_background(product_id) {
    for(let count = 1; count <= 5; ++count)
        $('#' + product_id + '-' + count).css('color', '#ccc');
}
// TODO Hover chuột đánh giá sao
$(document).on('mouseenter', '.rating', function() {
    let index = $(this).data("index");
    let product_id = $(this).data("product_id");
    remove_background(product_id);
    for(let count = 1; count <= index; ++count)
        $('#' + product_id + '-' + count).css('color', '#fc0');
});
// TODO Nhả chuột không đánh giá
$(document).on('mouseleave', '.rating', function() {
    let index = $(this).data('index');
    let product_id = $(this).data('product_id');
    let rating = $(this).data('rating');
    remove_background(product_id);
    for(let count = 1; count <= rating; ++count)
        $('#' + product_id + '-' + count).css('color', '#fc0');
});
$('.rating').click(function() {
    let index = $(this).data('index');
    let product_id = $(this).data('product_id');
    let customer_id = $(this).data('customer_id');
    $.ajax({
        url: 'ajax/rating.php',
        data: {
            index: index,
            product_id:product_id,
            customer_id:customer_id
        },
        type:'POST',
        success: function(data) {
            alert('Rasuccess Assessment' + index + 'star');
        }
    });
});
$(document).on('mouseenter', '.rating_login', function() {
    alert('Sign in to rate stars');
});

// TODO Box thông báo
function reloadPage(getVariables='', getValues='') {
    if(!getVariables && !getValues) window.location.href = "?";
    else window.location.href = "?" + getVariables + "=" + getValues;
}
document.addEventListener("DOMContentLoaded", function () {
    let modal = document.querySelector("#modal");
    let closeBtn = document.querySelector("#closeBtn");
    let span = document.querySelector(".close");
    // Kiểm tra nếu modal tồn tại
    if (modal) {
        modal.style.display = "block";
        // Đóng modal khi nhấn nút "OK" và chuyển hướng
        closeBtn.onclick = function() {
            modal.style.display = "none";
            let getVariables = closeBtn.getAttribute("data-variables") || "";
            let getValues = closeBtn.getAttribute("data-values") || "";
            if (getVariables && getValues) reloadPage(getVariables, getValues);
            else reloadPage();
        };
        // Đóng modal khi nhấn nút (x)
        if (span) {
            span.onclick = () => modal.style.display = "none";
        }
        // Đóng modal khi click ra ngoài modal
        window.onclick = (event) => {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };
    }
});

$(document).ready(function(){
    function loadProducts(page, type) {
        $.ajax({
            url: "ajax/fetch_products.php",
            type: "GET",
            data: { page: page, type: type },
            dataType: "json",
            success: function(response) {
                let html = "";
                $.each(response, function(index, product) {
                    html += `
                        <div class="grid_1_of_4 images_1_of_4">
                            <a href="details.php?productId=${product.id}">
                                <img class="img-product" src="uploads/product/${product.image}" />
                            </a>
                            <h2>${product.name}</h2>
                            <p><span class="price">$ ${product.price}</span></p>`;
                    if(product.quantity > 0) {
                        html += `
                            <form action="" method="POST">
                                <input type="hidden" value="${product.id}" name="productId">
                                <input type="hidden" value="${product.quantity}" name="stock">
                                <input type="submit" value="Add To Cart" class="btn btn-success" name="addToCart">
                            </form>
                        </div>`;
                    } else {
                        html += `<span class="error btn">Out of stock</span></div>`;
                    }
                });
                let target = type === "new" ? "#new-products" : "#featured-products";
                $(target).fadeOut("fast", function() {
                    $(this).html(html).fadeIn("fast");
                });
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: " + error);
            }
        });
    }
    loadProducts(1, "new");
    loadProducts(1, "featured");
    $(document).on("click", ".pagination-link", function(e) {
        e.preventDefault();
        let page = $(this).data("page");
        $(".pagination-link").removeClass("selected");
        $(this).addClass("selected");
        loadProducts(page, "new");
    });
    $(document).on("click", ".pagination-link-feature, .prev, .next", function(e) {
        e.preventDefault();
        let page = $(this).data("page_feature");
        $(".pagination-link-feature").removeClass("selected");
        $(this).addClass("selected");
        loadProducts(page, "featured");
    });
});