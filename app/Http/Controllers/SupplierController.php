<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use App\User;
use App\Setting;
use Auth;

class SupplierController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index ()
    {

        $suppliers = Supplier::orderBy('name')->paginate(100);
        
        return view('supplier.index',compact('suppliers'));

    }

    public function create()
    {
        return view('supplier.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[

            'name' => 'required',
        ]);

        $supp = New Supplier;

        $supp->name = $request->name;
        $supp->address1 = $request->address1;
        $supp->address2= $request->address2;
        $supp->address3 = $request->address3;
        $supp->town = $request->town;
        $supp->county = $request->country;
        $supp->postcode = $request->postcode;
        $supp->country = $request->country;
        $supp->contact1 = $request->contact1;
        $supp->email1 = $request->email1;
        $supp->phone1 = $request->phone1;
        $supp->mobile1 = $request->mobile1;
        $supp->contact2 = $request->contact2;
        $supp->email2 = $request->email2;
        $supp->phone2 = $request->phone2;
        $supp->mobile2 = $request->mobile2;
        $supp->website = $request->website;
        //$supp->username = $request->
        //$supp->password = $request->
        $supp->account = $request->account;
        $supp->notes = $request->notes;
        $supp->currency = 'GBP';
        $supp->vatno = $request->vatno;
        $supp->updated_by = Auth::user()->id;

        $supp->save();

        return redirect('suppliers')->with('status','New supplier was adedd successfully!');
    }

    public function show($id)
    {

        $supp = Supplier::findorfail($id);
        return view('supplier.show',compact('supp'));

    }

    public function edit($id)
    {

        $supp = Supplier::findorfail($id);
        return view('supplier.edit',compact('supp'));

    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[

            'name' => 'required',
        ]);

        $supp = Supplier::findorfail($id);

        $supp->name = $request->name;
        $supp->address1 = $request->address1;
        $supp->address2= $request->address2;
        $supp->address3 = $request->address3;
        $supp->town = $request->town;
        $supp->county = $request->country;
        $supp->postcode = $request->postcode;
        $supp->country = $request->country;
        $supp->contact1 = $request->contact1;
        $supp->email1 = $request->email1;
        $supp->phone1 = $request->phone1;
        $supp->mobile1 = $request->mobile1;
        $supp->contact2 = $request->contact2;
        $supp->email2 = $request->email2;
        $supp->phone2 = $request->phone2;
        $supp->mobile2 = $request->mobile2;
        $supp->website = $request->website;
        //$supp->username = $request->
        //$supp->password = $request->
        $supp->account = $request->account;
        $supp->notes = $request->notes;
        $supp->currency = 'GBP';
        $supp->vatno = $request->vatno;
        $supp->updated_by = Auth::user()->id;

        $supp->save();

        return redirect()->route('suppliers.edit',$id)->with('status','New supplier was updated successfully!');

    }

    public function destroy($id)
    {
        $supp = Supplier::findorFail($id);

        $supp->delete();


         return redirect('suppliers')->with('status','Supplier deleted successfully!');
    
    }
}
