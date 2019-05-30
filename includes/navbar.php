<header class="main-header">
  <nav class="navbar navbar-static-top">
    <div class="container">
      <div class="navbar-header">
        <a href="#" class="navbar-brand"><b>Library</b> System</a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
          <i class="fa fa-bars"></i>
        </button>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
        <ul class="nav navbar-nav">
          <?php
            if(isset($_SESSION['student'])){
              echo "
                <li><a href='index.php'>Home</a></li>
                <li><a href='article.php'>Add Article</a></li>
                <li><a href='review.php'>Review Articles</a></li>


                <li><a href='transaction.php'>Transaction</a></li>
              ";
            } 
          ?>
        </ul>
      </div>
      <!-- /.navbar-collapse -->
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <?php
            if(isset($_SESSION['student'])){
              $image = (!empty($student['photo'])) ? './upload/'.$student['photo'] : './upload/profile.jpg';
              echo "
                <li class='user user-menu'>
                  <a href='#'>
                    <img src='".$image."' class='user-image' alt='User Image'>
                    <span class='hidden-xs'>".$student['firstname'].' '.$student['lastname']."</span>
                  </a>
                </li>
                <li class='user user-menu'>
                  <a href='#'>
                    
                    <span class='hidden-xs'>".$student['role']."</span>
                  </a>
                </li>
                <li><a href='logout.php'><i class='fa fa-sign-out'></i> LOGOUT</a></li>
              ";
            }
            else{
              echo "
              <li><a href='./article_display.php' data-toggle='modal'><i class='fa fa-book'></i> Articles</a></li>
                <li><a href='#login' data-toggle='modal'><i class='fa fa-sign-in'></i> LOGIN</a></li>
                <li><a href='admin/index.php' data-toggle='modal'><i class='fa fa-key'></i> ADMIN LOGIN</a></li>
              ";
            } 
          ?>
        </ul>
      </div>
      <!-- /.navbar-custom-menu -->
    </div>
    <!-- /.container-fluid -->
  </nav>
</header>
<?php include 'includes/login_modal.php'; ?>