<div class="min-h-screen bg-pink-50 p-6">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-3xl shadow-lg border-2 border-pink-100">
        <h2 class="text-3xl font-extrabold text-pink-500 mb-6 text-center">🎀 Student Task Tracker</h2>

        @if (session()->has('message'))
            <div class="bg-pink-100 text-pink-700 p-3 rounded-lg mb-4 text-center font-bold text-sm">
                {{ session('message') }}
            </div>
        @endif

        <form wire:submit="saveTask" class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
            <div class="md:col-span-2">
                <label class="block text-black font-bold mb-1 ml-1 text-sm">What will you do?</label>
                <input type="text" wire:model="title" class="w-full p-3 border-2 border-pink-200 rounded-xl text-black bg-white">
                @error('title') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>
            
            <div>
                <label class="block text-black font-bold mb-1 ml-1 text-sm">Due Date</label>
                <input type="date" wire:model="due_date" class="w-full p-3 border-2 border-pink-200 rounded-xl text-black bg-white">
                @error('due_date') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-2">
                <label class="block text-black font-bold mb-1 ml-1 text-sm">Description</label>
                <textarea wire:model="description" class="w-full p-3 border-2 border-pink-200 rounded-xl text-black bg-white"></textarea>
            </div>

            <button type="submit" class="md:col-span-2 bg-pink-400 text-white font-bold py-3 rounded-xl hover:bg-pink-500 transition">
                {{ $isEditMode ? 'Update Task ✨' : 'Add Task 🎀' }}
            </button>
        </form>

        <div class="overflow-y-auto max-h-96 border-2 border-pink-100 rounded-2xl">
            <table class="w-full text-left">
                <thead class="bg-pink-100 sticky top-0">
                    <tr>
                        <th class="p-4 text-pink-600">Task</th>
                        <th class="p-4 text-pink-600">Due Date</th>
                        <th class="p-4 text-pink-600">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-pink-100">
                    @foreach($tasks as $task)
                        <tr class="{{ $task->is_completed ? 'bg-green-100' : 'bg-white' }}">
                            <td class="p-4">
                                <p class="font-bold text-black {{ $task->is_completed ? 'line-through' : '' }}">{{ $task->title }}</p>
                                <p class="text-xs text-gray-600">{{ $task->description }}</p>
                            </td>
                            <td class="p-4 text-sm text-gray-700">{{ $task->due_date }}</td>
                            <td class="p-4 flex gap-2">
                                <button wire:click="toggleComplete({{ $task->id }})" class="text-green-600 font-bold hover:underline">✓</button>
                                <button wire:click="editTask({{ $task->id }})" class="text-blue-500 font-bold hover:underline">Edit</button>
                                <button wire:click="deleteTask({{ $task->id }})" class="text-red-500 font-bold hover:underline">✕</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>