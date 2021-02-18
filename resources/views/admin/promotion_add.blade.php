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
                        <h1 class="page-header">Tạo đợt giảm giá
                            <small></small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" >
                         <form action="{{route('finishaddpromotion')}}" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                             <div class="form-group">
                                <label>Ngày bắt đầu</label>
                                <input type="date" class="form-control" name="timestart" required value="{{ old('timestart')}}" />
                            </div>
                            <div class="form-group">
                                <label>Ngày kết thúc</label>
                                <input type="date" class="form-control" name="timeend" value="{{ old('timeend')}}" required />
                            </div>
                            <div class="form-group">
                                <label>Giới thiệu</label>
                                <input class="form-control" name="drep" required value="{{ old('drep')}}"/>
                            </div>
                            <div class="form-group">
                                <label>Mức giảm giá</label>
                                <input class="form-control" name="perecent" required alue="{{ old('perecent')}}" />
                            </div>
                            <button type="submit" class="btn btn-success" >Add Promotion</button>
                        <form>
                    </div>

                </div>
                @if(count($errors)>0)
                            <div class="form-group " style="color: red">
                                @foreach($errors->all() as $err)
                                {{$err}}</br>   
                                @endforeach
                            </div>
                            @endif
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
    <script type="text/javascript">
        Date timeSt = document.getElementById("timestart").value;
        Date timeEnd = document.getElementById("timestart").value;
        console.log(timeSt);
        var check = date.compare (a, b);
        if(check == 1 || check == 0){
            alert('Ngày kết thúc lơn hơn ngày bắt đầu');
        }
    </script>
     @if(session('alert'))
    <script>
        alert("{{session('alert')}}");
    </script>
    @endif
    <!-- /#wrapper -->

    <!-- jQuery -->
@endsection
