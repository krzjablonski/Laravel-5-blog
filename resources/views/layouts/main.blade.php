{{-- Include head file form views/partials/_head.blade.php --}}
@include('partials._head')

  <!-- Include navigation file form views/partials/_nav.blade.php -->
  @include('partials._nav')
  <!-- End of Navigation -->

  <!-- Here goes content of specific view -->
  @include('partials._messages')
  @yield('content')
  <!-- Here ends content of specific view -->

{{-- Include footer file form views/partials/_footer.blade.php --}}
@include('partials._footer')
