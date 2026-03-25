<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\LoaiSP;

class SanPhamController extends Controller
{
public function index()
{ 
    $sanpham = SanPham::with('loai') ->orderBy('idsp', 'asc') ->get();
    $loaisp = LoaiSP::all();
    return view('admin.sanpham.index', compact('sanpham','loaisp'));
}
    public function create()
    {
        $loaisp = LoaiSP::all();
        return view('admin.sanpham.create', compact('loaisp'));
    }
    public function store(Request $request)
{
    $request->validate([
        'idloai'=>'required',
        'tensp'=>'required|unique:sanpham,tensp',
        'gia'=>'required|numeric',
        'soluong'=>'required|integer',
        'hinhanh'=>'nullable|image'
    ]);

    $filename = null;

    if($request->hasFile('hinhanh')){
        $file = $request->file('hinhanh');
        $filename = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('uploads'), $filename);
    }

    SanPham::create([
        'idloai' => $request->idloai,
        'tensp' => $request->tensp,
        'gia' => $request->gia,
        'soluong' => $request->soluong,
        'hinhanh' => $filename,
        'mota' => $request->mota
    ]);

    return redirect()->route('admin.sanpham.index')
        ->with('success','Thêm sản phẩm thành công');
}

    public function edit($id)
    {
        $sanpham = SanPham::findOrFail($id);
        $loaisp = LoaiSP::all();
        return view('admin.sanpham.edit', compact('sanpham','loaisp'));
    }
    public function update(Request $request, $id)
    {
    $request->validate([
        'idloai'=>'required',
        'tensp'=>'required|unique:sanpham,tensp',
        'gia'=>'required|numeric',
        'soluong'=>'required|integer',
        'hinhanh' => 'nullable|image|max:10240'    ]);

    $sanpham = SanPham::findOrFail($id);
    $data = [
        'idloai' => $request->idloai,
        'tensp' => $request->tensp,
        'gia' => $request->gia,
        'soluong' => $request->soluong,
        'mota' => $request->mota
    ];
    if ($request->hasFile('hinhanh')) {
        if ($sanpham->hinhanh && file_exists(public_path('uploads/'.$sanpham->hinhanh))) {
            unlink(public_path('uploads/'.$sanpham->hinhanh));
        }
        $file = $request->file('hinhanh');
        $filename = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('uploads'), $filename);
        $data['hinhanh'] = $filename;
    }
    $sanpham->update($data);
    return redirect()->route('admin.sanpham.index')
        ->with('success','Cập nhật thành công');
    }
    public function destroy($id)
    {
        SanPham::findOrFail($id)->delete();
        return redirect()->route('admin.sanpham.index')->with('success','Xoá sản phẩm thành công');
    }

public function filterByCategory(Request $request)
{
    $sanpham = SanPham::with('loai')
        ->when($request->idloai, function ($q) use ($request) {
            $q->where('idloai', $request->idloai);
        })
            ->orderBy('idsp','asc')
        ->get();
    $loaisp = LoaiSP::all();
    return view('admin.sanpham.index', compact('sanpham','loaisp'));
}

public function search(Request $request)
{
    $keyword = $request->keyword;
    $sanpham = SanPham::with('loai')
        ->where('tensp','like',"%$keyword%")
        ->orWhere('mota','like',"%$keyword%")
        ->orWhereHas('loai', function ($q) use ($keyword) {
            $q->where('tenloai','like',"%$keyword%");
        })
            ->orderBy('idsp','asc')
        ->get();
    $loaisp = LoaiSP::all();
    return view('admin.sanpham.index', compact('sanpham','loaisp'));
}

}
