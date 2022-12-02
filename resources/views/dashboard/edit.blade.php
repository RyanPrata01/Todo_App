@extends ('layout')

@section ('content')
    
<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card bg-dark text-white" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">      
                <h2 class="fw-bold mb-2 text-uppercase">Edit To Do</h2>
                <form id="create-form" method="POST" action="/todo/update/{{ $todo['id']}}">
                    {{-- Mengambil dan mengirim data input ke controller yang nantinya di ambil oleh request $request --}}
                    @csrf
                    {{-- Karena di route nya pake method patch sedangkan attribute method di form cuman bisa post/get. Jadi yang post nya di timpa --}}
                    @method('PATCH')
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <br>
                    @endif
  
                    <div class="form-outline form-white mb-4">
                        <label class="form-label" for="">Title</label>
                        {{-- Attribute value fungsinya untuk memasukkan data ke input --}}
                        {{-- Kenapa datanya harus di simpan di input? karena ini kan fitur edit, Kalau fitur edit belum tentu semua data coloum harus di ubah. Jadi untuk mengantisipasi 
                         hal itu, tampilin dulu semua data di inputnya baru nantinya pengguna yang menentukan data input mana yang mau di ubah  --}}
                        <input placeholder="title of todo" type="text" name="title" value = "{{ $todo['title']}}" class="form-control form-control-lg">
                    </div>
    
                    <div class="form-outline form-white mb-4">
                        <label class="form-label" for="">Target Date</label>
                        <input placeholder="Target Date" type="date" name="date" value = "{{ $todo['date']}}" class="form-control form-control-lg">
                    </div>

                    <div class="form-outline form-white mb-4">
                        <label class="form-label" for="">Description</label>
                        <textarea name="description" placeholder="Type your descriptions here..." tabindex="5" class="form-control form-control-lg">{{ $todo['description']}}</textarea>
                    </div>
                
                    <button class="btn btn-success btn-lg mt-5 mb-3 px-5 w-100" type="submit">Submit</button>
                    <a href="/todo" class="btn btn-danger btn-lg px-5 w-100">Cancel</a> 
                </form>
            </div>
        </div>
      </div>
    </div>
</section>
@endsection