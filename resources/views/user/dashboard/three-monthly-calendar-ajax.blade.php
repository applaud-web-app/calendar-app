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
            <h5 class="mb-1 text-base text-gray-900 md:text-lg dark:text-white">{{$firstMonthName}}</h5>
            <table class="w-full text-sm text-left text-gray-900 dark:text-gray-400 border border-gray-400">
                <thead class="text-xs text-gray-100 uppercase bg-gray-800 dark:bg-slate-700 ">
                  
                    <tr class="align-top">
                        <th scope="col" class="px-3 py-4 whitespace-nowrap">
                            Date
                        </th>
                        <th scope="col" class="px-3 py-4 w-full">
                            Event
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($firstMonthDates as $item)
                        @if(isset($dateEvents[$item->date]))
                            @foreach ($dateEvents[$item->date] as $val)
                                <tr class="border-b dark:bg-gray-800 dark:border-slate-700  border-gray-400 dark:hover:bg-slate-900/20 align-top" style="background: {!!$val->color_code!!};">
                                    <td class="px-3 py-4 whitespace-nowrap">
                                        <b class="border-r-2 block w-14 border-gray-800">{{$item->format_date}}</b>
                                    </td>
                                    <td scope="row" class="px-3 py-4 w-full font-medium text-gray-900 dark:text-white ">

                                        <p class=" font-medium text-black truncate dark:text-white">
                                            {{$val->event_title}}
                                        </p>
                                        <p class="text-sm text-gray-600 truncate dark:text-gray-400">
                                            {!!Common::timeFormatGl($val->event_time)!!}
                                        </p>

                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-slate-700  border-gray-400 dark:hover:bg-slate-900/20 align-top">
                                <td class="px-3 py-4 whitespace-nowrap">
                                    <b class="border-r-2 block w-14 border-gray-800">{{$item->format_date}}</b>
                                </td>
                                <td scope="row" class="px-3 py-4 w-full font-medium text-gray-900 dark:text-white  ">

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
            <h5 class="mb-1 text-base text-gray-900 md:text-lg dark:text-white">{{$secondMonthName}}</h5>
            <table class="w-full text-sm text-left text-gray-900 dark:text-gray-400 border border-gray-400">
                <thead class="text-xs text-gray-100 uppercase bg-gray-800 dark:bg-slate-700 ">
                 
                    <tr class="align-top">
                        <th scope="col" class="px-3 py-4 whitespace-nowrap">
                            Date
                        </th>
                        <th scope="col" class="px-3 py-4 w-full">
                            Event
                        </th>
                    </tr>
                </thead>
                <tbody>
                   

                    @foreach ($secondMonthDates as $item)
                    @if(isset($dateEvents[$item->date]))
                        @foreach ($dateEvents[$item->date] as $val)
                            <tr class="bg-blue-200 border-b dark:bg-gray-800 dark:border-slate-700  border-gray-400 dark:hover:bg-slate-900/20 align-top">
                               <td class="px-3 py-4 whitespace-nowrap">
                                    <b class="border-r-2 block w-14 border-gray-800">{{$item->format_date}}</b>
                                </td>
                                <td scope="row" class="px-3 py-4 w-full font-medium text-gray-900 dark:text-white ">

                                    <p class=" font-medium text-black truncate dark:text-white">
                                        {{$val->event_title}}
                                    </p>
                                    <p class="text-sm text-gray-600 truncate dark:text-gray-400">
                                        {!!Common::timeFormatGl($val->event_time)!!}
                                    </p>

                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-slate-700  border-gray-400 dark:hover:bg-slate-900/20 align-top">
                           <td class="px-3 py-4 whitespace-nowrap">
                                <b class="border-r-2 block w-14 border-gray-800">{{$item->format_date}}</b>
                            </td>
                            <td scope="row" class="px-3 py-4 w-full font-medium text-gray-900 dark:text-white ">

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
            <h5 class="mb-1 text-base text-gray-900 md:text-lg dark:text-white">{{$thirdMonthName}}</h5>
            <table
                class="w-full text-sm text-left text-gray-900 dark:text-gray-400 border border-gray-400">
                <thead class="text-xs text-gray-100 uppercase bg-gray-800 dark:bg-slate-700 ">
                    
                    <tr class="align-top">
                        <th scope="col" class="px-3 py-4 whitespace-nowrap">
                            Date
                        </th>
                        <th scope="col" class="px-3 py-4 w-full">
                            Event
                        </th>



                    </tr>
                </thead>
                <tbody>
                    @foreach ($thirdMonthDates as $item)
                        @if(isset($dateEvents[$item->date]))
                            @foreach ($dateEvents[$item->date] as $val)
                                <tr class="bg-blue-200 border-b dark:bg-gray-800 dark:border-slate-700  border-gray-400 dark:hover:bg-slate-900/20 align-top">
                                   <td class="px-3 py-4 whitespace-nowrap">
                                        <b class="border-r-2 block w-14 border-gray-800">{{$item->format_date}}</b>
                                    </td>
                                    <td scope="row" class="px-3 py-4 w-full font-medium text-gray-900 dark:text-white ">

                                        <p class=" font-medium text-black truncate dark:text-white">
                                            {{$val->event_title}}
                                        </p>
                                        <p class="text-sm text-gray-600 truncate dark:text-gray-400">
                                            {!!Common::timeFormatGl($val->event_time)!!}
                                        </p>

                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-slate-700  border-gray-400 dark:hover:bg-slate-900/20 align-top">
                               <td class="px-3 py-4 whitespace-nowrap">
                                    <b class="border-r-2 block w-14 border-gray-800">{{$item->format_date}}</b>
                                </td>
                                <td scope="row" class="px-3 py-4 w-full font-medium text-gray-900 dark:text-white ">

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