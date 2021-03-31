<?php
namespace SavyCon\Http\Controllers;

ini_set('max_execution_time', 300);

use Illuminate\Http\Request;

use SavyCon\Models\Advert;
use SavyCon\Models\UserService;
use SavyCon\Models\UserRequest;
use SavyCon\Models\User;
use SavyCon\Models\Category;
use SavyCon\Models\Payment;
use SavyCon\Models\Service;
use SavyCon\Models\ServiceLink;
use SavyCon\Models\UserServiceRating;

class PagesController extends Controller
{
    public function index()
    {

        //Check for Due featured services and unfeature them
        if (!session('promotionChecked', false)) {
            $this->unfeatureServices();
        }

        $featured_services = UserService::inRandomOrder()->where('featured', '1')->with([
            'user',
            'service',
            'service.category'
        ])->where('active', 1)->get();

        //$adverts = Advert::inRandomOrder()->where('layer', 'home')->orWhere('layer', 'all')->limit(6)->get();
        $adverts = Advert::inRandomOrder()->where('layer', 'home')->where('active', 1)->get();

    	return view('pages.index', [
            'featured_services' => $featured_services,
            'adverts' => $adverts,
            'services' => 0,
        ]);
    }

    private function unfeatureServices() {

        $payments = Payment::whereDate('created_at', '<', date("Y-m-d"))->with('userService')->get();
        foreach ($payments as $key => $payment) {
            $this->unfeatureService($payment);
        }
    }

    private function unfeatureService($payment) {

        $today = date_create(date('Y-m-d'));
        $created = date_create(date('Y-m-d', strtotime($payment->created_at)));

        $days = intval(date_diff($created, $today, TRUE)->format('%a'));

        $service = UserService::find($payment->user_service_id);
        if ($service) {
            if ($payment->package == 'month' && $days >= 30) {
                $service->featured = 0;
                $service->save();
            }
            elseif ($payment->package == 'week' && $days >= 7) {
                $service->featured = 0;
                $service->save();
            }
        }
    }

    private function deleteAds() {

        $advertsToDelete = Advert::whereDate('created_at', '<', date("Y-m-d"))->get();
        foreach ($advertsToDelete as $key => $advert) {
            $this->deleteAd($advert);
        }

        session('advertsDeleted', true);
    }

    private function deleteAd($advert) {

        $today = date_create(date('Y-m-d'));
        $created = date_create(date('Y-m-d', strtotime($advert->created_at)));

        $days = intval(date_diff($created, $today, TRUE)->format('%a'));

        if ($advert->package == 'month' && $days >= 30) {
            $advert->delete();
        }
        elseif ($advert->package == 'week' && $days >= 7) {
            $advert->delete();
        }
    }

    public function services()
    {
    	return view('pages.services');
    }

    public function servicepage()
    {
    	return view('pages.services.servicePage');
    }

    public function showService($id)
    {
        $service = UserService::withCount('ratings')->
        with([
            'user',
            'service',
            'service.category'
        ])->findOrFail($id);

        $service->views += 1;
        $service->save();

        $alreadyReviewed = null;
        $canComment = 1;

        if (auth()->user()) {
            if (auth()->user()->id === $service->id) {
                $canComment = null;
            }

            $ratings = auth()->user()->ratings()->where('user_service_id', $service->id)->get();
            if (count($ratings) > 0) {
                $alreadyReviewed = 1;
            }
        }

        $average_rating = $this->getAverageReview(UserServiceRating::where('user_service_id', $service->id)->get()); 

        return view('pages.services.single')->with([
            'service' => $service,
            'canComment' => $canComment,
            'alreadyReviewed' => $alreadyReviewed,
            'average_rating' => $average_rating
        ]);
    }

    public function userServices($id) 
    {
        $user = User::findOrFail($id);
        $services = UserService::where('user_id', $id)->paginate(10);

        return view('pages.services.user')->with([
            'user' => $user,
            'services' => $services
        ]);
    }

    public function buyersRequests()
    {
        $buyersRequests = UserRequest::inRandomOrder()->with([
            'user'
        ])->paginate(20);

        return view('pages.requests.requests')->with([
            'buyersRequests' => $buyersRequests,
        ]);
    }

    public function showBuyersRequest($id)
    {
        $buyersRequest = UserRequest::with([
            'user'
        ])->findOrFail($id);

        return view('pages.requests.single')->with([
            'buyersRequest' => $buyersRequest,
        ]);
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
    	return view('pages.contact');
    }

    public function thankYou()
    {
        return view('pages.thanks');
    }

    public function terms()
    {
    	return view('pages.terms');
    }

    public function privacyPolicy()
    {
    	return view('pages.privacyPolicy');
    }

    public function howItWorks()
    {
        return view('pages.howItWorks');
    }

    public function help()
    {
        return view('pages.help');
    }

    public function loadCategory($id)
    {
        $category = Category::findOrFail($id);

        return view('pages.services.category')->with([
            'category' => $category,
        ]);
    }

    public function loadSubCategory($id)
    {
        $subCategory = Service::findOrFail($id);

        return view('pages.services.subCategory')->with([
            'subCategory' => $subCategory,
        ]);
    }

    private function getAverageReview($ratings)
    {
        $number_of_reviews = count($ratings);
        $total = 0;

        foreach ($ratings as $rating) {
            $total += $rating->stars;
        }

        if ($number_of_reviews > 0) {
            $average = $total / $number_of_reviews;
        } else {
            $average = 0;
        }

        return $average;
    }

    public function invoice($id) {

         $payment = Payment::with([
            'user',
            'userService'
        ])->where('id', $id)->first();

        return view('pages.invoice', ['payment' => $payment]);
    }

    public function serviceDetails()
    {
        
        $uid = request()->get('id');
        $service = request()->get('service');
        
        $data['expired'] = FALSE;
        
        $details = ServiceLink::where(['uid' => $uid, 'service' => $service])->first();
        if ($details) {
            
            $data['details'] = $details;
            $today = date_create(date('Y-m-d H:i:s'));
            $created = date_create(date('Y-m-d H:i:s', strtotime($details->created_at)));

            if ($created->diff($today)->h > 3) {
                $data['expired'] = TRUE;
            }
        }
        else {
            return view('404');
        }

        return view('pages.serviceDetails', $data);
    }
}
