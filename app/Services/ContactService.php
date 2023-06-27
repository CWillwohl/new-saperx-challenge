<?php

namespace App\Services;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Collection;

class ContactService
{

    public function index() : Collection
    {
        return Contact::all();
    }

    public function create(Array $data) : Contact
    {
        return Contact::create($data);
    }

    public function update(Array $data, Contact $contact) : Contact
    {
        $contact->update($data);

        return $contact;
    }

    public function destroy(Contact $contact) : void
    {
        $contact->delete();
    }
}
