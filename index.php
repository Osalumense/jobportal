<?php
  $title='Job application';
  include "includes/db_conn.php";
  include_once "includes/header.php";

?>
<!-- <div class="jumbotron mt-n5 p-n3" style="height: 5vh;">
 </div> -->
    <div class="container mb-5">
    </div>
    <div class="preloader" style="position: absolute; top: 50%; left: 50%; margin: -25px 0 0 -25px;">
            <h5>Loading...</h5>
        </div>
        <script>
            $(window).on("load", function(){
                $('.preloader').fadeOut('slow');
            });
        </script>

      <div class="container mx-auto mt-5">
        <div class="row mx-auto">
            <div class="col-md-4 mx-n2"> 
                <div class="card img-thumbnail shadow"> 
                <img class="card-img-top" src="images/apply.png" alt="Card image" style="opacity:0.2;">
                    <div class="card-img-overlay">              
                      <div class="card-body my-auto">
                        <h5>Want to work with us? View the avalaible list of vacancies</h5>                        
                        <a href="jobs.php" class="btn btn-outline-dark mx-2 stretched-link">View now</a>
                      </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mx-n2"> 
                <div class="card img-thumbnail shadow">
                <img class="card-img-top" src="images/submit.png" alt="Card image" style="opacity:0.2">
                    <div class="card-img-overlay">                  
                      <div class="card-body my-auto">
                        <h5>Want to register and submit applications to any department?</h5>                      
                        <a href="" class="btn btn-outline-dark mx-2 stretched-link">Register Now</a>
                      </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mx-n2"> 
                <div class="card img-thumbnail shadow">
                <img class="card-img-top" src="images/subscribe.png" alt="Card image" style="opacity:0.2">
                    <div class="card-img-overlay">          
                      <div class="card-body my-auto">
                        <h5>Want to get job updates? Subscribe to receive job updates</h5>                     
                        <a href="subscribe.php" class="btn btn-outline-dark mx-2 stretched-link">Subscribe</a>
                      </div>
                    </div>
            </div>
        </div>
    </div>
  </div>

<?php
  include_once 'includes/footer.php';
?>


