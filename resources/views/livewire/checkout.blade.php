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
            <div class="col-sm-5">
                <div class="card">
                    <div class="card-body">
                        @include('stripe.stripe')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script type="text/javascript">

        var stripe = Stripe("{{ $stripeKey }}");

        var elements = stripe.elements();

        var card = elements.create('card', {
            hidePostalCode: true,
            style: {
                base: {
                    iconColor: '#666EE8',
                    color: '#31325F',
                    lineHeight: '40px',
                    fontWeight: 300,
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSize: '15px',
                    '::placeholder': {
                        color: '#CFD7E0',
                    },
                },
            }
        });

        card.mount('#card-element');

        card.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        var form = document.getElementById('payment-form');

        form.addEventListener('submit', function(event) {
            event.preventDefault();
            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    stripeTokenHandler(result.token);
                }
            });
        });

        function stripeTokenHandler(token) {
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
            form.submit();
        }
    </script>
@endpush
