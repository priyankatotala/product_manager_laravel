    <div class="row" style="margin-right: 10px;margin-left: 10px;">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Product</h2>
                <span>Fields with * are required</span>
            </div>
            
            
        </div>
    </div>
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

    @if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- Error Handling -->
    
    <!-- Form to create the products -->
    <form name="form1" action="{{ route('products.update',$product->id) }}" method="POST" onsubmit="return validateForm()" style="margin-right: 20px;margin-left: 20px;">
    	@csrf
        @method('PUT')
        
       
         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>*Name:</strong>
		            <input type="text" name="name" value="{{ $product->name }}" class="form-control" placeholder="Name">
		        </div>
		    </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>*Price:</strong>
		            <input type="text" name="price" value="{{ $product->price }}" class="form-control" placeholder="Price">
		        </div>
		    </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>*Quantity:</strong>
		            <input type="text" name="quantity" value="{{ $product->quantity }}" class="form-control" placeholder="Quantity">
		        </div>
		    </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong></strong>
                    <label for="sel1">*Main Categories:</label>
                    	            
                    
                    <select class="form-control" id="sel1" name="category" >
                        <option value='' >Choose a category</option>
                        <?php
                        // A sample product array
                        $rows = DB::table('category')->pluck('cat_name');    
                        //print_r($rows);die();    
                        // Iterating through the product array
                        foreach($rows as $item){
                        echo "<option value='$item' selected>$item</option>";      
                       // {{ $item == $item ? 'selected' : ''  }}
                        }
                        ?>
                    </select>

                </div>
            </div>
             

           

            <div class="col-xs-12 col-sm-12 col-md-12" >
                            <div class="form-group">
                                <strong></strong>
                                <label for="sel2">*Sub Categories:</label>
                                <span>(Select a Main category first to select a subcategory)</span>
                                                             
                    <select class="form-control" id="sel2" name="subcategory" >
                        
                    <option value='{{ $product->subcategory }}' selected>{{ $product->subcategory }}</option>
                
                </select>

            </div>
            </div>
		    <div class="col-xs-12 col-sm-12 col-md-12 hidden">
		        <div class="form-group">
		            <strong>User id:</strong>
		            <input type="text" name="user_id" value="{{ $product->user_id }}" class="form-control"  >
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		      <button type="submit" class="btn btn-primary">Submit</button>
		    </div>
		</div>
    </form>
    <!-- Form to create the products -->


