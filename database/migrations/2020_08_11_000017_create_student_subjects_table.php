
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateStudentSubjectsTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("student_subjects", function (Blueprint $table) {

                        $table->unsignedInteger('student_id');
                        $table->unsignedInteger('subject_id');
						$table->timestamps();
                        $table->softDeletes();
                        
                        $table->index('student_id');
                        $table->index('subject_id');

                        $table->unique([
                            'student_id',
                            'subject_id'
                        ]);

						// ----------------------------------------------------
						// -- SELECT [student_subject]--
						// ----------------------------------------------------
						// $query = DB::table("student_subject")
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
                Schema::dropIfExists("student_subject");
            }
        }
    