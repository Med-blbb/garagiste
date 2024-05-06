<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .card {
            width: 100%;
            max-width: 800px;
            margin: 20px auto;
            border: 1px solid #ccc;
            border-radius: 5px;
            overflow: hidden;
        }

        .card-body {
            padding: 20px;
        }

        .company-details {
            text-align: right;
        }

        .company-details h2 {
            margin: 0;
        }

        .company-details div {
            margin-bottom: 5px;
        }

        .invoice-details {
            text-align: right;
        }

        .invoice-details h1 {
            margin: 0;
            font-size: 1.5em;
        }

        .contacts {
            margin-bottom: 20px;
        }

        .contacts .to {
            margin-top: 5px;
            font-size: 1.2em;
            color: #333;
        }

        .contacts .address {
            margin-bottom: 5px;
        }

        .contacts .email {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
        }

        th {
            background-color: #f0f0f0;
            text-align: left;
        }

        .thanks {
            margin-top: 20px;
            font-weight: bold;
        }

        .notices {
            margin-top: 20px;
        }

        .notices .notice {
            background-color: #f0f0f0;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="card-body">
            <div id="invoice">
                <div class="invoice overflow-auto">
                    <div style="min-width: 600px">
                        <header>
                            <div class="row">
                                <div class="col">
                                    <a href="javascript:;">
                                        {{-- <img src="{{ asset('assets/images/logo-icon.png') }}" alt="image-example" --}}
                                            
                                    </a>
                                </div>
                                <div class="col company-details">
                                    <h2 class="name">
                                        <a href="javascript:;">
                                            {{ config('app.name') }}
                                        </a>
                                    </h2>
                                    <div>455 Foggy Heights, AZ 85004, US</div>
                                    <div>(123) 456-789</div>
                                    <div>garagiste@example.com</div>
                                </div>
                            </div>
                        </header>
                        <main>
                            <div class="row contacts">
                                <div class="col invoice-to">
                                    <div class="text-gray-light">INVOICE TO:</div>
                                    <h2 class="to">{{ $invoice->client->name }}</h2>
                                    <div class="address">{{ $invoice->client->address }}</div>
                                    <div class="email"><a href="mailto:{{ $invoice->client->email }}">{{ $invoice->client->email }}</a></div>
                                </div>
                                <div class="col invoice-details">
                                    <h1 class="invoice-id">INVOICE {{ $invoice->id }}</h1>
                                    <div class="date">Date of Invoice: {{ $invoice->created_at }}</div>
                                    <div class="date">Due Date: {{ $invoice->dueDate }}</div>
                                </div>
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-left">DESCRIPTION</th>
                                        <th class="text-right">HOUR PRICE</th>
                                        <th class="text-right">HOURS</th>
                                        <th class="text-right">TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    console.log({{ $invoice->repair }});
                                    
                                    @if ($invoice->repair)
                                    @foreach ($invoice->repair as $repair)
                                        <tr>
                                            <td>{{ $repair->id }}</td>
                                            <td>{{ $repair->description }}</td>
                                            <td>{{ $repair->hourPrice }}</td>
                                            <td>{{ $repair->hours }}</td>
                                            <td>{{ $repair->total }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">No repairs found</td>
                                    </tr>
                                @endif

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">SUBTOTAL</td>
                                        <td>{{ $invoice->totalAmount }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">TAX 25%</td>
                                        <td>{{ $invoice->additionalCharges }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">GRAND TOTAL</td>
                                        <td>{{ $invoice->additionalCharges + $invoice->totalAmount }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="thanks">Thank you!</div>
                            <div class="notices">
                                <div>NOTICE:</div>
                                <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30
                                    days.
                                </div>
                            </div>
                        </main>
                        <footer>Invoice was created on a computer and is valid without the signature and seal.</footer>
                    </div>
                    <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                    <div></div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
