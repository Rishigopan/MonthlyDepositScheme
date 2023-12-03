


<?php

    include './MAIN/Dbconfig.php';

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/5914a243cf.js" crossorigin="anonymous"></script>

    <title>Sign up</title>

    <style>
        body {
            background-color: #FF6464;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
        }
        
        #main_box {
            min-height: 500px;
            max-width: 800px;
            width: 100%;
            background: white;
            border: none;
            border-radius: 0px;
        }
        
        #first_box {
            align-items: center;
            display: flex;
            height: 500px;
        }
        
        #second_box {
            min-height: 500px;
            background-color: #EEEEEE;
            justify-content: center;
        }
        
        #second_box form {
            margin-top: 75px;
        }
        
        #signupform input {
            border: none !important;
            background-color: #EEEEEE !important;
            border-bottom: 2px solid #FF6464 !important;
            border-radius: 0px !important;
        }
        
        .input-group i {
            color: #FF6464;
        }
        
        #second_box p a {
            text-decoration: none;
            color: #FF6464;
        }
        
        #second_box button {
            background-color: #FF6464;
            color: white;
        }
        
        #login {
            background-color: #FF6464;
            color: white;
        }
    </style>
</head>

<body>
    <div id="main_box" class="card card-body shadow p-0">
        <div class="row g-0">
            <div id="first_box" class="col-7 d-none  d-md-flex">
                <img src="./Tiny technicians repairing smartphone.jpg" class="img-fluid" alt="">
            </div>
            <div id="second_box" class="col-md-5 col-12">
                <form action="" id="signupform" class="px-3" >
                    <h3 class="mb-4">Sign up</h3>
                    <div class="input-group mb-3">
                        <span style="position:absolute; margin-left: 10px; margin-top:6px; z-index: 99;">
                            <i class="fas fa-at fa-sm"></i>
                        </span>
                        <input type="text" name="phone_number" class="form-control shadow-none" placeholder="Enter Phone Number" style="padding-left: 35px;" required>
                    </div>
                    <div class="input-group mb-3">
                        <span style="position:absolute; margin-left: 10px; margin-top:6px; z-index: 99;">
                            <i class="fas fa-key fa-sm"></i>
                        </span>
                        <input type="password" name="password" class="form-control shadow-none" placeholder="Enter Password" style="padding-left: 35px;" required>
                    </div>
                    
                    <div id="message">

                    </div>
                    <button id="signup" class="btn mt-3" type="submit" style="width:100%">Create Account</button>

                    <p class="mt-3">Already have an account? <a href="login.php">Login</a></p>
                </form>


                <form action="" id="joinform" class="px-3 mb-5" style="display: none;"  enctype="multipart/form-data" novalidate>

                    <div class="row">

                        <div class="col-md-6 col-12">
                            <h5 class="text-center">Personal Details</h5>
                            
                            <input type="text" name="cust_id" id="Cust_id" hidden>
                            <div class="col-12">
                                <label for="First_name" class="form-label">First Name <span>*</span> </label>
                                <input type="text" class="form-control" name="first_name" id="First_name" placeholder="First Name" data-v-min="3" data-v-max="8" data-v-message="between 3 and 8 characters" required>
                            </div>
                            <div class="col-12 mt-2">
                                <label for="Last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="last_name" id="Last_name" placeholder="Last Name" >
                            </div>
                            <div class="col-12 mt-2">
                                <label for="Emailid" class="form-label">Email ID</label>
                                <input type="text" class="form-control" name="emailid" id="Emailid" placeholder="Email" required> 
                            </div>
                            <div class="col-12 d-flex mt-3">
                                <div class="form-check me-4" >
                                    <input class="form-check-input" value="male" type="radio" name="gender" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Male
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" value="female" type="radio" name="gender" id="flexRadioDefault2" >
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Female
                                    </label>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-6 col-12">
                            <h5 class="text-center mt-3 mt-md-0">Contact Details</h5>
                            <div class="col-12">
                                <label for="Address_cust" class="form-label">Address  </label>
                                <textarea class="form-control" name="address_cust" id="Address_cust" cols="30" rows="2" placeholder="Address"></textarea>
                            </div>

                            <div class="col-12 mt-2">
                                <label for="State" class="form-label">State <span>*</span> </label>
                                <select name="state" class="form-select" id="State" required >
                                    <option value="" hidden>Choose...</option>
                                    <option value="Kerala">Kerala</option>
                                    <option value="Kerala">Tamilnadu</option>
                                </select>
                            </div>
                            <div class="col-12 mt-2">
                                <label for="City" class="form-label">City</label>
                                <input type="text" class="form-control" name="city" id="City" data-v-min="3" data-v-max="12" data-v-message="between 3 and 12 characters" placeholder="City" required>
                            </div>
                            <div class="col-12 mt-2">
                                <label for="Pincode" class="form-label">Pincode</label>
                                <input type="number" class="form-control" name="pincode" id="Pincode" placeholder="Pincode" data-v-min-length="6"  data-v-max-length="6" data-v-message="Use valid pincode" required>
                            </div>
                            

                        </div>

                       
                        <div class="col-12 text-center mt-3">
                            <button class="btn btn-join w-75">Finish</button>
                        </div>
                      
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@emretulek/jbvalidator"></script>

    <script>
        $(document).ready(function(){


            $('#signupform').submit(function(e){
                e.preventDefault();
                var form = $(this).serializeArray();
                //console.log(form);
                $.post(
                    "signup_verify.php",
                    form,
                    function(form){
                        $('#message').show();
                        console.log(form);
                        // $('#btn_submit').hide();
                        $('#message').html(form);
                        var response = JSON.parse(form);
                        if(response.success == "1"){
                            $('#signupform').hide();
                            $('#Cust_id').val(response.reg_id);
                            $('#joinform').show();
                        }
                        else if(response.success == "2"){
                            $('#message').html("Some Error Occured!");
                        }
                        else if(response.success == "0"){
                           $('#message').html("Account Already Exists");
                           
                        }
                        else{

                        }
                    }
                );
            });

            /* Update Customer details Start */
                $(function(){

                    let validator = $('#joinform').jbvalidator({
                        language: 'dist/lang/en.json',
                        successClass:false,
                        html5BrowserDefault: true
                    });

                    validator.validator.custom = function(el, event){
                        if($(el).is('#First_name,#City,#Pincode') && $(el).val().trim().length == 0){
                            return 'Cannot be empty';
                        }
                    }

                    $(document).on('submit', '#joinform',(function(e){
                        e.preventDefault();
                        var joindata = new FormData(this);
                        console.log(joindata);
                        $.ajax({
                            type:"POST",
                            url:"signup_verify.php",
                            data:joindata,
                            beforeSend:function(){
                                $('#joinform').addClass("disable");
                            },
                            success:function(data){
                                console.log(data);
                                $('#joinform').removeClass("disable");
                                var response = JSON.parse(data);
                                if(response.updatecust == "1"){
                                    location.href = "newplans.php"; 
                                }
                                else if(response.updatecust == "2"){
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
            /* Update Customer details End */
        }); 

    </script>

























    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js " integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM " crossorigin="anonymous "></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js " integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p " crossorigin="anonymous "></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js " integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF " crossorigin="anonymous "></script>
    -->
</body>


















</html>