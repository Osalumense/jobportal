<?php
    include "../includes/db_conn.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/b-1.6.4/b-flash-1.6.4/b-html5-1.6.4/rr-1.2.7/sc-2.0.3/sb-1.0.0/sp-1.2.0/datatables.min.css"/>
        
        <link rel="stylesheet" href="../includes/fontawesome/css/all.css"/>
        <!-- <script src="https://kit.fontawesome.com/3b8c65f5c7.js"></script> -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>    
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/b-1.6.4/b-flash-1.6.4/b-html5-1.6.4/rr-1.2.7/sc-2.0.3/sb-1.0.0/sp-1.2.0/datatables.min.js"></script>   
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup Panelist Group</title>
</head>
<body>
    <h5 class="text-center mt-3 bg-light p-2">SETUP PANELIST GROUP</h5>

    <div class="container">
        <div class="row mx-auto mt-4">
            <div class="col-sm-3 mb-2">
            </div>
            <div class="col-sm-3 mb-2">
                <a href="" class="badge badge-primary p-2 show_panels">Show Existing Panel Groups</a>
            </div>
            <div class="col-sm-3 mb-2">
                <a href="" class="badge badge-success p-2 new_panels">Create New Panelist Group</a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6" id="panelist_tbl" style="display:none">                
                <table class="table table-sm table-bordered">                   
                    <thead> <a href="" class="badge badge-danger float-right" id="close_tbl">X</a>
                        <tr>
                            <th>S/N</th>
                            <th>Panel Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT DISTINCT panelist_group FROM panelist_group_tbl";
                            $stmt = $conn->query($sql);
                            $count = $stmt->rowCount();
                            if($count > 0){
                                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                    $i = 1;
                                    echo '<tr>
                                            <td>'.$i.'</td>
                                            <td>'.$row['panelist_group'].'</td>
                                            <td><button class="btn-sm btn- view_panelits" id='.$row["panelist_group"].'>Deactivate</button></td>
                                         </tr>';
                                    $i++;
                                }
                            }
                            else{
                                echo '<tr>
                                        <td colspan="3"><h5 class="text-danger text-center">No Panel Group Created yet</h5></td>
                                      </tr>';
                            }
                            
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div  id="add_panelist" style="display:none">
            <div class="row">
                <div class="col-sm-4">                
                    <div class="form-group my-2">
                        <label for="panel_group_name">Panel Group</label>
                        <input type="text" class="form-control form-control-sm" placeholder="Enter Name of Panel Group" id="panel_group_name" name="panel_group_name">
                    </div>
                    <div id="panelname-error" class="text-danger mt-n3"></div>
                </div>
                    <div class="row">
                        <div class="form-group my-2"> 
                            <label for="panel_group_name">Interview Date</label>
                            <input type="date" class="form-control form-control-sm" id="interview_date" name="interview_date">
                        </div>
                        <div id="interviewdate-error" class="text-danger mt-n3"></div>

                        <!-- <div class="form-group mb-3 mt-n2 col-sm-6"> 
                            <br><br><button class="btn btn-sm btn-success" id="add_panelist_btn"><span><i class="fas fa-plus mr-2"></i></span>Add Panelists</button>
                        </div> -->
                    </div>
            </div>
                    
                    <!-- <div class="row">
                        <div class="form-group my-2">
                            <label for="panel_group_name">Choose the panelist type</label>
                                <select type="text" class="form-control form-control-sm" id="panelist_type" name="panelist_type">
                                    <option value="">Choose staff or external</option>
                                    <option value="1">Staff</option>
                                    <option value="2">External panelist</option>
                                </select>
                        </div>                    
                    </div> -->

                    <div class="row mt-4">
                        <div class="col-sm-6">
                            <table class="table table-sm table-bordered">  
                                <thead><a href="" class="badge badge-success float-right" id="add_panelist_btn" data-toggle="modal" data-target="#staticBackdrop"><span><i class="fas fa-plus mr-2"></i></span>Add Panelists</a>
                                    <tr>
                                        <td>Panelist Name</td>
                                    </tr>
                                </thead>
                                <tbody id="panelist_tbl_body">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    

                    <!-- <div>
                        <button class="btn-sm btn-success"  data-toggle="modal" data-target="#staticBackdrop"></button>
                    </div>                 -->
                
            
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Panelists</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group col-sm-6 mb-3">
                    <label for="panel_group_name">Choose the panelist type</label>
                        <select type="text" class="form-control form-control-sm" id="panelist_type" name="panelist_type">
                            <option value="">Choose staff or external</option>
                            <option value="1">Staff</option>
                            <option value="2">External panelist</option>
                        </select>
                </div>
                <div id="panelist_membersdiv">
                
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false">   
        <div class="modal-dialog container modal-dialog-centered mw-100 ">
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
                                <div class="row">
                                    
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
    
