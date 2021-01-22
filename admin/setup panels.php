<?php
    include "../includes/db_conn.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup Panels</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../includes/fontawesome/css/all.css"/>
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> 
</head>
<body>
    <h5 class="text-center mt-3 bg-light p-2">SETUP PANELS</h5>

    <div class="container">
        <div class="row mx-auto mt-4">
            <div class="col-sm-3 mb-2">
            </div>
            <div class="col-sm-3 mb-2">
                <a href="" class="badge badge-primary p-2 show_panels" data-toggle="modal" data-target="#staticBackdrop">Show Existing Interview Panels</a>
            </div>
            <div class="col-sm-3 mb-2">
                <a href="" class="badge badge-success p-2 new_panels">Create New Interview Panel</a>
            </div>
        </div>
    </div>
    
    <div class="container">
            <div id="add_panelist" style="display:none" class="mt-4"> <a href="" class="badge badge-danger float-right" id="close_form">X</a>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label for="panel_group_name">Panel Group</label>
                            <input type="text" class="form-control form-control-sm" placeholder="Enter Name of Panel Group" id="panel_group_name" name="panel_group_name">
                            <div id="panelname-error" class="text-danger mt-n1"></div>
                        </div>
                                        
                        <div class="form-group col-sm-3"> 
                            <label for="interview_date">Interview Date</label>
                            <input type="date" class="form-control form-control-sm" id="interview_date" name="interview_date">
                            <div id="interviewdate-error" class="text-danger mt-n1"></div>
                        </div>

                        <div class="form-group col-sm-3">  
                            <label for="venue">venue</label>
                            <input type="text" class="form-control form-control-sm" id="venue" placeholder="Enter interview venue" name="venue">
                            <div id="venue-error" class="text-danger mt-n1"></div>
                        </div>

                        <!-- <div class="form-group col-sm-3">
                            <button class="btn btn-sm btn-success float-right mt-4" id="add_panelist_btn"><span><i class="fas fa-plus mr-1"></i></span>Add Members</button>
                        </div> -->

                        <div class="form-group col-sm-3 mb-3 choose_staff_type" id="choose_staff_type">
                            <label for="panel_group_name">Choose the panelist type</label>
                                <select type="text" class="form-control form-control-sm" id="panelist_type" name="panelist_type">
                                    <option value="">Choose staff or external</option>
                                    <option value="1">Staff</option>
                                    <option value="2">External panelist</option>
                                </select>
                        </div>
                        <div id="panelist_membersdiv" class="col-sm-6 panelist_membersdiv">
                        
                        </div>
                    </div>
                    
                    <div class="row mx-3">
                        <div id="panelmember-error" class="text-danger mb-n3 mt-2"></div>
                        
                        <table class="table table-sm col-sm-8 table-bordered mt-4 new_panelist_tbl text-center">
                            <thead>
                                <tr>
                                    <td>Staff ID</td>
                                    <td>Panel Members</td>
                                </tr>
                                </thead>
                                <tbody id="panelist_tbl_body" class="panelist_tbl_body">

                                </tbody>
                        </table>
                    </div>

                    <div class="row m-3">
                            <button class="btn btn-md btn-success" id="save_panel">Save</button>
                    </div>

            </div>

    </div>  

        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false">   
        <div class="modal-dialog container modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="get_name"></h4>
                    <div class="mx-auto" id="get_action"></div>
                    <button type="button" class="close" data-dismiss="modal">&times</button>
                </div>
                <div class="modal-body">
                    <div class="card-deck">
                        <div class="card border-secondary">
                            <div class="card-body">
                                <div class="row mt-4">
                                    <div class="col-sm-6">
                                        <table class="table table-sm table-bordered" id="panelist_tbl">               
                                            <thead> 
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Panel Name</th>
                                                    <th>Interview Date</th>
                                                    <th>Venue</th>
                                                    <th>More</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $sql = "SELECT * FROM interview_panels_tbl";
                                                    $stmt = $conn->query($sql);
                                                    $count = $stmt->rowCount();
                                                    if($count > 0){
                                                        $i = 1;
                                                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){              
                                                            echo '<tr>
                                                                    <td>'.$i.'</td>
                                                                    <td>'.$row['panel_name'].'</td>
                                                                    <td>'.$row['interview_date'].'</td>
                                                                    <td>'.$row['venue'].'</td>
                                                                    <td><a href="javascript:void(0)" class="badge badge-info view_panelists" id='.$row["panel_id"].'>View Details</a><a href="javascript:void(0)" class="badge badge-danger delete_panel" id="'.$row["panel_id"].'">Delete</a></td>
                                                                </tr>';
                                                            $i++;
                                                        }
                                                    }
                                                    else{
                                                        echo '<tr>
                                                                <td colspan="5"><h5 class="text-danger text-center">No Panel Group Created yet</h5></td>
                                                            </tr>';
                                                    }
                                                    
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>

                                <div class="col-sm-6" id="edit_panel_section" style="display:none"><a href="javascript:void(0);" class="badge badge-danger float-right close_edit_panel_section" id=""><i class="fas fa-times"></i></a>
                                    <div class="row">
                                                    <input class="form-control form-control-sm" type="text" id="edit_panel_id" hidden>
                                        <div class="form-group col-sm-6">
                                            <label for="edit_panel_group_name">Panel Group</label>
                                            <input type="text" class="form-control form-control-sm" id="edit_panel_group_name" name="edit_panel_group_name">
                                            <div id="edit_panelname-error" class="text-danger mt-n1"></div>
                                        </div>
                                                        
                                        <div class="form-group col-sm-6"> 
                                            <label for="edit_interview_date">Interview Date</label>
                                            <input type="date" class="form-control form-control-sm" id="edit_interview_date" name="edit_interview_date">
                                            <div id="edit_interviewdate-error" class="text-danger mt-n1"></div>
                                        </div>

                                        <div class="form-group col-sm-6">  
                                            <label for="edit_venue">venue</label>
                                            <input type="text" class="form-control form-control-sm" id="edit_venue" name="edit_venue">
                                            <div id="edit_venue-error" class="text-danger mt-n1"></div>
                                        </div>
                                        <div class="mt-4">
                                            <a href="javascript:void(0)" class="add_anoda_member">Add another member</a>
                                        </div>
                                        
                                        <div class="form-group col-sm-6 mb-3 " id="edit_choose_staff_type" style="display:none">
                                            <label for="panel_group_name">Choose the panelist type</label><a href="javascript:void(0);" class="badge badge-danger float-right close_section" id=""><i class="fas fa-times"></i></a>
                                            <select type="text" class="form-control form-control-sm" id="edit_panelist_type" name="edit_panelist_type">
                                                <option value="">Choose staff or external</option>
                                                <option value="1">Staff</option>
                                                <option value="2">External panelist</option>
                                            </select>
                                    </div>
                                    <div id="edit_panelist_membersdiv" class="col-sm-12">
                                    
                                    </div>
                                    </div> 
                                    
                                    <table class="col-sm-12 mt-4 table table-sm table-bordered">
                                        <thead>
                                            <tr>
                                                <td>Staff ID</td>
                                                <td>Panel Members</td>
                                            </tr>
                                        </thead>
                                        <tbody id="edit_panelmembers">
                                            
                                        </tbody>
                                    </table>

                                    <div class="row mt-5 d-flex justify-content-center">
                                        <button class="btn btn-sm btn-success mx-5" id="update_panel">Update </button>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-sm btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <?php
        $e = '';
        $sql = "SELECT * FROM titles";
        $result = $conn->query($sql);
        while ($row=$result->fetch(PDO::FETCH_ASSOC)) {
            $e .= '<option value="'.$row['title'].'">'.$row['title'].'</option>';
        }        
    ?>

    
