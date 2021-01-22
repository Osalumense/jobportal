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
    <h5 class="text-center mt-3 bg-light p-2">VIEW SHORTLISTED APPLICANTS</h5>
    <script>
        $(document).ready(function(){
            $('#applications_tbl').DataTable();
        });
    </script>

        <div class="container">            
            <div class="row mx-auto" >
                <div class="col-sm-12">
                    <table class="table table-sm table-responsive table-bordered" id="applications_tbl">
                        <thead class="bg-light">
                            <tr>
                                <!-- <th scope="col">Applicant ID</th> -->
                                <th scope="col">Category</th>
                                <th scope="col">Post</th>
                                <th scope="col">Title</th>
                                <th scope="col">Name</th>
                                <th scope="col">Age (yrs)</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Email</th>
                                <th scope="col">phone Number</th>
                                <th scope="col">Marital Status</th>
                                <th scope="col">Address (City)</th>
                                <th scope="col">Qualifications</th>
                                <th scope="col">Specialization</th>
                                <th scope="col">Experience (Months)
                                </th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql="SELECT *, posts.type AS position, 
                                employmentcategory.type AS empcat,
                                employmenttype.type AS emptype,
                                departments.dept AS dept
                                FROM job_applicants_tbl 
                                JOIN employmentcategory ON job_applicants_tbl.vacancy_category_id=employmentcategory.id
                                JOIN employmenttype ON job_applicants_tbl.employment_type=employmenttype.id
                                JOIN departments ON job_applicants_tbl.department_id=departments.id
                                JOIN posts ON job_applicants_tbl.position_id=posts.id
                                WHERE submit_status='submitted' AND shortlist_status='shortlisted'";
                                $result = $conn->query($sql);
                                while ($row = $result->fetch()) {
                                    $age = (date_diff(date_create(), date_create($row['dob'])))->format("%Y");
                                    $app_id = $row['applicant_id'];
                                    $vacancy_id = $row['vacancy_id'];
                                    $sql2 = "SELECT applicant_id, vacancy_id, GROUP_CONCAT(degree) as degs FROM educational_history_tbl WHERE applicant_id = $app_id AND vacancy_id = $vacancy_id group by applicant_id";
                                    $result2 = $conn->query($sql2);
                                    $row2 = $result2->fetch();
                                    $qualifs = $row2['degs'];

                                    $sql3 = "SELECT applicant_id, vacancy_id, GROUP_CONCAT(course) as courses FROM educational_history_tbl WHERE applicant_id = $app_id AND vacancy_id = $vacancy_id group by applicant_id";
                                    $result3 = $conn->query($sql3);
                                    $row3 = $result3->fetch();
                                    $specs = $row3['courses'];

                                    $sql4 = "SELECT applicant_id, SUM(TIMESTAMPDIFF(MONTH, start_date, end_date)) AS wrk_exp FROM workexperience_tbl WHERE applicant_id = $app_id AND vacancy_id = $vacancy_id";
                                    $result4 = $conn->query($sql4);
                                    $row4 = $result4->fetch();
                                    $wkexp = $row4['wrk_exp'];
                                    
                                    $data = '<tr class="" style="background-color: white">
                                            <td>'.$row['empcat'].'</td>
                                            <td>'.$row['position'].'</td>
                                            <td>'.$row['title'].'</td>
                                            <td><span class="font-weight-bold">'.$row['surname'].'</span>'.' '.$row['first_name'].' '.$row['other_name'].'</td>
                                            <td>'.$age.'</td>
                                            <td>'.$row['sex'].'</td>
                                            <td>'.$row['email'].'</td>
                                            <td>'.$row['phone_number'].'</td>
                                            <td>'.$row['marital_status'].'</td>
                                            <td>'.$row['city'].'</td>';
                                            $data .= '<td>'.$qualifs.' | '.$specs.'</td>
                                            <td></td>
                                            <td>'.$wkexp.'</td>
                                            <td><a href="" id="'.$app_id.'" title="View Details" class="text-info view_app_info"><i class="fas fa-info-circle fa-1x"></i></a></td>
                                        </tr>';
                                        echo $data;
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
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
    </body>

</html>

<script>
var ajaxurl = 'admincontrol.php';

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
                $("#show_applicant_details").modal('show');
            }
        });                 
    });

</script>