<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Todo app</title>
</head>
<body>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{route('register.input')}}">
        @csrf
        <section class="h-100 gradient-form" style="background-color: #eee;">
            <div class="container py-5 h-100">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                  <div class="card rounded-3 text-black">
                    <div class="row g-0">
                      <div class="col-lg-6">
                        <div class="card-body p-md-5 mx-md-4">
          
                          <div class="text-center">
                            <h4 class="mt-4 mb-5 pb-1">REGISTER NOW</h4>
                          </div>
          
                          <form>
                            <p>Please input your data</p>
          
                            <div class="form-outline mb-4">
                              <label class="form-label">Name</label>
                              <input type="text" class="form-control" name="name" required placeholder="Input Username">
                            </div>
          
                            <div class="form-outline mb-4">
                              <label class="form-label">Email</label>
                              <input type="email" class="form-control" name="email" required placeholder="Input Password">
                            </div>
        
                            <div class="form-outline mb-4">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" required placeholder="Input Password">
                            </div>
                            
                            <div class="form-outline mb-4">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" required placeholder="Input Password">
                            </div>
          
                            <div class="text-center pt-1 mb-3 pb-1">
                              <button class="btn btn-primary w-100" type="submit">Login</button>
                            </div>
                          </form>
                          
                          <div class="d-flex align-items-center justify-content-center pb-4">
                            <p class="mb-0 me-2">Already have account?</p><a style="text-decoration: none" link href="{{url('/login')}}">Sign In</a>
                          </div>

                        </div>
                      </div>
                      <div class="col-lg-6 px=0 d-none d-sm-block">
                        <img src="img/To Do App.png" class="w-100" style="object-position: left;">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
    </form>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</html>