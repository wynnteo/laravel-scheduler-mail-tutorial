<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\Product;
use App\Mail\SendEmail;

class StockScheduler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:lowstock_report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To pull a list of running low of stock products, send notification to admin at 6 PM daily via email.';

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
     * @return int
     */
    public function handle()
    {
        $product = Product::where('stock', '<=', '10')->get();

        $to_email = "sgwebfreelancer@gmail.com";

        Mail::to($to_email)->send(new SendEmail($product));

        $this->info('Daily report has been sent successfully!');
        return 'Daily report has been sent successfully!';
    }
}
