<x-guest-layout :pageTitle="'Forgot Password'">
<div class="login-box-body">
    <h3 class="login-box-msg text-primary">Forgot Password?</h3>
    <p class="login-box-msg">To get reset link please fill out the form below</p>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
      <div class="form-group has-feedback">
        <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required autofocus autocomplete="username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      <x-input-error :messages="$errors->get('email')" class="mt-2" />
      </div>
      <div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-main btn-block btn-flat">{{ __('Email Password Reset Link') }}</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="mt-5">
        Back to sign-in page <a href="{{ route('login')}}" class="text-center accent-color">Click Here</a>
    </div>
  </div>
</x-guest-layout>
