<x-guest-layout>

    <section id="content-body" class="md:w-[65%] md:mx-auto py-10 px-10 md:px-0">
        <h1 class="text-contrastGold text-5xl text-center mb-4">Have Questions? Send it to us!</h1>
        <form action="" method="post">
            @csrf
            <div class="flex flex-wrap">
                <label for="name" class="block mb-5 w-full md:w-1/2 md:pr-2">Name
                    <input type="text" name="name" id="name" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </label>
                <label for="email" class="block mb-5 w-full md:w-1/2 md:pl-2">Email
                    <input type="text" name="email" id="email" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </label>
                <label for="comment" class="block mb-5 w-full">Comment / Question:
                    <textarea name="comment" id="comment" rows="10" class="shadow appearance-none border border-ccc mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                </label>
                <span class="block w-full">
                    <input type="submit" value="Send" class="nav bg-gold hover:bg-darkGold text-black hover:text-white py-3 px-4 decoration-0 flex-nowrap">
                </span>
            </div>
        </form>
        <p class="mb-4 mt-4">
            If you are an existing user that requires support, please do not use this form.  Log into your control panel and open a support ticket instead for a faster 
            response.
        </p>
    </section>
    
</x-guest-layout>