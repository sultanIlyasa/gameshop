<?php

namespace App\Controllers;

use App\Models\TransactionModel;
use App\Models\GameModel;
use App\Models\TopupModel;
use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class Transaction extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        //
        $transaction = new TransactionModel();


        $data['transactions'] = $transaction->join('games', 'games.game_id = transactions.game_id')->join('users', 'users.user_id = transactions.user_id')->findAll();

        // if($data){
        //     return $this->respond($data,200,'Data ditemukan');
        // }else{
        //     return $this->failNotFound('Data tidak Ditemukan', 404, 'Not Found');
        // }

        return view('pages/admin/transaction/show', $data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
        $transaction = new TransactionModel();

        if($transaction->countAll() == 0){
            return $this->failNotFound('Data tidak Ditemukan', 404, 'Not Found');
        }

        $data = $transaction->join('games', 'games.game_id = transactions.game_id')->join('users', 'users.user_id = transactions.user_id')->where('transaction_id', $id)->first();

        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data tidak Ditemukan dengan id ' . $id, 404, 'Not Found');
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
        // $transaction = new TransactionModel();
        $game = new GameModel();
        // $topup = new TopupModel();
        $user = new UserModel();

        $data['games'] = $game->findAll();
        $data['users'] = $user->findAll();
        // $data['topups'] = $topup->findAll();

        return view('pages/admin/transaction/add', $data);
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
            'user_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'User id harus diisi.'
                ]
            ],
            'game_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Game id harus diisi.'
                ]
            ],
            'gameuser_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Game user id harus diisi.'
                ]
            ],
            'game_location' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Game location harus diisi.'
                ]
            ],
            'payment_method' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Payment method harus diisi.'
                ]
            ],
            'total_payment' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Total payment harus diisi.'
                ]
            ],
            'image' => [
                'rules' => 'uploaded[image]|max_size[image,10240]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Gambar harus diupload.',
                    'max_size' => 'Ukuran gambar maksimal 1MB.',
                    'is_image' => 'File yang diupload harus gambar.',
                    'mime_in' => 'File yang diupload harus gambar.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            // return $this->fail($this->validator->getErrors());
            session()->setFlashdata('error', $this->validator->getErrors());
            return redirect()->to('/transaction/new')->withInput();
        } else {
            $transaction = new TransactionModel();

            $image = $this->request->getFile('image');
            $imageName = $image->getRandomName();
            $image->move('assets/images/transactions/', $imageName);

            $data = [
                'user_id' => $this->request->getVar('user_id'),
                'game_id' => $this->request->getVar('game_id'),
                'gameuser_id' => $this->request->getVar('gameuser_id'),
                'game_location' => $this->request->getVar('game_location'),
                'payment_method' => $this->request->getVar('payment_method'),
                'total_payment' => $this->request->getVar('total_payment'),
                'payment_image' => $imageName,
            ];

            $transaction->insert($data);

            // $response = [
            //     'status' => 201,
            //     'error' => null,
            //     'messages' => [
            //         'success' => 'Data berhasil ditambahkan'
            //     ]
            // ];

            // return $this->respondCreated($response, 201);
            session()->setFlashdata('success', 'Data berhasil ditambahkan');
            return redirect()->to('/transaction');
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
        $transaction = new TransactionModel();
        $game = new GameModel();
        $user = new UserModel();

        $data['transaction'] = $transaction->join('games', 'games.game_id = transactions.game_id')->join('users', 'users.user_id = transactions.user_id')->where('transaction_id', $id)->first();
        $data['games'] = $game->findAll();
        $data['users'] = $user->findAll();

        return view('pages/admin/transaction/edit', $data);
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
            'user_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'User id harus diisi.'
                ]
            ],
            'game_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Game id harus diisi.'
                ]
            ],
            'gameuser_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Game user id harus diisi.'
                ]
            ],
            'game_location' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Game location harus diisi.'
                ]
            ],
            'payment_method' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Payment method harus diisi.'
                ]
            ],
            'total_payment' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Total payment harus diisi.'
                ]
            ],
            'image' => [
                'rules' => 'max_size[image,10240]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar maksimal 1MB.',
                    'is_image' => 'File yang diupload harus gambar.',
                    'mime_in' => 'File yang diupload harus gambar.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
            // session()->setFlashdata('error', $this->validator->getErrors());
            // return redirect()->to('/transaction/edit/' . $id)->withInput();
        } else {
            $transaction = new TransactionModel();

            $image = $this->request->getFile('image');
            $oldImage = $transaction->where('transaction_id', $id)->first()['payment_image'];
            $imageName = $image->getName();
            if($oldImage == $imageName || $imageName == null){
                $imageName = $oldImage;
            }else{
                if($oldImage != null){
                    unlink('assets/images/transactions/' . $oldImage);
                }

                $imageName = $image->getRandomName();
                $image->move('assets/images/transactions', $imageName);
            }

            $data = [
                'user_id' => $this->request->getVar('user_id'),
                'game_id' => $this->request->getVar('game_id'),
                'gameuser_id' => $this->request->getVar('gameuser_id'),
                'game_location' => $this->request->getVar('game_location'),
                'payment_method' => $this->request->getVar('payment_method'),
                'total_payment' => $this->request->getVar('total_payment'),
                'payment_image' => $imageName,
            ];

            $transaction->update($id, $data);

            // $response = [
            //     'status' => 201,
            //     'error' => null,
            //     'messages' => [
            //         'success' => 'Data berhasil diupdate'
            //     ]
            // ];

            // return $this->respondCreated($response, 201);
            session()->setFlashdata('success', 'Data berhasil diupdate');
            return redirect()->to('/transaction');
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
        $transaction = new TransactionModel();

        $data = $transaction->where('transaction_id', $id)->first();

        if ($data) {
            // unlink('assets/images/transactions/' . $data['payment_image']);
            $transaction->delete($id);

            // $response = [
            //     'status' => 201,
            //     'error' => null,
            //     'messages' => [
            //         'success' => 'Data berhasil dihapus'
            //     ]
            // ];

            // return $this->respondDeleted($response, 201);
            session()->setFlashdata('success', 'Data berhasil dihapus');
            return redirect()->to('/transaction');
        } else {
            // return $this->failNotFound('Data tidak Ditemukan dengan id ' . $id, 404, 'Not Found');
            session()->setFlashdata('error', 'Data gagal dihapus');
            return redirect()->to('/transaction');
        }
    }
}
