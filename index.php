<!-- INCLUDE VS INCLUDE_ONCE: 
include will add the specified file every time it is called. However, include_once will only ever include the file once and never again. -->
<?php include_once "header.php"; ?> 

<section>
    <?php

    // Check if the user is logged in
    if (isset($_SESSION["userid"])) {
        
        // Output the profile greeting
        echo "<p class='login-greeting'>Welcome " . $_SESSION["useruid"] . "</p>";
    }
    ?>
</section>

<!-- Homepage introduction and img -->
<div class="wrapper">
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo adipisci dolor porro tenetur deserunt aperiam quisquam earum, excepturi officiis fuga amet expedita! A quasi illum repellat, hic nisi ipsam eum! Lorem ipsum dolor, sit amet consectetur adipisicing elit. Neque nostrum sequi, debitis molestias nemo officia tempora dicta repellendus tempore iure aut saepe dignissimos accusamus autem eveniet enim, modi impedit expedita?</p>

    <img id="mainimg" src="img/hadern.jpg" alt="cool picture of mortal shell character">
</div>

<?php include_once "footer.php"; ?>

