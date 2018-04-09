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
	
	if($request->hasFile('file')) {

	    $image = $request->file('file');
	    // file re name
	    $image_name = time() . '.' . $image->getClientOriginalExtension();
	    // resize file destination path
	    $destinationPath = public_path('project/backend/research');

	    // Image upload method
	    $image->move($destinationPath, $image_name);

	}

			

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
	
	
	
	
	
	
	
	
	
	
___________________________________
	
	
multiple image upload :



********* multiple image upload 


<form class="form-horizontal" enctype="multipart/form-data" method="post" action="/details">

<input required type="file" class="form-control" name="images[]" placeholder="address" multiple>


public function store(request $request) {

	/* ----------------------------------------
	|| multiple video file upload & insert 
		 ---------------------------------------- */




	$videos = $request->file('videos');


		$loop = count($videos)-1;


	for($i=0; $i<= $loop; $i++)
	{

		$Research_file_detail = new Research_file_detail;

		$video = time().".".$_FILES['videos']['name'][$i]; 

		$Research_file_detail->path = $video;

		$Research_file_detail->save();


		move_uploaded_file($_FILES['videos']['tmp_name'][$i],"project/backend/research/video/".$video);




	}
			
}







Resize image :

$image = $request->file('profile_image');
            // file re name
$image_name = time() . '.' . $image->getClientOriginalExtension();
// resize file destination path
$destinationPath = public_path('uploads\resize_images');
// actual path for the file
$img = Image::make($request->file('profile_image')->getRealPath());
$img->resize(100, null, function ($constraint) {
$constraint->aspectRatio();
})->save($destinationPath . '/' . $image_name);
$destinationPath = public_path('uploads\profile_images');

// Image upload method
$image->move($destinationPath, $image_name);
            



____________________________________________________
	
	
Select Form Another Table | Foreach Loop | Array to String
	
	
	$client = client::where('email','$email');  // select

	

	foreach ($client as $c) {                  // after select loop
		$email[] = $c->email;
	}

 
        $email = array();			  // insert data into blank array

	$email_var = implode(" ",$email);         // array to var convertion

	$order->email = $email_var;               // insert data

	$order->save();






_________________________________________________________________________
	

Transaction lock :
	
 It will lock all the rows that match the criteria for writin
	 
$model = \App\Models\User::lockForUpdate()->find(1);
                sleep(30);
                $model->point = 100000;
                $model->save();

or
	
$user = UserInfo::where('id', '=', $this->user->id)->lockForUpdate()->first();
