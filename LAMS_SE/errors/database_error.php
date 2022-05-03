<?php include_once __DIR__ . '/../view/header.php'; ?>
<main>
    <h1>Database Error</h1>
    <p class="first_paragraph">There was an error connecting to the database.</p>
    <p>The database must be installed as described in the documentation.</p>
    <p>MySQL must be running.</p>
    <p class="last_paragraph">Error message: <?php echo $error_message; ?></p>
    <br>
    <?php
        //Display iframe of the page without any material imports, thereby diabling interaction
        echo ("
            <h2>LOG IN FAILED</h2>
            <span>Wrong username and password combination, here is a preview of what this system looks like, 
                click on the '<< BACK' or 'LOG OUT' buttons to try again:</span>
            <br>
            <img src='../images/product_manager_preview.jfif' />
            <br>"
            );
    ?>
</main>
<?php include_once __DIR__ . '/../view/footer.php'; ?>
