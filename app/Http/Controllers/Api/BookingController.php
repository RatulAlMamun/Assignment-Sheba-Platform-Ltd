<?php

namespace App\Http\Controllers\Api;

use App\Enums\BookingStatus;
use App\Models\Booking;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\BaseController;
use App\Http\Requests\StoreBookingRequest;

class BookingController extends BaseController
{
    public function store(StoreBookingRequest $request): JsonResponse
    {
        $data = $request->validated();
        $booking = Booking::create([
            'uuid'           => Str::uuid(),
            'customer_name'  => $data['customer_name'],
            'phone_number'   => $data['phone_number'],
            'service_id'     => $data['service_id'],
            'schedule_time'  => $data['schedule_time'],
            'status'         => BookingStatus::PENDING,
        ]);
        return $this->sendSuccessJson(
            [
                'booking_id' => $booking->uuid,
                'status' => $booking->status,
            ],
            "Service booked successfully!",
            201
        );
    }

    public function show(string $uuid): JsonResponse
    {
        $booking = Booking::where('uuid', $uuid)->with('service')->first();
        if (!$booking) {
            $this->sendErrorJson('Booking not found.');
        }
        $data = [
            'booking_id'     => $booking->uuid,
            'customer_name'  => $booking->customer_name,
            'phone_number'   => $booking->phone_number,
            'status'         => $booking->status->value,
            'schedule_time'  => $booking->schedule_time->toDateTimeString(),
            'service' => [
                'id'          => $booking->service->id,
                'name'        => $booking->service->name,
                'category'    => $booking->service->category,
                'price'       => $booking->service->price,
                'description' => $booking->service->description,
            ],
        ];
        return $this->sendSuccessJson(
            $data,
            "Service booked successfully!",
            200
        );
    }
}
