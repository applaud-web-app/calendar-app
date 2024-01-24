@extends('layout.master')
@section('section')

<section class="content-body flex items-center ">
    
    <div class="w-full  m-auto bg-white dark:bg-slate-800/60 rounded shadow-lg ring-2 ring-slate-300/50 dark:ring-slate-700/50 lg:max-w-md">
        <div class="text-center p-6 bg-[#091734] rounded-t">
            <h3 class="font-semibold text-white text-xl mb-1">Reset Password</h3>
        </div>

        <div>
            @include('messages')
        </div>

        <form class="p-5" name="pwd_frm" id="pwd_frm" action="{{url('/store-reset-password?token='.$_GET['token'].'&email='.$_GET['email'])}}" method="post">
            @csrf
            <div class="form-group mb-3">
                <label for="email" class="label">New Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="New Password" required>
            </div>      
            <div class="mt-3">
                <button type="submit" id="submit_btn"
                    class="w-full px-4 py-2 tracking-wide text-white transition-colors duration-200 transform bg-blue-500 rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
                    Update Password
                </button>
            </div>
        </form>
        
    </div>
</section>
@endsection

@push('scripts')
    <script>
        document.getElementById('pwd_frm').addEventListener('submit',function(){
            var elm = document.getElementById('submit_btn');
            elm.setAttribute('disabled','disabled');
            elm.innerHTML = 'Processing...';
        });
    </script>
    
@endpush


