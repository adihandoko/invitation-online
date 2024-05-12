<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class MigrationController extends Controller
{
    public function migrate()
    {
        // Run migrations
        Artisan::call('migrate');

        Artisan::call('db:seed');
        return response()->json(['message' => 'Migrations executed successfully']);
    }
}
