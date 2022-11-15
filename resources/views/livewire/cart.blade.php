<div class="d-flex align-items-center">
    <span class="badge bg-primary">{{ $cart->amount() }}</span>
    <a href="{{ route('checkout') }}" class="nav-link"><i class="fa-solid fa-cart-shopping"></i></a>
</div>
