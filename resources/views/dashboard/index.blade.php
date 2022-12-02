@extends ('layout')

@section ('content')

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <title>Todo App</title>
</head>
<body>
    <div class="wrapper bg-dark">
        @if (session('notAllowed'))
            <div class="alert alert-danger">
                {{ session('notAllowed') }}
            </div>
        @endif
        @if (session('successAdd'))
            <div class="alert alert-success">
                {{ session('successAdd') }}
            </div>
        @endif
        @if (session('deleted'))
            <div class="alert alert-success">
                {{ session('deleted') }}
            </div>
        @endif
        @if (session('successUpdate'))
            <div class="alert alert-success">
                {{ session('successUpdate') }}
            </div>
        @endif
        @if (session('done'))
            <div class="alert alert-success">
                {{ session('done') }}
            </div>
        @endif
        <div class="d-flex align-items-start justify-content-between">
            <div class="d-flex flex-column text-white">
                <div class="h5">Hello, {{Auth::user()->name}}</div>
                <p class="text-justify text-white">
                    Here's a list of activities you have to do
                </p>
            </div>
    
            <div class="info btn ml-md-5 ml-0">
                <i class="fa-solid fa-circle-user fa-xl" style="color: #00b4d8"></i>
            </div>
        </div>
        <div class="work border-bottom pt-3">
            <div class="d-flex align-items-center py-2 mt-1 ">
                <div>
                    <span class="fa-solid fa-comment btn" style="color: #ffff"></span>
                </div>

                <div class="text-light">{{ $todos->count()}} Work you have To Do !!</div>
                <button class="ml-auto btn bg-white text-muted fas fa-angle-down" type="button" data-toggle="collapse"
                    data-target="#comments" aria-expanded="false" aria-controls="comments">
                </button>
            </div>
        </div>

        {{-- looping data-data dari compact 'todos' agar dapat di tampilkan per baris datanya--}}
        @foreach ($todos as $todo)
            <div id="comments" class="mt-1">
                <div class="comment col-12">
                    <div class="d-flex px-1">
                        @if ($todo['status'] == 1)
                            <span class="fa-solid fa-sm fa-bookmark btn py-2" style="Color:#00b4d8"></span>
                            <p class="text-light">Selamat, {{Auth::user()->name}} sudah menyelesaikan tugas ini</p>
                        @else
                        <form method="POST" action="{{ route('todo.update-complated', $todo['id'])}}">
                            {{-- Apabila fiturnya berkaitan dengan modifikasi database, maka gunakan form  --}}
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="fa fa-circle-check btn fa-sm" style="Color:#00b4d8"></button>
                        </form>
                        @endif  
                    </div>
                   
                    <div class="d-flex flex-column text-white p-3">
                        {{-- Menampilkan data dinamis/data yang di ambil dari db pada blade harus menggunakan {{}} --}}
                        {{-- Path yang {id} di kirim data dinamis (data dari db) makanya di pake {{}} --}}
                        <h5>
                            {{$todo['title']}}
                        </h5>
                        <h6>
                            {{ $todo['description']}}
                        </h6>
                        {{-- Konsep Ternany : if column status bari ini isinya 1 bakal munculin teks 'Complated' selain dari itu 
                            akan menampilkan teks 'On-Process' 
                        --}}
                        <div class="text-muted">
                            {{ $todo['status'] == 1 ? 'Complated || ' : 'On-Process || '}}
                             {{-- Carbon itu package laravel untuk mengelola yang berhubungan dengan date. 
                                Tadinya value coloum date di db kan bentuknya format 2022-11-22 nah kita pengen ubah bentuk formatnya jadi 
                                22 November, 2022 --}}

                            <span class="date">
                                {{-- Kalau status nya 1 (complated), yang di tampilkan itu tanggal kapan dia selesaibya yang di ambil dari column done_time
                                    yang di isi pas update status nya ke complated --}}
                                @if ($todo['status'] == 1 )
                                Selesai pada : {{\Carbon\Carbon::parse($todo['done_time'])->format('j F, Y')}}
                                {{-- Kalau statusnya masih 0 (On-progress), yang di tampilin tanggal dia di buat (data dari column date yang di isi dari input pilih tanggal di input create) --}}
                                @else
                                Target selesai : {{ \Carbon\Carbon::parse($todo['date'])-> format('j F, Y')}}
                                @endif
                            </span>
                        </div>
                        <div class="mt-2">
                            <form method="POST" action="{{ route('todo.delete', $todo['id']) }}">
                                {{-- Apabila fiturnya berkaitan dengan modifikasi database, maka gunakan form  --}}
                                @csrf
                                @method('DELETE')
                                <a href="/todo/edit/{{ $todo['id']}}" class="fa-sharp fa-solid fa-pen-to-square fa-lg" style="color: rgb(64, 255, 0)"></a>
                                <button type="submit" class="fa-solid fa-trash-can text-danger btn fa-lg"></button>
                            </form>
                        </div>  
                    </div>
          
                  
                </div>
            </div>
        @endforeach

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</body>
</html>
@endsection