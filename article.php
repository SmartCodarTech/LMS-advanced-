<?php include 'includes/session.php'; ?>
<?php
	$where = '';
	if(isset($_GET['category'])){
		$catid = $_GET['category'];
		$where = 'WHERE category_id = '.$catid;
	}
	$where = '';
	if(isset($_GET['students'])){
		$stuid = $_GET['student'];
		$where = 'WHERE student_id = '.$stuid;
	}
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-10 col-sm-offset-0">
	        		<?php
	        			if(isset($_SESSION['error'])){
	        				echo "
	        					<div class='alert alert-danger'>
	        						".$_SESSION['error']."
	        					</div>
	        				";
	        				unset($_SESSION['error']);
	        			}
	        		?>
	        		<div class="box">
	        			<div class="box-header with-border">
                         <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
	        			<!--div class="box-header with-border">
	        				<div class="input-group">
				                <input type="text" class="form-control input-lg" id="searchBox" placeholder="Search for ISBN, Title or Author">
				                <span class="input-group-btn">
				                    <button type="button" class="btn btn-primary btn-flat btn-lg"><i class="fa fa-search"></i> </button>
				                </span>
				            </div>
	        			</div-->
	        			<div class="box-body">
	        				
	        				<table class="table table-bordered table-striped" id="booklist">
			        			<thead>

			        				<th>File</th>
			        				<th>Title</th>
			        				<th>Category</th>
			        				<th>Author</th>
			        				<th>Publisher</th>
			        				<th>Date</th>
			        				<th>Tools</th>
			        			</thead>
			        			<tbody>
			        			<?php
			        				 $sql = "SELECT *, article.id AS articleid FROM article LEFT JOIN category ON category.id=article.category_id $where";
			        				$query = $conn->query($sql);
			        				while($row = $query->fetch_assoc()){
			        					//$status = ($row['status'] == 0) ? '<span class="label label-success">available</span>' : '<span class="label label-danger">not available</span>';

			        					$file = (!empty($row['upload_file'])) ? 'file/'.$row['upload_file'] : 'file/profile.jpeg';
                                         echo "
                                         <tr>
                                         <td>
                                         <img src='".$file."' width='40px' height='60px'>
                                        
                                        </td>
			        					

			        							
			        							<td>".$row['title']."</td>
			        							<td>".$row['name']."</td>
			        							<td>".$row['author']."</td>
			        							<td>".$row['publisher']."</td>
			        							<td>".$row['publish_date']."</td>
			        							<td>
                            <button class='btn btn-success btn-sm edit btn-flat' data-id='".$row['articleid']."'><i class='fa fa-edit'></i> </button>
                            <button class='btn btn-danger btn-sm delete btn-flat' data-id='".$row['articleid']."'><i class='fa fa-trash'></i> </button>
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
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
  	<?php include 'includes/article_modal.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
	$('#catlist').on('change', function(){
		if($(this).val() == 0){
			window.location = 'index.php';
		}
		else{
			window.location = 'index.php?category='+$(this).val();
		}
		
  $('#select_category').change(function(){
    var value = $(this).val();
    if(value == 0){
      window.location = 'article.php';
    }
    else{
      window.location = 'article.php?category='+value;
    }
  });

  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.edit', function(e){
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
    url: 'article_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.articleid').val(response.articleid);
      $('#edit_title').val(response.title);
      $('#catselect').val(response.category_id).html(response.name);
      $('#edit_author').val(response.author);
      $('#edit_publisher').val(response.publisher);
      $('#datepicker_edit').val(response.publish_date);
      $('#del_article').html(response.title);
    }
  });
</script>
</body>
</html>