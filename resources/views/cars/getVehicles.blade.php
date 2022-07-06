@foreach ($vehicletypecars as $row)

                <?php if ($row->type1==1){?>
                <div class="col-lg-4 col-md-6 car-card">
                  <div class="card h-100">
                     <a href="/details/{{ $row->mainid}}">
                      <div class="card-body">

                        <div class="card-img-div">
                         <img class="card-img img-fluid" src="{{asset($row->image) }}"
                            alt="card image" />
                          <div class="ribbon featured"><span>{{ $row->soldreserved }}</span></div>
                        </div>
                        <div class="car-details-div">
                          <div class="tag-div">
                            <p>{{$row->uniquenumber}}</p>
                          </div>
                          <div class="car-name-div">
                            <p class="car-name">{{ $row->title }}</p>
                          </div>
                          <div class="price-div">
                            <p class="price">AED{{number_format($vehicletypecars->price)}} <span class="strike-price">AED {{ $row->price }}</span></p>
                          </div>
                          <div class="car-details">
                            <p class="location w-100">{{$row->placename}},{{$row->countryname}}</p>

                            <div class="info-div row">
                              <div class="col-lg-5 col-5">
                                <p class="info"><span><img src="{{ asset('car/assets/images/Icons/calendar.png') }}" class="img-fluid icon"
                                      alt="info icon"></span> {{$row->registration_year}}</p>
                              </div>
                              <div class="col-lg-7 col-7">
                                <p class="info"><span><img src="{{ asset('car/assets/images/Icons/wheel.png') }}" class="img-fluid icon"
                                      alt="info icon"></span> {{$row->drive}}</p>
                              </div>
                              <div class="col-lg-5 col-5">
                                <p class="info"><span><img src="{{ asset('car/assets/images/Icons/fuel.png') }}" class="img-fluid icon"
                                      alt="info icon"></span> {{$row->fuel_type}}</p>
                              </div>
                              <div class="col-lg-7 col-7">
                                <p class="info"><span><img src="{{ asset('car/assets/images/Icons/people.png') }}" class="img-fluid icon"
                                      alt="info icon"></span> {{$row->seats}}</p>
                              </div>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                    </a>
                  </div>
                </div>

<?php }?>
                @endforeach