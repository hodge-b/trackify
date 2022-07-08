<?php require_once 'components/Header.php'; ?>

<section class="p-3">
    <div class="container text-center mb-5">
        <h1 class='border-bottom p-1'>Trackify</h1>
        <h4>Bug Tracker</h4>
    </div>
    
    <div class="container p-2 border rounded">
        <form class='' action="includes/login.inc.php" method="POST" >
            <div class="form-group mb-3">
                <label class="form-label" id='email-input'>Email address</label>
                <input class='form-control' type="email" id='email-input' name='email' placeholder='email'>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" id='password-input'>Password</label>
                <input class='form-control' type="password" name='password' id='password-input' placeholder='password'>
            </div>
                
            <div class="form-group d-flex justify-content-evenly">
                <button class='btn' style='background-color:#94cc6c;' type='submit' name='submit'>Login</button>
                <button class='btn' style='background-color:#94cc6c;' type='register' name='register'>Register</button>
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
            echo '<p class="mt-2 text-center" style="color: black;">Login or Register</p>';
        }
    ?>
</section>

<?php require_once 'components/Footer.php'; ?>