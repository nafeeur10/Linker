@extends('base')
@section('title', 'Linker: Create')
@section('content')
<div class="mt-16 shadow-xd rounded">
    <div class="flex items-center">
        <div class="p-4">
            <h3 class="text-3xl font-bold">Link Form</h3>
            <p>A form of creating links in your account including their url href.</p>
        </div>
        <div class="ml-auto pr-2 py-4">
            <a x-data="{ url: '/' }"
                    x-on:click="$dispatch('alpine:navigate', url)"
                    x-bind:href="url"
                    type="button" 
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
            >
                Link List
            </a>
        </div>
    </div>
    <div x-data="{ links: '' }" class="w-full mb-4 border border-gray-200 bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
        <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
            <label for="link" class="sr-only">Your Links</label>
            <textarea x-model="links" rows="10" class="w-full px-0 text-sm text-gray-900 bg-white border-0 focus:ring-0" placeholder="Write your links here..." required></textarea>
        </div>
        <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
            <button @click="submitLinks" type="submit" class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                Create Links
            </button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function submitLinks() {
        axios.post('/store', { links: JSON.stringify(this.links) })
        .then(response => {
            console.log('Message submitted successfully!');
        })
        .catch(error => {
            console.error('Error submitting message:', error);
        });
    }
</script>
@endpush