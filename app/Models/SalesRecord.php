<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesRecord extends Model
{
    //Table 
    protected $table = 'sales_record';

    protected $fillable = [
        'outlets_id','total_price','total_discount', 'remarks',
    ];

    //Timestamps
    public $timestamps = false;

    public $products = null;
    public $sales_record_id = 0;
    public $quantity = 0;
    public $discount = 0;
    public $total = 0;

    public function __construct($oldSalesRecordCart){
        if($oldSalesRecordCart){
            $this->products = $oldSalesRecordCart->products;
            $this->sales_record_id = $oldSalesRecordCart->sales_record_id;
            $this->quantity = $oldSalesRecordCart->quantity;
            $this->discount = $oldSalesRecordCart->discount;
            $this->total = $oldSalesRecordCart->total;

        }
    }

    public function add($product, $id){
        $storedProduct = ['sales_record_id' => 0, 'quantity' => 0, 'discount' => 0, 'total' => 0];
        if($this->product){
            if(array_key_exists($id,$this->products)){
                $storedProduct = $this->products[$id];
            }
        }
        $storedProduct['total'] = $products->quantity * $storedProduct['quantity'];
        $this->products[$id] = $storedProduct;
    }

    public function salesRecordLists(){
        return hasMany('\App\Models\SalesRecordList');
    }
}
