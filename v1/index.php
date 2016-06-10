<!DOCTYPE html>
<html lang="en">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="description" content="">
 <meta name="keywords" content="">
 <meta name="author" content="">
 <title>Lime light 0.1</title>
<!--  <script src="https://use.fontawesome.com/d0029c4b59.js"></script>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
 <link rel="stylesheet" href="css/bootstrap.min.css">
 <link rel="stylesheet" href="css/font-awesome.min.css">
 <link rel="stylesheet" href="css/selectric.css">
 <link rel="stylesheet" href="css/style.css">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
<!-- Header -->
<header class="text-center">
<div class="container-fluid logo-container">
	<div class="row">
	 <div class="logo">
	  <a href="index.php"><img src="img/logo.png" alt="Lime Light" title="Lime Light" class="img-responsive" /></a>
	 </div>
	</div>
</div><!-- container-fluid logo-container -->
<div class="container banner-container">
	<div class="row">
  	 <div class="banner">
  	  <img src="img/banner.png" alt="star style combos" title="" class="img-responsive"  />
  	 </div>
  	</div>
</div><!-- container . banner-container -->
</header>
 <!-- Header -->

<!-- registration -->
<div class="container-fluid form-container">
<div class="row">
 <div class="view">

  <form class="form-inline" role="form" method="post" action="sms.php">
				  <div class="group">
					<div class="form-group spname">
						<label for="name">Name</label>
						<input type="text" class="form-control" id="name" name="name" value="">
					</div>
          </div>
					<div class="form-group spemail">
						<label for="email">Email</label>
							<input type="email" class="form-control" id="email" name="email" value="">
					</div>
					<div class="form-group spnumber">
						<label for="number">Phone Number</label>
						<input type="tel" class="form-control" id="number" name="number" value="">
					</div>
					<div class="group tc">
  			<div class="checkbox">
    			<label>
      				<input type="checkbox" id="termsConditions" name="termsConditions"> I agree to the <a data-toggle="modal" data-target="#tc">terms and conditions</a>
    			</label>
  			</div>
  		</div>
  		<div class="group btc">
  			<!-- Modal -->
			<div class="modal fade" id="tc" tabindex="-1" role="dialog" aria-labelledby="tclabel">
  				<div class="modal-dialog" role="document">
    				<div class="modal-content">
      					<div class="modal-header">
        					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        					<h4 class="modal-title" id="tclabel">Terms and Condition</h4>
      					</div>
      					<div class="modal-body">
      					<ul>
        				<li>This offer cannot be clubbed with any other offer / promotion at the salon.</li>
        				<li>This can be redeemed only upon presenting the confirmation Sms / Mail the before availing the services at the salon.</li>
        				<li>This offer can be redeemed against services only.</li>
        				<li>This offer is valid only on prior appointment.</li>
        				<li>Limelite holds the right to make changes or withdraw the promotion as and when required.</li>
        				<li>Service tax applicable.</li>
       					</ul>
      					</div>
    				</div>
  				</div>
			</div>
		</div>
		<div class="errordiv">
		</div>
		<div class="group getbutton">
  			<button type="submit" class="btn btn-default">Get Notified</button>
  		</div>
				</form> 
</div>
</div>
</div> 
<!-- footer -->
<footer class="container-fluid">
	<div class="row">
		<a href="http://www.limelitesalonandspa.com" target="_blank"> www.limelitesalonandspa.com </a> |
		<a href="https://www.facebook.com/LimeliteSalonandSpa" target="_blank"> <i class="fa fa-facebook-official" aria-hidden="true"></i> </a>
	</div>
</footer>

<!--
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.8/jquery.validate.js"></script>
-->
<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>