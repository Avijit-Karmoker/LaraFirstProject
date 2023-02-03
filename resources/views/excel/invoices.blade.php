<table>
    <thead>
    <tr>
        <th>
            <b>Name</b>
        </th>
        <th><b>Email</b></th>
        <th><b>Customer Phone Number</b></th>
        <th><b>Customer Address</b></th>
        <th><b>Payment Method</b></th>
        <th><b>Payment Status</b></th>
        <th><b>Order Status</b></th>
        <th><b>After Discounted</b></th>
        <th><b>Shipping Charge</b></th>
        <th><b>Order Total</b></th>
    </tr>
    </thead>
    <tbody>
    @foreach($invoices as $invoice)
        <tr>
            <td>{{ $invoice->customer_name }}</td>
            <td>{{ $invoice->customer_email }}</td>
            <td>{{ $invoice->customer_phone_number }}</td>
            <td>{{ $invoice->customer_address }}</td>
            <td>{{ $invoice->payment_method }}</td>
            <td>{{ $invoice->payment_status }}</td>
            <td>{{ $invoice->order_status }}</td>
            <td>{{ $invoice->after_discount }}</td>
            <td>{{ $invoice->shipping_charge }}</td>
            <td>{{ $invoice->order_total }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
