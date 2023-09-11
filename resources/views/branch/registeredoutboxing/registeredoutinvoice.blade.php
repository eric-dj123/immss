<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice</title>
<style>
body {font-family: sans-serif;
	font-size: 10pt;
}
p {	margin: 0pt; }
table.items {
	border: 0.1mm solid #000000;
}
td { vertical-align: top; }
.items td {
	border-left: 0.1mm solid #000000;
	border-right: 0.1mm solid #000000;
}
table thead td { background-color: #EEEEEE;
	text-align: center;
	border: 0.1mm solid #000000;
	font-variant: small-caps;
}
.items td.blanktotal {
	background-color: #EEEEEE;
	border: 0.1mm solid #000000;
	background-color: #FFFFFF;
	border: 0mm none #000000;
	border-top: 0.1mm solid #000000;
	border-right: 0.1mm solid #000000;
}
.items td.totals {
	text-align: right;
	border: 0.1mm solid #000000;
}
.items td.cost {
	text-align: "." center;
}
.watermark {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) rotate(-45deg);
        opacity: 0.3;
        font-size: 50px;
        font-weight: bold;
        color: #5c5c5c;
        z-index: -1;
    }
</style>
</head>
<body>
    <div class="watermark">IPOSITA</div>

<htmlpageheader name="myheader">
<table width="100%"><tr>
<td width="100%" style="color:#0000BB; "><span style="font-weight: bold; font-size: 11pt;">NATIONAL POST OFFICE</span><br> E-mail :info@i-posita.rw<br /> TEL : 250-0252582703 <br> B.P. 4 KIGALI
<br /> Website: www.i-posita.rw </td>
</tr></table>



</htmlpageheader>
<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
<sethtmlpagefooter name="myfooter" value="on" />
@foreach ($inboxings as $key => $inboxing)
<center><u><h2>DEPPOT RECEIPT OF AN PERCEL SHIPMENT No: {{ $inboxing->out_id}}</h2><u></center><br>

<div style="font-weight: bold; font-size: 12pt;" ></div>
<p>SENDER:  {{ $inboxing->snames }}, {{ $inboxing->sphone }}, {{ $inboxing->saddress }}</p><br>
<P>RECEIVER: {{ $inboxing->rnames }}, {{ $inboxing->rphone }} ,{{ $inboxing->raddress }}</P><br>

<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
<thead>
<tr>
	<td>Weight /g</td>
    <td>Tax</td>
   <td>Carton</td>
   <td>Postage</td>
  <td>Total</td>
</tr>
</thead>
<tbody>



<tr>
    <td>{{ $inboxing->weight }} </td>
    <td>{{ number_format($inboxing->tax) }}</td>
    <td>{{ number_format($inboxing->postage) }}</td>
    <td>{{ number_format($inboxing->amount) }}</td>
    <td>{{ number_format($inboxing->postage + $inboxing->amount) }}</td>


</tr>

</tbody>
</table>
<br>
<div > Done at Kigali on {{ $inboxing->created_at->format('Y-m-d') }}</div>
<div >Cashier:{{ auth()->user()->name}}</div>
<div > Cashier Signature........................</div>
<hr>
@endforeach
</body>


</html>
