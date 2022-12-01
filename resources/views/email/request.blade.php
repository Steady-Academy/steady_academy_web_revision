@component('mail::message')
	<h2>
		Hello {{ $mailData['name'] }},</h2>
	<p> Selemat kamu terpiliih menjadi Instruktur di SteadyAcademy
		@component('mail::button', ['url' => $mailData['action']])
			Bacancy Technology
		@endcomponent
	</p>

	Terima kasih,<br>
	{{ config('app.name') }}<br>
	Steady Academy Team
@endcomponent
