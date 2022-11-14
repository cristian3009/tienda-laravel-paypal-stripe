<div>
    <div class="container">
        <div class="row mt-4">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="{{ Storage::url($product->thumbnail) }}" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h1>{{ $product->name }}</h1>
                        <h2 class="mt-3">${{ $product->price }} <sup>00</sup></h2>
                        <p class="mt-4">{{ $product->description }}</p>
                        <div class="text-end">
                            <button class="btn btn-outline-primary">Add to cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
