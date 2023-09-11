
<html>
<head>

<style>
body {font-family: sans-serif;
	font-size: 10pt;
}
.watermark {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) rotate(-45deg);
        opacity: 0.3;
        font-size: 30px;
        font-weight: bold;
        color: #CCCCCC;
        z-index: -1;
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

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;

}

td, th {
  border: 2px solid #110101;
  text-align: left;
  padding: 8px;


}

 .p3 {
  font-family: "Brush Script MT";
  color:blue;
}
</style>
</head>
<body>

    <div class="watermark">DISPATCH REPORT {{ date('M', mktime(0, 0, 0, $date, 1)) }}</div>
 <table width="100%">
<tr>
<td  width="25%">


<img src="{{ public_path('img/logo.png')  }}" alt="Girl in a jacket" width="100" height="100">

</td>
<td>
<h2 class="p3">REPUBLIC OF RWANDA</h2>
<h2 class="p3">NATIONAL POST OFFICE</h2>
<h2>B.P 4 KIGALI, TEL +250783626253</h2>
<h2>E-mail:info@i-posita.rw </h2>
<h2>Website: www.i-posita.rw</h2>


</td>
</tr>




</table>

<br>


<h1 style="text-align:center">DISPATCH  REPORT ON {{ date('M', mktime(0, 0, 0, $date, 1)) }} </h1>


 <br>


<table width="100%">


    <thead>
	 <tr>
	<th>#</th>
   <th class="sort" data-sort="name">
    Dispatch Number
</th>
<th >Gross Weight/kg</th>
<th >Dispatch Type</th>
<th >Item Number</th>
<th >Orgin Country</th>
<th >Current Weight/Kg</th>
 </tr>
    </thead>
    <tbody>

     @php
        $total = 0; // Initialize $total variable
    @endphp
    @foreach ($inboxings as $key => $inboxing)

 <tr>
 <td>{{ $key + 1 }}</td>
 <td ><a
    >{{ $inboxing->dispatchNumber }}</a>
</td>
<td >{{ $inboxing->grossweight }}</td>

<td>{{ $inboxing->dispachetype }}</td>
<td >{{ $inboxing->numberitem }}</td>
<td > {{ $inboxing->orgincountry }}</td>
<td >{{ $inboxing->currentweight }}</td>

@php
$total += $inboxing->currentweight;
@endphp
<tr>
 @endforeach
<tr>
<td  colspan="6"><b>TOTAL WEIGHT/Kg</b></td>
<td><b></b>{{ $total }} </td>

</tr>



	</tbody>

</table>







<br>


 <br>
 <br>

<table width="100%">
<tr>
<td> <b>PREPARED BY  </b> <br><br>
NAMES: <B> {{strtoupper(auth()->user()->name) }}</B><br><br>
Signature ----------------------------------------------<br><br>
Date -----------------------------------------------------</td>

</tr>
</table>
</body>


</html>

