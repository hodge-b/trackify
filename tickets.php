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

    $ticketResultingData = getTicketsFromUser($conn, $_SESSION['userID']);
?>

<section class='container'>
    <div class="container w-90 mt-2 p-0 border border-dark shadow rounded">
        <div class="container border-dark border-bottom p-1 d-flex justify-content-between align-items-center">
            <h4 class='mt-2'>My Tickets</h4>
        </div>
        <?php
            if(mysqli_num_rows($ticketResultingData) == 0){
                echo "<div class='text-decoration-none text-dark'>";
                echo "<p class='p-2'>No active tickets</p>";
                echo "</div>";
            }
            while($ticketsRow = mysqli_fetch_assoc($ticketResultingData)){
                $projectResultData = getProject($conn, $ticketsRow['ticketsProjectID']);
                $projectsRow = mysqli_fetch_assoc($projectResultData);

                echo "<a class='text-decoration-none text-dark' href='ticketInfo.php?ticketID=$ticketsRow[ticketsID]'><div class='container border-bottom py-2'>";
                echo '<h5 class=" mt-3 mb-4">'.$projectsRow['projectsName'].'</h5>';
                echo '<p class=" mb-0">Title: </p>';
                echo '<p class=" mb-2 rounded" style="text-transform: capitalize;">'.$ticketsRow['ticketsTitle'].'</p>';
                echo '<p class=" mb-0">Status: </p>';
                echo '<p class="p-1 mb-2 rounded" style="text-transform: capitalize; background-color: #94cc6c; width: max-content;">'.$ticketsRow['ticketsStatus'].'</p>';
                echo '<p class=" mt-3 mb-1 text-muted"><small>'.getTicketTime($conn, $ticketsRow['ticketsTime']).'</small></p>';
                echo '</div></a>';
            }
            echo '<p class="py-2 pt-2 m-0 bg-light text-dark text-center rounded-bottom">Results: '.mysqli_num_rows($ticketResultingData).'</p>';
        ?>
        
    </div>
</section>

<?php require_once 'components/Footer.php'; ?>