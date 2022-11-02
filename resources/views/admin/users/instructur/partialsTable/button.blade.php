<div class="d-flex gap-2">
	<a href="{{ route('admin.instructur.show', $data['uid']) }}" class="btn btn-info"><i class="fas fa-search"></i></a>
	<a href="{{ route('admin.instructur.edit', $data['uid']) }}" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>
	@if ($user->disabled)
		<form action="{{ route('admin.instructur.enable', $data['uid']) }}" method="POST" id="data-enable-{{ $data['uid'] }}">
			@csrf
			@method('PUT')
			<button type="button" class="btn btn-secondary" onclick="confirmEnable({{ '\'' . $data['uid'] . '\'' }})"
				data-toggle="tooltip" title="Enable"><i class="bi bi-broadcast"></i></button>
		</form>
	@else
		<form action="{{ route('admin.instructur.disable', $data['uid']) }}" method="POST"
			id="data-disable-{{ $data['uid'] }}">
			@csrf
			@method('PUT')
			<button type="button" class="btn btn-success" onclick="confirmDisable({{ '\'' . $data['uid'] . '\'' }})"
				data-toggle="tooltip" title="Disable"><i class="bi bi-broadcast-pin"></i></button>
		</form>
	@endif
	<form action="{{ route('admin.instructur.destroy', $data['uid']) }}" method="POST"
		id="data-delete-{{ $data['uid'] }}">
		@csrf
		<input name="_method" type="hidden" value="DELETE">
		<button type="button" class="btn btn-danger" onclick="confirmDelete({{ '\'' . $data['uid'] . '\'' }})"
			data-toggle="tooltip" title="Delete"><i class="bi bi-trash-fill"></i></button>
	</form>
</div>
