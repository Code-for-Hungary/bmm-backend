<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('shared.style')
</head>
<body
    style="
        color: #46009e;
        background-color: #F9F6F6;
        font-family: 'Faune', Arial, sans-serif;
        font-size: 20px;
        line-height: 1.3;
    ">
@include('shared.header')
<h3 style="
    font-size: 1.4rem;
    font-weight: 700;
">Szia!</h3>
<h3 style="
    font-size: 1.4rem;
    font-weight: 700;
">Ez itt a Figyusz! adatbázis figyelő.</h3>
<p>Kérjük, <a href="{{ $confirmurl }}">ide kattintva erősítsd meg</a> a feliratkozásodat
    @switch($eventtype)
        @case(1)
            a "{{ $parameter }}" kulcsszóra a "{{ $eventgenerator }}" adatbázisból.
            @break
        @case(2)
            a "{{ $eventgenerator }}" adatbázis frissülésére.
    @endswitch
</p>
<p>Hiba esetén vedd fel velünk a kapcsolatot a <a href="mailto:figyusz@k-monitor.hu">figyusz@k-monitor.hu</a> e-mail címen.</p>
<div>Üdvözlettel,</div>
<div>K-Monitor</div>
@include('shared.footer')
</body>
</html>
