
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

                        $table->bigIncrements('id')->unsigned();
                        $table->bigInteger('user_type_id')->unsigned();
						$table->string('first_name',191);
						$table->string('last_name',191);
						$table->string('email',191);
						$table->timestamp('email_verified_at')->nullable();
                        $table->string('password');
                        $table->string('timezone',191);
                        $table->bigInteger('country_id')->unsigned()->nullable();
						$table->bigInteger('year_id')->unsigned()->nullable();
						$table->integer('life');
						$table->string('remember_token',100);
						$table->timestamps();
                        $table->softDeletes();
                        $table->unique('email');
                        
						$table->foreign("user_type_id")->references("id")->on("user_types");
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
    