<div class="d-flex gap-2">
	<a href="{{ route('admin.student.show', $data['uid']) }}" class="btn btn-info"><i class="fas fa-search"></i></a>
	<a href="{{ route('admin.student.edit', $data['uid']) }}" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>
	<form action="{{ route('admin.student.destroy', $data['uid']) }}" method="POST" id="data-{{ $data['uid'] }}">
		@csrf
		<input name="_method" type="hidden" value="DELETE">
		<button type="button" class="btn btn-danger" onclick="confirmDelete({{ '' . '' . $data['uid'] . '' . '' }})"
			data-toggle="tooltip" title="Delete"><i class="fas fa-trash-alt"></i></button>
	</form>
</div>
