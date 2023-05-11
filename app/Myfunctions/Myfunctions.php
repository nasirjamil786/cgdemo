<?php
/**
 * Created by PhpStorm.
 * User: nasirj
 * Date: 10/05/2016
 * Time: 12:34
 */

namespace app\myfunctions;
use App\Order;
use App\Orline;
use App\Customer;
use App\Quote;
use App\Qline;
use App\Setting;
use Illuminate\Support\Facades\Storage;

class myfunctions
{

    //convert input UK date to ISO or US Date

    public function usDate($ukDate){

        if($ukDate){
            $parts = explode('/',$ukDate);   //e.g 23/01/2015
            $usDate = $parts[2].'-'.$parts[1].'-'.$parts[0];  //e.g 2015-01-23
            return $usDate;
        }
        
        return $ukDate;
    }


    public function updateOrderTotals($order_id){
        
        $order = Order::findorfail($order_id);
        $cust_id = $order->customer_id;
        $orlines = Orline::where('order_id',$order_id)->get();        
        $settings = Setting::findorfail(1);

        $line_total = 0;
        $service_total = 0;
        $cost_vat = 0;
        foreach($orlines As $ol){
            
            $line_total = $line_total + $ol->value;
            $cost_vat = $cost_vat + $ol->cost_vat;

            if ($ol->item_notes != NULL && $ol->item_notes == "labour") {
                $service_total = $service_total + $ol->value;
            }
        }

        $order->line_total = $line_total;
        $order->discount = ($order->discount_percent * $service_total / 100);
        $order->total_beforevat = $line_total + $order->delivery_charge - $order->discount;
        $order->vat = $order->total_beforevat * $settings->vat_rate / 100;
        $order->cost_vat = $cost_vat;
        $order->order_total = $order->total_beforevat + $order->vat;
        $order->save();

        $this->custBalance($cust_id);

    }

    public function custBalance($custid){

        $customer = Customer::findorfail($custid);
        $orders = Order::where('customer_id',$custid)->get();

        $ord_total = 0;
        $paid = 0;
        foreach ($orders as $o) {
            $ord_total = $ord_total + $o->order_total;
            $paid = $paid + $o->payment;
        }

        $customer->account_total = $ord_total;
        $customer->outstand_balance = $ord_total - $paid;
        
        $customer->save();

    }

    public function updateQuoteTotals($quoteid){

          $quote = Quote::findorfail($quoteid);
          $qlines = Qline::where('quote_id',$quote->id)->get();
          $settings = Setting::findorfail(1);

          $qtotal = 0.00;
          $total_beforevat = 0.00;
          $cost_vat = 0.00;
          foreach ($qlines as $ql) {

              //Becuae in the qline model we have used number_format therefore 
              // it always get value as character and if it has a comma then it cause a problem
              // we need to convert back it to decimal 

              //$qtotal = $qtotal + (float) str_replace(',', '', $ql->value);
              $total_beforevat = $total_beforevat + $ql->value;
              $cost_vat = $cost_vat + $ql->cost_vat;
              
          }

          $quote->total_beforevat = $total_beforevat;
          $quote->vat = $total_beforevat * $settings->vat_rate / 100 ;
          $quote->cost_vat = $cost_vat;
          $quote->quote_total = $total_beforevat + ($total_beforevat * $settings->vat_rate / 100);
          $quote->save();

    }

    public function storeSignature($orderid,$signature){


      //Validation ordeid and signature must not be null
      if($orderid != null && $orderid != 0 && $signature != NULL) {

          $folderPath = storage_path('signatures/');
    
          $image_parts = explode(";base64,", $signature);
          $image_type_aux = explode("image/", $image_parts[0]);
          $image_type = $image_type_aux[1];
          $image_base64 = base64_decode($image_parts[1]);

          $fileName = $orderid . '.' . $image_type;

          //Storage::put('/signatures/'.$fileName,$image_base64);
          //$filePath = Storage::url($fileName);
    
          $file = $folderPath . $fileName;

          file_put_contents($file, $image_base64);

         return $fileName;

      } else {

        return NULL;
      }


      $folderPath = public_path('upload/');
    
      $image_parts = explode(";base64,", $request->signed);
          
      $image_type_aux = explode("image/", $image_parts[0]);
        
      $image_type = $image_type_aux[1];
        
      $image_base64 = base64_decode($image_parts[1]);
        
      $file = $folderPath . uniqid() . '.'.$image_type;
      file_put_contents($file, $image_base64);





    }

}