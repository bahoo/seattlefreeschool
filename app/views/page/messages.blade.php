@foreach($messages as $type => $m)
   @foreach($m as $message)
      <div class="alert alert-{{ $type }}">{{ $message }}</div>
   @endforeach
@endforeach