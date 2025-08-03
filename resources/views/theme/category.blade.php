 @extends('theme.master')
 @section('title', '-Category')
 @section('categories-active', 'active')
 @section('content')

     @include('theme.partials.hero', ['title' => $categoryname])

     <!--================ Start Blog Post Area =================-->
     <section class="blog-post-area section-margin">
         <div class="container">
             <div class="row">
                 <div class="col-lg-8">
                     <div class="row">
                         @if (isset($blogs) && $blogs->count() > 0)
                             @foreach ($blogs as $blog)
                                 <div class="col-12 mb-4">
                                     <div class="single-recent-blog-post card-view">
                                         <div class="thumb">
                                             <img class="card-img rounded-0" src="{{ asset("storage/blogs/$blog->image") }}"
                                                 alt="Blog Image">
                                             <ul class="thumb-info">
                                                 <li><a href="#"><i class="ti-user"></i> {{ $blog->user->name }}</a>
                                                 </li>
                                                 <li><a href="#"><i class="ti-themify-favicon"></i> 2 Comments</a>
                                                 </li>
                                             </ul>
                                         </div>
                                         <div class="details mt-20">
                                             <a href="{{ route('blogs.show', $blog) }}">
                                                 <h3>{{ $blog->name }}</h3>
                                             </a>
                                             <p>{{ $blog->description }}</p>
                                             <a class="button" href="{{ route('blogs.show', $blog) }}">
                                                 Read More <i class="ti-arrow-right"></i>
                                             </a>
                                         </div>
                                     </div>
                                 </div>
                             @endforeach
                         @else
                             <div class="col-12">
                                 <p>No blogs found.</p>
                             </div>
                         @endif
                     </div>

                     <!-- Pagination -->
                     <div class="row mt-4">
                         <div class="col-lg-12">
                             @if (isset($blogs) && $blogs->hasPages())
                                 {{ $blogs->links('pagination::bootstrap-4') }}
                             @endif
                         </div>
                     </div>
                 </div>

                 <!-- Sidebar -->
                 @include('theme.partials.sidebar')
             </div>
         </div>
     </section>

     <!--================ End Blog Post Area =================-->

 @endsection
