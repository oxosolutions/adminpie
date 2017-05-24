<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Materializaed CSS</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/css/materialize.min.css">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/js/materialize.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.modal').modal();
		});
	</script>
</head>
<body>
	  <!-- Modal Trigger -->
  <a class="waves-effect waves-light btn" href="#modal1">Modal</a>

  <!-- Modal Structure -->
  <div id="modal1" class="modal">
    <div class="modal-content">
      <h4>Modal Header</h4>
      <p>A bunch of text</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
  </div>
</body>
</html>