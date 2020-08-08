<?php 

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\AuthorizationException;

class ApiController extends Controller
{
    use ApiResponser;

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    protected function allowedAdminActions()
    {
    	if (Gate::denies('admin-actions')) {
    		throw new AuthorizationException("This action is unauthorized!");
    	}
    }
}