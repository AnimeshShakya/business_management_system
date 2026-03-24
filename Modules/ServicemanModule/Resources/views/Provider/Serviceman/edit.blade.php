@extends('providermanagement::layouts.master')

@section('title',translate('Update_Serviceman'))

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="page-title-wrap mb-3">
                <h2 class="page-title">{{translate('update_serviceman')}}</h2>
            </div>

            <form action="{{route('provider.serviceman.update',[$serviceman->id])}}" method="post"
                    enctype="multipart/form-data">
                @method('put')
                @csrf

                <div class="card">
                    <div class="card-body">
                        <div class="row gx-xl-5">
                            <div class="col-md-6">
                                <h4 class="mb-20">{{translate('General_Information')}}</h4>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-floating form-floating__icon mb-30">
                                            <input type="text" class="form-control" name="first_name"
                                                    placeholder="{{translate('First_name')}}"
                                                    value="{{$serviceman->user->first_name}}" required>
                                            <label>{{translate('First_name')}}</label>
                                            <span class="material-icons">account_circle</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-floating form-floating__icon mb-30">
                                            <input type="text" class="form-control" name="last_name"
                                                    placeholder="{{translate('Last_name')}}"
                                                    value="{{$serviceman->user->last_name}}" required>
                                            <label>{{translate('Last_name')}}</label>
                                            <span class="material-icons">account_circle</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 mb-30">
                                    <div class="input-wrap form-floating">
                                        <label for="phone">{{translate('Phone_number')}}</label>
                                        <input type="tel" class="form-control"
                                               name="phone"
                                                placeholder="{{translate('Phone_number')}}"
                                                value="{{$serviceman->user->phone}}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex flex-column align-items-center gap-3 mb-30">
                                    <h3 class="mb-0">{{translate('Serviceman_image')}} (1:1)</h3>
                                    <div>
                                        <div class="upload-file">
                                            <input type="file" class="upload-file__input"
                                                   name="profile_image"
                                                   accept=".{{ implode(',.', array_column(IMAGEEXTENSION, 'key')) }}, |image/*"
                                                   data-maxFileSize="{{ readableUploadMaxFileSize('image') }}">
                                            <div class="upload-file__img">
                                                <img
                                                    src="{{$serviceman->user->profile_image_full_path}}"
                                                    alt="{{ translate('serviceman') }}">
                                            </div>
                                            <span class="upload-file__edit">
                                                <span class="material-icons">edit</span>
                                            </span>
                                        </div>
                                    </div>
                                    <p class="opacity-75 max-w220 mx-auto text-center">
                                        {{ translate('Image format')}} - {{ implode(', ', array_column(IMAGEEXTENSION, 'key')) }}
                                        {{ translate("Image Size") }} - {{ translate('maximum size') }} {{ readableUploadMaxFileSize('image') }}
                                        {{ translate('Image Ratio') }} - 1:1
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <div class="row gx-xl-5">
                            <div class="col-md-6">
                                <h4 class="mb-20">{{translate('Business_Information')}}</h4>

                                @php($id_types=['passport','driving_license','nid','trade_license'])
                                <select class="select-identity theme-input-style w-100 mb-30"
                                        name="identity_type" required>
                                    <option selected disabled>{{translate('Select_Identity_Type')}}</option>
                                    @foreach($id_types as $type)
                                        <option
                                            value="{{$type}}" {{$type==$serviceman->user->identification_type?'selected':''}}>{{translate($type)}}</option>
                                    @endforeach
                                </select>

                                <div class="form-floating form-floating__icon mb-30">
                                    <input type="text" class="form-control" name="identity_number"
                                            placeholder="{{translate('Identity Number')}}"
                                            value="{{$serviceman->user->identification_number}}" required>
                                    <label>{{translate('Identity_Number')}}</label>
                                    <span class="material-icons">badge</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column gap-3 mb-30">
                                    <h3 class="mb-0">{{translate('Identification_Image')}}</h3>
                                    <div id="multi_image_picker">
                                        @foreach($serviceman->user->identification_image_full_path as $img)
                                            <img src="{{ $img }}" alt="{{ translate('identity-image') }}">
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <h4 class="c1 mb-30">{{translate('Account_Information')}}</h4>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-floating form-floating__icon mb-30">
                                    <input type="email" class="form-control" name="email"
                                            placeholder="{{translate('Email_*')}}"
                                            value="{{$serviceman->user->email}}" required>
                                    <label>{{translate('Email_*')}}</label>
                                    <span class="material-icons">mail</span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating form-floating__icon mb-30">
                                    <input type="password" class="form-control" name="password"
                                            placeholder="{{translate('Password')}}">
                                    <label>{{translate('Password')}}</label>
                                    <span class="material-icons togglePassword">visibility_off</span>
                                    <span class="material-icons">lock</span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating form-floating__icon mb-30">
                                    <input type="password" class="form-control"
                                            name="confirm_password"
                                            placeholder="{{translate('Confirm_Password')}}">
                                    <label>{{translate('Confirm_Password')}}</label>
                                    <span class="material-icons togglePassword">visibility_off</span>
                                    <span class="material-icons">lock</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-4 flex-wrap justify-content-end mt-4">
                    <button type="reset" class="btn btn--secondary">{{translate('Reset')}}</button>
                    <button type="submit" class="btn btn--primary">{{translate('update')}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{asset('public/assets/provider-module/js/spartan-multi-image-picker.js')}}"></script>
    <script>
        "use strict";

        let maxSizeReadable = "{{ readableUploadMaxFileSize('image') }}"; // "2MB"
        let maxFileSize = 2 * 1024 * 1024; // default 2MB

        if (maxSizeReadable.toLowerCase().includes('mb')) {
            maxFileSize = parseFloat(maxSizeReadable) * 1024 * 1024;
        } else if (maxSizeReadable.toLowerCase().includes('kb')) {
            maxFileSize = parseFloat(maxSizeReadable) * 1024;
        }

        function setAcceptForAllInputs() {
            const allowedExtensions = ".{{ implode(',.', array_column(IMAGEEXTENSION, 'key')) }},"

            $('#multi_image_picker input[type=file]').each(function() {
                $(this).attr('accept', allowedExtensions);
            });
        }

        setAcceptForAllInputs();

        $("#multi_image_picker").spartanMultiImagePicker({
                fieldName: 'identity_image[]',
                maxCount: 2,
                rowHeight: 'auto',
                maxFileSize: maxFileSize,
                allowedExt: 'png|jpg|jpeg|webp|gif',
                groupClassName: 'multi_image_picker_item',
                dropFileLabel: "{{translate('Drop_here')}}",
                placeholderImage: {
                    image: '{{asset('public/assets/provider-module')}}/img/media/identity-img.png',
                    width: '100%',
                },

                onAddRow() {
                    setAcceptForAllInputs()
                },
                onRenderedPreview: function (index) {
                    toastr.success('{{translate('Image_added')}}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                },
                onRemoveRow: function (index) {
                    console.log(index);
                },
                onExtensionErr: function (index, file) {
                    toastr.error('{{ translate("Please only input png|jpg|jpeg|gif|webp type file") }}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                },
                onSizeErr: function () {
                    toastr.error('File size must be less than ' + maxSizeReadable);
                }
            }
        );
    </script>
@endpush
