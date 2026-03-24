@extends('adminmodule::layouts.new-master')

@section('title',translate('dashboard'))
<link rel="stylesheet" href="{{asset('public/assets/admin-module')}}/plugins/highlight/highlight.css"/>
<link rel="stylesheet" href="{{asset('public/assets/admin-module')}}/plugins/highlight/component-snippets.css"/>

@section('content')
   
    <div class="main-content">
        <div class="container-fluid">
            <div class="mb-5">
                @include('adminmodule::layouts.partials.components.images')
            </div>
            <div class="card p-20 mb-4">
            <div class="row g-4">
                <!-- DropDown -->
                 <div class="col-md-12"><h2 class="mb-2 text-primary text-uppercase border-bottom pb-3">DropDown</h2></div>
                <div class="col-md-6">
                    <h2 class="text-primary text-uppercase fz-16 mb-2">Normal</h2>
                    <div class="component-snippets-container position-relative card">
                        <div class="component-snippets-preview">
                            <div id="liveAlertPlaceholder">
                                <div></div>
                            </div>
                            <select class="form-control" name="">
                                <option value="1">Items 01</option>
                                <option value="2">Items 02</option>
                                <option value="3">Items 03</option>
                                <option value="4">Items 04</option>
                                <option value="5">Items 05</option>
                            </select>
                        </div>
                        <div class="position-relative snippets-code-hover">
                            <div class="component-snippets-code-header">
                                <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                    <i class="fi fi-rr-copy"></i> 
                                </button>
                            </div>
                            <div class="code-preview max-w-100">
                                <div class="component-snippets-code-container">
                                    <pre>
                                        <code class="">
                                            <select class="form-control" name="">
    <option value="1">Items 01</option>
    <option value="2">Items 02</option>
    <option value="3">Items 03</option>
    <option value="4">Items 04</option>
    <option value="5">Items 05</option>
</select>
                                        </code>
                                    </pre>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- DropDown end -->


                <!-- DropDown -->
                <div class="col-md-6">
                    <h2 class="text-primary text-uppercase fz-16 mb-2">Normal > With Icon</h2>
                    <div class="component-snippets-container position-relative card">
                        <div class="component-snippets-preview">
                            <div id="liveAlertPlaceholder">
                                <div></div>
                            </div>
                            <select class="form-select" name="" aria-label="Default select example">
                                <option value="1">Items 01</option>
                                <option value="2">Items 02</option>
                                <option value="3">Items 03</option>
                                <option value="4">Items 04</option>
                                <option value="5">Items 05</option>
                            </select>
                        </div>
                        <div class="position-relative snippets-code-hover">
                            <div class="component-snippets-code-header">
                                <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                    <i class="fi fi-rr-copy"></i> 
                                </button>
                            </div>
                            <div class="code-preview max-w-100">
                                <div class="component-snippets-code-container">
                                    <pre>
                                        <code class="">
                                            <select class="form-select" name="" aria-label="Default select example">
        <option value="1">Items 01</option>
        <option value="2">Items 02</option>
        <option value="3">Items 03</option>
        <option value="4">Items 04</option>
        <option value="5">Items 05</option>
    </select>
                                        </code>
                                    </pre>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- DropDown end -->


                <!-- DropDown -->
                <div class="col-md-6">
                    <h2 class="text-primary text-uppercase fz-16 mb-2">Select</h2>
                    <div class="component-snippets-container position-relative card">
                        <div class="component-snippets-preview">
                            <div id="liveAlertPlaceholder">
                                <div></div>
                            </div>
                            <div class="form-business">
                                <label class="mb-2 text-dark">{{translate('Country')}} <span class="text-danger">*</span></label>
                                <select class="js-select theme-input-style w-100"
                                        name="country_code">
                                    <option value="0" selected
                                            disabled>{{translate('Select_Country')}}</option>
                                    @foreach(COUNTRIES as $country)
                                        <option value="1">Bangladesh</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="position-relative snippets-code-hover">
                            <div class="component-snippets-code-header">
                                <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                    <i class="fi fi-rr-copy"></i> 
                                </button>
                            </div>
                            <div class="code-preview max-w-100">
                                <div class="component-snippets-code-container">
                                    <pre>
                                        <code class="">
                                           <div class="form-business">
    <label class="mb-2 text-dark">{{translate('Country')}} <span class="text-danger">*</span></label>
    <select class="js-select theme-input-style w-100"
            name="country_code">
        <option value="0" selected disabled>{{translate('Select_Country')}}</option>
        <option value="1">Bangladesh</option>
        <option value="2">Bangladesh</option>
        <option value="3">Bangladesh</option>
        <option value="4">Bangladesh</option>
        <option value="5">Bangladesh</option>
    </select>
</div>
                                        </code>
                                    </pre>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- DropDown end -->


               
            </div>
        </div>

            <!-- 02 Row  -->
            <div class="card p-20 mb-4">
                <div class="row g-4">
                    <div class="col-md-12"><h2 class="mb-2 text-primary text-uppercase border-bottom pb-3">Inputs</h2></div>
                    <!-- DropDown -->
                    <div class="col-md-6 col-xl-4">
                        <h2 class="text-primary text-uppercase fz-16 mb-2">Input Field</h2>
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                                <div class="form-business mb-3">
                                    <label class="mb-2 text-dark">{{translate('email')}} <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="" placeholder="{{translate('Type your email')}} *" required="" value="">
                                </div>
                                <div class="form-business disabled mb-3">
                                    <label class="mb-2 text-dark">{{translate('email')}} <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="" placeholder="{{translate('Type your email')}} *" required="" value="">
                                </div>
                                <div class="form-business mb-3">
                                    <label class="mb-2 text-dark">{{translate('email')}} <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control warning-border" name="" placeholder="{{translate('Type your email')}} *" required="" value="">
                                </div>
                                <div class="form-business mb-3">
                                    <label class="mb-2 text-dark">{{translate('email')}} <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control danger-border" name="" placeholder="{{translate('Type your email')}} *" required="" value="">
                                    <span class="fz-12 text-danger mt-1 d-block">User name doesn't match</span>
                                </div>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<div class="form-business">
    <label class="mb-2 text-dark">{{translate('email')}} <span class="text-danger">*</span></label>
    <input type="email" class="form-control" name="" placeholder="{{translate('Type your email')}} *" required="" value="">
</div>
<div class="form-business">
    <label class="mb-2 text-dark">{{translate('email')}} <span class="text-danger">*</span></label>
    <input type="email" class="form-control" name="" placeholder="{{translate('Type your email')}} *" required="" value="">
</div>
<div class="form-business">
    <label class="mb-2 text-dark">{{translate('email')}} <span class="text-danger">*</span></label>
    <input type="email" class="form-control warning-border" name="" placeholder="{{translate('Type your email')}} *" required="" value="">
</div>
<div class="form-business">
    <label class="mb-2 text-dark">{{translate('email')}} <span class="text-danger">*</span></label>
    <input type="email" class="form-control danger-border" name="" placeholder="{{translate('Type your email')}} *" required="" value="">
    <span class="fz-12 text-danger mt-1 d-block">User name doesn't match</span>
</div>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                    <!-- DropDown -->
                    <div class="col-md-6 col-xl-4">
                        <h2 class="text-primary text-uppercase fz-16 mb-2">Input Field/Plain Text</h2>
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                                <div class="mb-3">
                                    <div class="mb-2 text-dark">{{translate('Example Text')}}
                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="{{translate('Example Text Here.........')}}"
                                        >info</i>
                                    </div>
                                    <input type="text" class="form-control" name="" placeholder="example......." required="">
                                </div>
                                <div class="mb-3 disabled">
                                    <div class="mb-2 text-dark">{{translate('Example Text')}}
                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="{{translate('Example Text Here.........')}}"
                                        >info</i>
                                    </div>
                                    <input type="text" class="form-control" name="" placeholder="example......." required="">
                                </div>
                                <div class="mb-3">
                                    <div class="mb-2 text-dark">{{translate('Example Text')}}
                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="{{translate('Example Text Here.........')}}"
                                        >info</i>
                                    </div>
                                    <input type="text" class="form-control warning-border" name="" placeholder="example......." required="">
                                </div>
                                <div class="mb-3">
                                    <div class="mb-2 text-dark">{{translate('Example Text')}}
                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="{{translate('Example Text Here.........')}}"
                                        >info</i>
                                    </div>
                                    <input type="text" class="form-control danger-border" name="" placeholder="example......." required="">
                                    <span class="fz-12 text-danger mt-1 d-block">User name doesn't match</span>
                                </div>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<div>
    <div class="mb-2 text-dark">{{translate('Example Text')}}
        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
            data-bs-placement="top"
            title="{{translate('Example Text Here.........')}}"
        >info</i>
    </div>
    <input type="text" class="form-control" name="" placeholder="example......." required="">
</div>
<div class="disabled">
    <div class="mb-2 text-dark">{{translate('Example Text')}}
        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
            data-bs-placement="top"
            title="{{translate('Example Text Here.........')}}"
        >info</i>
    </div>
    <input type="text" class="form-control" name="" placeholder="example......." required="">
</div>
<div>
    <div class="mb-2 text-dark">{{translate('Example Text')}}
        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
            data-bs-placement="top"
            title="{{translate('Example Text Here.........')}}"
        >info</i>
    </div>
    <input type="text" class="form-control warning-border" name="" placeholder="example......." required="">
</div>
<div>
    <div class="mb-2 text-dark">{{translate('Example Text')}}
        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
            data-bs-placement="top"
            title="{{translate('Example Text Here.........')}}"
        >info</i>
    </div>
    <input type="text" class="form-control danger-border" name="" placeholder="example......." required="">
    <span class="fz-12 text-danger mt-1 d-block">User name doesn't match</span>
</div>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                    <!-- Start -->
                    <div class="col-md-6 col-xl-4">
                        <h2 class="text-primary text-uppercase fz-16 mb-2">Input Field Switch/Inside</h2>
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center border rounded px-3 py-lg-3 py-2 mb-3">
                                    <h5 class="mb-0 fw-normal">{{translate('maintenance_mode')}}</h5>
                                    <label class="switcher ml-auto mb-0">
                                        <input type="checkbox" class="switcher_input">
                                        <span class="switcher_control"></span>
                                    </label>
                                </div>
                                <div class="d-flex justify-content-between align-items-center border rounded px-3 py-lg-3 py-2 mb-3 disabled">
                                    <h5 class="mb-0 fw-normal">{{translate('maintenance_mode')}}</h5>
                                    <label class="switcher ml-auto mb-0">
                                        <input type="checkbox" class="switcher_input">
                                        <span class="switcher_control"></span>
                                    </label>
                                </div>
                                <div class="d-flex justify-content-between align-items-center warning-border rounded px-3 py-lg-3 py-2 mb-3">
                                    <h5 class="mb-0 fw-normal">{{translate('maintenance_mode')}}</h5>
                                    <label class="switcher ml-auto mb-0">
                                        <input type="checkbox" class="switcher_input">
                                        <span class="switcher_control"></span>
                                    </label>
                                </div>
                                <div class="d-flex justify-content-between align-items-center danger-border rounded px-3 py-lg-3 py-2 mb-3 disabled">
                                    <h5 class="mb-0 fw-normal">{{translate('maintenance_mode')}}</h5>
                                    <label class="switcher ml-auto mb-0">
                                        <input type="checkbox" class="switcher_input">
                                        <span class="switcher_control"></span>
                                    </label>
                                    <span class="fz-12 text-danger mt-1 d-block">User name doesn't match</span>
                                </div>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<div class="d-flex justify-content-between align-items-center border rounded px-3 py-lg-3 py-2 mb-3">
        <h5 class="mb-0 fw-normal">{{translate('maintenance_mode')}}</h5>
        <label class="switcher ml-auto mb-0">
            <input type="checkbox" class="switcher_input">
            <span class="switcher_control"></span>
        </label>
    </div>
    <div class="d-flex justify-content-between align-items-center border rounded px-3 py-lg-3 py-2 mb-3 disabled">
        <h5 class="mb-0 fw-normal">{{translate('maintenance_mode')}}</h5>
        <label class="switcher ml-auto mb-0">
            <input type="checkbox" class="switcher_input">
            <span class="switcher_control"></span>
        </label>
    </div>
    <div class="d-flex justify-content-between align-items-center warning-border rounded px-3 py-lg-3 py-2 mb-3">
        <h5 class="mb-0 fw-normal">{{translate('maintenance_mode')}}</h5>
        <label class="switcher ml-auto mb-0">
            <input type="checkbox" class="switcher_input">
            <span class="switcher_control"></span>
        </label>
    </div>
    <div class="d-flex justify-content-between align-items-center danger-border rounded px-3 py-lg-3 py-2 mb-3 disabled">
        <h5 class="mb-0 fw-normal">{{translate('maintenance_mode')}}</h5>
        <label class="switcher ml-auto mb-0">
            <input type="checkbox" class="switcher_input">
            <span class="switcher_control"></span>
        </label>
    </div>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                    <!-- Start -->
                    <div class="col-md-6 col-xl-4">
                        <h2 class="text-primary text-uppercase fz-16 mb-2">Input Field Switch/OutInside</h2>
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                                <div class="form-business mb-3">
                                    <div class="d-flex justify-content-between gap-2 flex-wrap align-items-center mb-2">
                                        <label class="text-dark">Email <span class="text-danger">*</span></label>
                                        <label class="switcher ml-auto mb-0">
                                            <input type="checkbox" class="switcher_input">
                                            <span class="switcher_control"></span>
                                        </label>
                                    </div>
                                    <input type="email" class="form-control" name="" placeholder="Type your email *" required="" value="">
                                </div>
                                <div class="form-business mb-3 disabled">
                                    <div class="d-flex justify-content-between gap-2 flex-wrap align-items-center mb-2">
                                        <label class="text-dark">Email <span class="text-danger">*</span></label>
                                        <label class="switcher ml-auto mb-0">
                                            <input type="checkbox" class="switcher_input">
                                            <span class="switcher_control"></span>
                                        </label>
                                    </div>
                                    <input type="email" class="form-control" name="" placeholder="Type your email *" required="" value="">
                                </div>
                                <div class="form-business mb-3">
                                    <div class="d-flex justify-content-between gap-2 flex-wrap align-items-center mb-2">
                                        <label class="text-dark">Email <span class="text-danger">*</span></label>
                                        <label class="switcher ml-auto mb-0">
                                            <input type="checkbox" class="switcher_input">
                                            <span class="switcher_control"></span>
                                        </label>
                                    </div>
                                    <input type="email" class="form-control warning-border" name="" placeholder="Type your email *" required="" value="">
                                </div>
                                <div class="form-business mb-3">
                                    <div class="d-flex justify-content-between gap-2 flex-wrap align-items-center mb-2">
                                        <label class="text-dark">Email <span class="text-danger">*</span></label>
                                        <label class="switcher ml-auto mb-0">
                                            <input type="checkbox" class="switcher_input">
                                            <span class="switcher_control"></span>
                                        </label>
                                    </div>
                                    <input type="email" class="form-control danger-border" name="" placeholder="Type your email *" required="" value="">
                                    <span class="fz-12 text-danger mt-1 d-block">User name doesn't match</span>
                                </div>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<div class="form-business mb-3">
    <div class="d-flex justify-content-between gap-2 flex-wrap align-items-center mb-2">
        <label class="text-dark">Email <span class="text-danger">*</span></label>
        <label class="switcher ml-auto mb-0">
            <input type="checkbox" class="switcher_input">
            <span class="switcher_control"></span>
        </label>
    </div>
    <input type="email" class="form-control" name="" placeholder="Type your email *" required="" value="">
</div>
<div class="form-business mb-3 disabled">
    <div class="d-flex justify-content-between gap-2 flex-wrap align-items-center mb-2">
        <label class="text-dark">Email <span class="text-danger">*</span></label>
        <label class="switcher ml-auto mb-0">
            <input type="checkbox" class="switcher_input">
            <span class="switcher_control"></span>
        </label>
    </div>
    <input type="email" class="form-control" name="" placeholder="Type your email *" required="" value="">
</div>
<div class="form-business mb-3">
    <div class="d-flex justify-content-between gap-2 flex-wrap align-items-center mb-2">
        <label class="text-dark">Email <span class="text-danger">*</span></label>
        <label class="switcher ml-auto mb-0">
            <input type="checkbox" class="switcher_input">
            <span class="switcher_control"></span>
        </label>
    </div>
    <input type="email" class="form-control warning-border" name="" placeholder="Type your email *" required="" value="">
</div>
<div class="form-business mb-3">
    <div class="d-flex justify-content-between gap-2 flex-wrap align-items-center mb-2">
        <label class="text-dark">Email <span class="text-danger">*</span></label>
        <label class="switcher ml-auto mb-0">
            <input type="checkbox" class="switcher_input">
            <span class="switcher_control"></span>
        </label>
    </div>
    <input type="email" class="form-control danger-border" name="" placeholder="Type your email *" required="" value="">
    <span class="fz-12 text-danger mt-1 d-block">User name doesn't match</span>
</div>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                     <!-- Start -->
                    <div class="col-md-6 col-xl-4">
                        <h2 class="text-primary text-uppercase fz-16 mb-2">Input Field Switch/Tooltip</h2>
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                                <div class="form-business mb-3">
                                    <div class="d-flex justify-content-between gap-2 flex-wrap align-items-center mb-2">
                                        <div class="text-dark">{{translate('Example text')}}
                                            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="{{translate('Example text.....')}}"
                                            >info</i>
                                        </div>
                                        <label class="switcher ml-auto mb-0">
                                            <input type="checkbox" class="switcher_input">
                                            <span class="switcher_control"></span>
                                        </label>
                                    </div>
                                    <input type="email" class="form-control" name="" placeholder="Type your email *" required="" value="">
                                </div>
                                <div class="form-business mb-3 disabled">
                                    <div class="d-flex justify-content-between gap-2 flex-wrap align-items-center mb-2">
                                        <div class="text-dark">{{translate('Example text')}}
                                            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="{{translate('Example text.....')}}"
                                            >info</i>
                                        </div>
                                        <label class="switcher ml-auto mb-0">
                                            <input type="checkbox" class="switcher_input">
                                            <span class="switcher_control"></span>
                                        </label>
                                    </div>
                                    <input type="email" class="form-control" name="" placeholder="Type your email *" required="" value="">
                                </div>
                                <div class="form-business mb-3">
                                    <div class="d-flex justify-content-between gap-2 flex-wrap align-items-center mb-2">
                                        <div class="text-dark">{{translate('Example text')}}
                                            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="{{translate('Example text.....')}}"
                                            >info</i>
                                        </div>
                                        <label class="switcher ml-auto mb-0">
                                            <input type="checkbox" class="switcher_input">
                                            <span class="switcher_control"></span>
                                        </label>
                                    </div>
                                    <input type="email" class="form-control warning-border" name="" placeholder="Type your email *" required="" value="">
                                </div>
                                <div class="form-business mb-3">
                                    <div class="d-flex justify-content-between gap-2 flex-wrap align-items-center mb-2">
                                        <div class="text-dark">{{translate('Example text')}}
                                            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="{{translate('Example text.....')}}"
                                            >info</i>
                                        </div>
                                        <label class="switcher ml-auto mb-0">
                                            <input type="checkbox" class="switcher_input">
                                            <span class="switcher_control"></span>
                                        </label>
                                    </div>
                                    <input type="email" class="form-control danger-border" name="" placeholder="Type your email *" required="" value="">
                                    <span class="fz-12 text-danger mt-1 d-block">User name doesn't match</span>
                                </div>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<div class="form-business mb-3">
    <div class="d-flex justify-content-between gap-2 flex-wrap align-items-center mb-2">
        <div class="text-dark">{{translate('Example text')}}
            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                data-bs-placement="top"
                title="{{translate('Example text.....')}}"
            >info</i>
        </div>
        <label class="switcher ml-auto mb-0">
            <input type="checkbox" class="switcher_input">
            <span class="switcher_control"></span>
        </label>
    </div>
    <input type="email" class="form-control" name="" placeholder="Type your email *" required="" value="">
