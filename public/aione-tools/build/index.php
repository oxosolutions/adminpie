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
			$output .= "\r\n";
	
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
		<div class="ar">
			<div class="ac s100 m100 l100 shell-output">
				<pre><?php echo $output; ?></pre>
			</div>
		</div>
		<!-- Dashboard Widgets -->

		<!-- Dashboard Widgets -->
		<div class="ar">
			<!-- Dashboard Widget -->
			<div class="ac s100 m50 l25 pt-15 pb-15">
				<div class="aione-widget aione-border">
					<div class="aione-title">
						<h4 class="aione-align-center font-weight-100 aione-border-bottom pb-15">Find</h4>
					</div>
					<div class="p-15"> 
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
					</div>
				</div>
			</div>
			<!-- Dashboard Widget -->
			<!-- Dashboard Widget -->
			<div class="ac s100 m50 l25 pt-15 pb-15">
				<div class="aione-widget aione-border">
					<div class="aione-title">
						<h4 class="aione-align-center font-weight-100 aione-border-bottom pb-15">Gulp Build</h4>
					</div>
					<div class="p-15"> 
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
					</div>
				</div>
			</div>
			<!-- Dashboard Widget -->
			<!-- Dashboard Widget -->
			<div class="ac s100 m50 l25 pt-15 pb-15">
				<div class="aione-widget aione-border">
					<div class="aione-title">
						<h4 class="aione-align-center font-weight-100 aione-border-bottom pb-15">Find All</h4>
					</div>
					<div class="p-15"> 
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
					</div>
				</div>
			</div>
			<!-- Dashboard Widget -->
		</div>
		<!-- Dashboard Widgets -->
	
	
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