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
                        <h1 class="page-header">Danh sách danh mục
                            <small></small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Tên</th>
                                <th>Loại</th>
                                <th>Giới thiệu</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Ảnh</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($product as $pr): ?>
                                <tr class="odd gradeX" align="center">
                                <td>{{$pr->name}}</td>
                                <td>{{$pr->product_type->name}}</td>
                                <td>{{$pr->description}}</td>
                                <td>{{$pr->unit_price}}</td>
                                <td>{{$pr->amount}}</td>
                                <td>
                                    <img src="source/image/product/{{$pr->image}}" style="width: 150px;height: 150px">
                                </td>
                                <td class="center"><a href="{{route('deleteproduct',$pr->id)}}"><img  src="source/image/product/icon-cancel.png" style="padding-top: 10px;width: 40px;height: 40px "></a></td>
                                <td class="center"><a href="{{route('editproduct',$pr->id)}}"><img  src="source/image/product/icon-edit.png" style="padding-top: 10px;width: 40px;height: 40px "></a></td>
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