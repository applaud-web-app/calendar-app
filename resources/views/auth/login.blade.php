@extends('layout.master')
@section('section')

<section class="content-body flex items-center ">
    
    <div class="w-full  m-auto bg-white dark:bg-slate-800/60 rounded shadow-lg ring-2 ring-slate-300/50 dark:ring-slate-700/50 lg:max-w-md">
        <div class="text-center p-6 bg-[#091734] rounded-t">
            <h3 class="font-semibold text-white text-xl mb-1">Let's Get Started</h3>
            <p class="text-xs text-slate-400">Sign in to continue </p>
        </div>

        <div>
            @include('messages')
        </div>

        <form class="p-5" name="login_frm" id="login_frm" action="{{url('/check-login')}}" method="post">
            @csrf
            <div class="form-group mb-3">
                <label for="email" class="label">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Your Email" required>
            </div>
            <div class="form-group mb-3">
                <label for="password" class="label">Your password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password"  required>
            </div>
            <div class="flex items-start form-group mb-3">
                <div class="flex items-start">
                    <label class="custom-label">
                        <div class="bg-white dark:bg-slate-700 dark:border-slate-600 border border-slate-200 rounded w-4 h-4  inline-block leading-4 text-center -mb-[3px]">
                          <input type="checkbox" class="hidden" value="1" name="remember_me">
                          <i class="fas fa-check hidden text-xs text-slate-700 dark:text-slate-300"></i>
                        </div>
                        <span class="text-sm text-slate-500 font-medium">Remember me</span>                             
                    </label>
                </div>
                <a href="{{url('forget-password')}}" class="ms-auto text-sm text-blue-700 hover:underline dark:text-blue-500">Forget Password?</a>
            </div>

                            
            <div class="mt-3">
                <button type="submit"
                    class="w-full px-4 py-2 tracking-wide text-white transition-colors duration-200 transform bg-blue-500 rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
                    Login
                </button>
            </div>
        </form>
        <p class="mb-5 text-sm font-medium text-center text-slate-500"> Don't have an account? <a href="{{route('register')}}"
            class="font-medium text-blue-600 hover:underline">Register</a>
        </p>
    </div>
</section>


@endsection