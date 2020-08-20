
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateStudentsTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("students", function (Blueprint $table) {

						$table->bigInteger('id')->unsigned();
						$table->bigInteger('country_id')->unsigned();
						$table->bigInteger('year_id')->unsigned();
						$table->timestamps();
                        $table->softDeletes();
                        
                        $table->foreign("id")->references("id")->on("users");
						$table->foreign("country_id")->references("id")->on("countries");
						$table->foreign("year_id")->references("id")->on("years");



						// ----------------------------------------------------
						// -- SELECT [students]--
						// ----------------------------------------------------
						// $query = DB::table("students")
						// ->leftJoin("users","users.id", "=", "students.id")
						// ->leftJoin("countries","countries.id", "=", "students.country_id")
						// ->leftJoin("years","years.id", "=", "students.year_id")
						// ->get();
						// dd($query); //For checking



                });
            }

            /**
             * Reverse the migrations.
             *
             * @return void
             */
            public function down()
            {
                Schema::dropIfExists("students");
            }
        }
    