<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <style type="text/css">
      @font-face {
        font-family: \'mgenplus\';
        font-style: normal;
        font-weight: 400;
        src: url(dompdf/fonts/rounded-mgenplus-1c-regular.ttf);
       }
      .ft0{font: 14px;line-height: 16px;}
      *{ font-family: mgenplus !important;}
      table{
        border:1px solid #000;
        padding:0px;
        font-size:10px;
        table-collapse:collapse !important;
      }
      table td{
          text-align:center;
          border:1px solid #000;
      }
    </style>
  </head>
  <body>
    <div id="pdf-header">
    </div>
    <div id="pdf-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th></th>
            <th>PO</th>
            <th>配送センター</th>
            <th>ASIN</th>
            <th>商品名</th>
            <th>数量</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($orders as $index=>$order)
            @if(($index+1)%10===0)
             <p style="page-break-after: always;"></p>
            @endif
          <tr>
            <td>{{$index+1}}</td>
            <td>{{$order->po}}</td>
            <td>{{$order->ship_location}}</td>
            <td>{{$order->asin}}</td>
            <td>{{$order->title}}</td>
            <td>{{$order->quantity_request}}</td>
            <td>{{$order->unit_cost}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </body>
</html>