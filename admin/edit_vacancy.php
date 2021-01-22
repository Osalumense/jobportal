<?php
$title = 'edit vacancies';
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
<h5 class="text-center mt-2 bg-light p-2">EDIT VACANCIES</h5>


<div class="container-responsive mx-3">
    <div class="row">
        <div class="col-md-5 col-sm-12">
        <table class="table table-sm table-bordered mx-2" id="vacancy_tbl">
                    <thead class="thead-light">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Post</th>
                        <th scope="col">status</th>
                        <th scope="col">View</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody style="background-color: white">
                        <tr>
                        <?php
                        $sql = "SELECT *, posts.type AS position, 
                        employmenttype.type AS emptype, 
                        job_vacancy_tbl.status AS vac_status
                        FROM job_vacancy_tbl 
                        JOIN employmentcategory ON job_vacancy_tbl.vacancy_category_id=employmentcategory.id
                        JOIN employmenttype ON job_vacancy_tbl.employment_type=employmenttype.id
                        JOIN departments ON job_vacancy_tbl.department_id=departments.id
                        JOIN posts ON job_vacancy_tbl.post_id=posts.id ORDER BY vacancy_id ASC";
                            $result = $conn->query($sql);
                            if($result->rowCount() > 0){
                                $searchrow = $result->fetchAll();
                                foreach($searchrow as $row){
                                    $vac_id = $row["vacancy_id"];
                                    $stat = $row["vac_status"];
                                    $data = '
                                        <tr class="mx-auto">
                                        <td>'.$row["vacancy_id"].'</td>
                                        <td>'.$row["position"].'</td> 
                                        <td>'.$stat.'</td>    
                                        <td><button class="btn-sm btn-info view_vac" id='.$row["vacancy_id"].'>View</button></td>';
                                        if($stat=='Active'){
                                            $data .= '<td><button class="btn-sm btn-danger vac_deactivate" id='.$row["vacancy_id"].'>Deactivate</button></td> </tr>';
                                        }elseif($stat=='Inactive'){
                                            $data .= '<td><button class="btn-sm btn-success vac_activate" id='.$row["vacancy_id"].'>Activate</button></td> </tr>';
                                        }
                                    echo $data;
                                }
                            }
                            else {
                                echo '<tr><td scope="col" colspan="12" class="text-danger text-center mx-auto"><h3>No records found</h3></td></tr>';
                            }
                        ?>
                        </tr>
                    </tbody>
                </table>
        </div>
        <div class="col-md-7 mx-auto col-sm-12" id="edit_section" style="display:none; background-color: white">
                <div class="mb-3">
                    <button class="btn-sm btn-danger fa fa-times float-right m-2" id="close_section"> close</button>
                </div> <br>
                    <div class="row my-3 mx-2">
                            <input type="text" id="vacancy_id" hidden>
                        <div class="col">
                            <label for="vacancy_type" class="text-muted font-weight-bold">Employment type:</label>
                            <select name="vacancy_type" id="vacancy_type" class="form-control form-control-sm">
                                <option value="">Employment type </option>                      
                                    <?php
                                        $sql="SELECT * FROM employmenttype";
                                        $result = $conn->query($sql);
                                        while($searchrow = $result->fetch()){
                                            echo "<option value=".$searchrow['id'] .">" . ucfirst($searchrow['type']) ."</option>";  }            
                                    ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="vacancy_type" class="text-muted font-weight-bold">Employment category:</label>
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
                        <div class="col">
                            <label for="department" class="text-muted font-weight-bold">Unit/department:</label>
                            <select name="department" id="department" class="form-control form-control-sm">
                                <option value="">Unit/department</option>                      
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

                    <div class="row my-3 mx-2">
                        <div class="col">
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
                        <div class="col">
                            <label for="deadline" class="text-muted font-weight-bold">Application deadline:</label>
                            <input placeholder="Enter closing Date" type="date" name="deadline" id="deadline" class="form-control form-control-sm" required>
                        </div>
                        <div class="col">
                            <label for="location" class="text-muted font-weight-bold">Location</label>
                            <input placeholder="Enter location" type="text" name="location" id="location" class="form-control form-control-sm" required>
                        </div>
                    </div>

                    <div class="row my-3 mx-2">
                        <div class="col">
                            <label for="summary" class="text-muted font-weight-bold">Job summary:</label>
                            <textarea class="form-control form-control-sm" name="job_summary" id="job_summary" placeholder="Enter short summary about job" cols="40" rows="3"></textarea>
                        </div>
                        <div class="col">
                            <label for="experience_level" class="text-muted font-weight-bold">Experience level:</label>
                            <textarea class="form-control form-control-sm" name="experience_level" id="experience_level" placeholder="Enter experience level" cols="40" rows="3"></textarea>
                        </div>
                        <div class="col">
                            <label for="salary" class="text-muted font-weight-bold">Salary range:</label>
                            <textarea class="form-control form-control-sm" name="salary" id="salary" placeholder="Enter salary or salary range" cols="40" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="row my-3 mx-2" id="job_desc">                        
                    </div>


                    <div class="row my-3 mx-2" id="qualification">                        
                    </div>

                    <div class="row my-3 mx-2" id="elig_div">     
                                      
                    </div>
                    <div class="row my-3 mx-2">
                        <div class="col-sm-4">
                            <label for="location" class="text-muted font-weight-bold">Eligibility Pass Mark</label>
                            <input placeholder="Eligibility question pass mark" type="number" name="elig_pass" id="elig_pass" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-3 mb-2">
                          <button class="btn-sm btn-info mx-auto" id="update">Update</button>
                    </div>

        </div>

    </div>

