<?php 
    include_once 'inc/header.php';
    include_once 'inc/sidebar.php';
?>
<style type="text/css">
    html, body {
        margin: 0;
        padding: 0;
        overflow-x: hidden;
        overflow-y: hidden;
    }

    body {
        min-height: 100vh; /* Đảm bảo full màn hình */
        display: flex;
        flex-direction: column;
    }
    .bg-light {
        background-color:#04ff00;
    }
    .card-style1 {
        box-shadow: 0px 0px 10px 0px rgb(89 75 128 / 9%);
    }

    .border-0 {
        border: 0 !important;
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, .125);
        border-radius: 0.25rem;
    }

    section {
        padding: 120px 0;
        overflow: hidden;
        background: #fff;
    }

    .mb-2-3,
    .my-2-3 {
        margin-bottom: 2.3rem;
    }

    .section-title {
        font-weight: 600;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 10px;
        position: relative;
        display: inline-block;
    }

    .text-primary {
        color:rgb(206, 88, 77) !important;
    }

    .text-secondary {
        color: #15395A !important;
    }

    .font-weight-600 {
        font-weight: 600;
    }

    .display-26 {
        font-size: 1.3rem;
    }

    @media screen and (min-width: 992px) {
        .p-lg-7 {
            padding: 4rem;
        }
    }

    @media screen and (min-width: 768px) {
        .p-md-6 {
            padding: 3.5rem;
        }
    }

    @media screen and (min-width: 576px) {
        .p-sm-2-3 {
            padding: 2.3rem;
        }
    }

    .p-1-9 {
        padding: 1.9rem;
    }

    .bg-secondary {
        width: 300px;
        background: #45c465 !important;
    }

    @media screen and (min-width: 576px) {

        .pe-sm-6,
        .px-sm-6 {
            padding-right: 3.5rem;
        }
    }

    @media screen and (min-width: 576px) {

        .ps-sm-6,
        .px-sm-6 {
            padding-left: 3.5rem;
        }
    }

    .pe-1-9,
    .px-1-9 {
        padding-right: 1.9rem;
    }

    .ps-1-9,
    .px-1-9 {
        padding-left: 1.9rem;
    }

    .pb-1-9,
    .py-1-9 {
        padding-bottom: 1.9rem;
    }

    .pt-1-9,
    .py-1-9 {
        padding-top: 1.9rem;
    }

    .mb-1-9,
    .my-1-9 {
        margin-bottom: 1.9rem;
    }

    @media (min-width: 992px) {
        .d-lg-inline-block {
            display: inline-block !important;
        }
    }

    .rounded {
        border-radius: 0.25rem !important;
    }
    @media (min-width: 1200px) {
        .px-xl-10 {
            width: 50%;
            /* padding: 5px; */
            margin-top: 3%;
        }
    }
</style>
<section class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-4 mb-sm-5">
                <div class="card card-style1 border-0">
                    <div class="card-body p-1-9 p-sm-2-3 p-md-6 p-lg-7">
                        <div class="row align-items-center">
                            <div class="col-lg-6 mb-4 mb-lg-0"> <img
                                    src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="..."></div>
                            <div class="col-lg-6 px-xl-10">
                                <?php 
                                    $getAdmin = $class->show();
                                    if ($getAdmin) {
                                        $result = $getAdmin->fetch_assoc();
                                ?>
                                <div class="bg-secondary d-lg-inline-block py-1-9 px-1-9 px-sm-6 mb-1-9 rounded">
                                    <h3 class="h2 text-white mb-0"><?php echo $result['name']?></h3> <span
                                        class="text-primary">Admin</span>
                                </div>
                                <ul class="list-unstyled mb-1-9">
                                    <li class="mb-2 mb-xl-3 display-28">
                                        <span class="display-26 text-secondary me-2 font-weight-600">
                                            Position:
                                        </span>
                                        Admin
                                    </li>
                                    <li class="mb-2 mb-xl-3 display-28">
                                        <span class="display-26 text-secondary me-2 font-weight-600">
                                            Email:
                                        </span>
                                        <?php echo $result['email']?>
                                    </li>
                                    <li class="display-28">
                                        <span class="display-26 text-secondary me-2 font-weight-600">
                                            Phone:
                                        </span> 507 -541 - 4567
                                    </li>
                                </ul>
                                <ul class="social-icon-style1 list-unstyled mb-0 ps-0">
                                    <li><a href="profile.php"><i class="ti-twitter-alt"></i></a></li>
                                    <li><a href="profile.php"><i class="ti-facebook"></i></a></li>
                                    <li><a href="profile.php"><i class="ti-pinterest"></i></a></li>
                                    <li><a href="profile.php"><i class="ti-instagram"></i></a></li>
                                </ul>
                                <?php 
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php 
    include_once 'inc/footer.php';
?>