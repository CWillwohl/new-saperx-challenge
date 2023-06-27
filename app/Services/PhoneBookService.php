<?php

namespace App\Services;

use App\Models\PhoneBook;
use Illuminate\Database\Eloquent\Collection;

class PhoneBookService
{

    public function index() : Collection
    {
        return PhoneBook::all();
    }

    public function create(Array $data) : PhoneBook
    {
        return PhoneBook::create($data);
    }

    public function update(Array $data, PhoneBook $phoneBook) : PhoneBook
    {
        $phoneBook->update($data);

        return $phoneBook;
    }

    public function destroy(PhoneBook $phoneBook) : void
    {
        $phoneBook->delete();
    }
}
