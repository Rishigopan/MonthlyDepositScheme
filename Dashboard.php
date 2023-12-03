<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="./CSS/mds.css">

    <title>Dashboard</title>



</head>

<body>

    <div class="wrapper">

        <!--NAVBAR-->
        <nav class="navbar navbartop fixed-top">
            <div class="container-fluid">
                <button class="btn navbtn1 text-white shadow-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"><i class="ri-menu-2-line"></i></button>
                <a class="navbar-text " style="text-decoration: none;">
                    <h4> <strong>INSTA JEWEL</strong> </h4>
                </a>
                <button class="btn navbtn2 text-white shadow-none " type="submit">
                    <i class="ri-notification-2-line "></i>
                </button>
            </div>
        </nav>



        <!--SIDE MENU-->
        <div class="offcanvas offcanvas-start" style="width: 75%;" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-body">

                <div class="text-center" id="Menu_heading">
                    <h5>COMPANY NAME</h5>
                </div>

                <div id="Customer" class="text-center">
                    <img src="Images/Customer.png" alt="">
                    <h4>Customer Name</h4>
                </div>

                <div id="Menu_options">
                    <ul class="list-unstyled">
                        <li>
                            <a href="./Dashboard.php">
                                <i class="material-icons">home</i>
                                <span>Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="material-icons">info</i>
                                <span>About Us</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="material-icons">local_offer</i>
                                <span>Offers</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="material-icons">category</i>
                                <span>Categories</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="material-icons">settings</i>
                                <span>Settings</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="material-icons">storefront</i>
                                <span>Our Stores</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="material-icons">support_agent</i>
                                <span>Contact Us</span>
                            </a>
                        </li>
                        <li>
                            <a href="./signout.php">
                                <i class="material-icons">logout</i>
                                <span>Sign Out</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        
        <!--CONTENTS-->
        <div id="content" class="container-fluid">



            <!--GALLERY-->
            <div id="carouselExampleIndicators" style="border-radius: 8px;" class="carousel slide shadow-sm mt-3" data-bs-ride="carousel">
                <div id="Gallery-buttons" class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
                </div>
                <div id="Gallery" class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="./Images/poster 1-1.jpg" class="d-block  w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="./Images/poster 4.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="./Images/poster 5.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="./Images/poster 6.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="./Images/poster3.jpg" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev click_button" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
                <button class="carousel-control-next click_button" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
            </div>

            <!--BOARDS-->
            <div class="mt-4" id="board_cont">
                <div class="card card-body gold shadow-none ms-1  py-2 me-3 px-2 boardrates">
                    <h5 class="text-end me-2"> <strong>GOLD</strong> </h5>
                    <div class="d-flex justify-content-between mt-3 px-3">
                        <div>
                            <h6>1 Gram</h6>
                            <h3> &#8377; 6,000 </h3>
                        </div>
                        <div>
                            <h6>8 Gram</h6>
                            <h3> &#8377; 50,000 </h3>
                        </div>
                    </div>
                </div>
                <div class="card card-body silver shadow-none me-2 py-2 px-2 boardrates">
                    <h5 class="text-end me-2"> <strong>SILVER</strong> </h5>
                    <div class="d-flex justify-content-between mt-3 px-3">
                        <div>
                            <h6>1 Gram</h6>
                            <h3> &#8377; 69 </h3>
                        </div>
                        <div>
                            <h6>1 Kg</h6>
                            <h3> &#8377; 69,000 </h3>
                        </div>
                    </div>
                </div>
            </div>

            <!--MENU-->
            <div class="row g-2  mb-5" id="Menu">
                <div class="col-4">
                    <a href="./newplans.php">
                        <div class="card card-body mx-1">
                            <i class="material-icons">add_shopping_cart</i>
                            <p>New Plan</p>
                        </div>
                    </a>
                </div>
                <div class="col-4">
                    <a href="./myplans.php">
                        <div class="card card-body mx-1">
                            <i class="material-icons">shopping_basket</i>
                            <p>My Plans</p>
                        </div>
                    </a>
                </div>
                <div class="col-4">
                    <a href="./paynow.php">
                        <div class="card card-body  mx-1">
                            <i class="material-icons">payment</i>
                            <p>Pay EMA</p>
                        </div>
                    </a>
                </div>
                <div class="col-4">
                    <a href="">
                        <div class="card card-body mt-2  mx-1">
                            <i class="material-icons">paid</i>
                            <p>Transactions</p>
                        </div>
                    </a>
                </div>
                <div class="col-4">
                    <a href="">
                        <div class="card card-body mt-2 mx-1">
                            <i class="material-icons">diamond</i>
                            <p>New Arrivals</p>
                        </div>
                    </a>
                </div>
                <div class="col-4">
                    <a href="">
                        <div class="card card-body mt-2 mx-1">
                            <i class="material-icons">menu_book</i>
                            <p>Catalog</p>
                        </div>
                    </a>
                </div>
                <div class="col-4">
                    <a href="">
                        <div class="card card-body mt-2 mx-1">
                            <i class="material-icons">local_offer</i>
                            <p>Offers</p>
                        </div>
                    </a>
                </div>
                <div class="col-4">
                    <a href="">
                        <div class="card card-body mt-2 mx-1">
                            <i class="material-icons">support_agent</i>
                            <p>Contact Us</p>
                        </div>
                    </a>
                </div>
                <div class="col-4">
                    <a href="">
                        <div class="card card-body mt-2 mx-1">
                            <i class="material-icons">show_chart</i>
                            <p>Rate History</p>
                        </div>
                    </a>
                </div>


            </div>


        </div>


        <!--Footer Bar-->
        <nav id="Bottom_navbar" class="navbar fixed-bottom ">
            <p>
                <i class="material-icons" style="vertical-align: middle; font-size: 0.9rem;">copyright</i>
                <span>Insta Jewel</span>
            </p>
        </nav>




    </div>



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>