@extends('layout.master')
@section('section')
    @push('style')
        <style>

        </style>
    @endpush
    <section class="relative content-body">
        <div class="container mx-auto ">
            <div class="flex items-center justify-between flex-wrap mb-5">
                <div class="items-center ">
                    <h1 class="md:text-3xl text-2xl md:mb-0 mb-3 block dark:text-slate-100">{{$calendarD->calendar_name}}</h1>

                </div>
                <div class="flex items-center space-x-3">

                
                    <a href="{{ url('admin/add-calendar') }}"
                        class="px-2 py-2 lg:px-4 md:text-base text-sm border border-blue-500 bg-blue-500 text-white rounded hover:bg-blue-600"><i
                            class="fa-solid fa-plus"></i> Add New Calendar</a>
                </div>
            </div>

            <div class="w-full mb-5">
                @include('admin.dashboard.top_menu')
            </div>

            <div class="w-full bg-white p-5 shadow-sm rounded-sm">
                <div id='calendar'></div>
            </div>


        </div>
    </section>

@endsection

@php
    $inputObjPP = new stdClass();
    $inputObjPP->url = url('admin/yearly-calendar');
    $inputObjPP->params = 'id='.$calendarId;
    $postLink = Common::encryptLink($inputObjPP);
@endphp

@push('scripts')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <script>
        $.ajaxSetup({
            headers:
            { 'X-CSRF-TOKEN': "{{csrf_token()}}"}
        });
        document.addEventListener('DOMContentLoaded', function() {
            
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: "multiMonthYear",
                events: function (fetchInfo, successCallback, failureCallback) {
                jQuery.ajax({
                    url: "{{$postLink}}",
                    type: "POST",
                    data:{
                        'start':(new Date(fetchInfo.start)).toISOString().slice(0, 10),
                        'end':(new Date(fetchInfo.end)).toISOString().slice(0, 10)
                    },
                    success: function (res) {
                    var events = [];
                    res.forEach(function (evt) {
                        events.push({
                            title: evt.title,
                            start: evt.start,
                            end: evt.end,
                        });
                    });
                    successCallback(events);
                    },
                });
                },
            });
            calendar.render();
        });
    </script>
@endpush
