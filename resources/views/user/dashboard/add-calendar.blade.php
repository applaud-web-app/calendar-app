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

                            <h5 class="card-title"><a href="{{url("admin/dashboard")}}" class="text-blue-500 mr-3"><i
                                        class="fa-solid fa-arrow-left-long"></i></a> Add New Calendar</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('admin/store-calendar') }}" id="calendar_frm" method="post">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="calendar_name" class="label">Calendar Name <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" class="form-control" id="calendar_name" name="calendar_name"
                                        placeholder="Enter Calendar Name">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="category" class="label">Category <span
                                            class="text-red-500">*</span></label>
                                    <select id="category" name="category" class="form-select form-control"
                                        aria-label="Default select example">
                                        <option>--Select Category-</option>
                                        @foreach (Common::allCategories() as $item)
                                            <option value="{{$item->id}}">{{$item->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="calendarName" class="label">Access<span
                                            class="text-red-500">*</span></label>
                                    <div class="inline-flex items-center mr-5">
                                        <input id="country-option-1" type="radio" name="access" value="1"
                                            class="w-4 h-4 border-gray-300  dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600"
                                            aria-labelledby="country-option-1" aria-describedby="country-option-1" checked>
                                        <label for="country-option-1"
                                            class="block ml-2  font-medium text-gray-900 dark:text-gray-300">
                                            Public
                                        </label>
                                    </div>

                                    <div class="inline-flex items-center mr-5">
                                        <input id="country-option-2" type="radio" name="access" value="2"
                                            class="w-4 h-4 border-gray-300  dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600"
                                            aria-labelledby="country-option-2" aria-describedby="country-option-2">
                                        <label for="country-option-2"
                                            class="block ml-2  font-medium text-gray-900 dark:text-gray-300">
                                            Private
                                        </label>
                                    </div>

                                </div>
                                <div class="mt-3">
                                    <button type="submit" id="submit_btn"
                                        class="text-white w-full text-center bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded  px-3 py-2  dark:bg-blue-500 dark:hover:bg-blue-600 focus:outline-none dark:focus:ring-blue-700">Create
                                        Now </button>
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
