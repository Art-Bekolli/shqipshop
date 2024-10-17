
@extends('layouts.app')


@section('content')
  @while(have_posts()) @php the_post() @endphp
    
        <?php echo \App\Template('partials.single-product-content'); ?>

  @endwhile
@endsection

