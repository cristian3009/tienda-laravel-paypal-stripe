<div>
    <div class="container">
        <h2 class="text-center mb-4 mt-3">Products overview</h2>

        @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-sm-7">
                <div class="card">
                    <div class="card-body">
                        <table class="table text-center table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>
                                            {{ $product->id }}
                                        </td>
                                        <td>
                                            {{ $product->name }}
                                        </td>
                                        <td>
                                            <button class="btn btn-danger" wire:click="deleteProduct('{{ $product->pivot->id }}')">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach

                                <tr>
                                    <th></th>
                                    <td class="fw-bold">Total:</td>
                                    <td class="fw-bold">${{ $products->sum('price') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
