@extends('layouts.dashboard')

@section('title', 'Profil Admin')

@section('content')
<div style="max-width:480px;margin:2.5rem auto 0 auto;">
  <div style="background:#fff;border-radius:14px;box-shadow:0 2px 10px rgba(0,0,0,0.06);padding:2rem 2rem 1.5rem 2rem;">
    <h2 style="font-size:1.3rem;font-weight:700;color:#1f2937;margin-bottom:1.2rem;display:flex;align-items:center;gap:0.7em;">
      <i class="fa-solid fa-user-circle" style="color:#2dd4bf;font-size:1.2em;"></i> Profil Admin
    </h2>
    @if(session('success'))
      <div style="background:#e8f5e9;color:#166534;padding:10px 16px;border-radius:7px;margin-bottom:1rem;font-size:0.98em;">{{ session('success') }}</div>
    @endif
    @if($errors->any())
      <div style="background:#fee2e2;color:#b91c1c;padding:10px 16px;border-radius:7px;margin-bottom:1rem;font-size:0.98em;">
        <ul style="margin:0;padding-left:1.2em;">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <form method="POST" action="{{ route('admin.profile.update') }}" autocomplete="off">
      @csrf
      <div style="margin-bottom:1.1rem;">
        <label for="name" style="font-weight:600;font-size:0.98em;color:#374151;">Nama</label>
        <input type="text" id="name" name="name" value="{{ old('name', $admin->name ?? '') }}" required style="width:100%;padding:10px 12px;border:1px solid #e5e7eb;border-radius:7px;font-size:1em;margin-top:4px;">
      </div>
      <div style="margin-bottom:1.1rem;">
        <label for="email" style="font-weight:600;font-size:0.98em;color:#374151;">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email', $admin->email ?? '') }}" required style="width:100%;padding:10px 12px;border:1px solid #e5e7eb;border-radius:7px;font-size:1em;margin-top:4px;">
      </div>
      <div style="margin-bottom:1.1rem;">
        <label for="password" style="font-weight:600;font-size:0.98em;color:#374151;">Password Baru <span style="font-weight:400;color:#6b7280;font-size:0.95em;">(kosongkan jika tidak ingin ganti)</span></label>
        <input type="password" id="password" name="password" style="width:100%;padding:10px 12px;border:1px solid #e5e7eb;border-radius:7px;font-size:1em;margin-top:4px;">
      </div>
      <div style="margin-top:1.7rem;display:flex;justify-content:flex-end;">
        <button type="submit" style="background:#2dd4bf;color:#fff;font-weight:700;font-size:1.05em;padding:10px 28px;border:none;border-radius:7px;cursor:pointer;transition:background 0.18s;">Simpan</button>
      </div>
    </form>
  </div>
</div>
@endsection 