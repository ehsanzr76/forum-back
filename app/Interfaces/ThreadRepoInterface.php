<?php


namespace App\Interfaces;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ThreadRepoInterface
{
    public function index(): Collection;
    public function show($slug): Model;
    public function create($title , $body): Model;
    public function update($id ,$title , $body): bool;

}
