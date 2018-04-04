<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Chat realtime</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>Chat realtime</h2>
        <div class="panel panel-primary">
            <div class="panel-heading">Simple chat with Son</div>
            <div class="panel-body">
                <div id="data"></div>
                <div>
                    <div style="padding: 0 0 10px 0;">
                        <div>Name: </div>
                        <input id="name" type="text" name="name" value="Son">
                    </div>
                    <div>
                        <div>Content: </div>
                        <input id="content" name="content" rows="5" style="width:85%"></input>
                        <button id="btnSubmit" type="submit" name="send" style="width:14%">Send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
    <script>
        getMessage();

        // $('#content').on('keyup', function(e) {
        //     if ($('#content').val() !== '') {
        //         $.ajax({
        //             type: 'POST',
        //             url: '/typing',
        //             data: {
        //                 '_token': '{{ csrf_token() }}'
        //             },
        //         }).done(function (data) {
        //             // $('#data').html(data);
        //             console.log('typing event send');
        //         }).fail(function (error) {
        //         });
        //     }
        // });

        $('#btnSubmit').on('click', function(e) {
            var name = $('#name').val();
            var content = $('#content').val();

            $.ajax({
                type: 'POST',
                url: '/send-message',
                data: {
                    '_token': '{{ csrf_token() }}',
                    name: name,
                    content: content
                },
            }).done(function (data) {
                $('#data').html(data);
            }).fail(function (error) {
            });
        });

        $('#content').on('keydown', function(e) {
            var code = e.keyCode || e.which;
            if(code == 13) {
                $('#btnSubmit').click();
                $('#content').val("");
                return false;
            }
        });

        var link = window.location.hostname + ':6001';
        var socket = io(link);

        socket.on('chat:message', function(data) {
        // socket.on('test-channel:App\\Events\\RedisEvent', function(data) {
            getMessage();
        });

        socket.on('chat:typing', function(data) {
        // socket.on('test-channel:App\\Events\\RedisEvent', function(data) {
            // getMessage();
            console.log('typing....................');
        });

        function getMessage() {
            $.ajax({
                type: 'POST',
                url: '/getMessage',
                data: {
                    _token: '{{ csrf_token() }}',
                },
            }).done(function (data) {
                $('#data').html(data);
            }).fail(function (error) {
            });
        }
    </script>
</body>
</html>
