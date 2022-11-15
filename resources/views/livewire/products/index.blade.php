<div>
    <h1 class="text-center">Products</h1>
    <div class="container">

        @if(session()->has('message'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            @foreach($products as $product)
                <div class="col-sm-3 mb-4">
                    <div class="card">
                        <a href="{{ route('products.show', ['product' => $product->slug]) }}">
                            <img class="card-img-top" src="{{ Storage::url($product->thumbnail) }}" alt="{{ $product->name }}">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $product->price }} <sup>00</sup> </h5>
                            <p><span>12x $ 10.75 no interest</span></p>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-outline-primary" wire:click="addToCart('{{ $product->slug }}')">Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
