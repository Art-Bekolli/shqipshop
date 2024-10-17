{{--
  Template Name: Artisans Template
--}}

@extends('layouts.app')



@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.content-artisans')
    @content
  @endwhile
@endsection
