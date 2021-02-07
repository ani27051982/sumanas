<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('headerTitle')</title>
  
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  
  <link rel="stylesheet" href="{{asset('assets/vendor/nucleo/css/nucleo.css')}}">
 
  <link rel="stylesheet" href="{{asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/css/argon.min.css?v=1.2.0')}}">
  
  
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  
    <style type="text/css">
	.pdt_error_class_validate {
            color:#FF0000;
            font-style:italic;
            font-size:14px;
            text-align:left;
            font-weight: normal;
	}
        .is-invalid {
            border :1px solid #fb6340;
        }
        .is-valid {
            border :1px solid #2dce89;
        }
        
        button.disabled {
            cursor: not-allowed !important;
            pointer-events: all !important;
        }
        a.disabled {
            cursor: not-allowed !important;
            pointer-events: all !important;
        }
        

    </style>
@yield('header_styles')
@yield('header_scripts')  
</head>

<body class="bg-default">
    <div class="main-content">
        @yield('mainContent')    
    </div>
    <footer class="py-5" id="footer-main">
        @include('include.footer')
    </footer>
    <script type="text/javascript">
    (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start': new Date().getTime(),
        event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src =
        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-NKDMSK6');
    </script>
    <script src="{{asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>    
    <script src="{{asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>    
    <script src="{{asset('assets/vendor/js-cookie/js.cookie.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}}"></script>
    <script src="{{asset('assets/js/argon.min.js?v=1.2.0')}}" type="text/javascript"></script>
    <script type="text/javascript">
    function GetXmlHttpObject()
    {
        var xmlHttp=null;
        try
        {
        // Firefox, Opera 8.0+, Safari
                xmlHttp=new XMLHttpRequest();
        }
        catch (e)
        {
        // Internet Explorer
                try
                {
                        xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
                }
                catch (e)
                {
                        xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
        }
        return xmlHttp;
    }
    </script>
    @yield('footer_scripts')
</body>
</html>

