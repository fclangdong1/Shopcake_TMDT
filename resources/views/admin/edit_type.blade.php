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
                        <h1 class="page-header">Sửa danh mục
                            <small>Tin Tức</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="{{route('edittypefn',$item->id)}}" method="GET">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Tên</label>
                                <input class="form-control" name="name" value="{{$item->name}}" />
                            </div>
                             <div class="form-group">
                                <label>Giới thiệu</label>
                                <input class="form-control" name="dre" value="{{$item->description}} "/>
                            </div>
                            <div class="form-group">
                                <label>Ảnh</label>
                                <input  id="img" type="file" name="image" class="form-control hidden" onchange="changeImg(this)">
                                <img id="avatar" class="thumbnail" width="300px" src="{{asset('source/image/product/'.$item->image)}}">
                            </div>
                            <button type="submit" class="btn btn-success">Cập nhật</button>
                        <form>
                            @if(count($errors)>0)
                            <div class="form-group">
                                @foreach($errors->all() as $err)
                                {{$err}}</br>
                                @endforeach
                            </div>
                             @endif
                    </div>
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

    <!-- jQuery -->
  @endsection