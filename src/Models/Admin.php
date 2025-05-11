<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 */
class Admin extends Authenticatable implements Auditable, FilamentUser
{
    use AuditableTrait;

    /** @use HasFactory<\RectitudeOpen\FilaPressCore\Database\Factories\AdminFactory> */
    use HasFactory;

    use HasRoles;
    use Notifiable;

    protected $guard_name = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected $auditExclude = [
        'password',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole('super-admin') || $this->hasRole('webmaster');
    }
}
