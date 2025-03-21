



<div class="row">
    @foreach ($menuItems as $item)
    <div class="col-sm-6 col-lg-4 mb-4">
        <div class="card">

        <img 
    src="{{ asset('uploads/menuItem/' . ($item->images->first() ? $item->images->first()->image : '')) }}" 
    onerror="this.onerror=null; this.src='{{ asset('uploads/menuItem/5962f79bda939330912dd96df0971db7.jpg') }}';" 
    class="card-img-top" 
    alt="{{ $item->name }}">
    <div class="card-body">
                <h5 class="card-title">{{ $item->name }}</h5>
                <p class="card-text">{{ $item->description }}</p>
                <div class="menu-rating">
                    @for ($i = 0; $i < $item->rating; $i++)
                        ★
                    @endfor
                    @for ($i = $item->rating; $i < 5; $i++)
                        ☆
                    @endfor
                </div>
                <div class="menu-price">${{ number_format($item->price, 2) }}</div>

                <!-- <a href="#" class="btn btn-danger mt-2">Order Now</a> -->
            </div>
        </div>
    </div>
    @endforeach
</div>
