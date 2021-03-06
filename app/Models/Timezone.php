<?php
namespace App\Models;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

/**
 * Table to hold all "remember me" tokens for users.
 *
 * @author Jordan Doyle <jordan@doyle.wf>
 * @property integer $user_id id of the user this token belongs to
 * @property string $timezone timezone this user wants to show times as
 * @property Carbon $created_at when this timezone setting was created
 * @property Carbon $updated_at when this timezone setting was last updated
 * @property-read User $user user this token belongs to
 * @method static Builder|Token whereUserId($value)
 * @method static Builder|Token whereTimezone($value)
 * @method static Builder|Token whereCreatedAt($value)
 * @method static Builder|Token whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Timezone extends Model
{
    public $table = 'users_timezones';
    protected $primaryKey = 'user_id';
    protected $fillable = ['remember_token', 'user_id'];

    /**
     * Get the user this timezone token belongs to.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
