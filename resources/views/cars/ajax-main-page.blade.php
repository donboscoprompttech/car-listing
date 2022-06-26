<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel 8 Ajax Pagination Example - MyWebTuts.com</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Laravel 8 Ajax Pagination Example - MyWebTuts.com</h5>
                    </div>
                    <div class="card-body" id="tag_container">
                        @include('pagiresult');
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <script type="text/javascript">
        $(window).on('hashchange',function(){
            if (window.location.hash) {
                var page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                } else{
                    getData(page);
                }
            }
        });
        $(document).ready(function(){
            $(document).on('click','.pagination a',function(event){
                event.preventDefault();
                $('li').removeClass('active');
                $(this).parent('li').addClass('active');
                var url = $(this).attr('href');
                var page = $(this).attr('href').split('page=')[1];
                getData(page);
            });
        });
        function getData(page) {
            // body...
            $.ajax({
                url : '?page=' + page,
                type : 'get',
                datatype : 'html',
            }).done(function(data){
                $('#tag_container').empty().html(data);
                location.hash = page;
            }).fail(function(jqXHR,ajaxOptions,thrownError){
                alert('No response from server');
            });
        }
    </script>
</body>
</html>