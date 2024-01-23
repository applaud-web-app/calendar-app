@extends('layout.master')
@section('section')

<section class="content-body flex items-center ">
    
    <div class="w-full  m-auto bg-white dark:bg-slate-800/60 rounded shadow-lg ring-2 ring-slate-300/50 dark:ring-slate-700/50 md:max-w-md">
        <div class="text-center p-6 bg-[#091734] rounded-t">
            <h3 class="font-semibold text-white text-xl mb-1">Let's Get Started</h3>
            <p class="text-xs text-slate-400">Register to continue </p>
        </div>

        <div>
            @include('messages')
        </div>

        <form class="p-5" name="register_frm" id="register_frm" action="{{url('/register')}}" method="post">
            @csrf
            <div class="form-group mb-3">
                <label for="full_name" class="label">Name</label>
                <input type="text" id="full_name" name="full_name" maxlength="80" class="form-control" placeholder="Your Name" required>
            </div>
            <div class="form-group mb-3">
                <label for="email" class="label">Email</label>
                <input type="email" id="email" name="email" class="form-control" maxlength="80" placeholder="Your Email" required>
            </div>
            <div class="form-group mb-3">
                <label for="password" class="label">Your password</label>
                <input type="password" id="password" autocomplete="new-password" maxlength="80" name="password" class="form-control" placeholder="Password"  required>
            </div>

            <div class="mt-3">
                <button type="submit" id="submit_btn"
                    class="w-full px-4 py-2 tracking-wide text-white transition-colors duration-200 transform bg-blue-500 rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
                    Register
                </button>
            </div>
        </form>
        <p class="mb-5 text-sm font-medium text-center text-slate-500"> Already have an account? <a href="{{route('login')}}"
            class="font-medium text-blue-600 hover:underline">Login</a>
        </p>
    </div>
</section>
@endsection

@push('scripts')
    <script>
        document.getElementById('register_frm').addEventListener('submit',function(){
            var elm = document.getElementById('submit_btn');
            elm.innerText = 'Processing...';
            elem.setAttribute('disabled','disabled');
        })
    </script>
@endpush