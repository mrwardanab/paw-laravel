<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // return view('dashboard');
        $home = Home::all();
        $totalLampu= Home::where('thingType', 'LIKE', "Lampu")->get();
        $totalTV= Home::where('thingType', 'LIKE', "TV")->get();
        $totalAC= Home::where('thingType', 'LIKE', "A/C")->get();
        $totalKunci= Home::where('thingType', 'LIKE', "Kunci")->get();
        $totalGordyn= Home::where('thingType', 'LIKE', "Gordyn")->get();
        $countTotalLampu = $totalLampu->count();
        $countTotalTV = $totalTV->count();
        $countTotalAC = $totalAC->count();
        $countTotalKunci = $totalKunci->count();
        $countTotalGordyn = $totalGordyn->count();
        $notifikasiLampu = Home::orderBy('id', 'DESC')->limit(5)->get();

        $responseKota = Http::get('https://ibnux.github.io/BMKG-importer/cuaca/wilayah.json');
        $dataKota = $responseKota->json();
        // dd($dataKota);
        // return view('dashboard', ['things' => $home]);
        return view('dashboard', compact('totalLampu', 'totalAC', 'totalTV', 'totalKunci', 'totalGordyn', 'dataKota', 'countTotalLampu', 'notifikasiLampu', 'countTotalTV', 'countTotalAC', 'countTotalKunci', 'countTotalGordyn'));
    }

    public function store(Request $request)
    {
        // $mahasiswa = new Mahasiswa;
        // $mahasiswa->nim = $request->nim;
        // $mahasiswa->nama = $request->nama;
        // $mahasiswa->email = $request->email;
        // $mahasiswa->jurusan = $request->jurusan;
        // $mahasiswa->save();
        // return redirect('/');

        $request->state = 0;

        // $request->validate([
        //     'thing' => 'required|unique',
        //     'thingType' => 'required',
        //     'room' => 'required',
        //     'state' => 'required'
        // ]);

        Home::create([
            'thing' => $request->nama,
            'thingType' => $request->jenis,
            'room' => $request->lokasi,
            'state' => 0
        ]); 

        // Home::create($request->all());

        
        return redirect('/home')
            ->with('success','Benda Berhasil Ditambahkan!');
    }

    public function updateThing(Request $request)
    {
        $home = Home::find($request->id);
        $home->state = $request->state;
        $home->save();
    }

    public function updateCuaca(Request $request)
    {
        $id = $request->id;
        $responseCuaca = Http::get('https://ibnux.github.io/BMKG-importer/cuaca/' . $id . '.json');
        // $responseCuaca = Http::get('https://ibnux.github.io/BMKG-importer/cuaca/wilayah.json');
        $dataCuaca = $responseCuaca->json();
        // dump($dataCuaca);
        // return view('dashboard', compact('dataCuaca'));
        // return Response::json($dataCuaca);
        return response()->json($dataCuaca);
        // return $dataCuaca;
    }
}
