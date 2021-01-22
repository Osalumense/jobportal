<?php
    // $input_date = '31-12-2020';
    // $fmt_date = date_format(date_create($input_date), "Y-m-d").'<br>';
    // echo $fmt_date;

    // $input_date2 = '4/12/2020';
    // $fmt_date2 = date_format(date_create($input_date2), "Y-m-d").'<br>';
    // echo $fmt_date2;


    // $dob = "1997-06-25";
    // // $age = date_diff(date_create(), date_create($dob));
    // // echo $age->format("%Y Yrs Old");

    // $age_calc = (date_diff(date_create(), date_create($dob)))->format("%Y yrs old");
    // echo $age_calc;

    //print_r(date_create());


    // $str = date("19-09");
    // $new_num = "000";
    // $current_date = date('y');
    // $id = $str.'-'.$new_num;
    // //echo $current_date;
    // $str_details = explode('-',$str);
    // print_r($str_details);
    // echo $current_date.'<br>';
    // $lastrecyear=$str_details[0];
    // if ($current_date > $lastrecyear){
    //     $newdate = date('y').'-'.date('m').'-'.$new_num;
    //     echo $newdate.'<br>';
    //     $newpref = date('y').'-'.date('m');
    //     $newid = sprintf("%03d", substr($newdate, 6) + 1);
    //     echo $newid.'<br>';
    //     for($i=1; $i<20; $i++){
    //         $id = sprintf("%03d", $newid + $i);
    //         echo $newpref.'-'.$id.'<br>';            
    //     } 
    // }
    // else{
    //     $newid = sprintf("%03d", substr($id, 6));
    //     $newrec = $str.'-'.$newid;
    //     echo $newrec.'<br>';
    //     for($i=1; $i<20; $i++){
    //         $id = sprintf("%03d", $newid + $i);
    //         echo $str.'-'.$id.'<br>';            
    //     }

    // }




    // $id = $str.'-'.$new_num;
    // echo $id.'<br>';
    // $id2 = sprintf("%03d", substr($id, 6) + 1);
    // echo $id2.'<br>';
    // for($i=1; $i<20; $i++){
    //     $id = sprintf("%03d", $id2 + $i);
    //     echo $str.'-'.$id.'<br>';
    // }

    include "../includes/db_conn.php";
    $id='5';
    $sql="SELECT *, posts.type AS position, employmentcategory.type AS empcat, employmenttype.type AS emptype, departments.dept AS dept FROM job_applicants_tbl
        JOIN employmentcategory ON job_applicants_tbl.vacancy_category_id=employmentcategory.id
        JOIN employmenttype ON job_applicants_tbl.employment_type=employmenttype.id
        JOIN departments ON job_applicants_tbl.department_id=departments.id
        JOIN posts ON job_applicants_tbl.position_id=posts.id
        WHERE submit_status='submitted' AND vacancy_id='$id'";
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
                                    
                                    $tbl_details = '<tr class="" style="background-color: white">
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
                                            $tbl_details .= '<td>'.$qualifs.' | '.$specs.'</td>
                                            <td></td>
                                            <td>'.$wkexp.'</td>
                                            <td><a href="" id="'.$app_id.'" title="View Details" class="text-info view_app_info"><i class="fas fa-info-circle fa-1x"></i></a></td>
                                        </tr>';
                                    
                                }
                                $data['data'] = $tbl_details;
                                echo json_encode($data);
?>