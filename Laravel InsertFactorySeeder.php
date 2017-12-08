1. RENAME TABLE old_name TO old_names;

2. php artisan make:model old_name

3. make image folder in public folder



-> INSERT


use App\Http\Requests;

use App\Http\Controllers\controller;

use App\modelname;

use Illuminate\Http\Request;



public function store(Request $request){

dd($request);

$this->validate($request, [
	
	'field' => 'required',
						
]);



        $insert = new modelname;
		
	$insert->database_fieldname = $request->form_fieldname;
		
    // image upload
	
	$image1 = $request->file('image1');
        $name1 = time().rand(0,999999).'.'.$image1->getClientOriginalExtension();
        $destinationPath = public_path('/image');
        $image1->move($destinationPath, $name1);
			

	$insert->save();

	return redirect()->back()->with('message', 'IT WORKS!');

}


-> View Page 


	@if(session()->has('message'))
	    <div class="alert alert-success">
		{{ session()->get('message') }}
	    </div>
	@endif



-> Model 


	app\modelname


	<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;

	class Modelname extends Model

	{
		protected $fillable = ['fieldname','fieldname'];
	}





-> fopen 


	$description = json_decode($request->description);
			
	$url = "files/".$request->name.".txt";
			
	$fopen = fopen($url,"w");
			
	$fwrite = fwrite($fopen,$description);



-> file view :


	$myfile = fopen("abc.txt", "r");

	echo fread($myfile,filesize("abc.txt"));
	
	
	
--------------------------


Factory | Seeder ->

* factory is for generate fake data & faker is a object of facetory

* seeder is seed data in database.


-> php artisan make:factory ModelNameFacetory --model=ModelName   

  (ModelName here is in which table we want to insert data)

-> confiq/database/factory 

    return [
        'database_field_name' =>$faker->name,
        'database_field_name' =>$faker->email,
        'database_field_name' =>bcrypt('secret'),
				$faker->randomDigit;
				$faker->numberBetween(1,100);
				$faker->word;
				$faker->paragraph;
				$faker->lastName;
				$faker->city;
				$faker->year;
				$faker->domainName;
				$faker->creditCardNumber;
				$faker->region;
				$faker->bankAccountNumber;
				$faker->cellNumber;
    ];
    
 -> config/database/seeds/databaseSeeder.php :
   
    public function run(){
	 
	factory('App\ModelName',1000)->create();

   }
   
-> php artisan db:seed
