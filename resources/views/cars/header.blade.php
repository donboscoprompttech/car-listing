
<nav class="navbar navbar-expand-lg navbar-light bg-light gvr-navbar">
  <div class="container-fluid px-4 px-lg-5">
    <a class="navbar-brand" href="{{url('/index')}}">
        
       <img src="{{ asset('car/assets/images/logo.png') }}" class="navbar-logo" alt="Company logo" />
      <p class="logo-title" style="
    color: #f0d32f;
    font-size: 0.9rem;
    font-family: &quot;Montserrat&quot;, sans-serif;
    font-weight: 900;
    width: 78%;
    padding-left: 1rem;
">
             GLOBAL VECHICLE REMARKETING
          </p>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <div class="menu-div d-flex">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
          <li <?=(Request::segment(1)=='index')?'class="nav-item active"':'class="nav-item"'?>>
            <a class="nav-link" aria-current="page" href="{{url('/index')}}">Home</a>
          </li>


          <li  <?=(Request::segment(1)=='category')?'class="nav-item dropdown active"':'class="nav-item dropdown"'?>>
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Category</a>
            <ul class="dropdown-menu single-dropdown" aria-labelledby="navbarDropdown">
              <div class="flex-menu d-flex">
                <div class="leftside">
                  <ul>
                    <li>
                      <a class="dropdown-item" href="{{url('/category/All')}}">All</a>
                    </li>
                    @foreach ($subcategory as $row)
                    <li>
                      <a class="dropdown-item" href="{{url('/category/'.$row->canonical_name)}}">{{ $row->name }}</a>
                    </li>
                    @endforeach


                  </ul>
                </div>
                <!-- <div class="rightside">

                </div> -->
              </div>
            </ul>
          </li>
          <li <?=(Request::segment(1)=='howitworks')?'class="nav-item active"':'class="nav-item"'?>>
            <a class="nav-link" href="{{url('howitworks')}}">How it work</a>
          </li>
          <li <?=(Request::segment(1)=='about-us')?'class="nav-item active"':'class="nav-item"'?>>
            <a class="nav-link" href="{{url('/about-us')}}">About Us</a>
          </li>
          <li <?=(Request::segment(1)=='contactus')?'class="nav-item active"':'class="nav-item"'?>>
            <a class="nav-link" href="{{url('contactus')}}">Contact Us</a>
          </li>
        </ul>
      </div>
    </div>

   
    <!--<div class="btn-div">-->
    <!--  <ul class="navbar-nav d-flex">-->
    <!--    <li class="nav-item my-auto">-->
    <!--      <a href="" class="nav-link nav-link-login">Sign in</a>-->
    <!--    </li>-->
    <!--    <li class="nav-item">-->
    <!--      <a href="" class="nav-link">-->
    <!--        <button class="btn navbar-btn nav-btn-signup">Signup</button>-->
    <!--      </a>-->
    <!--    </li>-->
    <!--  </ul>-->
    <!--</div>-->
  </div>
  <div class="mobile-nav">
    <div class="row m-0">
      <ul class="navbar-nav">
        <li class="active">
          <a href=""> <span><i class="fa-solid fa-home"></i></span> <span>Home</span></a>
        </li>
        <li>
          <div class="dropup">
            <button class="dropbtn"><span><i class="fa-solid fa-layer-group"></i></span><span>Category
                <!--i
                    class="fa-solid fa-chevron-up"></i-->
              </span></button>
            <div class="dropup-content">
              <a href="{{url('/category/All')}}">All</a>
              @foreach ($subcategory as $row)
              <a href="{{url('/category/'.$row->canonical_name)}}">{{ $row->name }}</a>
              @endforeach              
            </div>
          </div>
        </li>
        <li>
          <a href="{{url('howitworks')}}"> <span><i class="fa-solid fa-wallet"></i></span> <span>How it work</span></a>

        </li>
        <li><a href=""> <span><i class="fa fa-circle-question"></i></span> <span>Why Us</span></a> </li>
        <li><a href="{{url('contactus')}}"><span><i class="fa-solid fa-address-book"></i></span> <span>Contact</span></a> </li>
      </ul>

    </div>
  </div>
</nav>