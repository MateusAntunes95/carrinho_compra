<?php

namespace App\Repositories\Product;

use App\Models\Product;

class ListarRepository
{
    private $dados;
    private $query;

    public function listar(array $dados)
    {
        $this->dados = $dados;
        $this->query = Product::query();
        $this->select();
        $this->filter();

        return $this->query;
    }

    private function select()
    {
        $this->query->select([
            'id',
            'image',
            'name',
            'active'
        ]);
    }

    private function filter()
    {
        if (!empty($this->dados['name'])) {
            $this->query->where('name', 'LIKE', '$' . $this->dados['name'] . '%');
        }

        if (!empty($this->dados['id'])) {
            $this->query->where('id', $this->dados['id']);
        }
    }
}
