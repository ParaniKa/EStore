@extends('product.layout')
@section('content')
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>E-Store Products</h2>
            </div>
            <br>
            <div class="pull-right">
                <a class="btn btn-success" href="{{route('products.create')}}"> Create New Product</a>
            </div>
        </div>
    </div>
   <br>
   <!-- success alert message -->
   @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
@endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Details</th>
            <th>price</th>
            <th width="280px">Action</th>
        </tr>
        @php($i=0)
        <!-- <?php $i=0 ?> -->
        @foreach($products as $product)
        <tr>
            <td>{{++$i}}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->detail}}</td>
            <td>{{$product->price}}</td>
        <td>
            <form action="{{route('products.destroy',$product)}}" method="POST">
                <a class="btn btn-info" href ="{{route('products.show',$product)}}">Show</a>
                <a class="btn btn-primary" href ="{{route('products.edit',$product)}}">Edit</a>
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">Delete</button>
             </form>
        </td>
        </tr>
        @endforeach
    </table>
    @endsection