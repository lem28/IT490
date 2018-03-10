<!DOCTYPE html>
<html>
<head>
<<<<<<< HEAD
	<title>Welcome <? = $first_name.' '.$last_name?>
=======
	<title>Search for Games
>>>>>>> ee0d7f83c2281c49f75d61a4410a61d971ebfb3a
	</title>
	<meta charset="UTF-8">
	<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<link href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
	<link href="css/style.css" rel="stylesheet">
	<script src="js/index.js"></script>
	<?php include 'css/css.html';?>
</head>
<body>
	<div class="form">
	<h1>Search PC games</h1>
<<<<<<< HEAD
	<h2><?php echo $first_name.' '.$last_name;?></h2>
	<h2><?=$email?></h2>
=======
>>>>>>> ee0d7f83c2281c49f75d61a4410a61d971ebfb3a
	<div class="wrapper">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<header id="header">
						<div class="slider">
							<div class="carousel slide" data-ride="carousel" id="carousel-example-generic"></div>
							<div class="collapse navbar-collapse" id="mainNav"></div>
						</div>
				<script>
<<<<<<< HEAD
					var apiResult;	
=======
					var apiResult;
>>>>>>> ee0d7f83c2281c49f75d61a4410a61d971ebfb3a
					function showHint(str) {
					var xhr = new XMLHttpRequest();
					xhr.onreadystatechange = function()
						{
							if (this.readyState == 4 && this.status == 200)
							{
								apiResult = this.responseText;
								document.getElementById("result").innerHTML = apiResult;
							}
						};
						xhr.open("GET", "api.php?q=" + str, true);
						xhr.send();
					}
				</script>
				<div>
					<p>Start typing a name in the input field below:</p>
<<<<<<< HEAD
					<input onkeyup="showHint(this.value)" type="text">
					<div id="result"></div>
				</div>
				</header>
				<a href="profile.php"><button class="button button-block" name="HOME">HOME</button></a>
=======
					<input onkeyup="showHint(this.value)" type="text"><br>
					<div id="result"></div>
				</div>
				</header>
				<a href="profile.php"><button class="button button-block" name="BACK">Back to Profile</button></a>
>>>>>>> ee0d7f83c2281c49f75d61a4410a61d971ebfb3a
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
