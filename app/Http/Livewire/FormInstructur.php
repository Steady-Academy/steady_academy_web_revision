<?php

namespace App\Http\Livewire;

use Livewire\WithFileUploads;
use Livewire\Component;

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
    public $instagram;
    public $facebook;
    public $website;
    public $dokumen;
    public $alasan;

    public $kegiatan = [
        'Lainnya',
        'Pekerja Profesional Kantoran',
        'Mahasiswa',
        'Guru',
        'Tidak Bekerja',
        'Ibu Rumah Tangga',
    ];

    public $provisi = [
        'Jawa Barat',
        'Jawa Timur',
        'Jawa Tengah',
        'Sumatra Utara',
    ];


    public $kota = [

        'Bandung',
        'Kota Bandung',
        'Jakarta',
        'Surabaya',
    ];

    public $totalSteps = 4;
    public $currentStep = 1;

    public function mount()
    {
        $this->currentStep = 1;
    }


    public function render()
    {
        return view('livewire.form-instructur');
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

    public function validateData()
    {

        if ($this->currentStep == 1) {
            $this->validate([
                'email' => 'required|email',
                'password' => 'required|password|confirmed',
                'password_confirmation' => 'required',
                'nama_depan' => 'required|string',
                'nama_belakang' => 'required|string',
                'jenis_kelamin' => 'required',
                'usia' => 'required|digits:2',
                'telepon' => 'required|max:13',
            ]);
        } elseif ($this->currentStep == 2) {
            $this->validate([
                'email' => 'required|email|unique:students',
                'phone' => 'required',
                'country' => 'required',
                'city' => 'required'
            ]);
        } elseif ($this->currentStep == 3) {
            $this->validate([
                'frameworks' => 'required|array|min:2|max:3'
            ]);
        }
    }

    public function register()
    {
        $this->resetErrorBag();
        if ($this->currentStep == 4) {
            $this->validate([
                'cv' => 'required|mimes:doc,docx,pdf|max:1024',
                'terms' => 'accepted'
            ]);
        }

        $cv_name = 'CV_' . time() . $this->cv->getClientOriginalName();
        $upload_cv = $this->cv->storeAs('students_cvs', $cv_name);

        if ($upload_cv) {
            $values = array(
                "first_name" => $this->first_name,
                "last_name" => $this->last_name,
                "gender" => $this->gender,
                "email" => $this->email,
                "phone" => $this->phone,
                "country" => $this->country,
                "city" => $this->city,
                "frameworks" => json_encode($this->frameworks),
                "description" => $this->description,
                "cv" => $cv_name,
            );

            Student::insert($values);
            //   $this->reset();
            //   $this->currentStep = 1;
            $data = ['name' => $this->first_name . ' ' . $this->last_name, 'email' => $this->email];
            return redirect()->route('registration.success', $data);
        }
    }
}
