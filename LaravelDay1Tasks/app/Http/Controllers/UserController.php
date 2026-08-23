<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    private $users = [

        [
            "id" => 1,
            "name" => "Ahmed",
            "email" => "ahmed@gmail.com",
            "age" => 22
        ],

        [
            "id" => 2,
            "name" => "Mohamed",
            "email" => "mohamed@gmail.com",
            "age" => 24
        ],

        [
            "id" => 3,
            "name" => "Ali",
            "email" => "ali@gmail.com",
            "age" => 21
        ]

    ];

    public function index()
    {
        return view('index', [
            'users' => $this->users
        ]);
    }

    public function show($id)
    {
        $user = collect($this->users)->firstWhere('id', $id);

        return view('show', compact('user'));
    }
}