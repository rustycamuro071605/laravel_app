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
        <ul class="navbar-nav w-100">
          <li class="nav-item w-100">
            <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search" method="GET" action="{{ route('users.index') }}">
              <input type="text" name="search" class="form-control" placeholder="Search users..." value="{{ request('search') }}">
            </form>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown d-none d-lg-block">
            <a class="nav-link btn btn-primary create-new-button" href="#" data-toggle="modal" data-target="#createUserModal">
              <i class="mdi mdi-plus"></i> Add New User
            </a>
          </li>
          <li class="nav-item dropdown d-none d-lg-block">
            <a class="nav-link btn btn-success" href="{{ route('users.export') }}">
              <i class="mdi mdi-download"></i> Export
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
                <h4 class="card-title">User Management</h4>
                <div class="row mb-3">
                  <div class="col-md-3">
                    <select class="form-control" id="statusFilter" onchange="filterUsers()">
                      <option value="">All Status</option>
                      <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                      <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <select class="form-control" id="sortBy" onchange="sortUsers()">
                      <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Created Date</option>
                      <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Name</option>
                      <option value="email" {{ request('sort_by') == 'email' ? 'selected' : '' }}>Email</option>
                      <option value="last_login" {{ request('sort_by') == 'last_login' ? 'selected' : '' }}>Last Login</option>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <select class="form-control" id="sortOrder" onchange="sortUsers()">
                      <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Descending</option>
                      <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Ascending</option>
                    </select>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>
                          <div class="form-check form-check-muted m-0">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input" id="selectAll">
                            </label>
                          </div>
                        </th>
                        <th>User</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Member Since</th>
                        <th>Last Login</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($users as $user)
                      <tr>
                        <td>
                          <div class="form-check form-check-muted m-0">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input user-checkbox" value="{{ $user->id }}">
                            </label>
                          </div>
                        </td>
                        <td>
                          <div class="d-flex align-items-center">
                            <div class="preview-thumbnail">
                              <div class="preview-icon bg-{{ $user->is_active ? 'success' : 'danger' }} rounded-circle">
                                <i class="mdi mdi-account text-white"></i>
                              </div>
                            </div>
                            <span class="pl-2">{{ $user->name }}</span>
                          </div>
                        </td>
                        <td>@{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                          <div class="badge badge-outline-{{ $user->is_active ? 'success' : 'danger' }}">
                            {{ $user->is_active ? 'Active' : 'Inactive' }}
                          </div>
                        </td>
                        <td>{{ $user->created_at->format('M d, Y') }}</td>
                        <td>
                          {{ $user->last_login ? $user->last_login->format('M d, H:i') : 'Never' }}
                        </td>
                        <td>
                          <div class="btn-group" role="group">
                            <button type="button" class="btn btn-sm btn-primary" onclick="viewUser({{ $user->id }})">
                              <i class="mdi mdi-eye"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-info" onclick="editUser({{ $user->id }})">
                              <i class="mdi mdi-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-{{ $user->is_active ? 'warning' : 'success' }}" onclick="toggleStatus({{ $user->id }})">
                              <i class="mdi mdi-{{ $user->is_active ? 'account-off' : 'account-check' }}"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" onclick="deleteUser({{ $user->id }})">
                              <i class="mdi mdi-delete"></i>
                            </button>
                          </div>
                        </td>
                      </tr>
                      @empty
                      <tr>
                        <td colspan="8" class="text-center">No users found</td>
                      </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3">
                  <div>
                    Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} users
                  </div>
                  <div>
                    {{ $users->links() }}
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

