<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Events\AttendanceUpdated;

echo "Testing broadcast...\n";
echo "BROADCAST_CONNECTION: " . config('broadcasting.default') . "\n";
echo "REVERB_APP_KEY: " . config('broadcasting.connections.reverb.key') . "\n";
echo "REVERB_HOST: " . config('broadcasting.connections.reverb.options.host') . "\n";
echo "REVERB_PORT: " . config('broadcasting.connections.reverb.options.port') . "\n";

echo "\nSending broadcast event...\n";
broadcast(new AttendanceUpdated(1, '2025-12-04'));
echo "Broadcast sent!\n";
