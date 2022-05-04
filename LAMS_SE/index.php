<?php include 'view/header.php'; ?>

<!-- /*/////////////////////////////////////////////////////////////////////////////////////////////////
 * Landing Page : index.php
 * Joshua Snider
 * Apr292022
 * Provides the two main directions the user can take when entering the site, Edit data (after login) via Product Manager, or select and buy items in Product Catalog 
*////////////////////////////////////////////////////////////////////////////////////////////////// -->

<main class="c-services c-services-background">
    <?php // initialize user role storage.
        $UROLE_ID = -1;
        $urole_title = "";
        if ( isset($_SESSION['UROLE_ID']) )
        { $UROLE_ID = $_SESSION['UROLE_ID']; }
    ?>
    <h1 style="display: inline-block; margin-right: 20%;">Menu >> <span style='font-size: 14pt;'>User Tier: </span><span style='font-size: 14pt;' id='access_level'>Unregistered</span></h1> <h2 style="display: inline-block; color: rgb(0,0,0);">Because Bruce Cant Drive.</h2>
    <ul style="width:108%; height: 300px; padding: 0px; overflow-x:auto;"> <!-- https://stackoverflow.com/questions/12802482/javascript-onclick-redirect--> 
        <li id='default_dashboard' class='c-services__item_disable' >
            <p >In/Out Dashboard</p>
            <p style="display:inline-block; width:20px;"></p> <!-- Using as a way to insert specific amount of whitespace -->
        </li>
        <li id='scheduler_dashboard' class='c-services__item_disable' >
            <p >Scheduler Dashboard</p>
            <p style="display:inline-block; width:20px;"></p> <!-- Using as a way to insert specific amount of whitespace -->
        </li>
        <li id='aircontroller_mgmt' class='c-services__item_disable' >
            <p >Manage Traffic</p>
            <p style="display:inline-block; width:20px;"></p> <!-- Using as a way to insert specific amount of whitespace -->
        </li>
        <li id='management_dashboard' class='c-services__item_disable' >
            <p >Management Dashboard</p>
            <p style="display:inline; width:20px;"></p> <!-- Using as a way to insert specific amount of whitespace -->
        </li>
        <li id='admin_flightmgmt' class='c-services__item_disable' >
            <p >Manage ALL [ADMIN]</p>
            <p style="display:inline-block; width:20px;"></p> <!-- Using as a way to insert specific amount of whitespace -->
        </li>
    
        <!-- Select Available Actions based on User Access Level -->
        <?php

            if ( !empty($db) ) // Retrieve Role Title from DB, then use to set controls as 'available' to the user
            {
                try {
                    if ( file_exists('../model/database.php') )
                    { require_once('../model/database.php'); }
                    else
                    { require_once('./model/database.php'); }

                    if ( !empty($db) )
                    {
                        $query = "SELECT role_title FROM user_roles WHERE role_id = '".$UROLE_ID."'";
                        $statement = $db->prepare($query);
                        $statement->execute();
                        $urole_title = $statement->fetch();
                        $statement->closeCursor();

                        $urole_title = $urole_title['role_title'];
                        echo("<script type='text/javascript'> document.getElementById('access_level').innerHTML = '".$urole_title."' </script>");
                    }
                } catch (PDOException $e) {
                    $error_message = $e;
//						$e->getMessage();
                }
            }
            // All levels defined by db-> 'user_roles' table.
            // Basic Access Level
            if ( $UROLE_ID == 0) // I Could be more flexible with this and have a query to check if role_title that matched role_id contains a keywword like 'Default', 'Scheduler', 'Management', 'Admin', etc.
            {
                // Enable Default Dashboard
                echo ("<script type='text/javascript'> 
                    flightmgmt_button = document.getElementById('default_dashboard'); 
                    flightmgmt_button.className = 'c-services__item'; 
                    flightmgmt_button.setAttribute('onclick',"."'window.location = '+".'"'."'./product_manager/default_dashboard.php'".'"'.");
                     </script>"
                    );
            }
            // Scheduler
            else if ( $UROLE_ID == 1)
            {
                // Enable Default Dashboard
                echo ("<script type='text/javascript'> 
                    flightmgmt_button = document.getElementById('default_dashboard'); 
                    flightmgmt_button.className = 'c-services__item'; 
                    flightmgmt_button.setAttribute('onclick',"."'window.location = '+".'"'."'./product_manager/default_dashboard.php'".'"'.");
                     </script>"
                    );

                // Enable Scheduler Dashboard
                echo ("<script type='text/javascript'> 
                    flightmgmt_button = document.getElementById('scheduler_dashboard'); 
                    flightmgmt_button.className = 'c-services__item'; 
                    flightmgmt_button.setAttribute('onclick',"."'window.location = '+".'"'."'./product_manager/scheduler_dashboard.php'".'"'.");
                     </script>"
                    );
            }
            // Air Traffic Controller
            else if ( $UROLE_ID == 2)
            {
                // Enable Default Dashboard
                echo ("<script type='text/javascript'> 
                    flightmgmt_button = document.getElementById('default_dashboard'); 
                    flightmgmt_button.className = 'c-services__item'; 
                    flightmgmt_button.setAttribute('onclick',"."'window.location = '+".'"'."'./product_manager/default_dashboard.php'".'"'.");
                     </script>"
                    );

                // Enable Traffic Controller Dashboard
                echo ("<script type='text/javascript'> 
                    flightmgmt_button = document.getElementById('aircontroller_mgmt'); 
                    flightmgmt_button.className = 'c-services__item'; 
                    flightmgmt_button.setAttribute('onclick',"."'window.location = '+".'"'."'./product_manager/traffic_dashboard.php'".'"'.");
                     </script>"
                    );
            }
            // Management
            else if ( $UROLE_ID == 3)
            {
                // Enable Default Dashboard
                echo ("<script type='text/javascript'> 
                    flightmgmt_button = document.getElementById('default_dashboard'); 
                    flightmgmt_button.className = 'c-services__item'; 
                    flightmgmt_button.setAttribute('onclick',"."'window.location = '+".'"'."'./product_manager/default_dashboard.php'".'"'.");
                     </script>"
                    );

                // Enable Scheduler Dashboard
                echo ("<script type='text/javascript'> 
                    flightmgmt_button = document.getElementById('scheduler_dashboard'); 
                    flightmgmt_button.className = 'c-services__item'; 
                    flightmgmt_button.setAttribute('onclick',"."'window.location = '+".'"'."'./product_manager/scheduler_dashboard.php'".'"'.");
                     </script>"
                    );

                // Enable Traffic Controller Dashboard
                echo ("<script type='text/javascript'> 
                    flightmgmt_button = document.getElementById('aircontroller_mgmt'); 
                    flightmgmt_button.className = 'c-services__item'; 
                    flightmgmt_button.setAttribute('onclick',"."'window.location = '+".'"'."'./product_manager/traffic_dashboardphp'".'"'.");
                     </script>"
                    );

                // Enable Management Dashboard
                echo ("<script type='text/javascript'> 
                flightmgmt_button = document.getElementById('management_dashboard'); 
                flightmgmt_button.className = 'c-services__item'; 
                flightmgmt_button.setAttribute('onclick',"."'window.location = '+".'"'."'./product_manager/management_dashboard.php'".'"'.");
                 </script>"
                );
            }
            // Admin
            else if ( $UROLE_ID == 999)
            {
                // ADMIN PRIVLEDGE, NO LIMIT
                // Enable Default Dashboard
                echo ("<script type='text/javascript'> 
                    flightmgmt_button = document.getElementById('default_dashboard'); 
                    flightmgmt_button.className = 'c-services__item'; 
                    flightmgmt_button.setAttribute('onclick',"."'window.location = '+".'"'."'./product_manager/default_dashboard.php'".'"'.");
                     </script>"
                    );

                // Enable Scheduler Dashboard
                echo ("<script type='text/javascript'> 
                flightmgmt_button = document.getElementById('scheduler_dashboard'); 
                flightmgmt_button.className = 'c-services__item'; 
                flightmgmt_button.setAttribute('onclick',"."'window.location = '+".'"'."'./product_manager/scheduler_dashboard.php'".'"'.");
                 </script>"
                );

                // Enable Traffic Controller Dashboard
                echo ("<script type='text/javascript'> 
                    flightmgmt_button = document.getElementById('aircontroller_mgmt'); 
                    flightmgmt_button.className = 'c-services__item'; 
                    flightmgmt_button.setAttribute('onclick',"."'window.location = '+".'"'."'./product_manager/traffic_dashboard.php'".'"'.");
                     </script>"
                    );

                // Enable Management Dashboard
                echo ("<script type='text/javascript'> 
                flightmgmt_button = document.getElementById('management_dashboard'); 
                flightmgmt_button.className = 'c-services__item'; 
                flightmgmt_button.setAttribute('onclick',"."'window.location = '+".'"'."'./product_manager/manager_dashboard.php'".'"'.");
                 </script>"
                );
                    
                // Enable ADMIN Dashboard
                echo ("<script type='text/javascript'> 
                    flightmgmt_button = document.getElementById('admin_flightmgmt'); 
                    flightmgmt_button.className = 'c-services__item'; 
                    flightmgmt_button.setAttribute('onclick',"."'window.location = '+".'"'."'./product_manager/index.php'".'"'.");
                     </script>"
                    );
            }
        ?>
    </ul>
    <div class="half-column">
        <h1> Why LAMS? </h1>
        <span>Lambert Air Management System aims to manage all your incoming and outgoing flights via a modern software solution.</span>
        <br>
        <span>READY TO DEPLOY NOW!</span> 
        <br>
        <h3> More Benefits Include: </h3>
        <ul>
            <li>
                <img class="home_benefits_img" src="./images/revenue.png" alt="revenue_go_up" />
                <p style="margin-left: 60px;" /><div class="home_benefits_triangle" />
                <div class="home_benefits_text">
                    <span>Increases revenue by increasing efficiency and throughput</span>
                </div>
            </li>
            <li>
                <img class="home_benefits_img" src="./images/time.png" alt="timecost_go_down" />
                <p style="margin-left: 60px;" /><div class="home_benefits_triangle" />
                <div class="home_benefits_text">
                    <span>Minimize lost time for arriving and departing passengers, maximizing customer satisfaction</span>
                </div>
            </li>
        </ul>
    </div>
    <div class="half-column">
        <h1> How LAMS Helps </h1>
        <h3> What's the Issue? </h3>
        <div style="max-height: 350px; overflow-y: auto;">
            <span>The airline industry has gone through significant upheaval in recent years; challenges in staffing and consumer demand have placed considerable strain on even well-established airlines and airports.  Daily operation of an airport involves the management of traffic and staff from multiple airlines operating numerous flights and some time consuming procedures. The air travel industry continues to grow steadily as more and more demand hits the markets, airport staffing, and scheduling gets increasingly difficult as airports try to expand to accept more customers and keep all related departments in the green. Customers that are waiting around costs money for all involved airports and the air travel industry at large, a streamlined solution is required.</span>
        </div>
        <br>
        <h3> What's the Solution? </h3>
        <div style="max-height: 350px; overflow-y: auto;">
            <span>We propose an automated solution to this problem with the development of a Flight Management System (FMS) can be configured for any port in any country.  This solution will reduce manpower requirements for all departments involved in flight logistics, streamlining the decision-making process for management by providing concise and accurate information about flights, crew and boarding/disembarking controls to a variety of airports internationally.  This will standardize the workflow of all impacted airlines and participating ports around the world.  This process is fast enough to communicate all the way around the world in a matter of seconds about a specific crew member, a flight, a port, an aircraft type, etc. It is a time saving, cost saving, space saving, and highly efficient system if done properly. Air traffic control becomes more fluid, and they are notified about flights of concern far faster and more consistently than by traditional means, thereby avoiding more potential expenses for accidents of varying kinds. This system will store empirical, quantifiable, and identifiable data about various needed systems.</span>
        </div>
    </div>
</main>
<?php include 'view/footer.php'; ?>