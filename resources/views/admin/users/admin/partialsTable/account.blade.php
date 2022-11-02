<div class="d-flex gap-2">
	<img src="{{ $data['photoUrl'] }}" class="rounded-circle border border-2 border-dark" width="50" height="50"
		alt="{{ $data['name'] }}">
	<div class="text-left align-self-center">
		<h5 class="fw-bold mb-0">{{ $data['name'] }}</h5>
		<p class="mb-0">{{ $data['email'] }}</p>
	</div>
</div>
