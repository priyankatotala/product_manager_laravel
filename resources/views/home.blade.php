@extends('layouts.master')

@section('content')

    <section class="content-header">
      <h1>
      Dashboard
        
      </h1>
  
      
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">All Products</h3>
        </div>
        <div class="box-body">
          
        <table id="table1" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
            <th>No</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Category</th>
            <th>Sub-Category</th>
            <th>Last Update</th>
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
            </tr>
        </tfoot>
    </table>
        <!-- /.box-body -->
        
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->


@endsection
