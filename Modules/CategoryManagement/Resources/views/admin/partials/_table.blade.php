
<div class="table-responsive">
    <table id="example" class="table align-middle">
        <thead class="align-middle">
        <tr>
            <th>{{translate('SL')}}</th>
            <th>{{translate('category_name')}}</th>
            <th>{{translate('sub_category_count')}}</th>
            <th>{{translate('zone_count')}}</th>
            @can('category_manage_status')
                <th>{{translate('status')}}</th>
            @endcan
            @can('category_manage_status')
                <th>{{translate('Is_Featured')}}</th>
            @endcan
            @canany(['category_delete', 'category_update'])
                <th>{{translate('action')}}</th>
            @endcan
        </tr>
        </thead>
        <tbody>
        @forelse($categories as $key=>$category)
            <tr>
                <td>{{$categories->firstitem()+$key}}</td>
                <td>{{$category->name}}</td>
                <td>{{$category->children_count}}</td>
                <td class="d-flex">
                    <div>{{$category->zones_count}}</div>
                    @if($category->zones_count < 1)
                        <i class="material-icons" data-bs-toggle="tooltip"
                           data-bs-placement="top"
                           title="{{translate('This category is not under any zone. Kindly update the category with zone')}}">info
                        </i>
                    @endif
                </td>
                @can('category_manage_status')
                    <td>
                        <label class="switcher">
                            <input class="switcher_input status-update"
                                   type="checkbox"
                                   {{$category->is_active?'checked':''}} data-id="{{$category->id}}">
                            <span class="switcher_control"></span>
                        </label>
                    </td>
                @endcan
                @can('category_manage_status')
                    <td>
                        <label class="switcher">
                            <input class="switcher_input feature-update"
                                   type="checkbox"
                                   {{$category->is_featured?'checked':''}} data-featured="{{$category->id}}">
                            <span class="switcher_control"></span>
                        </label>
                    </td>
                @endcan
                @canany(['category_delete', 'category_update'])
                    <td>
                        <div class="d-flex gap-2">
                            @can('category_update')
                                <a href="{{route('admin.category.edit',[$category->id])}}"
                                   class="action-btn btn--light-primary demo_check"
                                   style="--size: 30px">
                                    <span class="material-icons">edit</span>
                                </a>
                            @endcan
                            @can('category_delete')
                                <button type="button"
                                        data-id="delete-{{$category->id}}"
                                        data-message="{{translate('want_to_delete_this_category')}}?"
                                        class="action-btn btn--danger {{ env('APP_ENV') != 'demo' ? 'form-alert' : 'demo_check' }}"
                                        style="--size: 30px">
                                                                    <span
                                                                        class="material-symbols-outlined">delete</span>
                                </button>
                                <form
                                    action="{{route('admin.category.delete',[$category->id])}}"
                                    method="post" id="delete-{{$category->id}}"
                                    class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endcan
                        </div>
                    </td>
                @endcan
            </tr>
        @empty
            <tr class="text-center">
                <td colspan="8">{{translate('no data available')}}</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        {!! $categories->links() !!}
    </div>
</div>
