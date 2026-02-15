<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $order->order_number ?? '#' . $order->id }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 14px;
            color: #333;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            color: #555;
        }
        .header {
            display: flex; /* dompdf supports limited flexbox, might need table fallback */
            justify-content: space-between;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }
        table td {
            padding: 5px;
            vertical-align: top;
        }
        table tr td:nth-child(2) {
            text-align: right;
        }
        .top-table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }
        .heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }
        .item td {
            border-bottom: 1px solid #eee;
        }
        .item.last td {
            border-bottom: none;
        }
        .total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                @if($settings && $settings->logo)
                                    <img src="{{ public_path('storage/' . $settings->logo) }}" style="width:100%; max-width:150px;">
                                @else
                                    <h2>{{ $settings->restaurant_name ?? 'DinePro' }}</h2>
                                @endif
                            </td>
                            <td>
                                Invoice: {{ $order->order_number ?? '#' . $order->id }}<br>
                                Created: {{ $order->created_at->format('M d, Y') }}<br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                {{ $settings->restaurant_name ?? 'DinePro' }}<br>
                                {{ $settings->address ?? '123 Restaurant St.' }}<br>
                                {{ $settings->phone ?? '123-456-7890' }}
                            </td>
                            <td>
                                <strong>Bill To:</strong><br>
                                {{ $order->customer_name ?? 'Walk-in Customer' }}<br>
                                {{ $order->phone ?? '' }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="heading">
                <td>Item</td>
                <td>Price</td>
            </tr>
            
            @foreach($order->orderItems as $item)
            <tr class="item">
                <td>
                    {{ $item->menuItem->name ?? 'Deleted Item' }} <br>
                    <small>Qty: {{ $item->quantity }} x ${{ number_format($item->price, 2) }}</small>
                </td>
                <td>
                    ${{ number_format($item->quantity * $item->price, 2) }}
                </td>
            </tr>
            @endforeach
            
            <tr class="total">
                <td></td>
                <td>
                   Total: ${{ number_format($order->total_amount, 2) }}
                </td>
            </tr>
        </table>
        
        <br>
        <p style="text-align: center; font-size: 12px; color: #777;">Thank you for dining with us!</p>
    </div>
</body>
</html>
