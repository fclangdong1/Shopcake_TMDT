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
                                <th>Trả đơn</th>
                                
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
                                <td class="center"><a href="{{route('confirmorder',$pr->id)}}"><img  src="source/image/product/tick-xanh1.png" style="width: 40px;height: 40px "></a></td>
                                 <td class="center"><a href="{{route('deleteorder',$pr->id)}}"><img  src="source/image/product/icon-restore.png" style="width: 40px;height: 40px "></a></td>

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