<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Calendar App</title>
  <meta content="Tailwind Multipurpose Admin & Dashboard Template" name="description" />
  <meta content="" name="author" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <!-- App favicon -->
  <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico') }}" />

  @vite(['resources/css/app.css','resources/js/app.js'])

  <link rel="stylesheet" href="{{asset('assets/css/icons.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

  @stack('styles')
</head>

<body data-layout-mode="light" class="bg-gray-50 dark:bg-gray-900 ">

  {{-- start header --}}
  <header class="sticky top-0 z-40 header_area">

    <nav class="border-gray-200 bg-[#091734] px-2.5 py-2.5 shadow-sm dark:bg-slate-800 sm:px-4 block print:hidden">
      <div class="container mx-0 flex flex-wrap items-center lg:mx-auto">
        <div class="flex items-center">
          <a href="{{url('/')}}" class="flex items-center outline-none">

            <img src="{{asset('assets/images/logo.png')}}" alt="" class="ml-2 block h-12 md:h-20  w-auto" />
          </a>
        </div>

        @if(Auth::check()==true && Auth::user()->u_type==1)
        <div class="order-2 hidden w-full items-center justify-between md:order-1 md:ml-5 md:flex md:w-auto"
          id="mobile-menu-2">
          <ul
            class="font-body mt-4 flex flex-col font-medium md:mt-0 md:flex-row md:text-sm md:font-medium space-x-0 md:space-x-4 lg:space-x-6 navbar">
           
            <li>
              <a href="{{url('admin/all-categories')}}"
                class="text-slate-300 flex w-full items-center border-b border-gray-800 py-2 px-3 font-medium md:border-0 md:p-0">
                <i class="ti ti-smart-home mr-1 pb-1 text-lg"></i> Category

              </a>
            </li>
            <li>
              <a href="{{url('admin/all-users')}}"
                class="text-slate-300 flex w-full items-center border-b border-gray-800 py-2 px-3 font-medium md:border-0 md:p-0">
                <i class="ti ti-users mr-1 pb-1 text-lg"></i> Users
              </a>
            </li>
           

          </ul>
        </div>
        @endif

        <div class="order-1 ml-auto flex items-center md:order-2">

          @if(!Auth::check())
          <div class="relative mr-2 hidden lg:mr-4 lg:block">
            <a href="{{url('/')}}"
              class="px-3 py-2  text-sm font-medium text-gray-900 focus:outline-none bg-white rounded border border-gray-200 hover:bg-gray-100 hover:text-blue-500 focus:z-10 focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"><i
                class="fa-solid fa-right-to-bracket pr-1"></i>Login</a>
          </div>
          @endif
          <div class="mr-2 lg:mr-0 dropdown relative">
            @if(Auth::check())
            <button type="button"
              class="dropdown-toggle flex items-center rounded-full text-sm focus:bg-none focus:ring-0 dark:focus:ring-0 md:mr-0"
              id="user-profile" aria-expanded="false" data-dropdown-toggle="navUserdata">
              <img class="h-8 w-8 rounded-full" src="{{asset('assets/images/users/avatar-1.jpg')}}" alt="user photo" />
              <span class="ml-2 hidden text-left xl:block">
                <span class="block font-medium text-gray-50">{{Auth::user()->name}} <i
                    class="fas fa-chevron-down text-xs"></i> </span>
                <span class=" block text-sm font-medium text-gray-200">{{Auth::user()->email}}</span>
                {{-- <a href="{{route('logout')}}" class="block font-medium text-gray-50">Logout</a> --}}
              </span>
            </button>


            <div
              class="dropdown-menu  z-50 my-1 hidden list-none divide-y divide-gray-100 rounded border-slate-700 md:border-white text-base shadow dark:divide-gray-600 bg-white dark:bg-slate-800"
              id="navUserdata">
              <div class="py-3 px-4">
                <span class="block text-sm font-medium text-gray-900 dark:text-white">{{Auth::user()->name}}</span>
                <span
                  class="block truncate text-sm font-normal text-gray-500 dark:text-gray-400">{{Auth::user()->email}}</span>
              </div>
              <ul class="py-1" aria-labelledby="navUserdata">
                <li>
                  <a href="{{url('my-profile')}}"
                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-900/20 dark:hover:text-white">Profile</a>
                </li>
                @if(Auth::user()->u_type==1)
                <li>
                  <a href="{{url('admin/enquiries')}}"
                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-900/20 dark:hover:text-white">Enquiries</a>
                </li>
                @endif
                <li>
                  <a href="{{route('logout')}}"
                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-900/20 dark:hover:text-white">Sign
                    out</a>
                </li>
              </ul>
            </div>
            @endif
          </div>
          <button data-collapse-toggle="mobile-menu-2" type="button" id="toggle-menu" class="ml-1 inline-flex items-center rounded-lg text-sm text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-0 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600 md:hidden" aria-controls="mobile-menu-2" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <i class="ti ti-menu-2 h-6 w-6 text-lg leading-6"></i>
            <i class="ti ti-X hidden h-6 w-6 text-lg leading-6"></i>
          </button>

        </div>
      </div>
    </nav>

  </header>

  {{-- end header --}}

  @yield('section')

  {{-- <div class=" block print:hidden bg-[#1282bf] shadow dark:bg-slate-800  z-50 w-full footer_area">
    <div class="container mx-auto">

      <footer
        class="footer  rounded-tr-md rounded-tl-md  p-3 text-center font-medium text-white dark:text-lwhite  md:text-left">
        &copy;
        <script>
          document.write(new Date().getFullYear());
        </script>
        Doctor App
        <span class="float-right hidden text-white dark:text-gray-100 md:inline-block">Designed By <i
            class="ti ti-heart text-yellow-300"></i> by
          Applaud Web Media</span>
      </footer>

    </div>
  </div> --}}


  <footer class="bg-[#1282bf] w-full footer_area">
    <div class="container mx-auto p-3">
      <div class="sm:flex sm:items-center sm:justify-between ">
        <div class="flex my-1 justify-center sm:mt-0 space-x-3">
          <a href="https://www.facebook.com/schoolofdentalnursing"
            class="h-8 w-8 text-center leading-8 bg-white text-blue-500 hover:text-blue-600 border rounded-full border-gray-100 dark:hover:text-white ">
            <i class="fa-brands fa-facebook-f"></i>

          </a>
          <a href="https://www.instagram.com/school.of.dental.nursing/"
            class="h-8 w-8 text-center leading-8 bg-white text-blue-500 hover:text-blue-600 border rounded-full border-gray-100 dark:hover:text-white ">
            <i class="fa-brands fa-instagram"></i>

          </a>
          <a href="https://twitter.com/i/flow/login?redirect_after_login=%2FDentalNursing_"
            class="h-8 w-8 text-center leading-8 bg-white text-blue-500 hover:text-blue-600 border rounded-full border-gray-100 dark:hover:text-white ">
            <i class="fa-brands fa-twitter"></i>

          </a>
          <a href="https://www.linkedin.com/company/the-school-of-dental-nursing/"
            class="h-8 w-8 text-center leading-8 bg-white text-blue-500 hover:text-blue-600 border rounded-full border-gray-100 dark:hover:text-white ">
            <i class="fa-brands fa-linkedin-in "></i>

          </a>

        </div>
        <ul class="flex flex-wrap items-center justify-center  text-sm font-medium text-gray-100 sm:mb-0 my-1 ">
          <li>
            <a href="{{url('terms-and-condition')}}" class="hover:underline me-3 md:me-6">Terms Of Use</a>
          </li>
          <li>
            <a href="{{url('privacy-policy')}}" class="hover:underline me-3 md:me-6">Privacy Notice</a>
          </li>
          <li>
            <a href="{{url('contact-us')}}" class="hover:underline me-3 md:me-6">Contact Us</a>
          </li>

        </ul>
      </div>
      <hr class="my-2 border-gray-200 sm:mx-auto  lg:my-5" />
      <span class="block text-sm text-white text-center ">©
        <script>
          document.write(new Date().getFullYear());
        </script>
        The School Of Dental Nursing &nbsp;|&nbsp;  Developed By
        <a href="https://applaudwebmedia.com/" class="hover:underline">Applaud Web Media Pvt. Ltd.</a>
      </span>
    </div>

  </footer>




  <script src="{{asset('assets/js/jquery.min.js')}}"></script>
  <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
  <script src="{{asset('assets/js/pages/components.js')}}"></script>
  <script src="{{asset('assets/js/main.js')}}"></script>


  @stack('scripts')

  <script>


    var h_height = document.querySelector('.header_area').offsetHeight;
    var f_height = document.querySelector('.footer_area').offsetHeight;
    document.querySelector('.content-body').style.minHeight = window.innerHeight - (h_height + f_height) + 'px';


  </script>

</body>

</html>