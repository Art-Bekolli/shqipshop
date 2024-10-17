<!doctype html>
<html {!! get_language_attributes() !!}>
<meta name="viewport" content="width=device-width, initial-scale=1" />
  @include('partials.head')
  @php do_action('get_header') @endphp
  <body @php body_class() @endphp class="woocommerce">
    @include('partials.header')
    <div class="wrap" role="document">
      <div class="content">
        <main class="main">
          @yield('content')
        </main>
        @if (App\display_sidebar())
          <aside class="sidebar">
            @include('partials.sidebar')
          </aside>
        @endif
      </div>
    </div>
    @php do_action('get_footer') @endphp
    @include('partials.footer')
    @php wp_footer() @endphp
  </body>
</html>
