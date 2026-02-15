<?php
// Simple script to generate models and migrations
$commands = [
    'Category', 'MenuItem', 'Order', 'OrderItem', 'Reservation', 'WebsiteSetting'
];

foreach ($commands as $model) {
    exec("php artisan make:model $model -m", $output, $return_var);
    echo "Created $model: " . implode("\n", $output) . "\n";
    $output = [];
}
?>
