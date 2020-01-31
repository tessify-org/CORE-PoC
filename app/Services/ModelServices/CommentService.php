<?php

namespace App\Services\ModelServices;

use Auth;
use Jobs;
use Users;
use Tasks;
use Exception;
use App\Models\Job;
use App\Models\User;
use App\Models\Task;
use App\Models\Comment;
use App\Http\Requests\Api\Comments\CreateCommentRequest;
use App\Http\Requests\Api\Comments\UpdateCommentRequest;

class CommentService 
{
    private $comments;
    private $preloadedComments;

    public function getAll()
    {
        if (is_null($this->comments))
        {
            $this->comments = Comment::all();
        }

        return $this->comments;
    }

    public function getAllPreloaded()
    {
        if (is_null($this->preloadedComments))
        {
            $out = [];

            foreach ($this->getAll() as $comment)
            {
                $out[] = $this->preload($comment);
            }

            $this->preloadedComments = collect($out);
        }

        return $this->preloadedComments;
    }

    public function getAllPreloadedForJob(Job $job)
    {
        $out = [];

        foreach ($this->getAllPreloaded() as $comment)
        {
            if ($comment->commentable_type == "App\\Models\\Job" and $comment->commentable_id == $job->id)
            {
                $out[] = $comment;
            }
        }

        return collect($out);
    }

    public function getAllPreloadedForUser(User $user)
    {
        $out = [];

        foreach ($this->getAllPreloaded() as $comment)
        {
            if ($comment->commentable_type == "App\\Models\\User" and $comment->commentable_id == $user->id)
            {
                $out[] = $comment;
            }
        }

        return collect($out);
    }

    public function getAllPreloadedForTask(Task $task)
    {
        $out = [];

        foreach ($this->getAllPreloaded() as $comment)
        {
            if ($comment->commentable_type == "App\\Models\\Task" and $comment->commentable_id == $task->id)
            {
                $out[] = $comment;
            }
        }

        return collect($out);
    }

    public function find($id)
    {
        foreach ($this->getAll() as $comment)
        {
            if ($comment->id == $id)
            {
                return $comment;
            }
        }

        return false;
    }

    public function findPreloaded($id)
    {
        foreach ($this->getAllPreloaded() as $comment)
        {
            if ($comment->id == $id)
            {
                return $comment;
            }
        }

        return false;
    }

    private function preload(Comment $comment)
    {
        $comment->user = Users::findPreloaded($comment->user_id);

        $comment->formatted_created_at = $comment->created_at->format("d-m-Y H:m:s");

        return $comment;
    }

    public function createFromApiRequest(CreateCommentRequest $request)
    {
        // Convert the target type to a namespaced classname and validate at the same time
        $target_type = null;
        switch ($request->target_type)
        {
            case "job":
                $target_type = "App\\Models\\Job";
                $job = Jobs::find($request->target_id);
                if (!$job) throw new Exception("Invalid job id received.");
            break;
            case "user":
                $target_type = "App\\Models\\User";
                $user = Users::find($request->target_id);
                if (!$user) throw new Exception("Invalid user id received.");
            break;
            case "task":
                $target_type = "App\\Models\\Task";
                $task = Tasks::find($request->target_id);
                if (!$task) throw new Exception("Invalid task id received");
            break;
        }
        if (is_null($target_type)) throw new Exception("Invalid target type received.");

        // TODO: add validation to make sure user can comment on the target? (only if applicable to final concept)

        // Create and return the comment
        $comment = Comment::create([
            "commentable_id" => $request->target_id,
            "commentable_type" => $target_type,
            "user_id" => Auth::user()->id,
            "body" => $request->comment,
        ]);

        // Return preloaded version of the comment
        return $this->preload($comment);
    }

    public function updateFromApiRequest(UpdateCommentRequest $request)
    {
        // Grab the comment
        $comment = $this->find($request->comment_id);

        // TODO: add validation to make sure comment belongs to logged in user

        // Update the body of the comment and save the changes
        $comment->body = $request->comment;
        $comment->save();

        // Return preloaded version of the updated comment
        return $this->preload($comment);
    }
}