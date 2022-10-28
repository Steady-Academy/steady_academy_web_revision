<?php

namespace App\Http\Livewire;

use Livewire\WithFileUploads;
use Livewire\Component;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Session;


class FormInstructur extends Component
{
    use WithFileUploads;
    public $ottPlatform = '';
    public $nama;
    public $jenis_kelamin;
    public $foto;
    public $email;
    public $telepon;
    public $poskode;
    public $alamat;
    public $instagram = null;
    public $facebook = null;
    public $website = null;
    public $tanggal_lahir;
    public $kegiatan;
    public $kegiatan_id;

    public $dokumen;
    public $alasan;

    public $totalSteps = 3;
    public $currentStep = 1;

    public $final_provinsi;
    public $final_kota;

    public $provinsi;
    public $provinsi_id;
    public $kota, $kota_id;
    // private $api_key = "38d1f6524d721d2d04ac4d0b351b8d2e14c2188d96ef3c95f1f12960e6cff038";

    public function mount()
    {

        $this->currentStep = 1;
    }

    public function updatedProvinsiId()
    {
        $this->getKota();
        $this->getProvinsiName();
    }

    public function getKota()
    {
        $client = new Client();
        if ($this->provinsi_id != '') {
            // $res = $client->request('GET', 'https://api.binderbyte.com/wilayah/kabupaten?api_key=' . $this->api_key . '&id_provinsi=' . $this->provinsi_id);
            $res = $client->request('GET', 'http://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=' . $this->provinsi_id);
            $decode = json_decode($res->getBody());
            $this->kota = $decode->kota_kabupaten;
        } else {
            $this->kota = [];
        }
    }

    public function getProvinsiName()
    {
        $client = new Client();
        if ($this->provinsi_id != '') {
            $res = $client->request('GET', 'http://dev.farizdotid.com/api/daerahindonesia/provinsi/' . $this->provinsi_id);
            $decode = json_decode($res->getBody());
            $this->final_provinsi = $decode->nama;
        } else {
            $this->final_provinsi = [];
        }
    }

    public function getKotaName()
    {
        $client = new Client();
        if ($this->kota_id != '') {
            // $res = $client->request('GET', 'https://api.binderbyte.com/wilayah/kabupaten?api_key=' . $this->api_key . '&id_provinsi=' . $this->provinsi_id);
            $res = $client->request('GET', 'http://dev.farizdotid.com/api/daerahindonesia/kota/' . $this->kota_id);
            $decode = json_decode($res->getBody());
            $this->final_kota = $decode->nama;
        } else {
            $this->final_kota = [];
        }
    }

    public function render()
    {
        $client = new Client();
        // $res = $client->request('GET', 'https://api.binderbyte.com/wilayah/provinsi?api_key=' . $this->api_key);
        $res = $client->request('GET', 'http://dev.farizdotid.com/api/daerahindonesia/provinsi');
        $decode = json_decode($res->getBody());
        $this->provinsi = $decode->provinsi;
        $this->getKota();
        $this->getProvinsiName();
        $this->getKotaName();

        $uid = Session::get('uid');
        $userDetails = app('firebase.auth')->getUser($uid);

        return view('livewire.form-instructur')->extends('layouts.app');
    }

    public function increaseStep()
    {
        $this->resetErrorBag();
        $this->validateData();
        $this->currentStep++;
        if ($this->currentStep > $this->totalSteps) {
            $this->currentStep = $this->totalSteps;
        }
    }

