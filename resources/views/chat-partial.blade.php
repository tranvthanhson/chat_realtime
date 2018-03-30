@php
$result = '';

foreach($messages as $message) {
    $result = "<p><strong> $message->name </strong>: $message->content </p>" . $result;
}

echo $result;
@endphp
