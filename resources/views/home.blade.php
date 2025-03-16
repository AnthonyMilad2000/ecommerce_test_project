@extends('partials.app')

@section('content')

<body>
<section class="section-1">
        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="false">
            <div class="carousel-inner">
                <div class="carousel-item active">
                   <!--  <img src="images/carousel-1.jpg" class="d-block w-100" alt=""> -->

                    <picture>
                        <source media="(max-width: 799px)" srcset="{{asset('front-assets/images/Smart_Watch_banner.png')}}" />
                        <source media="(min-width: 800px)" srcset="{{asset('front-assets/images/Smart_Watch_banner.png')}}" />
                        <img src="{{asset('front-assets/images/Smart_Watch_banner.png')}}" alt="" />
                    </picture>

                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3">
                            <h1 class="display-4 text-white mb-3">Welcome to Our Store <span>Your one-stop shop for everything!</span></h1>
                        <!--   <p class="mx-md-5 px-5">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p> -->
                           <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{route('products.index')}}">Shop Now</a>
                        </div>
                    </div>
                </div>
                
                    </div>
                </div>
               
    </section>
        <section class="section-4 pt-5">
            <div class="container">
                <div class="section-title">
                    <h2>Featured Products</h2>
                </div>    
                <div class="row pb-3">
                    @if ($products->isNotEmpty())
                        @foreach($products as $product)
                        @php
                            $productImage = $product->product_images->first();
                        @endphp
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="card product-card">
                            <div class="product-image position-relative">
                            <a href="{{route ('products.show',$product->id)}}" class="product-img">
                                @if(!empty($productImage->image))
                                    <img class="card product-card" src="{{asset('uploads/product/small/'.$productImage->image)}}"/>
                                @else
                                    <img src="{{asset('admin-assets/img/default-150x150.png')}}"/>
                                @endif    
                            </a>           
                                </div>
                                                 
                            <div class="card-body text-center mt-0 px-0 pt-0">
                                <a class="h6 link" href="{{route ('products.show',$product->id)}}">{{$product->name}}</a>
                                <div class="price mt-2">

<span class="h5"><strong>{{$product->price}}$</strong></span>
                                </div>
                            </div>                        
                        </div>                                               
                    </div>  

                    @endforeach
                    @endif
                
                </div>
            </div>
        </section>   
@endsection

@section('customJs')
@endsection
