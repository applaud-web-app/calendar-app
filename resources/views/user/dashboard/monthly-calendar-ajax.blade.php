<div class="card-header flex justify-between space-x-1">
    <h4 class="card-title">{{ $monthName }}</h4>
    <div class="space-x-1">
        <button type="button" onclick="getMonthData('{{ $prevDate }}')"
            class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-3 py-2 text-center inline-flex items-center  dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <i class="fas fa-arrow-left "></i>
        </button>
        <button type="button" onclick="getMonthData('{{ $nextDate }}')"
            class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-3 py-2 text-center inline-flex items-center  dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
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
                    @if (isset($dateEvents[$item->date]))
                        @foreach ($dateEvents[$item->date] as $val)
                            <tr
                                class="dark:bg-slate-800 border-b  dark:border-slate-700  border-gray-400 dark:hover:bg-slate-900/20 align-top" style="background: {!!$val->color_code!!};">
                                <td class="px-3 py-4">
                                    <b class="border-r-2 block w-14 border-gray-800">{{$item->format_date}}</b>
                                </td>
                                <td scope="row" class="px-3 py-4 font-medium text-gray-900 dark:text-white ">

                                    <p class=" font-medium text-black truncate dark:text-white">
                                        {{ $val->event_title }}
                                    </p>

                                </td>
                                <td class="px-3 py-4">
                                    <p class="text-sm text-gray-600 truncate dark:text-gray-400">
                                        {!!Common::timeFormatGl($val->event_time)!!}
                                    </p>

                                </td>

                               
                            </tr>
                        @endforeach
                    @else
                        <tr
                            class="bg-white-500 border-b dark:bg-gray-800 dark:border-slate-700  border-gray-400 dark:hover:bg-slate-900/20 align-top">
                            <td class="p-4">
                                <b class="border-r-2 block w-14 border-gray-800">{{$item->format_date}}</b>
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
