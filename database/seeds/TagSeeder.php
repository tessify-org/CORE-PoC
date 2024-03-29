<?php

use Tessify\Core\Models\Tag;
use Tessify\Core\Models\Task;
use Tessify\Core\Models\Project;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("tags")->delete();
        DB::table("taggables")->delete();

        factory(Tag::class, 20)->create();

        $tags = Tag::all();

        foreach (Task::all() as $task)
        {
            $tag_ids = [];
            
            foreach ($tags->shuffle()->take(5) as $tag)
            {
                $tag_ids[] = $tag->id;
            }
            
            $task->tags()->attach($tag_ids);
        }

        foreach (Project::all() as $project)
        {
            $tag_ids = [];

            foreach ($tags->shuffle()->take(5) as $tag)
            {
                $tag_ids[] = $tag->id;
            }

            $project->tags()->attacH($tag_ids);
        }
    }
}
