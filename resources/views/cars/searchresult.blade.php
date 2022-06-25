 







 
<?php
 if (count($vehicletypecars)==0){
    echo "sorry no result found";
}?>

  <div class="flat-card-div ">

 @foreach ($vehicletypecars as $row)

                        <div class="card ">
                            <div class="card-body">
a
                                <div class="img-div">
                                    <div class="ribbon booked"><span>{{ $row->soldreserved }}</span></div>
                                    <div class="gallery js-gallery">
                                       <?php $images = DB::table('ads_images')->limit(3)->get()
       ;?>
       @foreach ($images as $row1)
                                    <div class="gallery-item">
                                            <div class="gallery-img-holder js-gallery-popup">

                                                <img src="{{asset($row1->image) }}" alt=""
                                                    class="gallery-img img-fluid">
                                            </div>
                                        </div>
@endforeach
                                          
                                    </div>
                                    <script>$(document).ready(function () {
  $('.js-gallery').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      prevArrow: '<span class="gallery-arrow mod-prev"><i class="fa-solid fa-chevron-left"></i></span>',
      nextArrow: '<span class="gallery-arrow mod-next"><i class="fa-solid fa-chevron-right"></i></span>'
  });

  $('.js-gallery').slickLightbox({
      src: 'src',
      itemSelector: '.js-gallery-popup img',
      background: 'rgba(0, 0, 0, .7)'
  });
});





</script>
                                </div>
                                <a href="details.html">
                                    <div class="content-div">
                                        <div class="tag-div">
                                            <p>NEWw</p>
                                        </div><div style="display:inline"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$row->uniquenumber}}</div>
                                        <div class="car-name-div">
                                            <p class="car-name">{{ $row->title }}</p>
                                        </div>
                                        <div class="price-div">
                                            <p class="price">AED {{ $row->price }}</p>
                                        </div>
                                        <div class="location-div">
                                            <p class="location">Dubai, UAE</p>
                                        </div>
                                        <div class="details-div">
                                            <div class="detail">
                                                <p><span><img src="{{ asset('car/assets/images/Icons/calendar.png') }}"
                                                            class="img-fluid detail-icon" alt=""></span>{{$row->registration_year}}</p>
                                            </div>
                                            <div class="detail">
                                                <p><span><img src="{{ asset('car/assets/images/Icons/wheel.png') }}"
                                                            class="img-fluid detail-icon" alt=""></span>{{$row->drive}}
                                                </p>
                                            </div>
                                            <div class="detail">
                                                <p><span><img src="{{ asset('car/assets/images/Icons/fuel.png') }}"
                                                            class="img-fluid detail-icon" alt=""></span>{{$row->fuel_type}}</p>
                                            </div>
                                            <div class="detail">
                                                <p><span><img src="{{ asset('car/assets/images/Icons/people.png') }}"
                                                            class="img-fluid detail-icon" alt=""></span>{{$row->seats}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                       

                    </div>

