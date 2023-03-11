<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>ECommerce App</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
</head>
<body>
<div class="container mt-2">
<div class="row">
<div class="col-lg-12 margin-tb">
<div class="pull-left">
<h2>ECommerce Application</h2>
</div>
<div class="pull-right mb-2">
<a class="btn btn-success" href="{{ route('products.create') }}"> Create Product</a>
<a class="btn btn-success" href="{{ route('orders.create') }}"> Order Management</a>
</div>
</div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
<p>{{ $message }}</p>
</div>
@endif
<table class="table table-bordered">
<tr>
<th>S.No</th>
<th>Product Name</th>
<th>Image</th>
<th>Category</th>
<th>Price</th>
<th width="280px">Action</th>
</tr>
@foreach ($products as $product)
<tr>
<td>{{ $product->id }}</td>
<td>{{ $product->name }}</td>
<td><img src="<?php echo asset("storage/products/$product->image")?>"></img></td>
<td>{{ $product->category }}</td>
<td>{{ $product->price }} Rs</td>
<td>
<form action="{{ route('products.destroy',$product->id) }}" method="Post">
<a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
@csrf
@method('DELETE')
<button type="submit" class="btn btn-danger">Delete</button>
</form>
</td>
</tr>
@endforeach
</table>
{!! $products->links() !!}
</body>
</html>