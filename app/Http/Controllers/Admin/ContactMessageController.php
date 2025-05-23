<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactMessage;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(10);
        return view('admin.contact_messages.index', compact('messages'));
    }

    public function deleteSelected(Request $request)
    {
        $ids = $request->input('selected', []);
        if (!empty($ids)) {
            ContactMessage::whereIn('id', $ids)->delete();
            return redirect()->route('admin.contact_messages.index')->with('success', 'Messages supprimés avec succès.');
        }
        return redirect()->route('admin.contact_messages.index')->with('error', 'Aucun message sélectionné.');
    }
    public function listMessages(Request $request)
{
    $query = ContactMessage::query();

    if ($search = $request->input('search')) {
        $query->where('name', 'like', "%$search%")
              ->orWhere('email', 'like', "%$search%")
              ->orWhere('message', 'like', "%$search%");
    }

    $messages = $query->latest()->paginate(10);

    return view('admin.contact_messages.index', compact('messages'));
}
      
}