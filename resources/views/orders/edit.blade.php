<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Order Form - Laravel 8 CRUD Tutorial</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
</head>
<body>
<div class="container mt-2">
<div class="row">
<div class="col-lg-12 margin-tb">
<div class="pull-left">
<h2>Edit Order</h2>
</div>
<div class="pull-right">
<a class="btn btn-primary" href="{{ route('orders.index') }}" enctype="multipart/form-data"> Back</a>
</div>
</div>
</div>
@if(session('status'))
<div class="alert alert-success mb-1 mt-1">
{{ session('status') }}
</div>
@endif
<form action="{{ route('orders.update',$order->id) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Customer Name:</strong>
<input type="text" name="customer_name" value="{{ $order->customer_name }}" class="form-control" placeholder="Product name">
@error('customer_name')
<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
@enderror
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Phone:</strong>
<input type="text" name="phone" value="{{$order->phone}}" class="form-control">
@error('phone')
<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
@enderror
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Products:</strong>
<select class="form-control" name="product">
@foreach($products as $prodt)
    <option value="{{$prodt->id}}" @if($prodt->id == $order->product_id) selected @endif>{{$prodt->name}}</option>
    @endforeach
</select>
@error('product')
<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
@enderror
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Quantity:</strong>
<input type="text" name="quantity" value="{{ $order->quantity }}" class="form-control" >
@error('quantity')
<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
@enderror
</div>
</div>
<button type="submit" class="btn btn-primary ml-3">Submit</button>
</div>
</form>
</div>
</body>
</html>
