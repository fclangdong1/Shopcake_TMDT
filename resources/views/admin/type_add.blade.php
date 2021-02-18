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
                        <h1 class="page-header">Thêm mới loại sản phẩm
                            <small></small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                         <form action="{{route('finishaddtypeproduct')}}" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}" >
                            <div class="form-group">
                                <label>Tên</label>
                                <input class="form-control" name="name" value="{{ old('name')}}"/ data-validation-error-msg='Điền tên sản phẩm'>
                            </div>
                             <div class="form-group">
                                <label>Giới thiệu</label>
                                <input class="form-control" name="dre" value="{{ old('dre')}}" />
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" class="form-control-file border" name="image" value="{{ old('image')}}">
                            </div>
                            <button type="submit" class="btn btn-success">Add type product</button>
                            @if(count($errors)>0)
                            <div class="form-group" style="color: red">
                                @foreach($errors->all() as $err)
                                {{$err}}</br>
                                @endforeach
                            </div>
                             @endif
                        <form>
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
    <script type="text/javascript">
        $.validate({

        });
    </script>
    @endif
    <!-- /#wrapper -->

    <!-- jQuery -->
@endsection
