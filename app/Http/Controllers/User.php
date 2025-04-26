<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\FuncCall;

use function Laravel\Prompts\password;

class User extends Controller
{   
    
    public function submitdata(Request $request){
        $name=$request->input('name');
        //echo $name;
        $username = $request -> input('username');
        $password = $request ->input('password');
        $email = $request ->input('email');
        $phone = $request ->input('phone');
        DB::table('users')->insert([
            'full_name' => $name,
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'phone' => $phone
        ]);
        return redirect('/login') -> with('Success','Registered Successfully');
    }

    public function login_user(Request $request){
        $username = $request -> input('username');
        $pass = $request -> input('password');
        $user = DB::table('users')
        ->where('username',$username)
        ->where('password',$pass)->first(); 
        if($user && $user->username == 'admin' && $user->password == "admin"){
            session(['admin' => true]);
            session(['username'=> $user->username]);
            session(['id'=> $user->user_id]);
            session(['full_name'=> $user->full_name]);
            return redirect('/admin');
        }
        if($user){
            session(['id'=> $user->user_id]);
            session(['username'=> $user->username]);
            session(['full_name'=> $user->full_name]);
            return redirect('/search');
        }
        else{
            return redirect()->Back()->with('Fail','Incorrect Credentials');
        }
    }

    function logout(){
        Session::flush();
        return redirect('/login');
    }

    public function checkemail(Request $request) {
        $email = $request -> input('email');
        $user = DB::table('users')
        ->where('email',$email)->first();
        if($user){
            return 'fail';
        } 
    }

    public function delete_flight(Request $request) {
        $id = $request->id;
        DB::table('seats')->where('flight_id', $id)->delete();
        DB::table('bookings')->where('flight_id', $id)->delete();
        DB::table('flights')->where('flight_id', $id)->delete();

        return redirect()->back()->with("success", "Done");
    }

    public function add_flight(Request $request) {
            
        DB::table('flights')->insert([
            'airline_id' => $request->airline_id,
            'flight_number' => $request->flight_number,
            'departure_airport' => $request->departure_airport,
            'arrival_airport' => $request->arrival_airport,
            'departure_time' => $request->departure_time,
            'arrival_time' => $request->arrival_time,
            'total_seats' => 50,
            'available_seats' => $request->total_seats,
            'price' => $request->price,
        ]);
        
        return 'success';
        
    }

    public function search_flight(Request $request) {
        $from = $request->input('from');
        $to = $request->input('to');
        $departureDate = $request->input('departure'); 
        $returnDate = $request->input('return'); 
        $airline = $request->input('airline'); 
        $departureDate = \Carbon\Carbon::parse($departureDate)->toDateString();

        $query = DB::table('flights')
            ->join('airlines', 'flights.airline_id', '=', 'airlines.airline_id')
            ->where('departure_airport', $from)
            ->where('arrival_airport', $to)
            ->whereDate('departure_time', $departureDate);
        
        $flights = $query->select('flights.*', 'airlines.airline_name')->get();
    
        return view('show_flights', compact('flights'));      
    }
   
    public function book_flight(Request $request) {
        
    
        return view('book_flight');      
    }

    public function shop(){
        $shop_list = DB::table('frequent_medicine')->get();

        return view('shop', compact('shop_list'));
    }
    
    public function add_medicine(Request $request){
        $name = $request->input('name');
        $medicine_gm = $request->input('medicine_gm');
        $uses = $request->input('uses');
        $tables = $request->input('tables');
        $price = $request->input('price');
    
        DB::table('frequent_medicine')->insert([
            'name' => $name,
            'medicine_in_each_page' => $medicine_gm,
            'uses' => $uses,
            'tablets_in_pack' => $tables,
            'price_per_pack' => $price
        ]);
    
        return redirect('/shop')->with('success', 'Medicine added successfully!');
    }
    
   
    public function addcart($id)
    {
        $id = $id;
        $user = DB::table('cart')
        ->where('medicine_id',$id)
        ->first();
        
        if(!$user){
            DB::table('cart')->insert([
                'user_id'=>session('id'),
                'medicine_id'=>$id,
            ]);
            return redirect()->Back()->with('Success','Cart Successfully');
        } 
        else{
            
            return redirect()->back()->with('Fail','Alredy in Your Cart');
        }    
    }

    public function show_cart()
    {
        $cartItems = DB::table('cart')
            ->join('frequent_medicine', 'cart.medicine_id', '=', 'frequent_medicine.id')
            ->select('cart.*', 'frequent_medicine.name', 'frequent_medicine.price_per_pack','cart.quantity')  
            ->get();
        
        return view('cart', compact('cartItems'));
    }

    function addqty($cart_id)
    {
        DB::table('cart')
            ->where('cart_id', $cart_id)
            ->increment('quantity', 1); 

        return redirect()->back()->with("success", "Item quantity updated");
    }

    function remqty($cart_id)
    {
        $item = DB::table('cart')->where('cart_id', $cart_id)->first();

    if ($item) {
        if ($item->quantity <= 1) {
            return redirect()->route('removecart', ['id' => $cart_id]);
        } else {
            // Otherwise, decrement the quantity
            DB::table('cart')
                ->where('cart_id', $cart_id)
                ->decrement('quantity', 1);
            return redirect()->back()->with("success", "Item quantity updated");
        }
    }

    return redirect()->back()->with("error", "Item not found in cart");
    }

    function removecart($cart_id)
    {
        DB::table('cart')->where('cart_id',$cart_id)->delete();
        return redirect()->back()->with("success", "Item deleted");
    }

    
}