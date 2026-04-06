<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    // Daftar semua permission per role
    private array $defaultPermissions = [
        'admin' => [
            'order_management' => ['view_orders' => true,  'process_refunds' => true,  'delete_orders' => true],
            'catalog_control'  => ['create_products' => true, 'bulk_price_update' => true],
            'system_security'  => ['api_key_access' => true,  'two_factor_enforcement' => true],
        ],
        'staff' => [
            'order_management' => ['view_orders' => true,  'process_refunds' => false, 'delete_orders' => false],
            'catalog_control'  => ['create_products' => true, 'bulk_price_update' => false],
            'system_security'  => ['api_key_access' => false, 'two_factor_enforcement' => false],
        ],
        'user' => [
            'order_management' => ['view_orders' => true,  'process_refunds' => false, 'delete_orders' => false],
            'catalog_control'  => ['create_products' => false, 'bulk_price_update' => false],
            'system_security'  => ['api_key_access' => false, 'two_factor_enforcement' => false],
        ],
    ];

    private array $permissionLabels = [
        'order_management' => [
            'label'       => 'Order Management',
            'icon'        => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2',
            'permissions' => [
                'view_orders'      => ['label' => 'View Orders',      'desc' => 'Ability to see list of all orders and order details.'],
                'process_refunds'  => ['label' => 'Process Refunds',  'desc' => 'Authorize and issue monetary refunds to customers.'],
                'delete_orders'    => ['label' => 'Delete Order Records', 'desc' => 'Permanently remove order history from the database.'],
            ],
        ],
        'catalog_control' => [
            'label'       => 'Catalog Control',
            'icon'        => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4',
            'permissions' => [
                'create_products'   => ['label' => 'Create Products',   'desc' => 'Add new products, variants, and stock levels.'],
                'bulk_price_update' => ['label' => 'Bulk Price Update', 'desc' => 'Modify pricing for multiple items via CSV or batch editor.'],
            ],
        ],
        'system_security' => [
            'label'       => 'System Security',
            'icon'        => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
            'permissions' => [
                'api_key_access'         => ['label' => 'API Key Access',          'desc' => 'Generate and manage developer API credentials.'],
                'two_factor_enforcement' => ['label' => 'Two-Factor Enforcement',  'desc' => 'Require all users with this role to use 2FA.'],
            ],
        ],
    ];

    public function index(string $role = 'admin')
    {
        $role        = in_array($role, ['admin','staff','user']) ? $role : 'admin';
        $permissions = session("permissions.$role", $this->defaultPermissions[$role]);
        $labels      = $this->permissionLabels;

        return view('admin.permissions.index', compact('role','permissions','labels'));
    }

    public function update(Request $request, string $role)
    {
        $role = in_array($role, ['admin','staff','user']) ? $role : 'admin';

        // Bangun array permission dari checkbox yang disubmit
        $saved = [];
        foreach ($this->permissionLabels as $group => $groupData) {
            foreach ($groupData['permissions'] as $key => $permData) {
                $saved[$group][$key] = $request->boolean("permissions.$group.$key");
            }
        }

        // Simpan ke session (di produksi bisa ke database/config)
        session(["permissions.$role" => $saved]);

        return redirect()->route('admin.permissions', $role)
            ->with('success', 'Permission untuk role ' . ucfirst($role) . ' berhasil disimpan.');
    }
}
