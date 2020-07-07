<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [        
        'ajax_dashbaord',
        'ajax_tracking_update',
        'ajax_direct_order',
        'ajax_order_products',
        'ajax_product_tracking',
        'ajax_import_po_csv',
        'ajax_get_apis'
    ];
}
