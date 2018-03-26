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
        {{-- @foreach ($messages as $message)
        <p><strong> {{$message->name}} </strong>: {{$message->content}} </p>
        @endforeach --}}
    </div>
    <div>
        {{-- <form action="send-message" method="POST"> --}}
            {{csrf_field()}}
            Name: <input id="name" type="text" name="name" value="Son">
            <br>
            Content: <textarea id="content" name="content" rows="5" style="width:100%"></textarea>
            <button id="btnSubmit" type="submit" name="send">Send</button>
        {{-- </form> --}}
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
        <script>
            $('#btnSubmit').on('click', function(e) {
                var name = $('#name').val();
                var content = $('#content').val();

                $.ajax({
                    type: 'POST',
                    url: 'send-message',
                    data: {
                        '_token': '{{ csrf_field() }}',
                        name: name,
                        content: content
                    },
                }).done(function (data) {
                    $('#data').html('<p><strong> '+data.name+'</strong>: '+data.content+'</p>');
                }).fail(function (error) {
                });
            });
            var link = window.location.hostname + ':6001';
            var socket = io(link);

            socket.on('chat:message', function(data) {
                // console.log(data);
                $('#data').append('<p><strong> '+data.name+'</strong>: '+data.content+'</p>');
            });
        </script>
    </div>
</body>
</html>
