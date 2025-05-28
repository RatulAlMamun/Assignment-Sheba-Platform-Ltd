<?php

namespace App\Http\Controllers\Api;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\BaseController;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;

class ServiceController extends BaseController
{
    public function index(Request $request): JsonResponse
    {
        $limit = $request->get('limit', 15);
        $services = Service::select('id', 'name', 'category', 'price', 'description')
            ->paginate($limit);
        return $this->sendSuccessJson($services, "All services.", 200);
    }

    public function store(StoreServiceRequest $request): JsonResponse
    {
        $service = Service::create($request->validated());
        return $this->sendSuccessJson($service, 'Service created successfully.', 201);
    }

    public function show(Service $service): JsonResponse
    {
        return $this->sendSuccessJson($service, 'Service details.');
    }

    public function update(UpdateServiceRequest $request, Service $service): JsonResponse
    {
        $service->update($request->validated());
        return $this->sendSuccessJson($service, 'Service updated successfully.');
    }

    public function destroy(Service $service): JsonResponse
    {
        $service->delete();
        return $this->sendSuccessJson(null, 'Service deleted successfully.');
    }
}
