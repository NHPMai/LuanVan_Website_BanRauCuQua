<?php


namespace App\Http\Services\Product;

use \Illuminate\Support\Facades\Log;
use App\Models\Supplier;
use Illuminate\Support\Facades\Session;


class SupplierAdminService
{
   
    /*--------------------Create----------------------------*/
    public function create($request)
    {
        // dd ($request->input('content'));
        try{
            
            Supplier::create([
                'name' => (string) $request->input('name'),
                'email' =>(string) $request->input('email'),
                'phone' => (int) $request->input('phone'),
                'website' => (string) $request->input('website'),
                'active' => (string) $request->input('active'),
            ]);

            Session::flash('success','Tạo Nhà Cung Cấp Thành Công');
        }catch (\Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        return true;
    }

    /*-----------------------GetAll-------------------------*/
    public function getAll()
    {
        return Supplier::orderbyDesc('id')->paginate(20);
    }

    /*---------------------UPDATE---------------------------*/
    public function update($request, $supplier)
    {
        try {
            $supplier->fill($request->input());
            $supplier->save();
            Session::flash('success', 'Cập Nhật Nhà Cung Cấp Thành Công');
        } catch (\Exception $err) {
            Session::flash('error', 'Cập Nhật Nhà Cung Cấp Lỗi');
            Log::info($err->getMessage());

            return false;
        }

        return true;
    }

    /*-----------------------Delete-------------------------*/
    public function delete($request)
    {
        $supplier = Supplier::where('id', $request->input('id'))->first();
        if ($supplier) {
            $supplier->delete();
            return true;
        }

        return false;
    }
    
}