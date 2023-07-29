<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('shared.style')
</head>
<body>
@include('shared.header')
<h3>Szia!</h3>
@switch($eventtype)
    @case(1)
        <h3>Ez itt a Figyusz! adatbázis figyelő. Az általad megadott kulcszóra találat érkezett.</h3>
        <div>
            <span class="bmm-label">A találat helye: </span><span class="bmm-data">"{{ $eventgenerator }}"</span>
            <span class="bmm-label">Kulcsszó: </span><span class="bmm-data">"{{ $parameter }}"</span>
        </div>
        <div>
            <span class="bmm-label">A találat tartalma: </span>{!! $eventcontent !!}
        </div>
        @break
    @case(2)
        <h3>Ez itt a Figyusz! adatbázis figyelő. A figyelt adatbázisba új adat érkezett.</h3>
        <div>
            <span class="bmm-label">A találat helye: </span><span class="bmm-data">"{{ $eventgenerator }}"</span>
        </div>
        <div>
            <span class="bmm-label">A találat tartalma: </span>{!! $eventcontent !!}
        </div>
        @break
@endswitch
<p>Hiba esetén vedd fel velünk a kapcsolatot a <a href="mailto:figyusz@k-monitor.hu">figyusz@k-monitor.hu</a> e-mail címen.</p>
<div>Üdvözlettel,</div>
<div>K-Monitor</div>
<p>
    <a href="{{ $unsubscribeurl }}">Leiratkozáshoz klikkelj ide.</a>
</p>
@include('shared.footer')
</body>
</html>
