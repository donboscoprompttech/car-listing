<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Details</title>
    <!-- Favicon-->
    <!--<link rel="icon" type="image/x-icon" href="assets/images/logo.png" />-->
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link rel="stylesheet" type="text/css" href="{{ url('car/css/styles.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('car/css/main.css') }}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Select2 Plugin css -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-lightbox/0.2.12/slick-lightbox.css">

    <!-- Slick slider -->
    <link rel="stylesheet" type="text/css" href="{{ url('car/css/slick/slick.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('car/css/slick/slick-theme.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('car/css/developer.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('car/css/developer.css') }}" />

</head>

<body>
    <!-- Navigation-->
    @include('cars.header')
    <section class="contact-section how-it-work" style="background-color: #fff;">
        <div class="content-left-wrap col-md-12">


            <div id="primary" class="content-area">

                <main id="main" class="site-main">

                    <article id="post-191" class="post-191 page type-page status-publish hentry">

                        <header class="entry-header" style="padding:30px">

                            
                            <h1 class="entry-title" itemprop="headline">About GVR</h1>
                        </header><!-- .entry-header -->

                        <div class="entry-content" style="padding:30px">

                            <p>GVR is one of the leading online car classified site and car marketplace in UAE to buy and sell used and new cars or post free car ads to sell your car in minutes.</p>

<p>On GVR, you can browse best car collection in UAE on best price. You can browse over thousands of car on GVR Dubai platform to find your next car without leaving your comfort and tired of visiting showrooms.</p>

<p>We (GVR) is an online marketplace in UAE to buy used car in UAE. Place your car ads absolutely free.</p>
                           

                        </div><!-- .entry-content -->


                    </article><!-- #post-## -->
                </main><!-- #main -->

            </div><!-- #primary -->


        </div>
    </section>

    <button class="btn back-to-up-btn rounded-circle position-fixed bottom-0 end-0 translate-middle d-none" onclick="scrollToTop()" id="back-to-up">
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

    <script src="{{ asset('car/css/slick/slick.min.js') }}"></script>
    <!-- Core theme JS-->




    <script type="text/javascript" src="{{asset('car/js/fotorama.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-lightbox/0.2.12/slick-lightbox.min.js"></script>

    <!-- Core theme JS-->
    <script src="{{ asset('car/js/scripts.js') }}"></script>

    <script>
        $('iframe').contents().find('video').css({
            opacity: 0,
            color: 'purple'
        });
    </script>

    <script>
        $('.fotorama').fotorama({
            allowfullscreen: true,
            nav: 'thumbs',
            arrows: true,
            thumbwidth: 145,
            thumbheight: 99,
            allowfullscreen: true,
        });
    </script>

</body>

</html>