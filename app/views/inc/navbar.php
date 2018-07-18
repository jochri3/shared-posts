<nav class="navbar navbar-inverse">

  <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?= URLROOT; ?>"><span class="glyphicon glyphicon-home" style="width:20px; height:20px;"></span></a>
      </div>
  <div >


  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
     

        <ul class="nav navbar-nav navbar-center">
            
            <li><a href="<?= URLROOT; ?>/pages/about" class="menu">A propos</a>
                
        </ul>

          <ul class="nav navbar-nav navbar-right">
	        <?php if(!isset($_SESSION['user_id'])){ ?>
                <li><a href="<?= URLROOT; ?>/users/login">Connexion</a></li>
                <li><a href="<?=URLROOT; ?>/users/register">S'enregistrer</a></li>
            <?php } ?>
              <?php if(isset($_SESSION['user_id'])){ ?><li><a href="#"><?= $_SESSION['user_name'];?></a></li><li><a href="<?= URLROOT; ?>/users/logout">Deconnexion</a></li><?php } ?>
                
        </ul>

</nav>