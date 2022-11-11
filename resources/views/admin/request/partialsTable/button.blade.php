<div class="d-flex gap-2">

	<form action="{{ route('admin.request.approve', $data['uid']) }}" method="POST" id="data-approve-{{ $data['uid'] }}">
		@csrf
		@method('PUT')
		<button type="button" class="btn btn-success" onclick="confirmApprove({{ '\'' . $data['uid'] . '\'' }})"
			data-toggle="tooltip" title="Approve"><i class="bi bi-check-circle-fill"></i></button>
	</form>

	<a href="{{ route('admin.request.show', $data['uid']) }}" class="btn btn-info"><i class="fas fa-search"></i></a>
	<a href="{{ route('admin.request.edit', $data['uid']) }}" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>
	<form action="{{ route('admin.request.disable', $data['uid']) }}" method="POST" id="data-disable-{{ $data['uid'] }}">
		@csrf
		<input name="_method" type="hidden" value="PUT">
		<button type="button" class="btn btn-danger" onclick="confirmDisable({{ '\'' . $data['uid'] . '\'' }})"
			data-toggle="tooltip" title="Delete"><i class="bi bi-x-circle-fill"></i></button>
	</form>
</div>