</div>
<div class="form-business mb-3 disabled">
    <div class="d-flex justify-content-between gap-2 flex-wrap align-items-center mb-2">
        <div class="text-dark">{{translate('Example text')}}
            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                data-bs-placement="top"
                title="{{translate('Example text.....')}}"
            >info</i>
        </div>
        <label class="switcher ml-auto mb-0">
            <input type="checkbox" class="switcher_input">
            <span class="switcher_control"></span>
        </label>
    </div>
    <input type="email" class="form-control" name="" placeholder="Type your email *" required="" value="">
</div>
<div class="form-business mb-3">
    <div class="d-flex justify-content-between gap-2 flex-wrap align-items-center mb-2">
        <div class="text-dark">{{translate('Example text')}}
            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                data-bs-placement="top"
                title="{{translate('Example text.....')}}"
            >info</i>
        </div>
        <label class="switcher ml-auto mb-0">
            <input type="checkbox" class="switcher_input">
            <span class="switcher_control"></span>
        </label>
    </div>
    <input type="email" class="form-control warning-border" name="" placeholder="Type your email *" required="" value="">
</div>
<div class="form-business mb-3">
    <div class="d-flex justify-content-between gap-2 flex-wrap align-items-center mb-2">
        <div class="text-dark">{{translate('Example text')}}
            <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                data-bs-placement="top"
                title="{{translate('Example text.....')}}"
            >info</i>
        </div>
        <label class="switcher ml-auto mb-0">
            <input type="checkbox" class="switcher_input">
            <span class="switcher_control"></span>
        </label>
    </div>
    <input type="email" class="form-control danger-border" name="" placeholder="Type your email *" required="" value="">
    <span class="fz-12 text-danger mt-1 d-block">User name doesn't match</span>
</div>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                     <!-- Start -->
                    <div class="col-md-6 col-xl-4">
                        <h2 class="text-primary text-uppercase fz-16 mb-2">Input/Textarea</h2>
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                                <div class="">
                                   <div class="mb-2 text-dark">{{translate('Copyright Text')}}
                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="{{translate('Write the statement to inform that this is protected by copyright law')}}"
                                        >info</i>
                                    </div>                                                        
                                    <textarea class="form-control" name="copyright_text" rows="1" placeholder="Type about the description" data-maxlength="100"></textarea>
                                    <div class="d-flex justify-content-end mt-1">
                                        <span class="text-light-gray letter-count fz-12">0/100</span>
                                    </div>
                                </div>
                                <div class="">
                                   <div class="mb-2 text-dark">{{translate('Copyright Text')}}
                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="{{translate('Write the statement to inform that this is protected by copyright law')}}"
                                        >info</i>
                                    </div>                                                        
                                    <textarea class="form-control warning-border" name="copyright_text" rows="1" placeholder="Type about the description" data-maxlength="100"></textarea>
                                    <div class="d-flex justify-content-end mt-1">
                                        <span class="text-light-gray letter-count fz-12">0/100</span>
                                    </div>
                                </div>
                                <div class="">
                                   <div class="mb-2 text-dark">{{translate('Copyright Text')}}
                                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="{{translate('Write the statement to inform that this is protected by copyright law')}}"
                                        >info</i>
                                    </div>                                                        
                                    <textarea class="form-control danger-border" name="copyright_text" rows="1" placeholder="Type about the description" data-maxlength="100"></textarea>
                                    <div class="d-flex justify-content-end mt-1">
                                        <span class="text-light-gray letter-count fz-12">0/100</span>
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<div class="">
    <div class="mb-2 text-dark">{{translate('Copyright Text')}}
        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
            data-bs-placement="top"
            title="{{translate('Write the statement to inform that this is protected by copyright law')}}"
        >info</i>
    </div>                                                        
    <textarea class="form-control" name="copyright_text" rows="1" placeholder="Type about the description" data-maxlength="100"></textarea>
    <div class="d-flex justify-content-end mt-1">
        <span class="text-light-gray letter-count fz-12">0/100</span>
    </div>
</div>
<div class="">
    <div class="mb-2 text-dark">{{translate('Copyright Text')}}
        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
            data-bs-placement="top"
            title="{{translate('Write the statement to inform that this is protected by copyright law')}}"
        >info</i>
    </div>                                                        
    <textarea class="form-control warning-border" name="copyright_text" rows="1" placeholder="Type about the description" data-maxlength="100"></textarea>
    <div class="d-flex justify-content-end mt-1">
        <span class="text-light-gray letter-count fz-12">0/100</span>
    </div>
</div>
<div class="">
    <div class="mb-2 text-dark">{{translate('Copyright Text')}}
        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
            data-bs-placement="top"
            title="{{translate('Write the statement to inform that this is protected by copyright law')}}"
        >info</i>
    </div>                                                        
    <textarea class="form-control danger-border" name="copyright_text" rows="1" placeholder="Type about the description" data-maxlength="100"></textarea>
    <div class="d-flex justify-content-end mt-1">
        <span class="text-light-gray letter-count fz-12">0/100</span>
    </div>
</div>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->

                    <!-- Start -->
                    <div class="col-md-6 col-xl-4">
                        <h2 class="text-primary text-uppercase fz-16 mb-2">Country Code</h2>
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                                <div class="country-select-whitebg only-country-picker">
                                    <div class="mb-2 text-dark d-flex align-items-center gap-1">
                                        {{translate('Country code')}}
                                    </div>
                                    <input type="tel" class="form-control phone-input-with-country-picker only-input-with-country-picker" />
                                    <div class="">
                                        <input type="hidden" class="country-picker-phone-number only-picker-countrylabel" />
                                    </div>
                                </div>
                                <div class="country-select-whitebg only-country-picker disabled mb-3">
                                    <div class="mb-2 text-dark d-flex align-items-center gap-1">
                                        {{translate('Country code')}}
                                    </div>
                                    <input type="tel" class="form-control phone-input-with-country-picker only-input-with-country-picker2" />
                                    <div class="">
                                        <input type="hidden" class="country-picker-phone-number only-picker-countrylabel2" />
                                    </div>
                                </div>
                                <div class="country-select-whitebg only-country-picker mb-3">
                                    <div class="mb-2 text-dark d-flex align-items-center gap-1">
                                        {{translate('Country code')}}
                                    </div>
                                    <input type="tel" class="form-control warning-border phone-input-with-country-picker only-input-with-country-picker3" />
                                    <div class="">
                                        <input type="hidden" class="country-picker-phone-number only-picker-countrylabel3" />
                                    </div>
                                </div>
                                <div class="country-select-whitebg only-country-picker">
                                    <div class="mb-2 text-dark d-flex align-items-center gap-1">
                                        {{translate('Country code')}}
                                    </div>
                                    <input type="tel" class="form-control danger-border phone-input-with-country-picker only-input-with-country-picker4" />
                                    <div class="">
                                        <input type="hidden" class="country-picker-phone-number only-picker-countrylabel4" />
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<div class="country-select-whitebg only-country-picker">
    <div class="mb-2 text-dark d-flex align-items-center gap-1">
        {{translate('Country code')}}
    </div>
    <input type="tel" class="form-control phone-input-with-country-picker only-input-with-country-picker" />
    <div class="">
        <input type="hidden" class="country-picker-phone-number only-picker-countrylabel" />
    </div>
</div>
<div class="country-select-whitebg only-country-picker disabled mb-3">
    <div class="mb-2 text-dark d-flex align-items-center gap-1">
        {{translate('Country code')}}
    </div>
    <input type="tel" class="form-control phone-input-with-country-picker only-input-with-country-picker2" />
    <div class="">
        <input type="hidden" class="country-picker-phone-number only-picker-countrylabel2" />
    </div>
</div>
<div class="country-select-whitebg only-country-picker mb-3">
    <div class="mb-2 text-dark d-flex align-items-center gap-1">
        {{translate('Country code')}}
    </div>
    <input type="tel" class="form-control warning-border phone-input-with-country-picker only-input-with-country-picker3" />
    <div class="">
        <input type="hidden" class="country-picker-phone-number only-picker-countrylabel3" />
    </div>
</div>
<div class="country-select-whitebg only-country-picker">
    <div class="mb-2 text-dark d-flex align-items-center gap-1">
        {{translate('Country code')}}
    </div>
    <input type="tel" class="form-control danger-border phone-input-with-country-picker only-input-with-country-picker4" />
    <div class="">
        <input type="hidden" class="country-picker-phone-number only-picker-countrylabel4" />
    </div>
</div>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                     <!-- Start -->
                    <div class="col-md-6 col-xl-4">
                        <h2 class="text-primary text-uppercase fz-16 mb-2">Input/Selection & Type</h2>
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                                <div class="d-flex align-items-center restriction-time rounded border mb-sm-4 mb-3">
                                    <div class="flex-grow-1">
                                        <input class="form-control w-100 border-0" placeholder="Ex: 4" min="1" type="number" value="" name="" required>                                                                                                                                                                                                              
                                    </div>
                                    <select class="form-select min-w-92px w-auto bg-light border-0" name="">                                                                    
                                        <option value="0" selected disabled>{{translate('Select')}}</option>
                                        <option value="hour">{{translate('Hour')}}</option>
                                        <option value="day">{{translate('Days')}}</option>
                                    </select>
                                </div>
                                <div class="d-flex align-items-center restriction-time rounded border mb-sm-4 mb-3 disabled">
                                    <div class="flex-grow-1">
                                        <input class="form-control w-100 border-0" placeholder="Ex: 4" min="1" type="number" value="" name="" required>                                                                                                                                                                                                              
                                    </div>
                                    <select class="form-select min-w-92px w-auto bg-light border-0" name="">                                                                    
                                        <option value="0" selected disabled>{{translate('Select')}}</option>
                                        <option value="hour">{{translate('Hour')}}</option>
                                        <option value="day">{{translate('Days')}}</option>
                                    </select>
                                </div>
                                <div class="d-flex align-items-center restriction-time rounded warning-border mb-sm-4 mb-3">
                                    <div class="flex-grow-1">
                                        <input class="form-control w-100 border-0" placeholder="Ex: 4" min="1" type="number" value="" name="" required>                                                                                                                                                                                                              
                                    </div>
                                    <select class="form-select min-w-92px w-auto bg-light border-0" name="">                                                                    
                                        <option value="0" selected disabled>{{translate('Select')}}</option>
                                        <option value="hour">{{translate('Hour')}}</option>
                                        <option value="day">{{translate('Days')}}</option>
                                    </select>
                                </div>
                                <div class="d-flex align-items-center restriction-time rounded danger-border">
                                    <div class="flex-grow-1">
                                        <input class="form-control w-100 border-0" placeholder="Ex: 4" min="1" type="number" value="" name="" required>                                                                                                                                                                                                              
                                    </div>
                                    <select class="form-select min-w-92px w-auto bg-light border-0" name="">                                                                    
                                        <option value="0" selected disabled>{{translate('Select')}}</option>
                                        <option value="hour">{{translate('Hour')}}</option>
                                        <option value="day">{{translate('Days')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<div class="d-flex align-items-center restriction-time rounded border mb-sm-4 mb-3">
    <div class="flex-grow-1">
        <input class="form-control w-100 border-0" placeholder="Ex: 4" min="1" type="number" value="" name="" required>                                                                                                                                                                                                              
    </div>
    <select class="form-select min-w-92px w-auto bg-light border-0" name="">                                                                    
        <option value="0" selected disabled>{{translate('Select')}}</option>
        <option value="hour">{{translate('Hour')}}</option>
        <option value="day">{{translate('Days')}}</option>
    </select>
</div>
<div class="d-flex align-items-center restriction-time rounded border mb-sm-4 mb-3 disabled">
    <div class="flex-grow-1">
        <input class="form-control w-100 border-0" placeholder="Ex: 4" min="1" type="number" value="" name="" required>                                                                                                                                                                                                              
    </div>
    <select class="form-select min-w-92px w-auto bg-light border-0" name="">                                                                    
        <option value="0" selected disabled>{{translate('Select')}}</option>
        <option value="hour">{{translate('Hour')}}</option>
        <option value="day">{{translate('Days')}}</option>
    </select>
</div>
<div class="d-flex align-items-center restriction-time rounded warning-border mb-sm-4 mb-3">
    <div class="flex-grow-1">
        <input class="form-control w-100 border-0" placeholder="Ex: 4" min="1" type="number" value="" name="" required>                                                                                                                                                                                                              
    </div>
    <select class="form-select min-w-92px w-auto bg-light border-0" name="">                                                                    
        <option value="0" selected disabled>{{translate('Select')}}</option>
        <option value="hour">{{translate('Hour')}}</option>
        <option value="day">{{translate('Days')}}</option>
    </select>
</div>
<div class="d-flex align-items-center restriction-time rounded danger-border">
    <div class="flex-grow-1">
        <input class="form-control w-100 border-0" placeholder="Ex: 4" min="1" type="number" value="" name="" required>                                                                                                                                                                                                              
    </div>
    <select class="form-select min-w-92px w-auto bg-light border-0" name="">                                                                    
        <option value="0" selected disabled>{{translate('Select')}}</option>
        <option value="hour">{{translate('Hour')}}</option>
        <option value="day">{{translate('Days')}}</option>
    </select>
</div>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                    <!-- Start -->
                    <div class="col-md-6 col-xl-4">
                        <h2 class="text-primary text-uppercase fz-16 mb-2">Input Search</h2>
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                                <form action="#" class="search-form w-100 mb-0 search-form_style-two d-flex align-items-center gap-0 border rounded mb-3" method="GET">
                                    @csrf
                                    <div class="input-group search-form__input_group bg-transparent">
                                        <input type="search" class="theme-input-style search-form__input border-0  block-size-36" name="search"
                                               placeholder="{{translate('search_here')}}"
                                               value="{{ request()?->search ?? null }}">
                                    </div>
                                    <button type="submit" class="bg-light border-0 px-2 block-size-36 rounded-end d-flex align-items-center justify-content-center">
                                        <span class="material-symbols-outlined fz-20 opacity-75">
                                            search
                                        </span>
                                    </button>
                                </form>
                                <form action="#" class="search-form w-100 mb-0 search-form_style-two d-flex align-items-center gap-0 border rounded" method="GET">
                                    @csrf
                                    <div class="input-group search-form__input_group bg-transparent">
                                        <input type="search" class="theme-input-style search-form__input border-0  block-size-36" name="search"
                                               placeholder="{{translate('search_here')}}" value="">
                                    </div>
                                </form>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<form action="#" class="search-form w-100 mb-0 search-form_style-two d-flex align-items-center gap-0 border rounded" method="GET">
    @csrf
    <div class="input-group search-form__input_group bg-transparent">
        <input type="search" class="theme-input-style search-form__input border-0  block-size-36" name="search"
                placeholder="{{translate('search_here')}}"
                value="{{ request()?->search ?? null }}">
    </div>
    <button type="submit" class="bg-light border-0 px-2 block-size-36 rounded-end d-flex align-items-center justify-content-center">
        <span class="material-symbols-outlined fz-20 opacity-75">
            search
        </span>
    </button>
</form>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                    <!-- Start -->
                    <div class="col-md-6 col-xl-4">
                        <h2 class="text-primary text-uppercase fz-16 mb-2">Input Switch</h2>
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                               <div class="d-flex flex-wrap gap-sm-4 gap-3">
                                    <label class="switcher ml-auto mb-0">
                                        <input type="checkbox" class="switcher_input">
                                        <span class="switcher_control"></span>
                                    </label>
                                    <label class="switcher ml-auto mb-0 disabled">
                                        <input type="checkbox" class="switcher_input">
                                        <span class="switcher_control"></span>
                                    </label>
                                    <label class="switcher ml-auto mb-0">
                                        <input type="checkbox" class="switcher_input" checked>
                                        <span class="switcher_control"></span>
                                    </label>
                               </div>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<label class="switcher ml-auto mb-0">
    <input type="checkbox" class="switcher_input">
    <span class="switcher_control"></span>
</label>
<label class="switcher ml-auto mb-0 disabled">
    <input type="checkbox" class="switcher_input">
    <span class="switcher_control"></span>
</label>
<label class="switcher ml-auto mb-0">
    <input type="checkbox" class="switcher_input" checked>
    <span class="switcher_control"></span>
</label>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                    <!-- Start -->
                    <div class="col-md-6 col-xl-4">
                        <h2 class="text-primary text-uppercase fz-16 mb-2">Input Check Radio</h2>
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                               <div class="d-flex flex-wrap gap-sm-4 gap-3">
                                   <div class="custom-radio">
                                        <input type="radio" id="timeformate" name="partial_payment_combinator" value="cash_after_service">
                                        <label for="timeformate" class="fz-14 text-dark">12 Hours</label>
                                    </div>
                                    <div class="custom-radio">
                                        <input type="radio" id="timeformate24" name="partial_payment_combinator" value="cash_after_service">
                                        <label for="timeformate24" class="fz-14 text-dark">24 Hours</label>
                                    </div>
                               </div>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<div class="custom-radio">
    <input type="radio" id="timeformate" name="partial_payment_combinator" value="cash_after_service">
    <label for="timeformate" class="fz-14 text-dark">12 Hours</label>
</div>
<div class="custom-radio">
    <input type="radio" id="timeformate24" name="partial_payment_combinator" value="cash_after_service">
    <label for="timeformate24" class="fz-14 text-dark">24 Hours</label>
</div>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                    <!-- Start -->
                    <div class="col-md-6 col-xl-4">
                        <h2 class="text-primary text-uppercase fz-16 mb-2">Input Check Radio</h2>
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                               <div class="d-flex flex-wrap gap-sm-4 gap-3 pb-3">
                                   <div class="custom-radio">
                                        <input type="radio" id="name1" name="partial_payment_combinator" value="cash_after_service">
                                        <label for="name1" class="fz-14 text-dark"></label>
                                    </div>
                                    <div class="custom-radio">
                                        <input type="radio" id="name2" name="partial_payment_combinator" value="cash_after_service">
                                        <label for="name2" class="fz-14 text-dark"></label>
                                    </div>
                               </div>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<div class="custom-radio">
    <input type="radio" id="name1" name="partial_payment_combinator" value="cash_after_service">
    <label for="name1" class="fz-14 text-dark"></label>
</div>
<div class="custom-radio">
    <input type="radio" id="name2" name="partial_payment_combinator" value="cash_after_service">
    <label for="name2" class="fz-14 text-dark"></label>
</div>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->                    
                </div>
            </div>
            <!-- 03 Row  -->
           <div class="card p-20 mb-4">
               <div class="row g-4">
                   <div class="col-md-12"><h2 class="mb-2 text-primary text-uppercase border-bottom pb-3">Buttons</h2></div>
                   <!-- Start -->
                    <div class="col-md-6 col-xl-4">
                        <h2 class="text-primary text-uppercase fz-16 mb-2">Primary Button</h2>
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                               <div class="d-flex flex-wrap gap-sm-3 gap-3">  
                                    <button type="submit" class="btn btn--primary rounded">
                                        {{translate('update')}}
                                    </button>
                               </div>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<button type="submit" class="btn btn--primary rounded">
    {{translate('update')}}
</button>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                     <!-- Start -->
                    <div class="col-md-6 col-xl-4">
                        <h2 class="text-primary text-uppercase fz-16 mb-2">Primary Button disabled</h2>
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                               <div class="d-flex flex-wrap gap-sm-3 gap-3">  
                                    <button type="submit" class="btn btn--primary rounded" disabled>
                                        {{translate('update')}}
                                    </button>
                               </div>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<button type="submit" class="btn btn--primary rounded" disabled>
    {{translate('update')}}
</button>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                    <!-- Start -->
                    <div class="col-md-6 col-xl-4">
                        <h2 class="text-primary text-uppercase fz-16 mb-2">Primary With Icon</h2>
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                               <div class="d-flex flex-wrap gap-sm-3 gap-3">  
                                    <button type="submit" class="btn btn--primary d-flex align-items-center gap-2 rounded">
                                        <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_9562_1632)">
                                            <path d="M9.91732 0.5H4.08398V4H9.91732V0.5Z" fill="white"></path>
                                            <path d="M7.00065 9.83333C7.64498 9.83333 8.16732 9.311 8.16732 8.66667C8.16732 8.02233 7.64498 7.5 7.00065 7.5C6.35632 7.5 5.83398 8.02233 5.83398 8.66667C5.83398 9.311 6.35632 9.83333 7.00065 9.83333Z" fill="white"></path>
                                            <path d="M11.0833 0.5V5.16667H2.91667V0.5H1.75C1.28587 0.5 0.840752 0.684374 0.512563 1.01256C0.184374 1.34075 0 1.78587 0 2.25L0 14.5H14V3.41667L11.0833 0.5ZM7 11C6.53851 11 6.08738 10.8632 5.70367 10.6068C5.31995 10.3504 5.02088 9.98596 4.84428 9.55959C4.66768 9.13323 4.62147 8.66408 4.7115 8.21146C4.80153 7.75883 5.02376 7.34307 5.35008 7.01675C5.67641 6.69043 6.09217 6.4682 6.54479 6.37817C6.99741 6.28814 7.46657 6.33434 7.89293 6.51095C8.31929 6.68755 8.68371 6.98662 8.94009 7.37034C9.19649 7.75405 9.33333 8.20518 9.33333 8.66667C9.33333 9.28551 9.0875 9.879 8.64992 10.3166C8.21233 10.7542 7.61884 11 7 11Z" fill="white"></path>
                                            </g>
                                            <defs>
                                            <clipPath id="clip0_9562_1632">
                                            <rect width="14" height="14" fill="white" transform="translate(0 0.5)"></rect>
                                            </clipPath>
                                            </defs>
                                        </svg>
                                        Save Information
                                    </button>
                               </div>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<button type="submit" class="btn btn--primary d-flex align-items-center gap-2 rounded">
    <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g clip-path="url(#clip0_9562_1632)">
        <path d="M9.91732 0.5H4.08398V4H9.91732V0.5Z" fill="white"></path>
        <path d="M7.00065 9.83333C7.64498 9.83333 8.16732 9.311 8.16732 8.66667C8.16732 8.02233 7.64498 7.5 7.00065 7.5C6.35632 7.5 5.83398 8.02233 5.83398 8.66667C5.83398 9.311 6.35632 9.83333 7.00065 9.83333Z" fill="white"></path>
        <path d="M11.0833 0.5V5.16667H2.91667V0.5H1.75C1.28587 0.5 0.840752 0.684374 0.512563 1.01256C0.184374 1.34075 0 1.78587 0 2.25L0 14.5H14V3.41667L11.0833 0.5ZM7 11C6.53851 11 6.08738 10.8632 5.70367 10.6068C5.31995 10.3504 5.02088 9.98596 4.84428 9.55959C4.66768 9.13323 4.62147 8.66408 4.7115 8.21146C4.80153 7.75883 5.02376 7.34307 5.35008 7.01675C5.67641 6.69043 6.09217 6.4682 6.54479 6.37817C6.99741 6.28814 7.46657 6.33434 7.89293 6.51095C8.31929 6.68755 8.68371 6.98662 8.94009 7.37034C9.19649 7.75405 9.33333 8.20518 9.33333 8.66667C9.33333 9.28551 9.0875 9.879 8.64992 10.3166C8.21233 10.7542 7.61884 11 7 11Z" fill="white"></path>
        </g>
        <defs>
        <clipPath id="clip0_9562_1632">
        <rect width="14" height="14" fill="white" transform="translate(0 0.5)"></rect>
        </clipPath>
        </defs>
    </svg>
    Save Information
</button>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                    <!-- Start -->
                    <div class="col-md-6 col-xl-4">
                        <h2 class="text-primary text-uppercase fz-16 mb-2">Primary With Icon disabled</h2>
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                               <div class="d-flex flex-wrap gap-sm-3 gap-3">  
                                    <button type="submit" class="btn btn--primary d-flex align-items-center gap-2 rounded" disabled>
                                        <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_9562_1632)">
                                            <path d="M9.91732 0.5H4.08398V4H9.91732V0.5Z" fill="white"></path>
                                            <path d="M7.00065 9.83333C7.64498 9.83333 8.16732 9.311 8.16732 8.66667C8.16732 8.02233 7.64498 7.5 7.00065 7.5C6.35632 7.5 5.83398 8.02233 5.83398 8.66667C5.83398 9.311 6.35632 9.83333 7.00065 9.83333Z" fill="white"></path>
                                            <path d="M11.0833 0.5V5.16667H2.91667V0.5H1.75C1.28587 0.5 0.840752 0.684374 0.512563 1.01256C0.184374 1.34075 0 1.78587 0 2.25L0 14.5H14V3.41667L11.0833 0.5ZM7 11C6.53851 11 6.08738 10.8632 5.70367 10.6068C5.31995 10.3504 5.02088 9.98596 4.84428 9.55959C4.66768 9.13323 4.62147 8.66408 4.7115 8.21146C4.80153 7.75883 5.02376 7.34307 5.35008 7.01675C5.67641 6.69043 6.09217 6.4682 6.54479 6.37817C6.99741 6.28814 7.46657 6.33434 7.89293 6.51095C8.31929 6.68755 8.68371 6.98662 8.94009 7.37034C9.19649 7.75405 9.33333 8.20518 9.33333 8.66667C9.33333 9.28551 9.0875 9.879 8.64992 10.3166C8.21233 10.7542 7.61884 11 7 11Z" fill="white"></path>
                                            </g>
                                            <defs>
                                            <clipPath id="clip0_9562_1632">
                                            <rect width="14" height="14" fill="white" transform="translate(0 0.5)"></rect>
                                            </clipPath>
                                            </defs>
                                        </svg>
                                        Save Information
                                    </button>
                               </div>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<button type="submit" class="btn btn--primary d-flex align-items-center gap-2 rounded" disabled>
    <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g clip-path="url(#clip0_9562_1632)">
        <path d="M9.91732 0.5H4.08398V4H9.91732V0.5Z" fill="white"></path>
        <path d="M7.00065 9.83333C7.64498 9.83333 8.16732 9.311 8.16732 8.66667C8.16732 8.02233 7.64498 7.5 7.00065 7.5C6.35632 7.5 5.83398 8.02233 5.83398 8.66667C5.83398 9.311 6.35632 9.83333 7.00065 9.83333Z" fill="white"></path>
        <path d="M11.0833 0.5V5.16667H2.91667V0.5H1.75C1.28587 0.5 0.840752 0.684374 0.512563 1.01256C0.184374 1.34075 0 1.78587 0 2.25L0 14.5H14V3.41667L11.0833 0.5ZM7 11C6.53851 11 6.08738 10.8632 5.70367 10.6068C5.31995 10.3504 5.02088 9.98596 4.84428 9.55959C4.66768 9.13323 4.62147 8.66408 4.7115 8.21146C4.80153 7.75883 5.02376 7.34307 5.35008 7.01675C5.67641 6.69043 6.09217 6.4682 6.54479 6.37817C6.99741 6.28814 7.46657 6.33434 7.89293 6.51095C8.31929 6.68755 8.68371 6.98662 8.94009 7.37034C9.19649 7.75405 9.33333 8.20518 9.33333 8.66667C9.33333 9.28551 9.0875 9.879 8.64992 10.3166C8.21233 10.7542 7.61884 11 7 11Z" fill="white"></path>
        </g>
        <defs>
        <clipPath id="clip0_9562_1632">
        <rect width="14" height="14" fill="white" transform="translate(0 0.5)"></rect>
        </clipPath>
        </defs>
    </svg>
    Save Information
