<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Category</title>
    <!-- Favicon-->
    <!--<link rel="icon" type="image/x-icon" href="assets/images/logo.png" />-->
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <!--<link href="css/styles.css" rel="stylesheet" />
    <link href="css/main.css" rel="stylesheet" />-->
    <link href="{{ asset('/car/css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('/car/css/main.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Select2 Plugin css -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-lightbox/0.2.12/slick-lightbox.css">

    <!-- Slick slider -->
    <!--<link rel="stylesheet" type="text/css" href="css/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="css/slick/slick-theme.css" />-->
    <link href="{{ asset('/car/css/slick/slick.css') }}" rel="stylesheet"> 
    <link href="{{ asset('/car/css/slick/slick-theme.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('car/css/developer.css') }}" />
    <style>
        .pagination{
            float: right;
            margin-top: 10px;
        }
        .page-link{
            color:#1d1d1d;background-color:#f0d32f ;border-color:#f0d32f ;
        }
        .page-item.active .page-link {
  z-index: 3;
  color: #000;
  background-color: #ffffff;
  border-color: #f0d32f;
}
div.ex1 {
  overflow-y: scroll;
}
</style>

</head>

<body>
    <!-- Navigation-->
        @include('cars.header')

    <!-- Header -->
    <header class="bg-dark gvr-header listing-header">
        <div class="header-div">
            <p class="title">Category</p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Category</a></li>
                </ol>
            </nav>
        </div>
    </header>

    <section class="list-section">
        <div class="container-fluid">
            <div class="list-div">

                <!--Left side Filter Div -->
                <div class="filter-div">
                    <form action="#" method="get">
                       @csrf
                    <div class="filter">
                        <p class="heading">Filter</p>
                        <div class="filter-search">

                            <span class="search-icon"><!--<img src="assets/images/Icons/search.png" alt="search icon"
                                    class="img-fluid search-img" />-->
                                 <a onclick="setflag(1)" href="/category/<?php echo $cname;?>" id='search_btn0'>       
                                        <img src="{{ asset('car/assets/images/Icons/search.png') }}" alt="search icon"
                                    class="img-fluid search-img" /></a>
                                    </span>
                            <input type="text" id="searchall" name="searchall" class="form-control filgroup" placeholder="Search" />
                        </div>
                        <div class="filter-accordion-div">
                            <div class="accordion" id="yearAccordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="year-panel">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#yearPanel-collapseOne" aria-expanded="true"
                                            aria-controls="yearPanel-collapseOne">
                                            Year
                                        </button>
                                    </h2>
                                    <div id="yearPanel-collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="year-panel">
                                        <div class="accordion-body ex1">
                                            <span class="caryear">
                                                 <input id="offsetyear"class="offsetyear" type="hidden" value="0" />
@foreach ($year as $row)
<div class="form-group">

                                                    <input type="checkbox" id="{{$row->registration_year}}" name="year[]" value="{{$row->registration_year}}" class="filgroup year">
                                                    <label for="{{$row->registration_year}}"><span>{{$row->registration_year}}</span></label>

                                                    
              
                                                </div>

@endforeach


                                            </span>
                                            
                                            <a href="javascript:void(0)" onclick="showmore()" class="see-more-link">See More</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="year-panel">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#brandPanel-collapseOne" aria-expanded="true"
                                            aria-controls="brandPanel-collapseOne">
                                            Make
                                        </button>
                                    </h2>
                                    <div id="brandPanel-collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="year-panel">
                                        <div class="accordion-body">
                                            
                                               


<span class="carmake">
@foreach ($make as $row)
<div class="form-group">

                                                    <input type="checkbox" name="carmake[]" value={{$row->make_id}} class="filgroup mak">
                                                    <label for="{{$row->make_id}}"><span>{{$row->name}}</span></label>

                                                    <?php $offset=0;?>
                                                    <input class="offsetmake" id="offsetmake" value=0 />
                                                </div>

