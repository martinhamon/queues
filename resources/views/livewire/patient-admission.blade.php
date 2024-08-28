<div>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg  p-6 ">

                <h1 class="text-2xl font-bold mb-6">Admisión de Pacientes</h1>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="dni">
                        DNI
                    </label>
                    <input wire:model.live="patient_dni" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="patient_dni" name="patient_dni" type="text" placeholder="DNI del Paciente">

                    @if($patients)
                    @foreach ($patients as $patient)
                    <div class="text-red-500 text-sm">{{$patient }}</div>
                    @endforeach

                    @else
                    <div class="text-red-500 text-sm">no hay coincidencias</div>
                    @endif
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Nombre
                    </label>
                    <input wire:model.live="patient_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="patient_name" name="patient_name" type="text" placeholder="Nombre del Paciente">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="lastname">
                        Apellido
                    </label>
                    <input wire:model.live="patient_lastname" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="patient_lastname" name="patient_lastname" type="text" placeholder="Apellido del Paciente">
                </div>

                <div class="flex items-center justify-between">
                    <button wire:click="save()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Admitir Paciente
                    </button>
                </div>
                <div class="flex items-center justify-between">
                    <button wire:click="search()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                       Buscar paciente
                    </button>
                </div>

            </div>

        </div>
    </div>

</div>