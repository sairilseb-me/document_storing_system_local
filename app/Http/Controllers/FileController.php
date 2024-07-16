<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use App\Services\FileUploadServices;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Services\PingNas;
use Illuminate\Support\Facades\Validator;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->page)
        {
            $files = File::with('office')->paginate(10, ['*'], 'page', $request->page);
            return response()->json(['files' => $files], 200);
        }
        $files = File::with('office')->paginate(10);
        return response()->json(['files' => $files], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Search for files
     * @param string $title
     * @return \Illuminate\Http\Response
     */

     public function search($file_name)
     {
            $files = File::where('title', 'like', '%'.$file_name.'%')->paginate(10);
            return response()->json(['files' => $files], 200);
     }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, FileUploadServices $file_upload)
    {
    
        // $validate = $request->validate([
        //     'title' => 'required | string',
        //     'file' => 'required | file | mimes:doc,docx,pdf,xlsx,xls,ppt,pptx,txt',
        //     'office_id' => 'required | numeric',
        //     'remarks' => 'sometimes | string',
        //     'date_received' => 'required | date',
        // ]);

        $validate = Validator::make($request->all(), [
            'title' => 'required | string',
            'file' => 'required | file | mimes:doc,docx,pdf,xlsx,xls,ppt,pptx,txt',
            'office_id' => 'required | numeric',
            'remarks' => 'sometimes | string',
            'date_received' => 'required | date',
        ]);

        if ($validate->fails()) return response()->json(['message' => $validate->errors()], 422);

        $validated = $validate->validated();

        $path = $file_upload->upload($request->file('file'));
        $date = Carbon::parse($request->date_received);
        $localDate = $date->setTimezone('Asia/Manila')->format('Y-m-d H:i:s');

        $file = File::create([
            'title' => $validated['title'],
            'path' => $path,
            'user_id' => Auth::user()->id,
            'office_id' => $validated['office_id'],
            'remarks' => $validated['remarks'],
            'date_received' => $localDate,
        ]);

        if ($file) return response()->json(['message' => 'File uploaded successfully'], 200);
        return response()->json(['message' => 'Failed to upload file'], 500);
    }

    /**
     * Display the specified resource.
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
       
        $validate = $request->validate([
            'title' => 'required | string',
            'office_id' => 'required | numeric',
            'remarks' => 'sometimes | string',
            'date_received' => 'required | date',
        ]);

        $file = File::findOrFail($id);

        $file->title = $validate['title'];
        $file->office_id = $validate['office_id'];
        $file->remarks = $validate['remarks'];
        $file->date_received = $validate['date_received'];
        $file->save();

        if ($file) return response()->json(['message' => 'File updated successfully'], 200);
        return response()->json(['message' => 'Failed to update file'], 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $file = File::findOrFail($id);
        if ($file){
            $file->delete();
            return response()->json(['message' => 'File deleted successfully'], 200);
        }

        return response()->json(['message' => 'Failed to delete file'], 500);
    }

    public function download($id)
    {
        $file = File::find($id);
        return Storage::download($file->path);
    }

    public function check_nas()
    {
        $ping = new PingNas();
        $response = $ping->index();
        if ($response) return response()->json(['message' => 'NAS is online', 'response' => $response], 200);
        return response()->json(['message' => 'NAS is offline'], 500);
    }
}
