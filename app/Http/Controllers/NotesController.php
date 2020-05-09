<?php

namespace App\Http\Controllers;

use App\Http\Gateways\Gateway;
use App\Interfaces\RepositoryInterface;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function __construct(RepositoryInterface $R, Gateway $G) {
        $this->R = $R;
        $this->G = $G;
    }

    public function index() {
        $notes = $this->R->getNotes();
        return view('notes.index', ['notes' => $notes]);
    }

    public function addNote() {
        return view('notes.addNote');
    }

    public function editNote($id) {
        $note = $this->R->getNote($id);
        return view('notes.addNote', ['note' => $note]);
    }

    public function store(Request $request, $id=null) {
        if(isset($id)){
            $this->G->createNote($request, $id);
            return redirect()->route('notes');

        } else {
            $this->G->createNote($request);
            return redirect()->route('notes');
        }
    }

    public function delete($id) {
        $note = $this->R->deleteNote($id);
        return redirect()->back();
    }

    public function searchNote(Request $request) {
        $results = $this->G->searchNote($request);
        return response()->json($results);
    }

    public function searchResult(Request $request) {
        if($notes = $this->G->getSearchedNotes($request))
            return view('notes.index', ['notes' => $notes]);
        else
            return redirect('/notes')->with('no_notes', 'Nie ma notatek o podanej nazwie');
    }
}
