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
                        <h1 class="page-header">Thêm mới sản phẩm
                            <small></small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                         <form action="{{route('finishaddproduct')}}" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Tên</label>
                                <input class="form-control" name="name" value="{{ old('name') }}" required/>
                            </div>
                             <div class="form-group">
                                <label>Giới thiệu</label>
                                <input class="form-control" name="dre" value="{{ old('dre')}}"/> 
                            </div>
                            <div class="form-group">
                                <label>Loại</label></br>
                                <input list="browsers" name="type" value="{{ old('type')}}" required>
                                  <datalist id="browsers">
                                    @<?php foreach ($type as $key ): ?>
                                         <option value="{{$key->id}}">{{$key->name}}</option>
                                    <?php endforeach ?>
                                  </datalist>
                            </div>
                            <div class="form-group">
                                <label>Giá</label>
                                <input class="form-control" name="price" value="{{ old('price')}}" required/>
                            </div>
                            <div class="form-group">
                                <label>Số lượng</label>
                                <input class="form-control" name="amount" value="{{ old('amount')}}" required/>
                            </div>
                             <div class="form-group">
                                <label>Sản phẩm mới</label></br>
                                <input list="newss" name="new" value="{{ old('new')}}" required />
                                  <datalist id="newss">
                                    <option value="1">Mới</option>
                                    <option value="0">Cũ</option>
                                  </datalist>
                            </div>
                            <div class="form-group">
                                <label>Ảnh</label>
                                <input type="file" class="form-control-file border" name="image" value="{{ old('image')}}" required>
                            </div>
                            @if(count($errors)>0)
                            <div class="form-group " style="color: red">
                                @foreach($errors->all() as $err)
                                {{$err}}</br>   
                                @endforeach
                            </div>
                            @endif
                            <button type="submit" class="btn btn-success">Thêm</button>
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
    @endif
    <!-- /#wrapper -->

    <!-- jQuery -->
@endsection
