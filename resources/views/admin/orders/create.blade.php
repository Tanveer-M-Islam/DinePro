@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Create New Order</h1>
        <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
            Back to Orders
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden" x-data="orderForm()">
        <form action="{{ route('admin.orders.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            <!-- Customer Info -->
            <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-3">
                <div>
                    <label for="order_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Order Number (Optional)</label>
                    <input type="text" name="order_number" id="order_number" placeholder="Leave blank for auto-generated" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm p-2 border">
                </div>

                <div>
                    <label for="customer_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Customer Name (Optional)</label>
                    <input type="text" name="customer_name" id="customer_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm p-2 border">
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone (Optional)</label>
                    <input type="text" name="phone" id="phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm p-2 border">
                </div>
            </div>

            <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white mb-4">Order Items</h3>
                
                <div class="space-y-4">
                    <template x-for="(item, index) in items" :key="index">
                        <div class="flex items-end gap-x-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600">
                            <!-- Menu Item Selection -->
                            <div class="flex-1">
                                <label :for="'item_' + index" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Item</label>
                                <select :name="'items[' + index + '][id]'" :id="'item_' + index" x-model="item.id" @change="updatePrice(index)" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white sm:text-sm p-2 border" required>
                                    <option value="">Select Item</option>
                                    @foreach($categories as $category)
                                        <optgroup label="{{ $category->name }}">
                                            @foreach($category->menuItems as $menuItem)
                                                <option value="{{ $menuItem->id }}" data-price="{{ $menuItem->price }}">{{ $menuItem->name }} - ${{ number_format($menuItem->price, 2) }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Quantity -->
                            <div class="w-24">
                                <label :for="'qty_' + index" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Qty</label>
                                <input type="number" :name="'items[' + index + '][quantity]'" :id="'qty_' + index" x-model="item.quantity" min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white sm:text-sm p-2 border" required>
                            </div>

                            <!-- Price Display -->
                            <div class="w-32 text-right pb-2">
                                <span class="text-sm font-medium text-gray-900 dark:text-white" x-text="'$' + (item.price * item.quantity).toFixed(2)"></span>
                            </div>

                            <!-- Remove Button -->
                            <button type="button" @click="removeItem(index)" class="mb-1 text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 p-2">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </template>
                </div>

                <div class="mt-4">
                    <button type="button" @click="addItem()" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-primary-700 bg-primary-100 hover:bg-primary-200 dark:bg-primary-900 dark:text-primary-200">
                        <svg class="mr-2 -ml-1 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add Item
                    </button>
                </div>
            </div>

            <!-- Total -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-6 flex justify-end">
                <div class="text-right">
                    <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">Total Amount</span>
                    <span class="block text-3xl font-bold text-gray-900 dark:text-white" x-text="'$' + calculateTotal()"></span>
                </div>
            </div>

            <div class="flex justify-end pt-6">
                <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-primary-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                    Create Order (Mark as Paid)
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function orderForm() {
        return {
            items: [
                { id: '', quantity: 1, price: 0 }
            ],
            addItem() {
                this.items.push({ id: '', quantity: 1, price: 0 });
            },
            removeItem(index) {
                if (this.items.length > 1) {
                    this.items.splice(index, 1);
                }
            },
            updatePrice(index) {
                const select = document.getElementById('item_' + index);
                const option = select.options[select.selectedIndex];
                const price = option.getAttribute('data-price');
                this.items[index].price = price ? parseFloat(price) : 0;
            },
            calculateTotal() {
                return this.items.reduce((total, item) => {
                    return total + (item.price * item.quantity);
                }, 0).toFixed(2);
            }
        }
    }
</script>
@endsection
