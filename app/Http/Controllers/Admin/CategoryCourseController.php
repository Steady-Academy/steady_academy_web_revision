<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Auth;
use Kreait\Auth\Request\UpdateUser;
use Kreait\Firebase\Exception\FirebaseException;
use RealRashid\SweetAlert\Facades\Alert;

use Carbon\Carbon;

class CategoryCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

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


    public function index(Request $request)
    {

        if ($request->ajax()) {
            $category = app('firebase.firestore')->database();
            $category_course = $category->collection('Category_course');
            $query = $category_course->orderBy('created_at', 'DESC');
            $snapshot = $this->getSnapshot($query);
            $data = json_decode($snapshot);


            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('photo', function ($data) {
                    return view('admin.categories.course_category.partialsTable.picture')->with('data', $data);
                })
                ->addColumn('action', function ($data) {
                    return view('admin.categories.course_category.partialsTable.button', compact('data'));
                })
                ->editColumn('created_at', function ($data) {
                    $date = Carbon::parse($data->created_at);
                    $date->settings(['formatFunction' => 'translatedFormat']);
                    $created_at = $date->format('l, j F Y  h:i a');
                    return $created_at;
                })
                ->editColumn('updated_at', function ($data) {
                    $date = Carbon::parse($data->updated_at);
                    $date->settings(['formatFunction' => 'translatedFormat']);
                    $updated_at = $date->format('l, j F Y  h:i a');
                    return $updated_at;
                })
                ->rawColumns(['photo', 'action'])
                ->make(true);
        }
        return view('admin.categories.course_category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.course_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'photo' => 'required|image|mimes:svg,png,jpg|max:2024',
            'nama_kategori' => 'required|string|max:50',
            'deskripsi_kategori' => 'required|string|max:255',
        ]);

        $date = Carbon::now();
        $db = app('firebase.firestore')->database()->collection('Category_course')->newDocument();

        $getPhoto = $validate['photo'];
        $firebase_storage_path_categories = 'Categories/' . $db->id() . '/Photo/';
        $name = $db->id();
        $localfolder = public_path('storage/categories/' . $db->id() . '/Photo/');
        $extension = $validate['photo']->getClientOriginalExtension();
        $photo = $name . '.' . $extension;

        if ($getPhoto->storeAs('public/categories/' . $db->id() . '/Photo/', $photo)) {
            $uploadedfile = fopen($localfolder . $photo, 'r');
            app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path_categories . $photo]);
            unlink($localfolder . $photo);
        }
        $expiresAt = new \DateTime('20-12-2222');
        $imageReference = app('firebase.storage')->getBucket()->object($firebase_storage_path_categories . $photo);
        if ($imageReference->exists()) {
            $photo = $imageReference->signedUrl($expiresAt);
        }

        $create = $db->set([
            'id' => $db->id(),
            'photoUrl' => $photo,
            'name' => $validate['nama_kategori'],
            'description' => $validate['deskripsi_kategori'],
            'created_at' => new \Google\Cloud\Core\Timestamp($date),
            'updated_at' => new \Google\Cloud\Core\Timestamp($date),
        ]);

        if ($create) {
            toast('Berhasil menambahkan kategori ' . $validate['nama_kategori'], 'success')->padding('8px');
            return redirect()->route('admin.kursus_kategori.index');
        }
        toast('Gagal menambahkan kategori ' . $validate['nama_kategori'], 'danger')->padding('8px');
        return redirect()->route('admin.kursus_kategori.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category_course = app('firebase.firestore')->database()->collection('Category_course')->document($id)->snapshot();
        return view('admin.categories.course_category.edit', compact('category_course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'photo' => 'required|image|mimes:svg,png,jpg|max:2024',
            'nama_kategori' => 'required|string|max:50',
            'deskripsi_kategori' => 'required|string|max:255',
        ]);

        $date = Carbon::now();
        $db = app('firebase.firestore')->database()->collection('Category_course')->document($id);

        if (!$request->photo) {
            $request->photo = $request->oldPhoto;
        } else {
            // hardcoded get photo from url
            $old = $request->oldPhoto;
            $decode = urldecode($old);
            $url_token = explode('?', $decode);
            $url = explode('/', $url_token[0]);
            $oldPhoto = $url[4] . '/' . $url[5] . '/' . $url[6] . '/' . $url[7];
            $imageDeleted = app('firebase.storage')->getBucket()->object($oldPhoto)->delete();

            $getPhoto = $request->photo;
            $firebase_storage_path_categories = 'Categories/' . $db->id();
            $name = $db->id();
            $localfolder = public_path('storage/categories/' . $db->id());
            $extension = $request->photo->getClientOriginalExtension();
            $photo = $name . '.' . $extension;

            if ($getPhoto->storeAs('public/categories/' . $db->id(), $photo)) {
                $uploadedfile = fopen($localfolder . $photo, 'r');
                app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path_categories . $photo]);
                unlink($localfolder . $photo);
            }
            $expiresAt = new \DateTime('20-12-2222');
            $imageReference = app('firebase.storage')->getBucket()->object($firebase_storage_path_categories . $photo);
            if ($imageReference->exists()) {
                $photo = $imageReference->signedUrl($expiresAt);
            }
        }

        if ($request->photo == $request->oldPhoto) {
            $create = $db->set([
                'id' => $db->id(),
                'photoUrl' => $request->photo,
                'name' => $validate['nama_kategori'],
                'description' => $validate['deskripsi_kategori'],
                'created_at' => new \Google\Cloud\Core\Timestamp($date),
                'updated_at' => new \Google\Cloud\Core\Timestamp($date),
            ], ['merge' => true]);
        } else {
            $create = $db->set([
                'id' => $db->id(),
                'photoUrl' => $photo,
                'name' => $validate['nama_kategori'],
                'description' => $validate['deskripsi_kategori'],
                'created_at' => new \Google\Cloud\Core\Timestamp($date),
                'updated_at' => new \Google\Cloud\Core\Timestamp($date),
            ], ['merge' => true]);
        }

        if ($create) {
            toast('Berhasil menambahkan kategori ' . $validate['nama_kategori'], 'success')->padding('8px');
            return redirect()->route('admin.kursus_kategori.index');
        }
        toast('Gagal menambahkan kategori ' . $validate['nama_kategori'], 'danger')->padding('8px');
        return redirect()->route('admin.kursus_kategori.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $snapshot = app('firebase.firestore')->database()->collection('Category_course')->document($id)->snapshot();
        $old = $snapshot->data()['photoUrl'];

        $decode = urldecode($old);
        $url_token = explode('?', $decode);
        $url = explode('/', $url_token[0]);
        $photo = $url[4] . '/' . $url[5] . '/' . $url[6] . '/' . $url[7];
        $imageDeleted = app('firebase.storage')->getBucket()->object($photo)->delete();

        $snapshot = app('firebase.firestore')->database()->collection('Category_course')->document($id)->delete();
        toast('Berhasil menghapus kategori ', 'success')->padding('8px');
        return redirect()->back();
    }
}
