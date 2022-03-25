<?php
include "includes/db_conn.php";

    extract($_POST);
    if($dataname=='getcat'){
        $sql = "SELECT *, posts.type AS emptype FROM job_vacancy_tbl LEFT JOIN posts ON job_vacancy_tbl.post_id=posts.id WHERE (vacancy_category_id='$category' AND job_vacancy_tbl.status='Active')";

        $result = $conn->query($sql);
        if($result->rowCount() > 0){
            $searchrow = $result->fetchAll();
            foreach($searchrow as $row){
            $tab[] = '<a class="nav-link" id="'.$row["vacancy_id"].'" data-toggle="pill" href="#'.$row["vacancy_id"].'" role="tab">'.ucfirst($row["emptype"]).'</a>'; 
            }
            $navdetails['tab']=$tab;
            echo json_encode($navdetails);
        }
    }


    if($dataname=='getempdet'){
        $sql = "SELECT *, posts.type AS position, 
        employmenttype.type AS emptype, 
        employmentcategory.type AS empcat
        FROM job_vacancy_tbl 
        JOIN employmentcategory ON job_vacancy_tbl.vacancy_category_id=employmentcategory.id
        JOIN employmenttype ON job_vacancy_tbl.employment_type=employmenttype.id
        JOIN departments ON job_vacancy_tbl.department_id=departments.id
        JOIN posts ON job_vacancy_tbl.post_id=posts.id
        WHERE vacancy_id='$id'";
        

        $result = $conn->query($sql);
        $searchrow = $result->fetchAll();
        foreach($searchrow as $row){
            $tabval = '<div class="tab-pane fade container show active" id="'.$row["vacancy_id"].'" role="tabpanel">
                    <div class="row">
                        <!--<div class="col-md-4 col-sm-6">
                            <h5 class="">Vacancy Details:</h5>
                        </div>-->
                        <div class="col-md-9 col-sm-12">
                            <h5><span class="font-weight-lighter">Position: </span>'.ucfirst($row["position"]).'</h5>
                        </div>
                        <div class="col-md-3 col-sm">
                            <a href="account/account_confirm.php?id='.$row["vacancy_id"].'"><button class="btn btn-lg bg-gradient btn-outline-info float-right p-2 rounded-pill" id="show_job">Apply Now</button></a>
                        </div>
                        
                    </div>

                    <div class="row justify-content-center mt-2">
                        <div class="col-md-4 col-sm-6">
                            <p>Category: <span class="lead">'.$row["empcat"].'</span></p>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <p>Employment Type: <span class="lead">'.$row["emptype"].'</span></p>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <p>Department: <span class="lead">'.$row["dept"].'</span></p>
                        </div>                        
                    </div>
                    
                    <div class="row justify-content-center">
                        <div class="col-md-4 col-sm-6">
                            <p>Valid until: <span class="lead">'.$row["closing_date"].'</span></p>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <p>Location: <span class="lead">'.$row["job_location"].'</span></p>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <p>Salary: <span class="lead">'.$row["salary"].'</span></p>
                        </div>                        
                    </div>                      
                    
                    
                    
                    <p>Job Summary: <span class="lead">'.$row["job_summary"].'</span></p>
                    <p>Experience level: <span class="lead">'.$row["experience_level"].'</span></p>

                    <div class="row justify-content-center">
                        <div class="col">
                            <p>Minimum requirements: </p> <ol><span class="lead">';
                            
                            $sql2="SELECT * FROM qualifications_tbl WHERE vacancy_id = '$id'";
                            $result2 = $conn->query($sql2);
                            $qual = $result2->fetchAll();
                            foreach($qual as $qrow){
                                $tabval.= '<li>'.$qrow["qualification"].'</li>';
                            }

                            $tabval.=' </span></ol>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col">
                            <p>Job Description:</p>
                            <ol><span class="lead">';

                            $sql3="SELECT * FROM vacancy_desc_tbl WHERE vacancy_id = '$id'";
                            $result3 = $conn->query($sql3);
                            $job = $result3->fetchAll();
                            foreach($job as $jrow){
                                $tabval.= '<li>'.$jrow["job_description"].'</li>';
                            }

                            $tabval .='</span></ol>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <a href="account/account_confirm.php?id='.$row["vacancy_id"].'"><button class="btn btn-lg bg-gradient btn-outline-info float-right p-2 rounded-pill" id="show_job">Apply Now</button></a>
                    </div>                  
                <hr>
            </div>';
        }                
            $navdetails['tabval']=$tabval;
            echo json_encode($navdetails);

    }

    if($dataname=='showvacancies'){
        $current_date = date('Y-m-d');
        $sql = "SELECT * FROM employmentcategory";
        $result = $conn->query($sql);
        $cats = $result->fetchAll();
      
        
        foreach($cats as $jrow){
            $jobtype=$jrow["id"];
            $catdisplay[] = '<h5 class="mx-auto">'.$jrow["type"].'</h5>';
        
            $sql2="SELECT *, posts.type AS emptype FROM job_vacancy_tbl LEFT JOIN posts ON job_vacancy_tbl.post_id=posts.id WHERE (vacancy_category_id='$jobtype') AND ('$current_date' BETWEEN creation_date AND closing_date)";
            $result2 = $conn->query($sql2);
            $posts = $result2->fetchAll();
            if($result->rowCount() > 0){
                foreach($posts as $prow){
                    $catdisplay[] = '<a class="nav-link links text-primary fw-bold" id="'.$prow["vacancy_id"].'" data-toggle="pill" href="#'.$prow["vacancy_id"].'" role="tab">'.$prow["emptype"].'</a>'; 
                }
            } elseif(rowCount() < 0){
                $catdisplay[] = '<p> No vacancies available </p>';
            }
        }
        
        $jobs['catdisplay']=$catdisplay;
        echo json_encode($jobs);
    }


    if($dataname == 'subscribetoupdate'){

        $stmt = $conn->prepare("INSERT INTO subscriptions_tbl(dept_id, location_id, email) VALUES (?,?,?)");
        $stmt->bindParam(1, $dept, PDO::PARAM_INT);
        $stmt->bindParam(2, $location, PDO::PARAM_INT);
        $stmt->bindParam(3, $mail, PDO::PARAM_STR);
        $result=$stmt->execute();

        if(isset($result)){
            echo "You have successfully subscribed to receive job updates according to your preferences";
        }else{
            echo "Error!! Please resubscribe";
        }
    }
?>