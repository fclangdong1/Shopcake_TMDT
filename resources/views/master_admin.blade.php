<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <script src="js/jquery.validate.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Admin">
    <meta name="author" content="">
    <title>Admin</title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="source/assets/dest/css/font-awesome.min.css">
    <link rel="stylesheet" href="source/assets/dest/vendors/colorbox/example3/colorbox.css">
    <link rel="stylesheet" href="source/assets/dest/rs-plugin/css/settings.css">
    <link rel="stylesheet" href="source/assets/dest/rs-plugin/css/responsive.css">
    <link rel="stylesheet" href="owlcarousel/assets/owl.carousel.min.css">
    <link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="owlcarousel/assets/owl.theme.default.min.css">
    <link href="{{url('admin/bower_components/bootstrap/dist/css/bootstrap.min.css')}}"rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="{{url('admin/bower_components/metisMenu/dist/metisMenu.min.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{url('admin/dist/css/sb-admin-2.css')}}" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="{{url('admin/bower_components/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <!-- DataTables CSS -->
    <link href="{{url('admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css')}}" rel="stylesheet">
    <!-- DataTables Responsive CSS -->
    <link href="{{url('admin/bower_components/datatables-responsive/css/dataTables.responsive.css')}}" rel="stylesheet">
    <script src="source/assets/dest/js/scripts.min.js"></script>
    
</head>




<body>
   @yield('content_admin')
   <script type="text/javascript">
        function addProduct(prd,prm)
        {
            console.log('soluong'+prd);
            console.log('id'+prm);
            $.get(
            '{{asset('addproduct/promotion')}}',{prd:prd,prm:prm},
            function()
            {
                location.reload();
            }
            );
        }    

    </script>
     <script type="text/javascript">
        function changeImg(input){
            //Nếu như tồn thuộc tính file, đồng nghĩa người dùng đã chọn file mới
            if(input.files && input.files[0]){
                var reader = new FileReader();
                //Sự kiện file đã được load vào website
                reader.onload = function(e){
                    //Thay đổi đường dẫn ảnh
                    $('#avatar').attr('src',e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(document).ready(function() {
            $('#avatar').click(function(){
                $('#img').click();  
            });
        });
    </script>  
    <script src="{{url('admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
    
    <!-- Bootstrap Core JavaScript -->
    <script src="{{url('admin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{url('admin/bower_components/metisMenu/dist/metisMenu.min.js')}}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{url('admin/dist/js/sb-admin-2.js')}}"></script>

    <!-- DataTables JavaScript -->
    <script src="{{url('admin/bower_components/DataTables/media/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js')}}"></script>
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
</body>
</html>
