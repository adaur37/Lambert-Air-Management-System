<?php include_once('../view/header.php'); ?>
<main>
    <h1>Database Error</h1>
    <p class="first_paragraph">There was an error connecting to the database.</p>
    <p>The database must be installed as described in the documentation.</p>
    <p>MySQL must be running.</p>
    <p class="last_paragraph">Error message: <?php echo $error_message; ?></p>
    <br>
</main>
<?php include_once('../view/footer.php'); ?>