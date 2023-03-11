<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">p;
<meta charset="UTF-8">
<title>Add Product Form - Laravel 8 CRUD</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
</head>
<body>
<div class="container mt-2">
<div class="row">
<div class="col-lg-12 margin-tb">
<div class="pull-left mb-2">
<h2>Add Product</h2>
</div>
<div class="pull-right">
<a class="btn btn-primary" href="{{ route('orders.index') }}"> Back</a>
</div>
</div>
</div>
@if(session('status'))
<div class="alert alert-success mb-1 mt-1">
{{ session('status') }}
</div>
@endif
<form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
@csrf
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Customer Name:</strong>
<input type="text" name="customer_name" class="form-control" placeholder="customer name">
@error('customer_name')
<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
@enderror
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Phone:</strong>
<input type="text" name="phone" class="form-control" placeholder="customer phone" >
@error('phone')
<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
@enderror
</div>
</div>
<div class="mb-3 input-group repeatDiv" id="repeatDiv">
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Products:</strong>
<select class="form-control" name="product[]">
    @foreach($products as $product)
    <option value="{{$product->id}}">{{$product->name}}</option>
    @endforeach
</select>
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Quantity:</strong>
<input type="text" name="quantity[]" class="form-control" placeholder="quantity">

</div>
</div>
	    		</div>

	    		<button type="button" class="btn btn-info" id="repeatDivBtn" data-increment="1">Add More Input</button> 


<button type="submit" class="btn btn-primary ml-3">Submit</button>
</div>
</form>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {

$("#repeatDivBtn").click(function () {

    $newid = $(this).data("increment");
    $repeatDiv = $("#repeatDiv").wrap('<div/>').parent().html();
    $('#repeatDiv').unwrap();
    $($repeatDiv).insertAfter($(".repeatDiv").last());
    $(".repeatDiv").last().attr('id',   "repeatDiv" + '_' + $newid);
    $("#repeatDiv" + '_' + $newid).append('<div class="input-group-append"><button type="button" class="btn btn-danger removeDivBtn" data-id="repeatDiv'+'_'+ $newid+'">Remove</button></div>');
    $newid++;
    $(this).data("increment", $newid);

});


$(document).on('click', '.removeDivBtn', function () {

    $divId = $(this).data("id");
    $("#"+$divId).remove();
    $inc = $("#repeatDivBtn").data("increment");
    $("#repeatDivBtn").data("increment", $inc-1);

});

});
    </script>
</body>
</html>