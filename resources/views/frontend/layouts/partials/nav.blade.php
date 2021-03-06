
<div class="main-navbar">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
     <div class="container">
       <a class="navbar-brand mr-5" href="index.html">
         <img src="{{ asset('frontend/images/logo.jpg')}}" class="logo-image">
       </a>
       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
       </button>

       <div class="collapse navbar-collapse" id="navbarsExampleDefault">
         <ul class="navbar-nav mr-auto">
           <li class="nav-item active">
             <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
           </li>
           <li class="nav-item">
             <a class="nav-link" href="{{ route('books.index') }}">Recent Books</a>
           </li>
           <li class="nav-item dropdown">
             <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filter Books By</a>
             <div class="dropdown-menu" aria-labelledby="dropdown01">
               <a class="dropdown-item" href="#">Filter By Top Borrowed</a>
             </div>
           </li>


           <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Upload Books</a>

                <div class="dropdown-menu" aria-labelledby="dropdown01">
                @if (Auth::check())
                  <a class="dropdown-item" href="{{ route('books.create') }}">Upload Now</a>
                  <a class="dropdown-item" href="rules.html">Upload Rules</a>
                @else
                  <a class="btn bnt-info" href="{{ route('login') }}">Please, Login First!</a>
                </div>
                @endif
          </li>

         </ul>
         <form class="form-inline my-2 my-lg-0" action="{{ route('user.book.search') }}" method="GET">
           <input class="form-control mr-sm-2 search-form" type="text" name="search" placeholder="Search" aria-label="Search" value="{{ isset($seacrhed)? $searched : '' }}">
           <button class="btn btn-secondary my-2 my-sm-0 search-button" type="submit"><i class="fa fa-search"></i></button>
         </form>
       </div>
     </div>
   </nav>
 </div>

