<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <form method="POST" action="{{ $verb == 'Create' ? route('admin.tasks.store') : route('admin.tasks.update', $task) }}">
                    @csrf
                    @if ($verb == 'Edit')
                        @method('PATCH')
                    @endif
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 font-bold mb-2">Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title') ?: (@$task->title ?: '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('title')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="start_date" class="block text-gray-700 font-bold mb-2">Start Date</label>
                        <input type="date" name="start_date" id="start_date" value="{{ old('start_date') ?: (@$task->start_date ?: '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('start_date')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="end_date" class="block text-gray-700 font-bold mb-2">End Date</label>
                        <input type="date" name="end_date" id="end_date" {{ old('end_date') ?: (@$task->end_date ?: '') }} class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('end_date')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="neighborhood_id" class="block text-gray-700 font-bold mb-2">Neighborhood</label>
                        <select name="neighborhood_id" id="neighborhood_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value=""></option>
                            @foreach ($neighborhoods as $neighborhood)
                                <option value="{{ $neighborhood->id }}" {{ old('neighborhood_id') == $neighborhood->id ? 'selected' : (@$task->neighborhood_id == $neighborhood->id ? 'selected' : '') }}>{{ $neighborhood->name }}</option>
                            @endforeach
                        </select>
                        @error('neighborhood_id')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="unit_id" class="block text-gray-700 font-bold mb-2">Unit</label>
                        <select name="unit_id" id="unit_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value=""></option>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}" {{ old('unit_id') == $unit->id ? 'selected' : (@$task->unit_id == $unit->id ? 'selected' : '') }}>{{ $unit->name }}</option>
                            @endforeach
                        </select>
                        @error('unit_id')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 font-bold mb-2">Description</label>
                        <textarea name="description" id="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('description') ?: (@$task->description ?: '') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="status" class="block text-gray-700 font-bold mb-2">Status</label>
                        <select name="status" id="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                          <option value="scheduled" {{ old('status') == 'scheduled' ? 'selected' : (@$task->status == 'scheduled' ? 'selected' : '') }}>Scheduled</option>
                          <option value="in progress" {{ old('status') == 'in progress' ? 'selected' : (@$task->status == 'in progress' ? 'selected' : '') }}>In Progress</option>
                          <option value="completed" {{ old('status') == 'completed' ? 'selected' : (@$task->status == 'completed' ? 'selected' : '') }}>Completed</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex items-center justify-start mt-4">
                        <button class="bg-gold mx-auto md:mx-0 hover:bg-darkGold text-black hover:text-white py-3 px-4 decoration-0 flex-nowrap" type="submit">
                            {{ $verb }} Task
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>