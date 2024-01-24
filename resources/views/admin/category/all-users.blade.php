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
                <h1 class="md:text-3xl text-2xl md:mb-0 mb-3 block dark:text-slate-100">Users</h1>

            </div>
            <div class="flex items-center space-x-3">
                <a href="{{url('admin/add-user')}}" class="px-2 py-2 lg:px-4 md:text-base text-sm border border-blue-500 bg-white text-blue-500  hover:text-white  rounded hover:bg-blue-600">  <i class="fa-solid fa-plus"></i> Add User</a>
            </div>
        </div>

        <div class="h-full card w-full relative overflow-hidden mb-3">
            <div class="card-header">
                <h4 class="font-medium">All Users</h4>
            </div>
            <div class="flex flex-col  card-body p-1">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <table class="min-w-full">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="w-10 p-3 text-sm font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">#</th>
                                        <th scope="col" class="p-3 text-sm font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Name
                                        </th>
                                        <th scope="col" class="p-3 text-sm font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Email
                                        </th>
                                        <th scope="col" class="p-3 text-sm font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Registered On
                                        </th>
                                        <th scope="col" class="p-3 text-sm font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach ($users as $item)
                                        <tr class="bg-white border-b border-dashed dark:bg-gray-800 dark:border-gray-700">
                                            <td class="w-10 p-3 text-sm font-medium whitespace-nowrap dark:text-white">{{$i}}</td>
                                            <td class="p-3 text-sm font-medium whitespace-nowrap dark:text-white">
                                           {{$item->name}}
                                            </td>
                                            <td class="p-3 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                {{$item->email}}
                                            </td>
                                            <td class="p-3 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                {{date("d M Y h:i:s A",strtotime($item->created_at))}}
                                            </td>
                                            @php
                                                $inputObj = new stdClass();
                                                $inputObj->url = url('admin/remove-user');
                                                $inputObj->params = 'id='.$item->id;
                                                $encLink = Common::encryptLink($inputObj);
                                            @endphp
                                            <td class="p-3 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                <a href="javascript:void(0)" onclick="removeUser('{{$encLink}}')"><i class="ti ti-trash text-lg text-red-500 dark:text-red-400"></i></a>
                                            </td>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                   
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                {{ $users->links() }}
            </div>
        </div>

    </div>
</section>

@endsection


@push('scripts')
    <script>
        function removeUser(link){
            if(confirm('are you sure ? you want to remove this category')){
                window.location.href = link;
            }
        }
    </script>
@endpush

