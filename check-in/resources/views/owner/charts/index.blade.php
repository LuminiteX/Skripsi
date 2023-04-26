<x-owner-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @if (auth()->user()->has_restaurant == 1)
        <div class="flex justify-center items-center space-x-4">
            <div class="bg-white rounded-lg shadow-lg p-3 flex items-center justify-center w-52 h-24">
                <div>
                    <div class="text-gray-700 font-bold text-xl mb-1 text-center flex items-center justify-center">
                        <i class="material-icons text-gray-700 text-3xl mr-2">remove_red_eye</i>View Count
                    </div>
                    <div class="text-gray-600 text-lg text-center">{{ $restaurant->view }}</div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-3 flex items-center justify-center w-52 h-24">
                <div>
                    <div class="text-gray-700 font-bold text-xl mb-1 text-center flex items-center justify-center">
                        <i class="material-icons text-yellow-500 text-3xl mr-2">star</i>Rating
                    </div>
                    <div class="text-gray-600 text-lg text-center">{{ $restaurant->rating }}</div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-3 flex items-center justify-center w-52 h-24">
                <div>
                    <div class="text-gray-700 font-bold text-xl mb-1 text-center flex items-center justify-center">
                        <i class="material-icons text-gray-700 text-3xl mr-2">book</i>Reservations
                    </div>
                    <div class="text-gray-600 text-lg text-center">{{ $ReservationCounter }}</div>
                </div>
            </div>
        </div>


        <div class="bg-white rounded-lg shadow-lg p-3 mb-4">
            <h2 class="text-gray-700 font-bold text-2xl mb-3">
                View Count
            </h2>
            <div class="chart-container">
                <div id="chart"></div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-3 mb-4">
            <h2 class="text-gray-700 font-bold text-2xl mb-3">
                Rating
            </h2>
            <div class="chart-container">
                <!-- Your chart goes here -->
                <div id="chart2"></div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-3 mb-4">
            <h2 class="text-gray-700 font-bold text-2xl mb-3">
                Reservation
            </h2>
            <div class="chart-container">
                <!-- Your chart goes here -->
                <div id="chart3">

                </div>
            </div>
        </div>


        <script>
            var chartData = <?php echo json_encode($chartData); ?>;

            Highcharts.chart('chart', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'View Counter Chart for <?php echo $restaurant->name; ?>'
                },
                xAxis: {
                    categories: chartData.categories,
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Views'
                    }
                },
                series: [{
                    name: 'Views',
                    data: chartData.data
                }]
            });
        </script>
        <script>
            var chartData2 = <?php echo json_encode($chartData2); ?>;

            Highcharts.chart('chart2', {
                chart: {
                    type: 'line' // changed to line chart
                },
                title: {
                    text: 'The amount of rating being given to <?php echo $restaurant->name; ?>'
                },
                xAxis: {
                    categories: chartData2.categories,
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Rating'
                    }
                },
                plotOptions: {
                    line: {
                        colorByPoint: true,
                        colors: ['#ffc107']
                    }
                },
                series: [{
                    name: 'Rating Count',
                    data: chartData2.data

                }]
            }, function(chart2) { // callback function to customize legend
                var legendItems = chart.legend.allItems;
                for (var i = 0; i < legendItems.length; i++) {
                    legendItems[i].color = chart2.series[0].color;
                }
            });
        </script>

        <script>
            var chartData3 = <?php echo json_encode($chartData3); ?>;

            Highcharts.chart('chart3', {
                chart: {
                    type: 'area'
                },
                title: {
                    text: 'The amount of reservation in <?php echo $restaurant->name; ?>'
                },
                xAxis: {
                    categories: chartData3.categories,
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Reservation'
                    }
                },

                series: [{
                    name: 'Reservations',
                    data: chartData3.data

                }]
            }, function(chart3) { // callback function to customize legend
                var legendItems = chart.legend.allItems;
                for (var i = 0; i < legendItems.length; i++) {
                    legendItems[i].color = chart2.series[0].color;
                }
            });
        </script>
    @endif
</x-owner-layout>
