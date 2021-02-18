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
                        <h1 class="page-header">Chi tiết đơn hàng
                            <small></small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Hình ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($product as $pr): ?>
                                <tr class="odd gradeX" align="center">
                                    <td>
                                        <img src="{{asset('source/image/product/'.$pr->image)}}" style="width: 150px;height: 150px">
                                    </td>
                                    <td>{{$pr->name}}</td>
                                    <td>{{$pr->quantity}}</td>
                                    <td>{{$pr->price}}</td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <form action="{{route('inhoadon',$ma)}}" method="GET">
                        <button class="btn btn-danger" style="height: 50px;width: 200px;">In hóa đơn</button>
                    </form>
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