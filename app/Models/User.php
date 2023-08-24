<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Cashier\Billable;
use Spatie\Permission\Traits\HasRoles;
use App\Models\UserRole;
use App\Models\HighSchoolResume\States;
use App\Models\HighSchoolResume\Cities;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Billable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'phone',
        'role',
        'password',
        'parent_phone',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin(){
        return (int) $this->role === 1;
    }

    public function isUser(){
        return (int) $this->role !== 1;
    }

    public function deadlineReminderSettings() {
        return $this->hasMany(UserDeadlineNotificationSettings::class, 'user_id', 'id');
    }

    public function userrole() {
        return $this->hasOne(UserRole::class, 'id', 'role');
    }

    public function isUserHasValidPermission($permission, $guardName = null) {
        $gaurd = $guardName ? $guardName : 'user';
        $role = UserRole::where('id', $this->role)->first();
        $permissions = $role->permissions->where('guard_name', $gaurd)->pluck('name')->toArray();
        return in_array($permission, $permissions);
    }

    public function isUserSubscibedToTheProduct($products, $isWhichCalled = null) {
        // dd($products);
        if (isset($products) && !empty($products) && count($products) == 0) return false;
        $subscription = $this->getUserStripeSubscription();
        if ($subscription && $subscription->valid()) {
            $product = $subscription->plan->product;
            if ($product) {
                // dd(in_array($product->id, $products));
                return in_array($product->id, $products);
            }
        }
        return false;
    }

    public function city() {
        return Cities::where('id', $this->city_id)->first();
    }

    public function state() {
        return States::where('id', $this->state_id)->first();
    }

    public function isUserSubscriptionOnGracePeriod() {
        $subscription = $this->getUserStripeSubscription();
        return $subscription && $subscription->onGracePeriod();
    }

    public function getUserStripeSubscription($name = 'default', $isAll = false) {
        $query = $this->subscriptions()->active()->where('name', $name);
        if (!$isAll) {
            return $query->where('plan_type', '=', 'subscription')->first();
        }
        return $query->get();
    }

    public function isSubscribeToSubscriptions($name = 'default') {
        $subscription = $this->getUserStripeSubscription($name);
        if ($subscription) {
            return $subscription->valid() || $subscription->onGracePeriod();
        }
        return false;
    }

    public function isUserSubscriptionToAnyPlan($name = 'default') {
        $subscription = $this->getUserStripeSubscription($name, true);
        return count($subscription) > 0;
    }

    public function hasVerifiedEmail() {
        return ! is_null($this->email_verified_at);
    }

    public function userSurvey() {
        return $this->hasOne(UserSurvey::class, 'user_id', 'id');
    }
}
