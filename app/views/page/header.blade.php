<header>
   <h2><a href="{{ route('index') }}" class="sfs-logo"><img src="/static/img/sfs-logo.png" />Seattle Free School</a></h2>
   <nav>
      <a href="{{ route('classes.index') }}">Attend a Class</a>
      <a href="{{ route('classes.host') }}">Host a Class</a>
      <a href="{{ route('community') }}"><abbr>SFS</abbr> Community</a>
   </nav>
   @if(Auth::check())
      <a href="{{ route('community.user', array('id' => Auth::user()->id)) }}" class="auth">
         <img src="{{ Auth::user()->avatar() }}" class="avatar" />
         <b>{{ Auth::user()->name }}</b>
      </a>
   @else
      {{ Form::open(array('route' => 'login', 'class' => 'auth form-inline', 'role' => 'form')) }}
         <div class="form-group">
            {{ Form::label('email', 'Email Address', array('class' => 'sr-only')) }}
            {{ Form::email('email', null, array('class' => 'form-control', 'placeholder' => 'Email Address')) }}
         </div>

         <div class="form-group">
            {{ Form::label('password', 'Password', array('class' => 'sr-only')) }}
            {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) }}
         </div>

         {{ Form::submit('Login', array('name' => 'login', 'class' => 'btn btn-primary')) }}

         <span class="or">or</span>

         {{ Form::submit('Sign Up', array('name' => 'signup', 'class' => 'btn btn-success')) }}

      {{ Form::close() }}
   @endif
</header>