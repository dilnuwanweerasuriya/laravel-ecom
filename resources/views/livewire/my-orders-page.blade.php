<div>
    <livewire:partials.navigation />

    <!-- My Orders Section -->
    <div class="container mx-auto px-6 py-12">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">My Orders</h1>
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($orders as $order)

                        @php
                            switch ($order->status) {
                                case 'pending':
                                    $statusColor = 'yellow';
                                    break;

                                case 'paid':
                                    $statusColor = 'blue';
                                    break;

                                case 'shipped':
                                case 'delivered':
                                    $statusColor = 'green';
                                    break;

                                case 'cancelled':
                                    $statusColor = 'red';
                                    break;

                                default:
                                    $statusColor = 'black';
                                    break;
                            }
                        @endphp

                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">#{{ $order->id }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ $order->created_at->format('d-m-Y') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ Number::currency($order->total_amount, 'LKR' )}}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs capitalize leading-5 font-semibold rounded-full bg-{{$statusColor}}-100 text-{{$statusColor}}-800">{{ $order->status }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="my-orders/{{ $order->id }}" class="text-indigo-600 hover:text-indigo-900">View Details</a>
                                {{-- <a href="/order/123456789/tracking" class="ml-4 text-indigo-600 hover:text-indigo-900">Track Shipment</a> --}}
                            </td>
                        </tr>
                        @endforeach                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <livewire:partials.footer />
</div>
