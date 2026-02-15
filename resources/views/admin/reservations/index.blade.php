@extends('layouts.admin')

@section('content')
<div x-data="{
    statusColors: {
        'pending': 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
        'confirmed': 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
        'cancelled': 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200'
    }
}">
    <!-- Header & Search -->
    <div class="md:flex md:items-center md:justify-between mb-6">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 dark:text-white sm:truncate">Reservations</h2>
        </div>
        <div class="mt-4 flex flex-wrap md:mt-0 md:ml-4 gap-2">
            <form method="GET" action="{{ route('admin.reservations.index') }}" class="flex flex-wrap gap-2 items-center">
                <input type="date" name="date" value="{{ request('date') }}" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white sm:text-sm p-2 border">
                
                <select name="status" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white sm:text-sm p-2 border">
                    <option value="">All Statuses</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search Name/Phone..." class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white sm:text-sm p-2 border">
                
                <button type="submit" class="inline-flex items-center rounded-md border border-transparent bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                    Filter
                </button>
            </form>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-hidden bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date & Time</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Guest</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Guests</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">
                @foreach($reservations as $reservation)
                <tr>
                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900 dark:text-white">
                        {{ $reservation->reservation_date->format('M d, Y') }}<br>
                        <span class="text-xs text-gray-500">{{ $reservation->reservation_date->format('h:i A') }}</span>
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                        {{ $reservation->name }}<br>
                        <span class="text-xs">{{ $reservation->phone }}</span>
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500 dark:text-gray-400">{{ $reservation->guests }}</td>
                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium" :class="statusColors['{{ $reservation->status }}']">
                            {{ ucfirst($reservation->status) }}
                        </span>
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                        @if($reservation->status === 'pending')
                            <form action="{{ route('admin.reservations.update', $reservation->id) }}" method="POST" class="inline-block mr-2">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="confirmed">
                                <button type="submit" class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300" title="Approve">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>
                            </form>
                            <form action="{{ route('admin.reservations.update', $reservation->id) }}" method="POST" class="inline-block mr-2">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="cancelled">
                                <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300" title="Reject" onsubmit="return confirm('Reject this reservation?');">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>
                            </form>
                        @endif
                         <form action="{{ route('admin.reservations.destroy', $reservation->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-400 hover:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400" title="Delete">
                                 <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                  </svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
            {{ $reservations->links() }}
        </div>
    </div>
</div>
@endsection
