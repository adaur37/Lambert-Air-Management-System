<?php require_once("../view/header.php"); ?>

<?php
    if (session_id() != "")
    { session_destroy(); }
?>
<script> alert("User Log Out Successful."); window.location = "http://localhost/LAMS_SE/"; </script>