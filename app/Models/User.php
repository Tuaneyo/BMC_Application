<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use phpDocumentor\Reflection\Types\Self_;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;
use App\Notifications\VerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','lastname', 'email', 'phone','company','st_number', 'birthday', 'password', 'file', 'active'
    ];

    private $guard_name = 'web';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @var string
     */
    protected static $default_image = "default-avatar.png";


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }


    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail); // my notification
    }

    /**
     * @return mixed
     */
    public function avatarExists()
    {
        $pathToImg = Auth::user()->id . '/' . Auth::user()->file;
        if(Storage::disk('avatar')->exists($pathToImg)){
            return Storage::disk('avatar')->url($pathToImg);
        }
        else{
            return Storage::disk('default-avatar')->url(static::$default_image);
        }
    }

    public function notification()
    {
        return $this->hasMany(Notification::class);
    }

    public function news()
    {
        return $this->hasMany(Notification::class, 'notifiable_id', 'id');
    }

    /**
     * @return string
     */
    public function retrieveAvatar(): string
    {
        return $this->avatarExists();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assignments()
    {
        return $this->hasMany('App\Models\UserAssigment', 'user_id', 'id');
    }

    /**
     * @return int
     * Gets the correct amount of percentile of the user completion in the course
     * Uses martens code from the welcomeController
     */
    public function assignmentPercentile($id = '')
    {

        $id = self::checkId($id);
        $assignments = UserAssigment::where([['user_id', '=', $id],['rated', '=', 2]])->orderby('component_id')->get();
        $total = 0;

        foreach ($assignments as $component) {
            switch ($component->component_id) {
                case 4:     //Waardepropositie
                    $total += 15;
                    break;
                case 7:     //Klantsegment
                    $total += 15;
                    break;
                default:    //Anders
                    $total += 10;
                    break;
            }
        }
        return $total;
    }

    /**
     * @return int
     */
    public function getCountCompletedAssignments($id = '')
    {
        $id = self::checkId($id);
        //User::where('id', $id)->first()->assignments->where('rated', '=', 2)

        //Auth::user()->assignments->where('rated', '>', 0)
        $user = User::find($id);

        return count( $user->assignments()->where('rated', '=', 2)->get());
    }

    public static function checkId($id)
    {
        if(empty($id)) $id = Auth::user()->id;
        return $id;
    }


}
