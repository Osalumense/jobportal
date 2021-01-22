<?php
$title = 'view vacancies';
include "../includes/db_conn.php";
include_once "../includes/header.php"; 

?>
<h5 class="text-center my-5 bg-light p-2">VIEW VACANCIES</h5>

<div class="container-responsive mx-3">
    <table class="table table-sm table-bordered" id="vacancy_tbl">
        <thead class="thead-light">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Type</th>
            <th scope="col">Category</th>
            <th scope="col">Unit/Department</th>
            <th scope="col">Post</th>
            <th scope="col">Deadline</th>
            <th scope="col">Location</th>
            <th scope="col">Summary</th>
            <th scope="col">Experience level</th>
            <th scope="col">Salary range</th>
            <th scope="col">Qualifications</th>
            <th scope="col">Job description</th>
            <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <?php
            $sql = "SELECT *, posts.type AS position, 
            employmenttype.type AS emptype, 
            employmentcategory.type AS empcat,
            job_vacancy_tbl.status AS vac_status
            FROM job_vacancy_tbl 
            JOIN employmentcategory ON job_vacancy_tbl.vacancy_category_id=employmentcategory.id
            JOIN employmenttype ON job_vacancy_tbl.employment_type=employmenttype.id
            JOIN departments ON job_vacancy_tbl.department_id=departments.id
            JOIN posts ON job_vacancy_tbl.post_id=posts.id
            JOIN states ON job_vacancy_tbl.job_location=states.state_id ORDER BY vacancy_id ASC";
                $result = $conn->query($sql);
                if($result->rowCount() > 0){
                    $searchrow = $result->fetchAll();
                    foreach($searchrow as $row){
                        $vac_id = $row["vacancy_id"];
                        $data = '
                            <tr class="mx-auto">
                            <td>'.$row["vacancy_id"].'</td>
                            <td>'.$row["emptype"].'</td>
                            <td>'.$row["empcat"].'</td>
                            <td>'.$row["dept"].'</td>
                            <td>'.$row["position"].'</td>
                            <td>'.$row["closing_date"].'</td>
                            <td>'.$row["state_name"].'</td>
                            <td>'.$row["job_summary"].'</td> 
                            <td>'.$row["experience_level"].'</td>        
                            <td>'.$row["salary"].'</td>
                            <td>';
                            
                            $sql = "SELECT * FROM  qualifications_tbl WHERE vacancy_id='$vac_id'";
                            $result2 = $conn->query($sql);
                            $qual = $result2->fetchAll();
                            foreach($qual as $qrow){
                            $data .= $qrow["qualification"].'<br>';
                        }

                    $data .= '</td>
                    <td>';
                            $sql = "SELECT * FROM  vacancy_desc_tbl WHERE vacancy_id='$vac_id'";
                            $result2 = $conn->query($sql);
                            $qual = $result2->fetchAll();
                            foreach($qual as $qrow){
                            $data .= $qrow["job_description"].'<br>';
                        }
                    $data .= '<td>'.$row["vac_status"].'</td>
                                </td>
                    </tr>';
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


<?php
include_once '../includes/footer.php';
?>

<script>
     //$('#vacancy_tbl').DataTable();
    //  $(document).ready( function () {
    //     $('#vacancy_tbl').DataTable();
    // });
</script>