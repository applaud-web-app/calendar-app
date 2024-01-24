@extends('layout.master')
@section('section')


<section class="relative content-body">
    <div class="container mx-auto ">
        <div class="flex items-center justify-between flex-wrap mb-5">
            <div class="items-center ">
                <h1 class="md:text-3xl text-2xl md:mb-0 mb-3 block dark:text-slate-100">All Enquiries</h1>

            </div>
          
        </div>

        <div class="p-3 bg-white dark:bg-slate-900 shadow dark:shadow-gray-700 rounded-md">
          
            <div class="w-full">
                <div class="relative overflow-x-auto  sm:rounded">
                        
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400" id="datatable">
                        <thead class=" text-gray-700 uppercase bg-gray-50 dark:bg-slate-700 dark:text-gray-300">
                            <tr>
                                <th scope="col" class="px-5 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-5 py-3">
                                    Contact Info
                                </th>
                                <th scope="col" class="px-5 py-3 w-full">
                                    Message
                                </th>
                              
                                <th scope="col" class="px-5 py-3">
                                    <span>Action</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($enquiries as $item)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-slate-700 hover:bg-gray-50 dark:hover:bg-slate-900/20">
                                    <th scope="row" class="px-5 py-3 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                        <p>{{$item->full_name}}</p>
                                    </th>
                                    <td class="px-5 py-3">
                                    <p class="whitespace-nowrap"><i class="fas fa-phone"></i> {{$item->phone_number}}</p>
                                    <p class="whitespace-nowrap"><i class="fas fa-envelope"></i> {{$item->email}}</p>
                                    </td>
                                    <td class="px-5 py-3">
                                        <h5 class=" text-blue-500 ">{{$item->subject}}</h5>
                                        <p >{{$item->message}}</p>
                                    </td>
                                
                                    <td class="px-5 py-3 text-right">
                                        @php
                                            $inputObj = new stdClass();
                                            $inputObj->params = 'id='.$item->id;
                                            $inputObj->url = url('admin/remove-enquiry');
                                            $encLink = Common::encryptLink($inputObj);
                                        @endphp
                                        <a href="{{$encLink}}" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center"><h4 class="text-red-500">NO Enquiries</h4></td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>                            
            </div><!--end card-body-->

            <div class="w-full mt-3">
           
                {{ $enquiries->links() }}
           
        </div>

        </div>

    </div>
</section>

@endsection


