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
        font-size: 70px;
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
  border: 1px solid #dddddd;
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
<div class="watermark">ORDINARY MAIL TRANSFER</div>
 <table width="100%">
<tr>
<td  width="25%">
 <img src="{{ public_path('assets/logo.png') }} " alt="Girl in a jacket" width="100" height="100">
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


<h1 style="text-align:center">MAIL TRANSFER FORM NO: MT   </h1>


 <br>


<table width="100%">


    <thead>
	 <tr>
	<th>#</th>
     <th  width="15%">MAIL CODE </th>
	  <th>NAMES</th>
	  <th>PHONE</th>
	  <th>DATE</th>
	  <th>CHECKING</th>
     </tr>
    </thead>

     <tbody>
            @foreach ($inboxings as $key => $inboxing)
            <tr>
                <th scope="row">
                     {{ $key + 1 }}
                </th>
                <td >{{ $inboxing->innumber }}</a></td>
                <td >{{ $inboxing->intracking }}</td>
                <td >{{ $inboxing->inname }}</td>
                <td >{{ $inboxing->phone }}</td>
                <td >{{ $inboxing->pob }}</td>

            </tr>

<tr>





	</tbody>
</table>







<br>




Done a Kigali on ''
 <br>
 <br>
 @endforeach
<table width="100%">
<tr>
<td> <b>CNTP STAFF  </b> <br><br>
NAMES ---------------------------------------------------<br><br>
Signature ----------------------------------------------<br><br>
Date -----------------------------------------------------</td>
<td><b>BRANCH STAFF </b> <br><br>

</tr>
</table>
</body>


</html>