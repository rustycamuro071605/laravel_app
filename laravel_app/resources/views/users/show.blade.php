@extends('layouts.app')

@section('content')
<div class="container-scroller">
  <!-- partial:partials/_sidebar.html -->
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
      <a class="sidebar-brand brand-logo" href="{{ route('dashboard') }}"><img src="{{ asset('assets/images/logo.svg') }}" alt="logo" /></a>
      <a class="sidebar-brand brand-logo-mini" href="{{ route('dashboard') }}"><img src="{{ asset('assets/images/logo-mini.svg') }}" alt="logo" /></a>
    </div>
    <ul class="nav">
      <li class="nav-item profile">
        <div class="profile-desc">
          <div class="profile-pic">
            <div class="count-indicator">
              <img class="img-xs rounded-circle" src="{{ asset('assets/images/faces/face15.jpg') }}" alt="">
              <span class="count bg-success"></span>
            </div>
            <div class="profile-name">
              <h5 class="mb-0 font-weight-normal">Arruginito</h5>
              <span>Administrator</span>
            </div>
          </div>
        </div>
      </li>
      <li class="nav-item nav-category">
        <span class="nav-link">Navigation</span>
      </li>
      <li class="nav-item menu-items">
        <a class="nav-link" href="{{ route('dashboard') }}">
          <span class="menu-icon">
            <i class="mdi mdi-speedometer"></i>
          </span>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item menu-items active">
        <a class="nav-link" href="{{ route('users.index') }}">
          <span class="menu-icon">
            <i class="mdi mdi-account-group"></i>
          </span>
          <span class="menu-title">User Management</span>
        </a>
      </li>
    </ul>
  </nav>
  <!-- partial -->
  <div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
        <a class="navbar-brand brand-logo-mini" href="{{ route('dashboard') }}"><img src="{{ asset('assets/images/logo-mini.svg') }}" alt="logo" /></a>
      </div>
      <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="mdi mdi-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('users.index') }}">
              <i class="mdi mdi-arrow-left"></i> Back to Users
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
          <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">User Details</h4>
                <div class="user-details-content">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="text-center">
                        <div class="preview-thumbnail mb-3">
                          <div class="preview-icon bg-{{ $user->is_active ? 'success' : 'danger' }} rounded-circle" style="width: 100px; height: 100px; display: inline-flex; align-items: center; justify-content: center;">
                            <i class="mdi mdi-account text-white" style="font-size: 48px;"></i>
                          </div>
                        </div>
                        <h5>{{ $user->name }}</h5>
                        <p class="text-muted">@{{ $user->username }}</p>
                        <div class="badge badge-outline-{{ $user->is_active ? 'success' : 'danger' }}">
                          {{ $user->is_active ? 'Active' : 'Inactive' }}
                        </div>
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="text-muted">Full Name</label>
                            <p class="font-weight-bold">{{ $user->name }}</p>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="text-muted">Username</label>
                            <p class="font-weight-bold">@{{ $user->username }}</p>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="text-muted">Email Address</label>
                            <p class="font-weight-bold">{{ $user->email }}</p>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="text-muted">Account Status</label>
                            <p class="font-weight-bold">
                              <span class="badge badge-outline-{{ $user->is_active ? 'success' : 'danger' }}">
                                {{ $user->is_active ? 'Active' : 'Inactive' }}
                              </span>
                            </p>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="text-muted">Member Since</label>
                            <p class="font-weight-bold">{{ $user->created_at->format('F d, Y') }}</p>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="text-muted">Last Login</label>
                            <p class="font-weight-bold">{{ $user->last_login ? $user->last_login->format('F d, Y H:i') : 'Never' }}</p>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="text-muted">Email Verified</label>
                            <p class="font-weight-bold">
                              {{ $user->email_verified_at ? $user->email_verified_at->format('F d, Y') : 'Not verified' }}
                            </p>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="text-muted">Account Age</label>
                            <p class="font-weight-bold">{{ $user->created_at->diffForHumans() }}</p>
                          </div>
                        </div>
                      </div>
                      <div class="form-group mt-4">
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary mr-2">
                          <i class="mdi mdi-pencil"></i> Edit User
                        </a>
                        <button type="button" class="btn btn-{{ $user->is_active ? 'warning' : 'success' }}" onclick="toggleStatus({{ $user->id }})">
                          <i class="mdi mdi-{{ $user->is_active ? 'account-off' : 'account-check' }}"></i> 
                          {{ $user->is_active ? 'Deactivate' : 'Activate' }}
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
function toggleStatus(userId) {
  if (confirm('Are you sure you want to toggle this user\'s status?')) {
    fetch(`/users/${userId}/toggle-status`, {
      method: 'PATCH',
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      }
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        location.reload();
      }
    })
    .catch(error => console.error('Error:', error));
  }
}
</script>
@endpush
