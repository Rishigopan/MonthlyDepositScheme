


<?php

include './MAIN/Dbconfig.php';
include './get_details.php';

if(isset($_COOKIE['custtypecookie']) && isset($_COOKIE['custidcookie'])){

    $user_id = $_COOKIE['custidcookie'];

    $allschemeid = $_GET['allscheme_id'];

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


        <?php

            $fetch_details = mysqli_query($conlink, "SELECT * FROM all_schemes a INNER JOIN scheme_master s ON a.scheme_id = s.scheme_id  WHERE a.allscheme_id = '$allschemeid'");
            foreach($fetch_details as $scheme_details){
                $ema = $scheme_details['ema'];
                $join_date = $scheme_details['join_date'];
            }


            $fetch_transaction = mysqli_query($conlink, "SELECT COUNT(ema_id) FROM all_transactions WHERE scheme_id = '1' AND cust_id = '$user_id' AND transaction_status = 'paid'");
            foreach($fetch_transaction as $transactions){
                $paid = $transactions['COUNT(ema_id)'];
            }

        ?>



        <div id="plan_detail" class="card card-body plan_detailed mb-5">


            <div class="col-12 top_portion">
                <div class="text-center">
                    <h6 class="m-0"> <?php echo $scheme_details['scheme_name']; ?> </h6>
                </div>
            </div>

            <div class="col-12 middle_portion">
                <div class="text-center">
                    
                    <h1 class="m-0"> <sup> &#8377</sup> <?php  echo $monthly_ema = number_format($scheme_details['ema']); ?></h1>
                    <p class="mt-2 m-0  text-muted">PER MONTH</p>
                </div>
            </div>

            <div class="col-12 duration_portion">
                <div class="d-flex justify-content-between px-3">
                    <h5> Duration : <?php echo $scheme_details['scheme_duration']; ?> Mon</h5>
                    <h5> Paid : <?php echo $paid; ?> Mon</h5>
                </div>
            </div>

            <div class="col-12 bottom_portion mt-3">
                <div class="text-center">
                    
                    <h4> Amount to be paid this Month :</h4>
                     
                    <h2 class="mt-3" >&#8377
                        <strong>
                            <?php  

                            /*
                                $month = date("m");
                                $year = date("Y");
                                $find_paid = mysqli_query($conlink, "SELECT * FROM all_transactions WHERE all_scheme_id = '$allschemeid' AND pay_month = '$month'")  ;
                                
                                if(mysqli_num_rows($find_paid) > 0){
                                
                                    $find_paid = mysqli_query($conlink, "SELECT SUM(transaction_amount) FROM all_transactions WHERE all_scheme_id = '$allschemeid' AND pay_month = '$month' AND pay_year = '$year'");
                                    foreach($find_paid as $total_amount){
                                        $amount_paid = $total_amount['SUM(transaction_amount)'];
                                    }
                                    echo  number_format($amounttopay = $ema - $amount_paid);
                                }
                                else{
                                    echo  $ema;
                                }
                            */

                            $today_date = date("Y-m-d");

                            $new_join =  new DateTime($join_date);
                            $new_end =  new DateTime($today_date);
    
                            $final_array = array();
    
                            for($var = $new_join; $var <= $new_end; $var->modify('+1 month')){
    
    
                                $paymonth = $var->format("m");
                                $payyear  = $var->format("Y");
                                $monthname = $var->format("M");
                                
                                $find_payment = mysqli_query($conlink, "SELECT SUM(transaction_amount) FROM all_transactions WHERE all_scheme_id = '$allschemeid' AND pay_month = '$paymonth' AND pay_year = '$payyear'");
    
                                while($find_pay = mysqli_fetch_array($find_payment)){
    
                                    $paid_amount = $find_pay['SUM(transaction_amount)']; 
    
                                    if($paid_amount == null){
                                        $status = 'Not Paid';
                                    }
                                    elseif($paid_amount < $ema){
                                        $status =  "not fully paid";
                                    }
                                    else{
                                        $status = "paid";
                                    }
    
                                    $balance = $ema -$paid_amount;
    
                                    $new_array = array('month' => $monthname, 'sum' => $paid_amount, 'status' => $status,'balance' => $balance);
    
                                }
    
                                array_push($final_array, $new_array);
    
                            }
    
                            
                            $newbalance = 0;
                            foreach($final_array as $finals=>$value){
                                $newbalance+= $value['balance'];
                            }
                            
    
                            echo $newbalance;





                            
                        ?>

                        </strong>
                        /-
                    </h2>  



                    <button class="btn btn-join btnjoin_scheme w-75">Pay Now</button>
                </div>
            </div>


        </div>


        <div id="joincard" class="card card-body plan_join mb-5" style="display: none;">


            <form action="" id="payment_form" enctype="multipart/form-data" novalidate>

             
                <div id="Select_input">
                    <label for="#Select_scheme" class="form-label">Current Scheme</label>
                    <select name="all_scheme" id="Select_scheme" class="form-select" style="pointer-events: none;background-color:#d3d3d3;">
                        <?php 
                        
                            $fetch_schemes = mysqli_query($conlink, "SELECT * FROM all_schemes a INNER JOIN scheme_master s ON a.scheme_id = s.scheme_id WHERE a.cust_id = '$user_id' AND a.scheme_status = '0' AND a.allscheme_id = '$allschemeid'");
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
        //show payment card
        $('.btnjoin_scheme').click(function(){
            $('#joincard').show();
            
        });


        //change custom amount
        $('#custom_amount').change(function(){
            var custom_amount = $(this).val();
            $('#Pay_final').val(custom_amount);
        });


        //reload page
        $('#success_button').click(function(){
            location.reload();
        });


        //get all details
        var scheme_id = $('#Select_scheme').val();
        //console.log(scheme_id);
        get_details(scheme_id);



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
                        $('#joincard').hide();
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