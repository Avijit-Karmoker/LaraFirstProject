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
        }
        .invoice{
            max-width: 600px;
            margin: auto;
            background: #f1f2f6;
            margin-top: 5px;
            padding: 25px;
            border-radius: 8px;
            height: 700px;
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
            font-size: 1.6em;
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
</head>
<body>
    <div>
        <div class="invoice">
            <div class="invoice-header">
                <div class="company-logo">
                    <img src="https://i.ibb.co/54qPZ08/logo-1x.png" alt="company logo">
                </div>
                <div class="text">
                    <h3>Company Name</h3>
                    <p>address</p>
                    <p>company phone</p>
                    <p>company email</p>
                </div>
            </div>
            <hr>
            <div class="client-invoice">
                <div class="client">
                    <div class="to">INVOICE TO:</div>
                    <h3 class="name">John Doe</h3>
                    <div class="address">796 Silver Harbour, TX 79273, US</div>
                    <div class="email"><a href="mailto:john@example.com">john@example.com</a></div>
                </div>
                <div class="invoice-issue">
                    <h2>INVOICE Issue</h2>
                    <div class="date">Date of Invoice: 01/06/2014</div>
                    <div class="date">Due Date: 30/06/2014</div>
                </div>
            </div>
            <table cellspacing="0" cellpadding="0">
                <thead>
                  <tr>
                    <th class="no">#</th>
                    <th class="desc">DESCRIPTION</th>
                    <th class="unit">UNIT PRICE</th>
                    <th class="qty">QUANTITY</th>
                    <th class="total">TOTAL</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="no">01</td>
                    <td class="desc">
                        <p>Website Design</p>
                    </td>
                    <td class="unit">$40.00</td>
                    <td class="qty">30</td>
                    <td class="total">$1,200.00</td>
                  </tr>
                  <tr>
                    <td class="no">02</td>
                    <td class="desc">
                        <p>Website Development</p>
                    </td>
                    <td class="unit">$40.00</td>
                    <td class="qty">80</td>
                    <td class="total">$3,200.00</td>
                  </tr>
                  <tr>
                    <td class="no">03</td>
                    <td class="desc">
                        <p>Search Engines Optimization</p>
                    </td>
                    <td class="unit">$40.00</td>
                    <td class="qty">20</td>
                    <td class="total">$800.00</td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="2"></td>
                    <td colspan="2">SUBTOTAL</td>
                    <td>$5,200.00</td>
                  </tr>
                  <tr>
                    <td colspan="2"></td>
                    <td colspan="2">TAX 25%</td>
                    <td>$1,300.00</td>
                  </tr>
                  <tr>
                    <td colspan="2"></td>
                    <td colspan="2">GRAND TOTAL</td>
                    <td>$6,500.00</td>
                  </tr>
                </tfoot>
              </table>
        </div>
    </div>
</body>
</html>
