@extends('base')
@section('title', 'Linker')
@section('content')

<div class="max-w-7xl mx-auto p-6 lg:p-8 w-full">
    <div class="flex justify-center items-center">
        <img width="80" height="80" src="https://img.icons8.com/officel/80/harvester.png" alt="harvester" />
        <h1 class="text-6xl ml-5 font-extrabold">Linker</h1>
    </div>

    <div class="mt-16">
        <div x-data="{ links: '' }" class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
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