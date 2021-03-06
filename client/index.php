<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
	<!-- Latest compiled and minified CSS & JS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<script src="//code.jquery.com/jquery.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<script src="socket.io.js"></script>
</head>
<body>
	<div class="container-fluid">
		<div class="row" style="margin-top: 50px;">
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				
			</div>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				<div id="chat" ></div>
				<form id="messageForm" class="form-inline" role="form">
					<legend>Form Chat</legend>
					<div class="form-group" style="margin-bottom:5px;">
						<label class="sr-only" for="">Name</label>
						<input type="text" class="form-control" id="name" placeholder="name">
					</div>
					<div class="form-group" style="margin-bottom:5px;">
						<label class="sr-only" for="">Message</label>
						<input type="text" class="form-control" id="message" placeholder="Input message">
					</div>
					<button type="submit" class="btn btn-primary">Sen Message</button>
				</form>
			</div>
		</div>
	</div>
<script>
  $(function() {
  	var socket = io.connect('http://localhost:3000');
  	$("#messageForm").submit(function( event ) {
	  	event.preventDefault();
	  	socket.emit('send-data-server',{name:$('#name').val(),mes:$('#message').val()});
	});
  	socket.on('server-send-client',function(data){
  		$("#chat").append('<div class="well-sm" style="background-color:lightgrey; border-left: 6px solid red;margin-bottom:5px;">'+data.name+ ': '+data.mes+'</div>');
  	});
  });
</script>
</body>
</html>