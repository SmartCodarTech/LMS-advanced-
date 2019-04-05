<?php include 'includes/session.php'; ?>
<?php
	$where = '';
	if(isset($_GET['category'])){
		$catid = $_GET['category'];
		$where = 'WHERE category_id = '.$catid;
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
	        	<div class="col-sm-8 col-sm-offset-2">
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

			        				<th>Images</th>
			        				<th>ISBN</th>
			        				<th>Title</th>
			        				<th>Author</th>
			        				<th>Status</th>
			        			</thead>
			        			<tbody>
			        			<?php
			        				 $sql = "SELECT *, books.id AS bookid FROM books LEFT JOIN category ON category.id=books.category_id $where";
			        				$query = $conn->query($sql);
			        				while($row = $query->fetch_assoc()){
			        					$status = ($row['status'] == 0) ? '<span class="label label-success">available</span>' : '<span class="label label-danger">not available</span>';

			        					$photo = (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/profile.jpeg';
                                         echo "
                                         <tr>
                                         <td>
                                         <img src='".$photo."' width='30px' height='30px'>
                                        
                                        </td>
			        					

			        							
			        							<td>".$row['isbn']."</td>
			        							<td>".$row['title']."</td>
			        							<td>".$row['author']."</td>
			        							<td>".$status."</td>
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
		
	});
});
</script>
</body>
</html>