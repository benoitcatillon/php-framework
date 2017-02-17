<?php

namespace myProject\Forum\Models;


interface IDAO
{
    public function findOneById(int $id): PersonneDAO;

    public function findAll(array $orderBy = [], array $limit = []): array;

    public function find(array $search, array $orderBy = [], array $limit = []): array;

    public function deleteOneById(int $id): bool;

}