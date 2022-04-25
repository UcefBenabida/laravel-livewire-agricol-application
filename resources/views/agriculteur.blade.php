<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agriculteurs') }}
        </h2>
    </x-slot>

    @section('style-links')
        <style>
            .nav-bar{
            background-color: rgb(163 230 53);
        }
        .inp-crud{
            width: 19%;
            margin-left: 7px;
        }
        .row-crud{
            align-items: center;
        }
        .label-crud{
            margin-left: 7px;
            text-align: center;
            width: 19%;
            display: inline-block;
        }
        .create-crud-text{
            text-align: center;
            font-size: 18px;
            width: 100%;
        }
        .btn-crud{
            width: 24%;
            margin-left: 7px;
            background-color: rgb(177, 228, 36);
            align-self: center;
            border-radius: 15px 15px 15px 15px ;
        }
        </style>
    @endsection

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @can('isAdmin')
                        @livewire('universal-create-crud')
                    @elsecan('isEditor')
                        @livewire('universal-create-crud')
                    @endcan

                        <livewire:agriculteur-table />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>