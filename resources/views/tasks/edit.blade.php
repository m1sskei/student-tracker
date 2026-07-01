<x-app-layout>
    <div class="py-12 bg-pink-50 min-h-screen">
        <div class="max-w-xl mx-auto bg-white p-6 rounded shadow border-t-4 border-pink-500">
            <h2 class="font-bold text-lg mb-4 text-pink-700">Edit Task</h2>
            <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="mb-4">
                    <label class="block text-sm">Title</label>
                    <input type="text" name="title" value="{{ $task->title }}" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm">Priority</label>
                    <select name="priority" class="border p-2 w-full rounded">
                        <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High</option>
                        <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm">Due Date</label>
                    <input type="date" name="due_date" value="{{ $task->due_date }}" class="border p-2 w-full rounded" required>
                </div>
                <button class="bg-pink-600 text-white p-2 w-full rounded hover:bg-pink-700">Update Task</button>
            </form>
        </div>
    </div>
</x-app-layout>