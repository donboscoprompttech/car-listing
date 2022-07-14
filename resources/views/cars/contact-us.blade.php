<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Contact Us</title>
    <!-- Favicon-->
    <!--<link rel="icon" type="image/x-icon" href="assets/images/logo.png" />-->
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
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

     <link href="{{ asset('/car/css/slick/slick.css') }}" rel="stylesheet"> 
    <link href="{{ asset('/car/css/slick/slick-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('/car/js/fotorama.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('car/css/developer.css') }}" />


</head>

<body>
    <!-- Navigation-->
    @include('cars.header')  

    <section class="contact-section">
        <p class="section-title">Enquire Now</p>
        <p class="desc">
             {{$contents->enquiryContent}}
        </p>
        <div class="form-div">
             <form action="#" id="frm" class="contact-form">
                @csrf
                <input type="hidden" value="" class="form-control" id="vehicleid" name="vehicleid" required>
                <div class="input-div">
                    <div class="form-group">
                        <label for="">Full Name</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" required>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </div>
                <div class="input-div">
                    <div class="form-group">
                        <label for="">Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject" required>
                    </div>
                </div>
                <div class="input-div">
                    <div class="form-group">
                        <label for="">Message</label>
                        <textarea name="message" id="message" class="form-control" rows="5" required></textarea>
                    </div>
                </div>
                <div class="input-div checkbox-div">
                    <div class="form-group">
                        <input type="checkbox" id="terms" required>
                        <label for="terms"> <span>Accept <a href="#"> terms & conditions</a></span> </label>
                    </div>
                </div>
                <div class="input-div">
                    <button class="btn send-btn"><span>SEND MESSAGE</span></button>
                </div>
            </form>
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
    <script src="{{asset('car/slick/slick.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('car/js/fotorama.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-lightbox/0.2.12/slick-lightbox.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Core theme JS-->
    <script src="{{asset('car/js/scripts.js')}}"></script>

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

$('form').bind('submit', function () {
          $.ajax({
            type: 'post',
            url: '/contactusprocess',
            data: $('form').serialize(),
            dataType : 'json',
            success: function (data) {             
            if (data.status==200){           
              Swal.fire('Enquiry Send Successfully');
              }
              else{
                Swal.fire('Sorry Enquiry not Send');
              }              
              $("#fullname").val('');
              $("#email").val('');
              $("#subject").val('');
              $("#message").val('');
              $("#terms").prop('checked', false); 
            }
          });
          return false;
        });






    </script>

</body>

</html>