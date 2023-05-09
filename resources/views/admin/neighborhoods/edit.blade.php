@extends('_template')

@section('content')

    <section id="content-body" class="md:w-[65%] md:mx-auto py-10 px-10 md:px-0 min-h-[60vh]">
        <div class="flex justify-between">
            <h1 class="text-contrastGold text-5xl mb-4">Edit a Neighborhood</h1>
            <div class="items-end">
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6 mb-10">
            <div class="mb-4">
                <div class="container mx-auto px-4">
                    <nav class="-mb-px flex">
                        <a id="info-tab" href="#" class="no-underline rounded-t-lg bg-white inline-block border-l border-t border-r py-2 px-4 text-blue-700 font-semibold" onclick="openTab(event, 'info')">Information</a>
                        <a id="pictures-tab" href="#" class="no-underline rounded-t-lg bg-white inline-block py-2 px-4 text-blue-700 font-semibold" onclick="openTab(event, 'pictures')">Pictures</a>
                        <a id="units-tab" href="#" class="no-underline rounded-t-lg bg-white inline-block py-2 px-4 text-blue-700 font-semibold" onclick="openTab(event, 'units')">Units</a>
                        <a id="amenities-tab" href="#" class="no-underline rounded-t-lg bg-white inline-block border-l py-2 px-4 text-blue-700 font-semibold" onclick="openTab(event, 'amenities')">Amenities</a>
                    </nav>
                </div>
            </div>
            <div class="container mx-auto px-4 py-6">
                <div id="info" class="tab-content">
                    @include('admin.neighborhoods._parts.form')
                </div>
                <div id="pictures" class="tab-content hidden">
                    @include('admin.neighborhoods._parts.pictures')
                </div>
                <div id="units" class="tab-content hidden">
                    @include('admin.units._parts.table')
                </div>
                <div id="amenities" class="tab-content hidden">
                    @include('admin.neighborhoods._parts.amenities')
                </div>
            </div>
        </div>
        
    </section>
    
@endsection

@push('scripts')
    <script>
        function openTab(event, tabName) {
            var i, tabContent, tabLinks;
            tabContent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabContent.length; i++) {
                tabContent[i].style.display = "none";
            }
            tabLinks = document.getElementsByClassName("tab-link");
            for (i = 0; i < tabLinks.length; i++) {
                tabLinks[i].classList.remove("border-blue-700");
                tabLinks[i].classList.remove("bg-white");
            }
            document.getElementById(tabName).style.display = "block";
            event.currentTarget.classList.add("border-blue-700");
            event.currentTarget.classList.add("bg-white");
        }

        // Show the first tab by default
        document.getElementById("info-tab").click();
    </script>
@endpush