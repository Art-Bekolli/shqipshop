{{--
  Template Name: Shop Template
--}}

@extends('layouts.app')



@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.content-shop')
    @content
  @endwhile
@endsection
