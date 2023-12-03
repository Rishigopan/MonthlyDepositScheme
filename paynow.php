


<?php

include './MAIN/Dbconfig.php';
include './get_details.php';

if(isset($_COOKIE['custtypecookie']) && isset($_COOKIE['custidcookie'])){

    $user_id = $_COOKIE['custidcookie'];

  

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

<style>

    .disable {
        opacity: 0.3;
        pointer-events: none;
    }


    #Success_modal .modal-body img{
        height: 100px;
        width: 100px;
    }


</style>

</head>

<body>

<div class="wrapper">


    <!-- Modal -->
    <div class="modal fade " id="Success_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            
            <div class="modal-body text-center">
                <div class="my-4">
                    <img src="./success.gif" class="img-fluid" alt="">

                    <h5 class="mt-3">Payment Successfull</h5>
                    <div class="mt-3">
                        <button id="success_button" class="btn btn-success px-5">Done</button>
                    </div>
                </div>
            </div>
            
            </div>
        </div>
    </div>

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



        <div id="joincard" class="card card-body plan_join mb-5">


            <form action="" id="payment_form" enctype="multipart/form-data" novalidate>

             
                <div id="Select_input">
                    <label for="#Select_scheme" class="form-label">Current Scheme</label>
                    <select name="all_scheme" id="Select_scheme" class="form-select" >
                        <option hidden value="">Choose...</option>
                        <?php 
                        
                            $fetch_schemes = mysqli_query($conlink, "SELECT * FROM all_schemes a INNER JOIN scheme_master s ON a.scheme_id = s.scheme_id WHERE a.cust_id = '$user_id' AND a.scheme_status = '0'");
                            foreach($fetch_schemes as $myschemes){
                                echo '<option value="'.$myschemes['allscheme_id'].'">'.$myschemes['scheme_name'].'</option>';
                            }
                        
                        ?>
                        
                    </select>
                </div>
                
                <h5 class="text-center my-3">Monthly Installment : <span>₹ <span id="emamonthly"> </span></span></h5>

                <!--DUES INVOICE-->
                <div class="card card-body mt-2" style="border-radius: 8px; border-color: #2F86A6;">
                    <div class="" style="line-height: 0.5;">
                        <div class="d-flex justify-content-between">
                            <p>Pending :</p>
                            <p>₹ <span id="pending"> </span></p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>EMA :</p>
                            <p>₹ <span id="emapay"> </span></p>
                        </div>
                        
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h6>Total Dues :</h6>
                            <h6>₹ <span id="totalpay"></span></h6>
                        </div>
                    </div>
                </div>

                <!--OPTION 2-->
                <div class="card card-body mt-3 mincard">
                    <div class="d-flex justify-content-between">
                        <div class="form-check my-auto">
                            <input class="form-check-input" type="radio" name="Pay_options" id="Pay_1">
                            <label class="form-check-label" for="Pay_1">Enter Amount</label>
                        </div>
                        <div class="input-group" style="width: 140px;">
                            <span class="input-group-text">₹</span>
                            <input type="text" class="form-control" id="custom_amount">
                        </div>
                    </div>
                </div>



                <!--FINAL AMOUNT-->
                <div class="input-group mt-4 mx-auto">
                    <span class="input-group-text" id="Amount_pay">Final Amount</span>
                    <input type="text" class="form-control" id="Pay_final" name="pay_final" style="pointer-events: none;background-color:#d3d3d3;">
                </div>


                <!--PAYMENT BUTTON-->
                <div class="text-center mt-4 ">
                    <button id="Paybtn" class="btn btn-danger rounded-pill px-4 py-2">PAY NOW</button>
                </div>


            </form>

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


<script src="./find_all.js"></script>


<script src="https://cdn.jsdelivr.net/npm/@emretulek/jbvalidator"></script>

<script>

    $(document).ready(function(){

        //change custom amount
        $('#custom_amount').change(function(){
            var custom_amount = $(this).val();
            $('#Pay_final').val(custom_amount);
        });


        //reload page
        $('#success_button').click(function(){
            location.reload();
        });


        $('#Select_scheme').change(function(){

            var scheme_id = $(this).val();
            get_details(scheme_id);

        });



        //make payment
        $('#payment_form').submit(function(e){
            e.preventDefault();
            var paydetails = new FormData(this);
            //console.log(paydetails);
            $.ajax({
                type:"POST",
                url:"transactions.php",
                data:paydetails,
                beforeSend:function(){
                    $('#joincard').addClass("disable");
                },
                success:function(data){
                    console.log(data);
                    $('#joincard').removeClass("disable");
                    var payresponse = JSON.parse(data);
                    if(payresponse.status == 1){
                        $('#Success_modal').modal("show");
                       
                    }
                    else if(payresponse.status == 2){
                        toastr.warning("Amount Exceeds The maximum Value");
                    }
                    else{
                        toastr.error("Payment Failed");
                    }
                   
                },
                cache: false,
                contentType: false,
                processData: false
            });



        });



    });










    
</script>

</body>

</html>