@extends('_template')

@section('content')

    <section id="content-body" class="md:w-[65%] md:mx-auto py-10 px-10 md:px-0 min-h-[60vh]">
        <div class="flex justify-between">
            <h1 class="text-contrastGold text-5xl mb-4">Edit a User</h1>
            <div class="items-end">
            </div>
        </div>
        <form action="{{ route('admin.users.update', $user) }}" method="post">
            @csrf
            @method('PATCH')
            <div>
                <label for="fname" class="block capitalize">first Name</label>
                <input type="text" name="fname" id="fname" value="{{ $user->fname }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div>
                <label for="lname" class="block capitalize">last Name</label>
                <input type="text" name="lname" id="lname" value="{{ $user->lname }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div>
                <label for="email" class="block capitalize">email address</label>
                <input type="text" name="email" id="email" value="{{ $user->email }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div>
                <label for="password" class="block capitalize">password</label>
                <input type="text" name="password" id="password" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div>
                <label for="role" class="block capitalize">role</label>
                <select name="role" id="role" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                    <option value=""></option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ ucwords($role->name) }}</option>
                    @endforeach
                </select>
            </div>
            <input type="submit" value="Update" class="bg-gold mx-auto md:mx-0 hover:bg-darkGold text-black hover:text-white py-3 px-4 decoration-0 flex-nowrap">
        </form>
    </section>
    
@endsection