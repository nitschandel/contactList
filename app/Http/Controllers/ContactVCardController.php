<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JeroenDesloovere\VCard\VCard;
use App\Contact;
use Illuminate\Support\Facades\Auth;

class ContactVCardController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }


    //Saving card for single contact

    public function singleContactVCard($id)
    {
    	$userId = Auth::id();
        $contact = Contact::where('id',$id)
                        ->where('userId',$userId)
                        ->first();

        if(!$contact){
            return false;
        }

        //VCard Object Created
        $vcard = new VCard();

        //adding all data
        $vcard->addName($contact->name);
        $vcard->addCompany($contact->organization);
		$vcard->addEmail($contact->email);
		$vcard->addPhoneNumber($contact->phone);
		$vcard->addAddress(null, null, $contact->address);
		$vcard->addBirthday($contact->dob);

        return $vcard->download();
    }

    public function FunctionName()
    {
        $userId = Auth::id();
        $contact = Contact::where('userId',$userId)
                        ->first();

        if(count($contact) == 0){
            return false;
        }

        foreach ($contacts as $contact) {

            //VCard Object Created
            $vcard = new VCard();

            //adding all data
            $vcard->addName($contact->name);
            $vcard->addCompany($contact->organization);
            $vcard->addEmail($contact->email);
            $vcard->addPhoneNumber($contact->phone);
            $vcard->addAddress(null, null, $contact->address);
            $vcard->addBirthday($contact->dob);

        }

        return $vcard->download();
    }
}
