<?php

require_once 'vendor/autoload.php';
require_once 'bootstrap/app.php';

use Illuminate\Support\Facades\DB;

echo "=== ADMIN USERS INFORMATION ===\n\n";

try {
    // Check if admins table exists and get admin users
    $admins = DB::table('admins')->select('id', 'name', 'email', 'status', 'role_id', 'created_at', 'updated_at')->get();
    
    if ($admins->isEmpty()) {
        echo "No admin users found in the database.\n\n";
    } else {
        echo "Found " . $admins->count() . " admin user(s):\n\n";
        
        foreach ($admins as $admin) {
            echo "Admin ID: {$admin->id}\n";
            echo "Name: {$admin->name}\n";
            echo "Email: {$admin->email}\n";
            echo "Status: " . ($admin->status ? 'Active' : 'Inactive') . "\n";
            echo "Role ID: {$admin->role_id}\n";
            echo "Created: {$admin->created_at}\n";
            echo "Updated: {$admin->updated_at}\n";
            echo "---\n\n";
        }
    }
    
    // Also check roles table for context
    echo "=== ADMIN ROLES ===\n\n";
    $roles = DB::table('roles')->select('id', 'name', 'guard_name', 'created_at')->get();
    
    foreach ($roles as $role) {
        echo "Role ID: {$role->id}\n";
        echo "Name: {$role->name}\n";
        echo "Guard: {$role->guard_name}\n";
        echo "Created: {$role->created_at}\n";
        echo "---\n\n";
    }
    
} catch (Exception $e) {
    echo "Error querying database: " . $e->getMessage() . "\n";
}

echo "=== DEFAULT CREDENTIALS (FROM SEEDER) ===\n";
echo "Email: admin@example.com\n";
echo "Password: admin123\n\n";