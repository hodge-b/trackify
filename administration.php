<?php
    session_start();
    if(!isset($_SESSION['userID'])){
        header('location: login.php');
        exit();
    }

    require_once 'components/Header.php';
    echo '<div class="container p-1 border-bottom d-flex justify-content-between align-items-center">';
    echo "<p class='m-0'>User: ".$_SESSION['userEmail']."</p>";
    echo "<a class='btn' style='background-color:#94cc6c;' href='includes/logout.inc.php'>Logout</a>";
    echo "</div>";
    require_once 'components/Navigation.php';
    require_once 'includes/functions.inc.php';
    require_once 'includes/dbh.inc.php';
?>

<section class="container">
    <div class="container w-90 mt-2 p-0 border border-dark shadow rounded">
        <div class="container border-dark border-bottom p-1 d-flex justify-content-between align-items-center">
            <h4 class='mt-2'>Organization</h4>
            <button type="button" class='btn btn--new-member' style='background-color:#94cc6c;' data-bs-toggle="modal" data-bs-target="#reg-modal">New Member</button>
        </div>
        <?php

            $resultData = getAllUsers($conn);
            while($row = mysqli_fetch_assoc($resultData)){
                echo "<a class='text-decoration-none text-dark' href='memberInfo.php?userID=$row[usersID]'><div class='container px-2 border-bottom'>";
                echo '<p class="my-2">' .$row['usersFirstName'] . ' ' .$row['usersLastName']. '</p>';
                echo '</div></a>';
            }
            echo '<p class="py-2 pt-2 mb-0 bg-light text-dark text-center rounded-bottom">Members: ' .mysqli_num_rows($resultData). '</p>';

        ?>
    </div>

    <!-- MODAL CARD -->
    <?php require_once 'components/CreateMemberModal.php'; ?>

</section>
<?php require_once 'components/Footer.php'; ?>