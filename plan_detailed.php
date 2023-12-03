


<?php

    include './MAIN/Dbconfig.php';

    if(isset($_COOKIE['custtypecookie']) && isset($_COOKIE['custidcookie'])){

        $user_id = $_COOKIE['custidcookie'];

        $schemeid = $_GET['scheme_id'];

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

    </style>

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


            <?php

                $fetch_details = mysqli_query($conlink, "SELECT * FROM scheme_master WHERE scheme_id = '$schemeid'");
                foreach($fetch_details as $scheme_details){

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
                        
                        <h1 class="m-0"> <sup> &#8377</sup> <?php  echo $monthly_ema = number_format($scheme_details['scheme_total'] / $scheme_details['scheme_duration']); ?></h1>
                        <p class="mt-2 m-0  text-muted">PER MONTH</p>
                    </div>
                </div>

                <div class="col-12 duration_portion">
                    <div class="text-center">
                        <h5> Duration : <?php echo $scheme_details['scheme_duration']; ?> Months</h5>
                    </div>
                </div>

                <div class="col-12 bottom_portion mt-3">
                    <div class="text-center">
                        <p class="px-3"> <?php echo $scheme_details['scheme_description']; ?> </p>

                        <button class="btn btn-join btnjoin_scheme w-75">Join Scheme</button>
                    </div>
                </div>


            </div>


            <div id="joincard" class="card card-body plan_join mb-5" style="display: none;">


                <form action="" id="joinform" enctype="multipart/form-data" novalidate>

                    <div class="row">

                        <?php 
                        
                            $fetch_userdetails = mysqli_query($conlink, "SELECT * FROM user_details WHERE user_id = '$user_id'");
                            foreach($fetch_userdetails as $user_details){

                            }

                        
                        ?>



                        <div class="col-md-6 col-12">
                            <h5 class="text-center">Personal Details</h5>
                            <input type="text" name="scheme_id" id="Scheme_id" value="<?php echo $schemeid; ?>" hidden>
                            <input type="text" name="cust_id" id="Cust_id" value="<?php echo $user_id; ?>" hidden>
                            <div class="col-12">
                                <label for="First_name" class="form-label">First Name <span>*</span> </label>
                                <input type="text" class="form-control" name="first_name" id="First_name" placeholder="First Name" value="<?php echo $user_details['first_name']; ?>" required disabled>
                            </div>
                            <div class="col-12 mt-2">
                                <label for="Last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="last_name" id="Last_name" placeholder="Last Name" value="<?php echo $user_details['last_name']; ?>" disabled>
                            </div>
                            <div class="col-12 mt-2">
                                <label for="Emailid" class="form-label">Email ID</label>
                                <input type="text" class="form-control" name="emailid" id="Emailid" placeholder="Email" value="<?php echo $user_details['email_id']; ?>" disabled> 
                            </div>
                            <div class="col-12 mt-2">
                                <label for="Mobile" class="form-label">Mobile No <span>*</span> </label>
                                <input type="text" class="form-control" name="mobile" id="Mobile" placeholder="Mobile No" required value="<?php echo $user_details['phone_number']; ?>" disabled>
                            </div>

                        </div>

                        <div class="col-md-6 col-12">
                            <h5 class="text-center mt-3 mt-md-0">Contact Details</h5>
                            <div class="col-12">
                                <label for="Address_cust" class="form-label">Address  </label>
                                <textarea class="form-control" name="address_cust" id="Address_cust" cols="30" rows="2" placeholder="Address" value="<?php echo $user_details['cust_address']; ?>" disabled></textarea>
                            </div>

                            <div class="col-12 mt-2">
                                <label for="State" class="form-label">State <span>*</span> </label>
                                <select name="state" class="form-select" id="State" required disabled>
                                    <option value=""><?php echo $user_details['cust_state']; ?></option>
                                    <option value="Kerala">Kerala</option>
                                    <option value="Kerala">Tamilnadu</option>
                                </select>
                            </div>
                            <div class="col-12 mt-2">
                                <label for="City" class="form-label">City</label>
                                <input type="text" class="form-control" name="city" id="City" placeholder="City" value="<?php echo $user_details['city']; ?>" disabled>
                            </div>
                            <div class="col-12 mt-2">
                                <label for="Pincode" class="form-label">Pincode</label>
                                <input type="text" class="form-control" name="pincode" id="Pincode" placeholder="Pincode" value="<?php echo $user_details['pincode']; ?>" disabled>
                            </div>
                            <div class="col-12 mt-2">
                                <label for="Nominee" class="form-label">Nominee  <span>*</span> </label>
                                <input type="text" class="form-control" name="nominee" id="Nominee" placeholder="Nominee" required>
                            </div>
                            <div class="col-12 mt-2">
                                <label for="Relation" class="form-label">Relationship <span>*</span> </label>
                                <select name="relation" class="form-select" id="Relation" required>
                                    <option value="">Choose...</option>
                                    <option value="Father">Father</option>
                                    <option value="Mother">Mother</option>
                                    <option value="Husband">Husband</option>
                                    <option value="Wife">Wife</option>
                                    <option value="Son">Son</option>
                                    <option value="Daughter">Daughter</option>
                                </select>
                            </div>
                            

                        </div>

                       
                        <div class="col-12 text-center mt-3">
                            <button class="btn btn-join w-75">JOIN NOW</button>
                        </div>
                      
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





    <script src="https://cdn.jsdelivr.net/npm/@emretulek/jbvalidator"></script>

    <script>

        $(document).ready(function(){
            $('.btnjoin_scheme').click(function(){
                $('#joincard').show();
            });
        });

        /* Add Branch Start */
            $(function(){

                let validator = $('#joinform').jbvalidator({
                    language: 'dist/lang/en.json',
                    successClass:false,
                    html5BrowserDefault: true
                });

                validator.validator.custom = function(el, event){
                    if($(el).is('#First_name,#Nominee,#Mobile') && $(el).val().trim().length == 0){
                        return 'Cannot be empty';
                    }
                }

                $(document).on('submit', '#joinform',(function(e){
                    e.preventDefault();
                    var joindata = new FormData(this);
                    console.log(joindata);
                    $.ajax({
                        type:"POST",
                        url:"join_scheme.php",
                        data:joindata,
                        beforeSend:function(){
                            $('#joincard').addClass("disable");
                        },
                        success:function(data){
                            console.log(data);
                            $('#joincard').removeClass("disable");
                            var response = JSON.parse(data);
                            if(response.join_scheme == "1"){
                                toastr.success("You have Joined the Scheme Successfully");
                                $('#joinform')[0].reset();
                                $('#joincard').hide();
                            }
                            else if(response.join_scheme == "0"){
                                toastr.warning("You are Already present in this Scheme");
                            }
                            else{
                                toastr.error("Some Error Occured");
                            }
                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    });
                }));

            });
        /* Add Branch End */


        
    </script>

</body>

</html>