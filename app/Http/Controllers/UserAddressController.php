<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\UserAddress;
use App\Models\Province;
use App\Models\District;
use App\Models\Subdistrict;

class UserAddressController extends Controller
{
    // public function index()
    // {
    //     $addresses = UserAddress::all();
    //     return view('useraddress.index', compact('addresses'));
    // }
    public function index()
    {
        $addresses = Address::with(['province', 'district', 'subdistrict'])->get();
        return view('useraddress.index', compact('addresses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'subdistrict_id' => 'required|exists:subdistricts,id',
            'district_id' => 'required|exists:districts,id',
            'province_id' => 'required|exists:provinces,id',
            'postcode' => 'required|string|max:10',
            'address_type' => 'required|string|in:บ้าน,สำนักงาน',
        ]);

        Address::create($request->all());

        return redirect()->route('addresses.index')->with('success', 'ที่อยู่ถูกบันทึกเรียบร้อยแล้ว');
    }
}
