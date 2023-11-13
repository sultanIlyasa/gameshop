<?php

namespace App\Controllers;

use App\Models\GameModel;
use App\Models\TopupModel;
use CodeIgniter\RESTful\ResourceController;

class Topup extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        //
        $topup = new TopupModel();

        $data['topups'] = $topup->join('games', 'games.game_id = topups.game_id')->findAll();

        // if($data){
        //     return $this->respond($data,200,'Data ditemukan');
        // }else{
        //     return $this->failNotFound('Data tidak Ditemukan', 404, 'Not Found');
        // }
        return view('/pages/admin/topup/show', $data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
        $topup = new TopupModel();

        if($topup->countAll() == 0){
            return $this->failNotFound('Data tidak Ditemukan', 404, 'Not Found');
        }

        $data = $topup->join('games', 'games.game_id = topup.game_id')->where('topup_id', $id)->first();

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
        $game = new GameModel();

        $data['games'] = $game->findAll();

        return view('pages/admin/topup/add', $data);
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
            'game_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Game ID harus diisi.'
                ]
            ],
            'price' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harga harus diisi.'
                ]
            ],
            'title' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Judul harus diisi.'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            // return $this->fail($this->validator->getErrors());
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->to('/topup/new');
        } else {
            $topup = new TopupModel();
            $game = new GameModel();

            $game_id = $this->request->getVar('game_id');

            if(!$game->where('game_id', $game_id)->first()){
                return $this->failNotFound('Data tidak Ditemukan dengan id ' . $game_id, 404, 'Not Found');
            }

            $data = [
                'game_id' => $this->request->getVar('game_id'),
                'price' => $this->request->getVar('price'),
                'topup_title' => $this->request->getVar('title'),
            ];

            $topup->insert($data);

            // $response = [
            //     'status' => 201,
            //     'error' => null,
            //     'messages' => [
            //         'success' => 'Data berhasil ditambahkan'
            //     ]
            // ];

            // return $this->respondCreated($response, 201);
            session()->setFlashdata('success', 'Topup berhasil ditambahkan');
            return redirect()->to('/topup');
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
        $topup = new TopupModel();
        $game = new GameModel();

        $data['topup'] = $topup->join('games', 'games.game_id = topups.game_id')->where('topup_id', $id)->first();
        $data['games'] = $game->findAll();

        
        return view('pages/admin/topup/edit', $data);
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
            'game_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Game ID harus diisi.'
                ]
            ],
            'price' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harga harus diisi.'
                ]
            ],
            'title' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Judul harus diisi.'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            // return $this->fail($this->validator->getErrors());
            session()->setFlashdata('error', $this->validator->getErrors());
            return redirect()->to('/topup/edit/' . $id);
        } else {
            $topup = new TopupModel();
            $game = new GameModel();

            $game_id = $this->request->getVar('game_id');

            if(!$game->where('game_id', $game_id)->first()){
                return $this->failNotFound('Data tidak Ditemukan dengan id ' . $game_id, 404, 'Not Found');
            }

            $data = [
                'game_id' => $this->request->getVar('game_id'),
                'price' => $this->request->getVar('price'),
                'topup_title' => $this->request->getVar('title'),
            ];

            $topup->update($id, $data);

            // $response = [
            //     'status' => 201,
            //     'error' => null,
            //     'messages' => [
            //         'success' => 'Data berhasil diupdate'
            //     ]
            // ];

            // return $this->respondCreated($response, 201);
            session()->setFlashdata('success', 'Topup berhasil diupdate');
            return redirect()->to('/topup');
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
        $topup = new TopupModel();

        $data = $topup->find($id);

        if ($data) {
            $topup->delete($id);

            // $response = [
            //     'status' => 201,
            //     'error' => null,
            //     'messages' => [
            //         'success' => 'Data berhasil dihapus'
            //     ]
            // ];

            // return $this->respondDeleted($response, 201);
            session()->setFlashdata('success', 'Topup berhasil dihapus');
            return redirect()->to('/topup');
        } else {
            // return $this->failNotFound('Data tidak Ditemukan dengan id ' . $id, 404, 'Not Found');
            session()->setFlashdata('error', 'Topup gagal dihapus');
            return redirect()->to('/topup');
        }
    }
}
