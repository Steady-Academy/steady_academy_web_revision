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

class CategoryTagsController extends Controller
{
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $category = app('firebase.firestore')->database();
            $category_course = $category->collection('Category_tags');
            $query = $category_course->orderBy('created_at', 'DESC');
            $snapshot = $this->getSnapshot($query);
            $data = json_decode($snapshot);


            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return view('admin.categories.tags.partialsTable.button', compact('data'));
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
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.categories.tags.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.tags.create');
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
            'nama_tags' => 'required|string|max:50',
        ]);
        $db = app('firebase.firestore')->database()->collection('Category_tags')->newDocument();
        $date = Carbon::now();
        $create = $db->set([
            'id' => $db->id(),
            'name' => $validate['nama_tags'],
            'created_at' => new \Google\Cloud\Core\Timestamp($date),
            'updated_at' => new \Google\Cloud\Core\Timestamp($date),
        ]);

        if ($create) {
            toast('Berhasil menambahkan tags ' . $validate['nama_tags'], 'success')->padding('8px');
            return redirect()->route('admin.tags.index');
        }
        toast('Gagal menambahkan tags ' . $validate['nama_tags'], 'danger')->padding('8px');
        return redirect()->route('admin.tags.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tags = app('firebase.firestore')->database()->collection('Category_tags')->document($id)->snapshot();
        return view('admin.categories.tags.edit', compact('tags'));
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
            'nama_tags' => 'required|string|max:50',
        ]);

        $db = app('firebase.firestore')->database()->collection('Category_tags')->document($id);

        $create = $db->set([
            'id' => $db->id(),
            'name' => $validate['nama_tags'],
            'updated_at' => new \Google\Cloud\Core\Timestamp(Carbon::now()),
        ], ['merge' => true]);

        if ($create) {
            toast('Berhasil mengubah tags ' . $validate['nama_tags'], 'success')->padding('8px');
            return redirect()->route('admin.tags.index');
        }
        toast('Gagal mengubah tags ' . $validate['nama_tags'], 'danger')->padding('8px');
        return redirect()->route('admin.tags.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $snapshot = app('firebase.firestore')->database()->collection('Category_tags')->document($id)->delete();
        if ($snapshot) {
            toast('Berhasil menghapus tags ', 'success')->padding('8px');
            return redirect()->back();
        }
        toast('Gagal menghapus tags ', 'danger')->padding('8px');
        return redirect()->back();
    }
}
