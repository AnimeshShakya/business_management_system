<?php

namespace Modules\AdminModule\Http\Middleware;

use Brian2694\Toastr\Facades\Toastr;
use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && in_array(auth()->user()->user_type, ADMIN_USER_TYPES)) {

            $user = auth()->user();

            if ($user->user_type === 'admin-employee') {
                if ($user->is_active == 0) {
                    auth()->guard('web')->logout();
                    Toastr::warning(translate('Your account is inactive. Please contact the admin.'));
                    return redirect('admin/auth/login');
                }

                $role = $user->roles->first();
                if (!$role || $role->is_active == 0) {
                    auth()->guard('web')->logout();
                    Toastr::warning(translate('Your role is inactive or not assigned. Please contact the admin.'));
                    return redirect('admin/auth/login');
                }
            }

            return $next($request);
        }

        Toastr::info(ACCESS_DENIED['message']);
        return redirect('admin/auth/login');
    }
}
