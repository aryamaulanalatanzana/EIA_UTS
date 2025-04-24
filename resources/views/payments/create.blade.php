@extends('layouts.app')

@section('content')
    <h2>Tambah Pembayaran</h2>

    <form action="{{ url('/payments') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="user_id" class="form-label">User ID</label>
            <input type="text" class="form-control" id="user_id" name="user_id">
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" class="form-control" id="amount" name="amount">
        </div>
        <div class="mb-3">
            <label for="currency" class="form-label">Currency</label>
            <input type="text" class="form-control" id="currency" name="currency" maxlength="3">
        </div>
        <div class="mb-3">
            <label for="method" class="form-label">Method</label>
            <input type="text" class="form-control" id="method" name="method">
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <input type="text" class="form-control" id="status" name="status">
        </div>

        <button type="submit" class="btn btn-primary">Create Payment</button>
    </form>
@endsection
