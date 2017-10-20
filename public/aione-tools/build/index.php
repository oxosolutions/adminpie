<!DOCTYPE html>
  <html>
    <head>
		<title>Aione Build Tools</title> 
      <!--Import Google Icon Font-->
      <!--
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	  -->
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="../../assets/css/aione.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	  <style>
	  body{
		  background-color:#f2f2f2;
	  }
	  .form{
		  text-align:center;
		 
	  }
	  .display-inline{
		  display:inline;
	  }
	  .shell-output{
		  color:#FFFFFF;
		  background-color:#333333;
		  margin:0 0 10px 0;
	  }
	 
	.shell-output pre {
		padding: 0 10px;
		margin: 20px 10px 20px 10px;
		font-size: 12px;
		line-height: 16px; 
		word-break: break-all;
		word-wrap: break-word;
		color: #FFFFFF;
		background-color: transparent;
		background: linear-gradient( to bottom, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0) 50%, rgba(255, 255, 255, 0.05) 50%, rgba(255, 255, 255, 0.05) );
		background-size: 100% 32px;
		border: none;
		border-radius: 0px;
	}
	.button-link{
		background: none;
		border: none;
		font-size: 16px;
		line-height: 20px;
		font-weight: 400;
		padding: 0;
		margin: 0 10px 0 0;
		display: inline;
		color: #03A9F4;
		text-shadow: none;	
	}
	.button-link:hover,
	.button-link:active,
	.button-link:focus{
		background: none;
		border: none;
		color: #03A9F4;	
	}
	.color-red{
		color:#F44336;
	}
	.text{
		font-size: 16px;
		line-height: 20px;
		font-weight: 400;
		margin: 0 10px 0 0;
		color: #333333;
		text-shadow: none;	
	}
	  </style>
    </head>

    <body>
	
	<?php
		$output = "";
		if(isset($_POST['action'])){
			$action = $_POST['action'];
		} else {
			$action = 'null';
		}
		
		if($action != 'null'){
			$output .= "\r\nInitializing ".$action;
	
			if($action == 'gulp'){
				$command = $_POST['command'];
				$output .= "\r\nExecuting ".$action." ".$command;
				$output .= "\r\nCurrent user ";
				$output .= shell_exec('whoami');

				$output .= shell_exec('
					'.$action.' '.$command.' 2>&1;
				');
				
				$output .= "Command executed successfully";
				
			} elseif($action == 'find'){
				$search = $_POST['search'];
				if(isset($_POST['directories'])){
					$directories = $_POST['directories'];
				}
				
				if(empty($search)){
					$output .= "\r\n Search field empty";
				} else {
					if(isset($directories)){
						foreach ($directories as $key => $directory) {
							$command = "grep -rnw '".$directory."' -e '".$search."'";
							//$output .= "\r\n";
							//$output .= "\r\n Command =".$command;
							$output .= shell_exec($command);
						}
					} else {
						$output .= "\r\n No directory selected";
					}
					
				}
				$output .= "\r\nCommand executed successfully";
				
			}elseif($action == 'findall'){
				$search = $_POST['search'];
				if(isset($_POST['directories'])){
					$directories = $_POST['directories'];
				}
				
				if(empty($search)){
					$output .= "\r\n Search field empty";
				} else {
					if(isset($directories)){
						foreach ($directories as $key => $directory) {
							$command = "grep -rnw '".$directory."' -e '".$search."'";
							//$output .= "\r\n";
							//$output .= "\r\n Command =".$command;
							$output .= shell_exec($command);
						}
					} else {
						$output .= "\r\n No directory selected";
					}
					
				}
				$output .= "\r\nCommand executed successfully";
				
			} else {
				$output .= "\r\nNothing to do!";
			}
		}
	?>

		<!-- Dashboard Widgets -->
		<div class="row">
		
				
				<div class="col s12 shell-output">
					<pre><?php echo $output; ?></pre>
				</div>
			

			<!-- Dashboard Widget -->
			<div class="col s12 m6 l3">
				<div class="card hoverable">	
					<div class="card-content">
						<span class="card-title activator center-align">Find</span>
						<div class="divider"></div>
						<p class="p-10 center-align">
							<form class="form" action=""  method="post">
								<div class="field">
								<input type="text" placeholder="e.g. Default Dashboard" name="search" />
								</div>
								<div class="field-wrapper ac field-wrapper-type-checkbox horizontal">
									<div class="field field-type-checkbox">
										<div class="field-option">
											<input id="option_testsec1f150" class="" name="directories[]" type="checkbox" checked="checked" value="/home/oxo/public_html/scolm/app/Http">
									    	<label for="option_testsec1f150" class="field-option-label">HTTP</label>    
										</div>
										<div class="field-option">
											<input id="option_views" class="" name="directories[]" type="checkbox" checked="checked" value="/home/oxo/public_html/scolm/resources">
									    	<label for="option_views" class="field-option-label">Views</label>    
										</div>
										<div class="field-option">
											<input id="option_routes" class="" name="directories[]" type="checkbox" checked="checked" value="/home/oxo/public_html/scolm/routes">
									    	<label for="option_routes" class="field-option-label">Routes</label>    
										</div>
									</div>
								</div>
								<br>
								<input type="hidden" name="action" value="find">
								<button class="btn waves-effect waves-light" type="submit">Find</button>
							</form>
						</p>
					</div>
				</div> 
			</div>
			<!-- Dashboard Widget -->
			
			<!-- Dashboard Widget -->
			<div class="col s12 m6 l3">
				<div class="card hoverable">	
					<div class="card-content">
						<span class="card-title activator center-align">Gulp Build</span>
						<div class="divider"></div>
						<p class="p-10 center-align">
							<form class="form" action=""  method="post">
								<select name="command" style="display:block">
									<option value="" disabled selected>Select Command</option>
									<option value="test-scss">Test SCSS</option>
									<option value="makecss">BUILD CSS</option>
									<option value="makejs">BUILD JS</option>
									<!--
									<option value="automakecss">BUILD CSS Automatically On change SCSS Files</option>
									-->
									<option value="">Default</option>
								</select>
								<br>
								<input type="hidden" name="action" value="gulp">
								<button class="btn waves-effect waves-light" type="submit">Execute Commmand</button>
							</form>
						</p>
					</div>
				</div> 
			</div>
			<!-- Dashboard Widget --> 

			<!-- Dashboard Widget -->
			<div class="col s12 m6 l3">
				<div class="card hoverable">	
					<div class="card-content">
						<span class="card-title activator center-align">Find All</span>
						<div class="divider"></div>
						<p class="p-10 center-align">
							<form class="form" action=""  method="post">
								<div class="field">
								<input type="text" placeholder="e.g. Default Dashboard" name="search" />
								</div>
								<div class="field">
								<input type="text" placeholder="/home/oxo/public_html/scolm/app/Http" name="directories[]" value="/home/oxo/public_html/aione/wp-content/themes/aione"/>
								</div>
								
								<br>
								<input type="hidden" name="action" value="findall">
								<button class="btn waves-effect waves-light" type="submit">Find All</button>
							</form>
						</p>
					</div>
				</div> 
			</div>
			<!-- Dashboard Widget -->
			
			
	
	
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