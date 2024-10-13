@extends('layouts.master')

@section('content')

<!--section-heading-->
<div class="section-heading " >
    <div class="container-fluid">
         <div class="section-heading-2">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="section-heading-2-title">
                         <h1>{{ $category->title }}</h1>
                         <p class="links"><a href="index.html">Home <i class="las la-angle-right"></i></a> Blog</p>
                     </div>
                 </div>
             </div>
         </div>
     </div>
</div>


 <!-- Blog Layout-2-->
 <section class="blog-layout-2">
     <div class="container-fluid">
         <div class="row">
             <div class="col-md-12">
                 <!--post 1-->
                @foreach ( $blogs as $blog )
                <div class="post-list post-list-style2">
                    <div class="post-list-image">
                        <a href="post-single.html">
                            <img src="{{ asset('uploads/blog') }}/{{ $blog->thumnail }}" alt="">
                        </a>
                    </div>
                    <div class="post-list-content">
                        <h3 class="entry-title">
                            <a href="post-single.html">{{ $blog->title }}</a>
                        </h3>
                        <ul class="entry-meta">
                            <li class="post-author-img"><img src="assets/img/author/1.jpg" alt=""></li>
                            <li class="post-author"> <a href="author.html">Meriam Smith</a></li>
                            <li class="entry-cat"> <a href="blog-layout-1.html" class="category-style-1 "> <span class="line"></span> interior</a></li>
                            <li class="post-date"> <span class="line"></span> february 10 ,2022</li>
                        </ul>
                        <div class="post-exerpt">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Ut est minus iste in accusantium repellat repudiandae nulla blanditiis iusto dolores!</p>
                        </div>
                        <div class="post-btn">
                            <a href="post-single.html" class="btn-read-more">Continue Reading <i class="las la-long-arrow-alt-right"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach

             </div>
         </div>
     </div>
 </section>


<!--pagination-->
<div class="pagination">
     <div class="container-fluid">
         <div class="pagination-area">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="pagination-list">
                         <ul class="list-inline">
                             <li><a href="#" ><i class="las la-arrow-left"></i></a></li>
                             <li><a href="#" class="active">1</a></li>
                             <li><a href="#">2</a></li>
                             <li><a href="#">3</a></li>
                             <li><a href="#">4</a></li>
                             <li><a href="#" ><i class="las la-arrow-right"></i></a></li>
                         </ul>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

@endsection
