<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Lecturer List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Lecturers</li>
        <li class="active">Lecturers List</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  
                  <th>Photo</th>
                  <th>Lecturer ID</th>
                  <th>Firstname</th>
                  <th>Lastname</th>
                  <th>Department</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Field</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT *, lecturer.id AS lecid FROM lecturer LEFT JOIN specialization ON specialization.id=lecturer.lecturer_id";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      $photo = (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/profile.jpg';
                      echo "
                        <tr>
                          
                          <td>
                            <img src='".$photo."' width='30px' height='30px'>
                            <a href='#edit_photo' data-toggle='modal' class='pull-right photo' data-id='".$row['lecid']."'><span class='fa fa-edit'></span></a>
                          </td>
                          <td>".$row['lecturer_id']."</td>
                          <td>".$row['firstname']."</td>
                          <td>".$row['lastname']."</td>
                          <td>".$row['department']."</td>
                          <td>".$row['email']."</td>
                          <td>".$row['phone_number']."</td>
                          <td>".$row['specialization']."</td>
                          <td>
                            <button class='btn btn-success btn-sm edit btn-flat' data-id='".$row['lecid']."'><i class='fa fa-edit'></i></button>
                            <button class='btn btn-danger btn-sm delete btn-flat' data-id='".$row['lecid']."'><i class='fa fa-trash'></i></button>
                          </td>
                        </tr>
                      ";
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/lecturer_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.photo', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'lecturer_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.lecid').val(response.lecid);
      $('#edit_firstname').val(response.firstname);
      $('#edit_lastname').val(response.lastname);
      $('#selcourse').val(response.program_id);
      $('#selcourse').html(response.code);
      $('.del_stu').html(response.firstname+' '+response.lastname);
    }
  });
}
</script>
</body>
</html>
