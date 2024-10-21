<div>
    @php
    //dd( $patients);
    @endphp
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4">Caller de Pacientes</h1>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>

                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hora admitido</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Consultorio</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">

                            @foreach($patients as $patient)
                            <tr>
                                @php

                              
                                $office=App\Models\Office::find($patient->office_id)->description;

                                @endphp
                                <td class="px-6 py-4 whitespace-nowrap">{{ $patient['name'] }}, {{ $patient['lastname'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $patient['created_at'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{$office}}--{{$patient->office_id}}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $patient['status'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <button wire:click="callPatient('{{ $patient['patient_id'] }}','{{$patient['office_id'] }}')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Llamar</button>
                                    <button wire:click="finalize('{{ $patient['id'] }}')" class="bg-red-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Finalizar</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>