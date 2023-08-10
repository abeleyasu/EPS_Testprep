<?php

namespace App\Http\Controllers\Cronjob;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
use App\Models\Subscription;

class FreeSubscriptionController extends Controller
{
    public function index() {
        try {
            $date = Carbon::now();
            $date = Carbon::parse($date)->setTime(0, 0, 0);
            $date = $date->format('Y-m-d H:i:s');
            $users = User::where('trial_ends_at', '<=', $date)->get();
            $free_role = Role::where('name', config('constants.role_free_name'))->first();
            foreach ($users as $user) {
                Log::chanel('freesubscription')->info('User id: '.$user->id.' email: '.$user->email.' trial_ends_at: '.$user->trial_ends_at);
                $user->trial_ends_at = null;
                if ($user->hasRole($free_role)) {
                    $user->removeRole($free_role);
                }
                $user->save();
            }
        } catch (\Exception $e) {
            Log::chanel('freesubscription')->error($e->getMessage());
        }
    }

    public function subscriptionRenewalAlert() {
        $subscriptions = Subscription::where([
            ['stripe_status', '=', 'active'],
            ['plan_type', '=', 'subscription']
        ])->get();
        
        if (count($subscriptions) > 0) {
            foreach ($subscriptions as $subscription) {
                if ($subscription->ends_at) {
                    // send subscription cancel email
                } else {
                    $stripe_subscription = $this->stripe->subscriptions->retrieve(
                        $subscription->stripe_id,
                        []
                    );
                    $subscription_next_billing_date = Carbon::createFromTimestamp($stripe_subscription->current_period_end)->format('Y-m-d H:i:s');
                    $before_week_date = Carbon::parse($subscription_next_billing_date)->subWeek()->format('Y-m-d');
                    $current_date = Carbon::now()->format('Y-m-d');
                    if ($current_date == $before_week_date) {
                        $user = $subscription->user;
                        $this->mailgun->sendMail([
                            'to' => $user->email,
                            'subject' => 'Reminder: Your Subscription Renewal is One Week Away!',
                            'html' => view('email-template.subscription.renewal', [
                                'name' => $user->first_name,
                                'plan_name' => $subscription->plan->product->title . ' - ' . $subscription->plan->interval_count . ' ' . $subscription->plan->interval . ' subscription',
                                'renewal_date' => $subscription_next_billing_date,
                                'amount' => '$'.number_format($subscription->plan->display_amount) . ' per ' . $subscription->plan->interval . ' (' . number_format($subscription->plan->amount) . ' total )',
                            ])->render()
                        ]);
                    }
                }
            }
        }
    }
}
