<?php

namespace Modules\BusinessSettingsModule\Http\Controllers\Web\Provider;

use App\Traits\ActivationClass;
use App\Traits\FileManagerTrait;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Modules\BusinessSettingsModule\Entities\BusinessSettings;
use Modules\ProviderManagement\Entities\Provider;
use Modules\ProviderManagement\Entities\ProviderSetting;
use Modules\ProviderManagement\Entities\ProvidersWithdrawMethodsData;
use Modules\TransactionModule\Entities\WithdrawalMethod;

class WithdrawPaymentInformationController extends Controller
{

    private ProvidersWithdrawMethodsData $providersWithdrawMethodsData;
    private WithdrawalMethod $withdrawalMethod;

    public function __construct(ProvidersWithdrawMethodsData $providersWithdrawMethodsData, WithdrawalMethod $withdrawalMethod)
    {
        $this->providersWithdrawMethodsData = $providersWithdrawMethodsData;
        $this->withdrawalMethod = $withdrawalMethod;
    }

    public function index(Request $request)
    {
        $providerId = $request->user()->id;
        $search = $request->input('search', '');

        $methods = $this->providersWithdrawMethodsData->where('provider_id', $providerId)
            ->when($search, function ($query, $search) {
                $keys = explode(' ',$search);
                $query->where(function ($q) use ($keys) {
                    foreach ($keys as $key) {
                        $q->orWhere('method_name', 'LIKE', '%' . $key . '%');
                    }
                });
            })
            ->latest()
            ->paginate(pagination_limit());

        $withdrawalMethods = $this->withdrawalMethod->get();

        return view('businesssettingsmodule::provider.withdraw-payment-information', compact('methods', 'withdrawalMethods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'withdrawal_method_id' => 'required|uuid|exists:withdrawal_methods,id',
            'method_field_data' => 'required|array',
        ]);

        $withdrawalMethod = $this->withdrawalMethod->find($request['withdrawal_method_id']);

        if (!$withdrawalMethod) {
            Toastr::error(translate('method not found'));
            return back();
        }

        $fields = array_column($withdrawalMethod->method_fields ?? [], 'input_name');
        $submittedData = $request->method_field_data;

        foreach ($fields as $field) {
            if (!array_key_exists($field, $submittedData)) {
                Toastr::error("Missing field: {$field}");
                return back();
            }
        }

        $hasExisting = $this->providersWithdrawMethodsData
            ->where('provider_id', $request->user()->id)
            ->exists();

        $method = new $this->providersWithdrawMethodsData;

        $method->provider_id = $request->user()->id;
        $method->withdrawal_method_id = $withdrawalMethod->id;
        $method->method_name = $withdrawalMethod->method_name;
        $method->method_field_data = $submittedData;
        $method->is_default = !$hasExisting;
        $method->is_active = $hasExisting == false || (bool)$request->is_active;
        $method->save();

        //update setup guideline data
        updateSetupGuidelineTutorialsOptions(auth()->user()->id,'payment_information', 'web');

        Toastr::success(translate(DEFAULT_STORE_200['message']));
        return back();
    }


    public function statusUpdate(Request $request, $id)
    {
        $method = $this->providersWithdrawMethodsData->where('id', $id)
            ->where('provider_id', $request->user()->id)
            ->first();

        if (!$method) {
            Toastr::error(translate('method not found'));
            return back();
        }

        $method->is_active = !$method->is_active;
        $method->save();

        return response()->json(response_formatter(DEFAULT_STATUS_UPDATE_200), 200);
    }

    public function defaultStatusUpdate(Request $request, $id)
    {
        $providerId = $request->user()->id;

        $this->providersWithdrawMethodsData->where('provider_id', $providerId)
            ->update(['is_default' => false]);

        $method = $this->providersWithdrawMethodsData->where('id', $id)
            ->where('provider_id', $providerId)
            ->first();

        if (!$method) {
            Toastr::error(translate('method not found'));
            return back();
        }

        $method->is_default = true;
        $method->is_active = true;
        $method->save();

        Toastr::success(translate(DEFAULT_UPDATE_200['message']));
        return back();
    }

    public function delete(Request $request, $id)
    {
        $method = $this->providersWithdrawMethodsData->where('id', $id)
            ->where('provider_id', $request->user()->id)
            ->first();

        if (!$method) {
            Toastr::error(translate('method not found'));
            return back();
        }

        $method->delete();

        Toastr::success(translate(DEFAULT_DELETE_200['message']));
        return back();
    }

    public function edit($id)
    {
        $method = $this->providersWithdrawMethodsData->findOrFail($id);
        $withdrawalMethod = WithdrawalMethod::findOrFail($method->withdrawal_method_id);

        return response()->json([
            'method' => $method,
            'method_fields' => $withdrawalMethod->method_fields,
            'method_field_data' => $method->method_field_data,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'method_field_data' => 'required|array',
        ]);

        $method = $this->providersWithdrawMethodsData
            ->where('provider_id', $request->user()->id)
            ->findOrFail($id);

        $withdrawalMethod = $this->withdrawalMethod->find($method->withdrawal_method_id);

        if (!$withdrawalMethod) {
            Toastr::error(translate('Withdrawal method not found.'));
            return back();
        }

        // Ensure all required method fields are present
        $requiredFields = array_column($withdrawalMethod->method_fields ?? [], 'input_name');
        $submittedData = $request->method_field_data;

        foreach ($requiredFields as $field) {
            if (!array_key_exists($field, $submittedData)) {
                Toastr::error(translate("Missing field: ") . $field);
                return back();
            }
        }

        $method->method_field_data = $submittedData;
        $method->is_active = (bool) $request->is_active;
        $method->save();

        Toastr::success(translate(DEFAULT_UPDATE_200['message']));
        return back();
    }



}
