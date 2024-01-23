@extends('layout.master')
@section('section')

<section class="relative content-body">
    <div class="container mx-auto ">
        <div class="flex items-center justify-between flex-wrap mb-5">
            <div class="items-center ">
                <h1 class="md:text-3xl text-2xl md:mb-0 mb-3 block dark:text-slate-100">Calendar</h1>

            </div>
            
        </div>

        <div>
            @include('messages')
        </div>


        @forelse ($calendarData as $item)
        @if(count($item->calendars))
            <div class="w-full mb-3 ">
                <h5 class="mb-3 text-lg text-gray-900 md:text-xl dark:text-white">
                {{$item->category_name}}
                </h5>
                <hr>
                    <ul class="my-4 md:gap-3 gap-2 grid  lg:grid-cols-2 grid-cols-1">
                        @foreach ($item->calendars as $item)
                            @php
                                $inputObj = new stdClass();
                                $inputObj->params = 'id='.$item->id;
                                $inputObj->url = url('user/monthly-calendar');
                                $encLink = Common::encryptLink($inputObj);
                            @endphp
                            <li>
                                <a href="{{$encLink}}" class="flex items-center justify-between md:p-3 p-2 shadow-sm md:text-lg text-base  text-gray-900 rounded-sm  bg-white hover:bg-blue-100 group dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                                    <span class="flex-1 whitespace-nowrap">{{$item->calendar_name}}</span>
                                    <button type="button" class="text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full  md:p-2 p-1 text-center inline-flex items-center dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800 dark:hover:bg-blue-500">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                        </svg>
                                    </button>
                                </a>
                            </li>
                        @endforeach
                    </ul>
            </div>
        @endif
        @empty
            <div class="w-full mb-3 ">
                <h2 class="text-center">NO DATA</h2>
            </div>
        @endforelse
       
       

    </div>
</section>



@endsection

