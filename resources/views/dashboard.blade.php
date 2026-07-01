<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-pink-600 leading-tight">
            {{ __('Student Workspace') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Welcome & Role Banner (Pink Theme) -->
            <div class="bg-pink-50 overflow-hidden shadow-md sm:rounded-lg border border-pink-200">
                <div class="p-6 text-pink-900">
                    @role('admin')
                        <div class="p-4 bg-pink-200 text-pink-900 font-extrabold rounded-lg border border-pink-400 shadow-sm flex items-center gap-2">
                            <span>👑</span> Hello, Admin! You have full access to the system.
                        </div>
                    @else
                        <div class="p-4 bg-white text-pink-700 font-bold rounded-lg border border-pink-300 shadow-sm flex items-center gap-2">
                            <span>🌸</span> Hello, Student! Welcome to your tracker.
                        </div>
                    @endrole
                </div>
            </div>

            <!-- Ito yung ginawa mong Student Task Tracker -->
            <div class="shadow-lg rounded-lg overflow-hidden border border-pink-200">
                <livewire:task-manager />
            </div>

        </div>
    </div>
</x-app-layout>