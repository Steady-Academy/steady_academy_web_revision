@extends('admin.layouts.app')
@section('title', 'Chatting')
@section('content')
	<section>
		<h1>Chatting</h1>

		<div class="card">
			<div class="row justify-content-center">
				{{-- <div class="col-12 col-lg-5 col-xl-3 border-end list-group">
					@foreach ($userAdmin as $user)

						<a href="{{ route('admin.chatting.update', $user->data()['uid']) }}"
							class="list-group-item list-group-item-action border-0 {{ request()->is('admin/chatting/' . $user->data()['uid']) ? 'active' : '' }}">
							<div class="badge bg-success float-end">5</div>
							<div class="d-flex align-items-start">
								<img src="{{ $user->data()['photoUrl'] }}" class="rounded-circle me-1" alt="Ashley Briggs" width="40"
									height="40">
								<div class="flex-grow-1 ms-3">
									{{ $user->data()['name'] }}
									<div class="small"></div>
								</div>
							</div>
						</a>
						<hr class="d-block d-lg-none mt-1 mb-0">
					@endforeach
				</div> --}}

				<div class="col-12 col-lg-7 col-xl-12">
					<div class="position-relative">
						<div class="chat-messages p-4" id="bodyContent">
						</div>
					</div>
					<div class="flex-grow-0 py-3 px-4 border-top">
						<div class="input-group">
							<input type="text" class="form-control" id="message" placeholder="Type your message">
							<button id="submit" class="btn btn-primary">Send</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
@push('custom-script')
	<script type="module">
    import { initializeApp } from "https://www.gstatic.com/firebasejs/9.14.0/firebase-app.js";
    import {
        getDatabase,
        set,
        ref,
        push,
        child,
        onValue,
        onChildAdded
    } from "https://www.gstatic.com/firebasejs/9.14.0/firebase-database.js";

    const firebaseConfig = {
      apiKey: "{{ env('CONFIG_FIREBASE_APP_ID') }}",
      authDomain: "{{ env('CONFIG_FIREBASE_AUTH_DOMAIN') }}",
      projectId: "{{ env('CONFIG_FIREBASE_PROJECT_ID') }}",
      storageBucket: "{{ env('CONFIG_FIREBASE_STORAGE_BUCKET') }}",
      messagingSenderId: "{{ env('CONFIG_FIREBASE_MESSAGING_SENDER_ID') }}",
      appId: "{{ env('CONFIG_FIREBASE_APP_ID') }}",
      measurementId: "{{ env('CONFIG_FIREBASE_MEASUREMENT_ID') }}",
      databaseURL: "{{ env('CONFIG_FIREBASE_DATABASE_URL') }}"
    };

    // Initialize Firebase
    const app = initializeApp(firebaseConfig);
    const database = getDatabase(app);
    var myName = "{{ Auth::user()->displayName }}";

    submit.addEventListener('click', (e) => {
        var message = document.getElementById('message').value;
        var name = myName;
        var date = "{{ \Carbon\Carbon::now()->format('H:i') }}";
        var uid = "{{ Auth::user()->localId }}";
        // var url = window.location.pathname;
        // var senderID = url.substring(url.lastIndexOf('/') + 1);

        // let currentAndSender = uid + "_" + senderID;
        // // let userData = {};
        // // let ids = uid;
        // // ids[currentAndSender] = true;
        // const user_id = set(ref(database, 'user_chats/' + uid), {
        //     [currentAndSender]:true,
        // });
        // const newMsg = ref(database, 'messages/' + uid + "_" + senderID);
        // const user_chats = push(child(ref(database), 'user_chats'));
        const id = push(child(ref(database), 'messages')).key;
        set(ref(database, 'messages/' + id), {
            uid: uid,
            name: name,
            message: message,
            date: date
        });
        document.getElementById('message').value = "";
    });
    const newMsg = ref(database, 'messages/');
    onChildAdded(newMsg, (data) => {
        if (data.val().name != myName) {
            var divData = `
            <div class="chat-message-left p-4">
                <div>
                    <div class="text-muted small text-nowrap mt-2">${data.val().date}</div>
                </div>
                <div class="flex-shrink-1 bg-light rounded py-2 px-3 ms-3">
                    <div class="fw-bold mb-1">${data.val().name}</div>
                        ${data.val().message}
                </div>
            </div>
            `;
            var d1 = document.getElementById('bodyContent');
            d1.insertAdjacentHTML('beforebegin', divData);
        } else {
            var divData = `
            <div class="chat-message-right p-4">
                <div>
                    <div class="text-muted small text-nowrap mt-2">${data.val().date}</div>
                </div>
                <div class="flex-shrink-1 bg-light rounded py-2 px-3 me-3">
                    <div class="fw-bold mb-1">You</div>
                        ${data.val().message}
                </div>
            </div>
            `;
            var d1 = document.getElementById('bodyContent');
            d1.insertAdjacentHTML('beforebegin', divData);
        }
    });
  </script>
	<script>
		$(document).ready(function() {
			$('#action_menu_btn').click(function() {
				$('.action_menu').toogle();
			});
		});
	</script>
@endpush
