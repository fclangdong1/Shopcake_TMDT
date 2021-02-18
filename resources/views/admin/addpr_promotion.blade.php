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
                        <h1 class="page-header">THÊM SẢN PHẨM 
                            <small></small>
                        </h1>
                    </div>
                    <div class="space50">&nbsp;</div>
                    <!-- /.col-lg-12 -->
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Tên</th>
                                <th scope="col">Thể Loại</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Số lượng tồn</th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php foreach ($product as $pr): ?>
                                <tr scope="row">
                                <td>{{$pr->name}}</td>
                                <td>{{$pr->name}}</td>
                                <td>{{$pr->unit_price}}</td>
                                <td>{{$pr->amount}}</td>
                                <td><button class="btn btn-primary" onclick="addProduct('{{$pr->id}}','{{$promotion->promotion_code}}')">Add</button></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <div class="row">{{$product->links()}}</div>
                </div>
                <div class="row" style="height: 2px;background-color: black;"></div>
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">SẢN PHẨM TRONG ĐỢT
                            <small></small>
                        </h1>
                    </div>
                    <div class="space50">&nbsp;</div>
                    <!-- /.col-lg-12 -->
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tên</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Số lượng tồn</th>
                                <th scope="col">Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php foreach ($productInPro as $pr): ?>
                                <tr scope="row">
                                <td>{{$pr->id}}</td>
                                <td>{{$pr->name}}</td>
                                <td>{{$pr->unit_price}}</td>
                                <td>{{$pr->amount}}</td>
                                <td><a href="{{route('deletepromotion',$pr->id)}}">Xóa</a></td>
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