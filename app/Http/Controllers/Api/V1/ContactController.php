<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use App\Http\Requests\Api\Contact\{
    ApiStoreContactRequest,
    ApiUpdateContactRequest
};

use App\Http\Resources\ContactResource;
use App\Models\Contact;
use App\Services\ContactService;

class ContactController extends Controller
{
    public function __construct(
        protected ContactService $contactService,
    ) {}

    public function index()
    {
        $data = $this->contactService->index();

        if($data) {
            return ContactResource::collection($data);
        }
    }

    public function store(ApiStoreContactRequest $request, $idPhoneBook)
    {
        $data = $request->validated();
        $data['phone_book_id'] = $idPhoneBook;

        $contact = $this->contactService->create($data);

        return new ContactResource($contact);
    }

    public function update(ApiUpdateContactRequest $request, $idPhoneBook, $idContact)
    {
        $data = $request->validated();

        $data['phone_book_id'] = $idPhoneBook;

        $contact = Contact::findOrFail($idContact);

        if(!$contact) {
            return response()->json('Error, contact not found', 404);
        }

        $contact = $this->contactService->update($data, $contact);

        return new ContactResource($contact);
    }

    public function destroy($idPhoneBook, $idContact)
    {
        $contact = Contact::where('phone_book_id', $idPhoneBook)->findOrFail($idContact);

        if(!$contact) {
            return response()->json('Error, contact not found', 404);
        }

        $this->contactService->destroy($contact);

        return response()->json('Contact deleted', 204);
    }
}
