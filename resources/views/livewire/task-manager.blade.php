<div class="min-h-screen bg-pink-50 p-6">
    <div class="max-w-6xl mx-auto bg-white p-8 rounded-3xl shadow-lg border-2 border-pink-100">
        
        @if(Auth::user()->hasRole('admin'))
            <h2 class="text-4xl font-extrabold text-pink-600 mb-8 text-center">👑 Admin Monitoring Panel</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="bg-pink-100 p-6 rounded-2xl border border-pink-200 text-center shadow-sm">
                    <h3 class="text-pink-600 font-bold text-lg uppercase tracking-wider">Total Tasks</h3>
                    <p class="text-5xl font-extrabold text-pink-800 mt-2">{{ $tasks->count() }}</p>
                </div>
                <div class="bg-green-100 p-6 rounded-2xl border border-green-200 text-center shadow-sm">
                    <h3 class="text-green-600 font-bold text-lg uppercase tracking-wider">Completed</h3>
                    <p class="text-5xl font-extrabold text-green-800 mt-2">{{ $tasks->where('is_completed', 1)->count() }}</p>
                </div>
                <div class="bg-orange-100 p-6 rounded-2xl border border-orange-200 text-center shadow-sm">
                    <h3 class="text-orange-600 font-bold text-lg uppercase tracking-wider">Pending</h3>
                    <p class="text-5xl font-extrabold text-orange-800 mt-2">{{ $tasks->where('is_completed', 0)->count() }}</p>
                </div>
            </div>
        @else
            <h2 class="text-4xl font-extrabold text-pink-600 mb-8 text-center">🎀 Student Task Tracker</h2>
            
            <form wire:submit="saveTask" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8 bg-pink-50 p-6 rounded-2xl border border-pink-200">
                <div class="col-span-1">
                    <input type="text" wire:model="title" placeholder="Title" class="w-full p-3 border-2 @error('title') border-red-500 @else border-pink-200 @enderror rounded-xl text-black">
                    @error('title') <span class="text-red-600 text-xs font-bold">Required</span> @enderror
                </div>
                
                <div class="col-span-1">
                    <input type="date" wire:model="due_date" min="1000-01-01" max="9999-12-31" class="w-full p-3 border-2 @error('due_date') border-red-500 @else border-pink-200 @enderror rounded-xl text-black">
                    @error('due_date') <span class="text-red-600 text-xs font-bold">Invalid Date</span> @enderror
                </div>
                
                <div class="col-span-1">
                    <select wire:model="priority" class="w-full p-3 border-2 @error('priority') border-red-500 @else border-pink-200 @enderror rounded-xl text-black">
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>
                    </select>
                    @error('priority') <span class="text-red-600 text-xs font-bold">Required</span> @enderror
                </div>
                
                <button class="bg-pink-400 text-white font-bold py-3 rounded-xl hover:bg-pink-500 transition shadow-md">
                    {{ $isEditMode ? 'Update' : 'Add Task' }}
                </button>
                
                <div class="col-span-1 md:col-span-4">
                    <textarea wire:model="description" placeholder="Description..." class="w-full p-3 border-2 @error('description') border-red-500 @else border-pink-200 @enderror rounded-xl text-black"></textarea>
                    @error('description') <span class="text-red-600 text-xs font-bold">Required</span> @enderror
                </div>
            </form>
        @endif

        <div class="overflow-x-auto border-2 border-pink-100 rounded-2xl">
            <table class="w-full text-center border-collapse">
                <thead class="bg-pink-100 text-black">
                    <tr>
                        @if(Auth::user()->hasRole('admin'))
                            <th class="p-4 border-b font-extrabold text-pink-700">Student Name</th>
                        @endif
                        <th class="p-4 border-b">Task</th>
                        <th class="p-4 border-b">Description</th>
                        <th class="p-4 border-b">Due Date</th>
                        <th class="p-4 border-b">Priority</th>
                        <th class="p-4 border-b">Options</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-pink-100">
                    @foreach($tasks as $task)
                        <tr class="{{ $task->is_completed ? 'bg-green-100' : 'bg-white' }}">
                            
                            @if(Auth::user()->hasRole('admin'))
                                <td class="p-4 border-b font-bold text-pink-800 bg-pink-50">
                                    {{ $task->user ? $task->user->name : 'N/A' }}
                                </td>
                            @endif

                            <td class="p-4 border-b font-bold text-black {{ $task->is_completed ? 'line-through' : '' }}">{{ $task->title }}</td>
                            <td class="p-4 border-b text-black">{{ $task->description }}</td>
                            <td class="p-4 border-b text-black">{{ $task->due_date }}</td>
                            <td class="p-4 border-b font-bold {{ $task->priority == 'High' ? 'text-red-600' : ($task->priority == 'Medium' ? 'text-orange-500' : 'text-blue-600') }}">
                                {{ $task->priority }}
                            </td>
                            <td class="p-4 border-b">
                                <select wire:change="handleAction($event.target.value, {{ $task->id }})" 
                                    class="bg-pink-50 border-2 border-pink-200 rounded-lg p-2 text-black font-bold cursor-pointer">
                                    <option value="">•••</option>
                                    <option value="done" class="text-green-600 font-bold">Done/Undo</option>
                                    <option value="edit" class="text-blue-500 font-bold">Edit</option>
                                    <option value="delete" class="text-red-500 font-bold">Delete</option>
                                </select>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>