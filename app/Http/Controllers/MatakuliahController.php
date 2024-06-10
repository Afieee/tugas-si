<?php

namespace App\Http\Controllers;

use App\Models\dosen;
use App\Models\matakuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MatakuliahController extends Controller
{
    function index(Request $request) {
        $katakunci = $request->katakunci;
        $query = matakuliah::query();

        if(strlen($katakunci)) {
            $query->where('id_matakuliah', 'like', "%$katakunci%")
                    ->orWhere('nama_matakuliah', 'like', "%$katakunci%")
                    ->orWhere('sks', 'like', "%$katakunci%")
                    ->orWhere('semester', 'like', "%$katakunci%")
                    ->orWhere('perkuliahan', 'like', "%$katakunci%")
                    ->orWhereHas('dosen', function($q) use ($katakunci) {
                        $q->where('nama_dosen', 'like', "%$katakunci%");
                    });
        }

        $data = $query->with('dosen')->orderBy('id_matakuliah', 'asc')->paginate(5);

        return view('sekretariat.index')->with('data', $data);
    }





public function create()
{
    $dosen = dosen::all();  // Retrieve all dosen records
    return view('sekretariat.create-matakuliah', compact('dosen'));
}





    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
    {
        Session::flash('id_matakuliah', $request->id_matakuliah);
        $request->validate([
            'id_matakuliah' => 'required|numeric|unique:matakuliah,id_matakuliah',                
            'nama_matakuliah' => 'required',
            'sks' => 'required',
            'semester' => 'required',
            'perkuliahan' => 'required',
            'nip' => 'required|exists:dosen,nip',
            'id_jurusan' => 'required|exists:jurusan,id_jurusan',
        ], [
            'id_matakuliah.required' => 'Id Matakuliah Kosong, Tolong Diisi',
            'id_matakuliah.numeric' => 'Id Matakuliah harus berupa angka, isi ulang data!',
            'id_matakuliah.unique' => 'Id Matakuliah yang kamu isikan sudah terdaftar!',
            'nama_matakuliah.required' => 'Nama Matakuliah Kosong, Tolong Diisi',

            'sks.required' => 'SKS Kosong, Tolong Diisi',
            'semester.required' => 'Semester Kosong, Tolong Diisi',
            'perkuliahan.required' => 'Perkuliahan Kosong, Tolong Diisi',
            'nip.required' => 'NIP Dosen Kosong, Tolong Diisi',
            'nip.exists' => 'NIP Dosen tidak terdaftar di database',

            'id_jurusan.required' => 'Id Jurusan Kosong, Tolong Diisi',
            'id_jurusan.exists' => 'Id Jurusan tidak terdaftar di database',
            
        ]);

        $data = [
            'id_matakuliah' => $request->id_matakuliah,                
            'nama_matakuliah' => $request->nama_matakuliah,
            'sks' => $request->sks,
            'semester' => $request->semester,
            'perkuliahan' => $request->perkuliahan,
            'nip' => $request->nip,
            'id_jurusan' => $request->id_jurusan,
        ];

        matakuliah::create($data);

        return redirect()->to('sekretariat')->with('success', 'Berhasil Menambahkan Data');
    }
public function show(string $id) #menampilkan detail data
{

}

    public function edit(string $id)#menampilkan form untuk update
    {
        $data = matakuliah::where('id_matakuliah',$id)->first();
        return view('sekretariat.edit-matakuliah')->with('data',$data);
    }
    public function update(Request $request, string $id) {
        $request->validate([
            'nama_matakuliah' => 'required',
            'sks' => 'required',
            'semester' => 'required',
            'perkuliahan' => 'required',
            'nama_dosen' => 'required',
        ], [
            'nama_matakuliah.required' => 'Matakuliah Kosong, Tolong Diisi',
            'sks.required' => 'SKS Kosong, Tolong diisi',
            'semester.required' => 'Semester Kosong, Tolong diisi',
            'perkuliahan.required' => 'Perkuliahan Kosong, Tolong diisi',
            'nama_dosen.required' => 'Nama Dosen Kosong, Tolong diisi',
            
        ]);
    
        // Update matakuliah data
        $data = [
            'nama_matakuliah' => $request->nama_matakuliah,
            'sks' => $request->sks,
            'semester' => $request->semester,
            'perkuliahan' => $request->perkuliahan,
        ];
    
        matakuliah::where('id_matakuliah', $id)->update($data);
    
        // Update dosen data
        $matakuliah = matakuliah::find($id);
        $dosen = dosen::where('nip', $matakuliah->nip)->first();
        if ($dosen) {
            $dosen->nama_dosen = $request->nama_dosen;
            $dosen->save();
        }
    
        return redirect()->to('sekretariat')->with('success', 'Berhasil Mengubah Data');
    }



    public function destroy(string $id) #menghapusan data
    {
        matakuliah::where('id_matakuliah', $id)->delete();
        return  redirect()->to('sekretariat')->with('success', 'Berhasil menghapus data'); 
    }
}