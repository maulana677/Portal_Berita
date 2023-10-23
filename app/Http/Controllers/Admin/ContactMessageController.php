<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\Contact;
use App\Models\RecivedMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactMessageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:contact message index,admin'])->only(['index']);
        $this->middleware(['permission:contact message update,admin'])->only(['sendReply']);
    }

    public function index()
    {
        RecivedMail::query()->update(['seen' => 1]);

        $messages = RecivedMail::all();
        return view('admin.contact-message.index', compact('messages'));
    }

    public function sendReply(Request $request)
    {
        $request->validate([
            'subject' => ['required', 'max:255'],
            'message' => ['required']
        ]);

        try {
            $contact = Contact::where('language', 'en')->first();

            /** kirim ke email */
            Mail::to($request->email)->send(new ContactMail($request->subject, $request->message, $contact->email));

            $makeReplied = RecivedMail::find($request->message_id);
            $makeReplied->replied = 1;
            $makeReplied->save();

            toast(__('Mail Sent Successfully!'), 'success');

            return redirect()->back();
        } catch (\Throwable $th) {
            toast($th->getMessage(), 'error');

            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        RecivedMail::findOrFail($id)->delete();

        return response(['status' => 'success', 'message' => __('Deleted Successfully!')]);
    }
}
