<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<h2>Esemény történt a Bulletin Monitoron!</h2>
<p>Az esemény kiváltója: "{{ $eventgenerator }}"</p>
<p>Ezt figyeltük: "{{ $parameter }}"</p>
<p>Az esemény tartalma: {!! $eventcontent !!}</p>
</body>
</html>
