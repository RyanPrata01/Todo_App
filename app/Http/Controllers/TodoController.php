<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use PDO;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function register(){
        return view ('register');
    }

    public function index()
    {
        return view ('login');
    }
    
    public function login()
    {
        return view('login');
    }

    public function todo()
    {   
        // ambil data dari table todo dengan model Todo 
        //filter data di database -> where('column', 'perbandingan', 'value')
        //get()-> ambil data
        // Filter data di table todos yang di isi column user_id nya sama dengan data history login bagian id
        $todos = Todo::where('user_id', '=', Auth::user()->id)->get();
        // kirim data yang sudah di ambil ke file blade / ke file yang menampilkan halaman 
        // kirim melalui compact ()
        // Isi compact sesuaikan dengan nama variable
        // Isi dari compact bisa lebih dari satu ( bisa banyak tinggal di pisah dengan ',')
        return view('dashboard.index', compact('todos'));
    }

    public function complated(){
        return view('complated');
    }

    public function updateComplated($id){
        // Cari data yang mau di ubah statusnya menjadi 'complated' dan coloum 'done-time' yang tadiya null, di isi dengan tanggal sekarang (tanggal ketika data todo di ubahh status nya )
        // Karena status boolean, dan 0 itu untuk kondisi to-do-progress, jadi 1 nya untuk kondisi todo-complated
        Todo::where('id', '=', $id)->update([
            'status' => 1, 
            'done_time' => \Carbon\Carbon::now(),
        ]);
        // Apabila berhasil, akan di kembalikan ke halaman awal pemberitahuan
        return redirect()->back()->with('done', 'Tugas telah selesai di kerjakan');
    }

    public function registerAccount(Request
    $request)
    {
        //dd($request->all());

        $request->validate([
            'email' => 'required',
            'username' => 'required|min:4|max:8',
            'password' => 'required|min:4',
            'name'=> 'required|min:3'
        ]);

        //Input data ke db 
        User::create([
            'name' => $request -> name, 
            'username' => $request -> username,
            'email' => $request -> email,
            'password' => Hash::make($request->password),
        ]);

        //redirect kemana setelah berhasil tambah data+ di kitim peritahuan
        return redirect('/')->with('success', 'Berhasil menambahkan akun, silahkan login');
    }

    public function auth(Request
    $request)
    {
        $request->validate([
            'username' => 'required|exists:users,username',
            'password' => 'required',
        ],[
            'username.exists' => 'username ini belum tersedia', 
            'username.required' => 'username ini harus di isi',
            'password.required' => 'password ini harus di isi',
        ]);

        $user = $request->only('username', 'password');
        if(Auth::attempt($user)) {
            return redirect()->route('todo.index');
        }else{
            return redirect()->back()->with('error', 'Gagal login, silahkan cek dan coba lagi!');
        }
    }

    public function logout()
    {
        //menghapus history login 
        Auth::logout();
        //mengarahkan ke halaman login lagi
        return redirect('/login');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('dashboard.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //menyimpan data ke database 
        //tes koneksi blade dengan controller 
        //dd($request->all());
        //validasi data
        $request->validate([
            'title' => 'required|min:3',
            'date'  => 'required',
            'description' => 'required',
        ],[
            'title.required' => 'Title ini harus di isi',
            'date.required' => 'Tanggal dan tahun harus di isi',
            'description.required' => 'Deskripsi harus di isi!!',
        ]);

        // Mengirim data ke database table todos dengan model Todo 
        // '' = nama coloum di table db 
        // $request -> = value attribute name pada input
        // Kenapa yang di kirim 5 data ?? Karena table pada db todos membutuhkan 6 kolom input 
        // Salah satunya coloum 'done-time' yang tipe nya nullable, karena nullable jadi tidak perlu di kirim nilai 
        // 'user-id' untuk memberitahu data ini milik siapa, di ambil melalui fitur Auth 
        // 'status' ini tipe nya boolean, 0 = belum di kerjakan, 1 = sudah di kerjakan (todo nya)
        
        Todo::create([
            'title' => $request->title,
            'date' => $request->date,
            'description' => $request->description, 
            'status' => 0, 
            'user_id' => Auth::user()->id, 
        ]);
        return redirect()->route('todo.index')->with('successAdd', 'Berhasil menambahkan data tugas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Parameter yang ada di dalam 
        // Menampilkan halaman input form edit 
        // Mengambil data satu baris ketika coloum id pada baris tersebut sama dengan id dari parameter route
        $todo = Todo::where('id', $id)->first();
        // kirim data yang di ambil ke file blade dengan compact
        return view('dashboard.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Mengubah data di database 
        // validasi data 
        $request->validate([
            'title' => 'required|min:3',
            'date'  => 'required',
            'description' => 'required',
        ]);
        // Cari baris data yang punya id sama dengan data id yang di kirim ke parameter route 
        // Kalau udah ketemu, update coloum - coloum datanya 
        Todo::where('id', $id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'user_id' => Auth::user()->id,
            'status' => 0,
        ]);
        // Kalau berhasil, halaman bakall di redirect ulang ke halaman awal todo dengan pesan pemberitahuan
        return redirect('/todo/')->with('successUpdate', 'Data tugas berhasil di perbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //menghapus data di database 
        // filter / cari data yang mau di hapus, baru jalankan perintah hapusnya
        Todo::where('id', '=', $id)->delete();
        //Kalau udah , balik laig ke halaman awalnya pemberitahuan
        return redirect()->back()->with('deleted', 'Berhasil menghapus data tugas!');
    }
}
