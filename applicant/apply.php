<?php
require_once '../includes/applicant_header.php';
require_once '../includes/db_conn.php';
?>

<div class="container mx-auto mt-4">
        <div class="preloader" style="position: absolute; top: 50%; left: 50%; margin: -25px 0 0 -25px;">
            <h5>Loading...</h5>
        </div>
        <script>
            $(window).on("load", function(){
                $('.preloader').fadeOut('slow');
            });
        </script>
        
        <?php
            //Select details of the job from job_vacancy_tbl and check if the job is still valid
            $id = $_GET['id'];
            if(!isset($id)){
                header("Location:jobs.php");
            }
            else{
                echo '';
            }
            $today = date("Y-m-d");
            $sql = "SELECT *, posts.type AS emptype FROM job_vacancy_tbl LEFT JOIN posts ON job_vacancy_tbl.post_id=posts.id WHERE vacancy_id = '$id'";
            $result = $conn->query($sql);
            $jobs = $result->fetch();
            $created = $jobs['creation_date'];
            $job = $jobs['emptype'];
            $expires = $jobs['closing_date'];
            if($today < $expires){
                echo '';
            } else{
                echo'<script>
                        alert("Application period closed, go back to vacancies");
                        window.location="jobs.php";
                    </script>';
                //header("Location:jobs.php");
            }
            $uid = $user['uid'];
            $sql3="SELECT * FROM job_applicants_tbl WHERE (vacancy_id='$id' AND uid='$uid') AND (submit_status='submitted')";
            $result3=$conn->query($sql3);
            if($result3->rowCount() > 0){
                echo'<script>
                        alert("You have applied for this job already");
                        window.location="jobs.php";
                    </script>';
            }  

            echo "<div class='row mx-auto ml-2 mt-n4 p-2 rounded shadow' style='background-color:white'>
                    <div class='col'>
                        <h5 class='text-secondary'><span class='lead'>Applying for: </span>$job</h5>
                    </div>
                    <div class='col'>
                        <h5 class='float-right text-secondary'><span class='lead'>Expires: </span>$expires</h5>
                    </div>
                  </div>";            
        ?>

</div>

<script>
    var id = '<?=$id?>';
    var uid = '<?=$user['uid']?>';

    $.ajax({
        url:"applicant_control.php",
        method:"POST",
        dataType:"JSON",
        data:{id:id,uid:uid,dataname:'populate_data'},
        success:function(data){
            if(data != ''){
                $("#title option:selected").text(data.title);
                $("#other_names").val(data.other_name);          
                $("#gender option:selected").text(data.gender);
                $("#dob").val(data.dob);
                $("#marital_status option:selected").text(data.marital_status);
                $("#nationality option:selected").text(data.nationality);
                $("#states option:selected").text(data.states);
                $("#lga").html(data.lg);
                $("#lga option:selected").text(data.lga);
                $("#hometown").val(data.hometown);
                $("#email").val(data.email);
                $("#phone_number1").val(data.phone1);
                $("#phone_number2").val(data.phone2);
                $("#address").val(data.address);
                $("#city").val(data.city);
                $("#state_of_residence option:selected").text(data.state_of_residence);
                $("#application_message").val(data.app_message);
                if(data.educ != ''){
                    $("#education").html(data.educ);
                }
                if(data.wrk != ''){
                    $("#work_exp").html(data.wrk);
                }
                if(data.ref != ''){
                    $("#referee").html(data.ref);
                }
                if(data.cv != ''){
                    var cvpath = 'cv_uploads/'+data.cv;
                    $("#cv_tmp").show();
                    $("#cv_upl").attr('src', cvpath);
                    $("#application_message").attr('rows', '8');
                }
            }
        }
    });

</script>


