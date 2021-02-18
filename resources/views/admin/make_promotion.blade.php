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
                        <h1 class="page-header">Đợt khuyến mãi
                            <small></small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Đợt khuyến mãi</th>
                                <th>Ngày bắt đầu</th>
                                <th>Ngày kết thúc</th>
                                <th>Người tạo</th>
                                <th>Mức giảm giá</th>
                                <th>Chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($promotion as $pr): ?>
                                <tr class="odd gradeX" align="center">
                                <td>{{$pr->description}}</td>
                                <td>{{$pr->date_start}}</td>
                                <td>{{$pr->date_end}}</td>
                                <td>{{$pr->users->full_name}}</td>
                                <td>{{$pr->perecent}}</td>
                                <td><a href="{{route('detailpromotion',$pr->promotion_code)}}">Detail</a></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <form action="{{route('addpromotion')}}">
                        <button class="btn btn-warning" >Tạo sự kiện mới</button>
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