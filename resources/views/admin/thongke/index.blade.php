@extends('admin.layout')

@section('title','Báo cáo bán hàng')

@section('content')
<div class="dashboard-container">

    <h1 class="dashboard-title">Báo cáo bán hàng</h1>

    {{-- Filters --}}
    <form class="dashboard-filters" method="GET">
        <select name="year" class="filter-select">
            @foreach($years as $y)
                <option value="{{ $y }}" {{ $y==$year?'selected':'' }}>{{ $y }}</option>
            @endforeach
        </select>

        <select name="month" class="filter-select">
            <option value="">Tất cả tháng</option>
            @foreach($months as $m)
                <option value="{{ $m }}" {{ $m==$month?'selected':'' }}>T{{ $m }}</option>
            @endforeach
        </select>

        <select name="type" class="filter-select">
            <option value="ngay" {{ $type=='ngay'?'selected':'' }}>Theo ngày</option>
            <option value="thang" {{ $type=='thang'?'selected':'' }}>Theo tháng</option>
            <option value="nam" {{ $type=='nam'?'selected':'' }}>Theo năm</option>
        </select>

        <button type="submit" class="btn btn-coffee btn-filter">Lọc</button>
    </form>

    {{-- Summary --}}
    <div class="summary-cards">
        <div class="card card-orders">
            <h5>Số đơn đặt hàng</h5>
            <h3>{{ $tongDon }}</h3>
        </div>
        <div class="card card-revenue">
            <h5>Tổng doanh thu</h5>
            <h3>{{ number_format($tongDoanhThu) }} đ</h3>
        </div>
    </div>

    {{-- Charts --}}
    <div class="charts-container">
        <div class="chart-card">
            <h5>Số đơn theo thời gian</h5>
            <canvas id="ordersChart"></canvas>
        </div>
        <div class="chart-card">
            <h5>Doanh thu theo thời gian</h5>
            <canvas id="revenueChart"></canvas>
        </div>
        <div class="chart-card">
            <h5>Số đơn theo trạng thái</h5>
            <canvas id="statusChart"></canvas>
        </div>
    </div>

    {{-- Hidden Data --}}
    <div id="chartData"
         data-labels='@json($labels)'
         data-orders='@json($soDonData)'
         data-revenue='@json($doanhThuData)'
         data-status='@json($statusData)'
         style="display:none"></div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const chartDataEl = document.getElementById('chartData');
    const labels = JSON.parse(chartDataEl.dataset.labels);
    const orders = JSON.parse(chartDataEl.dataset.orders);
    const revenue = JSON.parse(chartDataEl.dataset.revenue);
    const status = JSON.parse(chartDataEl.dataset.status);

    // === Orders Chart ===
    new Chart(document.getElementById('ordersChart').getContext('2d'), {
        type: 'line',
        data: { labels: labels, datasets:[{
            label:'Số đơn',
            data: orders,
            borderColor:'#6f4e37',
            backgroundColor:'rgba(111,78,55,0.2)',
            fill:true,
            tension:0.3,
            pointRadius:5,
            pointHoverRadius:7
        }]},
        options:{responsive:true, plugins:{legend:{display:false}}, scales:{y:{beginAtZero:true}, x:{grid:{display:false}}}}
    });

    // === Revenue Chart ===
    new Chart(document.getElementById('revenueChart').getContext('2d'), {
        type:'bar',
        data:{ labels:labels, datasets:[{
            label:'Doanh thu',
            data: revenue,
            backgroundColor:'#d9b382'
        }]},
        options:{responsive:true, plugins:{legend:{display:false}}, scales:{y:{beginAtZero:true}, x:{grid:{display:false}}}}
    });

    // === Status Chart ===
    new Chart(document.getElementById('statusChart').getContext('2d'), {
        type:'doughnut',
        data:{ labels:status.labels, datasets:[{
            data:status.data,
            backgroundColor:['#f0ad4e', 'rgba(255, 129, 51, 1)', '#5cb85c','#d9534f']
        }]},
        options:{
            responsive:true,
            plugins:{legend:{position:'bottom'}},
            cutout:'50%'
        }
    });

});
</script>
@endsection
