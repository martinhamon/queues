<div>

<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >


            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
               
        <h1>Caller de Pacientes</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>DNI</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($patients as $patient)
                    <tr>
                        <td>{{ $patient['id'] }}</td>
                        <td>{{ $patient['name'] }}</td>
                        <td>{{ $patient['lastname'] }}</td>
                        <td>{{ $patient['dni'] }}</td>
                        <td>
                            
                                <button wire:click="callPatient('{{ $patient['id'] }}')" class="btn btn-primary">Llamar</button>
                           
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
            </div>
        </div>
    </div>


