@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Daftar Pembayaran</h2>
        </div>
        <div class="card-body">
            <!-- Form untuk menambahkan pembayaran -->
            <form action="{{ route('payments.store') }}" method="POST" class="mb-4">
                @csrf
                <div class="form-group">
                    <label for="user_id">User ID</label>
                    <input type="text" class="form-control" id="user_id" name="user_id" placeholder="User ID" required>
                </div>
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="text" class="form-control" id="amount" name="amount" placeholder="Amount" required>
                </div>
                <div class="form-group">
                    <label for="currency">Currency</label>
                    <input type="text" class="form-control" id="currency" name="currency" placeholder="Currency" required>
                </div>
                <div class="form-group">
                    <label for="method">Payment Method</label>
                    <input type="text" class="form-control" id="method" name="method" placeholder="Payment Method" required>
                </div>
                <div class="form-group">
                    <label for="transaction_id">Transaction ID</label>
                    <input type="text" class="form-control" id="transaction_id" name="transaction_id" placeholder="Transaction ID" required>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Pembayaran</button>
            </form>

            <!-- Tabel daftar pembayaran -->
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Payment ID</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                        <tr>
                            <td>{{ $payment['id'] }}</td>
                            <td>{{ $payment['status'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
