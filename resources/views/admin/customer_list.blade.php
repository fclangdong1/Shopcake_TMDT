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
                        <h1 class="page-header">User
                            <small>List</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>Tên</th>
                                <th>Địa chỉ</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php foreach ($customer as $key): ?>
                            <tr class="odd gradeX" align="center">
                                <td>{{$key->fullname}}</td>
                               <td>{{$key->address}}</td>
                                <td>{{$key->email}}</td>
                                <td>{{$key->phone_number}}</td>
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
    <!-- /#wrapper -->

    @endsection
