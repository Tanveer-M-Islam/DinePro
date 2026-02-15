@extends('layouts.public')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto text-center mb-12">
            <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Book a Table</h2>
            <p class="mt-4 text-xl text-gray-500">Reserve your spot for an unforgettable dining experience.</p>
        </div>

        <div class="max-w-xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden p-8">
            <form action="{{ route('reservation.store') }}" method="POST" class="grid grid-cols-1 gap-y-6">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <div class="mt-1">
                        <input type="text" name="name" id="name" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm p-3 border">
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <div class="mt-1">
                            <input type="email" name="email" id="email" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm p-3 border">
                        </div>
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                        <div class="mt-1">
                            <input type="tel" name="phone" id="phone" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm p-3 border">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                    <div>
                        <label for="reservation_date" class="block text-sm font-medium text-gray-700">Date & Time</label>
                        <div class="mt-1">
                            <input type="datetime-local" name="reservation_date" id="reservation_date" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm p-3 border">
                        </div>
                    </div>
                    <div>
                        <label for="guests" class="block text-sm font-medium text-gray-700">Guests</label>
                        <div class="mt-1">
                            <select id="guests" name="guests" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm p-3 border">
                                <option>1 Person</option>
                                <option>2 People</option>
                                <option>3 People</option>
                                <option>4 People</option>
                                <option>5 People</option>
                                <option>6+ People</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="special_request" class="block text-sm font-medium text-gray-700">Special Requests</label>
                    <div class="mt-1">
                        <textarea id="special_request" name="special_request" rows="3" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm p-3 border"></textarea>
                    </div>
                </div>

                <div>
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors" style="background-color: var(--color-primary)">
                        Confirm Reservation
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
