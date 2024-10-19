<div>


    <div class="caller-wrapper">
        <div class="caller-container">
            <div class="header">
                <h1>Paciente</h1>
            </div>

            <div class="content">
                @if(!is_null( $patient))
                @php

               
                $office=App\Models\Office::find($medicalOffice)->description;

                @endphp
                <p>Llamado actual:</p>
                <div class="patient-name">{{ $patient->name }}, {{ $patient->lastname }}</div>
                <div class="medical-office">{{ $office }}</div>


                @else
                <p>No hay pacientes en espera.</p>
                @endif
            </div>
        </div>
        <div class="recent-calls" x-init="() => {
                    Echo.channel('patient-call' )
                        .listen('PatientCall', (e) => {
                            console.log(e);
                             @this.call('callPatient', e);
                             
                               const audio=new Audio()
                                audio.src= '{{ asset('storage/sounds/ding-dong.mp3') }}';
                                audio.load();
                                audio.muted=false;
                                audio.autoplay=false;
                                audio.play();
                                 
                           
                        });
                }">
            @if( !$recentCalls || $recentCalls->isEmpty())
            <li>No hay llamados recientes.</li>
            @else
            <h2>Ultimos llamados</h2>
            <ul>

                @foreach($recentCalls as $call)
                @php

                $pat=App\Models\Patient::find($call->patient_id);
                $office=App\Models\Office::find($call->office_id)->description;

                @endphp
                <li>
                    <div class="recent-patient-name">{{ $pat->name }}, {{ $pat->lastname }}</div>
                    <div class="recent-medical-office">{{$office }}</div>
                </li>
                @endforeach
            </ul>
            @endif
        </div>



    </div>

    <style>
        .caller-wrapper {
            display: flex;
            justify-content: space-between;
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .caller-container {
            flex: 1;
            margin-right: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            font-family: 'Arial', sans-serif;
        }

        .header {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border-radius: 10px 10px 0 0;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .content {
            padding: 20px;
        }

        .content p {
            font-size: 18px;
            color: #333;
        }

        .patient-name {
            font-size: 32px;
            color: #007bff;
            margin: 20px 0;
        }

        .medical-office {
            font-size: 20px;
            color: #28a745;
        }

        .recent-calls {
            flex: 0.4;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            font-family: 'Arial', sans-serif;
        }

        .recent-calls h2 {
            margin-top: 0;
            font-size: 22px;
            color: #333;
        }

        .recent-calls ul {
            list-style: none;
            padding: 0;
        }

        .recent-calls li {
            margin-bottom: 15px;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .recent-patient-name {
            font-size: 18px;
            color: #007bff;
        }

        .recent-medical-office {
            font-size: 16px;
            color: #28a745;
        }
    </style>



</div>