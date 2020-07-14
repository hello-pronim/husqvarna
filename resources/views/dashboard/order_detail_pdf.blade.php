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
        width: 100%;
        padding:0px;
        font-size:16px;
        table-collapse:collapse !important;
        page-break-inside: avoid;
      }
      table#table-order-detail thead td{
        text-align:center;
        border:3px solid #CCC; 
      }
      table#table-order-detail tbody td{
        border:2px solid #CCC;
        padding: 10px;
        height: 45px;
      }
      @font-face {
        font-family: mspgothic;
        font-style: normal;
        font-weight: 400;
        src: url('{{public_path('fonts/mspgothic.ttf')}}');
      }
      @font-face {
        font-family: kochi-gothic;
        font-style: normal;
        font-weight: 400;
        src: url('{{public_path('fonts/kochi-gothic-subst.ttf')}}');
      }
      @font-face {
        font-family: kochi-mincho;
        font-style: normal;
        font-weight: 400;
        src: url('{{public_path('fonts/kochi-mincho-subst-original.ttf')}}');
      }
      @font-face {
        font-family: tahoma;
        font-style: normal;
        font-weight: 400;
        src: url('{{public_path('fonts/Tahoma Regular font.ttf')}}');
      }
      *{ 
        font-family: mspgothic, kochi-gothic, kochi-mincho, tahoma !important;
        color: #3E3E3E;
      }
      @page { margin: 60px 30px; }
      #pdf-header { position: fixed; left: 0px; top: -50px; right: 0px; height: 50px;}
      .text-bold{
        font-weight: bold!important;
      }
      .text-black{
        color: black!important;
      }
      .fs-24{
        font-size: 24px!important;
      }
      .fs-20{
        font-size: 20px!important;
      }
      .fs-16{
        font-size: 16px!important;
      }
      .fs-14{
        font-size: 14px!important;
      }
      .mr-20{
        margin-right: 20px!important;
      }
      .pdf-header-item{display: inline-block;}
    </style>
  </head>
  <body>
    <div id="pdf-header">
      <table style="width: 100%">
        <tr class="text-black fs-20">
          <td>
            <span class="fs-24 text-bold mr-20">Amazon</span><span>0715000</span>
          </td>
          <td style="text-align: center;">
            <p>
              <span>配送先:</span><span class="mr-20">{{explode(" - ", $orders[0]->ship_location)[0]}}</span>
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
            <td></td>
            <td>PO</td>
            <td>配送センター</td>
            <td>ASIN</td>
            <td>商品名</td>
            <td>数量</td>
            <td>価格</td>
          </tr>
        </thead>
        <tbody>
        @for($j=0; $j<$limit_per_page; $j++)
          @if(isset($orders[$i*$limit_per_page+$j]))
          <tr class="fs-16">
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