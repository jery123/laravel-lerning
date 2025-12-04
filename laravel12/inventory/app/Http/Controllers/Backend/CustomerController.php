<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function AllCustomer()
    {
        $customers = Customer::latest()->get();
        return view('admin.backend.customer.all_customer', compact('customers'));
    }

    public function AddCustomer()
    {
        return view('admin.backend.customer.add_customer');
    }

    public function StoreCustomer(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required',
            'address' => 'required',
        ]);

        Customer::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        $notification = array(
            'message' => 'Customer Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.customer')->with($notification);
    }

    public function EditCustomer($id) 
    {
        $customer = Customer::findOrFail($id);
        return view('admin.backend.customer.edit_customer', compact('customer'));
    }

    public function UpdateCustomer(Request $request)
    {
        $id = $request->id;

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers,email,'.$id,
            'phone' => 'required',
            'address' => 'required',
        ]);

        Customer::findOrFail($request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        $notification = array(
            'message' => 'Customer Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.customer')->with($notification);
    }

    public function DeleteCustomer($id)
    {
        Customer::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Customer Deleted Successfully',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }   
}
