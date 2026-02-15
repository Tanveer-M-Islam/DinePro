@extends('layouts.admin')

@section('content')
<div x-data="{
    showModal: false,
    isEdit: false,
    modalTitle: 'Add Menu Item',
    form: {
        id: null,
        category_id: '',
        name: '',
        description: '',
        price: '',
        is_featured: false,
        status: true,
        image_preview: null
    },
    baseUrl: '{{ route('admin.menu-items.index') }}',
    get actionUrl() {
        return this.isEdit 
            ? `${this.baseUrl}/${this.form.id}` 
            : this.baseUrl;
    },
    openModal(item = null) {
        this.showModal = true;
        this.isEdit = !!item;
        this.modalTitle = this.isEdit ? 'Edit Menu Item' : 'Add Menu Item';
        
        if (item) {
            this.form.id = item.id;
            this.form.category_id = item.category_id;
            this.form.name = item.name;
            this.form.description = item.description;
            this.form.price = item.price;
            this.form.is_featured = !!item.is_featured;
            this.form.status = !!item.status;
            this.form.image_preview = item.image ? `/storage/${item.image}` : null;
        } else {
            this.form.id = null;
            this.form.category_id = '';
            this.form.name = '';
            this.form.description = '';
            this.form.price = '';
            this.form.is_featured = false;
            this.form.status = true;
            this.form.image_preview = null;
        }
    },
    closeModal() {
        this.showModal = false;
    },
    previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            this.form.image_preview = URL.createObjectURL(file);
        }
    }
}">
    <!-- Header & Search -->
    <div class="md:flex md:items-center md:justify-between mb-6">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 dark:text-white sm:truncate">Menu Items</h2>
        </div>
        <div class="mt-4 flex md:mt-0 md:ml-4">
             <form method="GET" action="{{ route('admin.menu-items.index') }}" class="mr-4">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..." class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white sm:text-sm p-2 border">
            </form>
            <button @click="openModal()" type="button" class="inline-flex items-center rounded-md border border-transparent bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                Add New
            </button>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-hidden bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Image</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Category</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Price</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Featured</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">
                @foreach($menuItems as $item)
                <tr>
                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="h-10 w-10 rounded-full object-cover">
                        @else
                            <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                <span class="text-xs text-gray-500">No Img</span>
                            </div>
                        @endif
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">{{ $item->name }}</td>
                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500 dark:text-gray-400">{{ $item->category->name }}</td>
                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500 dark:text-gray-400">${{ $item->price }}</td>
                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                         @if($item->is_featured)
                            <span class="inline-flex items-center rounded-full bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">Featured</span>
                        @endif
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $item->status ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                            {{ $item->status ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                        <button @click="openModal({{ $item }})" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 mr-3">Edit</button>
                        <form action="{{ route('admin.menu-items.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
            {{ $menuItems->links() }}
        </div>
    </div>

    <!-- Modal -->
    <div x-show="showModal" class="relative z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
        <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div x-show="showModal" @click.away="closeModal()" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative transform overflow-hidden rounded-lg bg-white dark:bg-gray-800 px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                    <div class="absolute top-0 right-0 hidden pt-4 pr-4 sm:block">
                        <button @click="closeModal()" type="button" class="rounded-md bg-white dark:bg-gray-800 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            <span class="sr-only">Close</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white" id="modal-title" x-text="modalTitle"></h3>
                            <div class="mt-2">
                                <form :action="actionUrl" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="_method" :value="isEdit ? 'PUT' : 'POST'">
                                    
                                    <div class="mb-4">
                                        <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                                        <select name="category_id" id="category_id" x-model="form.category_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm border p-2">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-4">
                                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                                        <input type="text" name="name" id="name" x-model="form.name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm border p-2">
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                                        <textarea name="description" id="description" rows="3" x-model="form.description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm border p-2"></textarea>
                                    </div>
                                    
                                     <div class="mb-4">
                                        <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Price</label>
                                        <input type="number" step="0.01" name="price" id="price" x-model="form.price" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm border p-2">
                                    </div>

                                    <div class="mb-4">
                                        <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image</label>
                                        <div class="mt-1 flex items-center space-x-4">
                                            <template x-if="form.image_preview">
                                                <img :src="form.image_preview" class="h-12 w-12 rounded-full object-cover">
                                            </template>
                                            <input type="file" name="image" id="image" @change="previewImage" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 dark:file:bg-gray-700 dark:file:text-white">
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center gap-x-6">
                                        <div class="flex items-center">
                                            <input type="checkbox" name="is_featured" id="is_featured" x-model="form.is_featured" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="is_featured" class="ml-2 block text-sm text-gray-900 dark:text-gray-300">Featured</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="checkbox" name="status" id="status" x-model="form.status" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="status" class="ml-2 block text-sm text-gray-900 dark:text-gray-300">Active</label>
                                        </div>
                                    </div>

                                    <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                        <button type="submit" class="inline-flex w-full justify-center rounded-md border border-transparent bg-primary-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">Save</button>
                                        <button @click="closeModal()" type="button" class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white dark:bg-gray-700 px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-300 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:w-auto sm:text-sm">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
