
<?php

    include '../MAIN/Dbconfig.php';

    if(isset($_COOKIE['custtypecookie']) && isset($_COOKIE['custidcookie'])){

        if($_COOKIE['custtypecookie'] == 'admin'){

        }
        else{
            header("location:../login.php");
        }
        
    }
    else{

    header("location:../login.php");

    }

?>

<!doctype html>
<html lang="en">

<head>


<?php 

    
    include '../MAIN/Header.php';

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
                        <a href="../Dashboard.php">
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
                        <a href="../signout.php">
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

        


        <div class="card card-body plan_join" id="addscheme_card">

            
            
            <form action="" class="master_form" id="addscheme_form" enctype="multipart/form-data" novalidate>

                <div class="row">

                    <div class="col-md-6 col-12">
                        <h5 class="text-center mb-3">Add Scheme</h5>
                        
                        <div class="col-12">
                            <label for="Scheme_name" class="form-label">Scheme Name <span>*</span> </label>
                            <input type="text" class="form-control" name="scheme_name" id="Scheme_name" placeholder="Scheme Name"  required >
                        </div>
                        <div class="col-12 mt-2">
                            <label for="Scheme_amount" class="form-label">Scheme Amount <span>*</span> </label>
                            <input type="number" class="form-control" name="scheme_amount" id="Scheme_amount" placeholder="Scheme Amount"  required >
                        </div>
                        <div class="col-12 mt-2">
                            <label for="Scheme_duration" class="form-label">Scheme Duration <span>*</span> </label>
                            <input type="number" class="form-control" name="scheme_duration" id="Scheme_duration" placeholder="Scheme Duration"  required >
                        </div>
                        <div class="col-12 mt-2">
                            <label for="Scheme_discount" class="form-label">Scheme Discount </label>
                            <input type="number" class="form-control" name="scheme_discount" id="Scheme_discount" placeholder="Scheme Discount">
                        </div>

                        <div class="col-12 mt-2">
                            <label for="Scheme_description" class="form-label">Address  </label>
                            <textarea class="form-control" name="scheme_description" id="Scheme_description" cols="30" rows="2" placeholder="Enter Scheme Description"></textarea>
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

            /* Add scheme Start */
                $(function(){

                    let validator = $('#addscheme_form').jbvalidator({
                        language: 'dist/lang/en.json',
                        successClass:false,
                        html5BrowserDefault: true
                    });

                    validator.validator.custom = function(el, event){
                        if($(el).is('#Scheme_name,#Scheme_amount,#Scheme_duration') && $(el).val().trim().length == 0){
                            return 'Cannot be empty';
                        }
                    }

                    $(document).on('submit', '#addscheme_form',(function(e){
                        e.preventDefault();
                        var schemedata = new FormData(this);
                        //console.log(schemedata);
                        $.ajax({
                            type:"POST",
                            url:"master_operations.php",
                            data:schemedata,
                            beforeSend:function(){
                                $('#addscheme_card').addClass("disable");
                            },
                            success:function(data){
                                console.log(data);
                                $('#addscheme_card').removeClass("disable");
                                var response = JSON.parse(data);
                                if(response.addscheme == "0"){
                                    toastr.warning("Scheme is Already Present")
                                }
                                else if(response.addscheme == "1"){
                                  toastr.success("Successfully Created Scheme")
                                }
                                else if(response.addscheme == "2"){
                                    toastr.error("Some Error Occured");
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
            /* Add scheme End */
        }); 


        toastr.options = {
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "3000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

    </script>


</body>

</html>