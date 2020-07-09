<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <style type="text/css">
      table#table-order-detail{
        border:1px solid #CCC;
        width: 100%;
        padding:0px;
        font-size:16px;
        table-collapse:collapse !important;
        page-break-inside: avoid;
      }
      table#table-order-detail td{
        border:1px solid #CCC;
        padding: 10px;
        height: 45px;
      }
      table#table-order-detail th{
        text-align:center;
        border:2px solid #CCC; 
      }
      @font-face {
        font-family: \'mgenplus\';
        font-style: normal;
        font-weight: 400;
        src: url(dompdf/fonts/MPLUSRounded1c-Regular.ttf);
      }
      *{ font-family: mgenplus !important;}
      @page { margin: 50px 50px; }
      #pdf-header { position: fixed; left: 0px; top: -50px; right: 0px; height: 50px;}
      .text-bold{
        font-weight: bold!important;
      }
      .pdf-header-item{display: inline-block;}
    </style>
  </head>
  <body>
    <div id="pdf-header">
      <table style="width: 100%">
        <tr>
          <td>
            <h3>Amazon <small>0715000</small></h3>
          </td>
          <td style="text-align: center;">
            <p>
              <span>配送先:</span><span style="margin-right: 20px">{{explode(" - ", $orders[0]->ship_location)[0]}}</span>
              <span>コード:</span><span>0715025</span>
            </p>
          </td>
          <td style="text-align: right;">
            <span>出力日: </span>
            <span>{{date('Y/m/d H:i:s')}}</span>
          </td>
        </tr>
      </table>
    </div>
    <div id="pdf-body">
      @for($i=0; $i<$page_count; $i++)
      <table class="table table-bordered" id="table-order-detail">
        <thead>
          <tr>
            <th></th>
            <th>PO</th>
            <th>配送センター</th>
            <th>ASIN</th>
            <th>商品名</th>
            <th>数量</th>
            <th>価格</th>
          </tr>
        </thead>
        <tbody>
        @for($j=0; $j<$limit_per_page; $j++)
          @if(isset($orders[$i*$limit_per_page+$j]))
          <tr>
            <td align="center">{{$i*$limit_per_page+$j+1}}</td>
            <td align="center" class="text-bold">{{$orders[$i*$limit_per_page+$j]->po}}</td>
            <td align="left">{{$orders[$i*$limit_per_page+$j]->ship_location}}</td>
            <td align="center" class="text-bold">{{$orders[$i*$limit_per_page+$j]->asin}}</td>
            <td align="left">{{$orders[$i*$limit_per_page+$j]->title}}</td>
            <td align="right" class="text-bold">{{$orders[$i*$limit_per_page+$j]->quantity_request}}</td>
            <td align="right" class="text-bold">{{$orders[$i*$limit_per_page+$j]->unit_cost}}</td>
          </tr>
          @endif
        @endfor
        </tbody>
      </table>
      @if($i<$page_count-1)
      <div style="page-break-before: always;"></div>
      @endif
      @endfor
    </div>
  </body>
</html>