<div class="container-responsive mx-5">
    <div class="row">
        <div class="col-lg-8 mx-auto mt-2" style="display:none" id="errlog">
            <div class="alert alert-danger">
                <p id="errmsg"></p>
            </div>
            <div id="msg">
            </div>
        </div>
    </div>
    
    <div class="row justify-content-center">
        <div class="col mx-auto">
            <div class="card rounded mt-1">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a href="#personal-details" data-toggle="tab" role="tab" class="nav-link active text-secondary" ><i class="fa fa-user fa-2x mr-1" aria-hidden="true"></i>Personal details</a>
                        </li>
                        <li class="nav-item">
                            <a href="#contact-details" data-toggle="tab" role="tab" class="nav-link text-secondary"><i class="fa fa-address-card fa-2x mr-1" aria-hidden="true"></i>Contact details</a>
                        </li>
                        <li class="nav-item">
                            <a href="#educational-history" data-toggle="tab" role="tab"class="nav-link text-secondary"><i class="fa fa-user-graduate fa-2x mr-1" aria-hidden="true"></i>Educational History</a>
                        </li>
                        <li class="nav-item">
                            <a href="#work-experience" data-toggle="tab" role="tab"class="nav-link text-secondary"><i class="fa fa-briefcase fa-2x mr-1" aria-hidden="true"></i>Work Experience</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="#referees" data-toggle="tab" role="tab"class="nav-link text-secondary"><i class="fa fa-house-user fa-2x mr-1" aria-hidden="true"></i>Certifications</a>
                        </li> 
                        <li class="nav-item">
                            <a href="#referees" data-toggle="tab" role="tab"class="nav-link text-secondary"><i class="fa fa-house-user fa-2x mr-1" aria-hidden="true"></i>Specializations</a>
                        </li> -->
                        <li class="nav-item">
                            <a href="#referees" data-toggle="tab" role="tab"class="nav-link text-secondary"><i class="fa fa-house-user fa-2x mr-1" aria-hidden="true"></i>Referees</a>
                        </li>
                        <li class="nav-item">
                            <a href="#uploads" data-toggle="tab" role="tab"class="nav-link text-secondary"><i class="fas fa-upload fa-2x mr-"></i>Uploads</a>
                        </li>
                    </ul>
                </div>
                <form action="" id="apply-form" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="tab-content">

                        <!-- profile tab content start -->
                        <div class="tab-pane container-responsive active" id="personal-details">
                            <div class="row mx-auto">
                                <div class="col-lg-2 col-sm-6 mt-2">                        
                                  <label for="title" class="text-muted font-weight-bold">Title</label>
                                  <select name="title" id="title" class="form-control form-control-sm">
                                          <option value="">Title</option>                      
                                          <?php
                                              $sql="SELECT * FROM titles";
                                              $result = $conn->query($sql);
                                              while($searchrow = $result->fetch()){
                                              echo "<option value=".$searchrow['titleid'] .">" . ucfirst($searchrow['title']) ."</option>";
                                              }            
                                          ?>
                                  </select>
                                </div>
                            </div>
                          <!-- first row start -->
                          <div class="row mx-auto">
                              <div class="col-md-4 col-sm-6 mt-2">                        
                                <label for="surname" class="text-muted font-weight-bold">Surname</label>
                                <input type="text" name="surname" id="surname" placeholder="Surname" value="<?=$user['lname']?>" class="form-control form-control-sm">
                              </div>

                              <div class="col-md-4 col-sm-6 mt-2">                        
                                <label for="first_name" class="text-muted font-weight-bold">First Name</label>
                                <input type="text" name="first_name" id="first_name" value="<?=$user['fname']?>" placeholder="First Name" class="form-control form-control-sm">
                              </div>

                              <div class="col-md-4 col-sm-6 mt-2">                        
                                <label for="other_names" class="text-muted font-weight-bold">Other Names</label>
                                <input type="text" name="other_names" id="other_names" value="<?=$user['other_name']?>" placeholder="Other Name" class="form-control form-control-sm">
                              </div>                            
                          </div>
                          <!-- first row ends -->

                          <!-- second row starts -->
                          <div class="row mx-auto mt-4">
                            <div class="col-md-3 col-sm-6 ">                        
                              <label for="gender" class="text-muted font-weight-bold">Gender</label>
                                    <select name="" id="gender" class="form-control form-control-sm">
                                        <option value="">Select gender</option>                      
                                        <?php
                                            $sql="SELECT * FROM gender";
                                            $result = $conn->query($sql);
                                            while($searchrow = $result->fetch()){
                                            echo "<option value=".$searchrow['id'] .">" . ucfirst($searchrow['full']) ."</option>";
                                            }            
                                        ?>
                                    </select>
                            </div>


                            <div class="col-md-3 col-sm-6">                        
                                <label for="dob" class="text-muted font-weight-bold">Date of Birth</label>
                                  <input type="date" name="dob" id="dob" class="form-control form-control-sm">
                            </div>                            

                            <div class="col-md-3 col-sm-6">                        
                                <label for="marital_status" class="text-muted font-weight-bold">Marital Status</label>
                                    <select name="" id="marital_status" class="form-control form-control-sm">
                                        <option value="">Marital Status</option>                      
                                        <?php
                                            $sql="SELECT * FROM maritalstatus";
                                            $result = $conn->query($sql);
                                            while($searchrow = $result->fetch()){
                                            echo "<option value=".$searchrow['id'] .">" . ucfirst($searchrow['mstatus']) ."</option>";
                                            }            
                                        ?>
                                    </select>
                            </div>

                            <div class="col-md-3 col-sm-6 ">                        
                              <label for="nationality" class="text-muted font-weight-bold">Nationality</label>
                                    <select name="" id="nationality" class="form-control form-control-sm">
                                        <option value="">Select Nationality</option> 
                                        <option value="159">Nigeria</option>                   
                                        <?php
                                            $sql="SELECT * FROM countries WHERE countryid != '159'";
                                            $result = $conn->query($sql);
                                            while($searchrow = $result->fetch()){
                                            echo "<option value=".$searchrow['countryid'] .">" . ucfirst($searchrow['country']) ."</option>";
                                            }            
                                        ?>
                                    </select>
                            </div>                            
                          </div>      

                          <!-- second row ends        -->
                           
                          <!-- third row starts -->
                           <div class="row mx-auto my-4" id="countrydetails">
                            


                            <div class="col-md-4 col-sm-6">                        
                                <label for="states" class="text-muted font-weight-bold">State of origin</label>
                                  <select name="" id="states" class="form-control form-control-sm">
                                        <option value="">state of origin</option>                      
                                        <?php
                                            $sql="SELECT * FROM states";
                                            $result = $conn->query($sql);
                                            while($searchrow = $result->fetch()){
                                            echo "<option value=".$searchrow['state_id'] .">" . ucfirst($searchrow['state_name']) ."</option>";
                                            }            
                                        ?>
                                  </select>
                            </div>                            

                            <div class="col-md-4 col-sm-6">                        
                                <label for="lga" class="text-muted font-weight-bold">LGA</label>
                                    <select name="lga" id="lga" class="form-control form-control-sm">
                                    </select>
                            </div>   

                            <div class="col-md-4 col-sm-6">                        
                                <label for="hometown" class="text-muted font-weight-bold">Hometown</label>
                                <input type="text" placeholder="Hometown" id="hometown" class="form-control form-control-sm">
                            </div>                            
                          </div>  

                          <!-- third row ends -->

                              <!-- submmit button row  -->
                              <div class="row mx-auto mb-4">
                                            <button class="btn btn-md btn-secondary mx-auto mt-3" id="save_for_later">Save and Continue Later</button>
                            </div>
                            <!-- submit button row end -->


                    </div>

                        <!-- personal details tab content end -->

                        <!-- contact details tab content start -->
                        <div class="tab-pane container-reponsive" id="contact-details">
                            <!-- first row start -->
                            <div class="row mx-auto">

                                <div class="col-md-5 col-sm-6">                        
                                    <label for="email" class="text-muted font-weight-bold">Email</label>
                                    <input type="text" placeholder="Enter email" id="email" value="<?=$user['email']?>" class="form-control form-control-sm">
                                </div>

                                <div class="col-md-3 col-sm-6">                        
                                    <label for="phone_number" class="text-muted font-weight-bold">Phone Number</label>
                                    <input type="text" placeholder="Enter phone number" value="<?=$user['phone_number']?>" id="phone_number1" class="form-control form-control-sm">
                                </div>

                                <div class="col-md-3 col-sm-6">                        
                                    <label for="phone_number" class="text-muted font-weight-bold">Alternate Phone Number</label>
                                    <input type="text" placeholder="Enter phone number" id="phone_number2" class="form-control form-control-sm">
                                </div>
                            </div>
                            <!-- first row end -->

                            <!-- second row start -->
                            <div class="row mx-auto my-4">
                                <div class="col-md-5 col-sm-6">                        
                                    <label for="city" class="text-muted font-weight-bold">Address</label>
                                    <input type="text" placeholder="Enter address" id="address" class="form-control form-control-sm">
                                </div>

                                <div class="col-md-3 col-sm-6">                        
                                    <label for="city" class="text-muted font-weight-bold">City</label>
                                    <input type="text" placeholder="City" id="city" class="form-control form-control-sm">
                                </div>

                                <div class="col-md-3 col-sm-6">                        
                                    <label for="" class="text-muted font-weight-bold">State</label>
                                    <select name="" id="state_of_residence" class="form-control form-control-sm">
                                        <option value="">state of residence</option>                      
                                        <?php
                                            $sql="SELECT * FROM states";
                                            $result = $conn->query($sql);
                                            while($searchrow = $result->fetch()){
                                            echo "<option value=".$searchrow['state_id'] .">" . ucfirst($searchrow['state_name']) ."</option>";
                                            }            
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- second row end -->
                                <!-- submmit button row  -->
                                <div class="row mx-auto mb-4">
                                            <button class="btn btn-md btn-secondary mx-auto mt-3" id="save_for_later">Save and Continue Later</button>
                            </div>
                            <!-- submit button row end -->
                        </div>
                        <!-- contact details tab end -->

                        <!-- educational-history tab starts -->
                        <div class="tab-pane container-responsive" id="educational-history">
                            
                            <div class="row mx-auto">
                                        <div class="col-md-6">
                                            <em class="text-muted">Enter most recent educational history first</em>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn-sm btn-info float-right" id="add_educ">Add New</button>
                                        </div> <br>
                            </div>

                            <div id="education">
                                <div class="row mx-auto justify-content-center" id="educ_row">
                                        <div class="col-lg-3 col-sm-6 mx-n2">
                                            <label for="institution" class="text-muted font-weight-bold ">Institution</label><br>
                                            <input type="text" placeholder="Institution Attended" name="institution1" id="institution1" class="form-control form-control-sm">
                                        </div>   

                                        <div class="col-lg-2 col-sm-6 mx-n2">
                                            <label for="sch_location" class="text-muted text-center font-weight-bold">Location</label><br>
                                            <input name="sch_location" placeholder="School location" id="sch_location" class="form-control form-control-sm">
                                       </div>

                                        <div class="col-lg col-sm-6 mx-n2">                        
                                            <label for="institution_from" class="text-muted font-weight-bold">From</label><br>
                                            <input type="date"
                                            name="institution_from" id="institution_from" class="form-control form-control-sm">
                                        </div>                          

                                        <div class="col-lg col-sm-6 mx-n2">                        
                                            <label for="institution_to" class="text-muted font-weight-bold">To</label><br>
                                            <input type="date" name="institution_to" id="institution_to"  class="form-control form-control-sm">
                                        </div>                       
                                
                                        <div class="col-lg-3 col-sm-6 mx-n2">                        
                                            <label for="course" class="text-muted font-weight-bold">Course</label><br>
                                            <input type="text" placeholder="Course of study" id="course"  name="course" class="form-control form-control-sm">
                                        </div>                        
                                        
                                        <div class="col-lg-1 col-sm-6 mx-n2">                        
                                            <label for="degree" class="text-muted font-weight-bold">Degree</label><br>
                                            <input type="text" name="degree" id="degree"  placeholder="Degree attained" class="form-control form-control-sm">
                                            
                                        </div>

                                        <div class="col-lg-1 col-sm-6 mx-n2">                        
                                            <label for="" class="text-muted font-weight-bold">Class</label><br>
                                            <select 
                                            name="class_of_degree"  id="class_of_degree" class="form-control form-control-sm">
                                                <option value="">Class of degree</option>                      
                                                <?php
                                                    $sql="SELECT * FROM class_of_degree";
                                                    $result = $conn->query($sql);
                                                    while($searchrow = $result->fetch()){
                                                    echo "<option value=".$searchrow['degree_id'] .">" . ucfirst($searchrow['degree']) ."</option>";
                                                    }            
                                                ?>
                                            </select>      
                                            
                                        </div>                                  
                                </div> 
                            </div>   
                                <!-- submmit button row  -->
                                <div class="row mx-auto mb-4">
                                            <button class="btn btn-md btn-secondary mx-auto mt-3" id="save_for_later">Save and Continue Later</button>
                            </div>
                            <!-- submit button row end -->                    
                        </div>
                        <!-- educational-history tab end -->

                          <!-- work experience tab start -->
                        <div class="tab-pane container-reponsive" id="work-experience">
                                <div class="row mx-auto">

                                    <div class="col-md-6">
                                        <em class="text-muted">Enter most recent work history first</em>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn-sm btn-info float-right" id="add_work">Add New</button>
                                    </div> <br>
                                      
                                </div>    

                                <div id="work_exp">
                                    <div class="row mx-auto justify-content-center" id="work_row">
                                    
                                        <div class="col-lg-3 col-sm-6 mx-n2">
                                            <label for="organization" class="text-muted font-weight-bold">Organization</label>
                                            <input type="text" placeholder="Previous Organization" name="prev_organization" class="form-control form-control-sm">
                                        </div>
                                        
                                        <div class="col-lg-3 col-sm-6 mx-n2">
                                            <label for="position_held" class="text-muted font-weight-bold">Position Held</label>
                                            <input type="text" placeholder="Last position held" name="position_held" class="form-control form-control-sm">
                                        </div> 
                                        
                                        <div class="col-lg col-sm-6 mx-n2">
                                            <label for="organization" class="text-muted font-weight-bold">From</label>
                                            <input type="date" name="organization_from" class="form-control form-control-sm">
                                        </div>
                                        
                                        <div class="col-lg col-sm-6 mx-n2"> 
                                            <label for="organization" class="text-muted font-weight-bold">To</label>
                                            <input type="date" name="organization_to" class="form-control form-control-sm"> 
                                        </div> 

                                        <div class="col-lg-3 col-sm-6 mx-n2">
                                            <label for="reason_for_leaving" class="text-muted font-weight-bold">Reason for leaving</label>
                                            <input type="text" placeholder='Reason for leaving' name="reason_for_leaving" class="form-control form-control-sm">
                                        </div>
                                        
                                        <div class="col-lg-1 col-sm-6 mx-n2">
                                            <label for="prev_salary" class="text-muted font-weight-bold">Salary</label> 
                                            <input type="text" name="prev_salary" placeholder="Salary received" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>

                                    <!-- submmit button row  -->
                            <div class="row mx-auto mb-4">
                                            <button class="btn btn-md btn-secondary mx-auto m-3" id="save_for_later">Save and Continue Later</button>
                            </div>
                            <!-- submit button row end -->
                        </div>
                        <!-- work experience tab end -->

                        <!-- referees tab start -->
                        <div class="tab-pane container-reponsive" id="referees">
                            <!-- first row start -->

                            <div class="row mx-auto">
                                <div class="col">
                                    <button class="btn-sm btn-info float-right" id="add_ref">Add New</button>
                                </div>
                            </div>
                            <div id="referee">
                                <div id="ref_row">
                                    <div class="row mx-auto justify-content-center mt-2">
                                        <div class="col-lg-1 col-sm-6 mx-n2">
                                            <label for="ref_title" class="text-muted font-weight-bold">Title</label>
                                            <select name="ref_title" id="ref_title" class="form-control form-control-sm" required>
                                                    <option value="">Title</option>                      
                                                    <?php
                                                        $sql="SELECT * FROM titles";
                                                        $result = $conn->query($sql);
                                                        while($searchrow = $result->fetch()){
                                                        echo "<option value=".$searchrow['titleid'] .">" . ucfirst($searchrow['title']) ."</option>";
                                                        }            
                                                    ?>
                                            </select>
                                        </div>
                                        <div class="col-lg col-sm-6 mx-n2">
                                            <label for="ref_surname" class="text-muted font-weight-bold">Surname</label> 
                                            <input type="text" name="ref_surname" id="ref_surname" placeholder="Surname" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-lg col-sm-6 mx-n2">
                                            <label for="ref_other_names" class="text-muted font-weight-bold">Other Names</label> 
                                            <input type="text" name="ref_other_names" id="ref_other_names"
                                            placeholder="Other Names" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-lg col-sm-6 mx-n2">
                                            <label for="ref_phone_number" class="text-muted font-weight-bold">Phone Number</label> 
                                            <input type="text" name="ref_phone_number" id="ref_phone_number" placeholder="Phone Number" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-lg-3 col-sm-6 mx-n2">
                                            <label for="ref_email" class="text-muted font-weight-bold">Email</label> 
                                            <input type="text" name="ref_email" id="ref_email" placeholder="Email" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-lg col-sm-6 mx-n2">
                                            <label for="ref_org" class="text-muted font-weight-bold">Organization</label> 
                                            <input type="text" name="ref_org" id="ref_org" placeholder="Organization"  class="form-control form-control-sm">
                                        </div>
                                        <div class="col-lg col-sm-6 mx-n2">
                                            <label for="ref_designation" class="text-muted font-weight-bold">Designation</label>
                                            <input type="text" name="ref_designation" id="ref_designation" placeholder="Designation" class="form-control form-control-sm">
                                        </div>
                                    </div>
                            </div>
                                 
                            </div>
                            <!-- third row end -->

                            <!-- submmit button row  -->
                            <div class="row mx-auto mb-4">
                                            <button class="btn btn-md btn-secondary mx-auto mt-3" id="save_for_later">Save and Continue Later</button>
                            </div>
                            <!-- submit button row end -->
                        </div>
                        <!-- referees tab end -->

                        <!-- uploads tab start -->
                        <div class="tab-pane container-reponsive" id="uploads">
                                     <div class="row mx-auto">
                                        <div class="col-lg-4 col-sm-6 mt-2 mx-3">
                                            <label for="cv" class="text-muted font-weight-bold">Upload CV</label> <br><small class="text-muted">CV should be in PDF format only</small>
                                            <input class="form-control form-control-sm" type="file" name="cv" id="cv">
                                            <div class="col-lg-4 col-sm-6" id="cv_tmp" style="display:none"> <embed id="cv_upl"  src="" type="application/pdf">
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-sm-6 mt-2 mx-3">                        
                                            <label for="application_message" class="text-muted font-weight-bold">Cover Letter</label><br>
                                            <small class="text-muted">Maximum 1000 characters</small>
                                            <textarea name="application_message" id="application_message" maxlength="1000" cols="30" rows="3" class="form-control form-control-sm"></textarea>
                                        </div>
                                    </div>

                                    <div class="row mx-auto">                             </div>
                                    <div class="row mx-auto">
                                        <div class="form-group mt-2">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="customcheck" class="custom-control-input" id="customcheck">
                                                <label for="customcheck" class="custom-control-label text-secondary">I affirm that all information provided in this application are true and can be verified at any point in time.</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- submmit button row  -->
                                    <div class="row mx-auto mb-4">
                                        <button class="btn btn-md btn-secondary mx-auto m-3" id="save_for_later">Save and Continue Later</button>
                                        <button class="btn btn-md btn-info mx-auto m-3" id="submit">Submit Application</button>
                                    </div>
                                    <!-- submit button row end -->
                                     
                        </div>
                        <!-- upload tab end -->
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>


