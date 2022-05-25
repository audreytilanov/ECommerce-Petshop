<form wire:submit.prevent="addToCart({{ $dataId }})" action="{{ route('user.home') }}" method="post">
    @csrf
    <button type="submit" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
</form>