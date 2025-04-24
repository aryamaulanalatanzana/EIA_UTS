@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Tambah Order</h2>
        </div>
        <div class="card-body">
            <!-- Form untuk menambahkan order -->
            <form action="{{ route('orders.store') }}" method="POST" id="orderForm">
                @csrf

                <!-- User Select -->
                <div class="form-group">
                    <label for="user_id">User</label>
                    <select name="user_id" id="user_id" class="form-control" required>
                        <option value="">Pilih User</option>
                        @foreach ($users as $user)
                            <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Produk Select -->
                <div class="form-group">
                    <label for="items">Produk</label>
                    <div id="product-list">
                        @foreach ($products as $product)
                            <div class="product-item mb-2">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input item-check" data-price="{{ $product['price'] }}" data-product-id="{{ $product['id'] }}" id="product-{{ $product['id'] }}">
                                    <label class="form-check-label" for="product-{{ $product['id'] }}">
                                        {{ $product['name'] }} - Rp{{ number_format($product['price'], 0, ',', '.') }}
                                    </label>
                                    <input type="number" class="form-control quantity" name="items[{{ $product['id'] }}][quantity]" value="1" min="1" disabled>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Total Price -->
                <div class="form-group">
                    <label for="total_price">Total Price</label>
                    <input type="number" class="form-control" id="total_price" name="total_price" placeholder="Total Price" required readonly>
                </div>

                <button type="submit" class="btn btn-primary">Create Order</button>
            </form>
        </div>
    </div>

    <script>
        // Function to calculate total price based on selected products
        document.querySelectorAll('.item-check').forEach(function(checkbox) {
            checkbox.addEventListener('change', updateTotalPrice);
        });

        document.querySelectorAll('.quantity').forEach(function(quantityInput) {
            quantityInput.addEventListener('input', updateTotalPrice);
        });

        function updateTotalPrice() {
            let totalPrice = 0;
            document.querySelectorAll('.item-check').forEach(function(checkbox) {
                const price = parseFloat(checkbox.dataset.price);
                const quantityInput = checkbox.closest('.product-item').querySelector('.quantity');
                const quantity = parseInt(quantityInput.value) || 1;

                if (checkbox.checked) {
                    totalPrice += price * quantity;
                    quantityInput.disabled = false;
                } else {
                    quantityInput.disabled = true;
                    quantityInput.value = 1;
                }
            });

            document.getElementById('total_price').value = totalPrice;
        }
    </script>
@endsection
