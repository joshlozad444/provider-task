<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        var csrf_token = '{{ csrf_token() }}';
    </script>
    <title>ShipERP PHP Technical Exam</title>
</head>
<body class="flex flex-col items-center justify-center h-screen bg-slate-200">
    <div class="mb-5 mt-5">
        <input class="bg-gray-200 text-gray-700 border border-gray-500 rounded py-3 px-1 w-1/5 leading-tight focus:outline-none focus:bg-white" type="text" id="provider-name" placeholder="Name">
        <input class="bg-gray-200 text-gray-700 border border-gray-500 rounded py-3 px-1 w-3/5 leading-tight focus:outline-none focus:bg-white mr-5" type="text" id="provider-url" placeholder="URL of data provider">
        <button class="py-3 bg-green-300 px-3 rounded" id="add-provider">Add</button>
    </div>
    <div class="relative overflow-x-auto mb-5">
        <table class="w-full h-2/3 text-md text-left text-gray-500 dark:text-gray-400">
            <thead class="text-md text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">URL</th>
                    <th scope="col" class="px-6 py-3"></th>
                </tr>
            </thead>
            <tbody class="max-h-fit" id="provider-contents">
                @forelse ($providers as $provider)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" id="trData-{{ $provider['provider_id'] }}">
                        <td class="px-6 py-4">{{ $provider['provider_name'] }}</td>
                        <td class="px-6 py-4">{{ $provider['provider_url'] }}</td>
                        <td class="px-6 py-4">
                            <button onclick="useProvider(this.id)" id="buttonTry-{{ $provider['provider_id'] }}" class="text-white bg-green-500 hover:bg-green-700 font-medium rounded-full text-sm px-4 py-2.5 text-center">Try</button>
                            <button onclick="toggleEditModal(this.id)" id="buttonEdit-{{ $provider['provider_id'] }}" class="text-white bg-blue-500 hover:bg-blue-700 font-medium rounded-full text-sm px-4 py-2.5 text-center">Edit</button>
                            <button onclick="deleteProvider(this.id)" id="buttonDelete-{{ $provider['provider_id'] }}" class="text-white bg-red-500 hover:bg-red-700 font-medium rounded-full text-sm px-4 py-2.5 text-center">Delete</button>
                        </td>
                    </tr>
                @empty 
                @endforelse
            </tbody>
        </table>
    </div>
    <figure>
        <img id="response-image" style="max-height:600px;max-width:500px;min-height:300px;min-width:250px;" class="rounded-lg" src="https://placehold.co/600x400?text=Hello+World&font=roboto" alt="image placeholder">
        <figcaption class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400">Response image from data provider</figcaption>
    </figure>

    <div id="overlay" class="fixed hidden z-40 w-screen h-screen inset-0 bg-gray-900 bg-opacity-60"></div>

    <div id="dialog" class="hidden fixed z-50 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 bg-white rounded-md px-8 py-6 space-y-5 drop-shadow-lg">
        <h1 id="current-edit" class="text-xl font-semibold">Dialog Title</h1>
        <div class="py-5 border-t border-b border-gray-300">
            <input class="bg-gray-200 text-gray-700 border border-gray-500 rounded w-3/12 py-3 px-1 focus:outline-none focus:bg-white mr-5" type="text" id="edit-provider-name">
            <input class="bg-gray-200 text-gray-700 border border-gray-500 rounded w-8/12 py-3 px-1 focus:outline-none focus:bg-white" type="text" id="edit-provider-url">
        </div>
        <div class="flex justify-end">
            <button id="saveDialog" class="px-5 py-2 bg-green-500 hover:bg-green-700 text-white cursor-pointer rounded-md mr-4">Save</button>
            <button id="closeDialog" class="px-5 py-2 bg-indigo-500 hover:bg-indigo-700 text-white cursor-pointer rounded-md">Close</button>
        </div>
    </div>
    <div id="loading-overlay" class="hidden absolute bg-white bg-opacity-60 z-10 h-full w-full items-center justify-center">
        <div class="flex items-center">
            <span class="flex text-3xl mr-4">Loading</span>
            <svg class="animate-spin h-5 w-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>
    </div>
</body>
<script src="/app.js"></script>
</html>