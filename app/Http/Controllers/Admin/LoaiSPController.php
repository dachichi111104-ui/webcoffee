<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoaiSP;

class LoaiSPController extends Controller
{
    public function index()
    {
        $loaisp = LoaiSP::orderBy('idloai', 'asc')->get();
        return view('admin.loaisp.index', compact('loaisp'));
    }

    public function create()
    {
        return view('admin.loaisp.create');
    }
    public function store(Request $request)
    {
        $request->validate(['tenloai' => 'required|unique:loaisp,tenloai']);
        LoaiSP::create($request->all());
        return redirect()->route('admin.loaisp.index')->with('success', 'Thêm danh mục thành công');
    }

    public function edit($id)
    {
        $loai = LoaiSP::findOrFail($id);
        return view('admin.loaisp.edit', compact('loai'));
    }
    public function update(Request $request, $id)
    {
        $loai = LoaiSP::findOrFail($id);
        $request->validate(['tenloai' => 'required|unique:loaisp,tenloai,'.$id.',idloai']);
        $loai->update($request->all());
        return redirect()->route('admin.loaisp.index')->with('success', 'Cập nhật thành công');
    }

    public function destroy($id)
    {
        LoaiSP::findOrFail($id)->delete();
        return redirect()->route('admin.loaisp.index')->with('success', 'Xoá thành công');
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $loaisp = LoaiSP::where('tenloai', 'LIKE', "%{$keyword}%")
                 ->orderBy('idloai', 'asc')
                 ->get();
                return view('admin.loaisp.index', compact('loaisp'));
    }
}
