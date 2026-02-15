@extends('layouts.admin')

@section('content')
    <div class="md:flex md:items-center md:justify-between mb-8">
        <div class="min-w-0 flex-1">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 dark:text-white sm:truncate sm:text-3xl sm:tracking-tight">Dashboard</h2>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-8">
        <!-- Total Revenue -->
        <div class="overflow-hidden rounded-xl bg-white dark:bg-gray-800 shadow-sm border border-gray-100 dark:border-gray-700 transition hover:shadow-md">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 rounded-md bg-green-50 dark:bg-green-900/30 p-3">
                        <svg class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="truncate text-sm font-medium text-gray-500 dark:text-gray-400">Total Revenue</dt>
                            <dd class="mt-1 text-2xl font-semibold text-gray-900 dark:text-white">${{ number_format($totalRevenue, 2) }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Orders -->
        <div class="overflow-hidden rounded-xl bg-white dark:bg-gray-800 shadow-sm border border-gray-100 dark:border-gray-700 transition hover:shadow-md">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 rounded-md bg-blue-50 dark:bg-blue-900/30 p-3">
                        <svg class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="truncate text-sm font-medium text-gray-500 dark:text-gray-400">Total Orders</dt>
                            <dd class="mt-1 text-2xl font-semibold text-gray-900 dark:text-white">{{ $totalOrders }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reservations Today -->
        <div class="overflow-hidden rounded-xl bg-white dark:bg-gray-800 shadow-sm border border-gray-100 dark:border-gray-700 transition hover:shadow-md">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 rounded-md bg-purple-50 dark:bg-purple-900/30 p-3">
                        <svg class="h-6 w-6 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0h18M5.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="truncate text-sm font-medium text-gray-500 dark:text-gray-400">Reservations Today</dt>
                            <dd class="mt-1 text-2xl font-semibold text-gray-900 dark:text-white">{{ $reservationsToday }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu Items -->
        <div class="overflow-hidden rounded-xl bg-white dark:bg-gray-800 shadow-sm border border-gray-100 dark:border-gray-700 transition hover:shadow-md">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 rounded-md bg-orange-50 dark:bg-orange-900/30 p-3">
                        <svg class="h-6 w-6 text-orange-600 dark:text-orange-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="truncate text-sm font-medium text-gray-500 dark:text-gray-400">Menu Items</dt>
                            <dd class="mt-1 text-2xl font-semibold text-gray-900 dark:text-white">{{ $totalMenuItems }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Weekly Revenue</h3>
        <div class="w-full h-80">
            <canvas id="salesChart"></canvas>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('salesChart').getContext('2d');
            const isDark = document.documentElement.classList.contains('dark');
            
            // Re-render chart on theme toggle if needed (simplified here)
            const salesChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($chartLabels) !!},
                    datasets: [{
                        label: 'Revenue ($)',
                        data: {!! json_encode($chartValues) !!},
                        borderColor: '#f97316',
                        backgroundColor: 'rgba(249, 115, 22, 0.1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#f97316',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: '#f97316'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)'
                            },
                            ticks: {
                                color: isDark ? '#9ca3af' : '#4b5563'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: isDark ? '#9ca3af' : '#4b5563'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            labels: {
                                color: isDark ? '#9ca3af' : '#4b5563'
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
