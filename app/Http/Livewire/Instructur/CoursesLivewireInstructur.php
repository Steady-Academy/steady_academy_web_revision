<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Http\Requests\PriceTypeRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class CoursesLivewireInstructur extends Component
{
    use WithFileUploads;
    public $totalSteps = 4;
    public $currentStep = 1;
    public $ottPlatform = '';

    // form input step 1
    public $nama_kursus, $kategori_kursus, $tags, $level_kursus, $kategori, $level, $tipe_harga, $deskripsi_kursus;
    public $waktu_kursus, $harga_kursus, $diskon, $promo, $kode_promo = null;
    public $tags_kursus = [];
    public $tag_name = [];
    public $kategori_name, $level_name;

    // form input step 2
    public $video_preview, $thumbnail;

    // form input step 3
    public $nama_materi = [];
    public $nama_materi_baru = [];
    public $materi = [];
    public $i = 0;
    public $sub_materi = [];

    public $nama, $foto;
    public $sub_materi_item = [];
    public $materi_sub_materi = [];
    public $pelajaran;

    public $result = [];
    public $test = [];
    public $doneStepOne = false;
    public $doneStepTwo = false;
    public $doneStepThree = false;
    public $refreshVideo = false;

    protected $listeners = [
        'selectedItem',
    ];

    public function render()
    {
        $this->materi_sub_materi;

        $this->getCategory();
        $this->getLevel();
        $this->getTags();
        $this->getUser();

        if ($this->kategori_kursus) {
            $db = app('firebase.firestore')->database();
            $query = $db->collection('Category_course')->document($this->kategori_kursus)->snapshot();
            $this->kategori_name = $query->data()['name'];
        }

        if ($this->level_kursus) {
            $db = app('firebase.firestore')->database();
            $query = $db->collection('Category_level_type')->document($this->level_kursus)->snapshot();
            $this->level_name = $query->data()['name'];
        }

        if ($this->tags_kursus) {
            $db = app('firebase.firestore')->database();
            foreach ($this->tags_kursus as $key => $value) {
                $query = $db->collection('Category_tags')->document($value)->snapshot();
                if (!in_array($value, $this->tag_name, true)) {
                    array_push($this->tag_name, $query->data()['name']);
                }
            }
            $this->tag_name = array_unique($this->tag_name);
        }

        return view('livewire.instructur.courses-livewire')->extends('instructur.layouts.app');
    }

    public function addNew()
    {
        $this->dispatchBrowserEvent('show-form');
    }

    public function hydrate()
    {
        $this->emit('loadSelect2Hydrate');
    }

    public function selectedItem($value)
    {
        $this->tags_kursus = $value;
    }

    public function mount()
    {
        $this->currentStep = 1;
    }

    public function removeMateriItems($key)
    {
        unset($this->materi_sub_materi[$key]);
    }

    public function removeSubMateriItems($key, $loop, $parent)
    {
        unset($this->materi_sub_materi[$key][$loop][$parent]);
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

    public function getCurrentStep($step)
    {
        $this->resetErrorBag();

        if ($this->doneStepOne || $this->doneStepTwo || $this->doneStepThree) {
            $this->currentStep = $step;
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

    public function getCategory()
    {
        $category = app('firebase.firestore')->database();
        $category_course = $category->collection('Category_course');
        $query = $category_course->orderBy('created_at', 'DESC');
        $snapshot = $this->getSnapshot($query);
        $this->kategori = json_decode($snapshot);
    }

    public function getLevel()
    {
        $level = app('firebase.firestore')->database();
        $level_type = $level->collection('Category_level_type');
        $query = $level_type->orderBy('created_at', 'DESC');
        $snapshot = $this->getSnapshot($query);
        $this->level = json_decode($snapshot);
    }

    public function getTags()
    {
        $tags = app('firebase.firestore')->database();
        $category_tags = $tags->collection('Category_tags');
        $query = $category_tags->orderBy('created_at', 'DESC');
        $snapshot = $this->getSnapshot($query);
        $this->tags = json_decode($snapshot);
    }

    public function getUser()
    {
        $uid = Session::get('uid');
        $snapshot = app('firebase.firestore')->database()->collection('Users')->document($uid)->snapshot();
        $this->foto = $snapshot->data()['photoUrl'];
        $this->nama = $snapshot->data()['name'];
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
                'tags_kursus' => 'required|array|min:1|max:3',

            ];
        } else if ($this->tipe_harga == "paid" && $this->promo == "false") {
            return [
                'nama_kursus' => 'required|string|max:50',
                'kategori_kursus' => 'required',
                'level_kursus' => 'required|string',
                'tipe_harga' => 'required',
                'waktu_kursus' => 'nullable',
                'deskripsi_kursus' => 'required|string',
                'harga_kursus' => 'required|integer',
                'promo' => 'nullable',
                'diskon' => 'nullable',
                'kode_promo' => 'nullable',
                'tags_kursus' => 'required|array|min:1|max:3',
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
                'tags_kursus' => 'required|array|min:1|max:3',
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
                'tags_kursus' => 'required|array|min:1|max:3',
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

    public function updateSubMateriItem($key, $child, $parent)
    {
        $this->sub_materi_item[$key][$child]['video_sub_materi'] = $this->materi_sub_materi[$key][$child][$parent]['video_sub_materi'];
        $this->sub_materi_item[$key][$child]['nama_sub_materi'] = $this->materi_sub_materi[$key][$child][$parent]['nama_sub_materi'];
        $this->sub_materi_item[$key][$child]['deskripsi_sub_materi'] = $this->materi_sub_materi[$key][$child][$parent]['deskripsi_sub_materi'];
    }

    public function updateSubMateri($key, $child, $parent)
    {
        Validator::make($this->sub_materi_item, [
            '*.*.nama_sub_materi' => 'required|string|max:30',
            '*.*.video_sub_materi' => 'required|mimes:mp4,mov,ogg,mkv|max:20000',
            '*.*.deskripsi_sub_materi' => 'required|string',
        ])->validate();

        if ($this->materi_sub_materi[$key][$child][$parent]['video_sub_materi'] != $this->sub_materi_item[$key][$child]['video_sub_materi']) {
            $oldVideo = Storage::delete('livewire-tmp/' . $this->materi_sub_materi[$key][$child][$parent]['video_sub_materi']->getFileName());
            if ($oldVideo) {
                $this->materi_sub_materi[$key][$child][$parent]['video_sub_materi'] = $this->sub_materi_item[$key][$child]['video_sub_materi'];
                $this->materi_sub_materi[$key][$child][$parent]['nama_sub_materi'] = $this->sub_materi_item[$key][$child]['nama_sub_materi'];
                $this->materi_sub_materi[$key][$child][$parent]['deskripsi_sub_materi'] = $this->sub_materi_item[$key][$child]['deskripsi_sub_materi'];
            }
        } else {
            $this->materi_sub_materi[$key][$child][$parent]['nama_sub_materi'] = $this->sub_materi_item[$key][$child]['nama_sub_materi'];
            $this->materi_sub_materi[$key][$child][$parent]['deskripsi_sub_materi'] = $this->sub_materi_item[$key][$child]['deskripsi_sub_materi'];
        }

        $this->sub_materi_item = [];
        $this->dispatchBrowserEvent('hide-form');
    }

    public function subMateri()
    {
        Validator::make($this->sub_materi_item, [
            '*.*.nama_sub_materi' => 'required|string|max:30',
            '*.*.video_sub_materi' => 'required|mimes:mp4,mov,ogg,mkv|max:20000',
            '*.*.deskripsi_sub_materi' => 'required|string',
        ])->validate();


        $this->addSubMateriItems();
        $this->sub_materi_item = [];
        $this->dispatchBrowserEvent('hide-form');
    }

    public function create()
    {
        $this->resetErrorBag();
        $uid = Session::get('uid');

        // thumbnail
        if ($this->thumbnail) {
            $getThumbnail = $this->thumbnail;
            $firebase_storage_path_thumbnail = 'Users/' . $uid . '/Courses/' . $this->nama_kursus . '/thumbnail/';
            $date = Carbon::now();
            $name = $date->getPreciseTimestamp(3);
            $localfolder = public_path('storage/users/' . $uid) . '/Courses/';
            $extension = $this->thumbnail->getClientOriginalExtension();
            $thumbnail = $name . '.' . $extension;
            if ($getThumbnail->storeAs('public/users/' . $uid . '/Courses/', $thumbnail)) {
                $uploadedfile = fopen($localfolder . $thumbnail, 'r');
                app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path_thumbnail . $thumbnail]);
                unlink($localfolder . $thumbnail);
            }
            $expiresAt = new \DateTime('20-12-2222');
            $thumbnailReference = app('firebase.storage')->getBucket()->object($firebase_storage_path_thumbnail . $thumbnail);
            if ($thumbnailReference->exists()) {
                $thumbnail_img = $thumbnailReference->signedUrl($expiresAt);
            }
        }

        // video preview
        if ($this->video_preview) {
            $getVideoPreview = $this->video_preview;
            $firebase_storage_path_video_preview = 'Users/' . $uid . '/Courses/' . $this->nama_kursus . '/preview/';
            $date = Carbon::now();
            $name = $date->getPreciseTimestamp(3);
            $localfolder = public_path('storage/users/' . $uid) . '/Courses/';
            $extension = $this->video_preview->getClientOriginalExtension();
            $preview = $name . '.' . $extension;
            if ($getVideoPreview->storeAs('public/users/' . $uid . '/Courses/', $preview)) {
                $uploadedfile = fopen($localfolder . $preview, 'r');
                app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path_video_preview . $preview]);
                unlink($localfolder . $preview);
            }

            $previewReference = app('firebase.storage')->getBucket()->object($firebase_storage_path_video_preview . $preview);
            if ($previewReference->exists()) {
                $preview_video = $previewReference->signedUrl($expiresAt);
            }
        }
        $db = app('firebase.firestore')->database();
        $course = $db->collection('Courses')->newDocument();
        $curriculum = $db->collection('Courses')->document($course->id())->collection('Curriculum')->newDocument();
        $curriculum_section = $db->collection('Courses')->document($course->id())->collection('Curriculum')->document($curriculum->id())->collection('Curriculum_section')->newDocument();

        $course->set([
            'name' => $this->nama,
            'id' => $course->id(),
            'preview_video_url' => $preview_video,
            'price' => $this->harga_kursus,
            'thumbnail_url' => $thumbnail_img,
            'time' => $this->waktu_kursus,
            'promo' => $this->promo,
            'code_promo' => $this->kode_promo,
            'discount' => $this->diskon,
            'updated_at' => Carbon::now()->toDayDateTimeString(),
            'created_at' => Carbon::now()->toDayDateTimeString(),
            'instructur' => $db->collection('Users')->document($uid),
            'Category_course' => $db->collection('Category_course')->document($this->kategori_kursus),
            'Category_level_type' => $db->collection('Category_level_type')->document($this->level_kursus),
            'Category_price_type' => $this->tipe_harga,
        ]);
        foreach ($this->tags_kursus as $key => $value) {
            $course->set([
                'Category_tags' => [
                    $db->collection('Category_tags')->document($value),
                ]
            ], ['merge' => true]);
        }
        // $materi_sub_materi[$key][$loop->index][$loop->parent->index]['nama_sub_materi']
        $parent = 0;
        foreach ($this->materi_sub_materi as $key => $value) {
            $child = 0;
            foreach ($value as $keys => $values) {
                // dd($this->materi_sub_materi, $key, $value, $keys, $values);
                if ($this->materi_sub_materi[$key][$child][$parent]['video_sub_materi']) {
                    $getVideo = $this->materi_sub_materi[$key][$child][$parent]['video_sub_materi'];
                    $firebase_storage_path_videos = 'Users/' . $uid . '/Courses/' . $this->nama_kursus . '/videos/';
                    $date = Carbon::now();
                    $name = $date->getPreciseTimestamp(3);
                    $localfolder = public_path('storage/users/' . $uid) . '/Courses/';
                    $extension = $this->materi_sub_materi[$key][$child][$parent]['video_sub_materi']->getClientOriginalName();
                    $video = $name . '.' . $extension;
                    if ($getVideo->storeAs('public/users/' . $uid . '/Courses/', $video)) {
                        $uploadedfile = fopen($localfolder . $video, 'r');
                        app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path_videos . $video]);
                        unlink($localfolder . $video);
                    }

                    $videoReference = app('firebase.storage')->getBucket()->object($firebase_storage_path_videos . $video);
                    if ($videoReference->exists()) {
                        $video = $videoReference->signedUrl($expiresAt);
                    }
                }
                $curriculum->set([
                    'id' => $curriculum->id(),
                    'name' => $key,
                    'created_at' => Carbon::now()->toDayDateTimeString(),
                    'updated_at' => Carbon::now()->toDayDateTimeString(),
                ]);
                $curriculum_section->set([
                    'id' => $curriculum_section->id(),
                    'name' => $this->materi_sub_materi[$key][$child][$parent]['nama_sub_materi'],
                    'video' => $video,
                    'description' => $this->materi_sub_materi[$key][$child][$parent]['deskripsi_sub_materi'],
                    'created_at' => Carbon::now()->toDayDateTimeString(),
                    'updated_at' => Carbon::now()->toDayDateTimeString(),
                ]);
                $child++;
            }
            $parent++;
        }
        return redirect()->route('instructur.dashboard');
    }
}
