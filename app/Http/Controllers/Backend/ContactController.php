<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact = Contact::orderBy('id', 'DESC')->get();
        return view('backend.contact.danhsach', compact(['contact']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $contact = Contact::find($id);
        return view('backend.contact.sua', compact(['contact']));
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
        $contact = Contact::find($id);
        $contact->status = $request->status;
        $contact->reply = $request->reply;
        $contact->save();
        try {
            Mail::send('frontend.email.contact_admin', ['reply' => $request->reply, 'name' => $contact->fullname, 'email' => $contact->email, 'address' => $contact->address, 'title' => $contact->title, 'content' => $contact->content], function ($message) use ($contact) {
                //$message->from('john@johndoe.com', 'John Doe');
                // $message->sender('john@johndoe.com', 'John Doe');
                $message->to($contact->email, $contact->fullname);
                //$message->cc('john@johndoe.com', 'John Doe');
                $message->bcc('nguyenphuochao456@gmail.com', 'Nguyễn Phước Hảo');
                // $message->replyTo('john@johndoe.com', 'John Doe');
                $message->subject('Thư phản hồi của nobita');
                //$message->priority(3);
                //$message->attach('pathToFile');
                return redirect()->route('contact.index')->with(['mess' => 'Gửi thông tin thành công. Chúng tôi sẽ phản hồi bạn sớm nhất', 'type' => 'success']);
            });
        } catch (Throwable $e) {
            return redirect()->route('contact.index')->with(['mess' => $e->getMessage(), 'type' => 'danger']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);
        $contact->delete();
        return redirect()->route('contact.index')->with(['mess' => 'Xóa thành công liên hệ']);
    }
}