@endforeach


                                            </span>

                                            
                                            <a href="javascript:void(0)"  onclick="showmoremake()" class="see-more-link">See More</a>






                                        </div>




                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="modelpanel">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#modelpanel-collapseTwo"
                                            aria-expanded="false" aria-controls="modelpanel-collapseTwo">
                                            Model
                                        </button>
                                    </h2>
                                    <div id="modelpanel-collapseTwo" class="accordion-collapse collapse"
                                        aria-labelledby="modelpanel-headingTwo">
                                        <div class="accordion-body">

                                           


<span class="carmodel">
@foreach ($model as $row)
<div class="form-group">

                                                    <input type="checkbox" class="filgroup mod" name="carmodel[]" value={{$row->model_id}}>
                                                    <label for="{{$row->model_id}}"><span>{{$row->name}}</span></label>

                                                    <?php $offsetmodel=0;?>
                                                    <input class="offsetmodel" id="offsetmodel" value=0 />
                                                </div>

@endforeach


                                            </span>

                                          
                                            <a href="javascript:void(0)"  onclick="showmoremodel()" class="see-more-link">See More</a>




                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="modelpanel">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#fuelpanel-collapseTwo"
                                            aria-expanded="false" aria-controls="fuelpanel-collapseTwo">
                                            Fuel Type
                                        </button>
                                    </h2>
                                    <div id="fuelpanel-collapseTwo" class="accordion-collapse collapse"
                                        aria-labelledby="fuelpanel-headingTwo">
                                        <div class="accordion-body">

                                           


<span class="carfueltype">
@foreach ($fueltype as $row)
<div class="form-group">

                                                    <input type="checkbox" class="filgroup ft" name="carfueltype[]" value={{$row->fuel_type}}>
                                                    <label for="{{$row->fuel_type}}"><span>{{$row->fuel_type}}</span></label>

                                                    <?php $offsetfuel_type=0;?>
                                                    <input class="offsetfueltype" id="offsetfueltype" value=0 />
                                                </div>

@endforeach


                                            </span>

                                           
                                            <!--<a href="javascript:void(0)"  onclick="showmorefueltype()" class="see-more-link">See More</a>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="modelpanel">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#passengerpanel-collapseTwo"
                                            aria-expanded="false" aria-controls="passengerpanel-collapseTwo">
                                            Passenger Capacity
                                        </button>
                                    </h2>
                                    <div id="passengerpanel-collapseTwo" class="accordion-collapse collapse"
                                        aria-labelledby="passengerpanel-headingTwo">
                                        <div class="accordion-body">

<input type=hidden class="offsetpassengercapacity" id="offsetpassengercapacity" value=0 />

<span class="carpassengercapacity">
@foreach ($passengercapacity as $row)
<div class="form-group">

                                               <input type="checkbox" name="carpassengercapacity[]" class="filgroup pc" value={{$row->seats}}>
                                                    <label for="{{$row->seats}}"><span>{{$row->seats}}</span></label>

                                                    <?php $offsetpassengercapacity=0;?>
                                                    
                                                </div>

