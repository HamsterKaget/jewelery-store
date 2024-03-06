
@extends('web.layout')

@section('title', 'Jenis Barang')

@section('content')
<div class="grid lg:grid-cols-3 grid-cols-1 sm:grid-cols-2 gap-4 mb-4">

    <div class="p-4 sm:col-span-full py-6 bg-white dark:bg-slate-800 shadow rounded-lg">
        <div class="mb-4 text-center">
            <h2 class="text-xl font-extrabold leading-none tracking-tight text-gray-900 md:text-3xl lg:text-4xl dark:text-white">Jenis Barang</h2>
            {{-- <p class="text-lg max-w-4xl mx-auto font-normal text-gray-500 lg:text-xl dark:text-gray-400">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam odit quos similique ratione tenetur iusto nemo voluptatum nisi!</p> --}}
        </div>

        <!-- Main App -->
        <div class="container bg-white mx-auto min-h-96 h-auto min-w-96 w-full rounded-xl shadow dark:bg-slate-800 dark:border-slate-700 border border-slate-200">

            <!-- Create modal -->
            <div id="createModal" tabindex="-1" aria-hidden="true"
                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] rounded-lg"
                >
                <div class="relative w-full max-w-lg max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="createModal" data-modal-target="createModal" onclick="createModal.hide()">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="px-6 py-6 lg:px-8 rounded-lg">
                            <h3 id="titleSimpanData" class="mb-4 text-xl font-medium text-gray-900 dark:text-white" >Tambah Data Jenis Barang</h3>
                            <form id="createForm" class="space-y-6" action="#" enctype="multipart/form-data"
                                onsubmit="event.preventDefault(); submitData('create');"
                            >
                                @csrf
                                <div class="hidden">
                                    <input type="hidden" id="id" name="id">
                                    <input type="hidden" id="created_by" name="created_by" >
                                    <input type="hidden" id="_method" name="_method">
                                </div>
                                <div>
                                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Barang</label>
                                    <div class="flex">
                                        <input type="text" id="nama" name="nama" class="rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                </div>

                                <button type="submit" id="buttonSimpanData" data-modal-hide="createModal" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan Data</button>
                            </form>
                        </div>
                    </div>
                </div>
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
                                <th scope="col" class="px-6 py-1.5 w-4">
                                    NO
                                </th>
                                <th scope="col" class="px-6 py-1.5 ">
                                    Jenis Barang
                                </th>
                                <th scope="col" class="px-6 py-1.5 ">
                                    Created By
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

<script>
    let createModal;

    const assetUrl = @json(asset('storage/'));

    /**
     *
     *  Read Script Start
     *
     */
    function fetchData(params, pageUrl = "{{ route('jenis-barang.get-data') }}") {
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
                        <td>${item.nama}</td>
                        <td>${item.created_by.name}</td>
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
                // Append the modified HTML to the table body
                tbody.insertAdjacentHTML('beforeend', newRowHTML);
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

        axios.post("{{ route('jenis-barang.create') }}", formData)
            .then(response => {
                // Handle the response (e.g., show a success message)
                console.log('data created successfully', response);
                fetchData(); // Refresh the table after deletion

                handleAlert('Berhasil', 'Data Berhasil Disimpan', 'success')
            })
            .catch(error => {
                // Handle any errors (e.g., show an error message)
                console.error('Error creating Jenis Barang', error);
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
        const editUrl = "{{ route('jenis-barang.edit') }}";

        editModal('Update Data', 'Simpan Perubahan')


            axios.get(`${editUrl}?id=${id}`)
                .then(response => {
                    let inputField = form.querySelector('#id');
                    inputField.value = response.data.id;

                    inputField = form.querySelector('#_method');
                    inputField.value = 'put';

                    inputField = form.querySelector('#nama');
                    inputField.value = response.data.nama;

                    inputField = form.querySelector('#created_by');
                    inputField.value = response.data.created_by;
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
        Swal.fire({
            title: "Yakin ingin menghapus data ?",
            text: "Anda tidak bisa mengembalikan data yang akan anda hapus!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya ! Saya Yakin"
            }).then((result) => {
            if (result.isConfirmed) {
                axios
                .post(`{{ route('jenis-barang.delete') }}`, {
                    _method: 'DELETE',
                    id: id
                })
                .then(response => {
                    // Handle the response (e.g., show a success message)
                    console.log('Jenis Barang deleted successfully', response);
                    fetchData(); // Refresh the table after deletion
                    Swal.fire({
                        title: "Deleted!",
                        text: "Data berhasil dihapus.",
                        icon: "success"
                    });

                })
                .catch(error => {
                    // Handle any errors (e.g., show an error message)
                    console.error('Error deleting Jenis Barang', error);
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
        searchInput.addEventListener('input', debounce(search, 400));
        // Create a new Modal object
        const modalOptions = {
            placement: 'bottom-right',
            backdrop: 'dynamic',
            backdropClasses: 'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
            closable: true,
            onShow: () => {
                const form = document.getElementById('createForm');
                const formData = new FormData(form);

                // reset form
                form.reset();
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

</script>
@endpush

