@extends('master_admin')
@section('content_admin')
    <div id="wrapper">
        <!-- Navigation -->
         @include('navadmin')

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Danh sách đơn hàng
                            <small></small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Tên khách hàng</th>
                                <th>Ngày đặt hàng</th>
                                <th>Địa chỉ</th>
                                <th>Ghi chú</th>
                                <th>SDT</th>
                                <th>Tổng tiền</th>
       							<th>Xác nhận</th>
                                <th>Hủy đơn</th>
                                <th>Chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($order as $pr): ?>
                                <tr class="odd gradeX" align="center">
                                <td>{{$pr->customer->fullname}}</td>
                                <td>{{$pr->date_order}}</td>
                                <td>{{$pr->customer->address}}</td>
                                <td>{{$pr->note}}</td>
                                <td>{{$pr->customer->phone_number}}</td>
                                <td>{{number_format($pr->total)}}</td>
                                @if($pr->status == 0)
                                <td class="center"></i> <a href="{{route('confirmorder',$pr->id)}}"><img src="source/image/product/xegiaohang.jpg" style="width: 60px;height: 60px" alt=""></a></td>
                                @else
                                <td class="center"></i> <a href="{{route('confirmorder',$pr->id)}}"><img src="source/image/product/delay_car.jpg" style="width: 50px;height: 50px" alt=""></a></td>
                                @endif
                                 <td class="center"><a href="{{route('deleteorder',$pr->id)}}"><img  src="source/image/product/icon-cancel.png" style="padding-top: 10px;width: 40px;height: 40px "></a></td>
                                  <td class="center"><a href="{{route('detailorder',$pr->id)}}"><img  src="source/image/product/icon-hand-right.png" style="padding-top: 10px;width: 40px;height: 40px "></a></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    @if(session('alert'))
    <script>
        alert("{{session('alert')}}");
    </script>
    @endif
    <!-- /#wrapper -->
@endsection