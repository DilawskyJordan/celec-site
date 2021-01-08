<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{url('resources/images/logos/celec_blanc.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    {{-- {{url()}} => this will generate url: 127.0.0.1/ , example {{url('css/style.css')}} => this will generate : 127.0.0.1/css --}}
    @if(Request::is('register'))
        <link rel="stylesheet" href="{{url('resources/css/style.css')}}">
    @elseif(Request::is('formation'))
      <link rel="stylesheet" href="{{url('resources/css/formation.css')}}">
    @elseif(Request::is('events'))
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
        <link rel="stylesheet" href="{{url('resources/css/eventssa.css')}}">)
    @elseif(Request::is("learn"))
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <link rel="stylesheet" href="{{url('resources/css/cours.css')}}">
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,600&amp;display=swap" rel="stylesheet">
    @elseif(Request::is("gallerie"))
        <link rel="stylesheet" href="{{url('resources/css/gallerie.css')}}">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}}
    @else
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{url('resources/css/site.css')}}">
    @endif
    @livewireStyles
    <title>@yield("title")</title>
    @if(Request::is('register'))
         <style>
            .dropbtn {
              background-color: transparent;
              color: white;
              padding: 8px;
              font-size: 19px;
              border: none;
              cursor: pointer;
            }
            
            .dropdown {
              position: relative;
              display: inline-block;
            }
            
            .dropdown-content {
              display: none;
              position: absolute;
              background-color: #f9f9f9;
              min-width: 160px;
              box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
              z-index: 1;
            }
            
            .dropdown-content a {
              color: black;
              padding: 12px 16px;
              text-decoration: none;
              display: block;
            }
            
            .dropdown-content a:hover {
                background-color: rgba(31, 183, 253, 0.116);
                color: #194B73;

                border-radius: 20px;
                transition: .5s;
            
            }
            
            .dropdown:hover .dropdown-content {
              display: block;
            }
        </style>
    @endif
</head>

<body>
        <!--loader-->
        @if(Request::is('register') == false AND Request::is("formation") == false AND Request::is("events") == false AND Request::is("learn") == false AND Request::is("gallerie") == false)
            <div class="loader-wrapper">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 539.8 122.57" id="logo"><defs><style>.cls-1{fill:none;stroke:#ffffff;stroke-miterlimit:10;stroke-width:4px;}
                </style>
                </defs><title>Asset 1logo</title>
                <g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1">
                    <path class="cls-1" d="M61.53,96.63q18.85,0,30.83-14.93l16.4,16.9q-19.51,22-46,22T19.14,103.84Q2,87.12,2,61.61T19.47,19.06Q36.93,2,62.19,2q28.2,0,47.23,21.48l-15.91,18Q81.38,26.44,63.34,26.44a35.17,35.17,0,0,0-24.69,9.43Q28.41,45.29,28.4,61.29T38.08,87A31.94,31.94,0,0,0,61.53,96.63Z"/>
                    <path class="cls-1" d="M211.59,4.62v22.8H154.52V51h51.33V72.85H154.52V96.63H213.4v22.63H128.94V4.62Z"/>
                    <path class="cls-1" d="M236.19,119.26V4.62h25.58V96.46h48.88v22.8Z"/>
                    <path class="cls-1" d="M412,4.62v22.8H354.92V51h51.34V72.85H354.92V96.63H413.8v22.63H329.34V4.62Z"/>
                    <path class="cls-1" d="M489.24,96.63q18.86,0,30.83-14.93l16.4,16.9q-19.51,22-46,22t-43.62-16.73q-17.14-16.73-17.14-42.23t17.46-42.55Q464.65,2,489.89,2q28.22,0,47.24,21.48l-15.91,18Q509.09,26.44,491,26.44a35.15,35.15,0,0,0-24.68,9.43q-10.25,9.42-10.25,25.42T465.79,87A31.93,31.93,0,0,0,489.24,96.63Z"/>
                </g>
                </g>
                </svg>
            </div>
        @endif
        
        
         <!--*************** NavBar ***************-->
         @if(Request::is("register"))
            <x-second-nav-bar/>
        @elseif(Request::is("formation") OR Request::is("gallerie"))
            <x-third-nav-bar/>
        @else
         {{-- this will require: resources/views/components/first-nav-bar.blade.php --}}
            <x-first-nav-bar/>
        @endif

        <!-- this will be replaced by the page -->
        @yield("content")

        <!--footer-->
        @if(Request::is('register') OR Request::is("gallerie"))
            <x-second-footer/>
        @elseif(Request::is("fomration"))
            <x-third-footer/>
        @else
            <x-first-footer/>
        @endif

    {{-- Check if we are in register page --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    @if(Request::is("register"))
        <script>
            const toggleButton = document.getElementsByClassName('toggle-button')[0]
           const navbarLinks = document.getElementsByClassName('navbar-links')[0]

           toggleButton.addEventListener('click', () => {
           navbarLinks.classList.toggle('active')
           })
            const realFileBtn = document.getElementById("real-file");
            const customBtn = document.getElementById("custom-button");
            const customTxt = document.getElementById("custom-text");

            customBtn.addEventListener("click", function() {
                realFileBtn.click();
            });

            realFileBtn.addEventListener("change", function() {
                if (realFileBtn.value) {
                    customTxt.innerHTML = realFileBtn.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
                } else {
                    customTxt.innerHTML = "No file chosen, yet.";
                }
            });
        </script>
    @else  
             
    
            <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
            <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>


            {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <script src="https://kit.fontawesome.com/27e5e9f5bc.js" ></script> 
            <script> 
                 AOS.init();
                setTimeout(function(){
                      $('.loader-wrapper').fadeToggle();
                },3000);
                $(document).ready(function(){
                    $('.logo-area').slick({
                        slidesToShow:3,
                        slidesToScroll:1,
                        autoplay:true,
                        autoplaySpeed:1500,
                        arrows:false,
                        pauseOnHover:true,
                        responsive:[{
                            breakpoint:768,
                            pauseOnHover:true,
                            settings:{
                                slidesToShow:2,
                            }
                        }]
                    });
                })
            </script>
        @endif
        @livewireScripts
        @stack("scripts")
    </body>
</html>
