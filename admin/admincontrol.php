<?php
    include "../includes/db_conn.php";

    extract($_POST);

    if($dataname=='createvacancy'){
        $status  = 'Active';
        $sql = "SELECT * FROM job_vacancy_tbl ORDER BY id DESC LIMIT 1";
        $result = $conn->query($sql);
        $reslt = $result->fetch();
        $idcount=$result->rowCount();
        $lastinsertid = $reslt['vacancy_id'];
        $current_date= date('y');
        $new_num = '001';
        if($idcount > 0){
            $prev_details = explode("-",$lastinsertid);
            $prev_yr = $prev_details[1];
            if($current_date > $prev_yr){
                $vac_id = 'V'.'-'.date('y').'-'.date('m').'-'.$new_num;
            }else{
                $new_id = sprintf("%03d", substr($lastinsertid, 8) + 1);
                $vac_id = 'V'.'-'.date('y').'-'.date('m').'-'.$new_id;
            }      
        }
        else{
            $vac_id = 'V'.'-'.date('y').'-'.date('m').'-'.$new_num;
        }
        $creation_date = date("Y-m-d");
        $stmt=$conn->prepare("INSERT INTO job_vacancy_tbl(vacancy_category_id, employment_type, department_id, post_id, job_summary, experience_level,salary, status, creation_date, closing_date, vacancy_id, job_location) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bindParam(1, $category, PDO::PARAM_INT);
        $stmt->bindParam(2, $type, PDO::PARAM_INT);
        $stmt->bindParam(3, $dept, PDO::PARAM_INT);
        $stmt->bindParam(4, $post, PDO::PARAM_INT);
        $stmt->bindParam(5, $job_summary, PDO::PARAM_STR);
        $stmt->bindParam(6, $experience_level, PDO::PARAM_STR);
        $stmt->bindParam(7, $salary, PDO::PARAM_STR);
        $stmt->bindParam(8, $status, PDO::PARAM_STR);
        $stmt->bindParam(9, $creation_date, PDO::PARAM_STR);
        $stmt->bindParam(10, $deadline, PDO::PARAM_STR);
        $stmt->bindParam(11, $vac_id, PDO::PARAM_STR);
        $stmt->bindParam(12, $location, PDO::PARAM_STR);
        $stmt->execute();

        $insert_passmrk=$conn->prepare("INSERT INTO eligibility_passmark(vacancy_id, passmark) VALUES (?,?)");
        $insert_passmrk->bindParam(1, $vac_id, PDO::PARAM_STR);
        $insert_passmrk->bindParam(2, $insert_passmrk, PDO::PARAM_INT);
        $insert_passmrk->execute();

        $job_description=json_decode($job_description, true);
        foreach ($job_description as $job_desc) {
            $description = $job_desc['col1'];
            $stmt2 = $conn->prepare("INSERT INTO vacancy_desc_tbl(vacancy_id, job_description) VALUES (?,?)");
            $stmt2->bindParam(1, $vac_id, PDO::PARAM_STR);
            $stmt2->bindParam(2, $description, PDO::PARAM_STR);
            $stmt2->execute();
        }

        $qualifications=json_decode($qualifications, true);
        foreach($qualifications as $qual){
            $vals = $qual['col1'];
            $stmt3 = $conn->prepare("INSERT INTO qualifications_tbl(vacancy_id, qualification) VALUES (?,?)");
            $stmt3->bindParam(1, $vac_id, PDO::PARAM_STR);
            $stmt3->bindParam(2, $vals, PDO::PARAM_STR);
            $stmt3->execute();
        }

        $eligibility_criteria=json_decode($eligibility_que, true);
        foreach ($eligibility_criteria as $elig_criteria) {
            $elig_question = $elig_criteria['col1'];
            $elig_ans = $elig_criteria['col2'];
            $elig_type = $elig_criteria['col3'];
            $stmt4 = $conn->prepare("INSERT INTO eligibility_questions_tbl(vacancy_id, question, expected_answer, type) VALUES (?,?,?,?)");
            $stmt4->bindParam(1, $vac_id, PDO::PARAM_STR);
            $stmt4->bindParam(2, $elig_question, PDO::PARAM_STR);
            $stmt4->bindParam(3, $elig_ans, PDO::PARAM_INT);
            $stmt4->bindParam(4, $elig_type, PDO::PARAM_STR);
            $finalresult=$stmt4->execute();
        }

        if(isset($finalresult)){
            echo "New job vacancy added";
        }else{
            echo "Record not saved";
        }
    }

    //Handle delete eligibility request
    if($dataname=='del_elig'){
        $sq = "DELETE FROM eligibility_questions_tbl WHERE question_id='$id'";
        $stmt=$conn->query($sq);
        if(isset($stmt)){
            echo "Eligibility question deleted successfully";
        }
        else{
            echo "Error deleting record, please try again!";
        }
    }

    
   

    if($dataname=='edit_vac'){
        $sql = "SELECT *, posts.type AS position,
        job_vacancy_tbl.status AS vac_status
        FROM job_vacancy_tbl 
        JOIN employmentcategory ON job_vacancy_tbl.vacancy_category_id=employmentcategory.id
        JOIN employmenttype ON job_vacancy_tbl.employment_type=employmenttype.id
        JOIN departments ON job_vacancy_tbl.department_id=departments.id
        JOIN posts ON job_vacancy_tbl.post_id=posts.id
        WHERE vacancy_id = '$vac_id'";
        $result = $conn->query($sql);
        $q1 = $result->fetch();
        $vac_details = [
            "vacancy_id" => $q1["vacancy_id"],
            "emp_type" => $q1["employment_type"],
            "emp_cat" => $q1["vacancy_category_id"],
            "dept" => $q1["department_id"],
            "post" => $q1["post_id"],
            "date" => $q1["closing_date"],
            "location" => $q1["job_location"],
            "summary" => $q1["job_summary"],
            "exp_lvl" => $q1["experience_level"],
            "salary" => $q1["salary"],
        ];
        
        $sql2="SELECT * FROM qualifications_tbl WHERE vacancy_id = '$vac_id'";
        $result2 = $conn->query($sql2);
        $qual = $result2->fetchAll();
        $q2 = '';
        if($result2->rowCount() > 0){
            
            foreach($qual as $qrow){
                $q2 .= '<div class="input-group mt-2 col-md-6"><textarea class="form-control form-control-sm quals" name="quals" id="'.$qrow["id"].'" cols="40" rows="1">'.$qrow["qualification"].'</textarea><div class="input-group-append"><button class="btn-sm btn-danger del_quals" type="button" id="'.$qrow["id"].'" aria-haspopup="true" aria-expanded="false">X</button></div></div>';
            }
        }
        else {
            $q2 .= '';
        }


        $sql3="SELECT * FROM vacancy_desc_tbl WHERE vacancy_id = '$vac_id'";
        $result3 = $conn->query($sql3);
        $job = $result3->fetchAll();
        $q3 = '';
        if($result3->rowCount() > 0){
            foreach($job as $jrow){
                $q3 .= '<div class="input-group mt-2 col-md-6"><textarea class="form-control form-control-sm job_description" name="job_description" id="'.$jrow["desc_id"].'" cols="40" rows="1">'.$jrow["job_description"].'</textarea><div class="input-group-append"><button class="btn-sm btn-danger del_job" type="button" id="'.$jrow["desc_id"].'" aria-haspopup="true" aria-expanded="false">X</button></div></div>';
        
            }
        }
        else {
            $q3 .= '';
        }
        $details['vac_details']=$vac_details;
        $details['q2']=$q2;
        $details['q3']=$q3;

        $sql4="SELECT * FROM eligibility_questions_tbl WHERE vacancy_id='$vac_id'";
        $result4 = $conn->query($sql4);
        $eligq = $result4->fetchAll();
        $elig = '';
        if($result4->rowCount() > 0){
            foreach($eligq as $elig_row){
                $elig .= '<div class="input-group mt-2 col-md-12" id="eligibile_que"> <textarea class="form-control form-control-sm eligibility_question" name="eligibility_question" id="'.$elig_row["question_id"].'" cols="30" rows="1" >'.$elig_row["question"].'</textarea>
                <div class="input-group-append">';
                 if ($elig_row['expected_answer'] == '1') {
                    $elig .= '<select name="eligible_question_option" id="eligible_question_option" class="form-control form-control-sm eligible_question_option">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                        </select>';     
                }else{
                    $elig .= '<select name="eligible_question_option" id="eligible_question_option" class="form-control form-control-sm eligible_question_option">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                    </select>';  
                }

                if($elig_row['type'] == 'Advantage'){
                    $elig .= '<select name="eligible_question_type"  class="form-control form-control-sm eligible_question_type"><option value="0">Advantage</option><option value="1">Compulsory</option></select>';
                }else{
                    $elig .= '<select name="eligible_question_type"  class="form-control form-control-sm eligible_question_type"><option value="1">Compulsory</option><option value="0">Advantage</option></select>';
                }
                $elig .= '<button class="btn-sm btn-danger del_elig" type="button" id="'.$elig_row["question_id"].'" aria-haspopup="true" aria-expanded="false">X</button>
                </div>                        
            </div>';
            }
        }
        else{
            $elig .= '';
        }
        $details['elig']=$elig;
        
        $sql5="SELECT * FROM eligibility_passmark WHERE vacancy_id='$vac_id'";
        $result5=$conn->query($sql5);
        $pass=$result5->fetch(PDO::FETCH_ASSOC);
        $details['pass_mrk'] = $pass['passmark'];

        echo json_encode($details);
    }

    if($dataname=='deletequalification'){
        $sql = "DELETE FROM qualifications_tbl WHERE id='$id'";
        $result = $conn->query($sql);
        if(isset($result)){
            echo "Qualification deleted successfully";
        }
        else{
            echo "Error deleting record, please try again!";
        }
    }

    

    //Delete job description record
    if($dataname=='deletejob'){
        $sql = "DELETE FROM vacancy_desc_tbl WHERE desc_id='$id'";
        $result = $conn->query($sql);
        if(isset($result)){
            echo "Description deleted successfully";
        }
        else{
            echo "Error deleting record, please try again!";
        }
    }

    

    if($dataname=='vacupdate'){
        $sql = "UPDATE job_vacancy_tbl SET vacancy_category_id='$vaccat', employment_type='$vactype', department_id='$dept', post_id='$position', job_summary='$summary', experience_level='$exp_lvl', salary='$salary', closing_date='$deadline', job_location='$location' WHERE vacancy_id='$vacid'";
        $stmt = $conn->query($sql);

        $upd_pass="DELETE FROM eligibility_passmark WHERE vacancy_id='$vacid'";
        $smt = $conn->query($upd_pass);

        $ins_sql=$conn->prepare("INSERT INTO eligibility_passmark(vacancy_id, passmark) VALUES (?,?)");
        $ins_sql->bindParam(1, $vacid, PDO::PARAM_STR);
        $ins_sql->bindParam(2, $passmrk, PDO::PARAM_INT);
        $ins_sql->execute();


        $jobdescs=json_decode($jobdescs, true);
        foreach($jobdescs as $jobs){
        $jobdetails=$jobs['col1'];
        $ids=$jobs['col2'];
        $sql2 = "UPDATE vacancy_desc_tbl SET job_description='$jobdetails' WHERE vacancy_id='$vacid' AND desc_id='$ids'";
        $stmt2 = $conn->query($sql2);
        }

        $qualifics=json_decode($qualifics, true);
        foreach($qualifics as $qualifs){
            $qualifications=$qualifs['col1'];
            $ids=$qualifs['col2'];
            $sql3 = "UPDATE qualifications_tbl SET qualification='$qualifications' WHERE vacancy_id='$vacid' AND id='$ids'";
            $stmt3 = $conn->query($sql3);           
        }

        $appendjob=json_decode($appendjobupd, true);
        if(!empty($appendjob)){
            foreach($appendjob as $jobupd){
                $jobdesc =  $jobupd['col1'];
                $stmt4 = $conn->prepare("INSERT INTO vacancy_desc_tbl(vacancy_id, job_description) VALUES (?,?)");
                $stmt4->bindParam(1, $vacid, PDO::PARAM_STR);
                $stmt4->bindParam(2, $jobdesc, PDO::PARAM_STR); 
                $rest1=$stmt4->execute();
            }
        }
        else{
            echo '';
        }

        $appendquals=json_decode($appendqualsupd, true);
        if(!empty($appendquals)){
            foreach($appendquals as $appendq){
                $qualifications = $appendq['col1'];
                $stmt5 = $conn->prepare("INSERT INTO qualifications_tbl(vacancy_id, qualification) VALUES (?,?)");
                $stmt5->bindParam(1, $vacid, PDO::PARAM_STR);
                $stmt5->bindParam(2, $qualifications, PDO::PARAM_STR);  
                $rest2=$stmt5->execute();
            }
        }else{
            echo '';
        }

        $existing_eligs=json_decode($existing_elig, true);
        foreach($existing_eligs as $ex_eligs){
            $que_id = $ex_eligs['col1'];
            $que = $ex_eligs['col2'];
            $ans = $ex_eligs['col3'];
            $type = $ex_eligs['col4'];
            $sql6 = "UPDATE eligibility_questions_tbl SET question='$que', expected_answer='$ans', type='$type' WHERE question_id='$que_id'";
            $stmt6 = $conn->query($sql6);
        }
        
        $appended_eligs=json_decode($appended_elig, true);
        foreach($appended_eligs as $ap_eligs){
            $ap_que = $ap_eligs['col1'];
            $ap_ans = $ap_eligs['col2'];
            $ap_type = $ap_eligs['col3'];
            $stmt7 = $conn->prepare("INSERT INTO eligibility_questions_tbl(vacancy_id, question, expected_answer, type) VALUES (?,?,?,?)");
            $stmt7->bindParam(1, $vacid, PDO::PARAM_STR);
            $stmt7->bindParam(2, $ap_que, PDO::PARAM_STR);
            $stmt7->bindParam(3, $ap_ans, PDO::PARAM_STR);
            $stmt7->bindParam(4, $ap_type, PDO::PARAM_STR);
            $result=$stmt7->execute();
        }

        if(isset($stmt) || ($result)){
            echo 'Record updated successfully';
        }else{
            echo 'Error updating records';
        }

    }

    
    if($dataname=='deactivatevac'){
        $sql="UPDATE job_vacancy_tbl SET status='Inactive' WHERE vacancy_id='$id'";
        $result=$conn->query($sql);
        if(isset($result)){
            echo "Vacancy deactivated";
        }
        else{
            echo "Error deactivating record";
        }
    }

    if($dataname=='activatevac'){
        $sql="UPDATE job_vacancy_tbl SET status='Active' WHERE vacancy_id='$id'";
        $result=$conn->query($sql);
        if(isset($result)){
            echo "Vacancy activated";
        }
        else{
            echo "Error activating record";
        }
    }

    //Display appplicant details in table
    if($dataname == 'showapplicants'){
        $data = '
             <thead class="thead-light">
                <tr>
                <th scope="col">Applicant ID</th>
                <th scope="col">Title</th>                
                <th scope="col">Surname</th>
               <th scope="col">Other Names</th>
               <th scope="col">Email</th>
               <th scope="col">Phone Number</th>
               <th scope="col">Application Date</th>
               <th scope="col">Status</th>
               <th scope="col">Action</th>
               </tr>
           </thead>
           <tbody>';

        $sql="SELECT *, posts.type AS position
        FROM job_applicants_tbl
        JOIN posts ON job_applicants_tbl.position_id=posts.id
        WHERE vacancy_id='$id' AND submit_status='submitted'";
        $stmt= $conn->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
        if($stmt->rowCount() > 0){
            foreach($result as $row){
                $data .= '<tr class="mx-auto">
                            <td>'.$row["applicant_id"].'</td>
                            <td>'.$row["title"].'</td>
                            <td>'.$row["surname"].'</td>
                            <td>'.$row["first_name"].' '.$row["other_name"].'</td>
                            <td>'.$row["email"].'</td>
                            <td>'.$row["phone_number"].'</td>
                            <td>'.date_format(date_create($row["application_date"]), "d-M-Y").'</td>
                            <td>'.$row["status"].'</td>
                            <td>
                                <a href="" id="'.$row['applicant_id'].'" title="View Details" data-toggle="modal" data-target="#show_applicant_details" class="text-info view_app_info"><i class="fas fa-info-circle fa-1x"></i></a>&nbsp;&nbsp;

                                <a href="" id="'.$row['applicant_id'].'" title="Shortlist Candidate" class="text-primary shortlist_appl"><i class="fas fa-check-square fa-1x"></i></a>&nbsp;&nbsp;
                            </td>
                         </tr>';
                
            }
            $data .=  ' </tbody>';
            echo $data;
        }
        else{
            $data .= '<tr><td scope="col" colspan="9" class="text-danger text-center mx-auto"><h3>No Applications Yet</h3></td></tbody>';
            echo $data;   
        }
    
    }

    //Display full applicant details
    if($dataname=='showappdetails'){
        $sql = "SELECT *, posts.type AS position
        FROM job_applicants_tbl
        JOIN posts ON job_applicants_tbl.position_id=posts.id
        WHERE applicant_id='$details_id'";
        $stmt = $conn->query($sql);
        $row = $stmt->fetch();
        $vacancy_id = $row['vacancy_id'];
    
        $data['surname'] = $row['surname'];
        $data['other_names'] = $row['first_name'].' '.$row['other_name'];
        $data['sex'] = $row['sex'];
        $data['nationality'] = $row['nationality'];

        $data['dob'] = date_format(date_create($row['dob']),"d-M-Y");
        $data['m_status'] = $row['marital_status'];
        $data['state_of_origin'] = $row['state_of_origin'];
        $data['lga'] = $row['lga'];
        $data['hometown'] = $row['hometown'];
        $data['address'] = $row['street'].', '.$row['city'].', '.$row['state_of_residence'];
        $data['email'] = $row['email'];
        $data['cv'] = $row['cv_upload'];
        $data['phone_number'] = $row['phone_number'];
        $data['alt_phone_number'] = $row['alt_phone_number'];
        $data['application_date'] = date_format(date_create($row['application_date']), "d-M-Y");
        $data['cv_upload'] = $row['cv_upload'];
        $shortlisted = $row['status'];
    
        $ed_details = '';
        $sql2 = "SELECT * FROM educational_history_tbl WHERE applicant_id='$details_id' AND vacancy_id='$vacancy_id'";
        $stmt2 = $conn->query($sql2);
        $result = $stmt2->fetchAll(PDO::FETCH_ASSOC);        
        foreach($result as $ret2) {
            $inst = $ret2['institution'];
            $location = $ret2['location'];
            $start = date_format(date_create($ret2['start_date']), "d-M-Y");
            $end = date_format(date_create($ret2['end_date']), "d-M-Y");
            $course = $ret2['course'];
            $degree = $ret2['degree'];
            $class = $ret2['class_of_degree'];  
            // $ed_details .= 'Institution: '.$inst.'<br>
            //  Location: '.$location.'<br>
            //  From: '.$start.'<br>
            //  To: '.$end.'<br>
            //  Course: '.$course.'<br>
            //  Degree: '.$degree.'<br>
            //  Class of degree: '.$class.'<br><br>'; 
    
             $ed_details .= '<tr>
             <td>'.$inst.'</td>
             <td>'.$location.'</td>
             <td>'.$course.'</td>
             <td>'.$start.'</td>
             <td>'.$end.'</td>
             <td>'.$degree.'</td>
             <td>'.$class.'</td>             
             </tr>';     
        }  
        $data['educ']=$ed_details;
    
        $sq3 = "SELECT * FROM workexperience_tbl WHERE applicant_id='$details_id' AND vacancy_id='$vacancy_id'";
        $stmt3 = $conn->query($sq3);
        $result = $stmt3->fetchAll(PDO::FETCH_ASSOC);
        $work = '';
        foreach($result as $ret3){
            $org = $ret3['organization'];
            $start = date_format(date_create($ret3['start_date']),"d-M-Y");
            $end = date_format(date_create($ret3['end_date']),"d-M-Y");
            $position = $ret3['position_held'];
            $reason = $ret3['position_held'];
            $salary = $ret3['salary'];

            $work .= '<tr>
            <td>'.$org.'</td>
            <td>'.$position.'</td>
            <td>'.$start.'</td>
            <td>'.$end.'</td>
            <td>'.$reason.'</td>
            <td>'.$salary.'</td>           
            </tr>';
        
        }   
        $data['wrk']=$work; 

        $sq4 = "SELECT * FROM referees_tbl WHERE applicant_id='$details_id' AND vacancy_id='$vacancy_id'";
        $reslt4 = $conn->query($sq4);
        $lst4 = $reslt4->fetchAll(PDO::FETCH_ASSOC);
        $ref = '';
        foreach($lst4 as $ret4){
            $title = $ret4['title'];
            $surname = $ret4['surname'];
            $other_name = $ret4['other_names'];
            $org = $ret4['organization'];
            $desig = $ret4['designation'];
            $phone_num = $ret4['phone_number'];
            $email = $ret4['email'];

            $ref .= '<tr>
            <td>'.$title.'</td>
            <td>'.$surname.'</td>
            <td>'.$other_name.'</td>
            <td>'.$org.'</td>
            <td>'.$desig.'</td>
            <td>'.$phone_num.'</td>
            <td>'.$email.'</td>           
            </tr>';
        }
        $data['ref'] = $ref;
        
        if($shortlisted == ''){
            $upd = "UPDATE job_applicants_tbl SET status='reviewed' WHERE applicant_id='$details_id' AND vacancy_id='$vacancy_id'";
            $stmt = $conn->query($upd);
        }
        
        echo json_encode($data);
    
    }

    //Show applicants for each job
    if($dataname=='showapptbl'){
        $sql="SELECT *, posts.type AS position, employmentcategory.type AS empcat, employmenttype.type AS emptype, departments.dept AS dept, job_applicants_tbl.status AS stats FROM job_applicants_tbl
        JOIN employmentcategory ON job_applicants_tbl.vacancy_category_id=employmentcategory.id
        JOIN employmenttype ON job_applicants_tbl.employment_type=employmenttype.id
        JOIN departments ON job_applicants_tbl.department_id=departments.id
        JOIN posts ON job_applicants_tbl.position_id=posts.id
        WHERE job_applicants_tbl.status!='incomplete' AND vacancy_id='$id'";
        $result = $conn->query($sql);
        $count = $result->rowCount();
        $tbl_details = '';

        if($count > 0){            
            while ($row = $result->fetch()) {
                $age = (date_diff(date_create(), date_create($row['dob'])))->format("%Y");
                $app_id = $row['applicant_id'];
                $shortlist_status = $row['stats'];
                //$vacancy_id = $row['vacancy_id'];
                $sql2 = "SELECT applicant_id, vacancy_id, GROUP_CONCAT(degree, ' | ', CONCAT(course)) as degs FROM educational_history_tbl WHERE applicant_id = $app_id group by applicant_id";
                $result2 = $conn->query($sql2);
                $row2 = $result2->fetch();
                $qualifs = $row2['degs'];

                $actions = '';
                $sql3 = "SELECT * FROM application_status_tbl WHERE active='1'";
                $result3 = $conn->query($sql3);
                while($row3 = $result3->fetch(PDO::FETCH_ASSOC)){
                    $actions .= '<option class="" value="'.$row3['application_status'].'">'.$row3['application_status'].'</span><i class="fas fa-arrow-circle-right ml-2"></i></span></option>';
                }
            

                $sql4 = "SELECT applicant_id, SUM(TIMESTAMPDIFF(MONTH, start_date, end_date)) AS wrk_exp FROM workexperience_tbl WHERE applicant_id = $app_id";
                $result4 = $conn->query($sql4);
                $row4 = $result4->fetch(PDO::FETCH_ASSOC);
                $wkexp = $row4['wrk_exp'];

                                    
                $tbl_details .= '<tr class="" style="background-color: white">
                                    <td>'.$row['empcat'].'</td>
                                    <td>'.$row['position'].'</td>
                                    <td>'.$row['applicant_id'].'</td>
                                    <td>'.$row['title'].'</td>
                                    <td><span class="font-weight-bold">'.$row['surname'].'</span>'.' '.$row['first_name'].' '.$row['other_name'].'</td>
                                    <td>'.$age.'</td>
                                    <td>'.$row['sex'].'</td>
                                    <td>'.$row['email'].'</td>
                                    <td>'.$row['phone_number'].'</td>
                                    <td>'.$row['marital_status'].'</td>
                                    <td>'.$row['city'].'</td>
                                    <td>'.$qualifs.'</td>
                                    <td>'.$wkexp.'</td>
                                    <td> <h6 class="badge badge-primary"><span><i class="far fa-check-circle mr-1"></i></span>'.$shortlist_status.'</h6> </td>
                                    <td><a href="" id="'.$app_id.'" title="View Details" class="view_app_info badge badge-info"> View details <i class="fas fa-arrow-circle-right ml-1"></i></a>
                                    <select class="mt-3 form-control form-control-sm action">
                                        <option>Select action</option>'.$actions.'
                                    </select>
                                </tr>';
                                    
            }
        }

        else{
            $tbl_details .= '<tr class="" style="background-color: white">
                                <td colspan="14"><h3 class="text-danger d-flex justify-content-center">No Applications for this Vacancy yet</h3></td>
                            </tr>';
        }

        echo $tbl_details;
    }

if($dataname=='shortlist_applicant'){
    $upd = "UPDATE job_applicants_tbl SET status='shortlisted' WHERE applicant_id='$applicant_id'";
    $result = $conn->query($upd);

    $sq = "SELECT * FROM job_applicants_tbl WHERE applicant_id ='$applicant_id'";
    $reslt = $conn->query($sq);
    $ret = $reslt->fetch(PDO::FETCH_ASSOC);
    $id = $ret['vacancy_id'];

    if(isset($result)){
        //Query to refresh table details
        $sql="SELECT *, posts.type AS position, employmentcategory.type AS empcat, employmenttype.type AS emptype, departments.dept AS dept FROM job_applicants_tbl
        JOIN employmentcategory ON job_applicants_tbl.vacancy_category_id=employmentcategory.id
        JOIN employmenttype ON job_applicants_tbl.employment_type=employmenttype.id
        JOIN departments ON job_applicants_tbl.department_id=departments.id
        JOIN posts ON job_applicants_tbl.position_id=posts.id
        WHERE submit_status='submitted' AND vacancy_id='$id'";
        $result = $conn->query($sql);
        $tbl_details = '';
        while ($row = $result->fetch()) {
            $age = (date_diff(date_create(), date_create($row['dob'])))->format("%Y");
            $app_id = $row['applicant_id'];
            $shortlist_status = $row['status'];
            //$vacancy_id = $row['vacancy_id'];
            $sql2 = "SELECT applicant_id, vacancy_id, GROUP_CONCAT(degree, ' | ', CONCAT(course)) as degs FROM educational_history_tbl WHERE applicant_id = $app_id group by applicant_id";
            $result2 = $conn->query($sql2);
            $row2 = $result2->fetch();
            $qualifs = $row2['degs'];
        

            $sql4 = "SELECT applicant_id, SUM(TIMESTAMPDIFF(MONTH, start_date, end_date)) AS wrk_exp FROM workexperience_tbl WHERE applicant_id = $app_id";
            $result4 = $conn->query($sql4);
            $row4 = $result4->fetch();
            $wkexp = $row4['wrk_exp'];
                                
            $tbl_details .= '<tr class="" style="background-color: white">
                                <td>'.$row['empcat'].'</td>
                                <td>'.$row['position'].'</td>
                                <td>'.$row['title'].'</td>
                                <td><span class="font-weight-bold">'.$row['surname'].'</span>'.' '.$row['first_name'].' '.$row['other_name'].'</td>
                                <td>'.$age.'</td>
                                <td>'.$row['sex'].'</td>
                                <td>'.$row['email'].'</td>
                                <td>'.$row['phone_number'].'</td>
                                <td>'.$row['marital_status'].'</td>
                                <td>'.$row['city'].'</td>
                                <td>'.$qualifs.'</td>
                                <td>'.$wkexp.'</td>
                                <td>';
                                if($shortlist_status == 'shortlisted'){
                                    $status = '<h6 class="badge badge-success"><span><i class="fas fa-check-double mr-1"></i></span> Shortlisted</h6>';
                                }
                                else if($shortlist_status == 'rejected'){
                                    $status = '<h6 class="badge badge-danger"><span><i class="fas fa-times-circle mr-1"></i></span> Rejected</h6>';
                                } 
                                else if($shortlist_status == 'reviewed'){
                                    $status = '<h6 class="badge badge-primary"><span><i class="far fa-check-circle mr-1"></i></span> Reviewed</h6>';
                                } 
                                else {
                                    $status = '<h6 class="badge badge-info"><span><i class="fas fa-exclamation-circle mr-1"></i></span> Pending Review</h6>';                                        
                                }                     
                                $tbl_details .= '' .$status . '</td>
                                <td><a href="" id="'.$app_id.'" title="View Details" class="view_app_info badge badge-info"> View details <i class="fas fa-arrow-circle-right ml-1"></i></a>
                                <a href="" id="'.$app_id.'" class="shortlist_applicant badge badge-success"> Shortlist<i class="fas fa-arrow-circle-right ml-2"></i></a>
                                <a href="" id="'.$app_id.'" class="reject_applicant badge badge-danger"> Reject<i class="fas fa-arrow-circle-right ml-2"></i></a></td>
                            </tr>';
                                
        }
        $data['tbl_details'] = $tbl_details;
        $data['msg'] = "Applicant Shortlisted";
        echo json_encode($data);
    }
    else{
        $data['msg'] = "Error!";
        echo json_encode($data);
    }
}


if($dataname=='reject_applicant'){
    $upd = "UPDATE job_applicants_tbl SET status='rejected' WHERE applicant_id='$applicant_id'";
    $result = $conn->query($upd);

    //Fetch vacancy ID
    $sq = "SELECT * FROM job_applicants_tbl WHERE applicant_id ='$applicant_id'";
    $reslt = $conn->query($sq);
    $ret = $reslt->fetch(PDO::FETCH_ASSOC);
    $id = $ret['vacancy_id'];

    if(isset($result)){
        //Query to refresh table details
        $sql="SELECT *, posts.type AS position, employmentcategory.type AS empcat, employmenttype.type AS emptype, departments.dept AS dept FROM job_applicants_tbl
        JOIN employmentcategory ON job_applicants_tbl.vacancy_category_id=employmentcategory.id
        JOIN employmenttype ON job_applicants_tbl.employment_type=employmenttype.id
        JOIN departments ON job_applicants_tbl.department_id=departments.id
        JOIN posts ON job_applicants_tbl.position_id=posts.id
        WHERE submit_status='submitted' AND vacancy_id='$id'";
        $result = $conn->query($sql);
        $tbl_details = '';
        while ($row = $result->fetch()) {
            $age = (date_diff(date_create(), date_create($row['dob'])))->format("%Y");
            $app_id = $row['applicant_id'];
            $shortlist_status = $row['status'];
            //$vacancy_id = $row['vacancy_id'];
            $sql2 = "SELECT applicant_id, vacancy_id, GROUP_CONCAT(degree, ' | ', CONCAT(course)) as degs FROM educational_history_tbl WHERE applicant_id = $app_id group by applicant_id";
            $result2 = $conn->query($sql2);
            $row2 = $result2->fetch();
            $qualifs = $row2['degs'];
        

            $sql4 = "SELECT applicant_id, SUM(TIMESTAMPDIFF(MONTH, start_date, end_date)) AS wrk_exp FROM workexperience_tbl WHERE applicant_id = $app_id";
            $result4 = $conn->query($sql4);
            $row4 = $result4->fetch();
            $wkexp = $row4['wrk_exp'];
                                
            $tbl_details .= '<tr class="" style="background-color: white">
                                <td>'.$row['empcat'].'</td>
                                <td>'.$row['position'].'</td>
                                <td>'.$row['title'].'</td>
                                <td><span class="font-weight-bold">'.$row['surname'].'</span>'.' '.$row['first_name'].' '.$row['other_name'].'</td>
                                <td>'.$age.'</td>
                                <td>'.$row['sex'].'</td>
                                <td>'.$row['email'].'</td>
                                <td>'.$row['phone_number'].'</td>
                                <td>'.$row['marital_status'].'</td>
                                <td>'.$row['city'].'</td>
                                <td>'.$qualifs.'</td>
                                <td>'.$wkexp.'</td>
                                <td>';
                                if($shortlist_status == 'shortlisted'){
                                    $status = '<h6 class="badge badge-success"><span><i class="fas fa-check-double mr-1"></i></span> Shortlisted</h6>';
                                }
                                else if($shortlist_status == 'rejected'){
                                    $status = '<h6 class="badge badge-danger"><span><i class="fas fa-times-circle mr-1"></i></span> Rejected</h6>';
                                } 
                                else if($shortlist_status == 'reviewed'){
                                    $status = '<h6 class="badge badge-primary"><span><i class="far fa-check-circle mr-1"></i></span> Reviewed</h6>';
                                } 
                                else {
                                    $status = '<h6 class="badge badge-info"><span><i class="fas fa-exclamation-circle mr-1"></i></span> Pending Review</h6>';                                        
                                }                     
                                $tbl_details .= '' .$status . '</td>
                                <td><a href="" id="'.$app_id.'" title="View Details" class="view_app_info badge badge-info"> View details <i class="fas fa-arrow-circle-right ml-1"></i></a>
                                <a href="" id="'.$app_id.'" class="shortlist_applicant badge badge-success"> Shortlist<i class="fas fa-arrow-circle-right ml-2"></i></a>
                                <a href="" id="'.$app_id.'" class="reject_applicant badge badge-danger"> Reject<i class="fas fa-arrow-circle-right ml-2"></i></a></td>
                            </tr>';
                                
        }
        $data['tbl_details'] = $tbl_details;
        $data['msg'] = "Applicant Rejected";
        echo json_encode($data);
    }
    else{
        $data['msg'] = "Error!";
        echo json_encode($data);
    }
}

//Add new application status 
if($dataname=='savestatus'){
    //Check if status exists 
    $sql="SELECT * FROM application_status_tbl WHERE application_status LIKE '$status_name'";
    $get = $conn->query($sql);
    $count = $get->rowCount();
    //if status exists activate status
    if($count > 0){
        $row = $get->fetch(PDO::FETCH_ASSOC);
        $id = $row['id'];
        $sql2 = "UPDATE application_status_tbl SET active='1' WHERE id='$id'";
        $stmt = $conn->query($sql2);
        echo 'Status already exists and has been activated';
    }
    //if status doesn't exist, add as new
    else{
        $active = 1;
        $stmt=$conn->prepare("INSERT INTO application_status_tbl(application_status, remarks, active) VALUES (?,?,?)");
        $stmt->bindParam(1, $status_name, PDO::PARAM_STR);
        $stmt->bindParam(2, $remarks, PDO::PARAM_STR);
        $stmt->bindParam(3, $active, PDO::PARAM_INT);
        $result = $stmt->execute();
        if(isset($result)){
            echo 'New Status added successfully';
        }
        else{
            echo 'Error! Please try again';
        }

    }

    
}

//Edit status
if($dataname=='editstatus'){
    $sql = "SELECT * FROM application_status_tbl WHERE id='$id'";
    $stmt = $conn->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $sq2 = "SELECT * FROM job_applicants_tbl WHERE job_applicants_tbl.status='$app_status'";
    $result = $conn->query($sq2);
    if($result->rowCount() > 0){
        $data['status'] = 'in use';
    }
    else{
        $data['status'] = '';
    }  

    $data['app_status']=$row['application_status'];
    $data['remarks']=$row['remarks'];
    $data['id']=$row['id']; 

    echo json_encode($data);
}

//Update existing status
if($dataname=='updatestatus'){
    $sql = "UPDATE application_status_tbl SET application_status='$status_name', remarks='$remarks' WHERE id='$id'";
    $stmt=$conn->query($sql);
    if(isset($stmt)){
        echo 'Status Updated successfully';
    }
    else{
        echo 'Error! Please try again';
    }
}

//Delete status
if($dataname=='deletestatus'){
    //Check if status is been used in job_applicants_tbl
    $sq2 = "SELECT * FROM job_applicants_tbl WHERE job_applicants_tbl.status='$app_status'";
    $result = $conn->query($sq2);
    //if its been used, give error message
    if($result->rowCount() > 0){
        echo 'This status is been used already, it cannot be deleted';
    }

    //else deactivate status
    else{
        $sql = "UPDATE application_status_tbl SET active='0' WHERE id='$id'";
        $stmt=$conn->query($sql);
        if(isset($stmt)){
            echo 'Status Deleted successfully';
        }
        else{
            echo 'Error! Please try again';
        }    
    }  
    
}

if($dataname=='action'){
     //UPDATE applicants status
     $sql = "UPDATE job_applicants_tbl SET status='$status' WHERE applicant_id='$id'";
    $result = $conn->query($sql);
    
    if(isset($result)){
        echo "Applicant $status";
    }
    else{
        echo "Error!";
    }
}

if($dataname=='getapplicantstbl'){
        $sql="SELECT *, posts.type AS position, employmentcategory.type AS empcat, employmenttype.type AS emptype, departments.dept AS dept, job_applicants_tbl.status AS stats FROM job_applicants_tbl
        JOIN employmentcategory ON job_applicants_tbl.vacancy_category_id=employmentcategory.id
        JOIN employmenttype ON job_applicants_tbl.employment_type=employmenttype.id
        JOIN departments ON job_applicants_tbl.department_id=departments.id
        JOIN posts ON job_applicants_tbl.position_id=posts.id
        WHERE job_applicants_tbl.status='$status' AND vacancy_id='$id'";
    
    $result = $conn->query($sql);
    $count = $result->rowCount();
    $tbl_details = '';

    if($count > 0){            
        while ($row = $result->fetch()) {
            $age = (date_diff(date_create(), date_create($row['dob'])))->format("%Y");
            $app_id = $row['applicant_id'];
            $shortlist_status = $row['stats'];
            //$vacancy_id = $row['vacancy_id'];
            $sql2 = "SELECT applicant_id, vacancy_id, GROUP_CONCAT(degree, ' | ', CONCAT(course)) as degs FROM educational_history_tbl WHERE applicant_id = $app_id group by applicant_id";
            $result2 = $conn->query($sql2);
            $row2 = $result2->fetch();
            $qualifs = $row2['degs'];

            $actions = '';
            $sql3 = "SELECT * FROM application_status_tbl WHERE active='1'";
            $result3 = $conn->query($sql3);
            while($row3 = $result3->fetch(PDO::FETCH_ASSOC)){
                $actions .= '<option class="" value="'.$row3['application_status'].'">'.$row3['application_status'].'</span><i class="fas fa-arrow-circle-right ml-2"></i></span></option>';
            }
        

            $sql4 = "SELECT applicant_id, SUM(TIMESTAMPDIFF(MONTH, start_date, end_date)) AS wrk_exp FROM workexperience_tbl WHERE applicant_id = $app_id";
            $result4 = $conn->query($sql4);
            $row4 = $result4->fetch(PDO::FETCH_ASSOC);
            $wkexp = $row4['wrk_exp'];

                                
            $tbl_details .= '<tr class="" style="background-color: white">
                                <td>'.$row['empcat'].'</td>
                                <td>'.$row['position'].'</td>
                                <td>'.$row['applicant_id'].'</td>
                                <td>'.$row['title'].'</td>
                                <td><span class="font-weight-bold">'.$row['surname'].'</span>'.' '.$row['first_name'].' '.$row['other_name'].'</td>
                                <td>'.$age.'</td>
                                <td>'.$row['sex'].'</td>
                                <td>'.$row['email'].'</td>
                                <td>'.$row['phone_number'].'</td>
                                <td>'.$row['marital_status'].'</td>
                                <td>'.$row['city'].'</td>
                                <td>'.$qualifs.'</td>
                                <td>'.$wkexp.'</td>
                                <td>';

                                if($shortlist_status == ''){
                                    $status = '<h6 class="badge badge-warning"><span><i class="fas fa-exclamation-triangle mr-1"></i></span>Pending Review</h6>';
                                } 
                                else if($shortlist_status == 'reviewed'){
                                    $status = '<h6 class="badge badge-info"><span><i class="far fa-check-circle mr-1"></i></span>reviewed</h6>';
                                }
                                else{
                                    $status = '<h6 class="badge badge-primary"><span><i class="far fa-check-circle mr-1"></i></span>'.$shortlist_status.'</h6>';
                                }
                               
                                $tbl_details .= '' .$status. '</td>
                                <td><a href="" id="'.$app_id.'" title="View Details" class="view_app_info badge badge-info"> View details <i class="fas fa-arrow-circle-right ml-1"></i></a>
                                <select class="mt-3 form-control form-control-sm action">
                                    <option>Select action</option>'.$actions.'
                                </select>
                            </tr>';
                                
        }
    }

    else{
        $tbl_details .= '<tr class="" style="background-color: white">
                            <td colspan="14"><h3 class="text-danger d-flex justify-content-center">No Applications for this Category</h3></td>
                        </tr>';
    }

    echo $tbl_details;
}

//Add new interview panel group controller
if($dataname=='addnewpanel'){
    
    $sql = "SELECT  * FROM interview_panels_tbl WHERE panel_name = '$panel'";
    $result = $conn->query($sql);
    $panel_id = '';
    if($result->rowCount() > 0){
        echo 'Panel Name already exists try a new name';
    }
    else{
        $stmt=$conn->prepare("INSERT INTO interview_panels_tbl(panel_name, interview_date, venue) VALUES (?,?,?)");
        $stmt->bindParam(1, $panel, PDO::PARAM_STR);
        $stmt->bindParam(2, $interview_date, PDO::PARAM_STR);
        $stmt->bindParam(3, $venue, PDO::PARAM_STR);
        $stmt->execute();
        $result = $panel_id = $conn->lastInsertId();

        $panelmember_array = json_decode($panelmember_array, true);
        $i = 1;
        foreach ($panelmember_array as $panel_members){
            $id = $panel_members['col1'];
            $member = $panel_members['col2'];
            if($id == ''){
                $staff_id = 'external'.$i;
                $i++;
            }
            else{
                $staff_id = $id;
            }
            $stmt = $conn->prepare("INSERT INTO interview_panelists_tbl (panel_id, staff_id, staff_name) VALUES (?,?,?)");
            $stmt->bindParam(1, $panel_id, PDO::PARAM_STR);
            $stmt->bindParam(2, $staff_id, PDO::PARAM_STR);
            $stmt->bindParam(3, $member, PDO::PARAM_STR);
            $result2 = $stmt->execute();
        }
        
        if(isset($result) && isset($result2)){
            echo 'New Interview Panel Created';
        }
        else{
            echo 'There was an error please try again';
        }       
    }    

}

//Get staff list for Panelist table
if($dataname=='getpaneliststaff'){
    $staff = '<label for="staff type">Select Staff</label><br><div class="input-group"> 
    <select type="text" class="form-control form-control-sm" id="panelist_staff" name="panelist_staff">
    <option value="">Choose staff</option>';
    $sql = "SELECT * FROM currentstafflist";
    $result = $conn->query($sql);
    while($row=$result->fetch()){
        $staff .='<option value="'.$row['idno'].'">'.$row['title'].' '.$row['sname'].' '.$row['fname'].' '.$row['mname'].'</option>';
    }
    $staff .='</select><div class="input-group-append"> <button class="badge badge-success float-right add_staff" id="add_staff"><i class="fas fa-plus"></i>Add</button> </div></div>';
    echo $staff;
}

//Display existing panel details
if($dataname=='edit_interview_panel'){
    $sql = "SELECT * FROM interview_panels_tbl WHERE panel_id='$id'";
    $result = $conn->query($sql);
    $row = $result->fetch(PDO::FETCH_ASSOC);

    $data['panel_name'] = $row['panel_name'];
    $data['interview_date'] = $row['interview_date'];
    $data['venue'] = $row['venue'];

    $sql2 = "SELECT * FROM interview_panelists_tbl WHERE panel_id='$id'";
    $result2 = $conn->query($sql2);
    $row2 = $result2->fetchAll(PDO::FETCH_ASSOC);
    $members = '';
    foreach($row2 as $get){
        similar_text($get['staff_id'],"external",$percent);
        if($percent > 80){
            $staffid = '';
        }
        else{
            $staffid = $get['staff_id'];
        }
        $members .= '<tr><td>'.$staffid.'</td><td>'.$get['staff_name'].'<a href="javascript:void(0);" class="badge badge-danger float-right remove_existing_panelist" id="'.$get['id'].'"><i class="fas fa-times"></i></a></td></tr>';
    } 
    $data['members'] = $members;
    echo json_encode($data);
}

//Get staff list to add for existing panel group
if($dataname=='geteditpaneliststaff'){
    $staff = '<label for="staff type">Select Staff</label><br><div class="input-group"> 
    <select type="text" class="form-control form-control-sm" id="edit_panelist_staff" name="edit_panelist_staff">
    <option value="">Choose staff</option>';
    $sql = "SELECT * FROM currentstafflist";
    $result = $conn->query($sql);
    while($row=$result->fetch()){
        $staff .='<option value="'.$row['idno'].'">'.$row['title'].' '.$row['sname'].' '.$row['fname'].' '.$row['mname'].'</option>';
    }
    $staff .='</select><div class="input-group-append"> <button class="badge badge-success float-right edit_add_staff" id="edit_add_staff"><i class="fas fa-plus"></i>Add</button> </div></div>';
    echo $staff;
}

//Delete existing panel group
if($dataname == 'delete_panel'){
    $sql1 = "DELETE FROM interview_panels_tbl WHERE panel_id='$id'";
    $stmt1 = $conn->query($sql1);

    $sql2 = "DELETE FROM interview_panelists_tbl WHERE panel_id='$id'";
    $stmt2 = $conn->query($sql2);

    if(isset($stmt2)){
        echo 'Panel deleted';
    }
    else{
        echo 'Something went wrong try again!';
    }
}

//Update existing panel group
if($dataname=='updatepanel'){ 
    $sq1 = "UPDATE interview_panels_tbl SET panel_name='$panel', interview_date='$interview_date', venue='$venue' WHERE panel_id='$panelid'";
    $stmt1 = $conn->query($sq1);

    $sq2 = "DELETE FROM interview_panelists_tbl WHERE panel_id = '$panelid'";
    $stmt2 = $conn->query($sq2);

        $panelmember_array = json_decode($panelmember_array, true);
        $i = 1;
        foreach ($panelmember_array as $panel_members){
            $id = $panel_members['col1'];
            $member = $panel_members['col2'];
            if($id == ''){
                $staff_id = 'external'.$i;
                $i++;
            }
            else{
                $staff_id = $id;
            }
            $stmt = $conn->prepare("INSERT INTO interview_panelists_tbl (panel_id, staff_id, staff_name) VALUES (?,?,?)");
            $stmt->bindParam(1, $panelid, PDO::PARAM_STR);
            $stmt->bindParam(2, $staff_id, PDO::PARAM_STR);
            $stmt->bindParam(3, $member, PDO::PARAM_STR);
            $result2 = $stmt->execute();
        }
        
        if(isset($result2)){
            echo 'Panel Updated';
        }
        else{
            echo 'There was an error please try again';
        }        

}

//Delete existing panel member
if($dataname=='delete_panelmember'){
    $sql = "DELETE FROM interview_panelists_tbl WHERE id='$id'";
    $stmt = $conn->query($sql);

    if(isset($stmt)){
        echo 'Member deleted';
    }
    else{
        echo 'Try again';
    }
}

    
?>
