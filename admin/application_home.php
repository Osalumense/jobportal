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
    <title>View Applications</title>
</head>
<body>

    <script>
        $(document).ready(function(){
            $('#applications_tbl').DataTable();
        });
    </script>
    

    <div class="container" id="vacancy_div">
        <div class="row">
            
                <?php
                    $sql = "SELECT *,posts.type as position FROM `job_vacancy_tbl`
                    JOIN departments ON job_vacancy_tbl.department_id=departments.dpid
                    JOIN posts ON job_vacancy_tbl.post_id=posts.typ ORDER BY vacancy_id DESC";
                    $result = $conn->query($sql);
                    $searchrow = $result->fetchAll(PDO::FETCH_ASSOC);
                    // <div class="card-header">'.$row['dept'].' department</div>
                    foreach($searchrow as $row){
                        $vacid = $row['vacancy_id'];
                        $sq2 = "SELECT COUNT(applicant_id) AS cid FROM job_applicants_tbl WHERE vacancy_id = '$vacid'";
                        $reslt = $conn->query($sq2);
                        $ret = $reslt->fetch(PDO::FETCH_ASSOC);
                        $cid = $ret['cid'];

                        // $sq3 = "SELECT COUNT(applicant_id) AS cid FROM job_applicants_tbl WHERE vacancy_id = '$vacid' AND status='submitted'";
                        // $get = $conn->query($sq3);
                        // $val = $get->fetch(PDO::FETCH_ASSOC);
                        // $submittedapplications = $val['cid'];

                        $sql3 = "SELECT DISTINCT application_status FROM application_status_tbl";
                        $result = $conn->query($sql3);
                        $getstats = $result->fetchAll(PDO::FETCH_ASSOC);
                        
                        $status = '';
                        foreach($getstats as $stats){
                            $appstatus = $stats['application_status'];
                            $query = "SELECT count(status) AS shortlist FROM job_applicants_tbl WHERE vacancy_id = '$vacid' AND status='$appstatus'";
                            $ret = $conn->query($query);
                            $statuses = $ret->fetch(PDO::FETCH_ASSOC);
                            $stat_rows = $ret->rowCount();
                            $stat_count = $statuses['shortlist'];
                            if($stat_count > 0){
                                    $status .=  '<a href="'.$vacid.'" class="card-text font-italic my-n1 badge badge-info getjobinfo" id="'.$appstatus.'">'.$stat_count.' '.$appstatus.'<span><i class="fas fa-arrow-circle-right ml-2"></i></span></a>'; 
                                    $status .= '<br><p class="card-text font-italic my-n1 badge badge-info">'.$stat_rows.' total applications</p>
                                    <a href="#" id="'.$vacid.'" class="view_details p-1 badge badge-light float-right mt-2">View Completed Applications <span><i class="fas fa-arrow-circle-right ml-2"></i></span></a>'; 
                            }                           
                        }


                        // $sq4 = "SELECT COUNT(applicant_id) AS cid FROM job_applicants_tbl WHERE vacancy_id = '$vacid' AND status='incomplete'";
                        // $getid = $conn->query($sq4);
                        // $vals = $getid->fetch(PDO::FETCH_ASSOC);
                        // $incompleteapplications = $vals['cid'];

                        // $sq5 = "SELECT COUNT(applicant_id) AS cid FROM job_applicants_tbl WHERE (vacancy_id = '$vacid' AND status='shortlisted')";
                        // $getshortlisted = $conn->query($sq5);
                        // $val = $getshortlisted->fetch(PDO::FETCH_ASSOC);
                        // $shortlisted = $val['cid'];

                        // <p class="card-text font-italic my-n1 p-1 badge badge-success">'.$submittedapplications.' submitted applications</p>
                        //             <p class="card-text font-italic my-n1 p-1 badge badge-secondary">'.$shortlisted.' shortlisted applicants</p>
                        //             <p class="card-text font-italic my-n1 p-1 badge badge-danger">'.$incompleteapplications.' incomplete applications</p> 

                        // <a href="'.$vacid.'" class="card-text font-italic my-n1 p-1 badge badge-info getjobinfo" id="submitted">'.$submittedapplications.' submitted applications<span><i class="fas fa-arrow-circle-right ml-2"></i></span></a>'
                        //             .$status.'
                        //             <p class="card-text font-italic my-n1 p-1 badge badge-danger" id="incomplete">'.$incompleteapplications.' incomplete applications</p>
                        //             <p class="card-text font-italic my-n1 p-1 badge badge-success">'.$cid.' total applications</p>
                        echo '
                        <div class="card border-dark bg-light m-3 col-sm-3">
                                <div class="card-body text-dark jobdetails">
                                    <h5 class="card-title">'.$row['position'].'</h5>
                                    <p class="card-text font-italic my-n1">Department: '.$row['dept'].'</p>
                                    <p class="card-text font-italic my-n1">Date Posted: '.date_format(date_create($row['creation_date']), "d-M-Y").'</p>
                                    <p class="card-text font-italic my-n1">Valid Until: '.date_format(date_create($row['closing_date']), "d-M-Y").'</p>'.$status.'                                 
                                                                      
                                </div>
                        </div>';
                    }

                ?>
        </div>
    </div>

    <div class="container" style="display: none" id="details_div"> 
        <div class="row my-3">
            <a href="" id="bck" class="badge badge-dark font-weight-bold"><span><i class="fas fa-arrow-circle-left mr-2 p-1"></i></span>Go Back </a>
        </div>
        <div class="row mx-auto" >
            <div class="col-sm-12">
                <table class="table table-sm table-responsive table-bordered" id="applications_tbl">
                    <thead class="bg-light">
                        <tr>
                                <!-- <th scope="col">Applicant ID</th> -->
                            <th scope="col">Category</th>
                            <th scope="col">Post</th>
                            <th scope="col">Applicant ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Name</th>
                            <th scope="col">Age (yrs)</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Email</th>
                            <th scope="col">phone Number</th>
                            <th scope="col">Marital Status</th>
                            <th scope="col">Address (City)</th>
                            <th scope="col">Qualifications</th>
                            <th scope="col">Experience (Months)
                            </th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="details">
                       
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
                    <div class="mx-auto" id="get_action"></div>
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
    $(document).on("click", ".view_details", function(e){
        e.preventDefault();
        let id = $(this).attr("id");
        $.ajax({
            url: "admincontrol.php",
            method:"POST",
            data:{id:id,dataname:'showapptbl'},
            success:function(data){
                $("#vacancy_div").hide();
                $("#details_div").show(); 
                $("#details").html(data);          
            }
        });
    });

    $("#bck").click(function(e){
        e.preventDefault();
        window.location='application_home.php'; 
    });

    //Ajax request to view applicant details
    $(document).on("click", ".view_app_info", function(e){
        e.preventDefault();
        var details_id = $(this).attr('id');
        $.ajax({
            url:"admincontrol.php",
            method:"POST",
            dataType:"JSON",
            data:{details_id:details_id,dataname:'showappdetails'},
            success:function(data){
                $("#get_name").html('<span class="font-weight-bold">'+data.surname +'</span> '+ data.other_names);
                // $("#get_action").html(data.shortlist +' '+data.reject);
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

    //Ajax request for shortlist status update
    $(document).on("change", ".action", function(e){
        e.preventDefault();
        var status = $(this).val();
        var id = $("#details tr").find('td:eq(2)').text();

        $.ajax({
            url: "admincontrol.php",
            method:"POST",
            data:{id:id,status:status,dataname:'action'},
            success:function(data){ 
                alert(data);
                $("#details tr").find('td:eq(13)').html('<h6 class="badge badge-primary"><span><i class="far fa-check-circle mr-1"></i></span>'+status+'</h6>'); 
            }
        });              

    });

    $(document).on("click", ".getjobinfo", function(e){
        e.preventDefault();
        var status = $(this).attr("id");
        var id = $(this).attr('href');

        $.ajax({
            url: "admincontrol.php",
            method:"POST",
            data:{id:id,status:status,dataname:'getapplicantstbl'},
            success:function(data){
                $("#vacancy_div").hide();
                $("#details_div").show(); 
                $("#details").html(data);          
            }
        });        
    });



    //Ajax request to shortlist applicant
    // $(document).on("click", ".shortlist_applicant", function(e){
    //     e.preventDefault();
    //     var applicant_id = $(this).attr('id');
    //     $.ajax({
    //         url: "admincontrol.php",
    //         method:"POST",
    //         dataType:"JSON",
    //         data:{applicant_id:applicant_id,dataname:'shortlist_applicant'},
    //         success:function(data){
    //             alert(data.msg);
    //             $("#details").html(data.tbl_details); 
    //         }
    //     }); 
    // });

    // //Ajax request to reject applicant
    // $(document).on("click", ".reject_applicant", function(e){
    //     e.preventDefault();
    //     var applicant_id = $(this).attr('id');
    //     $.ajax({
    //         url: "admincontrol.php",
    //         method:"POST",
    //         dataType:"JSON",
    //         data:{applicant_id:applicant_id,dataname:'reject_applicant'},
    //         success:function(data){ 
    //             alert(data.msg);
    //             $("#details").html(data.tbl_details);         
    //         }
    //     }); 
    // });
</script>