@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-12">
            <div class="card pt-80">
                <div class="card-header">                    
                    <img src="{{asset('images/logo.png')}}">
                    <h3 class="pt-40">アマゾンオートメーション管理</h3>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
                        @csrf

                        <div class="form-group row">                            
                            <div class="col-md-6 offset-md-3">
                                <input id="email" type="email" class="form-control form-rounded @error('メールアドレス') is-invalid @enderror" name="メールアドレス" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('メールアドレス') }}">                                
                                @error('メールアドレス')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3">
                                <input id="password" type="password" class="form-control form-rounded @error('パスワード') is-invalid @enderror" name="パスワード" required autocomplete="current-password" placeholder="{{ __('パスワード') }}">
                                @error('パスワード')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                                
                            </div>
                        </div>

                        <!-- <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div> -->

                        <div class="form-group row mb-0">                            
                            <div class="col-md-6 offset-md-3">                                
                                <button type="submit" class="btn btn-round btn-danger">
                                    {{ __('ログイン') }}
                                </button>

                                <!-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
