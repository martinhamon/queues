<div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <h2 class="text-2xl font-bold mb-6">Carga de Consultorio</h2>

        <div class="flex flex-col">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="office_name">Nombre del Consultorio:</label>
            <input wire:model.live="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" id="office_name" name="office_name">
        </div>

        <div class="flex flex-col">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="office_name">Numero de consultorio:</label>
            <input wire:model.live="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" id="office_name" name="office_name">
        </div>

        <div class="mb-4">
            <label for="queued_id" class="block text-gray-700 text-sm font-bold mb-2">Seleccionar Queued</label>
            <select id="queued_id" wire:model="queued_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Seleccione una fila</option>
                @foreach ($queues as $queued)
                <option value="{{ $queued->id }}">{{ $queued->Description }}</option>
                @endforeach
            </select>
            @error('queued_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end  py-6">
            <button wire:click="store" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Cargar</button>
        </div>

        <div class="flex flex-col py-6">
            @if ($message)
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ $message }}</span>
            </div>
            @endif
            @if($error)
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ $error }}</span>
            </div>
            @endif
        </div>
    </div>
</div>