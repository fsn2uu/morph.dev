@extends('_template')

@section('content')

    <section id="content-body" class="md:w-[65%] md:mx-auto py-10 px-10 md:px-0 min-h-[60vh]">
        <div class="flex justify-between">
            <h1 class="text-contrastGold text-5xl mb-4">Dashboard</h1>
            <div class="items-end">
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6 mb-10">
            <h2 class="text-2xl mb-4 text-contrastGold">2 Week Outlook</h2>
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-200 text-left text-xs leading-4 font-medium uppercase tracking-wider">Unit</th>
                        @for ($i = 0; $i <= 13; $i++)
                        <th class="px-6 py-3 bg-gray-200 text-center text-xs leading-2 font-medium uppercase">{{ \Carbon\Carbon::now()->addDays($i)->format('m/d') }}</th>
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    @foreach($units as $unit)
                        <tr class="{{ !$loop->last ? 'border-b' : '' }}">
                            <td class="px-6 py-4 whitespace-no-wrap"><a href="{{ route('admin.units.show', $unit->slug) }}">{{ $unit->name }}</a></td>
                            <td class="px-6 py-4">
                                <div class="w-6 h-6 rounded-full reservation-type
                                {{-- @if ($reservation->type === 'to')
                                bg-red-500
                                @elseif ($reservation->type === 'oo')
                                bg-green-500
                                @elseif ($reservation->type === 'bo')
                                bg-purple-500
                                @endif --}}
                                "></div>
                            </td>
                            <!-- Add more table cells for other unit details -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <div class="bg-white rounded-lg shadow p-6 mb-10">
                <h2 class="text-2xl mb-4 text-contrastGold">Profit & Loss YTD</h2>
                <canvas id="pieChart"></canvas>
            </div>
            <div class="bg-white rounded-lg shadow p-6 mb-10">
                <h2 class="text-2xl mb-4 text-contrastGold">YTD Comparison</h2>
                <canvas id="lineChart"></canvas>
            </div>
        </div>
    </section>
    
@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Get the canvas element
    var ctx = document.getElementById('pieChart').getContext('2d');

    const travelerEarned = 15000
    const ownerEarned = 3000
    const maintenanceEarned = 1569
    const blackoutEarned = 4512

    // Define the data for the pie chart
    var data = {
        labels: ['Traveler', 'Owner', 'Maintenance', 'Blackout'],
        datasets: [{
            data: [travelerEarned, ownerEarned, maintenanceEarned, blackoutEarned],
            backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0']
        }]
    };

    // Create the pie chart
    var pieChart = new Chart(ctx, {
        type: 'pie',
        data: data
    });

    // Get the canvas element
    var ctx = document.getElementById('lineChart').getContext('2d');

    const currentYearEarnings = [1500,1836,2628,2619,1273,1234,2616,3645,6534,5643,2322,2165]
    const previousYearEarnings = [2323,3232,4231,1234,2451,1232,3132,1312,6521,5321,8431,3146]

    // Define the data for the line chart
    var data = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: 'Current Year',
            data: currentYearEarnings,
            borderColor: '#36A2EB',
            fill: false
        }, {
            label: 'Previous Year',
            data: previousYearEarnings,
            borderColor: '#FF6384',
            fill: false
        }]
    };

    // Create the line chart
    var lineChart = new Chart(ctx, {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Monthly Earnings Comparison'
            },
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Month'
                    }
                },
                y: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Earnings'
                    }
                }
            }
        }
    });


</script>
    
@endpush