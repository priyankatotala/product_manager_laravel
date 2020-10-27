@extends('layouts.sidebar')

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
           <!-- <td> {{ Timezone::convertToLocal($product->updated_at) }} </td>  -->
	        <td>
                <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a>
                     
                    @csrf
                    
                    <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
                    


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


    

      </div>
      <!-- /.box -->
    </div>
    </section>
    <!-- /.content -->
    
   

@endsection
