<div>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg  p-6 ">

                <h1 class="text-2xl font-bold mb-6">Admisión de Pacientes</h1>
                <div class="  p-6 ">
                    <div class="flex items-center justify-between">
                        <button wire:click="$dispatch('openModal', { component: 'patient-search' })" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Buscar paciente</button>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="dni">
                        DNI
                    </label>
                    <input disabled wire:model.live="patient_dni" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="patient_dni" name="patient_dni" type="text" placeholder="DNI del Paciente">

                    @error('patient_dni') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Nombre
                    </label>
                    <input disabled wire:model.live="patient_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="patient_name" name="patient_name" type="text" placeholder="Nombre del Paciente">
                    @error('patient_name') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label disabled class="block text-gray-700 text-sm font-bold mb-2" for="lastname">
                        Apellido
                    </label>
                    <input disabled wire:model.live="patient_lastname" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="patient_lastname" name="patient_lastname" type="text" placeholder="Apellido del Paciente">
                    @error('patient_lastname') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="office">
                        Consultorio
                    </label>
                    <select wire:model.live="selectedOffice" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="office" name="office">
                        <option disabled >Seleccione un consultorio</option>
                       
                        @foreach($offices as $office)
                       
                        <option wire:model="selectedOffice" value="{{ $office->id }}">{{ $office->description }} </option>
                        @endforeach
                    </select>
                    @error('selectedOffice') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="flex items-center justify-between">
                    <button wire:click="save()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Admitir Paciente
                    </button>
                </div>




            </div>

        </div>
    </div>

</div>