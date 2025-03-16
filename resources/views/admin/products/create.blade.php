@extends('admin.partials.app')

@section('content')
<section class="content-header">					
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Create Product</h1>
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
                                                    <input type="text" name="name" id="name" class="form-control" placeholder="Name">	
                                                    <p class="error"></p>
                                                </div>
                                            </div>
                                            
                                            
                                            
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="description">Description</label>
                                                    <textarea name="description" id="description" cols="30" rows="10" class="summernote" placeholder="Description"></textarea>
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

                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h2 class="h4 mb-3">Pricing</h2>								
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="price">Price</label>
                                                    <input type="text" name="price" id="price" class="form-control" placeholder="Price">	
                                                    <p class="error"></p>
                                                </div>
                                            </div>
                                                                                   
                                        </div>
                                    </div>	                                                                      
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h2 class="h4 mb-3">Quantity</h2>								
                                        <div class="row">
                                            
                                            
                                            <div class="col-md-12">
                                               
                                                <div class="mb-3">
                                                    <input type="number" min="0" name="stock" id="stock" class="form-control" placeholder="Quantity">
                                                    <p class="error"></p>	
                                                </div>
                                            </div>                                         
                                        </div>
                                    </div>	                                                                      
                                </div>
                                
                            </div>
                            <div class="col-md-4">
                                <!-- <div class="card mb-3">
                                    <div class="card-body">	
                                        <h2 class="h4 mb-3">Product status</h2>
                                        <div class="mb-3">
                                            <select name="status" id="status" class="form-control">
                                                <option value="1">Active</option>
                                                <option value="0">Block</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>  -->
                                <div class="card">
                                    <div class="card-body">	
                                        <h2 class="h4  mb-3">Product category</h2>
                                        <div class="mb-3">
                                            <label for="category">Category</label>
                                            <select name="category_id" id="category_id" class="form-control">
                                                <option value="">Select a category</option>
                                               @if($categories->isNotEmpty())
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}"> {{ $category->name }} </option>
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
                                                <option value="No">No</option>
                                                <option value="Yes">Yes</option>                                                
                                            </select>
                                            <p class="error"></p>
                                        </div>
                                    </div>
                                </div>                                 
                            </div>
                        </div>
						
						<div class="pb-5 pt-3">
							<button type="submit" class="btn btn-primary">Create</button>
							<a href="{{route('products.list')}}" class="btn btn-outline-dark ml-3">Cancel</a>
						</div>
					</div>
                    </form>
					<!-- /.card -->
				</section>
@endsection

@section('customJs')

<script>



	$("#name").change(function(){
    element = $(this);
    $("button[type=submit]").prop('disabled',true);
    $.ajax({
            url: '{{route ("getSlug") }}',
            type: 'get',
            data: {name: element.val()},
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
        $("button[type='submit']").prop('disabled',true);
        
        $.ajax({
        url: '{{ route("products.store") }}',
        type: 'post',
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
        url: "{{ route('temp-images.create') }}",
        maxFiles: 10,
        paramName: 'image',
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
}


    

</script>


@endsection