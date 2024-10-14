<?php

namespace App\Controllers;

use App\Models\CommentModel;
use CodeIgniter\Controller;

class CommentsController extends Controller
{
    protected $commentModel;

    public function __construct()
    {
        $this->commentModel = new CommentModel();
    }
    public function index($page = 1)
{
    $perPage = 3;
    $total = $this->commentModel->countAllResults();
    $totalPages = ceil($total / $perPage);

    // Проверка на валидность номера страницы
    if ($page < 1) {
        return redirect()->to('comments/index/1');
    } elseif ($page > $totalPages) {
        return redirect()->to('comments/index/' . $totalPages);
    }

    $offset = ($page - 1) * $perPage;

    // Получение параметра сортировки из URL
    $sort = $this->request->getGet('sort') ?? 'date_asc';
    $orderField = 'date';
    $orderDirection = 'ASC';

    // Установка поля и направления сортировки
    switch ($sort) {
        case 'date_asc':
            $orderField = 'date';
            $orderDirection = 'ASC';
            break;
        case 'date_desc':
            $orderField = 'date';
            $orderDirection = 'DESC';
            break;
        case 'name_asc':
            $orderField = 'name';
            $orderDirection = 'ASC';
            break;
        case 'name_desc':
            $orderField = 'name';
            $orderDirection = 'DESC';
            break;
    }

    // Получение отсортированных комментариев
    $data['comments'] = $this->commentModel->getComments($perPage, $offset, $orderField, $orderDirection);

    $data['total'] = $total;
    $data['page'] = $page;
    $data['perPage'] = $perPage;
    $data['sort'] = $sort;

    return view('comments/index', $data);
}

    public function create()
    {
        $this->validate([
            'name' => 'required|valid_email',
            'text' => 'required',
        ]);

        if ($this->request->getMethod() === 'post') {
            $data = [
                'name' => $this->request->getPost('name'),
                'text' => $this->request->getPost('text'),
                'date' => date('Y-m-d H:i:s'),
            ];

            if ($this->commentModel->insert($data)) {
                return $this->response->setJSON(['success' => true]);
            } else {
                return $this->response->setJSON(['success' => false, 'errors' => $this->commentModel->errors()]);
            }
        }
    }

    public function delete($id)
    {
        if ($this->commentModel->delete($id)) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }

}