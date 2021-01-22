<?php
$title='Job application';
include "includes/db_conn.php";
include_once "includes/header.php";
?>

<style>
  .navbar-brand>img {
            height: 3rem;
            width: 7rem;
            padding: 0px;
        }
    </style>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"><img src="images/logo.png" alt="company logo">
        </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Contact</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
    <h3 class="text-center mt-3">Job Vacancies</h3>

    <!--<div class="container">
        <div class="row">
            <div class="col-md-9 my-3 mx-auto">
                <hr>
                <h6>Admin Manager</h6>  
                <p><span class="lead">Minimum requirements:</span>Bsc, Msc
                3 years of work experience</p>       
                <p><span class="lead">Category: </span>Non-Technical</p>
                <p><span class="lead">Employment Type: </span>Full-time</p>
                <a href="#"><button class="btn btn-success">Apply Now</button></a>
            </div>
            <div class="col-md-9 my-3 mx-auto">
                <hr>
                <h6>Admin Manager</h6>  
                <p><span class="lead">Minimum requirements:</span>Bsc, Msc
                3 years of work experience</p>       
                <p><span class="lead">Category: </span>Non-Technical</p>
                <p><span class="lead">Employment Type: </span>Full-time</p>
                <a href="#"><button class="btn btn-success">Apply Now</button></a>
            </div>
            <div class="col-md-9 my-3 mx-auto">
                <hr>
                <h6>Admin Manager</h6>  
                <p><span class="lead">Minimum requirements:</span>Bsc, Msc
                3 years of work experience</p>       
                <p><span class="lead">Category: </span>Non-Technical</p>
                <p><span class="lead">Employment Type: </span>Full-time</p>
                <a href="#"><button class="btn btn-success">Apply Now</button></a>
            </div>                     
        </div>
    </div>     -->

  
  <div class="container bg-light">
    <div class="col-md-2 my-4 col-sm-6">
                  <label for="category" class="text-muted font-weight-bold">Select category:</label>
                          <select name="category" id="category" class="form-control form-control-sm">
                              <option value="">Select category</option>                      
                              <?php
                                  $sql="SELECT * FROM employmentcategory";
                                  $result = $conn->query($sql);
                                  while($searchrow = $result->fetch()){
                                  echo "<option value=".$searchrow['id'] .">" . ucfirst($searchrow['type']) ."</option>";
                                  }            
                              ?>
                          </select>
      </div>
    <div class="row">
      <div class="col-sm-2 my-3">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        </div>
      </div>

      <div class="col-sm-4">
          <div class="tab-content" id="v-pills-tabContent">
          </div>
      </div>

      <div class="col-sm-6" id="job_application" style="display:none">
          <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fa fa-user fa-2x" aria-hidden="true"></i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fa fa-address-card fa-2x" aria-hidden="true"></i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false"><i class="fa fa-user-graduate fa-2x" aria-hidden="true"></i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-con-tab" data-toggle="pill" href="#pills-con" role="tab" aria-controls="pills-contact" aria-selected="false"><i class="fa fa-briefcase fa-2x" aria-hidden="true"></i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-con-tab" data-toggle="pill" href="#pills-con" role="tab" aria-controls="pills-contact" aria-selected="false"><i class="fa fa-house-user fa-2x" aria-hidden="true"></i></a> 
            </li>
          </ul>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">...</div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
          </div>                      
      </div>

  </div>
</div>
    
</body>
</html>

<script>
  var ajaxurl='pagecontrol.php';
  var page='jobapplication.php';

  $(document).on("change", "#category", function(){
    var category = $("#category").val();
    $.ajax({
      method: "POST",
      url:ajaxurl,
      dataType: "JSON",
      data:{category:category,dataname:'getcat'},
      success:function(navdetails){
        //alert(tab);
        $("#v-pills-tab").html(navdetails.tab);
        //$("#v-pills-tabContent").html(navdetails.tabval);
      }
    });

  });

  $(document).on("click", ".nav-link", function(){
      var id = $(this).attr("id");
      //console.log(id);
      $.ajax({
      method: "POST",
      url:ajaxurl,
      dataType: "JSON",
      data:{id:id,dataname:'getempdet'},
      success:function(navdetails){
        //alert(tab);
       // $("#v-pills-tab").html(navdetails.tab);
        $("#v-pills-tabContent").html(navdetails.tabval);
      }
    });      
  });

  // $(document).on("change", "#v-pills-tab a", function(){
  //   var cate = $(this).attr.val();
  //   console.log(cate);
  //   // $.ajax({
  //   //   method: "POST",
  //   //   url:ajaxurl,
  //   //   data:{category:category,dataname:'getjobs'},
  //   //   success:function(tab){
  //   //     $("#v-pills-tabContent").html(navdetails.tabval);
  //   //   }    
  // });

  $(document).on("click", "#show_job", function(){
    $("#job_application").show('slow');
  });

  $(document).on("click", "#v-pills-tab", function(){
    $("#job_application").hide('slow');
  });
</script>