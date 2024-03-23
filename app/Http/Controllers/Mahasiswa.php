<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa as ModelsMahasiswa;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class Mahasiswa extends Controller
{
    public function index(Request $request)
    {
        return redirect('/home');
    }
    public function home()
    {
        $mahasiswa = ModelsMahasiswa::all()->sortByDesc('nim');
        $totalMahasiswa = ModelsMahasiswa::count();
        $totalMahasiswaLaki = ModelsMahasiswa::where('gender', 'L')->count();
        $totalMahasiswaPerempuan = ModelsMahasiswa::where('gender', 'P')->count();

        return view('home', ['mahasiswa' => $mahasiswa, 'totalMahasiswa' => $totalMahasiswa, 'totalMahasiswaLaki' => $totalMahasiswaLaki, 'totalMahasiswaPerempuan' => $totalMahasiswaPerempuan]);
    }

    public function pencarian(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:50',
        ]);

        $mahasiswa = ModelsMahasiswa::where('nama', 'like', '%' . $request->nama . '%')->get();

        return view('pencarian', ['mahasiswa' => $mahasiswa]);
    }
    public function admin()
    {
        $mahasiswa = ModelsMahasiswa::all()->sortByDesc('nim');

        return view('admin', ['mahasiswa' => $mahasiswa]);
    }

    public function tambahMahasiswa(Request $request)
    {
        try {
            $request->validate([
                'nim' => 'required|numeric',
                'nama' => 'required|max:50',
                'alamat' => 'required',
                'tgl_lahir' => 'required|date',
                'gender' => 'required|in:L,P',
                'usia' => 'required|numeric',
            ]);

            $mahasiswa = ModelsMahasiswa::create([
                'nim' => $request->nim,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'tgl_lahir' => $request->tgl_lahir,
                'gender' => $request->gender,
                'usia' => $request->usia,
            ]);

            if ($mahasiswa) {
                $pop = [
                    'head' => 'Berhasil',
                    'body' => 'Mahasiswa Telah Ditambahkan',
                    'status' => 'success'
                ];

                return redirect('/admin')->with('pop-up', $pop);
            } else {
                throw new \Exception('Silakan Cek Kembali Mahasiswa Anda');
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            $pop = [
                'head' => 'Gagal Menambah Mahasiswa',
                'body' => '<ul class="text-justify"><li>' . implode('</li><li>', $e->validator->errors()->all()) . '</li></ul>',
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        } catch (\Exception $e) {
            $pop = [
                'head' => 'Gagal Menambah Mahasiswa',
                'body' => $e->getMessage(),
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        }
    }
    public function hapusMahasiswa($id)
    {
        try{
            $mahasiswa = ModelsMahasiswa::find($id);

            if ($mahasiswa) {
                $mahasiswa->delete();

                $pop = [
                    'head'=> 'berhasil',
                    'body'=> 'Mahasiswa berhasil di hapus',
                    'status' => 'succes'
                ];
                return redirect('/admin')->with('pop-up',$pop);
            }else{
                throw new \Exception('Mahasiswa tidak ditemukan');
            }
        }catch (\Exception $e){
            $pop = [
                'head' => 'gagal menghapus mahasiswa',
                'body' => $e->getMessage(),
                'status'=> 'error'
            ];
            return redirect()->back()->with('pop-up',$pop);
        }
    }
    public function editMahasiswa($id, Request $request)
    {
        try {
        $mahasiswa = ModelsMahasiswa::find($id);

        $request->validate([
            'nama'=> 'required|max:50',
            'alamat'=>'required|',
            'tgl_lahir'=>'required|date',
            'gender' =>'required|in:L,P',
            'usia' => 'required|numeric'
        ]);
        if ($mahasiswa) {
            $mahasiswa->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'tgl_lahir' => $request->tgl_lahir,
                'gender' => $request->gender,
                'usia' => $request->usia,
            ]);

            $pop = [
                'head' => 'Berhasil',
                'body' => 'Mahasiswa Telah Diedit',
                'status' => 'success'
            ];

            return redirect('/admin')->with('pop-up', $pop);
        } else {
            throw new \Exception('Mahasiswa Tidak Ditemukan');
        }
        } catch (\Throwable $e) {
            $pop = [
                'head' => 'Gagal mengedit mahasiswa',
                'body' => $e->getMessage(),
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up',$pop);
        }
    }
}
