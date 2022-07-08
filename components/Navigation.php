<?php require_once 'includes/functions.inc.php'; ?>

<nav class='border-bottom mt-2'>
    <ul class='d-flex justify-content-evenly align-items-center list-unstyled px-3 py-1'>
        <?= $_SERVER['PHP_SELF'] == '/trackify02/index.php'? 
            '<li style="border-bottom: 2px solid #94cc6c"><a class="text-decoration-none text-dark" href="index.php">Dashboard</a>' :
            '<li style="border-bottom: none"><a class="text-decoration-none text-dark" href="index.php">Dashboard</a>' ; 
        ?>
        <?= $_SERVER['PHP_SELF'] == '/trackify02/tickets.php'? 
            '<li style="border-bottom: 2px solid #94cc6c"><a class="text-decoration-none text-dark" href="index.php">Tickets</a>' :
            '<li style="border-bottom: none"><a class="text-decoration-none text-dark" href="tickets.php">Tickets</a>' ; 
        ?>
        <?= $_SESSION['userAdmin']? $_SERVER['PHP_SELF'] == '/trackify02/administration.php'? 
            '<li style="border-bottom: 2px solid #94cc6c"><a class="text-decoration-none text-dark" href="administration.php">Administration</a>' :
            '<li style="border-bottom: none"><a class="text-decoration-none text-dark" href="administration.php">Administration</a>' : ''; 
        ?>
    </ul>
</nav> 