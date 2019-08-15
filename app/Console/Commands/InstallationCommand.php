<?php

namespace App\Console\Commands;

use App\Ability;
use App\Role;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Silber\Bouncer\BouncerFacade;

/**
 * Class InstallationCommand
 *
 * @package App\Console\Commands
 * @author Anitche Chisom
 */
class InstallationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the MCIS web application.';

    /**
     * Application roles.
     *
     * @var array
     */
    protected $roles = [
        [
            'name' => 'admin',
            'title' => 'Administrator',
            'level' => 1
        ],
        [
            'name' => 'director',
            'title' => 'Director',
            'level' => 2
        ],
        [
            'name' => 'staff',
            'title' => 'Staff',
            'level' => 3
        ],
        [
            'name' => 'guardian',
            'title' => 'Guardian',
            'level' => 4
        ],
        [
            'name' => 'student',
            'title' => 'Student',
            'level' => 5
        ],
        [
            'name' => 'active',
            'title' => 'Active',
            'level' => 6
        ],
    ];

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $progress = $this->output->createProgressBar(5);

        $this->initiateInstallation($progress);

        $this->info("All done!");
    }

    /**
     * Start installation.
     *
     * @param \Symfony\Component\Console\Helper\ProgressBar $progress
     */
    protected function initiateInstallation(& $progress)
    {
        $this->info("Starting a fresh installation of the MCSI app.");
        $this->warn("This will drop all the tables in the database and recreate new ones. This should only be done once in an application's lifetime unless you have a good reason to run it again.");

        if (! $this->confirm("Continue to installation.")) {
            exit;
        }

        // Migrate database.
        $this->info("Migrating the database now...");
        $this->call("migrate:fresh");
        $this->info("Database migration complete!");

        $progress->advance();

        $this->createRolesAndPermissions($progress);

        $this->createSuperuser($progress);
    }

    /**
     * Create Roles and Permissions.
     *
     * @param \Symfony\Component\Console\Helper\ProgressBar $progress
     * @return void
     */
    protected function createRolesAndPermissions(& $progress): void
    {
        $this->info("Creating application roles and permissions.");

        $bar = $this->output->createProgressBar(count($this->roles));

        foreach($this->roles as $role) {

            Role::create($role);

            $bar->advance();
        }

        $bar->finish();

        $this->info("Roles created!");

        $progress->advance();
    }

    /**
     * Create a superuser
     *
     * @param \Symfony\Component\Console\Helper\ProgressBar $progress
     * @return void
     */
    protected function createSuperuser(& $progress)
    {
        $this->info("Creating a superuser for the application.");

        $user = [];
        $user['name'] = env('SUPERUSER_NAME') ?: $this->ask("Provide a name for the superuser");
        $user['email'] = env('SUPERUSER_EMAIL') ?: $this->ask("Provide an email account for the superuser");
        $user['password'] = Hash::make(env('SUPERUSER_PASSWORD') ?: $this->secret("Provide a password for the superuser"));

        $superuser = User::create($user);

        event(new Registered($superuser));

        $progress->advance();

        $this->info("Superuser created!");

        $this->info("Auto verifying email account.");
        $superuser->email_verified_at = Carbon::now();
        $superuser->save();

        $this->info("Email verification completed!");
        $progress->advance();

        $this->info("Assigning role!");
        BouncerFacade::assign('admin')->to($superuser);
        $this->info("An administrative role has been assigned to the superuser!");
        $progress->advance();
    }
}
