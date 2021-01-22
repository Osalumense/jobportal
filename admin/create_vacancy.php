<?php
$title = 'create vacancy';
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


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>    
    
        <title><?=$title?></title>
    </head>
    <body style="background-color: #d3d3d3">

<h5 class="text-center mt-3 bg-light p-2">CREATE NEW VACANCY</h5>

<div class="container">
    <div class="row">
        <div class="col-lg-8 mx-auto mt-2" style="display:none" id="errlog">
            <div class="alert alert-danger">
                <p id="errmsg"></p>
            </div>
        </div>
    </div>
    <ul class="nav nav-tabs bg-light" id="tabs-tab" role="tablist">
        <li class="nav-item mt-2">
            <a class="nav-link text-muted" data-toggle="tab" href="#category" role="tab" aria-controls="tabs-employment" aria-selected="true">Job details</a>
        </li>
        <li class="nav-item mt-2">
            <a class="nav-link text-muted" data-toggle="tab" href="#job_summ" role="tab" aria-controls="tabs-job-description" aria-selected="false">Job summary</a>
        </li>
        <li class="nav-item mt-2">
            <a class="nav-link text-muted" data-toggle="tab" href="#job_description" role="tab" aria-controls="tabs-requirements" aria-selected="false">Job description</a>
        </li> 
        <li class="nav-item mt-2">
            <a class="nav-link text-muted" data-toggle="tab" href="#qualification" role="tab" aria-controls="tabs-qualifications" aria-selected="false">Qualifications</a>
        </li>
        <li class="nav-item mt-2">
            <a class="nav-link text-muted" data-toggle="tab" href="#eligibility" role="tab" aria-controls="tabs-eligibility" aria-selected="false">Eligibility Criteria</a>
        </li>
        <li class="nav-item mt-2">
            <a class="nav-link text-muted" data-toggle="tab" href="#create_vac" role="tab" aria-controls="tabs-eligibility" aria-selected="false">Create Vacancy</a>
        </li>
    </ul>
    <div class="tab-content bg-light" id="tabs-tabContent" >

        <div class="tab-pane fade show active" id="category" role="tabpanel" aria-labelledby="tabs-employment-tab"  style="background-color: white">
            <div class="row mx-auto"> 
                <div class="col-md-3 mt-4 col-sm-6 ">
                        
                        <label for="vacancy_type" class="text-muted font-weight-bold">Employment type</label>
                                <select name="vacancy_type" id="vacancy_type" class="form-control form-control-sm">
                                    <option value="">Select employment type </option>                      
                                    <?php
                                        $sql="SELECT * FROM employmenttype";
                                        $result = $conn->query($sql);
                                        while($searchrow = $result->fetch()){
                                        echo "<option value=".$searchrow['id'] .">" . ucfirst($searchrow['type']) ."</option>";
                                        }            
                                    ?>
                                </select>
                </div>
                <div class="col-md-3 mt-4 col-sm-6 ">
                    
                        <label for="vacancy_type" class="text-muted font-weight-bold">Employment category</label>
                                <select name="vacancy_category" id="vacancy_category" class="form-control form-control-sm">
                                    <option value="">Select employment category</option>                      
                                    <?php
                                        $sql="SELECT * FROM employmentcategory";
                                        $result = $conn->query($sql);
                                        while($searchrow = $result->fetch()){
                                        echo "<option value=".$searchrow['id'] .">" . ucfirst($searchrow['type']) ."</option>";
                                        }            
                                    ?>
                                </select>
                </div>
                
                <div class="col-md-3 mt-4 col-sm-6 ">
                    
                    <label for="department" class="text-muted font-weight-bold">Unit/department:</label>
                            <select name="department" id="department" class="form-control form-control-sm">
                                <option value="">Select unit/department</option>                      
                                <?php
                                    $sql="SELECT * FROM departments";
                                    $result = $conn->query($sql);
                                    while($searchrow = $result->fetch()){
                                    echo "<option value=".$searchrow['id'] .">" . ucfirst($searchrow['dept']) ."</option>";
                                    }            
                                ?>
                            </select>
                 </div>
            </div>
            <div class="row mx-auto">   
        
            <div class="col-md-3 mt-4 col-sm-6 ">
                
                    <label for="post" class="text-muted font-weight-bold">Post:</label>
                            <select name="post" id="post" class="form-control form-control-sm">
                                <option value="">Select post</option>                      
                                <?php
                                    $sql="SELECT * FROM posts";
                                    $result = $conn->query($sql);
                                    while($searchrow = $result->fetch()){
                                    echo "<option value=".$searchrow['id'] .">" . ucfirst($searchrow['type']) ."</option>";
                                    }            
                                ?>
                            </select>
            </div>
            <div class="col-md-3 mt-4 col-sm-6 form-group">
                        <label for="deadline" class="text-muted font-weight-bold">Valid until</label>
                        <input placeholder="Enter closing Date" type="date" name="deadline" id="deadline" class="form-control form-control-sm" required>
            </div>
            <div class="col-md-3 col-sm-6 mt-4 form-group">
                        <label for="location" class="text-muted font-weight-bold">Location</label>
                        <input placeholder="Enter location" type="text" name="location" id="location" class="form-control form-control-sm" required>
            </div>

            </div>
        </div>            
        
        <div class="tab-pane fade" id="job_summ" role="tabpanel" aria-labelledby="tabs-job-description-tab"  style="background-color: white">

            <div class="row mx-auto">
                <div class="col-md-4 mt-4 col-sm-6">
                    <label for="summary" class="text-muted font-weight-bold">Job summary</label>
                    <textarea class="form-control form-control-sm" name="job_summary" id="job_summary" placeholder="Enter short summary about job" cols="40" rows="3"></textarea>
                    <small class="form-text text-muted">Example: We seek the services of highly skilled engineers for the continuous growth of the organzation</small>
                </div>
                <div class="col-md-4 mt-4 col-sm-6 form-group">
                    <label for="experience_level" class="text-muted font-weight-bold">Experience level</label>
                    <textarea class="form-control form-control-sm" name="experience_level" id="experience_level" placeholder="Enter experience level" cols="40" rows="3"></textarea>
                    <small class="form-text text-muted">Example: Candidates must have a minimum of 2 years experience in civil engineering</small>
                </div>  
                
                <div class="col-md-4 mt-4 col-sm-6 form-group">
                        <label for="salary" class="text-muted font-weight-bold">Salary range</label>
                        <textarea class="form-control form-control-sm" name="salary" id="salary" placeholder="Enter salary or salary range" cols="40" rows="3"></textarea>
                    
                </div>           
            </div>
            <div class="row mx-auto">
                      
            </div>
            <div class="row mx-auto">
                
            </div>
        </div>

        <div class="tab-pane fade" id="job_description" role="tabpanel" aria-labelledby="tabs-requirements-tab"  style="background-color: white">
            <div class="row mx-auto">
                <div class="col-sm-5 mt-1">
                    <label for="qualifications" class="text-muted font-weight-bold">Job description <span><small class="form-text text-muted">Full description of job and specifications</small></span></label>
                </div>

                <div class="col-sm-6 mt-1">
                    <button class="btn-sm btn-success" type="button" id="add_job_desc"><i class="fas fa-plus"></i> Add</button>
                </div>                
            </div>
            <div class="row mx-auto">
                <div class="col-lg-6 col-sm-6 mt-2 form-group" id="jobdiv">
                        <div class="input-group mt-2" id="job_desc">
                            <textarea class="form-control form-control-sm" name="job_description" id="job_description" placeholder="Enter job description " cols="40" rows="1"></textarea>
                            <div class="input-group-append">
                                <button class="btn-sm btn-danger" type="button" id="del_job" aria-haspopup="true" aria-expanded="false">X</button>
                            </div>                        
                        </div>

                        <div class="input-group mt-2" id="job_desc">
                            <textarea class="form-control form-control-sm" name="job_description" id="job_description" placeholder="Enter job description " cols="40" rows="1"></textarea>
                            <div class="input-group-append">
                                <button class="btn-sm btn-danger" type="button" id="del_job" aria-haspopup="true" aria-expanded="false">X</button>
                            </div>                       
                        </div>

                        <div class="input-group mt-2" id="job_desc">
                            <textarea class="form-control form-control-sm" name="job_description" id="job_description" placeholder="Enter job description " cols="40" rows="1"></textarea>
                            <div class="input-group-append">
                                <button class="btn-sm btn-danger" type="button" id="del_job" aria-haspopup="true" aria-expanded="false">X</button>
                            </div>                          
                        </div>
                    
                </div>          
            </div>           
        </div>
        
        <div class="tab-pane fade" id="qualification" role="tabpanel" aria-labelledby="tabs-qualifications-tab"  style="background-color: white">
            <div class="row mx-auto">
                <div class="col-sm-5 mt-1">
                    <label for="qualifications" class="text-muted font-weight-bold">Qualifications <span><small class="form-text text-muted">Highlight qualifications and certifications if necessary</small></span></label>
                </div>
                <div class="col-sm-6 mt-1">
                    <button class="btn-sm btn-success" type="button" id="add_qualification"><i class="fas fa-plus"></i> Add</button>
                </div>                
            </div>
            <div class="row mx-auto">
                <div class="col-md-6 col-sm-12 mt-2 form-group" id="qualdiv">
                                       
                        
                    <div class="input-group mt-2" id="qual">
                    <textarea class="form-control form-control-sm" name="qualifications" id="qualifications" placeholder="Enter qualifications" cols="30" rows="1"></textarea>
                        <div class="input-group-append">
                            <button class="btn-sm btn-danger" type="button" id="del" aria-haspopup="true" aria-expanded="false">X</button>
                        </div>                        
                    </div>

                    <div class="input-group mt-2" id="qual">
                         <textarea class="form-control form-control-sm " name="qualifications" id="qualifications" placeholder="Enter qualifications" cols="30" rows="1"></textarea>
                        <div class="input-group-append">
                            <button class="btn-sm btn-danger" type="button" id="del" aria-haspopup="true" aria-expanded="false">X</button>
                        </div>                        
                    </div>

                    <div class="input-group mt-2" id="qual">
                         <textarea class="form-control form-control-sm " name="qualifications" id="qualifications" placeholder="Enter qualifications" cols="30" rows="1"></textarea>
                        <div class="input-group-append">
                            <button class="btn-sm btn-danger" type="button" id="del" aria-haspopup="true" aria-expanded="false">X</button>
                        </div>                        
                    </div>
                    
                </div>                
            </div>
        </div>

        <div class="tab-pane fade" id="eligibility" role="tabpanel" aria-labelledby="tabs-eligibility-tab"  style="background-color: white">
            <div class="row">
                <div class="col-md-8 mt-1 ">
                    <button class="btn-sm btn-success float-right" type="button" id="add_elig"><i class="fas fa-plus"></i> Add</button>
                </div> 
            </div>
            <div class="row mx-auto">
                <div class="col-md-8 col-sm-12 mt-2 form-group" id="eligibility_div">
                    <div class="input-group mt-2" id="eligibile_que">
                        <textarea class="form-control form-control-sm" name="eligibility_question" id="eligibility_question" placeholder="Enter application eligibility question and select expected answer" cols="30" rows="1" ></textarea>
                        <div class="input-group-append">
                            <select name="eligible_question_option" id="eligible_question_option" class="form-control form-control-sm">
                                <option value="">Select Answer</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            <select name="eligible_question_type" id="eligible_question_type" class="form-control form-control-sm">
                                <option value="">Select Type</option>
                                <option value="1">Compulsory</option>
                                <option value="0">Advantage</option>
                            </select>
                            <button class="btn-sm btn-danger" type="button" id="del_elig" aria-haspopup="true" aria-expanded="false">X</button>
                        </div>                        
                    </div>

                    <div class="input-group mt-2" id="eligibile_que">
                        <textarea class="form-control form-control-sm" name="eligibility_question" id="eligibility_question" placeholder="Enter application eligibility question and select expected answer" cols="30" rows="1" ></textarea>
                        <div class="input-group-append">
                            <select name="eligible_question_option" id="eligible_question_option" class="form-control form-control-sm">
                                <option value="">Select Answer</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            <select name="eligible_question_type" id="eligible_question_type" class="form-control form-control-sm">
                                <option value="">Select Type</option>
                                <option value="1">Compulsory</option>
                                <option value="0">Advantage</option>
                            </select>
                            <button class="btn-sm btn-danger" type="button" id="del_elig" aria-haspopup="true" aria-expanded="false">X</button>
                        </div>                        
                    </div>

                    <div class="input-group mt-2" id="eligibile_que">
                        <textarea class="form-control form-control-sm" name="eligibility_question" id="eligibility_question" placeholder="Enter application eligibility question and select expected answer" cols="30" rows="1" ></textarea>
                        <div class="input-group-append">
                            <select name="eligible_question_option" id="eligible_question_option" class="form-control form-control-sm">
                                <option value="">Select Answer</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            <select name="eligible_question_type" id="eligible_question_type" class="form-control form-control-sm">
                                <option value="">Select Type</option>
                                <option value="1">Compulsory</option>
                                <option value="0">Advantage</option>
                            </select>
                            <button class="btn-sm btn-danger" type="button" id="del_elig" aria-haspopup="true" aria-expanded="false">X</button>
                        </div>                        
                    </div>
                </div>
            </div>
            <div class="row mx-auto">
                <div class="col-md-3 col-sm-6 mt-4 form-group">
                        <label for="pass_mark" class="text-muted font-weight-bold">Eligibility Test Pass Mark</label>
                        <input placeholder="Enter Eligibility test pass mark" type="number" name="pass_mark" id="pass_mark" class="form-control form-control-sm" required>
                </div>
            </div>

        </div>

        <div class="tab-pane fade" id="create_vac" role="tabpanel" aria-labelledby="tabs-eligibility-tab"  style="background-color: white">
            
            <div class="row mx-auto">
                <h5 class="text-danger mt-5 mx-3 font-weight-bold mx-auto">Before saving vacancy details, please make sure to review all entries</h5>
            </div>
            <div class="row mx-auto">
                    <button type="button" class="btn-sm btn-info mx-auto my-3" id="submit">Create Vacancy</button>
            </div>
        </div>
        
    </div>  
