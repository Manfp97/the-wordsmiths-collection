<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia, MustVerifyEmail
{
	use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'role_id',
		'username',
		'email',
		'password',
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [
		'password',
		'remember_token',
		'creditCard'
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
		'password' => 'hashed',
	];

	/**
	 * Define a relationship where the User has one Subscription.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function subscription(): HasOne
	{
		return $this->hasOne(Subscription::class);
	}

	/**
	 * Define a relationship where the User has one CreditCard.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function creditCard(): HasOne
	{
		return $this->hasOne(CreditCard::class);
	}

	/**
	 * Define a relationship where the User has many BookReview.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function bookReviews(): HasMany
	{
		return $this->hasMany(BookReview::class);
	}

	/**
	 * Define a relationship where the User belongs to a Role.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function role(): BelongsTo
	{
		return $this->belongsTo(Role::class);
	}

	/**
	 * Define a relationship where the User has many Bookmark.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function bookmarks(): HasMany
	{
		return $this->hasMany(Bookmark::class);
	}
}
