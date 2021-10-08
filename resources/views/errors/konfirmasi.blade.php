@extends('template.welcome')
@section('title')
Konfirmasi Admin
@endsection
@section('subtitle')
<li class="breadcrumb-item active">Konfirmasi Admin</li>
@endsection
@section('content')

<div class="container">
  <div class="row">
  	<h3>Konfirmasi Admin</h3>
	<h5>untuk melanjutkan proses, ketik password root aplikasi ini.</h5>
  	<nav>
	    <div class="nav-wrapper">
		    <form method="post">
		    	@csrf
		      <div class="input-field green">
		        <input id="search" type="search" name="password" value="" placeholder="Password Root Aplikasi">
		        <label class="label-icon" for="search"><i class="material-icons">lock</i></label>
		      </div>
		    </form>
	    </div>
    </nav>
  </div>
</div>
@endsection