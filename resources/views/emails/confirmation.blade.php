<x-mail::message>
# Booking Confirmed!

Hi {{ $booking->customer_name }},

Your booking (ID: {{ $booking->uuid }}) has been successfully confirmed.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>