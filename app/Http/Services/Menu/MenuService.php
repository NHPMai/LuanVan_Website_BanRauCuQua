<?php


namespace App\Http\Services\Menu;

use App\Models\Menu;
use Illuminate\Support\Facades\Session; 
use Illuminate\Support\Str;

class MenuService
{
    public function getParent()
    {
        return Menu::where('parent_id',0)->get();
    }

    public function show()
    {
        // return Menu::select('name','id')
        //     ->where('parent_id', 0)->where('active','1')
        //     ->orderbyDesc('id')
        //     ->get();
        return Menu::select('name','id')
            ->where('active','1')
            ->orderbyDesc('id')
            ->get();
}

    public function getAll()
    {
        return Menu::orderbyDesc('id')->paginate(20);
    }

    public function create($request)
    {
        // dd ($request->input('content'));
        try{
            
            Menu::create([
                'name' => (string) $request->input('name'),
                'parent_id' =>(int) $request->input('parent_id'),
                'description' => (string) $request->input('description'),
                'content' => (string) $request->input('content'),
                'active' => (string) $request->input('active'),
                // 'slug' => Str::slug($request->input('name'),'-')
            ]);

            Session::flash('success','Tạo Danh Mục Thành Công');
        }catch (\Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        return true;
    }


    public function update($request, $menu) : bool
    {
        if ($request->input('parent_id') != $menu->id){
            $menu->parent_id = (int) $request->input('parent_id');
        }
        
        $menu->name = (string) $request->input('name');
        $menu->description = (string) $request->input('description');
        $menu->content = (string) $request->input('content');
        $menu->active = (string) $request->input('active');
        $menu->save();

        Session::flash('success', 'Cập nhật thành công Danh Mục');
        return true;
    }

    public function destroy($request)
    {
        $id = (int) $request->input('id');

        $menu = Menu::where('id',$id)->first();
        if ($menu){
            return Menu::where('id',$id)->orWhere('parent_id', $id)->delete();
        }
        return false;
    }

    public function getId($id)
    {
        return Menu::where('id', $id)->where('active', 1)->firstOrFail();//đưa ID menu nếu có hiện nếu ko thì hiện lỗi 404
    }

    public function getProduct($menu, $request)
    {
        $query = $menu->products()
            ->select('id', 'ten', 'gia', 'hinhanh')
            ->where('hoatdong', 1)
            ->where('an',1);

        if ($request->input('gia')) {
            $query->orderBy('gia', $request->input('gia'));
        }

        return $query
            ->orderByDesc('id')
            ->paginate(12)
            ->withQueryString();
    }
}