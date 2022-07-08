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

    $userID = $_GET['userID'];
    $userData = getUser($conn, $userID);
    $userRow = mysqli_fetch_assoc($userData);
?>

<section class='container'>
    <div class="container w-90 mt-2 p-0 border border-dark shadow rounded">
        <div class="container border-dark border-bottom p-1 d-flex justify-content-between align-items-center">
            <h4 class="mt-2 " style='border-bottom: 2px solid #94cc6c;'>Member Information</h4>
        </div>

        <div class="container p-1 px-0">
            <div class="container p-1 border-bottom border-light">
                <h5 class="mb-1 mt-2">First Name</h5>
                <p><?= $userRow['usersFirstName'];?></p>
            </div>

            <div class="container p-1 border-bottom border-light">
                <h5 class="mb-1 mt-2">Last Name</h5>
                <p><?= $userRow['usersLastName'];?></p>
            </div>

            <div class="container p-1 border-bottom border-light">
                <h5 class="mb-1 mt-2">Phone</h5>
                <p><?= $userRow['usersPhone'];?></p>
            </div>

            <div class="container p-1 border-bottom border-light">
                <h5 class="mb-1 mt-2">Email</h5>
                <p><?= $userRow['usersEmail'];?></p>
            </div>

            <div class="container p-1">
                <h5 class="mb-1 mt-2">Role</h5>
                <p><?= $userRow['usersAuthorization'] == 1 ? "Administrator" : "Developer"; ?></p>
            </div>

            <button class='btn mx-1 my-1' style='background-color: #94cc6c;' data-bs-toggle="modal" data-bs-target="#edit-member-modal">Edit Member</button>
        </div>
    </div>

    <!-- ADD TICKET MODAL FORM -->
    <?php require_once 'components/EditTicketModal.php'; ?>
    <?php require_once 'components/EditMemberModal.php'; ?>
</section>

<?php require_once 'components/Footer.php'; ?>