</div>

<?php
include_once '../includes/footer.php';
?>

<script>
    var ajaxurl = 'admincontrol.php';
    var page = 'create_vacancy.php';

    $("#add_qualification").click(function(){
        var txt = '<div class="input-group mt-2" id="qual"><textarea class="form-control form-control-sm " name="qualifications" id="qualifications" placeholder="Enter qualifications" cols="30" rows="1"></textarea><div class="input-group-append"><button class="btn-sm btn-danger" type="button" id="del" aria-haspopup="true" aria-expanded="false">X</button></div></div>';
        $("#qualdiv").append(txt);
        
    });

    $(document).on("click", "#del", function(){
        $(this).closest('#qual').remove();
        
    }); 

    $("#add_job_desc").click(function(){
        var text = '<div class="input-group mt-2" id="job_desc"><textarea class="form-control form-control-sm" name="job_description" id="job_description" placeholder="Enter job description " cols="40" rows="1"></textarea><div class="input-group-append"><button class="btn-sm btn-danger" type="button" id="del_job" aria-haspopup="true" aria-expanded="false">X</button></div></div>';
        $("#jobdiv").append(text);
        
    });

    $(document).on("click", "#del_job", function(){
        $(this).closest('#job_desc').remove();
    });

    $("#add_elig").click(function(){
        var txt = '<div class="input-group mt-2" id="eligibile_que"><textarea class="form-control form-control-sm" name="eligibility_question" id="eligibility_question" placeholder="Enter application eligibility question and select expected answer" cols="30" rows="1" ></textarea><div class="input-group-append"><select name="eligible_question_option" id="eligible_question_option" class="form-control form-control-sm"><option value="">Select Answer</option><option value="1">Yes</option><option value="0">No</option></select><select name="eligible_question_type" id="eligible_question_type" class="form-control form-control-sm"><option value="">Select Type</option><option value="1">Compulsory</option><option value="0">Advantage</option></select><button class="btn-sm btn-danger" type="button" id="del_elig" aria-haspopup="true" aria-expanded="false">X</button></div></div>';
        $("#eligibility_div").append(txt);
    });

    $(document).on("click", "#del_elig", function(){
        $(this).closest("#eligibile_que").remove();
    });

    $("#submit").click(function(){
        var error = [];
        $("#errmsg").empty();
        var category = $("#vacancy_category").val();
        var type = $("#vacancy_type").val();
        var dept = $("#department").val();
        var post = $("#post").val();
        var deadline = $("#deadline").val();
        var salary = $("#salary").val();
        var job_summary = $("#job_summary").val();
        var experience_level = $("#experience_level").val();
        var qualifications = $("#qualifications").val();
        var location = $("#location").val();
        var passmark = $("#pass_mark").val();        

        if(type == ""){
                error.push("Please select vacancy type");
            }
        if(category == ""){
                error.push("Please select category");
            }
        if(dept == ""){
                error.push("Please select department");
            }
        if(post == ""){
                error.push("Please select post");
            }
        if(deadline == ""){
                error.push("Please enter deadline");
            }
        if(salary == ""){
                error.push("Please enter salary");
            }
        if(location == ""){
                error.push("Please enter location");
            }
        if(job_summary == ""){
                error.push("Please enter job summary");
            }
        if(experience_level == ""){
                error.push("Please enter experience level");
            }
        if(passmark == ""){
            error.push("Please enter eligibility question pass mark");                        
        }

        var job_desc = [];
        $("#jobdiv textarea").each(function(){
            var tx = $(this).val();
            var desc = {};
            desc.col1=tx;
            job_desc.push(desc);
            if(desc.col1 == ''){
                error.push("Please enter job description");                
            }
        });
        var job_description = JSON.stringify(job_desc);
        console.log(job_desc);
        // if($.isEmptyObject(job_desc) == 'true'){
        //         error.push("Please enter job description");    
        //     }

        var qual = [];
        $("#qualdiv textarea").each(function(){
            var text = $(this).val();
            var quals = {};
            quals.col1=text;
            if(quals.col1 == ''){
                error.push("Please enter qualifications");                
            }
            qual.push(quals);
        });
        var qualifications = JSON.stringify(qual);

        var elig = [];
        $("#eligibility_div #eligibile_que").each(function(){
            var v = $(this);
            var elig_que = v.find('textarea[name="eligibility_question"]').val();
            var elig_ans = v.find('select[name="eligible_question_option"]').val();
            var elig_type = v.find('select[name="eligible_question_type"] option:selected').text();
            var eligs = {};
            eligs.col1=elig_que;
            eligs.col2=elig_ans;  
            eligs.col3=elig_type;          
            if(eligs.col1 == ''){
                error.push("Please enter eligibility question");                
            }
            if(eligs.col2 == ''){
                error.push("Please enter eligibility question answer");                
            }
            if(eligs.col3 == 'Select Type'){
                error.push("Please enter eligibility question type");                
            }
            elig.push(eligs);            
        });
        var eligibility_que = JSON.stringify(elig);
        
        var elig_len = elig.length;
        if(passmark > elig_len){
            error.push('Eligibility pass mark cannot be greater than number of questions');
        }

        if(error.length > 0){
           for(var i in error){
               $("#errlog").show();
               $("#errmsg").append('- '+ error[i]+'<br>');
           }
           $("#errlog").delay(10000).fadeOut();
        }
        else{
            $.ajax({
            type:"POST",
            url:ajaxurl,
            data:{category:category,type:type,dept:dept,post:post,deadline:deadline,salary:salary,job_summary:job_summary,experience_level:experience_level,job_description:job_description,qualifications:qualifications,location:location,passmark:passmark,eligibility_que:eligibility_que,dataname:'createvacancy'},
            success:function(response){
                alert(response);
            }
        });   
        }

    });
</script>