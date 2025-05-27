<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends BaseController
{
    /**
     * Display a paginated list of services.
     */
    public function index(Request $request)
    {
        $limit = $request->get('limit', 15);
        $services = Service::select('id', 'name', 'category', 'price', 'description')
            ->paginate($limit);
        return $this->sendSuccessJson($services, "All services.", 200);
    }
}
