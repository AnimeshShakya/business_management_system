<?php

namespace Modules\CustomerModule\Http\Controllers\Api\V1\Customer;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\CustomerModule\Entities\SubscribeNewsletter;

class SubscribeNewsletterController extends Controller
{
    public function __construct(
        private SubscribeNewsletter $subscribeNewsletter
    )
    {}

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function subscribeNewsletter(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:subscribe_newsletters',
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $newsletter = $this->subscribeNewsletter;
        $newsletter->email = $request->email;
        $newsletter->save();

        return response()->json(response_formatter(SUBSCRIBE_NEWSLETTER_200), 200);
    }

}
