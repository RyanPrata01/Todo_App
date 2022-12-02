@extends ('layout')

@section ('content')
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <title>Todo App</title>
</head>
<body>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
              <div class="card bg-dark text-white" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">      
                    <h2 class="fw-bold mb-2 text-uppercase">Create To Do</h2>
                    <p class="text-white-50 mb-5">Enter the data below</p>
                    <form id="create-form" method="POST" action="{{route('todo.store')}}">
                        {{-- Mengambil dan mengirim data input ke controller yang nantinya di ambil oleh request $request --}}
                        @csrf
                        
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
                            <input type="text" name="title" id="typeEmailX" class="form-control form-control-lg"/>
                        </div>
        
                        <div class="form-outline form-white mb-4">
                            <label class="form-label" for="">Target Date</label>
                            <input type="date" name="date" id="typePasswordX" class="form-control form-control-lg" />
                        </div>

                        <div class="form-outline form-white mb-4">
                            <label class="form-label" for="">Description</label>
                            <textarea type="description" name="description" id="typePasswordX" class="form-control form-control-lg"></textarea>
                        </div>
                    
                        <button class="btn btn-success btn-lg mt-5 mb-3 px-5 w-100" type="submit">Submit</button>
                        <a href="/todo" class="btn btn-danger btn-lg px-5 w-100">Cancel</a> 
                    </form>
                </div>
            </div>
          </div>
        </div>
    </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</html>
@endsection