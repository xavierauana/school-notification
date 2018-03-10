<?php

namespace Anacreation\School\Notification\Http\Controllers;

use Anacreation\School\Notification\Models\Contact;
use Anacreation\School\Notification\Models\Email;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Contact $repo) {
        $contacts = $repo->all();

        return view("notification::contacts.index", compact("contacts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view("notification::contacts.create", compact("contacts"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(
        Request $request, Contact $contactRepo, Email $emailRepo
    ) {
        $validatedData = $this->validate($request, [
            'first_name' => "required",
            'last_name'  => "required",
            'email.*'    => "nullable|email",
            'mobile'     => "nullable",
        ]);
        $new_contact = $contactRepo->create($validatedData);
        foreach ($validatedData['email'] as $address) {
            $email = $emailRepo->create(compact('address'));
            $new_contact->addChannel($email);
        }

        return redirect()->route('contacts.index')
                         ->withStatus("{$new_contact->full_name} has created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Contact                  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact) {
        //
    }
}
