@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">e-signature</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="flash-message">
                      @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has('alert-' . $msg))
                        <p class="alert alert-{{ $msg }}" style="width: 500px;">{{ Session::get('alert-' . $msg) }}</p>
                        @endif
                      @endforeach
                    </div>
                    <div style="max-width: 600px">
                    @if (!empty($listImages))
                        <p>E-signature registered</p>
                    @else
                    	<p>You haven't registered a signature yet</p>
                    @endif

                        @foreach ($listImages as $image)
                        <img src="{{ $image->url }}" alt=""  style="border: 1px solid black; margin: 5px;">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
	img {
		width: 23%;
    	display: inline-block;
	}
</style>
