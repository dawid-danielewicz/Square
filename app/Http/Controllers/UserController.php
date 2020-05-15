<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\RepositoryInterface;
use App\Http\Gateways\Gateway;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(RepositoryInterface $R, Gateway $G) {
        $this->R = $R;
        $this->G = $G;
    }

    public function edit() {
        $user = Auth::user();
        return view('users.edit', ['user' => $user]);
    }

    public function store(Request $request) {
        $this->G->updateUser($request);
        return redirect()->back();
    }
}
