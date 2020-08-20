
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateCourseSubjectTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("course_subject", function (Blueprint $table) {

						$table->unsignedInteger('course_id');
						$table->unsignedInteger('subject_id');
						$table->timestamps();
                        $table->softDeletes();

                        $table->index('course_id');
                        $table->index('subject_id');
            
                        $table->unique([
                            'course_id',
                            'subject_id'
                        ]);



						// ----------------------------------------------------
						// -- SELECT [course_subject]--
						// ----------------------------------------------------
						// $query = DB::table("course_subject")
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
                Schema::dropIfExists("course_subject");
            }
        }
    