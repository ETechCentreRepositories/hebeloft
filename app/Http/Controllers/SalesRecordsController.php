<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesRecord;
use App\Models\InventoryOutlet;
use App\Models\Products;
use Session;
use App\User;
use App\CartSalesRecord;
use App\Models\AuditTrail;
use App\Models\SalesRecordList;


class SalesRecordsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user_id = auth()->user()->id;
        $users_id = User::find($user_id);
        $salesRecords = SalesRecord::orderBy('id','asc')->paginate(10);

        return view('salesrecord.index')->with('salesRecords', $salesRecords)->with('users_id',$users_id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user_id = auth()->user()->id;
        $users_id = User::find($user_id);

        //Audit Trail
        $auditTrail = AuditTrail::create([
            'action' => 'Created Sales Record',
            'action_by' => $users_id->name,
        ]);
        
        if(!Session::has('cartSalesRecord')) {
            return view('salesrecord.create')->with('users_id',$users_id);
        } else {

            $oldSalesRecordCart = Session::get('cartSalesRecord');
            $salesrecordCart = new CartSalesRecord($oldSalesRecordCart);
            $products = $salesrecordCart->items;
            
            $salesRecord = new SalesRecord;
            $salesRecord->audit_trails_id = $auditTrail->id;
            $salesRecord->outlets_id = 1;
            $salesRecord->total_price = 1;
            $salesRecord->remarks = $request->input('remarks');
            $salesRecord->date = $request->input('salesRecordDate');
            $salesRecord->receiptNumber = $request->input('receiptNumber');
            $salesRecord->save();

            foreach($products as $product) {
                $salesRecordList = new SalesRecordList;
                $salesRecordList->sales_record_id =$salesRecord['id'];
                $salesRecordList->products_id = $product['item']['id'];
                $salesRecordList->discount = 0.00;
                $salesRecordList->quantity=$product['qty'];
                $salesRecordList->save();
            }
        }

        return redirect('/salesrecord')->with('success', 'Sales Record Created');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_id = auth()->user()->id;
        $users_id = User::find($user_id);

        $salesRecord = SalesRecord::find($id);

        return view('salesrecord.show')->with('users_id',$users_id)->with('salesRecord',$salesRecord);
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

    public function getSalesRecordAddToCart(Request $request, $id, $price, $quantity, $outlet, $date, $remarks, $receiptNumber) {
        $product = Products::find($id);
        $oldSalesRecordCart = Session::has('cartSalesRecord') ? Session::get('cartSalesRecord') : null;

        $salesrecordCart = new CartSalesRecord($oldSalesRecordCart);
        $salesrecordCart->add($product, $product->id, $price, $quantity, $outlet, $date, $remarks, $receiptNumber);

        $request->session()->put('cartSalesRecord', $salesrecordCart);
        
        return redirect()->route('/salesrecord/create/');
    }

    public function getSalesRecordCart() {
        $user_id = auth()->user()->id;
        $users_id = User::find($user_id);

        if(!Session::has('cartSalesRecord')) {
            return view('salesrecord.create')->with('users_id',$users_id);
        } else {
            $oldSalesRecordCart = Session::get('cartSalesRecord');
            $salesrecordCart = new CartSalesRecord($oldSalesRecordCart);

            return view('salesrecord.create', [
                'products' => $salesrecordCart->items
            ])->with('users_id',$users_id);
        }
    }
    
    public function sortDate($startDate,$endDate){
        $salesRecord = SalesRecord::leftJoin('outlets','sales_record.outlets_id','=','outlets.id')
                     ->whereBetween('date',array($startDate,$endDate))
                     ->get()->toArray();

        return response($salesRecord);
    }

}
