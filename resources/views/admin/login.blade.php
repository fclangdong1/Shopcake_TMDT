@extends('master_admin')
@section('content_admin')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="text-info">Đăng nhập hệ thống</h3>
                        @if(Session::has('flag'))
                        <div><h6 style="color: red">{{Session::get('message')}}</h6></div>
                        @endif
                    </div>
                    <div class="panel-body">
                        <form role="form" action="{{route('loginad')}}" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Tài khoản" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Mật khẩu" name="password" type="password" value="">
                                </div>
                                <button type="submit" class="btn btn-lg btn-success btn-block">Đăng nhập</button>
                            </fieldset>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
  @endsection
