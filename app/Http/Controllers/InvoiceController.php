<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use App\Supplier;
use App\User;
use App\Invoice;
use App\Setting;
use App\Myfunctions\Myfunctions;
use Illuminate\Support\Facades\Response;
use DB;
use DateTime;
use Illuminate\Support\Str;
use Storage;

class InvoiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // index
    public function index(){
        $invoices = Invoice::orderByDesc('id')->paginate(100);
        $subtotal = Invoice::sum('subtotal');
        $vat= Invoice::sum('vat');
        $total = Invoice::sum('total');
        $from = '';
        $to = '';    
        $sfrom = '';
        $sto = '';    
        return view('invoice.index',compact('invoices','subtotal','vat','total','from','to','sfrom','sto'));
    }
    // search
    public function search(Request $request){

        $from = $request->from;
        $to = $request->to;
        
        $myfuncs = New Myfunctions;

        $sfrom = ($request->filled('from')) ? $myfuncs->usDate($request->from) : '1000-01-01';
        $sto = ($request->filled('to')) ? $myfuncs->usDate($request->to) : '9999-01-01';
        

        $invoices = Invoice::where('inv_date','>=',$sfrom)
                        ->where('inv_date','<=',$sto)
                        ->OrderByDesc('id')
                        ->paginate(100);

        $subtotal = Invoice::where('inv_date','>=',$sfrom)
                           ->where('inv_date','<=',$sto)
                           ->sum('subtotal');
        $vat= Invoice::where('inv_date','>=',$sfrom)
                        ->where('inv_date','<=',$sto)
                        ->sum('vat');
        $total = Invoice::where('inv_date','>=',$sfrom)
                        ->where('inv_date','<=',$sto)
                        ->sum('total');

        return view('invoice.index',compact('invoices','subtotal','vat','total','from','to','sfrom','sto'));
       

    }
    // create 
    public function create(){
        $suppliers = Supplier::orderBy('name')->get();
        $settings = Setting::findorfail(1);
        $vatrate = $settings->vat_rate;

        return view('invoice.create',compact('suppliers','vatrate'));
    }
    // store
    public function store(Request $request){
        
        $this->validate($request,[
            'suppid' => 'required|integer|gt:0',
            'inv_date' => 'required',
            //'suppname' => 'required',
            'invno' => 'required',
            'linetotal' => 'required',
        ]);

        $myfuncs = New Myfunctions;

        $inv_date = $myfuncs->usDate($request->inv_date);
        $supp = Supplier::findorfail($request->suppid);
        $settings = Setting::findorfail(1);

        $inv = New Invoice;
        
        $inv->supp_id = $request->suppid;
        $inv->invno = $request->invno;
        $inv->inv_date = $inv_date;
        $inv->vatno = $request->vatno;
        $inv->suppname = $supp->name;
        $inv->linetotal = $request->linetotal;
        $inv->delivery = $request->delivery;
        $inv->subtotal = $request->delivery + $request->linetotal;
        $inv->vatrate = $settings->vat_rate;
        $inv->vat = $inv->subtotal * $inv->vatrate  / 100;
        $inv->total = $inv->subtotal + $inv->vat ;
        $inv->updated_by = Auth::user()->id;
        $inv->save();

        //load image
        $file = $request->file('image');

        return redirect('invoices')->with('status','New purchase invoice was adedd successfully!');
    }
    // edit
    public function edit($invid){

        $inv = Invoice::findorfail($invid);
        $suppliers = Supplier::orderBy('name')->get();
        $settings = Setting::findorfail(1);
        $vatrate = $settings->vat_rate;
        return view('invoice.edit',compact('inv','suppliers','vatrate'));
    }
    // update
    public function update(Request $request,$invid){
        $this->validate($request,[
            'suppid' => 'required|integer|gt:0',
            'inv_date' => 'required',
            'invno' => 'required',
            'linetotal' => 'required',
        ]);

        $myfuncs = New Myfunctions;
        $inv_date = $myfuncs->usDate($request->inv_date);
        $supp = Supplier::findorfail($request->suppid);
        $settings = Setting::findorfail(1);

        $inv = Invoice::findorfail($invid);
        
        $inv->supp_id = $request->suppid;
        $inv->invno = $request->invno;
        $inv->inv_date = $inv_date;
        $inv->vatno = $request->vatno;
        $inv->suppname = $supp->name;
        $inv->linetotal = $request->linetotal;
        $inv->delivery = $request->delivery;
        $inv->subtotal = $request->delivery + $request->linetotal;
        $inv->vatrate = $settings->vat_rate;
        $inv->vat = $inv->subtotal * $inv->vatrate  / 100;
        $inv->total = $inv->subtotal + $inv->vat ;
        $inv->updated_by = Auth::user()->id;
        $inv->save();

        return redirect('invoices')->with('status','New purchase invoice was updated successfully!');
    }
    // export
    public function export($from = NULL,$to = NULL){

        $sfrom = ($from <> NULL) ? $from : '1000-01-01';
        $sto = ($to <> NULL) ? $to : '9999-01-01';

        $pathToFile = 'purchase_invoices.csv';
        $name = "purchase_invoices.csv";
        $headers = array('content-type' => 'text/csv',);
        $file_handle = fOpen($pathToFile,'w+');
        fputcsv($file_handle,['INVNO','INVDATE','SUPPLIER','SUPPINVNO','SUPPVATNO','TOTALBEFOREVAT','VAT','TOTAL']);

        $invoices = Invoice::where('inv_date','>=',$sfrom)
                        ->where('inv_date','<=',$sto)
                        ->OrderByDesc('id')
                        ->get();
                        $invoices = Invoice::where('inv_date','>=',$sfrom)
                        ->where('inv_date','<=',$sto)
                        ->OrderByDesc('id')
                        ->get();

        $subtotal = Invoice::where('inv_date','>=',$sfrom)
                           ->where('inv_date','<=',$sto)
                           ->sum('subtotal');
        $vat= Invoice::where('inv_date','>=',$sfrom)
                        ->where('inv_date','<=',$sto)
                        ->sum('vat');
        $total = Invoice::where('inv_date','>=',$sfrom)
                        ->where('inv_date','<=',$sto)
                        ->sum('total');

        foreach ($invoices as $inv) {
            fputcsv($file_handle, [
                $inv->id,
                $inv->inv_date,
                $inv->suppname,
                $inv->invno,
                $inv->vatno,
                $inv->subtotal,
                $inv->vat,
                $inv->total,
            ]);
        }

        fputcsv($file_handle, [
            '',
            '',
            '',
            '',
            'Totals',
            $subtotal,
            $vat,
            $total,
        ]);
        fclose($file_handle);
        return response()->download($pathToFile, $name, $headers);
    }
    // delete confirmation
    public function deleteConfirm($invid){
        $invno = $invid;
        return view('invoice.deleteconfirm',compact('invno'));
    }

    // delete from database
    public function delete($invid){
        $inv = Invoice::findorfail($invid);

        $inv->delete();

        return redirect('invoices')->with('status','Purchase Invoice Deleted Successfully!');
    }
    
    // upload file
    public function uploadfile($invid){

        $inv = Invoice::findorfail($invid);
        return view('invoice.file',compact('inv'));
    }
    // store file
    public function storefile(Request $request,$id){

        $request->validate([
            'file' => 'required|mimes:pdf,xlx,csv|max:3072',
        ]);

        $inv = Invoice::findorfail($id);
        //$fname = Str::of($inv->suppname)->substr(0, 5).$inv->id.'_'.time().'.'.$request->file->extension();
        $fname = Str::of($inv->suppname)->substr(0, 5).$inv->id.'.'.$request->file->extension();

        $request->file->storeAs('invoices', $fname);   // storage/app/public/invoices/file.ext

        $inv->filename = $fname;
        $inv->save();
        return redirect('invoices')->with('status','File Uploaded Successfully!');
    }

    public function downloadfile($id){

        $inv = Invoice::findorfail($id);
        $name = 'invoices/'.$inv->filename;
        return Storage::download($name);

    }

}
