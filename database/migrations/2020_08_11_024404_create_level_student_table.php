
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateLevelStudentTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("level_student", function (Blueprint $table) {

                        $table->unsignedInteger('student_id');
                        $table->unsignedInteger('level_id');
						$table->timestamps();
                        $table->softDeletes();
                        
                        $table->index('student_id');
                        $table->index('level_id');

                        $table->unique([
                            'student_id',
                            'level_id'
                        ]);



						// ----------------------------------------------------
						// -- SELECT [level_student]--
						// ----------------------------------------------------
						// $query = DB::table("level_student")
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
                Schema::dropIfExists("level_student");
            }
        }
    