</div>




<?php
include_once '../includes/footer.php';
?>

<script>
    var ajaxurl = 'admincontrol.php';
    var page = 'edit_vacancy.php';

    $(document).on("click", ".view_vac", function(){
        var vac_id = $(this).attr("id");
        $.ajax({
            method:"POST",
            url:ajaxurl,
            dataType:"JSON",
            data:{vac_id:vac_id,dataname:'edit_vac'},
            success:function(details){
                $("#vacancy_id").val(details.vac_details.vacancy_id);
                $("#vacancy_type").val(details.vac_details.emp_type);
                $("#vacancy_category").val(details.vac_details.emp_cat);
                $("#department").val(details.vac_details.dept);
                $("#deadline").val(details.vac_details.date);
                $("#location").val(details.vac_details.location);
                $("#job_summary").val(details.vac_details.summary);
                $("#experience_level").val(details.vac_details.exp_lvl);
                $("#salary").val(details.vac_details.salary);
                $("#post").val(details.vac_details.post);  
                $("#elig_pass").val(details.pass_mrk);
                $("#job_desc").html('<label for="job_description" class="text-muted font-weight-bold col-sm-12">Job description:</label><div class="col-sm-12"><button class="btn-sm btn-success float-left my-2" type="button" id="add_job_desc"><i class="fas fa-plus"></i> Add</button></div><br>' + details.q3);

                $("#qualification").html('<label for="qualification" class="text-muted font-weight-bold col-sm-12">Qualification:</label><div class="col-sm-12"><button class="btn-sm btn-success float-left my-2" type="button" id="add_quals"><i class="fas fa-plus"></i> Add</button></div><br>' + details.q2); 

                $("#elig_div").html('<label for="eligbility questions" class="text-muted font-weight-bold col-sm-12">Eligibility questions:</label><div class="col-sm-12"><button class="btn-sm btn-success float-left my-2" type="button" id="add_elig"><i class="fas fa-plus"></i> Add</button></div><br>' + details.elig);
                
                $("#edit_section").show('slow');

            }
        });
    });

    $(document).on("click", ".vac_deactivate", function(){
        var id = $(this).attr("id");
        if(confirm('Vacancy would no longer be visible to applicants, Are you sure you want to deactivate vacancy?')){
            $.ajax({
                type:"POST",
                url:ajaxurl,
                data:{id:id,dataname:'deactivatevac'},
                success:function(response){
                    alert(response);
                    window.location.href=page;
                }
            });
        }
    });

    $(document).on("click", ".del_elig", function(){
        var id = $(this).attr("id");
        if(confirm('Do you want to delete this eligibility question?')){
            $.ajax({
                type:"POST",
                url:ajaxurl,
                data:{id:id,dataname:'del_elig'},
                success:function(response){
                    alert(response);
                    window.location.href=page;
                }
            });
        }
    });

    //Add new eligibility question row
    $(document).on("click", "#add_elig", function(){
        var txt = '<div class="input-group mt-2 col-md-12" id="app_eligibile_que"><textarea class="form-control form-control-sm" name="append_eligibility_question" id="append_eligibility_question" placeholder="Enter application eligibility question and select expected answer" cols="30" rows="1" ></textarea><div class="input-group-append"><select name="append_eligible_question_option" id="append_eligible_question_option" class="form-control form-control-sm"><option value="1">Yes</option><option value="0">No</option></select><select name="app_eligible_question_type" id="app_eligible_question_type" class="form-control form-control-sm"><option value="1">Compulsory</option><option value="0">Advantage</option></select><button class="btn-sm btn-danger" type="button" id="del_append_elig" aria-haspopup="true" aria-expanded="false">X</button></div></div>';
        $("#elig_div").append(txt);
    });

    //Delete new eligibility question row
    $(document).on("click", "#del_append_elig", function(){
        if(confirm('Are you sure you want to delete this row?')){
            $(this).closest("#app_eligibile_que").remove();
        }
    });



    $(document).on("click", ".vac_activate", function(){
        var id = $(this).attr("id");
        if(confirm('Vacancy would now be visible to applicants, Are you sure you want to activate record?')){
            $.ajax({
                type:"POST",
                url:ajaxurl,
                data:{id:id,dataname:'activatevac'},
                success:function(response){
                    alert(response);
                    window.location.href=page;
                }
            });            
        }
    });

    $("#close_section").click(function(){
        $("#edit_section").hide('slow');        
    });

    $(document).on("click", ".del_quals", function(){
        var id = $(this).attr("id");
        if(confirm('Are you sure you want to delete this record?')){
            $.ajax({
                method:"POST",
                url:ajaxurl,
                data:{id:id,dataname:'deletequalification'},
                success:function(response){
                    alert(response);
                    window.location.href=page;
                }
            });                    
        }
    });

    //Delete existing job description record
    $(document).on("click", ".del_job", function(){
        var id = $(this).attr("id");
        if(confirm('Are you sure you want to delete this record?')){
            $.ajax({
                method:"POST",
                url:ajaxurl,
                data:{id:id,dataname:'deletejob'},
                success:function(response){
                    alert(response);
                    window.location.href=page;
                }
            });   
        }
    });

    //Add new job description row
    $(document).on("click", "#add_job_desc", function(){
       var text = '<div class="input-group mt-2 col-md-6" id="appendjob_div"><textarea class="form-control form-control-sm append_job" name="append_job" id="append_job" cols="40" rows="1"></textarea><div class="input-group-append"><button class="btn-sm btn-danger" type="button" id="del_append_job" aria-haspopup="true" aria-expanded="false">X</button></div></div>'; 
       $("#job_desc").append(text);
    });

    //Delete new job description row
    $(document).on("click", "#del_append_job", function(){
        if(confirm('Are you sure you want to delete row?')){
            $(this).closest("#appendjob_div").remove();
        }
    });

    //Add new qualification row
    $(document).on("click", "#add_quals", function(){
        var text = '<div class="input-group mt-2 col-md-6" id="appendqual_div"><textarea class="form-control form-control-sm append_quals" name="append_quals" id="append_quals" cols="40" rows="1"></textarea><div class="input-group-append"><button class="btn-sm btn-danger" type="button" id="del_append_qual" aria-haspopup="true" aria-expanded="false">X</button></div></div>';
        $("#qualification").append(text);
    });

    //Delete new qualification row
    $(document).on("click", "#del_append_qual", function(){
        if(confirm('Are you sure you want to delete row')){
            $(this).closest("#appendqual_div").remove();
        }
    });

    //Send ajax request to update record
    $("#update").click(function(){
        var vacid = $("#vacancy_id").val();
        var vactype = $("#vacancy_type").val();
        var vaccat = $("#vacancy_category").val();
        var dept = $("#department").val();
        var position = $("#post").val();
        var deadline = $("#deadline").val();
        var location = $("#location").val();
        var summary = $("#job_summary").val();
        var exp_lvl = $("#experience_level").val();
        var salary = $("#salary").val();
        var passmrk = $("#elig_pass").val();

        var jobdescarr = [];

        $(".job_description").each(function(){
            var jobdesc_exist = $(this).val();
            var jobid = $(this).attr("id");
            var jobdesc = {};
            jobdesc.col1=jobdesc_exist;
            jobdesc.col2=jobid;
            jobdescarr.push(jobdesc);
        });
                
        
        var jobdescs = JSON.stringify(jobdescarr);

        var qualifarr = [];

        $(".quals").each(function(){
            var  qual_exist = $(this).val();
            var qualid = $(this).attr("id");
            var  qualif = {};
            qualif.col1=qual_exist;
            qualif.col2=qualid;
            qualifarr.push(qualif);
        });
        
        var qualifics = JSON.stringify(qualifarr);
        
        var appendjob = [];

        $(".append_job").each(function(){
            var vals = $(this).val();
            var valjobs = {};
            valjobs.col1=vals;
            appendjob.push(valjobs);            
        });
        var appendjobupd = JSON.stringify(appendjob);
        
        var appendquals = [];

        $(".append_quals").each(function(){
            var vals = $(this).val();
            var valquals = {};
            valquals.col1=vals;
            appendquals.push(valquals);
        });

        var appendqualsupd = JSON.stringify(appendquals);

        //Collect added eligibility question records
        var append_elig = [];
        $("#elig_div #app_eligibile_que").each(function(){
            var v = $(this);
            var elig_que = v.find('#append_eligibility_question').val();
            var elig_ans = v.find('#append_eligible_question_option').val();
            var elig_type = v.find('select[name="app_eligible_question_type"] option:selected').text();

            
            var app_elig = {};
            app_elig.col1=elig_que;
            app_elig.col2=elig_ans;
            app_elig.col3=elig_type;
            append_elig.push(app_elig);        
        });
        var appended_elig = JSON.stringify(append_elig);
        
        
        //Collect existing eligibility question records
        var exist_elig = [];
        $("#elig_div #eligibile_que").each(function(){
            var v =$(this);
            var elig = v.find('.eligibility_question');
            var elig_id = elig.attr("id");
            var elig_que = elig.val();
            var elig_ans = v.find('.eligible_question_option').val();
            var elig_type = v.find('[name="eligible_question_type"] option:selected').text();
            var ex_elig = {};
            ex_elig.col1=elig_id;
            ex_elig.col2=elig_que;
            ex_elig.col3=elig_ans;
            ex_elig.col4=elig_type;
            exist_elig.push(ex_elig);
        });
        var existing_elig = JSON.stringify(exist_elig);
        var elig_len = exist_elig.length;
        var append_elig_len = append_elig.length;
        if(passmrk > (elig_len + append_elig_len)){
            alert('Pass mark is greater than number of questions');
            return false;
        }
        else{
            $.ajax({
            type:"POST",
            url:ajaxurl,
            data:{vacid:vacid,vactype:vactype,vaccat:vaccat,dept:dept,position:position,deadline:deadline,location:location,summary:summary,exp_lvl:exp_lvl,salary:salary,jobdescs:jobdescs,qualifics:qualifics,appendjobupd:appendjobupd,appendqualsupd:appendqualsupd,existing_elig:existing_elig,appended_elig:appended_elig,passmrk:passmrk,dataname:'vacupdate'},
            success:function(response){
                alert(response);
                window.location.href=page;
            }
        });    
        }        
            
    });

    
</script>