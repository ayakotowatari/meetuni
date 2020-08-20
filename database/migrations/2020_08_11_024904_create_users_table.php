
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateUsersTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("users", function (Blueprint $table) {

                        $table->bigIncrements('id')->unsigned();
                        $table->bigInteger('user_type_id')->unsigned();
						$table->string('first_name',191);
						$table->string('last_name',191);
						$table->string('email',191);
						$table->timestamp('email_verified_at')->nullable();
						$table->string('password');
						$table->integer('life');
						$table->string('remember_token',100);
						$table->timestamps();
                        $table->softDeletes();
                        $table->unique('email');
                        
						$table->foreign("user_type_id")->references("id")->on("user_types");



						// ----------------------------------------------------
						// -- SELECT [users]--
						// ----------------------------------------------------
						// $query = DB::table("users")
						// ->leftJoin("user_types","user_types.id", "=", "users.user_type_id")
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
                Schema::dropIfExists("users");
            }
        }
    