</body>
</html>

<script>
    var ajaxurl = "admincontrol.php";
    var page = "setup panels.php";
    
    $(".show_panels").click(function(e){
        e.preventDefault();
        
        $("#panelist_tbl").show('slow');        
    });

    $("#close_form").click(function(e){
        e.preventDefault();
        $("#add_panelist").hide();
    });

    $(".new_panels").click(function(e){
        e.preventDefault();
        $("#add_panelist").show('slow');
    });

    //Show staff type dropdown
    $("#add_panelist_btn").click(function(){
        $("#choose_staff_type").show('slow');
    });

    //Add panel members 
    $("#panelist_type").on("change", function(){
        var id = $(this).val();
        if(id == 1){
           $.ajax({
               method:"POST",
               url:ajaxurl,
               data:{id:id,dataname:'getpaneliststaff'},
               success:function(data){
                    $("#panelist_membersdiv").html(data);                
               }
           });
        }
        else if(id == 2){
            // var text = '<label>Enter panel member name</label><br><div class="input-group mb-3"> <input type="text" class="form-control form-control-sm " placeholder="Panelist title and full name" id="ext_panelist" name="ext_panelist"> <div class="input-group-append"> <button class="badge badge-success float-right add_ext_panelist" id="add_ext_panelist"><i class="fas fa-plus"></i>Add</button> </div> </div>';
            var e = '<?=$e?>';
            var text = '<div class="form-group" ><label>Panel Member Name</label><div class="input-group mb-3" id="ext_panelist"> <select class="form-control form-control-sm" id="ext_panelist_title"> <option value="">title</option>'+e+'</select> <div class="input-group-append"><input type="text" class="form-control form-control-sm" placeholder="Enter surname" id="ext_panelist_surname" name="ext_panelist_surname"><input type="text" class="form-control form-control-sm" placeholder="Enter first name" id="ext_panelist_fname" name="ext_panelist_fname"> <button class="badge badge-success float-right" id="add_ext_panelist"><i class="fas fa-plus"></i>Add</button> </div> </div></div>';
            $("#edit_panelist_membersdiv").html(text);
            $("#panelist_membersdiv").html(text);
        }
        else if(id == ''){
            $("#panelist_membersdiv").html('');
        }
    });

    //Add new external panelist to panel members table
    $(document).on("click", "#add_ext_panelist", function(){
        var title = $("#ext_panelist_title").val();
        var surname = $("#ext_panelist_surname").val();
        var fname = $("#ext_panelist_fname").val();
        if((title != '') && (surname != '') && (fname != '')){
            $('#panelist_tbl_body').append('<tr><td></td><td>'+title+' '+surname+' '+fname+'<a href="javascript:void(0);" class="badge badge-danger float-right remove_panelist" id=""><i class="fas fa-times"></i></a></td></tr>');  
            $("#ext_panelist_title, #ext_panelist_fname, #ext_panelist_surname").val('');
        }else{
            if(title == ''){
                $("#ext_panelist_title").focus();
            }
            else if(surname == ''){
                $("#ext_panelist_surname").focus();
            }
            else if(fname == ''){
                $("#ext_panelist_fname").focus();
            }
        }
        
    });


    //Add new staff panelist to panel members table
    $(document).on("click", ".add_staff", function(){
        var staff = $('#panelist_staff option:selected').text();
        var staffid = $("#panelist_staff").val();

        //Initialize check to zero
        var check = 0;

        //If staffid and staff are not empty
        if((staffid && staff) != ''){

            //Loop through the table to check for duplicate staffid
            $("#panelist_tbl_body tr").each(function(){
                var tr = $(this);
                var id = tr.find("td:eq(0)").text();
                
                if(id==staffid){
                    check++;   //if record exists increment check
                }
            });

            //if check value is greater than zero, give error else append to the table
            if(check == 0){
                $('#panelist_tbl_body').append('<tr><td>'+staffid+'</td><td>'+staff+'<a href="javascript:void(0);" class="badge badge-danger float-right remove_panelist" id=""><i class="fas fa-times"></i></a></td></tr>');
                $("#panelist_staff").val('');
            }
            else{
                alert("Member already exixts in the panel"); //error message if record already exists
            }
            
        }else{
            $("#panelist_staff").focus(); //error action if no item is selected
        }
    });

    //Remove added panelist from panel members table
    $(document).on("click", ".remove_panelist", function(e){
        e.preventDefault();
        if(confirm('Are you sure you want to remove this member from the panel?')){
            var val = $(this).closest('tr');
            val.remove();
        }
        
    });

    //Save panel members group AJAX request
    $("#save_panel").click(function(){
        $("#panelname-error, #interviewdate-error, #venue-error").empty();

        var panel = $("#panel_group_name").val();
        var interview_date = $("#interview_date").val();
        var venue = $("#venue").val();

        if(panel==''){
            $("#panelname-error").html('Panel name cannot be empty');
            $("#panel_group_name").focus();
            return false;
        }

        if(interview_date == ''){
            $("#interviewdate-error").html('Interview date cannot be empty');
            $("#interview_date").focus();
            return false;
        }

        if(venue == ''){
            $("#venue-error").html('Interview Venue cannot be empty');
            $("#venue").focus();
            return false;
        }

        var panelmembers = [];
        $(".panelist_tbl_body tr").each(function(){
            var getval = $(this);
            var col1_val = getval.find("td:eq(0)").text();
            var col2_val = getval.find("td:eq(1)").text();

            var members = {};
            members.col1 = col1_val;
            members.col2 = col2_val;
            panelmembers.push(members);
        });

        var panelmember_array = JSON.stringify(panelmembers);

        if(panelmember_array == ''){
            $("#panelmember-error").html('Add at least one panel member');
            return false;
        }
        
        $(this).html('<span class="spinner-border spinner-border-sm mx-2"></span>')
        $.ajax({
            url:ajaxurl,
            method:"POST",
            data:{panel:panel,interview_date:interview_date,venue:venue,panelmember_array:panelmember_array,dataname:'addnewpanel'},
            success:function(data){
                $("#save_panel").html('Save');
                alert(data);
                window.location=page;
            }
        });

    });

    //Edit panel group AJAX request
    $(".view_panelists").click(function(){
        var id = $(this).attr("id");
        $.ajax({
            url:ajaxurl,
            type: "POST",
            dataType:'json',
            data:{id:id,dataname:'edit_interview_panel'},
            success:function(data){
                $("#edit_panel_id").val(id);
                $("#edit_panel_group_name").val(data.panel_name);
                $("#edit_interview_date").val(data.interview_date);
                $("#edit_venue").val(data.venue);
                $("#edit_panelmembers").html(data.members);
                $("#edit_panelist_type, #edit_panelist_staff, #edit_ext_panelist").val('');
                $("#edit_choose_staff_type").hide();
                $("#edit_panelist_membersdiv").empty();
                $(".add_anoda_member").show();
                $("#edit_panel_section").show('slow');
            }
        });
    });

    //Close edit panel section
    $(".close_edit_panel_section").click(function(e){
        e.preventDefault();
        $("#edit_panel_section").hide();
    });

    //Choose panelist type for edit panel group
    $("#edit_panelist_type").on("change", function(){
        var id = $(this).val();
        if(id == 1){
           $.ajax({
               method:"POST",
               url:ajaxurl,
               data:{id:id,dataname:'geteditpaneliststaff'},
               success:function(data){
                    $("#edit_panelist_membersdiv").html(data);                
               }
           });
        }
        else if(id == 2){
            var e = '<?=$e?>';
            var text = '<div class="form-group" ><label>Panel Member Name</label><div class="input-group mb-3" id="edit_ext_panelist"> <select class="form-control form-control-sm" id="edit_ext_panelist_title"> <option value="">title</option>'+e+'</select> <div class="input-group-append"><input type="text" class="form-control form-control-sm" placeholder="Enter surname" id="edit_ext_panelist_surname" name="edit_ext_panelist_surname"><input type="text" class="form-control form-control-sm" placeholder="Enter first name" id="edit_ext_panelist_fname" name="edit_ext_panelist_fname"> <button class="badge badge-success float-right" id="edit_add_ext_panelist"><i class="fas fa-plus"></i>Add</button> </div> </div></div>';
            $("#edit_panelist_membersdiv").html(text);
        }
        else if(id == ''){
            $("#edit_panelist_membersdiv").html('');
        }
    });

    //Add staff to existing panels table
    $(document).on("click", ".edit_add_staff", function(){
        var staff = $('#edit_panelist_staff option:selected').text();
        var staffid = $("#edit_panelist_staff").val();

        //Initialize check to zero
        var check = 0;

        //If staffid and staff are not empty
        if((staffid && staff) != ''){

            //Loop through the table to check for duplicate staffid
            $("#edit_panelmembers tr").each(function(){
                var tr = $(this);
                var id = tr.find("td:eq(0)").text();
                
                if(id==staffid){
                    check++;   //if record exists increment check
                }
            });

            //if check value is greater than zero, give error else append to the table
            if(check == 0){
                $('#edit_panelmembers').append('<tr><td>'+staffid+'</td><td>'+staff+'<a href="javascript:void(0);" class="badge badge-danger float-right remove_panelist" id=""><i class="fas fa-times"></i></a></td></tr>');
                $("#edit_panelist_staff").val('');
            }
            else{
                alert("Member already exixts in the panel"); //error message if record already exists
            }
            
        }else{
            $("#edit_panelist_staff").focus(); //error action if no item is selected
        }
    }); 

    //Add external panelist to existing panels table
    $(document).on("click", "#edit_add_ext_panelist", function(){
        var title = $("#edit_ext_panelist_title").val();
        var fname = $("#edit_ext_panelist_fname").val(); 
        var surname = $("#edit_ext_panelist_surname").val();
        if((title != '') && (surname != '') && (fname != '')){
            $('#edit_panelmembers').append('<tr><td></td><td>'+title+' '+surname+' '+fname+'<a href="javascript:void(0);" class="badge badge-danger float-right remove_panelist" id=""><i class="fas fa-times"></i></a></td></tr>');  
            $("#edit_ext_panelist_title, #edit_ext_panelist_fname, #edit_ext_panelist_surname").val('');
        }else{
            if(title == ''){
                $("#edit_ext_panelist_title").focus();
            }
            else if(surname == ''){
                $("#edit_ext_panelist_surname").focus();
            }
            else if(fname == ''){
                $("#edit_ext_panelist_fname").focus();
            }          
        }  
    });

    //Delete panel
    $(".delete_panel").click(function(){
        if(confirm("Are you sure you want to delete this interview panel group?")){
            var id = $(this).attr("id");
            var tr = $(this).closest('tr');
            $.ajax({
                url:ajaxurl,
                type:"POST",
                data:{id:id,dataname:'delete_panel'},
                success:function(data){
                    alert(data);
                    tr.remove();
                }
            });
        }
    });

    //Delete panel member from existing panel
    $(document).on("click", ".remove_existing_panelist", function(){
        if(confirm("Are you sure you want to delete this interview panel group?")){
            var id = $(this).attr("id");
            var tr = $(this).closest('tr');

            $.ajax({
                url:ajaxurl,
                type:"POST",
                data:{id:id,dataname:'delete_panelmember'},
                success:function(data){
                    alert(data);
                    tr.remove();
                }
            });
        }
    });
    

    //Update existing panel group
    $("#update_panel").click(function(){
        $("#edit_panelname-error, #edit_interviewdate-error, #edit_venue-error").empty();

        var panelid = $("#edit_panel_id").val();
        var panel = $("#edit_panel_group_name").val();
        var interview_date = $("#edit_interview_date").val();
        var venue = $("#edit_venue").val();

        if(panel==''){
            $("#edit_panelname-error").html('Panel name cannot be empty');
            $("#edit_panel_group_name").focus();
            return false;
        }

        if(interview_date == ''){
            $("#edit_interviewdate-error").html('Interview date cannot be empty');
            $("#edit_interview_date").focus();
            return false;
        }

        if(venue == ''){
            $("#edit_venue-error").html('Interview Venue cannot be empty');
            $("#edit_venue").focus();
            return false;
        }

        var panelmembers = [];
        $("#edit_panelmembers tr").each(function(){
            var getval = $(this);
            var col1_val = getval.find("td:eq(0)").text();
            var col2_val = getval.find("td:eq(1)").text();

            var members = {};
            members.col1 = col1_val;
            members.col2 = col2_val;
            panelmembers.push(members);
        });

        var panelmember_array = JSON.stringify(panelmembers);

        if(panelmember_array == ''){
            $("#panelmember-error").html('Add at least one panel member');
            return false;
        }

        $(this).html('<span class="spinner-border spinner-border-sm mx-2"></span>')
        $.ajax({
            url:ajaxurl,
            method:"POST",
            data:{panelid:panelid,panel:panel,interview_date:interview_date,venue:venue,panelmember_array:panelmember_array,dataname:'updatepanel'},
            success:function(data){
                $("#update_panel").html('Update');
                alert(data);
                window.location=page;
            }
        });
    });

    //Close add new panel member for existing panel group
    $(".close_section").click(function(e){
        e.preventDefault();
        $("#edit_panelist_membersdiv").empty();
        $("#edit_choose_staff_type").hide();        
        $(".add_anoda_member").show('slow');
        $("#edit_panelist_type, #edit_panelist_staff").val('');
    });

    $(".add_anoda_member").click(function(){
        $(this).hide();
        $("#edit_choose_staff_type").show('slow');
    })


</script>