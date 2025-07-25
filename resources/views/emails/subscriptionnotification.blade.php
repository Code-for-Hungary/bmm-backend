<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Figyusz értesítő</title>
</head>
<body>
<div class="email">
    <div class="padding">
        <h3>Szia!</h3>
        @switch($eventtype)
            @case(1)
                <h3>Ez itt a <a href="https://figyusz.k-monitor.hu">Figyusz!</a> adatbázis figyelő. Az általad megadott kulcsszóra találat érkezett.</h3>
                <div>
                    <div><span class="bmm-label">A találat helye: </span><span class="bmm-data">"{{ $eventgenerator }}"</span></div>
                    <div><span class="bmm-label">Kulcsszó: </span><span class="bmm-data">"{{ $parameter }}"</span></div>
                    @if($extrainfo)
                        <div><span class="bmm-label">{!! $extrainfo !!}</span></div>
                    @endif
                </div>
                <div class="bmm-event-separator">&nbsp;</div>
                <div>
                    {!! $eventcontent !!}
                </div>
                @break
            @case(2)
                <h3>Ez itt a <a href="https://figyusz.k-monitor.hu">Figyusz!</a> adatbázis figyelő. A figyelt adatbázisba új adat érkezett.</h3>
                <div>
                    <span class="bmm-label">A találat helye: </span><span class="bmm-data">"{{ $eventgenerator }}"</span>
                </div>
                <div class="bmm-event-separator">&nbsp;</div>
                <div>
                    {!! $eventcontent !!}
                </div>
                @break
        @endswitch

        <p>Nemrég jelent meg a Figyusz Parlament figyelő, amivel feliratkozhatsz parlamenti irományokra is. <a href="https://figyusz.k-monitor.hu/">Próbáld ki!</a></p>

        <p>Hiba esetén vedd fel velünk a kapcsolatot a <a href="mailto:figyusz@k-monitor.hu?subject=Hiba a Figyusz!-ban">figyusz@k-monitor.hu</a> e-mail címen.
        </p>
        <div>Üdvözlettel,</div>
        <div>K-Monitor</div>
        <p>
            <a href="https://figyusz.k-monitor.hu">Új feliratkozás.</a> - <a href="{!! $unsubscribeurl !!}">Leiratkozás.</a>
        </p>
    </div>
    @include('shared.footer')
</div>
</body>
</html>
