@foreach ($messages as $message)
<p><strong> {{$message->name}} </strong>: {{$message->content}} </p>
@endforeach
