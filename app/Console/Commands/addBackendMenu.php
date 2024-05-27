<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class addBackendMenu extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backend:menus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To add backend menus';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $getMotivationMenu = \DB::table('menu_items')->where('title','Motivations')->first();
        if(!$getMotivationMenu){
            \DB::table('menu_items')->insert([
                'menu_id'=>1,
                'title'=>'Motivations',
                'url'=>'/admin/motivations',
                'target'=>'_self',
                'icon_class'=>'voyager-smile',
                'color'=>'#000000',
                'order'=>'15',
                'created_at'=>getCurrentDatetime(),
                'updated_at'=>getCurrentDatetime()
            ]);
        }
        $getMotivationMenu = \DB::table('menu_items')->where('title','Forums Categories')->first();
        if(!$getMotivationMenu){
            \DB::table('menu_items')->insert([
                'menu_id'=>1,
                'title'=>'Forums Categories',
                'url'=>'/admin/forums-categories',
                'target'=>'_self',
                'icon_class'=>'voyager-bubble-hear',
                'color'=>'#000000',
                'order'=>'15',
                'created_at'=>getCurrentDatetime(),
                'updated_at'=>getCurrentDatetime()
            ]);
        }
    }
}
