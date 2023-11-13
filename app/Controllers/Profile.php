<?php

namespace App\Controllers;

use App\Models\TransactionModel;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class Profile extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    use ResponseTrait;
    public function index()
    {
        //
        $user = new UserModel();
        $transactions = new TransactionModel();

        $user_id = session()->get('user_id');

        $data['user'] = $user->where('user_id', $user_id)->first();
        $data['transactions'] = $transactions->join('games', 'games.game_id = transactions.game_id')->where('user_id', $user_id)->findAll();

        // $response = [
        //     'status' => 200,
        //     'error' => null,
        //     'messages' => "Success",
        //     "data" => $data
        // ];

        // return $this->respond($response);

        return view('pages/profile/show', $data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        //
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
        $user = new UserModel();

        $data['user'] = $user->where('user_id', $id)->first();

        return view('pages/profile/edit', $data);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
      public function update($id = null)
    {
        //
        helper(['form']);

        $rules = [
            'name' => [
                'rules' => 'required|min_length[3]|max_length[20]',
                'errors' => [
                    'required' => 'Nama harus diisi',
                    'min_length' => 'Nama minimal 3 karakter',
                    'max_length' => 'Nama maksimal 20 karakter',
                ],
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email harus diisi',
                    'valid_email' => 'Email tidak valid',
                    'is_unique' => 'Email sudah terdaftar',
                ],
            ],
        ];

        if(!$this->validate($rules)){
            // return $this->fail($this->validator->getErrors());
            session()->setFlashdata('error', $this->validator->getErrors());
            return redirect()->to('/profile/edit/' . $id);
        }else{
            $user = new UserModel();

            $oldEmail = $user->find($id)['email'];
            $email = $this->request->getVar('email');

            if($oldEmail == $email){
                $email == $oldEmail;
            }else{
                if($user->where('email', $email)->first()){
                    return $this->fail('Email sudah terdaftar');
                }
            }

            $data = [
                'name' => $this->request->getVar('name'),
                'email' => $email,
            ];
            
            $user->update($id, $data);


            // $response = [
            //     'status' => 201,
            //     'error' => null,
            //     'messages' => [
            //         'success' => 'Data Updated',
            //     ],
            // ];

            // return $this->respondCreated($response, 201);
            session()->setFlashdata('success', 'Data berhasil diupdate');
            return redirect()->to('/profile');
        }
    }

    public function updatePassword($id){
        helper(['form']);

        $rules = [
            'old_password' => [
                'rules' => 'required|min_length[8]|max_length[20]',
                'errors' => [
                    'required' => 'Password lama harus diisi',
                    'min_length' => 'Password lama minimal 8 karakter',
                    'max_length' => 'Password lama maksimal 20 karakter',
                ],
            ],
            'password' => [
                'rules' => 'required|min_length[8]|max_length[20]',
                'errors' => [
                    'required' => 'Password harus diisi',
                    'min_length' => 'Password minimal 8 karakter',
                    'max_length' => 'Password maksimal 20 karakter',
                ],
            ],
            'confirm_password' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Konfirmasi password harus diisi',
                    'matches' => 'Konfirmasi password tidak sesuai dengan password'
                ],
            ],
        ];

        if(!$this->validate($rules)){
            // return $this->fail($this->validator->getErrors());
            session()->setFlashdata('error', $this->validator->getErrors());
            return redirect()->to('/profile/edit/' . $id);
        }else{
            $user = new UserModel();

            $oldPassword = $user->find($id)['password'];
            $password = $this->request->getVar('old_password');

            if(!password_verify($password, $oldPassword)){
                return $this->fail('Password lama salah');
            }

            $data = [
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ];

            $user->update($id, $data);

            // $response = [
            //     'status' => 201,
            //     'error' => null,
            //     'messages' => [
            //         'success' => 'Data Updated',
            //     ],
            // ];

            // return $this->respondCreated($response, 201);
            session()->setFlashdata('success', 'Password berhasil diupdate');
            return redirect()->to('/profile');
        }
    }
    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }
}