@endforeach


                                            </span>

                                            
                                            <a href="javascript:void(0)"  onclick="showmorepassengercapacity()" class="see-more-link">See More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pricerange-div">
                                <div class="range-div">
                                    <p class="range-title">Price Range</p>
                                    <p class="range-value">
                                        <input type="text" id="amount" name="amount" class="filterAmount filgroup" readonly>
                                         <input type="hidden" name="priceflag" id="priceflag" value="0">
                                    </p>
                                </div>
                                <div class="my-auto">
                                    <div class="price-range-slider">
                                        <div id="slider-range" class="range-bar"></div>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="button-div">
                                <a id="bt3" class="btn header-search-btn" onclick="#" href="/category/<?php echo $cname;?>">Go
                                <!--<button  type="button" class="btn header-search-btn">Search</button>--></a>

                                <button type="button" class="btn filter-reset-btn">Reset Filter</button>
                            </div>
                        </div>

                    </div>
                     </form>
                </div>
                <!-- Left side filter div ends -->

                <!-- Mobile filter modal -->
                <!-- Only visible in mobile view -->
                <div class="left-modal-div">
                    <div class="modal left fade" id="filterModal" tabindex="-1" role="dialog"
                        aria-labelledby="filterModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="filterModalLabel">Filter</h4>
                                    <button type="button" class="close btn" data-bs-dismiss="modal"
                                        aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>

                                <div class="modal-body">
                                    <div class="filter-div">
                                        <div class="filter">
                                            <p class="heading">Filter</p>
                                            <div class="filter-search">
                                                <span class="search-icon"><img src="{{ asset('car/assets/images/Icons/search.png') }}"
                                                        alt="search icon" class="img-fluid search-img" onclick="searchfirsttextbox();" /></span>
                                                <input type="text" class="form-control" placeholder="Search"  id="searchallfirst1" />
                                            </div>
                                            <div class="filter-accordion-div">
                                                <div class="accordion" id="yearAccordion">
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="year-panel">
                                                            <button class="accordion-button" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#yearPanel-collapseOne"
                                                                aria-expanded="true"
                                                                aria-controls="yearPanel-collapseOne">
                                                                Year
                                                            </button>
                                                        </h2>
                                                        <div id="yearPanel-collapseOne"
                                                            class="accordion-collapse collapse show"
                                                            aria-labelledby="year-panel">
                                                            <div class="accordion-body">
                                                                <form action="">
                                                                    <div class="form-group">
                                                                        <input type="checkbox" id="2016">
                                                                        <label for="2016"><span>2016</span></label>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="checkbox" id="2017">
                                                                        <label for="2017"><span>2017</span></label>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="checkbox" id="2018">
                                                                        <label for="2018"><span>2018</span></label>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="checkbox" id="2019">
                                                                        <label for="2019"><span>2019</span></label>
                                                                    </div>
                                                                </form>
                                                                <a href="#" class="see-more-link">See More</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="year-panel">
                                                            <button class="accordion-button" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#brandPanel-collapseOne"
                                                                aria-expanded="true"
                                                                aria-controls="brandPanel-collapseOne">
                                                                Brand
                                                            </button>
                                                        </h2>
                                                        <div id="brandPanel-collapseOne"
                                                            class="accordion-collapse collapse show"
                                                            aria-labelledby="year-panel">
                                                            <div class="accordion-body">
                                                                <div class="accordion-search">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Search">
                                                                </div>
                                                                <form action="">
                                                                    <div class="form-group">
                                                                        <input type="checkbox" id="Audi">
                                                                        <label for="Audi"><span>Audi</span></label>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="checkbox" id="BMW">
                                                                        <label for="BMW"><span>BMW</span></label>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="checkbox" id="Chevrolet">
                                                                        <label
                                                                            for="Chevrolet"><span>Chevrolet</span></label>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="checkbox" id="Ford">
                                                                        <label for="Ford"><span>Ford</span></label>
                                                                    </div>
                                                                </form>
                                                                <a href="#" class="see-more-link">See More</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="modelpanel">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#modelpanel-collapseTwo"
                                                                aria-expanded="false"
                                                                aria-controls="modelpanel-collapseTwo">
                                                                Model
                                                            </button>
                                                        </h2>
                                                        <div id="modelpanel-collapseTwo"
                                                            class="accordion-collapse collapse"
                                                            aria-labelledby="modelpanel-headingTwo">
                                                            <div class="accordion-body">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="modelpanel">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#fuelpanel-collapseTwo"
                                                                aria-expanded="false"
                                                                aria-controls="fuelpanel-collapseTwo">
                                                                Fuel Type
                                                            </button>
                                                        </h2>
                                                        <div id="fuelpanel-collapseTwo"
                                                            class="accordion-collapse collapse"
                                                            aria-labelledby="fuelpanel-headingTwo">
                                                            <div class="accordion-body">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="modelpanel">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#passengerpanel-collapseTwo"
                                                                aria-expanded="false"
                                                                aria-controls="passengerpanel-collapseTwo">
                                                                Passenger Capacity
                                                            </button>
                                                        </h2>
                                                        <div id="passengerpanel-collapseTwo"
                                                            class="accordion-collapse collapse"
                                                            aria-labelledby="passengerpanel-headingTwo">
                                                            <div class="accordion-body">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="pricerange-div">
                                                    <div class="range-div">
                                                        <p class="range-title">Price Range</p>
                                                        <p class="range-value">
                                                            <input type="text" id="amount" class="filterAmount"
                                                                readonly>
                                                        </p>
                                                    </div>
                                                    <div class="my-auto">
                                                        <div class="price-range-slider">
                                                            <div id="slider-range" class="range-bar"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="button-div">
                                                    <button class="btn filter-reset-btn">Reset Filter</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div><!-- modal-content -->
                        </div><!-- modal-dialog -->
                    </div>
                </div>
                <!-- Mobile filter modal ends-->



                <!-- Right side result div -->
                <div class="result-div">
                    <form id="searchform" method="get">
                    <div class="search-div">
                    <span class="search-icon"  >
                            <a onclick="setflag(2)" href="/category/<?php echo $cname;?>" id='search_btn'><img src="{{ asset('car/assets/images/Icons/search.png') }}"  class="img-fluid search-img" alt="search icon" /></a>
                        </span>
                        <input type="text" id="searchallfirst" class="form-control result-search" placeholder="Search">
                    </div>
                    <div class="result-activity">
                        <p class="result-count "><span class="rescount2"><?php echo($vehicletypecarscount);?> </span>Results</p>
                        <div class="sort-div">
                            <select id="sortcombo" class="form-control" onchange="formsubmit(this.value);">
                                <option value="0">Sort By</option>
                                <option value="Date">Date</option>
                                <option value="Price">Price</option>
                            </select>

                            <!-- Filter button for mobile -->
                            <!-- Only visible in mobile view -->
                            <!-- When clicked filter modal open from left and show the filter in mobile view  -->

                            <div class="mobile-filter-btn">
                                <button class="btn filter-btn-mobile" data-bs-toggle="modal"
                                    data-bs-target="#filterModal"><i class="fa-solid fa-filter"></i></button>
                            </div>
                            <!-- Filter button for mobile ends -->

                        </div>
                        <div class="view-mode-div">
                            <button type="button" class="btn list-btn active"><i class="fa-solid fa-list"></i></button>
                            <button type="button" class="btn block-btn">
                                <span class="icon-span">

                                    <svg id="SvgjsSvg1011" width="288" height="288" xmlns="http://www.w3.org/2000/svg"
                                        version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xmlns:svgjs="http://svgjs.com/svgjs">
                                        <defs id="SvgjsDefs1012"></defs>
                                        <g id="SvgjsG1013"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
                                                <path
                                                    d="M6 14h6a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2zm14 0h6a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-6a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2zM4 26a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v6zm14 0a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-6a2 2 0 0 0-2-2h-6a2 2 0 0 0-2 2v6z"
                                                    fill="#f0d32f" class="color000 svgShape"></path>
                                            </svg></g>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>
