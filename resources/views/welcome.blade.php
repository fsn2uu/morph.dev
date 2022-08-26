<x-guest-layout>
    
    <section id="hero" class="hidden bg-charcoal md:grid grid-cols-2 relative">
        <div class="overflow-visible z-10 static h-[50vh]">
            <p class="w-[120%] text-white text-7xl z-10 mt-20 pl-5">Make managing vacation rentals as easy as taking a vacation yourself</p>
            <div class="absolute bottom-0 w-full left-0">
                <a href="{{ route('signup') }}" class="py-10 w-1/4 inline-block -mr-[4px] text-center text-black bg-gold border-r border-r-charcoal"><strong>Get Started</strong></a>
                <a href="{{ route('plans') }}" class="py-10 w-1/4 inline-block -mr-[4px] text-center text-black bg-darkGold"><strong>View Pricing Plans</strong></a>
            </div>
        </div>
        <div class="bg-hero z-0 bg-cover bg-bottom bg-fixed bg-no-repeat h-[50vh]"></div>
    </section>
    <section id="mobile-hero" class="md:hidden bg-hero z-10 bg-cover bg-bottom bg-fixed bg-no-repeat p-4 h-[50vh] flex flex-col justify-center relative">
        <p class="text-white text-5xl text-center z-10">Make managing vacation rentals as easy as taking a vacation yourself</p>
        <div class="absolute bottom-0 w-full left-0 z-10">
            <a href="#" class="py-10 w-1/2 inline-block -mr-[4px] text-center text-black bg-gold border-r border-r-charcoal"><strong>Get Started</strong></a>
            <a href="#" class="py-10 w-1/2 inline-block -mr-[4px] text-center text-black bg-darkGold"><strong>View Pricing Plans</strong></a>
        </div>
    </section>
    <section id="content-body" class="md:w-[65%] md:mx-auto py-10 px-10 md:px-0">
        <h1 class="text-contrastGold text-5xl text-center mb-4">Morph your business now!</h1>
        <p class="mb-2">
            Vacation rentals on the Gulf Coast are special, so why trust your listings to a faceless company halfway across the country that doesn't care about your business at all?  
            Morph is based in the Gulf Coast, just like you, and we care whether your business succeeds or not.  After all, we succeed if you do!
        </p>
        <h2 class="text-4xl text-contrastGold text-center mb-4 mt-6">Why Choose Morph?</h2>
        <p class="mb-2">
            It's easy to use!  Morph was built with users in mind that maybe aren't the most tech-savyy.  There aren't a lot of moving parts and buttons to confuse 
            you; just everything where you need it, when you need it.
        </p>
        <p class="mb-2">
            Morph is cost-effective!  We don't charge you fees on top of fees.  It's your money, we just help you make it.  A receipt from Morph is exactly what you expect, without 
            surprises.  And the few fees we do charge are lower than most of the big guys.
        </p>
        <p class="mb-2">
            Everyone gets the same features.  Most larger rental management software companies are very stingy about features, so that only the people and companies who pay them the 
            most get all their features.  Morph wants everyone to get the same toys!  Our fees are based on volume, so there is no feature that you have to pay extra money to have.  
            Instead, you only pay for what you use.
        </p>
    </section>

</x-guest-layout>