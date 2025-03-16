<?php

use App\Mail\OrderEmail;
use App\Models\Category;
use App\Models\Country;
use App\Models\Order;
use App\Models\page;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Mail;

function getCategories(){
    return Category::orderBy('name','ASC')
    ->orderBy('id','DESC')
    ->where('status',1)
    ->get();
}

// function getProductImage($productId){
//     return ProductImage::where('product_id',$productId)->first();
// }




?>