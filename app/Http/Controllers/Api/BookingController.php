<?php

namespace App\Http\Controllers\Api;

use App\Models\Booking;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Enums\BookingStatus;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\BaseController;
use App\Http\Requests\StoreBookingRequest;
use App\Jobs\SendBookingConfirmationEmail;
use App\Http\Requests\UpdateBookingStatusRequest;

class BookingController extends BaseController
{
    public function index(Request $request): JsonResponse
    {
        $limit = $request->get('limit', 15);
        $services = Booking::select(
            'uuid',
            'customer_name',
            'email',
            'phone_number',
            'service_id',
            'schedule_time',
            'status',
        )->paginate($limit);
        return $this->sendSuccessJson($services, "All bookings.", 200);
    }

    public function store(StoreBookingRequest $request): JsonResponse
    {
        $data = $request->validated();
        $booking = Booking::create([
            'uuid'           => Str::uuid(),
            'customer_name'  => $data['customer_name'],
            'email'          => $data['email'],
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
            'email'  => $booking->email,
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
            "Service booking details.",
            200
        );
    }

    public function updateStatus(UpdateBookingStatusRequest $request, string $uuid): JsonResponse
    {
        $booking = Booking::where('uuid', $uuid)->first();
        if (!$booking) {
            $this->sendErrorJson('Booking not found for.');
        }
        $booking->status = $request->status;
        $booking->save();
        if ($booking->status === BookingStatus::CONFIRMED) {
            SendBookingConfirmationEmail::dispatch($booking);
        }
        return $this->sendSuccessJson(
            $booking,
            "Booking status updated successfully.",
            200
        );
    }
}
