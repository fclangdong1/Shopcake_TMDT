<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf_token" content="{ csrf_token() }" />
    <title>Cửa Hàng Bánh</title>
</head>
<body onload="window.print();">
<div id="page" class="page">
    <div class="header">
        <div class="logo"><img style="height:100px; width:100px" src="{{asset('source/assets/dest/images/logo-cake.png')}}"/></div>
        <div class="company">Shop bán bánh online</div>
    </div>
  <br/>
  <div class="title">
        HÓA ĐƠN THANH TOÁN
        <br/>
        -------oOo-------
  </div>
  <br/>
  <br/>
  @php $count=1; @endphp
  <table class="TableData">
    <tr>
      <th>STT</th>
      <th>Tên</th>
      <th>Đơn giá</th>
      <th>Số</th>
      <th>Thành tiền</th>
    </tr>
	@foreach($product as $value)
	<tr>
		<td align="center">{{$count}}</td>
		<td align="left">{{$value->name}}</td>
		<td align="right">{{number_format($value->unit_price)}}</td>
		<td align="center">{{$value->quantity}}</td>
		<td align="right">{{number_format($value->price,0,",",".")}}</td>
	</tr>
	@php $count++; @endphp
	@endforeach	
    <tr>
      <td colspan="4" class="tong">Tổng cộng</td>
      <td class="cotSo">{{number_format($bill->total,0,",",".")}}</td>
    </tr>
  </table>
 
  <div class="footer-left"><div id="timercheck"></div> <br/>
    Khách hàng 
	<br/>
	{{$bill->customer->fullname}}
	</div>
</div>
<script type="text/javascript">
        var today = new Date();//khai báo biến thời gian.

       //lấy thời gian hiện tại
       var y = today.getFullYear();//lấy dữ liệu ra
      var m = today.getMonth()+1;
      var d = today.getDate();
      //in thời gian ra màn hình, lấy thời gian hiện tại
     document.getElementById('timercheck').innerHTML = 'Sài Gòn, Ngày '+d+' Tháng '+m+' Năm '+y;
</script>
		<style>
		body {
				margin: 0;
				padding: 0;
				background-color: #FAFAFA;
				font: 12pt "Tohoma";
			}
			* {
				box-sizing: border-box;
				-moz-box-sizing: border-box;
			}
			.page {
				width: 21cm;
				overflow:hidden;
				min-height:297mm;
				padding: 2.5cm;
				margin-left:auto;
				margin-right:auto;
				background: white;
				box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
			}
			.subpage {
				padding: 1cm;
				border: 5px red solid;
				height: 237mm;
				outline: 2cm #FFEAEA solid;
			}
			 @page {
			 size: A4;
			 margin: 0;
			}
			button {
				width:100px;
				height: 24px;
			}
			.header {
				overflow:hidden;
			}
			.logo {
				background-color:#FFFFFF;
				text-align:left;
				float:left;
			}
			.company {
				padding-top:24px;
				text-transform:uppercase;
				background-color:#FFFFFF;
				text-align:right;
				float:right;
				font-size:16px;
			}
			.title {
				text-align:center;
				position:relative;
				color:#0000FF;
				font-size: 24px;
				top:1px;
			}
			.footer-left {
				text-align:center;
				text-transform:uppercase;
				padding-top:24px;
				position:relative;
				height: 150px;
				width:50%;
				color:#000;
				float:left;
				font-size: 12px;
				bottom:1px;
			}
			.footer-right {
				text-align:center;
				text-transform:uppercase;
				padding-top:24px;
				position:relative;
				height: 150px;
				width:50%;
				color:#000;
				font-size: 12px;
				float:right;
				bottom:1px;
			}
			.TableData {
				background:#ffffff;
				font: 11px;
				width:100%;
				border-collapse:collapse;
				font-family:Verdana, Arial, Helvetica, sans-serif;
				font-size:12px;
				border:thin solid #d3d3d3;
			}
			.TableData TH {
				background: rgba(0,0,255,0.1);
				text-align: center;
				font-weight: bold;
				color: #000;
				border: solid 1px #ccc;
				height: 24px;
			}
			.TableData TR {
				height: 24px;
				border:thin solid #d3d3d3;
			}
			.TableData TR TD {
				padding-right: 2px;
				padding-left: 2px;
				border:thin solid #d3d3d3;
			}
			.TableData TR:hover {
				background: rgba(0,0,0,0.05);
			}
			.TableData .cotSTT {
				text-align:center;
				width: 10%;
			}
			.TableData .cotTenSanPham {
				text-align:left;
				width: 40%;
			}
			.TableData .cotHangSanXuat {
				text-align:left;
				width: 20%;
			}
			.TableData .cotGia {
				text-align:right;
				width: 120px;
			}
			.TableData .cotSoLuong {
				text-align: center;
				width: 50px;
			}
			.TableData .cotSo {
				text-align: right;
				width: 120px;
			}
			.TableData .tong {
				text-align: right;
				font-weight:bold;
				text-transform:uppercase;
				padding-right: 4px;
			}
			.TableData .cotSoLuong input {
				text-align: center;
			}
			@media print {
			 @page {
			 margin: 0;
			 border: initial;
			 border-radius: initial;
			 width: initial;
			 min-height: initial;
			 box-shadow: initial;
			 background: initial;
			 page-break-after: always;
			}
			}
		</style>
</body>
</html>
