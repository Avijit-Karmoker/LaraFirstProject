<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body{
            margin: 0;
            padding: 0;
            font-family: 'Times New Roman', Times, serif !important;
        }
        .invoice{
            max-width: 600px;
            margin: auto;
            background: #f1f2f6;
            margin-top: 5px;
            padding: 25px;
            border-radius: 8px;
        }
        .invoice-header{
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .invoice-header h3{
            margin: 0;
        }
        .invoice-header p{
            margin: 0;
        }
        .invoice-header .text{
            text-align: right;
        }
        .client{
            padding-left: 6px;
            border-left: 6px solid #0087C3;
            float: left;
        }
        .client h3{
            margin: 0;
        }
        .client-invoice{
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 0;
        }
        .invoice-issue h2{
            margin: 0;
        }
        table{
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }
        table .no{
            color: #FFFFFF;
            font-size: 1.3em;
            background: #57B223;
        }
        table .total{
            background: #57B223;
            color: #FFFFFF;
        }
        table th {
            white-space: nowrap;
            font-weight: normal;
            background: #dfe4ea;
        }
        table th, table td{
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #FFFFFF;
        }
        .desc{
            text-align: left;
            background: #dfe4ea;
        }
        .unit{
            background: #d6d1d1;
        }
        .qty{
            background: #dfe4ea;
        }
        table tfoot tr td:first-child {
            border: none;
        }
        tfoot td{
            padding: 10px 20px;
            border-bottom: none;
            font-size: 1.2em;
            white-space: nowrap;
            border-top: 1px solid #AAAAAA;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <div>
        <div class="invoice">
            <div class="invoice-header">
                <div class="company-logo">
                    <img src="https://www.freepnglogos.com/uploads/original-samsung-logo-10.png" width="150" alt="company logo">
                </div>
                <div class="text">
                    <h3>Samsung</h3>
                    <p>Dhaka, Bangladesh</p>
                    <p>+88 09612300300</p>
                    <p>feedback.bd@samsung.com</p>
                </div>
            </div>
            <hr>
            <div class="client-invoice">
                <div class="client">
                    <div class="to">INVOICE TO:</div>
                    <h3 class="name">{{ Str::title($invoice->customer_name) }}</h3>
                    <div class="address">{{ $invoice->customer_address }}, {{ Str::upper($invoice->customer_country_id) }}</div>
                    <div class="email"><a href="mailto:john@example.com">{{ $invoice->customer_email }}</a></div>
                </div>
                <div class="invoice-issue">
                    <h2>INVOICE Issue</h2>
                    <div class="date">Date of Invoice: {{ \Carbon\Carbon::now()->format("d/m/Y") }}</div>
                    <div class="date">Due Date: {{ $invoice->created_at->format("d/m/Y") }}</div>
                </div>
            </div>
            <table cellspacing="0" cellpadding="0">
                <thead>
                  <tr>
                    <th class="no">ID</th>
                    <th class="desc">DESCRIPTION</th>
                    <th class="unit">UNIT PRICE</th>
                    <th class="qty">QUANTITY</th>
                    <th class="total">TOTAL</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($invoice_details as $invoice_detail)
                    <tr>
                      <td class="no">#{{ $invoice_detail->product_id }}</td>
                      <td class="desc">
                          <p>{{ $invoice_detail->relationshipwithproduct->product_name }}</p>
                      </td>
                      <td class="unit">৳{{ $invoice_detail->unit_price }}</td>
                      <td class="qty">{{ $invoice_detail->quantity }}</td>
                      <td class="total">৳{{ $invoice_detail->unit_price * $invoice_detail->quantity }}</td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="2"></td>
                    <td colspan="2" class="text-start">SUBTOTAL</td>
                    <td style="font-size: 16px;">৳{{ $invoice->after_discount }}</td>
                  </tr>
                  <tr>
                    <td colspan="2"></td>
                    <td colspan="2" class="text-start">SHIPPING CHARGE</td>
                    <td style="font-size: 16px;">৳{{ $invoice->shipping_charge }}</td>
                  </tr>
                  <tr>
                    <td colspan="2"></td>
                    <td colspan="2" class="text-start">GRAND TOTAL</td>
                    <td style="font-size: 16px;">৳{{ $invoice->order_total }}</td>
                  </tr>
                </tfoot>
              </table>
        </div>
    </div>
</body>
</html>
