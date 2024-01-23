@extends('layout.master')
@section('section')

<section class="relative content-body">
    <div class="container mx-auto ">
        <div>
            @include('messages')
        </div>
        <div class="flex items-center justify-between flex-wrap mb-5">
            <div class="items-center ">
                <h1 class="md:text-3xl text-2xl md:mb-0 mb-3 block dark:text-slate-100">Contact Us</h1>

            </div>
          
        </div>

        <div class="card">
          
            <div class="card-body">
                
                <form action="{{url('store-contact')}}" id="myform" method="post" >
                    @csrf
                    <div class="mb-2 input_field">
                        <label for="full_name" class="mb-2 label">Full Name <span class="text-red-500">*</span></label>
                        <input class="form-control" type="text" name="full_name" id="full_name" placeholder="Enter your full name" required>
                    </div>
                    <div class="mb-2 input_field">
                        <label for="subject" class="mb-2 label">Subject <span class="text-red-500">*</span></label>
                        <input class="form-control" type="text" id="subject" name="subject" placeholder="Enter subject here" maxlength="250" required>
                    </div>
                    <div class="mb-2 input_field">
                        <label for="phone_no" class="mb-2 label">Phone No <span class="text-red-500">*</span></label>
                        <input class="form-control" type="text" name="phone_no" id="phone_no" placeholder="Enter  phone no" required>
                    </div>
                    <div class="mb-2 input_field">
                        <label for="email" class="mb-2 label">Email <span class="text-red-500">*</span></label>
                        <input class="form-control" type="email" id="email" name="email" placeholder="Enter your email address" required>
                    </div>
                  <div class="input_field mb-3">
                    <label for="massage" class="mb-2 label">Message <span class="text-red-500">*</span></label>
                    <textarea id="message" name="massage" rows="4" class="block p-2 w-full text-sm text-gray-900 bg-gray-50 rounded border border-gray-200 focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:border-slate-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Leave a comment..." required maxlength="500"></textarea>
                  </div>
                  <button type="submit" id="submit_btn" class="mt-3 px-3 py-2 w-full lg:px-4 bg-blue-500 text-white rounded hover:bg-blue-600">Send Message</button>
                </form>
            </div><!--end card-body-->
        </div> <!--end card-->

    </div>
</section>


@endsection


@push('scripts')
    <script>
        document.getElementById('myform').addEventListener('submit',function(){
            var elm = document.getElementById('submit_btn');
            elm.setAttribute('disabled','disabled');
            elm.innerHTML = 'Processing...';
        });
    </script>
@endpush

