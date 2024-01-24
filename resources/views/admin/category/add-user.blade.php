@extends('layout.master')
@section('section')
<section class="content-body flex items-center ">

        <div class="container mx-auto ">

            <div>
                @include('messages')
            </div>
            <div class="flex justify-center mb-3 ">
                <div class="w-full md:w-1/2">
                    <div class="card h-full">
                        <div class="card-header">
                            <h5>Add User</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{url('/register')}}" id="calendar_frm" method="post">
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
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.getElementById('calendar_frm').addEventListener('submit',function(){
            var elm = document.getElementById('submit_btn');
            elm.innerText = 'Processing...';
            elem.setAttribute('disabled','disabled');
        })
    </script>
@endpush
