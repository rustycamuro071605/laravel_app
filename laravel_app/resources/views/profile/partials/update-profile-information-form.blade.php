<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')
        
        <div class="row mb-4">
            <div class="col-md-6">
                <label for="name" class="form-label neon-text">
                    <i class="bi bi-person me-2"></i>Full Name *
                </label>
                <div class="input-group">
                    <span class="input-group-text bg-dark-subtle border-dark">
                        <i class="bi bi-person"></i>
                    </span>
                    <input id="name" 
                           name="name" 
                           type="text" 
                           class="form-control bg-dark border-dark text-white @error('name') is-invalid @enderror" 
                           value="{{ old('name', $user->name) }}" 
                           required 
                           autofocus 
                           autocomplete="name"
                           placeholder="Enter your full name">
                </div>
                @error('name')
                    <div class="invalid-feedback d-block">
                        <i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}
                    </div>
                @enderror
            </div>
            
            <div class="col-md-6">
                <label for="username" class="form-label neon-text">
                    <i class="bi bi-at me-2"></i>Username *
                </label>
                <div class="input-group">
                    <span class="input-group-text bg-dark-subtle border-dark">
                        <i class="bi bi-at"></i>
                    </span>
                    <input id="username" 
                           name="username" 
                           type="text" 
                           class="form-control bg-dark border-dark text-white @error('username') is-invalid @enderror" 
                           value="{{ old('username', $user->username) }}" 
                           required 
                           autocomplete="username"
                           placeholder="Enter your username">
                </div>
                @error('username')
                    <div class="invalid-feedback d-block">
                        <i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="mb-4">
            <label for="email" class="form-label neon-text">
                <i class="bi bi-envelope me-2"></i>Email Address *
            </label>
            <div class="input-group">
                <span class="input-group-text bg-dark-subtle border-dark">
                    <i class="bi bi-envelope"></i>
                </span>
                <input id="email" 
                       name="email" 
                       type="email" 
                       class="form-control bg-dark border-dark text-white @error('email') is-invalid @enderror" 
                       value="{{ old('email', $user->email) }}" 
                       required 
                       autocomplete="username"
                       placeholder="Enter your email address">
            </div>
            @error('email')
                <div class="invalid-feedback d-block">
                    <i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}
                </div>
            @enderror
            
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="alert alert-warning mt-3">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    {{ __('Your email address is unverified.') }}
                    <button form="send-verification" class="btn btn-sm btn-outline-warning ms-2">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </div>
                
                @if (session('status') === 'verification-link-sent')
                    <div class="alert alert-success mt-2">
                        <i class="bi bi-check-circle me-2"></i>
                        {{ __('A new verification link has been sent to your email address.') }}
                    </div>
                @endif
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="futuristic-btn">
                <i class="bi bi-save me-2"></i>
                <span>Save Changes</span>
            </button>
            
            @if (session('status') === 'profile-updated')
                <div class="alert alert-success mb-0 py-2 px-3">
                    <i class="bi bi-check-circle me-1"></i>
                    {{ __('Saved.') }}
                </div>
            @endif
        </div>
    </form>
</section>
