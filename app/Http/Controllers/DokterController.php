<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DokterController extends Controller
{
    // Menyimpan ID user dokter
    protected $userIDDokter = 1;

    // Konstruktor untuk menginisialisasi ID dokter
    public function __construct()
    {
        $this->userIDDokter = 1;
    }

    // -------------------- MENAMPILKAN --------------------

    // Menampilkan semua data obat
    public function showObat()
    {
        $obats = Obat::all();

        // Mengirim data obat ke view 'dokter.obat'
        return view('dokter.obat', compact('obats'));
    }

    // -------------------- MENAMBAH --------------------

    // Menyimpan data obat baru ke database
    public function storeObat(Request $request)
    {
        // Validasi input dari request
        $validatedData = $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan'   => 'required|string|max:255',
            'harga'     => ['required'],
        ]);

        // Menyimpan data obat ke tabel 'obats'
        Obat::create([
            'nama_obat' => $validatedData['nama_obat'],
            'kemasan'   => $validatedData['kemasan'],
            'harga'     => $validatedData['harga'],
        ]);

        // Redirect ke halaman daftar obat
        return redirect()->route('dokter.obat');
    }

    // -------------------- MENGEDIT --------------------

    // Menampilkan form edit data obat berdasarkan ID
    public function editObat($id)
    {
        // Mencari data obat berdasarkan ID
        $obat = Obat::findOrFail($id);

        // Menampilkan view edit obat
        return view('dokter.obatEdit', compact('obat'));
    }

    // -------------------- MEMPERBARUI --------------------

    // Mengupdate data obat berdasarkan ID
    public function updateObat(Request $request, $id)
    {
        // Validasi input dari request
        $validatedData = $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan'   => 'required|string|max:255',
            'harga'     => ['required'],
        ]);

        // Mencari data obat berdasarkan ID
        $obat = Obat::findOrFail($id);

        // Melakukan update data obat
        $obat->update([
            'nama_obat' => $validatedData['nama_obat'],
            'kemasan'   => $validatedData['kemasan'],
            'harga'     => $validatedData['harga'],
        ]);

        // Redirect ke halaman daftar obat
        return redirect()->route('dokter.obat');
    }

    // -------------------- MENGHAPUS --------------------

    // Menghapus data obat berdasarkan ID
    public function deleteObat($id)
    {
        // Mencari data obat berdasarkan ID
        $obat = Obat::findOrFail($id);

        // Menghapus data obat dari database
        $obat->delete();

        // Redirect ke halaman daftar obat
        return redirect()->route('dokter.obat');
    }
}
