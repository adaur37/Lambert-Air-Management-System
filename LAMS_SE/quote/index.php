<?php require_once("../view/header.php"); ?>

<script type="text/javascript">
    function showFormConfirm()
    { alert("Quote Request Submitted.")}
    function showFormDeny()
    { alert("[ERROR] Quote Request did not go through."); }
</script>


<?php
    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL) {
        $action = filter_input(INPUT_GET, 'action');
        if ($action == NULL) {
            
        }
    }  
?>

<main>
    <div class="half-column">
        <h1> Contacting a member of the LAMS team </h1>
        <ul>
            <li>
                <div>
                    <img style='height: 40px;' src='http://localhost/LAMS_SE/images/login-icon.png'/>
                    <span> <b style='color: white;'>Andrew Daur</b> / Project Director </span>
                    <br><p style='padding-left: 60px;' /><span>email: ad1297@usnh.com</span> 
                </div>
            </li>
            <li>
                <div>
                    <img style='height: 40px;' src='http://localhost/LAMS_SE/images/login-icon.png'/>
                    <span> <b style='color: white;'>Matthew Lavin</b> / Developer </span>
                    <br><p style='padding-left: 60px;' /><span>email: matt_lavin9@gmail.com</span> 
                </div>
            </li>
            <li>
                <div>
                    <img style='height: 40px;' src='http://localhost/LAMS_SE/images/login-icon.png'/>
                    <span> <b style='color: white;'>Joshua Snider</b> / Fullstack Developer </span>
                    <br><p style='padding-left: 60px;' /><span>email: joshua_snider42@gmail.com</span> 
                </div>
            </li>
            <li>
                <div>
                    <img style='height: 40px;' src='http://localhost/LAMS_SE/images/login-icon.png'/>
                    <span> <b style='color: white;'>Elvis Foster</b> / Project Director Consultant </span>
                    <br><p style='padding-left: 60px;' /><span>email: elvis_foster88@gmail.com</span> 
                </div>
            </li>
    </div>
    <div class="half-column">
        <form id="quoteRequestForm" style="border-style: solid; border-radius: 10px; border-color: rgb(90,120,255); border-width: thin; padding: 5px;" method="post" action="?action=submit_quote_req">
            <h3 style="border-style: solid; border-color: rgb(0,0,0)"> Request a Quote Today </h3>
            <div> <!-- Table created with div elements -->
                <div style="display:block;">
                    <div style="display: inline-block; width:30%;">
                        <label>*Full Name</label>
                    </div>
                    <div style="display: inline-block; width:65%;">
                        <input name="client_fullname" type='text' placeholder='your name'></input>
                    </div>
                </div>
                <div style="display:block;">
                    <div style="display: inline-block; width:30%;">
                        <label>*Email</label>
                    </div>
                    <div style="display: inline-block; width:65%;">
                        <input name="client_email" type='email' placeholder='your_email@domain.com'></input>
                    </div>
                </div>
                <div style="display:block;">
                    <div style="display: inline-block; width:30%;">
                        <label>*Company</label>
                    </div>
                    <div style="display: inline-block; width:65%;">
                        <input name="client_company" type='text' placeholder='company name'></input>
                    </div>
                </div>
                <div style="display:block;">
                    <div style="display: inline-block; width:30%;">
                        <label>Profile ID</label>
                    </div>
                    <div style="display: inline-block; width:65%;">
                        <input name="client_profile_id" type='text' placeholder=''></input>
                    </div>
                </div>
            </div>
            <br>
            <div style="text-align: right;">
                <input type="submit" value="REQUEST QUOTE"></input>
            </div>
        </form>
    </div>
</main>

<?php
    // FINISH REMAINING OPERATIONS IF APPLICABLE
    if ($action == 'submit_quote_req')
    {
        $client_name = filter_input(INPUT_POST, 'client_fullname');
        $client_email = filter_input(INPUT_POST, 'client_email');
        $client_company = filter_input(INPUT_POST, 'client_company');
        $profile_id = filter_input(INPUT_POST, 'client_profile_id');

        $quote_request = array($client_name, $client_email, $client_company, $profile_id);
        // Fire off quote_request array packed with data via email daemon or other export method
        // Call Javascript to show message.
        echo ("<script type='text/javascript'>showFormConfirm();</script>" );
    }
?>

<?php require_once("../view/footer.php"); ?>