@extends('layouts.app')
@section('title', 'Login')
@section('content')
<div class="main-wrapper d-flex justify-content-center align-items-center">
  <div class="container">
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card p-3">
              <div class="card-title d-flex justify-content-center align-items-center my-3">
                <div class="text-center">
                  <img src="{{ asset('/img/logo.png') }}" class="mw-100 mb-4" height="40">
                  <h1 class="h3 text-primary mb-0">Ticket Management</h1>
                  <p>Login to your account.</p>
                </div>
              </div>
                <div class="card-body">
                    <form method="POST" role="form" action="{{ route('login') }}">
                        @csrf                           
                        <div class="form-group">
                          <div class="row d-flex justify-content-center align-items-center">
                            <div class="col-12">
                              <input id="email" type="email" class="form-control" name="email" value="" required="" autofocus="" placeholder="Email">
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                            <div class="row d-flex justify-content-center align-items-center">
                              <div class="col-12">
                                <input id="password" type="password" class="form-control" name="password" required="" placeholder="password">
                              </div>
                            </div>
                        </div>
                        <div class="form-group">
                          <div class="row d-flex justify-content-center align-items-center">
                              <div class="col-12">
                                    <label>
                                        <input type="checkbox" name="remember" id="remember">
                                        <span>Remember Me</span>
                                        <span class="aiz-square-check"></span>
                                    </label>
                              </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="row d-flex justify-content-center align-items-center">
                              <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    Login
                                    <i class="fa-solid fa-right-to-bracket"></i>
                                </button>
                              </div>
                          </div>
                        </div>
                    </form>
                    <div class="form-group">
                      <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-12">
                          <a href="javascript:void(0);" class="">Forgot password ?</a>
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