</body>
</html>

<script>
    $(".show_panels").click(function(e){
        e.preventDefault();
        $("#panelist_tbl").show('slow'); 
        $("#add_panelist").hide();       
    });

    $(".new_panels").click(function(e){
        e.preventDefault();
        $("#panelist_tbl").hide();
        $("#add_panelist").show('slow');
    });

    $("#panelist_type").on("change", function(){

    })

    $(".view_panelits").click(function(e){
        e.preventDefault();
        // $.ajax({
        //     url:'admincontrol.php',
        //     method:'POST',
        //     data:{dataname:'show_paneltbl'},
        //     success:function(data){
        //         console.log(data);
        //     }
        // });
    });

    $("#close_tbl").click(function(e){
        e.preventDefault();
        $("#panelist_tbl").hide();
    });

    var panel_group = $("#panel_group_name").val();
    var interview_date = $("#interview_date").val();
  

    
    // $("#interview_date").focusout(function(){
    //     if(panel_group == '' && interview_date == ''){
    //     $("#add_panelist_btn").prop("disabled", false);
    //     }
    //     else{
    //         $("#add_panelist_btn").prop("disabled", true); 
    //     }
    // });

    // $("#panel_group_name").focusout(function(){
    //     if(panel_group == '' && interview_date == ''){
    //     $("#add_panelist_btn").prop("disabled", false);
    //     }
    //     else{
    //         $("#add_panelist_btn").prop("disabled", true); 
    //     }
    // });
    $("#panelist_type").on("change", function(){
        var id = $(this).val();
        if(id == 1){
           $.ajax({
               method:"POST",
               url:"admincontrol.php",
               data:{id:id,dataname:'getpaneliststaff'},
               success:function(data){
                    $("#panelist_membersdiv").html(data);                
               }
           });
        }
        else if(id == 2){
            var text = '<a href="" class="badge badge-success" id="add_new_panelist">Add another panelist</a><div class="input-group mb-3"> <input type="text" class="form-control form-control-sm" placeholder="Panelist title and full name" id="ext_panelist" name="ext_panelist"> <div class="input-group-append"> <a href="" class="badge badge-success float-right add_ext_panelist" id=""><i class="fas fa-plus mt-1"></i></a> </div> </div>';
            $("#panelist_membersdiv").html(text);
        }
    });

    $(document).on("change", "#panelist_staff", function(){
        var staff = $('#panelist_staff option:selected').text();
        if(staff != ''){
            $('#panelist_tbl_body').append('<tr><td>'+staff+'<a href="" class="badge badge-danger float-right remove_panelist" id="">X</a></td></tr>');
        }
    });

    //Remove added panelist 
    $(document).on("click", ".remove_panelist", function(e){
        e.preventDefault();
        var val = $(this).closest('tr');
        val.remove();
    });

    //Add new external panwlist
    $(document).on("click", "#add_new_panelist", function(e){
        e.preventDefault();
        var txt = '<div class="input-group mb-3"> <input type="text" class="form-control form-control-sm" placeholder="Panelist title and full name" id="ext_panelist" name="ext_panelist"> <div class="input-group-append"> <a href="" class="badge badge-success float-right add_ext_panelist" id=""><i class="fas fa-plus mt-1"></i></a> </div> </div>';
        $("#panelist_membersdiv").append(txt);
    });

    $(document).on("click", ".add_ext_panelist", function(e){
        e.preventDefault();
    })
</script>