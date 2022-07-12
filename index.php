<?php
    session_start();
    if(!isset($_SESSION['userID'])){
        header('location: login.php');
        exit();
    }

    require_once 'components/Header.php';
    echo '<div class="container w-100 p-1 border-bottom d-flex justify-content-between align-items-center">';
    echo "<p class='m-0'>User: ".$_SESSION['userEmail']."</p>";
    echo "<a class='btn' style='background-color:#94cc6c;' href='includes/logout.inc.php'>Logout</a>";
    echo "</div>";
    require_once 'components/Navigation.php';
    require_once 'includes/functions.inc.php';
    require_once 'includes/dbh.inc.php';
?>

<section class='container'>
    <div class="container w-90 mt-2 p-0 shadow rounded">
        <div class="container border-dark border-bottom p-1 d-flex justify-content-between align-items-center">
            <h4 class='mt-2'>Projects</h4>
            <button class='btn btn--new-project' style='background-color:#94cc6c;' data-bs-toggle="modal" data-bs-target="#reg-modal">New Project</button>
        </div>
        <?php
            $result = getProjects($conn);

            while($row = mysqli_fetch_assoc($result)){
                $encodedUrl = 'projects.php?projectID='.urlencode(base64_encode($row['projectsID']));

                echo "<a class='text-decoration-none text-dark' href=$encodedUrl ><div class='container w-100 m-0 px-2 border-bottom'>";
                echo "<h5 class='mt-2 mb-1'>" .$row['projectsName']. "</h5>";
                echo "<p class='mb-2'>Author: " .getUserName($conn, $row['projectsContributorID']). "</p>";
                echo "</div></a>";
            }
            echo "<p class='py-2 pt-2 mb-0 bg-light text-dark text-center rounded-bottom'>Results: " .mysqli_num_rows($result). "</p>";
        ?>
    </div>
    
    <!-- IMPLEMENT AT A LATER TIME -->
    <!--<div class='index-section-stats-card-wrapper'>
        <h4>Stats</h4>
    </div>-->

    <!-- CREATE PROJECT MODAL -->
    <?php require_once 'components/CreateProjectModal.php'; ?>
    
</section>
<?php require_once 'components/Footer.php'; ?>