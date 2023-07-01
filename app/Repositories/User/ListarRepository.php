<?php

namespace App\Repositories\User;

use App\Models\User;

class ListarRepository
{
    private $dados;
    private $query;

    public function listar(array $dados)
    {
        $this->dados = $dados;
        $this->query = User::query();
        $this->select();
        $this->filter();

        return $this->query;
    }

    private function select()
    {
        $this->query->select([
            'id',
            'name',
            'email',
        ]);
    }

    private function filter()
    {
        if (!empty($this->dados['name'])) {
            $this->query->where('name', 'LIKE', '%' . $this->dados['name'] . '%');
        }

        if (!empty($this->dados['id'])) {
            $this->query->where('id', $this->dados['id']);
        }
    }
}
