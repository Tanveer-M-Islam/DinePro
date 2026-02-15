@extends('layouts.admin')

@section('content')
<div x-data="{
    showModal: false,
    order: null,
    statusColors: {
        'pending': 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
        'processing': 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
        'completed': 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
        'cancelled': 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200'
    },
    paymentColors: {
        'pending': 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
        'paid': 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
        'failed': 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200'
    },
    openModal(order) {
        this.order = order;
        this.showModal = true;
    },
    closeModal() {
        this.showModal = false;
        this.order = null;
    },
    formatDate(dateString) {
        return new Date(dateString).toLocaleString();
    }
}">
    <!-- Header & Search -->
    <div class="md:flex md:items-center md:justify-between mb-6">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 dark:text-white sm:truncate">Orders</h2>
        </div>
        <div class="mt-4 flex md:mt-0 md:ml-4 gap-2">
            <a href="{{ route('admin.orders.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                Create Order
            </a>
            <form method="GET" action="{{ route('admin.orders.index') }}" class="flex gap-2 items-center">
                <select name="status" onchange="this.form.submit()" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white sm:text-sm p-2 border">
                    <option value="">All Statuses</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search ID, Name..." class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white sm:text-sm p-2 border pr-8">
                    @if(request('search'))
                        <a href="{{ route('admin.orders.index', ['status' => request('status')]) }}" class="absolute inset-y-0 right-0 flex items-center pr-2 text-gray-400 hover:text-gray-600">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                    @endif
                </div>

            </form>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-hidden bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Order ID</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Customer</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Total</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Payment</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">
                @foreach($orders as $order)
                <tr>
                    <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">#{{ $order->id }}</td>
                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                        {{ $order->customer_name }}<br>
                        <span class="text-xs">{{ $order->phone }}</span>
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500 dark:text-gray-400">${{ $order->total_amount }}</td>
                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium" :class="statusColors['{{ $order->status }}']">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium" :class="paymentColors['{{ $order->payment_status }}']">
                            {{ ucfirst($order->payment_status) }}
                        </span>
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500 dark:text-gray-400">{{ $order->created_at->format('M d, Y H:i') }}</td>
                    <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                        <button @click="openModal({{ $order }})" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">View & Manage</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
            {{ $orders->links() }}
        </div>
    </div>

    <!-- Modal -->
    <div x-show="showModal" class="relative z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
        <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div x-show="showModal" @click.away="closeModal()" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative transform overflow-hidden rounded-lg bg-white dark:bg-gray-800 px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl sm:p-6">
                    <div class="absolute top-0 right-0 hidden pt-4 pr-4 sm:block">
                        <button @click="closeModal()" type="button" class="rounded-md bg-white dark:bg-gray-800 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            <span class="sr-only">Close</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    
                    <template x-if="order">
                        <div class="sm:flex sm:items-start w-full">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white" id="modal-title">
                                    Order #<span x-text="order.id"></span> Details
                                </h3>
                                
                                <!-- Customer Info -->
                                <div class="mt-4 grid grid-cols-2 gap-4 border-b border-gray-200 dark:border-gray-700 pb-4">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Customer</p>
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white" x-text="order.customer_name"></p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400" x-text="order.phone"></p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Date</p>
                                        <p class="text-sm text-gray-900 dark:text-white" x-text="new Date(order.created_at).toLocaleString()"></p>
                                    </div>
                                </div>

                                <!-- Items -->
                                <div class="mt-4">
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-white mb-2">Order Items</h4>
                                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                                        <template x-for="item in order.order_items" :key="item.id">
                                            <li class="py-2 flex justify-between">
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900 dark:text-white" x-text="item.menu_item ? item.menu_item.name : 'Unknown Item'"></p>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400">Qty: <span x-text="item.quantity"></span> x $<span x-text="item.price"></span></p>
                                                </div>
                                                <p class="text-sm font-semibold text-gray-900 dark:text-white">$<span x-text="(item.quantity * item.price).toFixed(2)"></span></p>
                                            </li>
                                        </template>
                                    </ul>
                                    <div class="mt-2 text-right border-t border-gray-200 dark:border-gray-700 pt-2 flex justify-between items-center">
                                        <form :action="`{{ route('admin.orders.index') }}/${order.id}`" method="POST" onsubmit="return confirm('Are you sure you want to delete this order?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs text-red-600 hover:text-red-900 border border-red-200 bg-red-50 rounded px-2 py-1">Delete Order</button>
                                        </form>
                                        <p class="text-base font-bold text-gray-900 dark:text-white">Total: $<span x-text="order.total_amount"></span></p>
                                    </div>
                                </div>

                                <!-- Manage Status Form -->
                                <div class="mt-6 bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-white mb-3">Update Order Status</h4>
                                    <form :action="`{{ route('admin.orders.index') }}/${order.id}`" method="POST" class="grid grid-cols-2 gap-4">
                                        @csrf
                                        @method('PUT')
                                        <div>
                                            <label for="status" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Order Status</label>
                                            <select name="status" x-model="order.status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white sm:text-sm p-2 border">
                                                <option value="pending">Pending</option>
                                                <option value="processing">Processing</option>
                                                <option value="completed">Completed</option>
                                                <option value="cancelled">Cancelled</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="payment_status" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Payment Status</label>
                                            <select name="payment_status" x-model="order.payment_status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white sm:text-sm p-2 border">
                                                <option value="pending">Pending</option>
                                                <option value="paid">Paid</option>
                                                <option value="failed">Failed</option>
                                            </select>
                                        </div>
                                        <div class="col-span-2 text-right mt-2">
                                            <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">Update Status</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
