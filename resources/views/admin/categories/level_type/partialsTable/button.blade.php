<div class="d-flex gap-2">
	<a href="{{ route('admin.tipe_level.edit', $data->id) }}" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>
	<form action="{{ route('admin.tipe_level.destroy', $data->id) }}" method="POST" id="data-delete-{{ $data->id }}">
		@csrf
		<input name="_method" type="hidden" value="DELETE">
		<button type="button" class="btn btn-danger" onclick="confirmDelete({{ '\'' . $data->id . '\'' }})"
			data-toggle="tooltip" title="Delete"><i class="bi bi-trash-fill"></i></button>
	</form>
</div>
