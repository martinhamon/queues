<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4">Crear filas (Ej: Laboratorio, consultorios, guardia, etc)</h1>
                <div class="overflow-x-auto">
                    <div>
                        <div>
                            @if (session()->has('message'))
                                <div class="bg-green-500 text-white p-2 rounded mb-4">
                                    {{ session('message') }}
                                </div>
                            @endif

                            @if (session()->has('error'))
                                <div class="bg-red-500 text-white p-2 rounded mb-4">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form wire:submit.prevent="submit">
                                <div class="mb-4">
                                    <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Descripción</label>
                                    <input type="text" id="description" wire:model="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div class="flex items-center justify-between">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                        Crear Registro
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-8">
        <h2 class="text-xl font-bold mb-4">Lista de filas</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border-b">ID</th>
                        <th class="px-4 py-2 border-b">Descripción</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @if (is_null($queueds) || $queueds->count()==0)
                   
                        <tr>
                            <td class="px-4 py-2 border-b" colspan="4">No hay registros</td>
                        </tr>
                        @else
                    @foreach ($queueds as $queued)
                        <tr>
                            <td class="px-4 py-2 border-b text-center align-middle">{{ $queued->id }}</td>
                            

                            <td class="px-4 py-2 border-b text-center align-middle">{{ $queued->Description }}</td>
                           
                        </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
        </div>
    </div>
</div>