</form>

<div class="res2" >
<div id="pagination_data">
@include("cars.ajax-pagination",["vehicletypecars"=>$vehicletypecars])
</div>
</div>
<input type="hidden" name="flagajax" id="flagajax" value="0">

              

                </div>
                <!-- Right side result div ends -->
            </div>
        </div>
    </section>
<input type="hidden" name="cat" id="cat" value="<?php echo $cname;?>">
    <button class="btn back-to-up-btn rounded-circle position-fixed bottom-0 end-0 translate-middle d-none"
        onclick="scrollToTop()" id="back-to-up">
        <i class="fa-solid fa-chevron-up" aria-hidden="true"></i>
    </button>
    <!-- Footer-->
    <section class="footer-section px-md-5">
        @include('cars.footer')
        
    </section>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 plug in JS -->
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <!-- Slick js -->
    
<script src="{{asset('car/css/slick/slick.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-lightbox/0.2.12/slick-lightbox.min.js"></script>

    <!-- Core theme JS-->
    <script src="{{ asset('car/js/scripts.js') }}"></script>
    
        







 <script>


function formsubmit(val){
    var year = [];
var make=[];
var model=[];
var ft1=[];
var pc=[]
$('input:checkbox.year').each(function () {
       var sThisVal = (this.checked ? $(this).val() : "");
       if (sThisVal!=''){
       year.push(sThisVal);
   }
  });
$('input:checkbox.mak').each(function () {
       var sThisVal = (this.checked ? $(this).val() : "");
       if (sThisVal!=''){
       make.push(sThisVal);
   }
  });
$('input:checkbox.mod').each(function () {
       var sThisVal = (this.checked ? $(this).val() : "");
       if (sThisVal!=''){
       model.push(sThisVal);
   }
  });
$('input:checkbox.ft').each(function () {
       var sThisVal = (this.checked ? $(this).val() : "");
       if (sThisVal!=''){
       ft1.push(sThisVal);
   }
  });
$('input:checkbox.pc').each(function () {
       var sThisVal = (this.checked ? $(this).val() : "");
       if (sThisVal!=''){
       pc.push(sThisVal);
   }
  });
    //var sortcombo=$("#sortcombo").val();
    
    
    //var url = $(this).attr("href");
    var url=window.location.href; 
        var append = url.indexOf("?") == -1 ? "?" : "&";
        //alert($("#searchform").serialize());
        //var finalURL = url + append + $("#searchform").serialize();
        var kw=$("#searchallfirst").val();
        //var finalURL = url + append + "&searchtextboxfirst="+kw+"&sortcombo="+sortcombo;
var sortcombo=$('#sortcombo option:selected').val();
        var kw0=$("#searchall").val();
        var flagajax=$("#flagajax").val();
        var priceflag=$("#priceflag").val();
        var amount=$("#amount").val();
        var finalURL = url + append + "&searchtextboxfirst="+kw+"&sortcombo="+sortcombo+"&searchtextbox="+kw0+"&flagajax="+flagajax+"&year[]="+year+"&carmake[]="+make+"&carmodel[]="+model+"&carfueltype[]="+ft1+"&carpassengercapacity[]="+pc+"&sortcombo1="+sortcombo+"&priceflag="+priceflag+"&amount="+amount;
//alert(finalURL);
        //set to current url
        window.history.pushState({}, null, finalURL);

        $.get(finalURL, function(data) {

          $("#pagination_data").html(data);
          var count=$("#count").val();
          $(".rescount2").html(count);

        });




}


   // $(function() {
      $(document).on("click", "#pagination a,#search_btn,#search_btn0,#bt3", function() {
var year = [];
var make=[];
var model=[];
var ft1=[];
var pc=[]
$('input:checkbox.year').each(function () {
       var sThisVal = (this.checked ? $(this).val() : "");
       if (sThisVal!=''){
       year.push(sThisVal);
   }
  });
$('input:checkbox.mak').each(function () {
       var sThisVal = (this.checked ? $(this).val() : "");
       if (sThisVal!=''){
       make.push(sThisVal);
   }
  });
$('input:checkbox.mod').each(function () {
       var sThisVal = (this.checked ? $(this).val() : "");
       if (sThisVal!=''){
       model.push(sThisVal);
   }
  });
$('input:checkbox.ft').each(function () {
       var sThisVal = (this.checked ? $(this).val() : "");
       if (sThisVal!=''){
       ft1.push(sThisVal);
   }
  });
$('input:checkbox.pc').each(function () {
       var sThisVal = (this.checked ? $(this).val() : "");
       if (sThisVal!=''){
       pc.push(sThisVal);
   }
  });



        var sortcombo=$("#sortcombo").val();
        //get url and make final url for ajax 
   var url = $(this).attr("href");
        //var url=window.location.href;
        var append = url.indexOf("?") == -1 ? "?" : "&";
        //alert($("#searchform").serialize());
        //var finalURL = url + append + $("#searchform").serialize();
        var kw=$("#searchallfirst").val();
        var kw0=$("#searchall").val();
        var flagajax=$("#flagajax").val();
        var priceflag=$("#priceflag").val();
        var amount=$("#amount").val();
        var finalURL = url + append + "&searchtextboxfirst="+kw+"&sortcombo="+sortcombo+"&searchtextbox="+kw0+"&flagajax="+flagajax+"&year[]="+year+"&carmake[]="+make+"&carmodel[]="+model+"&carfueltype[]="+ft1+"&carpassengercapacity[]="+pc+"&sortcombo1="+sortcombo+"&priceflag="+priceflag+"&amount="+amount;
//alert(finalURL);
        //set to current url
        window.history.pushState({}, null, finalURL);

        $.get(finalURL, function(data) {

          $("#pagination_data").html(data);
          var count=$("#count").val();
          $(".rescount2").html(count);

        });

        return false;
      })

   // });