    public function decreaseStep()
    {
        $this->resetErrorBag();
        $this->currentStep--;
        if ($this->currentStep < 1) {
            $this->currentStep = 1;
        }
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'foto' => 'required|image|mimes:jpg,png,jpeg|max:1024',
        ]);
        $this->validateOnly($fields, [
            'dokumen' => 'required|mimes:jpg,png,jpeg,pdf|max:2024'
        ]);
    }

    public function validateData()
    {
        if ($this->currentStep == 1) {
            $this->validate([
                'nama' => 'required|string',
                'email' => 'required|email',
                'foto' => 'required|image|mimes:jpg,png,jpeg',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required',
                'kegiatan' => 'required',
                'provinsi_id' => 'required',
                'kota_id' => 'required',
                'alamat' => 'required|string',
                'poskode' => 'required|numeric',
                'telepon' => 'required|numeric',
                'instagram' => 'nullable|string',
                'facebook' => 'nullable|string',
                'website' => 'nullable|url',
            ]);
        } elseif ($this->currentStep == 2) {
            $this->validate([
                'dokumen' => 'required|mimes:jpg,png,jpeg,pdf|max:2024',
                'alasan' => 'required|string',
            ]);
        }
    }


    public function register()
    {
        $this->resetErrorBag();
        if ($this->currentStep == 3) {
            $this->validate([
                'nama' => 'required|string',
                'email' => 'required|email',
                'foto' => 'required|image|mimes:jpg,png,jpeg',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required',
                'kegiatan' => 'required',
                'provinsi_id' => 'required',
                'kota_id' => 'required',
                'alamat' => 'required|string',
                'poskode' => 'required|numeric',
                'telepon' => 'required|numeric',
                'instagram' => 'nullable|string',
                'facebook' => 'nullable|string',
                'website' => 'nullable|url',
                'dokumen' => 'required|mimes:jpg,png,jpeg,pdf|max:2024',
                'alasan' => 'required|string',
            ]);
        }

        // get user id
        $uid = Session::get('uid');

        // get picture and get name of the picture
        if ($this->foto) {
            $getProfile = $this->foto;
            $firebase_storage_path_profile = 'Users/' . $uid . '/Profile/';
            $name = $uid;
            $localfolder = public_path('storage/users/' . $uid) . '/Profile/';
            $extension = $this->foto->getClientOriginalExtension();
            $profile = $name . '.' . $extension;
            if ($getProfile->storeAs('public/users/' . $uid . '/Profile/', $profile)) {
                $uploadedfile = fopen($localfolder . $profile, 'r');
                app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path_profile . $name]);
                unlink($localfolder . $profile);
            }
        }

        // get cv and get name of the cv
        if ($this->dokumen) {
            $getDocument = $this->dokumen;
            $firebase_storage_path_cv = 'Users/' . $uid . "/CV/";
            $name = $uid;
            $localfolder = public_path('storage/users/' . $uid . '/CV/');
            $extension = $this->dokumen->getClientOriginalExtension();
            $document = $name . '.' . $extension;
            if ($getDocument->storeAs('public/users/' . $uid . '/CV/', $document)) {
                $uploadedfile = fopen($localfolder . $document, 'r');
                app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path_cv . $name]);
                unlink($localfolder . $document);
            }
        }

        // add data to firestore
        $db = app('firebase.firestore')->database()->collection('Users')->document($uid);
        $db->set([
            'name' => $this->nama,
            'phoneNumber' => $this->telepon,
            'profile' => [
                'foto' => $firebase_storage_path_profile . $profile,
                'dokumen_cv' => $firebase_storage_path_cv . $document,
                'tanggal_lahir' => $this->tanggal_lahir,
                'jenis_kelamin' => $this->jenis_kelamin,
                'kegiatan' => $this->kegiatan,
                'alamat' => [
                    'provinsi' => $this->final_provinsi,
                    'kota' => $this->final_kota,
                    'kode_pos' => $this->poskode,
                    'detail' => $this->alamat,
                ],
                'instagram' => $this->instagram,
                'facebook' => $this->facebook,
                'website' => $this->website,
                'alasan' => $this->alasan,
            ],
            'registered' => true,
            'is_confirmed' => false,
        ], ['merge' => true]);

        return redirect()->route('instructur.success');
    }
}
