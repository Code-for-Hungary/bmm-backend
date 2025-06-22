<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="email">
    <div class="padding">
        <h3>Szia!</h3>
        <p>Az alábbi lista tartalmazza az aktív feliratkozásaidat a <strong>{{ $email }}</strong> email címhez.</p>

        @if($subscriptions->count() > 0)
            <h2>Aktív feliratkozásaid:</h2>
            
            @foreach($subscriptions as $subscription)
                <div class="subscription">
                    <div class="subscription-title">
                        {{ $subscription->event->eventgenerator->name }}
                    </div>
                    
                    @if($subscription->event->type == 1 && $subscription->event->parameters)
                        <p>Kulcsszó: <span class="parameter">{{ $subscription->event->parameters }}</span></p>
                    @endif

                    @if($subscription->event->selected_options && $subscription->event->eventgenerator->options_schema)
                        @foreach($subscription->event->eventgenerator->options_schema as $schema)
                            @if(isset($subscription->event->selected_options->{$schema['id']}))
                                <p><strong>{{ $schema['title'] }}:</strong>
                                    @foreach($subscription->event->selected_options->{$schema['id']} as $option)
                                        {{ $option }}@if(!$loop->last), @endif
                                    @endforeach
                                </p>
                            @endif
                        @endforeach
                    @endif

                    <p>
                        <a href="{{ config('bmm.unsubscribe_url') }}?s={{ $subscription->id }}" class="unsubscribe-link">
                            Leiratkozás erről a feliratkozásról
                        </a>
                    </p>
                </div>
                <hr>
            @endforeach
        @else
            <div class="subscription">
                <p>Jelenleg nincsenek aktív feliratkozásaid.</p>
            </div>
        @endif

        <p>Hiba esetén vedd fel velünk a kapcsolatot a <a href="mailto:figyusz@k-monitor.hu">figyusz@k-monitor.hu</a> e-mail címen.</p>
        <div>Üdvözlettel,</div>
        <div>K-Monitor</div>
    </div>
    @include('shared.footer')
</div>
</body>
</html>