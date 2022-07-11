<?php require_once 'components/Header.php'; ?>

<section class="my-2">
    <div class="text-center mb-5">
        <h1 class='border-bottom py-1'>Trackify</h1>
        <h4>Bug Tracker</h4>
    </div>
    
    <div class="row d-flex justify-content-center">
        <!-- TEAM MEMBERS SECTION -->
        <div class="card col-md-5 w-90 my-2 mb-4 p-0 border border-dark shadow rounded">

            <div class="container border-dark border-bottom p-1 d-flex justify-content-between align-items-center">
                <h4 class='mt-2' style='border-bottom: 2px solid #94cc6c;'>Register</h4>
            </div>

            <form class='container' action="includes/newMember.inc.php" method='POST'>
                        <div class="form-group mt-2 mb-3">
                            <label for="firstname">First Name</label>
                            <input class='form-control' type="text" name='firstname' placeholder='first name'>
                        </div>

                        <div class="form-group my-3">
                            <label for="lastname">Last Name</label>
                            <input class='form-control' type="text" name='lastname' placeholder='last name'>
                        </div>

                        <div class="form-group my-3">
                            <label for="email">Email</label>
                            <input class='form-control' type="email" name='email' placeholder='email'>
                        </div>

                        <div class="form-group my-3">
                            <label for="password">Password</label>
                            <input class='form-control' type="password" name='password' placeholder='password'>
                        </div>

                        <div class="form-group my-3">
                            <label for="phone">Phone</label>
                            <input class='form-control' type="tel" name='phone' placeholder='phone number'>
                        </div>

                        <input type="hidden" name='authorization' value='0'>
                        <div class="d-flex justify-content-center mb-2">
                            <button class='btn' style='background-color:#94cc6c;' name='submit'>Register Account</button>
                        </div>
                    </form>
        </div>

    <?php
        if(isset($_GET['error'])){
            if($_GET['error'] == 'emptyinput'){
                echo '<p class="my-2 text-center" style="color: red;">You must fill in all fields</p>';
            }else if($_GET['error'] == 'invalidcredentials'){
                echo '<p class="my-2 text-center" style="color: red;">Invalid Username/Password</p>';
            }
        }else{
            //echo '<p class="mt-2 text-center" style="color: black;">Login or Register</p>';
        }
    ?>
</section>

<?php require_once 'components/Footer.php'; ?>