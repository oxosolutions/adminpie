<!DOCTYPE html>
  <html>
    <head>
		<title>Aione Build Tools</title> 
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

      <link type="text/css" rel="stylesheet" href="../assets/css/aione.css"  media="screen,projection"/>
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>
		<!-- Dashboard Widgets -->
		<div class="ar">
			<!-- Dashboard Widget -->
			<div class="ac s100 m50 l25 pt-15 pb-15">
				<div class="aione-widget aione-border">
					<div class="aione-title">
						<h4 class="aione-align-center font-weight-100 aione-border-bottom pb-15">Build Tools</h4>
					</div>
					<div class="p-15"> 
						<a class="aione-button blue white-text" href="build">Aione Build Tools</a>
					</div>
				</div>
			</div>
			<!-- Dashboard Widget -->
			<!-- Dashboard Widget -->
			<div class="ac s100 m50 l25 pt-15 pb-15">
				<div class="aione-widget aione-border">
					<div class="aione-title">
						<h4 class="aione-align-center font-weight-100 aione-border-bottom pb-15">Dashboard</h4>
					</div>
					<div class="p-15"> 
						<h5 class="aione-align-center m-0">PhpMyAdmin</h5>
						<form class="form display-inline" action="http://192.168.0.101:2030/pma/index.php" target="_blank" method="post">
							<input type="hidden" name="pma_username" value="oxo">
							<input type="hidden" name="pma_password" value="bEPHkJAe">
							<input type="hidden" name="server"  value="1">
							<input type="submit" class="aione-button " name="action" value="Login">
						</form>
						<a class="aione-button red white-text" href="http://192.168.0.101:2030/pma/index.php?old_usr=logout" target="_blank">Logout</a>
					</div>
				</div>
			</div>
			<!-- Dashboard Widget -->
			<!-- Dashboard Widget --> 
			<div class="ac s100 m50 l25 pt-15 pb-15">
				<div class="aione-widget aione-border">
					<div class="aione-title">
						<h4 class="aione-align-center font-weight-100 aione-border-bottom pb-15">AdminPie(SCOLM)</h4>
					</div>
					<div class="p-15"> 
						<div class="col s6 m6 l6" style="border-right: 1px solid #ededed">
							<a href="http://admin.scolm.com" target="_blank"><span>Super Admin</span></a><br>			
							<span class="click" style="cursor: pointer;">admin@oxosolutions.com</span><br>
							<span class="click" style="cursor: pointer;">admin#874123</span>
						</div>
						<span>Docs</span><br>
						<a href="https://docs.google.com/spreadsheets/d/1T5KjGZAj9cf4nEwiTVHU9IsfA-z-SpLL1qoeSUP97Cs/edit?usp=drive_web" target="_blank">Project Status</a>
						<br>
						<a href="https://docs.google.com/document/d/1wtnjX6uFvDiJsAQB5hmNnfrgZ3vozaqXbLc7Byz8E8w/edit?usp=drive_web" target="_blank">SRS Document</a> 
					</div>
				</div>
			</div>
			<!-- Dashboard Widget --> 
			<div class="ac s100 m50 l25 pt-15 pb-15">
				<div class="aione-widget aione-border">
					<div class="aione-title">
						<h4 class="aione-align-center font-weight-100 aione-border-bottom pb-15">Aione Tools</h4>
					</div>
					<div class="p-15"> 
						<span>Colors</span>
						<a href="colors.php" target="_blank">Colors</a>
					</div>
				</div>
			</div>


		</div>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="../../assets/js/aione.min.js"></script>

	  <!--
	  <script src="jquery.copy-to-clipboard.js"></script>
	  <script>
    		$('.click').click(function(){
	  			$(this).CopyToClipboard();
			});
	  </script>
	  -->
    </body>
  </html>