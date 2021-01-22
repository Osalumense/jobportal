<?php
require_once '../includes/applicant_header.php';
?>
    <script>
        $(document).ready(function(){
            $.ajax({
                type:"POST",
                url:"applicant_control.php",
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
                    <h4 class="card-title">Vacancy details</h4>
                        <div id="vacancy-details">
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
    $(document).on("click", ".links", function(){
        var id = $(this).attr("id");
        var uid = '<?=$user['uid']?>';
        $.ajax({
            method: "POST",
            url:"applicant_control.php",
            dataType: "JSON",
            data:{id:id,uid:uid,dataname:'getempdet'},
            success:function(navdetails){
               $("#vacancy-details").html(navdetails.tabval);
        }
        });      
    });
</script>

