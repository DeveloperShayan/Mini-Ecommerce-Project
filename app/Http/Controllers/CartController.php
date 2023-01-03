<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Cartalyst\Stripe\Stripe;
use SebastianBergmann\CodeCoverage\Report\Xml\Source;
use Symfony\Component\VarDumper\VarDumper;
use AmrShawky\LaravelCurrency\Facade\Currency;
use App\Models\Processing;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.checkout');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->get('product_id')) {
            return ['message'=>'Item returned', 
            'Items'=> Cart::where('user_id',auth()->user()->id)->sum('quantity')];
        }

        $product = Product::find($request->get('product_id'));
        $productFoundInCart = Cart::where('product_id',$request->get('product_id'))->pluck('id');
            if($productFoundInCart->isEmpty())
            {
                $cart = Cart::create([
                    'product_id' => $product->id,
                    'quantity' => 1,
                    'price' => $product->sale_price,
                    'user_id' => auth()->user()->id
                ]);          
            }
            else{
                $cart =  Cart::where('product_id',$request->get('product_id'))->increment('quantity');
            }


            if($cart)
            {
                return ['message'=>'Item added into the cart', 
                'Items'=> Cart::where('user_id',auth()->user()->id)->sum('quantity')];
            }
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

    public function getCartItemForCheckout()
    {
        $finalData = [];
        $amount = 0;
        $cartItems = Cart::with('product')->where('user_id',auth()->user()->id)->get();
        if (isset($cartItems)) {
            foreach ($cartItems as $cartItem) {
               if($cartItem->product)
               {
                foreach ($cartItem->product as $cartProduct) {
                    if ($cartProduct->id == $cartItem->product_id) {
                        $finalData[$cartItem->product_id]['id'] = $cartProduct->id;
                        $finalData[$cartItem->product_id]['name'] = $cartProduct->name;
                        $finalData[$cartItem->product_id]['quantity'] = $cartItem->quantity;
                        $finalData[$cartItem->product_id]['sale_price'] = $cartItem->price;
                        $finalData[$cartItem->product_id]['total'] = $cartItem->price * $cartItem->quantity;
                        $amount +=  $cartItem->price * $cartItem->quantity;
                        $finalData['totalAmount'] = $amount;
                    }
                }
               }
            }
        }
        return response()->json($finalData);
    }

    public function processPayment(Request $request){

        $first_name = $request->get('first_name');
        $last_name = $request->get('last_name');
        $address = $request->get('address');
        $country = $request->get('country');
        $zip_code = $request->get('zip_code');
        $state = $request->get('state');
        $email = $request->get('email');
        $phone = $request->get('phone');
        $city = $request->get('city');
        $card_type = $request->get('card_type');
        $expirationmonth = $request->get('expirationmonth');
        $expirationyear = $request->get('expirationyear');
        $card_number = $request->get('card_number');
        $card_code = $request->get('card_code');
        $amount = Currency::convert()
        ->from('PKR')
        ->to('USD')
        ->amount($request->get('amount'))
        ->get();
        $orders = $request->get('order');
        $ordersArray = [];
        // getting order details
        foreach ($orders as $order) {
            // dd($order['id']);
            if (isset($order['id'])) {
                $ordersArray[$order['id']]['order_id'] = $order['id'];
                $ordersArray[$order['id']]['quantity'] = $order['quantity'];
            }
        }

        // Process payment

         $stripe = Stripe::make(env('STRIPE_API_KEY'));
         $token = $stripe->tokens()->create([
            'card'=>[
            'number' =>  $card_number,
            'exp_month' => $expirationmonth,
            'exp_year' => $expirationyear,
            'cvc' => $card_code,
         ],
        ]);
        
        if (!$token['id']) {
            session()->flush('error','Stripe Token generation failed');
            return;
        }

        //create a stripe customer
        $customer = $stripe->customers()->create(
            [
                'name' => $first_name.' '.$last_name,
                'email' => $email,
                'address' => [
                    'line1' => $address,
                    'postal_code' => $zip_code,
                    'city' => $city,
                    'state' => $state,
                    'country' => $country 
                ],
                'shipping' =>[
                    'name' => $first_name.' '.$last_name,
                    'address' => [
                        'line1' => $address,
                        'postal_code' => $zip_code,
                        'city' => $city,
                        'state' => $state,
                        'country' => $country 
                    ],
                ],
                'source' => $token['id']
            ]);

            //code for charging the client in stripe.
            
            $charge = $stripe->charges()->create([
                'customer' => $customer['id'],
                'currency' => 'USD',
                'amount' => $amount,
                'description' => 'Payment for order'
            ]);
// dd($charge['status']);
            if( $charge['status'] == "succeeded")
            {
                //capture detail from stripe
                $customerIDStripe = $charge['id'];
                $amountRecord = $charge['amount'];
                

              $processingDetails =  Processing::create([
                    'client_id' => auth()->user()->id,
                    'client_name' => $first_name.' '.$last_name, 
                    'client_address' => json_encode([
                        'line1' => $address,
                        'postal_code' => $zip_code,
                        'city' => $city,
                        'state' => $state,
                        'country' => $country 
                    ]),
                    'order_details' => json_encode($ordersArray),
                    'amount'=>$amount,
                    'currency'=>$charge['currency']
                ]);

                if ($processingDetails) {
                   //clear cart after the succession of payment
                   Cart::where('user_id',auth()->user()->id)->delete();
                   return ["success"=>"Order has Placed Successfully"];
                }
            }
            else{
                return ["error"=>"Order Failed Contact Support"];
            }
    }
    

}
