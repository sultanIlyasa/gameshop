<?php

namespace App\Controllers;

use App\Models\GameModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Game extends ResourceController
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
        $game = new GameModel();

        $data = $game->findAll();

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
        $game = new GameModel();

        $data = $game->where('slug', $id)->first();

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
            'title' => [
                'rules' => 'required|is_unique[games.title]',
                'errors' => [
                    'required' => 'Game title is required',
                    'is_unique' => 'Game title already exist'
                ]
            ],
            'description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Game description is required'
                ]
            ],
            // 'image' => [
            //     'rules' => 'uploaded[image]|max_size[image,1024]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
            //     'errors' => [
            //         'uploaded' => 'Game image is required',
            //         'max_size' => 'Game image size is too big',
            //         'is_image' => 'Game image is not an image',
            //         'mime_in' => 'Game image is not an image'
            //     ]
            // ]
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        } else {
            $game = new GameModel();

            // $image = $this->request->getFile('image');
            // $imageName = $image->getRandomName();
            // $image->move('assets/images/games', $imageName);

            $data = [
                'title' => $this->request->getVar('title'),
                'slug' => url_title($this->request->getVar('title'), '-', true),
                'description' => $this->request->getVar('description'),
                // 'game_image' => $imageName,
            ];

            $game->insert($data);

            $response = [
                'status' => 201,
                'error' => null,
                'message' => [
                    'success' => 'Game created successfully'
                ]
            ];

            return $this->respond($response, 201);
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
            'title' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Judul harus diisi',
                ]
            ],
            'description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi harus diisi',
                ]
            ],
            // 'image' => [
            //     'rules' => 'max_size[image,1024]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
            //     'errors' => [
            //         'uploaded' => 'Game image is required',
            //         'max_size' => 'Game image size is too big',
            //         'is_image' => 'Game image is not an image',
            //         'mime_in' => 'Game image is not an image'
            //     ]
            // ]
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        } else {
            $game = new GameModel();

            $title = $this->request->getVar('title');
            $oldTitle = $game->where('slug', $id)->first()['title'];

            if($oldTitle == $title){
                $title == $oldTitle;
            }else{
                if($game->where('title', $title)->first()){
                    return $this->fail('Judul sudah terdaftar');
                }
            }

            // $image = $this->request->getFile('image');
            // $oldImage = $game->where('slug', $id)->first()['image'];

            // if($image == $oldImage || $image == null){
            //     $imageName == $oldImage;
            // }else{
            //     if($oldImage != null){
            //         unlink('assets/images/games/' . $oldImage);
            //     }

            //     $imageName = $image->getRandomName();
            //     $image->move('assets/images/games', $imageName);
            // }

            $data = [
                'title' => $title,
                'slug' => url_title($title, '-', true),
                'description' => $this->request->getVar('description'),
                // 'game_image' => $imageName,
            ];

            $id = $game->where('slug', $id)->first()['game_id'];

            $game->update($id, $data);

            $response = [
                'status' => 201,
                'error' => null,
                'message' => [
                    'success' => 'Game updated successfully'
                ]
            ];

            return $this->respond($response, 201);
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
        $game = new GameModel();

        $data = $game->where('slug', $id)->first();

        
        if ($data) {
            // unlink('assets/images/games/' . $data['game_image']);

            $game->delete($data['game_id']);

            $response = [
                'status' => 201,
                'error' => null,
                'message' => [
                    'success' => 'Game deleted successfully'
                ]
            ];

            return $this->respondDeleted($response, 201);
        } else {
            return $this->failNotFound('No Data Found with id ' . $id, 404, 'Not Found');
        }
    }
}
