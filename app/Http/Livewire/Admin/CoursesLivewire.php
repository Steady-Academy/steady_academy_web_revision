<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Http\Requests\PriceTypeRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;


class CoursesLivewire extends Component
{
    use WithFileUploads;
    public $totalSteps = 4;
    public $currentStep = 1;
    public $ottPlatform = '';

    // form input step 1
    public $nama_kursus, $kategori_kursus, $level_kursus, $tipe_harga, $deskripsi_kursus;
    public $waktu_kursus, $harga_kursus, $diskon, $promo, $kode_promo = null;

    // form input step 2
    public $video_preview, $thumbnail;

    // form input step 3
    public $nama_materi = [];
    public $nama_materi_baru = [];
    public $materi = [];
    public $i = 0;
    public $sub_materi = [];

    public $sub_materi_item = [];
    public $materi_sub_materi = [];
    public $pelajaran;

    public $result = [];
    public $test = [];
    public $doneStepOne = false;
    public $doneStepTwo = false;
    public $doneStepThree = false;

    public function addMateriItems()
    {
        data_set($this->materi_sub_materi, is_array($this->nama_materi) ?  array_map('ucfirst', $this->nama_materi) : ucfirst($this->nama_materi), $this->sub_materi);
    }

    public function addSubMateriItems()
    {

        $materi_key = array_keys($this->materi_sub_materi);
        $sub_materi_key = array_keys($this->sub_materi_item);

        $check_key = array_intersect_key($materi_key, $sub_materi_key);

        $get_key = key($this->sub_materi_item);
        $current_key = current(array($this->sub_materi_item));
        foreach ($this->materi_sub_materi as $key => $value) {
            if (key($current_key) == $key) {
                array_push($this->materi_sub_materi[key($current_key)], $this->sub_materi_item[$key]);
                next($current_key);
                reset($current_key);
            } else {
                [];
            }
        }
    }

    public function removeMateriItems($key)
    {
        unset($this->materi_sub_materi[$key]);
    }

    public function removeSubMateriItems($key, $loop, $parent)
    {
        unset($this->materi_sub_materi[$key][$loop][$parent]);
    }


