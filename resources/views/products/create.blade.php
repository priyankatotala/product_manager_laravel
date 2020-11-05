@extends('layouts.master')

@section('content')

    <!-- Main content -->
    <section class="content">

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Product </h2>
                <span>Fields with * are required</span>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
            </div>
        </div>
    </div>
    
     <!-- Error Handling -->
    @if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Fix the problem with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif 
    <!-- Error Handling -->

<!-- Javascript Validations -->
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <script>
        jQuery(document).ready(function(){
            jQuery("#sel1").change(function() {
            var category = $(this).val();

    jQuery.ajax({
            url: "/fetch.php",            
            method: 'POST',                           
            data:{category : category},
            dataType:'text',                
            success: function(data)
            {               
                jQuery('#sel2').html(data);              
                
            }
        });  
});
});

function validateForm() {
  var x = document.forms["form1"]["name"].value;
  var y = document.forms["form1"]["price"].value;
  var z = document.forms["form1"]["quantity"].value;
  
  if( x == ""  )
  {
     text1 = "Product name is required";
    document.getElementById("error1").innerHTML = text1;
  }
  
  
  else if( y == "" || isNaN( y )  )
  {
     text2 = "Price value is required and it should be a Integer";
     document.getElementById("error2").innerHTML = text2;
  }
  
  else if( z == "" || isNaN( z )  )
  {
     text3 = "Quantity value is required";
     document.getElementById("error3").innerHTML = text3;
  }
  
}
</script> 

<!-- Javascript Validations -->

<!-- Form to create the products -->
    <form name="form1" action="{{ route('products.store') }}" method="POST" onsubmit="return validateForm()">
    	@csrf
        @method('PUT')
        
         <div class="row">     
         	<div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>*Name:</strong>
		            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}">
		        </div>
		        <p id="error1"></p>
		    </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>*Price:</strong>
		            <input type="text" name="price" class="form-control" placeholder="Price" value="{{ old('price') }}">
		        </div>
		        <p id="error2"></p>
		    </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>*Quantity:</strong>
		            <input type="text" name="quantity" class="form-control" placeholder="Quantity" value="{{ old('quantity') }}">
		        </div>
		        <p id="error3"></p>
		    </div>
            <!-- CATGEORY AND SUBCTAEGORY SECTION-->
            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong></strong>		            
                    <label for="sel1">*Main Categories:</label>
                    <select class="form-control" id="sel1" name="category" value="{{ old('category') }}">
                        <option value='' selected="selected">Choose a category</option>
                        <?php
                        // A sample product array
                        $rows = DB::table('category')->pluck('cat_name');    
                        //print_r($rows);die();    
                        // Iterating through the product array
                        foreach($rows as $item){
                        echo "<option value='$item'>$item</option>";                      
                        }
                        ?>
                    </select>
                </div>
                <p id="error4"></p>
            </div>


            <div class="col-xs-12 col-sm-12 col-md-12" >
                            <div class="form-group">
                                <strong></strong>
                                
                                <label for="sel2">*Sub Categories:</label>
                                <span>(Select a Main category first to select a subcategory)</span>

                    <select class="form-control" id="sel2" name="subcategory" value="{{ old('subcategory') }}">
                    <option value='' >Choose a Subcategory</option>
                </select>
            </div>
            </div>
             <!-- CATGEORY AND SUBCTAEGORY SECTION-->

            <div class="col-xs-12 col-sm-12 col-md-12 hidden">
		        <div class="form-group">
		            <strong>User id:</strong>
		            <input type="text" name="user_id" class="form-control" placeholder="{{ Auth::user()->id }}" value='{{ Auth::user()->id }}'>
		        </div>
		    </div>
		    
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		            <button type="submit" class="btn btn-primary" value="submit">Submit</button>
		    </div>
		</div>
    </form>
<!-- Form to create the products -->
        
        
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->


@endsection
