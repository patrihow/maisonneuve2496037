<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = Document::with('user')->orderByDesc('created_at')->paginate(10);
        return view('documents.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('documents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required_without:title_fr|max:255',
            'title_fr' => 'required_without:title_en|max:255',
            'file' => 'required|mimes:pdf,zip,doc,docx|max:20480'
        ]);

        $path = $request->file('file')->store('documents', 'public');

        Document::create([
            'title_en' => $request->title_en,
            'title_fr' => $request->title_fr,
            'file_path' => $path,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('documents.index')->with('success', __('forum.document_uploaded'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
         $this->authorize('update', $document);
        return view('documents.edit', compact('document'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        $this->authorize('update', $document);
        $request->validate([
            'title_en' => 'required_without:title_fr|max:255',
            'title_fr' => 'required_without:title_en|max:255',
            'file' => 'nullable|mimes:pdf,zip,doc,docx|max:20480'
        ]);
        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($document->file_path);
            $document->file_path = $request->file('file')->store('documents', 'public');
        }
        $document->update($request->only('title_en', 'title_fr'));
        $document->save();
        return redirect()->route('documents.index')->with('success', __('forum.document_updated'));
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        $this->authorize('delete', $document);
        Storage::disk('public')->delete($document->file_path);
        $document->delete();
        return redirect()->route('documents.index')->with('success', __('forum.document_deleted'));
    }
}
