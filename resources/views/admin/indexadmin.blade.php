@extends('master_admin')
@section('content_admin')

    <div id="wrapper">

        <!-- Navigation -->
         @include('navadmin')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                        <div class="col-6">
                            <h3 class="text-white">Số lượng bán được nhiều</h3>
                              <div class="card" >
                                <div class="card-body justify-content-md-center text-center">   
                                    <canvas id="myChart"  width="500" height="200" ></canvas>
                                </div>
                              </div>
                        </div>
                        <div class="col-6">
                            <h3 class="text-white">Giá bán được nhiều</h3>
                              <div class="card" >
                                <div class="card-body justify-content-md-center text-center">   
                                    <canvas id="polarArea" width="500" height="200" ></canvas>
                                </div>
                              </div>
                        </div>
                    </div>
                <!-- </div> -->
                <h1 id="list-item-2" class="text-white mt-2">Biểu Đồ thống kê khách hàng mua nhiều</h1>
                  <div class="card">
                    <div class="card-body justify-content-md-center text-center">   
                            <canvas id="myBar"></canvas>
                    </div>
                  </div>
                        
                </div>
                
            </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<script type="text/javascript">
    var ctx = document.getElementById("myChart").getContext('2d');
        var ctxx = document.getElementById("myBar").getContext('2d');
        var ctxxx = document.getElementById("polarArea").getContext('2d');
        var Soluongthanhphan=[];
        var maunen = [];
        var maunenkh = [];
        var Giatien=[];
        var Giatienkh=[];
        var ten=[];
        var khachhang=[];
        @php $i=0; @endphp
        @foreach($banh as $value)
            ten[{{$i}}]='{{$value->name}}';
            Soluongthanhphan[{{$i}}]={{$value->quantity}};
            Giatien[{{$i}}]={{$value->price*$value->quantity}};
            
            maunen[{{$i}}]='rgba('+Math.floor(Math.random() * 256) +','+Math.floor(Math.random() * 1) +','+Math.floor(Math.random() * 256)+', 1)';
            @php $i++;@endphp;
        @endforeach
        @php $i=0; @endphp
        @foreach($khachhang as $value)
            khachhang[{{$i}}]='{{$value->full_name}}';
            Giatienkh[{{$i}}]={{$value->giatientong}};
            maunenkh[{{$i}}]='rgba('+Math.floor(Math.random() * 256) +','+Math.floor(Math.random() * 256) +','+Math.floor(Math.random() * 256)+', 1)';
            @php $i++;@endphp;
        @endforeach
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ten,
                datasets: [{
                    label: 'Số lượng',
                    data: Soluongthanhphan,
                    backgroundColor: maunen,
                    borderColor:maunen,
                    borderWidth: 2
                }]
            },
        });
        console.log(myChart);
        var polarArea = new Chart(ctxxx, {
            type: 'polarArea',
            data: {
                labels: ten,
                datasets: [{
                    label: 'Số lượng',
                    backgroundColor: maunen,
                    data: Giatien,
                    borderWidth: 2
                }]
            },
        
            
        });
        var myBar = new Chart(ctxx, {
            type: 'bar',
            data: {
                labels: khachhang,
                datasets: [{
                    label: 'Giá tiền',
                    data: Giatienkh,
                    backgroundColor: maunenkh,
                    borderColor:maunenkh,
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    </script>
    <script>
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event) {
                event.preventDefault();
                $('html,body').animate({
                    scrollTop: $(this.hash).offset().top
                }, 900);
            });
        });
</script>
   @endsection
