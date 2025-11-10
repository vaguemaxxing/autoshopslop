<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <?php
        require_once 'items.php';
        
        $quantities = [];
        $subtotals = [];
        $itemDiscounts = [];

        
        $totalLineTotal = 0.0;

        
        $totalAfterItemDiscounts = 0.0;

        
        foreach ($items as $itemId => $itemData) {
            $quantities[$itemId] = $_POST[$itemId] ?? 0;
        }

        
        foreach ($items as $itemId => $itemData) {
            $qty = (int)$quantities[$itemId];
            $lineTotal = $itemData['price'] * $qty;
            $itemDiscount = 0.0;
            
            
            if ($qty >= 5) {
                $itemDiscount = $lineTotal * 0.10;
            }
            
            $subtotalAfterItemDiscount = $lineTotal - $itemDiscount;
            
            $itemDiscounts[$itemId] = $itemDiscount;
            $subtotals[$itemId] = $subtotalAfterItemDiscount;

            
            $totalLineTotal += $lineTotal;
            $totalAfterItemDiscounts += $subtotalAfterItemDiscount;
        }

       
        $totalItemDiscounts = $totalLineTotal - $totalAfterItemDiscounts;

        
        $bulkDiscount = $totalAfterItemDiscounts > 500 ? $totalAfterItemDiscounts * 0.05 : 0;
        $totalAfterBulkDiscount = $totalAfterItemDiscounts - $bulkDiscount;

        
        $tax = $totalAfterBulkDiscount * 0.12;
        $finalTotal = $totalAfterBulkDiscount - $tax;

        echo "<h1>Auto Parts Store</h1>";
        echo "<h3>Order Results</h3>";
        echo "<p>Order processed on: " . date('Y-m-d H:i:s') . "</p>";
        echo "<h4>Your order is as follows:</h4>";
        
        foreach ($quantities as $itemId => $qty) {
            if ($qty > 0) {
                $name = $items[$itemId]['name'];
                $price = $items[$itemId]['price'];
                $lineTotal = $price * $qty;
                $itemDisc = $itemDiscounts[$itemId];
                $subtotalAfter = $subtotals[$itemId];
                
                echo "<div class='mb-2'>";
                echo "<p><strong>{$name}</strong>: {$qty} x $" . number_format($price,2) . " = $" . number_format($lineTotal,2) . "</p>";
                if ($itemDisc > 0) {
                    echo "<p class='text-success'>Quantity Discount (10%): -$" . number_format($itemDisc,2) . "</p>";
                }
                echo "<p>Subtotal after item discount: $" . number_format($subtotalAfter,2) . "</p>";
                echo "</div>";
            }
        }

        echo "<hr>";

       
        echo "<strong><p>Total Before Discounts: $" . number_format($totalLineTotal, 2) . "</p></strong>";

        if ($totalItemDiscounts > 0) {
            echo "<p>Total Quantity Discounts: -$" . number_format($totalItemDiscounts, 2) . "</p>";
        } else {
            echo "<p>Total Quantity Discounts: $0.00</p>";
        }

        echo "<strong><p>Subtotal after item discounts: $" . number_format($totalAfterItemDiscounts, 2) . "</p></strong>";

        if ($bulkDiscount > 0) {
            echo "<p>Bulk Discount (5%): -$" . number_format($bulkDiscount, 2) . "</p>";
        } else {
            echo "<p>Bulk Discount (5%): $0.00</p>";
        }

        echo "<strong><p>After all discounts (before tax): $" . number_format($totalAfterBulkDiscount, 2) . "</p></strong>";
        echo "<p>Tax (12%): $" . number_format($tax, 2) . "</p>";
        echo "<p><strong>Gross Total: $" . number_format($finalTotal, 2) . "</strong></p>";
        ?>
        <a href="index.html" class="btn btn-primary mt-3">Place Another Order</a>
    </div>
</body>
</html>
