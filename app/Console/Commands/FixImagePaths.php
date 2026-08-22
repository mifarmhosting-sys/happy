<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('fix:images')]
#[Description('Fix case-sensitive image paths in the database')]
class FixImagePaths extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = 0;
        
        \App\Models\Testimonial::where('avatar_path', 'like', 'Images/%')->get()->each(function($t) use (&$count) {
            $t->avatar_path = str_replace('Images/', 'images/', $t->avatar_path);
            $t->save();
            $count++;
        });

        $this->info("Successfully fixed $count image paths!");
    }
}
