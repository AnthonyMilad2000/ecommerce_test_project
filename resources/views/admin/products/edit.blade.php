@extends('admin.partials.app')

@section('content')
<section class="content-header">					
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Edit Product</h1>
							</div>
							<div class="col-sm-6 text-right">
								<a href="{{route('products.list')}}" class="btn btn-primary">Back</a>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->
                    <form action="" method="post" name="productForm" id="productForm">
					<div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card mb-3">
                                    <div class="card-body">								
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="name">Name</label>
                                                    <input type="text" value="{{$product->name}}" name="name" id="name" class="form-control" placeholder="Name">	
                                                    <p class="error"></p>
                                                </div>
                                            </div>
                                            
                                           
                                            
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="description">Description</label>
                                                    <textarea name="description" id="description" cols="30" rows="10" class="summernote" placeholder="Description">{{$product->description}}</textarea>
                                                </div>
                                            </div>

                                                                              
                                        </div>
                                    </div>	                                                                      
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h2 class="h4 mb-3">Media</h2>								
                                        <div id="image" class="dropzone dz-clickable">
                                            <div class="dz-message needsclick">    
                                                <br>Drop files here or click to upload.<br><br>                                            
                                            </div>
                                        </div>
                                    </div>	                                                                      
                                </div>
                                <div class="row" id="product-gallery">
                                @if($productImages->isNotEmpty())
        @foreach($productImages as $image)
        <div class="col-md-3" id="image-row-{{ $image->id }}">
            <div class="card">
                <input type="hidden" name="image_array[]" value="{{ $image->id }}">
                <img src="{{ asset('uploads/product/small/'.$image->image) }}" class="card-img-top" alt="">
                <div class="card-body">
                    <a href="javascript:void(0)" onClick="deleteImage({{ $image->id }})" class="btn btn-danger">Delete</a>
                   </div>
                   
                                        </div></div>

                                        @endforeach
                                    @endif

                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h2 class="h4 mb-3">Pricing</h2>								
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="price">Price</label>
                                                    <input type="text" value="{{$product->price}}" name="price" id="price" class="form-control" placeholder="Price">	
                                                    <p class="error"></p>
                                                </div>
                                            </div>
                                                                                    
                                        </div>
                                    </div>	                                                                      
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h2 class="h4 mb-3">Inventory</h2>								
                                        <div class="row">
                                            
                                           
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <input type="number" value="{{$product->stock}}" min="0" name="stock" id="stock" class="form-control" placeholder="Stock">
                                                    <p class="error"></p>	
                                                </div>
                                            </div>
                                                                                     
                                        </div>
                                        
                                    </div>	
                                                                                                          
                                </div>
                               
                            </div>
                            
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    <!-- <div class="card-body">	
                                        <h2 class="h4 mb-3">Product status</h2>
                                        <div class="mb-3">
                                            <select name="status" id="status" class="form-control">
                                                <option {{ ( $product->status == 1)? 'selected': ''}} value="1">Active</option>
                                                <option {{ ( $product->status == 0)? 'selected': ''}} value="0">Block</option>
                                            </select>
                                        </div>
                                    </div> -->
                                </div> 
                                <div class="card">
                                    <div class="card-body">	
                                        <h2 class="h4  mb-3">Product category</h2>
                                        <div class="mb-3">
                                            <label for="category">Category</label>
                                            <select name="category_id" id="category" class="form-control">
    <option value="">Select a category</option>
    @if($categories->isNotEmpty())
        @foreach($categories as $category)
            <option {{($product->category_id == $category->id) ? 'selected' : ''}} value="{{ $category->id }}">
                {{ $category->name }}
            </option>
        @endforeach
    @endif
