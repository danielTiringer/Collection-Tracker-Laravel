@if(session()->has('success'))
    <div
        class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-48 py-3"
        x-data="{show: true}"
        x-init="setTimeout(() => show = false, 3000)"
        x-show="show"
    >
        <p>
            {{ session('success') }}
        </p>
    </div>
@elseif(session()->has('error'))
    <div class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-red-500 text-white px-48 py-3">
        <p>
            {{ session('error') }}
        </p>
    </div>
@endif
