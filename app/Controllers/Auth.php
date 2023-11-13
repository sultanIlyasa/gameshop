<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Controllers\BaseController;

class Auth extends BaseController
{
    public function index()
    {
        //
        return view('pages/auth/login');
    }

    public function login(){
        $session = session();

        helper(['form']);

        $rules = [
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email harus diisi',
                    'valid_email' => 'Email tidak valid'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]|max_length[20]',
                'errors' => [
                    'required' => 'Password harus diisi',
                    'min_length' => 'Password harus memiliki setidaknya 8 karakter',
                    'max_length' => 'Password harus memiliki paling banyak 20 karakter'
                ],
            ],
        ];

        if(!$this->validate($rules)){
            session()->setFlashdata('error', $this->validator->getErrors());
            return view('pages/auth/login');
        } else {
            $user = new UserModel();

            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');

            $data = $user->where('email', $email)->first();

            if($data){
                $isPasswordTrue = password_verify($password, $data['password']);

                if($isPasswordTrue){
                    $sessionData = [
                        'user_id' => $data['user_id'],
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'role' => $data['role'],
                        'isLoggedIn' => TRUE
                    ];

                    $session->set($sessionData);
                    $session->setFlashdata('success', 'Welcome back, ' . $data['name']);
                    if($data['role'] == 'admin'){
                        return redirect()->to('/user');
                    } else {
                        return redirect()->to('/');
                    }
                } else {
                    $session->setFlashdata('error', 'Password salah');
                    return redirect()->to('/login');
                }
            } else {
                $session->setFlashdata('error', 'Email tidak terdaftar');
                return redirect()->to('/login');
            }
        }
    }

    public function logout(){
        session()->destroy();
        return redirect()->to('/');
    }

    public function forgotPassword(){
        return view('pages/auth/forgot-password');
    }

    public function changePassword(){
        helper(['form']);

        $rules = [
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email harus diisi',
                    'valid_email' => 'Email tidak valid'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]|max_length[20]',
                'errors' => [
                    'required' => 'Password harus diisi',
                    'min_length' => 'Password harus memiliki setidaknya 8 karakter',
                    'max_length' => 'Password harus memiliki paling banyak 20 karakter'
                ],
            ],
            'confirm_password' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Konfirmasi password harus diisi',
                    'matches' => 'Konfirmasi password tidak sesuai'
                ],
            ],
        ];

        if(!$this->validate($rules)){
            session()->setFlashdata('error', $this->validator->getErrors());
            return view('pages/auth/forgot-password');
        } else {
            $user = new UserModel();

            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');

            $data = $user->where('email', $email)->first();

            if($data){
                $user->update($data['user_id'], [
                    'password' => password_hash($password, PASSWORD_DEFAULT)
                ]);

                session()->setFlashdata('success', 'Password berhasil diubah');
                return redirect()->to('/login');
            }else {
                session()->setFlashdata('error', 'Email tidak terdaftar');
                return redirect()->to('/forgot-password');
            }
        }
    }

    public function registerView(){
        return view('pages/auth/register');
    }

    public function register(){
        helper(['form']);

        $rules = [
            'name' => [
                'rules' => 'required|min_length[3]|max_length[20]',
                'errors' => [
                    'required' => 'Nama harus diisi',
                    'min_length' => 'Nama harus memiliki setidaknya 3 karakter',
                    'max_length' => 'Nama harus memiliki paling banyak 20 karakter'
                ],
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'Email harus diisi',
                    'valid_email' => 'Email tidak valid',
                    'is_unique' => 'Email sudah terdaftar'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]|max_length[20]',
                'errors' => [
                    'required' => 'Password harus diisi',
                    'min_length' => 'Password harus memiliki setidaknya 8 karakter',
                    'max_length' => 'Password harus memiliki paling banyak 20 karakter'
                ],
            ],
            'confirm_password' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Konfirmasi password harus diisi',
                    'matches' => 'Konfirmasi password tidak sesuai'
                ],
            ],
        ];

        if(!$this->validate($rules)){
            session()->setFlashdata('error', $this->validator->getErrors());
            return view('pages/auth/register');
        } else {
            $user = new UserModel();

            $name = $this->request->getVar('name');
            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');

            $user->save([
                'name' => $name,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'role' => 'user'
            ]);

            session()->setFlashdata('success', 'Akun berhasil dibuat');
            return redirect()->to('/login');
        }
    }
}
