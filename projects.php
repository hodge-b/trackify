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


    $projectID            = $_GET['projectID'];

    $commentResultData    = getComments($conn, $projectID);
    $ticketResultData     = getTicketsFromProject($conn, $projectID);
    $membersOnProjectData = getMembersOnProject($conn, $projectID);

    $projectResultData    = getProject($conn, $projectID);
    $projectRow           = mysqli_fetch_assoc($projectResultData);
?>

<section class='container'>
    <h4 class='pt-2 mx-2 mb-3' style="border-bottom: 2px solid #94cc6c; width:max-content"><?= $projectRow['projectsName']; ?></h4>
    
    <!-- TEAM MEMBERS SECTION -->
    <div class="container w-90 my-2 mb-4 p-0 border border-dark shadow rounded">

        <div class="container border-dark border-bottom p-1 d-flex justify-content-between align-items-center">
            <h4 class='mt-2'>Team Members</h4>
            <?= $_SESSION['userAdmin'] ? "<button class='btn btn--add-member' style='background-color:#94cc6c;' data-bs-toggle='modal' data-bs-target='#add-member-modal'>Add Member</button>" : ""; ?>
        </div>

        <?php
            if(mysqli_num_rows($membersOnProjectData) == 0){
                echo "<div class='container px-2 border-bottom'>";
                echo "<p class='my-2'>No current members</p>";
                echo "</div>";
            }
            while($memberRow = mysqli_fetch_assoc($membersOnProjectData)){
                $username = getUsername($conn, $memberRow['usersProjectsUserID']);
                echo "<div class='container px-2 border-bottom d-flex justify-content-between align-items-center'>";
                echo "<p class='my-2'>".$username."</p>";

                if($_SESSION['userAdmin']){
                    echo "<form action='includes/deleteMember.inc.php' method='POST'>";
                    echo "<input type='hidden' name='projectID' value='$projectID'>";
                    echo "<input type='hidden' name='userID' value='$memberRow[usersProjectsUserID]'>";
                    echo "<button class='btn' name='delete'><i class='btn ri-close-fill'></i></button>";
                    echo "</form>";
                }
                echo "</div>";
            }
        ?>
        <p class='py-2 pt-2 mb-0 bg-light text-dark text-center rounded-bottom'>Members: <?= mysqli_num_rows($membersOnProjectData); ?></p>
    </div>

    <!-- TICKETS SECTION -->
    <div class="container w-90 my-2 mb-4 p-0 border border-dark shadow rounded">
        <div class="container border-dark border-bottom p-1 d-flex justify-content-between align-items-center">
            <h4 class='mt-2'>Tickets</h4>
            <button class='btn btn--add-ticket' style='background-color:#94cc6c;' data-bs-toggle="modal" data-bs-target="#reg-modal">New Ticket</button>
        </div>
        <?php
            if(mysqli_num_rows($ticketResultData) == 0){
                echo "<div class='container px-2 border-bottom'>";
                echo "<p class='my-2'>No current tickets</p>";
                echo "</div>";
            }
            while($ticketsRow = mysqli_fetch_assoc($ticketResultData)){
                $authorName = getUsername($conn, $ticketsRow['ticketsAuthorID']);

                echo "<a class='text-decoration-none text-dark' href='ticketInfo.php?ticketID=$ticketsRow[ticketsID]'><div class='container w-100 m-0 p-1 border'>";
                echo '<h5 class="my-2">'.$ticketsRow['ticketsTitle'].'</h5>';
                echo '<p class="mb-0">Status:</p>';
                echo '<p class="mb-2 p-1 rounded" style="text-transform: capitalize; background-color: #94cc6c; width: max-content;">'.$ticketsRow['ticketsStatus'].'</p>';
                echo '<p class="mb-0">Priority:</p>';
                echo '<p class="mb-2 p-1 rounded" style="text-transform: capitalize; background-color: #94cc6c; width: max-content;">'.$ticketsRow['ticketsPriority'].'</p>';
                echo '<p class="mt-3 mb-2 text-muted"><small>'.getTicketTime($conn, $ticketsRow['ticketsTime']).'</small></p>';
                echo '</div></a>';
            }
            echo '<p class="py-2 pt-2 mb-0 bg-light text-dark text-center rounded-bottom">Results: '.mysqli_num_rows($ticketResultData).'</p>';
        ?>
    </div>

    <!-- COMMENTS SECTION -->
    <div class="container w-90 my-2 p-0 border border-dark shadow rounded">
        <div class="container border-dark border-bottom p-1 d-flex justify-content-between align-items-center">
            <h4 class='mt-2'>Comments</h4>
        </div>
        <?php
            if(mysqli_num_rows($commentResultData) == 0){
                echo "<div class='container px-2 border-bottom'>";
                echo "<p class='my-2'>No current comments</p>";
                echo "</div>";
            }
            while($commentsRow = mysqli_fetch_assoc($commentResultData)){
                $authorName = getUsername($conn, $commentsRow['commentsAuthorID']);

                echo "<div class='container mt-2 border-bottom'>";
                echo "<p class='px-2 mb-1 text-muted'>".$authorName." -<span class='px-2 text-muted'><small>".getCommentTime($conn, $commentsRow['commentsTime'])."</small></span></p>";
                echo "<p class='px-3'>".$commentsRow['commentsComment']."</p>";
                echo "</div>";
            }
        ?>

        <!-- COMMENTS FORM -->
        <form class='d-flex justify-content-between' action="includes/addComment.inc.php" method='POST'>
            <input class='form-control rounded-0' type="text" name='comment' placeholder='comment'>
            <input type="hidden" name='author' value=<?= $_SESSION['userID']; ?>>
            <input type="hidden" name='projectID' value=<?= $projectRow['projectsID'] ?>>
            <button class='btn btn--add-comment rounded-0' style='background-color:#94cc6c;' name='submit'>Send</button>
        </form>
        <p class="py-2 pt-2 mb-0 bg-light text-dark text-center rounded-bottom"><?= "Comments: " .mysqli_num_rows($commentResultData). "</p>"; ?>
    </div>

    <?php
        if($_SESSION['userAdmin']){
            echo "<form class='mt-5 d-flex justify-content-center' action='includes/deleteProject.inc.php' method='POST'>";
            echo "<input type='hidden' name='projectID' value='$projectRow[projectsID]'>";
            echo "<button class='btn text-center' style='background-color: #94cc6c;' name='delete'>Delete Project</button>";
            echo "</form>";
        }
    ?>

    <!-- ADD MEMBER MODAL FORM -->
    <?php require_once 'components/AddMemberModal.php'; ?>

    <!-- ADD TICKET MODAL FORM -->
    <?php require_once 'components/AddTicketModal.php'; ?>

</section>
<?php require_once 'components/Footer.php'; ?>