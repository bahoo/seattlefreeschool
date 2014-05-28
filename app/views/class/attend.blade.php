@extends('layouts.master')

@section('content')
   <h3>Showing @if($is_events_filtered)<b>{{ $filtered_topic }}</b>@else all @endif events in the next 90 days:
         @if($is_events_filtered)<small><a href="{{ route('classes.index') }}">Show all events instead</a></small>@endif
      </h3>

   <div class="list-group">
      @if($events)
         @foreach($events as $event)
            <a href="{{ $event->permalink() }}" class="list-group-item media">
               <div class="pull-left">
                  <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAACsUlEQVR4Xu2Y24upYRTGl0PI0JSimHDjMIVETVMzpvzrziLSTIkiLpTcjJLzcfaziuz2Njufsb8La93o+3jX+65nHX55NZ+fnzu6YdOIAFIB0gIyA254BpIMQaGAUEAoIBQQCtywAoJBwaBgUDAoGLxhCMifIcGgYFAwKBgUDAoGb1iBizHYbDap3+/Tbrcjp9NJwWCQNBrNQdJflKF6vU5ms5lisdhv353S/Ro+T+11kQCNRoN6vR7p9Xr2v16vyev1kt/v52eIkkql+L3BYKBEIkFarfbberuGz+82VCzAZrOhdDrNGX17e6PVakXdbpesVis9PDzwnq1Wi9/BTCYTvb6+0mQyoff3d9LpdBSPx2k8HhOCNhqNFIlEKJvNnu3zuOLO7WbFAiyXSz7sdrvloOfzObdAIBDgM8xmM8rlcuTxeGg0GtF0OmWhcNhKpULD4ZBsNhuvw3eoGqxX6vPcwPe/VywAertarbIftADKHIYgQqEQB4nAk8kklUolWiwWBwGOxcOa+/t7enp6okt8/ncBkOF8Ps+l+/LywlksFovc6+FwmMW5u7sjt9tN7XabK8Xn8/EzrNPp8HvY8/MzV9GlPpWIoLgCkHHMAPQ2BNg/Q4DHx0eq1Wp/nAcDEBWB4ZjJZA5VY7fbKRqNHnwo8fmv4XpKHMUCIAhUALLmcrn4E33tcDi4AlDmMBysXC5zcMg0gvv4+KDBYEAWi4UrB9WBAYi1Sn0qyT7WKBYAizHACoUCgQgwtAN6GUEeG1oDAoACmAsQZE8PCAHuY47saXKuT1UocBwgUAZDRn/KruHzb2e7qAJ+Klg1/YgAciMkN0JyIyQ3QmpOYbX3FgoIBYQCQgGhgNqTWM39hQJCAaGAUEAooOYUVntvoYBQQCggFBAKqD2J1dxfKHDrFPgCDLCNn09hb34AAAAASUVORK5CYII=" class="media-object" />
               </div>
               <div class="media-body">
                  <h4 class="list-group-item-heading media-heading">{{ $event->topic->title }}</h4>
                  <span>{{ $event->dateDescriptive() }} &bull; {{ $event->location->title }}  &bull; {{ $event->facilitatorsInline() }}</span>
                  <p class="list-group-item-text">{{ $event->topic->summary }}</p>
               </div>
            </a>
         @endforeach
      @else
         <div class="list-group-item empty-classes">:( No classes in the next 90 days.</div>
      @endif
   </div>


@stop

