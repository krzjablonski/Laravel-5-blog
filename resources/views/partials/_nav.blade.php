<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>

  <!-- Hamburger menu icon -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
    <ul class="navbar-nav">
    @if(Auth::check())
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Posts</a>
        <div class="dropdown-menu">
          {!! Html::linkRoute('posts.index', 'See All Posts', [], ['class' => 'dropdown-item']) !!}
          {!! Html::linkRoute('posts.create', 'Add New', [], ['class' => 'dropdown-item']) !!}
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Categories</a>
        <div class="dropdown-menu">
          {!! Html::linkRoute('categories.index', 'See All Categories', [], ['class' => 'dropdown-item']) !!}
          {!! Html::linkRoute('categories.create', 'Add New', [], ['class' => 'dropdown-item']) !!}
        </div>
      </li>
    @endif
      <li class="nav-item {{Request::is('/') ? 'active' : ''}}">
        <a class="nav-link" href="/">Home</a>
      </li>
      <li class="nav-item {{Request::is('blog') ? 'active' : ''}}">
        <a class="nav-link" href="/blog">Blog</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{Request::is('about') ? 'active' : ''}}" href="/about">About</a>
      </li>
      <li class="nav-item mr-2">
        <a class="nav-link {{Request::is('contact') ? 'active' : ''}}" href="/contact">Contact</a>
      </li>
      @if(Auth::check())
      <li class="nav-item dropdown border-left pl-2">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{{ isset(Auth::user()->name) ? 'Hello, '.ucfirst(Auth::user()->name) : Auth::user()->email }}}</a>
        <div class="dropdown-menu">
          {!! Html::linkRoute('posts.index', 'Posts', [], ['class' => 'dropdown-item']) !!}
          <div class="dropdown-divider"></div>
          {!! Form::open(['route' => 'logout']) !!}
            {{ Form::submit('Log out', ['class'=>'btn btn-link']) }}
          {!! Form::close() !!}
        </div>
      </li>
      @else
        <li class="nav-item border-left pl-2">
          {!! Html::linkRoute('login', 'Log In', [], ['class' => 'nav-link']); !!}
        </li>
      @endif
    </ul>
  </div>
</nav>
