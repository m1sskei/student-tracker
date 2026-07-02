<x-app-layout>
    <div class="py-12 bg-pink-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Admin Stats --}}
            @role('admin')
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="bg-white p-6 rounded-lg shadow border-l-4 border-pink-500">
                        <h3 class="font-bold text-pink-700">Pending Tasks</h3>
                        <p class="text-3xl font-bold">{{ $pendingCount }}</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow border-l-4 border-green-500">
                        <h3 class="font-bold text-green-700">Done Tasks</h3>
                        <p class="text-3xl font-bold">{{ $doneCount }}</p>
                    </div>
                </div>
            @endrole

            {{-- Student Add Task Form --}}
            @role('student')
                <div class="bg-white p-6 rounded-lg shadow mb-6 border border-pink-100">
                    <h2 class="font-bold mb-4 text-pink-700">Add New Task</h2>
                    <form action="{{ route('tasks.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @csrf
                        <input type="text" name="title" placeholder="Title" class="border p-2 rounded focus:ring-pink-500" required>
                        <select name="priority" class="border p-2 rounded focus:ring-pink-500">
                            <option value="high">High</option>
                            <option value="medium">Medium</option>
                            <option value="low">Low</option>
                        </select>
                        <input type="date" name="due_date" class="border p-2 rounded focus:ring-pink-500" required>
                        <input type="text" name="description" placeholder="Description" class="border p-2 rounded md:col-span-2">
                        <button class="bg-pink-600 text-white p-2 rounded col-span-2 hover:bg-pink-700">Save Task</button>
                    </form>
                </div>
            @endrole

            {{-- Task List --}}
            <div class="bg-white p-6 rounded-lg shadow border-t-4 border-pink-500">
                <h2 class="font-bold mb-4 text-pink-700">Task List</h2>
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b">
                            <th class="p-2">Title</th>
                            @role('admin')<th class="p-2">Student</th>@endrole
                            <th class="p-2">Priority</th>
                            <th class="p-2">Due</th>
                            <th class="p-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                        <tr class="border-b {{ $task->status === 'done' ? 'bg-gray-50' : '' }}">
                            <td class="p-2 {{ $task->status === 'done' ? 'line-through text-gray-500' : '' }}">{{ $task->title }}</td>
                            @role('admin') <td class="p-2 text-pink-600 font-semibold">{{ $task->user->name ?? 'N/A' }}</td> @endrole
                            <td class="p-2">{{ $task->priority }}</td>
                            <td class="p-2">{{ $task->due_date }}</td>
                            <td class="p-2 flex gap-4">
                                {{-- Status Toggle --}}
                                <form action="{{ route('tasks.status', $task->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button class="text-sm font-bold {{ $task->status === 'done' ? 'text-green-600' : 'text-gray-400' }}">
                                        {{ $task->status === 'done' ? '✓ Done' : 'Mark Done' }}
                                    </button>
                                </form>
                                
                                @role('admin')
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="text-blue-500 underline text-sm">Edit</a>
                                @endrole
                                
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button class="text-red-500 underline text-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>