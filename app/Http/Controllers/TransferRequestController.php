<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransferRequest;
use App\Models\TransferRequestList;
use App\Models\InventoryOutlet;
use App\User;
use App\Models\Status;
use App\Models\AuditTrail;
use App\Models\Products;
use App\Models\Outlet;
use App\Models\UserOutlet;
use Session;
use App\CartTransferRequest;
use Log;

use DB;

class TransferRequestController extends Controller
{
    protected $transferRequest;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $users_id = User::find($user_id);
        $transfers = TransferRequest::orderBy('id','desc')->paginate(10);
        
        $outletId = DB::table('users_has_outlets')->where('users_id', $user_id)->value('outlets_id');
        $outletTransfers = TransferRequest::where('outlets_id', '=', $outletId)->get();

        return view('transfer_request.index')->with('transfers', $transfers)->with('users_id',$users_id)->with('outletTransfers',$outletTransfers);
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

        $user_id = auth()->user()->id;
        $users_id = User::find($user_id);

        //Audit Trail
        $auditTrail = AuditTrail::create([
            'action' => 'Created Transfer Request',
            'action_by' => $users_id->name,
        ]);
        

        if(!Session::has('cartTransferRequest')) {
            return view('transfer_request.create')->with('users_id',$users_id);
        } else {

            $oldTransferRequestCart = Session::get('cartTransferRequest');
            $transferRequestCart = new CartTransferRequest($oldTransferRequestCart);
            $products = $transferRequestCart->items;

            $transfers = new TransferRequest;
            $transfers->audit_trails_id = $auditTrail->id;
            $transfers->statuses_id = 1;
            $transfers->status="pending";
            $transfers->outlets_id =  $request->input('outlet');
            $transfers->date =  $request->input('transferRequestDate');
            $transfers->remarks = $transferRequestCart->remarks;
            $transfers->save();

            foreach($products as $product) {
                $transferRequestList = new TransferRequestList;
                $transferRequestList->transfer_requests_id =$transfers['id'];
                $transferRequestList->products_id = $product['item']['id'];
                $transferRequestList->quantity=$product['qty'];
                $transferRequestList->save();
            }
            Session::forget("cartTransferRequest");
        }

        return redirect('/transferrequest')->with('success', 'Transfer Request Created');
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

        $transferRequests = TransferRequest::find($id);
        $transferRequestId = TransferRequest::find($id)->id;
        $transfers = DB::table('transfer_requests')
        ->where('transfer_requests.id', '=', $transferRequestId)
        ->join('transfer_requests_list', 'transfer_requests_list.transfer_requests_id', '=', 'transfer_requests.id')
        ->join('products', 'transfer_requests_list.products_id', '=', 'products.id')
        ->get()
        ->toArray();

        return view('transfer_request.show')->with('users_id',$users_id)->with('transferRequests',$transferRequests)->with('transfers',$transfers);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_id = auth()->user()->id;
        $users_id = User::find($user_id); 

        $transferRequests = TransferRequest::find($id);
        $transferRequestId = TransferRequest::find($id)->id;
        $transfers = TransferRequestList::where('transfer_requests_id', $transferRequestId)->get();

        return view('transfer_request.edit')->with('transfers', $transfers)->with('users_id',$users_id)->with('transferRequests',$transferRequests);
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
        $login_user_id = auth()->user()->id;
        $login_user = User::find($login_user_id);
        $userRole = $login_user->roles_id;

        //Audit Trail
        $auditTrail = AuditTrail::create([
            'action' => 'Updated Transfer Request',
            'action_by' => $login_user->name,
        ]);

        if ($userRole == '1') {
            $transfer = TransferRequest::find($id);
            // $transfer->quantity = $request->input('quantity');
            $transfer->status = $request->input('status');
            $transfer->save();
        } else {
            $transfer = TransferRequest::find($id);
            $transferId = TransferRequest::find($id)->id;
            $productIds = $this->productArray($transferId);
            $outletId = DB::table('inventory_has_outlets')->select('outlets_id')->get();
            $selectedOutlet = $transfer->outlets_id;

            $getProductsArray = array_get($productIds, 0);
            $convertProductsArray = (array) $getProductsArray;
            $getProductsValue = array_get($convertProductsArray, "products_id");

            $inventory = InventoryOutlet::where('outlets_id', '=', $selectedOutlet)->where('products_id', '=', $getProductsValue)->first();
            $inventoryWarehouse = InventoryOutlet::where('outlets_id', '=', 13)->where('products_id', '=', $getProductsValue)->first();

            $oldQuantity = $this->quantityArray($selectedOutlet, $getProductsValue);

            $getQuantityArray = array_get($oldQuantity, 0);
            $convertQuantityArray = (array) $getQuantityArray;
            $getQuantityValue = array_get($convertQuantityArray, "stock_level");

            $oldWarehouse = $this->warehouseArray($getProductsValue);

            $getWarehouseArray = array_get($oldWarehouse, 0);
            $convertWarehouseArray = (array) $getWarehouseArray;
            $getWarehouseValue = array_get($convertWarehouseArray, "stock_level");

            $inventory->stock_level = $getQuantityValue + $request->input('qty');
            $inventory->save();

            $inventoryWarehouse->stock_level = $getWarehouseValue - $request->input('qty');
            $inventoryWarehouse->save();

            $transfer->status = "received";
            $transfer->save();
        }

