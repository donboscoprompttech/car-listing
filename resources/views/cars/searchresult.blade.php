 


<style type="text/css">
    
.see-more-link {
   color: #f0d32f;
  font-size: 0.9rem;
}
</style>




 
<?php
 if (count($vehicletypecars)==0){
    echo "sorry no result found";
}?>

  <div class="flat-card-div ">

 @foreach ($vehicletypecars as $row)

                        <div class="card ">
                            <div class="card-body">

                                <div class="img-div">
                                    <div class="ribbon booked"><span>{{ $row->soldreserved }}</span></div>
                                    <div class="gallery js-gallery">
                                       <?php  


                                       $images = DB::table('ads_images')->limit(3)->where('ads_id',$row->id)->get()
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
                                <a href="/details/{{ $row->mainid}}">
                                    <div class="content-div">
                                        <div class="tag-div">
                                            <p>{{$row->uniquenumber}}</p>
                                        </div>
                                        <div class="car-name-div">
                                            <p class="car-name">{{ $row->makename }}-{{ $row->title }}</p>
                                        </div>
                                        <div class="price-div">
                                            <p class="price">AED <?php echo $price = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $row->price);?></p>
                                        </div>
                                        <div class="location-div">
                                            <p class="location">{{$row->placename}},{{$row->countryname}}</p>
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

<input type="hidden" name="first" id="first" value="<?php echo $offset;?>">
<input type="hidden" name="flag" id="flag" value="<?php echo $flag;?>">

                        @endforeach
                        <?php
 if ((count($vehicletypecars)!=0)&&($currcount==10)){?>
    <div style="text-align:right">
<a href='#'class="see-more-link" onclick="showmoreajax();"><b>See More ></b></a>           
<?php } ?>
                    </div>

 