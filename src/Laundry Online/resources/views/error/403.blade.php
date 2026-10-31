@extends('layouts.app')

@section('title', 'Akses Ditolak')

@section('content')
<div class="text-center py-5">
    <h1 class="display-1 fw-bold text-danger">403</h1>
    <h3 class="mb-3">Akses Ditolak</h3>
    <p class="text-muted">Anda tidak memiliki hak akses untuk membuka halaman ini.</p>
    <a href="{{ route('dashboard') }}" class="btn btn-primary mt-3">Kembali ke Beranda</a>
</div>
@endsection