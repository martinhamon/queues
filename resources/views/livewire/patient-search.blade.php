<div id="modal">
    <div class="w-full max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <h2 class="text-2xl font-bold mb-6">Busqueda de paciente</h2>
        <form wire:submit.prevent="searchPatient" class="space-y-4">
            <div class="flex flex-col">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="dni">DNI:</label>
                <input wire:model.live="dni" wire:keydown="searchPatient()" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" id="dni">
            </div>


        </form>

        @if(isset($patients) && $patients->isNotEmpty())
        <h3 class="text-xl font-bold mt-6">Resultados de la búsqueda:</h3>
        <div class="overflow-x-auto mt-4">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border-b">DNI</th>
                        <th class="px-4 py-2 border-b">Nombre</th>
                        <th class="px-4 py-2 border-b">Apellido</th>
                        <th class="px-4 py-2 border-b">Cargar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($patients as $patient)
                    <tr>
                        <td class="px-4 py-2 border-b">{{ $patient->dni }}</td>
                        <td class="px-4 py-2 border-b">{{ $patient->name }}</td>
                        <td class="px-4 py-2 border-b">{{ $patient->lastname }}</td>
                        <td class="px-4 py-2 border-b">
                            <div class="flex justify-end">
                                <button wire:click="selectPatient({{ $patient->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-1 rounded focus:outline-none focus:shadow-outline">Cargar</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="mt-4 text-gray-600">No se encontraron pacientes.</p>
        @endif

    </div>

    <script>
        window.addEventListener('closeModal', event => {
     $("#modal").modal('hide');                
})
    </script>
</div>