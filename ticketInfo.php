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

    $ticketID = $_GET['ticketID'];
    $ticketData = getTicket($conn, $ticketID);
    $ticketRow = mysqli_fetch_assoc($ticketData);
    $projectData = getProject($conn, $ticketRow['ticketsProjectID']);
    $projectRow = mysqli_fetch_assoc($projectData);;
?>

<section class='container'>
    <h4 class="pt-2 mx-2 mb-3" style="border-bottom: 2px solid #94cc6c; width:max-content"><?= $projectRow['projectsName']?></h4>
    <div class="container w-90 mt-2 p-0 border border-dark shadow rounded">

        <div class="container border-dark border-bottom p-1 d-flex justify-content-between align-items-center">
            <h4 class="mt-2">Ticket Information</h4>
        </div>


        <div class="container p-1 px-0">
            <div class="container p-1 border-bottom border-light">
                <h5 class="mb-1 mt-2">Ticket</h5>
                <p class='text-muted px-1 my-1'><?= $ticketRow['ticketsTitle'];?></p>
            </div>

            <div class="container p-1 border-bottom border-light">
                <h5 class="mb-1 mt-2">Author</h5>
                <p class='text-muted px-1 my-1'><?= getUsername($conn, $ticketRow['ticketsAuthorID']);?></p>
            </div>

            <div class="container p-1 border-bottom border-light">
                <h5 class="mb-1 mt-2">Description</h5>
                <p class='text-muted px-1 my-1'><?= $ticketRow['ticketsDescription'];?></p>
            </div>

            <div class="container px-1 py-1 bg-light">
                <div class="container p-1">
                    <h5 class="mb-1 mt-2">Status</h5>
                    <p><span class="p-1 rounded" style="background-color: #94cc6c; text-transform: capitalize;"><?= $ticketRow['ticketsStatus'];?></span></p>
                </div>

                <div class="container p-1">
                    <h5 class="mb-1 mt-2">Priority</h5>
                    <p><span class="p-1 rounded" style="background-color: #94cc6c; text-transform: capitalize;"><?= $ticketRow['ticketsPriority'];?></span></p>
                </div>

                <div class="container p-1">
                    <h5 class="mb-1 mt-2">Type</h5>
                    <p><span class="p-1 rounded" style="background-color: #94cc6c; text-transform: capitalize;"><?= $ticketRow['ticketsType'];?></span></p>
                </div>
            </div>
            
            <div class="container p-1 border-bottom border-light">
                <p class="mb-1 mt-2">Time Estimate(Hours)</p>
                <p class='text-muted px-1 my-1'><?= $ticketRow['ticketsEstimate'];?></p>
            </div>

            <div class="container p-1 border-bottom border-light">
                <p class="mb-1 mt-2">Assigned Members</p>
                <?php
                    $memberData = getMembersOnProject($conn, $ticketRow['ticketsProjectID']);

                    if(mysqli_num_rows($memberData) == 0){
                        echo "<p class='text-muted px-1 my-1'>No active Members</p>";
                    }

                    while($memberRow = mysqli_fetch_assoc($memberData)){
                        echo "<p class='text-muted px-1 my-1'>" .getUsername($conn, $memberRow['usersProjectsUserID']). "</p>";
                    }
                ?>
                
            </div>

            <div class="container p-1 border-bottom border-light">
                <p class="mb-1 mt-2">Created</p>
                <p class='text-muted px-1 my-1'><small><?= getTicketTime($conn, $ticketRow['ticketsTime']);?></small></p>
            </div>

            <div class='container p-1 d-flex justify-content-between'>
                <button class='btn btn--edit-ticket' style='background-color:#94cc6c;' data-bs-toggle="modal" data-bs-target="#reg-modal">Edit Ticket</button>
                <form action="includes/ticketInfo.inc.php" method="POST" class=''>
                    <input type="hidden" name='ticketID' value=<?= $ticketRow['ticketsID'];?>>
                    <input type="hidden" name='projectID' value=<?= $ticketRow['ticketsProjectID'];?>>
                    <button class='btn' style='background-color:#94cc6c;' name='delete'>Delete Ticket</button>
                </form>
            </div>
            
        </div>
    </div>

    <!-- ADD TICKET MODAL FORM -->
    <?php require_once 'components/EditTicketModal.php'; ?>
</section>

<?php require_once 'components/Footer.php'; ?>