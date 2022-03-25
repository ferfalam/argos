<?php

namespace App\Http\Controllers\SuperAdmin;

use App\AuthorizationInvoice;
use App\ClientDetails;
use App\Company;
use App\EmployeeDetails;
use App\Helper\Reply;
use App\LoginHistory;
use App\MollieInvoice;
use App\OfflineInvoice;
use App\Package;
use App\PaypalInvoice;
use App\PaystackInvoice;
use App\Project;
use App\ProjectMilestone;
use App\RazorpayInvoice;
use App\StripeInvoice;
use App\Task;
use App\Traits\CurrencyExchange;
use Carbon\Carbon;
use Froiden\Envato\Traits\AppBoot;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\SmtpSetting;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SuperAdminDashboardController extends SuperAdminBaseController
{
    use CurrencyExchange, AppBoot;

    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'app.menu.dashboard';
        $this->pageIcon = 'icon-speedometer';
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function index()
    {
        // $this->changeAppUrlEnvironment();
        $this->totalCompanies = Company::count();
        $this->totalEmployees = User::join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->where('roles.name', 'employee')
            ->count();
        $this->totalClients = ClientDetails::count();
        $this->tasksresearche = ProjectMilestone::where('type','Research')->count();
        $this->tasksprogress = ProjectMilestone::where('type','Development')->count();
        $this->totaltasks = Task::where('status','incomplete')->count();

        $this->totalPackages = Package::where('default', '!=', 'trial')->count();
        $this->activeCompanies = Company::where('status', '=', 'active')->count();

        $this->inactiveCompanies = Company::where('status', '=', 'inactive')->count();

        $expiredCompanies = Company::with('package')->where('status', 'license_expired')->get();
        $this->expiredCompanies = $expiredCompanies->count();

        // Collect recent 5 licence expired companies detail
        $this->recentExpired = $expiredCompanies->sortBy('updated_at')->take(5);

        // Collect data for earning chart
        $months = [
            '1' => 'Jan',
            '2' => 'Feb',
            '3' => 'Mar',
            '4' => 'Apr',
            '5' => 'May',
            '6' => 'Jun',
            '7' => 'Jul',
            '8' => 'Aug',
            '9' => 'Sep',
            '10' => 'Oct',
            '11' => 'Nov',
            '12' => 'Dec',
        ];

        $invoices = StripeInvoice::selectRaw('SUM(amount) as amount,YEAR(pay_date) as year, MONTH(pay_date) as month')->whereNotNull('stripe_invoices.pay_date')->havingRaw('year = ?', [Carbon::now()->year])->groupBy('month')->get()->groupBy('month')->toArray();

        $paypalInvoices = PaypalInvoice::selectRaw('SUM(total) as total,YEAR(paid_on) as year, MONTH(paid_on) as month')->where('paypal_invoices.status', 'paid')->havingRaw('year = ?', [Carbon::now()->year])->groupBy('month')->get()->groupBy('month')->toArray();

        $razorpayInvoice = RazorpayInvoice::selectRaw('SUM(amount) as amount,YEAR(pay_date) as year, MONTH(pay_date) as month')->whereNotNull('razorpay_invoices.pay_date')->havingRaw('year = ?', [Carbon::now()->year])->groupBy('month')->get()->groupBy('month')->toArray();

        $paystackInvoice = PaystackInvoice::selectRaw('SUM(amount) as amount,YEAR(pay_date) as year, MONTH(pay_date) as month')->whereNotNull('paystack_invoices.pay_date')->havingRaw('year = ?', [Carbon::now()->year])->groupBy('month')->get()->groupBy('month')->toArray();

        $mollieInvoice = MollieInvoice::selectRaw('SUM(amount) as amount,YEAR(pay_date) as year, MONTH(pay_date) as month')->whereNotNull('mollie_invoices.pay_date')->havingRaw('year = ?', [Carbon::now()->year])->groupBy('month')->get()->groupBy('month')->toArray();
        $offlineInvoice = OfflineInvoice::selectRaw('SUM(amount) as amount,YEAR(pay_date) as year, MONTH(pay_date) as month')->whereNotNull('offline_invoices.pay_date')->havingRaw('year = ?', [Carbon::now()->year])->groupBy('month')->get()->groupBy('month')->toArray();

        $authorizeInvoice = AuthorizationInvoice::selectRaw('SUM(amount) as amount,YEAR(pay_date) as year, MONTH(pay_date) as month')->whereNotNull('authorize_invoices.pay_date')->havingRaw('year = ?', [Carbon::now()->year])->groupBy('month')->get()->groupBy('month')->toArray();

        $chartData = [];
        foreach ($months as $key => $month) {
            if (key_exists($key, $invoices)) {
                foreach ($invoices[$key] as $amount) {
                    $chartData[] = ['month' => $month, 'amount' => $amount['amount']];
                }
            } else {
                $chartData[] = ['month' => $month, 'amount' => 0];
            }

            if (key_exists($key, $razorpayInvoice)) {
                foreach ($razorpayInvoice[$key] as $amount) {
                    $chartData[] = ['month' => $month, 'amount' => $amount['amount']];
                }
            } else {
                $chartData[] = ['month' => $month, 'amount' => 0];
            }
            if (key_exists($key, $paypalInvoices)) {
                foreach ($paypalInvoices[$key] as $amount) {
                    $chartData[] = ['month' => $month, 'amount' => $amount['total']];
                }
            } else {
                $chartData[] = ['month' => $month, 'amount' => 0];
            }
            if (key_exists($key, $paystackInvoice)) {
                foreach ($paystackInvoice[$key] as $amount) {
                    $chartData[] = ['month' => $month, 'amount' => $amount['amount']];
                }
            } else {
                $chartData[] = ['month' => $month, 'amount' => 0];
            }
            if (key_exists($key, $mollieInvoice)) {
                foreach ($mollieInvoice[$key] as $amount) {
                    $chartData[] = ['month' => $month, 'amount' => $amount['amount']];
                }
            } else {
                $chartData[] = ['month' => $month, 'amount' => 0];
            }
            if (key_exists($key, $authorizeInvoice)) {
                foreach ($authorizeInvoice[$key] as $amount) {
                    $chartData[] = ['month' => $month, 'amount' => $amount['amount']];
                }
            } else {
                $chartData[] = ['month' => $month, 'amount' => 0];
            }
            if (key_exists($key, $offlineInvoice)) {
                foreach ($offlineInvoice[$key] as $amount) {
                    $chartData[] = ['month' => $month, 'amount' => $amount['amount']];
                }
            } else {
                $chartData[] = ['month' => $month, 'amount' => 0];
            }
        }
        // return $chartData;
        $sumArray = array();

        foreach ($months as $key => $month) {

            $amount = 0;
            foreach ($chartData as $k => $subArray) {
                if ($subArray['month'] == $month) {
                    $amount = $amount + $subArray['amount'];
                }
            }
            $sumArray[] = [
                'month' => $month,
                'amount' => $amount,
            ];
        }


        $this->chartData = json_encode($sumArray);

        // Collect data of recent registered 5 companies
        $this->recentRegisteredCompanies = Company::with('package')->take(5)->latest()->get();

        $stripe = DB::table('stripe_invoices')
            ->join('packages', 'packages.id', 'stripe_invoices.package_id')
            ->join('companies', 'companies.id', 'stripe_invoices.company_id')
            ->selectRaw('stripe_invoices.amount,stripe_invoices.id ,companies.company_name, packages.name, companies.package_type,"Stripe" as method, stripe_invoices.pay_date as paid_on, "" as end_on ,stripe_invoices.next_pay_date, stripe_invoices.created_at')
            ->whereNotNull('stripe_invoices.pay_date');

        $razorpay = DB::table('razorpay_invoices')
            ->join('packages', 'packages.id', 'razorpay_invoices.package_id')
            ->join('companies', 'companies.id', 'razorpay_invoices.company_id')
            ->selectRaw('razorpay_invoices.amount,razorpay_invoices.id ,companies.company_name , packages.name as name, companies.package_type, "Razorpay" as method, razorpay_invoices.pay_date as paid_on , "" as end_on,razorpay_invoices.next_pay_date,razorpay_invoices.created_at')
            ->whereNotNull('razorpay_invoices.pay_date');

        $paystack = DB::table('paystack_invoices')
            ->join('packages', 'packages.id', 'paystack_invoices.package_id')
            ->join('companies', 'companies.id', 'paystack_invoices.company_id')
            ->selectRaw('paystack_invoices.amount,paystack_invoices.id ,companies.company_name , packages.name as name, companies.package_type, "Mollie" as method, paystack_invoices.pay_date as paid_on , "" as end_on,paystack_invoices.next_pay_date,paystack_invoices.created_at')
            ->whereNotNull('paystack_invoices.pay_date');

        $authorize = DB::table('authorize_invoices')
            ->join('packages', 'packages.id', 'authorize_invoices.package_id')
            ->join('companies', 'companies.id', 'authorize_invoices.company_id')
            ->selectRaw('authorize_invoices.amount,authorize_invoices.id ,companies.company_name , packages.name as name, companies.package_type, "Authorize" as method, authorize_invoices.pay_date as paid_on , "" as end_on,authorize_invoices.next_pay_date,authorize_invoices.created_at')
            ->whereNotNull('authorize_invoices.pay_date');

        $mollie = DB::table('mollie_invoices')
            ->join('packages', 'packages.id', 'mollie_invoices.package_id')
            ->join('companies', 'companies.id', 'mollie_invoices.company_id')
            ->selectRaw('mollie_invoices.amount,mollie_invoices.id ,companies.company_name , packages.name as name, companies.package_type, "Mollie" as method, mollie_invoices.pay_date as paid_on , "" as end_on,mollie_invoices.next_pay_date,mollie_invoices.created_at')
            ->whereNotNull('mollie_invoices.pay_date');

        $offline = DB::table('offline_invoices')
            ->join('packages', 'packages.id', 'offline_invoices.package_id')
            ->join('companies', 'companies.id', 'offline_invoices.company_id')
            ->selectRaw('offline_invoices.amount,offline_invoices.id ,companies.company_name , packages.name as name, companies.package_type, "Offline" as method, offline_invoices.pay_date as paid_on , "" as end_on,offline_invoices.next_pay_date,offline_invoices.created_at')
            ->whereNotNull('offline_invoices.pay_date')
            ->where('offline_invoices.status', 'paid');

        $allInvoices = DB::table('paypal_invoices')
            ->join('packages', 'packages.id', 'paypal_invoices.package_id')
            ->join('companies', 'companies.id', 'paypal_invoices.company_id')
            ->selectRaw('paypal_invoices.amount,paypal_invoices.id,companies.company_name, packages.name, companies.package_type, "Paypal" as method, paypal_invoices.paid_on, paypal_invoices.end_on,paypal_invoices.next_pay_date,paypal_invoices.created_at')
            ->where('paypal_invoices.status', 'paid')
            ->union($stripe)
            ->union($razorpay)
            ->union($paystack)
            ->union($offline)
            ->union($mollie)
            ->union($authorize)
            ->get();
        $this->allInvoices = $allInvoices;
        //return $allInvoices;
        $this->recentSubscriptions = $allInvoices->sortByDesc(function ($temp, $key) {
            return Carbon::parse($temp->created_at)->getTimestamp();
        })->take(5);

        try {
            $client = new Client();
            $res = $client->request('GET', config('froiden_envato.updater_file_path'), ['verify' => false]);
            $lastVersion = $res->getBody();
            $lastVersion = json_decode($lastVersion, true);

            if ($lastVersion['version'] > File::get(public_path() . 'version.txt')) {
                $this->lastVersion = $lastVersion['version'];
            }
        } catch (\Throwable $th) {
            //throw $th;
        }

        $this->onlineUsers = User::where('super_admin', '0')->where("online", true)->get();
        $this->allUsers = User::all();
        $this->allCompanies = Company::all();
        $this->progressPercent = $this->progressbarPercent();
        $this->isCheckScript();
        return view('super-admin.dashboard.index', $this->data);
    }

    private function progressbarPercent()
    {
        $this->smtpSetting = SmtpSetting::first();
        $totalItems = 4;
        $completedItem = 1;
        $progress = [];
        $progress['progress_completed'] = false;

        if ($this->global->company_email != 'company@email.com') {
            $completedItem++;
            $progress['company_setting_completed'] = true;
        }

        if ($this->smtpSetting->verified !== 0 || $this->smtpSetting->mail_driver == 'mail') {
            $progress['smtp_setting_completed'] = true;

            $completedItem++;
        }

        if ($this->user->email != 'superadmin@example.com') {
            $progress['profile_setting_completed'] = true;

            $completedItem++;
        }


        if ($totalItems == $completedItem) {
            $progress['progress_completed'] = true;
        }

        $this->progress = $progress;


        return ($completedItem / $totalItems) * 100;
    }

    public function stripePopUpClose()
    {
        $this->superadmin->show_update_popup = 0;
        $this->superadmin->save();
        return Reply::dataOnly([]);
    }

    //Add site URL in env
    protected function changeAppUrlEnvironment()
    {
        $path = '../.env';
        if (file_exists($path)) {
            //Try to read the current content of .env
            $current = file_get_contents($path);

            $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] .
                $_SERVER['REQUEST_URI'];

            $host = str_replace('/super-admin/dashboard', '', $link);
            //Store the key
            $original = [];
            if (preg_match('/^APP_URL=(.+)$/m', $current, $original) && $host != '') {
                $appUrl = $host;
                //Write the original key to console
                //Overwrite with new key
                $current = preg_replace('/^APP_URL=.+$/m', 'APP_URL=' . $appUrl . '', $current);

                // Check if sting has double quote or not
                if (strpos($appUrl, '"') === false) {
                    file_put_contents($path, $current);
                }
            }
        }
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function historyData(Request $request)
    {
        $histories = LoginHistory::where('duration', '<>', '--');
        if (!is_null($request->name) && $request->name != 'all') {
            $histories = $histories->where("user_id",$request->name);
        }
        if (!is_null($request->date) && $request->date != '') {
            $histories = $histories->where("login_at",">=", $request->date);
        }
        if (!is_null($request->company) && $request->company != 'all') {
            $histories = $histories->where("company_id", $request->company);
        }
        $histories = $histories->orderBy("login_at", "DESC")->get();
        return DataTables::of($histories)
            ->editColumn('name', function ($row) {
                return '<strong>' . ucfirst($row->user()->first()->name) . '</strong>';
                //return '<a href="' . route('super-admin.companies.edit', $row->id) . '"  data-company-id="' . $row->id . '"><strong>' . ucfirst($row->company_name) . '</strong></a>';
            })
            ->editColumn('company', function ($row) {
                return '<strong>' . $row->thisCompany()->first()->company_name . '</strong>';
                //return '<a href="' . route('super-admin.companies.edit', $row->id) . '"  data-company-id="' . $row->id . '"><strong>' . ucfirst($row->company_name) . '</strong></a>';
            })
            ->editColumn('login_at', function ($row) {
                return Carbon::parse($row->login_at)->format(company()->date_format.' '.company()->time_format);
            })
            ->editColumn('duration', function ($row) {
                $res = gmdate("H:i:s", intval($row->duration));
                return $res;
                //     
                //     <img src="' . asset("img/user-2.png") . '" alt="">
                //     <img src="' . asset("img/user-3.png") . '" alt="">
                //     <img src="' . asset("img/user-4.png") . '" alt=""></div>';
            })
            ->rawColumns(['name', 'company'])
            ->make(true);
    }
}
