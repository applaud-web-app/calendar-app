@extends('layout.master')
@section('section')

<section class="relative content-body">
    <div class="container mx-auto ">
        <div class="flex items-center justify-between flex-wrap mb-5">
            <div class="items-center ">
                <h1 class="md:text-3xl text-2xl md:mb-0 mb-3 block dark:text-slate-100">Calendar</h1>

            </div>
            <div class="flex items-center space-x-2">
              
                <a href="#addCategoryModal" data-modal-toggle="modal" class="px-2 py-2 lg:px-4 md:text-base text-sm border border-blue-500 bg-white text-blue-500  hover:text-white  rounded hover:bg-blue-600">  <i class="fa-solid fa-plus"></i> Add Category</a>
                <a href="{{url('admin/add-calendar')}}"
                    class="px-2 py-2 lg:px-4 md:text-base text-sm border border-blue-500 bg-blue-500 text-white rounded hover:bg-blue-600"><i class="fa-solid fa-plus"></i> Add Calendar</a>
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
                                $inputObj->url = url('admin/monthly-calendar');
                                $encLink = Common::encryptLink($inputObj);

                                $inputObjE = new stdClass();
                                $inputObjE->params = 'id='.$item->id;
                                $inputObjE->url = url('admin/edit-calendar');
                                $encLinkE = Common::encryptLink($inputObjE);
                            @endphp
                          
                            <li>
                                <div  class="flex items-center justify-between md:p-3 p-2 shadow-sm md:text-lg text-base  text-gray-900 rounded-sm  bg-white hover:bg-blue-100 group dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                                    <div class="flex-1 whitespace-nowrap">
                                        <span>{{$item->calendar_name}}</span> <a href="{{$encLinkE}}" class="text-blue-500"><i class="fa-solid fa-pen-to-square"></i></a>
                                    </div>
                                   
                                    
                                    <a href="{{$encLink}}" class="text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full  md:p-2 p-1 text-center inline-flex items-center dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800 dark:hover:bg-blue-500">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                        </svg>
                                    </a>
                                </div>
                               
                            </li>
                        @endforeach
                    </ul>
            </div>
        @endif
        @empty
            <div class="w-full mb-3 ">
                <h3 class="text-center">NO DATA</h3>
            </div>
        @endforelse

        <div class="w-full">
           
                {{ $calendarData->links() }}
           
        </div>
       
       

    </div>
</section>



  
    <!--Start Category  Add Modal -->
    <form action="{{url('admin/store-category')}}" class="modal fade" id="addCategoryModal" method="post">
        @csrf
        <div class="modal-dialog modal-dialog-center">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title mt-0" id="staticBackdropLabel1">Add Category</h6>
                    <button type="button" class="btn-close" aria-label="Close"><i class="fa-regular fa-circle-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="category_name" class="label">Category Name <span class="text-red-500">*</span></label>
                        <input type="text" class="form-control" name="category_name" id="category_name" placeholder="Enter Category Name" required maxlength="250">
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button type="submit" id="submit_btn" class="text-white bg-blue-500 hover:bg-blue-600  font-medium rounded block w-full px-3 py-2 dark:bg-blue-500 dark:hover:bg-blue-600 focus:outline-none  my-auto">Add Category</button>
                </div>
            </div>
        </div>
    </form>
    <div class="modal-overlay"></div>
 <!--End Category  Add Modal -->

@endsection


@push('scripts')
    <script>
        document.getElementById('addCategoryModal').addEventListener('submit',function(){
            var elm = document.getElementById('submit_btn');
            elm.innerText = 'Processing...';
            elem.setAttribute('disabled','disabled');
        })
    </script>    
@endpush


