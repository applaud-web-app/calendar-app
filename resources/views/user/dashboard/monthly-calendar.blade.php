@extends('layout.master')
@section('section')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/iziToast.min.css')}}">
@endpush
<section class="relative content-body">
    <div class="container mx-auto ">
        <div>
            @include('messages')
        </div>
        <div class="flex items-center justify-between flex-wrap mb-5">
            <div class="items-center ">
                <h1 class="md:text-3xl text-2xl md:mb-0 mb-3 block dark:text-slate-100">{{$calendarD->calendar_name}}</h1>

            </div>
           
        </div>
       

        <div class="w-full mb-5">
            @include('user.dashboard.top_menu')
        </div>

        <div class="card h-full" id="calendar_pst">
            <div class="card-header flex justify-between space-x-1">
                <h4 class="card-title">{{$monthName}}</h4>
                <div class="space-x-1 whitespace-nowrap">
                    <button type="button" onclick="getMonthData('{{$prevDate}}')" class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-3 py-2 text-center inline-flex items-center  dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <i class="fas fa-arrow-left "></i>  
                    </button>
                    <button type="button" onclick="getMonthData('{{$nextDate}}')" class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-3 py-2 text-center inline-flex items-center  dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <i class="fas fa-arrow-right "></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="relative overflow-x-auto  sm:rounded">
                        
                    <table class="w-full text-sm text-left text-gray-900 dark:text-gray-400 border border-gray-400">
                        <thead class="text-xs text-gray-100 uppercase bg-gray-800 dark:bg-slate-700 ">
                            <tr class="align-top">
                                <th scope="col" class="px-3 py-4">
                                    Date
                                </th>
                                <th scope="col" class="px-3 py-4">
                                    Event
                                </th>
                                <th scope="col" class="px-3 py-4">
                                    Time
                                </th>
                              
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($monthDates as $item)
                                @if(isset($dateEvents[$item->date]))
                                    @foreach ($dateEvents[$item->date] as $val)
                                        <tr class="dark:bg-slate-800 border-b  dark:border-slate-700  border-gray-400 dark:hover:bg-slate-900/20 align-top" style="background: {!!$val->color_code!!};">
                                            <td class="px-3 py-4">
                                                {{$item->format_date}}
                                            </td>
                                            <td scope="row" class="px-3 py-4 font-medium text-gray-900 dark:text-white ">
                                            
                                                <p class=" font-medium text-black truncate dark:text-white">
                                                    {{$val->event_title}}
                                                </p>
                                            
                                            </td>
                                            <td class="px-3 py-4">
                                                <p class="text-sm text-gray-600 truncate dark:text-gray-400">
                                                    <i class="fa-solid fa-clock"></i> {{Common::timeFormatGl($val->event_time)}}
                                                </p>
                                            
                                            </td>

                                        </tr>            
                                    @endforeach
                                @else
                                    <tr class="bg-white-500 border-b dark:bg-gray-800 dark:border-slate-700  border-gray-400 dark:hover:bg-slate-900/20 align-top">
                                        <td class="p-4">
                                        {{$item->format_date}}
                                        </td>
                                        <td scope="row" class="px-3 py-4 font-medium text-gray-900 dark:text-white ">
                                            <p class=" font-medium text-black truncate dark:text-white"></p>
                                        </td>
                                        <td class="px-3 py-4">
                                            <p class="text-sm text-gray-600 truncate dark:text-gray-400"></p>
                                        </td>
                                        
                                    </tr>
                                @endif
                            @endforeach

                          

                                         
                        </tbody>
                    </table>
                </div>                            
            </div><!--end card-body-->
        </div>

    </div>
</section>

{{-- edit event Modal --}}
    
@php
    $inputObj = new stdClass();
    $inputObj->url = url('user/store-calendar-event');
    $inputObj->params = 'id='.$calendarId;
    $encLink = Common::encryptLink($inputObj);
   
    $inputObjPP = new stdClass();
    $inputObjPP->url = url('user/get-calendar-month-data');
    $inputObjPP->params = 'id='.$calendarId;
    $postLink = Common::encryptLink($inputObjPP);
@endphp
<form action="{{$encLink}}" class="modal fade" id="addEventModal" method="post">
    @csrf
    <div class="modal-dialog modal-dialog-center">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title mt-0" id="staticBackdropLabel1">Add Event</h6>
                <button type="button" class="btn-close" aria-label="Close"><i class="fa-regular fa-circle-xmark"></i></button>
            </div>
            <div class="modal-body" id="modalBody">
            
            </div>
            <div class="modal-footer">
              
                <button type="submit" id="submit_btn" class="text-white bg-blue-500 hover:bg-blue-600  font-medium rounded block w-full px-3 py-2 dark:bg-blue-500 dark:hover:bg-blue-600 focus:outline-none  my-auto">Save Changes</button>
            </div>
        </div>
    </div>
</form>

<div id="editEventModal" class="modal fade">

</div>

<div class="modal-overlay"></div>

@endsection

@push('scripts')
<script src="{{asset('assets/js/iziToast.min.js')}}"></script>
   

    <script>
        async function getMonthData(date){
            const response = await fetch('{{$postLink}}',{
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN':'{{csrf_token()}}'
                },
                body: JSON.stringify({'date':date})
            });
            const data = await response.text();
            document.getElementById('calendar_pst').innerHTML = data;
        }
    </script>

@endpush



