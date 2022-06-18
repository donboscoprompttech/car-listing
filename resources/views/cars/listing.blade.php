<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Listing</title>
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
    

</head>

<body>
    <!-- Navigation-->
        @include('cars.header')

    <!-- Header -->
    <header class="bg-dark gvr-header listing-header">
        <div class="header-div">
            <p class="title">New Cars</p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Homepage</a></li>
                    <li class="breadcrumb-item"><a href="#">New Cars</a></li>
                </ol>
            </nav>
        </div>
    </header>

    <section class="list-section">
        <div class="container-fluid">
            <div class="list-div">

                <!--Left side Filter Div -->
                <div class="filter-div">
                    <div class="filter">
                        <p class="heading">Filter</p>
                        <div class="filter-search">
                            <span class="search-icon"><!--<img src="assets/images/Icons/search.png" alt="search icon"
                                    class="img-fluid search-img" />-->
                                        
                                        <img src="{{ asset('car/assets/images/Icons/search.png') }}" alt="search icon"
                                    class="img-fluid search-img" />
                                    </span>
                            <input type="text" class="form-control" placeholder="Search" />
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
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#brandPanel-collapseOne" aria-expanded="true"
                                            aria-controls="brandPanel-collapseOne">
                                            Brand
                                        </button>
                                    </h2>
                                    <div id="brandPanel-collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="year-panel">
                                        <div class="accordion-body">
                                            <div class="accordion-search">
                                                <input type="text" class="form-control" placeholder="Search">
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
                                                    <label for="Chevrolet"><span>Chevrolet</span></label>
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
                                            data-bs-toggle="collapse" data-bs-target="#modelpanel-collapseTwo"
                                            aria-expanded="false" aria-controls="modelpanel-collapseTwo">
                                            Model
                                        </button>
                                    </h2>
                                    <div id="modelpanel-collapseTwo" class="accordion-collapse collapse"
                                        aria-labelledby="modelpanel-headingTwo">
                                        <div class="accordion-body">

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

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pricerange-div">
                                <div class="range-div">
                                    <p class="range-title">Price Range</p>
                                    <p class="range-value">
                                        <input type="text" id="amount" class="filterAmount" readonly>
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
                                            <p class="heading">Filterr</p>
                                            <div class="filter-search">dd
                                                <span class="search-icon"><img src="{{ asset('car/assets/images/Icons/search.png') }}"
                                                        alt="search icon" class="img-fluid search-img" /></span>
                                                <input type="text" class="form-control" placeholder="Search" />
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
                    <div class="search-div">
                        <span class="search-icon">
                            <img src="{{ asset('car/assets/images/Icons/search.png') }}" class="img-fluid search-img" alt="search icon" />
                        </span>
                        <input type="text" class="form-control result-search" placeholder="Search">
                    </div>
                    <div class="result-activity">
                        <p class="result-count">6 Results</p>
                        <div class="sort-div">
                            <select id="sort" class="form-control">
                                <option>Sort By</option>
                                <option>Date</option>
                                <option>Type</option>
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
                            <button class="btn list-btn active"><i class="fa-solid fa-list"></i></button>
                            <button class="btn block-btn">
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

                    <div class="flat-card-div">
                        <div class="card">
                            <div class="card-body">
                                <div class="img-div">
                                    <div class="ribbon booked"><span>Booked</span></div>
                                    <div class="gallery js-gallery">
                                        <div class="gallery-item">
                                            <div class="gallery-img-holder js-gallery-popup">

                                                <img src="{{ asset('car/assets/images/listing/Product Listing Page/Ford.png') }}" alt=""
                                                    class="gallery-img img-fluid">
                                            </div>
                                        </div>

                                        <div class="gallery-item">
                                            <div class="gallery-img-holder js-gallery-popup">
                                                <img src="{{ asset('car/assets/images/listing/Product Listing Page/Honda.png') }}" alt=""
                                                    class="gallery-img img-fluid">
                                            </div>
                                        </div>
                                        <div class="gallery-item">
                                            <div class="gallery-img-holder js-gallery-popup">
                                                <img src="{{ asset('car/assets/images/listing/Product Listing Page/Tesla.png') }}" alt=""
                                                    class="gallery-img img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="details.html">
                                    <div class="content-div">
                                        <div class="tag-div">
                                            <p>NEW</p>
                                        </div>
                                        <div class="car-name-div">
                                            <p class="car-name">Tesla Model 3 Standard Range Plus</p>
                                        </div>
                                        <div class="price-div">
                                            <p class="price">AED 57,148</p>
                                        </div>
                                        <div class="location-div">
                                            <p class="location">Dubai, UAE</p>
                                        </div>
                                        <div class="details-div">
                                            <div class="detail">
                                                <p><span><img src="{{ asset('car/assets/images/Icons/calendar.png') }}"
                                                            class="img-fluid detail-icon" alt=""></span>2021</p>
                                            </div>
                                            <div class="detail">
                                                <p><span><img src="{{ asset('car/assets/images/Icons/wheel.png') }}"
                                                            class="img-fluid detail-icon" alt=""></span>Rear-wheel Drive
                                                </p>
                                            </div>
                                            <div class="detail">
                                                <p><span><img src="{{ asset('assets/images/Icons/fuel.png') }}"
                                                            class="img-fluid detail-icon" alt=""></span>Electric</p>
                                            </div>
                                            <div class="detail">
                                                <p><span><img src="{{ asset('assets/images/Icons/people.png') }}"
                                                            class="img-fluid detail-icon" alt=""></span>5</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="img-div">
                                    <div class="ribbon booked"><span>Bookedd</span></div>
                                    <div class="gallery js-gallery">
                                        <div class="gallery-item">
                                            <div class="gallery-img-holder js-gallery-popup">
                                                <img src="{{ asset('car/assets/images/listing/Product Listing Page/Ford.png') }}" alt=""
                                                    class="gallery-img img-fluid">
                                            </div>
                                        </div>
                                        <div class="gallery-item">
                                            <div class="gallery-img-holder js-gallery-popup">
                                                <img src="{{ asset('car/assets/images/listing/Product Listing Page/Honda.png') }}" alt=""
                                                    class="gallery-img img-fluid">
                                            </div>
                                        </div>
                                        <div class="gallery-item">
                                            <div class="gallery-img-holder js-gallery-popup">
                                                <img src="{{ asset('car/assets/images/listing/Product Listing Page/Tesla.png') }}" alt=""
                                                    class="gallery-img img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="details.html">
                                    <div class="content-div">
                                        <div class="tag-div">
                                            <p>NEW</p>
                                        </div>
                                        <div class="car-name-div">
                                            <p class="car-name">Tesla Model 3 Standard Range Plus</p>
                                        </div>
                                        <div class="price-div">
                                            <p class="price">AED 57,148</p>
                                        </div>
                                        <div class="location-div">
                                            <p class="location">Dubai, UAE</p>
                                        </div>
                                        <div class="details-div">
                                            <div class="detail">
                                                <p><span><img src="{{ asset('car/assets/images/Icons/calendar.png') }}"
                                                            class="img-fluid detail-icon" alt=""></span>2021</p>
                                            </div>
                                            <div class="detail">
                                                <p><span><img src="{{ asset('car/assets/images/Icons/wheel.png') }}"
                                                            class="img-fluid detail-icon" alt=""></span>Rear-wheel Drive
                                                </p>
                                            </div>
                                            <div class="detail">
                                                <p><span><img src="{{ asset('car/assets/images/Icons/fuel.png') }}"
                                                            class="img-fluid detail-icon" alt=""></span>Electric</p>
                                            </div>
                                            <div class="detail">
                                                <p><span><img src="{{ asset('car/assets/images/Icons/people.png') }}"
                                                            class="img-fluid detail-icon" alt=""></span>5</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                         <div class="card">
                            <div class="card-body">
                                <div class="img-div">
                                    <div class="ribbon booked"><span>Bookedd</span></div>
                                    <div class="gallery js-gallery">
                                        <div class="gallery-item">
                                            <div class="gallery-img-holder js-gallery-popup">
                                                <img src="{{ asset('car/assets/images/listing/Product Listing Page/Ford.png') }}" alt=""
                                                    class="gallery-img img-fluid">
                                            </div>
                                        </div>
                                        <div class="gallery-item">
                                            <div class="gallery-img-holder js-gallery-popup">
                                                <img src="{{ asset('car/assets/images/listing/Product Listing Page/Honda.png') }}" alt=""
                                                    class="gallery-img img-fluid">
                                            </div>
                                        </div>
                                        <div class="gallery-item">
                                            <div class="gallery-img-holder js-gallery-popup">
                                                <img src="{{ asset('car/assets/images/listing/Product Listing Page/Tesla.png') }}" alt=""
                                                    class="gallery-img img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="details.html">
                                    <div class="content-div">
                                        <div class="tag-div">
                                            <p>NEW</p>
                                        </div>
                                        <div class="car-name-div">
                                            <p class="car-name">Tesla Model 3 Standard Range Plus</p>
                                        </div>
                                        <div class="price-div">
                                            <p class="price">AED 57,148</p>
                                        </div>
                                        <div class="location-div">
                                            <p class="location">Dubai, UAE</p>
                                        </div>
                                        <div class="details-div">
                                            <div class="detail">
                                                <p><span><img src="{{ asset('car/assets/images/Icons/calendar.png') }}"
                                                            class="img-fluid detail-icon" alt=""></span>2021</p>
                                            </div>
                                            <div class="detail">
                                                <p><span><img src="{{ asset('car/assets/images/Icons/wheel.png') }}"
                                                            class="img-fluid detail-icon" alt=""></span>Rear-wheel Drive
                                                </p>
                                            </div>
                                            <div class="detail">
                                                <p><span><img src="{{ asset('car/assets/images/Icons/fuel.png') }}"
                                                            class="img-fluid detail-icon" alt=""></span>Electric</p>
                                            </div>
                                            <div class="detail">
                                                <p><span><img src="{{ asset('car/assets/images/Icons/people.png') }}"
                                                            class="img-fluid detail-icon" alt=""></span>5</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="img-div">
                                    <div class="ribbon booked"><span>Bookedd</span></div>
                                    <div class="gallery js-gallery">
                                        <div class="gallery-item">
                                            <div class="gallery-img-holder js-gallery-popup">
                                                <img src="{{ asset('car/assets/images/listing/Product Listing Page/Ford.png') }}" alt=""
                                                    class="gallery-img img-fluid">
                                            </div>
                                        </div>
                                        <div class="gallery-item">
                                            <div class="gallery-img-holder js-gallery-popup">
                                                <img src="{{ asset('car/assets/images/listing/Product Listing Page/Honda.png') }}" alt=""
                                                    class="gallery-img img-fluid">
                                            </div>
                                        </div>
                                        <div class="gallery-item">
                                            <div class="gallery-img-holder js-gallery-popup">
                                                <img src="{{ asset('car/assets/images/listing/Product Listing Page/Tesla.png') }}" alt=""
                                                    class="gallery-img img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="details.html">
                                    <div class="content-div">
                                        <div class="tag-div">
                                            <p>NEW</p>
                                        </div>
                                        <div class="car-name-div">
                                            <p class="car-name">Tesla Model 3 Standard Range Plus</p>
                                        </div>
                                        <div class="price-div">
                                            <p class="price">AED 57,148</p>
                                        </div>
                                        <div class="location-div">
                                            <p class="location">Dubai, UAE</p>
                                        </div>
                                        <div class="details-div">
                                            <div class="detail">
                                                <p><span><img src="{{ asset('car/assets/images/Icons/calendar.png') }}"
                                                            class="img-fluid detail-icon" alt=""></span>2021</p>
                                            </div>
                                            <div class="detail">
                                                <p><span><img src="{{ asset('car/assets/images/Icons/wheel.png') }}"
                                                            class="img-fluid detail-icon" alt=""></span>Rear-wheel Drive
                                                </p>
                                            </div>
                                            <div class="detail">
                                                <p><span><img src="{{ asset('car/assets/images/Icons/fuel.png') }}"
                                                            class="img-fluid detail-icon" alt=""></span>Electric</p>
                                            </div>
                                            <div class="detail">
                                                <p><span><img src="{{ asset('car/assets/images/Icons/people.png') }}"
                                                            class="img-fluid detail-icon" alt=""></span>5</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                         <div class="card">
                            <div class="card-body">
                                <div class="img-div">
                                    <div class="ribbon booked"><span>Bookedd</span></div>
                                    <div class="gallery js-gallery">
                                        <div class="gallery-item">
                                            <div class="gallery-img-holder js-gallery-popup">
                                                <img src="{{ asset('car/assets/images/listing/Product Listing Page/Ford.png') }}" alt=""
                                                    class="gallery-img img-fluid">
                                            </div>
                                        </div>
                                        <div class="gallery-item">
                                            <div class="gallery-img-holder js-gallery-popup">
                                                <img src="{{ asset('car/assets/images/listing/Product Listing Page/Honda.png') }}" alt=""
                                                    class="gallery-img img-fluid">
                                            </div>
                                        </div>
                                        <div class="gallery-item">
                                            <div class="gallery-img-holder js-gallery-popup">
                                                <img src="{{ asset('car/assets/images/listing/Product Listing Page/Tesla.png') }}" alt=""
                                                    class="gallery-img img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="details.html">
                                    <div class="content-div">
                                        <div class="tag-div">
                                            <p>NEW</p>
                                        </div>
                                        <div class="car-name-div">
                                            <p class="car-name">Tesla Model 3 Standard Range Plus</p>
                                        </div>
                                        <div class="price-div">
                                            <p class="price">AED 57,148</p>
                                        </div>
                                        <div class="location-div">
                                            <p class="location">Dubai, UAE</p>
                                        </div>
                                        <div class="details-div">
                                            <div class="detail">
                                                <p><span><img src="{{ asset('car/assets/images/Icons/calendar.png') }}"
                                                            class="img-fluid detail-icon" alt=""></span>2021</p>
                                            </div>
                                            <div class="detail">
                                                <p><span><img src="{{ asset('car/assets/images/Icons/wheel.png') }}"
                                                            class="img-fluid detail-icon" alt=""></span>Rear-wheel Drive
                                                </p>
                                            </div>
                                            <div class="detail">
                                                <p><span><img src="{{ asset('car/assets/images/Icons/fuel.png') }}"
                                                            class="img-fluid detail-icon" alt=""></span>Electric</p>
                                            </div>
                                            <div class="detail">
                                                <p><span><img src="{{ asset('car/assets/images/Icons/people.png') }}"
                                                            class="img-fluid detail-icon" alt=""></span>5</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                         <div class="card">
                            <div class="card-body">
                                <div class="img-div">
                                    <div class="ribbon booked"><span>Bookedd</span></div>
                                    <div class="gallery js-gallery">
                                        <div class="gallery-item">
                                            <div class="gallery-img-holder js-gallery-popup">
                                                <img src="{{ asset('car/assets/images/listing/Product Listing Page/Ford.png') }}" alt=""
                                                    class="gallery-img img-fluid">
                                            </div>
                                        </div>
                                        <div class="gallery-item">
                                            <div class="gallery-img-holder js-gallery-popup">
                                                <img src="{{ asset('car/assets/images/listing/Product Listing Page/Honda.png') }}" alt=""
                                                    class="gallery-img img-fluid">
                                            </div>
                                        </div>
                                        <div class="gallery-item">
                                            <div class="gallery-img-holder js-gallery-popup">
                                                <img src="{{ asset('car/assets/images/listing/Product Listing Page/Tesla.png') }}" alt=""
                                                    class="gallery-img img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="details.html">
                                    <div class="content-div">
                                        <div class="tag-div">
                                            <p>NEW</p>
                                        </div>
                                        <div class="car-name-div">
                                            <p class="car-name">Tesla Model 3 Standard Range Plus</p>
                                        </div>
                                        <div class="price-div">
                                            <p class="price">AED 57,148</p>
                                        </div>
                                        <div class="location-div">
                                            <p class="location">Dubai, UAE</p>
                                        </div>
                                        <div class="details-div">
                                            <div class="detail">
                                                <p><span><img src="{{ asset('car/assets/images/Icons/calendar.png') }}"
                                                            class="img-fluid detail-icon" alt=""></span>2021</p>
                                            </div>
                                            <div class="detail">
                                                <p><span><img src="{{ asset('car/assets/images/Icons/wheel.png') }}"
                                                            class="img-fluid detail-icon" alt=""></span>Rear-wheel Drive
                                                </p>
                                            </div>
                                            <div class="detail">
                                                <p><span><img src="{{ asset('car/assets/images/Icons/fuel.png') }}"
                                                            class="img-fluid detail-icon" alt=""></span>Electric</p>
                                            </div>
                                            <div class="detail">
                                                <p><span><img src="{{ asset('car/assets/images/Icons/people.png') }}"
                                                            class="img-fluid detail-icon" alt=""></span>5</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>

                    <!-- Pagination Div -->
                    <div class="pagination-div">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item active">
                                    <span class="page-link">
                                        2
                                        <span class="sr-only">(current)</span>
                                    </span>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <!-- Pagination Div ends-->

                </div>
                <!-- Right side result div ends -->
            </div>
        </div>
    </section>

    <button class="btn back-to-up-btn rounded-circle position-fixed bottom-0 end-0 translate-middle d-none"
        onclick="scrollToTop()" id="back-to-up">
        <i class="fa-solid fa-chevron-up" aria-hidden="true"></i>
    </button>
    <!-- Footer-->
    <section class="footer-section px-md-5">
        @include('cars.footer')
        
    </section>

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

</body>

</html>