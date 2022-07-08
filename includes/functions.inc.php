<?php

// ---- USER FUNCTIONS ---- //

function userExists($conn, $email){
    $query = "SELECT * FROM users WHERE usersEmail = ?;";
    
    $statement = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($statement, $query)){
        header('location: ../login.php?error=stmtfailed');
        exit();
    }

    mysqli_stmt_bind_param($statement, 's', $email);
    mysqli_stmt_execute($statement);
    $resultData = mysqli_stmt_get_result($statement);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }else{
        return false;
    }

    mysqli_stmt_close($statement);
}

function addMember($conn, $firstName, $lastName, $email, $password, $phone, $authorization, $startDate){
    $query = "INSERT INTO users(usersFirstName, usersLastName, usersEmail, usersPassword, usersPhone, usersAuthorization, usersStartDate) VALUES (?,?,?,?,?,?,?)";

    $statement = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($statement, $query)){
        header('location: ../administration.php?error=stmtfailed');
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($statement, 'sssssis', $firstName, $lastName, $email, $hashedPassword, $phone, $authorization, $startDate);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);

    header('location: ../administration.php?error=none');
    exit();
}

function editMember($conn, $userID, $firstName, $lastName, $email, $phone, $auth){
    $query = "UPDATE users SET `usersFirstName` = ?, `usersLastName` = ?, `usersEmail` = ?, `usersPhone` = ?, `usersAuthorization` = ? WHERE usersID = $userID";

    $statement = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($statement, $query)){
        header('location: ../administration.php?error=stmtfailed');
        exit();
    }

    mysqli_stmt_bind_param($statement, 'ssssi', $firstName, $lastName, $email, $phone, $auth);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);

    header('location: ../administration.php');
    exit();
}

function getAllUsers($conn){
    return mysqli_query($conn, "SELECT * FROM users");
}

function getUsername($conn, $userID){
    $query = "SELECT usersFirstName, usersLastName FROM users WHERE usersID = $userID";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['usersFirstName'] . ' ' . $row['usersLastName'];
}

function getUser($conn, $userID){
    $query= "SELECT * FROM users WHERE usersID = $userID";
    return mysqli_query($conn, $query);
}

function getMembersOnProject($conn, $projectID){
    $query = "SELECT * FROM usersProjects WHERE usersProjectsProjectID = $projectID";
    return mysqli_query($conn, $query);
}

function addMembersToProject($conn, $userID, $projectID){
    $query= "INSERT INTO usersProjects(usersProjectsUserID, usersProjectsProjectID) VALUES(?,?)";

    $statement = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($statement, $query)){
        header('location: ../projects.php?projectID='.$projectID);
        exit();
    }

    mysqli_stmt_bind_param($statement, 'ii', $userID, $projectID);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);

    header('location: ../projects.php?projectID='.$projectID);
    exit();
}

function deleteMemberFromProject($conn, $userID, $projectID){
    $query = "DELETE FROM usersProjects WHERE usersProjectsUserID = $userID AND usersProjectsProjectID = $projectID";
    mysqli_query($conn, $query);
    mysqli_close($conn);

    header('location: ../projects.php?projectID='.$projectID);
    exit();
}



// ---- LOGIN FUNCTIONS ---- //

function loginUser($conn, $email, $password){

    $userExists = userExists($conn, $email, $username);
    if($userExists === false){
        header('location: ../login.php?error=!userexists');
        exit();
    }

    $hashedPassword = $userExists['usersPassword'];
    $checkPassword = password_verify($password, $hashedPassword);
    //$checkPassword = $password === $hashedPassword ? true : false;

    if($checkPassword === false){
        header('location: ../login.php?error=invalidcredentials');
        exit();
        
    }else if($checkPassword === true){
        session_start();
        $_SESSION['userID'] = $userExists['usersID'];
        $_SESSION['userEmail'] = $userExists['usersEmail'];
        $_SESSION['userAdmin'] = $userExists['usersAuthorization'];

        header('location: ../index.php');
        exit();
    }

}



// ---- PROJECT FUNCTIONS ---- //

function getTotalRows($conn, $table){
    $result = mysqli_query($conn, "SELECT * FROM $table");
    return mysqli_num_rows($result);
}

function addProject($conn, $name, $description, $contributorID, $ticketsID, $commentsID){
    $query = "INSERT INTO projects(projectsName, projectsDescription, projectsContributorID, projectsTicketsID, projectsCommentsID) VALUES (?,?,?,?,?)";
    
    $statement = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($statement, $query)){
        header('location: ../index.php?error=stmtfailed');
        exit();
    }

    mysqli_stmt_bind_param($statement, 'ssiii', $name, $description, $contributorID, $ticketsID, $commentsID);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);

    header('location: ../index.php?error=none');
    exit();
}

function deleteProject($conn, $projectID){
    $query = "DELETE FROM projects WHERE projectsID = $projectID";
    mysqli_query($conn, $query);
    mysqli_close($conn);

    header('location: ../index.php');
    exit();
}

function getProject($conn, $projectID){
    return mysqli_query($conn, "SELECT * FROM projects WHERE projectsID = $projectID");
}

function getProjects($conn){
    return mysqli_query($conn,"SELECT * FROM projects");
}

// ---- TICKETS FUNCTIONS ---- //

