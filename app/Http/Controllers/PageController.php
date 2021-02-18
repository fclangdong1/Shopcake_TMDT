<?php

namespace App\Http\Controllers;
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
use Socialite;
use App\Promotion;
use App\Promotion_Detail;
use App\SocialiteProvider;
use App\Evaluate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class PageController extends Controller
{
    
    public function getIndex(){

        $test = DB::table('products')->join('promotion_detail','promotion_detail.id_product','=','products.id','left outer')->select('promotion_detail.percent','name')->get();
        // dd($test);
        $slide = Slide::all();

        $new_product = DB::table('products')->join('promotion_detail','promotion_detail.id_product','=','products.id','left outer')->select('promotion_detail.percent','name','id','description','amount','image','unit_price')->where('new','=','1')->paginate(4);
        // $sanpham_khuyenmai = Product::where('sale','<>',0)->paginate(8);
        $promotion = Promotion_Detail :: all();
        // dd($promotion);
        return view('page.trangchu',compact('slide','new_product','promotion'));
    }

    public function getLoaiSp($type){
        $sp_theoloai = DB::table('products')->join('promotion_detail','promotion_detail.id_product','=','products.id','left outer')->select('promotion_detail.percent','name','id','description','amount','image','unit_price')->where('id_type','=',$type)->get();
        $sp_khac = DB::table('products')->join('promotion_detail','promotion_detail.id_product','=','products.id','left outer')->select('promotion_detail.percent','name','id','description','amount','image','unit_price')->where('id_type','=',$type)->paginate(3);
        $loai = ProductType::all();
        $loap_sp = ProductType::where('id',$type)->first();
    	return view('page.loai_sanpham',compact('sp_theoloai','sp_khac','loai','loap_sp'));
    }
    public function addComment(Request $req ,$id)
    {
        if(Auth::check()){
            $cmt=new Evaluate();
            $cmt->id_product=$id;
            $cmt->id_user=Auth::user()->id;
            $cmt->cmt=$req->cmtt;
            $cmt ->save();
             return redirect()->back();
        }
      else{
        return view('page.dangnhap');
      }
    }
    public function getChitiet($id){

        $best = Product::where('id','<','5')->get();

        $new=Product::where('id','<','5')->get();

        $sanpham = Product::where('id', '=', $id)->first();

        $cmt=Evaluate::where('id_product',$id)->paginate(2);

        $sp_tuongtu = Product::where('id_type',$sanpham->id_type)->paginate(6);
        // dd($sp_tuongtu);
    	return view('page.chitiet_sanpham',compact('sanpham','sp_tuongtu','cmt','best','new'));

    }
    
    public function getLienHe(){
    	return view('page.lienhe');
    }

    public function getGioiThieu(){
    	return view('page.gioithieu');
    }
    public function searchProduct(Request $req){
        $slide = Slide::all();
        $foo = preg_replace('/\s+/', ' ', $req->search);
        // dd($foo);
        $search=Product::where('name', 'like', '%'.$foo.'%')->get();
        return view('page.search',compact('search','slide'));
    }
    
    public function getDelItemCart($id){
        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items)>0){
            Session::put('cart',$cart);
        }
        else{
            Session::forget('cart');
        }
        return redirect()->back();
    }
    public function getAddtoCart(Request $req,$id){
        $product = Product :: find($id);
        $promotion = Promotion_Detail :: where ('id_product','=',$id)->first();
        $oldCart = Session('cart')?Session::get('cart'):null;
        $soluong = 1;
        $cart = new Cart($oldCart);
        
        $cart->add($product, $id, $promotion,$soluong); 
        $req->session()->put('cart',$cart);
        return redirect()->back();
    }
    public function addQty(Request $req)
    {
        // dd($req->id);
        $id = $req->id;
        $product = Product :: find($id);
        $promotion = Promotion_Detail :: where ('id_product','=',$id)->first();
       
        $oldCart = Session('cart')?Session::get('cart'):null;
        // dd($id);

        $oldCart->totalQty =$req->qty + $oldCart->totalQty - $oldCart->items[$id]['qty'];
        $oldCart->items[$id]['qty'] = $req->qty;
        if( $promotion == null){
            $oldCart->items[$id]['price'] = $req->qty * $product->unit_price;
        } 
        else{
            $oldCart->items[$id]['price'] = $req->qty * ($product->unit_price - ($product->unit_price * $promotion->percent)/100);
        }
        $price = 0;
        foreach ($oldCart->items as $key => $value){
              $price += $value['price'];
          }
        $oldCart->totalPrice = $price;
        // dd($oldCart);
        // dd($oldCart);
        // dd($oldCart->items[64]['qty']);
        // $soluong = $req->qty;
        // $cart = new Cart($oldCart);
        // $cart->add($product, $id, $promotion,$soluong);
        // $req->session()->put('cart',$cart);
    }
    public function getCheckout(){
          if(Auth::check()){
                $id=Auth::user()->id;
                $userr=User::where('id',$id)->first();
                return view('page.dat_hang',compact('userr'));
        }
        else
        {
            return view('page.dangnhap');
        }
    }

    public function postCheckout(Request $req){
         $cart = Session::get('cart');
          foreach ($cart->items as $key => $value){
            $product = Product :: find($key);
             // dd($product->amount);
            if($value['qty'] > $product->amount){
                return redirect()->back()->with('thongbao','Số lượng bánh vượt quá số lượng trong kho');
            }
          }
         
          if(Auth::check()){
            $cus= Customer::where('email',$req->email);
            // if($cus!=null)
            // {
            // $cus->name = $req->name;
            // $cus->gender = $req->gender;
            // $cus->address = $req->address;
            // $cus->phone_number = $req->phone;
            // $cus->note = $req->notes;
            // $cus->save();
            // }
            // else
            // {
            $customer = new Customer;
            $customer->id_user=Auth::user()->id;
            $customer->fullname = $req->name;
            $customer->email = $req->email;
            $customer->address = $req->address;
            $customer->phone_number = $req->phone;
            $customer->note = $req->notes;
           
            $customer->save();
            // }
            
            $bill = new Bill;

            $bill->id_customer = $customer->id;
            $bill->date_order = date('Y-m-d');
            $bill->total = $cart->totalPrice;
            $bill->note = $req->notes;
            $bill->status = 0;
            $bill->id_employee  = 0; 
            $bill->id_shipper = 0;
            $bill->save();
           
            foreach ($cart->items as $key => $value) {

                $product=Product::find($key);
                $product->amount=$product->amount - $value['qty'];
                $product->save();
                $bill_detail = new BillDetail;
                $bill_detail->id_order = $bill->id;
                $bill_detail->id_product = $key;
                $bill_detail->quantity = $value['qty'];
                $bill_detail->price = ($value['price']);
                $bill_detail->save();
            }

            Session::forget('cart');
            return redirect()->back()->with('thongbao','Đặt hàng thành công');
        }
        else
        {
            return view('page.dangnhap');
        }
}
    public function getLogin(){
        return view('page.dangnhap');
    }
    public function getSignin(){
        return view('page.dangki');
    }

    public function postSignin(Request $req){
        $this->validate($req,
            [
                'email'=>'required|email|unique:users,email',
                'password'=>'required|min:6|max:20',
                'fullname'=>'required',
                're_password'=>'required|same:password'
            ],
            [
                'email.required'=>'Vui lòng nhập email',
                'email.email'=>'Không đúng định dạng email',
                'email.unique'=>'Email đã có người sử dụng',
                'password.required'=>'Vui lòng nhập mật khẩu',
                're_password.same'=>'Mật khẩu không giống nhau',
                'password.min'=>'Mật khẩu ít nhất 6 kí tự'
            ]);
        $user = new User();
        $user->full_name = $req->fullname;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->phone = $req->phone;
        $user->position='0';
        $user->address = $req->address;
        $user->save();
        return redirect()->back()->with('thanhcong','Tạo tài khoản thành công');
    }

    public function postLogin(Request $req){
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
            $slide = Slide::all();
            $new_product = Product::where('new',1)->paginate(4);
            // $sanpham_khuyenmai = Product::where('sale','<>',0)->paginate(8);
            $promotion = Promotion_Detail :: all();
            // dd($promotion);
            return view('page.trangchu',compact('slide','new_product','promotion'));
                
            }
            else{
                    return redirect()->back()->with(['flag'=>'danger','message'=>'Đăng nhập không thành công']);
                }
            
        }
    
    public function postLogout(){
        Auth::logout();
        return redirect()->route('trang-chu');
    }
     public function redirectToProvider($providers)
     {
         return Socialite::driver($providers)->redirect();
     }
     public function handleProviderCallback($provider)
     {
        try
        {
            $socialiteUser=Socialite::with($provider)->user();
        }
        catch(Exception $e)
        {
            return redirect()->route('trangchu')->with(['flash_level'=>'danger','flash_message'=>"Đăng nhập thành công"]);
        }
        $socialiteProvider=SocialiteProvider::where('provider_id',$socialiteUser->getId())->first();
        if(!$socialiteProvider)
        {
            //tạo mới
            $user=User::where('email',$socialiteUser->getEmail())->first();
            if($user)
            {
                return redirect()->route('trangchu')->with(['flash_level'=>'danger','flash_message'=>"Đăng nhập thành công"]);
            }
            else
            {
                $user=new User();
                $user->email=$socialiteUser->getEmail();
                $user->full_name=$socialiteUser->getName();
                $user->save();
            }
        }
        else{
            $user=User::where('email',$socialiteUser->getEmail())->first();
        }
        Auth()->login($user);
        return redirect()->route('trangchu')->with(['flash_level'=>'succces','flash_message'=>"Đăng nhập thành công"]);
     }
}
