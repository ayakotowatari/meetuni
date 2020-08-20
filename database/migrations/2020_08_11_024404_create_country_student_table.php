
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateCountryStudentTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("country_student", function (Blueprint $table) {

                        $table->unsignedInteger('student_id');
                        $table->unsignedInteger('country_id');
						$table->timestamps();
						$table->softDeletes();

                        $table->index('student_id');
                        $table->index('country_id');
            
                        $table->unique([
                            'student_id',
                            'country_id'
                        ]);

						// ----------------------------------------------------
						// -- SELECT [country_student]--
						// ----------------------------------------------------
						// $query = DB::table("country_student")
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
                Schema::dropIfExists("country_student");
            }
        }
    