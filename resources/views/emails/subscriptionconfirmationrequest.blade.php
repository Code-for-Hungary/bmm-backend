<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<h3>Szia!</h3>
<p>Ez itt a Figyusz! adatbázis figyelő. Kérjük, <a href="{{ $confirmurl }}">ide kattintva erősítsd meg</a> a feliratkozásodat
    @switch($eventtype)
        @case(1)
            a "{{ $parameter }}" kulcsszóra a "{{ $eventgenerator }}" adatbázisból.
            @break
        @case(2)
            a "{{ $eventgenerator }}" adatbázis frissülésére.
    @endswitch
</p>
<p>Hiba esetén vedd fel velünk a kapcsolatot a <a href="mailto:figyusz@k-monitor.hu">figyusz@k-monitor.hu</a> e-mail címen.</p>
<p>
<div>Üdvözlettel,</div>
<div>K-Monitor</div>
</p>
</body>
</html>
