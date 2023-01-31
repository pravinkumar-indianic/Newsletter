<?php
namespace Indianic\Newsletter\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class NewslettersPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any newsletters.
     *
     * @param Admin $user
     * @return bool
     */
    public function viewAny(Admin $user): bool
    {
        return $user->hasPermissionTo('view newsletters');
    }

    /**
     * Determine whether the user can view the newsletters.
     *
     * @param Admin $user
     * @return bool
     */
    public function view(Admin $user): bool
    {
        return ( $user->hasPermissionTo('view newsletters'));
    }

    /**
     * Determine whether the user can create newsletters.
     *
     * @param Admin $user
     * @return bool
     */
    public function create(Admin $user): bool
    {
        return ( $user->hasPermissionTo('create newsletters'));
    }

    /**
     * Determine whether the user can update the newsletters.
     *
     * @param Admin $user
     * @return bool
     */
    public function update(Admin $user): bool
    {
        return $user->hasPermissionTo('update newsletters');
    }

    /**
     * Determine whether the user can delete the newsletters.
     *
     * @return Response|bool
     */
    public function delete(): Response|bool
    {
        return $user->hasPermissionTo('delete newsletters');
    }
}
