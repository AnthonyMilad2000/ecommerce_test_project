@extends('partials.app')

@section('content')

<section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a class="white-text" href="{{route('products.index')}}">Shop</a></li>
                    <li class="breadcrumb-item">{{$product->name}}</li>
                </ol>
            </div>
        </div>
    </section>
<section class="section-7 pt-3 mb-3">
        <div class="container">
            <div class="row ">
                @include('products.account.common.message')
                <div class="col-md-5">
                    <div id="product-carousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner bg-light">
                        @if ($product->product_images)
                        @foreach ($product->product_images as $key => $productImage)
                            <div class="carousel-item {{ ($key == 0) ? 'active' : '' }}">
                            <img class="w-100"  style="display: block; height: 350px; object-fit: contain" src="{{ asset('uploads/product/large/'.
                            $productImage->image) }}" alt="Image">
                            </div>
                        @endforeach
                        @endif

                           
                        </div>
                        <a class="carousel-control-prev" href="#product-carousel" data-bs-slide="prev">
                            <i class="fa fa-2x fa-angle-left text-dark"></i>
                        </a>
                        <a class="carousel-control-next" href="#product-carousel" data-bs-slide="next">
                            <i class="fa fa-2x fa-angle-right text-dark"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="bg-light right">
                        <h1>{{$product->name}}</h1>
                        <p>{!! $product->description !!}</p>
                        <h2 class="price">Price: {{$product->price}}$</h2>

                       
                    </div>
                </div>

                <div class="col-md-12 mt-5">
                    <div class="bg-light">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">reviews</button>
                            </li>
                            
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">Write a review</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="description" 
                                role="tabpanel" aria-labelledby="description-tab">                               
                                    @if($product->product_ratings->isNotEmpty())
                                    @foreach($product->product_ratings as $rating)
                                    @php
                                    $ratingPer = ($rating->rating*100)/5
                                    @endphp
                                
                                <div class="rating-group mb-4">
                                <span> <strong>{{ $rating->user->name }}</strong></span>
                                <div class="star-rating mt-2" title="">
                                        <div class="back-stars">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            
                                            <div class="front-stars" style="width: {{ $ratingPer }}%">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>   
                                    <div class="my-3">
                                    <p>{{$rating->comment}}</p>
                                    </p>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                           
                            </div>
                           
                            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
    <div class="col-md-8">
        <div class="row">
            <form id="reviewForm" action="{{ url('/products/' . $product->id . '/review') }}" method="POST">
                @csrf
                <h3 class="h4 pb-3">Write a Review</h3>

                <!-- Rating Section -->
                <div class="form-group mb-3">
                    <label for="rating">Rating</label>
                    <br>
                    <div class="rating" style="width: 10rem">
                        <input id="rating-5" type="radio" name="rating" value="5"/><label for="rating-5"><i class="fas fa-3x fa-star"></i></label>
                        <input id="rating-4" type="radio" name="rating" value="4"/><label for="rating-4"><i class="fas fa-3x fa-star"></i></label>
                        <input id="rating-3" type="radio" name="rating" value="3"/><label for="rating-3"><i class="fas fa-3x fa-star"></i></label>
                        <input id="rating-2" type="radio" name="rating" value="2"/><label for="rating-2"><i class="fas fa-3x fa-star"></i></label>
                        <input id="rating-1" type="radio" name="rating" value="1"/><label for="rating-1"><i class="fas fa-3x fa-star"></i></label>
                    </div>
                    <p class="product-rating-error text-danger"></p>
                </div>

                <!-- Review Comment Section -->
                <div class="form-group mb-3">
                    <label for="comment">How was your overall experience?</label>
                    <textarea required name="comment" id="comment" class="form-control" cols="30" rows="10" placeholder="How was your overall experience?"></textarea>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="btn btn-dark">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>



                    </div>
                </div> 
            </div>           
        </div>
    </section>



@endsection

@section('customJs')
<!-- JavaScript Validation -->
<script>
document.getElementById('reviewForm').addEventListener('submit', function(event) {
    let ratingSelected = document.querySelector('input[name="rating"]:checked');
    let errorMessage = document.querySelector('.product-rating-error');

    if (!ratingSelected) {
        event.preventDefault(); // Prevent form submission
        errorMessage.textContent = "You must choose a rating before submitting.";
    } else {
        errorMessage.textContent = ""; // Clear the error if rating is selected
    }
});
</script>
@endsection
