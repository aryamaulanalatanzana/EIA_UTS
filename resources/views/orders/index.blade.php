@extends('layouts.app')

@section('content')
<div class="container">
    {{-- Flash Message --}}
    {{-- @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif --}}

    {{-- Create Order Form --}}
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h4>Create New Order</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('orders.store') }}" method="POST" id="orderForm">
                @csrf
                <div class="form-group">
                    <label for="user_id">Pilih User</label>
                    <!-- User Name Input Field -->
                    <input type="text" id="user_name" name="user_name" class="form-control" placeholder="Masukkan Nama Pengguna" required>
                    <!-- Hidden User ID Field -->
                    <input type="hidden" id="user_id" name="user_id" required>
                    <ul id="user-list" class="list-group" style="display:none;"></ul>
                </div>

                <div class="form-group">
                    <label>Produk</label>
                    @foreach ($products as $product)
                        <div class="form-row align-items-center mb-2">
                            <div class="col-md-6">
                                <label>
                                    <input type="checkbox" class="item-check" data-price="{{ $product['price'] }}"
                                           name="items[{{ $product['id'] }}][product_id]"
                                           value="{{ $product['id'] }}">
                                    {{ $product['name'] }} - Rp{{ number_format($product['price'], 0, ',', '.') }}
                                </label>
                            </div>
                            <div class="col-md-4">
                                <input type="number" class="form-control quantity" name="items[{{ $product['id'] }}][quantity]"
                                       value="1" min="1" disabled>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="form-group">
                    <label for="total_price">Total Harga</label>
                    <input type="number" id="total_price" name="total_price" class="form-control" readonly required>
                </div>

                <button type="submit" class="btn btn-success">Create Order</button>
            </form>
        </div>
    </div>

    {{-- List Orders --}}
    <div class="card">
        <div class="card-header bg-dark text-white">
            <h4>Daftar Order</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Order ID</th>
                        <th>User</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order['id'] }}</td>
                            <td>{{ $order['user_id'] }}</td>
                            <td>{{ $order['status'] }}</td>
                            <td>Rp{{ number_format($order['total_price'], 0, ',', '.') }}</td>
                            <td>
                                {{-- Update Status --}}
                                <form action="{{ route('orders.update', $order['id']) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="form-control d-inline w-auto">
                                        <option value="pending" {{ $order['status'] == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="processing" {{ $order['status'] == 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="completed" {{ $order['status'] == 'completed' ? 'selected' : '' }}>Completed</option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-warning">Update</button>
                                </form>

                                {{-- Delete Order --}}
                                <form action="{{ route('orders.destroy', $order['id']) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Script untuk total_price otomatis --}}
<script>
    const checkboxes = document.querySelectorAll('.item-check');
    const quantities = document.querySelectorAll('.quantity');
    const totalPriceInput = document.getElementById('total_price');

    function calculateTotal() {
        let total = 0;
        checkboxes.forEach((cb, i) => {
            const qtyInput = quantities[i];
            const price = parseFloat(cb.dataset.price);

            if (cb.checked) {
                qtyInput.disabled = false;
                const qty = parseInt(qtyInput.value) || 1;
                total += price * qty;
            } else {
                qtyInput.disabled = true;
                qtyInput.value = 1;
            }
        });
        totalPriceInput.value = total;
    }

    checkboxes.forEach(cb => cb.addEventListener('change', calculateTotal));
    quantities.forEach(qty => qty.addEventListener('input', calculateTotal));

    // Autocomplete User Name Search
    const userNameInput = document.getElementById('user_name');
    const userList = document.getElementById('user-list');

    userNameInput.addEventListener('input', async function () {
        const query = userNameInput.value;
        if (query.length < 2) {
            userList.style.display = 'none';
            return;
        }

        const response = await fetch('/api/users/search?q=' + query); // Assuming you have an API for searching users
        const users = await response.json();

        if (users.length > 0) {
            userList.innerHTML = '';
            users.forEach(user => {
                const li = document.createElement('li');
                li.classList.add('list-group-item');
                li.textContent = user.name;
                li.addEventListener('click', () => {
                    userNameInput.value = user.name;
                    document.getElementById('user_id').value = user.id;
                    userList.style.display = 'none';
                });
                userList.appendChild(li);
            });
            userList.style.display = 'block';
        } else {
            userList.style.display = 'none';
        }
    });

    document.addEventListener('click', function (e) {
        if (!userList.contains(e.target) && e.target !== userNameInput) {
            userList.style.display = 'none';
        }
    });
</script>
@endsection
