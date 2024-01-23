@extends('layout.master')
@section('section')

<section class="relative flex flex-col justify-center py-16 overflow-hidden sm:py-24 lg:py-32">
    
    <div class="w-full  m-auto bg-white dark:bg-slate-800/60 rounded shadow-lg ring-2 ring-slate-300/50 dark:ring-slate-700/50 lg:max-w-md">
        <div class="text-center p-6 bg-[#091734] rounded-t">
            <h3 class="font-semibold text-white text-xl mb-1">Let's Get Started</h3>
            <p class="text-xs text-slate-400">Sign in to continue </p>
        </div>

        <div>
            @include('messages')
        </div>

        <form class="p-6" name="login_frm" id="login_frm" action="{{url('/check-login')}}" method="post">
            @csrf
            <div>
                <label for="email" class="label">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Your Email" required>
            </div>
            <div class="mt-4">
                <label for="password" class="label">Your password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password"  required>
            </div>
            <a href="#" class="text-xs text-gray-600 hover:underline">Forget Password?</a>
            <div class="block mt-3">
                <label class="custom-label">
                    <div class="bg-white dark:bg-slate-700 dark:border-slate-600 border border-slate-200 rounded w-4 h-4  inline-block leading-4 text-center -mb-[3px]">
                      <input type="checkbox" class="hidden" value="1" name="remember_me">
                      <i class="fas fa-check hidden text-xs text-slate-700 dark:text-slate-300"></i>
                    </div>
                    <span class="text-sm text-slate-500 font-medium">Remember me</span>                             
                </label>
            </div>                    
            <div class="mt-6">
                <button type="submit"
                    class="w-full px-4 py-2 tracking-wide text-white transition-colors duration-200 transform bg-blue-500 rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
                    Login
                </button>
            </div>
        </form>
        <p class="mb-5 text-sm font-medium text-center text-slate-500"> Don't have an account? <a href="{{route('register')}}"
            class="font-medium text-blue-600 hover:underline">Sign up</a>
        </p>
    </div>
</section>


@endsection