<?php
namespace App\Http\Controllers;
use Illuminate\Support\Collection;
use App\Slide;
use App\Product;
use App\ProductType;
use App\Cart;
use Session;
use App\Customer;
use App\Bill;
use App\BillDetail;
use App\User;
use Hash;
use Auth;
use Carbon\Carbon;
use App\Evaluate;
use App\Promotion;
use App\Promotion_Detail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class AdminController extends Controller
{
    public function loginad()
    {
        return view('admin.login');
    }
    public function postLoginad(Request $req)
    {
    	 $this->validate($req,
            [
                'email'=>'required|email',
                'password'=>'required|min:6|max:20'
            ],
            [
                'email.required'=>'Vui lòng nhập email',
                'email.email'=>'Email không đúng định dạng',
                'password.required'=>'Vui lòng nhập mật khẩu',
                'password.min'=>'Mật khẩu ít nhất 6 kí tự',
                'password.max'=>'Mật khẩu không quá 20 kí tự'
            ]
        );
        $credentials = array('email'=>$req->email,'password'=>$req->password);
            if(Auth::attempt($credentials)){
                $Banh=DB::table('order_detail')->join('products','products.id','=','order_detail.id_product')->select( DB::raw('name,SUM(order_detail.quantity) as quantity, SUM(order_detail.price) as price') )->groupBy('name')->paginate(10); 
                 // dd($Banh);
                $KH=DB::table('orders')->join('customer','orders.id_customer','=','customer.id')->join('users','customer.id_user','=','users.id')->select( DB::raw('full_name,SUM(customer.id_user) as soluongtong, SUM(orders.total) as giatientong'))->groupBy('full_name')->paginate(10); 
                // dd($KH);
            return view('admin.indexadmin',['banh' => $Banh,'khachhang'=>$KH]);
            }
	}
    public function thongKe(){
        $Banh=DB::table('order_detail')->join('products','products.id','=','order_detail.id_product')->select( DB::raw('name,SUM(order_detail.quantity) as quantity, SUM(order_detail.price) as price') )->groupBy('name')->paginate(20); 
                 // dd($Banh);
        $KH=DB::table('orders')->join('customer','orders.id_customer','=','customer.id')->join('users','customer.id_user','=','users.id')->select( DB::raw('full_name,SUM(customer.id_user) as soluongtong, SUM(orders.total) as giatientong') )->groupBy('full_name')->paginate(10); 
        return view('admin.indexadmin',['banh' => $Banh,'khachhang'=>    $KH]);
    }
    public function showProduct()
    {
        $product=Product::all();
        return view('admin.cate_list',compact('product'));
    }
    public function deleteProduct($id)
    {
        $item=Product::find($id);
        // dd($item->name);
        $order = BillDetail::where('id_product','=',$id)->get();
        if(isset($order[0]) == false){
            $item->delete();
            $alert='Xóa thành công';
        }else{
            $alert='Sản phẩm tồn tại trong đơn hàng';
        }
       
        return redirect()->back()->with('alert',$alert);    
    }
    public function editProduct($id)
    {
        $type=ProductType::all();
         $item=Product::find($id);
         return view('admin.cate_edit',compact('item','type'));
    }
    public function editFinal(Request $req,$id)
    {
         $this->validate($req,
            [
                'name'=>'required',
                'dre'=>'required',
                'type'=>'required',
                'price'=>'required|numeric',
                'amount'=>'required|numeric',
            ],
            [
                'name.required'=>'Vui lòng nhập tên product',
                'dre.required'=>'Vui lòng nhập description',
                'price.numeric'=>'Nhập lại giá sản phẩm',
                'amount.required'=>'Nhập số lượng',
                'amount.numeric'=>'Nhập lại số lượng',
                'type.required'=>'Vui lòng chọn loại sản phẩm',
            ]);
        $product=Product::find($id);
        $product->name=$req->name;
        $product->description=$req->dre;
        $product->unit_price=$req->price;
        $product->id_type=$req->type;
        $product->new=$req->new;
        $product->amount=$req->amount;
        if($req->image != null){
           $product->image=$req->image;
        }
        $product->save();
        // dd($product);
        $alert='Sửa thành công';
        return redirect()->back()->with('alert',$alert);
    }
    public function addProduct()
    {
       
        $type=ProductType::all();
        return view('admin.cate_add',compact('type'));
    }
    public function addProductFn(Request $req)
    {
        $obj = $req;
        // dd($obj);
        $this->validate($req,
            [
                'name'=>'required|unique:products,name',
                //'description'=>'required',
                'type'=>'required',
                'price'=>'required|numeric',
                'amount'=>'required|numeric',
                // 'unit'=>'required',
            ],
            [
                'name.required'=>'Vui lòng nhập tên product',
                'name.unique'=>'Tên trùng với sản phẩm khác',
                //'description.required'=>'Vui lòng nhập description',
                'price.numeric'=>'Nhập lại giá sản phẩm',
                // 'price.numeric'=>'Nhập lại mức giảm giá',
                'amount.required'=>'Nhập số lượng',
                 'amount.numeric'=>'Nhập lại số lượng',
                'type.required'=>'Vui lòng chọn loại sản phẩm',
                 // 'unit.required'=>'Vui lòng chọn thể loại',

            ]);
        $product=new Product;
        $product->name=$req->name;
        $product->description=$req->dre;
        $product->unit_price=$req->price;
        $product->id_type=$req->type;
        $product->new=$req->new;
        $product->amount=$req->amount;
        $product->image=$req->image;
        $product->save();
        $alert = 'Thêm thành công';
        return redirect()->back()->with('alert',$alert);     
    }
    public function showTypeProduct()
    {
       $type=ProductType::all();
        return view('admin.type_list',compact('type'));
    }
    public function addTypeProduct()
    {
        return view('admin.type_add');
    }
    public function addTypeProductFn(Request $req)
    {
        $this->validate($req,
            [
                'name'=>'required',
                'dre'=>'required',
                'image'=>'required',
            ],
            [
                'name.required'=>'Vui lòng nhập loại sản phẩm',
                'dre.required'=>'Vui lòng nhập description',
                'image.required'=>'Vui lòng chọn ảnh'
            ]);

        $product=new ProductType;
        $product->name=$req->name;
        $product->description=$req->dre;
        $product->image=$req->image;
        $product->save();
        $alert='Thêm thành công';
        return redirect()->back()->with('alert',$alert);
    }
    public function deleteTypeProduct($id)
    {

        $item1=Product::where('id_type',$id);
        $item1->delete();
        $item=ProductType::find($id);
        $item->delete();
        $alert='Xóa thành công';
        return redirect()->back()->with('alert',$alert);    
    }
     public function editTypeProduct($type)
    {
         $item=ProductType::find($type);
         return view('admin.edit_type',compact('item'));
    }
    public function editTypeFinal(Request $req,$id)
    {
        $this->validate($req,
            [
                'name'=>'required',
                'dre'=>'required', 
            ],
            [
                'name.required'=>'Vui lòng nhập loại sản phẩm',
                'dre.required'=>'Vui lòng nhập description',
            ]);
        $product=ProductType::find($id);
        $product->name=$req->name;
        $product->description=$req->dre;
        if($req->image != null){
        $product->image=$req->image;
        }
        $product->save();
        $alert='Sửa thành công';
        return redirect()->back()->with('alert',$alert);
    }
    public function listOrder()
    {
        // ->orderBy('date_oder','desc')
        $order=Bill::where('status','=','0')->orWhere('status','=','3')->get();
        // dd($order);
        return view('admin.list_order',compact('order'));
    }
    public function confirmOrder($id)
    {
      
        $order=Bill::find($id);
        $item1=BillDetail::where('id_order',$id)->get();
        // dd($order);
        if($order->status == 0 || $order->status == 3){
            $order->status = 1;
            $order->id_employee = Auth::user()->id;
        }
        else if($order->status == 1){
            $order->status = 2;
            $order->id_shipper = Auth::user()->id;
        }
        $order->save();
        return redirect()->back();    
    }
    public function deleteOrder($id)
    {
        $order=Bill::find($id);
        if($order->status == 0){
            foreach ($item as $key) {
               $pr=Product::find($key->id_product);
               $pr->amount = $pr->amount +  $key->quantity;
               $pr->save();
               $item1=BillDetail::where('id_order',$key->id);
               $item1->delete();
                }
                $order->delete();
        }
        else if($order->status == 1){
            $order->status = 3;
             $order->save();
        }
         return redirect()->back(); 
    }
    public function listUser()
    {
        $user=User::all();
        return view('admin.user_list',compact('user'));
    }
     public function listCustomer()
    {
         $customer=Customer::all();
        return view('admin.customer_list',compact('customer'));
    }
    public function makePromotion()
    {
        // $date = Carbon::now()->;
        // dd($date);
        // $deletePR = Promotion::where('date_end','>',$date)->get();
        // dd($deletePR);
        // foreach ($variable as $key => $value) {
        //     # code...
        // }
        $promotion = Promotion :: all();
        return view('admin.make_promotion', compact('promotion'));
    }
    public function orderWait(){
        $order=Bill::where('status','=','1')->get();
        // dd($order);
        return view('admin.wait_order',compact('order'));
    }
     public function orderDetail($id){
        $product = DB::table('order_detail')->join('products','order_detail.id_product','=','products.id','left outer')->where('id_order','=',$id)->get();
        // dd($product);
        $ma = $id ;
        return view('admin.order_detail',compact('product','ma'));
     }
     public function orderFinish(){
        $order=Bill::where('status','=','2')->get();
        return view('admin.finish_order',compact('order'));
     }
     public function addPromotion(){
        return view('admin.promotion_add');
     }
     public function finishAddpromotion(Request $req){
         $this->validate($req,
            [
                'timestart'=>'required',
                'timeend'=>'required',
                'drep'=>'required',
                'perecent'=>'required|numeric'
            ],
            [
                'timestart.required'=>'Vui lòng chọn ngày bắt đầu',
                'timeend.required'=>'Vui lòng chọn ngày kết thúc',
                'dre.required'=>'Vui lòng nhập description',
                'perecent.require' =>'Vui lòng nhập mức giảm giá',
                'perecent.numeric' =>'Mức giảm giá nhập kí tự',
            ]);
        if($req->timestart < $req->timeend){
            $promotion = new Promotion;
            $promotion->date_start = $req->timestart;
            $promotion->date_end = $req->timeend;
            $promotion->description = $req->drep;
            $promotion->id_employee =  Auth::user()->id;
            $promotion->perecent = $req->perecent;
            $promotion->save();
            $alert='Thêm thành công';
            return redirect()->back()->with('alert',$alert);
        }else{
             $alert='Ngày bắt đầu lớn hơn ngày kết thúc';
            return redirect()->back()->with('alert',$alert);
        }
        
     }
     public function detailPromotion($id){
        $promotion = Promotion::where('promotion_code','=',$id)->first();
        $chuoi = null;
        $pr_detail = Promotion_Detail :: all();
        // dd($pr_detail == null);
        // if($pr_detail == null){
        //    dd('aaaaa');
        foreach ($pr_detail as $key ) {
            $chuoi[] = $key->id_product; 
        }
        $product = Product::whereNotIn('id',$chuoi)->paginate(4);
        // dd($product);
        $productInPro = DB::table('promotion_detail')->join('products','promotion_detail.id_product','=','products.id')->where('promotion_detail.promotion_code','=',$id)->get();
        //dd( $productInPro);
        //$productInPro = Product::whereIn('id',$chuoi)->where('promotion_code','=',$id)->paginate(4);
        return view('admin.addpr_promotion',compact('pr_detail','product','promotion','productInPro'));
     }
     public function addProductPr(Request $req){
        ////dd($req);
        $promotion = Promotion::where('promotion_code','=',$req->prm)->first();
        $Promotion_detail = new Promotion_Detail ; 
        $Promotion_detail->promotion_code = $promotion->promotion_code ;
        $Promotion_detail->id_product = $req->prd ;
        $Promotion_detail->percent = $promotion->perecent;
        $Promotion_detail->save();
     }
     public function inHoadon($ma){
         $product = DB::table('order_detail')->join('products','order_detail.id_product','=','products.id','left outer')->where('id_order','=',$ma)->get();
        $bill = Bill::where('id','=',$ma)->first();
        // dd($bill);
        return view('admin.inhoadon',compact('product','bill'));
     }
     public function quenmatkhau(){
        return view('page.quenmatkhau');
     }
     public function ressetpass(Request $req){

         $this->validate($req,
            [
                'email'=>'required|email',
                'password'=>'required|min:6|max:20',
                're_password'=>'required|same:password'

            ],
            [
                'email.required'=>'Vui lòng nhập email',
                'email.email'=>'Email không đúng định dạng',
                'password.required'=>'Vui lòng nhập mật khẩu',
                'password.min'=>'Mật khẩu ít nhất 6 kí tự',
                'password.max'=>'Mật khẩu không quá 20 kí tự',
                're_password.same'=>'Mật khẩu không giống nhau',
            ]
        );

        $user = User ::where('email','=',$req->email)->first();
            if($user->email == $req->email){
                $user->password = Hash::make($req->password);
                $user->save();
                $slide = Slide::all();
                $new_product = Product::where('new',1)->paginate(4);
                // $sanpham_khuyenmai = Product::where('sale','<>',0)->paginate(8);
                $promotion = Promotion_Detail :: all();
                // dd($promotion);
                return view('page.trangchu',compact('slide','new_product','promotion'));

            }else{
                  return redirect()->back()->with(['flag'=>'danger','message'=>'Thất bại']);
            }
     }
     public function deletePromotionpr($id){
        $promotion = Promotion_Detail::where('id_product','=',$id);
        $promotion->delete();
        return redirect()->back();
     }
}
