@php
    use Picqer\Barcode\BarcodeGeneratorPNG;
    $generator = new BarcodeGeneratorPNG();
    $barcodeData = 'REF:'.$out_id;
    $barcodeImage = 'data:image/png;base64,' . base64_encode($generator->getBarcode($barcodeData, $generator::TYPE_CODE_128));
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $barcodeData }} || Posting With Tembre EMS Mail Outboxing receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 4px;
            border: 1px solid black;
        }

        th {
            text-align: center;
        }

        .logo {
            text-align: center;
        }

        .logo img {
            max-width: 150px;
        }

        h3 {
            text-align: center;
        }

        .border-right {
            border-right: 1px solid black;
        }

        #barcode img {
            max-width: 100%;
        }

        .mt-3 {
            margin-top: 5px;
        }
        .postal-holder {
            border: 2px solid #000;
            padding: 10px;
            width: fit-content;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th colspan="3">Receipt</th>
        </tr>
        <tr>
            <td colspan="3" class="logo">
                <img src="{{ asset('logo/ems.jpg') }}" alt="" height="">
                <br>
                <b>RWANDA Express</b>
            </td>
        </tr>
        <tr>
            <td colspan="3" align="center">
                <h3>RECEIPT OF DEPOSIT OF AN POSTING WITH TEMBLE SHIPMENT</h3>
            </td>
        </tr>
        <tr>
            <td colspan="3" align="center">
                <b>{{ $barcodeData }}</b>
            </td>
        </tr>
        <tr>
            <td colspan="1">
                <h4>Sender Details</h4>
            </td>
            <td colspan="2">
                Names : {{ $pay->snames }} <br>
                Phone : {{ $pay->sphone }} <br>
                Email : {{ $pay->semail }} <br>
                Address : {{ $pay->saddress }} <br>

            </td>
        </tr>
        <tr>
            <td>
                <h4>Receiver Details</h4>
            </td>
            <td colspan="2">
                Names : {{ $pay->rnames }} <br>
                Country : {{ $pay->c_id }}<br>
                Phone : {{ $pay->rphone }} <br>
                Email : {{ $pay->remail }} <br>
                Address : {{ $pay->raddress }} <br>


            </td>
        </tr>
        <tr>
            <td class="border-right">
            Temble :{{ number_format($pay->temb_amount) }} Rwf
            </td>
            <td class="border-right">
                <table>

                    <tr>
                        <th>Weight</th>
                        <td>
                            {{-- envelop from outbox row  --}}
                            {{ number_format($pay->weight) }}
                        </td>
                    </tr>
                    <tr>
                        <th>Tax</th>
                        <td>
                            {{-- tax from outbox row  --}}
                            {{ number_format($pay->tax) }} Rwf
                        </td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <td>
                            {{-- total from outbox row  --}}
                            {{ number_format($pay->temb_amount )}} Rwf
                        </td>
                    </tr>
                </table>
            </td>
            <td>
                <div id="barcode" align="center">
                    <img src="{{ $barcodeImage }}" alt="Barcode">
                    <br>
                    {{ $barcodeData }}
                </div>
                <br>
                <b class="mt-3">Signature: .............</b>
            </td>
        </tr>
    </table>
</body>
</html>
