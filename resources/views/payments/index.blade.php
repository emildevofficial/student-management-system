@extends('layouts.layout')
@section('content')

<div class="min-h-screen bg-gray-50 px-6 py-8">
    <div class="max-w-6xl mx-auto">
        <!-- Minimal Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Payment Records</h1>
                <p class="text-gray-600 mt-1">Manage your payment transactions</p>
            </div>
            <a 
                href="{{ route('payments.create') }}" 
                class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium rounded-xl shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 group"
            >
                <i class="fa fa-plus mr-2 group-hover:scale-110 transition-transform"></i>
                New Payment
            </a>
        </div>

        @if(session('flash_message'))
            <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-r-lg">
                <div class="flex items-center">
                    <i class="fa fa-check-circle text-green-500 mr-3"></i>
                    <span class="text-green-800 font-medium">{{ session('flash_message') }}</span>
                </div>
            </div>
        @endif

        @if($payments->isEmpty())
            <!-- Creative Empty State -->
            <div class="text-center py-16 bg-white rounded-2xl shadow-sm border border-gray-200">
                <div class="w-20 h-20 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <i class="fa fa-credit-card text-blue-500 text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">No payments yet</h3>
                <p class="text-gray-500 mb-6 max-w-md mx-auto">Start building your payment history by recording your first transaction</p>
                <a 
                    href="{{ route('payments.create') }}" 
                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all shadow-md hover:shadow-lg"
                >
                    <i class="fa fa-plus mr-2"></i>
                    Create First Payment
                </a>
            </div>
        @else
            <!-- Enhanced Table Design -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <!-- Table Header with Search -->
                <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                            <i class="fa fa-history mr-3 text-blue-500"></i>
                            Recent Transactions
                        </h3>
                        <div class="flex items-center space-x-3">
                            <div class="relative">
                                <input 
                                    type="text" 
                                    placeholder="Search payments..." 
                                    class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-64"
                                >
                                <i class="fa fa-search absolute left-3 top-3 text-gray-400"></i>
                            </div>
                            <button class="flex items-center px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                                <i class="fa fa-filter mr-2 text-gray-600"></i>
                                <span class="text-gray-700">Filter</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Table Content -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200">
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <div class="flex items-center space-x-1">
                                        <span>Student</span>
                                        <i class="fa fa-sort text-gray-400 cursor-pointer"></i>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <div class="flex items-center space-x-1">
                                        <span>Amount</span>
                                        <i class="fa fa-sort text-gray-400 cursor-pointer"></i>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <div class="flex items-center space-x-1">
                                        <span>Payment Date</span>
                                        <i class="fa fa-sort text-gray-400 cursor-pointer"></i>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($payments as $payment)
                                <tr class="hover:bg-blue-50/30 transition-all duration-200 group">
                                    <!-- Student with Avatar -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm mr-3 shadow-sm">
                                                {{ strtoupper(substr($payment->student->name ?? 'N', 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="text-sm font-semibold text-gray-900 group-hover:text-blue-700 transition-colors">
                                                    {{ $payment->student->name ?? 'N/A' }}
                                                </div>
                                                <div class="text-xs text-gray-500">Student ID: {{ $payment->student->id ?? 'N/A' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <!-- Amount with Currency Symbol -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <span class="text-lg font-bold text-green-600">${{ number_format($payment->amount, 2) }}</span>
                                            <span class="ml-2 text-xs text-gray-500 bg-green-100 px-2 py-1 rounded-full">USD</span>
                                        </div>
                                    </td>
                                    
                                    <!-- Payment Date with Time Indicator -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ \Carbon\Carbon::parse($payment->paid_at)->format('M d, Y') }}
                                        </div>
                                        <div class="text-xs text-gray-500 flex items-center mt-1">
                                            <i class="fa fa-clock mr-1"></i>
                                            {{ \Carbon\Carbon::parse($payment->paid_at)->diffForHumans() }}
                                        </div>
                                    </td>
                                    
                                    <!-- Status Badge -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                            <i class="fa fa-check-circle mr-1.5"></i>
                                            Completed
                                        </span>
                                    </td>
                                    
                                    <!-- Action Buttons -->
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <div class="flex justify-end space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                            <a 
                                                href="{{ route('payments.show', $payment->id) }}" 
                                                class="inline-flex items-center px-3 py-2 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-colors duration-200 text-sm font-medium shadow-sm"
                                                title="View Details"
                                            >
                                                <i class="fa fa-eye mr-1.5"></i>
                                                View
                                            </a>
                                            <a 
                                                href="{{ route('payments.edit', $payment->id) }}" 
                                                class="inline-flex items-center px-3 py-2 bg-amber-50 text-amber-700 rounded-lg hover:bg-amber-100 transition-colors duration-200 text-sm font-medium shadow-sm"
                                                title="Edit Payment"
                                            >
                                                <i class="fa fa-edit mr-1.5"></i>
                                                Edit
                                            </a>
                                            <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" class="inline">
                                                @csrf @method('DELETE')
                                                <button 
                                                    onclick="return confirm('Are you sure you want to delete this payment record?')"
                                                    class="inline-flex items-center px-3 py-2 bg-red-50 text-red-700 rounded-lg hover:bg-red-100 transition-colors duration-200 text-sm font-medium shadow-sm"
                                                    title="Delete Payment"
                                                >
                                                    <i class="fa fa-trash mr-1.5"></i>
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Enhanced Footer -->
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                        <div class="text-sm text-gray-600">
                            Showing <span class="font-semibold">{{ $payments->count() }}</span> 
                            of <span class="font-semibold">{{ $payments->count() }}</span> payments
                        </div>
                        <div class="flex items-center space-x-2">
                            <button class="w-9 h-9 flex items-center justify-center border border-gray-300 rounded-lg hover:bg-gray-100 transition-colors">
                                <i class="fa fa-chevron-left text-gray-600"></i>
                            </button>
                            <button class="w-9 h-9 flex items-center justify-center bg-blue-600 text-white rounded-lg font-medium shadow-sm">
                                1
                            </button>
                            <button class="w-9 h-9 flex items-center justify-center border border-gray-300 rounded-lg hover:bg-gray-100 transition-colors">
                                <i class="fa fa-chevron-right text-gray-600"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Action Bar -->
            <div class="mt-6 flex justify-between items-center text-sm text-gray-600">
                <div class="flex items-center space-x-4">
                    <span class="flex items-center">

                </div>
               
            </div>
        @endif
    </div>
</div>

@endsection