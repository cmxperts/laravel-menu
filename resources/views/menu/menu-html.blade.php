@php
	$currentUrl = url()->current();
@endphp

<div id="cmxperts-menu" class="card mt-2 mb-2">
	<div class="card-header">
		<form method="GET" action="{{ $currentUrl }}" class="form-inline">
			<span for="email" class="mr-sm-2">Select the menu you want to edit: </span>
			{!! Menu::select('menu', $menulist, ['class' => 'form-control']) !!}
			<button type="submit" class="btn btn-primary ml-2">Submit</button>
			<div class="ml-4 mr-sm-2">
				or <a href="{{ $currentUrl }}?action=edit&menu=0">Create New Menu</a>
			</div>
		</form>
	</div>

	<div class="card-body">
		<input type="hidden" id="idmenu" value="{{$indmenu->id ?? null}}"/>
		<div class="row">
			<div class="col-md-4">
				@include('cmxperts::menu.partials.left')
			</div>
			{{-- /col-md-4 --}}
			<div class="col-md-8">
				@include('cmxperts::menu.partials.right')
			</div>
		</div>
	</div>

	<div class="ajax-loader" id="ajax_loader">
		<div class="lds-ripple">
			<div></div>
			<div></div>
		</div>
	</div>
</div>
