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
            <div class="flex items-center space-x-3">
                <a href="{{url('admin/add-calendar')}}"
                    class="px-2 py-2 lg:px-4 md:text-base text-sm border border-blue-500 bg-blue-500 text-white rounded hover:bg-blue-600"><i class="fa-solid fa-plus"></i> Add New Calendar</a>
            </div>
        </div>
       

       
        <div class="w-full mb-5">
            @include('admin.dashboard.top_menu')
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
                              
                                <th scope="col" class="px-3 py-4 whitespace-nowrap">
                                    <span >Action</span>
                                  
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

                                            {{-- "{{url('admin/edit-calendar-event')}}?id="+id --}}

                                            @php
                                                $inputObjE = new stdClass();
                                                $inputObjE->url = url('admin/edit-calendar-event');
                                                $inputObjE->params = 'id='.$val->id;
                                                $encLinkE = Common::encryptLink($inputObjE);
                                            @endphp
                                        
                                            <td class="px-3 py-4 whitespace-nowrap ">
                                                <a  href="javascript:void(0)" onclick="editModal('{{$encLinkE}}')" class="text-blue-500 font-medium rounded text-lg p-1 "><i class="fa-regular fa-pen-to-square"></i></a>
                                                <a  href="javascript:void(0)" onclick="showModal('{{$item->date}}')" class="opn_mdl text-blue-500 font-medium rounded text-lg p-1 "><i class="fa-solid fa-plus"></i></a>
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
                                        <td class="px-3 py-4">
                                            <a  href="javascript:void(0)" onclick="showModal('{{$item->date}}')" class="opn_mdl text-blue-500 font-medium rounded text-lg p-1"><i class="fa-solid fa-plus"></i></a>
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
    $inputObj->url = url('admin/store-calendar-event');
    $inputObj->params = 'id='.$calendarId;
    $encLink = Common::encryptLink($inputObj);
   
    $inputObjPP = new stdClass();
    $inputObjPP->url = url('admin/get-calendar-month-data');
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
        function showModal(date){
            var str = `<div class="form-group mb-3">
                    <label for="event_title" class="label">Title<span class="text-red-500">*</span></label>
                    <input type="text" class="form-control" id="event_title" name="event_title" placeholder="Enter Event" required>
                </div>
                <div class="form-group mb-3">
                    <label for="event_time" class="label">Time</label>
                    <input type="time" class="form-control" id="event_time" name="event_time" placeholder="Enter Time">
                </div>

                <div class="form-group mb-3">
                    <label for="event_date" class="label">Date <span class="text-red-500">*</span></label>
                    <input type="date" class="form-control" id="event_date" name="event_date" value="${date}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="calendarName" class="label">Choose Color <span class="text-red-500">*</span></label>
                    <div class="flex flex-wrap items-center gap-2">
                        <div>
                            <input id="selectColor1" class="inline-block w-5 h-5  border rounded-sm appearance-none cursor-pointer bg-[#a1eebd] border-sky-500 checked:bg-[#a1eebd] checked:border-sky-500 disabled:opacity-75 disabled:cursor-default" type="radio" value="#a1eebd" name="color_code">
                        </div>
                        <div>
                            <input id="selectColor2" class="inline-block w-5 h-5  bg-[#f6f7c4] border border-orange-500 rounded-sm appearance-none cursor-pointer checked:bg-[#f6f7c4] checked:border-orange-500 disabled:opacity-75 disabled:cursor-default" type="radio" value="#f6f7c4" name="color_code" checked="">
                        </div>
                        <div>
                            <input id="selectColor3" class="inline-block w-5 h-5  bg-[#e5d4ff] border border-green-500 rounded-sm appearance-none cursor-pointer checked:bg-[#e5d4ff] checked:border-green-500 disabled:opacity-75 disabled:cursor-default" type="radio" value="#e5d4ff" name="color_code">
                        </div>
                        <div>
                            <input id="selectColor4" class="inline-block w-5 h-5  bg-[#aee2ff] border border-purple-500 rounded-sm appearance-none cursor-pointer checked:bg-[#aee2ff] checked:border-purple-500 disabled:opacity-75 disabled:cursor-default" type="radio" value="#aee2ff" name="color_code">
                        </div>
                        <div>
                            <input id="selectColor5" class="inline-block w-5 h-5  bg-[#eab308] border border-yellow-500 rounded-sm appearance-none cursor-pointer checked:bg-[#eab308] checked:border-yellow-500 disabled:opacity-75 disabled:cursor-default" type="radio" value="#eab308" name="color_code">
                        </div>
                        <div>
                            <input id="selectColor6" class="inline-block w-5 h-5  bg-[#ff8c37] border border-red-500 rounded-sm appearance-none cursor-pointer checked:bg-[#ff8c37] checked:border-red-500 disabled:opacity-75 disabled:cursor-default" type="radio" value="#ff8c37" name="color_code">
                        </div>
                        <div>
                            <input id="selectColor7" class="inline-block w-5 h-5  border rounded-sm appearance-none cursor-pointer bg-[#b1bce6] border-slate-500 checked:bg-[#b1bce6] checked:border-slate-500 disabled:opacity-75 disabled:cursor-default" type="radio" value="#b1bce6" name="color_code">
                        </div>
                        <div>
                            <input id="selectColor8" class="inline-block w-5 h-5  border rounded-sm appearance-none cursor-pointer bg-[#f8f0df] border-slate-900 checked:bg-[#f8f0df] checked:border-slate-900 disabled:opacity-75 disabled:cursor-default" type="radio" value="#f8f0df" name="color_code">
                        </div>
                        
                    </div>
                  
                </div>`;
            document.getElementById('modalBody').innerHTML = str;
            document.getElementsByTagName('body')[0].classList.add('modal-enabled');
            document.getElementById('addEventModal').classList.add('block');
        }
    </script>

    <script>
        async function postFormData(){
            var dateA = document.getElementById('event_date').value;
            const response = await fetch('{{$encLink}}',{
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN':'{{csrf_token()}}'
                },
                body: JSON.stringify({
                    'event_title':document.getElementById('event_title').value,
                    'event_time':document.getElementById('event_time').value,
                    'event_date':dateA,
                    'color_code':document.querySelector("input[type='radio'][name=color_code]:checked").value
                })
            });
            const data = await response.json();
            if(data.s==1){
                getMonthData(dateA);
                iziToast.success({
                    title: 'Success',
                    message: 'Event added successfully...',
                    position:'topRight'
                });
                document.getElementsByTagName('body')[0].classList.remove('modal-enabled');
                document.getElementById('addEventModal').classList.remove('block');
            }else{
                
            }
        }
        document.getElementById('addEventModal').addEventListener('submit',function(e){
            e.preventDefault();
            var elm = document.getElementById('submit_btn');
            elm.innerText = 'Processing...';
            elm.setAttribute('disabled','disabled');
            
            postFormData();

        });
    </script>

    <script>
         document.querySelector('.btn-close').addEventListener('click',function(){
            document.getElementsByTagName('body')[0].classList.remove('modal-enabled');
            document.getElementById('addEventModal').classList.remove('block');
        });
              
    </script>

    <script>
        async function postFormDataUpdate(link){
            var dateA = document.getElementById('event_date_up').value;
            const response = await fetch(link,{
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN':'{{csrf_token()}}'
                },
                body: JSON.stringify({
                    'event_title':document.getElementById('event_title_up').value,
                    'event_time':document.getElementById('event_time_up').value,
                    'event_date':dateA,
                    'color_code':document.querySelector("input[type='radio'][name=color_code_up]:checked").value
                })
            });
            const data = await response.json();
            if(data.s==1){
                getMonthData(dateA);
                iziToast.success({
                    title: 'Success',
                    message: 'Event updated successfully...',
                    position:'topRight'
                });
                document.getElementsByTagName('body')[0].classList.remove('modal-enabled');
                document.getElementById('editEventModal').classList.remove('block');
            }else{
                
            }
        }
    </script>

    <script>
        async function editModal(link){
            document.getElementsByTagName('body')[0].classList.add('modal-enabled');
            document.getElementById('editEventModal').classList.add('block');
            var elem = document.getElementById('editEventModal');
            elem.innerHTML = `
                    <div class="modal-dialog modal-dialog-center">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title mt-0" id="staticBackdropLabel1">Edit Event</h6>
                                <button type="button" class="btn-close1" aria-label="Close"><i class="fa-regular fa-circle-xmark"></i></button>
                            </div>
                            <div class="modal-body" id="modalBody">
                                <h3 class="text-center">Loading Data...</h3>
                            </div>
                        </div>
                    </div>`;
                
            const response = await fetch(link);
            const data = await response.json();
            elem.innerHTML = `
            <form action="${data.link}" method="post" id="updateModal">
                @csrf
                <div class="modal-dialog modal-dialog-center">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title mt-0" id="staticBackdropLabel1">Edit Event</h6>
                            <button type="button" class="btn-close1" aria-label="Close"><i class="fa-regular fa-circle-xmark"></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="event_title_up" class="label">Title<span class="text-red-500">*</span></label>
                                <input type="text" class="form-control" id="event_title_up" name="event_title" placeholder="Enter Event" required value="${data.event_title}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="event_time_up" class="label">Time</label>
                                <input type="time" class="form-control" id="event_time_up" name="event_time" placeholder="Enter Time" value="${data.event_time}">
                            </div>

                            <div class="form-group mb-3">
                                <label for="event_date_up" class="label">Date <span class="text-red-500">*</span></label>
                                <input type="date" class="form-control" value="${data.event_date}" id="event_date_up" name="event_date" value="" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="calendarName" class="label">Choose Color <span class="text-red-500">*</span></label>
                                <div class="flex flex-wrap items-center gap-2">
                                    <div>
                                        <input id="selectColor1" class="inline-block w-5 h-5  border rounded-sm appearance-none cursor-pointer bg-[#a1eebd] border-sky-500 checked:bg-[#a1eebd] checked:border-sky-500 disabled:opacity-75 disabled:cursor-default" type="radio" value="#a1eebd" name="color_code_up" ${data.color_code=='#a1eebd' ? 'checked':''}>
                                    </div>
                                    <div>
                                        <input id="selectColor2" class="inline-block w-5 h-5  bg-[#f6f7c4] border border-orange-500 rounded-sm appearance-none cursor-pointer checked:bg-[#f6f7c4] checked:border-orange-500 disabled:opacity-75 disabled:cursor-default" type="radio" value="#f6f7c4" name="color_code_up" ${data.color_code=='#f6f7c4' ? 'checked':''}>
                                    </div>
                                    <div>
                                        <input id="selectColor3" class="inline-block w-5 h-5  bg-[#e5d4ff] border border-green-500 rounded-sm appearance-none cursor-pointer checked:bg-[#e5d4ff] checked:border-green-500 disabled:opacity-75 disabled:cursor-default" type="radio" value="#e5d4ff" name="color_code_up" ${data.color_code=='#e5d4ff' ? 'checked':''}>
                                    </div>
                                    <div>
                                        <input id="selectColor4" class="inline-block w-5 h-5  bg-[#aee2ff] border border-purple-500 rounded-sm appearance-none cursor-pointer checked:bg-[#aee2ff] checked:border-purple-500 disabled:opacity-75 disabled:cursor-default" type="radio" value="#aee2ff" name="color_code_up" ${data.color_code=='#aee2ff' ? 'checked':''}>
                                    </div>
                                    <div>
                                        <input id="selectColor5" class="inline-block w-5 h-5  bg-[#eab308] border border-yellow-500 rounded-sm appearance-none cursor-pointer checked:bg-[#eab308] checked:border-yellow-500 disabled:opacity-75 disabled:cursor-default" type="radio" value="#eab308" name="color_code_up" ${data.color_code=='#eab308' ? 'checked':''}>
                                    </div>
                                    <div>
                                        <input id="selectColor6" class="inline-block w-5 h-5  bg-[#ff8c37] border border-red-500 rounded-sm appearance-none cursor-pointer checked:bg-[#ff8c37] checked:border-red-500 disabled:opacity-75 disabled:cursor-default" type="radio" value="#ff8c37" name="color_code_up" ${data.color_code=='#ff8c37' ? 'checked':''}>
                                    </div>
                                    <div>
                                        <input id="selectColor7" class="inline-block w-5 h-5  border rounded-sm appearance-none cursor-pointer bg-[#b1bce6] border-slate-500 checked:bg-[#b1bce6] checked:border-slate-500 disabled:opacity-75 disabled:cursor-default" type="radio" value="#b1bce6" name="color_code_up" ${data.color_code=='#b1bce6' ? 'checked':''}>
                                    </div>
                                    <div>
                                        <input id="selectColor8" class="inline-block w-5 h-5  border rounded-sm appearance-none cursor-pointer bg-[#f8f0df] border-slate-900 checked:bg-[#f8f0df]  checked:border-slate-900 disabled:opacity-75 disabled:cursor-default" type="radio" value="#f8f0df" name="color_code_up" ${data.color_code=='#f8f0df' ? 'checked':''}>
                                    </div>
                                    
                                </div>
                            
                            </div>
                        </div>
                        <div class="modal-footer">
                        
                            <button type="submit" id="submit_btn_1" class="text-white bg-blue-500 hover:bg-blue-600  font-medium rounded block w-full px-3 py-2 dark:bg-blue-500 dark:hover:bg-blue-600 focus:outline-none  my-auto">Update Changes</button>
                        </div>
                    </div>
                </div>
            </form>
            `;       
             
            document.querySelector('.btn-close1').addEventListener('click',function(){
                document.getElementsByTagName('body')[0].classList.remove('modal-enabled');
                document.getElementById('editEventModal').classList.remove('block');
            });    



            document.getElementById('updateModal').addEventListener('submit',function(e){
                e.preventDefault();
                var elm = document.getElementById('submit_btn_1');
                elm.innerText = 'Processing...';
                elm.setAttribute('disabled','disabled');
                postFormDataUpdate(data.link);
            });



            
        }
    </script>

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



