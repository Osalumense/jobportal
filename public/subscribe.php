<?php
$title='Subscribe to job updates';
include_once "../public/includes/header.php";
?>
    
<section>
    <div class="container mx-auto mt-4 shadow-lg rounded-lg">
        <h5 class="text-center py-3 rounded shadow" >SUBSCRIBE TO JOB UPDATES</h5>
        <div class="row">
        
            <div class="col-md-6 mt-4 col-sm-6 ">   
                    <label for="department" class="font-weight-bold">Preferred department:</label>
                            <select name="department" id="department" class="form-select mb-3">
                                <option value="">Select preferred department</option>                   
                                <?php
                                    $sql="SELECT * FROM departments";
                                    $result = $conn->query($sql);
                                    while($searchrow = $result->fetch()){
                                    echo "<option value=".$searchrow['id'] .">" . ucfirst($searchrow['dept']) ."</option>";
                                    }            
                                ?>
                            </select>
                            <div id="dept-error" class="text-danger "></div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6 mt-4">
                        <label for="location" class="font-weight-bold">Preferred location:</label>
                        <select name="location" id="location" class="form-select">
                                <option value="">Select preferred location</option>
                                <option value="all">Any location</option>                        
                                <?php
                                    $sql="SELECT * FROM states";
                                    $result = $conn->query($sql);
                                    while($searchrow = $result->fetch()){
                                    echo "<option value=".$searchrow['state_id'] .">" . ucfirst($searchrow['state_name']) ."</option>";
                                    }            
                                ?>
                            </select>
                            <div id="location-error" class="text-danger"></div>
                </div>
        </div>

        <div class="row">
                <div class="col-md-6 col-sm-6 my-3 form-group">
                    <label for="location" class="font-weight-bold">Email:</label>
                    <input type="email" class="form-control" placeholder="Enter email here" id="mail">
                    <div id="mail-error" class="text-danger"></div>
                </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="d-grid gap-2">
                <button class="btn btn-info my-4" id="subscribe">Subscribe</button>
            </div>
        </div>
    </div>
</section>


<script>
    var ajaxurl = "pagecontrol.php";
    $("#subscribe").click(function(){
        $("#dept-error, #location-error, #mail-error").empty();
        var dept = $("#department").val();
        var location = $("#location").val();
        var mail = $("#mail").val();

        if(dept == ""){
            var text = 'Select at least one department';
            $("#dept-error").html(text);
            return false;
        }

        if(location == ""){
            var text = 'Select at least one location';
            $("#location-error").html(text);
            return false;
        }

        if(mail == ""){
            var text = 'Enter correct email';
            $("#mail-error").html(text);
            return false;
        }

        $.ajax({
            type:"POST",
            url:ajaxurl,
            data:{dept:dept,location:location,mail:mail,dataname:'subscribetoupdate'},
            success:function(response){
                alert(response);
            }
        });

    });
</script>