function setflag(value){
    $("#flagajax").val(value);
}
$("#bt3").click(function(){
        $("#flagajax").val(3);
    });
$(function() {
$(".offsetyear").val(0);
    $(".offsetpassengercapacity").val(0);
    $(".offsetfueltype").val(0);
    $(".offsetmake").val(0);
    $(".offsetmodel").val(0);

    
  $( ".range-bar" ).slider({
    range: true,
    min: <?php echo $minprice[0]->price;?>,
    max: <?php echo $maxprice[0]->price;?>,
    values: [ 0, <?php echo $maxprice[0]->price;?> ],
    slide: function( event, ui ) {
    $( ".filterAmount" ).val( "AED" + ui.values[ 0 ] + " - AED" + ui.values[ 1 ] );
    }
  });
  $( ".filterAmount" ).val( "AED" + $( ".range-bar" ).slider( "values", 0 ) +
    " -AED" + $( ".range-bar" ).slider( "values", 1 ) );
});
$(function() {    // <== doc ready

    $( "#slider-range" ).slider({
       change: function(event, ui) {           
var low = $(this).slider('values', 0);
            var high = $(this).slider('values', 1);
$("#priceflag").val(1);

       }
    });

});
    
function showmore(){
var val=$(".offsetyear").val();
var val1=parseInt(val)+4;
//alert(val);
$.ajax({
            type: 'get',
            url:"{{ route('yearrender') }}",
            dataType: 'html',
            data:{val:val},
            success: function (data) {
//$(".caryear").html(data);
$(".caryear").append(data);

$(".offsetyear").val(val1);
 },error:function(){
                console.log(data);
            }
        });               
}


