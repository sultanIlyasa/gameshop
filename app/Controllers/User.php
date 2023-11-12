<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class User extends ResourceController
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

        $data = $user->findAll();

        if($data){
            return $this->respond($data,200,'Data Found');
        }else{
            return $this->failNotFound('No Data Found', 404, 'Not Found');
        }
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
        $user = new UserModel();

        $data = $user->getWhere(['user_id' => $id])->getResult();

        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('No Data Found with id ' . $id, 404, 'Not Found');
        }
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
        return view('welcome_message');
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
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
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'Email harus diisi',
                    'valid_email' => 'Email tidak valid',
                    'is_unique' => 'Email sudah terdaftar',
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

        ];

        if(!$this->validate($rules)){
            return $this->fail($this->validator->getErrors());
        }else{
            $user = new UserModel();

            $data = [
                'name' => $this->request->getVar('name'),
                'email' => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ];

            $user->insert($data);

            $response = [
                'status' => 201,
                'error' => null,
                'messages' => [
                    'success' => 'Data Saved',
                ],
            ];

            return $this->respondCreated($response, 201);
        }
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
        return view('welcome_message');
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
            'role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Role harus diisi',
                ],
            ]
        ];

        if(!$this->validate($rules)){
            return $this->fail($this->validator->getErrors());
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
                'role' => $this->request->getVar('role'),
            ];
            
            $user->update($id, $data);


            $response = [
                'status' => 201,
                'error' => null,
                'messages' => [
                    'success' => 'Data Updated',
                ],
            ];

            return $this->respondCreated($response, 201);
        }
    }

    public function updatePassword($id){
        helper(['form']);

        $rules = [
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
            return $this->fail($this->validator->getErrors());
        }else{
            $user = new UserModel();

            $data = [
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ];

            $user->update($id, $data);

            $response = [
                'status' => 201,
                'error' => null,
                'messages' => [
                    'success' => 'Data Updated',
                ],
            ];

            return $this->respondCreated($response, 201);
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
        $user = new UserModel();

        $data = $user->find($id);

        if($data){
            $user->delete($id);

            $response = [
                'status' => 201,
                'error' => null,
                'messages' => [
                    'success' => 'Data Deleted',
                ],
            ];

            return $this->respondDeleted($response, 201);
        }else{
            return $this->failNotFound('No Data Found with id ' . $id, 404, 'Not Found');
        }
    }
}
