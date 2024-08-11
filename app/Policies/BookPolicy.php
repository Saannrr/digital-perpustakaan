<?php

namespace App\Policies;

use App\Models\Buku;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookPolicy
{
    public function view(User $user, Buku $book)
    {
        // Allow all users to view the book
        return true;
    }

    public function update(User $user, Buku $book)
    {
        // Allow only the owner or an admin to update the book
        return $user->id === $book->user_id || $user->hasRole('admin');
    }

    public function delete(User $user, Buku $book)
    {
        // Allow only the owner or an admin to delete the book
        return $user->id === $book->user_id || $user->hasRole('admin');
    }
}
