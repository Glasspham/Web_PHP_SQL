<div class="clear">
</div>
</div>
<div class="clear">
</div>
<div id="site_info">
    <p>&copy; Copyright 2025</p>
    </div>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".menuitem").click(function () {
                var submenu = $(this).next(".submenu");
                if (submenu.is(":visible")) {
                    submenu.stop(true, true).slideUp(1, "swing");
                } else {
                    $(".submenu").stop(true, true).slideUp(1, "swing");
                    submenu.stop(true, true).slideDown(1, "swing");
                }
            });
        });
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".menuitem").forEach(item => {
                item.classList.remove("ui-state-active"); // Xóa trạng thái active
            });
            document.querySelectorAll(".submenu").forEach(submenu => {
                submenu.style.display = "none"; // Ẩn tất cả submenu
            });
        });
        $(document).ready(function () {
            var currentPage = window.location.pathname.split("/").pop(); // Lấy tên file hiện tại
            $(".submenu li a").each(function () {
                if ($(this).attr("href") === currentPage) {
                    $(this).closest(".submenu").show(); // Hiện submenu chứa trang đang mở
                }
            });
            $(".submenu li a").each(function () {
                if ($(this).attr("href") === currentPage) {
                    $(".submenu li").removeClass("active"); // Xóa class 'active' khỏi tất cả
                    $(this).closest("li").addClass("active"); // Thêm class 'active' vào mục đang mở
                }
            });
        });
        $(document).ready(function () {
            statistical();
            var char = new Morris.Bar({
                element: 'myfirstchart',
                xkey: 'date',
                ykeys: ['_order', 'revenue', 'quantity'],
                labels: ['Order Number', 'Revenue']
            });
            function statistical() {
                let content = '365 date';
                $('#text_date').text(content);
                $.ajax({
                    url: '../ajax/statistic.php',
                    method: "POST",
                    dataType: "JSON",
                    cache: false,
                    success: function (data) {
                        char.setData(data);
                    }
                })
            }
        });
    </script>
</body>
</html>