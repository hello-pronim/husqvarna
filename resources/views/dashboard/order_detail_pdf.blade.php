<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <style type="text/css">
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
      @font-face {
        font-family: arial;
        font-style: normal;
        font-weight: 400;
        src: url('{{public_path('fonts/arial.ttf')}}');
      }
      *{ 
        font-family: mspgothic!important;
        color: #3E3E3E;
      }
      @page { 
        margin: 72px 24px; 
        position: relative;
      }
      #pdf-header { 
        position: fixed; 
        left: 0px; 
        top: -64px; 
        right: 0px; 
        height: 36px;
        line-height: 36px;
      }
      .text-bold{
        font-weight: bold!important;
      }
      .text-black{
        color: black!important;
      }
      .p-0-15{
        padding: 0px 15px!important;
      }
      .p-0-20{
        padding: 0px 20px!important;
      }
      .fs-28{
        font-size: 28px!important;
      }
      .fs-24{
        font-size: 24px!important;
      }
      .fs-20{
        font-size: 20px!important;
      }
      .fs-18{
        font-size: 18px!important;
      }
      .fs-16{
        font-size: 16px!important;
      }
      .fs-14{
        font-size: 14px!important;
      }
      .mr-30{
        margin-right: 30px!important;
      }
      .mr-20{
        margin-right: 20px!important;
      }
      table#table-order-detail{
        width: 100%;
        padding:0px;
        font-size:16px;
        table-collapse:collapse !important;
        page-break-inside: avoid;
      }
      table#table-order-detail thead td{
        text-align:center;
        padding: 5px 20px;
      }
      table#table-order-detail tbody tr{
        height: 64px;
        min-height: 64px;
      }
      table#table-order-detail tbody td{
        padding: 0px 5px;
        height: 64px;
        min-height: 64px;
        vertical-align: top;
      }
      .pdf-header-item{
        display: inline-block;
      }
    </style>
  </head>
  <body>
    <div id="pdf-header">
      <table style="width: 100%">
        <tr class="fs-24">
          <td>
            <span class="fs-28 text-black text-bold mr-30">Amazon</span><span class="fs-24">0715000</span>
          </td>
          <td align="center">
            <p class="text-black">
              <span class="mr-20">配送先:</span><span class="mr-30 fs-24">{{explode(" - ", $orders[0]->ship_location)[0]}}</span>
              <span class="mr-20">コード:</span><span class="fs-24">0715025</span>
            </p>
          </td>
          <td class="fs-20" align="right">
            <span class="mr-20 text-black">出力日: </span>
            <span class="mr-20">{{date('Y/m/d')}}</span>
            <span class="mr-20">{{date('H:i:s')}}</span>
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
            <td><b>PO</b></td>
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
            <td align="center" class="text-bold p-0-20">{{$orders[$i*$limit_per_page+$j]->po}}</td>
            <td align="left">{{$orders[$i*$limit_per_page+$j]->ship_location}}</td>
            <td align="center" class="text-bold p-0-20">{{$orders[$i*$limit_per_page+$j]->asin}}</td>
            <td align="left">{{$orders[$i*$limit_per_page+$j]->title}}</td>
            <td align="right" class="text-bold fs-24 p-0-15">{{$orders[$i*$limit_per_page+$j]->quantity_request}}</td>
            <td align="right" class="text-bold fs-20 p-0-15">{{$orders[$i*$limit_per_page+$j]->unit_cost}}</td>
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