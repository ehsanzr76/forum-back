<?php


namespace App\Repositories;


use App\Interfaces\ThreadRepoInterface;
use App\Models\Channel;
use App\Models\Thread;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ThreadRepository implements ThreadRepoInterface
{
    private Builder $model;

    public function __construct()
    {
        $this->model = Thread::query();

    }

    public function index(): Collection
    {
        return $this->model->where('flag', 1)->latest()->get();
    }


    public function show($slug): Model | null
    {
       return $this->model->where('slug', $slug)->where('flag', 1)->first();

    }


    public function create($title, $body): Model
    {
        return $this->model->create([
            'title' => $title,
            'slug' => Str::slug($title),
            'body' => $body,
            'channel_id' => Channel::factory()->create()->id,
            'user_id' => auth()->user()->id,
        ]);
    }


    public function update($title, $body, $best_answer_id = null): bool
    {
        return $this->model->update([
            'title' => $title,
            'slug' => Str::slug($title),
            'body' => $body,
            'channel_id' => Channel::factory()->create()->id,
            'best_answer_id' => $best_answer_id,
        ]);
    }


    public function user($id): Model | Collection
    {
        return $this->model->find($id);
    }


    public function destroy($id): bool
    {
        return $this->model->find($id)->delete();
    }


    public function find($thread_id): Model
    {
        return $this->model->getModel()->find($thread_id);
    }


}