    public function mount()
    {
        $this->currentStep = 1;
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

    public function getSnapshot($query)
    {
        $json = [];
        $snapshot = $query->documents();
        foreach ($snapshot as $document) {
            if ($document->exists()) {
                $d = [];
                foreach ($document->data() as $key => $data) {
                    if (is_object($data)) {
                        $d[$key] = $data->formatAsString();
                    } else {
                        $d[$key] = $data;
                    }
                }

                $json[] = $d;
            }
        }
        return json_encode($json);
    }


    public function render()
    {
        $this->materi_sub_materi;

        $this->getCategory();
        $this->getLevel();
        return view('livewire.admin.courses-livewire')->extends('admin.layouts.app');
    }

    public function getCategory()
    {
        $category = app('firebase.firestore')->database();
        $category_course = $category->collection('Category_course');
        $query = $category_course->orderBy('created_at', 'DESC');
        $snapshot = $this->getSnapshot($query);
        $this->kategori_kursus = json_decode($snapshot);
    }

    public function getLevel()
    {
        $level = app('firebase.firestore')->database();
        $level_type = $level->collection('Category_level_type');
        $query = $level_type->orderBy('created_at', 'DESC');
        $snapshot = $this->getSnapshot($query);
        $this->level_kursus = json_decode($snapshot);
    }

    protected function rules()
    {
        if ($this->tipe_harga == "paid" && $this->promo == "true") {
            return [
                'nama_kursus' => 'required|string|max:50',
                'kategori_kursus' => 'required',
                'level_kursus' => 'required',
                'tipe_harga' => 'required',
                'waktu_kursus' => 'nullable',
                'deskripsi_kursus' => 'required|string',
                'harga_kursus' => 'required|integer',
                'promo' => 'required',
                'diskon' => 'required|integer|max:2',
                'kode_promo' => 'required|string|max:6',
            ];
        } else if ($this->tipe_harga == "paid" && $this->promo == "false") {
            return [
                'nama_kursus' => 'required|string|max:50',
                'kategori_kursus' => 'required|string',
                'level_kursus' => 'required|string',
                'tipe_harga' => 'required|string',
                'waktu_kursus' => 'nullable',
                'deskripsi_kursus' => 'required|string',
                'harga_kursus' => 'required|integer',
                'promo' => 'nullable',
                'diskon' => 'nullable',
                'kode_promo' => 'nullable',
            ];
        } else if ($this->tipe_harga == "paid" && $this->promo == "") {
            return [
                'nama_kursus' => 'required|string|max:50',
                'kategori_kursus' => 'required',
                'level_kursus' => 'required',
                'tipe_harga' => 'required',
                'waktu_kursus' => 'nullable',
                'deskripsi_kursus' => 'required|string',
                'harga_kursus' => 'required|integer',
                'promo' => 'required',
                'diskon' => 'nullable',
                'kode_promo' => 'nullable',
            ];
        } else {
            return [
                'nama_kursus' => 'required|string|max:50',
                'kategori_kursus' => 'required',
                'level_kursus' => 'required',
                'tipe_harga' => 'required',
                'waktu_kursus' => 'nullable',
                'deskripsi_kursus' => 'required|string',
                'harga_kursus' => 'nullable',
                'promo' => 'nullable',
                'diskon' => 'nullable',
                'kode_promo' => 'nullable',
            ];
        }
    }

    public function validateData()
    {
        if ($this->currentStep == 1) {
            $this->validate();
            $this->doneStepOne = true;
        } else if ($this->currentStep == 2) {
            $this->validate([
                'thumbnail' => 'required|mimes:png,jpg,jpeg|max:1500',
                'video_preview' => 'required|mimes:mp4,mov,ogg,mkv|max:20000',
            ]);
            $this->doneStepTwo = true;
        } else if ($this->currentStep == 3) {
        }
    }

    public function change_key($array, $old_key, $new_key)
    {

        if (!array_key_exists($old_key, $array))
            return $array;

        $keys = array_keys($array);
        $keys[array_search($old_key, $keys)] = $new_key;

        return array_combine($keys, $array);
    }

    // public function materi_sub_materi()
    // {
    //     $this->materi();
    //     array_push($this->materi_sub_materi, $this->materi);
    //     $this->subMateri();
    //     array_push($this->subMateri_sub_materi, $this->sub_materi);

    // }

    public function materi()
    {
        $this->validate([
            'nama_materi' => 'required|string|max:30',
        ]);

        $this->addMateriItems();
        $this->dispatchBrowserEvent('hide-form');
        $this->nama_materi = [];
    }

    function recursive_change_key($arr, $set)
    {
        if (is_array($arr) && is_array($set)) {
            $newArr = array();
            foreach ($arr as $k => $v) {
                $key = array_key_exists($k, $set) ? $set[$k] : $k;
                $newArr[$key] = is_array($v) ? $this->recursive_change_key($v, $set) : $v;
            }
            return $newArr;
        }
        return $arr;
    }

    public function updateMateriItem($key)
    {
        $this->nama_materi_baru = $key;
    }

    public function updateMateri($key)
    {
        $this->validate([
            'nama_materi_baru' => 'required|string|max:30',
        ]);

        $this->materi_sub_materi = $this->recursive_change_key($this->materi_sub_materi, array($key => $this->nama_materi_baru));
        $this->dispatchBrowserEvent('hide-form');
        $this->nama_materi_baru = [];
    }

    public function addNew()
    {
        $this->dispatchBrowserEvent('show-form');
    }

    public function updateSubMateriItem($key, $child, $parent)
    {
        $this->sub_materi_item[$key][$child]['video_sub_materi'] = $this->materi_sub_materi[$key][$child][$parent]['video_sub_materi'];
        $this->sub_materi_item[$key][$child]['nama_sub_materi'] = $this->materi_sub_materi[$key][$child][$parent]['nama_sub_materi'];
        $this->sub_materi_item[$key][$child]['deskripsi_sub_materi'] = $this->materi_sub_materi[$key][$child][$parent]['deskripsi_sub_materi'];


        // dd($this->sub_materi_item[$key][$parent]['nama_sub_materi']);
        // dd($this->sub_materi_item[$key . $child . 'nama_sub_materi']);
    }

    public function updateSubMateri($key, $child, $parent)
    {
        Validator::make($this->sub_materi_item, [
            '*.*.nama_sub_materi' => 'required|string|max:30',
            '*.*.video_sub_materi' => 'required|mimes:mp4,mov,ogg,mkv|max:20000',
            '*.*.deskripsi_sub_materi' => 'required|string',
        ])->validate();
        $this->materi_sub_materi[$key][$child][$parent] = $this->sub_materi_item[$key][$child];
        $this->dispatchBrowserEvent('hide-form');
        $this->sub_materi_item = [];
    }

    public function subMateri()
    {
        Validator::make($this->sub_materi_item, [
            '*.*.nama_sub_materi' => 'required|string|max:30',
            '*.*.video_sub_materi' => 'required|mimes:mp4,mov,ogg,mkv|max:20000',
            '*.*.deskripsi_sub_materi' => 'required|string',
        ])->validate();


        $this->addSubMateriItems();
        $this->dispatchBrowserEvent('hide-form');
        $this->sub_materi_item = [];
    }

    public function create()
    {
    }
}