</button>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                    <!-- Start -->
                    <div class="col-md-6 col-xl-4">
                        <h2 class="text-primary text-uppercase fz-16 mb-2">Primary Outline Button</h2>
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                               <div class="d-flex flex-wrap gap-sm-3 gap-3">  
                                    <button type="submit" class="btn btn-outline-primary rounded">
                                        {{translate('update')}}
                                    </button>
                               </div>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<div class="d-flex flex-wrap gap-sm-3 gap-3">  
    <button type="submit" class="btn btn-outline-primary rounded">
        {{translate('update')}}
    </button>
</div>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                     <!-- Start -->
                    <div class="col-md-6 col-xl-4">
                        <h2 class="text-primary text-uppercase fz-16 mb-2">Primary Outline disabled</h2>
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                               <div class="d-flex flex-wrap gap-sm-3 gap-3">  
                                    <button type="submit" class="btn btn-outline-primary rounded disabled">
                                        {{translate('update')}}
                                    </button>
                               </div>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<div class="d-flex flex-wrap gap-sm-3 gap-3">  
    <button type="submit" class="btn btn-outline-primary rounded disabled">
        {{translate('update')}}
    </button>
</div>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                    <!-- Start -->
                    <div class="col-md-6 col-xl-4">
                        <h2 class="text-primary text-uppercase fz-16 mb-2">Secondary Button</h2>
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                               <div class="d-flex flex-wrap gap-sm-3 gap-3">  
                                    <button type="reset" class="btn btn--secondary rounded">
                                        Reset
                                    </button>
                               </div>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<button type="reset" class="btn btn--secondary rounded">
    Reset
</button>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                    <!-- Start -->
                    <div class="col-md-6 col-xl-4">
                        <h2 class="text-primary text-uppercase fz-16 mb-2">Secondary Outline Button</h2>
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                               <div class="d-flex flex-wrap gap-sm-3 gap-3">  
                                    <button type="reset" class="btn btn--secondary btn--outline-secondary rounded">
                                        Reset
                                    </button>
                               </div>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<button type="reset" class="btn btn--secondary btn--outline-secondary rounded">
    Reset
</button>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                     <!-- Start -->
                    <div class="col-md-6 col-xl-4">
                        <h2 class="text-primary text-uppercase fz-16 mb-2">Secondary Outline disabled</h2>
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                               <div class="d-flex flex-wrap gap-sm-3 gap-3">  
                                    <button type="reset" class="btn btn--secondary btn--outline-secondary rounded disabled">
                                        Reset
                                    </button>
                               </div>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<button type="reset" class="btn btn--secondary btn--outline-secondary rounded disabled">
    Reset
</button>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                    <!-- Start -->
                    <div class="col-md-6 col-xl-4">
                        <h2 class="text-primary text-uppercase fz-16 mb-2">Primary Outline witch icon</h2>
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                               <div class="d-flex flex-wrap gap-sm-3 gap-3">                                      
                                    <button type="button" class="rounded transition text-nowrap fz-12 fw-semibold btn-primary__outline btn d-flex align-items-center gap-1 py-2 px-3" data-bs-toggle="offcanvas" data-bs-target="#admin-landing-page">
                                        <span class="material-symbols-outlined">visibility</span> Section Preview
                                    </button>
                               </div>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<button type="button" class="rounded transition text-nowrap fz-12 fw-semibold btn-primary__outline btn d-flex align-items-center gap-1 py-2 px-3" data-bs-toggle="offcanvas" data-bs-target="#admin-landing-page">
    <span class="material-symbols-outlined">visibility</span> Section Preview
</button>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                    <!-- Start -->
                    <div class="col-md-6 col-xl-4">
                        <h2 class="text-primary text-uppercase fz-16 mb-2">Primary Outline witch icon Disabled</h2>
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                               <div class="d-flex flex-wrap gap-sm-3 gap-3">                                      
                                    <button type="button" class="rounded transition text-nowrap fz-12 fw-semibold btn-primary__outline btn d-flex align-items-center gap-1 py-2 px-3 disabled" data-bs-toggle="offcanvas" data-bs-target="#admin-landing-page">
                                        <span class="material-symbols-outlined">visibility</span> Section Preview
                                    </button>
                               </div>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<button type="button" class="rounded transition text-nowrap fz-12 fw-semibold btn-primary__outline btn d-flex align-items-center gap-1 py-2 px-3 disabled" data-bs-toggle="offcanvas" data-bs-target="#admin-landing-page">
    <span class="material-symbols-outlined">visibility</span> Section Preview
</button>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                     <!-- Start -->
                    <div class="col-md-6 col-xl-4">
                        <h2 class="text-primary text-uppercase fz-16 mb-2">System Addons</h2>
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                               <div class="d-flex flex-wrap gap-sm-3 gap-3">                                      
                                    <a href="#0" class="bg-warning rounded-full py-2 h-45 px-4 text-white fw-semibold d-inline-flex align-items-center gap-2">
                                        Check Addons
                                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_10223_7486)">
                                            <path d="M14.5 2.25V6.33333C14.5 6.65533 14.2392 6.91667 13.9167 6.91667C13.5941 6.91667 13.3333 6.65533 13.3333 6.33333V2.4915L6.45408 9.37075C6.34033 9.4845 6.191 9.54167 6.04167 9.54167C5.89233 9.54167 5.743 9.4845 5.62925 9.37075C5.40117 9.14267 5.40117 8.774 5.62925 8.54592L12.5085 1.66667H8.66667C8.34408 1.66667 8.08333 1.40533 8.08333 1.08333C8.08333 0.761333 8.34408 0.5 8.66667 0.5H12.75C13.7148 0.5 14.5 1.28517 14.5 2.25ZM13.9167 8.66667C13.5941 8.66667 13.3333 8.928 13.3333 9.25V11.5833C13.3333 12.5482 12.5482 13.3333 11.5833 13.3333H3.41667C2.45183 13.3333 1.66667 12.5482 1.66667 11.5833V3.41667C1.66667 2.45183 2.45183 1.66667 3.41667 1.66667H5.75C6.07258 1.66667 6.33333 1.40533 6.33333 1.08333C6.33333 0.761333 6.07258 0.5 5.75 0.5H3.41667C1.80842 0.5 0.5 1.80842 0.5 3.41667V11.5833C0.5 13.1916 1.80842 14.5 3.41667 14.5H11.5833C13.1916 14.5 14.5 13.1916 14.5 11.5833V9.25C14.5 8.928 14.2392 8.66667 13.9167 8.66667Z" fill="white"/>
                                            </g>
                                            <defs>
                                            <clipPath id="clip0_10223_7486">
                                            <rect width="14" height="14" fill="white" transform="translate(0.5 0.5)"/>
                                            </clipPath>
                                            </defs>
                                        </svg>
                                    </a>
                               </div>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<a href="#0" class="bg-warning rounded-full py-2 h-45 px-4 text-white fw-semibold d-inline-flex align-items-center gap-2">
    Check Addons
    <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g clip-path="url(#clip0_10223_7486)">
        <path d="M14.5 2.25V6.33333C14.5 6.65533 14.2392 6.91667 13.9167 6.91667C13.5941 6.91667 13.3333 6.65533 13.3333 6.33333V2.4915L6.45408 9.37075C6.34033 9.4845 6.191 9.54167 6.04167 9.54167C5.89233 9.54167 5.743 9.4845 5.62925 9.37075C5.40117 9.14267 5.40117 8.774 5.62925 8.54592L12.5085 1.66667H8.66667C8.34408 1.66667 8.08333 1.40533 8.08333 1.08333C8.08333 0.761333 8.34408 0.5 8.66667 0.5H12.75C13.7148 0.5 14.5 1.28517 14.5 2.25ZM13.9167 8.66667C13.5941 8.66667 13.3333 8.928 13.3333 9.25V11.5833C13.3333 12.5482 12.5482 13.3333 11.5833 13.3333H3.41667C2.45183 13.3333 1.66667 12.5482 1.66667 11.5833V3.41667C1.66667 2.45183 2.45183 1.66667 3.41667 1.66667H5.75C6.07258 1.66667 6.33333 1.40533 6.33333 1.08333C6.33333 0.761333 6.07258 0.5 5.75 0.5H3.41667C1.80842 0.5 0.5 1.80842 0.5 3.41667V11.5833C0.5 13.1916 1.80842 14.5 3.41667 14.5H11.5833C13.1916 14.5 14.5 13.1916 14.5 11.5833V9.25C14.5 8.928 14.2392 8.66667 13.9167 8.66667Z" fill="white"/>
        </g>
        <defs>
        <clipPath id="clip0_10223_7486">
        <rect width="14" height="14" fill="white" transform="translate(0.5 0.5)"/>
        </clipPath>
        </defs>
    </svg>
