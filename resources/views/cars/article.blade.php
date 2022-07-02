<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Readerstacks laravel 8 ajax pagination with search </title>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
  <link href="//netdna.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" />

</head>

<body class="antialiased">
  <div class="container">
    <!-- main app container -->
    <div class="readersack">
      <div class="container">
        <div class="row">
          <div class="col-md-8 offset-md-2">
            <h3>Laravel 8 ajax pagination with search - Readerstacks</h3>
            <div id="search">
              <form id="searchform" name="searchform">
                <div class="form-group">
                  <label>Search by Title</label>
                  <input type="text" name="title" value="{{request()->get('title','')}}" class="form-control" />
                  @csrf

                </div>
                <div class="form-group">
                  <label>Search by body</label>
                  <input type="text" name="body" value="{{request()->get('body','')}}" class="form-control" />


                </div>
                <a class='btn btn-success' href='{{url("articles")}}' id='search_btn'>Search</a>
              </form>


            </div>
            <div id="pagination_data">
              @include("cars.article-pagination",["articles"=>$articles])
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- credits -->
    <div class="text-center">
      <p>
        <a href="#" target="_top">Laravel 8 ajax pagination with search
        </a>
      </p>
      <p>
        <a href="https://readerstacks.com" target="_top">readerstacks.com</a>
      </p>
    </div>
  </div>
  <script>
    $(function() {
      $(document).on("click", "#pagination a,#search_btn", function() {

        //get url and make final url for ajax 
        var url = $(this).attr("href");
        var append = url.indexOf("?") == -1 ? "?" : "&";
        var finalURL = url + append + $("#searchform").serialize();

        //set to current url
        window.history.pushState({}, null, finalURL);

        $.get(finalURL, function(data) {

          $("#pagination_data").html(data);

        });

        return false;
      })

    });

$(function() {
        $(document).on("click","#pagination a,#search_btn",function(){

          //get url and make final url for ajax 
          var url=$(this).attr("href");
          var append=url.indexOf("?")==-1?"?":"&";
          var finalURL=url+append+$("#searchform").serialize();
          
          //set to current url
          window.history.pushState({},null, finalURL);
          
          $.get(finalURL,function(data){
            $("#pagination_data").html(data);
          });
          return false;
        })
       
      });


    
  </script>
</body>

</html>