<?php

namespace Modules\CustomerModule\Http\Controllers\Web\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Routing\Controller;
use Modules\CustomerModule\Entities\SubscribeNewsletter;
use Rap2hpoutre\FastExcel\FastExcel;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SubscribeNewsletterController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private SubscribeNewsletter $subscribeNewsletter
    )
    {}

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $this->authorize('newsletter_view');

        $search = $request->get('search', '');
        $from = $request->get('from', '');
        $to = $request->get('to', '');
        $sort_by = $request->get('sort_by', 'latest');
        $limit = $request->get('limit');

        $queryParam = ['search' => $search, 'from' => $from, 'to' => $to, 'sort_by' => $sort_by, 'limit' => $limit];

        $query = $this->subscribeNewsletter
            ->when($request->has('search'), function ($query) use ($request) {
                $keys = explode(' ', $request['search']);
                return $query->where(function ($query) use ($keys) {
                    foreach ($keys as $key) {
                        $query->where('email', 'LIKE', '%' . $key . '%');
                    }
                });
            })
            ->when($from, function ($query) use ($from) {
                return $query->whereDate('created_at', '>=', $from);
            })
            ->when($to, function ($query) use ($to) {
                return $query->whereDate('created_at', '<=', $to);
            })
            ->when($sort_by === 'latest', function ($query) {
                return $query->latest();
            })
            ->when($sort_by === 'oldest', function ($query) {
                return $query->oldest();
            })
            ->when($sort_by === 'ascending', function ($query) {
                return $query->orderBy('email', 'asc');
            })
            ->when($sort_by === 'descending', function ($query) {
                return $query->orderBy('email', 'desc');
            });

        if (isset($limit) && $limit > 0) {
            $subscribeNewsletters = $query->take($limit)->get(); // limit results
            $perPage = pagination_limit();
            $page =  $request?->page ?? 1;
            $offset = ($page - 1) * $perPage;
            $itemsForCurrentPage = $subscribeNewsletters->slice($offset, $perPage);
            $newsletters = new \Illuminate\Pagination\LengthAwarePaginator(
                $itemsForCurrentPage,
                $subscribeNewsletters->count(),
                $perPage,
                $page,
                ['path' => Paginator::resolveCurrentPath(), 'query' => request()->query()]
            );
        } else {

            $newsletters = $query
                ->paginate(pagination_limit())
                ->appends($queryParam);
        }

        return view('customermodule::admin.newsletter.list', compact('newsletters', 'queryParam'));
    }

    public function download(Request $request)
    {
        $this->authorize('newsletter_export');

        $search = $request->get('search', '');
        $from = $request->get('from', '');
        $to = $request->get('to', '');
        $sort_by = $request->get('sort_by', 'latest');
        $limit = $request->get('limit');


        $query = $this->subscribeNewsletter
            ->when($search, function ($query) use ($search) {
                $keys = explode(' ', $search);
                return $query->where(function ($query) use ($keys) {
                    foreach ($keys as $key) {
                        $query->where('email', 'LIKE', '%' . $key . '%');
                    }
                });
            })
            ->when($from, function ($query) use ($from) {
                return $query->whereDate('created_at', '>=', $from);
            })
            ->when($to, function ($query) use ($to) {
                return $query->whereDate('created_at', '<=', $to);
            })
            ->when($sort_by === 'latest', function ($query) {
                return $query->latest();
            })
            ->when($sort_by === 'oldest', function ($query) {
                return $query->oldest();
            })
            ->when($sort_by === 'ascending', function ($query) {
                return $query->orderBy('email', 'asc');
            })
            ->when($sort_by === 'descending', function ($query) {
                return $query->orderBy('email', 'desc');
            });

        if (isset($limit) && $limit > 0) {
            $newsletters = $query->take($limit)->get();
        }else{
            $newsletters = $query->get();
        }

        $formatted = $newsletters->map(function ($item) {
            return [
                'Email' => $item->email,
                'Subscribe At' => $item->created_at->format('d M Y h:i A'),
            ];
        });

        return (new FastExcel($formatted))->download(time() . '-file.xlsx');
    }

}
