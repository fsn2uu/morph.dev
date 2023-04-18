<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <form action="{{ $verb == 'Create' ? route('admin.users.store') : route('admin.users.update', $user) }}" method="post">
                    @csrf
                    <div>
                        <label for="fname" class="block capitalize">first Name</label>
                        <input type="text" name="fname" id="fname" value="{{ old('fname') ?: (@$user->fname ?: '') }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                        @error('fname')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="lname" class="block capitalize">last Name</label>
                        <input type="text" name="lname" id="lname" value="{{ old('lname') ?: (@$user->lname ?: '') }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                        @error('lname')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="block capitalize">email address</label>
                        <input type="text" name="email" id="email" value="{{ old('email') ?: (@$user->email ?: '') }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                        @error('email')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="password" class="block capitalize">password</label>
                        <input type="text" name="password" id="password" value="{{ old('password') ?: '' }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                        @error('password')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="role" class="block capitalize">role</label>
                        <select name="role" id="role" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                            <option value=""></option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>{{ ucwords($role->name) }}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <input type="submit" value="{{ $verb }} User" class="bg-gold mx-auto md:mx-0 hover:bg-darkGold text-black hover:text-white py-3 px-4 decoration-0 flex-nowrap">
                </form>
            </div>
        </div>
    </div>
</div>