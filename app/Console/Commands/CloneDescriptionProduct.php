<?php

namespace App\Console\Commands;

use App\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CloneDescriptionProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:cloneDescriptionProduct';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $evenProduct = Product::find(128);
        $evenDescription = $evenProduct->description;

        $oddProduct = Product::find(129);
        $oddDescription = $oddProduct->description;

        $products = Product::all();
        $even = [];
        $odd = [];

        foreach ($products as $product) {
            if ($product->id % 2 == 0) {
                $even[] = $product->id;
            } else {
                $odd[] = $product->id;
            }
        }

        DB::table('products')
            ->whereIn('id', $even)
            ->update(['description' => $evenDescription]);

        DB::table('products')
            ->whereIn('id', $odd)
            ->update(['description' => $oddDescription]);

    }
}
