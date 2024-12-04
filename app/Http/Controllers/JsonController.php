<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeoJsonData;

class JsonController extends Controller
{
    function index()
{
    $data['list_desa'] = GeoJsonData::all();
    $data['uploaded_geojsons'] = GeoJsonData::select('id', 'geojson', 'nama_geo', 'warna_geo')->get();

    return view('content.map.create', $data);
}
function create(Request $request)
{
    $request->validate([
        'geojson_file' => 'required|mimes:geojson,json|max:10240',
        'nama_geo' => 'required|string|max:255',
        'warna_geo' => 'required|string|max:255', // Hex color code
    ]);

    $file = $request->file('geojson_file');
    $path = $file->storeAs('geojson', $file->getClientOriginalName(), 'public');

    $fileContents = file_get_contents(storage_path('app/public/' . $path));
    $geojsonData = json_decode($fileContents, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        return back()->withErrors('File yang di-upload bukan format GeoJSON yang valid.');
    }

    GeoJsonData::create([
        'geojson' => $geojsonData,
        'nama_geo' => $request->input('nama_geo'),
        'warna_geo' => $request->input('warna_geo'),
    ]);

    return back()->with('success', 'File GeoJSON berhasil di-upload dan disimpan ke database!');
}


    
}
