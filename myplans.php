
<?php

include './MAIN/Dbconfig.php';

if(isset($_COOKIE['custtypecookie']) && isset($_COOKIE['custidcookie'])){

    $cust_id = $_COOKIE['custidcookie'];

}
else{

header("location:login.php");
}

?>

<!doctype html>
<html lang="en">

<head>


<?php 

    include './MAIN/Header.php';

?>


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

        <div class="row mb-5">



        <?php 
        
            $findplans_query = mysqli_query($conlink, "SELECT * FROM all_schemes a INNER JOIN scheme_master s ON a.scheme_id = s.scheme_id WHERE a.cust_id = '$cust_id' AND a.scheme_status = '0'");
            if(mysqli_num_rows($findplans_query) > 0){
                foreach($findplans_query as $result_virus){
            ?>

                <div class="col-12 col-md-6 col-lg-3 mt-2">
                    <div class="card card_plans card-body">
                        <div class="row g-1">
                            <div class="col-5 col1">
                                <div class="img_cont">
                                    <img src="./Images/5143422.jpg" class="img-fluid" alt="">
                                </div>
                            </div>
                            <div class="col-7">
                                <h6 class="p-3 text-center"> <strong> <?php echo $result_virus['scheme_name'];?> </strong></h6>
                                <p class="d-flex mx-2 justify-content-between">
                                    <span> <?php echo $result_virus['scheme_duration'];?> Months</span>
                                    <span class="me-2"> <?php 
                                    
                                        echo $monthly_ema = number_format($result_virus['scheme_total'] / $result_virus['scheme_duration']);
                                     
                                    ?></span>
                                </p>
                                <div class="text-center btn_join mt-2">
                                    <a href="myplan_detailed.php?allscheme_id=<?php echo  $result_virus['allscheme_id']; ?>" class="btn shadow-none rounded-pill">
                                        View 
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
            
            <?php
            }
            }
            else{
            ?>

                <div class="card card_plans card-body">
                    <div class="row g-1">
                        
                        <div class="col-12">
                            <h5 class="p-3 text-center"> <strong>ADD A SCHEME FIRST</strong></h5>
                        </div>

                    </div>
                </div>

            <?php
            }
        

        ?>

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



</body>

</html>