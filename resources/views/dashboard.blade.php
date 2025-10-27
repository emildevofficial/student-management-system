@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 px-6 py-8 space-y-8">

    {{-- SUMMARY CARDS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
        @php
            $cards = [
                ['label'=>'Students','value'=>$students,'icon'=>'fa-user-graduate','color'=>'blue'],
                ['label'=>'Teachers','value'=>$teachers,'icon'=>'fa-chalkboard-teacher','color'=>'purple'],
                ['label'=>'Courses','value'=>$courses,'icon'=>'fa-book','color'=>'amber'],
                ['label'=>'Enrollments','value'=>$enrollments,'icon'=>'fa-clipboard-list','color'=>'green'],
                ['label'=>'Payments','value'=>"$".number_format($payments,2),'icon'=>'fa-credit-card','color'=>'red'],
            ];
        @endphp

        @foreach($cards as $card)
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-200">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">{{ $card['label'] }}</p>
                    <h2 class="text-2xl font-bold mt-1 text-gray-800">{{ $card['value'] }}</h2>
                </div>
                <div class="bg-{{ $card['color'] }}-50 p-3 rounded-full flex items-center justify-center">
                    <i class="fa {{ $card['icon'] }} text-{{ $card['color'] }}-600 text-lg"></i>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- CHARTS --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Enrollment Chart --}}
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                    <i class="fa fa-chart-line text-blue-500"></i> Monthly Enrollments
                </h3>
            </div>
            <div class="h-64">
                <canvas id="enrollmentChart"></canvas>
            </div>
        </div>

        {{-- Revenue Chart --}}
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                    <i class="fa fa-coins text-amber-500"></i> Monthly Revenue
                </h3>
            </div>
            <div class="h-64">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>

    {{-- RECENT PAYMENTS --}}
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                <i class="fa fa-credit-card text-red-500"></i> Recent Payments
            </h3>
            <a href="{{ route('payments.index') }}" class="text-blue-600 font-medium text-sm hover:text-blue-700 transition-colors">View All</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-gray-500 text-xs font-medium uppercase tracking-wide border-b border-gray-200">
                        <th class="pb-3 font-semibold">Student</th>
                        <th class="pb-3 font-semibold">Amount</th>
                        <th class="pb-3 font-semibold">Status</th>
                        <th class="pb-3 font-semibold">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($recentPayments as $payment)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-3 font-medium text-gray-900">{{ $payment->student->name ?? 'N/A' }}</td>
                        <td class="py-3 font-semibold text-gray-900">${{ number_format($payment->amount, 2) }}</td>
                        <td class="py-3">
                            <span class="px-2.5 py-1 text-xs font-medium rounded-full
                                @if($payment->status === 'completed') bg-green-100 text-green-800
                                @elseif($payment->status === 'pending') bg-amber-100 text-amber-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst($payment->status) }}
                            </span>
                        </td>
                        <td class="py-3 text-gray-600">{{ $payment->created_at->format('M d, Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-6 text-gray-500">No recent payments found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

{{-- CHART.JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const ctx1 = document.getElementById('enrollmentChart');
    const ctx2 = document.getElementById('revenueChart');

    // Enrollment Chart
    new Chart(ctx1, {
        type: 'line',
        data: {
            labels: @json($months),
            datasets: [{
                label: 'Enrollments',
                data: @json($enrollmentData),
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.05)',
                fill: true,
                tension: 0.4,
                borderWidth: 2,
                pointBackgroundColor: '#3b82f6',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    border: {
                        dash: [2, 4]
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(255, 255, 255, 0.95)',
                    titleColor: '#1f2937',
                    bodyColor: '#1f2937',
                    borderColor: '#e5e7eb',
                    borderWidth: 1,
                    boxShadow: '0 4px 6px -1px rgba(0, 0, 0, 0.1)'
                }
            }
        }
    });

    // Revenue Chart
    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: @json($months),
            datasets: [{
                label: 'Revenue ($)',
                data: @json($revenueData),
                backgroundColor: 'rgba(245, 158, 11, 0.7)',
                borderColor: 'rgba(245, 158, 11, 1)',
                borderWidth: 1,
                borderRadius: 6,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    border: {
                        dash: [2, 4]
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(255, 255, 255, 0.95)',
                    titleColor: '#1f2937',
                    bodyColor: '#1f2937',
                    borderColor: '#e5e7eb',
                    borderWidth: 1,
                    boxShadow: '0 4px 6px -1px rgba(0, 0, 0, 0.1)'
                }
            }
        }
    });
});
</script>
@endsection