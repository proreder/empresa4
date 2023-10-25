<div class="container-fluid d-flex justify-content-center align-items-center" style="height:100vh; overflow:hidden; border: 2px solid red">
    <div class="row d-flex mx-auto vh-50 bg-info p-5 rounded-5 justify-content-center align-items-center vh-50 font-sans text-gray-900 antialiased" style="width: 25rem">
        
            <div class="d-flex  justify-content-center">
                {{ $logo }}
            </div>

            <div class="d-flex justify-content-center">
                {{ $slot }}
            </div>
    </div>
</div>
