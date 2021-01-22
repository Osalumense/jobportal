<?php
$title = 'View Applications';
include "../includes/db_conn.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <script src="https://kit.fontawesome.com/3b8c65f5c7.js" crossorigin="anonymous"></script>
        
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/b-1.6.4/b-flash-1.6.4/b-html5-1.6.4/rr-1.2.7/sc-2.0.3/sb-1.0.0/sp-1.2.0/datatables.min.css"/>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>    
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/b-1.6.4/b-flash-1.6.4/b-html5-1.6.4/rr-1.2.7/sc-2.0.3/sb-1.0.0/sp-1.2.0/datatables.min.js"></script>   
        <title><?=$title?></title>
    </head>

<body style="background-color: #d3d3d3">
<h5 class="text-center my-5 bg-light p-2">VIEW APPLICATIONS</h5>
    <script>
        
    </script>

<div class="container mx-auto">

    <div class="row">
        <div class="col-md-3 col-sm-6 form-group">
                <label for="vacancy" class="text-muted font-weight-bold">Vacancy:</label>
                    <select name="vacancy" id="vacancy" class="form-control form-control-sm">
                        <option value="">Select vacancy to see applicants</option>                      
                            <?php
                                $sql="SELECT *, posts.type AS position FROM job_vacancy_tbl 
                                JOIN posts ON job_vacancy_tbl.post_id=posts.id";
                                $result = $conn->query($sql);
                                while($searchrow = $result->fetch()){
                                echo "<option value=".$searchrow['vacancy_id'] .">" . ucfirst($searchrow['position']).' | Valid until: '.$searchrow['closing_date']."</option>";
                                }            
                            ?>
                    </select>
        </div>
    </div>

    <div class="row" id="show_applicants">
        <table class="table table-sm table-bordered table-striped rounded" id="vacancy_tbl" style="background-color: white;">
        </table>
    </div>

    <div class="modal fade" id="show_applicant_details">
        <div class="modal-dialog container modal-dialog-centered mw-100 ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="get_name"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times</button>
                </div>
                <div class="modal-body">
                    <div class="card-deck">
                        <div class="card border-secondary">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg col-sm-6"><p id="get_email"></p></div>
                                    <div class="col-lg col-sm-6"><p id="get_gender"></p></div>
                                    <div class="col-lg col-sm-6"><p id="get_dob"></p></div>
                                    <div class="col-lg col-sm-6"><p id="get_marital_stat"></p></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg col-sm-6"><p id="get_nationality"></p></div>
                                    <div class="col-lg col-sm-6"><p id="get_state"></p></div>
                                    <div class="col-lg col-sm-6"><p id="get_lga"></p></div>
                                    <div class="col-lg col-sm-6"><p id="get_hometown"></p></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg col-sm-12">
                                        <p id="get_address"></p>
                                    </div>
                                    <div class="col-lg col-sm-6">
                                        <p id="get_cv"></p>
                                    </div>
                                </div>
                                
                                
                                <div class="row mx-2">
                                    <h5>Educational History</h5>
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                        <th scope="col">Institution</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Course</th>
                                        <th scope="col">From</th>
                                        <th scope="col">To</th>
                                        <th scope="col">Degree</th>
                                        <th scope="col">Class</th>
                                        </tr>
                                        
                                    </thead>
                                    <tbody id="get_educ">
                                    </tbody>
                                    </table>
                                </div>
                                <div class="row mx-2">
                                    <h5>Work History</h5>
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Organization</th>
                                            <th scope="col">Position Held</th>
                                            <th scope="col">From</th>
                                            <th scope="col">To</th>
                                            <th scope="col">Reason for leaving</th>
                                            <th scope="col">Salary</th>
                                        </tr>
                                    </thead>
                                    <tbody id="get_wkexp">
                                    </tbody>
                                    </table>
                                </div>
                                <div class="row mx-2">
                                    <h5>Referee Details</h5>
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Surname</th>
                                            <th>Other Names</th>
                                            <th>Organization</th>
                                            <th>Designation</th>
                                            <th>Phone Number</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    <tbody id="get_ref">
                                    </tbody>
                                    </table>
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

</div>
</body>
</html>

<script>
    
    var ajaxurl = 'admincontrol.php';
    $("#vacancy").on("change", function(){
        var id = $(this).val();
        //console.log(id);
        $.ajax({
            url:ajaxurl,
            method:'POST',
            data:{id:id, dataname:'showapplicants'},
            success:function(data){
                $("#vacancy_tbl").html(data);
            }
        });
    });

    //$('#vacancy_tbl').DataTable();
    
    $(document).on("click", ".view_app_info", function(e){
        e.preventDefault();
        var details_id = $(this).attr('id');
        $.ajax({
            url:ajaxurl,
            method:"POST",
            dataType:"JSON",
            data:{details_id:details_id,dataname:'showappdetails'},
            success:function(data){
                //console.log(data);
                $("#get_name").html('<span class="font-weight-bold">'+data.surname +'</span> '+ data.other_names);
                $("#get_email").html('<span class="font-weight-bold">Email: </span>'+data.email);
                $("#get_gender").html('<span class="font-weight-bold">Gender: </span>' + data.sex);
                $("#get_dob").html('<span class="font-weight-bold">Date of Birth: </span>' + data.dob);
                $("#get_marital_stat").html('<span class="font-weight-bold">Marital Status: </span>' + data.m_status);
                $("#get_nationality").html('<span class="font-weight-bold">Nationality: </span>' + data.nationality);
                $("#get_state").html('<span class="font-weight-bold">State of Origin: </span>' + data.state_of_origin);   
                $("#get_lga").html('<span class="font-weight-bold">LGA: </span>' + data.lga);
                $("#get_hometown").html('<span class="font-weight-bold">Hometown: </span>' + data.hometown);
                $("#get_address").html('<span class="font-weight-bold">Address: </span>' + data.address);
                $("#get_educ").html(data.educ);
                $("#get_wkexp").html(data.wrk);
                $("#get_ref").html(data.ref);
                $("#get_cv").html('<span class="font-weight-bold">CV: </span><a href="../applicant/cv_uploads/'+data.cv+'" target="_blank">View CV</a>');
            }
        });                 
    });

    $(document).on("click", ".shortlist_appl", function(e){
        e.preventDefault();
    });
</script>