        // return redirect('/transferrequest')->with('success', 'Request Updated');
    }

    /**
     * Remove the specified resource from storage.
     *git 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $login_user_id = auth()->user()->id;
        $login_user = User::find($login_user_id);

        //Audit Trail
        $auditTrail = AuditTrail::create([
            'action' => 'Deleted Transfer Request',
            'action_by' => $login_user->name,
        ]);

        $transfers = TransferRequest::find($id);
        $transfers->delete();

        return redirect('/transferrequest')->with('success', 'Request Removed');
    }

    public function getTransferRequestAddToCart(Request $request, $id, $quantity, $outlet, $date, $remarks) {
        $product = Products::find($id);
        $oldTransferRequestCart = Session::has('cartTransferRequest') ? Session::get('cartTransferRequest') : null;

        $transferRequestCart = new CartTransferRequest($oldTransferRequestCart);
        $transferRequestCart->add($product, $product->id, $quantity, $outlet, $date, $remarks);

        $request->session()->put('cartTransferRequest', $transferRequestCart);
        
        return redirect('transfer_request.create')->with('success', 'Added to Cart');
    }

    public function getTransferRequestCart() {
        $user_id = auth()->user()->id;
        $users_id = User::find($user_id);

        if(!Session::has('cartTransferRequest')) {
            return view('transfer_request.create')->with('users_id',$users_id);
        } else {
            $oldTransferRequestCart = Session::get('cartTransferRequest');
            $transferRequestCart = new CartTransferRequest($oldTransferRequestCart);

            //dd($transferRequestCart);
            
            return view('transfer_request.create', [
                'products' => $transferRequestCart->items
            ])->with('users_id',$users_id);
        }
    }
    public function sortDate($startDate,$endDate){
        $transferRequest = TransferRequest::select('transfer_requests.id','statuses_id','status','date','transfer_requests_number','status_name')
                     ->leftJoin('statuses','transfer_requests.statuses_id','=','statuses.id')
                     ->whereBetween('date',array($startDate,$endDate))
                     ->get()->toArray();

        return response($transferRequest);
    }
    
    public function getReduceByOne($id) {
        $oldTransferRequestCart = Session::get('cartTransferRequest');
        $transferRequestCart = new CartTransferRequest($oldTransferRequestCart);
        $transferRequestCart->reduce($id);
        Session::put('cartTransferRequest', $transferRequestCart);
        return redirect('transfer_request.create');
    }
    
    public function getRemoveItem($id) {
        $user_id = auth()->user()->id;
        $users_id = User::find($user_id);
        $oldTransferRequestCart = Session::get('cartTransferRequest');
        $transferRequestCart = new CartTransferRequest($oldTransferRequestCart);
        $transferRequestCart->removeItem($id);
        if($transferRequestCart->items == null) {
             Session::forget("cartTransferRequest");
        }
        Session::put('cartTransferRequest', $transferRequestCart);
        return view('transfer_request.create', [
                'products' => $transferRequestCart->items
            ])->with('users_id',$users_id);
    }

    public function productArray($transferId) {
        $productId = DB::table('transfer_requests_list')->where('transfer_requests_id', '=', $transferId)->select('products_id')->get()->toArray();
        return $productId;
    }

    public function warehouseArray($getProductsValue) {
        $warehouse = InventoryOutlet::where('outlets_id', '=', '13')->where('products_id', '=', $getProductsValue)->select('stock_level')->get()->toArray();
        return $warehouse;
     }

    public function quantityArray($selectedOutlet, $getProductsValue) {
        $quantity = InventoryOutlet::where('outlets_id', '=', $selectedOutlet)->where('products_id', '=', $getProductsValue)->select('stock_level')->get()->toArray();
        return $quantity;
     }

     public function exportFile($type){
        $transfers = DB::table('transfer_requests')
        ->join('transfer_requests_list', 'transfer_requests_list.transfer_requests_id', '=', 'transfer_requests.id')
        ->get()
        ->toArray();
        $data = json_decode( json_encode($transfers), true);

        return \Excel::create('transfer_request', function($excel) use ($data) {
            $excel->sheet('sheet name', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }
}