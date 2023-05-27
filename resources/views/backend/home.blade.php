@extends('backend.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Tổng quan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Thống kê</li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Số lượng sản phẩm</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div class="fs-4 fw-bold">{{count($product)}}</div>
                        <a class="small text-white stretched-link" href="{{route('product.index')}}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Tổng doanh thu</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div class="fs-4 fw-bold">{{number_format($count_order)}} VNĐ</div>
                        <a class="small text-white stretched-link" href="{{route('order.index')}}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Bình luận chưa trả lời</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div class="fs-4 fw-bold">{{$count_comment}}</div>
                        <a class="small text-white stretched-link" href="{{route('comment.index')}}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Số lượng User</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div class="fs-4 fw-bold">{{$count_user}}</div>
                        <a class="small text-white stretched-link" href="{{route('customer.index')}}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <!-- Thống kê chart theo danh mục -->
                <div id="myChart1" style="width:100%; max-width:100%; height:400px;"></div>
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script>
                    google.charts.load('current', {
                            'packages': ['corechart']
                        });
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            const data = google.visualization.arrayToDataTable([
                                ['Danh mục', 'Số lượng sản phẩm'],
                                @foreach ($thongke_cate as $tk)
                                    [' {{ "$tk->cate_name" }} ', {{$tk->SL}}],
                                @endforeach
                            ]);

                            const options = {
                                title: 'Thống kê sản phẩm theo danh mục'
                            };

                            const chart = new google.visualization.PieChart(document.getElementById('myChart1'));
                            chart.draw(data, options);
                        }
                </script>

            </div>
            <div class="col-md-6">
                <!-- Thống kê chart theo đơn hàng -->
                <div id="myChart2" style="width:100%; max-width:100%; height:400px;"></div>
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script>
                    google.charts.load('current', {
                           'packages': ['corechart']
                       });
                       google.charts.setOnLoadCallback(drawChart);

                       function drawChart() {
                           const data = google.visualization.arrayToDataTable([
                               ['Danh mục', 'Số lượng sản phẩm'],
                               @foreach ($thongke_order as $or)
                                @if($or->order_status==0)
                                    ['Chờ xác nhận', {{$or->SL}}],
                                @elseif($or->order_status==1)
                                    ['Đang giao hàng', {{$or->SL}}],
                                @elseif($or->order_status==2)
                                    ['Đã nhận hàng', {{$or->SL}}],
                                @else
                                    ['Đã hủy đơn', {{$or->SL}}],
                                @endif
                               @endforeach
                           ]);

                           const options = {
                               title: 'Thống kê đơn hàng'
                           };

                           const chart = new google.visualization.PieChart(document.getElementById('myChart2'));
                           chart.draw(data, options);
                       }
                </script>

            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Bảng đơn hàng mới
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Mã đơn hàng</th>
                            <th>Tên khách hàng</th>
                            <th>Email</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái đơn hàng</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $count = 1;
                        @endphp
                        @foreach ($order_all as $or)
                        <tr>
                            <td>{{ $count++ }}</td>
                            <td>{{ $or->code }}</td>
                            <td>{{$or->order_name}}</td>
                            <td>{{$or->customer->email}}</td>
                            <td>{{number_format($or->total)}}</td>
                            <td>
                                @if ($or->order_status==0)
                                <span class="badge bg-warning text-dark">Chờ xác nhận</span>
                                @elseif($or->order_status==1)
                                <span class="badge bg-primary">Đang giao hàng</span>
                                @elseif($or->order_status==2)
                                <span class="badge bg-success">Đã giao hàng</span>
                                @else
                                <span class="badge bg-danger">Đã hủy đơn</span>
                                @endif
                            </td>

                            <td>
                                <a href="{{route('order.edit',$or->id)}}" class="btn btn-warning">Xem chi tiết/cập nhật</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
