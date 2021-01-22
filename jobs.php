<?php
    $title = 'jobs';
    include 'includes/header.php';
?>
<!DOCTYPE html>

<html lang="en">

    <script>
        var ajaxurl = "pagecontrol.php";
        $(document).ready(function(){
            $.ajax({
                type:"POST",
                url:ajaxurl,
                dataType:"JSON",
                data:{dataname:'showvacancies'},
                success:function(jobs){
                    $("#vacancies").html(jobs.catdisplay);
                }
            });
        });
    </script>

    <div class="container-responsive">
        <div class="row">
            <div class="col-md-3 m-2"> 
                <div class="card">
                    
                    <div class="card-body mx-auto">
                    <h4 class="card-title">Categories and Vacancies</h4><br>
                        <div class="mx-auto" id="vacancies">
                            
                        </div>  
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            </div>                  
                    </div>
                </div>
            </div>

            <div class="col-md m-2"> 
                <div class="card">
                    <div class="card-body">
                        <div id="vacancy-details">
                            <h4>Vacancy details</h4>
                            <h2 class="lead">Select a vacancy at the left hand side of the screen to view details here</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
<script>
    var ajaxurl = "pagecontrol.php";
    $(document).on("click", ".links", function(){
        var id = $(this).attr("id");
        $.ajax({
            method: "POST",
            url:ajaxurl,
            dataType: "JSON",
            data:{id:id,dataname:'getempdet'},
            success:function(navdetails){
               $("#vacancy-details").html(navdetails.tabval);
        }
        });      
    });
</script>