</a>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
               </div>
            </div>



            <!-- 04 Row  -->
            <div class="card p-20 mb-4">
                <div class="row g-4">
                    <div class="col-md-12">
                        <h2 class="mb-2 text-primary text-uppercase border-bottom pb-3">Icon Button</h2>
                    </div>
                     <!-- Start -->
                    <div class="col-md-12">
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                               <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <button class="btn btn--primary p-1 rounded w-30 h-30 d-center d-flex align-items-center gap-2 rounded">
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_9854_15822)">
                                            <path d="M4.57062 9.43163C4.43645 9.29746 4.31045 9.15046 4.1967 8.99529C4.00712 8.73512 4.06429 8.36996 4.32504 8.18037C4.5852 7.99079 4.94979 8.04796 5.13995 8.30812C5.2152 8.41196 5.29979 8.51171 5.39487 8.60621C5.86329 9.07463 6.4857 9.33246 7.14779 9.33246C7.80987 9.33246 8.43287 9.07463 8.9007 8.60621L12.109 5.39787C13.0756 4.43129 13.0756 2.85804 12.109 1.89146C11.1425 0.924875 9.5692 0.924875 8.60262 1.89146L7.98545 2.50862C7.75737 2.73671 7.3887 2.73671 7.16062 2.50862C6.93254 2.28054 6.93254 1.91187 7.16062 1.68379L7.77779 1.06662C9.19937 -0.355542 11.5123 -0.355542 12.9339 1.06662C14.3555 2.48821 14.3555 4.80112 12.9339 6.22271L9.72554 9.43104C9.0372 10.12 8.12137 10.4991 7.14779 10.4991C6.1742 10.4991 5.25837 10.12 4.57062 9.43163ZM3.64779 13.9991C4.62195 13.9991 5.5372 13.62 6.22554 12.931L6.8427 12.3139C7.07079 12.0864 7.07079 11.7171 6.8427 11.489C6.6152 11.261 6.24595 11.2615 6.01787 11.489L5.40012 12.1062C4.9317 12.5746 4.30929 12.8325 3.6472 12.8325C2.98512 12.8325 2.3627 12.5746 1.89429 12.1062C1.42587 11.6378 1.16804 11.0154 1.16804 10.3533C1.16804 9.69121 1.42587 9.06821 1.89429 8.60037L5.10262 5.39204C5.57104 4.92362 6.19345 4.66579 6.85554 4.66579C7.51762 4.66579 8.14062 4.92362 8.60845 5.39204C8.70179 5.48596 8.78695 5.58571 8.86279 5.68954C9.05179 5.95029 9.41637 6.00862 9.6777 5.81846C9.93845 5.62887 9.9962 5.26429 9.80662 5.00354C9.69579 4.85071 9.57037 4.70429 9.43387 4.56779C8.74495 3.87829 7.82912 3.49912 6.85554 3.49912C5.88195 3.49912 4.96612 3.87829 4.27779 4.56721L1.07004 7.77554C0.38112 8.46387 0.00195312 9.37971 0.00195312 10.3533C0.00195312 11.3269 0.38112 12.2427 1.07004 12.931C1.75837 13.62 2.67362 13.9991 3.64779 13.9991Z" fill="#fff"/>
                                            </g>
                                            <defs>
                                            <clipPath id="clip0_9854_15822">
                                            <rect width="14" height="14" fill="white"/>
                                            </clipPath>
                                            </defs>
                                        </svg>
                                    </button>
                                    <button type="button" class="action-btn btn--light-primary bg-white outline-primary-hover view-icon" title="View" data-bs-toggle="modal" data-bs-target="#imageShowingMOdal">
                                        <span class="material-icons">visibility</span>
                                    </button>
                                    <button type="button" class="action-btn btn--light-primary bg-white outline-primary-hover edit-icon" title="Edit">
                                        <span class="material-icons">edit</span>
                                    </button>
                                    <button type="button" class="action-btn btn--light-primary db-restore demo_check">
                                        <span class="material-icons">settings_backup_restore</span>
                                    </button>
                                    <div class="btn-group">
                                        <button type="button" class="action-btn rounded transition fw-bold text-nowrap fz-12 fw-semibold text-primary outline-primary-hover btn-primary btn-outline-primary d-flex align-items-center gap-1 py-2 px-1 d-center" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="material-symbols-outlined">more_vert </span>
                                        </button>
                                        <div class="dropdown-menu cus-shadow2 p-3 dropdown-menu-right">
                                            <button class="dropdown-item mb-1 d-flex align-items-center gap-2 fz-14 text-dark" type="button">
                                                <i class="material-symbols-outlined">schedule</i> Mark As Default
                                            </button>
                                            <button class="dropdown-item mb-1 d-flex align-items-center gap-2 fz-14 text-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#Edit__languageOffcanvas">
                                                <i class="material-symbols-outlined">edit_square</i> Edit
                                            </button>
                                            <button class="dropdown-item d-flex align-items-center gap-2 fz-14 text-dark" type="button">
                                                <i class="material-symbols-outlined">delete</i> Delete
                                            </button>
                                        </div>
                                    </div>
                                    <button type="button" class="action-btn btn--danger delete_section" data-bs-toggle="offcanvas" data-bs-target="#payment-setup-edit">
                                        <span class="material-icons">settings</span>
                                    </button>
                                    <button type="button" class="action-btn btn--success">
                                        <span class="material-icons">download</span>
                                    </button>
                                    <button type="button" class="action-btn btn--danger">
                                        <span class="material-symbols-outlined">delete</span>
                                    </button>
                                </div>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<div class="d-flex align-items-center gap-2 flex-wrap">
    <button class="btn btn--primary p-1 rounded w-30 h-30 d-center d-flex align-items-center gap-2 rounded">
        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_9854_15822)">
            <path d="M4.57062 9.43163C4.43645 9.29746 4.31045 9.15046 4.1967 8.99529C4.00712 8.73512 4.06429 8.36996 4.32504 8.18037C4.5852 7.99079 4.94979 8.04796 5.13995 8.30812C5.2152 8.41196 5.29979 8.51171 5.39487 8.60621C5.86329 9.07463 6.4857 9.33246 7.14779 9.33246C7.80987 9.33246 8.43287 9.07463 8.9007 8.60621L12.109 5.39787C13.0756 4.43129 13.0756 2.85804 12.109 1.89146C11.1425 0.924875 9.5692 0.924875 8.60262 1.89146L7.98545 2.50862C7.75737 2.73671 7.3887 2.73671 7.16062 2.50862C6.93254 2.28054 6.93254 1.91187 7.16062 1.68379L7.77779 1.06662C9.19937 -0.355542 11.5123 -0.355542 12.9339 1.06662C14.3555 2.48821 14.3555 4.80112 12.9339 6.22271L9.72554 9.43104C9.0372 10.12 8.12137 10.4991 7.14779 10.4991C6.1742 10.4991 5.25837 10.12 4.57062 9.43163ZM3.64779 13.9991C4.62195 13.9991 5.5372 13.62 6.22554 12.931L6.8427 12.3139C7.07079 12.0864 7.07079 11.7171 6.8427 11.489C6.6152 11.261 6.24595 11.2615 6.01787 11.489L5.40012 12.1062C4.9317 12.5746 4.30929 12.8325 3.6472 12.8325C2.98512 12.8325 2.3627 12.5746 1.89429 12.1062C1.42587 11.6378 1.16804 11.0154 1.16804 10.3533C1.16804 9.69121 1.42587 9.06821 1.89429 8.60037L5.10262 5.39204C5.57104 4.92362 6.19345 4.66579 6.85554 4.66579C7.51762 4.66579 8.14062 4.92362 8.60845 5.39204C8.70179 5.48596 8.78695 5.58571 8.86279 5.68954C9.05179 5.95029 9.41637 6.00862 9.6777 5.81846C9.93845 5.62887 9.9962 5.26429 9.80662 5.00354C9.69579 4.85071 9.57037 4.70429 9.43387 4.56779C8.74495 3.87829 7.82912 3.49912 6.85554 3.49912C5.88195 3.49912 4.96612 3.87829 4.27779 4.56721L1.07004 7.77554C0.38112 8.46387 0.00195312 9.37971 0.00195312 10.3533C0.00195312 11.3269 0.38112 12.2427 1.07004 12.931C1.75837 13.62 2.67362 13.9991 3.64779 13.9991Z" fill="#fff"/>
            </g>
            <defs>
            <clipPath id="clip0_9854_15822">
            <rect width="14" height="14" fill="white"/>
            </clipPath>
            </defs>
        </svg>
    </button>
    <button type="button" class="action-btn btn--light-primary bg-white outline-primary-hover view-icon" title="View" data-bs-toggle="modal" data-bs-target="#imageShowingMOdal">
        <span class="material-icons">visibility</span>
    </button>
    <button type="button" class="action-btn btn--light-primary bg-white outline-primary-hover edit-icon" title="Edit">
        <span class="material-icons">edit</span>
    </button>
        <button type="button" class="action-btn btn--light-primary db-restore demo_check">
        <span class="material-icons">settings_backup_restore</span>
    </button>
    <div class="btn-group">
        <button type="button" class="action-btn rounded transition fw-bold text-nowrap fz-12 fw-semibold text-primary outline-primary-hover btn-primary btn-outline-primary d-flex align-items-center gap-1 py-2 px-1 d-center" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="material-symbols-outlined">more_vert </span>
        </button>
        <div class="dropdown-menu cus-shadow2 p-3 dropdown-menu-right">
            <button class="dropdown-item mb-1 d-flex align-items-center gap-2 fz-14 text-dark" type="button">
                <i class="material-symbols-outlined">schedule</i> Mark As Default
            </button>
            <button class="dropdown-item mb-1 d-flex align-items-center gap-2 fz-14 text-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#Edit__languageOffcanvas">
                <i class="material-symbols-outlined">edit_square</i> Edit
            </button>
            <button class="dropdown-item d-flex align-items-center gap-2 fz-14 text-dark" type="button">
                <i class="material-symbols-outlined">delete</i> Delete
            </button>
        </div>
    </div>
    <button type="button" class="action-btn btn--danger delete_section" data-bs-toggle="offcanvas" data-bs-target="#payment-setup-edit">
        <span class="material-icons">settings</span>
    </button>
    <button type="button" class="action-btn btn--success">
        <span class="material-icons">download</span>
    </button>
    <button type="button" class="action-btn btn--danger">
        <span class="material-symbols-outlined">delete</span>
    </button>
</div>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <!-- Start -->
                <div class="col-md-6 col-xl-6 col-xxl-3">
                    <h2 class="text-primary text-uppercase fz-16 mb-2">Badge Large</h2>
                    <div class="component-snippets-container position-relative card">
                        <div class="component-snippets-preview">
                            <div id="liveAlertPlaceholder">
                                <div></div>
                            </div>
                            <div class="d-flex flex-wrap gap-sm-3 gap-3">                                      
                                <span class="badge badge-success badge-lg">Success</span>
                                <span class="badge badge-warning badge-lg">Warning</span>
                                <span class="badge badge-danger badge-lg">Danger</span>
                                <span class="badge badge-info badge-lg">Info</span>
                            </div>
                        </div>
                        <div class="position-relative snippets-code-hover">
                            <div class="component-snippets-code-header">
                                <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                    <i class="fi fi-rr-copy"></i> 
                                </button>
                            </div>
                            <div class="code-preview max-w-100">
                                <div class="component-snippets-code-container">
                                    <pre>
                                        <code class="">
<div class="d-flex flex-wrap gap-sm-3 gap-3">                                      
    <span class="badge badge-success badge-lg">Success</span>
    <span class="badge badge-warning badge-lg">Warning</span>
    <span class="badge badge-danger badge-lg">Danger</span>
    <span class="badge badge-info badge-lg">Info</span>
</div>
                                        </code>
                                    </pre>
                                </div>
                            </div>
                        </div>
                    </div>            
                </div>
                <!-- End -->
                <!-- Start -->
                <div class="col-md-6 col-xl-6 col-xxl-3">
                    <h2 class="text-primary text-uppercase fz-16 mb-2">Badge Medium</h2>
                    <div class="component-snippets-container position-relative card">
                        <div class="component-snippets-preview">
                            <div id="liveAlertPlaceholder">
                                <div></div>
                            </div>
                            <div class="d-flex flex-wrap gap-sm-3 gap-3">                                      
                                <span class="badge badge-success">Success</span>
                                <span class="badge badge-warning">Warning</span>
                                <span class="badge badge-danger">Danger</span>
                                <span class="badge badge-info">Info</span>
                            </div>
                        </div>
                        <div class="position-relative snippets-code-hover">
                            <div class="component-snippets-code-header">
                                <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                    <i class="fi fi-rr-copy"></i> 
                                </button>
                            </div>
                            <div class="code-preview max-w-100">
                                <div class="component-snippets-code-container">
                                    <pre>
                                        <code class="">
<div class="d-flex flex-wrap gap-sm-3 gap-3">                                      
    <span class="badge badge-success">Success</span>
    <span class="badge badge-warning">Warning</span>
    <span class="badge badge-danger">Danger</span>
    <span class="badge badge-info">Info</span>
</div>
                                        </code>
                                    </pre>
                                </div>
                            </div>
                        </div>
                    </div>            
                </div>
                <!-- End -->
                <!-- Start -->
                <div class="col-md-6 col-xl-6 col-xxl-3">
                    <h2 class="text-primary text-uppercase fz-16 mb-2">Badge Small</h2>
                    <div class="component-snippets-container position-relative card">
                        <div class="component-snippets-preview">
                            <div id="liveAlertPlaceholder">
                                <div></div>
                            </div>
                            <div class="d-flex flex-wrap gap-sm-3 gap-3">                                      
                                <span class="badge badge-success badge-sm">Success</span>
                                <span class="badge badge-warning badge-sm">Warning</span>
                                <span class="badge badge-danger badge-sm">Danger</span>
                                <span class="badge badge-info badge-sm">Info</span>
                            </div>
                        </div>
                        <div class="position-relative snippets-code-hover">
                            <div class="component-snippets-code-header">
                                <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                    <i class="fi fi-rr-copy"></i> 
                                </button>
                            </div>
                            <div class="code-preview max-w-100">
                                <div class="component-snippets-code-container">
                                    <pre>
                                        <code class="">
<div class="d-flex flex-wrap gap-sm-3 gap-3">                                      
    <span class="badge badge-success badge-sm">Success</span>
    <span class="badge badge-warning badge-sm">Warning</span>
    <span class="badge badge-danger badge-sm">Danger</span>
    <span class="badge badge-info badge-sm">Info</span>
</div>
                                        </code>
                                    </pre>
                                </div>
                            </div>
                        </div>
                    </div>            
                </div>
                <!-- End -->
                <!-- Start -->
                <div class="col-md-6 col-xl-6 col-xxl-3">
                    <h2 class="text-primary text-uppercase fz-16 mb-2">Small (without background)
</h2>
                    <div class="component-snippets-container position-relative card">
                        <div class="component-snippets-preview">
                            <div id="liveAlertPlaceholder">
                                <div></div>
                            </div>
                            <div class="d-flex flex-wrap gap-sm-3 gap-3">                                      
                                <span class="text-success">Success</span>
                                <span class="text-warning">Warning</span>
                                <span class="text-danger">Danger</span>
                                <span class="text-info">Info</span>
                            </div>
                        </div>
                        <div class="position-relative snippets-code-hover">
                            <div class="component-snippets-code-header">
                                <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                    <i class="fi fi-rr-copy"></i> 
                                </button>
                            </div>
                            <div class="code-preview max-w-100">
                                <div class="component-snippets-code-container">
                                    <pre>
                                        <code class="">
<div class="d-flex flex-wrap gap-sm-3 gap-3">                                      
    <span class="text-success">Success</span>
    <span class="text-warning">Warning</span>
    <span class="text-danger">Danger</span>
    <span class="text-info">Info</span>
</div>
                                        </code>
                                    </pre>
                                </div>
                            </div>
                        </div>
                    </div>            
                </div>
                <!-- End -->
                <!-- Start -->
                <div class="col-lg-6 col-xl-6">
                    <h2 class="text-primary text-uppercase fz-16 mb-2">
                        Tab Menu
                    </h2>
                    <div class="component-snippets-container position-relative card">
                        <div class="component-snippets-preview">
                            <div id="liveAlertPlaceholder">
                                <div></div>
                            </div>
                            <div class="nav-tabs-responsive position-relative">
                                <ul class="nav nav--tabs scrollbar-w flex-nowrap white-nowrap overflow-x-auto flex-wrap-nowrap nav--tabs__style2">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link active" id="payment-custom-tab1" data-bs-toggle="tab" data-bs-target="#payment-tabs1" type="button" role="tab" aria-controls="payment-tabs1" aria-selected="false">
                                            {{translate('Digital Payment')}}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" id="payment-custom-tab2" data-bs-toggle="tab" data-bs-target="#payment-tabs2" type="button" role="tab" aria-controls="payment-tabs2" aria-selected="false">
                                            {{translate('Offline Payment')}}
                                        </a>
                                    </li> 
                                </ul>
                                <div class="nav--tab__prev position-absolute top-0 start-3">
                                    <button class="border-0 w-38 h-38 d-flex align-items-center justify-content-center rounded-full p-0 bg-white text-primary">
                                        <span class="material-symbols-outlined">
                                            arrow_back_ios
                                        </span>
                                    </button>
                                </div>
                                <div class="nav--tab__next position-absolute top-0 right-3">
                                    <button class="border-0 w-38 h-38 d-flex align-items-center justify-content-center rounded-full p-0 bg-white text-primary">
                                        <span class="material-symbols-outlined">
                                            arrow_forward_ios
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="position-relative snippets-code-hover">
                            <div class="component-snippets-code-header">
                                <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                    <i class="fi fi-rr-copy"></i> 
                                </button>
                            </div>
                            <div class="code-preview max-w-100">
                                <div class="component-snippets-code-container">
                                    <pre>
                                        <code class="">
<div class="nav-tabs-responsive position-relative">
    <ul class="nav nav--tabs scrollbar-w flex-nowrap white-nowrap overflow-x-auto flex-wrap-nowrap nav--tabs__style2">
        <li class="nav-item">
            <a href="#" class="nav-link active" id="payment-custom-tab1" data-bs-toggle="tab" data-bs-target="#payment-tabs1" type="button" role="tab" aria-controls="payment-tabs1" aria-selected="false">
                {{translate('Digital Payment')}}
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link" id="payment-custom-tab2" data-bs-toggle="tab" data-bs-target="#payment-tabs2" type="button" role="tab" aria-controls="payment-tabs2" aria-selected="false">
                {{translate('Offline Payment')}}
            </a>
        </li> 
    </ul>
    <div class="nav--tab__prev position-absolute top-0 start-3">
        <button class="border-0 w-38 h-38 d-flex align-items-center justify-content-center rounded-full p-0 bg-white text-primary">
            <span class="material-symbols-outlined">
                arrow_back_ios
            </span>
        </button>
    </div>
    <div class="nav--tab__next position-absolute top-0 right-3">
        <button class="border-0 w-38 h-38 d-flex align-items-center justify-content-center rounded-full p-0 bg-white text-primary">
            <span class="material-symbols-outlined">
                arrow_forward_ios
            </span>
        </button>
    </div>