<!-- Create User Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="createUserModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createUserModalLabel">Create New User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="createUserForm">
        <div class="modal-body">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
          </div>
          <div class="form-group">
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="is_active" name="is_active" checked>
              <label class="form-check-label" for="is_active">Active</label>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Create User</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="editUserForm">
        <input type="hidden" id="edit_user_id" name="user_id">
        <div class="modal-body">
          <div class="form-group">
            <label for="edit_name">Name</label>
            <input type="text" class="form-control" id="edit_name" name="name" required>
          </div>
          <div class="form-group">
            <label for="edit_username">Username</label>
            <input type="text" class="form-control" id="edit_username" name="username" required>
          </div>
          <div class="form-group">
            <label for="edit_email">Email</label>
            <input type="email" class="form-control" id="edit_email" name="email" required>
          </div>
          <div class="form-group">
            <label for="edit_password">Password (leave blank to keep current)</label>
            <input type="password" class="form-control" id="edit_password" name="password">
          </div>
          <div class="form-group">
            <label for="edit_password_confirmation">Confirm Password</label>
            <input type="password" class="form-control" id="edit_password_confirmation" name="password_confirmation">
          </div>
          <div class="form-group">
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="edit_is_active" name="is_active">
              <label class="form-check-label" for="edit_is_active">Active</label>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update User</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- View User Modal -->
<div class="modal fade" id="viewUserModal" tabindex="-1" role="dialog" aria-labelledby="viewUserModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewUserModalLabel">User Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="userDetails">
        <!-- User details will be loaded here -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
function filterUsers() {
  const status = document.getElementById('statusFilter').value;
  const url = new URL(window.location);
  url.searchParams.set('status', status);
  url.searchParams.delete('page');
  window.location.href = url.toString();
}

function sortUsers() {
  const sortBy = document.getElementById('sortBy').value;
  const sortOrder = document.getElementById('sortOrder').value;
  const url = new URL(window.location);
  url.searchParams.set('sort_by', sortBy);
  url.searchParams.set('sort_order', sortOrder);
  url.searchParams.delete('page');
  window.location.href = url.toString();
}

function viewUser(userId) {
  fetch(`/users/${userId}`)
    .then(response => response.text())
    .then(html => {
      const tempDiv = document.createElement('div');
      tempDiv.innerHTML = html;
      const userDetails = tempDiv.querySelector('.user-details-content');
      if (userDetails) {
        document.getElementById('userDetails').innerHTML = userDetails.innerHTML;
        $('#viewUserModal').modal('show');
      }
    })
    .catch(error => console.error('Error:', error));
}

function editUser(userId) {
  fetch(`/users/${userId}/edit`)
    .then(response => response.json())
    .then(data => {
      document.getElementById('edit_user_id').value = data.id;
      document.getElementById('edit_name').value = data.name;
      document.getElementById('edit_username').value = data.username;
      document.getElementById('edit_email').value = data.email;
      document.getElementById('edit_is_active').checked = data.is_active;
      $('#editUserModal').modal('show');
    })
    .catch(error => console.error('Error:', error));
}

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

function deleteUser(userId) {
  if (confirm('Are you sure you want to delete this user?')) {
    fetch(`/users/${userId}`, {
      method: 'DELETE',
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

// Create User Form
document.getElementById('createUserForm').addEventListener('submit', function(e) {
  e.preventDefault();
  const formData = new FormData(this);
  
  fetch('{{ route("users.store") }}', {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': '{{ csrf_token() }}',
      'Accept': 'application/json'
    },
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      $('#createUserModal').modal('hide');
      location.reload();
    } else {
      alert('Error creating user: ' + JSON.stringify(data.errors));
    }
  })
  .catch(error => console.error('Error:', error));
});

// Edit User Form
document.getElementById('editUserForm').addEventListener('submit', function(e) {
  e.preventDefault();
  const userId = document.getElementById('edit_user_id').value;
  const formData = new FormData(this);
  
  fetch(`/users/${userId}`, {
    method: 'PUT',
    headers: {
      'X-CSRF-TOKEN': '{{ csrf_token() }}',
      'Accept': 'application/json'
    },
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      $('#editUserModal').modal('hide');
      location.reload();
    } else {
      alert('Error updating user: ' + JSON.stringify(data.errors));
    }
  })
  .catch(error => console.error('Error:', error));
});

// Select All Checkbox
document.getElementById('selectAll').addEventListener('change', function() {
  const checkboxes = document.querySelectorAll('.user-checkbox');
  checkboxes.forEach(checkbox => {
    checkbox.checked = this.checked;
  });
});
</script>
@endpush
