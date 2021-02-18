<?php

namespace App\Http\Controllers;
use Hash;
use Auth;
use Socialite;
use App\SocialiteProvider;
use App\Evaluate;
use Illuminate\Http\Request;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
class PaypalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $apiContext;
    public function __construct()
    {
    
    $configPayPal = \Config::get('paypal');
    $this->apiContext = new ApiContext(
        new OAuthTokenCredential(
            $configPayPal['client_id'],
            $configPayPal['secret']
        )
    );

    $this->apiContext->setConfig($configPayPal['settings']);
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {

       //  $payment_id=$req->session()->pull('payment_id');
       // //$payment_id=Session::get('payment_id');
       // Session::forget('payment_id');
       // $execution=new PaymentExecution();
       // $execution->setPayerId($req->input('PayerId'));
       // $payment=Payment::get($payment_id,$this->apiContext);
       // try{
       //  $result=$payment->execute($execution,$this->apiContext);
       //  dd($result);
       //  if($result->getState()=='approved'){
       //      return "success";
       //  }
       // }
       // catch(PayPal\Exception\PayPalConnectionException $ex)
       // {
       //  return 'false';
       // }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $payer = new Payer();
$payer->setPaymentMethod("paypal");

$item1 = new Item();
$item1->setName('Ground Coffee 40 oz')
    ->setCurrency('USD')
    ->setQuantity(1)
    ->setSku("123123") // Similar to `item_number` in Classic API
    ->setPrice(7.5);
$item2 = new Item();
$item2->setName('Granola bars')
    ->setCurrency('USD')
    ->setQuantity(5)
    ->setSku("321321") // Similar to `item_number` in Classic API
    ->setPrice(2);

$itemList = new ItemList();
$itemList->setItems(array($item1, $item2));


$details = new Details();
$details->setShipping(1.2)
    ->setTax(1.3)
    ->setSubtotal(17.50);


$amount = new Amount();
$amount->setCurrency("USD")
    ->setTotal(20)
    ->setDetails($details);


$transaction = new Transaction();
$transaction->setAmount($amount)
    ->setItemList($itemList)
    ->setDescription("Payment description")
    ->setInvoiceNumber(uniqid());


//$baseUrl = getBaseUrl();
$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl(route("payment.create"))
    ->setCancelUrl(route("payment.create"));
$payment = new Payment();
$payment->setIntent("sale")
    ->setPayer($payer)
    ->setRedirectUrls($redirectUrls)
    ->setTransactions(array($transaction));

$request = clone $payment;

try {
    $payment->create($this->apiContext);
} catch (Exception $ex) {

   echo 'false';
    exit(1);
}

$approvalUrl = $payment->getApprovalLink();

return $payment;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
