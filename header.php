<div class="navbar navbar-inverse">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="<?php echo $ROOT_URL . 'index.php'; ?>"><?php echo $APP_NAME; ?></a>
  </div>
  <div class="navbar-collapse collapse navbar-inverse-collapse">
    <ul class="nav navbar-nav">
      <!--li><a href="#">Active</a></li>
      <li><a href="#">Link</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#">Action</a></li>
          <li><a href="#">Another action</a></li>
          <li><a href="#">Something else here</a></li>
          <li class="divider"></li>
          <li class="dropdown-header">Dropdown header</li>
          <li><a href="#">Separated link</a></li>
          <li><a href="#">One more separated link</a></li>
        </ul>
      </li-->
    </ul>
    <form class="navbar-form navbar-left">
      <!--input type="text" class="form-control col-lg-8" placeholder="Search"-->
    </form>
    <ul class="nav navbar-nav navbar-right">
      <?php
      if($_SESSION['is_logged'] == 0) {
      ?>
      <li><a href="<?php echo $ROOT_URL . 'login.php'; ?>">LogIn</a></li>
      <li><a href="<?php echo $ROOT_URL . 'signup.php'; ?>">SignUp</a></li>
      <?php
      }
      else if($_SESSION['is_logged'] == 1) {
      ?>
      <li><a href="#">Welcome <?php echo $_SESSION['first_name']; ?></a></li>
      <li><a href="<?php echo $ROOT_URL . 'logout.php'; ?>">LogOut</a></li>
      <?php
      }
      ?>
      <!--li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#">Action</a></li>
          <li><a href="#">Another action</a></li>
          <li><a href="#">Something else here</a></li>
          <li class="divider"></li>
          <li><a href="#">Separated link</a></li>
        </ul>
      </li-->
    </ul>
  </div>
</div>