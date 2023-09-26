<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chirps') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('chirps.store') }}">
                        @csrf
                        <div class="mb-4">
                            <x-input-label>Color</x-input-label>
                            <input value="{{ old('color') }}" type="text" name="color" id="color"
                                class="t-1 p-2 w-full border rounded-md shadow-sm
                                dark:bg-gray-800 dark:text-gray-200 placeholder-gray-400"
                                placeholder="Rojo, Azul, Blanco...">
                            <x-input-error :messages="$errors->get('color')" />
                        </div>
                        <div class="mb-4">
                            <x-input-label>Animal</x-input-label>
                            <input value="{{ old('animal') }}" type="text" name="animal" id="animal"
                                class="mt-1 p-2 w-full border rounded-md shadow-sm
                                 dark:bg-gray-800 dark:text-gray-200 placeholder-gray-400"
                                placeholder="Gato, Perro, Gallina...">
                            <x-input-error :messages="$errors->get('animal')" />
                        </div>
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                            @if (session('status') === 'profile-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                            @endif
                            <select id="select2-example" name="select2-example">
                                <option value="1">Opción 1</option>
                                <option value="2">Opción 2</option>
                                <option value="3">Opción 3</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <table id="datatablechirps" class="stripe hover"
                        style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                        <thead>
                            <tr>
                                <th data-priority="1">Name</th>
                                <th data-priority="2">Position</th>
                                <th data-priority="3">Office</th>
                                <th data-priority="4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
<script>
    function inicializarDataTable() {
        var table = $('#datatablechirps').DataTable({
            responsive: true,
            language: {
                url: '{{ asset('js/datatable.spanish.js') }}' // Ruta al archivo de traducción en español
            },
            ajax: {
                url: '{{ route('chirps.show') }}', // Ruta de la solicitud AJAX
                dataSrc: '' // Esto indica que los datos están en la raíz del objeto JSON de respuesta
            },
            columns: [{
                    data: 'id',
                    className: 'text-center align-middle'
                },
                {
                    data: 'color',
                    className: 'text-center align-middle'
                },
                {
                    data: 'animal',
                    className: 'text-center align-middle'
                },
                {
                    // Columna personalizada para los botones
                    data: null,
                    className: 'text-center align-middle',
                    render: function(data, type, row) {
                        return `
                        @can('users.edit')
                        <button onclick="verRegistro(${data.id})" class="btn btn-primary custom-btn">
                            <svg class="h-8 w-8 text-gray-500" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z"/>
                                <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                <line x1="16" y1="5" x2="19" y2="8" />
                            </svg>
                        </button>
                        @endcan
                        <button onclick="editarRegistro(${data.id})" class="btn btn-warning custom-btn">
                            <svg class="h-8 w-8 text-gray-500" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z"/>
                                <circle cx="12" cy="12" r="2" />
                                <path d="M2 12l1.5 2a11 11 0 0 0 17 0l1.5 -2" />
                                <path d="M2 12l1.5 -2a11 11 0 0 1 17 0l1.5 2" />
                            </svg>
                        </button>
                        @can('users.destroy')
                        <button onclick="eliminarRegistro(${data.id})" class="btn btn-danger custom-btn">
                            <svg class="h-8 w-8 text-gray-500" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z"/>
                                <line x1="4" y1="7" x2="20" y2="7" />
                                <line x1="10" y1="11" x2="10" y2="17" />
                                <line x1="14" y1="11" x2="14" y2="17" />
                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                            </svg>
                        </button>
                        @endcan
                        `;
                    }
                }
            ]
        });
    }

    $(document).ready(function() {
        inicializarDataTable();
    });

    function verRegistro(id) {
        // Lógica para ver un registro
        console.log('Ver registro con ID: ' + id);
    }

    function editarRegistro(id) {
        // Lógica para editar un registro
        console.log('Editar registro con ID: ' + id);
    }

    function eliminarRegistro(id) {
        // Lógica para eliminar un registro
        console.log('Eliminar registro con ID: ' + id);
    }



    $(document).ready(function() {
        $('#select2-example').select2();
    });
</script>
