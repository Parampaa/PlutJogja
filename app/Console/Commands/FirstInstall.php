<?php

namespace App\Console\Commands;

use App\User;
use Mysqli;
use Hash;
use Illuminate\Console\Command;

class FirstInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'FirstInstall:exec';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mempersiapkan kebutuhan awal';

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
        $x = new Mysqli('localhost','root','');
        if ($x) {
        	$this->info("SQL SERVER READY");
        	
	        if ($x->select_db('plut_kumkm')) {
	        	$this->info("Already Exist");
	        }
	        else{
	        	$x -> query("CREATE DATABASE plut_kumkm");
	        	$conn = new mysqli('localhost','root','', 'plut_kumkm');
			    if ($conn) {
			        
			        $filename = base_path('plut_kumkm.sql');
					$op_data = '';
					$lines = file($filename);
					foreach ($lines as $line)
					{
					    if (substr($line, 0, 2) == '--' || $line == '')//This IF Remove Comment Inside SQL FILE
					    {
					        continue;
					    }
					    $op_data .= $line;
					    if (substr(trim($line), -1, 1) == ';')//Breack Line Upto ';' NEW QUERY
					    {
					        $conn->query($op_data);
					        $op_data = '';
					    }
					}
					
			    }

	        }
	        $this->info("DB done");
	        $this->info("Table Created");
        }
        else{
        	$this->info("Something wrong");
        }
		
        $admin = User::Create([
        	'name' => 'admin',
        	'email' => 'admin@plutjogja.com',
        	'password' => Hash::make('plutjogja')
        ]);
        if ($admin) {
        	$this->info("Admin Created");
        }
    }
}