</div>
                                        </code>
                                    </pre>
                                </div>
                            </div>
                        </div>
                    </div>            
                </div>
                <!-- End -->
                <!-- Start -->
                <div class="col-lg-6 col-xl-6">
                    <h2 class="text-primary text-uppercase fz-16 mb-2">
                        Tab Menu With Arrow
                    </h2>
                    <div class="component-snippets-container position-relative card">
                        <div class="component-snippets-preview">
                            <div id="liveAlertPlaceholder">
                                <div></div>
                            </div>
                            <div class="nav-tabs-responsive position-relative">
                                <ul class="nav nav--tabs scrollbar-w flex-nowrap white-nowrap overflow-x-auto flex-wrap-nowrap nav--tabs__style2">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link active" id="payment-custom-tab1" data-bs-toggle="tab" data-bs-target="#payment-tabs1" type="button" role="tab" aria-controls="payment-tabs1" aria-selected="false">
                                            {{translate('Digital Payment')}}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" id="payment-custom-tab2" data-bs-toggle="tab" data-bs-target="#payment-tabs2" type="button" role="tab" aria-controls="payment-tabs2" aria-selected="false">
                                            {{translate('Offline Payment')}}
                                        </a>
                                    </li> 
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" id="payment-custom-tab3" data-bs-toggle="tab" data-bs-target="#payment-tabs3" type="button" role="tab" aria-controls="payment-tabs3" aria-selected="false">
                                            {{translate('Example 03')}}
                                        </a>
                                    </li> 
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" id="payment-custom-tab4" data-bs-toggle="tab" data-bs-target="#payment-tabs4" type="button" role="tab" aria-controls="payment-tabs4" aria-selected="false">
                                            {{translate('Example 04')}}
                                        </a>
                                    </li> 
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" id="payment-custom-tab5" data-bs-toggle="tab" data-bs-target="#payment-tabs5" type="button" role="tab" aria-controls="payment-tabs5" aria-selected="false">
                                            {{translate('Example 05')}}
                                        </a>
                                    </li> 
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" id="payment-custom-tab6" data-bs-toggle="tab" data-bs-target="#payment-tabs6" type="button" role="tab" aria-controls="payment-tabs6" aria-selected="false">
                                            {{translate('Example 06')}}
                                        </a>
                                    </li> 
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" id="payment-custom-tab7" data-bs-toggle="tab" data-bs-target="#payment-tabs7" type="button" role="tab" aria-controls="payment-tabs7" aria-selected="false">
                                            {{translate('Example 07')}}
                                        </a>
                                    </li> 
                                </ul>
                                <div class="nav--tab__prev position-absolute top-0 start-3">
                                    <button class="border-0 w-38 h-38 d-flex align-items-center justify-content-center rounded-full p-0 bg-white text-primary shadow-lg">
                                        <span class="material-symbols-outlined">
                                            arrow_back_ios
                                        </span>
                                    </button>
                                </div>
                                <div class="nav--tab__next position-absolute top-0 right-3">
                                    <button class="border-0 w-38 h-38 d-flex align-items-center justify-content-center rounded-full p-0 bg-white text-primary shadow-lg">
                                        <span class="material-symbols-outlined">
                                            arrow_forward_ios
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="position-relative snippets-code-hover">
                            <div class="component-snippets-code-header">
                                <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                    <i class="fi fi-rr-copy"></i> 
                                </button>
                            </div>
                            <div class="code-preview max-w-100">
                                <div class="component-snippets-code-container">
                                    <pre>
                                        <code class="">
<div class="nav-tabs-responsive position-relative">
    <ul class="nav nav--tabs scrollbar-w flex-nowrap white-nowrap overflow-x-auto flex-wrap-nowrap nav--tabs__style2">
        <li class="nav-item">
            <a href="#" class="nav-link active" id="payment-custom-tab1" data-bs-toggle="tab" data-bs-target="#payment-tabs1" type="button" role="tab" aria-controls="payment-tabs1" aria-selected="false">
                {{translate('Digital Payment')}}
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link" id="payment-custom-tab2" data-bs-toggle="tab" data-bs-target="#payment-tabs2" type="button" role="tab" aria-controls="payment-tabs2" aria-selected="false">
                {{translate('Offline Payment')}}
            </a>
        </li> 
        <li class="nav-item">
            <a href="#" class="nav-link" id="payment-custom-tab3" data-bs-toggle="tab" data-bs-target="#payment-tabs3" type="button" role="tab" aria-controls="payment-tabs3" aria-selected="false">
                {{translate('Example 03')}}
            </a>
        </li> 
        <li class="nav-item">
            <a href="#" class="nav-link" id="payment-custom-tab4" data-bs-toggle="tab" data-bs-target="#payment-tabs4" type="button" role="tab" aria-controls="payment-tabs4" aria-selected="false">
                {{translate('Example 04')}}
            </a>
        </li> 
        <li class="nav-item">
            <a href="#" class="nav-link" id="payment-custom-tab5" data-bs-toggle="tab" data-bs-target="#payment-tabs5" type="button" role="tab" aria-controls="payment-tabs5" aria-selected="false">
                {{translate('Example 05')}}
            </a>
        </li> 
        <li class="nav-item">
            <a href="#" class="nav-link" id="payment-custom-tab6" data-bs-toggle="tab" data-bs-target="#payment-tabs6" type="button" role="tab" aria-controls="payment-tabs6" aria-selected="false">
                {{translate('Example 06')}}
            </a>
        </li> 
        <li class="nav-item">
            <a href="#" class="nav-link" id="payment-custom-tab7" data-bs-toggle="tab" data-bs-target="#payment-tabs7" type="button" role="tab" aria-controls="payment-tabs7" aria-selected="false">
                {{translate('Example 07')}}
            </a>
        </li> 
    </ul>
    <div class="nav--tab__prev position-absolute top-0 start-3">
        <button class="border-0 w-38 h-38 d-flex align-items-center justify-content-center rounded-full p-0 bg-white text-primary shadow-lg">
            <span class="material-symbols-outlined">
                arrow_back_ios
            </span>
        </button>
    </div>
    <div class="nav--tab__next position-absolute top-0 right-3">
        <button class="border-0 w-38 h-38 d-flex align-items-center justify-content-center rounded-full p-0 bg-white text-primary shadow-lg">
            <span class="material-symbols-outlined">
                arrow_forward_ios
            </span>
        </button>
    </div>
</div>
                                        </code>
                                    </pre>
                                </div>
                            </div>
                        </div>
                    </div>            
                </div>
                <!-- End -->
                <!-- Start -->
                <div class="col-lg-6 col-xl-6">
                    <h2 class="text-primary text-uppercase fz-16 mb-2">
                        Tab Language
                    </h2>
                    <div class="component-snippets-container position-relative card">
                        <div class="component-snippets-preview">
                            <div id="liveAlertPlaceholder">
                                <div></div>
                            </div>
                            <ul class="nav nav--tabs border-color-primary">
                                <li class="nav-item">
                                    <a class="nav-link lang_link active" href="#" id="default-link">{{translate('default')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link lang_link" href="#"  id="">{{translate('Arabic(SA)')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link lang_link" href="#"  id="">{{translate('Bangla(BD)')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link lang_link" href="#"  id="">{{translate('Hindi(IN)')}}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="position-relative snippets-code-hover">
                            <div class="component-snippets-code-header">
                                <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                    <i class="fi fi-rr-copy"></i> 
                                </button>
                            </div>
                            <div class="code-preview max-w-100">
                                <div class="component-snippets-code-container">
                                    <pre>
                                        <code class="">
<ul class="nav nav--tabs border-color-primary">
    <li class="nav-item">
        <a class="nav-link lang_link active" href="#" id="default-link">{{translate('default')}}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link lang_link" href="#"  id="">{{translate('Arabic(SA)')}}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link lang_link" href="#"  id="">{{translate('Bangla(BD)')}}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link lang_link" href="#"  id="">{{translate('Hindi(IN)')}}</a>
    </li>
</ul>
                                        </code>
                                    </pre>
                                </div>
                            </div>
                        </div>
                    </div>            
                </div>
                <!-- End -->
            </div>


            <!-- 05 Row  -->
            <div class="card p-20 mb-4">
                <div class="row g-4">
                    <div class="col-md-12">
                        <h2 class="mb-2 text-primary text-uppercase border-bottom pb-3">Tooltip</h2>
                    </div>
                    <!-- Start -->
                    <div class="col-lg-6 col-xl-6">
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                                <button type="button" class="btn btn-primary rounded" data-bs-toggle="tooltip" data-bs-placement="top" title="{{translate('Tooltip Position Top')}}">
                                    Tooltip Top
                                </button>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<button type="button" class="btn btn-primary rounded" data-bs-toggle="tooltip" data-bs-placement="top" title="{{translate('Tooltip Position Top')}}">
    Tooltip Top
</button>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                    <!-- Start -->
                    <div class="col-lg-6 col-xl-6">
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                                <button type="button" class="btn btn-primary rounded" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{translate('Tooltip Position Bottom')}}">
                                    Tooltip Bottom
                                </button>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<button type="button" class="btn btn-primary rounded" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{translate('Tooltip Position Bottom')}}">
    Tooltip Bottom
</button>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                    <!-- Start -->
                    <div class="col-lg-6 col-xl-6">
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                                <button type="button" class="btn btn-primary rounded" data-bs-toggle="tooltip" data-bs-placement="left" title="{{translate('Tooltip Position Left')}}">
                                    Tooltip Left
                                </button>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<button type="button" class="btn btn-primary rounded" data-bs-toggle="tooltip" data-bs-placement="left" title="{{translate('Tooltip Position Left')}}">
    Tooltip Left
</button>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                    <!-- Start -->
                    <div class="col-lg-6 col-xl-6">
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                                <button type="button" class="btn btn-primary rounded" data-bs-toggle="tooltip" data-bs-placement="right" title="{{translate('Tooltip Position Right')}}">
                                    Tooltip Right
                                </button>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<button type="button" class="btn btn-primary rounded" data-bs-toggle="tooltip" data-bs-placement="right" title="{{translate('Tooltip Position Right')}}">
    Tooltip Right
</button>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                    <!-- Start -->
                    <div class="col-lg-6 col-xl-6">
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                                <button type="button" class="btn btn-primary rounded" data-bs-toggle="tooltip" data-bs-placement="top" title="{{translate('Tooltip Position Lorem ipsum dolor sit amet consectetur adipisicing elit. Multiple Text')}}">
                                    Tooltip Multiple Text
                                </button>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<button type="button" class="btn btn-primary rounded" data-bs-toggle="tooltip" data-bs-placement="top" title="{{translate('Tooltip Position Lorem ipsum dolor sit amet consectetur adipisicing elit. Multiple Text')}}">
    Tooltip Multiple Text
</button>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                </div>
            </div>
            
            <!-- 06 Row  -->
            <div class="card p-20 mb-4">
                <div class="row g-4">
                    <div class="col-md-12">
                        <h2 class="mb-2 text-primary text-uppercase border-bottom pb-3">Notes Info</h2>
                    </div>
                    <!-- Start -->
                    <div class="col-md-12">
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                               <div class="d-flex flex-column gap-3">
                                    <div class="pick-map p-12 rounded d-flex flex-md-nowrap flex-wrap align-items-center gap-1 bg-primary bg-opacity-10">
                                        <img src="{{asset('public/assets/admin-module')}}/img/lights-icons.png" alt="">
                                        <p class="fz-12">To use any <span class="text-dark fw-medium">payment method</span> for <span class="text-dark fw-medium">Partial payment</span> you need to active them from <span class="text-dark fw-medium">Previous Section,</span> otherwise the payment method will remain disable.</p>
                                    </div>
                                    <div class="pick-map p-12 rounded d-flex flex-md-nowrap flex-wrap align-items-start gap-1 bg-primary bg-opacity-10">
                                        <img src="{{asset('public/assets/admin-module')}}/img/lights-icons.png" alt="">
                                        <p class="fz-12">All the provider <a href="#" class="text-primary text-decoration-underline fw-medium">Withdraw Request</a> you wil find from Withdraw Request page. For further setup for withdraw request go to <a href="#" class="text-primary text-decoration-underline fw-medium">Withdraw Method Setup</a> .</p>
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<div class="d-flex flex-column gap-3">
    <div class="pick-map p-12 rounded d-flex flex-md-nowrap flex-wrap align-items-center gap-1 bg-primary bg-opacity-10">
        <img src="{{asset('public/assets/admin-module')}}/img/lights-icons.png" alt="">
        <p class="fz-12">To use any <span class="text-dark fw-medium">payment method</span> for <span class="text-dark fw-medium">Partial payment</span> you need to active them from <span class="text-dark fw-medium">Previous Section,</span> otherwise the payment method will remain disable.</p>
    </div>
    <div class="pick-map p-12 rounded d-flex flex-md-nowrap flex-wrap align-items-start gap-1 bg-primary bg-opacity-10">
        <img src="{{asset('public/assets/admin-module')}}/img/lights-icons.png" alt="">
        <p class="fz-12">All the provider <a href="#" class="text-primary text-decoration-underline fw-medium">Withdraw Request</a> you wil find from Withdraw Request page. For further setup for withdraw request go to <a href="#" class="text-primary text-decoration-underline fw-medium">Withdraw Method Setup</a> .</p>
    </div>
</div>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                </div>
            </div> 
             <!-- 07 Row  -->
            <div class="card p-20 mb-4">
                <div class="row g-4">
                    <div class="col-md-12">
                        <h2 class="mb-2 text-primary text-uppercase border-bottom pb-3">Warning Notes</h2>
                    </div>
                    <!-- Start -->
                    <div class="col-md-12">
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                                <div class="d-flex flex-column gap-3">
                                    <div class="pick-map p-12 rounded bg-warning bg-opacity-10 d-flex flex-md-nowrap flex-wrap align-items-start gap-1">
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_9562_195)">
                                            <path d="M7 14C8.38447 14 9.73785 13.5895 10.889 12.8203C12.0401 12.0511 12.9373 10.9579 13.4672 9.67879C13.997 8.3997 14.1356 6.99224 13.8655 5.63437C13.5954 4.2765 12.9287 3.02922 11.9497 2.05026C10.9708 1.07129 9.7235 0.404603 8.36563 0.134506C7.00777 -0.13559 5.6003 0.003033 4.32122 0.532846C3.04213 1.06266 1.94888 1.95987 1.17971 3.11101C0.410543 4.26216 0 5.61553 0 7C0.0020073 8.8559 0.74015 10.6352 2.05247 11.9475C3.36479 13.2599 5.1441 13.998 7 14ZM7 2.91667C7.17306 2.91667 7.34223 2.96799 7.48612 3.06413C7.63002 3.16028 7.74217 3.29694 7.8084 3.45682C7.87462 3.61671 7.89195 3.79264 7.85819 3.96237C7.82443 4.13211 7.74109 4.28802 7.61872 4.41039C7.49635 4.53276 7.34044 4.6161 7.1707 4.64986C7.00097 4.68362 6.82504 4.66629 6.66515 4.60006C6.50527 4.53384 6.36861 4.42169 6.27246 4.27779C6.17632 4.1339 6.125 3.96473 6.125 3.79167C6.125 3.55961 6.21719 3.33705 6.38128 3.17295C6.54538 3.00886 6.76794 2.91667 7 2.91667ZM6.41667 5.83334H7C7.30942 5.83334 7.60617 5.95625 7.82496 6.17505C8.04375 6.39384 8.16667 6.69058 8.16667 7V10.5C8.16667 10.6547 8.10521 10.8031 7.99581 10.9125C7.88642 11.0219 7.73804 11.0833 7.58333 11.0833C7.42862 11.0833 7.28025 11.0219 7.17086 10.9125C7.06146 10.8031 7 10.6547 7 10.5V7H6.41667C6.26196 7 6.11358 6.93855 6.00419 6.82915C5.89479 6.71975 5.83333 6.57138 5.83333 6.41667C5.83333 6.26196 5.89479 6.11359 6.00419 6.00419C6.11358 5.8948 6.26196 5.83334 6.41667 5.83334Z" fill="#FFBB38"/>
                                            </g>
                                            <defs>
                                            <clipPath id="clip0_9562_195">
                                            <rect width="14" height="14" fill="white"/>
                                            </clipPath>
                                            </defs>
                                        </svg>
                                        <p class="fz-12">To active subscription based business model 1st you need to add subscription package from <span class="fw-semibold text-primary text-decoration-underline">Subscription Packages.</span></p>
                                    </div>                        
                                    <div class="bg-warning bg-opacity-10 fs-12 p-12 text-dark rounded mb-3">
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_9562_195)">
                                                <path d="M7 14C8.38447 14 9.73785 13.5895 10.889 12.8203C12.0401 12.0511 12.9373 10.9579 13.4672 9.67879C13.997 8.3997 14.1356 6.99224 13.8655 5.63437C13.5954 4.2765 12.9287 3.02922 11.9497 2.05026C10.9708 1.07129 9.7235 0.404603 8.36563 0.134506C7.00777 -0.13559 5.6003 0.003033 4.32122 0.532846C3.04213 1.06266 1.94888 1.95987 1.17971 3.11101C0.410543 4.26216 0 5.61553 0 7C0.0020073 8.8559 0.74015 10.6352 2.05247 11.9475C3.36479 13.2599 5.1441 13.998 7 14ZM7 2.91667C7.17306 2.91667 7.34223 2.96799 7.48612 3.06413C7.63002 3.16028 7.74217 3.29694 7.8084 3.45682C7.87462 3.61671 7.89195 3.79264 7.85819 3.96237C7.82443 4.13211 7.74109 4.28802 7.61872 4.41039C7.49635 4.53276 7.34044 4.6161 7.1707 4.64986C7.00097 4.68362 6.82504 4.66629 6.66515 4.60006C6.50527 4.53384 6.36861 4.42169 6.27246 4.27779C6.17632 4.1339 6.125 3.96473 6.125 3.79167C6.125 3.55961 6.21719 3.33705 6.38128 3.17295C6.54538 3.00886 6.76794 2.91667 7 2.91667ZM6.41667 5.83334H7C7.30942 5.83334 7.60617 5.95625 7.82496 6.17505C8.04375 6.39384 8.16667 6.69058 8.16667 7V10.5C8.16667 10.6547 8.10521 10.8031 7.99581 10.9125C7.88642 11.0219 7.73804 11.0833 7.58333 11.0833C7.42862 11.0833 7.28025 11.0219 7.17086 10.9125C7.06146 10.8031 7 10.6547 7 10.5V7H6.41667C6.26196 7 6.11358 6.93855 6.00419 6.82915C5.89479 6.71975 5.83333 6.57138 5.83333 6.41667C5.83333 6.26196 5.89479 6.11359 6.00419 6.00419C6.11358 5.8948 6.26196 5.83334 6.41667 5.83334Z" fill="#FFBB38"/>
                                                </g>
                                                <defs>
                                                <clipPath id="clip0_9562_195">
                                                <rect width="14" height="14" fill="white"/>
                                                </clipPath>
                                                </defs>
                                            </svg>
                                            <p class="fz-12">To enable this feature must be activated</p>
                                        </div>
                                        <ul class="m-0 ps-20 d-flex flex-column gap-1 text-dark">
                                            <li>Customer wallet from the <span class="fw-semibold text-primary text-decoration-underline">Customer Wallet</span> page.</li>
                                            <li>At least one payment mathod from the previous <span class="fw-semibold text-dark text-decoration-underline">Payment Option</span> section.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<div class="d-flex flex-column gap-3">
    <div class="pick-map p-12 rounded bg-warning bg-opacity-10 d-flex flex-md-nowrap flex-wrap align-items-start gap-1">
        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_9562_195)">
            <path d="M7 14C8.38447 14 9.73785 13.5895 10.889 12.8203C12.0401 12.0511 12.9373 10.9579 13.4672 9.67879C13.997 8.3997 14.1356 6.99224 13.8655 5.63437C13.5954 4.2765 12.9287 3.02922 11.9497 2.05026C10.9708 1.07129 9.7235 0.404603 8.36563 0.134506C7.00777 -0.13559 5.6003 0.003033 4.32122 0.532846C3.04213 1.06266 1.94888 1.95987 1.17971 3.11101C0.410543 4.26216 0 5.61553 0 7C0.0020073 8.8559 0.74015 10.6352 2.05247 11.9475C3.36479 13.2599 5.1441 13.998 7 14ZM7 2.91667C7.17306 2.91667 7.34223 2.96799 7.48612 3.06413C7.63002 3.16028 7.74217 3.29694 7.8084 3.45682C7.87462 3.61671 7.89195 3.79264 7.85819 3.96237C7.82443 4.13211 7.74109 4.28802 7.61872 4.41039C7.49635 4.53276 7.34044 4.6161 7.1707 4.64986C7.00097 4.68362 6.82504 4.66629 6.66515 4.60006C6.50527 4.53384 6.36861 4.42169 6.27246 4.27779C6.17632 4.1339 6.125 3.96473 6.125 3.79167C6.125 3.55961 6.21719 3.33705 6.38128 3.17295C6.54538 3.00886 6.76794 2.91667 7 2.91667ZM6.41667 5.83334H7C7.30942 5.83334 7.60617 5.95625 7.82496 6.17505C8.04375 6.39384 8.16667 6.69058 8.16667 7V10.5C8.16667 10.6547 8.10521 10.8031 7.99581 10.9125C7.88642 11.0219 7.73804 11.0833 7.58333 11.0833C7.42862 11.0833 7.28025 11.0219 7.17086 10.9125C7.06146 10.8031 7 10.6547 7 10.5V7H6.41667C6.26196 7 6.11358 6.93855 6.00419 6.82915C5.89479 6.71975 5.83333 6.57138 5.83333 6.41667C5.83333 6.26196 5.89479 6.11359 6.00419 6.00419C6.11358 5.8948 6.26196 5.83334 6.41667 5.83334Z" fill="#FFBB38"/>
            </g>
            <defs>
            <clipPath id="clip0_9562_195">
            <rect width="14" height="14" fill="white"/>
            </clipPath>
            </defs>
        </svg>
        <p class="fz-12">To active subscription based business model 1st you need to add subscription package from <span class="fw-semibold text-primary text-decoration-underline">Subscription Packages.</span></p>
    </div>                        
    <div class="bg-warning bg-opacity-10 fs-12 p-12 text-dark rounded mb-3">
        <div class="d-flex align-items-center gap-2 mb-2">
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_9562_195)">
                <path d="M7 14C8.38447 14 9.73785 13.5895 10.889 12.8203C12.0401 12.0511 12.9373 10.9579 13.4672 9.67879C13.997 8.3997 14.1356 6.99224 13.8655 5.63437C13.5954 4.2765 12.9287 3.02922 11.9497 2.05026C10.9708 1.07129 9.7235 0.404603 8.36563 0.134506C7.00777 -0.13559 5.6003 0.003033 4.32122 0.532846C3.04213 1.06266 1.94888 1.95987 1.17971 3.11101C0.410543 4.26216 0 5.61553 0 7C0.0020073 8.8559 0.74015 10.6352 2.05247 11.9475C3.36479 13.2599 5.1441 13.998 7 14ZM7 2.91667C7.17306 2.91667 7.34223 2.96799 7.48612 3.06413C7.63002 3.16028 7.74217 3.29694 7.8084 3.45682C7.87462 3.61671 7.89195 3.79264 7.85819 3.96237C7.82443 4.13211 7.74109 4.28802 7.61872 4.41039C7.49635 4.53276 7.34044 4.6161 7.1707 4.64986C7.00097 4.68362 6.82504 4.66629 6.66515 4.60006C6.50527 4.53384 6.36861 4.42169 6.27246 4.27779C6.17632 4.1339 6.125 3.96473 6.125 3.79167C6.125 3.55961 6.21719 3.33705 6.38128 3.17295C6.54538 3.00886 6.76794 2.91667 7 2.91667ZM6.41667 5.83334H7C7.30942 5.83334 7.60617 5.95625 7.82496 6.17505C8.04375 6.39384 8.16667 6.69058 8.16667 7V10.5C8.16667 10.6547 8.10521 10.8031 7.99581 10.9125C7.88642 11.0219 7.73804 11.0833 7.58333 11.0833C7.42862 11.0833 7.28025 11.0219 7.17086 10.9125C7.06146 10.8031 7 10.6547 7 10.5V7H6.41667C6.26196 7 6.11358 6.93855 6.00419 6.82915C5.89479 6.71975 5.83333 6.57138 5.83333 6.41667C5.83333 6.26196 5.89479 6.11359 6.00419 6.00419C6.11358 5.8948 6.26196 5.83334 6.41667 5.83334Z" fill="#FFBB38"/>
                </g>
                <defs>
                <clipPath id="clip0_9562_195">
                <rect width="14" height="14" fill="white"/>
                </clipPath>
                </defs>
            </svg>
            <p class="fz-12">To enable this feature must be activated</p>
        </div>
        <ul class="m-0 ps-20 d-flex flex-column gap-1 text-dark">
            <li>Customer wallet from the <span class="fw-semibold text-primary text-decoration-underline">Customer Wallet</span> page.</li>
            <li>At least one payment mathod from the previous <span class="fw-semibold text-dark text-decoration-underline">Payment Option</span> section.</li>
        </ul>
    </div>
