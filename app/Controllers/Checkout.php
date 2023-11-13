<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GameModel;
use App\Models\TransactionModel;

class Checkout extends BaseController
{
    public function index($id = null)
    {
        //
        helper(['form']);

        $session = session();

        if (!$session->get('isLoggedIn')) {
            session()->setFlashdata('error', 'Silahkan login terlebih dahulu');
            return redirect()->to('/login');
        }

        $rules = [
            'price' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Price harus diisi'
                ]
            ],
            'gameuser_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'ID Game harus diisi'
                ]
            ],
            'game_location' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Lokasi Game harus diisi'
                ]
            ],
            'payment_method' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Metode Pembayaran harus diisi'
                ]
            ],
            'image' => [
                'rules' => 'uploaded[image]|max_size[image,10240]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Bukti Pembayaran harus diisi',
                    'max_size' => 'Ukuran Bukti Pembayaran maksimal 1MB',
                    'is_image' => 'File Bukti Pembayaran harus berupa gambar',
                    'mime_in' => 'File Bukti Pembayaran harus berupa gambar'
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('error', $this->validator->getErrors());
            return redirect()->to('/' . $id);
        } else {
            $transaction = new TransactionModel();
            $game = new GameModel();

            $image = $this->request->getFile('image');
            $imageName = $image->getRandomName();
            $image->move('assets/images/transactions', $imageName);

            $id = $game->where('slug', $id)->first()['game_id'];

            $userId = $session->get('user_id');

            $data = [
                'game_id' => $id,
                'user_id' => $userId,
                'gameuser_id' => $this->request->getVar('gameuser_id'),
                'game_location' => $this->request->getVar('game_location'),
                'payment_method' => $this->request->getVar('payment_method'),
                'total_payment' => $this->request->getVar('price'),
                'payment_image' => $imageName,
            ];

            $transaction->insert($data);

            session()->setFlashdata('success', 'Transaksi berhasil, silahkan tunggu konfirmasi dari admin');
            return redirect()->to('/');
        }
    }
}
