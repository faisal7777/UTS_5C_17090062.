<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Login</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
  </head>
  <body style="background-image: url(gundam.jpg);">
    <div class="col-md-4 col-md-offset-4 form-login body">
    
    <?php
    /* handle error */
    if (isset($_GET['error'])) : ?>
        <div class="alert alert-warning alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <strong>Warning!</strong> <?=base64_decode($_GET['error']);?>
        </div>
    <?php endif;?>

        <div>
          <form action="check-login.php" class="inner-login" method="post">
            
			<img style="margin-left:20px; border-radius:50px" src="assets/img/kgear.png" width="300px" alt="">
                	<br/>
                	<br/>
				<div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Masukkan Username">
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Masukkan Password">
                </div>
                <br>
                <input type="submit" class="btn btn-block btn-custom-green" value="LOGIN" />
                
                <br>
            </form>
        </div>
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>