</div>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                </div>
            </div>
            <!-- 08 Row  -->
            <div class="card p-20 mb-4">
                <div class="row g-4">
                    <div class="col-md-12">
                        <h2 class="mb-2 text-primary text-uppercase border-bottom pb-3">Danger Notes</h2>
                    </div>
                    <!-- Start -->
                    <div class="col-md-12">
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                               <div class="d-flex flex-column gap-3">
                                    <div class="bg-danger bg-opacity-10 fs-12 p-10 rounded d-flex gap-2 align-items-center">
                                        <span class="material-symbols-outlined text-danger">
                                            warning
                                        </span>
                                        <span>
                                            <span class="fw-medium text-dark">Digital Payment</span> and <span class="fw-medium text-dark">Offline Payment</span> option are disable because <span class="fw-medium text-dark">Digital</span> and <span class="fw-medium text-dark">Offline payment</span> are not active from Previous <span class="fw-medium text-dark">Section.</span> 
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<div class="d-flex flex-column gap-3">
    <div class="bg-danger bg-opacity-10 fs-12 p-10 rounded d-flex gap-2 align-items-center">
        <span class="material-symbols-outlined text-danger">
            warning
        </span>
        <span>
            <span class="fw-medium text-dark">Digital Payment</span> and <span class="fw-medium text-dark">Offline Payment</span> option are disable because <span class="fw-medium text-dark">Digital</span> and <span class="fw-medium text-dark">Offline payment</span> are not active from Previous <span class="fw-medium text-dark">Section.</span> 
        </span>
    </div>
</div>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                </div>
            </div> 
            <!-- 09 Row  -->
            <div class="card p-20 mb-4">
                <div class="row g-4">
                    <div class="col-md-12">
                        <h2 class="mb-2 text-primary text-uppercase border-bottom pb-3">Copy Code</h2>
                    </div>
                    <!-- Start -->
                    <div class="col-lmd-12">
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                                <div class="d-flex h-100 align-items-start gap-xl-3 gap-2 bg-white cus-shadow2 rounded p-20">
                                    <img src="{{asset('public/assets/admin-module/img/command.png')}}" alt="">
                                    <div class="w-0 flex-grow-1">
                                        <h6 class="fs-12 mb-1">{{translate('PHP File Path')}}</h6>                                            
                                        <div class="fs-12 command">/path/to/php/file</div>
                                        <div class="copy-text position-relative d-flex justify-content-between gap-1">
                                            <input type="text" class="text border-0 text-light-gray bg-transparent" value="0 12,15,17,19,21 * * * cat /home/helloworld.sh" />
                                            <button class="border-0 outline-0 text-primary p-0 bg-transparent"><span class="material-symbols-outlined">content_copy</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
                        <div class="d-flex h-100 align-items-start gap-xl-3 gap-2 bg-white cus-shadow2 rounded p-20">
    <img src="{{asset('public/assets/admin-module/img/command.png')}}" alt="">
    <div class="w-0 flex-grow-1">
        <h6 class="fs-12 mb-1">{{translate('PHP File Path')}}</h6>                                            
        <div class="fs-12 command">/path/to/php/file</div>
        <div class="copy-text position-relative d-flex justify-content-between gap-1">
            <input type="text" class="text border-0 text-light-gray bg-transparent" value="0 12,15,17,19,21 * * * cat /home/helloworld.sh" />
            <button class="border-0 outline-0 text-primary p-0 bg-transparent"><span class="material-symbols-outlined">content_copy</span></button>
        </div>
    </div>
