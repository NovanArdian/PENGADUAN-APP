@extends('layouts.layout')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/echarts@5"></script>

<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-10">
            <h1 class="text-4xl font-black text-gray-900 mb-2">
                Statistik & Grafik
            </h1>
            <p class="text-gray-600 font-medium">Visualisasi data laporan dan tanggapan</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 gradient-blue rounded-xl flex items-center justify-center shadow-md">
                        <i class="fas fa-file-alt text-white text-2xl"></i>
                    </div>
                    <span class="text-5xl font-black text-gray-900">{{ $report_count }}</span>
                </div>
                <h3 class="text-lg font-bold text-gray-700">Total Laporan</h3>
                <p class="text-sm text-gray-500 mt-1">Jumlah laporan yang masuk</p>
            </div>

            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 bg-green-600 rounded-xl flex items-center justify-center shadow-md">
                        <i class="fas fa-reply text-white text-2xl"></i>
                    </div>
                    <span class="text-5xl font-black text-gray-900">{{ $response_count }}</span>
                </div>
                <h3 class="text-lg font-bold text-gray-700">Total Tanggapan</h3>
                <p class="text-sm text-gray-500 mt-1">Jumlah tanggapan yang diberikan</p>
            </div>
        </div>

        <!-- Chart Card -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
            <div class="gradient-blue px-8 py-6">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-chart-bar mr-3 text-2xl"></i>
                    Grafik Perbandingan
                </h2>
            </div>
            <div class="p-8">
                <div id="bars_basic" style="width: 100%; height: 500px;"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var bars_basic_element = document.getElementById('bars_basic');
    if (bars_basic_element) {
        var bars_basic = echarts.init(bars_basic_element);
        bars_basic.setOption({
            title: {
                text: 'Perbandingan Laporan & Tanggapan',
                left: 'center',
                top: 20,
                textStyle: {
                    fontSize: 20,
                    fontWeight: 'bold',
                    color: '#1f2937'
                }
            },
            color: ['#1e3a8a', '#16a34a'],
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'shadow'
                },
                backgroundColor: 'rgba(255, 255, 255, 0.95)',
                borderColor: '#e5e7eb',
                borderWidth: 1,
                textStyle: {
                    color: '#1f2937',
                    fontSize: 14
                },
                padding: 12
            },
            grid: {
                left: '5%',
                right: '5%',
                bottom: '10%',
                top: '20%',
                containLabel: true
            },
            xAxis: [{
                type: 'category',
                data: ['Total Laporan', 'Total Tanggapan'],
                axisTick: {
                    alignWithLabel: true
                },
                axisLine: {
                    lineStyle: {
                        color: '#e5e7eb'
                    }
                },
                axisLabel: {
                    color: '#6b7280',
                    fontSize: 14,
                    fontWeight: 'bold'
                }
            }],
            yAxis: [{
                type: 'value',
                axisLine: {
                    lineStyle: {
                        color: '#e5e7eb'
                    }
                },
                axisLabel: {
                    color: '#6b7280',
                    fontSize: 12
                },
                splitLine: {
                    lineStyle: {
                        color: '#f3f4f6'
                    }
                }
            }],
            series: [{
                name: 'Jumlah',
                type: 'bar',
                barWidth: '40%',
                data: [
                    {
                        value: {{ $report_count }},
                        itemStyle: {
                            color: '#1e3a8a',
                            borderRadius: [8, 8, 0, 0]
                        }
                    },
                    {
                        value: {{ $response_count }},
                        itemStyle: {
                            color: '#16a34a',
                            borderRadius: [8, 8, 0, 0]
                        }
                    }
                ],
                label: {
                    show: true,
                    position: 'top',
                    color: '#1f2937',
                    fontSize: 16,
                    fontWeight: 'bold'
                }
            }]
        });

        // Resize chart on window resize
        window.addEventListener('resize', function() {
            bars_basic.resize();
        });
    }
</script>

@endsection
