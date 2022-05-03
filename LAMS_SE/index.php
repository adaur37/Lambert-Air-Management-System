<?php include 'view/header.php'; ?>

<!-- /*/////////////////////////////////////////////////////////////////////////////////////////////////
 * Landing Page : index.php
 * Joshua Snider
 * Apr292022
 * Provides the two main directions the user can take when entering the site, Edit data (after login) via Product Manager, or select and buy items in Product Catalog 
*////////////////////////////////////////////////////////////////////////////////////////////////// -->

<main class="c-services c-services-background">
    <h1 style="display: inline-block; margin-right: 20%;">Menu</h1> <h1 style="display: inline-block; color: rgb(0,0,0);">Because Bruce Cant Drive.</h1>
    <ul style="width:115%; overflow:hidden;"> <!-- https://stackoverflow.com/questions/12802482/javascript-onclick-redirect--> 
        <li class="c-services__item" onclick="window.location = 'product_manager';">
            <a href="product_manager">Flight Manager [ADMIN]</a>
            <p style="display:inline-block; width:20px;"></p> <!-- Using as a way to insert specific amount of whitespace -->
        </li>
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