@extends('frontend.layouts.master')
@section('title')
{{$settings->site_name}} || e-Commerce HTML Template
@endsection

@section('content')

    <!--============================
        BANNER PART 2 START
    ==============================-->
    @include('frontend.home.sections.banner-slider')
    <!--============================
        BANNER PART 2 END
    ==============================-->


    <!--============================
        FLASH SELL START
    ==============================-->
    @include('frontend.home.sections.flash-sale')
    <!--============================
        FLASH SELL END
    ==============================-->


    <!--============================
       MONTHLY TOP PRODUCT START
    ==============================-->
    @include('frontend.home.sections.top-category-product')
    <!--============================
       MONTHLY TOP PRODUCT END
    ==============================-->


    <!--============================
        BRAND SLIDER START
    ==============================-->
    @include('frontend.home.sections.brand-slider')
    <!--============================
        BRAND SLIDER END
    ==============================-->


    <!--============================
        SINGLE BANNER START
    ==============================-->
    @include('frontend.home.sections.single-banner')
    <!--============================
        SINGLE BANNER END
    ==============================-->


    <!--============================
        HOT DEALS START
    ==============================-->
    @include('frontend.home.sections.hot-deals')
    <!--============================
        HOT DEALS END
    ==============================-->


    <!--============================
        ELECTRONIC PART START
    ==============================-->
    @include('frontend.home.sections.category-product-slider-one')
    <!--============================
        ELECTRONIC PART END
    ==============================-->


    <!--============================
        ELECTRONIC PART START
    ==============================-->
    @include('frontend.home.sections.category-product-slider-two')

    <!--============================
        ELECTRONIC PART END
    ==============================-->


    <!--============================
        LARGE BANNER  START
    ==============================-->
    @include('frontend.home.sections.large-banner')

    <!--============================
        LARGE BANNER  END
    ==============================-->


    <!--============================
        WEEKLY BEST ITEM START
    ==============================-->
    @include('frontend.home.sections.weekly-best-item')
    <!--============================
        WEEKLY BEST ITEM END
    ==============================-->


    <!--============================
      HOME SERVICES START
    ==============================-->
    @include('frontend.home.sections.services')
    <!--============================
        HOME SERVICES END
    ==============================-->


    <!--============================
        HOME BLOGS START
    ==============================-->
    @include('frontend.home.sections.blog')
    <!--============================
        HOME BLOGS END
    ==============================-->

     <!-- Include Botman chat widget CSS -->
     {{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/assets/css/chat.min.css"> --}}

     <!-- Botman configuration -->
     {{-- <script>
         var botmanWidget = {
             aboutText: '',
             introMessage: "Welcome to ArtNexus"
         };
     </script>

     <!-- Include Botman chat widget JS -->
     <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>

     <!-- This div will contain the chat icon -->
     <div class="botman-open-chat">
         <button class="btn btn-primary">Chat</button>
     </div>
 --}}


     <!-- Include Botman chat widget -->
    @include('frontend.home.sections.chat-widget')



@endsection
