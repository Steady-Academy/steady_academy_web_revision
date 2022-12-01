@component('mail::message')
	<h2>
		Hallo {{ $mailData['name'] }},</h2>
	<p> Selemat kamu terpiliih menjadi Instruktur di Steady Academy
		@component('mail::button', ['url' => $mailData['action']])
			Lanjutkan Ke Dashboard
		@endcomponent
	</p>

	Terima kasih,<br>
	Steady Academy Team
@endcomponent
