
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateFollowsTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("follows", function (Blueprint $table) {

                        $table->unsignedInteger('student_id');
                        $table->unsignedInteger('inst_id');
                        $table->integer('notifications')->nullable();
                        $table->timestamps();
                        $table->softDeletes();
                        
                        $table->index('student_id');
                        $table->index('inst_id');
            
                        $table->unique([
                            'student_id',
                            'inst_id'
                        ]);

						// ----------------------------------------------------
						// -- SELECT [inst_user]--
						// ----------------------------------------------------
						// $query = DB::table("inst_user")
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
                Schema::dropIfExists("inst_student");
            }
        }
    