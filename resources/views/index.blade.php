@extends('base')
@section('title', 'Linker')
@section('content')
<div class="relative overflow-x-auto shadow-xd rounded mt-16">
    <div class="flex items-center">
        <div class="p-4">
            <h3 class="text-3xl font-bold">Link List</h3>
            <p>A list of all the links in your account including their url href.</p>
        </div>
        <div class="ml-auto pr-2 py-4">
            <a x-data="{ url: '/create' }"
                    x-on:click="$dispatch('alpine:navigate', url)"
                    x-bind:href="url"
                    type="button" 
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
            >
                Add Links
            </a>
        </div>
    </div>
    
    <div class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900 pt-4 px-4">
        <label for="table-search" class="sr-only">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="text" id="table-search-users" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for users">
        </div>
        <div x-data="{ isSortOpen: false }" class="relative">
            <button 
                x-on:click="isSortOpen = !isSortOpen" 
                data-dropdown-toggle="dropdownAction" 
                class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" 
                type="button"
            >
                <span class="sr-only">Action button</span>
                Sort
                <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                </svg>
            </button>
            
            <div id="dropdownAction" x-show="isSortOpen" class="z-10 absolute right-0 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownActionButton">
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Alphabetically A - Z</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Alphabetically Z - A</a>
                    </li>
                </ul>
            </div>
        </div>
        
    </div>
    <div x-data="getData()">
        <table class="w-full text-sm text-left rtl:text-right text-gray-600 dark:text-gray-400">
            <x-link-table-header />
            <tbody x-init="fetchLinkData()">
                <template x-for="link in links">
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <span x-text="link.domain.domain"></span>
                        </th>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <span x-text="link.path"></span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <a href="#" class="font-medium text-red-600">Delete</a>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
        <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between p-4" aria-label="Table navigation">
            <span x-init="fetchLinkCount()" class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto">
                Showing 
                <span class="font-semibold text-gray-900 dark:text-white">
                    <span x-text="showingFrom"></span>
                    <span> - </span>
                    <span x-text="showingTo"></span>
                </span>
                 of <span class="font-semibold text-gray-900 dark:text-white" x-text="linkCount"></span>
            </span>
            <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
                <li>
                    <button x-on:click="fetchLinkData(currentPage > 1 ? currentPage - 1: currentPage)" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 ">Previous</button>
                </li>
                <template x-for="(item, index) in totalPage">
                    <li>
                        <button x-on:click="fetchLinkData(index+1)" :class="{'bg-blue-50 text-blue-600': index+1 == currentPage}" class="flex items-center justify-center px-3 h-8 border border-gray-30 hover:bg-blue-100 hover:text-blue-700" x-text="index+1"></button>
                    </li>
                </template>
                <li>
                    <button x-on:click="fetchLinkData(currentPage < totalPage ? currentPage + 1: currentPage)" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 ">Next</button>
                </li>
            </ul>
        </nav>
        <script>
            function getData() {
                return {
                    isLoading: false,
                    links: [],
                    linkCount: 0,
                    showingFrom: 0,
                    showingTo: 5,
                    error: null,
                    currentPage: 1,
                    totalPage: 1,
                    perPageItems: 5,
                    fetchLinkData(page = 1) {
                        this.isLoading = true;
                        this.currentPage = page;
                        fetch('/links?page=' + page)
                            .then((response) => response.json())
                            .then((json) => {
                                this.links = json.links
                                console.log(this.links);
                            })
                            .catch(error => {
                                this.error = error.message;
                                this.isLoading = false;
                            });
                    },
                    fetchLinkCount() {
                        fetch('/count')
                            .then((response) => response.json())
                            .then((json) => {
                                this.linkCount = json;
                                this.totalPage = Math.ceil(this.linkCount / this.perPageItems);
                                console.log("Counter: ", json);
                            })
                            .catch(error => {
                                console.log(error);
                            });
                    }
                }
            }
        </script>
    </div>
</div>

@endsection