@extends('layouts.master')

@section('content')

    <section class="content-header">
      <h1>
      Products Lists
        <small></small>
      </h1>     
      
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
         <div class="box-body">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2></h2><br><br>
            </div>
            <div class="pull-right">
                
                
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
               
               
            </div>
        </div>
    

        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

<table id="table2" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
            <th>No</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Category</th>
            <th>Sub-Category</th>
            <th>Last Update</th>
            <th width="280px">Action</th>
        </tr>
        </thead>
        <tbody>
            
            @foreach ($products as $product)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $product->name }}</td>
	        <td>{{ $product->price }}</td>
            <td>{{ $product->quantity }}</td>
            <td>{{ $product->category }}</td>
            <td>{{ $product->subcategory }}</td>
            
            <td>{{ $product->updated_at }}</td>
           
	        <td>
                <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                    <a class="btn btn-info" data-attr="{{ route('products.show', $product->id) }}" 
                        data-toggle="modal" id="smallButton" data-target="#smallModal" 
                            data-attr="{{ route('products.show', $product->id) }}" title="show">Show</a>
                   
                     
                    @csrf
                    
                    <a class="btn btn-primary" data-attr="{{ route('products.edit', $product->id) }}" 
                        data-toggle="modal1" id="smallButton1" data-target="#smallModal1" 
                            data-attr="{{ route('products.edit', $product->id) }}" title="show">Edit</a>
                    
                    


                    @csrf
                    @method('DELETE')
                    
                    <button type="submit" class="btn btn-danger">Delete</button>
                    
                </form>

	        </td>
	    </tr>
	    @endforeach
        </tbody>
        <tfoot>
            <tr>
            <th>No</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Category</th>
            <th>Sub-Category</th>
            <th>Last Update</th>
            <th width="280px">Action</th>
            </tr>
        </tfoot>
    </table>

<!-- small modal to show-->
<div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="smallBody">
                    <div>
                        <!-- the result to be displayed apply here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- small modal to show-->
<!-- small modal to edit-->
<div class="modal1 fade" id="smallModal1" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="smallBody">
                    <div>
                        <!-- the result1 to be displayed apply here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- small modal to edit-->
      </div>      
    </div>
    </section>
    <!-- /.content -->
    
    <script>
        // show products  modal (small modal)
        $(document).on('click', '#smallButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(response) {
                    $('#smallModal').modal("show");
                    $('#smallBody').html(response).show();
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });

        // edit products  modal (small modal)
        $(document).on('click', '#smallButton1', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(response) {
                    $('#smallModal').modal("show");
                    $('#smallBody').html(response).show();
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });

        
    </script>

@endsection
