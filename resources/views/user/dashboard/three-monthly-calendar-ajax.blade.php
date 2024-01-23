<div class="card-header flex justify-between space-x-1">
    <h4 class="card-title"></h4>
    <div class="space-x-1">
        <button type="button" onclick="getNextThreeMonth('{{$prevDate}}')" class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-3 py-2 text-center inline-flex items-center  dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <i class="fas fa-arrow-left "></i>
        </button>
        <button type="button" onclick="getNextThreeMonth('{{$nextDate}}')" class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-3 py-2 text-center inline-flex items-center  dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <i class="fas fa-arrow-right "></i>
        </button>
    </div>
</div>
<div class="card-body" >

    <div class="grid grid-cols-3  gap-2">
        {{-- 1st month --}}
        <div class="relative overflow-x-auto  sm:rounded">

            <table class="w-full text-sm text-left text-gray-900 dark:text-gray-400 border border-gray-400">
                <thead class="text-xs text-gray-100 uppercase bg-gray-800 dark:bg-slate-700 ">
                    <tr>
                        <th colspan="2" class="text-center text-lg">{{$firstMonthName}}<hr></th>
                    </tr>
                    <tr class="align-top">
                        <th scope="col" class="px-3 py-4">
                            Date
                        </th>
                        <th scope="col" class="px-3 py-4">
                            Event
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($firstMonthDates as $item)
                        @if(isset($dateEvents[$item->date]))
                            @foreach ($dateEvents[$item->date] as $val)
                                <tr class="bg-blue-200 border-b dark:bg-gray-800 dark:border-slate-700  border-gray-400 dark:hover:bg-slate-900/20 align-top">
                                    <td class="px-3 py-4">
                                        {{$item->format_date}}
                                    </td>
                                    <td scope="row" class="px-3 py-4 font-medium text-gray-900 dark:text-white ">

                                        <p class=" font-medium text-black truncate dark:text-white">
                                            {{$val->event_title}}
                                        </p>
                                        <p class="text-sm text-gray-600 truncate dark:text-gray-400">
                                            <i class="fa-solid fa-clock"></i> {{Common::timeFormatGl($val->event_time)}}
                                        </p>

                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-slate-700  border-gray-400 dark:hover:bg-slate-900/20 align-top">
                                <td class="px-3 py-4">
                                    {{$item->format_date}}
                                </td>
                                <td scope="row" class="px-3 py-4 font-medium text-gray-900 dark:text-white ">

                                    <p class=" font-medium text-black truncate dark:text-white">
                                        
                                    </p>
                                    <p class="text-sm text-gray-600 truncate dark:text-gray-400">
                                        
                                    </p>

                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- 2nd Month --}}
        <div class="relative overflow-x-auto  sm:rounded">

            <table class="w-full text-sm text-left text-gray-900 dark:text-gray-400 border border-gray-400">
                <thead class="text-xs text-gray-100 uppercase bg-gray-800 dark:bg-slate-700 ">
                    <tr>
                        <th colspan="2" class="text-center text-lg">{{$secondMonthName}}<hr></th>
                    </tr>
                    <tr class="align-top">
                        <th scope="col" class="px-3 py-4">
                            Date
                        </th>
                        <th scope="col" class="px-3 py-4">
                            Event
                        </th>
                    </tr>
                </thead>
                <tbody>
                   

                    @foreach ($secondMonthDates as $item)
                    @if(isset($dateEvents[$item->date]))
                        @foreach ($dateEvents[$item->date] as $val)
                            <tr class="bg-blue-200 border-b dark:bg-gray-800 dark:border-slate-700  border-gray-400 dark:hover:bg-slate-900/20 align-top">
                                <td class="px-3 py-4">
                                    {{$item->format_date}}
                                </td>
                                <td scope="row" class="px-3 py-4 font-medium text-gray-900 dark:text-white ">

                                    <p class=" font-medium text-black truncate dark:text-white">
                                        {{$val->event_title}}
                                    </p>
                                    <p class="text-sm text-gray-600 truncate dark:text-gray-400">
                                        <i class="fa-solid fa-clock"></i> {{Common::timeFormatGl($val->event_time)}}
                                    </p>

                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-slate-700  border-gray-400 dark:hover:bg-slate-900/20 align-top">
                            <td class="px-3 py-4">
                                {{$item->format_date}}
                            </td>
                            <td scope="row" class="px-3 py-4 font-medium text-gray-900 dark:text-white ">

                                <p class=" font-medium text-black truncate dark:text-white">
                                    
                                </p>
                                <p class="text-sm text-gray-600 truncate dark:text-gray-400">
                                    
                                </p>

                            </td>
                        </tr>
                    @endif
                @endforeach

                </tbody>
            </table>
        </div>

        {{-- 3rd month --}}
        <div class="relative overflow-x-auto  sm:rounded">

            <table
                class="w-full text-sm text-left text-gray-900 dark:text-gray-400 border border-gray-400">
                <thead class="text-xs text-gray-100 uppercase bg-gray-800 dark:bg-slate-700 ">
                    <tr>
                        <th colspan="2" class="text-center text-lg">{{$thirdMonthName}}<hr></th>
                    </tr>
                    <tr class="align-top">
                        <th scope="col" class="px-3 py-4">
                            Date
                        </th>
                        <th scope="col" class="px-3 py-4">
                            Event
                        </th>



                    </tr>
                </thead>
                <tbody>
                    @foreach ($thirdMonthDates as $item)
                        @if(isset($dateEvents[$item->date]))
                            @foreach ($dateEvents[$item->date] as $val)
                                <tr class="bg-blue-200 border-b dark:bg-gray-800 dark:border-slate-700  border-gray-400 dark:hover:bg-slate-900/20 align-top">
                                    <td class="px-3 py-4">
                                        {{$item->format_date}}
                                    </td>
                                    <td scope="row" class="px-3 py-4 font-medium text-gray-900 dark:text-white ">

                                        <p class=" font-medium text-black truncate dark:text-white">
                                            {{$val->event_title}}
                                        </p>
                                        <p class="text-sm text-gray-600 truncate dark:text-gray-400">
                                            <i class="fa-solid fa-clock"></i> {{Common::timeFormatGl($val->event_time)}}
                                        </p>

                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-slate-700  border-gray-400 dark:hover:bg-slate-900/20 align-top">
                                <td class="px-3 py-4">
                                    {{$item->format_date}}
                                </td>
                                <td scope="row" class="px-3 py-4 font-medium text-gray-900 dark:text-white ">

                                    <p class=" font-medium text-black truncate dark:text-white">
                                        
                                    </p>
                                    <p class="text-sm text-gray-600 truncate dark:text-gray-400">
                                        
                                    </p>

                                </td>
                            </tr>
                        @endif
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

</div><!--end card-body-->