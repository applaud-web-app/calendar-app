@php
    $inputObj = new stdClass();
    $inputObj->url = url('admin/monthly-calendar');
    $inputObj->params = 'id='.$calendarId;
    $encLink = Common::encryptLink($inputObj);

    $inputObjM = new stdClass();
    $inputObjM->url = url('admin/three-monthly-calendar');
    $inputObjM->params = 'id='.$calendarId;
    $encLinkM = Common::encryptLink($inputObjM);

    $inputObjY = new stdClass();
    $inputObjY->url = url('admin/yearly-calendar');
    $inputObjY->params = 'id='.$calendarId;
    $encLinkY = Common::encryptLink($inputObjY);

@endphp

@if(Route::current()->getName()=="monthly-calendar")
    <a  href="{{$encLink}}" class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded px-3 py-2 mr-2 mb-2 dark:bg-blue-500 dark:hover:bg-blue-600 focus:outline-none dark:focus:ring-blue-700">Monthly</a>
@else
    <a  href="{{$encLink}}" class="px-5 py-2 mr-2 mb-2 font-medium text-gray-900 focus:outline-none bg-white rounded border border-gray-200 hover:bg-gray-100 hover:text-blue-500 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Monthly</a>
@endif

@if(Route::current()->getName()=="three-monthly-calendar")
    <a  href="{{$encLinkM}}" class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded px-3 py-2 mr-2 mb-2 dark:bg-blue-500 dark:hover:bg-blue-600 focus:outline-none dark:focus:ring-blue-700">3 Months</a>
@else
    <a  href="{{$encLinkM}}" class="px-5 py-2 mr-2 mb-2 font-medium text-gray-900 focus:outline-none bg-white rounded border border-gray-200 hover:bg-gray-100 hover:text-blue-500 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">3 Months</a>
@endif

@if(Route::current()->getName()=="yearly-calendar")
    <a  href="{{$encLinkY}}" class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded px-3 py-2 mr-2 mb-2 dark:bg-blue-500 dark:hover:bg-blue-600 focus:outline-none dark:focus:ring-blue-700">Yearly</a>
@else
    <a  href="{{$encLinkY}}" class="px-5 py-2 mr-2 mb-2 font-medium text-gray-900 focus:outline-none bg-white rounded border border-gray-200 hover:bg-gray-100 hover:text-blue-500 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Yearly</a>
@endif
