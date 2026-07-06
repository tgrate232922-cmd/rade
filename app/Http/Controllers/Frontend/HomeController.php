<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\LandingPage;
use App\Models\Subscription;
use App\Models\Theme;
use App\Services\CrawlerDetector;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class HomeController extends Controller
{
    public function home(CrawlerDetector $crawlerDetector)
    {
        $customLandingTheme = Theme::where('type', 'landing')->where('status', true)->first();
        if ($customLandingTheme) {
            return view('landing_theme.' . $customLandingTheme->name);
        }

        $redirectPage = setting('home_redirect', 'global');

        if ($redirectPage == '/') {
            if ($this->isHomeBotProtectionEnabled()) {
                if ($crawlerDetector->isCrawler()) {
                    return response()
                        ->view('frontend::home.crawler')
                        ->header('X-Robots-Tag', 'noindex, nofollow');
                }

                return view('frontend::home.shell');
            }

            return view('frontend::home.index', [
                'homeContent' => $this->getHomeContent(),
            ]);
        }

        return redirect($redirectPage);
    }

    public function content(CrawlerDetector $crawlerDetector): Response
    {
        if (!$this->isHomeBotProtectionEnabled() || $crawlerDetector->isCrawler()) {
            abort(403);
        }

        return response()
            ->view('frontend::home._sections', [
                'homeContent' => $this->getHomeContent(),
            ])
            ->header('Cache-Control', 'private, no-store');
    }

  /**
     * @return RedirectResponse
     */
    public function subscribeNow(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:subscriptions'],
        ]);

        if ($validator->fails()) {
            notify()->error($validator->errors()->first(), 'Error');

            return redirect()->back();
        }

        Subscription::create([
            'email' => $request->email,
        ]);

        notify()->success(__('Subscribe Successfully'));

        return redirect()->back();
    }

    /**
     * @return bool
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function themeMode()
    {

        $oldTheme = session()->get('site-color-mode');

        if ($oldTheme == 'dark-theme') {
            session()->put('site-color-mode', 'light-theme');
        } else {
            session()->put('site-color-mode', 'dark-theme');
        }
    }

    /**
     * @return RedirectResponse
     */
    public function languageUpdate(Request $request)
    {

        App::setLocale($request->name);
        session()->put('locale', $request->name);

        return redirect()->back();
    }

    public function session(Request $request)
    {
        $key = $request->input('key');
        $value = $request->input('value');
        session([$key => $value]);
        return response()->json(['success' => true]);
    }

    private function isHomeBotProtectionEnabled(): bool
    {
        return (bool) setting('home_bot_protection', 'permission', false);
    }

    private function getHomeContent()
    {
        return LandingPage::where('status', true)
            ->whereNot('code', 'footer')
            ->where('locale', app()->getLocale())
            ->orderBy('short')
            ->get();
    }
}