</body>
</html>

<script>

    var ajaxurl = "applicant_control.php";
    $("#apply-form").click(function(){ 
        $("#msg, #error").empty();
        $("#error").hide('slow');
    });

    $("#states").on("change", function(){
      var stateid = $(this).val();
      $.ajax({
        url:ajaxurl,
        type:"POST",
        data:{stateid:stateid,dataname:'showlga'},
        success:function(data){
                var seloption = '<option value="">Select lga</option>';
                $("#lga").html(data);
                $("#lga").prepend(seloption);
                $("#lga").val("");
            }
      });
    });

    $("#add_educ").click(function(e){
        e.preventDefault();
        var newrow = '<div id="educ_row"><div class="row mx-auto mt-1 justify-content-end"><button style="line-height:7px;" class="btn-sm btn-danger float-right" id="del_educ">Delete</button></div><div class="row mx-auto mt-2 justify-content-center"><div class="col-lg-3 col-sm-6 mx-n2"><input type="text" placeholder="Institution Attended" name="institution1" class="form-control form-control-sm institution1"></div> <div class="col-lg-2 col-sm-6 mx-n2"> <input name="sch_location" placeholder="School location" id="sch_location" class="form-control form-control-sm"> </div>  <div class="col-lg col-sm-6 mx-n2"><input type="date" name="institution_from" class="form-control form-control-sm"></div> <div class="col-lg col-sm-6 mx-n2"><input type="date" name="institution_to" class="form-control form-control-sm"></div> <div class="col-lg-3 col-sm-6 mx-n2"> <input type="text" placeholder="Course of study" name="course" class="form-control form-control-sm"> </div> <div class="col-lg-1 col-sm-6 mx-n2"> <input type="text" name="degree" class="form-control form-control-sm"></div><div class="col-lg-1 col-sm-6 mx-n2"><select name="class_of_degree" id="class_of_degree" class="form-control form-control-sm"> <option value="">Class of degree</option><?php $sql="SELECT * FROM class_of_degree"; $result = $conn->query($sql);
                                            while($searchrow = $result->fetch()){echo "<option value=".$searchrow['degree_id'] .">" . ucfirst($searchrow['degree']) ."</option>";}            
                                        ?> </select></div> </div></div>';

        $("#education").append(newrow);
    });

    $(document).on("click", "#del_educ", function(){
        $(this).closest("#educ_row").remove();
    });

    $(document).on("click", "#add_work", function(e){
        e.preventDefault();
        var addrow = '<div id="work_row"><div class="row mx-auto mt-1 justify-content-end"><button mx-auto style="line-height:7px;" class="btn-sm btn-danger float-right" id="del_work">Delete</button></div><div class="row mx-auto mt-2 justify-content-center"><div class="col-lg-3 col-sm-6 mx-n2"><input type="text" placeholder="Previous Organization" name="prev_organization" class="form-control form-control-sm"></div><div class="col-lg-3 col-sm-6 mx-n2"><input type="text" placeholder="Enter position held" name="position_held" class="form-control form-control-sm"></div> <div class="col-lg col-sm-6 mx-n2"> <input type="date" name="organization_from" class="form-control form-control-sm"></div><div class="col-lg col-sm-6 mx-n2"> <input type="date" name="organization_to" class="form-control form-control-sm"> </div> <div class="col-lg-3 col-sm-6 mx-n2"> <input type="text" placeholder="Reason for living" name="reason_for_leaving" class="form-control form-control-sm"></div><div class="col-lg-1 col-sm-6 mx-n2"> <input type="text" placeholder="Salary" name="prev_salary" class="form-control form-control-sm"></div></div></div>';

        $("#work_exp").append(addrow);
    });

    $(document).on("click", "#del_work", function(){
        $(this).closest("#work_row").remove();
    });

    $("#add_ref").click(function(e){
        e.preventDefault();
        var refrow = '<div id="ref_row"><div class="row mx-auto mt-1 justify-content-end"><button mx-auto style="line-height:7px;" class="btn-sm btn-danger float-right" id="del_ref">Delete</button></div><div class="row mx-auto justify-content-center mt-2"><div class="col-lg-1 col-sm-6 mx-n2"><select name="ref_title" id="ref_title" class="form-control form-control-sm"><option value="">Title</option> <?php  $sql="SELECT * FROM titles";
        $result = $conn->query($sql);    while($searchrow = $result->fetch()){
                                            echo "<option value=".$searchrow['titleid'] .">" . ucfirst($searchrow['title']) ."</option>";
                                                                    }            
        ?> </select></div><div class="col-lg col-sm-6 mx-n2"> <input type="text" name="ref_surname" id="ref_surname" placeholder="Surname" class="form-control form-control-sm"></div><div class="col-lg col-sm-6 mx-n2"> <input type="text" name="ref_other_names" id="ref_other_names" placeholder="Other Names" class="form-control form-control-sm"></div><div class="col-lg col-sm-6 mx-n2"> <input type="text" name="ref_phone_number" id="ref_phone_number" placeholder="Phone Number" class="form-control form-control-sm"></div><div class="col-lg-3 col-sm-6 mx-n2"> <input type="text" name="ref_email" id="ref_email" placeholder="Email" class="form-control form-control-sm"></div><div class="col-lg col-sm-6 mx-n2"> <input type="text" name="ref_org" id="ref_org" placeholder="Organization" class="form-control form-control-sm"></div><div class="col-lg col-sm-6 mx-n2"> <input type="text" name="ref_designation" id="ref_designation" placeholder="Designation" class="form-control form-control-sm"></div></div></div>';
        
        $("#referee").append(refrow);
    });

    $(document).on("click", "#del_ref", function(){
        $(this).closest("#ref_row").remove();
    });

        function showtop(){
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
        // function checkinput(input, text) {
        //     var inp = document.getElementById(input).value;
           
        //     if(inp == ''){
                
        //         alert(input + ' ' + text);
        //         $("#error").html('<div class="alert alert-danger"><h6>'+ text + ' field cannot be empty</h6></div>');
        //         $("#error").show();
        //     }                   
        // }

    $("#submit").on("click", function(e){
        e.preventDefault();
        //check input values

        //Create error array
        var error = [];

        //Collect all input values
        var title = $("#title option:selected").text();
        var surname = $("#surname").val();
        var fname = $("#first_name").val();
        var other_name = $("#other_names").val();
        var gender = $("#gender option:selected").text();
        var dob = $("#dob").val();
        var m_status = $("#marital_status option:selected").text();
        var nationality = $("#nationality option:selected").text();   
        var state_of_origin = $("#states option:selected").text();
        var lga = $("#lga option:selected").text();
        var hometown = $("#hometown").val();
        var email = $("#email").val();
        var phone1 = $("#phone_number1").val();
        var phone2 = $("#phone_number2").val();
        var address = $("#address").val();
        var city = $("#city").val();
        var state_of_residence = $("#state_of_residence option:selected").text();
        var application_message = $("#application_message").val();
        
        //Push errors into error array
        if(title=='Title'){
            error.push('Please select your title');            
        }

        if(surname == ''){
            error.push('Please enter your surname');
        }
        
        if(fname == ''){
            error.push('Please enter your first name');
        } 

        if(other_name == ''){
            error.push('Please enter your other name');          
        }

        if(gender=='Select gender'){
            error.push('Please select your gender');            
        }

        if(dob == ''){
            error.push('Please enter your date of birth');     
        }

        if(m_status == 'Marital Status'){
            error.push('Please select your marital status');     
        }

        if(nationality == 'Select Nationality'){
            error.push('Please select your country of origin');
        }

        if(state_of_origin == 'state of origin'){
            error.push('Please select your state of origin');
        }
        
        if(lga ==''){
            error.push('Please select your local government of origin');
        }

        if(hometown == ''){
            error.push('Please enter your hometown');          
        }


        if(email == ''){
            error.push('Please enter your email');          
        }

        if(phone1 == ''){
            error.push('Please enter your phone number');          
        }

        if(address == ''){
            error.push('Please enter your address');           
        }

        if(city == ''){
            error.push('Please enter your city of residence'); 
        }

        if(state_of_residence == 'state of residence'){
            error.push('Please select your state of residence');          
        }

        if($('input[name="institution1"]').val()==''){
            error.push('Please enter the name of institution attended');           
        }   

        if($('input[name="sch_location"]').val()==''){
            error.push('Please enter the location of  institution attended');           
        }

        if($('input[name="institution_from"]').val()==''){
            error.push('Please enter the date you started your degree');          
        }

        if($('input[name="institution_to"]').val()==''){
            error.push('Please enter the date you completed your degree');          
        }

        if($('input[name="course"]').val()==''){
            error.push('Please enter the course you studied');
        }

        if($('input[name="degree"]').val()==''){
            error.push('Please enter degree obtained from institution');            
        }

        if($('select[name="class_of_degree"] option:selected').text()=='Class of degree'){
            error.push('Please select the class of degree'); 
        }

        if($('select[name="ref_title"] option:selected').text()=='Title'){
            error.push('Please select the title of referee');  
        }

        if($('input[name="ref_surname"]').val()==''){
            error.push('Please enter surname of referee');
        }
        
        if($('input[name="ref_other_names"]').val()==''){
            error.push('Please enter other name of referee');
        }

        if($('input[name="ref_phone_number"]').val()==''){
            error.push('Please enter referee phone number');
        }  

        if($('input[name="ref_email"]').val()==''){
            error.push('Please enter referee email');          
        } 

        if($('input[name="ref_org"]').val()==''){
            error.push('Please enter referee organization');    
        } 

        if($('input[name="ref_designation"]').val()==''){
            error.push('Please enter referee designation at organization');           
        }      

        if($("#cv").val()==''){
            if($("#cv_upl").attr('src')==''){
                error.push('Please upload your CV');
            }            
        }

        if($("#application_message").val() == ''){
            error.push('Please enter your cover letter');
        }

        if($("#customcheck").prop("checked") == false){
            error.push('Verify that all information provided here is correct');
        };

        //Collect values from educational history tab

        //Create array to store educational history values
        var inst=[];
        $("#education #educ_row").each(function(){
            var v = $(this);
            var institution = v.find('input[name="institution1"]').val();
            var school_location = v.find('input[name="sch_location"]').val();
            var from = v.find('input[name="institution_from"]').val();
            var to = v.find('input[name="institution_to"]').val();
            var course = v.find('input[name="course"]').val();
            var degree = v.find('input[name="degree"]').val();
            var class_degree = v.find('select[name="class_of_degree"] option:selected').text();
            
            //Create temporary array to store educational history values
            var educ = {};
            educ.col1=institution;
            educ.col2=school_location;
            educ.col3=from;
            educ.col4=to;
            educ.col5=course;
            educ.col6=degree;
            educ.col7=class_degree;
            inst.push(educ);
        });
        //Stringify array into JSON variable 
        var educ_details=JSON.stringify(inst);

        //Collect values from work experience tab
        var wrk=[];
        $("#work_exp #work_row").each(function(){
            var wkexp = $(this);
            var organization = wkexp.find('input[name="prev_organization"]').val();
            var position = wkexp.find('input[name="position_held"]').val();
            var from = wkexp.find('input[name="organization_from"]').val();
            var to = wkexp.find('input[name="organization_to"]').val();
            var reason = wkexp.find('input[name="reason_for_leaving"]').val();
            var prev_salary = wkexp.find('input[name="prev_salary"]').val();
            //create temporary array to store work experience values
            var work={};
            work.col1=organization;
            work.col2=position;
            work.col3=from;
            work.col4=to;
            work.col5=reason;
            work.col6=prev_salary;
            wrk.push(work);

        });       
        //Stringify work experience array into JSON variable
        var wrk_details=JSON.stringify(wrk);

        //Collect values from referees tab
        var ref=[];
        $("#referee #ref_row").each(function(){
            var r = $(this);
            var ref_title = r.find('select[name="ref_title"] option:selected').text();
            var ref_surname = r.find('input[name="ref_surname"]').val();
            var ref_other_names = r.find('input[name="ref_other_names"]').val();
            var ref_phone_number = r.find('input[name="ref_phone_number"]').val();
            var ref_email = r.find('input[name="ref_email"]').val();
            var ref_org = r.find('input[name="ref_org"]').val();
            var ref_designation = r.find('input[name="ref_designation"]').val();
            //Create temporary array to store referee detail values
            var ref_temp = {};
            ref_temp.col1=ref_title;
            ref_temp.col2=ref_surname;
            ref_temp.col3=ref_other_names;
            ref_temp.col4=ref_phone_number;
            ref_temp.col5=ref_email;
            ref_temp.col6=ref_org;
            ref_temp.col7=ref_designation;
            ref.push(ref_temp);
        });
        //Stringify array into JSON variable
        var ref_details=JSON.stringify(ref);

        var cv = $("#cv").prop('files')[0];
        var id = '<?=$id?>';
        var uid = '<?=$user['uid']?>';
        var formdata = new FormData();
        formdata.append('cv',cv);
        formdata.append('application_message',application_message);
        formdata.append('ref_details',ref_details);
        formdata.append('wrk_details',wrk_details);
        formdata.append('educ_details',educ_details);
        formdata.append('state_of_residence',state_of_residence);
        formdata.append('city',city);
        formdata.append('address',address);
        formdata.append('phone2',phone2);
        formdata.append('phone1',phone1);
        formdata.append('email',email);
        formdata.append('hometown',hometown);
        formdata.append('lga',lga);
        formdata.append('state_of_origin',state_of_origin);
        formdata.append('nationality',nationality);
        formdata.append('m_status',m_status);
        formdata.append('dob',dob);
        formdata.append('gender',gender);
        formdata.append('other_name',other_name);
        formdata.append('fname',fname);
        formdata.append('surname',surname);
        formdata.append('title',title);
        formdata.append('dataname','submitapplication');
        formdata.append('id',id);
        formdata.append('uid', uid);

        if(error.length > 0){
            for(var i in error){
                $("#errlog").show();
               $("#errmsg").append('- '+ error[i]+'<br>');
            }
            $("#errlog").delay(10000).fadeOut();
        }
        else{
            $.ajax({
            method:"POST",
            url:ajaxurl,
            data:formdata,
            contentType:false,
            processData:false,
            success:function(response){
                $("#errlog").show();
                $("#msg").html(response);
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }            
        });
        }
    });

    $(document).on("click", "#save_for_later", function(e){
        e.preventDefault();
         //Collect all input values
         var title = $("#title option:selected").text();
        var surname = $("#surname").val();
        var fname = $("#first_name").val();
        var other_name = $("#other_names").val();
        var gender = $("#gender option:selected").text();
        var dob = $("#dob").val();
        var m_status = $("#marital_status option:selected").text();
        var nationality = $("#nationality option:selected").text();   
        var state_of_origin = $("#states option:selected").text();
        var lga = $("#lga option:selected").text();
        var hometown = $("#hometown").val();
        var email = $("#email").val();
        var phone1 = $("#phone_number1").val();
        var phone2 = $("#phone_number2").val();
        var address = $("#address").val();
        var city = $("#city").val();
        var state_of_residence = $("#state_of_residence option:selected").text();

        
        //Collect values from educational history tab

        //Create array to store educational history values
        var inst=[];
        $("#education #educ_row").each(function(){
            var v = $(this);
            var institution = v.find('input[name="institution1"]').val();
            var school_location = v.find('input[name="sch_location"]').val();
            var from = v.find('input[name="institution_from"]').val();
            var to = v.find('input[name="institution_to"]').val();
            var course = v.find('input[name="course"]').val();
            var degree = v.find('input[name="degree"]').val();
            var class_degree = v.find('select[name="class_of_degree"] option:selected').text();
            
            //Create temporary array to store educational history values
            var educ = {};
            educ.col1=institution;
            educ.col2=school_location;
            educ.col3=from;
            educ.col4=to;
            educ.col5=course;
            educ.col6=degree;
            educ.col7=class_degree;
            inst.push(educ);
        });
        //Stringify array into JSON variable 
        var educ_details=JSON.stringify(inst);

        //Collect values from work experience tab
        var wrk=[];
        $("#work_exp #work_row").each(function(){
            var wkexp = $(this);
            var organization = wkexp.find('input[name="prev_organization"]').val();
            var position = wkexp.find('input[name="position_held"]').val();
            var from = wkexp.find('input[name="organization_from"]').val();
            var to = wkexp.find('input[name="organization_to"]').val();
            var reason = wkexp.find('input[name="reason_for_leaving"]').val();
            var prev_salary = wkexp.find('input[name="prev_salary"]').val();
            //create temporary array to store work experience values
            var work={};
            work.col1=organization;
            work.col2=position;
            work.col3=from;
            work.col4=to;
            work.col5=reason;
            work.col6=prev_salary;
            wrk.push(work);

        });       
        //Stringify work experience array into JSON variable
        var wrk_details=JSON.stringify(wrk);

        //Collect values from referees tab
        var ref=[];
        $("#referee #ref_row").each(function(){
            var r = $(this);
            var ref_title = r.find('select[name="ref_title"] option:selected').text();
            var ref_surname = r.find('input[name="ref_surname"]').val();
            var ref_other_names = r.find('input[name="ref_other_names"]').val();
            var ref_phone_number = r.find('input[name="ref_phone_number"]').val();
            var ref_email = r.find('input[name="ref_email"]').val();
            var ref_org = r.find('input[name="ref_org"]').val();
            var ref_designation = r.find('input[name="ref_designation"]').val();
            //Create temporary array to store referee detail values
            var ref_temp = {};
            ref_temp.col1=ref_title;
            ref_temp.col2=ref_surname;
            ref_temp.col3=ref_other_names;
            ref_temp.col4=ref_phone_number;
            ref_temp.col5=ref_email;
            ref_temp.col6=ref_org;
            ref_temp.col7=ref_designation;
            ref.push(ref_temp);
        });
        //Stringify array into JSON variable
        var ref_details=JSON.stringify(ref);
        var cv = $("#cv").prop('files')[0];
        var application_message = $("#application_message").val();
        var id = '<?=$id?>';
        var uid = '<?=$user['uid']?>';
        var formdata = new FormData();
        formdata.append('cv',cv);
        formdata.append('application_message',application_message);
        formdata.append('ref_details',ref_details);
        formdata.append('wrk_details',wrk_details);
        formdata.append('educ_details',educ_details);
        formdata.append('state_of_residence',state_of_residence);
        formdata.append('city',city);
        formdata.append('address',address);
        formdata.append('phone2',phone2);
        formdata.append('phone1',phone1);
        formdata.append('email',email);
        formdata.append('hometown',hometown);
        formdata.append('lga',lga);
        formdata.append('state_of_origin',state_of_origin);
        formdata.append('nationality',nationality);
        formdata.append('m_status',m_status);
        formdata.append('dob',dob);
        formdata.append('gender',gender);
        formdata.append('other_name',other_name);
        formdata.append('fname',fname);
        formdata.append('surname',surname);
        formdata.append('title',title);
        formdata.append('dataname','save_for_later');
        formdata.append('id',id);
        formdata.append('uid', uid);
        
        // console.log(wrk_details);
        $.ajax({
            method:"POST",
            url:ajaxurl,
            data:formdata,
            contentType:false,
            processData:false,
            success:function(response){
                $("#msg").html(response);
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }            
        });


    });
    
</script>
