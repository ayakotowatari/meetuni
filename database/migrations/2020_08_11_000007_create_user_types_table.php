
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateUserTypesTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("user_types", function (Blueprint $table) {

						$table->bigIncrements('id');
						$table->string('user_type',191)->nullable();
						$table->timestamps();
						$table->softDeletes();



						// ----------------------------------------------------
						// -- SELECT [user_types]--
						// ----------------------------------------------------
						// $query = DB::table("user_types")
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
                Schema::dropIfExists("user_types");
            }
        }
    