function showmoremake(offset){
var val=$(".offsetmake").val();
var val1=parseInt(val)+4;
$.ajax({
            type: 'get',
            url:"{{ route('makerender') }}",
            dataType: 'html',
            'data':{val:val},
            success: function (data) {
//$(".carmake").html(data);
$(".carmake").append(data);
$(".offsetmake").val(val1);
 },error:function(){
                console.log(data);
            }
        });               
}


function showmoremodel(offset){
var val=$(".offsetmodel").val();
var val1=parseInt(val)+4;
$.ajax({
            type: 'get',
            url:"{{ route('modelrender') }}",
            dataType: 'html',
            'data':{val:val},
            success: function (data) {
//$(".carmodel").html(data);
$(".carmodel").append(data);
$(".offsetmodel").val(val1);
 },error:function(){
                console.log(data);
            }
        });               
}

function showmorefueltype(offset){
var val=$("#offsetfueltype").val();
var val1=parseInt(val)+4;
$.ajax({
            type: 'get',
            url:"{{ route('fueltyperender') }}",
            dataType: 'html',
            'data':{val:val},
            success: function (data) {
//$(".carfueltype").html(data);
$(".carfueltype").append(data);
$(".offsetfueltype").val(val1);
 },error:function(){
                console.log(data);
            }
        });               
}


function showmorepassengercapacity(offset){

var val=$("#offsetpassengercapacity").val();
var val1=parseInt(val)+4;

$.ajax({
            type: 'get',
            url:"{{ route('passengercapacityrender') }}",
            dataType: 'html',
            'data':{val:val},
            success: function (data) {
//$(".carpassengercapacity").html(data);
$(".carpassengercapacity").append(data);
$(".offsetpassengercapacity").val(val1);
 },error:function(){
                console.log(data);
            }
        });               
}






$('.filter-reset-btn').click(function() {
    $(".filgroup").prop("checked", false);
    $('.filgroup').val('');
    $("#priceflag").val(0);
    $(".offsetyear").val(0);
    $(".offsetpassengercapacity").val(0);
    $(".offsetfueltype").val(0);
    $(".offsetmake").val(0);
    $(".offsetmodel").val(0);
    location.reload();
});


    


  </script>
</body>

</html>