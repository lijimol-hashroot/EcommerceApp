<!DOCTYPE html>
<html>
<head>
    <title>Generate PDF using Laravel TCPDF - ItSolutionStuff.com</title>
</head>
<body>
<table>
  <tr>
    <th>Order ID:</th>
    <td>{{$orderid}}</td>
  </tr>
  <tr>
    <th>Products:</th>  
    <td>{{$productdetail}}</td>      
  </tr>  
  <tr>
    <th rowspan="2">Net amount:</th>
    <td>{{$total}}</td>
  </tr>
</table>
</body>
</html>