<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Periksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PasienController extends Controller
{
    // Menyimpan ID user pasien
    protected $userID = 3;

    // Konstruktor untuk menginisialisasi user ID pasien
    public function __construct()
    {
        $this->userID = 3;
    }

    // Menampilkan halaman dashboard pasien
    public function index()
    {
        // Mengambil data user berdasarkan ID
        $pasien = User::where('id', $this->userID)->first();

        // Mengambil nama pasien
        $namaPasien = $pasien->nama;

        // Menghitung total pemeriksaan yang dilakukan pasien
        $totalPeriksa = Periksa::where('id_pasien', $this->userID)->count();

        // Menampilkan view dashboard dengan data nama dan total periksa
        return view('pasien.dashboard', compact('namaPasien', 'totalPeriksa'));
    }

    // Menampilkan halaman form periksa
    public function showPeriksa()
    {
        // Mengambil semua user yang memiliki role sebagai dokter
        $dokters = User::where('role', 'dokter')->get();

        // Menampilkan view form periksa dengan data dokter
        return view('pasien.periksa', compact('dokters'));
    }

    // Menyimpan data periksa baru
    public function periksa(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'id_dokter'   => 'required',
            'tgl_periksa' => 'required|date',
        ]);

        // Menyimpan data pemeriksaan ke database
        $periksa = Periksa::create([
            'id_pasien'   => $this->userID,
            'id_dokter'   => $request->id_dokter,
            'tgl_periksa' => $request->tgl_periksa,
        ]);

        // Redirect kembali ke halaman periksa
        return redirect()->route('pasien.periksa');
    }

    // Menampilkan riwayat pemeriksaan pasien
    public function riwayat()
    {
        // Mengambil semua data pemeriksaan pasien
        $riwayats = Periksa::where('id_pasien', $this->userID)->get();

        // Menampilkan view riwayat pemeriksaan
        return view('pasien.riwayat', compact('riwayats'));
    }
}
