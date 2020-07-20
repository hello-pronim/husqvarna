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
        font-family: "Tahoma-Bold";
        font-style: bold;
        font-weight: 700;
        src: url('{{public_path('fonts/tahomabd.ttf')}}');
      }
      @font-face {
        font-family: "Verdana";
        font-style: normal;
        font-weight: 400;
        src: url('{{public_path('fonts/Verdana.ttf')}}');
      }   
      @font-face {
        font-family: "Ms Gothic";
        font-style: normal;
        font-weight: 400;
        src: url('{{public_path('fonts/mspgothic.ttf')}}');
      }
      *{ 
        font-family: arial;
        color: #3f3f3f;
      }
      @page { 
        margin: 65px 24px; 
        position: relative;
      }
      #pdf-header { 
        position: fixed; 
        left: 0px; 
        top: -71px; 
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
      table#table-order-detail{
        width: 100%;
        padding:0px;
        font-size:16px;        
        page-break-inside: avoid;
        border-collapse: collapse;
      }
      table#table-order-detail thead td{
        text-align:center;
        padding: 1px 20px;       
      }
      table#table-order-detail tbody tr{
        height: 64px;
        min-height: 64px;
      }
      table#table-order-detail tbody td{
        padding: 0px 1px;
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
      <table style="width: 100%; color:#000;">
        <tr class="fs-24">
          <td style="width:28%;">
            <span style="font-size: 25.5px; font-weight: 700; font-family: 'Tahoma-Bold'; margin-right:14px; color: #000;">Amazon</span> <span style="font-size: 21px; font-family:Verdana; color:#000; padding-bottom: 5px;">0715000</span>
          </td>
          <td align="center">
            <p>
              <span style="margin-right: 10px; margin-top: -5px; font-size: 21px; font-family: MS Gothic; color: #000;">配送先 : </span><span style="margin-right: 10px; font-size: 23px; font-family: Verdana; color: #000;">{{explode(" - ", $orders[0]->ship_location)[0]}}</span>
              <span style="margin-right: 14px; font-size: 21px; font-family: MS Gothic; color: #000;">コード : </span><span style="margin-right: 30px; font-size: 23.5px; font-family: Verdana; color: #000;">0715025</span>
            </p>
          </td>
          <td align="right">
            <span style="margin-right: 15px; margin-top: -5px; font-size: 19.5px; font-family: MS Gothic; color: #000;">出力日 : </span>
            <span style="margin-right: 15px; font-size: 18.5px; font-family: Verdana; color: #3f3f3f;">{{date('Y/m/d')}}</span>
            <span style="margin-right: 15px; font-size: 18.5px; font-family: Verdana; color: #3f3f3f;">{{date('H:i:s')}}</span>
          </td>
        </tr>
      </table>
    </div>
    <div id="pdf-body">      
    @if($page_count > 0)
      @for($i=0; $i<$page_count; $i++)
      <table class="table table-bordered" id="table-order-detail" style="color: #474747;">
        <thead>
          <tr>
            <td width="3%" style="max-width: 20px;"></td>
            <td style="font-family: 'Tahoma-Bold'; font-weight: 700; font-size: 16px; padding-left: 20px;"align="center" width="13%">PO</td>
            <td style="font-family: 'Ms Gothic'; font-size: 16px" width="16%">配送センター</td>
            <td style="font-family: 'Ms Gothic'; font-size: 16px" width="14%">ASIN</td>
            <td style="font-family: 'Ms Gothic'; font-size: 16px;" width="33%">商品名</td>
            <td style="font-family: 'Ms Gothic'; font-size: 16px" width="9%">数量</td>
            <td style="font-family: 'Ms Gothic'; font-size: 16px" width="12%">価格</td>
          </tr>
        </thead>
        <tbody>
        @for($j=0; $j<$limit_per_page; $j++)
          @if(isset($orders[$i*$limit_per_page+$j]))
          <tr>
            <td align="center" style="font-family: 'Verdana'; font-size: 16px;">{{$i*$limit_per_page+$j+1}}</td>
            <td align="center" style="font-family: 'Tahoma-Bold'; font-weight: bold; font-size: 15.5px;">{{$orders[$i*$limit_per_page+$j]->po}}</td>
            <td align="left" style="font-family: 'MS Gothic'; font-size: 16px;">{{$orders[$i*$limit_per_page+$j]->ship_location}}</td>
            <td align="center" style="font-family: 'Tahoma-Bold'; font-weight: bold; font-size: 15.5px;">{{$orders[$i*$limit_per_page+$j]->asin}}</td>
            <td align="left" style="font-family: 'MS Gothic'; font-size: 16px;">{{$orders[$i*$limit_per_page+$j]->title}}</td>
            <td align="right" style="font-family: 'Tahoma-Bold'; font-weight: bold; font-size: 22px; padding-right: 14px;">{{$orders[$i*$limit_per_page+$j]->quantity_request}}</td>
            <td align="right" style="font-family: 'Tahoma-Bold'; font-weight: bold; font-size: 16px; padding-right: 14px;">{{$orders[$i*$limit_per_page+$j]->unit_cost}}</td>
          </tr>
          @endif
        @endfor
        </tbody>
      </table>
      @if($i<$page_count-1)
      <div style="page-break-before: always;"></div>
      @endif
      @endfor
    @endif  
    </div>
  </body>
</html>