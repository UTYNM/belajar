<?php

namespace App\Http\Controllers;

use App\Models\Operator;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
    public function index()
    {
      $data['operators'] = Operator::all();
      return view('content.operators.index', $data);
    }

    public function create()
    {
      return view('content.operators.create');
    }

    public function store(Request $request)
    {
      $anggota = new Operator();
      $anggota->nama = $request->nama;
      $anggota->alamat = $request->alamat;
      $anggota->jenis_kelamin = $request->jenis_kelamin;
      $anggota->opd = $request->opd;
      $anggota->save();

        return redirect('operators')->with('success', 'Operator created successfully.');
    }

    public function show(Operator $operator)
    {
        $data['operator'] = $operator;
        return view('content.operators.show', $data);
    }

    public function edit(Operator $operator)
    {
       $data['operator'] = $operator;
        return view('content.operators.edit', $data);
    }
    
    public function update(Request $request,Operator $operator)
    {
        $operator->nama = $request->nama;
        $operator->alamat = $request->alamat;
        $operator->jenis_kelamin = $request->jenis_kelamin;
        $operator->opd = $request->opd;
        $operator->update();
       
        return back()->with('success', 'Operator updated successfully.');
    }

    public function destroy(Operator $operator)
    {
        $operator->delete();
        return back()->with('success', 'Operator deleted successfully.');
    }
}