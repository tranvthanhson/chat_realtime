<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Chat realtime</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<div id="data">
		@foreach ($messages as $message)
		<p><strong> {{$message->name}} </strong>: {{$message->content}} </p>
		@endforeach
	</div>
	<div>
		<form action="send-message" method="POST">
			{{csrf_field()}}
			Name: <input type="text" name="name" value="Son">
			<br>
			Content: <textarea name="content" rows="5" style="width:100%"></textarea>
			<button type="submit" name="send">Send</button>
		</form>
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
		<script>
			var socket = io('http://localhost:6001');

			socket.on('chat:message', function(data) {
				console.log(data);
				$('#data').append('<p><strong> '+data.name+'</strong>: '+data.content+'</p>');
			});
		</script>
	</div>
</body>
</html>