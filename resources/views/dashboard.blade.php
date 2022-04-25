<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @section('style-links')
    <link rel="stylesheet" href="/../materialize/css/materialize.css">
        <style>
             button.mr-btn{
                margin-top: 20px;
                margin-left: 34px;
                margin-right: 34px;
            }

            .row{
                margin: 5px;
                padding: 10px;
            }
            .nav-bar{
                background-color: rgb(163 230 53);
            }
        </style>
    @endsection

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    

                    <div class="center-align z-depth-1 bg-pink-500" style="padding: 10px; font-size: 28px; ">suggestions</div>
                    <div class="center-align">
                        @livewire('agriculteurs-list')
                    </div>
                        
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
