@if (Session::has('message'))
 
    <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-star me-1"></i>
                <strong>Success !</strong> {{ session('message') }}      
                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>

@endif

@if (Session::has('error'))
    
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-octagon me-1"></i>
                <strong>Error !</strong> {{ session('error') }}
       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>

@endif