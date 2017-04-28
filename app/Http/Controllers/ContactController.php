<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Contact;
use Illuminate\Support\Facades\Validator;
use DateTime;

class ContactController extends Controller
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
        $userId = Auth::id();
        $contacts = Contact::where('userId', $userId)->simplePaginate(10);

        foreach ($contacts as $contact) {
            $birthdate = new DateTime($contact->dob);
            $now = new DateTime();
            $age = $now->diff($birthdate);
            $contact->age = $age->y;
        }

        if (session()->has('error')) {
            return view('contacts.contactList')->with('contacts', $contacts)->with('error', session()->get('error'));
        }

        return view('contacts.contactList')->with('contacts', $contacts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (session()->has('error')) {
            return view('contacts.addContact')->with('error', session()->get('error'));
        }
        if (session()->has('success')) {
            return view('contacts.addContact')->with('success', session()->get('success'));
        }
        return view('contacts.addContact');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $dob = $request->input('dob');
        $address = $request->input('address');
        $organization = $request->input('organization');
        $userId = Auth::id();
        $gender = $request->input('gender');
        

        $validator = Validator::make(
            array(
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'dob' => $dob,
                'address' => $address,
                'organization' => $organization,
                'gender' => $gender
            ),
            array(
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'dob' => 'required',
                'address' => 'required',
                'organization' => 'required',
                'gender' => 'required'
            )
        );
        if ($validator->fails()) {
            $error_messages = $validator->messages()->all();
            return redirect('/contacts/create')->with('error', 'Please fill all fields');
        } else {
            if (strtotime($dob) > strtotime(date('Y-m-d'))) {
                return redirect('/contacts/create')->with('error', 'Please do not enter future Date of Birth');
            }
            $contact = new Contact;
            $contact->name = $name;
            $contact->email = $email;
            $contact->phone = $phone;
            $contact->dob = $dob;
            $contact->address = $address;
            $contact->gender = $gender;
            $contact->organization = $organization;
            $contact->userId = $userId;
            $contact->save();
            return redirect('/contacts/create')->with('success', 1);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userId = Auth::id();
        $contact = Contact::where('id', $id)
                        ->where('userId', $userId)
                        ->first();

        if (!$contact) {
            return redirect('/contacts')
                        ->with('error', 'You are not authorized to update this contact.');
        }

        return view('contacts.showContact')->with('contact', $contact);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userId = Auth::id();
        $contact = Contact::where('id', $id)
                        ->where('userId', $userId)
                        ->first();

        if (!$contact) {
            return redirect('/contacts')
                        ->with('error', 'You are not authorized to update this contact.');
        }

        if (session()->has('error')) {
            return view('contacts.editContact')
                        ->with('error', session()->get('error'))
                        ->with('contact', $contact);
        }
        if (session()->has('success')) {
            return view('contacts.editContact')
                        ->with('success', session()->get('success'))
                        ->with('contact', $contact);
        }

        return view('contacts.editContact')->with('contact', $contact);
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
        $userId = Auth::id();
        $contact = Contact::where('id', $id)
                        ->where('userId', $userId)
                        ->first();

        if (!$contact) {
            return redirect('/contacts')->with('error', 'You are not authorized to update this contact.');
        }
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $dob = $request->input('dob');
        $address = $request->input('address');
        $organization = $request->input('organization');
        $gender = $request->input('gender');
        

        $validator = Validator::make(
            array(
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'dob' => $dob,
                'address' => $address,
                'organization' => $organization,
                'gender' => $gender
            ),
            array(
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'dob' => 'required',
                'address' => 'required',
                'organization' => 'required',
                'gender' => 'required'
            )
        );
        if ($validator->fails()) {
            $error_messages = $validator->messages()->all();
            return redirect()->route('contacts.edit', $id)->with('error', 'Please fill all fields');
        } else {
            if (strtotime($dob) > strtotime(date('Y-m-d'))) {
                return redirect()->route('contacts.edit', $id)
                                ->with('error', 'Please do not enter future Date of Birth');
            }
            $contact->name = $name;
            $contact->email = $email;
            $contact->phone = $phone;
            $contact->dob = $dob;
            $contact->gender = $gender;
            $contact->address = $address;
            $contact->organization = $organization;
            $contact->save();
            return redirect()->route('contacts.edit', $id)->with('success', 1);
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
        $userId = Auth::id();
        $contact = Contact::where('id', $id)
                        ->where('userId', $userId)
                        ->first();

        if (!$contact) {
            return redirect('/contacts')->with('error', 'You are not authorized to delete this contact.');
        }

        $contact->delete();
    }

    //Searching for a contact
    public function search(Request $request)
    {
        $searchText = $request->input('searchText');
        if ($searchText == '') {
            return redirect('/contacts');
        } else {
            $contacts = Contact::where("name", 'LIKE', '%'.$searchText.'%')->simplePaginate(10);
        }
        if (count($contacts) > 0) {
            foreach ($contacts as $contact) {
                $birthdate = new DateTime($contact->dob);
                $now = new DateTime();
                $age = $now->diff($birthdate);
                $contact->age = $age->y;
            }
        }
        return view('contacts.contactList')
                ->with('contacts', $contacts)
                ->with('searchText', $searchText);
    }
}
