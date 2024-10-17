{{--
  Template Name: About Us Template
--}}

@extends('layouts.app')



@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.content-about')
    @content
  @endwhile
@endsection