function addTicket($conn, $projectID, $authorID, $title, $description, $assignDevsID, $estimate, $type, $priority, $status){

    $query = "INSERT INTO tickets(ticketsProjectID, ticketsAuthorID, ticketsTitle, ticketsDescription, ticketsAssignDevsID, ticketsEstimate, ticketsType, ticketsPriority, ticketsStatus, ticketsDateCreated, ticketsTime) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
    $time = time();
    $date = date('Y-m-d');

    $statement = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($statement, $query)){
        header('location: ../index.php?error=stmtfailed');
        exit();
    }

    mysqli_stmt_bind_param($statement, 'iississssss', $projectID, $authorID, $title, $description, $assignDevsID, $estimate, $type, $priority, $status, $date, $time);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);

    header('location: ../projects.php?projectID='.$projectID);
    exit();
}

function getTicket($conn, $ticketID){
    $query = "SELECT * FROM tickets WHERE ticketsID = $ticketID";
    return mysqli_query($conn, $query);
}

function getTicketsFromProject($conn, $projectID){
    $query = "SELECT * FROM tickets WHERE ticketsProjectID = $projectID";
    return mysqli_query($conn, $query);
}

function getTicketsFromUser($conn, $userID){
    $query= "SELECT * FROM tickets WHERE ticketsAuthorID = $userID";
    return mysqli_query($conn, $query);
}

function editTicket($conn, $ticketID, $projectID, $title, $description, $assign, $estimate, $type, $priority, $status){
    $query = "UPDATE `tickets` SET `ticketsTitle`= '$title', `ticketsDescription` = '$description', `ticketsAssignDevsID` = '$assign', `ticketsEstimate` = '$estimate', `ticketsType` = '$type', `ticketsPriority` = '$priority', `ticketsStatus` = '$status' WHERE ticketsID = $ticketID";
    mysqli_query($conn, $query);

    header('location: ../projects.php?projectID='.$projectID);
    exit();
}

function deleteTicket($conn, $ticketID, $projectID){
    $query = "DELETE FROM tickets WHERE ticketsID = $ticketID";

    mysqli_query($conn, $query);
    mysqli_close($conn);

    header('location: ../projects.php?projectID='.$projectID);
    exit();
}

// ---- COMMENTS FUNCTIONS ---- //

function addComment($conn, $projectID, $authorID, $comment){
    
    $query = 'INSERT INTO comments(commentsProjectID, commentsRowID, commentsAuthorID, commentsComment, commentsTime) VALUES(?,?,?,?,?)';
    $commentRowCount = getCommentRowCount($conn, $projectID) + 1;
    $time = time();
    $date = date('Y-m-d');

    $statement = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($statement, $query)){
        header('location: ../index.php?error=stmtfailed');
        exit();
    }

    mysqli_stmt_bind_param($statement, 'iisss', $projectID, $commentRowCount, $authorID, $comment, $time);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);

    header("location: ../projects.php?projectID=" .$projectID);
    exit();
}

function getComments($conn, $projectID){
    $query = "SELECT * FROM comments WHERE commentsProjectID = $projectID";
    return mysqli_query($conn, $query);
}

function getCommentRowCount($conn, $projectID){

    if($rows = mysqli_query($conn, "SELECT * FROM comments WHERE commentsProjectID = $projectID")){
        return mysqli_num_rows($rows);
    }else{
        return 0;
    }
}

// ---- ERROR FUNCTIONS ---- //

function emptyLoginInput($username, $password){
    return empty($username) || empty($password) ? true : false;
}
function emptyAddProjectInput($name, $description){
    return empty($name) || empty($description) ? true : false;
}
function emptyAddMemberInput($firstName, $lastName, $email, $password, $phone){
    return empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($phone) ? true : false;
}
function emptyAddTicketInput($title, $description, $estimate){
    return empty($title) || empty($description) || empty($estimate) ? true : false;
}

// ---- UTILITY FUNCTIONS ---- //

function getCommentTime($conn, $seconds){
    $time = time();
    $difference = $time - intval($seconds);

    if($difference >= 604800){
        return floor($difference / 604800) . " weeks ago.";
    }else if($difference <= 604800 && $difference >= 86399){
        if(floor($difference / 86400) == 1){
            return floor($difference / 86400) . " day ago.";
        }else{
            return floor($difference / 86400) . " days ago.";  
        }
    }else if($difference <= 86399 && $difference >= 3600){
        return floor($difference / 3600) . " hours ago.";
    }else if($difference <= 3599 && $difference >= 60){
        return floor($difference / 60) . " mins ago.";
    }else{
        return $difference . " seconds ago.";
    }
}

function getTicketTime($conn, $seconds){
    $time = time();
    $difference = $time - intval($seconds);

    if($difference >= 604800){
        return floor($difference / 604800) . " weeks ago.";
    }else if($difference <= 604800 && $difference >= 86399){
        if(floor($difference / 86400) == 1){
            return floor($difference / 86400) . " day ago.";
        }else{
            return floor($difference / 86400) . " days ago.";  
        }
    }else if($difference <= 86399 && $difference >= 3600){
        return floor($difference / 3600) . " hours ago.";
    }else if($difference <= 3599 && $difference >= 60){
        return floor($difference / 60) . " mins ago.";
    }else{
        return $difference . " seconds ago.";
    }
}