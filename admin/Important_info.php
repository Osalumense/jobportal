<?php
$title = 'important information';
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

    <h5 class="text-center mt-3 bg-light p-2">RECRUITMENT APPLICATION INSTRUCTIONS</h5>

    <div class="container">
        <div class="row">
            <div class="card col-sm-10">
                <h5 class="card-header col-sm">How to Use the Recruitment Application</h5>
                <div class="card-body">
                    <h4 class="card-title">CREATE VACANCY</h4>
                    <div class="card-text">
                        <h6>Job details</h6>
                        <p>To create a new vacancy:</p>
                        <ol>                        
                            <li>Select the employment type from the list of employment types available</li>
                            <li>Select the employment category from the list of employment categories available</li>
                            <li>Select the unit/department from the departments in the organization</li>
                            <li>Select the vacant position from the list of available positions, if not available should be setup by the HR personnel</li>
                            <li>Select the date the application period is going to close</li>
                            <li>Enter the location of the vacancy</li> 
                        </ol> <br>

                        <h6>Job Summary</h6>
                        <ol>
                            <li>Enter a brief summary about the vacant post</li>
                            <li>Enter the experience level; be it <strong>entry level</strong>, <strong>mid-level</strong> or <strong>senior level</strong>. </li>
                            <li>Enter the specific salary or a salary range</li>
                        </ol>
                         <br>

                        <h6>Job Description</h6>
                        <ol>
                            <li>Itemize the job description; new fields can be added by using the <strong>Add</strong> button </li>
                        </ol>
                         <br>

                        <h6>Qualifications</h6>
                        <ol>
                            <li>Itemize the requirements or qualifications needed for the job; new fields can be added by using the <strong>Add</strong> button </li>
                        </ol> <br>  

                        <h6>Eligibility Criteria</h6>                 
                        <p class="font-italic">These are questions that must be answered by the appplicant to verify if he/she meets the requirements for the job.</p> <strong>The questions should be framed such that they have a Yes/No answer.</strong><br>
                        <p>For an applicant to be eligible to apply for a job, he/she must answer all compulsory questions correctly and score higher than (or equal to) the eligiblity passmark stated</p>
                        <ol>
                            <li>Enter the question</li>
                            <li>Select the answer; <strong>Yes/No</strong></li>
                            <li>Select the question type; whether it is compulsory or just an added advantage</li>
                            <li>Enter the passmark for the questions. <strong>The passmark cannot exceed the number of questions.</strong> </li>
                        </ol><br>

                        <p>Finally review the entries and create a vacancy.</p>

                        <p>Once a vacancy is declared it automatically becomes active and visible to applicants on <a href="https://www.jobportal.penl.com.ng" target="_blank">www.jobportal.penl.com.ng</a> </p>
                        
                    </div>                    
                </div>
            </div>
        </div>    
    </div>

    
</body>
</html>