</div>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                </div>
            </div>
            <!-- 00 Row  -->
            <div class="card p-20 mb-4">
                <div class="row g-4">
                    <div class="col-md-12">
                        <h2 class="mb-2 text-primary text-uppercase border-bottom pb-3">Tables</h2>
                    </div>
                    <!-- Start -->
                    <div class="col-lg-12">
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                                <div class="">
                                    <div class="data-table-top mb-20 d-flex align-items-center flex-wrap gap-xl-3 gap-2 justify-content-between">
                                        <h4 class="fw-bold text-dark">{{translate('Page List')}}</h4>
                                        <form action="#" class="search-form search-form_style-two d-flex align-items-center gap-0 border rounded" method="GET">
                                            @csrf
                                            <div class="input-group search-form__input_group bg-transparent">
                                                <input type="search" class="theme-input-style search-form__input border-0  block-size-36" name="search"
                                                        placeholder="{{translate('search_here')}}"
                                                        value="">
                                            </div>
                                            <button type="submit" class="bg-light border-0 px-2 block-size-36 rounded-end d-flex align-items-center justify-content-center">
                                                <span class="material-symbols-outlined fz-20 opacity-75">
                                                    search
                                                </span>
                                            </button>
                                        </form>
                                    </div> 
                                    <div class="table-responsive">
                                        <table id="example" class="table align-middle">
                                            <thead>
                                            <tr>
                                                <th>{{translate('SL')}}</th>
                                                <th>{{translate('File_Name')}}</th>
                                                <th>{{translate('Backup Time')}}</th>
                                                <th>{{translate('File Size')}}</th>
                                                <th class="text-center">{{translate('action')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Subscription renewal reminder mail	</td>
                                                    <td>Mar 04, 2020</td>
                                                    <td>1.95 Mb</td>
                                                    <td>
                                                        <div class="d-flex gap-2 justify-content-center">
                                                            <button type="button" class="action-btn btn--light-primary db-restore demo_check">
                                                                <span class="material-icons">settings_backup_restore</span>
                                                            </button>
                                                            <div class="modal fade" id="" tabindex="-1" aria-labelledby="restoreModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-body p-30">
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            <div class="d-flex flex-column gap-2 align-items-center text-center">
                                                                                <img class="mb-3" src="{{asset('public/assets/admin-module')}}/img/ad_delete.svg" alt="">
                                                                                <h3 class="mb-2">{{ translate('Are you sure you want to restore this backup') }}?</h3>
                                                                                <p>{{ translate('This action will replace the current database with the selected backup. Any unsaved changes made after the backup date will be lost.') }}</p>
                                                                                <div class="d-flex gap-3 justify-content-center flex-wrap">
                                                                                    <button type="button" class="btn btn--secondary text-capitalize" class="btn-close" data-bs-dismiss="modal">{{ translate('Cancel') }}</button>
                                                                                    <a class="btn btn--primary text-capitalize demo_check" href="#">{{ translate('Restore Backup') }}</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button type="button" class="action-btn btn--success">
                                                                <span class="material-icons">download</span>
                                                            </button>
                                                            <button type="button" class="action-btn btn--danger">
                                                                <span class="material-symbols-outlined">delete</span>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>                                 
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
                        <div class="">
    <div class="data-table-top mb-20 d-flex align-items-center flex-wrap gap-xl-3 gap-2 justify-content-between">
        <h4 class="fw-bold text-dark">{{translate('Page List')}}</h4>
        <form action="#" class="search-form search-form_style-two d-flex align-items-center gap-0 border rounded" method="GET">
            @csrf
            <div class="input-group search-form__input_group bg-transparent">
                <input type="search" class="theme-input-style search-form__input border-0  block-size-36" name="search"
                        placeholder="{{translate('search_here')}}"
                        value="">
            </div>
            <button type="submit" class="bg-light border-0 px-2 block-size-36 rounded-end d-flex align-items-center justify-content-center">
                <span class="material-symbols-outlined fz-20 opacity-75">
                    search
                </span>
            </button>
        </form>
    </div> 
    <div class="table-responsive">
        <table id="example" class="table align-middle">
            <thead>
            <tr>
                <th>{{translate('SL')}}</th>
                <th>{{translate('File_Name')}}</th>
                <th>{{translate('Backup Time')}}</th>
                <th>{{translate('File Size')}}</th>
                <th class="text-center">{{translate('action')}}</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Subscription renewal reminder mail	</td>
                    <td>Mar 04, 2020</td>
                    <td>1.95 Mb</td>
                    <td>
                        <div class="d-flex gap-2 justify-content-center">
                            <button type="button" class="action-btn btn--light-primary db-restore demo_check">
                                <span class="material-icons">settings_backup_restore</span>
                            </button>
                            <div class="modal fade" id="" tabindex="-1" aria-labelledby="restoreModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body p-30">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            <div class="d-flex flex-column gap-2 align-items-center text-center">
                                                <img class="mb-3" src="{{asset('public/assets/admin-module')}}/img/ad_delete.svg" alt="">
                                                <h3 class="mb-2">{{ translate('Are you sure you want to restore this backup') }}?</h3>
                                                <p>{{ translate('This action will replace the current database with the selected backup. Any unsaved changes made after the backup date will be lost.') }}</p>
                                                <div class="d-flex gap-3 justify-content-center flex-wrap">
                                                    <button type="button" class="btn btn--secondary text-capitalize" class="btn-close" data-bs-dismiss="modal">{{ translate('Cancel') }}</button>
                                                    <a class="btn btn--primary text-capitalize demo_check" href="#">{{ translate('Restore Backup') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="action-btn btn--success">
                                <span class="material-icons">download</span>
                            </button>
                            <button type="button" class="action-btn btn--danger">
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    </div>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                     <!-- Start -->
                    <div class="col-lg-12">
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                                <div class="table-responsive table-custom-responsive">
                                    <table id="example" class="table align-middle">
                                        <thead class="text-nowrap">
                                            <tr>
                                                <th class="text-dark fw-medium bg-light">{{translate('Sl')}}</th>
                                                <th class="text-dark fw-medium bg-light">{{translate('Page Name')}}</th>
                                                <th class="text-dark fw-medium bg-light text-center">{{translate('Availability')}}</th>
                                                <th class="text-dark fw-medium bg-light text-end">{{translate('action')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Terms & Conditions</td>
                                                <td class="text-end">
                                                    <label class="switcher mx-auto">
                                                        <input class="switcher_input" type="checkbox"> 
                                                        <span class="switcher_control"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2 justify-content-end">
                                                        <a href="#" class="action-btn btn--light-primary">
                                                            <span class="material-icons">visibility</span>
                                                        </a>
                                                        <a href="#" class="action-btn btn--light-primary">
                                                            <span class="material-icons">edit</span>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Privacy Policy</td>
                                                <td class="text-end">
                                                    <label class="switcher mx-auto">
                                                        <input class="switcher_input" type="checkbox"> 
                                                        <span class="switcher_control"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2 justify-content-end">
                                                        <a href="#" class="action-btn btn--light-primary">
                                                            <span class="material-icons">visibility</span>
                                                        </a>
                                                        <a href="#" class="action-btn btn--light-primary">
                                                            <span class="material-icons">edit</span>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<div class="table-responsive table-custom-responsive">
    <table id="example" class="table align-middle">
        <thead class="text-nowrap">
            <tr>
                <th class="text-dark fw-medium bg-light">{{translate('Sl')}}</th>
                <th class="text-dark fw-medium bg-light">{{translate('Page Name')}}</th>
                <th class="text-dark fw-medium bg-light text-center">{{translate('Availability')}}</th>
                <th class="text-dark fw-medium bg-light text-end">{{translate('action')}}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Terms & Conditions</td>
                <td class="text-end">
                    <label class="switcher mx-auto">
                        <input class="switcher_input" type="checkbox"> 
                        <span class="switcher_control"></span>
                    </label>
                </td>
                <td>
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="#" class="action-btn btn--light-primary">
                            <span class="material-icons">visibility</span>
                        </a>
                        <a href="#" class="action-btn btn--light-primary">
                            <span class="material-icons">edit</span>
                        </a>
                    </div>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Privacy Policy</td>
                <td class="text-end">
                    <label class="switcher mx-auto">
                        <input class="switcher_input" type="checkbox"> 
                        <span class="switcher_control"></span>
                    </label>
                </td>
                <td>
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="#" class="action-btn btn--light-primary">
                            <span class="material-icons">visibility</span>
                        </a>
                        <a href="#" class="action-btn btn--light-primary">
                            <span class="material-icons">edit</span>
                        </a>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                </div>
            </div> 

            <!-- 00 Row  -->
            <div class="mb-4">
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="card p-20">
                            <h2 class="text-primary text-uppercase">Images / Files</h2>
                        </div>
                    </div>
                    <!-- Start -->
                    <div class="col-lg-6 col-xl-6">
                        <h4 class="mb-2">1/1 Images</h4>
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                                <span class="mb-2 d-block">Normal</span>
                                <div class="custom-upload-wrapper upload-group mx-auto image-upload-wrap2">
                                    <input type="file" id="imageUpload" accept="image/*" required>        
                                    <label for="imageUpload" class="upload-box rounded position-relative d-flex align-items-center justify-content-center text-center overflow-hidden bg-white">
                                        <div class="upload-content">
                                            <img src="{{asset('public/assets/admin-module')}}/img/image-uploads.png" alt="placeholder" class="placeholder-icon mb-2">
                                            <h6 class="fz-10 text-primary">Click to upload<br> <span class="text-dark d-block mt-1">Or drag and drop</span> </h6>
                                        </div>
                                        <img class="image-preview" src="" alt="Preview" />
                                        <div class="upload-overlay">
                                            <span class="material-symbols-outlined">photo_camera</span>
                                        </div>                                        
                                    </label>
                                </div>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
                        <div class="custom-upload-wrapper upload-group mx-auto image-upload-wrap2">
    <input type="file" id="imageUpload" accept="image/*" required>        
    <label for="imageUpload" class="upload-box rounded position-relative d-flex align-items-center justify-content-center text-center overflow-hidden bg-white">
        <div class="upload-content">
            <img src="{{asset('public/assets/admin-module')}}/img/image-uploads.png" alt="placeholder" class="placeholder-icon mb-2">
            <h6 class="fz-10 text-primary">Click to upload<br> <span class="text-dark d-block mt-1">Or drag and drop</span> </h6>
        </div>
        <img class="image-preview" src="" alt="Preview" />
        <div class="upload-overlay">
            <span class="material-symbols-outlined">photo_camera</span>
        </div>                                        
    </label>
</div>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                    <!-- Start -->
                    <div class="col-lg-6 col-xl-6">
                        <h4 class="mb-2">2/1 Images</h4>
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                                <span class="mb-2 d-block">With delete button</span>
                                <div class="custom-upload-wrapper upload-group ratio-2-1 h-100px mx-auto">
                                    <input type="file" id="imageUpload2" accept="image/*" required>        
                                    <label for="imageUpload2" class="upload-box rounded position-relative d-flex align-items-center justify-content-center text-center overflow-hidden bg-white">
                                        <div class="upload-content">
                                            <img src="{{asset('public/assets/admin-module')}}/img/image-uploads.png" alt="placeholder" class="placeholder-icon mb-2">
                                            <h6 class="fz-10 text-primary">Click to upload<br> <span class="text-dark d-block mt-1">Or drag and drop</span> </h6>
                                        </div>
                                        <img class="image-preview" src="" alt="Preview" />
                                        <div class="upload-overlay">
                                            <span class="material-symbols-outlined">photo_camera</span>
                                        </div>                                        
                                        <span class="uploaded-remove-icon"><i class="material-symbols-outlined">close</i></span>
                                    </label>
                                </div>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
                        <div class="custom-upload-wrapper upload-group image-upload-wrap1 mx-auto">
    <input type="file" id="imageUpload2" accept="image/*" required>        
    <label for="imageUpload2" class="upload-box rounded position-relative d-flex align-items-center justify-content-center text-center overflow-hidden bg-white">
        <div class="upload-content">
            <img src="{{asset('public/assets/admin-module')}}/img/image-uploads.png" alt="placeholder" class="placeholder-icon mb-2">
            <h6 class="fz-10 text-primary">Click to upload<br> <span class="text-dark d-block mt-1">Or drag and drop</span> </h6>
        </div>
        <img class="image-preview" src="" alt="Preview" />
        <div class="upload-overlay">
            <span class="material-symbols-outlined">photo_camera</span>
        </div>                                        
        <span class="uploaded-remove-icon"><i class="material-symbols-outlined">close</i></span>
    </label>
</div>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                    <!-- Start -->
                    <div class="col-lg-6 col-xl-6">
                        <h4 class="mb-2">3/1 Images</h4>
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                                <span class="mb-2 d-block">With All Icons</span>
                                <div class="global-image-upload position-relative ratio-3-1 max-w-100 overflow-hidden bg-white border-dashed rounded-2 mx-auto h-100px d-center">
                                    <input type="file" accept="image/*" required style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">                                
                                    <div class="global-upload-box">
                                        <div class="upload-content text-center">
                                            <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">photo_camera</span>
                                            <span class="fz-10 d-block">Add image</span>
                                        </div>
                                    </div>                                
                                    <img class="global-image-preview d-none" src="" alt="Preview" style="max-height: 100%; max-width: 100%;" />
                                    <div class="overlay-icons d-none">
                                        <button type="button" class="action-btn btn--light-primary bg-white outline-primary-hover view-icon" title="View" data-bs-toggle="modal" data-bs-target="#imageShowingMOdal">
                                            <span class="material-icons">visibility</span>
                                        </button>
                                        <button type="button" class="action-btn btn--light-primary bg-white outline-primary-hover edit-icon" title="Edit">
                                            <span class="material-icons">edit</span>
                                        </button>
                                        <button type="button" class="action-btn btn--danger delete_section bg-white outline-danger-hover remove-icon" title="Remove">
                                            <i class="material-symbols-outlined">delete</i>
                                        </button>
                                    </div>
                                    <div class="image-file-name d-none mt-2 text-center text-muted" style="font-size: 12px;"></div>
                                </div>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<div class="global-image-upload position-relative ratio-3-1 max-w-100 overflow-hidden bg-white border-dashed rounded-2 mx-auto h-100px d-center">
    <input type="file" accept="image/*" required style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">                                
    <div class="global-upload-box">
        <div class="upload-content text-center">
            <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">photo_camera</span>
            <span class="fz-10 d-block">Add image</span>
        </div>
    </div>                                
    <img class="global-image-preview d-none" src="" alt="Preview" style="max-height: 100%; max-width: 100%;" />
    <div class="overlay-icons d-none">
        <button type="button" class="action-btn btn--light-primary bg-white outline-primary-hover view-icon" title="View" data-bs-toggle="modal" data-bs-target="#imageShowingMOdal">
            <span class="material-icons">visibility</span>
        </button>
        <button type="button" class="action-btn btn--light-primary bg-white outline-primary-hover edit-icon" title="Edit">
            <span class="material-icons">edit</span>
        </button>
        <button type="button" class="action-btn btn--danger delete_section bg-white outline-danger-hover remove-icon" title="Remove">
            <i class="material-symbols-outlined">delete</i>
        </button>
    </div>
    <div class="image-file-name d-none mt-2 text-center text-muted" style="font-size: 12px;"></div>
</div>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                    <!-- Start -->
                    <div class="col-lg-6 col-xl-6">
                        <h4 class="mb-2">7/1 Images</h4>
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                                <span class="mb-2 d-block">With All Icons</span>
                                <div class="global-image-upload position-relative max-w-100 overflow-hidden bg-white border-dashed rounded-2 mx-auto ratio-7-1 h-100px d-center">
                                    <input type="file" accept="image/*" required style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">                                
                                    <div class="global-upload-box">
                                        <div class="upload-content text-center">
                                            <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">photo_camera</span>
                                            <span class="fz-10 d-block">Add image</span>
                                        </div>
                                    </div>                                
                                    <img class="global-image-preview d-none" src="" alt="Preview" style="max-height: 100%; max-width: 100%;" />
                                    <div class="overlay-icons d-none">
                                        <button type="button" class="action-btn btn--light-primary bg-white outline-primary-hover view-icon" title="View" data-bs-toggle="modal" data-bs-target="#imageShowingMOdal">
                                            <span class="material-icons">visibility</span>
                                        </button>
                                        <button type="button" class="action-btn btn--light-primary bg-white outline-primary-hover edit-icon" title="Edit">
                                            <span class="material-icons">edit</span>
                                        </button>
                                        <button type="button" class="action-btn btn--danger delete_section bg-white outline-danger-hover remove-icon" title="Remove">
                                            <i class="material-symbols-outlined">delete</i>
                                        </button>
                                    </div>
                                    <div class="image-file-name d-none mt-2 text-center text-muted" style="font-size: 12px;"></div>
                                </div>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<div class="global-image-upload position-relative max-w-100 overflow-hidden bg-white border-dashed rounded-2 mx-auto mb-20 ratio-7-1 h-100px d-center">
    <input type="file" accept="image/*" required style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">                                
    <div class="global-upload-box">
        <div class="upload-content text-center">
            <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">photo_camera</span>
            <span class="fz-10 d-block">Add image</span>
        </div>
    </div>                                
    <img class="global-image-preview d-none" src="" alt="Preview" style="max-height: 100%; max-width: 100%;" />
    <div class="overlay-icons d-none">
        <button type="button" class="action-btn btn--light-primary bg-white outline-primary-hover view-icon" title="View" data-bs-toggle="modal" data-bs-target="#imageShowingMOdal">
            <span class="material-icons">visibility</span>
        </button>
        <button type="button" class="action-btn btn--light-primary bg-white outline-primary-hover edit-icon" title="Edit">
            <span class="material-icons">edit</span>
        </button>
        <button type="button" class="action-btn btn--danger delete_section bg-white outline-danger-hover remove-icon" title="Remove">
            <i class="material-symbols-outlined">delete</i>
        </button>
    </div>
    <div class="image-file-name d-none mt-2 text-center text-muted" style="font-size: 12px;"></div>
                                </div>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                    <!-- Start -->
                    <div class="col-lg-6 col-xl-6">
                        <h4 class="mb-2">1/1 Images</h4>
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                                <span class="mb-2 d-block">With Inside delete button</span>
                                <div class="global-image-upload position-relative max-w-100 overflow-hidden bg-white border-dashed rounded-2 mx-auto ratio-1 h-100px d-center">
                                    <input type="file" accept="image/*" required style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">                                
                                    <div class="global-upload-box">
                                        <div class="upload-content text-center">
                                            <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">photo_camera</span>
                                            <span class="fz-10 d-block">Add image</span>
                                        </div>
                                    </div>                                
                                    <img class="global-image-preview d-none" src="" alt="Preview" style="max-height: 100%; max-width: 100%;" />
                                    <div class="overlay-icons d-none">
                                        <button type="button" class="action-btn btn--danger delete_section bg-white outline-danger-hover remove-icon" title="Remove">
                                            <i class="material-symbols-outlined">delete</i>
                                        </button>
                                    </div>
                                    <div class="image-file-name d-none mt-2 text-center text-muted" style="font-size: 12px;"></div>
                                </div>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<div class="global-image-upload position-relative max-w-100 overflow-hidden bg-white border-dashed rounded-2 mx-auto ratio-1 h-100px d-center">
    <input type="file" accept="image/*" required style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">                                
    <div class="global-upload-box">
        <div class="upload-content text-center">
            <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">photo_camera</span>
            <span class="fz-10 d-block">Add image</span>
        </div>
    </div>                                
    <img class="global-image-preview d-none" src="" alt="Preview" style="max-height: 100%; max-width: 100%;" />
    <div class="overlay-icons d-none">
        <button type="button" class="action-btn btn--danger delete_section bg-white outline-danger-hover remove-icon" title="Remove">
            <i class="material-symbols-outlined">delete</i>
        </button>
    </div>
    <div class="image-file-name d-none mt-2 text-center text-muted" style="font-size: 12px;"></div>
</div>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                    <!-- Start -->
                    <div class="col-lg-6 col-xl-6">
                        <h4 class="mb-2">1/1 Images</h4>
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                                <span class="mb-2 d-block">With Inside View button</span>
                                <div class="global-image-upload position-relative max-w-100 overflow-hidden bg-white border-dashed rounded-2 mx-auto ratio-1 h-100px d-center">
                                    <input type="file" accept="image/*" required style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">                                
                                    <div class="global-upload-box">
                                        <div class="upload-content text-center">
                                            <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">photo_camera</span>
                                            <span class="fz-10 d-block">Add image</span>
                                        </div>
                                    </div>                                
                                    <img class="global-image-preview d-none" src="" alt="Preview" style="max-height: 100%; max-width: 100%;" />
                                    <div class="overlay-icons d-none">
                                        <button type="button" class="action-btn btn--light-primary bg-white outline-primary-hover view-icon" title="View" data-bs-toggle="modal" data-bs-target="#imageShowingMOdal">
                                            <span class="material-icons">visibility</span>
                                        </button>
                                    </div>
                                    <div class="image-file-name d-none mt-2 text-center text-muted" style="font-size: 12px;"></div>
                                </div>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<div class="global-image-upload position-relative max-w-100 overflow-hidden bg-white border-dashed rounded-2 mx-auto ratio-1 h-100px d-center">
    <input type="file" accept="image/*" required style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">                                
    <div class="global-upload-box">
        <div class="upload-content text-center">
            <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">photo_camera</span>
            <span class="fz-10 d-block">Add image</span>
        </div>
    </div>                                
    <img class="global-image-preview d-none" src="" alt="Preview" style="max-height: 100%; max-width: 100%;" />
    <div class="overlay-icons d-none">
        <button type="button" class="action-btn btn--light-primary bg-white outline-primary-hover view-icon" title="View" data-bs-toggle="modal" data-bs-target="#imageShowingMOdal">
            <span class="material-icons">visibility</span>
        </button>
    </div>
    <div class="image-file-name d-none mt-2 text-center text-muted" style="font-size: 12px;"></div>
</div>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                    <!-- Start -->
                    <div class="col-lg-6 col-xl-6">
                        <h4 class="mb-2">1/1 Images</h4>
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                                <span class="mb-2 d-block">With Inside Edit button</span>
                                <div class="global-image-upload position-relative max-w-100 overflow-hidden bg-white border-dashed rounded-2 mx-auto ratio-1 h-100px d-center">
                                    <input type="file" accept="image/*" required style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">                                
                                    <div class="global-upload-box">
                                        <div class="upload-content text-center">
                                            <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">photo_camera</span>
                                            <span class="fz-10 d-block">Add image</span>
                                        </div>
                                    </div>                                
                                    <img class="global-image-preview d-none" src="" alt="Preview" style="max-height: 100%; max-width: 100%;" />
                                    <div class="overlay-icons d-none">
                                        <button type="button" class="action-btn btn--light-primary bg-white outline-primary-hover edit-icon" title="Edit">
                                            <span class="material-icons">edit</span>
                                        </button>
                                    </div>
                                    <div class="image-file-name d-none mt-2 text-center text-muted" style="font-size: 12px;"></div>
                                </div>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<div class="global-image-upload position-relative max-w-100 overflow-hidden bg-white border-dashed rounded-2 mx-auto ratio-1 h-100px d-center">
    <input type="file" accept="image/*" required style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">                                
    <div class="global-upload-box">
        <div class="upload-content text-center">
            <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">photo_camera</span>
            <span class="fz-10 d-block">Add image</span>
        </div>
    </div>                                
    <img class="global-image-preview d-none" src="" alt="Preview" style="max-height: 100%; max-width: 100%;" />
    <div class="overlay-icons d-none">
        <button type="button" class="action-btn btn--light-primary bg-white outline-primary-hover edit-icon" title="Edit">
            <span class="material-icons">edit</span>
        </button>
    </div>
    <div class="image-file-name d-none mt-2 text-center text-muted" style="font-size: 12px;"></div>
</div>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                     <!-- Start -->
                    <div class="col-lg-6 col-xl-6">
                        <h4 class="mb-2">Multiple Image Upload</h4>
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                                <div>
                                    <div class="body-bg rounded p-20 mb-20">
                                        <h5 class="fw-normal mb-15 text-center">Choose Image <span class="text-danger">*</span></h5>
                                        <div class="trigger-image-hit ratio-1 position-relative max-w-100 overflow-hidden bg-white border-dashed rounded-2 mx-auto h-100px d-center">
                                            <input type="file" accept="image/*" required style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">                                
                                            <div class="global-upload-box">
                                                <div class="upload-content text-center">
                                                    <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">photo_camera</span>
                                                    <span class="fz-10 d-block">Add image</span>
                                                </div>
                                            </div>                                
                                        </div>
                                    </div>
                                    <div class="inside-upload-imageBox">

                                    </div>
                                </div>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<div>
    <div class="body-bg rounded p-20 mb-20">
        <h5 class="fw-normal mb-15 text-center">Choose Image <span class="text-danger">*</span></h5>
        <div class="trigger-image-hit ratio-1 position-relative max-w-100 overflow-hidden bg-white border-dashed rounded-2 mx-auto h-100px d-center">
            <input type="file" accept="image/*" required style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">                                
            <div class="global-upload-box">
                <div class="upload-content text-center">
                    <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">photo_camera</span>
                    <span class="fz-10 d-block">Add image</span>
                </div>
            </div>                                
        </div>
    </div>
    <div class="inside-upload-imageBox">

    </div>
</div>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                    <!-- Start -->
                    <div class="col-lg-6 col-xl-6">
                        <h4 class="mb-2">File Upload</h4>
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                                <div>
                                    <div class="body-bg rounded p-20 mb-20">
                                        <h5 class="fw-normal mb-15 text-center">Choose Zip File <span class="text-danger">*</span></h5>
                                        <div class="trigger-zip-hit ratio-1 position-relative max-w-100 overflow-hidden bg-white border-dashed rounded-2 mx-auto h-100px d-center">
                                            <input type="file" accept=".zip" required style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">                                
                                            <div class="global-upload-box">
                                                <div class="upload-content text-center">
                                                    <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">folder</span>
                                                    <span class="fz-10 d-block">Upload File</span>
                                                </div>
                                            </div>                                
                                        </div>
                                    </div>
                                    <div class="inside-upload-zipBox">

                                    </div>
                                </div>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
<div>
    <div class="body-bg rounded p-20 mb-20">
        <h5 class="fw-normal mb-15 text-center">Choose Zip File <span class="text-danger">*</span></h5>
        <div class="trigger-zip-hit ratio-1 position-relative max-w-100 overflow-hidden bg-white border-dashed rounded-2 mx-auto h-100px d-center">
            <input type="file" accept=".zip" required style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">                                
            <div class="global-upload-box">
                <div class="upload-content text-center">
                    <span class="material-symbols-outlined placeholder-icon mb-1 text-primary">folder</span>
                    <span class="fz-10 d-block">Upload File</span>
                </div>
            </div>                                
        </div>
    </div>
    <div class="inside-upload-zipBox">

    </div>
</div>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                </div>
            </div>
            
            <!-- 00 Row  -->
            <div class="card p-20 mb-4">
                <div class="row g-4">
                    <div class="col-md-12">
                        <h2 class="mb-2 text-primary text-uppercase border-bottom pb-3">Modal Popup</h2>
                    </div>
                    <!-- Start -->
                    <div class="col-lg-12">
                        <div class="component-snippets-container position-relative card">
                            <div class="component-snippets-preview">
                                <div id="liveAlertPlaceholder">
                                    <div></div>
                                </div>
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal" class="border rounded p-12 fw-semibold bg-primary text-white mb-3">Delete status?</a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#turnOnStatus" class="border rounded p-12 fw-semibold bg-primary text-white mb-3">Are you sure Turn On the status?</a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#turnOffStatus" class="border rounded p-12 fw-semibold bg-primary text-white mb-3">Are you sure Turn Off the status?</a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#onPortialPayment" class="border rounded p-12 fw-semibold bg-primary text-white mb-3">Are you sure turn on Partial Payment</a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#offPortialPayment" class="border rounded p-12 fw-semibold bg-primary text-white mb-3">Are you sure turn Off Partial Payment</a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#googleConfiguration" class="border rounded p-12 fw-semibold bg-primary text-white mb-3">Set Up Google Configuration First</a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#appleConfiguration" class="border rounded p-12 fw-semibold bg-primary text-white mb-3">Set Up Apple ID Configuration First</a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#facebookConfiguration" class="border rounded p-12 fw-semibold bg-primary text-white mb-3">Set Up Facebook Configuration First</a>
                                </div>
                            </div>
                            <div class="position-relative snippets-code-hover">
                                <div class="component-snippets-code-header">
                                    <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                    <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                        <i class="fi fi-rr-copy"></i> 
                                    </button>
                                </div>
                                <div class="code-preview max-w-100">
                                    <div class="component-snippets-code-container">
                                        <pre>
                                            <code class="">
                                                <!--Status On Modal--> 
<div class="modal fade custom-confirmation-modal" id="turnOnStatus" tabindex="-1" aria-labelledby="statusonModelLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-30">
                <button type="button" class="btn-close bg-light rounded-full" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="d-flex flex-column align-items-center text-center">
                    <img class="mb-20" src="{{asset('public/assets/admin-module')}}/img/status-on.png" alt="">
                    <h3 class="mb-15">{{ translate('Are you sure Turn On the status?')}}</h3>
                    <p class="mb-4 fz-14">{{ translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet ')}}</p>
                    <form action="{{ route('admin.subscription.package.subscription-to-commission') }}" method="post">
                        @csrf
                        <div class="choose-option">
                            <div class="d-flex gap-3 justify-content-center flex-wrap">
                                <button type="button" class="btn px-xl-5 px-4 btn--secondary rounded" data-bs-dismiss="modal">NO</button>
                                <button type="button" class="btn px-xl-5 px-4 btn--primary text-capitalize rounded">Yes</button>                                              
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End -->
                </div>
            </div>



        <!-- Offcanvas Row  -->
        <div class="card p-20 mb-4">
            <div class="row g-4">
                <!-- Start -->
                <div class="col-lg-12">
                    <div class="component-snippets-container position-relative card">
                        <div class="component-snippets-preview">
                            <div id="liveAlertPlaceholder">
                                <div></div>
                            </div>
                            <div class="view-details-container">
                                <div class="">
                                    <div class="row align-items-center">
                                        <div class="col-xxl-8 col-md-6 mb-md-0 mb-2">
                                            <h3 class="black-color mb-1 d-block">{{ translate('Firebase Authentication') }}</h3>
                                            <p class="fz-12 text-c mb-0">{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet.')}}</p>
                                        </div>
                                        <div class="col-xxl-4 col-md-6">
                                            <div class="d-flex flex-sm-nowrap flex-wrap justify-content-end justify-content-end align-items-center gap-sm-3 gap-2">
                                                <div class="view-btn  order-sm-0 order-3 fz-12 text-primary cursor-pointer fw-semibold d-flex align-items-center gap-1">
                                                    View 
                                                    <i class="material-symbols-outlined fz-14">arrow_downward</i>
                                                </div>
                                                <div class="mb-0">
                                                    <label class="switcher">
                                                        <input class="switcher_input section-toggle" type="checkbox"> 
                                                        <span class="switcher_control"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3 view-details">
                                        <div class="body-bg rounded p-20 mb-20">
                                            <div class="">
                                                <div class="mb-2 text-dark">{{translate('Web Api Key')}}
                                                    <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="{{translate('Web Api Key')}}"
                                                    >info</i>
                                                </div>
                                                <input type="text" placeholder="Ex: Smtp.amailtrap.io " class="form-control" name="measurementId" value="">                                    
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end gap-3">
                                            <button type="reset" class="btn btn--secondary rounded">{{translate('Reset')}}</button>
                                            <button type="button" class="btn btn--primary demo_check rounded" data-bs-toggle="modal" data-bs-target="#confirmation">{{translate('Save Information')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="position-relative snippets-code-hover">
                            <div class="component-snippets-code-header">
                                <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                    <i class="fi fi-rr-copy"></i> 
                                </button>
                            </div>
                            <div class="code-preview max-w-100">
                                <div class="component-snippets-code-container">
                                    <pre>
                                        <code class="">
<div class="view-details-container">
    <div class="">
        <div class="row align-items-center">
            <div class="col-xxl-8 col-md-6 mb-md-0 mb-2">
                <h3 class="black-color mb-1 d-block">{{ translate('Firebase Authentication') }}</h3>
                <p class="fz-12 text-c mb-0">{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet.')}}</p>
            </div>
            <div class="col-xxl-4 col-md-6">
                <div class="d-flex flex-sm-nowrap flex-wrap justify-content-end justify-content-end align-items-center gap-sm-3 gap-2">
                    <div class="view-btn  order-sm-0 order-3 fz-12 text-primary cursor-pointer fw-semibold d-flex align-items-center gap-1">
                        View 
                        <i class="material-symbols-outlined fz-14">arrow_downward</i>
                    </div>
                    <div class="mb-0">
                        <label class="switcher">
                            <input class="switcher_input section-toggle" type="checkbox"> 
                            <span class="switcher_control"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-3 view-details">
            <div class="body-bg rounded p-20 mb-20">
                <div class="">
                    <div class="mb-2 text-dark">{{translate('Web Api Key')}}
                        <i class="material-icons fz-14 text-light-gray" data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="{{translate('Web Api Key')}}"
                        >info</i>
                    </div>
                    <input type="text" placeholder="Ex: Smtp.amailtrap.io " class="form-control" name="measurementId" value="">                                    
                </div>
            </div>
            <div class="d-flex justify-content-end gap-3">
                <button type="reset" class="btn btn--secondary rounded">{{translate('Reset')}}</button>
                <button type="button" class="btn btn--primary demo_check rounded" data-bs-toggle="modal" data-bs-target="#confirmation">{{translate('Save Information')}}</button>
            </div>
        </div>
    </div>
</div>
                                        </code>
                                    </pre>
                                </div>
                            </div>
                        </div>
                    </div>            
                </div>
                <!-- End -->
                <!-- Start -->
                <div class="col-lg-12">
                    <div class="component-snippets-container position-relative card">
                        <div class="component-snippets-preview">
                            <div id="liveAlertPlaceholder">
                                <div></div>
                            </div>
                            <div>
                                <div class="d-flex align-items-center justify-content-between flex-sm-nowrap flex-wrap gap-2">
                                    <div>
                                        <h3 class="page-title mb-2">{{translate('OffCanvas Title')}}</h3>
                                        <p>{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet ')}}</p>
                                    </div>
                                    <button type="button" class="rounded transition text-nowrap fz-12 fw-semibold btn-primary__outline btn d-flex align-items-center gap-1 py-2 px-3" data-bs-toggle="offcanvas" data-bs-target="#customer-landing-page">
                                        <span class="material-symbols-outlined">visibility</span> View Offcanvas
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="position-relative snippets-code-hover">
                            <div class="component-snippets-code-header">
                                <button class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                                <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                                    <i class="fi fi-rr-copy"></i> 
                                </button>
                            </div>
                            <div class="code-preview max-w-100">
                                <div class="component-snippets-code-container">
                                    <pre>
                                        <code class="">
    <div class="d-flex align-items-center justify-content-between flex-sm-nowrap flex-wrap gap-2">
        <div>
            <h3 class="page-title mb-2">{{translate('OffCanvas Title')}}</h3>
            <p>{{translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet ')}}</p>
        </div>
        <button type="button" class="rounded transition text-nowrap fz-12 fw-semibold btn-primary__outline btn d-flex align-items-center gap-1 py-2 px-3" data-bs-toggle="offcanvas" data-bs-target="#customer-landing-page">
            <span class="material-symbols-outlined">visibility</span> View Offcanvas
        </button>
    </div>

    <!-- Offcanvas Body-->
    <form action="" method="post" id="update-form-submit">
        @csrf
        <div class="offcanvas offcanvas-end" tabindex="-1" id="customer-landing-page" aria-labelledby="testimonial-landing-pageLabel">
            <div class="offcanvas-header py-md-4 py-3">
                <h2 class="mb-0">Hero Section Preview</h2>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body bg-white">
                <div class="hero-preview-thumb px-md-5 px-0 py-md-4 py-1"> 
                    <img src="{{asset('public/assets/admin-module')}}/img/customer-hero-preview.png" alt="img" class="w-100">
                </div>
            </div>
        </div>
    </form>
                                        </code>
                                    </pre>
                                </div>
                            </div>
                        </div>
                    </div>            
                </div>
                <!-- End -->
            </div>
        </div> 

        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex flex-wrap gap-3 justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-lg-2 mb-1">
                            {{translate('System Maintenance')}}
                        </h4>
                        <p>*{{ translate('By turning on maintenance mode Control your all system & function') }}</p>
                    </div>
                    <div class="w-100 max-w320">
                        <div class="d-flex justify-content-between align-items-center border rounded px-3 py-lg-3 py-2">
                            <h5 class="mb-0 fw-normal">{{translate('maintenance_mode')}}</h5>
                            <label class="switcher ml-auto mb-0">
                                <input type="checkbox" class="switcher_input">
                                <span class="switcher_control"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body p-20">
                <div class="table-responsive table-custom-responsive">
                    <table id="example" class="table align-middle">
                        <thead class="text-nowrap">
                            <tr>
                                <th class="text-dark fw-medium bg-light">{{translate('Sl')}}</th>
                                <th class="text-dark fw-medium bg-light">{{translate('Name')}}</th>
                                <th class="text-dark fw-medium bg-light">{{translate('Social media link')}}</th>
                                <th class="text-dark fw-medium bg-light">{{translate('status')}}</th>
                                <th class="text-dark fw-medium bg-light text-end">{{translate('action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center bg-white  pt-5 pb-5" colspan="7">
                                    <div class="d-flex flex-column gap-2">
                                        <img src="{{asset('public/assets/admin-module')}}/img/log-list-error.svg" alt="error" class="w-100px mx-auto">
                                        <p>{{translate('data not found')}}</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        </div>
    </div>
    





<!-- Delete On Modal--> 
<div class="modal fade custom-confirmation-modal" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-30"> 
                <button type="button" class="btn-close bg-light rounded-full" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="d-flex flex-column align-items-center text-center">
                    <img class="mb-20" src="{{asset('public/assets/admin-module')}}/img/delete.png" alt="">
                    <h3 class="mb-15">{{ translate('Do you want to delete Facebook?')}}</h3>
                    <p class="mb-4 fz-14">{{ translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet ')}}</p>
                    <form action="{{ route('admin.subscription.package.subscription-to-commission') }}" method="post">
                        @csrf
                        <div class="choose-option">
                            <div class="d-flex gap-3 justify-content-center flex-wrap">
                                <button type="button" class="btn px-xl-5 px-4 btn--secondary rounded" data-bs-dismiss="modal">No</button>
                                <button type="button" class="btn px-xl-5 px-4 btn--danger text-capitalize rounded">Yes, Delete</button>                                              
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <!--Status On Modal--> 
    <div class="modal fade custom-confirmation-modal" id="turnOnStatus" tabindex="-1" aria-labelledby="statusonModelLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-30">
                    <button type="button" class="btn-close bg-light rounded-full" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="d-flex flex-column align-items-center text-center">
                        <img class="mb-20" src="{{asset('public/assets/admin-module')}}/img/status-on.png" alt="">
                        <h3 class="mb-15">{{ translate('Are you sure Turn On the status?')}}</h3>
                        <p class="mb-4 fz-14">{{ translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet ')}}</p>
                        <form action="{{ route('admin.subscription.package.subscription-to-commission') }}" method="post">
                            @csrf
                            <div class="choose-option">
                                <div class="d-flex gap-3 justify-content-center flex-wrap">
                                    <button type="button" class="btn px-xl-5 px-4 btn--secondary rounded" data-bs-dismiss="modal">NO</button>
                                    <button type="button" class="btn px-xl-5 px-4 btn--primary text-capitalize rounded">Yes</button>                                              
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Status Off Modal--> 
    <div class="modal fade custom-confirmation-modal" id="turnOffStatus" tabindex="-1" aria-labelledby="statusoffModelLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-30">
                    <button type="button" class="btn-close bg-light rounded-full" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="d-flex flex-column align-items-center text-center">
                        <img class="mb-20" src="{{asset('public/assets/admin-module')}}/img/status-of.png" alt="">
                        <h3 class="mb-15">{{ translate('Are you sure Turn Off the status?')}}</h3>
                        <p class="mb-4 fz-14">{{ translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet ')}}</p>
                        <form action="{{ route('admin.subscription.package.subscription-to-commission') }}" method="post">
                            @csrf
                            <div class="choose-option">
                                <div class="d-flex gap-3 justify-content-center flex-wrap">
                                    <button type="button" class="btn px-xl-5 px-4 btn--secondary rounded" data-bs-dismiss="modal">NO</button>
                                    <button type="button" class="btn px-xl-5 px-4 btn--primary text-capitalize rounded">Yes</button>                                              
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Partial Payment On Modal-->
    <div class="modal fade custom-confirmation-modal" id="onPortialPayment" tabindex="-1" aria-labelledby="onPortialModelLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-30">
                    <button type="button" class="btn-close bg-light rounded-full" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="d-flex flex-column align-items-center text-center">
                        <img class="mb-20" src="{{asset('public/assets/admin-module')}}/img/on-partial-payment.png" alt="">
                        <h3 class="mb-15">{{ translate('Are you sure turn on Partial Payment')}}</h3>
                        <p class="mb-4 fz-14">{{ translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet ')}}</p>
                        <form action="{{ route('admin.subscription.package.subscription-to-commission') }}" method="post">
                            @csrf
                            <div class="choose-option">
                                <div class="d-flex gap-3 justify-content-center flex-wrap">
                                    <button type="button" class="btn px-xl-5 px-4 btn--secondary rounded" data-bs-dismiss="modal">NO</button>
                                    <button type="button" class="btn px-xl-5 px-4 btn--primary text-capitalize rounded">Yes</button>                                              
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Partial Payment Off Modal--> 
    <div class="modal fade custom-confirmation-modal" id="offPortialPayment" tabindex="-1" aria-labelledby="onPortialModelLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-30">
                    <button type="button" class="btn-close bg-light rounded-full" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="d-flex flex-column align-items-center text-center">
                        <img class="mb-20" src="{{asset('public/assets/admin-module')}}/img/of-partial-payment.png" alt="">
                        <h3 class="mb-15">{{ translate('Are you sure turn Off Partial Payment')}}</h3>
                        <p class="mb-4 fz-14">{{ translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam odio tellus, laoreet ')}}</p>
                        <form action="{{ route('admin.subscription.package.subscription-to-commission') }}" method="post">
                            @csrf
                            <div class="choose-option">
                                <div class="d-flex gap-3 justify-content-center flex-wrap">
                                    <button type="button" class="btn px-xl-5 px-4 btn--secondary rounded" data-bs-dismiss="modal">NO</button>
                                    <button type="button" class="btn px-xl-5 px-4 btn--primary text-capitalize rounded">Yes</button>                                              
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Google Configuration Modal--> 
    <div class="modal fade custom-confirmation-modal" id="googleConfiguration" tabindex="-1" aria-labelledby="googleConfigurationLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-30">
                    <button type="button" class="btn-close bg-light rounded-full" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="d-flex flex-column align-items-center text-center">
                        <img class="mb-20" src="{{asset('public/assets/admin-module')}}/img/mgoogle.png" alt="">
                        <h3 class="mb-15">{{ translate('Set Up Google Configuration First')}}</h3>
                        <p class="mb-4 fz-14">{{ translate('It looks like your Google configuration is not set up yet. To enable the OTP system, please set up the Google configuration first.')}}</p>
                        <form action="{{ route('admin.subscription.package.subscription-to-commission') }}" method="post">
                            @csrf
                            <div class="choose-option">
                                <div class="d-flex gap-3 justify-content-center flex-wrap">
                                    <button type="button" class="btn px-xl-5 px-4 btn--primary text-capitalize rounded">Go to Google Configuration</button>                                              
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Apple Configuration Modal--> 
    <div class="modal fade custom-confirmation-modal" id="appleConfiguration" tabindex="-1" aria-labelledby="appleConfigurationLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-30">
                    <button type="button" class="btn-close bg-light rounded-full" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="d-flex flex-column align-items-center text-center">
                        <img class="mb-20" src="{{asset('public/assets/admin-module')}}/img/mapple.png" alt="">
                        <h3 class="mb-15">{{ translate('Set Up Apple ID Configuration First')}}</h3>
                        <p class="mb-4 fz-14">{{ translate('It looks like your Apple ID Login configuration is not set up yet. To enable the Apple ID Login option, please set up the Apple ID configuration first.')}}</p>
                        <form action="{{ route('admin.subscription.package.subscription-to-commission') }}" method="post">
                            @csrf
                            <div class="choose-option">
                                <div class="d-flex gap-3 justify-content-center flex-wrap">
                                    <button type="button" class="btn px-xl-5 px-4 btn--primary text-capitalize rounded">Go to Apple ID Configuration</button>                                              
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <!--Facebook Configuration Modal--> 
    <div class="modal fade custom-confirmation-modal" id="facebookConfiguration" tabindex="-1" aria-labelledby="appleConfigurationLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-30">
                    <button type="button" class="btn-close bg-light rounded-full" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="d-flex flex-column align-items-center text-center">
                        <img class="mb-20" src="{{asset('public/assets/admin-module')}}/img/mfacebook.png" alt="">
                        <h3 class="mb-15">{{ translate('Set Up Facebook Configuration First')}}</h3>
                        <p class="mb-4 fz-14">{{ translate('It looks like your Facebook Login configuration is not set up yet. To enable the Facebook Login option, please set up the Facebook configuration first.')}}</p>
                        <form action="{{ route('admin.subscription.package.subscription-to-commission') }}" method="post">
                            @csrf
                            <div class="choose-option">
                                <div class="d-flex gap-3 justify-content-center flex-wrap">
                                    <button type="button" class="btn px-xl-5 px-4 btn--primary text-capitalize rounded">Go to Facebook Configuration</button>                                              
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>                       

    <!-- Offcanvas -->
    <form action="" method="post" id="update-form-submit">
        @csrf
        <div class="offcanvas offcanvas-end" tabindex="-1" id="customer-landing-page" aria-labelledby="testimonial-landing-pageLabel">
            <div class="offcanvas-header py-md-4 py-3">
                <h2 class="mb-0">Hero Section Preview</h2>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body bg-white">
                <div class="hero-preview-thumb px-md-5 px-0 py-md-4 py-1"> 
                    <img src="{{asset('public/assets/admin-module')}}/img/customer-hero-preview.png" alt="img" class="w-100">
                </div>
            </div>
        </div>
    </form>
    
@endsection


@push('script')
<script src="{{asset('public/assets/admin-module')}}/plugins/highlight/highlight.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            hljs.initHighlightingOnLoad();
            document.querySelectorAll(".component-snippets-code-container code").forEach((block) => {
                block.textContent = block.innerHTML.trim();
            });

            // Add copy functionality
            document.querySelectorAll('.copy--button').forEach(button => {
                button.addEventListener('click', () => {
                    const codeBlock = button.closest('.component-snippets-container').querySelector('.code-preview code');
                    navigator.clipboard.writeText(codeBlock.textContent).then(() => {
                        // Change icon temporarily to show success
                        const icon = button.querySelector('i');
                        icon.classList.remove('fi-rr-copy')
                        icon.classList.add('fi-rr-check') // change to check icon

                        setTimeout(() => {
                            icon.classList.remove('fi-rr-check');
                            icon.classList.add('fi rr-copy') // revert to copy icon
                        }, 1000);
                    });
                });
            });

        });
    </script>

<script>
        $(".view-btn").on("click", function () {
            var container = $(this).closest(".view-details-container");
            var details = container.find(".view-details");
            var icon = $(this).find("i");
        
            $(this).toggleClass("active");
            details.slideToggle(300);
            icon.toggleClass("rotate-180deg");
        });


        $(".section-toggle").on("change", function () {
            if ($(this).is(':checked')) {
                $(this).closest(".view-details-container").find(".view-details").slideDown(300);
            } else {
                $(this).closest(".view-details-container").find(".view-details").slideUp(300);
            }
        });
</script>
  
@endpush
