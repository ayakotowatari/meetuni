
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateCourseStudentTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("course_student", function (Blueprint $table) {

						$table->unsignedInteger('student_id');
						$table->unsignedInteger('course_id');
						$table->timestamps();
                        $table->softDeletes();
                        
                        $table->index('student_id');
                        $table->index('course_id');

                        $table->unique([
                            'student_id',
                            'course_id'
                        ]);



						// ----------------------------------------------------
						// -- SELECT [course_user]--
						// ----------------------------------------------------
						// $query = DB::table("course_user")
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
                Schema::dropIfExists("course_student");
            }
        }
    