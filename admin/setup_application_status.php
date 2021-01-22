<?php
    include "../includes/db_conn.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup Application Status</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> 
</head>
<body>
    <h5 class="text-center mt-3 bg-light p-2">SETUP APPLICATION STATUS</h5>
    <div class="container">
            <div class="d-flex justify-content-center mt-5">
                <button class="btn btn-success" id="add">Add Status</button>
            </div>

        <div class="row mt-3">

            
            <div class="col-sm-6">
                <table class="table table-bordered table-responsive table-sm text-center">
                    <thead class="">
                        <tr>
                            <th>id</th>
                            <th>Application Status</th>
                            <th>Remarks</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT * FROM application_status_tbl WHERE active='1'";
                            $result = $conn->query($sql);
                            if($result->rowCount() > 0){
                                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                    echo '
                                    <tr>
                                        <td>'.$row["id"].'</td>
                                        <td>'.$row["application_status"].'</td>
                                        <td>'.$row["remarks"].'</td>
                                        <td><button class="btn btn-info btn-sm edit_data" id="'.$row["id"].'">Edit</button></td>
                                        <td><button class="btn btn-secondary btn-sm delete_data" id="'.$row["id"].'">Delete</td>
                                    </tr>';
                                }
                            }
                            else{
                                echo '
                                <tr>
                                    <td colspan="5"><h5 class="text-danger">No Application Status yet</h5></td>
                                </tr>
                                ';
                            }
                        ?>
                    </tbody>
                </table>
            </div>

            <div id="add_status" class="col-sm-4" style="display: none;">
                <form method="POST">
                    <label for="status">Status name:</label>
                    <input type="text" name="status_name" id="status_name" class="form-control"  required> <br>
                    <label for="remarks">Remarks:</label>
                    <input type="text" name="remarks" id="remarks" class="form-control"  required> <br>
                    <button type="button" class="btn btn-primary" id="submit_add_status">Save</button>
                    
                </form><hr>
                <div class="float-right">
                    <button type="button" class="btn btn-secondary" id="close_add_status">Close</button>
                </div>
            </div>

            <div id="edit_status" class="col-sm-4" style="display: none">
                <form method="POST">
                    <input type="text" id="edit_id" class="form-control" hidden>
                    <label for="status">Status name:</label>
                    <input type="text" id="edit_status_name" class="form-control"  required> <br>
                    <label for="remarks">Remarks:</label>
                    <input type="text" id="edit_remarks" class="form-control"  required> <br>
                    <button type="button" class="btn btn-primary" id="submit_edit_status">Update</button>
                    
                </form><hr>
                <div class="float-right">
                    <button type="button" class="btn btn-secondary" id="close_edit_status">Close</button>
                </div>
            </div>
        </div>
    </div>     
</body>
</html>

<script>
    let ajaxurl = 'admincontrol.php';
    let page = 'setup_application_status.php';

    $("#add").click(function(){
        $("#edit_status").hide();
        $("#add_status").show('slow');
    });

    $("#close_add_status").click(function(){
        $("#add_status").hide('slow');
    });

    $("#close_edit_status").click(function(){
        $("#edit_status").hide('slow'); 
    });

    $("#submit_add_status").click(function(){
        var status_name = $("#status_name").val();
        var remarks = $("#remarks").val();
        $.ajax({
            type:"POST",
            url:ajaxurl,
            data:{status_name:status_name,remarks:remarks,dataname:'savestatus'},
            success:function(response){
                alert(response);
                window.location.href=page;
            }
        });
    });

    //Ajax request to edit application status
    $(document).on('click', '.edit_data', function(){
        $("#add_status").hide('slow');
        var id = $(this).attr("id");
        var tr = $(this).closest('tr');
        var app_status = tr.find('td:eq(1)').text();
        
        $.ajax({
            type:"POST",
            url:ajaxurl,
            data:{id:id,app_status:app_status,dataname:'editstatus'},
            dataType:"JSON",
            success:function(data){                
                $("#edit_id").val(data.id);
                $("#edit_status_name").val(data.app_status);
                $("#edit_remarks").val(data.remarks);
                if(data.status != ''){
                    $("#edit_status_name, #edit_remarks, #submit_edit_status").prop("disabled", true);
                }
                else{
                    $("#edit_status_name, #edit_remarks, #submit_edit_status").prop("disabled", false);
                }                
                $("#edit_status").show('slow');               
            }
        });
    });

    //Ajax request to update application status
    $("#submit_edit_status").click(function(){
        var id = $("#edit_id").val();
        var status_name = $("#edit_status_name").val();
        var remarks = $("#edit_remarks").val();
        $.ajax({
            method:"POST",
            url:ajaxurl,
            data:{id:id,status_name:status_name,remarks:remarks,dataname:'updatestatus'},
            success:function(response){
                alert(response);
                window.location.href=page;
            }
        });
    });

    //Ajax request to delete application status
    $(document).on('click', '.delete_data', function(){
        var id = $(this).attr("id");
        var tr = $(this).closest('tr');
        var app_status = tr.find('td:eq(1)').text();
        if(confirm('Are you sure you want to delete record? It is not advisable to continue with this action')){
            $.ajax({
                url:ajaxurl,
                type:"POST",
                data:{id:id,app_status:app_status,dataname:'deletestatus'},
                success:function(response){
                    alert(response);
                    window.location.href=page;
                }
            });
        }
    });
</script>