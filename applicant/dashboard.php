<?php
require_once '../includes/applicant_header.php';
include "../includes/db_conn.php";
$uid = $user['uid'];
?>

<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <div class="justify-content-center">
                        
                        
                        <?php
                            // $uid = $user['uid'];
                            // $sql="SELECT *, posts.type AS position FROM job_applicants_tbl 
                            // JOIN posts ON job_applicants_tbl.position_id=posts.id 
                            // WHERE uid='$uid'";
                            // $stmt = $conn->query($sql);
                            // if($stmt->rowCount() > 0) {
                            //     while($result = $stmt->fetch()){
                            //         $app_status = $result['shortlist_status'];
                            //     $data = '
                            //     <div class="container col-lg-9 col-sm-6 justify-content-center border rounded mx-auto">
                            //         <div class="row mt-2">
                            //             <div class="col-lg-7">
                            //                 <h6 class="text-muted"> Position: '.$result['position'].'</h6>
                            //             </div>
                            //             <div class="col-lg-5">
                            //                 <h6 class="text-muted text-right"> Applicant ID: '.$result['applicant_id'].'</h6>
                            //             </div>
                            //         </div>
                            //         <div class="row my-2 mx-auto">
                            //         <h6 class="text-muted mr-2"> Application Status:  </h6>
                            //             ';
                            //         if($app_status == ''){
                            //             $data .= '<div class="col-lg-2 col-sm-6 bg-primary rounded text-white text-center"> Pending     
                            //                       </div> 
                            //                         ';
                            //         }

                            //         }                                   
                                    
                            //     $data .= '      
                            //                 </div>
                            //             </div>';
                            //     echo $data;
                            // }
                            // else{
                            //     echo '<h5 class="text-muted">You havent applied for any jobs yet</>';
                            // }

                        ?>
                        <div class="card">
                                    <div class="card-header text-center  text-white" style="background-color: #c0c0c0">
                                        <h4>My Applications</h4>
                                        <h5 class="font-weight-light text-muted text-center">View and Track your applications here</h5>
                                    </div>
                                    <div class="card-body">

                                <?php
                                    $uid = $user['uid'];
                                    $sql="SELECT *, posts.type AS position FROM job_applicants_tbl 
                                    JOIN posts ON job_applicants_tbl.position_id=posts.id 
                                    WHERE uid='$uid' ORDER BY application_date";
                                    $stmt = $conn->query($sql);
                                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    $data = '';
                                    foreach($result as $app_rec){
                                        $stat=$app_rec['shortlist_status'];
                                        $appdate=date_format(date_create($app_rec['application_date']), "d M, Y");

                                        $data .= '<div class="card-text rounded m-3 p-1" style="border: 1px solid #c0c0c0">
                                            <div class="row">
                                            <div class="col-sm">
                                            <h5 class="text-muted">'.$app_rec["position"].'</h5>
                                            </div>
                                            </div>

                                            <div class="row text-muted">
                                            <div class="col-sm-10">
                                                Applied on: '.$appdate.'
                                             </div>';

                                             if($stat==''){
                                                $data .=
                                                '<div class="col-sm-2 justify-content-end"><span class="badge badge-info float-right p-1 m-1">Pending</span>
                                                </div>
                                               </div>
                                           </div>';
                                            }
                                            else{
                                                $data .=
                                                '<div class="col-sm-2 justify-content-end"><span class="badge badge-success float-right p-1 m-1">Shortlisted</span>
                                                </div>
                                               </div>
                                           </div>';}
                                    }
                                    echo $data;
                                ?>
                                </div>

                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

        
</body>
</html>