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
                <h1 class="md:text-3xl text-2xl md:mb-0 mb-3 block dark:text-slate-100">Categories</h1>

            </div>
            <div class="flex items-center space-x-3">
                <a href="#addCategoryModal" data-modal-toggle="modal" class="px-2 py-2 lg:px-4 md:text-base text-sm border border-blue-500 bg-white text-blue-500  hover:text-white  rounded hover:bg-blue-600">  <i class="fa-solid fa-plus"></i> Add Category</a>
            </div>
        </div>

        <div class="h-full card w-full relative overflow-hidden mb-3">
            <div class="card-header">
                <h4 class="font-medium">All Categories</h4>
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
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach ($categories as $item)
                                        <tr class="bg-white border-b border-dashed dark:bg-gray-800 dark:border-gray-700">
                                            <td class="w-10 p-3 text-sm font-medium whitespace-nowrap dark:text-white">{{$i}}</td>
                                            <td class="p-3 text-sm font-medium whitespace-nowrap dark:text-white">
                                            {{$item->category_name}}
                                            </td>
                                            <td class="p-3 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                <a href="javascript:void(0);" onclick="editcat('{!!$item->category_name!!}','{{$item->id}}')"><i class="ti ti-edit text-lg text-gray-500 dark:text-gray-400"></i></a>
                                                @php
                                                    $inputObj = new stdClass();
                                                    $inputObj->url = url('admin/remove-category');
                                                    $inputObj->params = 'id='.$item->id;
                                                    $encLink = Common::encryptLink($inputObj);
                                                @endphp
                                                <a href="javascript:void(0);" onclick="deleteCat('{{$encLink}}')"><i class="ti ti-trash text-lg text-red-500 dark:text-red-400"></i></a>
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
                {{ $categories->links() }}
            </div>
        </div>

    </div>
</section>
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

<div id="editEventModal" class="modal fade">

</div>

<div class="modal-overlay"></div>
@endsection


@push('scripts')
    <script>
        document.getElementById('addCategoryModal').addEventListener('submit',function(){
            var elm = document.getElementById('submit_btn');
            elm.innerText = 'Processing...';
            elem.setAttribute('disabled','disabled');
        })
    </script>    
    <script>
        function editcat(catName,Id){
            document.getElementsByTagName('body')[0].classList.add('modal-enabled');
            document.getElementById('editEventModal').classList.add('block');
            document.getElementById('editEventModal').innerHTML = `
                <form action="{{url('admin/update-category')}}"  method="post" id="update_modal">
                    @csrf
                    <div class="modal-dialog modal-dialog-center">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title mt-0" id="staticBackdropLabel1">Edit Category</h6>
                                <button type="button" id="btn_close" aria-label="Close"><i class="fa-regular fa-circle-xmark"></i></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label for="category_name_up" class="label">Category Name <span class="text-red-500">*</span></label>
                                    <input type="text" class="form-control" name="category_name" id="category_name_up" placeholder="Enter Category Name" required maxlength="250" value="${catName}">
                                </div>
                                <input type="hidden" value="${Id}" name="id">
                            
                            </div>
                            <div class="modal-footer">
                                <button type="submit" id="submit_btn_up" class="text-white bg-blue-500 hover:bg-blue-600  font-medium rounded block w-full px-3 py-2 dark:bg-blue-500 dark:hover:bg-blue-600 focus:outline-none  my-auto">Update Category</button>
                            </div>
                        </div>
                    </div>
                </form>`;
                document.getElementById('btn_close').addEventListener('click',function(){
                    document.getElementsByTagName('body')[0].classList.remove('modal-enabled');
                    document.getElementById('editEventModal').classList.remove('block');
                });

                document.getElementById('update_modal').addEventListener('submit',function(){
                    var elm = document.getElementById('submit_btn_up');
                    elm.innerText = 'Processing...';
                    elem.setAttribute('disabled','disabled');
                })
        }

       

    </script>
    <script>
        function deleteCat(link){
            if(confirm('are you sure ? you want to remove this category')){
                window.location.href = link;
            }
        }
    </script>
@endpush

