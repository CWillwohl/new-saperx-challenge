<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PhoneBook\{
    ApiStorePhoneBookRequest,
    ApiUpdatePhoneBookRequest
};

use App\Http\Resources\PhoneBookResource;
use App\Models\PhoneBook;
use App\Services\PhoneBookService;

class PhoneBookController extends Controller
{
    public function __construct(
        protected PhoneBookService $phoneBookService,
    ) {}

    public function index()
    {
        $data = $this->phoneBookService->index();

        if($data) {
            return PhoneBookResource::collection($data);
        }
    }

    public function store(ApiStorePhoneBookRequest $request)
    {
        $data = $request->validated();

        $phoneBook = $this->phoneBookService->create($data);

        return new PhoneBookResource($phoneBook);
    }

    public function update(ApiUpdatePhoneBookRequest $request, $idPhoneBook)
    {
        $data = $request->validated();

        $phoneBook = PhoneBook::find($idPhoneBook);

        if(!$phoneBook) {
            return response()->json('Error, phone book not found', 404);
        }

        $phoneBook = $this->phoneBookService->update($data, $phoneBook);
        return new PhoneBookResource($phoneBook);
    }

    public function destroy($idPhoneBook)
    {
        $phoneBook = PhoneBook::find($idPhoneBook);

        if($phoneBook) {

            $this->phoneBookService->destroy($phoneBook);

            return response()->json('Phone book deleted', 204);
        }

        return response()->json('Error, phone book not found', 404);
    }
}
