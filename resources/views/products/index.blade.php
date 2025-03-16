@extends('partials.app')

@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Shop</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-6 pt-5">
        <div class="container">
            <div class="row">            
                <div class="col-md-12">
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
                                    <img class="card-img-top" src="{{asset('uploads/product/small/'.$productImage->image)}}"/>
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
                       
                        <div class="col-md-12 pt-5">
                            {{$products->withQueryString()->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    @endsection

    @section('customJs')
    @endsection
    


    