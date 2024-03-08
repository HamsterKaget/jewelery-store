
@extends('web.layout')

@section('title', 'Emas')

@push('post-css')
    <style>
        .select2-selection {
            -webkit-box-shadow: 0;
            box-shadow: 0;
            background-color: #fff;
            border: 0;
            border-radius: 8px;
            color: #555555;
            font-size: 14px;
            outline: 0;
            min-height: 42px;
            text-align: left;
        }

        .select2-selection__rendered {
        margin: 6px auto;
        }

        .select2-selection__arrow {
            margin: 6px auto;
        }
    </style>
@endpush

@section('content')
<div class="grid lg:grid-cols-3 grid-cols-1 sm:grid-cols-2 gap-4 mb-4">

    <div class="p-4 sm:col-span-full py-6 bg-white dark:bg-slate-800 shadow rounded-lg">
        <div class="mb-4 text-center">
            <h2 class="text-xl font-extrabold leading-none tracking-tight text-gray-900 md:text-3xl lg:text-4xl dark:text-white">Emas</h2>
            {{-- <p class="text-lg max-w-4xl mx-auto font-normal text-gray-500 lg:text-xl dark:text-gray-400">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam odit quos similique ratione tenetur iusto nemo voluptatum nisi!</p> --}}
        </div>

        <!-- Main App -->
        <div class="container bg-white mx-auto min-h-96 h-auto min-w-96 w-full rounded-xl shadow dark:bg-slate-800 dark:border-slate-700 border border-slate-200">
            <!-- Create modal -->
            <div id="createModal" tabindex="-1" aria-hidden="true"
                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] rounded-lg"
                >
                <div class="relative w-full max-w-xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="createModal" data-modal-target="createModal" onclick="createModal.hide()">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="px-6 py-6 lg:px-8 rounded-lg">
                            <h3 id="titleSimpanData" class="mb-4 text-xl font-medium text-gray-900 dark:text-white" >Tambah Data Emas</h3>
                            <form id="createForm" class="space-y-6" action="#" enctype="multipart/form-data"
                                onsubmit="event.preventDefault(); submitData('create');"
                            >
                                @csrf
                                <div class="hidden">
                                    <input type="hidden" id="id" name="id">
                                    <input type="hidden" id="_method" name="_method">
                                </div>
                                <div class="flex flex-col items-center justify-center w-full">
                                    <label for="thumbnail" class="block text-sm font-medium text-gray-900 dark:text-white text-left self-start">Thumbnail / Foto</label>

                                    <label for="thumbnail" class="flex flex-col items-center justify-center w-full h-64 mt-3 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                        <div class="flex flex-col items-center justify-center pt-2 pb-6">
                                            <div id="filePreview" class="hidden border-b-2 border-dashed border-gray-600">
                                                <img id="previewThumbnail" src="" alt="File Preview" class="max-h-32 w-auto h-full" />
                                            </div>
                                            <svg class="w-8 h-8 mb-4 mt-2 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, JPEG or WEBP (*max 2MB)</p>
                                        </div>
                                        <input id="thumbnail" name="thumbnail" type="file" class="hidden" />
                                    </label>

                                </div>
                                <div>
                                    <label for="toko_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Toko</label>
                                    <select class="toko_id" style="width: 100%" name="toko_id">

                                    </select>
                                </div>
                                <div class="grid grid-cols-12 gap-2">
                                    <div class="col-span-6">
                                        <label for="jenis_emas_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Emas</label>
                                        <select class="jenis_emas_id" style="width: 100%" name="jenis_emas_id">

                                        </select>
                                    </div>
                                    <div class="col-span-6">
                                        <label for="jenis_barang_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Barang</label>
                                        <select class="jenis_barang_id" style="width: 100%" name="jenis_barang_id">

                                        </select>
                                    </div>
                                </div>

                                <div>
                                    <label for="judul" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Produk</label>
                                    <div class="flex">
                                        <input type="text" id="judul" name="judul" class="rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        </div>
                                </div>
                                <div>
                                    <label for="Sinopsis Emas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sinopsis / Deskripsi Emas</label>
                                    <div id="editor"></div>
                                </div>

                                <div class="grid grid-cols-2 gap-x-2">
                                    <div>
                                        <label for="penulis" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penulis Emas</label>
                                        <div class="flex">
                                            <input type="text" id="penulis" name="penulis" class="rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        </div>
                                    </div>
                                    <div>
                                        <label for="penerbit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penerbit Emas</label>
                                        <div class="flex">
                                            <input type="text" id="penerbit" name="penerbit" class="rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-x-2">
                                    <div>
                                        <label for="tahun_terbit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tahun Terbit</label>
                                        <div class="flex">
                                            <input type="text" id="tahun_terbit" name="tahun_terbit" class="rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        </div>
                                    </div>
                                    <div>
                                        <label for="stok" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok Emas</label>
                                        <div class="flex">
                                            <input type="number" min="1" id="stok" name="stok" class="rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        </div>
                                    </div>


                                </div>
                                <button type="submit" id="buttonSimpanData" data-modal-hide="createModal" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan Data</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            {{-- Delete Popup --}}
            <div id="deleteModal" tabindex="-1" class="fixed inset-0 flex items-center justify-center z-50 hidden overflow-x-hidden overflow-y-auto">
                <div class="bg-white dark:bg-gray-700 rounded-lg shadow max-w-md mx-auto my-auto self-center w-full p-6">
                    <div class="text-center">
                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this product?</h3>
                        <button data-modal-hide="deleteModal" type="button" class="data-delete-confirm text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Yes, I'm sure
                        </button>
                        <button data-modal-hide="deleteModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                    </div>
                </div>
            </div>

            <div class="hidden">
                <button data-modal-target="deleteModal"
                    data-modal-toggle="deleteModal" class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-pink-500 to-orange-400 group-hover:from-pink-500 group-hover:to-orange-400 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800">
                    <span class="relative p-2 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                        <svg class="w-3 h-3 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                            <path d="M17 4h-4V2a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v2H1a1 1 0 0 0 0 2h1v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1a1 1 0 1 0 0-2ZM7 2h4v2H7V2Zm1 14a1 1 0 1 1-2 0V8a1 1 0 0 1 2 0v8Zm4 0a1 1 0 0 1-2 0V8a1 1 0 0 1 2 0v8Z"></path>
                        </svg>
                    </span>
                </button>
            </div>

            <!-- Table -->
            <div class="px-4 py-8">
                <div class="relative overflow-x-auto sm:rounded-lg pb-8">
                    <div class="flex">
                        <form id="searchForm" class="mb-1 w-full sm:w-sm md:w-md lg:w-lg">
                            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </div>
                                <input type="search" id="default-search" class="block w-full p-3 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Mockups, Logos..." required>
                                {{-- <button type="submit" class="text-white absolute right-1.5 bottom-1.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button> --}}
                                <button
                                    type="submit"
                                    class="text-white absolute right-1.5 bottom-1.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    id="searchButton"
                                >
                                    Search
                                </button>
                            </div>
                        </form>
                        <div class="w-full mx-auto flex justify-end">
                            <caption class="items-end text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                                <button onclick="editModal('Tambah Data', 'Tambah Data')" data-modal-target="createModal" data-modal-toggle="createModal" type="button" class="relative inline-flex items-center justify-center p-0.5 mb-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-green-400 to-blue-600 group-hover:from-green-400 group-hover:to-blue-600 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800">
                                    <span class="relative px-3 py-1.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                        Tambah Data
                                    </span>
                                </button>
                            </caption>
                        </div>
                    </div>
                    <table class="w-full text-sm mt-4 text-left text-gray-500 rounded-t-xl dark:text-gray-400  border border-gray-200 rounded-lg">
                        <thead class="text-xs border broder-gray-200 text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 rounded-lg">
                            <tr class="text-center">
                                <th scope="col" class="px-6 py-1.5 ">
                                    Kode
                                </th>
                                <th scope="col" class="px-6 py-1.5 ">
                                    Toko
                                </th>
                                <th scope="col" class="px-6 py-1.5 ">
                                    Kategori Emas & Barang
                                </th>
                                <th scope="col" class="px-6 py-1.5 ">
                                    Informasi Produk
                                </th>
                                <th scope="col" class="px-6 py-1.5 w-[15%]">
                                    Tanggal Stok - Terjual
                                </th>
                                <th scope="col" class="px-6 py-1.5 ">
                                    Detail Produk
                                </th>
                                <th scope="col" class="px-6 py-1.5 ">
                                    Harga Beli - Jual
                                </th>
                                <th scope="col" class="px-6 py-1.5 ">
                                    Inventaris
                                </th>
                                <th scope="col" class="px-6 py-1.5  ">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="">
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example" class="mt-6 pagination-nav">
                        <ul class="inline-flex -space-x-px text-sm">
                          <li>
                            <a href="#" class="flex items-center justify-center px-3 h-8 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                          </li>

                            <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
                          </li>
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection


@push('post-js')
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>

<script>
    let editor;

    const fileInput = document.getElementById('thumbnail');
    const filePreview = document.getElementById('filePreview');
    const previewThumbnail = document.getElementById('previewThumbnail');
    let createModal;
    let sinopsisModal;


    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .then( newEditor => {
            editor = newEditor;
        } )
        .catch( error => {
            console.error( error );
        } );

    const assetUrl = @json(asset('storage/'));

    /**
     *
     *  Read Script Start
     *
     */
    function fetchData(params, pageUrl = "{{ route('emas.get-data') }}") {
        axios.get(pageUrl, {
            params: params
        })
            .then(function (response) {
                const data = response.data.data;

                const tbody = document.querySelector('table tbody');
                tbody.innerHTML = '';

                let index = 1;
                const rowTemplate = (item) =>
                `
                    <tr class="bg-white odd:bg-white even:bg-gray-50 text-center border-b dark:bg-gray-800 dark:border-gray-700">
                        <td>${index++}</td>
                        <td>
                            <img class="h-auto max-w-xl mx-auto rounded-lg shadow-xl dark:shadow-gray-800 w-32 my-2.5" src="${assetUrl+'/'+item.thumbnail}" alt="Thumbnail description">
                        </td>
                        <td class="max-w-[50%] h-full">
                            <div class="flex flex-col items-center justify-center space-y-3">
                                <span class="text-gray-600 font-semibold">${item.judul}</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">
                                    <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z"/>
                                    </svg>
                                    {{ url('') }}/buku/${item.slug}
                                </span>
                            </div>
                        </td>
                        <td>
                            <div id="kategori-list" class="flex h-full flex-wrap justify-center items-center mx-auto my-4">
                                <div id="dummy"></div>
                            </div>
                        </td>
                        <td>
                            </td>
                        <td>
                            <div class="flex flex-col justify-center items-center space-y-2">
                                <span class="bg-green-100 text-green-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-green-400 border border-green-400">

                                    Tersedia : ${item.stok}
                                </span>
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-yellow-400 border border-yellow-400">
                                    Dipinjam : 0
                                </span>

                            </div>
                        </td>
                        <td>
                            <div class="flex flex-col justify-center items-center space-y-2">
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">
                                    <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z"/>
                                    </svg>
                                    ${item.penulis}
                                </span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">
                                    <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z"/>
                                    </svg>
                                    ${item.penerbit}
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-2.5 text-center">
                            <button data-modal-target="createModal" onClick="edit(${item.id})" data-modal-show="createModal"  class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-teal-300 to-lime-300 group-hover:from-teal-300 group-hover:to-lime-300 dark:text-white dark:hover:text-gray-900 focus:ring-4 focus:outline-none focus:ring-lime-200 dark:focus:ring-lime-800">
                                <span class="relative p-2 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                    <svg class="w-3 h-3 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                        <path d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z"></path>
                                        <path d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z"></path>
                                    </svg>
                                </span>
                            </button>
                            <button onClick="handleDeleteAction(${item.id})"
                                    class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-pink-500 to-orange-400 group-hover:from-pink-500 group-hover:to-orange-400 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800">
                                <span class="relative p-2 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                    <svg class="w-3 h-3 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                        <path d="M17 4h-4V2a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v2H1a1 1 0 0 0 0 2h1v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1a1 1 0 1 0 0-2ZM7 2h4v2H7V2Zm1 14a1 1 0 1 1-2 0V8a1 1 0 0 1 2 0v8Zm4 0a1 1 0 0 1-2 0V8a1 1 0 0 1 2 0v8Z"></path>
                                    </svg>
                                </span>
                            </button>
                        </td>
                    </tr>
                `;


                data.data.forEach(function (item) {
                const newRowHTML = rowTemplate(item);

                // Construct the HTML for the kategori list
                let kategoriHTML = '';
                // console.log(item.kategori_buku_relasi.length);
                if (item.kategori_buku_relasi.length != 0) {
                    item.kategori_buku_relasi.forEach(kategori => {
                        kategoriHTML += `
                            <span class="inline-flex items-center mt-2 px-2 py-1 me-2 text-sm font-medium text-blue-800 bg-blue-100 rounded dark:bg-blue-900 dark:text-blue-300">
                                ${kategori.kategori_emas.nama_kategori}
                            </span>
                        `;
                    });
                }

                // Insert the kategori HTML into the newRowHTML
                const modifiedRowHTML = newRowHTML.replace('<div id="dummy"></div>', kategoriHTML);

                // Append the modified HTML to the table body
                tbody.insertAdjacentHTML('beforeend', modifiedRowHTML);
            });


                const searchInput = document.querySelector('#default-search');
                const searchValue = searchInput.value.trim();

                // Define your params object with the search value
                const params = {
                    search: searchValue || '', // Set the default to null if searchValue is empty
                };
                generatePaginationControls(data, params);
            })
            .catch(function (error) {
                console.error('Error fetching data:', error);
            });
    }

    fetchData();

    /**
     *
     *  Search Script Start
     *
     */
    function search(event) {
        event.preventDefault();

        const searchInput = document.querySelector('#default-search');
        const searchValue = searchInput.value.trim();

        // Define your params object with the search value
        const params = {
            search: searchValue || null, // Set the default to null if searchValue is empty
        };

        // Call the function to fetch data and append it to the table with the provided params
        fetchData(params);
    }

    /**
     *
     *  Create & Update Script Start
     *
     */
    function submitData() {
        const form = document.getElementById('createForm');
        const formData = new FormData(form);

        // reset form
        form.reset();
        let sinopsis = editor.getData();
        formData.append('sinopsis', sinopsis);

        axios.post("{{ route('emas.create') }}", formData)
            .then(response => {
                // Handle the response (e.g., show a success message)
                console.log('data created successfully', response);
                fetchData(); // Refresh the table after deletion

                handleAlert('Berhasil', 'Data Berhasil Disimpan', 'success')
            })
            .catch(error => {
                // Handle any errors (e.g., show an error message)
                console.error('Error creating Emas', error);
                handleAlert('Something Wrong!', error, 'error');
            });

        createModal.hide();


    }

    function editModal(titleText, buttonText) {
        const title = document.getElementById('titleSimpanData');
        title.textContent = titleText;

        const button = document.getElementById('buttonSimpanData');
        button.textContent = buttonText;

        createModal.show();
    }

    /**
     *
     *  Edit Script Start
     *
     */
    function edit(id = null) {
        const form = document.getElementById('createForm');
        const editUrl = "{{ route('emas.edit') }}";

        editModal('Update Data', 'Simpan Perubahan')


            axios.get(`${editUrl}?id=${id}`)
                .then(response => {
                    let inputField = form.querySelector('#id');
                    inputField.value = response.data.id;

                    inputField = form.querySelector('#_method');
                    inputField.value = 'put';

                    inputField = form.querySelector('#judul');
                    inputField.value = response.data.judul;

                    inputField = form.querySelector('#stok');
                    inputField.value = response.data.stok;

                    inputField = form.querySelector('#penulis');
                    inputField.value = response.data.penulis;

                    inputField = form.querySelector('#penerbit');
                    inputField.value = response.data.penerbit;

                    inputField = form.querySelector('#tahun_terbit');
                    inputField.value = response.data.tahun_terbit;

                    editor.setData(response.data.sinopsis);

                    previewThumbnail.src = assetUrl+'/'+response.data.thumbnail;
                    filePreview.classList.remove('hidden');

                      // Extract jenis_emas_id values from kategori_buku_relasi
                    const kategoriIds = response.data.kategori_buku_relasi.map(relasi => relasi.jenis_emas_id);
                    // Set selected options in Select2 dropdown
                    $('.jenis_emas_id').val(kategoriIds).trigger('change');

                })
                .catch(error => {
                    // Handle errors if needed
                    console.error(error);
                    handleAlert('Something Wrong!', error, 'error');

                });
    }


    /**
     *
     *  Delete Script Start
     *
     */
    function handleDeleteAction(id) {
        // resetModalPosition('deleteModal');
        // const deleteModal = document.getElementById('deleteModal'); // Get the delete modal element
        // const confirmButton = deleteModal.querySelector('.data-delete-confirm');
        Swal.fire({
            title: "Yakin ingin menghapus data?",
            text: "Anda tidak bisa mengembalikan data yang akan anda hapus!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya ! Saya Yakin"
            }).then((result) => {
            if (result.isConfirmed) {
                axios
                .post(`{{ route('emas.delete') }}`, {
                    _method: 'DELETE',
                    id: id
                })
                .then(response => {
                    // Handle the response (e.g., show a success message)
                    console.log('Emas deleted successfully', response);
                    fetchData(); // Refresh the table after deletion
                    Swal.fire({
                        title: "Deleted!",
                        text: "Data berhasil dihapus.",
                        icon: "success"
                    });

                })
                .catch(error => {
                    // Handle any errors (e.g., show an error message)
                    console.error('Error deleting Emas', error);
                    handleAlert('Something Wrong!', error, 'error');

                });

            }
            });
    }

    function init() {
        const modalElem = document.getElementById('createModal');
        const sinopsisElem = document.getElementById('modal-deskripsi');

        // Add an event listener to the search input to trigger the API request on input change
        const searchInput = document.querySelector('#default-search');
        searchInput.addEventListener('input', debounce(search, 400)); // Adjust the delay as needed (1 second in this case)

        // Create a new Modal object
        const modalOptions = {
            placement: 'bottom-right',
            backdrop: 'dynamic',
            backdropClasses: 'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
            closable: true,
            onShow: () => {
                previewThumbnail.src = '';
                filePreview.classList.add('hidden');

                $('.jenis_emas_id').val('').trigger('change');

                const form = document.getElementById('createForm');
                const formData = new FormData(form);

                // reset form
                form.reset();

                editor.setData('');
            }
        };

        // Create a new Modal object
        const modalOptionsDefault = {
            placement: 'bottom-right',
            backdrop: 'dynamic',
            backdropClasses: 'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
            closable: true,
        };

        const instanceOptions = {
            id: 'createModal',
            override: true,
        };

        fileInput.addEventListener('change', function (e) {
            const file = e.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    previewThumbnail.src = e.target.result;
                };

                reader.readAsDataURL(file);
                filePreview.classList.remove('hidden');
            } else {
                filePreview.classList.add('hidden');
            }
        });

        // Initialize createModal
        createModal = new Modal(modalElem, modalOptions, instanceOptions);
    }

    init();

    function handleAlert(title, text, icon) {
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            timer: 2000,
            timerProgressBar: true,
        });
    }

    function populateSelect(selector, route, defaultOptionText = 'Pilih') {
        $(selector).select2();
        axios.get(route)
            .then(function(response) {
                const data = response.data;
                $(selector).empty();
                $(selector).append($('<option>', {
                    value: '',
                    text: defaultOptionText,
                }));

                $.each(data, function(index, item) {
                    $(selector).append($('<option>', {
                        value: item.id,
                        text: item.text
                    }));
                });

                $(selector).trigger('change');
            })
            .catch(function(error) {
                console.error('Error fetching data:', error);
            });
    }

    populateSelect('.jenis_emas_id', "{{ route('jenis-emas.select') }}", 'Pilih Jenis Emas');
    populateSelect('.jenis_barang_id', "{{ route('jenis-barang.select') }}", 'Pilih Jenis Barang');
    populateSelect('.toko_id', "{{ route('toko.select') }}", 'Pilih Toko');

</script>
@endpush