</select>
<p class="error"></p>

                                        </div>
                                        
                                    </div>
                                </div> 
                               
                                <div class="card mb-3">
                                    <div class="card-body">	
                                        <h2 class="h4 mb-3">Featured product</h2>
                                        <div class="mb-3">
                                            <select name="is_featured" id="is_featured" class="form-control">
                                                <option {{($product->is_featured == 'No')? 'selected' : ''}} value="No">No</option>
                                                <option {{($product->is_featured == 'Yes')? 'selected' : ''}} value="Yes">Yes</option>                                                
                                            </select>
                                            <p class="error"></p>
                                        </div>
                                    </div>
                                </div>   
                                                                  
                            </div>
                        </div>
						
						<div class="pb-5 pt-3">
							<button type="submit" class="btn btn-primary">Update</button>
							<a href="{{route('products.list')}}" class="btn btn-outline-dark ml-3">Cancel</a>
						</div>
					</div>
                    </form>
					<!-- /.card -->
				</section>
@endsection

@section('customJs')

<script>
        $('.related-product').select2({
        ajax: {
        url: '{{ route("products.getProducts") }}',
        dataType: 'json',
        tags: true,
        multiple: true,
        minimumInputLength: 3,
        processResults: function (data) {
        return {
        results: data.tags
        };
        }
        }
        });



	$("#title").change(function(){
    element = $(this);
    $("button[type=submit]").prop('disabled',true);
    $.ajax({
            url: '{{route ("getSlug") }}',
            type: 'get',
            data: {title: element.val()},
            dataType: 'json',
            success: function (response) {
                $("button[type=submit]").prop('disabled',false);

                if(response["status"] == true){
                    $("#slug").val(response["slug"]);
                }
}

});
});

$("#productForm").submit(function(event){
        event.preventDefault();
        var formArray = $(this).serializeArray();
        $("button[type='submit']").prop('disapled',true);
        
        $.ajax({
        url: '{{ route("products.update",$product->id) }}',
        type: 'put',
        data: formArray,
        dataType: 'json',
        success: function (response) {
            $("button[type='submit']").prop('disapled',false);

            if (response['status'] == true) {
                $(".error").removeClass('invalid-feedback').html('');
                $("input[type='text'], select,input[type='number']").removeClass('is-invalid');
                window.location.href="{{route ('products.list')}}";
           } else {
            var errors = response['errors'];
          //  if (errors['title']) {
          //  $("#title").addClass('is-invalid')
          //  .siblings('p')
          //  .addClass('invalid-feedback')
          //  .html(errors['title']);
          //  } else {
          //  $("#title").removeClass('is-invalid')
          //  .siblings('p')
          //  .removeClass('invalid-feedback')
          //  .html("");
          //  }
          $(".error").removeClass('invalid-feedback').html('');
          $("input[type='text'], select,input[type='number']").removeClass('is-invalid');

          $.each(errors,function(key,value){
            $(`#${key}`).addClass('is-invalid')
            .siblings('p')
            .addClass('invalid-feedback')
            .html(value);
          });
        }
        },
        error: function(){
            console.log("something went wrong");
        }
    });
        });


        Dropzone.autoDiscover = false;
        const dropzone = $("#image").dropzone({
        url: "{{ route('product-images.update') }}",
        maxFiles: 10,
        paramName: 'image',
        params: {'product_id':'{{$product->id}}'},
        addRemoveLinks: true,
        acceptedFiles: "image/jpeg,image/png,image/gif",
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }, success: function(file, response){

           var html = `<div class="col-md-3" id="image-row-${response.image_id}"><div class="card">
           <input type="hidden" name="image_array[]" value="${response.image_id}">
            <img src="${response.ImagePath}" class="card-img-top" alt="">
            <div class="card-body">
                <a href="javascript:void(0)" onClick="deleteImage(${response.image_id})" class="btn btn-danger">Delete</a>
            </div>
            </div></div>`;
            $("#product-gallery").append(html);
            
        },
        complete: function(file){
            this.removeFile(file);
        }
    });

    function deleteImage(id) {
   $("#image-row-" + id).remove();
   if(confirm("Are you sure you want to delete ?")){
        $.ajax({
            url: '{{route("product-images.destroy")}}',
            type: 'delete',
            data:{id:id},
            success: function(response){
                if(response.status == true){
                    alert(response.message);
                }
                else{
                    alert(response.message);
                }
            }
        });
       }}


    

</script>


@endsection