 <div class="row footer-row">
      <div class="col-lg-4">
        <div class="logo-div">
          <span><img src="assets/images/logo.png" class="img-fluid footer-logo" alt=""></span>
          <p class="logo-title">
             {{$contents->footertitle}}
          </p>
        </div>
        <div class="desc-div">
           {{$contents->footercontent}}
        </div>
        <div class="opening-div">
          <p class="title">OPENING HOURS</p>
          <p class="open-desc">{{$profile->openingdates}}</p>
          <p class="open-desc">{{$profile->closingdates}}</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-8">
        <div class="footer-title">
          <p>LATEST CARS</p>
        </div>

        <div class="row">
          <div class="col-lg-6 col-6">
            <ul class="footer-list">
              @foreach ($showcarsfirst as $row)
              <li><a href="/details/{{ $row->canonical_name}}"><i class="fas fa-angle-double-right"></i>{{$row->title}}</a></li>
              @endforeach
              
            </ul>
          </div>
          <div class="col-lg-6 col-6">
            <ul class="footer-list">
             @foreach ($showcarssecond as $row)
              <li><a href="/details/{{ $row->canonical_name}}"><i class="fas fa-angle-double-right"></i>{{$row->title}}</a></li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 ps-lg-5">
        <div class="footer-title">
          <p>Contact Us</p>
        </div>
        <ul class="footer-list">
          <li><a href=""><span class="icon-span"><img src="{{ asset('car/assets/images/Icons/location.svg') }}" class="footer-icon"
                  alt=""></span>{{$profile->address}}</a></li>
          <li><a href=""><span class="icon-span"><img src="{{ asset('car/assets/images/Icons/phone-call.svg') }}" class="footer-icon"
                  alt=""></span>Phone : {{$profile->phoneno}}</a></li>
          <li><a href=""><span class="icon-span"><img src="{{ asset('car/assets/images/Icons/fax.svg') }}" class="footer-icon"
                  alt=""></span>FAX : {{$profile->fax}}</a></li>
          <li><a href=""><span class="icon-span"><img src="{{ asset('car/assets/images/Icons/email.svg') }}" class="footer-icon"
                  alt=""></span>Email : {{$profile->contactemail}}</a></li>
        </ul>
      </div>
    </div>
    <footer class="bottom-footer">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6 col-12">
            <p class="copyright">
              Copyright <span>@ CAR LISTING</span> 2022
            </p>
          </div>
          <div class="col-lg-6 col-12">
            <ul class="social-links">
               @foreach ($sociallinks as $row)
<li><a href="{{$row->url}}">{{$row->name}}</a></li>
               @endforeach
              
            </ul>
          </div>
        </div>
      </div>
    </footer>