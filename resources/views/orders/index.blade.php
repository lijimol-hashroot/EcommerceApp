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
<a class="btn btn-success" href="{{ route('orders.create') }}"> Create Order</a>
<a class="btn btn-success" href="{{ route('products.index') }}"> Product list</a>
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
<th>Order ID</th>
<th>Customer Name</th>
<th>Phone</th>
<th>Net Amount</th>
<th>Order Date</th>
<th width="280px">Action</th>
</tr>
@foreach ($orders as $order)
<tr>
<td>{{$loop->iteration}}</td>
<td>{{ $order->orderid }}</td>
<td>{{ $order->customer_name }}</td>
<td>{{ $order->phone }}</td>
<td>{{ $order->net_amount }}</td>
<td>{{ $order->created_at }}</td>
<td>
<form action="{{ route('orders.destroy',$order->id) }}" method="Post">
<a class="btn btn-primary" href="{{ route('orders.edit',$order->id) }}">Edit</a>
@csrf
@method('DELETE')
<button type="submit" class="btn btn-danger">Delete</button>
<a class="btn btn-primary" href="{{ route('invoice-generation',$order->orderid) }}">Invoice</a>
</form>
</td>
</tr>
@endforeach
</table>
{!! $orders->links() !!}
</body>
</html>