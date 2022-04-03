<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;

class FileUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['files'] = File::orderBy('id','desc')->paginate(20);
        return view('fileUpload',$data);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,xlx,csv|max:9048',
        ]);
        
        $file = $request->file('file');
        $fileOriginalName = $file->getClientOriginalName();


        $fileName = time().'.'.$request->file->extension();  
        $type = $request->file->extension();
     
        $request->file->move(public_path('uploads'), $fileName);
   

        $file = new File;
        $file->name = $fileName;
        $file->originalName = $fileOriginalName;
        $file->type = $type;
        $file->save();
     
        return back()
            ->with('success','You have successfully upload file.')
            ->with('file', $fileName);
   
    }

    public function edit(Request $request,$id)
    {
        $file = File::find($id);
        $fileOriginalName = $file->originalName;
        $fileName = $file->name;
        $type = $file->type;
        $file->save();

        $filePath = 'uploads/'.$fileName ;
    	$headers = ['Content-Type: application/pdf'];
    	$tmp = $fileOriginalName;

    	return response()->download($filePath, $tmp, $headers) ;
        
    }

    public function destroy(Request $request, $id)
    {
        $file = File::find($id);
        $fileName = $file->name;
        $file->delete();

        unlink("uploads/$fileName");

        return back()
            ->with('success','You have successfully upload file.')
            ->with('file', $fileName);
    }
}