@extends('layouts.app')

@section('content')
{{-- hero --}} 
<div class="w-full m-0 p-0 bg-cover bg-bottom" style="@foreach($latest as $latest_post)background-image: linear-gradient(rgba(0,0,0, 0.7), rgba(0,0,0, 0.7)), url('{{ $latest_post['thumbnail'] }}'); @endforeach height: 60vh; max-height:460px;">
  <div class="container max-w-4xl mx-auto pt-16 md:pt-32 text-center break-normal">
    <p class="text-white font-extrabold text-3xl md:text-5xl">
      {{ bloginfo('name') }}
    </p>
    <p class="text-xl md:text-2xl text-gray-500">{!! get_bloginfo('description') !!}</p>
  </div>
</div>
<!--container-->
{{-- /hero --}}
<div class="container px-4 md:px-0 max-w-6xl mx-auto -mt-32">
  
  <div class="mx-0 sm:mx-6">
    @foreach($latest as $latest_post)
    {{-- nav --}}
    <nav class="mt-0 w-full">
      <div class="container mx-auto flex items-center">
        
        <div class="flex w-2/3 pl-4 text-sm">
          @if (has_nav_menu('primary_navigation'))
          {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav list-reset flex justify-between flex-1 md:flex-none items-center', 'container' => false]) !!}
          @endif
        </div>
        <div class="flex w-1/3 justify-end content-center">		
          <a class="inline-block text-gray-500 no-underline hover:text-white hover:text-underline text-center h-10 p-2 md:h-auto md:p-4 avatar" data-tippy-content="@twitter_handle" href="https://twitter.com/intent/tweet?url={{ $latest_post['permalink'] }}">
            <svg class="fill-current h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path d="M30.063 7.313c-.813 1.125-1.75 2.125-2.875 2.938v.75c0 1.563-.188 3.125-.688 4.625a15.088 15.088 0 0 1-2.063 4.438c-.875 1.438-2 2.688-3.25 3.813a15.015 15.015 0 0 1-4.625 2.563c-1.813.688-3.75 1-5.75 1-3.25 0-6.188-.875-8.875-2.625.438.063.875.125 1.375.125 2.688 0 5.063-.875 7.188-2.5-1.25 0-2.375-.375-3.375-1.125s-1.688-1.688-2.063-2.875c.438.063.813.125 1.125.125.5 0 1-.063 1.5-.25-1.313-.25-2.438-.938-3.313-1.938a5.673 5.673 0 0 1-1.313-3.688v-.063c.813.438 1.688.688 2.625.688a5.228 5.228 0 0 1-1.875-2c-.5-.875-.688-1.813-.688-2.75 0-1.063.25-2.063.75-2.938 1.438 1.75 3.188 3.188 5.25 4.25s4.313 1.688 6.688 1.813a5.579 5.579 0 0 1 1.5-5.438c1.125-1.125 2.5-1.688 4.125-1.688s3.063.625 4.188 1.813a11.48 11.48 0 0 0 3.688-1.375c-.438 1.375-1.313 2.438-2.563 3.188 1.125-.125 2.188-.438 3.313-.875z"></path></svg>
          </a>
          <a class="inline-block text-gray-500 no-underline hover:text-white hover:text-underline text-center h-10 p-2 md:h-auto md:p-4 avatar" data-tippy-content="#facebook_id" href="https://www.facebook.com/sharer/sharer.php?u={{ $latest_post['permalink'] }}">
            <svg class="fill-current h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path d="M19 6h5V0h-5c-3.86 0-7 3.14-7 7v3H8v6h4v16h6V16h5l1-6h-6V7c0-.542.458-1 1-1z"></path></svg>
          </a>
        </div>    
      </div>
    </nav>
    {{-- /nav --}}
    <!--lead card-->
    <div class="flex h-full bg-white rounded overflow-hidden shadow-lg">
      <a href="{{ $latest_post['permalink'] }}" class="flex flex-wrap no-underline hover:no-underline">
        <div class="w-full md:w-2/3 rounded-t">	
          <img src={{ the_post_thumbnail_url('large') }} class="h-full w-full rounded-t">
        </div>
        <div class="w-full md:w-1/3 flex flex-col flex-grow flex-shrink">
          <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow-lg">
            <p class="w-full text-gray-600 text-xs md:text-sm pt-6 px-6 uppercase">{{ $latest_post['category'] }}</p>
            <div class="w-full font-bold text-xl text-gray-900 px-6">{{ $latest_post['title'] }}</div>
            <p class="text-gray-800 font-serif text-base px-6 mb-5">
              {{ $latest_post['excerpt'] }}
            </p>
          </div>
          
          <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow-lg p-6">
            <div class="flex items-center justify-between">
              <img class="w-8 h-8 rounded-full mr-4 avatar" data-tippy-content="{{ $latest_post['author'] }}" src="{{ $latest_post['avatar'] }}" alt="Avatar of Author">
              <p class="text-gray-600 text-xs md:text-sm">{{ App::readTime($latest_post['content']) }} MIN READ</p>
            </div>
          </div>
        </div>
        
      </a>
    </div>
    <!--/lead card-->
    @endforeach
    <div class="bg-gray-200 w-full text-xl md:text-2xl text-gray-800 leading-normal rounded-t">
      
      <!-- post container-->
      <div class="flex flex-wrap justify-between pt-12 -mx-6">
        @php 
        $count = 1;
        @endphp
        @while (have_posts()) @php the_post() @endphp
        
        @if($count > 1)
        <!--1/3 col -->
        <div class="w-full md:w-1/3 p-6 flex flex-col flex-grow flex-shrink">
          <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow-lg">
            <a href="{{ get_the_permalink() }}" class="flex flex-wrap no-underline hover:no-underline">
              <img src={{ the_post_thumbnail_url('large') }} class="h-full w-full rounded-t pb-6">
              <p class="w-full text-gray-600 text-xs md:text-sm px-6">{{ get_the_category()[0]->name }}</p>
              <div class="w-full font-bold text-xl text-gray-900 px-6">{{ the_title() }}</div>
              <p class="text-gray-800 font-serif text-base px-6 mb-5">
                {{ get_the_excerpt() }}
              </p>
            </a>
          </div>
          <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow-lg p-6">
            <div class="flex items-center justify-between">
              <img class="w-8 h-8 rounded-full mr-4 avatar" data-tippy-content="{{ get_author_name() }}" src={{ get_avatar_url(get_the_ID()) }} alt="Avatar of Author">
              <p class="text-gray-600 text-xs md:text-sm">{{ App::readTime() }} MIN READ</p>
            </div>
          </div>
        </div>
        @endif
        @php
        $count++
        @endphp
        @endwhile
        
        <!--1/2 col -->
        {{-- <div class="w-full md:w-1/2 p-6 flex flex-col flex-grow flex-shrink">
          <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow-lg">
            <a href="#" class="flex flex-wrap no-underline hover:no-underline">
              <img src="https://source.unsplash.com/collection/3657445/800x600" class="h-full w-full rounded-t pb-6">
              <p class="w-full text-gray-600 text-xs md:text-sm px-6">GETTING STARTED</p>
              <div class="w-full font-bold text-xl text-gray-900 px-6">Lorem ipsum dolor sit amet.</div>
              <p class="text-gray-800 font-serif text-base px-6 mb-5">
                Lorem ipsum eu nunc commodo posuere et sit amet ligula. 
              </p>
            </a>
          </div>
          <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow-lg p-6">
            <div class="flex items-center justify-between">
              <img class="w-8 h-8 rounded-full mr-4 avatar" data-tippy-content="Author Name" src="http://i.pravatar.cc/300" alt="Avatar of Author">
              <p class="text-gray-600 text-xs md:text-sm">1 MIN READ</p>
            </div>
          </div>
        </div> --}}
        
        <!--2/3 col -->
        {{-- <div class="w-full md:w-2/3 p-6 flex flex-col flex-grow flex-shrink">
          <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow-lg">
            <a href="#" class="flex flex-wrap no-underline hover:no-underline">	
              <img src="https://source.unsplash.com/collection/325867/800x600" class="h-full w-full rounded-t pb-6">
              <p class="w-full text-gray-600 text-xs md:text-sm px-6">GETTING STARTED</p>
              <div class="w-full font-bold text-xl text-gray-900 px-6">Lorem ipsum dolor sit amet.</div>
              <p class="text-gray-800 font-serif text-base px-6 mb-5">
                Lorem ipsum eu nunc commodo posuere et sit amet ligula. 
              </p>
            </a>
          </div>
          <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow-lg p-6">
            <div class="flex items-center justify-between">
              <img class="w-8 h-8 rounded-full mr-4 avatar" data-tippy-content="Author Name" src="http://i.pravatar.cc/300" alt="Avatar of Author">
              <p class="text-gray-600 text-xs md:text-sm">1 MIN READ</p>
            </div>
          </div>
        </div> --}}
        
      </div>
      <!--/ post container-->
      
    </div>
    {{-- @include('partials.subscribe') --}}
    {{-- @include('partials.author') --}}
  </div>
</div>
@endsection

{{-- roots sage defaults --}}

{{-- inside post  loop --}}
{{-- @include('partials.content-'.get_post_type()) --}}


{{-- @include('partials.page-header') --}}
{{-- <div id="posts"></div> --}}

{{-- @if (!have_posts())
  <div class="alert alert-warning">
    {{ __('Sorry, no results were found.', 'sage') }}
  </div>
  {!! get_search_form(false) !!}
  @endif --}}
  
  
  {{-- {!! get_the_posts_navigation() !!} --}}